<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php if (is_user_logged_in()): ?>
	<form method="post" action="/" id="tmm_mail_subscriber_user_cabinet">
		<h2><?php _e('Groups', 'newsplus') ?></h2>
		<?php if (!empty($groups)) : ?>
			<?php foreach ($groups as $key => $group) : ?>
				<p>
					<input name="tm_mail_subscriber_user_groups[]" <?php if (!empty($users_groups)): ?><?php if (in_array($key, $users_groups)): ?>checked=""<?php endif; ?><?php endif; ?> type="checkbox" value="<?php echo $key ?>">&nbsp;<?php echo $group['name'] ?><br />
				<?php if (!empty($group['description'])): ?>
					<small><i><?php echo $group['description'] ?></i></small>
				<?php endif; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>


			<h2><?php _e('Post categories', 'newsplus') ?></h2>
			
			<?php if (!empty($posts_categories)) : ?>
				<?php foreach ($posts_categories as $cat) : ?>
					<?php
					if ($cat->term_id == 1) {
						continue;
					}
					?>
					<p>
					<input name="tm_mail_subscriber_user_postcat[]" <?php if (!empty($users_postcat)): ?><?php if (in_array($cat->term_id, $users_postcat)): ?>checked=""<?php endif; ?><?php endif; ?> type="checkbox" value="<?php echo $cat->term_id ?>">&nbsp;<?php echo $cat->name ?><br />
					<?php if (!empty($cat->category_description)): ?>
						<small><i><?php echo $cat->category_description ?></i></small><br />
						<b><i><?php _e('Posts count', 'newsplus') ?>: <?php echo $cat->category_count ?></i></b>
					</p>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

		<?php endif; ?>
		<p><input type="submit" value="<?php _e('Save options', 'newsplus') ?>" /></p>
	</form>
	<p><small><a href="#" id="unsubscribe_and_delete"><?php _e('Unsubscribe and remove my mail from database.', 'newsplus') ?></a></small></p>


	<script type="text/javascript">
		var mail_subscriber_lang_sure = "<?php _e("Sure?", 'newsplus') ?>";
	</script>