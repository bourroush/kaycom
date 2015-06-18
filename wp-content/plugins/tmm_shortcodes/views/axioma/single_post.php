<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$post_id = (int) $content;
$post = get_post($post_id);
$post_link = post_permalink($post_id);
?>

<?php if ($show_post_type_media == 1): ?>
	<?php
	$post_pod_type = get_post_meta($post_id, 'post_pod_type', true);
	$post_type_values = get_post_meta($post_id, 'post_type_values', true);
//***
	switch ($post_pod_type) {
		case 'audio':
			echo do_shortcode('[tmm_audio]' . $post_type_values[$post_pod_type] . '[/tmm_audio]');
			break;
		case 'video':
			?>

			<?php
			$video_width = '100%';
			$video_height = 'auto';

			$source_url = $post_type_values[$post_pod_type];
			if (!empty($source_url)) {

				$video_type = 'youtube.com';
				$allows_array = array('youtube.com', 'vimeo.com');

				foreach ($allows_array as $key => $needle) {
					$count = strpos($source_url, $needle);
					if ($count !== FALSE) {
						$video_type = $allows_array[$key];
					}
				}

				switch ($video_type) {
					case $allows_array[0]:
						echo do_shortcode('[tmm_video type="youtube" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
						break;
					case $allows_array[1]:
						echo do_shortcode('[tmm_video type="vimeo" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
						break;
					default:
						break;
				}
			}
			?>
			<?php
			break;

		case 'quote':
			echo do_shortcode('[blockquote]' . $post_type_values[$post_pod_type] . '[/blockquote]');
			break;

		case 'gallery':
			TMM_Functions::enqueue_script('cycle');
			$gall = $post_type_values[$post_pod_type];
			?>

			<?php if (!empty($gall)) : ?>

				<div class="image-post-slider">
					<ul>
						<?php foreach ($gall as $key => $source_url): ?>
								<li>
									
									<div class="work-item">

										<img src="<?php echo TMM_Helper::resize_image($source_url, '460*350') ?>" alt="<?php echo $post->post_title ?>" />

										<div class="image-extra">
											
											<div class="inner-extra">
												
												<div class="extra-content">
													<a class="single-image link-icon" href="<?php echo $post_link ?>">Permalink</a>
													<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>">Image</a>
												</div><!--/ .extra-content-->	
												
											</div><!--/ .inner-extra-->
				
										</div><!--/ .image-extra-->													

									</div><!--/ .work-item-->
								
								</li>
						<?php endforeach; ?>
					</ul>
				</div><!--/ .image-post-slider-->

			<?php endif; ?>

			<?php
			break;

		default:
			?>
			<?php if (has_post_thumbnail($post_id)) : ?>
				
			<div class="work-item">
				
				<img src="<?php echo TMM_Helper::get_post_featured_image($post_id, '460*350'); ?>" alt="<?php echo $post->post_title ?>" />

				<div class="image-extra">

					<div class="extra-content">
						<a class="single-image link-icon" href="<?php echo $post_link ?>">Permalink</a>
						<a class="single-image plus-icon" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>
					</div><!--/ .extra-content-->	

				</div><!--/ .image-extra-->				

			</div><!--/ .work-item-->
			
			<?php endif; ?>
			<?php
			break;
	}
	?>
<?php endif; ?>

<h5 class="title"><a href="<?php echo $post_link ?>"><?php echo $post->post_title ?></a></h5>

<?php if ($show_post_metadata == 1): ?>
	<div class="post-meta">

		<?php if (TMM::get_option("blog_listing_show_date")) : ?>
			<span class="post-date"><?php echo mysql2date(get_option('date_format'), $post->post_date, false) ?></span>
		<?php endif; ?>		

		<?php if (!TMM::get_option("blog_listing_show_comments")) : ?>
			<span class="post-comments"><?php _e('With', 'tmm_shortcodes'); ?>&nbsp;<a href="<?php echo $post_link ?>#comments"><?php echo get_comments_number($post->ID); ?></a>&nbsp;<?php _e('Comments', 'tmm_shortcodes'); ?></span>
		<?php endif; ?>
	</div>
<?php endif; ?>	
	
<?php
$txt = "";
if ($show_content == 1) {
	$txt = strip_tags(do_shortcode($post->post_content));
} else {
	$txt = strip_tags(do_shortcode($post->post_excerpt));
}

if (function_exists('mb_substr')) {
	$txt = do_shortcode(mb_substr($txt, 0, $char_count) . " ...");
} else {
	$txt = do_shortcode(substr($txt, 0, $char_count) . " ...");
}
?>

<?php if (!empty($txt)): ?>

	<p><?php echo $txt ?></p>
	
<?php endif; ?>

<?php if ($show_readmore_button == 1): ?>
	<?php echo do_shortcode('[button url="' . $post_link . '" color="' . $button_color . '" size="' . $button_size . '"]' . __('Read more', 'tmm_shortcodes') . '[/button]') ?>
<?php endif; ?>