<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />

<div class="custom-page-options">

	<p>
		<strong><?php _e('Another page title', 'axioma'); ?></strong>
	</p>

	<input type="text" name="another_page_title" value="<?php if (isset($another_page_title)) echo $another_page_title ?>" />

	<p>
		<strong><?php _e('Another page description', 'axioma'); ?></strong>
	</p>

	<textarea name="another_page_description"><?php if (isset($another_page_description)) echo $another_page_description ?></textarea>

	<p>
		<strong><?php _e('Hide page header', 'axioma'); ?></strong>
	</p>

	<div class="sel">
		<select name="headerbg_hide" class="headerbg_type_image_option">
			<?php
			$options = array(
				0 => __('No', 'axioma'),
				1 => __('Yes', 'axioma'),
			);

			if (!isset($headerbg_hide)) {
				$headerbg_hide = 0;
			}
			?>
			<?php foreach ($options as $key => $option) : ?>
				<option <?php echo($key == $headerbg_hide ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
			<?php endforeach; ?>
		</select>			
	</div>

	<p>
		<strong><?php _e('Align', 'axioma'); ?></strong>
	</p>

	<div class="sel">
		<select name="another_page_content_align" class="headerbg_type_image_option">
			<?php
			$options = array(
				"align-left" => __('Left', 'axioma'),
				"align-center" => __('Center', 'axioma'),
				"align-right" => __('Right', 'axioma'),
			);

			if (!$another_page_content_align) {
				$another_page_content_align = "align-left";
			}
			?>
			<?php foreach ($options as $key => $option) : ?>
				<option <?php echo($key == $another_page_content_align ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
			<?php endforeach; ?>
		</select>		
	</div>
</div>

<div class="custom-page-options">

	<ul id="headerbg_type_options">

		<li id="headerbg_type_image" style="display: block;">

			<p>
				<strong><?php _e('Page header image', 'axioma'); ?></strong>
			</p>		

			<p>
				<input type="text" value="<?php echo $headerbg_image; ?>" name="headerbg_image" class="headerbg_image" />
				<a href="#" class="button_upload body_pattern button" title=""><?php _e('Upload', 'axioma'); ?></a>
			</p>

			<div class="clear"></div>

			<p>
				<strong><?php _e('Background repeat', 'axioma'); ?></strong>
			</p>

			<div class="sel">
				<select name="headerbg_type_image_option" class="headerbg_type_image_option">
					<?php
					$options = array(
						"no-repeat" => "No Repeat",
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$headerbg_type_image_option) {
						$headerbg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $headerbg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>				
			</div>

			<p>
				<strong><?php _e('Background attachment', 'axioma'); ?></strong>
			</p>

			<div class="sel">
				<select name="headerbg_type_image_bg_cover" class="headerbg_type_image_bg_cover">
					<?php
					$options = array(
						"scroll" => __('Scroll', 'axioma'),
						"fixed" => __('Fixed', 'axioma'),
					);

					if (!isset($headerbg_type_image_bg_cover)) {
						$headerbg_type_image_bg_cover = "scroll";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $headerbg_type_image_bg_cover ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>				
			</div>

		</li>

		<li id="headerbg_type_color" style="display: block;">
			<p>
				<strong><?php _e('Background color', 'axioma'); ?></strong>
			</p>
			<input type="text" class="colorpicker_input headerbg_color" value="<?php echo $headerbg_color; ?>" name="headerbg_color" placeholder="#ffffff" />
		</li>

		<li>

			<h4><?php _e('Page header opacity', 'axioma'); ?></h4>
			<?php
			//***
			if (!isset($headerbg_opacity)) {
				$headerbg_opacity = 20;
			}
			//***
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'headerbg_opacity',
				'type' => 'slider',
				'description' => '',
				'default_value' => $headerbg_opacity,
				'min' => 0,
				'max' => 100,
			));
			?>

		</li>

	</ul>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class="body_pattern button headerbg_button_reset" title=""><?php _e('Reset', 'axioma'); ?></a></p>

	<div class="clear"></div>
</div>

<hr />

<div class="custom-page-options">
	<h4><?php _e('Page Background', 'axioma'); ?></h4>
	<div class="bg-type-option">
		<div class="sel">
			<select name="pagebg_type" class="pagebg_type">
				<?php
				$types = array(
					"default" => __("Default", 'axioma'),
					"color" => __("Color", 'axioma'),
					"image" => __("Image", 'axioma'),
				);

				if (!$pagebg_type) {
					$pagebg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $pagebg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<ul id="pagebg_type_options" style="margin: 0; padding: 0;">

		<li id="pagebg_type_image" style="display: none;">
			<p>
				<input type="text" value="<?php echo $pagebg_image; ?>" name="pagebg_image" class="pagebg_image" />&nbsp;
				<a href="#" class="button_upload body_pattern button" title=""><?php _e('Upload', 'axioma'); ?></a>
			</p>

			<div class="clear"></div>

			<label><?php _e('Set options', 'axioma'); ?>:</label>
			<div class="sel right">
				<select name="pagebg_type_image_option" class="pagebg_type_image_option">
					<?php
					$options = array(
						"no-repeat" => "No Repeat",
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$pagebg_type_image_option) {
						$pagebg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $pagebg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</li>

		<li id="pagebg_type_color" style="display: none;">
			<p><input type="text" class="colorpicker_input pagebg_color" value="<?php echo $pagebg_color; ?>" name="pagebg_color" placeholder="#ffffff" /></p>
		</li>
	</ul>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class="body_pattern button button_reset" title=""><?php _e('Reset', 'axioma'); ?></a></p>

	<div class="clear"></div>
</div>

<hr>

<h4><?php _e('Page Sidebar Position', 'axioma'); ?></h4>
<input type="hidden" value="<?php echo (!$page_sidebar_position ? "sbr" : $page_sidebar_position) ?>" name="page_sidebar_position" />

<ul class="admin-page-choice-sidebar clearfix">
	<li class="lside <?php echo ($page_sidebar_position == "sbl" ? "current-item" : "") ?>"><a href="sbl" data-val="sbl"><?php _e('Left Sidebar', 'axioma'); ?></a></li>
	<li class="wside <?php echo ($page_sidebar_position == "no_sidebar" ? "current-item" : "") ?>"><a href="no_sidebar" data-val="no_sidebar"><?php _e('Without Sidebar', 'axioma'); ?></a></li>
	<li class="rside <?php echo ($page_sidebar_position == "sbr" ? "current-item" : "") ?>"><a href="sbr" data-val="sbr"><?php _e('Right Sidebar', 'axioma'); ?></a></li>
</ul>
<div class="clear"></div>

<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery("#pagebg_type_<?php echo $pagebg_type; ?>").show();

		jQuery("[name=pagebg_type]").change(function() {
			jQuery("#pagebg_type_options li").hide(200);
			jQuery("#pagebg_type_" + jQuery(this).val()).show(400);
		});

		jQuery('.button_reset').life('click', function()
		{
			jQuery("#pagebg_type_options input").val("");
			jQuery("#pagebg_type_options select").val(0);
			return false;
		});

		//*****
		/*
		 jQuery("#headerbg_type_<?php echo $headerbg_type; ?>").show();
		 
		 jQuery("[name=headerbg_type]").change(function() {
		 jQuery("#headerbg_type_options li").hide(200);
		 jQuery("#headerbg_type_" + jQuery(this).val()).show(400);
		 });
		 */

		jQuery('.headerbg_button_reset').life('click', function()
		{
			jQuery("#headerbg_type_options input").val("");
			jQuery("#headerbg_type_options select").val(0);
			return false;
		});


	});
</script>