<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/* ---------------------------------------------------------------------- */
/* 	Basic Theme Settings
  /* ---------------------------------------------------------------------- */

define('TMM_THEME_URI', get_template_directory_uri());
define('TMM_THEME_PATH', get_template_directory());
define('TMM_THEME_PREFIX', 'thememakers_');
define('TMM_EXT_URI', TMM_THEME_URI . '/extensions');
define('TMM_EXT_PATH', TMM_THEME_PATH . '/extensions');
//***
define('TMM_THEME_NAME', 'Axioma');
define('TMM_THEME_TEXTDOMAIN', 'axioma');
define('TMM_FRAMEWORK_VERSION', '2.1.2');
define('TMM_THEME_LINK', 'http://' . TMM_THEME_TEXTDOMAIN . '.webtemplatemasters.com/help/');
define('TMM_THEME_FORUM_LINK', 'http://forums.webtemplatemasters.com/');
/* ---------------------------------------------------------------------- */
/* 	Load Parts
  /* ---------------------------------------------------------------------- */
include_once TMM_THEME_PATH . '/helper/aq_resizer.php';
include_once TMM_THEME_PATH . '/admin/theme_widgets.php';
include_once TMM_THEME_PATH . '/admin/theme_options/helper.php';
include_once TMM_THEME_PATH . '/helper/helper.php';
include_once TMM_THEME_PATH . '/helper/helper_fonts.php';
//***
include_once TMM_THEME_PATH . '/classes/thememakers.php';
//***
include_once TMM_THEME_PATH . '/classes/portfolio.php';
include_once TMM_THEME_PATH . '/classes/staff.php';
include_once TMM_THEME_PATH . '/classes/testimonials.php';
include_once TMM_THEME_PATH . '/classes/gallery.php';
include_once TMM_THEME_PATH . '/classes/page.php';
include_once TMM_THEME_PATH . '/classes/contact_form.php';
include_once TMM_THEME_PATH . '/classes/custom_sidebars.php';
include_once TMM_THEME_PATH . '/classes/seo_group.php';
//extensions INCLUDING----------------------------------------------
include_once TMM_EXT_PATH . '/includer.php';

//17-01-2014
class TMM_Functions {
	/*
	 * Theme custom post types classes (cpt)
	 */

	public static $theme_cpt_classes = array(
		'TMM_Portfolio',
		'TMM_Staff',
		'TMM_Testimonials',
		//'TMM_Gallery',
		'TMM_Page',
	);

