<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$content = explode('^', $content);
$titles = explode('^', $titles);
$links = explode('^', $links);
$icons = explode(',', $icons);
$colors = explode(',', $colors);
?>
<?php if ($type == 1): ?>
	<ul class="ch-grid clearfix">
		<?php if (!empty($content)): ?>
			<?php foreach ($content as $key => $text) : ?>
				<li>
					<div class="ch-item"><a target="_blank" href="<?php echo $links[$key] ?>"><h3><?php echo $titles[$key] ?></h3><div style="background-color: <?php echo $colors[$key] ?>" class="ch-info"><i class="<?php echo $icons[$key] ?>"></i></div></a></div><!--/ .ch-item-->
					<p><?php echo $text ?></p>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul><!--/ .ch-grid-->
<?php else : ?>
	<?php if (!empty($content)): ?>
		<?php foreach ($content as $key => $text) : ?><div class="ca-shortcode"><i class="ca-icon <?php echo $icons[$key] ?>"></i><div class="ca-content"><h4 class="ca-title"><?php if (!empty($links[$key])) : ?><a target="_blank" href="<?php echo $links[$key] ?>"><?php echo $titles[$key] ?></a><?php else : ?><?php echo $titles[$key] ?><?php endif; ?></h4><p><?php echo $text ?></p></div></div><?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>