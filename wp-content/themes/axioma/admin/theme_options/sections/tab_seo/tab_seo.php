<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	'block1' => array(
		'title' => __('Home page', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'meta_title_home' => array(
				'title' => __('Meta title', 'axioma'),
				'type' => 'text',
				'default_value' => '',
				'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'axioma'),
				'custom_html' => ''
			),
			'meta_keywords_home' => array(
				'title' => __('Meta keywords', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Keywords - up to 250 characters', 'axioma'),
				'custom_html' => ''
			),
			'meta_description_home' => array(
				'title' => __('Meta description', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Description - about 150-200 characters', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('Posts listing/Blog page', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'meta_title_post_listing' => array(
				'title' => __('Meta title', 'axioma'),
				'type' => 'text',
				'default_value' => '',
				'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'axioma'),
				'custom_html' => ''
			),
			'meta_keywords_post_listing' => array(
				'title' => __('Meta keywords', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Keywords - up to 250 characters', 'axioma'),
				'custom_html' => ''
			),
			'meta_description_post_listing' => array(
				'title' => __('Meta description', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Description - about 150-200 characters', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block3' => array(
		'title' => __('Portfolio listing', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'meta_title_portfolio_listing' => array(
				'title' => __('Meta title', 'axioma'),
				'type' => 'text',
				'default_value' => '',
				'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'axioma'),
				'custom_html' => ''
			),
			'meta_keywords_portfolio_listing' => array(
				'title' => __('Meta keywords', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Keywords - up to 250 characters', 'axioma'),
				'custom_html' => ''
			),
			'meta_description_portfolio_listing' => array(
				'title' => __('Meta description', 'axioma'),
				'type' => 'textarea',
				'default_value' => '',
				'description' => __('Description - about 150-200 characters', 'axioma'),
				'custom_html' => ''
			),
		)
	),
		/*
		  'block4' => array(
		  'title' => __('Gallery listing', 'axioma'),
		  'type' => 'items_block',
		  'items' => array(
		  'meta_title_gallery_listing' => array(
		  'title' => __('Meta title', 'axioma'),
		  'type' => 'text',
		  'default_value' => '',
		  'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'axioma'),
		  'custom_html' => ''
		  ),
		  'meta_keywords_gallery_listing' => array(
		  'title' => __('Meta keywords', 'axioma'),
		  'type' => 'textarea',
		  'default_value' => '',
		  'description' => __('Keywords - up to 250 characters', 'axioma'),
		  'custom_html' => ''
		  ),
		  'meta_description_gallery_listing' => array(
		  'title' => __('Meta description', 'axioma'),
		  'type' => 'textarea',
		  'default_value' => '',
		  'description' => __('Description - about 150-200 characters', 'axioma'),
		  'custom_html' => ''
		  ),
		  )
		  ),
		 */
);

$seo_groups = TMM::get_option('seo_groups');
if (is_string($seo_groups) AND !empty($seo_groups)) {
	$seo_groups = unserialize($seo_groups);
}
//***
$child_sections['seo_groups_tab'] = array(
	'name' => __('SEO Groups', 'axioma'),
	'sections' => array(
		'seo_groups' => array(
			'title' => '',
			'type' => 'custom',
			'default_value' => '',
			'description' => '',
			'custom_html' => TMM::draw_free_page($pagepath . 'seo_groups.php', array('seo_groups' => $seo_groups, 'custom_html_pagepath' => $pagepath))
		)
	)
);


$sections = array(
	'name' => __("SEO Tools", 'axioma'),
	'css_class' => 'shortcut-seo',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

