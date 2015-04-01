<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
TMM_Functions::enqueue_script('cycle');
TMM_Functions::enqueue_script('isotope');
//***
$layout = $content;
if (!$posts_per_page) {
	$posts_per_page = 6;
}
//***
$tax_query_array = array();
//***
if (!isset($skills)) {
	$skills = 'all';
}

if (!isset($clients)) {
	$clients = 'all';
}

if (!isset($tags)) {
	$tags = '';
}
//***
if ($skills != 'all') {
	$tax_query_array[] = array(
		'taxonomy' => 'skills',
		'field' => 'term_id',
		'terms' => array($skills),
	);
}

if ($clients != 'all') {
	$tax_query_array[] = array(
		'taxonomy' => 'clients',
		'field' => 'term_id',
		'terms' => array($clients),
	);
}
$folio_page = 1;
if (isset($_GET['folio_page'])) {
	$folio_page = $_GET['folio_page'];
}
global $post;
$current_page_id = $post->ID;
//***
$w_query = new WP_Query();
$query = $w_query->query(array(
	'tag' => $tags,
	'tax_query' => $tax_query_array,
	'post_type' => TMM_Portfolio::$slug,
	'orderby' => 'name',
	'order' => 'ASC',
	'posts_per_page' => -1,
	'paged' => $folio_page
		)
);


//***
$article_css_class = "";
$featured_image_alias = "460*350";
switch ($layout) {
	case 2:
		$article_css_class = "eight columns";
		break;
	case 3:
		$article_css_class = "one-third column";
		break;
	case 4:
		$article_css_class = "four columns";
		break;
	default:
		break;
}
?>

<div class="filter-holder clearfix">

	<?php if ($layout != 1): ?>

		<ul id="portfolio-filter" class="portfolio-filter clearfix">

			<?php
			$folio_tags = array();
			$posts_tags = array();
			foreach ($query as $p) {
				$tmp = wp_get_post_tags($p->ID);
				foreach ($tmp as $tag_object) {
					$folio_tags[$tag_object->term_id] = $tag_object;
					$posts_tags[$p->ID][] = $tag_object;
				}
			}
			?>
			<li><a data-categories="*" class=""><?php _e(do_shortcode("[cml_text en='All' fr='Tous']"), 'tmm_shortcodes'); ?></a></li>
			<li><a data-categories="70"><?php echo do_shortcode("[cml_translate string='Defence' in='" . CMLLanguage::get_current_slug() . "']") ?></a></li>
			<li><a data-categories="71"><?php echo do_shortcode("[cml_translate string='Commercial/Industrial' in='" . CMLLanguage::get_current_slug() . "']") ?></a></li>

			
		</ul><!--/ .portfolio-filter-->

	<?php endif; ?>

	<section id="portfolio-items" class="portfolio-items clearfix">

		<?php foreach ($query as $post) : ?>

			<?php
			$tag_css_class = "";

			if (isset($posts_tags[$post->ID])) {
				$tags = $posts_tags[$post->ID];
				if (!empty($tags)) {
					foreach ($tags as $key => $tag) {
						if ($key > 0) {
							$tag_css_class .= " ";
						}
						$tag_css_class .= $tag->term_id;
					}
				}
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($article_css_class . ' '); ?> data-categories="<?php echo $tag_css_class ?>">

				<div class="work-item">
					
					<?php 
	
						switch ($layout) {
							case 2:
								$disable_icons = TMM::get_option('folio_disable_icons_2col');
								break;
							case 3:
								$disable_icons = TMM::get_option('folio_disable_icons_3col');
								break;
							case 4:
								$disable_icons = TMM::get_option('folio_disable_icons_4col');
								break;
							default:
								break;
						}					
					
					?>
					
					<?php if ($disable_icons): ?>
					
						<a href="<?php echo get_permalink( $post->ID ); ?>" class="single-image full-link">
							<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $featured_image_alias); ?>" alt="<?php the_title(); ?>" />
						</a>
					
					<?php else: ?>

						<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $featured_image_alias); ?>" alt="<?php the_title(); ?>" />

						<div class="image-extra">

							<div class="extra-content">
								<a class="single-image link-icon" href="<?php echo get_permalink( $post->ID ); ?>">Permalink</a>
								<a class="single-image plus-icon" data-fancybox-group="gallery" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>

								<h4 class="extra-title"><?php echo $post->post_title ?></h4>
								<?php
								if (!isset($show_categories)) {
									$show_categories = 1;
								}
								?>
								<?php if ($show_categories): ?>
									<span class="extra-category">
										<?php
										$tags = wp_get_post_tags($post->ID);
										foreach ($tags as $key => $value) {
											if ($key > 0) {
												echo ' / ';
											}
											echo $value->name;
										}
										?>
									</span><!--/ .extra-category-->
								<?php endif; ?>
							</div><!--/ .extra-content-->	

						</div><!--/ .image-extra-->	
					
					<?php endif; ?>

				</div><!--/ .work-item-->

			</article><!--/ .project-item-->

			<?php
		endforeach;
		?>

	</section><!--/ .portfolio-items-->

</div><!--/ .filter-holder-->

<?php if ($w_query->max_num_pages > 1): ?>
	<div class="wp-pagenavi">

		<?php if ($folio_page - 1 > 0): ?>
			<a href="<?php echo get_permalink($current_page_id) ?>?folio_page=<?php echo($folio_page - 1) ?>" class="prev page-numbers"></a>
		<?php endif; ?>

		<?php for ($i = 0; $i < $w_query->max_num_pages; $i++): ?>

			<?php if ($folio_page == ($i + 1)): ?>
				<span class="page-numbers current"><?php echo($i + 1) ?></span>
			<?php else: ?>
				<a href="<?php echo get_permalink($current_page_id) ?>?folio_page=<?php echo($i + 1) ?>" class="page-numbers"><?php echo ($i + 1) ?></a>
			<?php endif; ?>

		<?php endfor; ?>

		<?php if ($folio_page < $w_query->max_num_pages): ?>
			<a href="<?php echo get_permalink($current_page_id) ?>?folio_page=<?php echo($folio_page + 1) ?>" class="next page-numbers"></a>
		<?php endif; ?>

	</div>
<?php endif; ?>
