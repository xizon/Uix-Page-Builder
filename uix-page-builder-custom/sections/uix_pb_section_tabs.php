<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_tabs';

//clone list
$clone_trigger_id        = 'uix_pb_tabs_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

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
$form_type = array(
    'list' => false
);

$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						


$args = 
	array(
	
		
		array(
			'id'             => 'uix_pb_tabs_style',
			'title'          => __( 'Choose Style', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'horizontal',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'vertical'  => 'vertical',
									'horizontal'  => 'horizontal',
								)
		
		),	
		
		
		array(
			'id'             => 'uix_pb_tabs_effect',
			'title'          => __( 'Transition Effect', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'slide',
									'3'  => 'none',
								)
		
		),
		
		
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ).'',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ).'',
											'type'      => 'textarea'
										), 
	

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
			array(
				'id'             => 'uix_pb_tabs_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Tab Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_tabs_listitem_con',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'This is content of the tab.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
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

$form_html    = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html' );
$form_js_vars = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );


$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ).'', $form_html );

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
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Tabs', 'uix-page-builder' ) ); ?>            
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
		$field = 'uix_pb_tabs_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         = array( 'uix_pb_tabs_listitem_title', 'uix_pb_tabs_listitem_con' );
							  
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

			/* Radio (Requires quotes) */
			var transeffect = 'slide';

			switch( uix_pb_tabs_effect ){ 
				case '1': 
					transeffect = 'slide';

				break; 

				case '2': 
					transeffect = 'fade';

				break; 

				case '3': 
					transeffect = 'none';

				break;			

				default: 

			}


			/* List Item */
			var list_num               = <?php echo $clone_max; ?>,
				show_list_item_title   = '',
				show_list_item_content = '';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid     = ( i >= 2 ) ? '#'+i+'-' : '#',
					_title   = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ); ?>' ).val(),
					_con     = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ); ?>' ).val();


				if ( _title != undefined && _title != '' ) {

					//Do not include spaces
					show_list_item_title += '<li>'+_title+'</li>';

					show_list_item_content += '<div class="uix-pb-spoiler-content">';
					show_list_item_content += '<p>'+_con+'</p>';
					show_list_item_content += '</div>';

				}


			}

			
			var temp = '';
				temp += '<div class="uix-pb-accordion-box">';
				temp += '<div class="uix-pb-accordion uix-pb-tabs uix-pb-tabs-'+uixpbform_htmlEncode(uix_pb_tabs_style)+'" data-effect="'+uixpbform_htmlEncode(transeffect)+'">';
				temp += '<ul class="uix-pb-tabs-title">';
				temp += show_list_item_title;
				temp += '</ul>';
				temp += '<div class="uix-pb-spoiler-group">';
				temp += show_list_item_content;
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
     
 