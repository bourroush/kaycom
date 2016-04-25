<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
		global $post;
		$single_page_layout = get_post_meta($post->ID, 'single_page_layout', TRUE);
		if (empty($single_page_layout)) {
			$single_page_layout = 1;
		}
		?>
		<?php if ($single_page_layout == 1): ?>
	
			<div class="filter-holder clearfix">

				<div class="portfolio-items">

					<article id="post-<?php the_ID(); ?>">

						<?php
						$meta = get_post_custom($post->ID);
						if (!empty($meta["thememakers_portfolio"][0]) AND is_serialized($meta["thememakers_portfolio"][0])) {
							$pictures = unserialize($meta["thememakers_portfolio"][0]);
						}
						?>

						<?php if (!empty($pictures)): ?>

							<div class="project-thumb two-thirds column">

								<div class="image-post-slider">

									<ul>
										<?php if (is_array($pictures) AND !empty($pictures)): ?>
											<?php foreach ($pictures as $source_url) : ?>

												<li>
													<?php if (TMM_Helper::get_media_type($source_url) == 'image'): ?>

														<div class="work-item">

															<img alt="" src="<?php echo TMM_Helper::resize_image($source_url, '620*420') ?>">

															<div class="image-extra">
																
																<div class="extra-content">
																	
																	<div class="inner-extra">
																		
																		<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>">Image</a>
																	
																	</div><!--/ .inner-content-->	
																	
																</div><!--/ .extra-content-->
																
															</div><!--/ .image-extra-->													

														</div><!--/ .work-item-->

													<?php else: ?>
														<?php
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
																	echo do_shortcode('[tmm_video type="youtube" width="620" height="420"]' . $source_url . '[/tmm_video]');
																	break;
																case $allows_array[1]:
																	echo do_shortcode('[tmm_video type="vimeo" width="620" height="420"]' . $source_url . '[/tmm_video]');
																	break;
																default:
																	break;
															}
														}
														?>
													<?php endif; ?>	

												</li>

											<?php endforeach; ?>
										<?php endif; ?>
									</ul>

								</div><!--/ .image-post-slider-->

							</div><!--/ .project-thumb-->

						<?php endif; ?>

						<div class="project-meta one-third column">

							<h2><?php echo the_title() ?></h2>

							<?php the_content() ?>

							<div class="separator"></div>

							<ul class="project-details">
								<?php if (!TMM::get_option("single_folio_hide_metadata")): ?>
									<?php if (!empty($meta["portfolio_date"][0])): ?>
										<li><em><?php _e("Release", 'axioma') ?>:</em> <?php echo $meta["portfolio_date"][0] ?></li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if (!TMM::get_option("single_folio_hide_clients")): ?>
									<li>
										<?php $clients = get_the_term_list($post->ID, 'clients', '', ', ', '') ?>
										<?php if (!empty($clients)): ?>
											<em><?php _e('Clients', 'axioma'); ?>:</em> <?php echo $clients; ?><br />
										<?php endif; ?>
									</li>
								<?php endif; ?>

								<?php if (!TMM::get_option("single_folio_hide_skills")): ?>
									<li>
										<?php $skills = get_the_term_list($post->ID, 'skills', '', ', ', '') ?>
										<?php if (!empty($skills)): ?>
											<em><?php _e('Skills', 'axioma'); ?>:</em> <?php echo $skills; ?><br />
										<?php endif; ?>
									</li>
								<?php endif; ?>

								<?php if (!TMM::get_option("single_folio_hide_metadata")): ?>
									<li>
										<?php if (!empty($meta["portfolio_tools"][0])): ?>
											<em><?php _e('Tools', 'axioma'); ?>:</em> <?php echo $meta["portfolio_tools"][0] ?><br />
										<?php endif; ?>
									</li>
								<?php endif; ?>

							</ul><!--/ .project-details-->

							<?php if (!TMM::get_option("single_folio_hide_metadata")): ?>
								<?php if (!empty($meta["portfolio_url"][0])): ?>
									<a target="_blank" href="<?php echo $meta["portfolio_url"][0] ?>" class="button large default">
										<?php if (!empty($meta["portfolio_url"][0])): ?>
											<?php echo $meta["portfolio_url_title"][0] ?>
										<?php else: ?>
											<?php _e('View Project', 'axioma'); ?>
										<?php endif; ?>
									</a>
								<?php endif; ?>
							<?php endif; ?>

						</div><!--/ .project-meta-->

					</article>
					
					<div class="clear"></div>
		
					<?php if (class_exists('TMM_Ext_LayoutConstructor')) TMM_Ext_LayoutConstructor::draw_front($post->ID); ?>

					<?php if (TMM::get_option('folio_show_related_works')): ?>

						<?php
						$tags = wp_get_post_tags($post->ID);
						$tag_ids = array();

						if ($tags) {
							foreach ($tags as $tag_item)
								$tag_ids[] = $tag_item->term_id;
						}

						$query = new WP_Query(array(
							'tag__in' => $tag_ids,
							'post_type' => TMM_Portfolio::$slug,
							'post__not_in' => array($post->ID),
							'showposts' => 4
								)
						);
						?>

						<?php if ($query->post_count > 0): ?>

							<div class="clear"></div>
							<div class="separator"></div>

							<h4><?php _e("Related Projects", 'axioma') ?></h4>

							<section class="related-works">

								<?php
								if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
										?>

										<article class="four columns">

											<div class="work-item">

												<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '460*350'); ?>" alt="<?php the_title(); ?>" />

												<div class="image-extra">
													
													<div class="extra-content">
														
														<div class="inner-extra">

															<a class="single-image link-icon" href="<?php the_permalink(); ?>">Permalink</a>
															<a class="single-image plus-icon" data-fancybox-group="folio" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>
															<h4 class="extra-title"><?php the_title() ?></h4>		
															
														</div><!--/ .inner-extra-->

													</div><!--/ .extra-content-->
													
												</div><!--/ .image-extra-->													

											</div><!--/ .work-item-->

										</article>

										<?php
									endwhile;
								endif;
								?>
							</section><!--/ .related-->

						<?php endif; ?>
						<?php wp_reset_query(); ?>

					<?php endif; ?>					

				</div><!--/ .portfolio-items-->

			</div><!--/ .filter-holder-->

		<?php else: ?>

			<div class="filter-holder clearfix">

				<div class="portfolio-items">

					<article id="post-<?php the_ID(); ?>">

						<?php
						$meta = get_post_custom($post->ID);
						if (!empty($meta["thememakers_portfolio"][0]) AND is_serialized($meta["thememakers_portfolio"][0])) {
							$pictures = unserialize($meta["thememakers_portfolio"][0]);
						}
						?>

						<?php if (!empty($pictures)): ?>

							<div class="project-thumb sixteen columns">

								<div class="image-post-slider">

									<ul>
										<?php if (is_array($pictures) AND !empty($pictures)): ?>
											<?php foreach ($pictures as $source_url) : ?>

												<li>

													<?php if (TMM_Helper::get_media_type($source_url) == 'image'): ?>

														<div class="work-item">

															<img alt="" src="<?php echo TMM_Helper::resize_image($source_url, '940*520') ?>">

															<div class="image-extra">
																
																<div class="extra-content">
																	
																	<div class="inner-extra">
																		
																		<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>">Image</a>
																		
																	</div><!--/ .inner-extra-->
																	
																</div><!--/ .extra-content-->
																
															</div><!--/ .image-extra-->													

														</div><!--/ .work-item-->

													<?php else: ?>

														<?php
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
																	echo do_shortcode('[tmm_video type="youtube" width="940" height="520"]' . $source_url . '[/tmm_video]');
																	break;
																case $allows_array[1]:
																	echo do_shortcode('[tmm_video type="vimeo" width="940" height="520"]' . $source_url . '[/tmm_video]');
																	break;
																default:
																	break;
															}
														}
														?>
													<?php endif; ?>	

												</li>

											<?php endforeach; ?>
										<?php endif; ?>
									</ul>

								</div><!--/ .image-post-slider-->

							</div><!--/ .project-thumb-->

						<?php endif; ?>

						<div class="project-entry">

							<h2><?php echo the_title() ?></h2>

							<div class="two-thirds column">

								<?php the_content() ?>

								<?php if (!empty($meta["portfolio_url"][0])): ?>
									<p>
										<a target="_blank" href="<?php echo $meta["portfolio_url"][0] ?>" class="button large default">
											<?php if (!empty($meta["portfolio_url"][0])): ?>
												<?php echo $meta["portfolio_url_title"][0] ?>
											<?php else: ?>
												<?php _e('View Project', 'axioma'); ?>
											<?php endif; ?>
										</a>
									</p>	
								<?php endif; ?>	
							</div>

							<div class="one-third column">

								<?php if (!TMM::get_option("single_folio_hide_metadata")): ?>

									<div class="acc-box type-1">

										<?php if (!empty($meta["portfolio_date"][0])): ?>
											<span data-mode="toggle" class="acc-trigger">
												<a href="#"><?php _e("Date", 'axioma') ?></a>
											</span>
											<div class="acc-container">
												<p><?php echo $meta["portfolio_date"][0] ?></p>
											</div><!--/ .acc-container-->
										<?php endif; ?>

										<?php if (!TMM::get_option("single_folio_hide_clients")): ?>
											<?php $clients = get_the_term_list($post->ID, 'clients', '', ', ', '') ?>
											<?php if (!empty($clients)): ?>
												<span data-mode="toggle" class="acc-trigger">
													<a href="#"><?php _e('Clients', 'axioma'); ?></a>
												</span>

												<div class="acc-container">
													<p><?php echo $clients; ?></p>
												</div><!--/ .acc-container-->	
											<?php endif; ?>
										<?php endif; ?>

										<?php if (!TMM::get_option("single_folio_hide_skills")): ?>
											<?php $skills = get_the_term_list($post->ID, 'skills', '', ', ', '') ?>
											<?php if (!empty($skills)): ?>
												<span data-mode="toggle" class="acc-trigger">
													<a href="#"><?php _e('Skills', 'axioma'); ?></a>
												</span>

												<div class="acc-container">
													<p><?php echo $skills; ?></p>
												</div><!--/ .acc-container-->		
											<?php endif; ?>
										<?php endif; ?>

										<?php if (!empty($meta["portfolio_tools"][0])): ?>	
											<span data-mode="toggle" class="acc-trigger">
												<a href="#"><?php _e('Tools', 'axioma'); ?></a> 
											</span>
											<div class="acc-container">
												<p><?php echo $meta["portfolio_tools"][0] ?></p>
											</div><!--/ .acc-container-->
										<?php endif; ?>

									</div><!--/ .acc-box-->

								<?php endif; ?>	

							</div><!--/ .columns-->	

						</div><!--/ .project-entry-->

					</article>					
				
					<div class="clear"></div>
					
					<?php if (class_exists('TMM_Ext_LayoutConstructor')) TMM_Ext_LayoutConstructor::draw_front($post->ID); ?>

					<?php if (TMM::get_option('folio_show_related_works')): ?>

						<?php
						$tags = wp_get_post_tags($post->ID);
						$tag_ids = array();

						if ($tags) {
							foreach ($tags as $tag_item)
								$tag_ids[] = $tag_item->term_id;
						}

						$query = new WP_Query(array(
							'tag__in' => $tag_ids,
							'post_type' => TMM_Portfolio::$slug,
							'post__not_in' => array($post->ID),
							'showposts' => 4
								)
						);
						?>

						<?php if ($query->post_count > 0): ?>

							<div class="clear"></div>
							<div class="separator"></div>

							<h4><?php _e("Related Products", 'axioma') ?></h4>

							<section class="related-works">

								<?php
								if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
										?>

										<article class="four columns">

											<div class="work-item">

												<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '460*350'); ?>" alt="<?php the_title(); ?>" />

												<div class="image-extra">
													
													<div class="extra-content">

														<div class="inner-extra">

															<a class="single-image link-icon" href="<?php the_permalink(); ?>">Permalink</a>
															<a class="single-image plus-icon" data-fancybox-group="folio" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>
															<h4 class="extra-title"><?php the_title() ?></h4>			
															
														</div><!--/ .inner-extra-->

													</div><!--/ .extra-content-->
													
												</div><!--/ .image-extra-->													

											</div><!--/ .work-item-->

										</article>

										<?php
									endwhile;
								endif;
								?>
							</section><!--/ .related-->

						<?php endif; ?>
						<?php wp_reset_query(); ?>

					<?php endif; ?>					

				</div><!--/ .portfolio-items-->

			</div><!--/ .filter-holder-->

		<?php endif; ?>			
			
		<?php
	endwhile;
endif;
?>
<?php get_footer(); ?>