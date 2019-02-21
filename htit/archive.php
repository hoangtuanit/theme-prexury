<?php 

get_header(); 

	$object = get_queried_object();

	echo '<div class="container">';

		echo  htit_sow_generator_title( $object->name , 'h3' , 'border-left-over' );

		echo '<div class="sow-archive sow-featured-news-content d-flex row flex-wrap  justify-content-start">';

		if( have_posts() ):

			while( have_posts() ):

				the_post();

				$post_id 	= get_the_ID();
				$post_title = get_the_title();

				$img = iz_get_image( $post_id, 'large');

				echo '<div class="wrap-item col-6 col-sm-6 col-md-3">';
				echo '<div class="item-featured">';

					echo '<a  href="'.get_permalink( $post_id ).'" title="'.$post_title.'" class="overlay-img">';
						echo '<img src="'.$img.'" alt="'.$post_title.'"/>';
					echo '</a>';

					echo '<div class="item-title">';
						echo '<a href="'.get_permalink( $post_id ).'" title="'.$post_title.'">';
							echo '<h6>'.$post_title.'</h6>';
						echo '</a>';
						
						echo '<p>'.iz_excerpt( $post_id, 100 ).'</p>';

					echo "</div>";

					// end .item-news
				echo '</div>';	
				echo '</div>';	

			endwhile;

		else:

			echo '<div class="alert alert-info">'.__(" Chưa có bài viết tại đây",'diginet').'</div>';

		endif;
			
		echo '</div>';

	echo '</div>';


	$big = 999999999; // need an unlikely integer
	$translated = "Trang"; // Supply translatable string

	echo '<div class="pagination  wow fadeIn">'.paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
	        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
	) ).'</div>';

get_footer();