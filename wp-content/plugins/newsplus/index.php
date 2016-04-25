<?php
/*
  Plugin Name: NewsPlus WP NewsLetter Plugin
  Plugin URI: http://codecanyon.net/user/ThemeMakers/portfolio
  Description: Great mail and news subscription service, which always keeps your users informed about latest news and events. It is easy in use, nice looking in design and functional in work. Everything is ready for work – no more long settings, go ahead and keep up your subscribers with newest tidings ever!
  Author: ThemeMakers
  Version: 1.0.2
  Author URI: http://codecanyon.net/user/ThemeMakers
 */


//25-09-2013
define("THEMEMAKERS_MAIL_SUBSCRIBER_PATH", plugin_dir_path(__FILE__));
define("THEMEMAKERS_MAIL_SUBSCRIBER_LINK", plugin_dir_url(__FILE__));

//***

include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/core.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/template.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/settings.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/statistic.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/user.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/post_types/post_types.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/post_types/mail_subscriber.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/post_types/mail_subscriber_template.php';
include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'classes/heap.php';

//***

class TmMS_Controller extends TmMS {

	public $template = NULL;
	private $user = NULL;
	public $settings = NULL;
	public $statistic = NULL;
	private $pt_mail_subscriber = NULL;
	private $pt_mail_subscriber_tpl = NULL;
	private $heap = NULL;

	//***

	public function init() {
		//check is user superadmin
		if (!current_user_can('remove_users')) {
			//return;
		}
		if (isset($_GET['page'])) {
			if ($_GET['page'] == 'tm_mail_subscriber_posts_templates') {
				wp_redirect(site_url('wp-admin/edit.php?post_type=ms_tpls'));
			}
		}
		//***
		load_plugin_textdomain('newsplus', false, THEMEMAKERS_MAIL_SUBSCRIBER_PATH . '/languages');
		//AJAX
		add_action('wp_ajax_mail_subscriber_send_one_letter', array(&$this, 'send_one_letter'));
		//***
		add_action('wp_head', array(&$this, 'wp_head'),1);
		add_action('admin_head', array(&$this, 'admin_head'));
		add_action('admin_menu', array(&$this, 'admin_menu'));
		add_action('widgets_init', array(&$this, 'widgets_init'), 90);
		//***
		$this->template = new TmMS_Template();
		$this->user = new TmMS_User();
		$this->settings = new TmMS_Settings();
		$this->statistic = new TmMS_Statistic();
		$this->pt_mail_subscriber_tpl = new TmMS_PT_MailSubscriberTemplate();
		$this->pt_mail_subscriber = new TmMS_PT_MailSubscriber();

		$this->heap = new TmMS_Heap();

		//***
		add_shortcode('newsplus_user_cabinet', array(&$this->user, 'draw_user_cabinet'));

		//***

		if (isset($_GET['ms_action'])) {
			do_action($_GET['ms_action']);
		}

		//*** remove Post Templates from menu order
		add_filter('custom_menu_order', create_function('', 'return true;'));
		add_filter('menu_order', array(&$this, 'remove_menu_items'));
	}

	function remove_menu_items($menu_order) {
		global $menu;

		foreach ($menu as $mkey => $m) {
			$key = array_search('edit.php?post_type=ms_tpls', $m);

			if ($key)
				unset($menu[$mkey]);
		}

		return $menu_order;
	}

	public static function install() {
		$sql = file_get_contents(THEMEMAKERS_MAIL_SUBSCRIBER_PATH . '/install/sql.sql');
		$sql = explode('# __TMM_MAIL_SUBSCRIBER2__', $sql);
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		foreach ($sql as $query) {
			dbDelta($query);
		}
	}

	public function widgets_init() {
		include_once THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'widgets.php';
		register_widget('ThemeMakers_Mail_Subscriber_Newsletters_Widget');
	}

