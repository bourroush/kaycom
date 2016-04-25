<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Testimonials_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Rotates testimonials in random order.', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Testimonials', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/testimonials', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_id'] = (int) $new_instance['post_id'];
		$instance['show'] = (int) $new_instance['show'];
		$instance['timeout'] = (int) $new_instance['timeout'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Testimonials',
			'post_id' => 0,
			'show' => 0,
			'timeout' => 3000,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/testimonials_form', $args);
	}

}

class TMM_Latest_Tweets_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays latest tweets', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Latest Tweets', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/latest_tweets', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['postcount'] = (int) $new_instance['postcount'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Latest on Twitter',
			'twitter_id' => '352020786023895042',
			'postcount' => 2,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/latest_tweets_form', $args);
	}

}

class TMM_Social_Links_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays website social links', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Social Links', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/social_links', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['twitter_links'] = $new_instance['twitter_links'];
		$instance['twitter_tooltip'] = $new_instance['twitter_tooltip'];
		$instance['facebook_links'] = $new_instance['facebook_links'];
		$instance['facebook_tooltip'] = $new_instance['facebook_tooltip'];
		$instance['linkedin_links'] = $new_instance['linkedin_links'];
		$instance['linkedin_tooltip'] = $new_instance['linkedin_tooltip'];
		$instance['dribbble_links'] = $new_instance['dribbble_links'];
		$instance['dribbble_tooltip'] = $new_instance['dribbble_tooltip'];
		$instance['wordpress_links'] = $new_instance['wordpress_links'];
		$instance['wordpress_tooltip'] = $new_instance['wordpress_tooltip'];
		$instance['gplus_links'] = $new_instance['gplus_links'];
		$instance['gplus_tooltip'] = $new_instance['gplus_tooltip'];
		$instance['vimeo_links'] = $new_instance['vimeo_links'];
		$instance['vimeo_tooltip'] = $new_instance['vimeo_tooltip'];
		$instance['youtube_links'] = $new_instance['youtube_links'];
		$instance['youtube_tooltip'] = $new_instance['youtube_tooltip'];
		$instance['rss_tooltip'] = $new_instance['rss_tooltip'];
		$instance['show_rss_tooltip'] = $new_instance['show_rss_tooltip'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Social Links',
			'twitter_tooltip' => 'Twitter',
			'twitter_links' => 'https://twitter.com/ThemeMakers',	
			'facebook_tooltip' => 'Facebook',
			'facebook_links' => 'http://www.facebook.com/wpThemeMakers',
			'linkedin_tooltip' => 'Linkedin',
			'linkedin_links' => 'http://linkedin.com/',
			'dribbble_tooltip' => 'Dribbble',
			'dribbble_links' => 'http://dribbble.com/',
			'wordpress_tooltip' => 'Wordpress',
			'wordpress_links' => 'http://wordpress.com/',
			'gplus_tooltip' => 'Google Plus',
			'gplus_links' => 'http://plus.google.com/',
			'vimeo_tooltip' => 'Vimeo',
			'vimeo_links' => 'https://vimeo.com/',
			'youtube_tooltip' => 'Youtube',
			'youtube_links' => 'https://youtube.com/',
			'rss_tooltip' => 'RSS',
			'show_rss_tooltip' => 'false',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/social_links_form', $args);
	}

}

class TMM_Recent_Posts_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays recent blog posts', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Recent Posts', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/recent_posts', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['category'] = $new_instance['category'];
		$instance['post_number'] = $new_instance['post_number'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		$instance['show_exerpt'] = $new_instance['show_exerpt'];
		$instance['exerpt_symbols_count'] = $new_instance['exerpt_symbols_count'];
		$instance['show_see_all_button'] = $new_instance['show_see_all_button'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Recent Posts',
			'category' => '',
			'post_number' => 3,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'true',
			'exerpt_symbols_count' => 60,
			'show_see_all_button' => 'false'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_posts_form', $args);
	}

}

