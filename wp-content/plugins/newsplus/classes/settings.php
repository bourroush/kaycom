<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_Settings extends TmMS {

	public function __construct() {
		add_action('wp_ajax_mail_subscriber_save_settings', array(&$this, 'save_settings'));
	}

	//ajax
	public function save_settings() {
		$data = array();
		parse_str($_REQUEST['values'], $data);
		$data = self::db_quotes_shield($data);
		update_option('tm_mail_subscriber_settings', $data);
		exit;
	}

	public static function get_settings() {
		$settings = get_option('tm_mail_subscriber_settings');
		//***
		if (!isset($settings['letters_per_minute'])) {
			$settings['letters_per_minute'] = 50;
		}
		return $settings;
	}

	public static function get_setting($option) {
		$settings = self::get_settings();
		return $settings[$option];
	}

	public function draw_settings_page() {
		wp_enqueue_style("thememakers_mail_subscriber_total_css", THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/settings.css');
		wp_enqueue_script('thememakers_mail_subscriber_options_js', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'js/admin/settings.js', array('jquery'));
		wp_enqueue_script('thememakers_mail_subscriber_selectivizr_js', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'js/admin/selectivizr-and-extra-selectors.min.js');
		echo $this->draw_html('admin/settings_page', self::get_settings());
	}
	
	private static function db_quotes_shield($data) {
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