<?php

get_header();

	do_action('iz_before_wrap_content');

	if( have_posts() ):

		while( have_posts() ):

			the_post();

			$hide_title = get_post_meta( get_the_ID(), 'title', true );

			if( $hide_title == 0 ){
				the_title("<h6 class='post-title' style='margin-top: 30px;'>","</h6>");
			}

			the_content();

		endwhile;

	endif;

	do_action('iz_after_wrap_content');

get_footer();
 