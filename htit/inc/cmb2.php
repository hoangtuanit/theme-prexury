<?php

add_action( 'cmb2_admin_init', 'myprefix_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function myprefix_register_theme_options_metabox() {

	/****************BEGIN PAGE***************/

		$cmb_product = new_cmb2_box( array(
			'id'               => 'productedit',
			'title'            => esc_html__( 'Settings', 'cmb2' ), // Doesn't output for user boxes
			'object_types'     => array( 'page', 'recruitment', 'post' ), // Tells CMB2 to use user_meta vs post_meta
			'show_names'       => true,
			'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		) );

		$cmb_product->add_field( array(
			'name' 	 => 'Type Header',
			'id'     => 'type_header',
			'type'   => 'select',
			'options' => array(
				'normal' => 'Normal',
				'fixed' => "Fixed"
			)
		) );

		$cmb_product->add_field( array(
			'name' 	 => 'Layout',
			'id'     => 'layout',
			'type'   => 'select',
			'options' => array(
				'normal' => 'Normal',
				'fullwidth' => "Full width"
			)
		) );

	/****************END PAGE***************/

	/****************BEGIN RECRUITMENT***************/

		$cmb_recruitment = new_cmb2_box( array(
			'id'               => 'recruitmentedit',
			'title'            => esc_html__( 'Settings', 'cmb2' ),
			'object_types'     => array( 'recruitment' ), 
			'show_names'       => true,
			'new_user_section' => 'add-new-user', 
		) );

		$cmb_recruitment->add_field( array(
			'name' 	 => 'Mã vị trí',
			'id'     => '_sku',
			'type'   => 'text',
		) );

		$cmb_recruitment->add_field( array(
			'name' 	 => 'Mức lương',
			'id'     => '_salary',
			'type'   => 'text',
		) );

		$cmb_recruitment->add_field( array(
			'name' 	 => 'Trạng thái',
			'id'     => '_status',
			'type'   => 'select',
			'options' => array(
				'0'  => 'Ngưng tuyển',
				'1'  => 'Đang tuyển',
			),
			'default' => 1 
		) );

	/****************END RECRUITMENT***************/


	$attrs 			= array( 'post_type' => 'structure', 'post_status' => 'publish','posts_per_page'=>'-1'  );
	$structures   	= get_posts( $attrs );
	$arr_structure 	= array( '' => " -- Chọn top header -- ", '-1' => ' Mặc định - Cài đặt tại Page Info' );

	if( count( $structures ) > 0 ){
		foreach ($structures as $key => $value) {
			$arr_structure[ $value->ID ] = $value->post_title;
		}
	}

	/****************BEGIN ALL POSTYPE ***************/

		$cmb_posttype = new_cmb2_box( array(
			'id'               => 'posttype_edit',
			'title'            => esc_html__( 'Top Header', 'cmb2' ),
			'object_types'     => array( 'page','post','recruitment' ), 
			'show_names'       => true,
			'new_user_section' => 'add-new-user', 
		) );

		$cmb_posttype->add_field( array(
			'name' 	 => 'Choose top header',
			'id'     => 'top_header',
			'type'   => 'select',
			'options' => $arr_structure
		) );

	/****************END ALL POSTYPE***************/

}