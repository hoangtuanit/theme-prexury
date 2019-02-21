<?php

get_header();
	
	
	
	do_action('iz_before_wrap_content');

	echo '<div class="single-row row">';

		echo '<div class="col-12 col-md-8 col-lg-9">';

			echo '<div class="main-content">';

			if( have_posts() ):

				$str_terms = htit_get_post_terms( get_the_ID() );
				if( !empty( $str_terms ))
					echo  '<div class="list-term border-left-over">'.$str_terms.'</div>';

				while( have_posts() ):

					the_post();
					the_title('<h6 class="single-title">','</h6>');
					the_content();

				endwhile;

			endif;
			

			global $iz_options;

			if( $iz_options['show_post_author'] == 1 ){

				$author_id = get_the_author_id( get_the_ID()  );

				$author = new WP_User( $author_id );

				$author_name = !empty( $author->data->display_name  )  ? $author->data->display_name :   $author->data->user_nicename; 


				echo '<div class="post_author"> '.__('Tác giả','diginet').' : '.$author_name.'</div>';

			}


			if( $iz_options['show_post_date'] == 1 ){
				echo '<div class="post_date"> '.__('Ngày đăng','diginet').' : '.get_the_date().'</div>';
			}

			if( $iz_options['show_tags'] == 1 ){
				echo '<div class="post-tags">';
	                $tags = wp_get_post_tags( get_the_ID()  );

	                if( count( $tags ) > 0  ){
	                    foreach ($tags as $key => $term) {
	                        echo '<div class="post-item">';
	                            echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a>';

	                        echo '</div>';
	                    }
	                }

	            echo '</div>';
			}

			htit_single_share( get_permalink(), get_the_title(), get_the_excerpt() );

			do_action('iz_after_single_loop');

			echo '</div>';
			// end .main-content
		echo '</div>';

		get_sidebar();

	echo '</div>';
	// end .row

	do_action('iz_after_wrap_content');

get_footer();
 