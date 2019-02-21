<?php
/*
Widget Name: Owl Carousel - Slider
Author: Hoàng Tuấn
Author URI: http://hoangtuanit.com
*/

class Owlcarousel_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'owlcarousel-widget',
			__('Owl Carousel - Slider', 'owlcarousel-widget-text-domain'),
			array(
				'description' => __('', 'owlcarousel-widget-text-domain'),
			),
			array(
			),
			array(
			),
			plugin_dir_path(__FILE__)
		);

	}

	function get_template_name($instance) {
		return 'owlcarousel-widget-template';
	}

	function get_widget_form() {

		return array(			
			'slides'  => array(
		        'type'  => 'repeater',
		        'label' => __( 'Add slide' , 'widget-form-fields-text-domain' ),
		        'hide' 	=> false,
		        'item_label' => array(
		                    'selector'     => "[id*='title']",
		                    'update_event' => 'change',
		                    'value_method' => 'val'
                ),
		        'fields' => array(
		           'title' => array(
						'type' 		=> 'text',
						'label' 	=> __('Slide name', 'iznet'),
					),
					'image' => array(
				        'type' 		=> 'media',
				        'label' 	=> __( 'Choose image', 'widget-form-fields-text-domain' ),
				        'choose' 	=> __( 'Choose image', 'widget-form-fields-text-domain' ),
				        'update' 	=> __( 'Choose image', 'widget-form-fields-text-domain' ),
				        'library' 	=> 'image',
				    ),
					'url' => array(
						'type' 		=> 'link',
						'label' 	=> __('Link to post', 'iznet'),
					),
		        )
		    )

		);
	}

}

siteorigin_widget_register('owlcarousel-widget', __FILE__, 'Owlcarousel_Widget');

