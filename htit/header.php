<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

	<?php do_action('iz_body') ?>

	<?php  

		$header_class = 'header-type';

		if( is_singular() ){
			$header_class .= get_post_meta( get_the_ID(), 'type_header', true );
		}


	?>

	<header id="masthead" class="site-header" role="banner">
	 	<nav id="site-navigation" class="main-navigation navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        	<div class="container">
	            <div class="navbar-header">

	            	<?php  

	            		global $iz_options;

	            		if( $iz_options['logo']['url'] ):
	            			
			                echo '<a class="navbar-brand" href="'.home_url().'">';
								echo '<img alt="Home page" src="'.$iz_options['logo']['url'].'">';
							'</a>';

	            		endif;

	            	?>

	                
	                <button type="button" class="navbar-toggle hidden-xs hidden-sm" data-toggle="collapse" data-target="#navbar-collapse-main">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end .navbar-header -->
	            <div class="collapse navbar-collapse" id="navbar-collapse-main">
					<?php  

	                	$args = array(
									'theme_location' => 'primary', 
									'menu_class' 	 => 'nav navbar-nav hidden-sm',
									'container' 	 => 'ul', 
									'depth' 		 => 1
								);
								
						wp_nav_menu( $args );

	            	?>
	            </div>
	            <!-- end #navbar... -->
	        </div>
	    </nav>
	</header>
	<!-- end header -->


	<main id="main">		

		<?php do_action('iz_before_main') ?>

