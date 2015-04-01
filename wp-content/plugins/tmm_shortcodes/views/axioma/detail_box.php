<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<ul class="contact-details">
	<?php if (!empty($content)): ?>
		<li class="contact-icon-address"><span><?php _e('Address', 'tmm_shortcodes') ?>:</span> <?php echo $content ?></li>
	<?php endif; ?>
	<?php if (!empty($phone)): ?>
		<li class="contact-icon-phone"><span><?php _e('Phone', 'tmm_shortcodes') ?>:</span> <?php echo $phone ?></li>
	<?php endif; ?>
	<?php if (!empty($email)): ?>
		<li class="contact-icon-email"><span><?php _e('Email', 'tmm_shortcodes') ?>:</span><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
		<?php endif; ?>
</ul>