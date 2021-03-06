<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('category'); ?>"><?php _e('Posts Category', 'axioma') ?>:</label>
	<?php
	$args = array(
		'hide_empty' => 0,
		'show_option_all' => __('All Categories', 'axioma'),
		'echo' => 0,
		'selected' => $instance['category'],
		'hierarchical' => 0,
		'id' => $widget->get_field_id('category'),
		'name' => $widget->get_field_name('category'),
		'class' => 'widefat',
		'depth' => 0,
		'tab_index' => 0,
		'taxonomy' => 'category',
		'hide_if_empty' => false
	);
	echo wp_dropdown_categories($args);
	?>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('post_number'); ?>"><?php _e('Post Number', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('post_number'); ?>" name="<?php echo $widget->get_field_name('post_number'); ?>" value="<?php echo $instance['post_number']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_thumbnail'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_thumbnail'); ?>" name="<?php echo $widget->get_field_name('show_thumbnail'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_thumbnail'); ?>"><?php _e('Display Thumbnail', 'axioma') ?>:</label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_exerpt'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_exerpt'); ?>" name="<?php echo $widget->get_field_name('show_exerpt'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_exerpt'); ?>"><?php _e('Display Excerpt', 'axioma') ?></label>
</p>


<p>
    <label for="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>"><?php _e('Excerpt symbols count', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>" name="<?php echo $widget->get_field_name('exerpt_symbols_count'); ?>" value="<?php echo $instance['exerpt_symbols_count']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_see_all_button'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_see_all_button'); ?>" name="<?php echo $widget->get_field_name('show_see_all_button'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_see_all_button'); ?>"><?php _e('Display "View all" button', 'axioma') ?></label>
</p>

