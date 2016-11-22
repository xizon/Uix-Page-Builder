<?php 
$uix_pb_config = [
	
		array(
			'title'           => __( 'Author Card', 'uix-page-builder' ),
			'id'              => 'uix_pb_section_authorcard'
		
		),	
		
];

/**
 * Sections template parameters
 */
$section_id = ( isset( $_COOKIE[ 'uix-page-section-cur' ] ) ) ? $_COOKIE[ 'uix-page-section-cur' ] : 0;
global $post;

// Page Builder
$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-page-builder-layoutdata', true ) );

if ( $builder_content && is_array( $builder_content ) ) {
	foreach ( $builder_content as $key => $value ) {
		$con     = UixPageBuilder::pagebuilder_output( $value->content );
		
		$item = [];
		if ( $con && is_array( $con ) ) {
			foreach ( $con as $key ) {
				
				$$key[ 0 ] = $key[ 1 ];
				$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
			}	
		}

	}

}