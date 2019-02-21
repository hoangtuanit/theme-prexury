<aside id='primary-sidebar' class="col-12 col-md-4 col-lg-3">
	<?php if ( is_active_sidebar( 'primary' ) ) : ?>
		<ul id="sidebar" class="list-sidebar wow fadeInUp ">
			<?php dynamic_sidebar( 'primary' ); ?>
		</ul>
	<?php endif; ?>

	<?php  

		global $iz_options;

		if( (int) $iz_options['sidebar'] > 0 ){
			iz_get_structure( $iz_options['sidebar']);
		}

	?>

</aside>

