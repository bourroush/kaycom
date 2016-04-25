<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_Template extends TmMS {

	public static $template_link = null;
	public static $template_path = null;

	public function __construct() {
		self::$template_link = THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/templates/';
		self::$template_path = THEMEMAKERS_MAIL_SUBSCRIBER_PATH . '/templates/';
		//AJAX
		//add_action('wp_ajax_mail_subscriber_get_letter_recepients', array(&$this, 'get_letter_recepients'));
	}

	public function get_mail_templates() {
		$directories = glob(self::$template_path . '/*', GLOB_ONLYDIR);
		$result = array();
		if (!empty($directories)) {
			foreach ($directories as $dir) {
				$dir = explode('/', $dir);
				$ini_data = parse_ini_file(THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'templates/' . $dir[count($dir) - 1] . '/values.ini');
				$result[$dir[count($dir) - 1]] = $ini_data['name'];
			}
		}
		return $result;
	}

	public function draw_templates_page() {
		$data = array();
		$data['templates'] = $this->get_mail_templates();
		echo $this->draw_html('admin/templates_page', $data);
	}

}
