<?php
// Global Styles
$logo_font_size = TMM::get_option('logo_font_size');
$logo_font = TMM::get_option('logo_font');
$logo_text_color = TMM::get_option('logo_text_color');
$general_elements = TMM::get_option('general_elements');
$general_font_family = TMM::get_option('general_font_family');
$general_font_size = TMM::get_option('general_font_size');
$general_text_color = TMM::get_option('general_text_color');
$general_normal_links_color = TMM::get_option('general_normal_links_color');
$general_mouseover_links_color = TMM::get_option('general_mouseover_links_color');
$general_header_bg_color = TMM::get_option('general_header_bg_color');
$general_footer_bg_color = TMM::get_option('general_footer_bg_color');

// Headings
$h1_font_family = TMM::get_option('h1_font_family');
$h1_font_size = TMM::get_option('h1_font_size');
$h1_font_color = TMM::get_option('h1_font_color');
$h1_normal_link_color = TMM::get_option('h1_normal_link_color');
$h1_mouseover_link_color = TMM::get_option('h1_mouseover_link_color');

$h2_font_family = TMM::get_option('h2_font_family');
$h2_font_size = TMM::get_option('h2_font_size');
$h2_font_color = TMM::get_option('h2_font_color');
$h2_normal_link_color = TMM::get_option('h2_normal_link_color');
$h2_mouseover_link_color = TMM::get_option('h2_mouseover_link_color');

$h3_font_family = TMM::get_option('h3_font_family');
$h3_font_size = TMM::get_option('h3_font_size');
$h3_font_color = TMM::get_option('h3_font_color');
$h3_normal_link_color = TMM::get_option('h3_normal_link_color');
$h3_mouseover_link_color = TMM::get_option('h3_mouseover_link_color');

$h4_font_family = TMM::get_option('h4_font_family');
$h4_font_size = TMM::get_option('h4_font_size');
$h4_font_color = TMM::get_option('h4_font_color');
$h4_normal_link_color = TMM::get_option('h4_normal_link_color');
$h4_mouseover_link_color = TMM::get_option('h4_mouseover_link_color');

$h5_font_family = TMM::get_option('h5_font_family');
$h5_font_size = TMM::get_option('h5_font_size');
$h5_font_color = TMM::get_option('h5_font_color');
$h5_normal_link_color = TMM::get_option('h5_normal_link_color');
$h5_mouseover_link_color = TMM::get_option('h5_mouseover_link_color');

$h6_font_family = TMM::get_option('h6_font_family');
$h6_font_size = TMM::get_option('h6_font_size');
$h6_font_color = TMM::get_option('h6_font_color');
$h6_normal_link_color = TMM::get_option('h6_normal_link_color');
$h6_mouseover_link_color = TMM::get_option('h6_mouseover_link_color');

// Main Navigation
$main_nav_font = TMM::get_option('main_nav_font');
$main_nav_first_level_font_size = TMM::get_option('main_nav_first_level_font_size');
$main_nav_second_level_font_size = TMM::get_option('main_nav_second_level_font_size');

$main_nav_def_text_color = TMM::get_option('main_nav_def_text_color');
$main_nav_curr_text_color = TMM::get_option('main_nav_curr_text_color');
$main_nav_hover_text_color = TMM::get_option('main_nav_hover_text_color');
$main_nav_border_color = TMM::get_option('main_nav_border_color');
$main_nav_border_color_sub_menu = TMM::get_option('main_nav_border_color_sub_menu');

$main_nav_dd_def_text_color = TMM::get_option('main_nav_dd_def_text_color');
$main_nav_dd_curr_text_color = TMM::get_option('main_nav_dd_curr_text_color');
$main_nav_dd_hover_text_color = TMM::get_option('main_nav_dd_hover_text_color');

$main_nav_dd_def_item_bg = TMM::get_option('main_nav_dd_def_item_bg');

// Content
$content_bg = TMM::get_option('content_bg');
$content_font_family = TMM::get_option('content_font_family');
$content_font_size = TMM::get_option('content_font_size');
$content_text_color = TMM::get_option('content_text_color');
$content_normal_link_color = TMM::get_option('content_normal_link_color');
$content_mouseover_link_color = TMM::get_option('content_mouseover_link_color');

