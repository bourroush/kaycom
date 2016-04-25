<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class ThemeMakers_Mail_Subscriber_Newsletters_Widget extends WP_Widget {

    //Widget Setup
    function __construct() {
        //Basic settings
        $settings = array('classname' => __CLASS__, 'description' => __('Newsletters Subscriptions', 'newsplus'));

        //Creation
        $this->WP_Widget(__CLASS__, __('ThemeMakers Newsletters Subscriptions', 'newsplus'), $settings);
    }

    //Widget view
    function widget($args, $instance) {
		global $tm_ms_controller;
        $args['instance'] = $instance;
		wp_enqueue_script('mail_subscriber_newsletters', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'js/widgets/newsletters_subscriptions.js',array('jquery'));
        echo $tm_ms_controller->draw_html('widgets/newsletters_subscriptions', $args);
    }

    //Update widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['text'] = $new_instance['text'];
        return $instance;
    }

    //Widget form
    function form($instance) {
        //Defaults
        $defaults = array(
            'title' => __('Keep in touch with us', 'newsplus'),
            'text' => __("Subscribe to our newsletters to keep up with our company latest news and events", 'newsplus'),
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $args = array();
        $args['instance'] = $instance;
        $args['widget'] = $this;
		global $tm_ms_controller;
        echo $tm_ms_controller->draw_html('widgets/newsletters_subscriptions_form', $args);
    }

}

