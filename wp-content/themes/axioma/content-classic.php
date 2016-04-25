<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
$show_post_metadata = TMM::get_option("blog_listing_show_all_metadata");
if (isset($_REQUEST['shortcode_show_metadata'])) {
	$show_post_metadata = $_REQUEST['shortcode_show_metadata'];
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix"); ?>>
			
			<?php
			$post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
			$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
			//***
			switch ($post_pod_type) {
				case 'audio':
					echo do_shortcode('[tmm_audio]' . $post_type_values[$post_pod_type] . '[/tmm_audio]');
					break;
				case 'video':
					?>

					<?php
					$video_width = 940;
					$video_height = 420;

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

										<img src="<?php echo TMM_Helper::resize_image($source_url, '940*420') ?>" alt="<?php echo $post->post_title ?>" />

										<div class="image-extra">

											<div class="extra-content">
												
												<div class="inner-extra">
													
													<a class="single-image link-icon" href="<?php the_permalink() ?>">Permalink</a>
													<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>">Image</a>													
													
												</div>
												
											</div><!--/ .extra-content-->	

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
					<?php if (has_post_thumbnail()) : ?>
						
						<div class="work-item">

							<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '940*420'); ?>" alt="<?php the_title(); ?>" />

							<div class="image-extra">

								<div class="extra-content">
									
									<div class="inner-extra">
										
										<a class="single-image link-icon" href="<?php the_permalink() ?>">Permalink</a>
										<a class="single-image plus-icon" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>		
										
									</div><!--/ .inner-extra-->
									
								</div><!--/ .extra-content-->	

							</div><!--/ .image-extra-->				

						</div><!--/ .work-item-->
					
					<?php endif; ?>
					<?php
					break;
			}
			?>

			<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<?php if ($show_post_metadata) : ?>

				<div class="entry-meta">
					
					<?php if (TMM::get_option("blog_listing_show_date")) : ?>
						<span class="post-date"><?php _e('On', 'axioma'); ?> <?php echo get_the_date('d M Y') ?>,</span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_listing_show_author")) : ?>
						<span class="author"><?php _e('Posted by', 'axioma'); ?>&nbsp;<?php the_author_link() ?>,</span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_listing_show_category")) : ?>
						<?php $categories_list = get_the_category_list(__(', ', 'axioma')); ?>
						<?php if (!empty($categories_list)) : ?>
							<span class="categories">
								<?php _e('In', 'axioma'); ?>
								<?php 
									// echo $categories_list ;
									
									$categories = get_the_category();
									$separator = ', ';
									$output = '';
									if($categories){
										foreach($categories as $category) {
											$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.do_shortcode("[cml_translate string='" . $category->cat_name . "' in='" . CMLLanguage::get_current_slug() . "']").'</a>'.$separator;
										}
									echo trim($output, $separator);
									}

								?>
							</span>
						<?php endif; ?>
					<?php endif; ?>

					<?php $tags = get_the_tag_list('', ', '); ?>
					<?php if (TMM::get_option("blog_listing_show_tags") AND !empty($tags)) : ?>
						<span class="categories">
							<?php _e('By', 'axioma'); ?>
							<?php echo $tags ?>
						</span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_comments")) : ?>
						<span class="comments">
							<?php _e('With', 'axioma'); ?>
							<a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a>
							<?php _e('Comments', 'axioma'); ?>
						</span>
					<?php endif; ?>

				</div><!--/ .entry-meta-->

			<?php endif; ?>

			<p>
				<?php
				if (TMM::get_option("excerpt_symbols_count")) {
					if (empty($post->post_excerpt)) {
						$txt = do_shortcode($post->post_content);
						$txt = strip_tags($txt);
						if (function_exists('mb_substr')) {
							echo do_shortcode(mb_substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						} else {
							echo do_shortcode(substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						}
					} else {
						if (function_exists('mb_substr')) {
							echo do_shortcode(mb_substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						} else {
							echo do_shortcode(substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						}
					}
				} else {
					echo do_shortcode($post->post_excerpt);
				}
				?>
			</p>

			<a class="button small default" href="<?php the_permalink() ?>"><?php _e('Read More', 'axioma'); ?></a>

		</article><!--/ .entry-->

		<?php
	endwhile;
else:
	get_template_part('content', 'nothingfound');
endif;
?>



