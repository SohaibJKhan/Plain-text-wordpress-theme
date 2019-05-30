<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="pingback" href=" <?php bloginfo( 'pingback_url' ); ?>" >
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
			<header class="site_header" id="main_header">
				<div class="wrapper clearfix">
					<div class="logo">						
						<?php the_custom_logo(); ?>											  
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) );?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					</div>
						<div class="links" id="main_links">
						<?php 
						$arg_2 = array( 
							 		'theme_location' => 'header_right' ,
							 		'menu_class' => 'header_menu' ,
							 		'menu_id' => 'header_1' ,
							 		'container_id' => 'cssmenu' ,
							 		// do not edit this\/..//
							 		'walker' => new plaintext_MENU_Walker()
								 	);
									wp_nav_menu($arg_2); 
						?>
					</div>
				</div>			
			
			</header>				
	