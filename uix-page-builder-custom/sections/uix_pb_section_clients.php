<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( 'uix_pb_section_clients' );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;


/**
 * Clone parameters
 * ----------------------------------------------------
 */
//clone list
$clone_trigger_id        = 'uix_pb_clients_list';    // ID of clone trigger 
$clone_max               = 50;                         // Maximum of clone form 

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
			'id'             => 'uix_pb_clients_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_clients_config_intro',
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
		
	
		array(
			'id'             => 'uix_pb_clients_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            '6'  => '6',
		                            '5'  => '5',
									'4'  => '4',
									'3'  => '3',
									'2'  => '2',
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'',
											'type'      => 'image'
										),
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'',
											'type'      => 'text'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'',
											'type'      => 'textarea'
										), 		
										
	

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_clients_listitem_logo',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'LOGO URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
									)
			
			),	
				
			array(
				'id'             => 'uix_pb_clients_listitem_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Destination URL, e.g., http://your.clientsite.com', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''

			),
		
			array(
				'id'             => 'uix_pb_clients_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The Introduction of this client.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'', /*class of list item */
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
																	'required'       => 'uix_pb_clients_listitem_logo',
																	'fields'         => array( 'uix_pb_clients_listitem_logo', 'uix_pb_clients_listitem_url', 'uix_pb_clients_listitem_intro' )
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
		'title'                   => esc_html__( 'Clients', 'uix-page-builder' ),
	    'js_template'             => '
		
			var _config_t      = ( uix_pb_clients_config_title != undefined && uix_pb_clients_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_clients_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc   = ( uix_pb_clients_config_intro != undefined && uix_pb_clients_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uix_pb_clients_config_intro+\'</div>\' : \'\';




			/* List Item */
			var list_num               = '.floatval( $clone_max ).',
				show_list_item = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid      = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_logo     = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'\' ).val(),
					_url      = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'\' ).val(),
					_intro    = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'\' ).val();


				var _item_v_logoURL        = ( _logo != undefined && _logo != \'\' ) ? encodeURI( _logo ) : \''.esc_url(  UixPBFormCore::logo_placeholder() ).'\',
					_item_v_urltag_before  = ( _url != undefined && _url != \'\' ) ? \'<a href="\'+encodeURI( _url )+\'" target="_blank">\' : \'\',
					_item_v_urltag_after   = ( _url != undefined && _url != \'\' ) ? \'</a>\' : \'\';

				if ( _logo != undefined ) {

					//Do not include spaces
					show_list_item += \'<div class="uix-pb-client-li uix-pb-client-li-\'+uix_pb_clients_config_grid+\'">\';
					show_list_item += \'<p class="uix-pb-img">\'+_item_v_urltag_before+\'<img src="\'+_item_v_logoURL+\'" alt="" />\'+_item_v_urltag_after+\'</p>\';
					show_list_item += \'<p>\'+_intro+\'</p>\';   
					show_list_item += \'</div>\';

				}


			}



			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-client">\';
				temp += show_list_item;
				temp += \'</div>\';	
		
		
		'
    )
);
