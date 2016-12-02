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
		$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-pagebuilder-layoutdata', true ) );
		$pagebuilder_echo  = '';
		$item              = [];
		if ( $builder_content && is_array( $builder_content ) ) {
			foreach ( $builder_content as $key => $value ) :
				$con           = UixPageBuilder::pagebuilder_output( $value->content );
				$col           = $value->col;
				$row           = $value->row;
				$size_x        = $value->size_x;
				$section_id    = $value->secindex;
				$section_title = $value->title;
				$element_code  = '';
				
			
				if ( $con && is_array( $con ) ) {
					foreach ( $con as $key ) :
						
						$$key[ 0 ] = $key[ 1 ];
						$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
					endforeach;
				}
		
				//------------------------------------   loop sections
				if ( sizeof( $item ) > 3 && !empty( $value->content ) ) {
					
					$col_content   = UixPageBuilder::pagebuilder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
					
					if ( $col_content && is_array( $col_content ) ) {
						foreach ( $col_content as $key => $value ) :
							
							$colid           = $value[0][1]; //column id
							$temp_index      = count( $value ) - 1;
						
							if ( UixPageBuilder::inc_str( $value[ $temp_index ][ 0 ], '_temp' ) ) {
								$element_code .= UixPageBuilder::theme_value( $value[ $temp_index ][ 1 ] );	
							}

						
						endforeach;
						
					  
						//Section container
						echo  '<div class="uix-pagebuilder-section" id="uix-pagebuilder-section-'.$row.'" data-row="'.$section_id.'">'.$element_code.'</div>'; 
						//WP menu title of anchor link
						echo "\n".'<div data-pb-section-title="'.esc_attr( $section_title ).'"></div>'."\n<!-- ".wp_kses( __( 'End Section', 'uix-pagebuilder' ), wp_kses_allowed_html( 'post' ) )." -->\n\n";	
						

						
					}
					
	
				}
				
				//------------------------------------ end sections

				
		
			endforeach;
			
	
		}
	
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


