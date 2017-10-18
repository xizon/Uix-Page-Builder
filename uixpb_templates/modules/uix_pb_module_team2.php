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
$clone_trigger_id        = 'uix_pb_team2_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
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
			'id'             => 'uix_pb_team2_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
	
		
		array(
			'id'             => 'uix_pb_team2_config_intro' ,
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
			'id'             => 'uix_pb_team2_config_avatar_gray',
			'title'          => esc_html__( 'Gray Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, //0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	

		array(
			'id'             => 'uix_pb_team2_config_avatar_fillet',
			'title'          => esc_html__( 'Radius of Fillet Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'callback'       => 'number',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => 'uix_pb_team2_config_list_height',
			'title'          => esc_html__( 'Height of Grid', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'callback'       => 'number',
			'default'        => array(
									'units'  => 'px'
								)
		
		
		),	
		
	    array(
			'id'             => 'uix_pb_team2_config_list_height_tipinfo',
			'desc'           => wp_kses( __( 'Set height of grid so that it will fit its avatar photo. Browsers use a default stylesheet to render if the value is <strong>"0"</strong>.', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'note'  //error, success, warning, note, default
				                ),
		
		),	
		
		
		
		array(
			'id'             => 'uix_pb_team2_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 4,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
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
				'id'             => 'uix_pb_team2_listitem_avatar',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Avatar URL', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
			array(
				'id'             => 'uix_pb_team2_listitem_name',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Name', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',
			
			),			
			
			array(
				'id'             => 'uix_pb_team2_listitem_position',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Position', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'html',
			
			),			
			array(
				'id'             => 'uix_pb_team2_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The Introduction of this member.', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
		
			//--- Toggle of unidirectional display (begin)
			array(
				'id'             => 'uix_pb_team2_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'placeholder'    => '',
				'type'           => 'toggle',
				'toggle'         => array(
										'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
		 								'target_ids'    => array( 
																'uix_pb_team2_listitem_toggle_url1', 
																'uix_pb_team2_listitem_toggle_icon1', 
																'uix_pb_team2_listitem_toggle_url2', 
																'uix_pb_team2_listitem_toggle_icon2', 
																'uix_pb_team2_listitem_toggle_url3', 
																'uix_pb_team2_listitem_toggle_icon3' 
															)
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Your Social Network Page URL 1', 'uix-page-builder' ),
					'type'           => 'text',
			        'callback'       => 'url',
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Choose Social Icon 1', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Your Social Network Page URL 2', 'uix-page-builder' ),
					'type'           => 'text',
			        'callback'       => 'url',
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Choose Social Icon 2', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Your Social Network Page URL 3', 'uix-page-builder' ),
					'type'           => 'text',
			        'callback'       => 'url',
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Choose Social Icon 3', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
		    //--- Toggle of unidirectional display (end)
		
		    
			
		
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
																'uix_pb_team2_listitem_avatar', 
																'uix_pb_team2_listitem_name',
																'uix_pb_team2_listitem_position',
																'uix_pb_team2_listitem_intro', 
																'uix_pb_team2_listitem_toggle',
																'uix_pb_team2_listitem_toggle_url1',
																'uix_pb_team2_listitem_toggle_icon1', 
																'uix_pb_team2_listitem_toggle_url2',
																'uix_pb_team2_listitem_toggle_icon2',
																'uix_pb_team2_listitem_toggle_url3',
																'uix_pb_team2_listitem_toggle_icon3',
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
		'title'                   => esc_html__( 'Team Grid', 'uix-page-builder' ),
	
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
		
		
			{{if uix_pb_team2_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_team2_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_team2_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_team2_config_intro}</div>		
			{{/if}}	
			
			
			<div class="uix-pb-gallery">

				<!-- loop start -->

					{{each '.$clone_trigger_id.'}}
						{{if uix_pb_team2_listitem_name != ""}}

							<div class="uix-pb-gallery-list uix-pb-gallery-list-col${uix_pb_team2_config_grid} {{if uix_pb_team2_config_avatar_gray == 1}}uix-pb-gray{{/if}}">
								<div class="uix-pb-gallery-list-imgbox" {{if uix_pb_team2_config_list_height > 0}}style="height:${uix_pb_team2_config_list_height}px;"{{/if}}>
									<img src="{{if uix_pb_team2_listitem_avatar != ""}}${uix_pb_team2_listitem_avatar}{{else}}'.esc_url( UixPBFormCore::photo_placeholder() ).'{{/if}}" alt="" style="-webkit-border-radius:${uix_pb_team2_config_avatar_fillet}%;-moz-border-radius: ${uix_pb_team2_config_avatar_fillet}%;border-radius:${uix_pb_team2_config_avatar_fillet}%;">
									{{if uix_pb_team2_listitem_position != ""}}<span class="uix-pb-gallery-list-position">${uix_pb_team2_listitem_position}</span>{{/if}}
								</div>
								<div class="uix-pb-gallery-list-info">
									<h3 class="uix-pb-gallery-list-title">${uix_pb_team2_listitem_name}</h3>
									<div class="uix-pb-gallery-list-desc">
										<p>${uix_pb_team2_listitem_intro}</p>
									</div>
									<div class="uix-pb-gallery-list-social">
									
										{{if uix_pb_team2_listitem_toggle_url1 != ""}}
											<a href="${uix_pb_team2_listitem_toggle_url1}" target="_blank">
												{{if uix_pb_team2_listitem_toggle_icon1 != ""}}<i class="fa fa-${uix_pb_team2_listitem_toggle_icon1}"></i>{{else}}<i class="fa fa-link"></i>{{/if}}
											</a>
										{{/if}}

										{{if uix_pb_team2_listitem_toggle_url2 != ""}}
											<a href="${uix_pb_team2_listitem_toggle_url2}" target="_blank">
												{{if uix_pb_team2_listitem_toggle_icon2 != ""}}<i class="fa fa-${uix_pb_team2_listitem_toggle_icon2}"></i>{{else}}<i class="fa fa-link"></i>{{/if}}
											</a>
										{{/if}}

										{{if uix_pb_team2_listitem_toggle_url3 != ""}}
											<a href="${uix_pb_team2_listitem_toggle_url3}" target="_blank">
												{{if uix_pb_team2_listitem_toggle_icon3 != ""}}<i class="fa fa-${uix_pb_team2_listitem_toggle_icon3}"></i>{{else}}<i class="fa fa-link"></i>{{/if}}
											</a>
										{{/if}}									
									</div>
								</div>
							</div>

						{{/if}}
					{{/each}}	

				<!-- loop end -->

			</div>
		
		'
	
    )
);
