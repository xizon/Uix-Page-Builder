<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Returns each variable in module data
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::get_module_data_vars( basename( __FILE__, '.php' ) );
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
			'desc'           => esc_html__( 'Set the instagram module top & bottom padding to be 0px for your page.', 'uix-page-builder' ),
			'value'          => 1, // 0:false  1:true
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
		
		    var space_class = ( uix_pb_instagram_bg_space === true ) ? \'uix-pb-section-nospace\' : \'\';
	
			var temp = \'[uix_pb_instagram custom_classes=\\\'\'+uixpbform_htmlEncode( space_class )+\'\\\' username=\\\'\'+uixpbform_htmlEncode( uix_pb_instagram_username )+\'\\\' show=\\\'\'+uixpbform_floatval( uix_pb_instagram_show )+\'\\\' thumbsize=\\\'\'+uixpbform_htmlEncode( uix_pb_instagram_thumb )+\'\\\' displayname=\\\'\'+uix_pb_instagram_displayname+\'\\\']\';
		'
    )
);

