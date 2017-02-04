<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_pricing2';

/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';



if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::page_builder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::page_builder_output( $value->content );
			
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::page_builder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
			if ( $col_content && is_array( $col_content ) ) {
				foreach ( $col_content as $key ) :
				    
					$detail_content = $key;
					
					//column id
					$colname           = $form_id.'-col';
					$cname             = str_replace( $form_id.'|', '', $key[1][0] );
					$id                = $key[0][1];
					$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_section_xxx-col' ];
					
				
					foreach ( $detail_content as $value ) :	
						$name           = str_replace( $form_id.'|', '', $value[0] );
						$content        = $value[1];
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];
						
					endforeach;
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}




/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];


$args_config = [
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
];						


$module_config = 
	[
	
		array(
			'id'             => 'uix_pb_pricing_col4_config_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_pricing_col4_config_intro',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	]
;


$form_type = [
    'list' => 4
];


$args_1 = 
	[
	
		array(
			'id'             => 'uix_pb_pricing_col4_one_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'free', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_one_price',
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 49,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_one_emphasis_color',
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col4_one_currency',
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_one_period',
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_one_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_one_btn_label',
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'TRY FOR FREE', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col4_one_btn_link',
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_one_btn_color',
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col4_one_btn_win',
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_one_features',
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => UixPageBuilder::html_listTran( __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_one_active',
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	]
;


$args_2 = 
	[
	
		array(
			'id'             => 'uix_pb_pricing_col4_two_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'premium', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_two_price',
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 69,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_two_emphasis_color',
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col4_two_currency',
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_two_period',
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_two_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_two_btn_label',
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col4_two_btn_link',
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_two_btn_color',
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col4_two_btn_win',
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_two_features',
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => UixPageBuilder::html_listTran( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_two_active',
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	]
;


$args_3 = 
	[
	
		array(
			'id'             => 'uix_pb_pricing_col4_three_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'professional', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_three_price',
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 109,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_three_emphasis_color',
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col4_three_currency',
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_three_period',
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_three_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_three_btn_label',
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col4_three_btn_link',
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_three_btn_color',
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col4_three_btn_win',
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_three_features',
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => UixPageBuilder::html_listTran( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description', 'uix-page-builder' ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_three_active',
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),
		

	
	]
;

$args_4 = 
	[
	
		array(
			'id'             => 'uix_pb_pricing_col4_four_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'expand', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_four_price',
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 139,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_four_emphasis_color',
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col4_four_currency',
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing_col4_four_period',
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_four_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_four_btn_label',
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col4_four_btn_link',
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_four_btn_color',
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col4_four_btn_win',
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_four_features',
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => UixPageBuilder::html_listTran( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description<br>Another Feature Description', 'uix-page-builder' ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col4_four_active',
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),
		
		
        //------- template
		array(
			'id'             => $form_id.'_temp',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	
			

	
	]
;


//---
$form_html  = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_1, 'html', __( 'Table 1', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_2, 'html', __( 'Table 2', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_3, 'html', __( 'Table 3', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_4, 'html', __( 'Table 4', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::form_after();


//----
$form_js_vars  = '';
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_3, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_4, 'js_vars' );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Pricing Table (4 column)', 'uix-page-builder' ) ); ?>         
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
	?>
    
<script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>


			var win_one        = ( uix_pb_pricing_col4_one_btn_win === true ) ? 'target="_blank"' : '',
				win_two        = ( uix_pb_pricing_col4_two_btn_win === true ) ? 'target="_blank"' : '',
				win_three      = ( uix_pb_pricing_col4_three_btn_win === true ) ? 'target="_blank"' : '',
				win_four       = ( uix_pb_pricing_col4_four_btn_win === true ) ? 'target="_blank"' : '',

				imclass_one    = ( uix_pb_pricing_col4_one_active === true ) ? 'uix-pb-price-important' : '',
				imclass_two    = ( uix_pb_pricing_col4_two_active === true ) ? 'uix-pb-price-important' : '',
				imclass_three  = ( uix_pb_pricing_col4_three_active === true ) ? 'uix-pb-price-important' : '',
				imclass_four   = ( uix_pb_pricing_col4_four_active === true ) ? 'uix-pb-price-important' : '',

				btncolor_one   = uixpbform_colorTran( uix_pb_pricing_col4_one_btn_color ),
				btncolor_two   = uixpbform_colorTran( uix_pb_pricing_col4_two_btn_color ),
				btncolor_three = uixpbform_colorTran( uix_pb_pricing_col4_three_btn_color ),
				btncolor_four  = uixpbform_colorTran( uix_pb_pricing_col4_four_btn_color );

			var _config_t      = ( uix_pb_pricing_col4_config_title != undefined && uix_pb_pricing_col4_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_pricing_col4_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
				_config_desc   = ( uix_pb_pricing_col4_config_intro != undefined && uix_pb_pricing_col4_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_pricing_col4_config_intro+'</div>' : '';

			

			var temp = '';
				temp += _config_t;
				temp += _config_desc;
				temp += '<div class="uix-pb-price">';
				temp += '<div class="uix-pb-row">';
			    
			    //--- one
				temp += '<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="'+uixpbform_htmlEncode( uix_pb_pricing_col4_one_emphasis_color )+'">';
				temp += '<div class="uix-pb-price-bg-hover uix-pb-price-init-height">';
				temp += '<div class="uix-pb-price-border '+uixpbform_htmlEncode( imclass_one )+'">';
				temp += '<h5 class="uix-pb-price-level">'+uix_pb_pricing_col4_one_title+'</h5>';
				temp += '<h2 class="uix-pb-price-num" style="color:'+uixpbform_htmlEncode( uix_pb_pricing_col4_one_emphasis_color )+'">'+uix_pb_pricing_col4_one_currency+''+uixpbform_floatval( uix_pb_pricing_col4_one_price )+' <span class="uix-pb-price-period">'+uix_pb_pricing_col4_one_period+'</span></h2>';
				temp += '<div class="uix-pb-price-excerpt">';
				temp += '<p>'+uix_pb_pricing_col4_one_desc+'</p>';
				temp += '</div> <a href="'+encodeURI( uix_pb_pricing_col4_one_btn_link )+'" '+win_one+' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-'+btncolor_one+'">'+uix_pb_pricing_col4_one_btn_label+'</a>';
				temp += '<hr>';
				temp += '<div class="uix-pb-price-detail">';
				temp += '<ul>';
				temp += uixpbform_html_listTran( uix_pb_pricing_col4_one_features, 'li' );
				temp += '</ul>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';

			    //--- two
				temp += '<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="'+uixpbform_htmlEncode( uix_pb_pricing_col4_two_emphasis_color )+'">';
				temp += '<div class="uix-pb-price-bg-hover uix-pb-price-init-height">';
				temp += '<div class="uix-pb-price-border '+uixpbform_htmlEncode( imclass_two )+'">';
				temp += '<h5 class="uix-pb-price-level">'+uix_pb_pricing_col4_two_title+'</h5>';
				temp += '<h2 class="uix-pb-price-num" style="color:'+uixpbform_htmlEncode( uix_pb_pricing_col4_two_emphasis_color )+'">'+uix_pb_pricing_col4_two_currency+''+uixpbform_floatval( uix_pb_pricing_col4_two_price )+' <span class="uix-pb-price-period">'+uix_pb_pricing_col4_two_period+'</span></h2>';
				temp += '<div class="uix-pb-price-excerpt">';
				temp += '<p>'+uix_pb_pricing_col4_two_desc+'</p>';
				temp += '</div> <a href="'+encodeURI( uix_pb_pricing_col4_two_btn_link )+'" '+win_two+' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-'+btncolor_two+'">'+uix_pb_pricing_col4_two_btn_label+'</a>';
				temp += '<hr>';
				temp += '<div class="uix-pb-price-detail">';
				temp += '<ul>';
				temp += uixpbform_html_listTran( uix_pb_pricing_col4_two_features, 'li' );
				temp += '</ul>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
			
			
			    //--- three
				temp += '<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="'+uixpbform_htmlEncode( uix_pb_pricing_col4_three_emphasis_color )+'">';
				temp += '<div class="uix-pb-price-bg-hover uix-pb-price-init-height">';
				temp += '<div class="uix-pb-price-border '+uixpbform_htmlEncode( imclass_three )+'">';
				temp += '<h5 class="uix-pb-price-level">'+uix_pb_pricing_col4_three_title+'</h5>';
				temp += '<h2 class="uix-pb-price-num" style="color:'+uixpbform_htmlEncode( uix_pb_pricing_col4_three_emphasis_color )+'">'+uix_pb_pricing_col4_three_currency+''+uixpbform_floatval( uix_pb_pricing_col4_three_price )+' <span class="uix-pb-price-period">'+uix_pb_pricing_col4_three_period+'</span></h2>';
				temp += '<div class="uix-pb-price-excerpt">';
				temp += '<p>'+uix_pb_pricing_col4_three_desc+'</p>';
				temp += '</div> <a href="'+encodeURI( uix_pb_pricing_col4_three_btn_link )+'" '+win_three+' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-'+btncolor_three+'">'+uix_pb_pricing_col4_three_btn_label+'</a>';
				temp += '<hr>';
				temp += '<div class="uix-pb-price-detail">';
				temp += '<ul>';
				temp += uixpbform_html_listTran( uix_pb_pricing_col4_three_features, 'li' );
				temp += '</ul>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
			
			    //--- four
				temp += '<div class="uix-pb-col-3 uix-pb-col-last uix-pb-price-border-hover" data-tcolor="'+uixpbform_htmlEncode( uix_pb_pricing_col4_four_emphasis_color )+'">';
				temp += '<div class="uix-pb-price-bg-hover uix-pb-price-init-height">';
				temp += '<div class="uix-pb-price-border '+uixpbform_htmlEncode( imclass_four )+'">';
				temp += '<h5 class="uix-pb-price-level">'+uix_pb_pricing_col4_four_title+'</h5>';
				temp += '<h2 class="uix-pb-price-num" style="color:'+uixpbform_htmlEncode( uix_pb_pricing_col4_four_emphasis_color )+'">'+uix_pb_pricing_col4_four_currency+''+uixpbform_floatval( uix_pb_pricing_col4_four_price )+' <span class="uix-pb-price-period">'+uix_pb_pricing_col4_four_period+'</span></h2>';
				temp += '<div class="uix-pb-price-excerpt">';
				temp += '<p>'+uix_pb_pricing_col4_four_desc+'</p>';
				temp += '</div> <a href="'+encodeURI( uix_pb_pricing_col4_four_btn_link )+'" '+win_four+' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-'+btncolor_four+'">'+uix_pb_pricing_col4_four_btn_label+'</a>';
				temp += '<hr>';
				temp += '<div class="uix-pb-price-detail">';
				temp += '<ul>';
				temp += uixpbform_html_listTran( uix_pb_pricing_col4_four_features, 'li' );
				temp += '</ul>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
			
                //---
				temp += '</div>';
				temp += '<!-- /.uix-pb-row -->';
				temp += '</div>';
				temp += '<!-- /.uix-pb-price -->';
			
			
			/* Save data */
			$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
			
		}
		
		uix_pb_temp();
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() { uix_pb_temp(); });
		

		
		
		 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
