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
 * Clone parameters
 * ----------------------------------------------------
 */
$clone_trigger_id        = 'uix_pb_clients_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_max               = 50;                               // Maximum of clone form 


/**
 * Form Type & Controls
 * ----------------------------------------------------
 */
$form_type_config = array(
    'list' => 1
);


$module_config = 
	array(
	
		array(
			'id'             => 'uix_pb_clients_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
	
		
		array(
			'id'             => 'uix_pb_clients_config_intro',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
	
		array(
			'id'             => 'uix_pb_clients_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            '6'  => '6',
		                            '5'  => '5',
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
		
		//------ Clone controls list (begin)

		
		array(
			'id'             => $clone_trigger_id,
			'title'          => esc_html__( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'max' => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_clients_listitem_logo',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'LOGO URL', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
				
			array(
				'id'             => 'uix_pb_clients_listitem_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Destination URL, e.g., http://your.clientsite.com', 'uix-page-builder' ),
				'type'           => 'text',
			    'callback'       => 'url',

			),
		
			array(
				'id'             => 'uix_pb_clients_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The Introduction of this client.', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
			
		
		//------ Clone controls list (end)
		
	

	
	)
;


/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
		'clone'                    => array(
										'trigger_id'     => $clone_trigger_id,
										'fields'         => array( 
																'uix_pb_clients_listitem_logo', 
																'uix_pb_clients_listitem_url',
																'uix_pb_clients_listitem_intro',
															)
									),
		'form_id'                 => $form_id,
		'fields'                  => array(
										array(
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type,
											 'values'  => $args,
											 'title'   => esc_html__( 'Content', 'uix-page-builder' )
										),

									),
		'title'                   => esc_html__( 'Clients', 'uix-page-builder' ),
	
	
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
		
			{{if uix_pb_clients_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_clients_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_clients_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_clients_config_intro}</div>		
			{{/if}}	
			
			
			<div class="uix-pb-client">

				<!-- loop start -->

					{{each '.$clone_trigger_id.'}}
						<div class="uix-pb-client-li uix-pb-client-li-${uix_pb_clients_config_grid}">
							<p class="uix-pb-img">
								{{if uix_pb_clients_listitem_url != ""}}<a href="${uix_pb_clients_listitem_url}" target="_blank">{{/if}}
								<img src="{{if uix_pb_clients_listitem_logo != ""}}${uix_pb_clients_listitem_logo}{{else}}'.esc_url( UixPBFormCore::logo_placeholder() ).'{{/if}}" alt="">
								{{if uix_pb_clients_listitem_url != ""}}</a>{{/if}}
							</p>
							<p>${uix_pb_clients_listitem_intro}</p>   
						</div>
					{{/each}}	

				<!-- loop end -->

			</div>
		
		'
	
    )
);
