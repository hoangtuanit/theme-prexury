<?php
/*
	Widget Name: Group Button
	Author: Hoàng Tuấn
*/

class prex000_Widget extends SiteOrigin_Widget {

	function __construct(){

		parent::__construct(
			'prex000-widget',
			__('Group Button', 'htit'),
			array(
				'description' => __('', 'htit'),
			),
			array(),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'htit-sow-prex000',
					get_stylesheet_directory_uri() . '/inc/siteorigin/widgets/prex000/assets/prex000.css',
					array(),
					SOW_BUNDLE_VERSION
				),
			)
		);

	}

	function get_template_name($instance) {
	    return 'prex000-template';
	}

	function get_template_dir($instance) {
	    return 'tpl';
	}

	function get_template_variables( $instance, $args ){

		unset( $instance['title'] );
		unset( $instance['display_title'] );
		unset( $instance['design'] );
		unset( $instance['panels_info'] );
		$vars['instance_hash'] = md5( serialize( $instance ) );
		unset( $instance['_sow_form_id'] );

		return $vars;

	}

	function get_widget_form() {

		return array(				
			'items'  => array(
		        'type'  => 'repeater',
		        'label' => __( 'Add Buttons' , 'widget-form-fields-text-domain' ),
		        'hide' 	=> false,
		        'item_label' => array(
		                    'selector'     => "[id*='title']",
		                    'update_event' => 'change',
		                    'value_method' => 'val'
                ),
		        'fields' => array(
		           'title' => array(
						'type' 		=> 'text',
						'label' 	=> __('Button name', 'iznet'),
					),
					'icon' => array(
				        'type' => 'icon',
				        'label' => __('Select a font', 'widget-form-fields-text-domain'),
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

siteorigin_widget_register('prex000-widget', __FILE__, 'prex000_Widget');
