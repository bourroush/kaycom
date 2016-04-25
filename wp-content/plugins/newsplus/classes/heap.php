<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_Heap extends TmMS {

	public static $posts_in_heap = array(); //posts in heap `mail_subscriber_posts_heap` for mailing
	public static $snippets = array();

	public function __construct() {
		add_action('wp_ajax_ms_add_post_to_send_heap', array(&$this, 'add_post_to_send_heap'));
		add_action('wp_ajax_ms_remove_post_from_send_heap', array(&$this, 'remove_post_from_send_heap'));
		add_action('wp_ajax_ms_mail_posts_heap', array(&$this, 'mail_posts_heap'));
		add_action('wp_ajax_ms_send_post_one_letter', array(&$this, 'send_post_one_letter'));
		add_action('wp_ajax_ms_clean_heap', array(&$this, 'clean_heap'));

		add_action('admin_footer', array(&$this, 'admin_footer'));

		//***
		add_filter('manage_edit-post_columns', array(&$this, 'manage_edit_post_columns'), 10, 2);
		add_action('manage_posts_custom_column', array(&$this, 'manage_posts_custom_column'), 10, 2);
		//***

		if (is_admin()) {
			//not need in front
			self::$posts_in_heap = $this->get_posts_in_heap();
		}
		//***
		self::$snippets = array(
			'__USER_NAME__' => __("User name", 'newsplus'),
			'__CURRENT_DATA__' => __("Current data", 'newsplus'),
			'__POSTS_CYCLE_START__' => __("Start of post cycle", 'newsplus'),
			'__POSTS_CYCLE_END__' => __("End of post cycle", 'newsplus'),
			'__POST_TITLE__' => __("Post Title", 'newsplus'),
			'__POST_CONTENT__' => __("Post content", 'newsplus'),			
			'__POST_EXCERPT__' => __("Post excerpt", 'newsplus'),
			'__POST_PERMALINK__' => __("Post permalink", 'newsplus'),
		);
	}

	public function manage_edit_post_columns($cat_columns) {
		$cat_columns['mail_subscriber_posts'] = __('Newsplus', 'newsplus');
		return $cat_columns;
	}

	public function manage_posts_custom_column($column_name, $term_id) {
		global $post;
		if ($column_name == 'mail_subscriber_posts') {
			//I clicked this button and through ajax -> add_post_to_send_heap() -> $wpdb I set it in heap in table mail_subscriber_posts_heap
			?>
			<a data-post-id="<?php echo $post->ID ?>" data-post-title="<?php echo mysql_real_escape_string(get_the_title($post->ID)) ?>" href="javascript:void(0);" class="<?php if (in_array($post->ID, self::$posts_in_heap)): ?>button-primary<?php else: ?>button<?php endif; ?> add_post_to_send_heap">
				<?php
				if (in_array($post->ID, self::$posts_in_heap)) {
					_e('Remove from heap', 'newsplus');
				} else {
					_e('Add to heap', 'newsplus');
				}
				?>
			</a>
			<?php
		}
	}

	public function admin_footer() {
		global $pagenow;

		if ($pagenow == 'edit.php') {
			if (empty($_GET) OR (isset($_GET['post_type']) AND $_GET['post_type'] == 'post')) {
				wp_enqueue_script('tm_mail_subscriber_heap', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/heap.js', array('jquery', 'jquery-ui-sortable'));
				?>
				<script type="text/javascript">
					jQuery(function() {
						jQuery('#screen-meta-links').append('<div class="hide-if-no-js screen-meta-toggle" id="mail-subscriber-options-link-wrap" style=""><a aria-expanded="false" aria-controls="screen-options-wrap" class="show-settings" id="mail-subscriber-settings-link" href="#mail-subscriber-options-wrap">Newsplus</a></div>');
						var mail_subscriber_options_wrap = jQuery('#mail_subscriber_options').html();
						jQuery('#mail_subscriber_options').remove();
						jQuery('#screen-meta').append(mail_subscriber_options_wrap);
					});

				</script>
				<?php
				$this->draw_prepared_posts_content();
			}
		}
	}

	/*
	 *
	 */

	public function draw_prepared_posts_content() {
		$data = array();
		echo $this->draw_html('admin/prepared_posts_content', $data);
	}

	public function get_posts_in_heap() {
		global $wpdb;
		$res = $wpdb->get_results('SELECT post_id FROM `mail_subscriber_posts_heap` WHERE is_ready=1', ARRAY_A);
		$posts_in_heap = array();
		if (!empty($res)) {
			foreach ($res as $value) {
				$posts_in_heap[] = $value['post_id'];
			}
		}

		return $posts_in_heap;
	}

	//ajax
	public function add_post_to_send_heap() {
		$post_id = intval($_REQUEST['post_id']);
		if ($post_id == 0) {
			exit;
		}
		$post = get_post($post_id);
		//***
		global $wpdb;
		//check is post already in heap
		$res = $wpdb->get_results('SELECT * FROM `mail_subscriber_posts_heap` WHERE post_id=' . $post_id . ' AND is_ready=1', ARRAY_A);
		if (!empty($res)) {
			printf(__('Post "%s" already in heap', 'newsplus'), $post->post_title);
			exit;
		}

		$res = $wpdb->get_results('SELECT * FROM `mail_subscriber_posts_heap` WHERE post_id=' . $post_id . ' AND is_ready=0', ARRAY_A);
		if (!empty($res)) {
			$wpdb->query("UPDATE `mail_subscriber_posts_heap` SET is_ready = 1 WHERE post_id = " . $post_id);
		} else {
			$wpdb->query('INSERT INTO `mail_subscriber_posts_heap` (`post_id`,`is_ready`,`date_add`,`date_last_send`,`times_send`) VALUES(' . $post_id . ',1,' . time() . ',0,0)');
		}
		//***
		printf(__('Post "%s" added in heap', 'newsplus'), $post->post_title);
		exit;
	}

	//ajax
	public function remove_post_from_send_heap() {
		$post_id = intval($_REQUEST['post_id']);
		if ($post_id == 0) {
			exit;
		}
		$post = get_post($post_id);
		//***
		global $wpdb;
		$res = $wpdb->get_results('SELECT * FROM `mail_subscriber_posts_heap` WHERE post_id=' . $post_id, ARRAY_A);
		if (!empty($res)) {
			$wpdb->query("UPDATE `mail_subscriber_posts_heap` SET is_ready = 0 WHERE post_id = " . $post_id);
		} else {
			$wpdb->query('INSERT INTO `mail_subscriber_posts_heap` (`post_id`,`is_ready`,`date_add`,`date_last_send`,`times_send`) VALUES(' . $post_id . ',0,' . time() . ',0,0)');
		}
		//***
		printf(__('Post "%s" removed from heap', 'newsplus'), $post->post_title);
		exit;
	}

	//ajax
	public function clean_heap() {
		global $wpdb;
		$wpdb->query("UPDATE `mail_subscriber_posts_heap` SET is_ready = 0");
		exit;
	}

	//ajax return users_ids who subscribed for categories of posts in heap
	public function mail_posts_heap() {
		global $wpdb;
		$res = $wpdb->get_results('SELECT ID FROM ' . $wpdb->users, ARRAY_A);
		$users = array();
		if (!empty($res)) {
			foreach ($res as $value) {
				$users[] = $value['ID'];
			}
		}
		//***
		$data = array();
		if (!empty($users)) {
			foreach ($users as $user_id) {
				$res = get_user_meta($user_id, 'tm_mail_subscriber_user_postcat');
				if (!empty($res[0])) {
					$data[$user_id] = $res[0];
				}
			}
		}

		echo json_encode($data);
		exit;
	}

	//ajax
	public function send_post_one_letter() {
		$user_id = intval($_REQUEST['user_id']);
		$tpl_id = intval($_REQUEST['tpl_id']);
		$categories = $_REQUEST['categories'];
		$posts_in_heap = $this->get_posts_in_heap();
		//*** filter $posts_in_heap by $categories, if empty send no letter
		$posts_to_letter = array();
		if (!empty($posts_in_heap)) {
			foreach ($posts_in_heap as $post_id) {
				$post_categories = wp_get_post_categories($post_id, array('fields' => 'ids'));
				if (array_intersect($categories, $post_categories)) {
					$posts_to_letter[] = $post_id;
				}
			}
		}
		//***
		//order posts by id as their order in admin panel
		$tmp = array();
		foreach ($_REQUEST['posts_in_order'] as $post_id) {
			if (in_array($post_id, $posts_to_letter)) {
				$tmp[] = $post_id;
			}
		}
		$posts_to_letter = $tmp;
		//***
		if (!empty($posts_to_letter)) {
			$settings = TmMS_Settings::get_settings();
			//***
			$user = get_userdata($user_id);
			$email = $user->user_email;
			$subject = $settings['default_email_subject'];
			//***
			$posts = array();
			foreach ($posts_to_letter as $post_id) {
				$posts[] = get_post($post_id);
			}

			//***

			$data = array(
				'user_name' => $user->user_nicename,
				'posts' => $posts
			);

			//replacing snippets by values
			$content = get_post_field('post_content', $tpl_id);
			$content = str_replace('<p>__POSTS_CYCLE_START__</p>', '__POSTS_CYCLE_START__', $content);
			$content = str_replace('<p>__POSTS_CYCLE_END__</p>', '__POSTS_CYCLE_END__', $content);

			$content = str_replace('__POSTS_CYCLE_START__', '<?php foreach ($posts as $post) : ?>', $content);
			$content = str_replace('__POSTS_CYCLE_END__', '<?php endforeach; ?>', $content);
			$content = str_replace('__POST_TITLE__', '<?php echo get_the_title($post->ID); ?>', $content);
			$content = str_replace('__POST_CONTENT__', '<?php echo str_replace(\']]>\', \']]&gt;\', apply_filters(\'the_content\', $post->post_content)); ?>', $content);
			$content = str_replace('__POST_PERMALINK__', '<?php echo get_permalink($post->ID); ?>', $content);
			$content = str_replace('__POST_EXCERPT__', '<?php echo $post->post_excerpt; ?>', $content);
			$content = str_replace('__USER_NAME__', '<?php echo $user_name; ?>', $content);
			$content = str_replace('__CURRENT_DATA__', '<?php echo date("d-m-Y"); ?>', $content);
			//***
			$buffer_path = THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'views/buffer.php';
			file_put_contents($buffer_path, $content);
			$content = $this->draw_html('buffer', $data);
			//***
			self::send_email($email, $content, $subject);
		}
		exit;
	}

}
