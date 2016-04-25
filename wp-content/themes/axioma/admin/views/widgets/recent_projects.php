<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_recent_projects">

	<?php
	TMM_Functions::enqueue_script('cycle');
	wp_reset_query();
	$query = new WP_Query(array(
		'post_type' => TMM_Portfolio::$slug,
		'showposts' => $instance['post_number'],
	));
	global $post;
	?>

	<?php if ($instance['title'] != '') : ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>

	<?php if ($instance['layout_style'] == 1): ?>
		<ul class="recent-projects type-1">

			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<li>
					<a class="single-image" href="<?php the_permalink(); ?>">
						<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '90*80'); ?>" alt="<?php the_title(); ?>">
					</a>
				</li>

				<?php
			endwhile;
		endif;
			?>

		</ul><!--/ .recent-projects-->
	<?php endif; ?>		

	<?php if ($instance['layout_style'] == 2): ?>
		
		<ul class="recent-projects type-2">
			
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

					<li>
						<?php if ($instance['show_thumbnail'] == 'true'): ?>
							<a class="single-image" href="<?php the_permalink(); ?>">
								<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '460*350'); ?>" alt="<?php the_title(); ?>">
							</a>
						<?php endif; ?>

						<?php if ($instance['show_title']): ?>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<?php endif; ?>

						<?php if ($instance['exerpt_symbols_count'] > 0): ?>
							<?php if ($instance['show_exerpt'] == true) : ?>
								<p>
									<?php
									if ((int) $instance['exerpt_symbols_count'] > 0) {
										echo substr(strip_tags(get_the_excerpt()), 0, (int) $instance['exerpt_symbols_count']) . " ...";
									} else {
										the_excerpt();
									}
									?>								
								<?php endif; ?>
							</p>
						<?php endif; ?>

						<?php if ($instance['show_button']): ?>
							<a class="button default medium" href="<?php echo get_post_type_archive_link(TMM_Portfolio::$slug) ?>"><?php _e('See all projects', 'axioma'); ?></a>
						<?php endif; ?>								

					</li>

					<?php
				endwhile;
			endif;
			?>

		</ul><!--/ .recent-projects-->
	<?php endif; ?>	

</div><!--/ .widget-->
