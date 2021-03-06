<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Gallery {

	public static $slug = 'gall';

	public static function init() {
		$args = array(
			'labels' => array(
				'name' => __('Galleries', 'axioma'),
				'singular_name' => __('Gallery', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Gallery', 'axioma'),
				'edit_item' => __('Edit Gallery', 'axioma'),
				'new_item' => __('New Gallery', 'axioma'),
				'view_item' => __('View Gallery', 'axioma'),
				'search_items' => __('Search Gallery', 'axioma'),
				'not_found' => __('No Galleries found', 'axioma'),
				'not_found_in_trash' => __('No Galleries found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'menu_icon' => ''
		);
		register_post_type(self::$slug, $args);
		//*** taxonomies ****
		register_taxonomy("gallery_categories", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Gallery Categories', 'axioma'),
				'singular_name' => __('Gallery Category', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Gallery Category', 'axioma'),
				'edit_item' => __('Edit Gallery Category', 'axioma'),
				'new_item' => __('New Gallery Category', 'axioma'),
				'view_item' => __('View Gallery Category', 'axioma'),
				'search_items' => __('Search Gallery Categories', 'axioma'),
				'not_found' => __('No Gallery Categories found', 'axioma'),
				'not_found_in_trash' => __('No Gallery Categories found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("Gallery Category", 'axioma'),
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => true,
			'show_in_admin_bar' => true,
			"rewrite" => true,
			'show_in_nav_menus' => false,
		));
		//***
		flush_rewrite_rules(false);
		self::init_meta_boxes();
		add_filter("manage_gall_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_gall_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		//ajax
		add_action('wp_ajax_add_gallery_item', array(__CLASS__, 'add_gallery_item'));
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function gallery_meta() {
		global $post;
		$data = array();
		$data['tmm_gallery'] = get_post_meta($post->ID, 'thememakers_gallery', true);
		$data['layout'] = get_post_meta($post->ID, 'layout', true);
		echo TMM::draw_html('gallery/metabox', $data);
	}

	public static function save_post() {
		global $post;
		if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
			update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
			update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
			update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
			//*****
			update_post_meta($post->ID, "thememakers_gallery", @$_POST["tmm_gallery"]);
			update_post_meta($post->ID, "layout", @$_POST["layout"]);
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("gallery_meta", __("Gallery images", 'axioma'), array(__CLASS__, 'gallery_meta'), self::$slug, "normal", "low");
		
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'axioma'), array('TMM_Page', 'page_background_options'), self::$slug, "side", "low");
		add_meta_box("seo_options", __("Seo options", 'axioma'), array('TMM_Page', 'page_seo_options'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<img width="200" alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200') . '"/>';
				break;
			case "image_count":
				$custom = get_post_custom($post->ID);
				$tmm_gallery = unserialize(@$custom["thememakers_gallery"][0]);
				if (empty($tmm_gallery)) {
					$tmm_gallery = array();
				}
				echo count($tmm_gallery);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'axioma'),
			"image" => __("Cover", 'axioma'),
			"image_count" => __("Image count", 'axioma'),
			"date" => __("Date", 'axioma')
		);

		return $columns;
	}

	//for ajax
	public static function add_gallery_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['title'] = "";
		$data['description'] = "";
		$data['layout'] = 2;
		$data['category'] = "";
		echo TMM::draw_html('gallery/render_gallery_item', $data);
		exit;
	}

	public static function render_gallery_item($data) {
		echo TMM::draw_html('gallery/render_gallery_item', $data);
	}

}

