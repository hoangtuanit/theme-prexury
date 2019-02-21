<?php
require_once get_template_directory() .'/inc/custom-wp-admin.php';
require_once get_template_directory() .'/inc/post-types.php';
require_once get_template_directory() .'/redux/redux-init.php';
require_once get_template_directory() .'/inc/cmb2.php';
require_once get_template_directory() .'/inc/siteorigin/siteorigin.php';
require_once get_template_directory() .'/inc/global.php';

function iz_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar chính', 'diginet' ),
		'id'            => 'primary',
		'description'   => __( 'Hiển thị thanh sidebar chính', 'diginet' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


}

add_action( 'widgets_init', 'iz_widgets_init' );

add_action("init",function(){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
});

add_action( 'after_setup_theme', 'iz_setup' );

if ( ! function_exists( 'iz_setup' ) ) :

	function iz_setup() {

		load_theme_textdomain( 'diginet' );

		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails' );
		
		set_post_thumbnail_size( 825, 510, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Main Menu','diginet' ),
			'footer' => __( 'Footer','diginet' ),
		) );
		
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
			'flex-height' => true,
		) );

		add_image_size( 'featured', 320, 320, true );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}


endif; // iz_setup

add_action('admin_enqueue_scripts','htit_admin_script');
function htit_admin_script(){
	wp_enqueue_style('custom-admin', get_stylesheet_directory_uri().'/css/admin.css' , array(), null , false);
}

add_action('wp_enqueue_scripts','main_script');

function main_script(){


	// wp_deregister_script('jquery');

	// wp_enqueue_script('jquery', get_stylesheet_directory_uri().'/js/jquery-3.2.1.min.js' , array(), 	null , false);

	wp_enqueue_style('normalize', get_stylesheet_directory_uri().'/css/normalize.css' , array(), null , false);
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri().'/css/font-awesome.min.css' , array(), null , false);
	wp_enqueue_style('wp-style', get_stylesheet_directory_uri().'/css/wp-style.css' , array(), null , false);
	wp_enqueue_style('init-style', get_stylesheet_directory_uri().'/css/init.css' , array(), null , false);

	/****************BEGIN OWLCAROUSEL***************/
		wp_enqueue_style('owl.carousel', get_stylesheet_directory_uri().'/lib/owlcarousel/owl.carousel.min.css' , array(), null , false);
		wp_enqueue_style('owl.carousel.green', get_stylesheet_directory_uri().'/lib/owlcarousel/owl.theme.green.min.css' , array(), null , false);
		wp_enqueue_script('owl.carousel', get_stylesheet_directory_uri().'/lib/owlcarousel/owl.carousel.min.js' , array('jquery'), null , true);
	/****************END OWLCAROUSEL***************/


	/****************BEGIN JQUERY MATCH HEIGHT***************/
		wp_enqueue_script('matchheight', get_stylesheet_directory_uri().'/lib/jquery-match-height/jquery.matchHeight-min.js' , array('jquery'), null , true);
	/****************END JQUERY MATCH HEIGHT***************/


	wp_enqueue_style('style', get_stylesheet_directory_uri().'/css/style.css' , array(), null , false);
	wp_enqueue_style('main', get_stylesheet_directory_uri().'/style.css' , array(), null , false);

	wp_enqueue_script('main', get_stylesheet_directory_uri().'/js/main.js' , array('jquery'), null , true);

}

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


function iz_get_thumbnail_src($id, $size = 'large'){
	global $iz_options;
	$img_default = $iz_options['image_default']['url'];
    $img = wp_get_attachment_image_src( $id, $size );
    $img = !empty($img[0]) ? $img[0] : $img_default;
	return $img;
}


function iz_excerpt( $post_id, $number = 300 ){
	$post = get_post( $post_id );
	$content = $post->post_content;
	$excerpt = $post->post_excerpt;
	$excerpt = !empty( $excerpt ) ? $excerpt : mb_substr(strip_tags( $content ), 0, $number,'UTF-8');
	return $excerpt;
}

