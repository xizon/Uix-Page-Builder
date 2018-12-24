<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Require the WP plugin "Uix Slideshow"
 * ----------------------------------------------------
 */
if ( !class_exists( 'UixSlideshow' ) ) {
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
			'id'             => 'uix_pb_uix_slideshow_code',
			'title'          => esc_html__( 'Shortcode & Content', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '[uix_slideshow_output]',
			'placeholder'    => '',
			'type'           => 'textarea',
	        'callback'       => 'html', 
			'default'        => array(
									'row'     => 3
								)
		
		),
		
	
	    array(
			'id'             => 'uix_pb_uix_slideshow_manage_tipinfo',
			'desc'           => wp_kses( sprintf( __( '<a href="%1$s" target="_blank">Manage Your Content of Uix Slideshow</a>', 'uix-page-builder' ), esc_url( admin_url( 'edit.php?post_type=uix-slideshow' ) ) ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
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
		'title'        => esc_html__( 'Uix Slideshow', 'uix-page-builder' ),

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
	    'template'              => '${uix_pb_uix_slideshow_code}'
    )
);

