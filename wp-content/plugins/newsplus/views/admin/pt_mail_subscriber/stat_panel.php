<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<h4 class="stat-title"><?php _e('Sent', 'newsplus') ?></h4>

<?php
if (!empty($mail_stat_data['send_letter'])) {
	foreach ($mail_stat_data['send_letter'] as $date => $data) {
		?>
		<b class="stat-date"><?php echo $date ?>: <?php echo date("H:i", $data['time']) ?> <i><?php _e(sprintf('to %d users', $data['user_count']), 'newsplus') ?></i></b><br />
		<?php
	}
}
?>

<h4 class="stat-title"><?php _e('Referred by link', 'newsplus') ?></h4>
<?php echo $referred_by_link ?> <?php _e('users', 'newsplus') ?>