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
$clone_trigger_id_1        = 'uix_pb_features_col2_one_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_trigger_id_2        = 'uix_pb_features_col2_two_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_max                 = 15;                                           // Maximum of clone form 


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
			'id'             => 'uix_pb_features_col2_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html', 
		
		),
	
		
		array(
			'id'             => 'uix_pb_features_col2_config_intro',
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
    'list' => 2
);



$args_1 = 
	array(
	
		//------ Clone controls list (begin)
		array(
			'id'             => $clone_trigger_id_1,
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
				'id'             => 'uix_pb_features_col2_one_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Feature Title', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
			
		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
		
		//------ Clone controls list (end)
		
		


		
	
	)
;

$args_2 = 
	array(

	 
		//------ Clone controls list (begin)
		array(
			'id'             => $clone_trigger_id_2,
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
				'id'             => 'uix_pb_features_col2_two_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Feature Title', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',	
			
			),
			

			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
			
		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
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
										'trigger_id'     => array( $clone_trigger_id_1, $clone_trigger_id_2 ),
										'fields'         => array(
																array( 
																	'uix_pb_features_col2_one_listitem_title', 
																	'uix_pb_features_col2_one_listitem_desc',
																	'uix_pb_features_col2_one_listitem_icon',
																),
																array( 
																	'uix_pb_features_col2_two_listitem_title', 
																	'uix_pb_features_col2_two_listitem_desc',
																	'uix_pb_features_col2_two_listitem_icon',
																)
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
											 'values'  => $args_1,
											 'title'   => esc_html__( 'Left Block', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type,
											 'values'  => $args_2,
											 'title'   => esc_html__( 'Right Block', 'uix-page-builder' )
										),

									),
		'title'                   => esc_html__( 'Features (2 Column)', 'uix-page-builder' ),
	
	
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
		
		
			{{if uix_pb_features_col2_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_features_col2_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_features_col2_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_features_col2_config_intro}</div>		
			{{/if}}	
		
			<div class="uix-pb-feature">
				<div class="uix-pb-row">
					<div class="uix-pb-col-6">

						<!-- loop start -->

							{{each '.$clone_trigger_id_1.'}}
								<div class="uix-pb-feature-li">
									<h3 class="uix-pb-feature-title">
										<span class="uix-pb-feature-icon-side">{{if uix_pb_features_col2_one_listitem_icon != ""}}<i class="fa fa-${uix_pb_features_col2_one_listitem_icon}"></i>{{else}}<i class="fa fa-check"></i>{{/if}}</span>
										${uix_pb_features_col2_one_listitem_title}
									</h3>
									<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow">
										<p>${uix_pb_features_col2_one_listitem_desc}</p>
									</div>             
								</div>
							{{/each}}	

						<!-- loop end -->	


					</div>
					<div class="uix-pb-col-6 uix-pb-col-last">
						<!-- loop start -->

							{{each '.$clone_trigger_id_2.'}}
								<div class="uix-pb-feature-li">
									<h3 class="uix-pb-feature-title">
										<span class="uix-pb-feature-icon-side">{{if uix_pb_features_col2_two_listitem_icon != ""}}<i class="fa fa-${uix_pb_features_col2_two_listitem_icon}"></i>{{else}}<i class="fa fa-check"></i>{{/if}}</span>
										${uix_pb_features_col2_two_listitem_title}
									</h3>
									<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow">
										<p>${uix_pb_features_col2_two_listitem_desc}</p>
									</div>             
								</div>
							{{/each}}	

						<!-- loop end -->
					</div>
				</div>
			</div>

		'
    )
);
