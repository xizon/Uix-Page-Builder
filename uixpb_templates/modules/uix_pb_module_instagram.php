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
			'id'             => 'uix_pb_instagram_username',
			'title'          => esc_html__( 'User Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'html', 
		
		),
		
		
	    array(
			'id'             => 'uix_pb_instagram_show',
			'title'          => esc_html__( 'Number of items to show', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 10,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number', 
		
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
		'title'        => esc_html__( 'Instagram Feed', 'uix-page-builder' ),

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
		
			[uix_pb_instagram custom_classes=\'{{if uix_pb_instagram_bg_space == 1}}uix-pb-section-nospace{{/if}}\' username=\'${uix_pb_instagram_username}\' show=\'${uix_pb_instagram_show}\' thumbsize=\'${uix_pb_instagram_thumb}\' displayname=\'${uix_pb_instagram_displayname}\']

		
		'
    )
);

