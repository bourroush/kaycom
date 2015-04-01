<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'newsplus') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('text'); ?>"><?php _e('Text', 'newsplus') ?>:</label>
    <textarea name="<?php echo $widget->get_field_name('text'); ?>" id="<?php echo $widget->get_field_id('text'); ?>" class="widefat"><?php echo $instance['text']; ?></textarea>
</p>