class TMM_Contact_Form_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows custom contact form.', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Contact Form', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/contact_form', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['form'] = $new_instance['form'];
		$instance['labels'] = $new_instance['labels'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Contact Form',
			'form' => '',
			'labels' => 'placeholder'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_form_form', $args);
	}

}

class TMM_Flickr_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Flickr feed widget', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Flickr feed widget', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/flickr', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['imagescount'] = (int) $new_instance['imagescount'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Flickr Feed',
			'username' => '54958895@N06',
			'imagescount' => '9',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/flickr_form', $args);
	}

}

class TMM_Recent_Projects_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('The most recent projects from portfolio.', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Recent Projects', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/recent_projects', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_number'] = $new_instance['post_number'];
		$instance['layout_style'] = $new_instance['layout_style'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		$instance['show_exerpt'] = $new_instance['show_exerpt'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['exerpt_symbols_count'] = $new_instance['exerpt_symbols_count'];
		$instance['show_button'] = $new_instance['show_button'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Recent Projects',
			'post_number' => 5,
			'layout_style'=>1,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'false',
			'exerpt_symbols_count' => 90,
			'show_button' => 'true',
			'show_title' => 'true'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_projects_form', $args);
	}

}

class TMM_Google_Map_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Custom Google Map widget', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Google Map', 'axioma'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/google_map', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['mode'] = $new_instance['mode'];
		$instance['latitude'] = $new_instance['latitude'];
		$instance['longitude'] = $new_instance['longitude'];
		$instance['address'] = $new_instance['address'];
		$instance['location_mode'] = $new_instance['location_mode'];
		$instance['zoom'] = $new_instance['zoom'];
		$instance['scrollwheel'] = $new_instance['scrollwheel'];
		$instance['maptype'] = $new_instance['maptype'];
		$instance['marker'] = $new_instance['marker'];
		$instance['popup'] = $new_instance['popup'];
		$instance['popup_text'] = $new_instance['popup_text'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Our Location',
			'width' => '200',
			'height' => '200',
			'mode' => 'image',
			'latitude' => "40.714623",
			'longitude' => "-74.006605",
			'address' => 'New York',
			'location_mode' => 'address',
			'zoom' => 12,
			'maptype' => 'ROADMAP',
			'marker' => 'false',
			'scrollwheel' => 'false',
			'popup' => 'false',
			'popup_text' => ""
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/google_map_form', $args);
	}

}

class TMM_Facebook_LikeBox_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Facebook Like Box widget', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Facebook LikeBox', 'axioma'), $settings);
	}

	//Widget view

	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/facebook', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['pageID'] = $new_instance['pageID'];
		$instance['connection'] = $new_instance['connection'];
		$instance['height'] = $new_instance['height'];
		$instance['header'] = $new_instance['header'];


		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Facebook Like Box',
			'pageID' => '273813622709585',
			'connection' => 9,
			'height' => '340',
			'header' => 'true'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/facebook_form', $args);
	}

}

class TMM_Contact_Us_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Contact Us widget', 'axioma'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Contact Us', 'axioma'), $settings);
	}

	//Widget view

	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/contact_us', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['email'] = $new_instance['email'];
		
		//***
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Contact Us',
			'address' => '',
			'phone' => '',
			'email' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_us_form', $args);
	}

}

//*****************************************************

register_widget('TMM_Testimonials_Widget');
register_widget('TMM_Latest_Tweets_Widget');
register_widget('TMM_Social_Links_Widget');
register_widget('TMM_Recent_Posts_Widget');
register_widget('TMM_Contact_Form_Widget');
register_widget('TMM_Flickr_Widget');
register_widget('TMM_Recent_Projects_Widget');
register_widget('TMM_Google_Map_Widget');
register_widget('TMM_Facebook_LikeBox_Widget');
register_widget('TMM_Contact_Us_Widget');


