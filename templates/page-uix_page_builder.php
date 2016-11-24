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
        // Page Builder
		$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-page-builder-layoutdata', true ) );
        $pagebuilder_echo  = '';
		$item              = [];
		
		if ( $builder_content && is_array( $builder_content ) ) {
			foreach ( $builder_content as $key => $value ) {
				$con     = UixPageBuilder::pagebuilder_output( $value->content );
				$col     = $value->col;
				$row     = $value->row;
				$size_x  = $value->size_x;
				
				if ( $con && is_array( $con ) ) {
					foreach ( $con as $key ) {
						
						$$key[ 0 ] = $key[ 1 ];
						$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
					
					}	
				}
				$sid = $item[ 'row' ];
				$fid = $item[ 'section' ];
		
				/*====================================================================
				 * Section Template : Author Card
				 * ===================================================================
				 */	 
				 if ( $fid == 'uix_pb_section_authorcard' ) {
					 
					$avatarURL = ( !empty( $item[ '[uix_pb_authorcard_avatar]['.$sid.']' ] ) ) ? $item[ '[uix_pb_authorcard_avatar]['.$sid.']' ] : UixFormCore::plug_directory() .'images/no-photo.png';
					
					$social_out_1 = ( !empty( $item[ '[uix_pb_authorcard_1_icon]['.$sid.']' ] ) ) ? '<a href=\''.$item[ '[uix_pb_authorcard_1_url]['.$sid.']' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ '[uix_pb_authorcard_1_icon]['.$sid.']' ] ) ? $item[ '[uix_pb_authorcard_1_icon]['.$sid.']' ] : 'link' ).'\'></i></a>' : '';
					$social_out_2 = ( !empty( $item[ '[uix_pb_authorcard_2_icon]['.$sid.']' ] ) ) ? '<a href=\''.$item[ '[uix_pb_authorcard_2_url]['.$sid.']' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ '[uix_pb_authorcard_2_icon]['.$sid.']' ] ) ? $item[ '[uix_pb_authorcard_2_icon]['.$sid.']' ] : 'link' ).'\'></i></a>' : '';
					$social_out_3 = ( !empty( $item[ '[uix_pb_authorcard_3_icon]['.$sid.']' ] ) ) ? '<a href=\''.$item[ '[uix_pb_authorcard_3_url]['.$sid.']' ].'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $item[ '[uix_pb_authorcard_3_icon]['.$sid.']' ] ) ? $item[ '[uix_pb_authorcard_3_icon]['.$sid.']' ] : 'link' ).'\'></i></a>' : '';
					   
					$section_temp = '
					<div class="uix-pb-authorcard" style="border-top-color: '.$item[ '[uix_pb_authorcard_primary_color]['.$sid.']' ].';">
						<div class="uix-pb-authorcard-top">
							<div class="uix-pb-authorcard-text">
								<h3 class="uix-pb-authorcard-title">'.$item[ '[uix_pb_authorcard_name]['.$sid.']' ].'
								'.$social_out_1.'
								'.$social_out_2.'
								'.$social_out_3.'
								</h3> 	 
							</div>
							<div class="uix-pb-authorcard-pic"><img src="'.$avatarURL.'" id="'.UixFormCore::get_attachment_id( $avatarURL ).'" alt="'.esc_attr( $item[ '[uix_pb_authorcard_name]['.$sid.']' ] ).'"></div>
						</div>
						<div class="uix-pb-authorcard-middle">'.$item[ '[uix_pb_authorcard_intro]['.$sid.']' ].'</div> 
						<a class="uix-pb-authorcard-final" href="'.$item[ '[uix_pb_authorcard_link_link]['.$sid.']' ].'" rel="author">'.$item[ '[uix_pb_authorcard_link_label]['.$sid.']' ].'</a> 
					</div>        
					 ';
					 
				 }/*end section*/	 
				 
				 
				/*====================================================================
				 * Section Template : Code
				 * ===================================================================
				 */	 
				 if ( $fid == 'uix_pb_section_code' ) {
					 
					
					$section_temp = '
					<code>
						'.$item[ '[uix_pb_code_info]['.$sid.']' ].'
					</code>        
					 ';
					 
				 }/*end section*/	  


				//echo	 
				$pagebuilder_echo .=  '<div class="uix-page-builder-section" id="uix-page-builder-section-'.$row.'" data-name="'.$fid.'" data-row="'.$sid.'">'.$section_temp.'</div>'; 
				 
				 
			}
			
			echo $pagebuilder_echo;
	
		}
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


