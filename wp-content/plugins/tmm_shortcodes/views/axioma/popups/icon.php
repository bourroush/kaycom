<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<link rel="stylesheet" href="<?php echo TMM_THEME_URI; ?>/css/font-awesome.css" type="text/css" media="all" />
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Title', 'tmm_shortcodes'),
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
			'type' => 'select',
			'title' => __('Type', 'tmm_shortcodes'),
			'shortcode_field' => 'type',
			'id' => 'type',
			'options' => array(
				'span' => __('span', 'tmm_shortcodes'),
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('type', 'span'),
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
			'description' => __('Example: http://forums.webtemplatemasters.com/', 'tmm_shortcodes')
		));
		?>
	</div><!--/ .one-half-->

	<div class="one-half">

		<?php

		$icon_css_class = TMM_Ext_Shortcodes::set_default_value('icon_css_class', 'icon-html5');
		?>	

		<input type="hidden" class="js_shortcode_template_changer" data-shortcode-field="icon_css_class" id="chooced_icon_type" value="<?php echo $icon_css_class ?>" />

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Font Weight', 'tmm_shortcodes'),
			'shortcode_field' => 'font_weight',
			'id' => 'font_weight',
			'options' => array(
				'normal' => __('Normal', 'tmm_shortcodes'),
				'200' => 200,
				'400' => 400,
				'600' => 600,
				'800' => 800,
				'bold' => __('Bold', 'tmm_shortcodes'),
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('font_weight', 'normal'),
			'description' => ''
		));
		?>		
		
	</div><!--/ .one-half-->
	
	<div class="one-half">
		
		<?php
		$icon_groups = array(
			'New_Icons' => __('New Icons', 'tmm_shortcodes'),
			'Web_Application_Icons' => __('Web Application Icons', 'tmm_shortcodes'),
			'Text_Editor_Icons' => __('Text Editor Icons', 'tmm_shortcodes'),
			'Directional_Icons' => __('Directional Icons', 'tmm_shortcodes'),
			'Video_Player_Icons' => __('Video Player Icons', 'tmm_shortcodes'),
			'Brand_Icons' => __('Brand Icons', 'tmm_shortcodes'),
			'Medical_Icons' => __('Medical Icons', 'tmm_shortcodes'),
		);

		$view_icon_group = TMM_Ext_Shortcodes::set_default_value('view_icon_group', 'New_Icons');
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('View icon group', 'tmm_shortcodes'),
			'shortcode_field' => 'view_icon_group',
			'id' => 'view_icon_group',
			'options' => $icon_groups,
			'default_value' => $view_icon_group,
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'title' => __('Color', 'tmm_shortcodes'),
			'shortcode_field' => 'icon_bg_color',
			'type' => 'color',
			'description' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('icon_bg_color', '#5ac1ca'),
			'id' => '',
			'display' => 1
		));
		?>

	</div><!--/ .one-half-->

	<div class="one-half">
		
		<?php 
		$icons_style = array(
			'circle-pic' => __('Circle Style', 'tmm_shortcodes'),
			'small-circle-pic' => __('Small Circle Style', 'tmm_shortcodes'),
			'default-pic' => __('Default Style', 'tmm_shortcodes')
		);		
		?>
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Icon Style', 'tmm_shortcodes'),
			'shortcode_field' => 'icons_style',
			'id' => 'icons_style',
			'options' => $icons_style,
			'default_value' => TMM_Ext_Shortcodes::set_default_value('icons_style', 'circle-pic'),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->
	
	<div class="one-half">
		
	<?php 
	TMM_Ext_Shortcodes::draw_shortcode_option(array(
		'type' => 'textarea',
		'title' => __('Optional Text', 'tmm_shortcodes'),
		'shortcode_field' => 'text',
		'id' => 'url',
		'default_value' => TMM_Ext_Shortcodes::set_default_value('text', ''),
		'description' => ''
	));
	?>
		
	</div>

	<div class="fullwidth">

		<?php
		$icons_array = array();

		$new_icons = $icons_array['new_icons'] = array(
			'icon-expand-alt',
			'icon-collapse-alt',
			'icon-smile',
			'icon-frown',
			'icon-meh',
			'icon-gamepad',
			'icon-keyboard',
			'icon-flag-alt',
			'icon-flag-checkered',
			'icon-terminal',
			'icon-code',
			'icon-mail-forward',
			'icon-mail-reply',
			'icon-reply-all',
			'icon-mail-reply-all',
			'icon-star-half-empty',
			'icon-star-half-full',
			'icon-location-arrow',
			'icon-rotate-left',
			'icon-rotate-right',
			'icon-crop',
			'icon-code-fork',
			'icon-unlink',
			'icon-question',
			'icon-info',
			'icon-exclamation',
			'icon-superscript',
			'icon-subscript',
			'icon-eraser',
			'icon-puzzle-piece',
			'icon-microphone',
			'icon-microphone-off',
			'icon-shield',
			'icon-calendar-empty',
			'icon-fire-extinguisher',
			'icon-rocket',
			'icon-maxcdn',
			'icon-chevron-sign-left',
			'icon-chevron-sign-right',
			'icon-chevron-sign-up',
			'icon-chevron-sign-down',
			'icon-html5',
			'icon-css3',
			'icon-anchor',
			'icon-unlock-alt',
			'icon-bullseye',
			'icon-ellipsis-horizontal',
			'icon-ellipsis-vertical',
			'icon-rss-sign',
			'icon-play-sign',
			'icon-ticket',
			'icon-minus-sign-alt',
			'icon-check-minus',
			'icon-level-up',
			'icon-level-down',
			'icon-check-sign',
			'icon-edit-sign',
			'icon-external-link-sign',
			'icon-share-sign'
		);

		$new_icons = $icons_array['new_icons'] = array_combine($new_icons, $new_icons);

		//***

		$web_application_icons = $icons_array['web_application_icons'] = array(
			'icon-adjust',
			'icon-anchor',
			'icon-asterisk',
			'icon-ban-circle',
			'icon-bar-chart',
			'icon-barcode',
			'icon-beaker',
			'icon-beer',
			'icon-bell',
			'icon-bolt',
			'icon-book',
			'icon-bookmark-empty',
			'icon-bookmark',
			'icon-briefcase',
			'icon-bullhorn',
			'icon-bullseye',
			'icon-calendar-empty',
			'icon-calendar',
			'icon-camera',
			'icon-camera-retro',
			'icon-certificate',
			'icon-check-empty',
			'icon-check-minus',
			'icon-check-sign',
			'icon-check',
			'icon-circle-blank',
			'icon-circle',
			'icon-cloud-download',
			'icon-cloud',
			'icon-code-fork',
			'icon-code',
			'icon-coffee',
			'icon-cog',
			'icon-cogs',
			'icon-collapse-alt',
			'icon-comment-alt',
			'icon-comment',
			'icon-comments-alt',
			'icon-comments',
			'icon-credit-card',
			'icon-crop',
			'icon-dashboard',
			'icon-desktop',
			'icon-download-alt',
			'icon-download',
			'icon-edit-sign',
			'icon-edit',
			'icon-ellipsis-horizontal',
			'icon-ellipsis-vertical',
			'icon-envelope-alt',
			'icon-envelope',
			'icon-eraser',
			'icon-exchange',
			'icon-exclamation-sign',
			'icon-exclamation',
			'icon-expand-alt',
			'icon-external-link-sign',
			'icon-external-link',
			'icon-eye-close',
			'icon-eye-open',
			'icon-facetime-video',
			'icon-fighter-jet',
			'icon-film',
			'icon-filter',
			'icon-fire-extinguisher',
			'icon-fire',
			'icon-flag-alt',
			'icon-flag-checkered',
			'icon-flag',
			'icon-folder-close-alt',
			'icon-folder-close',
			'icon-folder-open-alt',
			'icon-folder-open',
			'icon-food',
			'icon-frown',
			'icon-gamepad',
			'icon-gift',
			'icon-glass',
			'icon-globe',
			'icon-group',
			'icon-hdd',
			'icon-headphones',
			'icon-heart-empty',
			'icon-heart',
			'icon-home',
			'icon-inbox',
			'icon-info-sign',
			'icon-info',
			'icon-key',
			'icon-keyboard',
			'icon-laptop',
			'icon-leaf',
			'icon-legal',
			'icon-lemon',
			'icon-level-down',
			'icon-level-up',
			'icon-lightbulb',
			'icon-location-arrow',
			'icon-lock',
			'icon-magic',
			'icon-magnet',
			'icon-mail-forward',
			'icon-mail-reply',
			'icon-mail-reply-all',
			'icon-map-marker',
			'icon-meh',
			'icon-microphone-off',
			'icon-microphone',
			'icon-minus-sign-alt',
			'icon-minus-sign',
			'icon-minus',
			'icon-mobile-phone',
			'icon-money',
			'icon-move',
			'icon-music',
			'icon-off',
			'icon-ok-circle',
			'icon-ok-sign',
			'icon-ok',
			'icon-pencil',
			'icon-picture',
			'icon-plane',
			'icon-plus-sign',
			'icon-plus',
			'icon-print',
			'icon-pushpin',
			'icon-puzzle-piece',
			'icon-qrcode',
			'icon-question-sign',
			'icon-question',
			'icon-quote-left',
			'icon-quote-right',
			'icon-random',
			'icon-refresh',
			'icon-remove-circle',
			'icon-remove-sign',
			'icon-remove',
			'icon-reorder',
			'icon-reply-all',
			'icon-reply',
			'icon-resize-horizontal',
			'icon-resize-vertical',
			'icon-retweet',
			'icon-road',
			'icon-rocket',
			'icon-rotate-left',
			'icon-rotate-right',
			'icon-rss-sign',
			'icon-rss',
			'icon-screenshot',
			'icon-search',
			'icon-share',
			'icon-share-alt',
			'icon-share-sign',
			'icon-share',
			'icon-shield',
			'icon-shopping-cart',
			'icon-sign-blank',
			'icon-signal',
			'icon-signin',
			'icon-signout',
			'icon-sitemap',
			'icon-smile',
			'icon-sort-down',
			'icon-sort-up',
			'icon-sort',
			'icon-spinner',
			'icon-star-empty',
			'icon-star-half-full',
			'icon-star-half-empty',
			'icon-star-half',
			'icon-star',
			'icon-tablet',
			'icon-tag',
			'icon-tags',
			'icon-tasks',
			'icon-terminal',
			'icon-thumbs-down',
			'icon-thumbs-up',
			'icon-ticket',
			'icon-time',
			'icon-tint',
			'icon-trash',
			'icon-trophy',
			'icon-truck',
			'icon-umbrella',
			'icon-unlock-alt',
			'icon-unlock',
			'icon-upload-alt',
			'icon-upload',
			'icon-user-md',
			'icon-user',
			'icon-volume-down',
			'icon-volume-off',
			'icon-volume-up',
			'icon-warning-sign',
			'icon-wrench',
			'icon-zoom-in',
			'icon-zoom-out'
		);

		$web_application_icons = $icons_array['web_application_icons'] = array_combine($web_application_icons, $web_application_icons);

		//***

		$text_editor_icons = $icons_array['text_editor_icons'] = array(
			'icon-file',
			'icon-file-alt',
			'icon-cut',
			'icon-copy',
			'icon-paste',
			'icon-save',
			'icon-undo',
			'icon-repeat',
			'icon-text-height',
			'icon-text-width',
			'icon-align-left',
			'icon-align-center',
			'icon-align-right',
			'icon-align-justify',
			'icon-indent-left',
			'icon-indent-right',
			'icon-font',
			'icon-bold',
			'icon-italic',
			'icon-strikethrough',
			'icon-underline',
			'icon-superscript',
			'icon-subscript',
			'icon-link',
			'icon-unlink',
			'icon-paper-clip',
			'icon-eraser',
			'icon-columns',
			'icon-table',
			'icon-th-large',
			'icon-th',
			'icon-th-list',
			'icon-list',
			'icon-list-ol',
			'icon-list-ul',
			'icon-list-alt'
		);

		$text_editor_icons = $icons_array['text_editor_icons'] = array_combine($text_editor_icons, $text_editor_icons);

		//***

		$directional_icons = $icons_array['directional_icons'] = array(
			'icon-angle-left',
			'icon-angle-right',
			'icon-angle-up',
			'icon-angle-down',
			'icon-arrow-down',
			'icon-arrow-left',
			'icon-arrow-right',
			'icon-arrow-up',
			'icon-caret-down',
			'icon-caret-left',
			'icon-caret-right',
			'icon-caret-up',
			'icon-chevron-down',
			'icon-chevron-left',
			'icon-chevron-right',
			'icon-chevron-up',
			'icon-chevron-sign-left',
			'icon-chevron-sign-right',
			'icon-chevron-sign-up',
			'icon-chevron-sign-down',
			'icon-circle-arrow-down',
			'icon-circle-arrow-left',
			'icon-circle-arrow-right',
			'icon-circle-arrow-up',
			'icon-double-angle-left',
			'icon-double-angle-right',
			'icon-double-angle-up',
			'icon-double-angle-down',
			'icon-hand-down',
			'icon-hand-left',
			'icon-hand-right',
			'icon-hand-up'
		);
		$directional_icons = $icons_array['directional_icons'] = array_combine($directional_icons, $directional_icons);

		//***

		$video_player_icons = $icons_array['video_player_icons'] = array(
			'icon-play-circle',
			'icon-play-sign',
			'icon-play',
			'icon-pause',
			'icon-stop',
			'icon-eject',
			'icon-backward',
			'icon-forward',
			'icon-fast-backward',
			'icon-fast-forward',
			'icon-step-backward',
			'icon-step-forward',
			'icon-fullscreen',
			'icon-resize-full',
			'icon-resize-small'
		);

		$video_player_icons = $icons_array['video_player_icons'] = array_combine($video_player_icons, $video_player_icons);

		//***

		$brand_icons = $icons_array['brand_icons'] = array(
			'icon-css3',
			'icon-facebook',
			'icon-facebook-sign',
			'icon-twitter',
			'icon-twitter-sign',
			'icon-github',
			'icon-github-sign',
			'icon-html5',
			'icon-linkedin',
			'icon-linkedin-sign',
			'icon-maxcdn',
			'icon-pinterest',
			'icon-pinterest-sign',
			'icon-google-plus',
			'icon-google-plus-sign'
		);

		$brand_icons = $icons_array['brand_icons'] = array_combine($brand_icons, $brand_icons);

		//***

		$medical_icons = $icons_array['medical_icons'] = array(
			'icon-ambulance',
			'icon-beaker',
			'icon-h-sign',
			'icon-hospital',
			'icon-medkit',
			'icon-plus-sign-alt',
			'icon-stethoscope',
			'icon-user-md'
		);

		$medical_icons = $icons_array['medical_icons'] = array_combine($medical_icons, $medical_icons);
		?>
		
		<br />

		<div class="container" id="icons_items">

			<div id="New_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'New_Icons' ? 'block' : 'none') ?>">
				
				<h4><?php _e('New Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($new_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->

				<div class="clear"></div>

			</div><!--/ .icons_types_container-->

			<div id="Web_Application_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Web_Application_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Web Application Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($web_application_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->		

				<div class="clear"></div>

			</div><!--/ .icon_types_container-->

			<div id="Text_Editor_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Text_Editor_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Text Editor Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($text_editor_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->

				<div class="clear"></div>

			</div><!--/ .icon_types_container-->

			<div id="Directional_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Directional_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Directional Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($directional_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->

				<div class="clear"></div>

			</div><!--/ .icon_types_container-->

			<div id="Video_Player_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Video_Player_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Video Player Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($video_player_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->

				<div class="clear"></div>

			</div><!--/ .icon_types_container-->

			<div id="Brand_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Social_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Brand Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($brand_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->	

				<div class="clear"></div>

			</div><!--/ .icon_types_container-->

			<div id="Medical_Icons" class="icon_types_container" style="display: <?php echo($view_icon_group == 'Medical_Icons' ? 'block' : 'none') ?>">
				<h4><?php _e('Medical Icons', 'tmm_shortcodes') ?></h4>

				<ul class="icons-type-list icons-type-awesome">
					<?php foreach ($medical_icons as $name): ?>
						<li <?php if ($icon_css_class == $name): ?>class="chooced_icon_type"<?php endif; ?>><i title="<?php echo $name ?>" class="<?php echo $name ?>"></i></li>
					<?php endforeach; ?>
				</ul><!--/ .icons-type-list-->		

				<div class="clear"></div>

			</div><!--/ .icon_type_container-->

		</div><!--/ #icons_items-->		

	</div><!--/ .fullwidth-->

</div>


<!-- --------------------------  PROCESSOR  --------------------------- -->
<script type="text/javascript">
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";

	jQuery(function() {
		colorizator();
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});

		var $iconGroup = jQuery('#view_icon_group');

		$iconGroup.on('change', function() {
			jQuery(".icon_types_container").hide();
			jQuery("#" + jQuery(this).val()).show();
		});

		jQuery("#icons_items").on('click', 'li', function(e) {
			var $target = jQuery(this);
			jQuery("#icons_items li").removeClass('chooced_icon_type');
			$target.addClass('chooced_icon_type');
			jQuery("#chooced_icon_type").val($target.find("i").attr('class'));
			tmm_ext_shortcodes.changer(shortcode_name);
			return false;
		});
		
		selectwrap();

	});
</script>

