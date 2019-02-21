<?php

if ( defined( 'ABSPATH' ) && ! class_exists( 'RWMB_Loader' ) )
{
	require 'inc/loader.php';
	new RWMB_Loader;
}

add_filter( 'rwmb_meta_boxes', 'iz_register_metaboxes' );

function iz_register_metaboxes( $meta_boxes ) {

	$meta_boxes[] = array(
			'id'         => 'information',
			'title'      => __( 'Information', 'diginet' ),
			'post_types' => array('page' ,'post'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
							array(
							    'name' => 'Hide partners',
							    'id'   => 'partner',
							    'type' => 'checkbox',
							    'std'  => 0,
							),
							array(
							    'name' => 'Hide title',
							    'id'   => 'title',
							    'type' => 'checkbox',
							    'std'  => 0,
							)
			)
	);

	$meta_boxes[] = array(
			'id'         => 'gallery',
			'title'      => __( 'Info', 'diginet' ),
			'post_types' => array('project'),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields' => array(
							array(
								'id'               => 'albums',
								'name'             => 'Choose images',
								'type'             => 'image_advanced',
								'force_delete'     => false,
								'max_file_uploads' => -1,
								'max_status'       => true,
							),							
			)
	);

  	return $meta_boxes;
}
