<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//*************************************

$content = array(
	'skin_composer' => array(
		'title' => __('Skin Composer', 'axioma'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'skin_composer.php')
	),
	'block0' => array(
		'title' => __('Elements', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'general_elements' => array(
				'title' => __('Website Elements Color', 'axioma'),
				'type' => 'color',
				'default_value' => '#5ac1ca',
				'description' => __('General website elements color(Such elements like icons, some backgrounds etc.). Do not edit this field to use default theme styling.
									Notice: All the styles below may override this color if necessary. ', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),

		)
	),
	'block1' => array(
		'title' => __('Text', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'general_font_family' => array(
				'title' => __('Website Font Family', 'axioma'),
				'type' => 'google_font_select',
				'default_value' => 'Arial',
				'description' => '',
				'custom_html' => '',
				'is_reset' => true
			),
			'general_font_size' => array(
				'title' => __('Website Font Size', 'axioma'),
				'type' => 'slider',
				'default_value' => 14,
				'min' => 12,
				'max' => 18,
				'description' => __('General website font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_text_color' => array(
				'title' => __('Website Text Color', 'axioma'),
				'type' => 'color',
				'default_value' => '#777777',
				'description' => __('General website text color. Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_normal_links_color' => array(
				'title' => __('Website Normal Links Color', 'axioma'),
				'type' => 'color',
				'default_value' => '#777777',
				'description' => __('General website mouseover links color. Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),
		)
	),
	'block2' => array(
		'title' => __('Backgrounds', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'general_header_bg_color' => array(
				'title' => __('Website Header Background', 'axioma'),
				'type' => 'color',
				'default_value' => '#ffffff',
				'description' => __('General website header background color (The top area where is logo located). Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_footer_bg_color' => array(
				'title' => __('Website Footer Background', 'axioma'),
				'type' => 'color',
				'default_value' => '#373738',
				'description' => __('General website footer background color (The bottom area where is copyright info located). Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => '',
				'is_reset' => true
			),
			'body_pattern_selected' => array(
				'title' => __('Website Background', 'axioma'),
				'type' => 'select',
				'css_class' => 'showhide',
				'default_value' => 0,
				'values' => array(
					0 => __('Background Color', 'axioma'),
					1 => __('Custom Background Image', 'axioma'),
					2 => __('Patterns', 'axioma'),
				),
				'description' => __('General website background. Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => TMM::draw_free_page($pagepath . 'body_pattern_selected.php'),
				'is_reset' => true
			),
		)
	),
	'custom_css' => array(
		'title' => __('Custom CSS Styles', 'axioma'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => '',
		'custom_html' => ''
	),
);
//*************************************

$child_sections['styling_headings'] = array(
	'name' => __('Headings', 'axioma'),
	'sections' => array(
		'block1' => array(
			'title' => __('H1 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h1_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 48,
					'min' => 35,
					'max' => 48,
					'description' => __('H1 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H1 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('H2 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h2_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 27,
					'min' => 25,
					'max' => 36,
					'description' => __('H2 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H2 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('H3 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h3_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 22,
					'min' => 18,
					'max' => 28,
					'description' => __('H3 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H3 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block4' => array(
			'title' => __('H4 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h4_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 20,
					'min' => 16,
					'max' => 26,
					'description' => __('H4 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H4 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block5' => array(
			'title' => __('H5 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h5_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 16,
					'min' => 14,
					'max' => 24,
					'description' => __('H5 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H5 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block6' => array(
			'title' => __('H6 Heading', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'h6_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 14,
					'min' => 12,
					'max' => 20,
					'description' => __('H6 heading font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_font_color' => array(
					'title' => __('Font Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('H6 heading cont color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_normal_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_mouseover_link_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);
//*************************************
$child_sections['styling_main_navigation'] = array(
	'name' => __('Main Navigation', 'axioma'),
	'sections' => array(
		'block1' => array(
			'title' => __('General', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_font' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Open Sans',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_first_level_font_size' => array(
					'title' => __('First Level\'s Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 14,
					'min' => 12,
					'max' => 16,
					'description' => __('Main navigation first level\'s font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_second_level_font_size' => array(
					'title' => __('Second Level\'s Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 12,
					'min' => 11,
					'max' => 15,
					'description' => __('Main navigation seconds level\'s font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Links Color (First level)', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_def_text_color' => array(
					'title' => __('Normal', 'axioma'),
					'type' => 'color',
					'default_value' => '#000000',
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_curr_text_color' => array(
					'title' => __('Current', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_hover_text_color' => array(
					'title' => __('Mouseover', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_border_color' => array(
					'title' => __('Border Bottom Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#eaeaea',
					'description' => __('Border color of the lower. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_border_color_sub_menu' => array(
					'title' => __('Border Top Color for Sub Menu', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('Border top color for sub menu. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('Links Color (Second level)', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_dd_def_text_color' => array(
					'title' => __('Normal', 'axioma'),
					'type' => 'color',
					'default_value' => '#818181',
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_dd_curr_text_color' => array(
					'title' => __('Current Top Color for Sub Menu', 'axioma'),
					'type' => 'color',
					'default_value' => '#000000',
					'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_dd_hover_text_color' => array(
					'title' => __('Mouseover', 'axioma'),
					'type' => 'color',
					'default_value' => '#000000',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block4' => array(
			'title' => __('Current Background Color for Touch Devices', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_dd_def_item_bg' => array(
					'title' => __('Normal', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);
//*************************************
$child_sections['styling_content'] = array(
	'name' => __('Content', 'axioma'),
	'sections' => array(
		'block1' => array(
			'title' => __('Links Color Options', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'content_normal_link_color' => array(
					'title' => __('Normal', 'axioma'),
					'type' => 'color',
					'default_value' => '#000000',
					'description' => __('A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'content_mouseover_link_color' => array(
					'title' => __('Mouse Over', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		)
	)
);
//*************************************
$child_sections['styling_buttons'] = array(
	'name' => __('Buttons', 'axioma'),
	'sections' => array(
		'block1' => array(
			'title' => __('General Styles', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'buttons_font_family' => array(
					'title' => __('Font Family', 'axioma'),
					'type' => 'google_font_select',
					'default_value' => 'Arial',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_font_size' => array(
					'title' => __('Font Size', 'axioma'),
					'type' => 'slider',
					'default_value' => 14,
					'min' => 12,
					'max' => 16,
					'description' => __('General buttons font size in pixels. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Normal Color Styles', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'buttons_text_color' => array(
					'title' => __('Text', 'axioma'),
					'type' => 'color',
					'default_value' => '#ffffff',
					'description' => __('A normal, visited and unvisited default button\'s text color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_bg_color' => array(
					'title' => __('Background', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A normal, visited and unvisited default button\'s background color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('Mouseover Color Styles', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'buttons_hover_text_color' => array(
					'title' => __('Text', 'axioma'),
					'type' => 'color',
					'default_value' => '#ffffff',
					'description' => __('Default button\'s text color when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_hover_bg_color' => array(
					'title' => __('Background', 'axioma'),
					'type' => 'color',
					'default_value' => '#0e0e0e',
					'description' => __('Default button\'s background color when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);
//*************************************
$child_sections['styling_widgets'] = array(
	'name' => __('Widgets', 'axioma'),
	'sections' => array(
		'block1' => array(
			'title' => __('Normal Color Styles', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'widget_title_color' => array(
					'title' => __('Title Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('Widget\'s title text color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'widget_text_color' => array(
					'title' => __('Text Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#777777',
					'description' => __('Widget text color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'widget_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Footer Widgets', 'axioma'),
			'type' => 'items_block',
			'items' => array(
				'footer_widget_title_color' => array(
					'title' => __('Title Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#f7f7f7',
					'description' => __('Footer widget\'s title text color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'footer_widget_text_color' => array(
					'title' => __('Text Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#909090',
					'description' => __('Footer widget text color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'footer_widget_link_color' => array(
					'title' => __('Normal Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
				'footer_widget_link_hover_color' => array(
					'title' => __('Mouseover Link Color', 'axioma'),
					'type' => 'color',
					'default_value' => '#5ac1ca',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'axioma'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);

//*************************************
//*************************************
$sections = array(
	'name' => __('Styling', 'axioma'),
	'css_class' => 'shortcut-styling',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;


