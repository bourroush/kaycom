<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS {

	public function draw_html($view, $data = array()) {
		$pagepath = THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'views/' . $view . '.php';
		@extract($data);
		ob_start();
		include($pagepath);
		return ob_get_clean();
	}

	protected static function send_email($email, $content, $subject) {	
		$attachments = array();
		$settings = TmMS_Settings::get_settings();
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: ' . (!empty($settings['name_from']) ? $settings['name_from'] : get_option("blogname")) . ' <' . $subject . '>' . "\r\n";
		add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
		return wp_mail($email, $subject, $content, $headers, $attachments);
	}

}