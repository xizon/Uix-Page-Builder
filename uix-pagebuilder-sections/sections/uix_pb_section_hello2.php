<?php
include dirname( __FILE__ ) . 'data.php';


/**
 * Form ID
 */
$form_id = 'uix_pb_form_hello2';

/**
 * Form Type
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
		
	
	]
;


//---

$form_html = UixSCFormCore::form_before( $cid, $sid, $form_id );


$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );


$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_3, 'html', __( 'Item 3', 'uix-pagebuilder' ) );


$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_1, 'html', __( 'Item 1', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_2, 'html', __( 'Item 2', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_3, 'html', __( 'Item 3', 'uix-pagebuilder' ) );
$form_html .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_4, 'html', __( 'Item 4', 'uix-pagebuilder' ) );


$form_html .= UixSCFormCore::form_after();

//----

$form_js = '';
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_1, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_2, 'js' );


$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_1, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_2, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_3, 'js' );


$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_1, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_2, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_3, 'js' );
$form_js .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_4, 'js' );

//----

$form_js_vars = '';
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_1, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col2, $args_col2_2, 'js_vars' );

$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_1, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_2, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col3, $args_col3_3, 'js_vars' );


$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_1, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_2, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_3, 'js_vars' );
$form_js_vars .= UixSCFormCore::add_form( $cid, $sid, $form_id, $form_type_col4, $args_col4_4, 'js_vars' );



/**
 * Returns actions of javascript
 */

if ( $sid == -1 && is_admin() ) {
	$currentScreen = get_current_screen();
	if( $currentScreen->base === "post" || $currentScreen->base === "widgets" || $currentScreen->base === "customize" || UixSCFormCore::inc_str( $currentScreen->base, '_page_' ) ) {
  
		
		
		?>
		<script type="text/javascript">
		( function($) {
		'use strict';
			$( function() {  
				<?php echo UixSCFormCore::uixscform_callback( $form_js, $form_id, __( 'Demo Form 2', 'uix-pagebuilder' ) ); ?>					
				<?php echo UixSCFormCore::send_before( $form_js_vars, $form_id ); ?> 
				/*--**************** Custom shortcode begin ****************-- */
					
				code = "[uix_hello2][/uix_hello2]";
					
				/*--**************** Custom shortcode end ****************-- */
				<?php echo UixSCFormCore::send_after(); ?> 
		} ) ( jQuery );
		</script>
 
		<?php

	}
	
}


/**
 * Returns forms with ajax
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
}
