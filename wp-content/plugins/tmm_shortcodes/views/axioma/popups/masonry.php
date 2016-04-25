<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Layout', 'tmm_shortcodes'),
			'shortcode_field' => 'columns',
			'id' => '',
			'options' => array(
				3 => __('3 Columns', 'tmm_shortcodes'),
				4 => __('4 Columns', 'tmm_shortcodes'),
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('columns', 3),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">

		<?php
		$col_algorims_ids = array(
			1 => __('Algoritm 1', 'tmm_shortcodes'),
			2 => __('Algoritm 2', 'tmm_shortcodes'),
		);
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Image Sizes', 'tmm_shortcodes'),
			'shortcode_field' => 'col_alg',
			'id' => '',
			'options' => $col_algorims_ids,
			'default_value' => TMM_Ext_Shortcodes::set_default_value('col_alg', 1),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->


	<div class="fullwidth">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Type', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'options' => array(
				1 => __('Type 1', 'tmm_shortcodes'),
				2 => __('Type 2', 'tmm_shortcodes'),
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', 1),
			'description' => __('Type 1 - show images of selected portfolios, Type 2 - show covers of selected portfolios', 'tmm_shortcodes')
		));
		?>

	</div><!--/ .fullwidth"-->


	<div class="fullwidth">

		<?php
		$posts = get_posts(array('post_type' => TMM_Portfolio::$slug, 'posts_per_page'=>-1));
		$posts_array = array();
		if (!empty($posts)) {
			foreach ($posts as $value) {
				$posts_array[$value->ID] = $value->post_title;
			}
		}
		
		//***
		$albums_edit_data = array('');
		if (isset($_REQUEST["shortcode_mode_edit"])) {
			if (isset($_REQUEST["shortcode_mode_edit"]['folioposts'])) {
				$albums_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['folioposts']);
			} else {
				$albums_edit_data = array('0');
			}
		}
		?>


		<h4 class="label"><?php _e('Galleries', 'tmm_shortcodes'); ?></h4>
		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add gallery item', 'tmm_shortcodes'); ?></a><br />

		<ul id="list_items" class="list-items">
			<?php foreach ($albums_edit_data as $album_id) : ?>
				<li class="list_item">
					<table class="list-table">
						<tr>
							<td width="100%">
								<?php
								TMM_Ext_Shortcodes::draw_shortcode_option(array(
									'type' => 'select',
									'title' => '',
									'shortcode_field' => 'folioposts',
									'id' => '',
									'options' => $posts_array,
									'css_classes' => 'list_item_style save_as_one js_shortcode_template_changer',
									'default_value' => $album_id,
									'description' => ''
								));
								?>
							</td>
							<td>
								<a class="button button-secondary js_delete_list_item" href="#"><?php _e('Remove', 'tmm_shortcodes'); ?></a>
							</td>
							<td><div class="row-mover"></div></td>
						</tr>
					</table>
				</li>
			<?php endforeach; ?>

		</ul>

		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add gallery item', 'tmm_shortcodes'); ?></a><br />


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
		//***
		jQuery("#list_items").sortable({
			stop: function(event, ui) {
				tmm_ext_shortcodes.changer(shortcode_name);
			}
		});

		jQuery(".js_add_list_item").click(function() {
			var clone = jQuery(".list_item:last").clone(true);
			var last_row = jQuery(".list_item:last");
			jQuery(clone).insertAfter(last_row, clone);
			tmm_ext_shortcodes.changer(shortcode_name);
			return false;
		});

		jQuery(".js_delete_list_item").life('click',function() {
			if (jQuery(".list_item").length > 1) {
				jQuery(this).parents('li').hide(200, function() {
					jQuery(this).remove();
					tmm_ext_shortcodes.changer(shortcode_name);
				});
			}

			return false;
		});
		
		selectwrap();
	});

</script>

