<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<link rel="stylesheet" href="<?php echo TMM_THEME_URI; ?>/css/font-awesome.css" type="text/css" media="all" />
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="fullwidth">

		<?php
		$value_type = TMM_Ext_Shortcodes::set_default_value('type', 0);

		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'radio',
			'title' => __('Type', 'tmm_shortcodes'),
			'shortcode_field' => 'type',
			'id' => 'type',
			'name' => 'type',
			'values' => array(
				0 => array(
					'title' => __('Normal', 'tmm_shortcodes'),
					'id' => 'type_normal',
					'value' => 0,
					'checked' => ($value_type == 0 ? 1 : 0)
				),
				1 => array(
					'title' => __('Colorized', 'tmm_shortcodes'),
					'id' => 'type_colorized',
					'value' => 1,
					'checked' => ($value_type == 1 ? 1 : 0)
				)
			),
			'value' => $value_type,
			'description' => '',
			'hidden_id' => 'list_type'
		));
		?>

		<br />

		<?php
		$type_array = array(
			'icon-laptop' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-laptop',
			'icon-search' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-search',
			'icon-wrench' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-wrench',
			'icon-leaf' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-leaf',
			'icon-cogs' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-cogs',
			'icon-group' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-group',
			'icon-comments-alt' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-comments-alt',
			'icon-folder-close' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-folder-close',
			'icon-cloud' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-cloud',
			'icon-briefcase' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-briefcase',
			'icon-beaker' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-beaker',
			'icon-bullhorn' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-bullhorn',
			'icon-comment' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-comment',
			'icon-globe' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-globe',
			'icon-heart' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-heart',
			'icon-rocket' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-rocket',
			'icon-suitcase' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-suitcase',
			'icon-pencil' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-pencil',
			'icon-folder-open' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-folder-open',
			'icon-cog' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-cog',
			'icon-coffee' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-coffee',
			'icon-gift' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-gift',
			'icon-home' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-home',
			'icon-lightbulb' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-lightbulb',
			'icon-thumbs-up' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-thumbs-up',
			'icon-umbrella' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-umbrella',
			'icon-random' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-random',
			'icon-th-list' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-th-list',
			'icon-resize-small' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-resize-small',
			'icon-download-alt' => __('Type', 'tmm_shortcodes') . ': ' . 'icon-download-alt'
		);
		?>

		<h4 class="label"><?php _e('Blocks', 'tmm_shortcodes'); ?></h4>
		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />
		<ul id="list_items" class="list-items">
			<?php
			$content_edit_data = array('');
			$links_edit_data = array('#');
			$titles_edit_data = array('');
			$icons_edit_data = array(key($type_array));
			$list_item_color = array('');
			if (isset($_REQUEST["shortcode_mode_edit"])) {
				$content_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['content']);
				$links_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['links']);
				$titles_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['titles']);
				$icons_edit_data = explode(',', $_REQUEST["shortcode_mode_edit"]['icons']);
				$list_item_color = explode(',', $_REQUEST["shortcode_mode_edit"]['colors']);
			}
			?>

			<?php foreach ($content_edit_data as $key => $content_edit_text) : ?>
				<li class="list_item">
					<table class="list-table">
						<tr>
							<td>
								<i class="ca-icon <?php echo $icons_edit_data[$key] ?>"></i>
							</td>
							<td>
								<?php
								TMM_Ext_Shortcodes::draw_shortcode_option(array(
									'type' => 'select',
									'title' => '',
									'shortcode_field' => 'list_item_icon',
									'id' => '',
									'options' => $type_array,
									'default_value' => $icons_edit_data[$key],
									'description' => '',
									'css_classes' => 'list_item_icon'
								));
								?>
								
								<?php
								TMM_Ext_Shortcodes::draw_shortcode_option(array(
									'title' => __('Background Color', 'tmm_shortcodes'),
									'shortcode_field' => 'list_item_color',
									'type' => 'color',
									'description' => '',
									'default_value' => $list_item_color[$key],
									'id' => '',
									'css_classes' => 'list_item_color',
									'display' => $value_type == 1 ? 1 : 0
								));
								?>					
							</td>
							<td style="width: 100%;">							

								<h5 class="label"><?php _e('Title', 'tmm_shortcodes'); ?></h5>
								<input type="text" value="<?php echo $titles_edit_data[$key] ?>" class="list_item_title js_shortcode_template_changer data-input" style="width: 100%;" /><br />

								<h5 class="label"><?php _e('Link', 'tmm_shortcodes'); ?></h5>
								<input type="text" value="<?php echo $links_edit_data[$key] ?>" class="list_item_link js_shortcode_template_changer data-input" style="width: 100%;" /><br />

								<h5 class="label"><?php _e('Content', 'tmm_shortcodes'); ?></h5>
								<textarea class="list_item_content js_shortcode_template_changer data-area" style="width: 100%; min-height: 50px;"><?php echo $content_edit_text ?></textarea>
							</td>
							<td>
								<a class="button button-secondary js_delete_list_item js_shortcode_template_changer" href="#"><?php _e('Remove', 'tmm_shortcodes'); ?></a>
							</td>
							<td><div class="row-mover"></div></td>
						</tr>
					</table>


				</li>

			<?php endforeach; ?>

		</ul>
		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />

	</div><!--/ .fullwidth-->

</div>


<!-- --------------------------  PROCESSOR  --------------------------- -->

<script type="text/javascript">
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";

	jQuery(function() {
		
		colorizator();
		
		jQuery("#list_items").sortable({
			stop: function(event, ui) {
				tmm_ext_shortcodes.services_changer(shortcode_name);
			}
		});


		//***
		tmm_ext_shortcodes.services_changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});


		//*****
		jQuery("#type_colorized").life('click',function() {
			jQuery(".list-item-color").show(200);
			jQuery("#list_type").val(1);
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});

		jQuery("#type_normal").life('click', function() {
			jQuery(".list-item-color").hide(200);
			jQuery("#list_type").val(0);
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});

		jQuery(".js_add_list_item").life('click', function() {
			var clone = jQuery(".list_item:last").clone(false);
			var last_row = jQuery(".list_item:last");
			jQuery(clone).insertAfter(last_row, clone);
			jQuery(".list_item:last").find('input[type=text]').val("");
			//***
			var icon_class = jQuery(".list_item:first").find('select').val();
			jQuery(".list_item:last").find('select').val(icon_class);
			tmm_ext_shortcodes.services_changer(shortcode_name);
			colorizator();
			return false;
		});

		jQuery(".js_delete_list_item").life('click',function() {
			if (jQuery(".list_item").length > 1) {
				jQuery(this).parents('li').hide(200, function() {
					jQuery(this).remove();
				});
			}
			tmm_ext_shortcodes.services_changer(shortcode_name);
			return false;
		});

		jQuery(".list_item_icon").life('change', function() {
			jQuery(this).parents('li').find('i').removeAttr('class').addClass(jQuery(this).val());
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});
		
		selectwrap();

	});
</script>