// buttons
$buttons_font_family = TMM::get_option('buttons_font_family');
$buttons_font_size = TMM::get_option('buttons_font_size');
$buttons_text_color = TMM::get_option('buttons_text_color');
$buttons_bg_color = TMM::get_option('buttons_bg_color');
$buttons_hover_text_color = TMM::get_option('buttons_hover_text_color');
$buttons_hover_bg_color = TMM::get_option('buttons_hover_bg_color');

// widgets
$widget_title_color = TMM::get_option('widget_title_color');
$widget_title_first_color = TMM::get_option('widget_title_first_color');
$widget_text_color = TMM::get_option('widget_text_color');
$widget_link_color = TMM::get_option('widget_link_color');

$footer_widget_title_color = TMM::get_option('footer_widget_title_color');
$footer_widget_title_first_color = TMM::get_option('footer_widget_title_first_color');
$footer_widget_text_color = TMM::get_option('footer_widget_text_color');
$footer_widget_link_color = TMM::get_option('footer_widget_link_color');
$footer_widget_link_hover_color = TMM::get_option('footer_widget_link_hover_color');
?>

/***************************** Global Styles ************************************/

body {<?php echo TMM_Helper::draw_body_bg() ?>}

<?php if (!empty($general_font_family) || !empty($general_text_color) || !empty($general_font_size)): ?>
	body {
	font-family: <?php echo $general_font_family ?>, sans-serif;
	font-size: <?php echo $general_font_size ?>px;
	color: <?php echo $general_text_color ?>;
	}
<?php endif; ?>

<?php if (!empty($general_normal_links_color)): ?>
	a {color: <?php echo $general_normal_links_color ?>;}
<?php endif; ?>

<?php if (!empty($general_mouseover_links_color)): ?>
	a:hover {color: <?php echo $general_mouseover_links_color ?>;}
<?php endif; ?>

<?php if (!empty($general_header_bg_color)): ?>
	.header-front {background-color: <?php echo $general_header_bg_color ?>;}
	.header-shrink .header-front {
	background-color: <?php echo $general_header_bg_color; ?>;
	background-color: rgba(<?php echo TMM_Helper::hex2rgb($general_header_bg_color) ?>, 0.95);
	}
<?php endif; ?>

<?php if (!empty($general_footer_bg_color)): ?>
	#footer {background-color: <?php echo $general_footer_bg_color ?>;}
<?php endif; ?>

<?php if (!empty($logo_font) || !empty($logo_text_color) || !empty($logo_font_size)): ?>
	#logo h1 {
	font-family: <?php echo $logo_font ?>, sans-serif;
	color: <?php echo $logo_text_color ?>;
	font-size: <?php echo $logo_font_size ?>px;
	}
<?php endif; ?>