add_action( 'wp_before_admin_bar_render', 'iz_admin_bar_render' );

function iz_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}

add_action('admin_bar_menu', 'remove_wp_logo', 999);

function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node('wp-logo');
}


function iz_page_404(){

	global $iz_options;

	$img_404 = $iz_options['image_404']['url'];

	echo '<a class="page-not-found" href="'.home_url().'" title="Quay trở lại trang chủ">';

		echo '<img class="lazy" data-original="'.$img_404.'" alt="Ảnh 404" />';

	echo '</a>';

}


add_action('wp_footer','iz_copyright', 10 );

function iz_copyright(){

	global $iz_options;

	if( !empty( $iz_options['copyright']) )
		echo '<div class="copyright">'.$iz_options['copyright'].' </div>';
	
}

add_action('wp_footer','iz_gallery_footer', 5 );

function iz_gallery_footer(){

	global $iz_options;

	if( is_singular() ):

		$hide_partner = get_post_meta( get_the_ID(), 'partner', true );

		if( $hide_partner == 0 ):
			
			echo '<div class="container list-partners wow fadeInLeft">';
				echo '<div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">';

					if( isset( $iz_options['main_img'] ) && !empty( $iz_options['main_img']['url'] ) ):
						echo '<a class="main-img" href="'.home_url().'" title="'.$iz_options['contact_name'].'">';
							echo '<img class="img-fluid" src="'.$iz_options['main_img']['url'].'" alt="'.$iz_options['contact_name'].'"/>';
						echo '</a>';
					endif;

					if( isset( $iz_options['footer_slides'] ) ):
						echo "<div class='right-partner d-flex align-items-center justify-content-center  flex-sm-row flex-column flex-xl-nowrap flex-wrap'>";
						foreach ($iz_options['footer_slides'] as $key => $slides) {

							if( !empty( $slides['url'] ) )
								echo '<a href="'.$slides['url'].'" target="_blank" title="'.$slides['title'].'">';

								echo '<img src="'.$slides['image'].'" alt="'.$slides['description'].'"/>';

							if( !empty( $slides['url'] ) )
								echo '</a>';

						}
						echo '</div>';
					endif;

				echo '</div>';
			echo '</div>';

		endif;

	else:

		echo '<div class="container list-partners wow fadeInLeft">';
			echo '<div class="row d-flex align-items-center flex-column flex-sm-row  justify-content-center ">';

				if( isset( $iz_options['main_img'] ) && !empty( $iz_options['main_img']['url'] ) ):
					echo '<a class="main-img" href="'.home_url().'" title="'.$iz_options['contact_name'].'">';
						echo '<img class="img-fluid" src="'.$iz_options['main_img']['url'].'" alt="'.$iz_options['contact_name'].'"/>';
					echo '</a>';
				endif;

				if( isset( $iz_options['footer_slides'] ) ):
					echo "<div class='right-partner d-flex align-items-center justify-content-center flex-sm-row flex-column flex-xl-nowrap flex-wrap'>";
					foreach ($iz_options['footer_slides'] as $key => $slides) {

						if( !empty( $slides['url'] ) )
							echo '<a href="'.$slides['url'].'" target="_blank" title="'.$slides['title'].'">';

							echo '<img src="'.$slides['image'].'" alt="'.$slides['description'].'"/>';

						if( !empty( $slides['url'] ) )
							echo '</a>';

					}
					echo '</div>';
				endif;

			echo '</div>';
		echo '</div>';

	endif;

}

function iz_get_fanpage( $fanpage_url, $name = '' ){
	echo '<div class="fb-page"   data-href="'.$fanpage_url.'" data-width="380"  data-hide-cover="false"  data-show-facepile="false"></div>';
}

add_action('wp_head','iz_script_header', 5 );

function iz_script_header(){
	global $iz_options;
	echo $iz_options['script-header'];
}

add_action('iz_body','iz_script_body', 5 );

