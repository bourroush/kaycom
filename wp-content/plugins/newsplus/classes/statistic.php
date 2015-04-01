<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_Statistic extends TmMS {

	public function __construct() {
		add_filter('manage_edit-category_columns', array(&$this, 'manage_edit_category_columns'), 10, 2);
		add_action('manage_category_custom_column', array(&$this, 'manage_category_custom_column'), 10, 3);

		//***
		add_action('mail_subscriber_mail_clicking', array(&$this, 'register_mail_clicking'));
	}

	public function dashboard_widget() {
		$data = array();
		$subscribers = 0;
		$count_users = count_users();
		global $wpdb;
		$subscribers_array = $wpdb->get_results('SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_groups"', ARRAY_A);
		$user_count_by_email_themes = array();
		//***
		foreach ($subscribers_array as $user_sub_themes) {
			$user_sub_themes = unserialize($user_sub_themes['meta_value']);

			if (!empty($user_sub_themes) AND is_array($user_sub_themes)) {
				$subscribers++;
				//for USER COUNT BY EMAIL THEME
				if (!empty($user_sub_themes)) {
					foreach ($user_sub_themes as $mail_cat_id) {
						@$user_count_by_email_themes[$mail_cat_id]+=1;
					}
				}
			}
		}
		$no_subscribed = intval($count_users['total_users']) - intval($subscribers);
		//***
		$data['subscribers_stat'] = array(
			'title' => __('Subscribed Users/Unsubscribed Users', 'newsplus'),
			'width' => '100%',
			'height' => 350,
			'data' => array(
				array('title' => __('Subscribed', 'newsplus') . ': ' . $subscribers, 'value' => intval($subscribers)),
				array('title' => __('Not subscribed', 'newsplus') . ': ' . $no_subscribed, 'value' => $no_subscribed)
			)
		);
		//*** USER COUNT BY EMAIL THEME
		if (!empty($user_count_by_email_themes)) {
			$data['subscribers_by_themes'] = array(
				'title' => __('Subscribers by Category', 'newsplus'),
				'width' => '100%',
				'height' => 350,
				'data' => array()
			);

			foreach ($user_count_by_email_themes as $mail_cat_id => $count) {
				$term = get_term_by('term_id', $mail_cat_id, 'mail_subscriber_types');
				$data['subscribers_by_themes']['data'][] = array('title' => $term->name, 'value' => $count);
			}
		}

		//*** COUNT OF DELETED USERS IN CURRENT MONTH
		$data['deleted_accounts'] = array(
			'title' => __('Unsubscribed users (current month)', 'newsplus'),
			'hAxis_title' => __('Days', 'newsplus'),
			'width' => '100%',
			'height' => 350,
			'x_title' => __('Days', 'newsplus'),
			'y_title' => __('Count', 'newsplus'),
			'data' => array()
		);
		$options = array();
		$options['start'] = strtotime(date('Y-m-01'));
		$options['finish'] = strtotime(date('Y-m-t'));
		$end_date_num = date('t');
		$res = self::get_stat('delete_account', $options);
		//***
		$days_array = array();
		for ($i = 1; $i <= $end_date_num; $i++) {
			$days_array[$i] = 0;
		}
		//***
		if (!empty($res)) {
			foreach ($res as $value) {
				$d = intval(date('d', $value['date']));
				$days_array[$d]+=1;
			}
		}


		if (!empty($days_array)) {
			foreach ($days_array as $day_num => $count) {
				$data['deleted_accounts']['data'][] = array('title' => $day_num, 'value' => $count);
			}
		}


		//***
		//*** EMAILS SENT BY GROUPS
		$data['emails_sent_by_groups'] = array(
			'title' => __('Emails have been sent by groups', 'newsplus'),
			'width' => '100%',
			'height' => 350,
			'data' => array()
		);
		$options = array();
		$options['start'] = strtotime(date('Y-m-01'));
		$options['finish'] = strtotime(date('Y-m-t'));
		$res = self::get_stat('sent', $options);
		$groups_data = array();
		if (!empty($res)) {
			foreach ($res as $value) {
				$groups = explode(',', $value['groups']);
				if (!empty($groups)) {
					foreach ($groups as $group_id) {
						@$groups_data[$group_id]+=1;
					}
				}
			}
			//***
			if (!empty($groups_data)) {
				$groups_terms = get_terms('mail_subscriber_types', array('hide_empty' => false));
				$groups_terms_array = array();
				if (!empty($groups_terms)) {
					foreach ($groups_terms as $value) {
						$groups_terms_array[$value->term_id] = $value->name;
					}
				}
				//***
				foreach ($groups_data as $group_id => $count) {
					$data['emails_sent_by_groups']['data'][] = array('title' => $groups_terms_array[$group_id], 'value' => $count);
				}
			}
		}


		//***********************************
		echo $this->draw_html('admin/statistic/dashboard_widget', $data);
	}

	public static function draw_pie_chart($data) {
		$unique_id = uniqid();
		?>
		<script type="text/javascript">
			google.load("visualization", "1", {packages: ["corechart"]});
			google.setOnLoadCallback(drawChart_<?php echo $unique_id ?>);
			function drawChart_<?php echo $unique_id ?>() {
				var data = google.visualization.arrayToDataTable([
						['Chart', 'Pie Chart'],
		<?php foreach ($data['data'] as $key => $value) : ?>
			<?php if ($key > 0) echo ','; ?>['<?php echo $value['title'] ?>', <?php echo $value['value'] ?>]
		<?php endforeach; ?>
				]);
						var options = {
					title: '<?php echo $data['title'] ?>',
					backgroundColor: '#F5F5F5',
					animation: {
						duration: 1000,
						easing: 'out'
					}
				};
				var chart = new google.visualization.PieChart(document.getElementById('chart_<?php echo $unique_id ?>'));
				chart.draw(data, options);
			}
		</script>
		<div id="chart_<?php echo $unique_id ?>" style="width: <?php echo $data['width'] ?>; height: <?php echo $data['height'] ?>px;"></div>
		<?php
	}

	public static function draw_column_chart($data) {
		$unique_id = uniqid();
		?>
		<script type="text/javascript">
			google.load("visualization", "1", {packages: ["corechart"]});
			google.setOnLoadCallback(drawChart_<?php echo $unique_id ?>);
			function drawChart_<?php echo $unique_id ?>() {
				var data = google.visualization.arrayToDataTable([
						['<?php echo $data['x_title'] ?>', '<?php echo $data['y_title'] ?>'],
		<?php foreach ($data['data'] as $key => $value) : ?>
			<?php if ($key > 0) echo ','; ?>['<?php echo $value['title'] ?>', <?php echo $value['value'] ?>]
		<?php endforeach; ?>
				]);
						var options = {
					title: '<?php echo $data['title'] ?>',
					hAxis: {title: '<?php echo $data['hAxis_title'] ?>', titleTextStyle: {color: 'red'}},
					vAxis: {minValue: 4}
				};

				var chart = new google.visualization.ColumnChart(document.getElementById('chart_<?php echo $unique_id ?>'));
				chart.draw(data, options);
			}
		</script>
		<div id="chart_<?php echo $unique_id ?>" style="width: <?php echo $data['width'] ?>; height: <?php echo $data['height'] ?>px;"></div>
		<?php
	}

	public function register_mail_clicking() {
		if (isset($_GET['params'])) {
			$data = unserialize(base64_decode($_GET['params']));
			if (!empty($data)) {
				self::update_stat('register_mail_clicking', $data);
			}
		}
	}

	public static function get_letter_link_url($url, array $data) {
		$data = base64_encode(serialize($data));
		return $url . '?ms_action=mail_subscriber_mail_clicking&params=' . $data;
	}

	public static function update_stat($stat, $data = array()) {
		$now = time();
		global $wpdb;

		switch ($stat) {
			case 'delete_account':
				$wpdb->insert('mail_subscriber_stat_delete_account', array('date' => $now));
				break;
			case 'register_mail_clicking':
				//check is it first click
				$res = $wpdb->get_results('SELECT * FROM mail_subscriber_stat_mail_clicking WHERE user_id="' . $data['user_id'] . '" AND mail_id=' . $data['mail_id'], ARRAY_A);
				if (empty($res)) {
					$wpdb->query('INSERT INTO `mail_subscriber_stat_mail_clicking` (`user_id`,`mail_id`,`date`) VALUES("' . $data['user_id'] . '",' . $data['mail_id'] . ',' . $now . ')');
					/*
					  $wpdb->insert('mail_subscriber_stat_mail_clicking', array(
					  'user_id' => $data['user_id'],
					  'mail_id' => $data['mail_id'],
					  'date' => $now
					  ));
					 */
				}
				break;

			case 'sent':
				$wpdb->query('INSERT INTO `mail_subscriber_stat_mail_sent` (`user_id`,`mail_id`,`groups`,`date`) VALUES("' . $data['user_id'] . '",' . $data['mail_id'] . ',"' . $data['groups'] . '",' . $now . ')');
				break;
			default:
				break;
		}
	}

	public static function get_stat($stat, $data = array()) {
		global $wpdb;
		switch ($stat) {
			case 'delete_account':
				return $wpdb->get_results('SELECT * FROM mail_subscriber_stat_delete_account WHERE date>' . $data['start'] . ' AND date<' . $data['finish'], ARRAY_A);
				break;
			case 'referred_by_link':
				//for one letter
				$res = $wpdb->get_results('SELECT * FROM mail_subscriber_stat_mail_clicking WHERE mail_id=' . $data['mail_id'], ARRAY_A);
				return count($res);
				break;

			case 'sent':
				$res = $wpdb->get_results('SELECT * FROM mail_subscriber_stat_mail_sent WHERE date>' . $data['start'] . ' AND date<' . $data['finish'], ARRAY_A);
				return $res;
				break;

			default:
				break;
		}
	}

	public function add_mail_stat_data($post_id, $data, $action = 'send_letter') {
		$mail_stat_data = $this->get_mail_stat_data($post_id);

		switch ($action) {
			case 'send_letter':
				$index = date('d-m-Y');

				if (!isset($mail_stat_data[$action])) {
					$mail_stat_data[$action] = array();
				}

				if (!isset($mail_stat_data[$action][$index])) {
					$mail_stat_data[$action][$index] = array();
				}

				@$mail_stat_data[$action][$index]['time'] = time();
				if (!isset($mail_stat_data[$action][$index]['user_count'])) {
					$mail_stat_data[$action][$index]['user_count'] = 0;
				}
				$mail_stat_data[$action][$index]['user_count']+=1;

				//***

				break;


			default:
				break;
		}

		update_post_meta($post_id, 'mail_stat_data', $mail_stat_data);
	}

	public static function get_mail_stat_data($post_id) {
		$mail_stat_data = get_post_meta($post_id, 'mail_stat_data', true);
		if (empty($mail_stat_data)) {
			$mail_stat_data = array();
		}
		return $mail_stat_data;
	}

	public function manage_edit_category_columns($cat_columns) {
		$cat_columns['mail_subscriber_users_count'] = __('Users subscribed', 'newsplus');
		return $cat_columns;
	}

	public function manage_category_custom_column($deprecated, $column_name, $term_id) {
		if ($column_name == 'mail_subscriber_users_count') {
			global $wpdb;
			$count = 0;
			$res = $wpdb->get_results('SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_postcat"', ARRAY_A);
			if (!empty($res)) {
				foreach ($res as $values) {
					$values = unserialize($values['meta_value']);
					if (is_array($values)) {
						if (in_array($term_id, $values)) {
							++$count;
						}
					}
				}
			}

			echo $count;
		}
	}	

}