	public function wp_head() {
		wp_enqueue_style('tm_mail_subscriber_styles', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/front/styles.css');
		?>
		<script type="text/javascript">
			var mail_subscriber_lang4 = "<?php _e("Please type your name", 'newsplus') ?>";
			var mail_subscriber_lang5 = "<?php _e("Please type your email", 'newsplus') ?>";
		</script>
		<?php
	}

	public function admin_head() {
		if (function_exists('wp_add_dashboard_widget') AND current_user_can('activate_plugins')) {
			wp_add_dashboard_widget('mail_subscriber_dashboard_widget', __('Newsplus Statistic', 'newsplus'), array(&$this->statistic, 'dashboard_widget'));
		}
		//***
		wp_enqueue_script('tm_mail_subscriber_options', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/options.js');
		wp_enqueue_style('tm_mail_subscriber_styles', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/styles.css');
		?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			var ms_plugin_url ="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>";
			var letters_per_minute =<?php echo TmMS_Settings::get_setting('letters_per_minute'); ?>;
			//***
			var mail_subscriber_lang_paused_warning = "<?php _e("Paused. Please do not reload browser page untill letters/messages are sending!", 'newsplus') ?>";
			var mail_subscriber_lang_saved = "<?php _e("Saved", 'newsplus'); ?>";
			var mail_subscriber_lang1 = "<?php _e("Subscriber status has been updated", 'newsplus'); ?>";
			var mail_subscriber_lang2 = "<?php _e("No recipients", 'newsplus'); ?>";
			var mail_subscriber_lang3 = "<?php _e("Loading ...", 'newsplus'); ?>";
			var mail_subscriber_lang4 = "<?php _e("None of users subscribes with groups selected", 'newsplus'); ?>";
			var mail_subscriber_lang5 = "<?php _e("Add to heap", 'newsplus'); ?>";
			var mail_subscriber_lang6 = "<?php _e("Remove from heap", 'newsplus'); ?>";
			var mail_subscriber_lang_remove = "<?php _e("remove", 'newsplus'); ?>";
			var mail_subscriber_lang_sure = "<?php _e("Sure?", 'newsplus'); ?>";
			var mail_subscriber_lang7 = "<?php _e("Posts are sent to users", 'newsplus'); ?>";
			var mail_subscriber_lang8 = "<?php _e("Please create one post template!", 'newsplus'); ?>";
		</script>
		<?php
	}

	public function admin_menu() {
		add_submenu_page("edit.php?post_type=" . $this->pt_mail_subscriber->slug, __("Newsplus settings", 'newsplus'), __("Settings", 'newsplus'), 'remove_users', 'tm_mail_subscriber_settings', array(&$this->settings, 'draw_settings_page'));
		add_submenu_page("edit.php?post_type=" . $this->pt_mail_subscriber->slug, __("Newsplus templates", 'newsplus'), __("Templates", 'newsplus'), 'remove_users', 'tm_mail_subscriber_templates', array(&$this->template, 'draw_templates_page'));
		add_submenu_page("edit.php?post_type=" . $this->pt_mail_subscriber->slug, __("Post templates", 'newsplus'), __("Post templates", 'newsplus'), 'remove_users', 'tm_mail_subscriber_posts_templates', create_function('', ''));
	}

	function admin_notices() {
		$notices = "";

		echo $notices;
	}

	public function send_one_letter() {
		$user_id = (int) $_REQUEST['user_id'];
		$post_id = (int) $_REQUEST['post_id'];

		$settings = TmMS_Settings::get_settings();
		$site_url = site_url();
		//***
		$email = "";
		if ($user_id != 0) {
			$email = get_user_option('user_email', $user_id);
		} else {
			$email = $_REQUEST['email'];
		}

		//***

		$content = $this->db_quotes_shield(array('content' => $_REQUEST['content']));
		$content = $content['content'];
		//change links for stat
		$pattern = '#href=([\'"]?)((?(?<![\'"])[^>\s]+|.+?(?=\1)))\1#si';
		$links_array = array();
		$processed_links_array = array();
		if (preg_match_all($pattern, $content, $links_array)) {

			foreach ($links_array[0] as $link) {
				if (!empty($link) AND $link != '#') {
					//$link = str_replace('"', '', $link);
					//$link = str_replace("'", '', $link);
					$link = str_replace("href=", '', $link);
					//***
					if (!in_array($link, $processed_links_array) AND !empty($link) AND $link != '#') {
						$c = substr_count($link, $site_url);
						if ($c > 0) {
							//$content=preg_replace($pattern, TmMS_Statistic::get_letter_link_url($link, array('user_id' => $user_id, 'mail_id' => $post_id)), $content);
							$content = str_replace($link, TmMS_Statistic::get_letter_link_url($link, array('user_id' => ($user_id > 0 ? $user_id : uniqid()), 'mail_id' => $post_id)) . '"', $content);
							$processed_links_array[] = $link;
						}
					}
					//***
				}
			}
			$content = str_replace('"?', '?', $content);
		}

		//**** add unsubscribe link
		if ($user_id > 0) {
			$content.="<br />";
			$content.='<center>' . __("To stop receiving these emails, you may", 'newsplus') . ": " . "<a href='" . home_url() . "/?p=" . $settings['user_subscribe_page_id'] . "'>" . __('Manage your subscriptions', 'newsplus') . "</a></center>";
		}
		//*************************

		$attachments = array();
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		//$headers .= 'To: <' . $email . '>' . "\r\n";

		$headers .= 'From: ' . (!empty($settings['name_from']) ? $settings['name_from'] : get_option("blogname")) . ' <' . (!empty($settings['senders_mail_address']) ? $settings['senders_mail_address'] : get_option("admin_email")) . '>' . "\r\n";
		add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));

		$result_data = array();
		$result_data['error'] = "";
		$subject = get_post_meta($post_id, 'email_subject', true);
		if (!wp_mail($email, (!empty($subject) ? $subject : $settings['default_email_subject']), $content, $headers, $attachments)) {
			$result_data['error'] = "Email for " . $email . " has not been sent";
		} else {

			$stat_data = array(
				'user_id' => $user_id,
				'mail_id' => $post_id,
				'groups' => implode(',', $_REQUEST['subscribe_groups']),
				'time' => time()
			);

			$this->statistic->update_stat('sent', $stat_data);
			$this->statistic->add_mail_stat_data($post_id, array());
		}
		echo json_encode($result_data);
		exit;
	}

	private function db_quotes_shield($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$data[$key] = self::db_quotes_shield($value);
				} else {
					$value = stripslashes($value);
					$value = str_replace('\"', '"', $value);
					$value = str_replace("\'", "'", $value);
					$data[$key] = $value;
				}
			}
		}

		return $data;
	}

}

$tm_ms_controller = new TmMS_Controller();
add_action('init', array(&$tm_ms_controller, 'init'), 1, 1);
register_activation_hook(__FILE__, array('TmMS_Controller', 'install'));
