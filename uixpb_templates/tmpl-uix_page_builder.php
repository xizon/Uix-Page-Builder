<?php
/**
 * Template Name: Uix Page Builder Template
 *
 * The template for displaying all pages with Uix Page Builder.
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