function iz_script_body(){
	global $iz_options;
	echo $iz_options['script-body'];
}

add_action('wp_footer','iz_script_footer', 5 );

function iz_script_footer(){
	global $iz_options;
	echo $iz_options['script-footer'];
}


function iz_get_list_nav( $menu_id ){
	$list_nav = wp_get_nav_menu_items( $menu_id );

	if( count( $list_nav ) > 0 ){
		foreach ($list_nav as $key => $value) {
			echo '<a href="'.$value->url.'" title="'.$value->title.'"> '.$value->title.'</a>';
		}
	}
}

function iz_get_featured_by_project_tax( $tax_id ){

	$args = array(	'post_type' => 'project', 'posts_per_page' => -1, 'post_status' =>'publish', 'orderby' => 'rand',
					'tax_query' => array(
						array(
							'taxonomy' 	=> 'project_tax',
							'field' 	=> 'term_id',
							'terms'	   	=> $tax_id,
						)
					)
			 	);
	$projects = get_posts( $args );

	if( count( $projects ) > 0 ){
		$arr_img = array();

		foreach ($projects as $key => $value) {
			
			$arr_img[] = iz_get_image( $value->ID, false );

		}

		return $arr_img;
	}


}


function qt_custom_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs" class="wow fadeIn"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs">  <a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      // $thisCat = get_category(get_query_var('cat'), false);
      // if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      // echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';

        if( get_post_type() == 'project' ){

        	$project_tax = get_the_terms( get_the_ID(), 'project_tax');

        	if( count( $project_tax ) > 0 ){
        		echo ' ' . $delimiter . ' ' . $before ;
        			echo '<ul class="list-cat">';
	        		foreach ($project_tax as $key => $value) {
	        			$tax_link = get_term_link( $value );
	        			echo '<li> <a href="'.$tax_link.'" title="'.$value->name.'">';
	        				echo $value->name;
	        			echo '</a> </li>';
	        		}
	        		echo '</ul>';
        		echo $after;
        	}

        }
        
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end qt_custom_breadcrumbs()


// http://www.sharelinkgenerator.com/
function htit_single_share( $url, $title = '', $description = '' ,$source = '' ){

	$source_link  = array();

	$source_link['facebook-square'] 	= 'https://www.facebook.com/sharer/sharer.php?u='.$url;
	$source_link['pinterest'] = 'https://pinterest.com/pin/create/button/?url='.$url.'&description='.$description;
	$source_link['linkedin-square'] = 'https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'&summary='.$description.'&source='.$source;
	$source_link['google-plus'] = 'https://plus.google.com/share?url='.$url;
	$source_link['twitter'] 	= 'https://twitter.com/home?status='.$url;
	echo '<ul class="normal-list list-share list-inline">';
		echo '<li class="label list-inline-item"> CHIA SẺ: </li>';
		foreach ($source_link as $key => $item) {
			echo '<li class=" list-inline-item">';
				echo '<a target="_blank" title="'.$key.'" href="'.$item.'"> <i class="fa fa-'.$key.'"></i> </a>';
			echo '</li>';
		}
	echo '</ul>';
}


// In page singular.php, after single post
add_action("iz_after_single_loop",'fn_comment',5);
function fn_comment(){
	if( is_single() ){
		echo '<div class="col-12"> <div class="fb-comments" data-href="'.get_permalink().'" data-numposts="5"> </div> </div>';
	}
}

add_action("iz_after_wrap_content",'fn_featured_post',10);
function fn_featured_post(){

	if( is_single() ) {
		global $iz_options;
		echo '<div class="col-12">';
		if( (int) $iz_options['post_featured'] > 0 ){
			iz_get_structure( $iz_options['post_featured']);
		}
		echo '</div>';
	}
	
}


function fn_check_recruitment_new( $post_id, $day = 15 ){
	$post_date    	= strtotime( get_the_date( 'd-m-Y H:i:s', $post_id ) );
	$curr_date 		= strtotime( date('d-m-Y H:i:s') );

	$date_limit 	= $day*24*60*60;

	if( $curr_date - $post_date <= $date_limit )
		return true;

}

