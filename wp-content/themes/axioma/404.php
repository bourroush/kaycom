<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<!-- - - - - - - - - - - - 404  - - - - - - - - - - - - - - -->	

<div class="error-404 clearfix">

	<h2 class="title"><?php _e('Ooops', 'axioma'); ?>!</h2>

	<div class="error-entry">

		<h1>404</h1>

		<div class="error-text-style"><?php _e('We Can\'t Find', 'axioma'); ?></div>
		<span class="error-big-text-style"><?php _e('what', 'axioma'); ?></span>

		<div class="alignleft">
			<span class="error-text-style"><?php _e('You\'re', 'axioma'); ?></span> <br />
			<span class="error-text-style"><?php _e('LOOKING For', 'axioma'); ?></span>
			<div class="clear"></div>
			<a href="/" class="button default large"><?php _e('Get Me Back to Homepage', 'axioma'); ?>!</a>
		</div>

	</div><!--/ .error-entry-->

</div><!--/ .error-404-->

<!-- - - - - - - - - - - end 404  - - - - - - - - - - - - - -->	

<?php get_footer(); ?>
