<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Type', 'tmm_shortcodes'),
			'shortcode_field' => 'type',
			'id' => '',
			'options' => array(
				'type-2' => 'Type 2',
				'type-1' => 'Type 1'
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('type', ''),
			'description' => '( Type 1 Recommended to use on dark background )'
		));
		?>
	</div>	

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Align', 'tmm_shortcodes'),
			'shortcode_field' => 'align',
			'id' => '',
			'options' => array(
				'align-left' => 'Left',
				'align-right' => 'Right',
				'align-center' => 'Center'
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('align', 'left'),
			'description' => ''
		));
		?>
	</div>


    <div class="one-half">

		<?php
		$show = TMM_Ext_Shortcodes::set_default_value('show', 'mode1');

		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Show', 'tmm_shortcodes'),
			'shortcode_field' => 'show',
			'id' => 'show_testimonial_value',
			'options' => array(
				'mode1' => __('Show selected testimonial', 'tmm_shortcodes'),
				'mode2' => __('Show random testimonial', 'tmm_shortcodes'),
				'mode3' => __('Show latest testimonial', 'tmm_shortcodes'),
			),
			'default_value' => $show,
			'description' => ''
		));
		?>

		<?php
		$tt = get_posts(array('numberposts' => -1, 'post_type' => TMM_Testimonials::$slug));
		$testimonials = array();
		if (!empty($tt)) {
			foreach ($tt as $value) {
				$testimonials[$value->ID] = $value->post_title . ". " . substr(strip_tags($value->post_content), 0, 90) . " ...";
			}
		}
		?>
		<div class="content_select" style="display: <?php if ($show == 'mode2' OR $show == 'mode3'): ?>none<?php else: ?>inline-block<?php endif; ?>;">
			<?php
			TMM_Ext_Shortcodes::draw_shortcode_option(array(
				'type' => 'select',
				'title' => __('Testimonials', 'tmm_shortcodes'),
				'options' => $testimonials,
				'shortcode_field' => 'content',
				'id' => '',
				'default_value' => TMM_Ext_Shortcodes::set_default_value('content', ''),
				'description' => ''
			));
			?>
		</div>

    </div><!--/ .ona-half-->

	<div class="one-half testimonial_count" style="display: <?php if ($show == 'mode2' OR $show == 'mode3'): ?>inline-block<?php else: ?>none<?php endif; ?>;">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Timeout', 'tmm_shortcodes'),
			'shortcode_field' => 'timeout',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('timeout', 3000),
			'description' => ''
		));
		?>

	</div><!--/ .ona-half-->

	<div class="one-half testimonial_count" style="display: <?php if ($show == 'mode2' OR $show == 'mode3'): ?>inline-block<?php else: ?>none<?php endif; ?>;">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Count', 'tmm_shortcodes'),
			'shortcode_field' => 'count',
			'id' => '',
			'options' => array(
				-1 => __('All', 'tmm_shortcodes'),
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('count', -1),
			'description' => ''
		));
		?>
	</div>

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Show photo', 'tmm_shortcodes'),
			'shortcode_field' => 'show_photo',
			'id' => 'show_photo',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('show_photo', 1),
			'description' => __('Show/Hide Photo', 'tmm_shortcodes')
		));
		?>

	</div>


</div><!--/ .tmm_shortcode_template->

<!-- --------------------------  PROCESSOR  --------------------------- -->
<script type="text/javascript">
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";
	jQuery(function() {
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});

		//***

		jQuery("#show_testimonial_value").change(function() {
			var val = jQuery(this).val();
			tmm_ext_shortcodes.changer(shortcode_name);

			switch (val) {
				case 'mode1':
					jQuery(".testimonial_count").hide(200);
					jQuery(".content_select").show(200);
					break;
				case 'mode2':
				case 'mode3':
					jQuery(".testimonial_count").show(200);
					jQuery(".content_select").hide(200);
					break;
			}


			return true;
		});
		
		selectwrap();

	});
</script>