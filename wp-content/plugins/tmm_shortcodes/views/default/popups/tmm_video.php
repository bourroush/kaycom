<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Type', 'tmm_shortcodes'),
			'shortcode_field' => 'type',
			'id' => 'type',
			'options' => array(
				'youtube' => 'Youtube',
				'vimeo' => 'Vimeo',
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('type', 'youtube'),
			'description' => ''
		));
		?>
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Full Width Youtube', 'tmm_shortcodes'),
			'shortcode_field' => 'full_width',
			'id' => 'full_width',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('full_width', 0),
			'description' => ''
		));
		?>	

	</div>

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Youtube or Vimeo link', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', ''),
			'description' => __('Examples:https://www.youtube.com/watch?v=_EBYf3lYSEg or http://vimeo.com/22439234', 'tmm_shortcodes')
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Width', 'tmm_shortcodes'),
			'shortcode_field' => 'width',
			'id' => 'width',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('width', ''),
			'description' => ''
		));
		?>

	</div>

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Height', 'tmm_shortcodes'),
			'shortcode_field' => 'height',
			'id' => 'height',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('height', ''),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->

</div>

<!-- --------------------------  PROCESSOR  --------------------------- -->
<script type="text/javascript">
	
	
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";
	jQuery(function() {
		
		var $type = jQuery('#type'),
			$input = jQuery('#width'),
			$checkbox = jQuery('#full_width');

		var checkType = function(type) {
			var $radio = jQuery('.radio-holder');
			if (type.children(':selected').val() == 'youtube') {
				$radio.slideDown(200);
				checkFullWidth($checkbox);
			} else {
				$input.prop({
					"disabled": false
				}).css('background-color', '#fff');	
				$radio.slideUp(200);
			}
		};
		
		var checkFullWidth = function (checkbox) {
			if (checkbox.is(':checked')) {
				$input.val('').prop({
					"disabled": true
				}).css('background-color', '#eee');
			} else {
				$input.prop({
					"disabled": false
				}).css('background-color', '#fff');
			}
		};
		
		$type.on('change', function() { checkType(jQuery(this)); });
		$checkbox.on('click', function () { checkFullWidth(jQuery(this)); });
		
		checkType($type);
		checkFullWidth($checkbox);
		
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});
		
		selectwrap();
		
	});
	
	
</script>

