<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_features1';

//clone list
$clone_trigger_id_1        = 'uix_pb_features_col2_one_list';    // ID of clone trigger 
$clone_trigger_id_2        = 'uix_pb_features_col2_two_list';    // ID of clone trigger 
$clone_max                 = 15;                                 // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '';


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
			'id'             => 'uix_pb_features_col2_config_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_features_col2_config_intro',
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
    'list' => 2
];



$args_1 = 
	[
	
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_1,
			'colid'          => $colid, /*clone required */
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'',
											'type'      => 'text'
										), 
										
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
																	

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
		
		//------list end
		
		


		
	
	]
;

$args_2 = 
	[
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_2,
			'colid'          => $colid, /*clone required */
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'',
											'type'      => 'text'
										), 
										
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
																	

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
		
		//------list end
		
		
		
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
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_1, 'html', __( 'Left Block', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_2, 'html', __( 'Right Block', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::form_after();


//----
$form_js_vars  = '';
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js_vars' );




$clone_value_1 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', $form_html );

$clone_value_2 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', $form_html );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_1, $clone_value_1 );
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_2, $clone_value_2 );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Features (2 Column)', 'uix-page-builder' ) ); ?>            
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
	
	
    /*-- Dynamic Adding Input ( Default Value ) --*/
	for ( $i = 2; $i <= $clone_max; $i++ ) {
		$uid = $i.'-';
		$field = 'uix_pb_features_col2_one_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => 'uix_pb_features_col2_one_listitem_title',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_title]['.$sid.']' ]
								),
								array(
									'id'       => 'uix_pb_features_col2_one_listitem_desc',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => 'uix_pb_features_col2_one_listitem_icon',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ]
								),
														
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $uid, $clone_trigger_id_1, $cur_id, $colid, $clone_value_1, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	
	for ( $ii = 2; $ii <= $clone_max; $ii++ ) {
		$uid = $ii.'-';
		$field = 'uix_pb_features_col2_two_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $ii;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => 'uix_pb_features_col2_two_listitem_title',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_title]['.$sid.']' ]
								),
								
								array(
									'id'       => 'uix_pb_features_col2_two_listitem_desc',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => 'uix_pb_features_col2_two_listitem_icon',
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ]
								),							
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $uid, $clone_trigger_id_2, $cur_id, $colid, $clone_value_2, $sid, $value, $clone_list_toggle_class );
	
		} 
	}	
	
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>

			var _config_t      = ( uix_pb_features_col2_config_title != undefined && uix_pb_features_col2_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_features_col2_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
				_config_desc   = ( uix_pb_features_col2_config_intro != undefined && uix_pb_features_col2_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_features_col2_config_intro+'</div>' : '';


			/* List Item */
			var list_num         = <?php echo $clone_max; ?>,
				show_list_item_1 = '',
				show_list_item_2 = '';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid              = ( i >= 2 ) ? '#'+i+'-' : '#',
					_title_1          = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ); ?>' ).val(),
					_desc_1           = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ); ?>' ).val(),
					_icon_1           = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ); ?>' ).val(),

					_title_2           = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ); ?>' ).val(),
					_desc_2            = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ); ?>' ).val(),
					_icon_2            = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ); ?>' ).val();


				var _item_v_icon_1         = ( _icon_1 != undefined && _icon_1 != '' ) ? '<i class="fa fa-'+_icon_1+'"></i>' : '<i class="fa fa-check"></i>',

					_item_v_icon_2         = ( _icon_2 != undefined && _icon_2 != '' ) ? '<i class="fa fa-'+_icon_2+'"></i>' : '<i class="fa fa-check"></i>';



				if ( _title_1 != undefined && _title_1 != '' ) {

					//Do not include spaces
					show_list_item_1 += '<div class="uix-pb-feature-li">';
					show_list_item_1 += '<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'+_item_v_icon_1+'</span>'+_title_1+'</h3>';
					show_list_item_1 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'+_desc_1+'</p></div>';             
					show_list_item_1 += '</div>';

				}


				if ( _title_2 != undefined && _title_2 != '' ) {

					//Do not include spaces
					show_list_item_2 += '<div class="uix-pb-feature-li">';
					show_list_item_2 += '<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'+_item_v_icon_2+'</span>'+_title_2+'</h3>';
					show_list_item_2 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'+_desc_2+'</p></div>';             
					show_list_item_2 += '</div>';

				}


			}



			var temp = '';
				temp += _config_t;
				temp += _config_desc;
				temp += '<div class="uix-pb-feature">';
				temp += '<div class="uix-pb-row">';
				temp += '<div class="uix-pb-col-6">';
				temp += show_list_item_1;
				temp += '</div>';
				temp += '<div class="uix-pb-col-6 uix-pb-col-last">';
				temp += show_list_item_2;
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
			
			
			
			/* Save data */
			$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
			
		}
		
		uix_pb_temp();
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() { uix_pb_temp(); });
		
		
		
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}


