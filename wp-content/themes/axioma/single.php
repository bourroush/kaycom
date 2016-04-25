<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<article id="post-<?php the_ID(); ?>" <?php post_class("entry single clearfix"); ?>>

			<?php
			$post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
			$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
			//***
			switch ($post_pod_type) {
				case 'audio':
					echo do_shortcode('[tmm_audio]' . $post_type_values[$post_pod_type] . '[/tmm_audio]');
					break;
				case 'video':
					$video_width = 620;
					$video_height = 370;

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

											<img src="<?php echo TMM_Helper::resize_image($source_url, '620*370') ?>" alt="<?php echo $post->post_title ?>" />

											<div class="image-extra">
												
												<div class="extra-content">
													
													<div class="inner-extra">
														
														<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>">Image</a>
													
													</div><!--/ .inner-extra-->
													
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

							<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '620*370'); ?>" alt="<?php the_title(); ?>" />

							<div class="image-extra">

								<div class="extra-content">
									
									<div class="inner-extra">
										
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
			<div class="clear"></div>

			<h2 class="entry-title"><?php the_title(); ?></h2>

			<?php if (TMM::get_option("blog_single_show_all_metadata")) : ?>
				<div class="entry-meta">
					<?php if (TMM::get_option("blog_listing_show_date")) : ?>
						<span class="post-date">
						<?php
							echo do_shortcode("[cml_text en='In' fr='En']");
						?>
						<?php
							if (CMLLanguage::get_current_slug() == 'fr'){
								_e(date_i18n( 'F',  strtotime( get_the_time( "Y-m-d" ) ) ), 'axioma');	
								_e(date_i18n( ', Y',  strtotime( get_the_time( "Y-m-d" ) ) ), 'axioma');
							} else {
								the_date(', Y', '');
							}
						?>
						,</span>
					<?php endif; ?>
					<?php if (TMM::get_option("blog_single_show_author")) : ?>
						<span class="author"><?php _e('Posted by', 'axioma'); ?>&nbsp;<?php the_author_link() ?></span>,
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_category")) : ?>
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

					<?php if (TMM::get_option("blog_single_show_comments")) : ?>
						<span class="comments">
							<?php _e('With', 'axioma'); ?>
							<a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a>
							<?php _e('Comments', 'axioma'); ?>
						</span>
					<?php endif; ?>

				</div><!--/ .entry-meta-->
			<?php endif; ?>

			<?php the_content() ?>
			<?php
			if (class_exists('TMM_Ext_LayoutConstructor')) {
				TMM_Ext_LayoutConstructor::draw_front($post->ID);
			}
			?>

			<?php $tags = get_the_tag_list('<ul class="tags-list" data-title="Tags:"><li>', '</li><li>', '</li></ul>'); ?>
			<?php if (TMM::get_option("blog_single_show_tags") AND !empty($tags)) : ?>		

				<div class="tags-holder">
					<?php echo $tags ?>
				</div><!--/ .tags-holder-->	

			<?php endif; ?>

			<?php
			wp_link_pages(array(
				'before' => '<div class="wp-link-pages">',
				'after' => '</div>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'next_or_number' => 'next_and_number', # activate parameter overloading
				'nextpagelink' => __('Next', 'axioma'),
				'previouspagelink' => __('Previous', 'axioma'),
				'pagelink' => '%',
				'echo' => 1)
			);
			?>


			<?php
			$next_post = get_next_post();
			$prev_post = get_previous_post();
			//***
			$next_post_url = "";
			$prev_post_url = "";

			if (is_object($next_post)) {
				$next_post_url = get_permalink($next_post->ID);
			}

			if (is_object($prev_post)) {
				$prev_post_url = get_permalink($prev_post->ID);
			}
			?>

			<div class="single-post-nav clearfix">

				<?php if (!empty($next_post_url)): ?>
					<a href="<?php echo $next_post_url ?>" class="prev" title="<?php _e("Previous post", 'axioma') ?>"><?php _e("Prev", 'axioma') ?></a>
				<?php endif; ?>

				<?php if (!empty($prev_post_url)): ?>
					<a href="<?php echo $prev_post_url ?>" class="next" title="<?php _e("Next post", 'axioma') ?>"><?php _e("Next", 'axioma') ?></a>
				<?php endif; ?>				

			</div><!--/ .single-post-nav-->




			<?php if (TMM::get_option("blog_single_show_bio")): ?>

				<?php $user = get_userdata($post->post_author); ?>
				<?php if (is_object($user)): ?>

					<div class="author-holder">

						<h3 class="author-title"><?php _e('About the Author', 'axioma'); ?></h3>

						<div class="author-about">

							<div class="author-thumb">
								<div class="avatar">
									<?php
									$avatar_url = get_avatar($user->user_email, 90);
									echo $avatar_url;
									?>
								</div><!--/ .avatar-->
							</div><!--/ .author-thumb-->

							<div class="author-entry">
								<h4 class="author-entry-title"><?php echo $user->user_nicename ?></h4>
								<p><?php echo stripslashes($user->description); ?></p>
							</div><!--/ .author-entry-->

						</div><!--/ .about-author-->						

					</div>

					<div class="separator"></div>

				<?php endif; ?>
			<?php endif; ?>

			<?php if (TMM::get_option("blog_single_show_comments")): ?>
				<?php comments_template(); ?>
			<?php endif; ?>

			<?php if (TMM::get_option("blog_single_show_fb_comments")) : ?>   

				<div class="separator"></div>	
				<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width=""></div>

			<?php endif; ?>

		</article><!--/ .entry-->


		<?php
	endwhile;
endif;
?>
<?php get_footer(); ?>