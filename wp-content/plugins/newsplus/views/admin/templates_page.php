<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="wrap">

	<div class="icon32" id="icon-options-general"><br></div>

	<h2><?php _e('Newsplus Templates', 'newsplus') ?></h2>

	<br />

	<?php if (!empty($templates)): ?>
		<ul class="templates-list">
			<?php foreach ($templates as $template_key => $template) : ?>
				<li>
					<img class="thumb" src="<?php echo TmMS_Template::$template_link . $template_key . '/screenshot.jpg' ?>" alt="" /><br />
					<?php
					//global $tm_ms_controller;
					$ini_data = parse_ini_file(THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'templates/' . $template_key . '/values.ini');
					if (!empty($ini_data)) {
						?>
						<ul class="desc-list">
							<li><span><?php _e('Author:', 'newsplus') ?></span> <?php echo $ini_data['author'] ?></li>
							<li><span><?php _e('Name:', 'newsplus') ?></span> <?php echo $ini_data['name'] ?></li>
							<li><span><?php _e('Layout:', 'newsplus') ?></span> <?php echo $ini_data['layout'] ?></li>
							<li><a href="<?php echo admin_url('post-new.php?post_type=mail_subscriber&template=' . $template_key) ?>" class="button-primary"><?php _e('Create Email', 'newsplus') ?></a></li>
						</ul>
						<?php
					}
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</div>
