<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Buttons Text', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', ''),
			'description' => ''
		));
		?>
	</div><!--/ .one-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('URL', 'tmm_shortcodes'),
			'shortcode_field' => 'url',
			'id' => 'url',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('url', ''),
			'description' => __('http://forums.webtemplatemasters.com/', 'tmm_shortcodes')
		));
		?>
	</div><!--/ .one-half-->

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Color', 'tmm_shortcodes'),
			'shortcode_field' => 'color',
			'id' => 'color',
			'options' => TMM_OptionsHelper::get_theme_buttons(),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('color', ''),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Size', 'tmm_shortcodes'),
			'shortcode_field' => 'size',
			'id' => 'size',
			'options' => TMM_OptionsHelper::get_theme_buttons_sizes(),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('size', ''),
			'description' => ''
		));
		?>	

	</div><!--/ .one-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Top Indent', 'tmm_shortcodes'),
			'shortcode_field' => 'top_indent',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('top_indent', ''),
			'description' => ''
		));
		?>	

	</div><!--/ .one-half-->

</div><!--/ .tmm_shortcode_template->


<!-- --------------------------  PROCESSOR  --------------------------- -->

<script type="text/javascript">
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";

	jQuery(function() {
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});
		
		selectwrap();
		
	});
</script>


