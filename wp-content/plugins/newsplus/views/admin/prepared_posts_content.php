<div style="display: none;" id="mail_subscriber_options">
	<div aria-label="Newsplus" tabindex="-1" class="hidden" id="mail-subscriber-options-wrap" style="display: none;">
		<div style="padding: 11px;">
			<?php $templates_array = TmMS_PT_MailSubscriberTemplate::get_templates_array() ?>
			<?php if (!empty($templates_array)): ?>

				<select id="ms_tpls">
					<?php foreach ($templates_array as $tpl_id => $tpl_name) : ?>
						<option value="<?php echo $tpl_id ?>"><?php echo $tpl_name ?></option>
					<?php endforeach; ?>
				</select>
			<?php else: ?>
				<?php _e("No one post template created", 'newsplus') ?>. <a href="<?php echo site_url('wp-admin/edit.php?post_type=mail_subscriber&page=tm_mail_subscriber_posts_templates') ?>"><?php _e("Create a new one here", 'newsplus') ?></a><br />
			<?php endif; ?>
			<br />
			<ul id="mail-subscriber-options-posts" class="mail-options-list">
				<?php if (!empty(TmMS_Heap::$posts_in_heap)): ?>
					<?php foreach (TmMS_Heap::$posts_in_heap as $post_id) : ?>
						<li><?php echo get_the_title($post_id); ?>&nbsp;<a data-post-id="<?php echo $post_id ?>" href="javascript:void(0);" class="mail_subscriber_remove_item_from_heap button">X</a></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
			<br />
			<div id="process_bar" style="display: none;">
				<span></span>
				<div id="process_progress"><strong></strong></div>
			</div>

			<br />
			<a href="javascript:mail_subscriber_heap.mail_posts_heap();void(0);" class="button-primary"><?php _e('Send letters', 'newsplus') ?></a><br />
		</div>
	</div>
</div>

