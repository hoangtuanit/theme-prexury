<?php

add_action('init','register_post_type_structure');

function register_post_type_structure() {

   $labels = array(
      'name'               => _x( 'Cấu trúc', 'diginet' ),
      'singular_name'      => _x( 'Cấu trúc', 'diginet' ),
      'menu_name'          => _x( 'Cấu trúc', 'diginet' ),
      'name_admin_bar'     => _x( 'Cấu trúc', 'diginet' ),
      'add_new'            => _x( 'Thêm cấu trúc', 'diginet' ),
      'add_new_item'       => __( 'Thêm cấu trúc', 'diginet' ),
      'new_item'           => __( 'Cấu trúc mới', 'diginet' ),
      'edit_item'          => __( 'Chỉnh sửa', 'diginet' ),
      'view_item'          => __( 'Xem', 'diginet' ),
      'all_items'          => __( 'Tất cả', 'diginet' ),
      'search_items'       => __( 'Tìm kiếm', 'diginet' ),
      'parent_item_colon'  => __( 'Parent item:', 'diginet' ),
      'not_found'          => __( 'Not found.', 'diginet' ),
      'not_found_in_trash' => __( 'Not found.', 'diginet' )
    );

    $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => false,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => true,
      'menu_position'      => 7,
      'menu_icon'          =>  'dashicons-editor-kitchensink',
      'supports'           => array( 'title', 'editor' )
    );

    register_post_type( 'structure', $args );
    flush_rewrite_rules();

}

function iz_get_structure( $post_id ){

  $args = array(
    'p'         => $post_id, // ID of a page, post, or custom type
    'post_type' => 'structure',
    'post_status' => 'publish',
  );

  $my_posts = new WP_Query($args);


  if( $my_posts->have_posts() ):

    while( $my_posts->have_posts() ):

      $my_posts->the_post();

      echo apply_filters( 'the_content', get_the_content() );

    endwhile;

  endif;

  wp_reset_query();

}

