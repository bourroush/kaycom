<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="simple-column<?php if ($featured == 1) echo ' featured' ?>">

	<div class="header">
		<h4 class="title"><?php echo $title ?></h4>
		<div class="price">
			<h2 class="cost"><?php echo $price ?></h2>
			<span class="description"><?php echo $period ?></span>
		</div><!--/ .price-->
	</div><!-- .header -->
	<?php $content = explode('^', $content); ?>
	<?php if (!empty($content)): ?>
		<ul class="features">
			<?php foreach ($content as $text) : ?>
				<li><?php echo $text ?></li>
			<?php endforeach; ?>
		</ul><!-- .features -->
	<?php endif; ?>

	<div class="footer">
		<a href="<?php echo $button_link ?>" class="button large black"><?php echo $button_text ?></a>
	</div>

</div><!-- .column -->
