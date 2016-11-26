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
$form_id = 'uix_pb_section_accordion';

/**
 * Form Type
 */
$form_type = [
    'list' => false
];


//The maximum of clone form 
$clone_max = 30;

$args = 
	[
	 
		//------list begin
		array(
			'id'             => 'uix_pb_accordion_list',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_accordion_list' ),
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-uix_pb_accordion_listitem_title',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-uix_pb_accordion_listitem_con',
											'type'      => 'textarea'
										), 
	

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
			array(
				'id'             => 'uix_pb_accordion_listitem_title',
				'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_accordion_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_accordion_listitem_title', __( 'Accordion Title', 'uix-page-builder' ), $clone_max ),
				'class'          => 'dynamic-row-uix_pb_accordion_listitem_title', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_accordion_listitem_con',
				'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_accordion_listitem_con' ),
				'title'          => '',
				'desc'           => '',
				'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_accordion_listitem_con', __( 'Accordion content here.', 'uix-page-builder' ), $clone_max ),
				'class'          => 'dynamic-row-uix_pb_accordion_listitem_con', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
			
			
		
		//------list end
		
		


		
	
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
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( 'uix_pb_accordion_list', UixPBFormCore::dynamic_form_code( 'dynamic-row-uix_pb_accordion_listitem_title', $form_html ).UixPBFormCore::dynamic_form_code( 'dynamic-row-uix_pb_accordion_listitem_con', $form_html ) );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert Accordion', 'uix-page-builder' ) ); ?>            
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