<?php if (!empty($general_elements)): ?>

	/* Color */

	blockquote,
	.simple-pricing-table .features li:before,
	.widget_recent_entries li:hover > a,
	.error-404 .error-big-text-style,
	.project-nav li a:hover:after,
	.simple-pricing-table .title,
	.widget_contacts .vcard em,
	.type-2 .tabs-nav .active a,
	.type-2 .acc-trigger:after,
	.quotes-nav a:hover:after,
	.all-projects:hover span,
	.website-general-color,
	.entry .entry-meta a,
	.title > a:hover,
	i.ca-icon:before,
	.wp-link-pages a:hover,
	.wp-link-pages > span,	
	.post-meta span:before {
	color: <?php echo $general_elements ?>;
	}

	/* Background Color */

	.simple-pricing-table .featured .footer .button,
	.simple-pricing-table.type-1 .featured .header,
	.simple-pricing-table.type-2 .featured .price,
	.widget_archive li:hover,
	.widget_categories li:hover,
	.widget_links li:hover,
	.widget_meta li:hover,
	.widget_pages li:hover,
	.widget_recent_comments li:hover,
	.widget_recent_entries li:hover,
	.widget_product_categories li:hover, 
	.widget_nav_menu li:hover > a,
	.widget_nav_menu .menu .current-menu-item > a,
	.widget_nav_menu .menu .current-menu-parent > a,
	.widget_nav_menu .menu .current-menu-ancestor > a,
	.widget_nav_menu .menu .current_page_item > a,
	.widget_nav_menu .menu .current_page_parent > a,
	.widget_nav_menu .menu .current_page_ancestor > a,
	.responsive-nav-button.active,
	.responsive-nav-button:hover,
	.ajax-nav li.current > a, 
	.ajax-nav li:hover > a,
	.post-slider-nav a:hover,
	.fancybox-nav:hover span,
	.fancybox-close:hover,
	.portfolio-filter a:hover,
	.portfolio-filter .active,
	.widget_product_tag_cloud a:hover,
	.widget_tag_cloud a:hover,
	.widget_calendar #today,
	.form-submit #submit,
	.recent-projects-nav a:hover,
	.single-post-nav a:hover,
	.widget_calendar tfoot a:hover,
	.comment-reply-link,
	.theme-default-bg,
	i[class^="circle-pic"],
	i[class*=" circle-pic"],
	.flickr-badge .curtain,
	.ls-inpage .ls-nav-next:hover,
	.ls-inpage .ls-nav-prev:hover,
	.recent-projects.type-1 .curtain,
	.wp-pagenavi .page-numbers:hover,
	.wp-pagenavi .current,
	.type-1 .tabs-nav .active a,
	.acc-trigger:before,
	.circle-date:hover,
	.masonry_view_more_button,
	.thumb .curtain,
	.page-header,
	#back-top,
	.slider,
	.image-extra,
	.full-link .curtain
	{
	background: <?php echo $general_elements ?>;
	}

	.image-extra {
	background-color: rgba(<?php echo TMM_Helper::hex2rgb($general_elements) ?>, 0.8);
	}

	/* Border Color */

	.newsletter-form input[type="text"]:focus,
	.team-item img
	{
	border-color: <?php echo $general_elements ?>;
	}

	/* Selection */

	::-moz-selection  { background-color: <?php echo $general_elements ?>; }
	::selection	      { background-color: <?php echo $general_elements ?>; }
	.highlight		  { background-color: <?php echo $general_elements ?>; }

<?php endif; ?>

/************************ Headings *****************************/   

<?php if (!empty($h1_font_family) || !empty($h1_font_size) || !empty($h1_font_color) || !empty($h1_normal_link_color) || !empty($h1_mouseover_link_color)): ?>
	h1 {
	font-family:<?php echo $h1_font_family ?>;
	font-size:<?php echo $h1_font_size ?>px;
	color:<?php echo $h1_font_color ?>;
	}
	h1 a {color:<?php echo $h1_normal_link_color ?>;}
	h1 a:hover {color:<?php echo $h1_mouseover_link_color ?>;}
<?php endif; ?>

<?php if (!empty($h2_font_family) || !empty($h2_font_size) || !empty($h2_font_color) || !empty($h2_normal_link_color) || !empty($h2_mouseover_link_color)): ?>
	h2 {
	font-family:<?php echo $h2_font_family ?>;
	font-size:<?php echo $h2_font_size ?>px;
	color:<?php echo $h2_font_color ?>;
	}
	h2 a {color:<?php echo $h2_normal_link_color ?>;}
	h2 a:hover {color:<?php echo $h2_mouseover_link_color ?>;}
<?php endif; ?>

<?php if (!empty($h3_font_family) || !empty($h3_font_size) || !empty($h3_font_color) || !empty($h3_normal_link_color) || !empty($h3_mouseover_link_color)): ?>
	h3 {
	font-family:<?php echo $h3_font_family ?>;
	font-size:<?php echo $h3_font_size ?>px;
	color:<?php echo $h3_font_color ?>;
	}
	h3 a {color:<?php echo $h3_normal_link_color ?>;}
	h3 a:hover {color:<?php echo $h3_mouseover_link_color ?>;}
<?php endif; ?>

<?php if (!empty($h4_font_family) || !empty($h4_font_size) || !empty($h4_font_color) || !empty($h4_normal_link_color) || !empty($h4_mouseover_link_color)): ?>
	h4 {
	font-family:<?php echo $h4_font_family ?>;
	font-size:<?php echo $h4_font_size ?>px;
	color:<?php echo $h4_font_color ?>;
	}
	h4 a {color:<?php echo $h4_normal_link_color ?>;}
	h4 a:hover {color:<?php echo $h4_mouseover_link_color ?>;}
<?php endif; ?>

