<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Ext_Slider_Flex extends TMM_Ext_Sliders {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		//***
		self::$slider_options = array(
			'key' => "flex",
			'name' => "Flexslider",
			'fields' => array(
				'description' => array(
					'name' => __('Slide Description', 'axioma'),
					'type' => 'textarea',
					'field_options' => array(
						'font_family' => __('Font family', 'axioma'),
						'font_size' => __('Font size', 'axioma'),
						'font_color' => __('Font color', 'axioma')
					),
					'field_options_defaults' => array(
						'font_family' => '',
						'font_size' => '',
						'font_color' => ''
					)
				),
				'url' => array(
					'name' => __('Slide URL', 'axioma'),
					'type' => 'textinput',
					'field_options' => array()
				),
			),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		//***
		self::$slider_js_options = array(
			'slide_image_alias' => array(
				'title' => __('Slide size', 'axioma'),
				'type' => 'text',
				'description' => __('Slide size. width*height, for example 500*300. Empty field means full size!', 'axioma'),
				'default' => '',
			),
			'enable_caption' => array(
				'title' => __('Enable caption', 'axioma'),
				'type' => 'checkbox',
				'description' => "",
				'default' => 1,
			),
			'slideshow' => array(
				'title' => __('Slideshow', 'axioma'),
				'type' => 'checkbox',
				'description' => __("Animate slider automatically", 'axioma'),
				'default' => 1,
			),
			'init_delay' => array(
				'title' => __('initDelay', 'axioma'),
				'type' => 'slider',
				'description' => __("Integer: Set an initialization delay, in milliseconds", 'axioma'),
				'default' => 0,
				'max' => 500
			),
			'animation_speed' => array(
				'title' => __('Animation Speed', 'axioma'),
				'type' => 'slider',
				'description' => __("Set the speed of animations, in milliseconds", 'axioma'),
				'default' => 600,
				'max' => 2000
			),
			'slideshow_speed' => array(
				'title' => __('Slideshow Speed', 'axioma'),
				'type' => 'slider',
				'description' => __("Set the speed of the slideshow cycling, in milliseconds", 'axioma'),
				'default' => 7000,
				'max' => 20000
			),
			'animation' => array(
				'title' => __('Animation', 'axioma'),
				'type' => 'select',
				'values' => array(
					'fade' => __('Fade', 'axioma'),
					'slide' => __('Slide', 'axioma'),
				),
				'description' => __('Select your animation type, "fade" or "slide"', 'axioma'),
				'default' => 'slide',
			),
			'directionNav' => array(
				'title' => __('Direction Nav', 'axioma'),
				'type' => 'checkbox',
				'description' => __("Direction Navigation", 'axioma'),
				'default' => 1,
			),
			'controlnav' => array(
				'title' => __('Control Navigation', 'axioma'),
				'type' => 'checkbox',
				'description' => __("Control Navigation", 'axioma'),
				'default' => 1,
			),
			'direction' => array(
				'title' => __('Direction', 'axioma'),
				'type' => 'select',
				'values' => array(
					'horizontal' => __('Horizontal', 'axioma'),
					'vertical' => __('Vertical', 'axioma'),
				),
				'description' => "",
				'default' => 'horizontal',
			)
		);
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}
