<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
wp_enqueue_script('tmm_masonry', TMM_Ext_Shortcodes::get_application_uri() . 'js/shortcodes/jquery.masonry.min.js');
$folioposts_array = explode('^', $folioposts);
$folioposts_array_icl = array();

if (function_exists('icl_object_id')){
    if (!empty($folioposts_array)){
        foreach($folioposts_array as $post_id){
            $folioposts_array_icl[] = icl_object_id($post_id, 'folio', false, ICL_LANGUAGE_CODE); 
        }
    }
    $folioposts_array = $folioposts_array_icl;
}

if (!empty($folioposts_array)) {
	$foliopost = $folioposts_array[0];
}

//***
$type = $content;

if ($type == 1) {
	$images = get_post_meta($foliopost, 'thememakers_portfolio', true);   
        
	if (!empty($images)) {
		foreach ($images as $k => $img) {                    
			if (!TMM_Helper::is_file_url_exists($img)) {
				unset($images[$k]);
			}
		}
	}
        
        
} else {
	if (!empty($folioposts_array)) {
		foreach ($folioposts_array as $p_id) {
			if (has_post_thumbnail($p_id)) {
				$images[] = TMM_Helper::get_post_featured_image($p_id, '');
			}
		}
	}
}

//***
if ($columns == 3) {
	$col_algorithms = array(
		'random' => 'random',
		1 => 'col2,col3,col2,col1,col2,col2,col2,col3,col2,col2,col1,col2,col2,col3,col2,col3,col2,col1,col2',
		2 => 'col3,col1,col2,col1,col3,col2,col2,col3,col2',
	);
}

if ($columns == 4) {
	$col_algorithms = array(
		'random' => 'random',
		1 => 'col1,col2,col3,col2,col2,col2,col2,col2,col2,col3,col2,col1,col2,col1,col2,col3,col2,col2,col1',
		2 => 'col3,col1,col2,col1,col3,col2,col2,col1,col2',
	);
}
//***
$current_col_algoritm = $col_algorithms[$col_alg];
$current_col_algoritm_arr = array();
if ($current_col_algoritm == 'random') {
	unset($col_algorithms['random']);
	shuffle($col_algorithms);
	reset($col_algorithms);
	$first_key = key($col_algorithms);
	$current_col_algoritm_arr = explode(',', $col_algorithms[$first_key]);
} else {
	$current_col_algoritm_arr = explode(',', $current_col_algoritm);
}

//***
if ($columns == 3) {
	$columns_img_sizes = array('col1' => '300*190', 'col2' => '300*250', 'col3' => '300*310');
}

if ($columns == 4) {
	$columns_img_sizes = array('col1' => '228*170', 'col2' => '228*250', 'col3' => '228*340');
}
//***
$counter = 0;
?>
<?php if (!empty($folioposts_array)): ?>

	<script type="text/javascript">	var IE8 = false;</script>
	<!--[if IE 8]><script type="text/javascript">IE8 = true;</script><![endif]-->

	<script type="text/javascript">
		jQuery(function() {
			jQuery("#masonry").imagesLoaded(function() {
				var columnWidth = 300;//$columns == 3
	<?php if ($columns == 4): ?>
					columnWidth = 228;
	<?php endif; ?>

				init_masonry(columnWidth);
			});
		});
	</script>

<?php endif; ?>    

<div id="masonry" class="masonry" style="opacity: 0;">
	<?php if (!empty($images)): ?>
		<?php foreach ($images as $key => $image){ ?>
			<?php
			$col = $current_col_algoritm_arr[$counter];
			$counter++;
			if ($counter >= count($current_col_algoritm_arr))
				$counter = 0;

			//
			if ($type == 2) {
				$foliopost = $folioposts_array[$key];
				$post = get_post($foliopost);
			}
                                                
			?>

			<article class="box <?php echo $col ?>">

				<div class="work-item">

					<img src="<?php echo TMM_Helper::resize_image($image, $columns_img_sizes[$col]) ?>" alt="" />

					<div class="image-extra">

						<div class="extra-content">
							
							<div class="inner-extra">
								
								<a class="single-image link-icon" href="<?php echo get_permalink($foliopost) ?>">Permalink</a>
								<a class="single-image plus-icon" data-fancybox-group="masonry" href="<?php echo $image ?>">Image</a>

								<?php if ($type == 2): ?>
									<h4 class="extra-title"><?php echo $post->post_title ?></h4>
									<span class="extra-category">
										<?php
										$tags = wp_get_post_tags($post->ID);
										foreach ($tags as $kk => $value) {
											if ($kk > 0) {
												echo ' / ';
											}
											echo $value->name;
										}
										?>
									</span><!--/ .extra-category-->
								<?php endif; ?>
									
							</div><!--/ .inner-extra-->
							
						</div><!--/ .extra-content-->	

					</div><!--/ .image-extra-->

				</div><!--/ .work-item-->

			</article><!--/ .box-->

                <?php } ?>

		<?php if (!empty($folioposts_array)): ?>
			<div id="masonryjaxloader" data-next-post-key="1" data-posts="<?php echo $folioposts ?>" data-col-algoritm="<?php echo $current_col_algoritm ?>"></div>
		<?php endif; ?>

	<?php endif; ?>

</div><!--/ #masonry-->		

<div id="infscr-loading">
	<img src="<?php echo TMM_THEME_URI ?>/images/icons/ajax-loader.gif" alt="Loading...">
</div>
<?php if ($type == 1): ?>
	<a href="javascript:masonry_reload(<?php echo $type ?>,<?php echo $columns ?>);void(0);" class="masonry_view_more_button"><?php _e('More', 'tmm_shortcodes'); ?></a>
<?php endif; ?>
<div class="clear"></div>
<?php wp_reset_query(); ?>
