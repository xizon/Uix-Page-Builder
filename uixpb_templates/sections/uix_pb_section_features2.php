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
$clone_trigger_id        = 'uix_pb_features_col3_list';    // ID of clone trigger
$clone_max               = 30;                             // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = '';



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
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_features_col2_config_intro',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
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
			'title'          => esc_html__( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => esc_html__( 'click here to add an item', 'uix-page-builder' ),
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
				'value'          => esc_html__( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col3_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5
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
		

	
	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'                   => array(
										'max'               => $clone_max,
										'list_toggle_class' => $clone_list_toggle_class,
										'fields_group'  => array(
																array(
																	'trigger_id'     => $clone_trigger_id,
																	'required'       => 'uix_pb_features_col3_listitem_title',
																	'fields'         => array( 'uix_pb_features_col3_listitem_title', 'uix_pb_features_col3_listitem_desc', 'uix_pb_features_col3_listitem_icon' )
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
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args,
											 'title'   => esc_html__( 'Content', 'uix-page-builder' )
										),

									),
		'title'                   => esc_html__( 'Features (3 Column)', 'uix-page-builder' ),
	
	
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
		 *    $( {index}+'<?php echo UixPBFormCore::fid( $colid, $sid, '{controlID}' ); ?>' ).val()
		 *  
		 *  ---------------------------------
		 *     {index}      @var Number      ->  Index value, For example: 2-, 3-, 4-, 5-, ...
		 *     {controlID}  @var String      ->  The ID of a control.
		 */
	    'js_template'             => '
		
			var _config_t      = ( uix_pb_features_col2_config_title != undefined && uix_pb_features_col2_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_features_col2_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc   = ( uix_pb_features_col2_config_intro != undefined && uix_pb_features_col2_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uixpbform_format_textarea_entering( uix_pb_features_col2_config_intro )+\'</div>\' : \'\';


			/* List Item */
			var list_num         = '.floatval( $clone_max ).',
				show_list_item = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid            = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_title          = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'\' ).val(),
					_desc           = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'\' ).val(),
					_icon           = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'\' ).val();


				var _item_v_icon         = ( _icon != undefined && _icon != \'\' ) ? \'<i class="fa fa-\'+_icon+\'"></i>\' : \'<i class="fa fa-check"></i>\',
					_item_v_col_lastclass  = ( i >=3 && i % 3 == 0 ) ? \'uix-pb-col-last\' : \'\';





				if ( _title != undefined && _title != \'\' ) {

					//Do not include spaces
					show_list_item += \'<div class="uix-pb-col-4 \'+_item_v_col_lastclass+\'">\';
					show_list_item += \'<div class="uix-pb-feature-li uix-pb-feature-li-c3">\';
					show_list_item += \'<p class="uix-pb-feature-icon">\'+_item_v_icon+\'</p>\';
					show_list_item += \'<h3 class="uix-pb-feature-title">\'+_title+\'</h3>\';
					show_list_item += \'<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>\'+uixpbform_format_textarea_entering( _desc )+\'</p></div>\';             
					show_list_item += \'</div>\';
					show_list_item += \'</div>\';

				}


			}



			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-feature">\';
				temp += \'<div class="uix-pb-row">\';
				temp += show_list_item;
				temp += \'</div>\';
				temp += \'</div>\';
		
		
		'
    )
);

