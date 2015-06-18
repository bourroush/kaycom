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
		
        $posts = get_posts($args);
	if (!isset($timeout)) $timeout = 5000;    
	
	?>

	<ul data-timeout="<?php echo $timeout ?>" class="quotes <?php echo $type ?>">
		
	<?php   foreach ($posts as $post){ ?>
				<li class="<?php echo $css_class; ?>">
					<?php
					if ($show_photo AND $type == 'type-1') {
						if (has_post_thumbnail($post->ID)) {
							?>
							<div class="quote-image"><img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $image_sizes); ?>" alt="<?php echo $post->post_title ?>" /></div>
							<?php
						}
					}
					?>
					<blockquote class="quote-text"><?php echo $post->post_content; ?></blockquote><!--/ .quote-text-->
					<?php
					?>
					<div class="quote-author">
						<?php 
						if ($show_photo AND $type == 'type-2') {
							if (has_post_thumbnail($post->ID)) {
								?>
								<div class="quote-image"><img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $image_sizes); ?>" alt="<?php echo $post->post_title ?>" /></div>
								<?php
							}
						}
						?>
						<span><?php echo $post->post_title; ?>, <?php echo get_post_meta($post->ID, 'position', true);  ?></span>
					</div>
				</li>
	<?php   } ?>
	</ul>

</div><!--/ .widget-container-->


