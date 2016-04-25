<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<form id="tm_mail_subscriber_settings" name="mail_subscriber_form" method="post" style="display: none;">
	<div id="tm">

		<section class="admin-container clearfix">

			<header id="title-bar" class="clearfix">

				<a href="#" class="admin-logo"></a>
				<span class="fw-version">NewsPlus v.1.0.2</span>

				<div class="clear"></div>

			</header><!--/ #title-bar-->

			<section class="set-holder clearfix">

				<ul class="support-links">
					<li><a class="support-docs" href="http://newsplus.webtemplatemasters.com/subscriber-help" target="_blank"><?php _e('Newsplus\'s Docs', 'newsplus'); ?></a></li>
					<li><a class="support-forum" href="#" target="_blank"><?php _e('Visit Forum', 'newsplus'); ?></a></li>
				</ul><!--/ .support-links-->

				<div class="button-options">
					<input type="submit" class="button_save_mail_subscriber_options admin-button button-yellow button-small" value="<?php _e('Save Settings', 'newsplus'); ?>" />
				</div><!--/ .button-options-->

			</section><!--/ .set-holder-->

			<aside id="admin-aside">

				<ul class="admin-nav">
					<li><a class="shortcut-general" href="#general"><?php _e("General", 'newsplus') ?></a></li>
					<li><a class="shortcut-contact" href="#subscribers"><?php _e("Subscribers", 'newsplus') ?></a></li>

				</ul><!--/ .admin-nav-->

			</aside><!--/ #admin-aside-->

			<section id="admin-content" class="clearfix">

				<div class="tab-content" id="general">

					<h4><?php _e("Name From", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" class="regular-text" value="<?php echo (!isset($name_from) ? get_option("blogname") : $name_from) ?>" name="name_from">
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("The sender's name which displays in \"From:\" field of subscriber's mailbox.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Subscribers Page ID", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" name="user_subscribe_page_id" value="<?php if(isset($user_subscribe_page_id))echo $user_subscribe_page_id ?>" />
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Create a page for your subscribers to be able to manage their subscriptions by their own and place here the ID of that page.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Default Email Subject", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" name="default_email_subject" value="<?php if(isset($default_email_subject))echo $default_email_subject ?>" />
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Type here a default email subject for your newsletter subscribers.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Default Email Address", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" name="senders_mail_address" value="<?php if(isset($senders_mail_address))echo $senders_mail_address ?>" />
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Type here a default email address for your newsletter subscribers.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Set the limit of Emails per minute", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" name="letters_per_minute" value="<?php echo($letters_per_minute?$letters_per_minute:50) ?>" />
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Important notice: Some servers don't allow to send too much mails because of safety. We'd recommend to use a value of 50 mails per minute. In other case please contact your server's administrator to increase that limit.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Newsletter's Header", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<textarea name="mail_header"><?php if(isset($mail_header))echo $mail_header ?></textarea>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Type here your newsletter's header text.", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("Newsletter's Footer", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<textarea name="mail_footer"><?php if(isset($mail_footer))echo $mail_footer ?></textarea>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Type here your newsletter's footer text.", 'newsplus') ?>
							</p>
						</div>
					</div>

				</div>


				<div class="tab-content" id="subscribers">

					<h4><?php _e("New user's registration text", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<textarea name="new_user_registration_text"><?php echo (!isset($new_user_registration_text) ? __('Hello __USERNAME__! Your password is: __PASSWORD__', 'newsplus') : $new_user_registration_text) ?></textarea>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Example: Hello __USERNAME__! Your password is: __PASSWORD__", 'newsplus') ?>
							</p>
						</div>
					</div>

					<hr class="admin-divider">

					<h4><?php _e("New user's registration mail subject", 'newsplus') ?></h4>
					<div class="clearfix">
						<div class="admin-one-half">
							<input type="text" name="new_user_registration_mail_subject" value="<?php if(isset($new_user_registration_mail_subject))echo $new_user_registration_mail_subject ?>" />
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php _e("Type here your new subscriber's \"Welcome\" text.", 'newsplus') ?>
							</p>
						</div>
					</div>

				</div>

			</section><!--/ #admin-content-->

		</section><!--/ .admin-container-->

	</div><!--/ #tm-->

</form>