<?php if (!empty($h5_font_family) || !empty($h5_font_size) || !empty($h5_font_color) || !empty($h5_normal_link_color) || !empty($h5_mouseover_link_color)): ?>
	h5 {
	font-family:<?php echo $h5_font_family ?>;
	font-size:<?php echo $h5_font_size ?>px;
	color:<?php echo $h5_font_color ?>;
	}
	h5 a {color:<?php echo $h5_normal_link_color ?>;}
	h5 a:hover {color:<?php echo $h5_mouseover_link_color ?>;}
<?php endif; ?>

<?php if (!empty($h6_font_family) || !empty($h6_font_size) || !empty($h6_font_color) || !empty($h6_normal_link_color) || !empty($h6_mouseover_link_color)): ?>
	h6 {
	font-family:<?php echo $h6_font_family ?>;
	font-size:<?php echo $h6_font_size ?>px;
	color:<?php echo $h6_font_color ?>;
	}
	h6 a {color:<?php echo $h6_normal_link_color ?>;}
	h6 a:hover {color:<?php echo $h6_mouseover_link_color ?>;}
<?php endif; ?>

/************************* Main Navigation *******************************/

<?php if (!empty($main_nav_font)): ?>

	.navigation a {font-family: <?php echo $main_nav_font ?>;}

<?php endif; ?>

<?php if (!empty($main_nav_first_level_font_size) || !empty($main_nav_second_level_font_size)): ?>

	.navigation div > ul > li > a { font-size: <?php echo $main_nav_first_level_font_size ?>px; }
	.navigation div ul ul a		  { font-size: <?php echo $main_nav_second_level_font_size ?>px; }

<?php endif; ?>

/* First level menu items */

<?php if (!empty($main_nav_def_text_color)): ?>
	.navigation > div > ul > li > a { color:<?php echo $main_nav_def_text_color ?>; }
<?php endif; ?>

<?php if (!empty($main_nav_curr_text_color)): ?>

	.navigation > div > ul > li.current-menu-item > a,
	.navigation > div > ul > li.current-menu-parent > a,
	.navigation > div > ul > li.current-menu-ancestor > a,
	.navigation > div > ul > li.current_page_item > a,
	.navigation > div > ul > li.current_page_parent > a,
	.navigation > div > ul > li.current_page_ancestor > a {
	color: <?php echo $main_nav_curr_text_color ?>;
	}

<?php endif; ?>

<?php if (!empty($main_nav_hover_text_color)): ?>

	.navigation > div > ul > li:hover > a {color:<?php echo $main_nav_hover_text_color ?>;}

<?php endif; ?>

<?php if (!empty($main_nav_border_color)): ?>

	@media only screen and (min-width: 960px) {
	.navigation > div > ul > li > a:after { background-color: <?php echo $main_nav_border_color; ?>; }
	}	

<?php endif; ?>

<?php if (!empty($main_nav_border_color_sub_menu)): ?>

	.navigation ul ul { border-top-color: <?php echo $main_nav_border_color_sub_menu; ?>; }

<?php endif; ?>

/* Second level menu items */

<?php if (!empty($main_nav_dd_def_text_color)): ?>

	.navigation ul ul a { color: <?php echo $main_nav_dd_def_text_color ?>; }

<?php endif; ?>

<?php if (!empty($main_nav_dd_curr_text_color)): ?>

	.navigation ul ul .current-menu-item > a,
	.navigation ul ul .current-menu-parent > a,
	.navigation ul ul .current-menu-ancestor > a,
	.navigation ul ul .current_page_item > a,
	.navigation ul ul .current_page_parent > a,
	.navigation ul ul .current_page_ancestor > a {
	color: <?php echo $main_nav_dd_curr_text_color ?>;
	}

<?php endif; ?>

<?php if (!empty($main_nav_dd_hover_text_color)): ?>

	.navigation > div ul ul > li:hover > a {color:<?php echo $main_nav_dd_hover_text_color ?>;}

<?php endif; ?>

/* Backgrounds */

<?php if (!empty($main_nav_dd_def_item_bg)): ?>

	/* All Mobile Sizes (devices and browser) */

	@media only screen and (max-width: 959px) {

	.navigation ul > li:hover > a,
	.navigation ul > .current-menu-item > a,
	.navigation ul > .current-menu-parent > a,
	.navigation ul > .current-menu-ancestor > a,
	.navigation ul > .current_page_item > a,
	.navigation ul > .current_page_parent > a,
	.navigation ul > .current_page_ancestor > a { background-color: <?php echo $main_nav_dd_def_item_bg ?> !important; }

	}	

