<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Page {

	public static $post_pod_types = array();

	public static function init() {

		self::$post_pod_types = array(
			'default' => __("Default", 'axioma'),
			'video' => __("Video", 'axioma'),
			'audio' => __("Audio", 'axioma'),
			//'link' => __("Link", 'axioma'),
			'quote' => __("Quote", 'axioma'),
			'gallery' => __("Gallery", 'axioma'),
		);

		//ajax
		add_action('wp_ajax_add_post_podtype_gallery_image', array(__CLASS__, 'add_post_podtype_gallery_image'));
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND ($post->post_type == 'post' OR $post->post_type == 'page')) {
				update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
				update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
				update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
				//*****
				update_post_meta($post->ID, "post_pod_type", @$_POST["post_pod_type"]);
				update_post_meta($post->ID, "post_type_values", @$_POST["post_type_values"]);
				//***
				update_post_meta($post->ID, "another_page_title", @$_POST["another_page_title"]);
				update_post_meta($post->ID, "another_page_description", @$_POST["another_page_description"]);
				update_post_meta($post->ID, "another_page_content_align", @$_POST["another_page_content_align"]);
				update_post_meta($post->ID, "headerbg_hide", @$_POST["headerbg_hide"]);
				update_post_meta($post->ID, "headerbg_type_image_bg_cover", @$_POST["headerbg_type_image_bg_cover"]);
				update_post_meta($post->ID, "pagebg_type", @$_POST["pagebg_type"]);
				update_post_meta($post->ID, "pagebg_color", @$_POST["pagebg_color"]);
				update_post_meta($post->ID, "pagebg_image", @$_POST["pagebg_image"]);
				update_post_meta($post->ID, "pagebg_type_image_option", @$_POST["pagebg_type_image_option"]);
				update_post_meta($post->ID, "page_sidebar_position", @$_POST["page_sidebar_position"]);
				//***
				update_post_meta($post->ID, "headerbg_type", @$_POST["headerbg_type"]);
				update_post_meta($post->ID, "headerbg_color", @$_POST["headerbg_color"]);
				update_post_meta($post->ID, "headerbg_image", @$_POST["headerbg_image"]);
				update_post_meta($post->ID, "headerbg_type_image_option", @$_POST["headerbg_type_image_option"]);
				update_post_meta($post->ID, "headerbg_opacity", @$_POST["headerbg_opacity"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("seo_options", __("Seo options", 'axioma'), array(__CLASS__, 'page_seo_options'), "page", "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'axioma'), array(__CLASS__, 'page_seo_options'), "post", "normal", "low");
		//*****
		add_meta_box("post_types", __("Post type", 'axioma'), array(__CLASS__, 'post_type_meta_box'), "post", "side", "low");
		add_meta_box("post_types_data", __("Post type data", 'axioma'), array(__CLASS__, 'post_type_meta_panel'), "post", "normal");
		//*****
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'axioma'), array(__CLASS__, 'page_background_options'), "post", "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'axioma'), array(__CLASS__, 'page_background_options'), "page", "side", "low");
	}

	public static function page_background_options() {
		global $post;
		echo TMM::draw_html('page/background_options', self::get_page_settings($post->ID));
	}

	public static function get_page_settings($post_id) {
		$custom = get_post_custom($post_id);
		$data = array();
		$data['another_page_title'] = @$custom["another_page_title"][0];
		$data['another_page_description'] = @$custom["another_page_description"][0];
		$data['headerbg_hide'] = @$custom["headerbg_hide"][0];
		$data['headerbg_type_image_bg_cover'] = @$custom["headerbg_type_image_bg_cover"][0];
		$data['another_page_content_align'] = @$custom["another_page_content_align"][0];
		$data['pagebg_type'] = @$custom["pagebg_type"][0];
		$data['pagebg_color'] = @$custom["pagebg_color"][0];
		$data['pagebg_image'] = @$custom["pagebg_image"][0];
		$data['pagebg_type_image_option'] = @$custom["pagebg_type_image_option"][0];
		//***
		$data['headerbg_type'] = @$custom["headerbg_type"][0];
		$data['headerbg_color'] = @$custom["headerbg_color"][0];
		$data['headerbg_image'] = @$custom["headerbg_image"][0];
		$data['headerbg_type_image_option'] = @$custom["headerbg_type_image_option"][0];

		$data['headerbg_opacity'] = "";
		if (isset($custom["headerbg_opacity"][0])) {
			$data['headerbg_opacity'] = $custom["headerbg_opacity"][0];
		} else {
			$data['headerbg_opacity'] = 20;
		}

		//*****
		$data['page_sidebar_position'] = @$custom["page_sidebar_position"][0];
		return $data;
	}

	//***

	public static function page_seo_options() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['meta_title'] = @$custom["meta_title"][0];
		$data['meta_keywords'] = @$custom["meta_keywords"][0];
		$data['meta_description'] = @$custom["meta_description"][0];
		echo TMM::draw_html('page/seo_options', $data);
	}

	public static function post_type_meta_box() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}
		echo TMM::draw_html('page/post_pod_type_box', $data);
	}

	public static function post_type_meta_panel() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}

		$data['post_type_values'] = get_post_meta($post->ID, 'post_type_values', true);

		echo TMM::draw_html('page/post_pod_type_panel', $data);
	}

	//ajax
	public static function add_post_podtype_gallery_image() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		echo TMM::draw_html('page/draw_post_podtype_gallery_image', $data);
		exit;
	}

}
