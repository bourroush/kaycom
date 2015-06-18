<?php
/*
  Plugin Name: ThemeMakers Shortcodes Package
  Plugin URI: http://webtemplatemasters.com
  Description: Universal Shortcodes Package
  Author: ThemeMakers
  Version: 1.0.7
  Author URI: http://themeforest.net/user/ThemeMakers
 */

//16-12-2013
class TMM_Ext_Shortcodes {

	public static $shortcodes = array();
	public static $shortcodes_folders = array();
	public static $shortcodes_keys_by_folders = array();

	//*****************************

	public static function get_application_path() {
		return plugin_dir_path(__FILE__);
	}

	public static function get_application_uri() {
		return plugin_dir_url(__FILE__);
	}

	public static function register() {
		load_plugin_textdomain('tmm_shortcodes', false, dirname(plugin_basename(__FILE__)) . '/languages');
		//***
		add_action('wp_head', array('TMM_Ext_Shortcodes', 'wp_head'), 1);
		add_action('wp_footer', array('TMM_Ext_Shortcodes', 'wp_footer'), 1);
		add_action('admin_head', array('TMM_Ext_Shortcodes', 'admin_head'), 1);
		add_filter('mce_buttons', array('TMM_Ext_Shortcodes', 'mce_buttons'));
		add_filter('mce_external_plugins', array('TMM_Ext_Shortcodes', 'mce_add_rich_plugins'));

		//AJAX callback
		add_action('wp_ajax_app_shortcodes_get_shortcode_template', array(__CLASS__, 'get_shortcode_template'));
		//collect shortcodes from folder "views"
		$handler = opendir(self::get_application_path() . "views/");
		while ($file = readdir($handler)) {
			if ($file != "." AND $file != "..") {
				self::$shortcodes_folders[] = $file;
			}
		}
		//***
		$shortcodes = self::get_shortcodes_array();
		if (!empty($shortcodes)) {
			foreach ($shortcodes as $value) {
				$name = ucfirst(trim($value));
				$name = str_replace("_", " ", $name);
				self::$shortcodes[$value] = $name;
			}
		}
		//quite shortcodes
		self::$shortcodes['price_table'] = __('Price table', 'tmm_shortcodes');
		self::$shortcodes['google_table_row'] = __('Google table row', 'tmm_shortcodes');
		//*****
		$shortcodes_keys = array_keys(self::$shortcodes);

		function TMM_Ext_Shortcodes_do($attributes = array(), $content = "", $shortcode_key) {
			$attributes["content"] = $content;
			if (isset($_REQUEST["shortcode_mode_edit"])) {
				$_REQUEST["shortcode_mode_edit"] = $attributes;
			} else {
				return TMM_Ext_Shortcodes::draw_html($shortcode_key, $attributes);
			}
		}

		foreach ($shortcodes_keys as $shortcode_key) {
			$_REQUEST["shortcode_key"] = $shortcode_key;
			add_shortcode($shortcode_key, 'TMM_Ext_Shortcodes_do');
		}
	}

	public static function wp_head() {
		wp_enqueue_style('tmm_ext_shortcodes', self::get_application_uri() . 'css/front.css');
	}
	
	public static function wp_footer() {
		wp_enqueue_script('tmm_ext_shortcodes', self::get_application_uri() . 'js/front.js', array('jquery'));
	}

	public static function admin_head() {
		wp_enqueue_script('tmm_ext_shortcodes', self::get_application_uri() . 'js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-draggable'));
		wp_enqueue_style('tmm_ext_shortcodes', self::get_application_uri() . 'css/admin.css');
		?>
		<script type="text/javascript">
			var tmm_ext_shortcodes_app_link = "<?php echo TMM_Ext_Shortcodes::get_application_uri() ?>";
			var tmm_ext_shortcodes_items = [];
			var tmm_lang_loading = "<?php _e('Loading ...', 'tmm_shortcodes'); ?>";
		<?php
//global $pagenow;
		$show_shortcode = substr_count($_SERVER['PHP_SELF'], '/wp-admin/post.php');
		if (!$show_shortcode) {
			$show_shortcode = substr_count($_SERVER['PHP_SELF'], '/wp-admin/post-new.php');
		}

		if ($show_shortcode):
			wp_enqueue_script('tmm_ext_shortcodes_popup_js', self::get_application_uri() . 'js/tmm_popup/tmm_advanced_wp_popup.js', array('jquery', 'jquery-ui-core', 'jquery-ui-draggable'));
			wp_enqueue_style('tmm_ext_shortcodes_popup_css', self::get_application_uri() . 'js/tmm_popup/styles.css');
			?>

