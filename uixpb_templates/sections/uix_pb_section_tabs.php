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
$clone_trigger_id        = 'uix_pb_tabs_list';    // ID of clone trigger 
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
			'id'             => 'uix_pb_tabs_style',
			'title'          => esc_html__( 'Choose Style', 'uix-page-builder' ),
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
				'value'          => esc_html__( 'Tab Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_tabs_listitem_con',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'This is content of the tab.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5
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
																		'required'       => 'uix_pb_tabs_listitem_title',
																		'fields'         => array( 'uix_pb_tabs_listitem_title', 'uix_pb_tabs_listitem_con' )
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
		'title'                   => esc_html__( 'Tabs', 'uix-page-builder' ),
	
	
		/**
		 * /////////////// Customizing HTML output on the frontend /////////////// 
		 * 
		 * 
		 * Usage:
		 *
		 * 1) Written as pure JavaScript syntax.
		 * 2) Please push the value of final output to the JavaScript variable "temp", For example: var temp = '...';
		 * 3) Be sure to note the escape of quotation marks and slashes.
		 * 4) Directly use the controls ID as a JavaScript variable as the value for each control.
		 * 5) Value of controls with dynamic form need to use, For example:
		 *    $( '{index}<?php echo UixPBFormCore::fid( $colid, $sid, '{controlID}' ); ?>' ).val();
		 *  
		 *  ---------------------------------
		 *     {index}      @var Number      ->  Index value and starting with 2, For example: 2-, 3-, 4-, 5-, ...
		 *     {controlID}  @var String      ->  The ID of a control.
		 */
	    'js_template'             => '
		
			/* Radio (Requires quotes) */
			var transeffect = \'slide\';

			switch( uix_pb_tabs_effect ){ 
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
			var list_num               = '.floatval( $clone_max ).',
				show_list_item_title   = \'\',
				show_list_item_content = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid     = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_title   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_title' ).'\' ).val(),
					_con     = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_tabs_listitem_con' ).'\' ).val();


				if ( _title != undefined && _title != \'\' ) {

					//Do not include spaces
					show_list_item_title += \'<li>\'+_title+\'</li>\';

					show_list_item_content += \'<div class="uix-pb-spoiler-content">\';
					show_list_item_content += \'<p>\'+uixpbform_format_textarea_entering( _con )+\'</p>\';
					show_list_item_content += \'</div>\';

				}


			}

			
			var temp = \'\';
				temp += \'<div class="uix-pb-accordion-box">\';
				temp += \'<div class="uix-pb-accordion uix-pb-tabs uix-pb-tabs-\'+uixpbform_htmlEncode(uix_pb_tabs_style)+\'" data-effect="\'+uixpbform_htmlEncode(transeffect)+\'">\';
				temp += \'<ul class="uix-pb-tabs-title">\';
				temp += show_list_item_title;
				temp += \'</ul>\';
				temp += \'<div class="uix-pb-spoiler-group">\';
				temp += show_list_item_content;
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
		
		'
    )
);
