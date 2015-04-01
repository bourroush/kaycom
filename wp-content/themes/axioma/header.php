<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if !(IE)]><!-->			<html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
	<head>
		<?php get_template_part('header', 'seocode'); ?>
		<!-- Google Web Fonts
	  ================================================== -->
		<?php echo TMM_HelperFonts::get_google_fonts_link() ?>

		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->

		<?php
		$favicon = TMM::get_option("favicon_img");
		if ($favicon) :
			?>
			<link href="<?php echo $favicon; ?>" rel="icon" type="image/x-icon" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon" />
		<?php endif; ?>

		<?php if (!isset($content_width)) $content_width = 960; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<style type="text/css" media="print">#wpadminbar { display: none; }</style>
		<?php wp_head(); ?>
		<?php echo TMM::get_option("tracking_code"); ?>
	</head>

	<?php
	$page_id = 0;
	if (is_single() OR is_page() OR is_front_page()) {
		global $post;
		$page_id = $post->ID;
	}

	//***

	if ((!is_single() OR !is_page()) AND is_front_page()) {
		remove_filter('the_content', 'wpautop');
	}
	?>
	<body <?php body_class(TMM::get_option('fixed_menu') ? 'header-fixed' : 'header-show'); ?> <?php if ($page_id > 0): ?>style="<?php echo TMM_Helper::get_page_backround($page_id) ?>"<?php endif; ?>>
		<div id="fb-root"></div>
		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

		<header id="header">

			<div class="header-front">

				<div class="container clearfix">

					<div class="sixteen columns">

						<div class="header-in">

							<!-- - - - - - - - - - - - Logo - - - - - - - - - - - - - -->

							<?php
							$logo_type = TMM::get_option("logo_type");
							$logo_text = TMM::get_option("logo_text");
							$logo_img = TMM::get_option("logo_img");
							?>

							<?php if (!$logo_type AND $logo_text) : ?>
								<a id="logo" title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><h1><?php echo $logo_text; ?></h1></a>
							<?php elseif ($logo_type AND $logo_img) : ?>
								<a id="logo" title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_img; ?>" alt="<?php bloginfo('description'); ?>" /></a>
							<?php else : ?>
								<a id="logo" title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><h1><img src="<?php echo TMM_THEME_URI ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></h1></a>
							<?php endif; ?>

							<!-- - - - - - - - - - - end Logo - - - - - - - - - - - - -->


							<!-- - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - -->

							<nav id="navigation" class="navigation">
								<?php wp_nav_menu(array('theme_location' => 'primary', 'container_class' => false)); ?>
							</nav><!--/ #navigation-->

							<!-- - - - - - - - - - - - end Navigation - - - - - - - - - - - - - -->

						</div><!--/ .header-in-->

					</div><!--/ .columns-->

				</div><!--/ .container-->

			</div><!--/ .header-front-->

		</header><!--/ #header-->

		<!-- - - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - - -->

		<?php
		$slider_html = "";
		if ($page_id > 0 AND is_object($post)) {
			$slider_width = get_post_meta($post->ID, 'page_slider_width', true);
			$slider_html = TMM_Ext_Sliders::draw_page_slider($post->ID);
		}
		?>

		<?php $headerbg_hide = (int) get_post_meta($page_id, 'headerbg_hide', true); ?>

		<?php if (!empty($slider_html)): ?>
			<!-- - - - - - - - - - - - - Slider - - - - - - - - - - - - - - - -->
			<?php if ($slider_width == 'fixed'): ?><div class="container"><?php endif; ?>
			<?php echo $slider_html ?>
				<?php if ($slider_width == 'fixed'): ?></div><?php endif; ?>
			<!-- - - - - - - - - - - - - end Slider - - - - - - - - - - - - - - -->
		<?php else: ?>
			<!-- - - - - - - - - - - - - - Page Header - - - - - - - - - - - - - - - - -->

			<?php if (!$headerbg_hide): ?>
				<?php
				$header_bg = array('image' => '', 'color' => '');
				if ($page_id > 0 AND is_object($post))
					$header_bg = TMM_Helper::get_header_bg($page_id);
				?>
				<div class="page-header <?php echo get_post_meta($page_id, 'another_page_content_align', true) ?>" <?php echo $header_bg['color'] ?>>

					<div class="page-header-bg" <?php echo $header_bg['image'] ?>></div>

					<div class="container">

						<div class="sixteen columns">

							<?php if (is_404()): ?>
								<h1><?php _e("Page not Found", 'axioma') ?></h1>
							<?php else: ?>

								<?php if (is_home()): ?>
									<h1><?php bloginfo('description'); ?></h1>
								<?php endif; ?>

								<?php if (is_single() OR is_page()): ?>

									<?php
									$page_title = $post->post_title;
									$another_page_title = get_post_meta($post->ID, 'another_page_title', true);
									$another_page_description = get_post_meta($post->ID, 'another_page_description', true);
									if (!empty($another_page_title)) {
										$page_title = $another_page_title;
									}
									?>

									<?php
									switch ($post->post_type) {
										case TMM_Portfolio::$slug:
											?>

											<h1 class="folio-page-title"><?php echo $page_title ?></h1>

											<?php
											$next_post = get_next_post();
											$prev_post = get_previous_post();

											$next_post_url = "";
											$prev_post_url = "";

											// if (is_object($next_post)) {
											// 	$next_post_url = get_permalink($next_post->ID);
											// }

											// if (is_object($prev_post)) {
											// 	$prev_post_url = get_permalink($prev_post->ID);
											// }

											if (is_object($next_post)) {
												$next_post_url = get_permalink(cml_get_linked_post($next_post->ID, CMLLanguage::get_current_slug()));
											}

											if (is_object($prev_post)) {
												$prev_post_url = get_permalink(cml_get_linked_post($prev_post->ID, CMLLanguage::get_current_slug()));
											}

											?>

											<ul class="project-nav clearfix">

												<?php if (!empty($next_post_url)): ?>
													<!-- <li><a href="<?php echo $next_post_url ?>" class="prev"><?php _e("Prev", 'axioma') ?></a></li> -->
												<?php endif; ?>

												<li>
													<a href="<?php echo do_shortcode("[cml_text en='/en/products' fr='/fr/produits']") ?>" class="all-projects"><?php _e("All Products", 'axioma') ?></a>
												</li>

												<?php if (!empty($prev_post_url)): ?>
													<!-- <li><a href="<?php echo $prev_post_url ?>" class="next"><?php _e("Next", 'axioma') ?></a></li> -->
												<?php endif; ?>

											</ul><!--/ .project-nav-->

											<?php
											break;

										default:
											?>
											<h1 <?php echo ((strlen($post->post_title) > 23) ? "class='font-small'" : '') ?>><?php echo $page_title ?></h1>
											<?php
											break;
									}
									?>

									<?php if (!empty($another_page_description)): ?>
										<h3><?php echo $another_page_description; ?></h3>
									<?php endif; ?>
								<?php endif; ?>

								<?php if (is_search()): ?>
									<h1><?php printf(__('Search Results for: %s', 'axioma'), '<span>' . get_search_query() . '</span>'); ?></h1>
								<?php endif; ?>

								<?php if (is_tag()): ?>
									<h1><?php printf(__('Tag Archives: %s', 'axioma'), '<span>' . single_tag_title('', false) . '</span>'); ?></h1>
								<?php endif; ?>

								<?php
								$queried_object = get_queried_object();
								$is_defined = false;
								?>

								<?php if (is_object($queried_object)): ?>
									<?php if (@$queried_object->taxonomy == 'skills'): $is_defined = true; ?>
										<h1><?php printf(__('Folios by Skills: %s', 'axioma'), '<span>' . $queried_object->name . '</span>'); ?></h1>
									<?php elseif (@$queried_object->taxonomy == 'clients'):$is_defined = true; ?>
										<h1><?php printf(__('Folios by Clients: %s', 'axioma'), '<span>' . $queried_object->name . '</span>'); ?></h1>
									<?php endif; ?>
								<?php endif; ?>


								<?php if (is_archive() AND !$is_defined): ?>

									<?php if (is_post_type_archive(TMM_Portfolio::$slug)): ?>
										<h1 class="page-title">
											<?php if (is_day()) : ?>
												<?php printf(__('Daily Portfolio Archives: %s', 'axioma'), '<span>' . get_the_date() . '</span>'); ?>
											<?php elseif (is_month()) : ?>
												<?php printf(__('Monthly Portfolio Archives: %s', 'axioma'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'axioma')) . '</span>'); ?>
											<?php elseif (is_year()) : ?>
												<?php printf(__('Yearly Portfolio Archives: %s', 'axioma'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'axioma')) . '</span>'); ?>
											<?php else : ?>
												<?php _e('Portfolio Archives', 'axioma'); ?>
											<?php endif; ?>
										</h1>
									<?php endif; ?>

									<?php if (is_object($queried_object)): ?>
										<?php if (@$queried_object->taxonomy == 'category'):$is_defined = true; ?>
											<h1><?php printf(__('Category: %s', 'axioma'), '<span>' . do_shortcode("[cml_translate string='" . $queried_object->name . "' in='" . CMLLanguage::get_current_slug() . "']") . '</span>'); ?></h1>


										<?php endif; ?>
									<?php endif; ?>

									<?php if (is_post_type_archive() != TMM_Portfolio::$slug AND $is_defined == false): ?>
										<h1 class="page-title">
											<?php if (is_day()) : ?>
												<?php printf(__('Daily Archives: %s', 'axioma'), '<span>' . get_the_date() . '</span>'); ?>
											<?php elseif (is_month()) : ?>
												<?php printf(__('Monthly Archives: %s', 'axioma'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'axioma')) . '</span>'); ?>
											<?php elseif (is_year()) : ?>
												<?php printf(__('Yearly Archives: %s', 'axioma'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'axioma')) . '</span>'); ?>
											<?php else : ?>
												<?php _e('Blog Archives', 'axioma'); ?>
											<?php endif; ?>
										</h1>

									<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>


							<?php if (!TMM::get_option("hide_breadcrumb")): ?>
								<?php if (!is_404()): ?>
									<div class="breadcrumbs">
										<?php TMM_Helper::draw_breadcrumbs() ?>
									</div><!--/ .breadcrumbs-->
								<?php endif; ?>
							<?php endif; ?>
						</div>

					</div><!--/ .container-->

				</div><!--/ .page-header-->
			<?php endif; ?>
			<!-- - - - - - - - - - - - - end Page Header - - - - - - - - - - - - - - - -->

		<?php endif; ?>



		<?php
		$sidebar_position = "sbr";

		$_REQUEST['sidebar_position'] = $sidebar_position;

		if (is_single() AND $post->post_type == TMM_Portfolio::$slug) {
			$_REQUEST['sidebar_position'] = 'no_sidebar';
			$sidebar_position = 'no_sidebar';
		} else {

			$page_sidebar_position = "default";

			if (!is_404()) {
				if (is_single() OR is_page()) {
					$page_sidebar_position = get_post_meta(get_the_ID(), 'page_sidebar_position', TRUE);
				}

				if (!empty($page_sidebar_position) AND $page_sidebar_position != 'default') {
					$sidebar_position = $page_sidebar_position;
				} else {
					$sidebar_position = TMM::get_option("sidebar_position");
				}

				if (!$sidebar_position) {
					$sidebar_position = "sbr";
				}

				//*****
			} else {
				$sidebar_position = 'no_sidebar';
			}
		}

//is portfolio archive
		if (is_archive()) {
			if (is_post_type_archive(TMM_Portfolio::$slug)) {
				$sidebar_position = TMM::get_option('folio_archive_sidebar');
				if (empty($sidebar_position)) {
					$sidebar_position = 'no_sidebar';
				}
			}
		}

		$_REQUEST['sidebar_position'] = $sidebar_position;
		?>


		<!-- - - - - - - - - - - - - - Main - - - - - - - - - - - - - - - - -->


		<section id="content" class="<?php echo $sidebar_position ?>" <?php if ($headerbg_hide == 1): ?>style="padding-top: 0;"<?php endif; ?>>

			<div class="container">

				<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?>

					<section class="eleven columns" id="main">

					<?php endif; ?>


