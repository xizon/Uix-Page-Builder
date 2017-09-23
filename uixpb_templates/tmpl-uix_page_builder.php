<?php
/**
 * Template Name: Uix Page Builder Template
 *
 * The template for displaying all pages with Uix Page Builder.
 * ---------------------------------------------------------------
 *
 * Hi, there! It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, 
 * you can use of the default page template or your own custom template file directly. As a workaround you can use FTP, 
 * access the Uix Page Builder template files path "/wp-content/plugins/uix-page-builder/uixpb_templates/" and upload 
 * files to your theme templates directory "/wp-content/themes/{your-theme}/".
 *
 */
?><!DOCTYPE html>
<html <?php echo language_attributes();?> class="no-js">
<head>
	<meta charset="<?php echo bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Header Area
	============================================= -->      
	<header class="uix-pb-header-area">

			<div class="uix-pb-container uix-pb-container-boxed">
				<div class="uix-pb-row">
					<div class="uix-pb-col-12 uix-pb-col-last">

							<div class="uix-pb-brand">
								<?php 
								$custom_logo_url = '';
								$custom_logo_id  = get_theme_mod( 'custom_logo' );
								
								$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
								if ( has_custom_logo() ) {
									$custom_logo_url = $logo[0];
								} 
								
								?>
								<?php if ( !empty( $custom_logo_url ) ) { ?>
								
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
									</a>	
									
								<?php } else { ?>
								
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>

									<?php if ( get_bloginfo( 'description' ) ) { ?>
										<p class="uix-pb-brand-description"><?php bloginfo( 'description' ); ?></p>
									<?php } ?>

								<?php } ?>           
							</div>
							<!-- .logo end -->

					</div>
				</div>
			</div>	
																	
	  </header>
	  
<!-- Navigation Area
		============================================= -->       
		  <nav class="uix-pb-menu-container">
			<?php
			  
			 $li_search = '
			 <li class="uix-pb-menu-search">
				<form class="uix-pb-search" method="get" action="'.esc_url( home_url( '/' ) ).'">
				  <div class="uix-pb-search-wrapper">
					<input type="search" autocomplete="off" name="s" placeholder="'.esc_html__( 'Search for...', 'uix-page-builder' ).'" class="uix-pb-search-field">
					<button type="submit" class="fa fa-search uix-pb-search-icon"></button>
				  </div>
				</form>
			</li>
			 ';
			  
			/*
			 * Display main menu
			 *
			*/    
			wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu'            => '',
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => '',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'uix_pb_default_menus',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="uix-pb-menu-embedded"><li class="uix-pb-menu-mobile-icon"><a href="javascript:void(0);">&#9776;</a></li>%3$s'.$li_search.'</ul>', 
						'depth'           => 0
					)
				);	


				function uix_pb_default_menus() {
					global $li_search;
				?>
				
				<ul class="uix-pb-menu-embedded">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'uix-page-builder' ); ?></a></li>
					<li><a target="_blank" href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Menu Settings', 'uix-page-builder' ); ?></a></li>
					<?php echo $li_search; ?>
				</ul>
		
				<?php	
				}

			
			?>


		  </nav>	


	
	<?php while ( have_posts() ) : the_post(); ?>


		<?php the_content(); ?>                      

	<?php endwhile; ?>  

       

	<!-- Footer
	============================================= -->    
	<footer class="uix-pb-footer-area">

		<div class="uix-pb-container uix-pb-container-boxed">
			<div class="uix-pb-row">
				<div class="uix-pb-col-12 uix-pb-col-last">
				
				    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'uix-page-builder' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'uix-page-builder' ), 'WordPress' ); ?></a>
				

				</div>
			</div>
		</div>

	</footer>
        
    
    <?php wp_footer(); ?>
   
  </body>
</html>


