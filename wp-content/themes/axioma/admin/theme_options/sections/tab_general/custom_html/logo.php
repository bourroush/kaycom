<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$google_fonts = TMM_HelperFonts::get_google_fonts();
$content_fonts = TMM_HelperFonts::get_content_fonts();
$fonts = array_merge($content_fonts, $google_fonts);
$fonts = array_merge(array("" => ""), $fonts);
?>

<div class="option option-radio">
	
	<div class="controls">
		<input id="logoimage" type="radio" class="showhide" data-show-hide="logo_img" name="logo_type" value="1" <?php echo(TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logoimage"><span></span><?php _e('Image', 'axioma'); ?></label>&nbsp; &nbsp;
		<input id="logotext" type="radio" class="showhide" data-show-hide="logo_text" name="logo_type" value="0" <?php echo(!TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logotext"><span></span><?php _e('Text', 'axioma'); ?></label>
	</div><!--/ .controls-->
	
	<div class="explain"></div>
	
</div><!--/ .option-->	

<ul class="show-hide-items">

	<li class="logo_img" <?php echo (TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_img',
			'type' => 'upload',
			'default_value' => '',
			'description' => __('Upload your logo image here. Recommended dimensions: width <= 300px, height = any. Recommended image types: png, gif, jpg.', 'axioma'),
			'id' => '',
		));
		?>

		<?php $logo_img = TMM::get_option('logo_img') ?>
		<div class="optional">
			<img id="logo_preview_image" style="display: <?php if ($logo_img): ?>inline<?php else: ?>none<?php endif; ?>; max-width:300px;" src="<?php echo $logo_img ?>" alt="logo" />
		</div>
		
	</li>
	<li class="logo_text" <?php echo(!TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text',
			'title'=>__('Logo Name', 'axioma'),
			'type' => 'text',
			'description' => __('Type your website name here, it will appear instead of your Logo in text format.', 'axioma'),
			'default_value' => '',
			'css_class' => '',
		));
		?>
		
		<?php
		$logo_font_size = array();
		for ($i = 20; $i < 60; $i++) {
			$logo_font_size[$i] = $i;
		}
		
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font_size',
			'type' => 'select',
			'title'=> __('Logo Font Size', 'axioma'),
			'description' => '',
			'values' => $logo_font_size,
			'default_value' => 30,
			'css_class' => '',
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font',
			'title' => __('Logo Font Family', 'axioma'),
			'type' => 'google_font_select',
			'default_value' => 'Open Sans',
			'fonts' => $fonts,
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text_color',
			'title'=>__('Logo Text Color', 'axioma'),
			'type' => 'color',
			'default_value' => '#232323',
			'description' => __('Logo text color for text logo only. Do not edit this field to use default theme styling.', 'axioma'),
			'css_class' => '',
		));
		?>
	</li>
</ul>
