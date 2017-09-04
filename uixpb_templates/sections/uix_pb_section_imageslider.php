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
$clone_trigger_id        = 'uix_pb_imageslider_list';    // ID of clone trigger 
$clone_max               = 15;                         // Maximum of clone form 

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
			'id'             => 'uix_pb_imageslider_list_effect',
			'title'          => esc_html__( 'Effect', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'slide',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            'slide'  => esc_html__( 'Slide', 'uix-page-builder' ),
		                            'fade'  => esc_html__( 'Fade', 'uix-page-builder' ),
								)
		
		),
		
		array(
			'id'             => 'uix_pb_imageslider_list_loop',
			'title'          => esc_html__( 'Automatically Transition', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),
		
		array(
			'id'             => 'uix_pb_imageslider_list_paging',
			'title'          => esc_html__( 'Show Paging Navigation', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		
		array(
			'id'             => 'uix_pb_imageslider_list_arrows',
			'title'          => esc_html__( 'Show Arrow Navigation', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		
		array(
			'id'             => 'uix_pb_imageslider_list_speed',
			'title'          => esc_html__( 'Speed of Images Appereance', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1000,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'ms'
								)
		
		),	
		
		array(
			'id'             => 'uix_pb_imageslider_list_timing',
			'title'          => esc_html__( 'Delay Between Images', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 7000,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'ms'
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_photo' ).'',
											'type'      => 'image'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_url' ).'',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_title' ).'',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_intro' ).'',
											'type'      => 'textarea'
										),

									 ),
									'max'                       => $clone_max
				                )
									
		),
		

			array(
				'id'             => 'uix_pb_imageslider_listitem_photo',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_photo' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload Image', 'uix-page-builder' ),
									)
			
			),	
			

			array(
				'id'             => 'uix_pb_imageslider_listitem_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_url' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Destination URL and can be left blank, e.g., http://your.site.com', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''

			),
		
			array(
				'id'             => 'uix_pb_imageslider_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_title' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Slider title', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''

			),
			
		
		

			
			array(
				'id'             => 'uix_pb_imageslider_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_intro' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Slider introduction', 'uix-page-builder' ),
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
										'max'               => $clone_max,
										'list_toggle_class' => $clone_list_toggle_class,
										'fields_group'  => array(
																array(
																	'trigger_id'     => $clone_trigger_id,
	             										            'required'       => 'uix_pb_imageslider_listitem_photo',
																	'fields'         => array( 'uix_pb_imageslider_listitem_photo', 'uix_pb_imageslider_listitem_title', 'uix_pb_imageslider_listitem_intro', 'uix_pb_imageslider_listitem_url' )
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
		'title'                   => esc_html__( 'Image Slider', 'uix-page-builder' ),
	    'js_template'             => '
		
		
			/* List Item */
			var list_num               = '.floatval( $clone_max ).',
				show_list_item = \'\';
			
			
			for ( var i = 1; i <= list_num; i++ ){


				var _uid     = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_photo   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_photo' ).'\' ).val(),
					_url     = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_url' ).'\' ).val(),
					_title   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_title' ).'\' ).val(),
					_desc    = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_imageslider_listitem_intro' ).'\' ).val();



				var _item_v_photo = ( _photo != undefined ) ? encodeURI( _photo ) : \'\',
					_item_v_url   = ( _url != undefined && _url != \'\' ) ? encodeURI( _url ) : \'\',
					_item_v_title = ( _title != undefined && _title != \'\' ) ? _title : \'\',
					_item_v_desc  = ( _desc != undefined && _desc != \'\' ) ? uixpbform_format_textarea_entering( _desc ) : \'\',
					_item_v_intro = \'\';


				if ( _photo != undefined && _photo != \'\' ) {
				
				
					//Do not include spaces
					
					var __t = \'\',
					    __d = \'\';
						
					if ( _item_v_title != \'\' || _item_v_desc != \'\' ) {
					

							
						if ( _item_v_title != \'\' ) __t = \'<div class="slide-title">\'+_item_v_title+\'</div>\';
						if ( _item_v_desc != \'\' ) __d = \'<div class="slide-byline">\'+_item_v_desc+\'</div>\';
					
					    _item_v_intro += \'<div class="slide-text">\';
						_item_v_intro += __t;
						_item_v_intro += __d;
						_item_v_intro += \'</div>\';
						
					}
					

					show_list_item += \'<li>\';
					show_list_item += \'<img src="\'+_item_v_photo+\'" alt="">\';
					
					if ( _item_v_url != \'\' ) {
					   show_list_item += \'<a href="\'+_item_v_url+\'">\';
					}
					
					show_list_item += _item_v_intro;
					
					if ( _item_v_url != \'\' ) {
					   show_list_item += \'</a>\';
					}
				
					
					show_list_item += \'</li>\';
				

				}


			}
			

					
			var temp = \'\';
				temp += \'<div class="uix-pb-imageslider-wrapper">\';
				temp += \'<div class="uix-pb-imageslider">\';
				temp += \'<div class="uix-pb-imageslider-container">\';
				temp += \'<div class="flexslider" data-loop="\'+uix_pb_imageslider_list_loop+\'" data-speed="\'+uix_pb_imageslider_list_speed+\'" data-timing="\'+uix_pb_imageslider_list_timing+\'" data-paging="\'+uix_pb_imageslider_list_paging+\'" data-arrows="\'+uix_pb_imageslider_list_arrows+\'" data-animation="\'+uix_pb_imageslider_list_effect+\'">\';
				temp += \'<ul class="slides">\';
				temp += show_list_item;
				temp += \'</ul>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';




		'
    )
);
