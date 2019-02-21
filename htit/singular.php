<?php

get_header();

	do_action('iz_before_wrap_content');

	echo '<div class="post-row section-row">';
		echo '<div class="container">';
		
			if( have_posts() ):

				while( have_posts() ):

					the_post();
					the_content();

				endwhile;

			endif;

			do_action('iz_after_single_loop');

		echo '</div>';
	echo '</div>';
	// end .row

	do_action('iz_after_wrap_content');

get_footer();
 