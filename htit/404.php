<?php 

get_header(); 

	global $iz_options;


	echo '<div class="page-404">';

		echo '<div class="container container-404">';

			echo  htit_sow_generator_title( 'Có vẻ như bạn đang mất phương hướng, chuyển về trang chủ trong 3 giây' , 'h3' , 'border-left-over' );

			// get_search_form();

			?>

			<script>
				setTimeout( function(){
					window.location ='<?php echo home_url() ?>';
				}, 3000 )
			</script>

			<?php

		echo '</div>';

		if( is_array( $iz_options['image_404'] ) ){

			echo '<a class="img-404" href="'.home_url().'" title="'.__('Về trang chủ','diginet' ).'">';
				echo '<img class="img-fluid" src="'.$iz_options['image_404']['url'].'" alt="page 404 "/>';
			echo '</a>';
		}
		
	echo '</div>';


get_footer();