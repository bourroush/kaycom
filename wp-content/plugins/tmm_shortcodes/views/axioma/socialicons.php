<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$social_types = explode('^', $social_types);
$links = explode('^', $links);
?>

<?php if (!empty($social_types)): ?>

	<ul class="social-icons">

		<?php foreach ($social_types as $key => $type) : ?>
			<li class="<?php echo $type ?>">
				<a href="<?php echo $links[$key] ?>"></a>
			</li>
		<?php endforeach; ?>

	</ul>

<?php endif; ?>