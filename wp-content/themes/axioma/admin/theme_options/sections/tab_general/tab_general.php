<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	'favicon_img' => array(
		'title' => __('Website Favicon', 'axioma'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/favicon.ico',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 16x16. Recommended image types: png, ico.', 'axioma'),
		'custom_html' => TMM::draw_free_page($pagepath . 'favicon_img.php')
	),
	'logo' => array(
		'title' => __('Website Logo', 'axioma'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'logo.php')
	),
	'sidebar_position' => array(
		'title' => __('Default Sidebar position', 'axioma'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'sidebar_position.php')
	),
	'hide_breadcrumb' => array(
		'title' => __('Disable Breadcrumbs', 'axioma'),
		'type' => 'checkbox',
		'default_value' => 1,
		'description' => __('If checked, the breadcrumbs area will be disabled for all the website.', 'axioma'),
		'custom_html' => ''
	),
	'use_wptexturize' => array(
		'title' => __('Use wptexturize', 'axioma'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => '',
		'custom_html' => ''
	),
	'fixed_menu' => array(
		'title' => __('Use fixed menu', 'axioma'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => '',
		'custom_html' => ''
	),
	'tracking_code' => array(
		'title' => __('Tracking Code', 'axioma'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => __('Place here your Google Analytics (or other) tracking code. It will be inserted before closing body tag in your theme.', 'axioma'),
		'custom_html' => ''
	)
);






$sections = array(
	'name' => __("General", 'axioma'),
	'css_class' => 'shortcut-options',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

