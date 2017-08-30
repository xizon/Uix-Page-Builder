<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( 'uix_pb_section_features1' );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;



/**
 * Clone parameters
 * ----------------------------------------------------
 */

//clone list
$clone_trigger_id_1        = 'uix_pb_features_col2_one_list';    // ID of clone trigger 
$clone_trigger_id_2        = 'uix_pb_features_col2_two_list';    // ID of clone trigger 
$clone_max                 = 15;                                 // Maximum of clone form 

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
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	)
;



$form_type = array(
    'list' => 2
);



$args_1 = 
	array(
	
	
		array(
			'desc'           => esc_html__( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_1,
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
																	

									 ),
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
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
		
		


		
	
	)
;

$args_2 = 
	array(
	
		array(
			'desc'           => esc_html__( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_2,
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
																	

									 ),
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
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
																	'trigger_id'     => $clone_trigger_id_1,
																	'required'       => 'uix_pb_features_col2_one_listitem_title',
																	'fields'         => array( 'uix_pb_features_col2_one_listitem_title', 'uix_pb_features_col2_one_listitem_desc', 'uix_pb_features_col2_one_listitem_icon' )
																),
																array(
																	'trigger_id'     => $clone_trigger_id_2,
																	'required'       => 'uix_pb_features_col2_two_listitem_title',
																	'fields'         => array( 'uix_pb_features_col2_two_listitem_title', 'uix_pb_features_col2_two_listitem_desc', 'uix_pb_features_col2_two_listitem_icon' )
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
											 'values'  => $args_1,
											 'title'   => esc_html__( 'Left Block', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args_2,
											 'title'   => esc_html__( 'Right Block', 'uix-page-builder' )
										),

									),
		'title'                   => esc_html__( 'Features (2 Column)', 'uix-page-builder' ),
	    'js_template'             => '
		
			var _config_t      = ( uix_pb_features_col2_config_title != undefined && uix_pb_features_col2_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_features_col2_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc   = ( uix_pb_features_col2_config_intro != undefined && uix_pb_features_col2_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uix_pb_features_col2_config_intro+\'</div>\' : \'\';


			/* List Item */
			var list_num         = '.floatval( $clone_max ).',
				show_list_item_1 = \'\',
				show_list_item_2 = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid              = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_title_1          = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'\' ).val(),
					_desc_1           = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'\' ).val(),
					_icon_1           = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'\' ).val(),

					_title_2           = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'\' ).val(),
					_desc_2            = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'\' ).val(),
					_icon_2            = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'\' ).val();


				var _item_v_icon_1         = ( _icon_1 != undefined && _icon_1 != \'\' ) ? \'<i class="fa fa-\'+_icon_1+\'"></i>\' : \'<i class="fa fa-check"></i>\',

					_item_v_icon_2         = ( _icon_2 != undefined && _icon_2 != \'\' ) ? \'<i class="fa fa-\'+_icon_2+\'"></i>\' : \'<i class="fa fa-check"></i>\';



				if ( _title_1 != undefined && _title_1 != \'\' ) {

					//Do not include spaces
					show_list_item_1 += \'<div class="uix-pb-feature-li">\';
					show_list_item_1 += \'<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">\'+_item_v_icon_1+\'</span>\'+_title_1+\'</h3>\';
					show_list_item_1 += \'<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>\'+_desc_1+\'</p></div>\';             
					show_list_item_1 += \'</div>\';

				}


				if ( _title_2 != undefined && _title_2 != \'\' ) {

					//Do not include spaces
					show_list_item_2 += \'<div class="uix-pb-feature-li">\';
					show_list_item_2 += \'<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">\'+_item_v_icon_2+\'</span>\'+_title_2+\'</h3>\';
					show_list_item_2 += \'<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>\'+_desc_2+\'</p></div>\';             
					show_list_item_2 += \'</div>\';

				}


			}



			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-feature">\';
				temp += \'<div class="uix-pb-row">\';
				temp += \'<div class="uix-pb-col-6">\';
				temp += show_list_item_1;
				temp += \'</div>\';
				temp += \'<div class="uix-pb-col-6 uix-pb-col-last">\';
				temp += show_list_item_2;
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
			
		
		
		'
    )
);
