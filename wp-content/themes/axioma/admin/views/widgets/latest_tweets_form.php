<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('twitter_id'); ?>"><?php _e('Twitter Widget ID', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('twitter_id'); ?>" name="<?php echo $widget->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('postcount'); ?>"><?php _e('Number of tweets', 'axioma') ?>:</label>
    <input class="widefat" type="text" id="<?php echo @$widget->get_field_id('postcount'); ?>" name="<?php echo @$widget->get_field_name('postcount'); ?>" value="<?php echo @$instance['postcount']; ?>" />
</p>

