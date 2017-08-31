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
$clone_trigger_id        = 'uix_pb_testimonials_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

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
			'id'             => 'uix_pb_testimonials_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_testimonials_config_intro',
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
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'',
											'type'      => 'image'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
	

									 ),
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_testimonials_listitem_avatar',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'', /*class of list item */
				'placeholder'    => esc_html__( 'Avatar URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
									)
			
			),	
			array(
				'id'             => 'uix_pb_testimonials_listitem_name',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Name', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => 'uix_pb_testimonials_listitem_position',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Position', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => 'uix_pb_testimonials_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Enter some details for the customer giving this testimonial., E.g., Thank you from the bottom of our hearts.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'', /*class of list item */
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
																		'required'       => 'uix_pb_testimonials_listitem_intro',
																		'fields'         => array( 'uix_pb_testimonials_listitem_avatar', 'uix_pb_testimonials_listitem_name', 'uix_pb_testimonials_listitem_position', 'uix_pb_testimonials_listitem_intro' )
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
		'title'                   => esc_html__( 'Testimonials Carousel', 'uix-page-builder' ),
	    'js_template'             => '
		
			var _config_t      = ( uix_pb_testimonials_config_title != undefined && uix_pb_testimonials_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_testimonials_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc   = ( uix_pb_testimonials_config_intro != undefined && uix_pb_testimonials_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uix_pb_testimonials_config_intro+\'</div>\' : \'\';

					

				
			/* List Item */
			var list_num               = '.floatval( $clone_max ).',
				show_list_item = \'\';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid      = ( i >= 2 ) ? \'#\'+i+\'-\' : \'#\',
					_avatar   = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'\' ).val(),
					_name     = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'\' ).val(),
					_pos      = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'\' ).val(),
					_intro    = $( _uid+\''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'\' ).val();

				var _item_v_avatar     = ( _avatar != undefined && _avatar != \'\' ) ? \'<img class="uix-pb-testimonials-avatar" src="\'+encodeURI( _avatar )+\'" alt="\'+uixpbform_htmlEncode( _name )+\'" />\': \'<span class="uix-pb-testimonials-no-avatar"></span>\',
					_item_v_posclass   = ( _avatar != undefined && _avatar != \'\' ) ? \'\': \'class="uix-pb-testimonials-pure-text"\';


				if ( _intro != undefined && _intro != \'\' ) {

					//Do not include spaces
					show_list_item += \'<li>\';
					show_list_item += \'<div class="uix-pb-testimonials-content">\'+_intro+\'</div>\';
					show_list_item += \'<div class="uix-pb-testimonials-signature">\'+_item_v_avatar+\'\';
					show_list_item += \'<strong \'+_item_v_posclass+\'>\'+_name+\'</strong> - \'+_pos+\'\';
					show_list_item += \'</div>\';										                                                    
					show_list_item += \'</li>\';

				}


			}


			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-testimonials-wrapper">\';
				temp += \'<div class="uix-pb-testimonials">\';
				temp += \'<div class="uix-pb-testimonials-container">\';
				temp += \'<div class="flexslider">\';
				temp += \'<ul class="slides">\';
				temp += show_list_item;
				temp += \'</ul><!-- .uix-pb-testimonials-slides -->\';
				temp += \'</div><!-- .flexslider -->\';
				temp += \'</div><!-- .uix-pb-testimonials-container -->\';
				temp += \'</div><!-- /.uix-pb-testimonials -->\';
				temp += \'</div>\';	
		
		'
    )
);


