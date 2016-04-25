<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_social clearfix">

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php } ?>

    <ul class="social-icons clearfix">

		<?php if ($instance['twitter_links'] != '') { ?>
			<li class="twitter">
				<a title="<?php echo $instance['twitter_tooltip']; ?>" target="_blank" href="<?php echo $instance['twitter_links']; ?>"></a>
			</li>
		<?php } ?>

		<?php if ($instance['facebook_links'] != '') { ?>
			<li class="facebook">
				<a title="<?php echo $instance['facebook_tooltip']; ?>" target="_blank" href="<?php echo $instance['facebook_links']; ?>"></a>
			</li>
		<?php } ?>


		<?php if (@$instance['linkedin_links'] != '') { ?>
			<li class="linkedin">
				<a title="<?php echo $instance['linkedin_tooltip']; ?>" target="_blank" href="<?php echo $instance['linkedin_links']; ?>"></a>
			</li>
		<?php } ?>
			

		<?php if ($instance['dribbble_links'] != '') { ?>
			<li class="dribbble">
				<a title="<?php echo $instance['dribbble_tooltip']; ?>" target="_blank" href="<?php echo $instance['dribbble_links']; ?>"></a>
			</li>
		<?php } ?>

			
		<?php if ($instance['wordpress_links'] != '') { ?>
			<li class="wordpress">
				<a title="<?php echo $instance['wordpress_tooltip']; ?>" target="_blank" href="<?php echo $instance['wordpress_links']; ?>"></a>
			</li>
		<?php } ?>

			
		<?php if ($instance['gplus_tooltip'] != '') { ?>
			<li class="gplus">
				<a title="<?php echo $instance['gplus_tooltip']; ?>" target="_blank" href="<?php echo $instance['gplus_links']; ?>"></a>
			</li>
		<?php } ?>
			

		<?php if ($instance['vimeo_links'] != '') { ?>
			<li class="vimeo">
				<a title="<?php echo $instance['vimeo_tooltip']; ?>" target="_blank" href="<?php echo $instance['vimeo_links']; ?>"></a>
			</li>
		<?php } ?>

		<?php if ($instance['youtube_links'] != '') { ?>
			<li class="youtube">
				<a title="<?php echo $instance['youtube_tooltip']; ?>" target="_blank" href="<?php echo $instance['youtube_links']; ?>"></a>
			</li>
		<?php } ?>

		<?php if ($instance['show_rss_tooltip'] == 'true') { ?>
			<li class="rss">
				<a title="<?php echo $instance['rss_tooltip']; ?>" href="<?php
				if (TMM::get_option('feedburner')) {
					echo TMM::get_option('feedburner');
				} else {
					bloginfo('rss2_url');
				}
				?>">
				</a>
			</li>
		<?php } ?>

    </ul><!--/ .social-list-->		

</div><!--/ .widget_social-->

