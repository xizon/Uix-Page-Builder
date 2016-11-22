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
			    
				//load sections template
				$item = [];
				
				if ( $con && is_array( $con ) ) {
					foreach ( $con as $key ) {
						
						$$key[ 0 ] = $key[ 1 ];
						$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
					}	
				}

				/*====================================================================
				 * Section Template : Author Card
				 * ===================================================================
				 */
				$avatarURL = ( !empty( $item[ 'uix_pb_authorcard_avatar' ] ) ) ? $item[ 'uix_pb_authorcard_avatar' ] : UixFormCore::plug_directory() .'images/no-photo.png';
				
				$social_out_1 = ( !empty( $item[ 'uix_pb_authorcard_1_icon' ] ) ) ? '<a href=\''.$item[ 'uix_pb_authorcard_1_url' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ 'uix_pb_authorcard_1_icon' ] ) ? $item[ 'uix_pb_authorcard_1_icon' ] : 'link' ).'\'></i></a>' : '';
				$social_out_2 = ( !empty( $item[ 'uix_pb_authorcard_2_icon' ] ) ) ? '<a href=\''.$item[ 'uix_pb_authorcard_2_url' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ 'uix_pb_authorcard_2_icon' ] ) ? $item[ 'uix_pb_authorcard_2_icon' ] : 'link' ).'\'></i></a>' : '';
				$social_out_3 = ( !empty( $item[ 'uix_pb_authorcard_3_icon' ] ) ) ? '<a href=\''.$item[ 'uix_pb_authorcard_3_url' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ 'uix_pb_authorcard_3_icon' ] ) ? $item[ 'uix_pb_authorcard_3_icon' ] : 'link' ).'\'></i></a>' : '';
				   
				$section_temp = '
				<div class="uix-pb-authorcard" style="border-top-color: '.$item[ 'uix_pb_authorcard_primary_color' ].';">
					<div class="uix-pb-authorcard-top">
						<div class="uix-pb-authorcard-text">
							<h3 class="uix-pb-authorcard-title">'.$item[ 'uix_pb_authorcard_name' ].'
							'.$social_out_1.'
							'.$social_out_2.'
							'.$social_out_3.'
							</h3> 	 
						</div>
						<div class="uix-pb-authorcard-pic"><img src="'.$avatarURL.'" id="'.UixFormCore::get_attachment_id( $avatarURL ).'" alt="'.esc_attr( $item[ 'uix_pb_authorcard_name' ] ).'"></div>
					</div>
					<div class="uix-pb-authorcard-middle">'.$item[ 'uix_pb_authorcard_intro' ].'</div> 
					<a class="uix-pb-authorcard-final" href="'.$item[ 'uix_pb_authorcard_link_link' ].'" rel="author">'.$item[ 'uix_pb_authorcard_link_label' ].'</a> 
				</div>        
				 ';
					
					
				//echo	 
			   $pagebuilder_echo .=  '<div class="uix-page-builder-section" id="uix-page-builder-section-'.$row.'" data-name="'.$item[ 'section' ].'" data-row="'.$item[ 'row' ].'">'.$section_temp.'</div>';
			}
			
			echo $pagebuilder_echo;
	
		}
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


