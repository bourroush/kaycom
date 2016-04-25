<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Staff {

	public static $slug = 'staff-page';

	public static function init() {

		$args = array(
			'labels' => array(
				'name' => __('Staff', 'axioma'),
				'singular_name' => __('Staff', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Staff', 'axioma'),
				'edit_item' => __('Edit Staff', 'axioma'),
				'new_item' => __('New Staff', 'axioma'),
				'view_item' => __('View Staff', 'axioma'),
				'search_items' => __('Search In Staff', 'axioma'),
				'not_found' => __('Nothing found', 'axioma'),
				'not_found_in_trash' => __('Nothing found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'excerpt'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'taxonomies' => array('position'), // this is IMPORTANT
			'menu_icon' => ''
		);

		register_taxonomy("position", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Position', 'axioma'),
				'singular_name' => __('Position', 'axioma'),
				'add_new' => __('Add New', 'axioma'),
				'add_new_item' => __('Add New Position', 'axioma'),
				'edit_item' => __('Edit Position', 'axioma'),
				'new_item' => __('New Position', 'axioma'),
				'view_item' => __('View Position', 'axioma'),
				'search_items' => __('Search GPosition', 'axioma'),
				'not_found' => __('No Position found', 'axioma'),
				'not_found_in_trash' => __('No Position found in Trash', 'axioma'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("Position", 'axioma'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
		));
		//***	


		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);

		//***
		add_filter("manage_staff-page_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_staff-page_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function get_meta_data($post_id) {
		$data = array();
		$custom = get_post_custom($post_id);
		$data['email'] = @$custom["email"][0];
		$data['twitter'] = @$custom["twitter"][0];
		$data['facebook'] = @$custom["facebook"][0];
		$data['dribble'] = @$custom["dribble"][0];
		$data['skype'] = @$custom["skype"][0];
		return $data;
	}

	public static function credits_meta() {
		global $post;
		$data = self::get_meta_data($post->ID);
		echo TMM::draw_html('staff/credits_meta', $data);
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "email", @$_POST["email"]);
				update_post_meta($post->ID, "twitter", @$_POST["twitter"]);
				update_post_meta($post->ID, "facebook", @$_POST["facebook"]);
				update_post_meta($post->ID, "dribble", @$_POST["dribble"]);
				update_post_meta($post->ID, "skype", @$_POST["skype"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Staff attributes", 'axioma'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				if (has_post_thumbnail($post->ID)) {
					echo '<img width="160" alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '160*160') . '"/>';
				} else {
					echo '<img width="160" alt="" src="' . TMM_THEME_URI . '/admin/images/no_staff.png" />';
				}
				break;
			case "twitter":
				echo get_post_meta($post->ID, 'twitter', true);
				break;
			case "facebook":
				echo get_post_meta($post->ID, 'facebook', true);
				break;
			case "dribble":
				echo get_post_meta($post->ID, 'dribble', true);
				break;
			case "skype":
				echo get_post_meta($post->ID, 'skype', true);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Name", 'axioma'),
			"image" => __("Photo", 'axioma'),
			"twitter" => __("Twitter", 'axioma'),
			"facebook" => __("Facebook", 'axioma'),
			"dribble" => __("Dribble", 'axioma'),
			"skype" => __("Skype", 'axioma'),
		);

		return $columns;
	}

}
