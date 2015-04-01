<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<script type="text/javascript">
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<div class="widget widget_newsletter_subscription">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>

	<?php if (is_user_logged_in()): ?>
		<?php
		//$user = wp_get_current_user();
		$settings = TmMS_Settings::get_settings();
		?>
		<a href="<?php echo get_permalink($settings['user_subscribe_page_id']) ?>"><?php _e('Manage your subscriptions', 'newsplus') ?></a><br />
	<?php else: ?>

		<p><?php echo $instance['text'] ?></p>

		<?php $unique_id = uniqid(); ?>

		<form class="newsletter-form" name="newsletter_subscription_<?php echo $unique_id ?>" action="/" onsubmit="return mail_subscriber_newsletters.subscribe_user('<?php echo $unique_id ?>')">
			<p class="input-block newsletter-name">
				<input type="text" name="newsletter_subscription_name" placeholder="<?php _e('enter you name *', 'newsplus') ?>" id="newsletter_subscription_name_<?php echo $unique_id ?>" value="" />
			</p>
			<p class="input-block newsletter-email">
				<input type="text" name="newsletter_subscription_email" placeholder="<?php _e('enter you e-mail *', 'newsplus') ?>" id="newsletter_subscription_email_<?php echo $unique_id ?>" value="" />
				<input type="submit" class="button default middle" value="<?php _e('Sign Up', 'newsplus') ?>" />
			</p>
		</form>

		<div class="message-response"><p class="default" id="newsletter_subscription_info_<?php echo $unique_id ?>"></p></div>

	<?php endif; ?>
</div>