function fn_get_recruitment( $id, $type = 'type-1' ){

	$meta         =  get_post_meta( $id );

	if( $meta['_status'][0] == 0 )
		return false;

	$terms 		  =  wp_get_post_terms( $id , 'recruitment_tax' );
	$city 		  =  wp_get_post_terms( $id , 'recruitment_city', array('parent' => 0) );

	if( fn_check_recruitment_new( $id ) == true )
		$class_new = 'r-new';

	$parent_terms  = $child_terms  =  $arr_city = array();

	if( is_array( $terms ) && count( $terms ) > 0 ):

		foreach ($terms as $key => $value) {
			if( $value->parent == 0 ){
				$parent_terms[] = '<a href="'.get_term_link( $value ).'" title="'.$value->name.'">'.$value->name.'</a>';
			}else{
				$child_terms[] = '<a href="'.get_term_link( $value ).'" title="'.$value->name.'">'.$value->name.'</a>';
			}
		}

	endif;

	if( is_array( $city ) && count( $city ) > 0 ):

		foreach ($city as $key => $c_val) {

			$arr_city[] = '<a href="'.get_term_link( $c_val ).'" title="'.$c_val->name.'">'.$c_val->name.'</a>';

		}

	endif;

	echo '<li class="'.$type.'">';

		echo '<a href="'.get_permalink().'" class="name '.$class_new.'">'.get_the_title( $id ).'</a>';		

		if( count( $child_terms  ) >  0 )
			echo '<div class="child-terms">'.implode(', ', $child_terms).'</div>';

		if( count( $parent_terms  ) >  0 ){

			// $parent_terms = array_merge( $parent_terms, $arr_city );

			echo '<div class="parent-terms">'.implode(', ', $parent_terms).'</div>';

		}

		if( count( $arr_city ) >  0 ){

			echo '<div class="city-terms">'.__('Địa chỉ: ','diginet').implode(', ', $arr_city).'</div>';

		}

		echo '<a href="'.get_permalink( $id ).'" class="sku">'.$meta['_sku'][0].'</a>';

		

		echo '<button type="button" class="btn  btn-transparent" data-toggle="modal" data-target="#recruitmentModal"> <i class="fa fa-angle-right"></i> ';
		  _e('ỨNG TUYỂN','diginet');
		  echo '<input type="hidden" name="post_url" value="'.get_the_permalink().'">';
		  echo '<input type="hidden" name="post_sku" value="'.get_post_meta( get_the_ID(), '_sku', true ).'">';
		echo '</button>';

	echo '</li>';

}

add_action('htit_related_post_recruitment','fn_post_recruitment');

function fn_post_recruitment(){

	$args = array(
		'post_type' 	 => 'recruitment',
		'post_status' 	 => 'publish',
		'posts_per_page' => 3,
		'exclude'   => get_the_ID()
	);

	$related_post = get_posts( $args ) ;

	if( count( $related_post ) > 0 ):

		echo '<div class="recruitment-related">';

			echo '<h6>'.__("VỊ TRÍ CÔNG VIỆC KHÁC",'diginet').'</h6>';

			echo '<ul class="normal-list  list-recruitment">';

			foreach ($related_post as $key => $post) {
				
				fn_get_recruitment( $post->ID, $type );

			}

			echo '</ul>';

			echo '<div class="bottom-related">';

				echo '<a href="'.get_post_type_archive_link('recruitment').'" class="readmore"> <i class="fa fa-angle-right"></i> '.__("XEM TIẾP").'</a>';

			echo '</div>';

		echo '</div>';

	endif;

}

