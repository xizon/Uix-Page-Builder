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
		$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-pagebuilder-layoutdata', true ) );
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
				
				if ( sizeof( $item ) > 3 && !empty( $value->content ) ) :
					
					$sid   = $item[ 'row' ];
					$fid   = $item[ 'section' ];
					$wname = $item[ 'widgetname' ];
			
					/*====================================================================
					 * Section Template : Author Card
					 * ===================================================================
					 */	 
					 if ( $fid == 'uix_pb_section_authorcard' ) {
						 
						$avatarURL = ( !empty( $item[ '[uix_pb_authorcard_avatar]['.$sid.']' ] ) ) ? $item[ '[uix_pb_authorcard_avatar]['.$sid.']' ] : UixPBFormCore::plug_directory() .'images/no-photo.png';
						
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
								<div class="uix-pb-authorcard-pic"><img src="'.$avatarURL.'" id="'.UixPBFormCore::get_attachment_id( $avatarURL ).'" alt="'.esc_attr( $item[ '[uix_pb_authorcard_name]['.$sid.']' ] ).'"></div>
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
					 
					 
					 
					/*====================================================================
					 * Section Template : Accordion
					 * ===================================================================
					 */	 
					 if ( $fid == 'uix_pb_section_accordion' ) {
						 
						
						$list_accordion_item = '';
						
						for ( $i = 0; $i <= 30; $i++ ) {
							$uid = ( $i == 0 ) ? '' : $i.'-';
							
							if ( is_array( $item ) && array_key_exists( '['.$uid.'uix_pb_accordion_listitem_title]['.$sid.']', $item ) ) {
								$list_accordion_item .= '
									<h4>'.$item[ '['.$uid.'uix_pb_accordion_listitem_title]['.$sid.']' ].'</h4>
									<p>'.$item[ '['.$uid.'uix_pb_accordion_listitem_con]['.$sid.']' ].'</p>	
	
								';
							}
							
						}
						
						$section_temp = '
						<div class="uix-pb-accordion">
						    '.$list_accordion_item.'
						</div>        
						 ';
						 
					 }/*end section*/	  
					 
					 
					 
					 
					 //====================================================================
					 
				
					$pagebuilder_echo .=  '<div class="uix-pagebuilder-section" id="uix-pagebuilder-section-'.$row.'" data-name="'.$fid.'" data-row="'.$sid.'">'.$section_temp.'</div>'; 
					//WP menu title of anchor link
					$pagebuilder_echo .= "\n".'<div data-pb-section-title="'.$wname.'"></div>'."\n<!-- ".uiuxlabtheme_wp_kses( __( 'End Section', 'uix-pagebuilder' ) )." -->\n\n";
 
					 
				
				endif;


				 
				 
			}
			
			echo $pagebuilder_echo;
	
		}
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


