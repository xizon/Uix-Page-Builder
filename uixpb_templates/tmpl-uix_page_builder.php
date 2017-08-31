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
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

get_header(); ?>
     
	<?php while ( have_posts() ) : the_post(); ?>
            
  
		<?php
		if ( class_exists( 'UixPageBuilder' ) ) {
			echo do_shortcode( "[uix_pb_sections]" );
		} else {
			the_content();
		}
        ?>                      
   
    <?php endwhile; ?>  

<?php get_footer(); ?>


