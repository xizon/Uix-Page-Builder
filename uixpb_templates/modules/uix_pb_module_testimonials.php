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
 * 2) Optional params of field "callback":  html, attr, slug, url, number, number-deg_px, shortcode-attr, color-hex, list
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
$clone_trigger_id        = 'uix_pb_testimonials_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_max               = 30;                               // Maximum of clone form 


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
			'id'             => 'uix_pb_testimonials_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
	
		
		array(
			'id'             => 'uix_pb_testimonials_config_intro',
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
				'id'             => 'uix_pb_testimonials_listitem_avatar',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Avatar URL', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
			array(
				'id'             => 'uix_pb_testimonials_listitem_name',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Name', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',
			
			),			
			
			array(
				'id'             => 'uix_pb_testimonials_listitem_position',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Position', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',
			
			),			
			array(
				'id'             => 'uix_pb_testimonials_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Enter some details for the customer giving this testimonial., E.g., Thank you from the bottom of our hearts.', 'uix-page-builder' ),
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
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
		'clone'                    => array(
										'trigger_id'     => $clone_trigger_id,
										'fields'         => array( 
																'uix_pb_testimonials_listitem_avatar', 
																'uix_pb_testimonials_listitem_name',
																'uix_pb_testimonials_listitem_position',
																'uix_pb_testimonials_listitem_intro',
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
		'title'                   => esc_html__( 'Testimonials Carousel', 'uix-page-builder' ),
	
	
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
		
		
			{{if uix_pb_testimonials_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_testimonials_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_testimonials_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_testimonials_config_intro}</div>		
			{{/if}}	
		
			<div class="uix-pb-testimonials-wrapper">
				<div class="uix-pb-testimonials">
					<div class="uix-pb-testimonials-container">
						<div class="flexslider">
							<ul class="slides">

							<!-- loop start -->

								{{each '.$clone_trigger_id.'}}
									{{if uix_pb_testimonials_listitem_intro != ""}}
										<li>
											<div class="uix-pb-testimonials-content">${uix_pb_testimonials_listitem_intro}</div>
											<div class="uix-pb-testimonials-signature">
												{{if uix_pb_testimonials_listitem_avatar != ""}}
													<img class="uix-pb-testimonials-avatar" src="${uix_pb_testimonials_listitem_avatar}" alt="" />
												{{else}}
													<span class="uix-pb-testimonials-no-avatar"></span>
												{{/if}}

												<strong {{if uix_pb_testimonials_listitem_avatar == ""}}class="uix-pb-testimonials-pure-text"{{/if}}>${uix_pb_testimonials_listitem_name}</strong>
												{{if uix_pb_testimonials_listitem_position != ""}} - ${uix_pb_testimonials_listitem_position}{{/if}}
											</div>										                                                    
										</li>	
									{{/if}}	
								{{/each}}	

							<!-- loop end -->

							</ul><!-- .uix-pb-testimonials-slides -->
						</div><!-- .flexslider -->
					</div><!-- .uix-pb-testimonials-container -->
				</div><!-- /.uix-pb-testimonials -->
			</div>	

		'
	
    )
);


