<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
	    <meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">

      <?php wp_head(); ?>
	</head>
	<body <?php body_class( 'bghack' );  ?>>
	    <div class="container">
		    <header role="banner">
		        <div class="banner-cont">
	        	<?php if( get_header_image() <> '' ):  ?>
		            <a href="<?php echo esc_url( home_url() ) ?>">
		                <img src="<?php header_image(); ?>" alt="banner" class="img-fluid">
		             </a>
	          	<?php endif; ?>
		        </div> <!-- /.banner-cont -->
		        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-5" role="navigation" id="nav-menu">
                	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    	<span class="navbar-toggler-icon"></span>
                  	</button>
                    <?php	if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array(
	                            	'theme_location'    => 'primary',
	                            	'depth'             => 2,
	                            	'container'         => 'div',
	                            	'container_class'   => 'collapse navbar-collapse',
	                            	'container_id'      => 'bs-example-navbar-collapse-1',
	                            	'menu_class'        => 'navbar-nav mr-auto',
	                            	'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
	                            	'walker'            => new WP_Bootstrap_Navwalker()
	                            	)
                        		);
							}
					?>
					<?php	if ( has_nav_menu( 'accounts' ) ) {
								wp_nav_menu( array(
									'theme_location'    => 'accounts',
									'depth'             => 2,
									'container'         => 'div',
									'container_class'   => 'collapse navbar-collapse',
									'container_id'      => 'bs-example-navbar-collapse-2',
									'menu_class'        => 'navbar-nav ml-auto',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker()
	                        		)
								);
							}
                    ?>
                </nav>
		    </header>
		    <main class="text-white">
