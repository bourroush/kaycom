<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Custom_Sidebars {

	public static function get_categories_select($selected = '', $name = '', $id = '') {
		$args = array(
			'show_option_none' => __('No categories', 'axioma'),
			'hide_empty' => 0,
			'echo' => 0,
			'selected' => $selected,
			'hierarchical' => 0,
			'name' => $name,
			'id' => $id,
			'class' => 'postform',
			'depth' => 0,
			'tab_index' => 0,
			'taxonomy' => 'category',
			'hide_if_empty' => false
		);

		return wp_dropdown_categories($args);
	}

	public static function get_pages_select($selected = '', $name = '', $id = '') {
		$args = array(
			'show_option_none' => __('No pages', 'axioma'),
			'selected' => $selected,
			'echo' => 0,
			'name' => $name,
			'id' => $id
		);

		return wp_dropdown_pages($args);
	}

	//ajax
	public static function add_sidebar() {
		$sidebar = array();
		$sidebar['sidebar_id'] = $_REQUEST['sidebar_id'];
		$sidebar['name'] = $_REQUEST['sidebar_name'];
		$sidebar['page'] = array();
		$sidebar['cat'] = array();
		//***
		$responce = array();
		$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/custom_html/';
		$responce['html'] = TMM::draw_free_page($pagepath . 'sidebar.php', array('sidebar'=>$sidebar, 'sidebar_id'=>$sidebar['sidebar_id']));
		wp_die(json_encode($responce));
	}

	public static function add_sidebar_page() {
		$sidebar_id = $_REQUEST['sidebar_id'];
		$page_id = $_REQUEST['page_id'];
		$data = array();
		$data['select'] = self::get_pages_select('', "sidebars[" . $sidebar_id . "][page][" . $page_id . "]", "sidebars_page_" . $sidebar_id);
		$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/custom_html/';
		wp_die(TMM::draw_free_page($pagepath . 'add_sidebar_page.php', $data));
	}

	public static function add_sidebar_category() {
		$sidebar_id = $_REQUEST['sidebar_id'];
		$cat_id = $_REQUEST['cat_id'];
		$data = array();
		$data['select'] = self::get_categories_select('', "sidebars[" . $sidebar_id . "][cat][" . $cat_id . "]", "sidebars_cat_" . $sidebar_id);
		$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/custom_html/';
		wp_die(TMM::draw_free_page($pagepath . 'add_sidebar_page.php', $data));
	}

	public static function register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title) {
		$sidebars = TMM::get_option('sidebars');
		$data = array();

		if (!empty($sidebars) AND is_array($sidebars)) {
			foreach ($sidebars as $key => $sidebar) {
				$data[$key]['name'] = $sidebar['name'];
				$data[$key]['id'] = strtolower(str_replace(" ", "_", trim($sidebar['name'])));
			}
		}


		if (!empty($data)) {
			foreach ($data as $area) {
				$area['before_widget'] = $before_widget;
				$area['after_widget'] = $after_widget;
				$area['before_title'] = $before_title;
				$area['after_title'] = $after_title;
				register_sidebar($area);
			}
		}
	}

	//Show sidebar for current page
	public static function show_custom_sidebars() {
		//set areas
		$sidebars = TMM::get_option('sidebars');
		//get current page id
		$type = "page";
		$current_id = 0;
		wp_reset_query();
		global $post;
		if (is_category()) {
			$type = 'cat';
			$current_id = get_query_var('cat');
		} else if (is_page()) {
			$type = 'page';
			$current_id = $post->ID;
		}


		//open wigitised areas

		$show_default_sidebar = true;


		if (is_array($sidebars)) {
			//show custom sidebar
			foreach ($sidebars as $area) {
				if ($type == "cat") {
					$cat_id = $current_id;
					if (in_array($cat_id, $area['cat'])) {
						if ($cat_id != 0) {
							$show_default_sidebar = false;
							dynamic_sidebar($area['name']);
						}
					}
				} else {
					$post_id = $current_id;
					if (in_array($post_id, $area['page'])) {
						if ($post_id != 0) {
							$show_default_sidebar = false;
							dynamic_sidebar($area['name']);
						}
					}
				}
			}
		}

		//show default sidebar
		if ($show_default_sidebar) {
			if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Thememakers Default Sidebar')):else:
				?>
				<div class="widget widget_categories">
					<h3 class="widget-title"><?php _e('Categories', 'axioma') ?></h3>
					<ul class="categories">
						<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&title_li=0'); ?>
					</ul>
				</div>
				<div class="widget widget_calendar">
					<h3 class="widget-title"><?php _e('Calendar', 'axioma') ?></h3>
					<?php get_calendar(); ?>
				</div>

				<div class="widget widget_meta">
					<h3 class="widget-title"><?php _e('Meta', 'axioma') ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li>
							<?php wp_loginout(); ?>
						</li>
						<?php wp_meta(); ?>
					</ul>

				</div>

			<?php
			endif;
		}
	}

}
