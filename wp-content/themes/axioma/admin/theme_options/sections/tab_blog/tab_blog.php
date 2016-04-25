<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************

$content = array(
	'block1' => array(
		'title' => __('Listing Page', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'blog_listing_template' => array(
				'title' => __('Listing Page Template', 'axioma'),
				'type' => 'select',
				'default_value' => 0,
				'values' => array(
					0 => __('Default Listing Page Template', 'axioma'),
					1 => __('Alternate Listing Page Template', 'axioma'),
				),
				'description' => __('General view of your Blog/News listing page. Do not edit this field to use default theme styling.', 'axioma'),
				'custom_html' => ''
			),
			'excerpt_symbols_count' => array(
				'title' => __('Excerpt Symbols Count', 'axioma'),
				'type' => 'slider',
				'default_value' => 220,
				'min' => 10,
				'max' => 900,
				'description' => __('This option will excerpt full article content with a necessary amount of symbols on the blog listing page.', 'axioma'),
				'custom_html' => ''
			),
			'blog_listing_show_all_metadata' => array(
				'title' => __('Show/Hide All Meta Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, all the meta info will disappear under article title such as date, author, tags etc. This option will owerride the next separate four options.', 'axioma'),
				'custom_html' => ''
			),
			'blog_listing_show_date' => array(
				'title' => __('Show/Hide Date Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the date info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_listing_show_author' => array(
				'title' => __('Show/Hide Author Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the author info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_listing_show_tags' => array(
				'title' => __('Show/Hide Tags Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the tags info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_listing_show_category' => array(
				'title' => __('Show/Hide Category Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the category info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('Single Page', 'axioma'),
		'type' => 'items_block',
		'items' => array(
			'blog_single_show_bio' => array(
				'title' => __('Show/Hide Author Bio', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, author\'s bio box will appear at the end of each article.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_comments' => array(
				'title' => __('Show/Hide Comments', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, all the visitors will be allowed to post their comments to articles.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_fb_comments' => array(
				'title' => __('Show/Hide Facebook Comments', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => __('If checked, all the visitors will be allowed to post their comments to articles with faceebok.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_all_metadata' => array(
				'title' => __('Show/Hide All Meta Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, all the meta info will disappear under article title such as date, author, tags etc. This option will owerride the next separate four options.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_date' => array(
				'title' => __('Show/Hide Date Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the date info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_author' => array(
				'title' => __('Show/Hide Author Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the author info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_tags' => array(
				'title' => __('Show/Hide Tags Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the tags info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
			'blog_single_show_category' => array(
				'title' => __('Show/Hide Category Info', 'axioma'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('If checked, the category info will appear under article title.', 'axioma'),
				'custom_html' => ''
			),
		)
	),
);




//*************************************
//*************************************
$sections = array(
	'name' => __('Blog/News', 'axioma'),
	'css_class' => 'shortcut-blog',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

