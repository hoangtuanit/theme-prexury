<aside id='left-sidebar' class="col-12 col-md-4 col-lg-3">
	
	<?php  

		global $iz_options;

		if( (int) $iz_options['left_recruitment'] > 0 ){
			iz_get_structure( $iz_options['left_recruitment']);
		}

	?>

</aside>

