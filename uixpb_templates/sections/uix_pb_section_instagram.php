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
			'id'             => 'uix_pb_instagram_username',
			'title'          => esc_html__( 'User Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		
	    array(
			'id'             => 'uix_pb_instagram_show',
			'title'          => esc_html__( 'Number of items to show', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 10,
			'placeholder'    => '',
			'type'           => 'short-text'
		
		),
		
		array(
			'id'             => 'uix_pb_instagram_thumb',
			'title'          => esc_html__( 'Thumbnail Size', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'small',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'small'   => 'Small',
									'medium'  => 'Medium',
									'large'   => 'Large'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_instagram_displayname',
			'title'          => esc_html__( 'Display Your Username?', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		),	


		array(
			'id'             => 'uix_pb_instagram_bg_space',
			'title'          => esc_html__( 'Seamless Display', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Set the instagram module top & bottom margin to be 0px for your page.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),

		
	)
;

/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'        => '',
	    'defalt_value' => $item,
	    'widget_name'  => $wname,
		'form_id'      => $form_id,
		'section_id'   => $sid,
	    'column_id'    => $colid,
		'fields'       => array(
							array(
								 'config'  => $args_config,
								 'type'    => $form_type,
								 'values'  => $args
							),

						),
		'title'        => esc_html__( 'Instagram Feed', 'uix-page-builder' ),
	    'js_template'  => '
		
		    var space_class = ( uix_pb_instagram_bg_space === true ) ? \'uix-pb-section-nospace\' : \'\';
	
			var temp = \'[uix_pb_instagram custom_classes=\\\'\'+uixpbform_htmlEncode( space_class )+\'\\\' username=\\\'\'+uixpbform_htmlEncode( uix_pb_instagram_username )+\'\\\' show=\\\'\'+uixpbform_floatval( uix_pb_instagram_show )+\'\\\' thumbsize=\\\'\'+uixpbform_htmlEncode( uix_pb_instagram_thumb )+\'\\\' displayname=\\\'\'+uix_pb_instagram_displayname+\'\\\']\';
		'
    )
);

