<?php global $iz_options; ?>

	</main>

	<footer id="footer">
		
		<div class="container">
			
			<?php  
			
				if( (int) $iz_options['footer'] > 0 ){
					iz_get_structure( $iz_options['footer']);
				}


			?>

		</div>	

		<?php wp_footer(); ?>

	</footer>
	
	</body>
	
</html>