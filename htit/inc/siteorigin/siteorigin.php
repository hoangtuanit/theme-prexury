<?php

if( class_exists('SiteOrigin_Widgets_Bundle') ){

	function iz_add_widget_folders( $folders ){
	    $folders[] = get_template_directory() . '/inc/siteorigin/widgets/';
	    return $folders;
	}

	add_action('siteorigin_widgets_widget_folders', 'iz_add_widget_folders');

	function htit_custom_fields_class_paths( $class_paths ) {
	    $class_paths[] = get_template_directory(). '/inc/siteorigin/fields/';
	    return $class_paths;
	}
	// add_filter( 'siteorigin_widgets_field_class_paths', 'htit_custom_fields_class_paths' );

	function my_custom_fields_class_prefixes( $class_prefixes ) {
	    $class_prefixes[] = 'HT_Sow_';
	    return $class_prefixes;
	}
	// add_filter( 'siteorigin_widgets_field_class_prefixes', 'my_custom_fields_class_prefixes' );

	
	function htit_sow_generator_title( $title, $tag = 'div' , $class = '' ){

		if( empty( $tag ) ) $tag = 'div';

		$open_tag = "<".$tag." class='sow-title text-center ".$class."'>";
		$close_tag = "</".$tag.">";
		return $open_tag.$title.$close_tag;

	}

}



/*

	// Begin Prexury - Vuottroi
	prex000: Group Button

*/