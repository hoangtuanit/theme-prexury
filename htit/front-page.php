<?php

get_header();

	// do_action('iz_before_wrap_content');

	if( have_posts() ):

		while( have_posts() ):

			the_post();
			the_content();

		endwhile;

	endif;

	// do_action('iz_after_wrap_content');

get_footer();
 