			<?php foreach (TMM_Ext_Shortcodes::$shortcodes as $shortcode_key => $shortcode_name): ?>
				<?php
				//for undershortcodes
				$continue_array = array('price_table', 'google_table_row');
				if (in_array($shortcode_key, $continue_array)) {
					continue;
				}
				?>
					tmm_ext_shortcodes_items.push({'key': '<?php echo $shortcode_key ?>', 'name': '<?php echo $shortcode_name ?>', 'icon': '<?php echo TMM_Ext_Shortcodes::get_shortcode_icon($shortcode_key) ?>'});
			<?php endforeach; ?>

		<?php endif; ?>
			var tmm_ext_shortcodes_items_keys = /\[(<?php print join('|', array_keys(TMM_Ext_Shortcodes::$shortcodes)); ?>)\s?([^\]]*)(?:\s*\/)?\](([^\[\]]*)\[\/\1\])?/g;
			addLoadEvent(function() {
				jQuery('form#post').submit(function() {
					var c = this.content;
					//c.value = c.value.replace(/(\[[^\]]+\S)(\s+sc_id="sc\d+")([^\]]*\])/g, '$1$3');
				});
			});

			var tmm_ext_shortcodes_lang1 = "<?php _e('Shortcode updated', 'tmm_shortcodes') ?>";
			var tmm_ext_shortcodes_lang2 = "<?php _e('Insert Shortcode', 'tmm_shortcodes') ?>";
			var tmm_ext_shortcodes_lang3 = "<?php _e('Edit shortcode', 'tmm_shortcodes') ?>";

		</script>
		<?php
	}

	public static function draw_html($shortcode_key, $attributes = array()) {
		return self::render_html("views/" . self::get_shortcode_key_folder($shortcode_key) . "/" . $shortcode_key . ".php", $attributes);
	}

	public static function get_shortcode_icon($shortcode) {
		$icon_url = self::get_application_uri() . 'images/icons/' . $shortcode . '.png';
		if (file_exists(self::get_application_path() . 'images/icons/' . $shortcode . '.png')) {
			return $icon_url;
		}

		return self::get_application_uri() . 'images/icons/shortcode.png';
	}

	public static function get_shortcodes_array() {
		$results = array();
		foreach (self::$shortcodes_folders as $shortcode_folder) {
			$handler = opendir(self::get_application_path() . "views/" . $shortcode_folder . "/popups/");
			while ($file = readdir($handler)) {
				if ($file != "." AND $file != "..") {
					$results[] = $file;
				}
			}
			//***
			foreach ($results as $key => $value) {
				$value = explode(".", $value);
				if (!empty($value[0])) {
					$results[$key] = $value[0];
					self::$shortcodes_keys_by_folders[$shortcode_folder][] = $value[0];
				}
			}
			$results = array();
		}
		//***
		self::$shortcodes_keys_by_folders['axioma'][] = 'price_table';
		self::$shortcodes_keys_by_folders['default'][] = 'google_table_row';
		$results = array();
		if (!empty(self::$shortcodes_keys_by_folders)) {
			foreach (self::$shortcodes_keys_by_folders as $value) {
				$results = array_merge($results, $value);
			}
		}
		//***
		sort($results);
		return $results;
	}

	//*****************************


	public static function mce_buttons($buttons) {
		$buttons[] = 'tmm_shortcodes';
		$buttons[] = 'code';               
		return $buttons;
	}

	public static function mce_add_rich_plugins($plugin_array) {
		$plugin_array['tmm_tiny_shortcodes'] = self::get_application_uri() . '/js/editor.js';
		return $plugin_array;
	}

	//ajax
	public static function get_shortcode_template() {
		$data = array();
		if ($_REQUEST['mode'] == 'edit') {
			$_REQUEST['shortcode_mode_edit'] = array();
			$_REQUEST['shortcode_text'] = str_replace("\'", "'", $_REQUEST['shortcode_text']);
			$_REQUEST['shortcode_text'] = str_replace('\"', '"', $_REQUEST['shortcode_text']);
			do_shortcode($_REQUEST['shortcode_text']);
		}
		//***
		echo self::render_html('views/' . self::get_shortcode_key_folder($_REQUEST['shortcode_name']) . '/popups/' . $_REQUEST['shortcode_name'] . ".php", $data);
		exit;
	}

	public static function get_shortcode_key_folder($shortcode_key) {
		foreach (self::$shortcodes_keys_by_folders as $folder => $shortcodes_keys) {
			if (in_array($shortcode_key, $shortcodes_keys)) {
				return $folder;
			}
		}
	}

	//for inputs in shortcode popups
	public static function set_default_value($key, $default_value = '') {
		if (isset($_REQUEST["shortcode_mode_edit"]) AND !empty($_REQUEST["shortcode_mode_edit"])) {
			if (is_array($_REQUEST["shortcode_mode_edit"])) {
				if (isset($_REQUEST["shortcode_mode_edit"][$key])) {
					return $_REQUEST["shortcode_mode_edit"][$key];
				}
			}
		}

		return $default_value;
	}

	public static function render_html($pagepath, $data = array()) {
		$pagepath = self::get_application_path() . '/' . $pagepath;
		@extract($data);
		ob_start();
		include($pagepath);
		return ob_get_clean();
	}

	public static function draw_shortcode_option($data) {
		switch ($data['type']) {
			case 'textarea':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<textarea id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer data-area" data-shortcode-field="<?php echo $data['shortcode_field'] ?>"><?php echo $data['default_value'] ?></textarea>
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'select':
				if (!isset($data['display'])) {
					$data['display'] = 1;
				}
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<?php if (!empty($data['options'])): ?>
					<select <?php if ($data['display'] == 0): ?>style="display: none;"<?php endif; ?> class="js_shortcode_template_changer data-select <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>">

						<?php foreach ($data['options'] as $key => $text) : ?>
							<option <?php if ($data['default_value'] == $key) echo 'selected' ?> value="<?php echo $key ?>"><?php echo $text ?></option>
						<?php endforeach; ?>

					</select><br />
					<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php endif; ?>
				<?php
				break;
			case 'text':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<input type="text" value="<?php echo $data['default_value'] ?>" <?php if (isset($data['placeholder'])): ?>placeholder="<?php echo $data['placeholder'] ?>"<?php endif; ?> class="js_shortcode_template_changer data-input <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>" />
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'color':
				?>
				<div <?php if (@$data['display'] == 0): ?>style="display: none;"<?php endif; ?> class="list-item-color">
					<?php if (!empty($data['title'])): ?>
						<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
					<?php endif; ?>

					<input type="text" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" value="<?php echo $data['default_value'] ?>" class="bg_hex_color text small js_shortcode_template_changer <?php echo @$data['css_classes']; ?>" id="<?php echo $data['id'] ?>">
					<div style="background-color: <?php echo $data['default_value'] ?>" class="bgpicker"></div>
					<span class="preset_description"><?php echo $data['description'] ?></span>
				</div>
				<?php
				break;
			case 'upload':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<input type="text" id="<?php echo $data['id'] ?>" value="<?php echo $data['default_value'] ?>" class="js_shortcode_template_changer data-input data-upload <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
				<a title="" class="tmm_button_upload2 button-primary" href="#">
					<?php _e('Upload', 'tmm_shortcodes'); ?>
				</a>
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'checkbox':
				?>
				<div class="radio-holder">
					<input <?php if ($data['is_checked']): ?>checked=""<?php endif; ?> type="checkbox" value="<?php if ($data['is_checked']): ?>1<?php else: ?>0<?php endif; ?>" id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer js_shortcode_checkbox_self_update data-check" data-shortcode-field="<?php echo $data['shortcode_field'] ?>">
					<label for="<?php echo $data['id'] ?>"><span></span><i class="description"><?php if (!empty($data['title'])): ?><?php echo $data['title'] ?><?php endif; ?></i></label>
				</div><!--/ .radio-holder-->
				<?php
				break;
			case 'radio':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<div class="radio-holder">
					<input <?php if ($data['values'][0]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][0]['id'] ?>" value="<?php echo $data['values'][0]['value'] ?>" class="js_shortcode_radio_self_update" />
					<label for="<?php echo $data['values'][0]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][0]['title'] ?></label>

					<input <?php if ($data['values'][1]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][1]['id'] ?>" value="<?php echo $data['values'][1]['value'] ?>" class="js_shortcode_radio_self_update" />
					<label for="<?php echo $data['values'][1]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][1]['title'] ?></label>

					<input type="hidden" id="<?php echo @$data['hidden_id'] ?>" value="<?php echo $data['value'] ?>" class="js_shortcode_template_changer" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
				</div><!--/ .radio-holder-->
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
		}
	}

}

//*******

add_action('init', array('TMM_Ext_Shortcodes', 'register'), 1);
