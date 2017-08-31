<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( basename( __FILE__, '.php' ) );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;


/**
 * Clone parameters
 * ----------------------------------------------------
 */

//clone list
$clone_trigger_id        = 'uix_pb_accordion_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = '';



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
			'id'             => 'uix_pb_accordion_effect',
			'title'          => esc_html__( 'Transition Effect', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'slide',
									'3'  => 'none',
								)
		
		),
	
	
		array(
			'id'             => 'uix_pb_accordion_open_first',
			'title'          => esc_html__( 'Open The First One Automatically', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),		
		
		//------list begin

		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'title'          => esc_html__( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => esc_html__( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => array( 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'',
											'type'      => 'textarea'
										), 
	

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
			array(
				'id'             => 'uix_pb_accordion_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Accordion Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_accordion_listitem_con',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Accordion content here.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
			
			
		
		//------list end
		
		


		
	
	)
;



/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'                   => array(
										'max'                => $clone_max,
										'list_toggle_class'  => $clone_list_toggle_class,
										'fields_group'       => array(
																	array(
																		'trigger_id'     => $clone_trigger_id,
																		'required'       => 'uix_pb_accordion_listitem_title',
																		'fields'         => array( 'uix_pb_accordion_listitem_title', 'uix_pb_accordion_listitem_con' )
																	),
										)
									),
	    'defalt_value'            => $item,
	    'widget_name'             => $wname,
		'form_id'                 => $form_id,
		'section_id'              => $sid,
	    'column_id'               => $colid,
		'fields'                  => array(
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args
										),

									),
		'title'                   => esc_html__( 'Accordion', 'uix-page-builder' ),
	    'js_template'             => '
		
			/* Radio (Requires quotes) */
			var transeffect = \'slide\';

			switch( uix_pb_accordion_effect ){ 
				case \'1\': 
					transeffect = \'slide\';

				break; 

				case \'2\': 
					transeffect = \'fade\';

				break; 

				case \'3\': 
					transeffect = \'none\';

				break;			

				default: 

			}


			/* List Item */
			var list_num       = '.floatval( $clone_max ).',
				show_list_item = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var openfirst_class = ( uix_pb_accordion_open_first === true && i == 1 ) ? \' uix-pb-spoiler-closed\' : \'\';

				var _uid     = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_title   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'\' ).val(),
					_con     = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'\' ).val();

				var _item_v_title = ( _title != undefined && _title != \'\' ) ? _title : \'\',
					_item_v_con   = ( _con != undefined && _con != \'\' ) ? _con : \'\';


				if ( _title != undefined && _title != \'\' ) {

					//Do not include spaces
					show_list_item += \'<div class="uix-pb-spoiler\'+openfirst_class+\'">\';
					show_list_item += \'<div class="uix-pb-spoiler-title">\'+_item_v_title+\'</div>\';
					show_list_item += \'<div class="uix-pb-spoiler-content">\';
					show_list_item += \'<p>\'+_item_v_con+\'</p>\';
					show_list_item += \'</div>\';                 
					show_list_item += \'</div>\';

				}


			}


			var temp = \'\';
				temp += \'<div class="uix-pb-accordion-box">\';
				temp += \'<div class="uix-pb-accordion" data-effect="\'+uixpbform_htmlEncode(transeffect)+\'">\';
				temp += show_list_item;
				temp += \'</div>\';
				temp += \'</div>\';
		'
    )
);



