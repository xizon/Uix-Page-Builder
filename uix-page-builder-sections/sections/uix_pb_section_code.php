<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Sections template parameters
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Title', 'uix-page-builder' );
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
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
			 
		}
		
		echo $pagebuilder_echo;

	}
	
	
}


/**
 * Form ID
 */
$form_id = 'uix_pb_section_code';

/**
 * Form Type
 */
$form_type = [
	'list' => false
];



$args = 
	[
		
		array(
			'id'             => 'uix_pb_code_info',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_code_info' ),
			'title'          => __( 'Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_code_info', '' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	
	
	
	]
;

$form_html = UixPBFormCore::add_form( $wname, $sid, $form_id, $form_type, $args, 'html' );
$form_js = UixPBFormCore::add_form( $wname, $sid, $form_id, $form_type, $args, 'js' );
$form_js_vars = UixPBFormCore::add_form( $wname, $sid, $form_id, $form_type, $args, 'js_vars' );



/**
 * Returns actions of javascript
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert Code', 'uix-page-builder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}


/**
 * Returns forms with ajax
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
}

