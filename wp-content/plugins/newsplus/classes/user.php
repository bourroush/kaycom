<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_User extends TmMS {

	public function __construct() {
		//AJAX
		add_action('wp_ajax_mail_subscriber_get_letter_recepients', array(&$this, 'get_letter_recepients'));
		add_action('wp_ajax_mail_subscriber_user_set_group', array(&$this, 'user_set_group'));
		add_action('wp_ajax_nopriv_mail_subscriber_subscribe_user', array(&$this, 'subscribe_user'));
		add_action('wp_ajax_mail_subscriber_save_user_cabinet_settings', array(&$this, 'save_user_cabinet_settings'));
		add_action('wp_ajax_mail_subscriber_delete_account', array(&$this, 'delete_account'));
		//***
		add_action('mail_subscriber_user_activation', array(&$this, 'activate_user'));
		add_filter('manage_users_columns', array(&$this, 'manage_users_columns'), 15, 1);
		add_action('manage_users_custom_column', array(&$this, 'manage_users_custom_column'), 15, 3);
	}

	//add columns to User panel list page
	public function manage_users_columns($defaults) {
		$defaults['group'] = __('Subscribed', 'newsplus');
		return $defaults;
	}

	public function manage_users_custom_column($value, $column_name, $id) {
		if ($column_name == 'group') {
			$data = array();
			$data['groups'] = $this->get_users_groups();
			$data['users_groups'] = $this->user_get_groups($id);
			$data['user_id'] = $id;

			return $this->draw_html('admin/user_groups_form', $data);
		}
	}

	public static function get_users_groups() {
		$args = array(
			'orderby' => 'title',
			'order' => 'ASC',
			'hierarchical' => 1,
			'show_count' => 0,
			'hide_empty' => false
		);


		$groups = get_terms('mail_subscriber_types', $args);
		$result = array();
		if (!empty($groups)) {
			foreach ($groups as $value) {
				$result[$value->term_id] = array('name' => $value->name, 'description' => $value->description);
			}
		}

		return $result;
	}

	private function user_get_groups($user_id) {
		global $wpdb;
		$res = $wpdb->get_results('SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_groups" AND user_id=' . $user_id, ARRAY_A);
		if (!empty($res)) {
			$groups = unserialize($res[0]['meta_value']);
		} else {
			$groups = array();
		}

		return $groups;
	}

	private function user_get_postcat($user_id) {
		global $wpdb;
		$res = $wpdb->get_results('SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_postcat" AND user_id=' . $user_id, ARRAY_A);
		if (!empty($res)) {
			$groups = unserialize($res[0]['meta_value']);
		} else {
			$groups = array();
		}

		return $groups;
	}

	//****
	//ajax
	public function get_letter_recepients() {
		$subscribe_groups = $_REQUEST['subscribe_groups'];
		if (!empty($subscribe_groups)) {
			global $wpdb;
			$result = array();
			$users = $wpdb->get_results('SELECT user_id,meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_groups"', ARRAY_A);

			if (!empty($users)) {
				foreach ($users as $user) {
					$groups = unserialize($user['meta_value']);
					if (!empty($groups)) {
						foreach ($groups as $group) {
							if (in_array($group, $subscribe_groups)) {
								$result[] = $user['user_id'];
								break;
							}
						}
					}
				}
			}

			echo json_encode($result);
		}
		exit;
	}

	//ajax
	public function user_set_group() {
		$groups = $this->user_get_groups($_REQUEST['user_id']);
		if (empty($groups)) {
			$groups = array();
		}
		//***
		$mode = $_REQUEST['mode'];
		$group_id = $_REQUEST['group_id'];

		if ($mode == 1) {
			$groups[] = $group_id;
		} else {
			foreach ($groups as $key => $id) {
				if ($id == $group_id) {
					unset($groups[$key]);
					break;
				}
			}
		}
		//***
		update_user_meta($_REQUEST['user_id'], 'tm_mail_subscriber_user_groups', $groups);
		exit;
	}

	public static function subscribe_user() {
		
		$user_name = trim($_REQUEST['user_name']);
		$user_email = trim($_REQUEST['user_email']);

		$result = array();
		$result['error'] = "";
		$result['info'] = "";


		if (username_exists($user_name)) {
			$result['err_name'] = __('Please try another username. Such name already exists', 'newsplus');
			echo json_encode($result);
			exit;
		}

		if (empty($user_name)) {
			$result['err_email'] = __('Please type correct mail address', 'newsplus');
			echo json_encode($result);
			exit;
		}

		if (!is_email($user_email)) {
			$result['err_email'] = __('Wrong email!', 'newsplus');
			echo json_encode($result);
			exit;
		}

		if (email_exists($user_email)) {
			$result['err_email'] = __('Such email already exists', 'newsplus');
			echo json_encode($result);
			exit;
		}

		global $wpdb;
		$now = time();
		$hash = md5($user_name . $user_email . $now);
		$wpdb->insert('mail_subscriber_user_not_confirmed', array(
			'name' => $user_name,
			'email' => $user_email,
			'hash' => $hash,
			'date' => $now
		));

		$content = '<a href="' . home_url() . '?ms_action=mail_subscriber_user_activation&hash=' . $hash . '">' . __('Please confirm your registration', 'newsplus') . '</a>';
		self::send_email($user_email, $content, __('Subscription confirmation', 'newsplus'));


		$result['info'] = __('Congratulations! You have been successfully subscribed to our newsletter. Please check your mailbox and confirm your current subscription.', 'newsplus');
		echo json_encode($result);
		exit;
	}

	public function activate_user() {
		//***
		global $wpdb;
		$user_data = $wpdb->get_results('SELECT * FROM mail_subscriber_user_not_confirmed WHERE hash="' . $_GET['hash'] . '"', ARRAY_A);
		if (empty($user_data)) {
			wp_die(__('Such data doesn\'t exist', 'newsplus'));
		}
		$user_data = $user_data[0];
		$user_name = $user_data['name'];
		$user_email = $user_data['email'];
		//***
		$settings = TmMS_Settings::get_settings();
		$random_password = wp_generate_password();
		$user_id = wp_create_user($user_name, $random_password, $user_email);
		//subscribe user ***********************************************************
		$groups = self::get_users_groups();
		$groups = array_keys($groups);
		update_user_meta($user_id, 'tm_mail_subscriber_user_groups', $groups);
		//**************************************************************************
		$subject = (!isset($settings['new_user_registration_mail_subject']) ? __("User subscription", 'newsplus') : $settings['new_user_registration_mail_subject']);
		$content = (!isset($settings['new_user_registration_text']) ? __("Hello __USERNAME__! Your password is: __PASSWORD__", 'newsplus') : $settings['new_user_registration_text']);
		//***
		$content = str_replace("__USERNAME__", $user_name, $content);
		$content = str_replace("__PASSWORD__", $random_password, $content);
		//***
		if (self::send_email($user_email, $content, $subject)) {
			$wpdb->delete('mail_subscriber_user_not_confirmed', array('hash' => $_GET['hash']));
			$settings = TmMS_Settings::get_settings();

			if (wp_authenticate($user_name, $random_password)) {
				$credentials['user_login'] = $user_name;
				$credentials['user_password'] = $random_password;
				$credentials['remember'] = true;
				$user = wp_signon($credentials, false);
				if (is_wp_error($user)) {
					wp_die(__('Wrong data', THEMEMAKERS_THEME_FOLDER_NAME));
				}
			}
			?>
			<script type="text/javascript">
				alert('<?php _e('Thank you for signing up. Your e-mail address has been successfully added to our subscription list!', 'newsplus') ?>');
				window.location = '<?php echo home_url() . '/?p=' . $settings['user_subscribe_page_id'] ?>';
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
				alert('<?php _e('Server error. Please try again later.', 'newsplus') ?>');
			</script>
			<?php
		}
	}	

	public function draw_user_cabinet() {
		$data = array();
		$current_user_id = get_current_user_id();
		if ($current_user_id) {
			wp_enqueue_style('mail_subscriber_options', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/styles.css');
			wp_enqueue_script('mail_subscriber_options', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'js/admin/options.js', array('jquery'));
			wp_enqueue_script('mail_subscriber_user_cabinet', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'js/front/user_cabinet.js', array('jquery'));
			?>
			<script type="text/javascript">
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
				var homeurl = "<?php echo home_url(); ?>";
			</script>
			<?php
			$data['posts_categories'] = get_categories();
			$data['users_postcat'] = $this->user_get_postcat($current_user_id);
			//***
			$data['groups'] = $this->get_users_groups();
			$data['users_groups'] = $this->user_get_groups($current_user_id);
			$data['user_id'] = $current_user_id;
		}

		return $this->draw_html('front/user_cabinet', $data);
	}

	public function save_user_cabinet_settings() {
		$data = array();
		parse_str($_REQUEST['values'], $data);
		update_user_meta(get_current_user_id(), 'tm_mail_subscriber_user_groups', $data['tm_mail_subscriber_user_groups']);
		update_user_meta(get_current_user_id(), 'tm_mail_subscriber_user_postcat', $data['tm_mail_subscriber_user_postcat']);

		exit;
	}

	public function delete_account() {
		if (!current_user_can('manage_options')) {
			$user_id = get_current_user_id();
			wp_delete_user($user_id);
			TmMS_Statistic::update_stat('delete_account');
		}

		exit;
	}

}

