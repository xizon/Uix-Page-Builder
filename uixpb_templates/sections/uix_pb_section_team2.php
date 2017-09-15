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
$clone_trigger_id        = 'uix_pb_team2_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = array( 'uix_pb_team2_listitem_toggle_url1', 'uix_pb_team2_listitem_toggle_icon1', 'uix_pb_team2_listitem_toggle_url2', 'uix_pb_team2_listitem_toggle_icon2', 'uix_pb_team2_listitem_toggle_url3', 'uix_pb_team2_listitem_toggle_icon3' );       



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
			'id'             => 'uix_pb_team2_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_team2_config_intro' ,
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_team2_config_avatar_gray',
			'title'          => esc_html__( 'Gray Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, //0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	

		array(
			'id'             => 'uix_pb_team2_config_avatar_fillet',
			'title'          => esc_html__( 'Radius of Fillet Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => 'uix_pb_team2_config_list_height',
			'title'          => esc_html__( 'Height of Grid', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		
		),		
		
	    array(
			'id'             => 'uix_pb_team2_config_list_height_tipinfo',
			'desc'           => wp_kses( __( 'Set height of grid so that it will fit its avatar photo. Browsers use a default stylesheet to render if the value is <strong>"0"</strong>.', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'note'  //error, success, warning, note, default
				                ),
		
		),	
		
		
		array(
			'id'             => 'uix_pb_team2_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 4,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'',
											'type'      => 'image'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => array(
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
											 )
										), 			
		

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_team2_listitem_avatar',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Avatar URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
									)
			
			),	
			array(
				'id'             => 'uix_pb_team2_listitem_name',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Name', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => 'uix_pb_team2_listitem_position',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Position', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => 'uix_pb_team2_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The Introduction of this member.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => 'uix_pb_team2_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => array(
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
	                                     )
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', /*class of toggle item */
					'placeholder'    => esc_html__( 'Your Social Network Page URL 1', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',/*class of toggle item */
					'placeholder'    => esc_html__( 'Choose Social Icon 1', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', /*class of toggle item */
					'placeholder'    => esc_html__( 'Your Social Network Page URL 2', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',/*class of toggle item */
					'placeholder'    => esc_html__( 'Choose Social Icon 2', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', /*class of toggle item */
					'placeholder'    => esc_html__( 'Your Social Network Page URL 3', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',/*class of toggle item */
					'placeholder'    => esc_html__( 'Choose Social Icon 3', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
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
																		'required'       => 'uix_pb_team2_listitem_name',
																		'fields'         => array( 'uix_pb_team2_listitem_avatar', 'uix_pb_team2_listitem_name', 'uix_pb_team2_listitem_position', 'uix_pb_team2_listitem_intro', 'uix_pb_team2_listitem_toggle', 'uix_pb_team2_listitem_toggle_url1', 'uix_pb_team2_listitem_toggle_icon1', 'uix_pb_team2_listitem_toggle_url2', 'uix_pb_team2_listitem_toggle_icon2', 'uix_pb_team2_listitem_toggle_url3', 'uix_pb_team2_listitem_toggle_icon3' )
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
		'title'                   => esc_html__( 'Team Grid', 'uix-page-builder' ),
	
	
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
		
			var _config_t             = ( uix_pb_team2_config_title != undefined && uix_pb_team2_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_team2_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc          = ( uix_pb_team2_config_intro != undefined && uix_pb_team2_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uixpbform_format_textarea_entering( uix_pb_team2_config_intro )+\'</div>\' : \'\',
				_config_gray          = ( uix_pb_team2_config_avatar_gray === true ) ? \' uix-pb-gray\' : \'\',
				_config_height        = ( uix_pb_team2_config_list_height > 0 ) ? \'style="height:\'+uixpbform_floatval( uix_pb_team2_config_list_height )+\'px;"\' : \'\',
				_config_avatar_fillet = uixpbform_floatval( uix_pb_team2_config_avatar_fillet ) + \'%\';


				
			/* List Item */
			var list_num               = '.floatval( $clone_max ).',
				show_list_item         = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid         = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_avatar      = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'\' ).val(),
					_name        = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'\' ).val(),
					_pos         = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'\' ).val(),
					_intro       = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'\' ).val(),
					_toggleurl1  = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'\' ).val(),
					_toggleicon1 = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'\' ).val(),
					_toggleurl2  = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'\' ).val(),
					_toggleicon2 = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'\' ).val(),		
					_toggleurl3  = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'\' ).val(),
					_toggleicon3 = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'\' ).val();


				var _item_v_avatarURL       = ( _avatar != undefined && _avatar != \'\' ) ? _avatar : \''.esc_url(  UixPBFormCore::photo_placeholder() ).'\',
					_item_v_social_icon_1   = ( _toggleicon1 != undefined && _toggleicon1 != \'\' ) ? _toggleicon1 : \'link\',
					_item_v_social_icon_2   = ( _toggleicon2 != undefined && _toggleicon2 != \'\' ) ? _toggleicon2 : \'link\',
					_item_v_social_icon_3   = ( _toggleicon3 != undefined && _toggleicon3 != \'\' ) ? _toggleicon3 : \'link\', 
					_item_v_social_out_1    = ( _toggleurl1 != undefined && _toggleurl1 != \'\' ) ? \'<a href="\'+encodeURI( _toggleurl1 )+\'" target="_blank"><i class="fa fa-\'+uixpbform_htmlEncode( _item_v_social_icon_1 )+\'"></i></a>\' : \'\',
					_item_v_social_out_2    = ( _toggleurl2 != undefined && _toggleurl2 != \'\' ) ? \'<a href="\'+encodeURI( _toggleurl2 )+\'" target="_blank"><i class="fa fa-\'+uixpbform_htmlEncode( _item_v_social_icon_2 )+\'"></i></a>\' : \'\',
					_item_v_social_out_3    = ( _toggleurl3 != undefined && _toggleurl3 != \'\' ) ? \'<a href="\'+encodeURI( _toggleurl3 )+\'" target="_blank"><i class="fa fa-\'+uixpbform_htmlEncode( _item_v_social_icon_3 )+\'"></i></a>\' : \'\',
					_item_v_pos             = ( _pos != undefined && _pos != \'\' ) ? \'<span class="uix-pb-gallery-list-position">\'+_pos+\'</span>\' : \'\';





				if ( _name != undefined && _name != \'\' ) {

					//Do not include spaces

					show_list_item += \'<div class="uix-pb-gallery-list uix-pb-gallery-list-col\'+uix_pb_team2_config_grid+\' \'+_config_gray+\'">\';
					show_list_item += \'<div class="uix-pb-gallery-list-imgbox" \'+_config_height+\'>\';
					show_list_item += \'<img src="\'+encodeURI( _item_v_avatarURL )+\'" alt="\'+uixpbform_htmlEncode( _name )+\'" style="-webkit-border-radius: \'+_config_avatar_fillet+\'; -moz-border-radius: \'+_config_avatar_fillet+\'; border-radius: \'+_config_avatar_fillet+\';">\';
					show_list_item += _item_v_pos;
					show_list_item += \'</div>\';
					show_list_item += \'<div class="uix-pb-gallery-list-info">\';
					show_list_item += \'<h3 class="uix-pb-gallery-list-title">\'+_name+\'</h3>\';
					show_list_item += \'<div class="uix-pb-gallery-list-desc">\';
					show_list_item += \'<p>\'+uixpbform_format_textarea_entering( _intro )+\'</p>\';
					show_list_item += \'</div>\';
					show_list_item += \'<div class="uix-pb-gallery-list-social">\';
					show_list_item += _item_v_social_out_1;
					show_list_item += _item_v_social_out_2;
					show_list_item += _item_v_social_out_3;									
					show_list_item += \'</div>\';
					show_list_item += \'</div>\';
					show_list_item += \'</div>\';

				}


			}



			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-gallery">\';
				temp += show_list_item;
				temp += \'</div>\';		
		
		'
    )
);
