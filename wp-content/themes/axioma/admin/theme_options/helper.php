<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_OptionsHelper {

	public static $sections = array();
	public static $google_fonts = array(
		"Open Sans:300,400,400italic,600,700"
	);
	public static $content_fonts = array(
		"Arial" => "Arial",
		"Tahoma" => "Tahoma",
		"Verdana" => "Verdana",
		"Calibri" => "Calibri"
	);

	/*
	 * Drawing theme option for admin panel
	 */

	public static function draw_theme_option($data, $prefix = TMM_THEME_PREFIX) {
		$value = "";
		//sometimes I have value or cant get in by TMM::get_option
		if (isset($data['value'])) {
			$value = $data['value'];
		} else {
			$value = TMM::get_option($data['name'], $prefix);
		}

		if (empty($value) && '0' != $value) {
			$value = @$data['default_value'];
		}

		switch ($data['type']) {
			case 'slider':
				?>
				<div class="option option-slider">
					
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" type="text" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>" min-value="<?php echo $data['min'] ?>" max-value="<?php echo $data['max'] ?>" class="ui_slider_item" />
					</div>
					
					<div class="explain"><?php echo $data['description'] ?></div>
					
				</div>
				<?php
				break;
			case 'text':
				?>
				<div class="option option-text">
					
					<h4 class="option-title"><?php echo $data['title']; ?></h4>
					
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" type="text" class="<?php echo @$data['css_class'] ?>" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
					</div><!--/ .controls-->
					
					<div class="explain"><?php echo $data['description'] ?></div>
					
				</div>
				<?php
				break;
			case 'textarea':
				?>
				<div class="option option-textarea">
					
					<textarea data-default-value="<?php echo @$data['default_value'] ?>" name="<?php echo $data['name'] ?>" class="<?php echo $data['css_class'] ?>"><?php echo $value ?></textarea>
					
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
					
				</div>
				<?php
				break;
			case 'select':
				?>
				<div class="option option-select">
		
					<h4 class="option-title"><?php echo $data['title']; ?></h4>
					
					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo @$data['default_value'] ?>" name="<?php echo $data['name'] ?>" class="<?php echo $data['css_class'] ?>">
								<?php if (!empty($data['values'])): ?>
									<?php foreach ($data['values'] as $key => $option_text) : ?>
										<option value="<?php echo $key ?>" <?php echo($value == $key ? 'selected=""' : "") ?>><?php echo $option_text ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>							
						</label>
					</div>

					<div class="explain"><?php echo $data['description'] ?></div>

				</div>
				<?php
				break;
			case 'checkbox':
				?>
				<div class="option option-checkbox">
					
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" type="hidden" value="<?php echo($value == 1 ? "1" : "0") ?>" name="<?php echo $data['name'] ?>">
						<input type="checkbox" id="<?php echo $data['name'] ?>" class="option_checkbox <?php echo $data['css_class'] ?>" <?php echo($value == 1 ? "checked" : "") ?> />
						<label for="<?php echo $data['name'] ?>"><span></span><?php echo $data['title'] ?></label>
					</div>
					
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
					
				</div>
				<?php
				break;
			case 'color':
				?>
				<div class="option option-color">
					
					<h4 class="option-title"><?php echo @$data['title'] ?></h4>

					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" value-index="0" type="text" class="bg_hex_color text small <?php echo @$data['css_class'] ?>" value="<?php echo $value ?>" name="<?php echo $data['name'] ?>">
						<div class="bgpicker" style="background-color: <?php echo $value ?>"></div>

						<?php if (@$_GET['page'] == 'tmm_theme_options'): ?>
							<a href="javascript:void(0);" class="js_picker_val_back" title="Back">back</a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_ahead" title="Forward">forward</a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_reset" title="Reset">reset</a>
						<?php endif; ?>
					</div>

					<div class="explain"><?php echo $data['description'] ?></div>

				</div>
				<?php
				break;

			case 'google_font_select':
				$google_fonts = TMM_HelperFonts::get_google_fonts();
				$content_fonts = TMM_HelperFonts::get_content_fonts();
				$fonts = array_merge($content_fonts, $google_fonts);
				$fonts = array_merge(array("" => ""), $fonts);
				?>
				<div class="option option-select-browse">
					
					<h4 class="option-title"><?php echo $data['title'] ?></h4>
					
					<div class="controls">
						<label class="sel">
							<select data-default-value="" name="<?php echo $data['name'] ?>" class="google_font_select">
								<?php foreach ($fonts as $font_name) : ?>
									<?php
									$font_clean_name = explode(":", $font_name);
									$font_clean_name = $font_clean_name[0];
									?>
									<option <?php echo ($font_clean_name == $value ? "selected" : "") ?> value="<?php echo $font_clean_name; ?>"><?php echo $font_name; ?></option>
								<?php endforeach; ?>
							</select>
						</label>
						<a title="" class="admin-button button-gray button-medium" href="javascript:add_google_font();void(0);"><?php _e('Browse', 'axioma'); ?></a>
					</div>
					
					<div class="explain"><?php echo $data['description'] ?></div>
					
				</div>

				<?php
				break;

			case 'upload':
				?>
				<div class="option option-upload">
					
					<div class="controls">
						<input data-default-value="" <?php if (isset($data['id'])): ?>id="<?php echo $data['id'] ?>"<?php endif; ?> class="middle" type="text" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
						<a class="admin-button button_upload" href="#"><?php _e('Browse', 'axioma'); ?></a>
					</div>
					
					<div class="explain"><?php echo $data['description'] ?></div>
					
				</div>
				<?php
				break;

			default:
				_e('Option type does not exist!', 'axioma');
				break;
		}
		?>
		<?php if (isset($data['is_reset'])): ?>
			<script type="text/javascript">
				tmm_options_reset_array.push("<?php echo $data['name'] ?>");
			</script>
		<?php endif; ?>
		<?php
	}

	public static function get_theme_buttons() {
		return array(
			'default' => __('Default', 'axioma'),
			'black' => __('Black', 'axioma'),
			'bordered' => __('Bordered', 'axioma'),
		);
	}

	public static function get_theme_buttons_sizes() {
		return array(
			'small' => __('Small', 'axioma'),
			'medium' => __('Medium', 'axioma'),
			'large' => __('Large', 'axioma'),
		);
	}

	public static function get_contacts_placeholder_icons() {
		return array(
			'' => "",
			'message-form-name' => __('Name', 'axioma'),
			'message-form-email' => __('Email', 'axioma'),
			'message-form-url' => __('URL', 'axioma'),
			'message-form-message' => __('Message', 'axioma')
		);
	}

}
