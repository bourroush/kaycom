<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_testimonials">

	<?php
	
	TMM_Functions::enqueue_script('cycle');
	
	//***
	$args = array();

	if ($show == 'mode1') {
		$args = array(
			'post_type' => TMM_Testimonials::$slug,
			'p' => $content,
		);
	} elseif ($show == 'mode2') {
		$args = array(
			'post_type' => TMM_Testimonials::$slug,
			'orderby' => 'rand',
			'posts_per_page' => $count,
		);
	} else {
		$args = array(
			'post_type' => TMM_Testimonials::$slug,
			'posts_per_page' => $count,
		);
	}

	// Align
	if (!empty($align)) {
		$css_class = $align;
	}
	
	switch($type) {
		case 'type-1':
			$image_sizes = '140*140';
		break;
		case 'type-2':
			$image_sizes = '50*50';
		break;
		default: 
			$image_sizes = '140*140';
		break;
	}
	
	$query = new WP_Query($args);
	if (!isset($timeout)) $timeout = 5000;
	
	?>

	<ul data-timeout="<?php echo $timeout ?>" class="quotes <?php echo $type ?>">
		
	<?php
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
				?>
				<li class="<?php echo $css_class; ?>">
					<?php
					if ($show_photo AND $type == 'type-1') {
						if (has_post_thumbnail(get_the_ID())) {
							?>
							<div class="quote-image"><img src="<?php echo TMM_Helper::get_post_featured_image(get_the_ID(), $image_sizes); ?>" alt="<?php the_title(); ?>" /></div>
							<?php
						}
					}
					?>
					<blockquote class="quote-text"><?php the_content(); ?></blockquote><!--/ .quote-text-->
					<?php
					?>
					<div class="quote-author">
						<?php 
						if ($show_photo AND $type == 'type-2') {
							if (has_post_thumbnail(get_the_ID())) {
								?>
								<div class="quote-image"><img src="<?php echo TMM_Helper::get_post_featured_image(get_the_ID(), $image_sizes); ?>" alt="<?php the_title(); ?>" /></div>
								<?php
							}
						}
						?>
						<span><?php the_title(); ?>, <?php echo get_post_meta(get_the_ID(), 'position', true);  ?></span>
					</div>
				</li>
				<?php
			endwhile;
		endif;
		?>
	</ul>
<?php wp_reset_query(); ?>
</div><!--/ .widget-container-->


