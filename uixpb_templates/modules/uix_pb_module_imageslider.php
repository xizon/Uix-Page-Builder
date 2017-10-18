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
$clone_trigger_id        = 'uix_pb_imageslider_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_max               = 15;                                     // Maximum of clone form 


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
			'callback'       => 'number',
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
			'callback'       => 'number',
			'default'        => array(
									'units'  => 'ms'
								)
		
		),	
		
	 
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
				'id'             => 'uix_pb_imageslider_listitem_photo',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
			
		
			array(
				'id'             => 'uix_pb_imageslider_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Slider title', 'uix-page-builder' ),
				'type'           => 'text',
			    'callback'       => 'html',

			),
			
		
		

			
			array(
				'id'             => 'uix_pb_imageslider_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Slider introduction', 'uix-page-builder' ),
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
		
			array(
				'id'             => 'uix_pb_imageslider_listitem_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Destination URL and can be left blank, e.g., http://your.site.com', 'uix-page-builder' ),
				'type'           => 'text',
			    'callback'       => 'url',

			),
	
			
		
		//------ Clone controls list (end)
		
		


		
	
	)
;



/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'        => array(
							'trigger_id'     => $clone_trigger_id,
							'fields'         => array( 
													'uix_pb_imageslider_listitem_photo', 
													'uix_pb_imageslider_listitem_title',
													'uix_pb_imageslider_listitem_intro',
													'uix_pb_imageslider_listitem_url',
												)
						),
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'     => $form_type,
								 'values'   => $args
							),

						),
		'title'        => esc_html__( 'Image Slider', 'uix-page-builder' ),
	
	
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
		
			<div class="uix-pb-imageslider-wrapper">
				<div class="uix-pb-imageslider">
					<div class="uix-pb-imageslider-container">
						<div class="flexslider" data-loop="${uix_pb_imageslider_list_loop}" data-speed="${uix_pb_imageslider_list_speed}" data-timing="${uix_pb_imageslider_list_timing}" data-paging="${uix_pb_imageslider_list_paging}" data-arrows="${uix_pb_imageslider_list_arrows}" data-animation="${uix_pb_imageslider_list_effect}">
							<ul class="slides">
							<!-- loop start -->

								{{each '.$clone_trigger_id.'}}
									{{if uix_pb_imageslider_listitem_photo != ""}}

										<li>
											<img src="${uix_pb_imageslider_listitem_photo}" alt="">

											{{if uix_pb_imageslider_listitem_url != ""}}<a href="${uix_pb_imageslider_listitem_url}" target="_blank">{{/if}}
												<div class="slide-text">
														{{if uix_pb_imageslider_listitem_title != ""}}<div class="slide-title">${uix_pb_imageslider_listitem_title}</div>{{/if}}
														{{if uix_pb_imageslider_listitem_intro != ""}}<div class="slide-byline">${uix_pb_imageslider_listitem_intro}</div>{{/if}}
												</div>
											{{if uix_pb_imageslider_listitem_url != ""}}</a>{{/if}}			
										</li>

									{{/if}}
								{{/each}}	

							<!-- loop end -->
							</ul>
						</div>
					</div>
				</div>
			</div>

		'
	
    )
);
