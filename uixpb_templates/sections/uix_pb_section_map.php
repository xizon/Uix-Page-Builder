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
			'id'             => 'uix_pb_map_style',
			'title'          => esc_html__( 'Map Style', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'normal',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'normal'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-1.png',
									'gray'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-2.png',
									'black'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-3.png',
									'real'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-4.png',
									'terrain'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-5.png',
									'white'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-6.png',
									'dark-blue'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-7.png',
									'dark-blue-2'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-8.png',
									'blue'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-9.png',
									'flat'   => UixPageBuilder::plug_directory() .'includes/uixpbform/images/map/map-style-10.png',
				                )
		
		),
		
		
	    array(
			'id'             => 'uix_pb_map_style_tipinfo',
			'desc'           => wp_kses( sprintf( __( 'Click on the exact location you\'d like coordinates for. Right-click on the pin and select "What\'s here?" <a href="%1$s" target="_blank" rel="nofollow">Get Latitude Longitude</a>', 'uix-page-builder' ), 'https://www.google.ch/maps/' ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'note'  //error, success, warning, note, default
				                ),
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_map_width',
			'title'          => esc_html__( 'Map Width', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 100,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'       => array( '%', 'px' ),
									'units_id'    => 'uix_pb_map_width_units',
									'units_value' => '%',
				                )
		
		),
		
	    array(
			'id'             => 'uix_pb_map_height',
			'title'          => esc_html__( 'Map Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 285,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => array( 'px', 'vh' ),
									'units_id'    => 'uix_pb_map_height_units',
									'units_value' => 'px'
								)
		
		),	
		
		
		
		array(
			'id'             => 'uix_pb_map_name',
			'title'          => esc_html__( 'Place Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'SEO San Francisco, CA, Gough Street, San Francisco, CA', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => 'uix_pb_map_latitude',
			'title'          => esc_html__( 'Latitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 37.7770776,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		array(
			'id'             => 'uix_pb_map_longitude',
			'title'          => esc_html__( 'Longitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => -122.4414289,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_map_zoom',
			'title'          => esc_html__( 'Zoom', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 14,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'min'   => 3,
									'max'   => 21,
									'step'  => 1
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_map_marker',
			'title'          => esc_html__( 'Marker', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Markers can display custom images, in which case they are usually referred to as "icons."', 'uix-page-builder' ),
			'value'          => esc_url( UixPBFormCore::map_marker() ),
			'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
				                )
		
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
		'title'        => esc_html__( 'Google Map', 'uix-page-builder' ),
	
	
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
			var temp = \'[uix_pb_map style=\\\'\'+uixpbform_htmlEncode( uix_pb_map_style )+\'\\\' width=\\\'\'+uixpbform_floatval( uix_pb_map_width )+\'\'+uixpbform_htmlEncode( uix_pb_map_width_units )+\'\\\' height=\\\'\'+uixpbform_floatval( uix_pb_map_height )+\'\'+uixpbform_htmlEncode( uix_pb_map_height_units )+\'\\\' latitude=\\\'\'+uixpbform_floatval( uix_pb_map_latitude )+\'\\\' longitude=\\\'\'+uixpbform_floatval( uix_pb_map_longitude )+\'\\\' zoom=\\\'\'+uixpbform_floatval( uix_pb_map_zoom )+\'\\\' name=\\\'\'+uixpbform_htmlEncode( uix_pb_map_name )+\'\\\' marker=\\\'\'+encodeURI( uix_pb_map_marker )+\'\\\']\';
		'
    )
);