	public static function init() {
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_filter('widget_text', 'do_shortcode');
//*****
		register_nav_menu('primary', 'Primary Menu');
		load_theme_textdomain(TMM_THEME_TEXTDOMAIN, TMM_THEME_PATH . '/languages');
//*****
		TMM::init();
		//STYLES
		self::register_styles();
		self::init_sidebars();
		add_action('wp_print_styles', array(__CLASS__, "wp_print_styles"));
		//***

		add_filter('mce_buttons', array(__CLASS__, "mce_buttons"));
		if (!TMM::get_option('use_wptexturize')) {
			remove_filter('the_content', 'wptexturize');
		}


		//***
		add_action('wp_head', array(__CLASS__, 'wp_head'), 1);
		add_action('wp_footer', array(__CLASS__, 'wp_footer'), 1);

		//ADMIN
		add_action('admin_bar_menu', array(__CLASS__, 'admin_bar_menu'), 89);
		add_action('admin_menu', array(__CLASS__, 'admin_menu'));
		add_action('admin_head', array(__CLASS__, 'admin_head'), 1);
		add_action('admin_footer', array(__CLASS__, 'admin_footer'));
		add_action('admin_notices', array(__CLASS__, 'admin_notices'));

		//INIT CUSTOM POST TYPES
		foreach (TMM_Functions::$theme_cpt_classes as $class) {
			add_action('init', array($class, 'init'));
			add_action('admin_init', array("{$class}", 'admin_init'));
			add_action('save_post', array("{$class}", "save_post"));
		}
		//AJAX callbacks------------------------------------------------------------

		add_action('wp_ajax_change_options', array('TMM', 'change_options'));

		add_action('wp_ajax_add_sidebar', array('TMM_Custom_Sidebars', 'add_sidebar'));
		add_action('wp_ajax_add_sidebar_page', array('TMM_Custom_Sidebars', 'add_sidebar_page'));
		add_action('wp_ajax_add_sidebar_category', array('TMM_Custom_Sidebars', 'add_sidebar_category'));

		add_action('wp_ajax_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));

		add_action('wp_ajax_add_comment', array('TMM_Helper', 'add_comment'));
		add_action('wp_ajax_get_resized_image_url', array('TMM_Helper', 'get_resized_image_url'));
		add_action('wp_ajax_regeneratethumbnail', array('TMM_Helper', 'regeneratethumbnail'));
		add_action('wp_ajax_update_allowed_alias', array('TMM_Helper', 'update_allowed_alias'));

		add_action('wp_ajax_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
		add_action('wp_ajax_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
		add_action('wp_ajax_save_google_fonts', array('TMM_HelperFonts', 'save_google_fonts'));

		add_action('wp_ajax_add_seo_group', array('TMM_SEO_Group', 'add_seo_group'));
		add_action('wp_ajax_add_seo_group_category', array('TMM_SEO_Group', 'add_seo_group_category'));



		//***
		add_action('wp_ajax_nopriv_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));

		add_action('wp_ajax_nopriv_add_comment', array('TMM_Helper', 'add_comment'));

		add_action('wp_ajax_nopriv_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
		add_action('wp_ajax_nopriv_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
	}

	public static function theme_first_activation() {

		global $pagenow;
		if (is_admin() AND 'themes.php' == $pagenow AND isset($_GET['activated'])) {
			//***** set default options
			$theme_was_activated = TMM::get_option('theme_was_activated');
			if (!$theme_was_activated) {
				//*****
				$menu_id = wp_update_nav_menu_object(0, array('menu-name' => 'Primary Menu'));
				$theme_mods = get_option('theme_mods_' . TMM_THEME_TEXTDOMAIN);
				$theme_mods['nav_menu_locations']['primary'] = $menu_id;
				update_option('theme_mods_' . TMM_THEME_TEXTDOMAIN, $theme_mods);

				if (class_exists('TMM_Ext_Shortcodes')) {
					$shortcodes = TMM_Ext_Shortcodes::get_shortcodes_array();
					if (!empty($shortcodes)) {
						foreach ($shortcodes as $shortcode) {
							TMM::update_option('show_shortcode_' . $shortcode, 1);
						}
					}
				}

				TMM::update_option('theme_was_activated', 1);
//*****
				TMM::update_option('saved_google_fonts', 'a:1:{i:0;s:83:"Open Sans:300,300italic,400regular,italic,600,600italic,700,700italic,800,800italic";}');
				TMM::update_option('sidebar_position', 'sbr');
				TMM::update_option('copyright_text', 'Copyright &copy; 2013. <a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a>. All rights reserved');
			}
		}
	}

	/* ---------------------------------------------------------------------- */
	/* 	Theme scripts Header
	  /* ---------------------------------------------------------------------- */

	public static function wp_head() {
		self::register_scripts();
		wp_enqueue_script('jquery');
		wp_print_scripts('jquery');
		self::enqueue_script('modernizr');
		?>
		<script type="text/javascript">
			(function($) {

				$.fn.life = function(types, data, fn) {
					"use strict";
					$(this.context).on(types, this.selector, data, fn);
					return this;
				};

			})(jQuery);
			//***
		<?php if (is_single() OR is_page()) : ?>
				is_single_page = true;//for breadcumbs definitions it theme.js
		<?php endif; ?>
		</script>
		<?php
	}

	/* ---------------------------------------------------------------------- */
	/* 	Theme scripts Footer
	  /* ---------------------------------------------------------------------- */

	public static function wp_footer() {
		// For Internet Explorer
		global $is_IE;
		if ($is_IE) {
			TMM_Functions::enqueue_script('selectivizr');
		}

		TMM_Functions::enqueue_script('easing');
		TMM_Functions::enqueue_script('cycle');
		TMM_Functions::enqueue_script('touchswipe');
		TMM_Functions::enqueue_script('fancybox');
		// TMM_Functions::enqueue_script('smoothscroll');
		TMM_Functions::enqueue_script('ytplayer');
		TMM_Functions::enqueue_script('tooltipster');
		TMM_Functions::enqueue_script('theme');
		?>

		<script type="text/javascript">
			var site_url = "<?php echo home_url() ?>";
			var capcha_image_url = "<?php echo TMM_THEME_URI ?>/helper/capcha/image.php/";
			var template_directory = "<?php echo TMM_THEME_URI; ?>/";
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			//translations
			var lang_enter_correctly = "<?php _e('Please enter correct', 'axioma'); ?>";
			var lang_sended_succsessfully = "<?php _e('Your message has been sent successfully!', 'axioma'); ?>";
			var lang_server_failed = "<?php _e('Server failed. Send later', 'axioma'); ?>";
			var lang_any = "<?php _e('Any', 'axioma'); ?>";
			var lang_home = "<?php _e('Home', 'axioma'); ?>";
			var lang_attach_more_else = "<?php _e('You cant add more else attachments!', 'axioma'); ?>";
			var lang_loading = "<?php _e('Loading ...', 'axioma'); ?>";
			var lang_mail_sending = "<?php _e('Mail sending ...', 'axioma'); ?>";

			jQuery(function() {
				var fixed_menu = <?php echo (int) TMM::get_option('fixed_menu') ?>;
				jQuery('#navigation').mainNav({
					onFixed: parseInt(fixed_menu)
				});
			});

		</script>


		<?php
	}

	//register front scripts
	public static function register_scripts() {
		wp_register_script('tmm_selectivizr', TMM_THEME_URI . '/js/jquery.selectivizr.min.js', array('jquery'));
		wp_register_script('tmm_cycle', TMM_THEME_URI . '/js/jquery.cycle.all.min.js', array('jquery'));
		wp_register_script('tmm_easing', TMM_THEME_URI . '/js/jquery.easing.1.3.min.js', array('jquery'));
		wp_register_script('tmm_isotope', TMM_THEME_URI . '/js/jquery.isotope.min.js', array('jquery'));
		wp_register_script('tmm_modernizr', TMM_THEME_URI . '/js/jquery.modernizr.min.js', array('jquery'));
		wp_register_script('tmm_touchswipe', TMM_THEME_URI . '/js/jquery.touchswipe.min.js', array('jquery'));
		wp_register_script('tmm_fancybox', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'));
		wp_register_script('tmm_smoothscroll', TMM_THEME_URI . '/js/jquery.smoothscroll.js', array('jquery'));
		wp_register_script('tmm_ytplayer', TMM_THEME_URI . '/js/jquery.mb.YTPlayer.js', array('jquery'));
		wp_register_script('tmm_tooltipster', TMM_THEME_URI . '/js/jquery.tooltipster.min.js', array('jquery'));
		wp_register_script('tmm_theme', TMM_THEME_URI . '/js/theme.js', array('jquery'));
	}

	public static function register_styles() {
		wp_register_style('tmm_theme_style', TMM_THEME_URI . '/style.css', null, false);
		wp_register_style('tmm_skeleton', TMM_THEME_URI . '/css/skeleton.css', null, false);
		wp_register_style('tmm_layout', TMM_THEME_URI . '/css/layout.css', null, false);
		wp_register_style('tmm_font_awesome', TMM_THEME_URI . '/css/font-awesome.css', null, false);
		wp_register_style('tmm_tooltipster', TMM_THEME_URI . '/css/tooltipster.css', null, false);
		wp_register_style('tmm_custom1', TMM_THEME_URI . '/css/custom1.css', null, false);
		wp_register_style('tmm_custom2', TMM_THEME_URI . '/css/custom2.css', null, false);
		wp_register_style('tmm_fancybox', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.css', null, false);
	}

	public static function wp_print_styles() {
		self::enqueue_style('theme_style');
		self::enqueue_style('skeleton');
		self::enqueue_style('layout');
		self::enqueue_style('font_awesome');
		self::enqueue_style('tooltipster');
		self::enqueue_style('custom1');
		self::enqueue_style('custom2');
		self::enqueue_style('fancybox');
	}

	public static function enqueue_script($key) {
		wp_enqueue_script('tmm_' . $key);
	}

	public static function enqueue_style($key) {
		wp_enqueue_style('tmm_' . $key);
	}

	//***

	public static function mce_buttons($mce_buttons) {
		$pos = array_search('wp_more', $mce_buttons, true);
		if ($pos !== false) {
			$tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
			$tmp_buttons[] = 'wp_page';
			$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
		}
		return $mce_buttons;
	}

	//admin functions
	public static function admin_bar_menu() {
		global $wp_admin_bar;
		if (!is_super_admin() || !is_admin_bar_showing())
			return;
		$wp_admin_bar->add_menu(array(
			'id' => 'tmm_theme_options_page',
			'title' => __("Theme Options", 'axioma'),
			'href' => admin_url('themes.php?page=tmm_theme_options'),
		));
	}

	public static function admin_menu() {
		add_theme_page(__("Theme Options", 'axioma'), __("Theme Options", 'axioma'), 'edit_themes', 'tmm_theme_options', array(__CLASS__, 'theme_options_page'));
	}

	public static function theme_options_page() {
		echo TMM::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/theme_options.php');
	}

	public static function admin_notices() {
		$notices = "";

		if (!is_writable(TMM_THEME_PATH . "/css/custom1.css")) {
			$notices.=sprintf(__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>%s/css/custom1.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'axioma'), TMM_THEME_PATH);
		}

		if (!is_writable(TMM_THEME_PATH . "/css/custom2.css")) {
			$notices.=sprintf(__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>%s/css/custom2.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'axioma'), TMM_THEME_PATH);
		}

		if (!class_exists('TMM_Ext_Shortcodes')) {
			$notices.=__('<div class="error"><p>To make your theme work correctly you need to install ThemeMakers Shortcodes Plugin. Check in your theme bundle.</p></div>', 'axioma');
		}


		echo $notices;
	}

	public static function admin_head() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-sortable');


		wp_enqueue_script('media-upload');
		wp_enqueue_script('tmm_theme_admin', TMM_THEME_URI . '/admin/js/general.js', array('jquery'));

		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');

//*****
		wp_enqueue_style("tmm_theme_colorpicker", TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.css');
		wp_enqueue_script('tmm_theme_colorpicker', TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.js', array('jquery'));
		?>
		<!--[if IE]>
				<script>
					document.createElement('header');
					document.createElement('footer');
					document.createElement('section');
					document.createElement('aside');
					document.createElement('nav');
					document.createElement('article');
				</script>
		<![endif]-->
		<script type="text/javascript">
			(function($) {

				$.fn.life = function(types, data, fn) {
					"use strict";
					$(this.context).on(types, this.selector, data, fn);
					return this;
				};

			})(jQuery);
			//***
			var site_url = "<?php echo home_url(); ?>/";
			var template_directory = "<?php echo TMM_THEME_URI; ?>/";
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			//translations
			var lang_edit = "<?php _e('Edit', 'axioma'); ?>";
			var lang_delete = "<?php _e('Delete', 'axioma'); ?>";
			var lang_cancel = "<?php _e('Cancel', 'axioma'); ?>";
			var lang_one_moment = "<?php _e("One moment", 'axioma') ?>";
			var lang_loading = "<?php _e("Loading", 'axioma') ?> ...";
			var lang_sure = "<?php _e("Sure?", 'axioma') ?> ...";
			var tmm_theme_options_url = "<?php echo admin_url('themes.php?page=tmm_theme_options&tmm_action=save_options'); ?>";
			var is_IE =<?php
		global $is_IE;
		echo (int) $is_IE;
		?>;
		</script>

		<?php
		echo TMM_HelperFonts::get_google_fonts_link();
		//***
		wp_enqueue_style("tmm_admin_styles_css", TMM_THEME_URI . '/admin/css/styles.css');
		//*** FOR THEME OPTIONS
		$is_tmm_theme_options = FALSE;
		if (isset($_GET['page'])) {
			if ($_GET['page'] == 'tmm_theme_options') {
				$is_tmm_theme_options = TRUE;
			}
		}
		//***
		if ($is_tmm_theme_options === TRUE) {
			wp_enqueue_style('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/css/styles.css');
			wp_enqueue_script('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery'));
			wp_enqueue_style('tmm_theme_popup', TMM_THEME_URI . '/admin/js/tmm_popup/styles.css');
			wp_enqueue_script('tmm_theme_popup', TMM_THEME_URI . '/admin/js/tmm_popup/tmm_advanced_wp_popup.js', array('jquery'));

			wp_enqueue_script('tmm_theme_custom_sidebars', TMM_THEME_URI . '/admin/theme_options/js/custom_sidebars.js', array('jquery'));
			wp_enqueue_script('tmm_theme_seo_groups', TMM_THEME_URI . '/admin/theme_options/js/seo_groups.js', array('jquery'));
			wp_enqueue_script('tmm_theme_form_constructor', TMM_THEME_URI . '/admin/theme_options/js/form_constructor.js', array('jquery'));

			wp_enqueue_script('tmm_theme_selectivizr', TMM_THEME_URI . '/admin/theme_options/js/selectivizr-and-extra-selectors.min.js', array('jquery'));

			//***
			wp_print_styles(array('tmm_theme_options'));
		}
	}

	public static function admin_footer() {
		?>
		<div style="display: none;">

			<div id="google_font_set" style="width: 800px; height: 600px;">
				<ul id="google_font_set_list"></ul><br />
			</div>

			<div id="ui_slider_item">

				<div class="clearfix ui-slider-item" id="__UI_SLIDER_NAME__">
					<input type="text" class="range-amount-value" value="__UI_SLIDER_VALUE__" />
					<input type="hidden" value="__UI_SLIDER_VALUE__" name="__UI_SLIDER_NAME__" class="range-amount-value-hidden" />
					<div class="slider-range __UI_SLIDER_NAME__"></div>
				</div>

			</div>

		</div>
		<?php
	}

//end of admin functions

	public static function init_sidebars() {
		global $before_widget, $after_widget, $before_title, $after_title;
//static widget attributes
		$before_widget = '<div id="%1$s" class="widget %2$s">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == 'add_sidebar') {
				$_REQUEST = TMM_Helper::db_quotes_shield($_REQUEST);
			}
		}

		register_sidebar(array(
			'name' => 'Thememakers Default Sidebar',
			'id' => 'tmm_default_sidebar',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 1',
			'id' => 'footer_sidebar_1',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 2',
			'id' => 'footer_sidebar_2',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 3',
			'id' => 'footer_sidebar_3',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 4',
			'id' => 'footer_sidebar_4',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 5',
			'id' => 'footer_sidebar_5',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

//custom widget sidebars
		TMM_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);
	}

}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
add_action('init', array('TMM_Functions', 'init'), 1);
TMM_Functions::theme_first_activation();

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


/* ---------------------------------------------------------------------- */
/* 	Filter Hooks for Form
  /* ---------------------------------------------------------------------- */

// Modity comments form fields
function tmk_comments_form_defaults($defaults) {

	$commenter = wp_get_current_commenter();

	$req = get_option('require_name_email');

	$aria_req = ( $req ? " required" : '' );

	$defaults['fields']['author'] = '<p class="comment-form-author"><label for="author">' . __('Your Name', 'axioma') . ( $req ? ': <span class="required">(required)</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';
	$defaults['fields']['email'] = '<p class="comment-form-email"><label for="email">' . __('Email', 'axioma') . ( $req ? ': <span class="required">(required)</span>' : '' ) . '</label> ' .
			'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
	$defaults['fields']['url'] = '<p class="comment-form-url"><label for="url">' . __('Website', 'axioma') . '</label> ' .
			'<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>';
	$defaults['comment_field'] = '<p class="comment-form-comment">' .
			'<label for="comment">' . __('Your Message', 'axioma') . '</label>' .
			'<textarea required="" id="comment" name="comment"></textarea></p>';

	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';

	$defaults['cancel_reply_link'] = ' - ' . __('Cancel reply', 'axioma');

	$defaults['title_reply'] = __('Leave a Comment', 'axioma');

	$defaults['label_submit'] = __('Submit', 'axioma');

	return $defaults;
}

add_filter('comment_form_defaults', 'tmk_comments_form_defaults');

//*************************************************

function tmm_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>

	<li class="comment" id="comment-<?php echo comment_ID() ?>" comment-id="<?php echo comment_ID() ?>">

		<article>
			<div class="comment-meta clearfix">
				<div class="gravatar">
	<?php echo get_avatar($comment, $size = '50', TMM_THEME_URI . '/admin/images/gravatar.jpg'); ?>
				</div><!--/ .gravatar-->
				<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-date"><?php comment_date(); ?> <?php _e('at', 'axioma'); ?> <?php comment_date('H:i'); ?></div>
	<?php echo get_comment_reply_link(array_merge(array('reply_text' => __('Reply', 'axioma')), array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div><!--/ .comment-meta -->

			<div class="comment-body">
				<p><?php comment_text_rss(); ?></p>
			</div><!--/ .comment-body -->

		</article>

	</li>

	<?php
}

/**
 * Add prev and next links to a numbered link list
 */
function wp_link_pages_args_prevnext_add($args) {
	global $page, $numpages, $more, $pagenow;

	if (!$args['next_or_number'] == 'next_and_number')
		return $args;# exit early

	$args['next_or_number'] = 'number'; # keep numbering for the main part
	if (!$more)
		return $args;# exit early

	if ($page - 1) # there is a previous page
		$args['before'] .= _wp_link_page($page - 1)
				. $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';

	if ($page < $numpages) # there is a next page
		$args['after'] = _wp_link_page($page + 1)
				. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
				. $args['after'];

	return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');


//* Add custom body class to the head
function sp_body_class( $classes ) {

	$classes[] = CMLLanguage::get_current_slug();
	return $classes;
}

add_filter( 'body_class', 'sp_body_class' );
