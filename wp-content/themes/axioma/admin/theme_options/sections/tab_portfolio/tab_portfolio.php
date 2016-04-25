<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************

$folio_archive_per_page = array();
for ($i = 3; $i <= 21; $i++) {
	$folio_archive_per_page[$i] = $i;
}

//***

$content = array(
	'block1' => array(
		'title' => __('2 Columns layout', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'folio_col2_listing_symbols' => array(
				'title' => __('Excerpt Symbols Count', 'axioma'),
				'type' => 'slider',
				'default_value' => 300,
				'min' => 10,
				'max' => 700,
				'description' => __('This option will excerpt full article content with a necessary amount of symbols on the portfolio listing page.', 'axioma'),
				'custom_html' => ''
			),
			'folio_disable_icons_2col' => array(
				'title' => __('Disable Icons', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => __('Disable Icons', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('3 Columns layout', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'folio_col3_listing_symbols' => array(
				'title' => __('Excerpt Symbols Count', 'axioma'),
				'type' => 'slider',
				'default_value' => 180,
				'min' => 10,
				'max' => 700,
				'description' => __('This option will excerpt full article content with a necessary amount of symbols on the portfolio listing page.', 'axioma'),
				'custom_html' => ''
			),
			'folio_disable_icons_3col' => array(
				'title' => __('Disable Icons', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => __('Disable Icons', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block3' => array(
		'title' => __('4 Columns layout', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'folio_col4_listing_symbols' => array(
				'title' => __('Excerpt Symbols Count', 'axioma'),
				'type' => 'slider',
				'default_value' => 90,
				'min' => 10,
				'max' => 700,
				'description' => __('This option will excerpt full article content with a necessary amount of symbols on the portfolio listing page.', 'axioma'),
				'custom_html' => ''
			),
			'folio_disable_icons_4col' => array(
				'title' => __('Disable Icons', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => __('Disable Icons', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block4' => array(
		'title' => __('Archive Page Layout', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'folio_archive_layout' => array(
				'title' => __('Default Layout', 'axioma'),
				'type' => 'select',
				'default_value' => 3,
				'values' => array(
					2 => __('2 Columns', 'axioma'),
					3 => __('3 Columns', 'axioma'),
					4 => __('4 Columns', 'axioma'),
				),
				'description' => __('Archive Page layout for Portfolio. I.e. skills, clients listing pages.', 'axioma'),
				'custom_html' => ''
			),
			'folio_archive_per_page' => array(
				'title' => __('Items per page', 'axioma'),
				'type' => 'select',
				'default_value' => 9,
				'values' => $folio_archive_per_page,
				'description' => __('Please type here an amount of items to be displayed per portfolio page.', 'axioma'),
				'custom_html' => ''
			),
			'folio_archive_sidebar' => array(
				'title' => __('Archive Page Sidebar', 'axioma'),
				'type' => 'select',
				'default_value' => 'no_sidebar',
				'values' => array(
					'no_sidebar' => __('No sidebar', 'axioma'),
					'sbl' => __('Left', 'axioma'),
					'sbr' => __('Rigth', 'axioma'),
				),
				'description' => __('Archive Page sidebar position for Portfolio', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block5' => array(
		'title' => __('Single Page Layout', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'folio_show_related_works' => array(
				'title' => __('Show Related Works on single page', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show Related Works on single page', 'axioma'),
				'custom_html' => ''
			),
			'single_folio_hide_clients' => array(
				'title' => __('Hide Single Folio Clients', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_skills' => array(
				'title' => __('Hide Single Folio Skills', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_metadata' => array(
				'title' => __('Hide Single Folio Metadata', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
		)
	),
);




//*************************************
//*************************************
$sections = array(
	'name' => __('Portfolio', 'axioma'),
	'css_class' => 'shortcut-portfolio',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

