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
$form_id = 'uix_pb_section_authorcard';

/**
 * Form Type
 */
$form_type = [
	'list' => false
];



$args = 
	[
		array(
			'id'             => 'uix_pb_authorcard_primary_color',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_primary_color' ),
			'title'          => __( 'Primary Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_primary_color', '#a2bf2f' ),
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),

		array(
			'id'             => 'uix_pb_authorcard_avatar',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_avatar' ),
			'title'          => __( 'Author Picture', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_avatar', '' ),
			'placeholder'    => __( 'Avatar URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
								)
		
		),	
		

		
		array(
			'id'             => 'uix_pb_authorcard_name',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_name' ),
			'title'          => __( 'Author Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_name', '' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_authorcard_intro',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_intro' ),
			'title'          => __( 'Biographical Info', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_intro', '' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	

		array(
			'id'             => 'uix_pb_authorcard_link_label',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_link_label' ),
			'title'          => __( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_link_label', __( '&rarr;', 'uix-page-builder' ) ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_authorcard_link_link',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_link_link' ),
			'title'          => __( 'Link URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_link_link', '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),		



		array(
			'id'             => 'uix_pb_authorcard_1_url',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_1_url' ),
			'title'          => __( 'Social Network 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_1_url', '' ),
			'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_1_icon',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_1_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_1_icon', '' ),
			'placeholder'    => __( 'Choose Social Icon 1', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_authorcard_2_url',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_2_url' ),
			'title'          => __( 'Social Network 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_2_url', '' ),
			'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_2_icon',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_2_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_2_icon', '' ),
			'placeholder'    => __( 'Choose Social Icon 2', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
			
		
		array(
			'id'             => 'uix_pb_authorcard_3_url',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_3_url' ),
			'title'          => __( 'Social Network 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_3_url', '' ),
			'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_3_icon',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_authorcard_3_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => UixPageBuilder::fvalue( $sid, $item, 'uix_pb_authorcard_3_icon', '' ),
			'placeholder'    => __( 'Choose Social Icon 3', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert An Author Card', 'uix-page-builder' ) ); ?>            
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