<?php endif; ?>

/************************** Content ******************************/

<?php if (!empty($content_font_family) || !empty($content_font_size) || !empty($content_text_color) || !empty($content_normal_link_color) || !empty($content_mouseover_link_color)): ?>

	#content .container p a {
	color: <?php echo $content_normal_link_color ?>;
	}

	#content .container p a:hover {
	color: <?php echo $content_mouseover_link_color ?>;
	}

<?php endif; ?>

/*************************** Buttons *****************************/ 

<?php if (!empty($buttons_font_family) || !empty($buttons_font_size) || !empty($buttons_text_color) || !empty($buttons_bg_color) || !empty($buttons_hover_text_color) || !empty($buttons_hover_bg_color)): ?>

	.button.default,
	html .woocommerce-page #respond input#submit.alt, 
	html .woocommerce-page #content input.button.alt,
	html .woocommerce-page #content input.button,
	html .woocommerce-page button.button.alt,
	html .woocommerce-page input.button.alt,
	html .woocommerce-page input.button,
	html .woocommerce-page button.button,
	html .woocommerce-page a.button.alt,
	html .woocommerce-page a.button,
	html .woocommerce #respond input#submit.alt,
	html .woocommerce #content input.button.alt,
	html .woocommerce #content input.button,
	html .woocommerce button.button.alt,
	html .woocommerce input.button.alt,
	html .woocommerce input.button,
	html .woocommerce button.button,
	html .woocommerce a.button.alt,
	html .woocommerce a.button
	{
	font-family: <?php echo $buttons_font_family ?>;
	font-size: <?php echo $buttons_font_size ?>px;
	color: <?php echo $buttons_text_color ?> !important;
	background: <?php echo $buttons_bg_color ?>;
	}

	.button.black:hover,
	.button.bordered:hover {
	color: <?php echo $buttons_text_color ?> !important;
	background: <?php echo $buttons_bg_color ?>;
	}

	.button.default:hover,
	html .woocommerce-page #respond input#submit.alt:hover, 
	html .woocommerce-page #content input.button.alt:hover,
	html .woocommerce-page #content input.button:hover,
	html .woocommerce-page button.button.alt:hover,
	html .woocommerce-page input.button.alt:hover,
	html .woocommerce-page input.button:hover,
	html .woocommerce-page button.button:hover,
	html .woocommerce-page a.button.alt:hover,
	html .woocommerce-page a.button:hover,
	html .woocommerce #respond input#submit.alt:hover,
	html .woocommerce #content input.button.alt:hover,
	html .woocommerce #content input.button:hover,
	html .woocommerce button.button.alt:hover,
	html .woocommerce input.button.alt:hover,
	html .woocommerce input.button:hover,
	html .woocommerce button.button:hover,
	html .woocommerce a.button.alt:hover,
	html .woocommerce a.button:hover,
	.comment-reply-link:hover,
	.form-submit #submit:hover {
	color: <?php echo $buttons_hover_text_color ?> !important;
	background: <?php echo $buttons_hover_bg_color ?> !important;
	}

<?php endif; ?>

/************************** Widgets *****************************/

<?php if (!empty($widget_title_color) || !empty($widget_title_first_color) || !empty($widget_text_color) || !empty($widget_link_color)) : ?>
	#sidebar .widget .widget-title {
	color: <?php echo $widget_title_color ?>;
	}

	#sidebar .widget_calendar caption {
	color: <?php echo $widget_title_color ?>;
	}

	#sidebar .widget {
	color: <?php echo $widget_text_color ?>;
	}

	#sidebar .widget a {
	color: <?php echo $widget_link_color ?>;
	}

<?php endif; ?>

<?php if (!empty($footer_widget_title_color) || !empty($footer_widget_text_color) || !empty($footer_widget_link_color) || !empty($footer_widget_link_hover_color)): ?>

	#footer .widget-title {
	color: <?php echo $footer_widget_title_color ?>;
	}

	#footer .widget {
	color: <?php echo $footer_widget_text_color ?>;
	}

	#footer .widget a {
	color: <?php echo $footer_widget_link_color ?>;
	}

	#footer .widget a:hover {
	color: <?php echo $footer_widget_link_hover_color ?>;
	}

<?php endif; ?>
