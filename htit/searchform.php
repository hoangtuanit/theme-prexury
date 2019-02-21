<form action="<?php echo home_url() ?>" method="get">
	
	<div class="form-group">
		<input type="text" name='s' class="form-control" placeholder="Mã tin *" value="<?php echo $sku ?>" />
		<input type="hidden" name='post_type' value="recruitment">
	</div>

	<div class="form-group">
		<?php  

			$attrs = array(
				'show_option_all' 	=> __('Ngành Nghề', 'diginet' ),
				'hide_empty' 	  	=> false ,
				'class' 			=> 'form-control', 
				'depth' 			=> 2,
				'name'   			=> 'tax',
				'hierarchical' 		=> true,
				'taxonomy' 			=> 'recruitment_tax',
				'selected' 			=> $tax_id
			);
			// wp_dropdown_categories( $attrs ); 

			$taxs = get_terms( array('taxonomy' => 'recruitment_tax', 'hide_empty' => false,'orderby' => 'menu_order','parent' => 0  ));
			echo '<select name="tax" class="form-control">';
			foreach ($taxs as $key => $tax_item) {
				$term_childs = get_term_children( $tax_item->term_id, 'recruitment_tax');

				echo '<option value="'.$tax_item->term_id.'"> <b> '.$tax_item->name.'</b> </option>';
				if( is_array( $term_childs ) && count( $term_childs) > 0  ){
					foreach ($term_childs as $key => $child_id) {
						$child_item = get_term( $child_id );
						echo '<option value="'.$child_item->term_id.'"> -- <span>'.$child_item->name.' </span> </option>';
					}
				}

			}
			echo '</select>';

		?>
	</div>

	<div class="form-group">
		<?php  

			$attr_city = array(
				'show_option_all' 	=> __('Nơi làm việc', 'diginet' ),
				'hide_empty' 	  	=> false ,
				'class' 			=> 'form-control', 
				'depth' 			=> 2,
				'name'   			=> 'city',
				'hierarchical' 		=> true,
				'taxonomy' 			=> 'recruitment_city',
				'selected' 			=> $city_id
			);
			wp_dropdown_categories( $attr_city ); 

		?>
	</div>

	<div class="form-action">
		<input type="submit" class="btn btn-primary" value="<?php echo __("TÌM KIẾM",'diginet') ?>">
	</div>

</form>