<?php
/** 
* @description:
* @author: hoangtuan
* @bugs:
* @date: 06/10/2018

* @return: string  
*/
if( !function_exists( 'htit_get_post_terms' )){
	function htit_get_post_terms( $post_id, $taxonomy = 'category' ){
		$terms = wp_get_post_terms( $post_id , $taxonomy );
		if( is_array( $terms ) && count( $terms ) > 0 ){
		  $arr_terms = array();
		  foreach ($terms as $key => $term_val ) {
		  	if( $term_val->term_id != 1 )
			    $arr_terms[] = '<a href="'.get_term_link( $term_val ).'" title="'.$term_val->name.'">'.$term_val->name.'</a>';
		  }
		  $list_terms = implode(', ', $arr_terms );
		  return $list_terms;
		}
	}
}

if( !function_exists( 'htit_get_post_term' )){
	function htit_get_post_term( $post_id, $taxonomy = 'category', $args = array()  ){
		$terms = wp_get_post_terms( $post_id , $taxonomy, $args );

		if( is_array( $terms ) && count( $terms ) > 0 )
		    return '<a href="'.get_term_link( $terms[0] ).'" title="'.$terms[0]->name.'">'.$terms[0]->name.'</a>';
	}
}



/** 
* @description: Append image favicon
* @author: hoangtuan
* @bugs:
* @date: 08/10/2018

* @return: string  
*/

function myfavicon() {
	global $iz_options;
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.$iz_options['favicon']['url'].'" />';
}
add_action('wp_head', 'myfavicon');

if( !function_exists( 'iz_get_image' )){
	function iz_get_image( $id, $size = 'large' ){
		global $iz_options;
		$img = $iz_options['image_default']['url'];
		$thumbnail_id = get_post_thumbnail_id( $id );
		if( !empty( $thumbnail_id ) ){
			$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
	    	$img = $img[0];
		}

		return $img;	
	}
}

if( !function_exists( 'iz_get_thumbnail_src' )){
	function iz_get_thumbnail_src($id, $size = 'large'){
		global $iz_options;
		$img_default = $iz_options['image_default']['url'];
	    $img = wp_get_attachment_image_src( $id, $size );
	    $img = !empty($img[0]) ? $img[0] : $img_default;
		return $img;
	}
}

if( !function_exists( 'iz_excerpt' )){
	function iz_excerpt( $post_id, $number = 300 ){
		$post = get_post( $post_id );
		$content = $post->post_content;
		$excerpt = $post->post_excerpt;
		$excerpt = !empty( $excerpt ) ? $excerpt : mb_substr(strip_tags( $content ), 0, $number,'UTF-8');
		return $excerpt;
	}
}

if( !function_exists( 'iz_admin_bar_render' )){
	add_action( 'wp_before_admin_bar_render', 'iz_admin_bar_render' );

	function iz_admin_bar_render() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('comments');
	}
}

if( !function_exists( 'iz_script_header' )){
	add_action('wp_head','iz_script_header', 5 );

	function iz_script_header(){
		global $iz_options;
		echo $iz_options['script-header'];
	}
}

if( !function_exists( 'iz_script_body' )){
	add_action('iz_body','iz_script_body', 5 );

	function iz_script_body(){
		global $iz_options;
		echo $iz_options['script-body'];
	}
}


if( !function_exists( 'iz_script_body' )){
	add_action('wp_footer','iz_script_footer', 5 );

	function iz_script_footer(){
		global $iz_options;
		echo $iz_options['script-footer'];
	}
}



// Allow upload files type: svg 


// if( !function_exists('add_file_types_to_uploads') ){
// 	function add_file_types_to_uploads($file_types){

// 	    $new_filetypes = array();
// 	    $new_filetypes['svg'] = 'image/svg+xml';
// 	    $file_types = array_merge($file_types, $new_filetypes );

// 	    return $file_types;
// 	}
// 	add_action('upload_mimes', 'add_file_types_to_uploads');
// }



/*
* @description: 
* @author: hoangtuan
* @bugs:
* @date: 23/01/2019

* @return: string  
*/

function template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'recruitment' )   
  {
	return locate_template('search-recruitment.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');  


/*
* @description: Convert color rgb to rgba
* @author: hoangtuan
* @bugs:
* @date: 24/01/2019

* @return: string  
*/


function fn_convert_rgb_to_rgba( $color = 'rgb(14, 102, 141)', $opacity = '0.8' ){

	$rgb_color = substr($color,0,-1);

	echo '<pre>rgb_color:';
	print_r( $rgb_color );
	echo '</pre>';

	return 'rgba('.$rgb_color.','.$opacity.')';

}


/*
* @description: convert hex color to rgba
* @author: hoangtuan
* @bugs:
* @date: 24/01/2019

* @return: string  
*/

function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}


/*
* @description: Get taxonomy with hierarchy, depth = 2;
* @author: hoangtuan
* @bugs:
* @date: 25/01/2019

* @return: string  
*/

function htit_get_taxonomy_hierarchy( $taxonomy =  'category'  ){

	$cats = get_terms( array('taxonomy' => $taxonomy ,'hide_empty' => false,'parent' => 0  ));

	$arr_cat = array();

	if( count( $cats ) > 0 ){

		foreach ($cats as $key => $item) {
			
			$arr_cat[ $item->term_id ] = $item->name;
			$cats_child = get_terms(array('taxonomy' => $taxonomy ,'hide_empty' => false,'parent' => $item->term_id  ));

			if(  count( $cats_child  ) >  0   ){
				foreach ($cats_child as $key => $value) {
					$arr_cat[ $value->term_id ] = ' -- '.$value->name;
				}
			}

		}

	}

	return $arr_cat;

}