// Thêm siteorigin witget vào top header, được cài đặt bằng redux: url - Page Info
add_action('iz_header','fn_top_header');
function fn_top_header(){
	global $iz_options;

	if( is_singular()  ){

		$top_id = get_post_meta( get_the_ID(), 'top_header', true );


		if( $top_id == -1 || get_post_type() == 'recruitment'  )
			$top_id = (int) $iz_options['top_recruitment'];


		if( $top_id > 0 && get_post_status( $top_id ) == 'publish' )
			iz_get_structure( $top_id );

	}else if( is_archive('recruitment') ){
		
		$top_id = (int) $iz_options['top_recruitment'];
		iz_get_structure( $top_id );

	}
	// else if( is_category() ){
		
	// 	$top_id = (int) $iz_options['top_category'];
	// 	iz_get_structure( $top_id );
	// }


}


/*
* @description: Display li item by taxonomy id
* @author: hoangtuan
* @bugs:
* @date: 25/01/2019
* @parms: $taxonomy: taxonomy name, $id = taxonomy id 
* @return: string  
*/

function htit_get_li_taxonomy($taxonomy, $id){
	$term_item = get_term( $id, $taxonomy );

	echo '<li>';
		echo '<a href="'.get_term_link( $term_item ).'" title="'.$term_item->name.'">'.$term_item->name.'</a>';
		
		// Lấy danh sách term children
		$arr_term_child = get_term_children( $term_item->term_id , $taxonomy );

		if( is_array( $arr_term_child ) && count( $arr_term_child ) > 0 ){

			echo "<span class='toggle-child fa fa-angle-right'></span>";

			echo '<ul class="term-child">';
				foreach ($arr_term_child as $key => $term_child_id) {
					$term_child = get_term( $term_child_id );
					echo '<li>';
						echo '<a href="'.get_term_link( $term_child ).'" title="'.$term_child->name.'">'.$term_child->name.'</a>';
					echo '</li>';
				}
			echo '</ul>';

		}else{

			echo "<span class='toggle-child dont-has-child fa fa-angle-right'></span>";

		}

	echo '</li>';
}

function htit_get_li_taxonomy_hide_parent($taxonomy, $id){
	$term_item = get_term( $id, $taxonomy );
	// Lấy danh sách term children
	$arr_term_child = get_term_children( $term_item->term_id , $taxonomy );

	if( is_array( $arr_term_child ) && count( $arr_term_child ) > 0 ){

		foreach ($arr_term_child as $key => $term_child_id) {
			$term_child = get_term( $term_child_id );
			echo '<li class="not-parent">';
				echo ' <a href="'.get_term_link( $term_child ).'" title="'.$term_child->name.'"> <i class="fa fa-angle-right"></i> '.$term_child->name.'</a>';
			echo '</li>';
		}

	}

}


add_shortcode('button_apply_recruitment','fn_popup_recruitment', 5 );

function fn_popup_recruitment(){

	global $iz_options;

	if( !empty( $iz_options['shortcode_recruitment'] ) ):

	?>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recruitmentModal">
		  <?php _e('ỨNG TUYỂN','diginet') ?>

		  <input type="hidden" name="post_url" value="<?php echo get_the_permalink() ?>">
		  <input type="hidden" name="post_sku" value="<?php echo get_post_meta( get_the_ID(), '_sku', true ) ?>">

		</button>

	<?php
	
	endif;

}

add_action('wp_footer','fn_modal_recruitment');

function fn_modal_recruitment(){

	global $iz_options;

	if( !empty( $iz_options['shortcode_recruitment'] ) ):

	?>
		
		<!-- Modal -->
		<div class="modal fade" id="recruitmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog  modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-body">

	      		<?php echo do_shortcode( $iz_options['shortcode_recruitment'] ) ?>
		        
		      </div>
		    </div>
		  </div>
		</div>

	<?php

	endif;

}


function exclude_single_posts_home($query) {

	if (  !is_admin() && $query->is_post_type_archive( 'recruitment' )  ) {
		$query->set('meta_key','_status' );
		$query->set('meta_value', 1  );
		return ;
	}
}

add_action('pre_get_posts', 'exclude_single_posts_home');