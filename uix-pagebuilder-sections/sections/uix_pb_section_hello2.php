<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_hello2';

/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-pagebuilder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';



/**
 * Element Template
 * ----------------------------------------------------
 */





/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_col2 = [
    'list'       => 2
];


$args_col2_1 = 
	[
	


		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_text' ),
			'title'          => __( 'Text2 - 1', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
			
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_textarea' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_1_textarea' ),
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_1_icon' ),
			'title'          => __( 'Icon', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Feature Icon', 'uix-pagebuilder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_upload' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_1_upload' ),
				'title'          => __( 'Upload Image', 'uix-pagebuilder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => __( 'Image URL', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' )
									)
			
		),	
			
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_slider' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_1_slider' ),
			'title'          => __( 'SLider', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_1_slider_units' ),
									'units_name'      => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_1_slider_units' ),
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),		
		
	
	]
;


$args_col2_2 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2' ),
			'title'          => __( 'Text2 - 2', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2_textarea' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_2_textarea' ),
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_2_icon' ),
			'title'          => __( 'Icon', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Feature Icon', 'uix-pagebuilder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2_upload' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_2_upload' ),
				'title'          => __( 'Upload Image', 'uix-pagebuilder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => __( 'Image URL', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' )
									)
			
		),	
			
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2_slider' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_2_slider' ),
			'title'          => __( 'SLider', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col2_2_slider_units' ),
									'units_name'      => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_col_demo_col2_2_slider_units' ),
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),			
	
	]
;


//---------

$form_type_col3 = [
    'list' => 3
];


$args_col3_1 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col3_1' ),
			'title'          => __( 'Text3 - 1', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;

$args_col3_2 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col3_2' ),
			'title'          => __( 'Text3 - 2', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;


$args_col3_3 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col3_3' ),
			'title'          => __( 'Text3 - 3', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;



//---------

$form_type_col4 = [
    'list' => 4
];


$args_col4_1 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col4_1' ),
			'title'          => __( 'Text4 - 1', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;

$args_col4_2 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col4_2' ),
			'title'          => __( 'Text4 - 2', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;
$args_col4_3 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col4_3' ),
			'title'          => __( 'Text4 - 3', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	]
;
$args_col4_4 = 
	[
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_col_demo_col4_4' ),
			'title'          => __( 'Text4 - 4', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_hello2_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_hello2_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => __( 'Form Demo 2', 'uix-pagebuilder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),
		
		
	
	]
;


//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_3, 'html', __( 'Item 3', 'uix-pagebuilder' ) );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_3, 'html', __( 'Item 3', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_4, 'html', __( 'Item 4', 'uix-pagebuilder' ) );


$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_2, 'js' );


$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_2, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_3, 'js' );


$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_2, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_3, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_4, 'js' );

//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_2, 'js_vars' );

$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_3, 'js_vars' );


$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_3, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_4, 'js_vars' );





/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Form Demo 2', 'uix-pagebuilder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}


/**
 * Returns forms with ajax
 * ----------------------------------------------------
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
}

