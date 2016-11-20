<?php
/**
 * Template Name: Uix Page Builder
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
        // Page Builder
        $builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-page-builder-layoutdata', true ) );
        $pagebuilder_echo = '';
        $current_row       = 0;
		
		if ( $builder_content && is_array( $builder_content ) ) {
			foreach ( $builder_content as $key => $value ) {
				$con     = UixPageBuilder::pagebuilder_output( $value->content );
				$col     = $value->col;
				$row     = $value->row;
				$size_x  = $value->size_x;
			
			
			   $pagebuilder_echo .=  "<div style='border: 3px dashed #DFDFDF;padding: 15px; background-color: #F7F7F7;margin:20px;'>". $con . "</div>";
			}
			
			$pagebuilder_echo .=  "</div>"; 
			
			echo $pagebuilder_echo;
	
		}
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


