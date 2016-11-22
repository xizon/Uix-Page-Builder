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
$cursectionData    = UixPageBuilder::pagebuilder_output( json_decode( get_post_meta( $post->ID, 'uix-page-builder-layoutdata', true ), true )[$section_id]['content'] );
$item              = [];

if ( $cursectionData && is_array( $cursectionData ) ) {
	foreach ( $cursectionData as $key ) {
		
		$$key[ 0 ] = $key[ 1 ];
		$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
	}	
}
