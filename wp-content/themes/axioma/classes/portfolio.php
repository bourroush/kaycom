<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Portfolio {

	public static $slug = 'folio';

	public static function init() {

		$args = array(
			'labels' => array(
				'name' => __('Portfolios', 'axioma'),
				'singular_name' => __('Portfolio', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Portfolio', 'axioma'),
				'edit_item' => __('Edit Portfolio', 'axioma'),
				'new_item' => __('New Portfolio', 'axioma'),
				'view_item' => __('View Portfolio', 'axioma'),
				'search_items' => __('Search Portfolios', 'axioma'),
				'not_found' => __('No Portfolios found', 'axioma'),
				'not_found_in_trash' => __('No Portfolios found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			'public' => true,
			'archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'tags', 'comments'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'taxonomies' => array('clients', 'skills', 'post_tag'), // this is IMPORTANT
			'menu_icon' => ''
		);

		//*** taxonomies ****		
		register_taxonomy("clients", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Clients', 'axioma'),
				'singular_name' => __('Client', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Client', 'axioma'),
				'edit_item' => __('Edit Client', 'axioma'),
				'new_item' => __('New Client', 'axioma'),
				'view_item' => __('View Client', 'axioma'),
				'search_items' => __('Search Clients', 'axioma'),
				'not_found' => __('No Clients found', 'axioma'),
				'not_found_in_trash' => __('No Clients found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("client", 'axioma'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
			'capabilities' => array('manage_terms'),
			'show_ui' => true
		));

		register_taxonomy("skills", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Skills', 'axioma'),
				'singular_name' => __('Skill', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Skill', 'axioma'),
				'edit_item' => __('Edit Skill', 'axioma'),
				'new_item' => __('New Skill', 'axioma'),
				'view_item' => __('View Skill', 'axioma'),
				'search_items' => __('Search Skills', 'axioma'),
				'not_found' => __('No Skills found', 'axioma'),
				'not_found_in_trash' => __('No Skills found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("skill", 'axioma'),
			"show_tagcloud" => true,
			'query_var' => true,
			'rewrite' => true,
			'show_in_nav_menus' => false,
			'capabilities' => array('manage_terms'),
			'show_ui' => true
		));


		register_taxonomy("folio_category", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Categories', 'axioma'),
				'singular_name' => __('Category', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Category', 'axioma'),
				'edit_item' => __('Edit Category', 'axioma'),
				'new_item' => __('New Category', 'axioma'),
				'view_item' => __('View Category', 'axioma'),
				'search_items' => __('Search Categories', 'axioma'),
				'not_found' => __('No Categories found', 'axioma'),
				'not_found_in_trash' => __('No Categories found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("category", 'axioma'),
			"show_tagcloud" => true,
			'query_var' => true,
			'rewrite' => true,
			'show_in_nav_menus' => false,
			'capabilities' => array('manage_terms'),
			'show_ui' => true
		));

		//***
		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);
		//***		
		add_filter("manage_folio_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_folio_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));

		//ajax
		add_action('wp_ajax_add_gallery_folio_item', array(__CLASS__, 'add_gallery_item'));
		add_action('wp_ajax_folio_get_masonry_piece', array(__CLASS__, 'get_masonry_piece'));

		add_action('wp_ajax_nopriv_folio_get_masonry_piece', array(__CLASS__, 'get_masonry_piece'));
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['portfolio_date'] = @$custom["portfolio_date"][0];
		$data['portfolio_url'] = @$custom["portfolio_url"][0];
		$data['portfolio_url_title'] = @$custom["portfolio_url_title"][0];
		$data['portfolio_client'] = @$custom["portfolio_client"][0];
		$data['portfolio_tools'] = @$custom["portfolio_tools"][0];
		$data['portfolio_clients'] = @$custom["portfolio_clients"][0];
		$data['single_page_layout'] = @$custom["single_page_layout"][0];
		$data['tmm_portfolio'] = unserialize(@$custom["tmm_portfolio"][0]);
		echo TMM::draw_html('portfolio/credits_meta', $data);
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
				update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
				update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
				//*****
				update_post_meta($post->ID, "portfolio_url", @$_POST["portfolio_url"]);
				update_post_meta($post->ID, "portfolio_date", @$_POST["portfolio_date"]);
				update_post_meta($post->ID, "portfolio_url_title", @$_POST["portfolio_url_title"]);
				update_post_meta($post->ID, "portfolio_client", @$_POST["portfolio_client"]);
				update_post_meta($post->ID, "portfolio_tools", @$_POST["portfolio_tools"]);
				update_post_meta($post->ID, "thememakers_portfolio", @$_POST["tmm_portfolio"]);
				update_post_meta($post->ID, "portfolio_clients", @$_POST["portfolio_clients"]);
				update_post_meta($post->ID, "single_page_layout", @$_POST["single_page_layout"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Portfolio attributes", 'axioma'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
		add_meta_box("folio_gallery_meta", __("Folio images", 'axioma'), array(__CLASS__, 'gallery_meta'), self::$slug, "normal", "low");
		add_meta_box("folio_single_tpl", __("Single page layout", 'axioma'), array(__CLASS__, 'single_tpl_meta'), self::$slug, "side", "low");

		add_meta_box("seo_options", __("Seo options", 'axioma'), array('TMM_Page', 'page_seo_options'), self::$slug, "normal", "low");
	}

	public static function gallery_meta() {
		global $post;
		$data = array();
		$data['tmm_portfolio'] = get_post_meta($post->ID, 'thememakers_portfolio', true);
		echo TMM::draw_html('portfolio/gallery_meta', $data);
	}

	public static function render_gallery_item($data) {
		echo TMM::draw_html('portfolio/render_gallery_item', $data);
	}

	public static function single_tpl_meta() {
		global $post;
		$single_page_layout = get_post_meta($post->ID, 'single_page_layout', TRUE);
		if (empty($single_page_layout)) {
			$single_page_layout = 1;
		}
		?>
		<select name="single_page_layout">
			<option <?php echo($single_page_layout == 1 ? 'selected' : '') ?> value="1"><?php _e("Default", 'axioma') ?></option>
			<option <?php echo($single_page_layout == 2 ? 'selected' : '') ?> value="2"><?php _e("Full Width", 'axioma') ?></option>
		</select>
		<?php
	}

	//for ajax
	public static function add_gallery_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		echo TMM::draw_html('portfolio/render_gallery_item', $data);
		exit;
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<img width="200" alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200') . '"/>';
				break;
			case "description":
				the_excerpt();
				break;
			case "tags":
				echo get_the_tag_list('', '', '', $post->ID);
				break;
			case "clients":
				echo get_the_term_list($post->ID, 'clients', '', ', ', '');
				break;
			case "skills":
				echo get_the_term_list($post->ID, 'skills', '', ', ', '');
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'axioma'),
			"image" => __("Cover", 'axioma'),
			"description" => __("Description", 'axioma'),
			"tags" => __("Tags", 'axioma'),
			"clients" => __("Clients", 'axioma'),
			"skills" => __("Skills", 'axioma'),
		);

		return $columns;
	}

	//ajax
	public static function get_masonry_piece() {
		$post_key = (int) $_REQUEST['post_key'];
		$posts = $_REQUEST['posts'];
		if (!isset($posts[$post_key])) {
			echo "";
			exit;
		} else {
			$data = array();
			$data['folioposts'] = $posts;
			$data['foliopost_key'] = $post_key;
			$data['foliopost'] = $posts[$post_key];
			$data['current_col_algoritm'] = $_REQUEST['current_col_algoritm'];
			$data['type'] = $_REQUEST['type'];
			$data['columns'] = $_REQUEST['columns'];
			echo TMM::draw_html('portfolio/shortcodes/masonry_piece', $data);
		}

		exit;
	}

}
