<?php 

get_header(); 

	$object = get_queried_object();

	$posts_per_page = get_option("posts_per_page");

	$args = array(
		'post_type' 	 => 'recruitment',
		'posts_per_page' => $posts_per_page,
		'post_status' 	 => 'publish',
		'meta_key' 		 => '_status',
		'meta_value'     => 1
	);

	$custom_query = new WP_Query( $args );

	echo '<div class="container">';

		echo '<div class="sow-archive sow-archive-recruitment sow-featured-news-content row ">';

			get_sidebar('left');

			echo '<div class="col-12 col-md-8 col-lg-5 main-recruitment">';

				echo '<h6 class="recruitment-title">'.$object->name.'</h6>';

				if( $custom_query->have_posts() ):

					echo '<ul class="normal-list list-recruitment">';

					while( $custom_query->have_posts() ):

						$custom_query->the_post();

						fn_get_recruitment( get_the_ID(), 'type-2' );

					endwhile;

					echo '</ul>';

				else:

					echo '<div class="alert alert-info">'.__(" Chưa có công việc nào đăng tuyển tại đây",'diginet').'</div>';

				endif;

				$big = 999999999; // need an unlikely integer
				$translated = "Trang"; // Supply translatable string

				echo '<div class="pagination  pagi-recruiment wow fadeIn">'.paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'prev_text' => '<span class="fa fa-angle-left"></span>', 
					'next_text' => '<span class="fa fa-angle-right"></span>', 
					'total' => $custom_query->max_num_pages,
				        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
				) ).'</div>';

			echo '</div>';

			get_sidebar('right');
			
		echo '</div>';

	echo '</div>';

get_footer();