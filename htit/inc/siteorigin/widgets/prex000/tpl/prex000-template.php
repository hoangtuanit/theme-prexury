<div class="footer-box">
	<div class="row">

		<?php  
			if( isset( $instance['items'] ) && count( $instance['items']) ):
				foreach ($instance['items'] as $key => $data) { ?>
	    			<div class="col-sm-4">
	    				<div class="footer-buttons">
	    					<a href="<?php echo sow_esc_url( $data['url']) ?>" class="footer-button">
	    						<span> <?php echo siteorigin_widget_get_icon( $data['icon'] ) ?> </span>
	    						<span class="footer-button-text"> <?php echo $data['title'] ?> </span>
	    					</a>
	    				</div>
	    				<!-- end footer-buttons -->
	    			</div>

    			<?php
				}
	    	endif;

		?>

		
	</div>
</div>