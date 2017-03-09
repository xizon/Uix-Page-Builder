<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_features2';

//clone list
$clone_trigger_id        = 'uix_pb_features_col3_list';    // ID of clone trigger
$clone_max               = 30;                                    // Maximum of clone form 

//clone list of toggle class value @var array
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
	$item              = array();
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

$form_type_config = array(
    'list' => 1
);

$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						


$module_config = 
	array(
	
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
		
	
	)
;



$form_type = array(
    'list' => 1
);



$args = 
	array(
	
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => array(
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'',
											'type'      => 'text'
										), 
										
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
																	

									 ),
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => 'uix_pb_features_col3_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col3_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
		
			array(
				'id'             => 'uix_pb_features_col3_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'', /*class of list item */
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
	

		
	
	)
;


//---
$form_html  = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Left Block', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::form_after();


//----
$form_js_vars  = '';
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );



$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'', $form_html );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Features (3 Column)', 'uix-page-builder' ) ); ?>            
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
		$field = 'uix_pb_features_col3_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         = array( 'uix_pb_features_col3_listitem_title', 'uix_pb_features_col3_listitem_desc', 'uix_pb_features_col3_listitem_icon' );
							  
			UixPageBuilder::push_cloneform( $uid, $item, $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
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
				show_list_item = '';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid            = ( i >= 2 ) ? '#'+i+'-' : '#',
					_title          = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ); ?>' ).val(),
					_desc           = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ); ?>' ).val(),
					_icon           = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ); ?>' ).val();


				var _item_v_icon         = ( _icon != undefined && _icon != '' ) ? '<i class="fa fa-'+_icon+'"></i>' : '<i class="fa fa-check"></i>',
					_item_v_col_lastclass  = ( i >=3 && i % 3 == 0 ) ? 'uix-pb-col-last' : '';





				if ( _title != undefined && _title != '' ) {

					//Do not include spaces
					show_list_item += '<div class="uix-pb-col-4 '+_item_v_col_lastclass+'">';
					show_list_item += '<div class="uix-pb-feature-li uix-pb-feature-li-c3">';
					show_list_item += '<p class="uix-pb-feature-icon">'+_item_v_icon+'</p>';
					show_list_item += '<h3 class="uix-pb-feature-title">'+_title+'</h3>';
					show_list_item += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'+_desc+'</p></div>';             
					show_list_item += '</div>';
					show_list_item += '</div>';

				}


			}



			var temp = '';
				temp += _config_t;
				temp += _config_desc;
				temp += '<div class="uix-pb-feature">';
				temp += '<div class="uix-pb-row">';
				temp += show_list_item;
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


