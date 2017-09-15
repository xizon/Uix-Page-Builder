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
$clone_trigger_id        = 'uix_pb_portfolio1_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = array( 'uix_pb_portfolio1_listitem_toggle_url' );       



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
			'id'             => 'uix_pb_portfolio1_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_intro',
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
			'id'             => 'uix_pb_portfolio1_config_filterable',
			'title'          => esc_html__( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_urlwindow',
			'title'          => esc_html__( 'Open link in new tab', 'uix-page-builder' ),
			'desc'           => esc_html__( 'This option is valid when you use destination URL.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		

		array(
			'id'             => 'uix_pb_portfolio1_config_thumbnail_fillet',
			'title'          => esc_html__( 'Radius of Fillet Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'',
											'type'      => 'image'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'',
											'type'      => 'image'
										), 					
		
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => array(
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
											 )
										), 			
		

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_thumbnail',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Thumbnail', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
									)
			
			),	
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_fullimage',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Full Preview (Optional)', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
									)
			
			),			
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Project Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => 'uix_pb_portfolio1_listitem_cat',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Category', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => 'uix_pb_portfolio1_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The description of this project.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => 'uix_pb_portfolio1_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => array(
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
	                                     )
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_portfolio1_listitem_toggle_url',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => esc_html__( 'Destination URL', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
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
																		'required'       => 'uix_pb_portfolio1_listitem_title',
																		'fields'         => array( 'uix_pb_portfolio1_listitem_thumbnail', 'uix_pb_portfolio1_listitem_fullimage', 'uix_pb_portfolio1_listitem_title', 'uix_pb_portfolio1_listitem_cat', 'uix_pb_portfolio1_listitem_intro', 'uix_pb_portfolio1_listitem_toggle', 'uix_pb_portfolio1_listitem_toggle_url' )
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
		'title'                   => esc_html__( 'Portfolio Grid', 'uix-page-builder' ),
	
	
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
			var _config_id            = uixpbform_uid(),
				_config_t             = ( uix_pb_portfolio1_config_title != undefined && uix_pb_portfolio1_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_portfolio1_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc          = ( uix_pb_portfolio1_config_intro != undefined && uix_pb_portfolio1_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uixpbform_format_textarea_entering( uix_pb_portfolio1_config_intro )+\'</div>\' : \'<div class="uix-pb-section-desc"></div>\',
				_config_avatar_fillet = uixpbform_floatval( uix_pb_portfolio1_config_thumbnail_fillet ) + \'%\';
			

			/* List Item */
			var list_num               = '.floatval( $clone_max ).',
				show_list_item = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid         = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_thumbnail   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'\' ).val(),
					_fullimage   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'\' ).val(),
					_title       = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'\' ).val(),
					_cat         = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'\' ).val(),
					_intro       = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'\' ).val(),
					_url         = encodeURI( $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'\' ).val() );


					var _item_v_thumbnailURL  = ( _thumbnail != undefined && _thumbnail != \'\' ) ? _thumbnail : \''.esc_url(  UixPBFormCore::photo_placeholder() ).'\',
					_item_v_fullimageURL      = ( _fullimage != undefined && _fullimage != \'\' ) ? _fullimage : _item_v_thumbnailURL,
					_item_v_catshow           = ( _cat != undefined && _cat != \'\' ) ? \'<div class="uix-pb-portfolio-type">\'+_cat+\'</div>\' : \'\',
					_item_v_targetcode        = \'\';

					if ( _url != undefined && _url != \'\' ) {
						_item_v_targetcode   = ( uix_pb_portfolio1_config_urlwindow === true ) ? \' target="_blank"\' : \'\';
						_item_v_fullimageURL = _url;
					} else {
						_item_v_targetcode = ( uix_pb_portfolio1_config_urlwindow === true ) ? \' target="_blank" rel="alternate"\' : \'rel="alternate"\';
					}




				if ( _intro != undefined && _intro != \'\' ) {



					//Do not include spaces

					show_list_item += \'<div class="uix-pb-portfolio-item" data-groups-name="\'+uixpbform_strToSlug( _cat )+\'">\';
					show_list_item += \'<span class="uix-pb-portfolio-image" style="-webkit-border-radius: \'+_config_avatar_fillet+\'; -moz-border-radius: \'+_config_avatar_fillet+\'; border-radius: \'+_config_avatar_fillet+\';">\';
					show_list_item += \'<a \'+_item_v_targetcode+\' href="\'+encodeURI( _item_v_fullimageURL )+\'" title="\'+uixpbform_htmlEncode( _title )+\'">\';
					show_list_item += \'<img src="\'+_item_v_thumbnailURL+\'" alt="" style="-webkit-border-radius: \'+_config_avatar_fillet+\'; -moz-border-radius: \'+_config_avatar_fillet+\'; border-radius: \'+_config_avatar_fillet+\';">\';
					show_list_item += \'</a>\';
					show_list_item += \'</span>\';
					show_list_item += \'<h3><a \'+_item_v_targetcode+\' href="\'+encodeURI( _item_v_fullimageURL )+\'" title="\'+uixpbform_htmlEncode( _title )+\'">\'+_title+\'</a></h3>\';
					show_list_item += _item_v_catshow;
					show_list_item += \'<div class="uix-pb-portfolio-content">\';
					show_list_item += uixpbform_format_textarea_entering( _intro );
					show_list_item += \'<a class="uix-pb-portfolio-link" \'+_item_v_targetcode+\' href="\'+encodeURI( _item_v_fullimageURL )+\'" title="\'+uixpbform_htmlEncode( _title )+\'"></a>\';
					show_list_item += \'</div>\';
					show_list_item += \'</div>\';

				}


			}


			//Display categories on page
			var catlist = \'\';
			if (  uix_pb_portfolio1_config_filterable === true ) {
				catlist += \'<div class="uix-pb-portfolio-cat-list uix-pb-filterable" data-classprefix="uix-pb-portfolio-"  data-filter-id="\'+_config_id+\'" id="uix-pb-portfolio-cat-list-\'+_config_id+\'">\';
				catlist += \'<ul>\';
				catlist += \'<li class="current"><a href="javascript:" data-group="all">'.esc_html__( 'All', 'uix-page-builder' ).'</a></li>\';
				catlist += uixpbform_catlist( show_list_item, \'uix-pb-portfolio-\' );
				catlist += \'</ul>\';
				catlist += \'</div>\';

			}


			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += catlist;
				temp += \'<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col\'+uix_pb_portfolio1_config_grid+\'" id="uix-pb-portfolio-filter-stage-\'+_config_id+\'">\';
				temp += show_list_item;
				temp += \'</div>\';
		
		'
    )
);

