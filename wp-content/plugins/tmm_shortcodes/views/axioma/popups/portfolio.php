<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Layout', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'options' => array(
				2 => __('2 Columns', 'tmm_shortcodes'),
				3 => __('3 Columns', 'tmm_shortcodes'),
				4 => __('4 Columns', 'tmm_shortcodes'),
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', 1),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Posts per page', 'tmm_shortcodes'),
			'shortcode_field' => 'posts_per_page',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('posts_per_page', 6),
			'description' => __('Posts per page', 'tmm_shortcodes'),
		));
		?>

	</div><!--/ .one-half-->
	
	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Show categories', 'tmm_shortcodes'),
			'shortcode_field' => 'show_categories',
			'id' => '',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('show_categories', 1),
			'description' => __('Show/Hide Categories', 'tmm_shortcodes')
		));
		?>

	</div>

</div>


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
