<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Note: 
 *
 * Please refer to sample:  uix_pb_module_sample_hello.php
 * 						    uix_pb_module_sample_hello2.php
 *
 * 1) For all ID attribute, special characters are only allowed underscores "_"
 * 2) Optional params of field "callback":  html, attr, slug, url, number, number-deg_px, color-name, list
 * 3) String of clone trigger ID, must contain at least "_triggerclonelist"
 * 4) String of clone ID attribute must contain at least "_listitem"
 * 5) If multiple columns are used to clone event and there are multiple clone triggers, 
      the triggers ID and clone controls ID must contain the string "_one_", "_two", "_three_" or "_four_" for per column
*/



/**
 * Returns current module(form group) ID
 * ----------------------------------------------------
 */
$form_id = basename( __FILE__, '.php' );


/**
 * Form Type & Controls
 * ----------------------------------------------------
 */
$form_type = array(
	'list' => false
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
									'normal'   => UixPBFormCore::plug_directory() .'images/map/map-style-1.png',
									'gray'   => UixPBFormCore::plug_directory() .'images/map/map-style-2.png',
									'black'   => UixPBFormCore::plug_directory() .'images/map/map-style-3.png',
									'real'   => UixPBFormCore::plug_directory() .'images/map/map-style-4.png',
									'terrain'   => UixPBFormCore::plug_directory() .'images/map/map-style-5.png',
									'white'   => UixPBFormCore::plug_directory() .'images/map/map-style-6.png',
									'dark-blue'   => UixPBFormCore::plug_directory() .'images/map/map-style-7.png',
									'dark-blue-2'   => UixPBFormCore::plug_directory() .'images/map/map-style-8.png',
									'blue'   => UixPBFormCore::plug_directory() .'images/map/map-style-9.png',
									'flat'   => UixPBFormCore::plug_directory() .'images/map/map-style-10.png',
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

			'id'             => 'uix_pb_map_apikey',
			'title'          => esc_html__( 'Google API key', 'uix-page-builder' ),
			'desc'           => wp_kses( sprintf( __( '<a href="%1$s" target="_blank">How to 
Get an API Key?</a> If left blank, the default Key will be used, but it will have a traffic excess problem that will not display properly.', 'uix-page-builder' ), esc_url( '//developers.google.com/maps/documentation/javascript/get-api-key' ) ), wp_kses_allowed_html( 'post' ) ),
			'value'          => esc_attr( get_option( 'uix_pb_opt_map_api', '' ) ),
			'placeholder'    => esc_attr__( 'Your own Google API key', 'uix-page-builder' ),
			'type'           => 'text',
		    'callback'       => 'attr',
		
		),
	
	
		
	    array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_map_width}
				${uix_pb_map_width_units}
			 *
			*/
			'id'             => 'uix_pb_map_width',
			'title'          => esc_html__( 'Map Width', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 100,
			'placeholder'    => '',
			'type'           => 'short-units-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'       => array( '%', 'px' ),
									'units_value' => '%',
				                )
		
		),
		
	    array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_map_height}
				${uix_pb_map_height_units}
			 *
			*/
			'id'             => 'uix_pb_map_height',
			'title'          => esc_html__( 'Map Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 285,
			'placeholder'    => '',
			'type'           => 'short-units-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'      => array( 'px', 'vh' ),
									'units_value' => 'px'
								)
		
		),	
		
		
		
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_map_name}
				${uix_pb_map_name_attr}
			 *
			*/
			'id'             => 'uix_pb_map_name',
			'title'          => esc_html__( 'Place Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'SEO San Francisco, CA, Gough Street, San Francisco, CA', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'attr',
		
		),
		
		array(
			'id'             => 'uix_pb_map_latitude',
			'title'          => esc_html__( 'Latitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 37.7770776,
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'number',
		
		),
	
		array(
			'id'             => 'uix_pb_map_longitude',
			'title'          => esc_html__( 'Longitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => -122.4414289,
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'number',
		
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
			'type'           => 'image'
		
		),		


	
	)
;

/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'        => false,
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'     => $form_type,
								 'values'   => $args
							),

						),
		'title'        => esc_html__( 'Google Map', 'uix-page-builder' ),
	
	
		/**
		 * /////////////// Customizing HTML output on the frontend /////////////// 
		 * 
		 * 
		 * Usage:
		 *
		 * 1) Written as pure HTML syntax.
		 * 2) Directly use the controls ID as a variable: ${???}
		 * 3) Using {{if}} and {{else}} to render conditional sections. 
		       -----E.g.
		       {{if your_field_id}} ... {{else}} ... {{/if}}
			   
		 * 4) Using {{each}} to render repeating sections.
		       -----E.g.
				{{each your_clone_trigger_id}}
					{{if your_listitem_field_id != ""}}
					    {{if $index == 0}}<li class="active">{{else}}<li>{{/if}}
						    ${your_listitem_field_id}
						</li>
					{{/if}}	
				{{/each}}
		 
		 */
	    'template'              => '
		  
		 [uix_pb_map style=\'${uix_pb_map_style}\' apikey=\'${uix_pb_map_apikey}\' width=\'${uix_pb_map_width}${uix_pb_map_width_units}\' height=\'${uix_pb_map_height}${uix_pb_map_height_units}\' latitude=\'${uix_pb_map_latitude}\' longitude=\'${uix_pb_map_longitude}\' zoom=\'${uix_pb_map_zoom}\' name=\'${uix_pb_map_name_attr}\' marker=\'${uix_pb_map_marker}\']
	
		'
	
    )
);

