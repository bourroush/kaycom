<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="fullwidth">

		<?php
		$social_types_array = array(
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'dribbble' => 'Dribbble',
			'vimeo' => 'Vimeo',
			'youtube' => 'Youtube',
			'rss' => 'Rss',
			'skype' => 'Skype',
			'email' => 'Email',
			'picasa' => 'Picasa',
			'stubleupon' => 'Stubleupon',
			'dropbox' => 'Dropbox',
			'cat' => 'Cat',
			'linkedin' => 'Linkedin',
			'plus' => 'Plus',
			'pinterest' => 'Pinterest',
			'blogger' => 'Blogger',
			'flickr' => 'Flickr',
			'delicious' => 'Delicious',
			'yahoo' => 'Yahoo',
			'evernote' => 'Evernote',
			'apple' => 'Apple',
			'behance' => 'Behance',
			'gplus' => 'Google plus',
			'digg' => 'Digg',
			'lastfm' => 'Lastfm',
			'myspace' => 'Myspace',
			'deviantart' => 'Deviantart',
			'wordpress' => 'Wordpress'
		);
		
		$social_types = array('facebook');
		$links = array('#');
		if (isset($_REQUEST["shortcode_mode_edit"])) {
			if (isset($_REQUEST["shortcode_mode_edit"]['social_types'])) {
				$social_types = explode('^', $_REQUEST["shortcode_mode_edit"]['social_types']);
				$links = explode('^', $_REQUEST["shortcode_mode_edit"]['links']);
			}
		}
		?>

		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />

		<ul id="list_items" class="list-items">
			<?php foreach ($social_types as $key => $type) : ?>
				<li class="list_item">
					<table class="list-table">
						<tr>
							<td width="30%">
								<?php
								TMM_Ext_Shortcodes::draw_shortcode_option(array(
									'type' => 'select',
									'title' => '',
									'shortcode_field' => 'social_types',
									'id' => '',
									'options' => $social_types_array,
									'default_value' => $type,
									'description' => '',
									'css_classes' => 'list_item_style save_as_one'
								));
								?>
							</td>							
							<td width="70%">
								<?php
								TMM_Ext_Shortcodes::draw_shortcode_option(array(
									'type' => 'text',
									'title' => '',
									'shortcode_field' => 'links',
									'id' => '',
									'css_classes' => 'list_item_style save_as_one',
									'default_value' => $links[$key],
									'description' => '',
									'placeholder' => __('http://', 'tmm_shortcodes')
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

		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />

	</div>

</div>



<!-- --------------------------  PROCESSOR  --------------------------- -->
<script type="text/javascript">

	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";
	jQuery(function() {
		
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
			colorizator();
		});
		colorizator();
		//***
		jQuery("#list_items").sortable({
			stop: function(event, ui) {
				tmm_ext_shortcodes.changer(shortcode_name);
			}
		});

		jQuery(".js_add_list_item").life('click',function() {
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

