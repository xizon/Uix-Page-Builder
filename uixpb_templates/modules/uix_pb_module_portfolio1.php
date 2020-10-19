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
$clone_trigger_id        = 'uix_pb_portfolio1_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
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
			'id'             => 'uix_pb_portfolio1_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_intro',
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
			'id'             => 'uix_pb_portfolio1_config_filterable',
			'title'          => esc_html__( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
	
	
		array(
			'id'             => 'uix_pb_portfolio1_config_layout',
			'title'          => esc_html__( 'Layout', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'standard',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'standard'  => esc_html__( 'Standard', 'uix-page-builder' ),
									'masonry'  => esc_html__( 'Masonry', 'uix-page-builder' ),
								)
		
		
		),	
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_urlwindow',
			'title'          => esc_html__( 'Open link in new tab', 'uix-page-builder' ),
			'desc'           => esc_html__( 'This option is valid when you use destination URL.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		

		array(
			'id'             => 'uix_pb_portfolio1_config_thumbnail_fillet',
			'title'          => esc_html__( 'Radius of Fillet Image', 'uix-page-builder' ),
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
			'id'             => 'uix_pb_portfolio1_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
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
				'id'             => 'uix_pb_portfolio1_listitem_thumbnail',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Thumbnail', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_fullimage',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Full Preview (Optional)', 'uix-page-builder' ),
				'type'           => 'image'
			
			),			
		
			array(
				/*
				 * @template vars: 
				 *
					${uix_pb_portfolio1_listitem_title}
					${uix_pb_portfolio1_listitem_title_attr}
				 *
				*/
				'id'             => 'uix_pb_portfolio1_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Project Title', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'attr',
			
			),			
			
			array(
				/*
				 * @template vars: 
				 *
					${uix_pb_portfolio1_listitem_cat}
					${uix_pb_portfolio1_listitem_cat_slug}
				 *
				*/
				'id'             => 'uix_pb_portfolio1_listitem_cat',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Category', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
			    'callback'       => 'slug',
			
			),			
			array(
				'id'             => 'uix_pb_portfolio1_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'The description of this project.', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'textarea',
			    'callback'       => 'html',
				'default'        => array(
										'row'     => 5
									)
			
			),
		
		
			//--- Toggle of unidirectional display (begin)
			array(
				'id'             => 'uix_pb_portfolio1_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'placeholder'    => '',
				'type'           => 'toggle',
				'toggle'         => array(
										'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
										'target_ids'    => array( 'uix_pb_portfolio1_listitem_toggle_url' )
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_portfolio1_listitem_toggle_url',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Destination URL', 'uix-page-builder' ),
					'type'           => 'text',
			        'callback'       => 'url',
				
				),
				
		
		    //--- Toggle of unidirectional display (end)
		
		
		
			
		
		//------ Clone controls list (end)
		

		
	
	)
;

/**
 * Returns form
 * ----------------------------------------------------
 */

/**
 * 
 * Returns the unique ID used in the frontend template
 */
$frontend_id = uniqid();


UixPBFormCore::form_scripts( array(
		'clone'                    => array(
												'trigger_id'     => $clone_trigger_id,
												'fields'         => array( 
																		'uix_pb_portfolio1_listitem_thumbnail', 
																		'uix_pb_portfolio1_listitem_fullimage',
																		'uix_pb_portfolio1_listitem_title',
																		'uix_pb_portfolio1_listitem_cat',
																		'uix_pb_portfolio1_listitem_intro',
																		'uix_pb_portfolio1_listitem_toggle',
																		'uix_pb_portfolio1_listitem_toggle_url',
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
		'title'                   => esc_html__( 'Portfolio Grid', 'uix-page-builder' ),
	
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
		
		
			{{if uix_pb_portfolio1_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_portfolio1_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_portfolio1_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_portfolio1_config_intro}</div>		
			{{/if}}	
			
			{{if uix_pb_portfolio1_config_filterable == 1}}
				<div class="uix-pb-portfolio-cat-list uix-pb-filterable" data-classprefix="uix-pb-portfolio-" id="nav-filters-uix-pb-portfolio-cat-list-'.$frontend_id.'">
					<ul>
					    <li class="current-cat"><a href="javascript:void(0)" data-normal="1" data-group="all">'.esc_html__( 'All', 'uix-page-builder' ).'</a></li>
						<span id="nav-filters-uix-pb-portfolio-cat-list-'.$frontend_id.'-container"></span>
					</ul>
				</div>
			{{/if}}	
						
			
			
			<div class="uix-pb-portfolio-wrapper" data-show-type="${uix_pb_portfolio1_config_layout}{{if uix_pb_portfolio1_config_filterable == 1}}|filter{{/if}}" data-filter-id="{{if uix_pb_portfolio1_config_filterable == 1}}#nav-filters-uix-pb-portfolio-cat-list-'.$frontend_id.'{{/if}}">
				<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col${uix_pb_portfolio1_config_grid}">
			      <!-- loop start -->

						{{each '.$clone_trigger_id.'}}
							<div class="uix-pb-portfolio-item" data-groups-name="${uix_pb_portfolio1_listitem_cat_slug}">
								<span class="uix-pb-portfolio-image" style="-webkit-border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%; -moz-border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%; border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%;">
								<a {{if uix_pb_portfolio1_listitem_toggle_url != ""}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank"{{/if}}{{else}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank" rel="alternate"{{else}}rel="alternate"{{/if}}{{/if}} href="{{if uix_pb_portfolio1_listitem_toggle_url != ""}}${uix_pb_portfolio1_listitem_toggle_url}{{else}}{{if uix_pb_portfolio1_listitem_fullimage != ""}}${uix_pb_portfolio1_listitem_fullimage}{{else}}{{if uix_pb_portfolio1_listitem_thumbnail != ""}}${uix_pb_portfolio1_listitem_thumbnail}{{else}}'.esc_url(  UixPBFormCore::photo_placeholder() ).'{{/if}}{{/if}}{{/if}}" title="${uix_pb_portfolio1_listitem_title_attr}">
								<img src="{{if uix_pb_portfolio1_listitem_thumbnail != ""}}${uix_pb_portfolio1_listitem_thumbnail}{{else}}'.esc_url(  UixPBFormCore::photo_placeholder() ).'{{/if}}" alt="" style="-webkit-border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%; -moz-border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%; border-radius: ${uix_pb_portfolio1_config_thumbnail_fillet}%;">
								</a>
								</span>
								<h3>
									<a {{if uix_pb_portfolio1_listitem_toggle_url != ""}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank"{{/if}}{{else}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank" rel="alternate"{{else}}rel="alternate"{{/if}}{{/if}} href="{{if uix_pb_portfolio1_listitem_toggle_url != ""}}${uix_pb_portfolio1_listitem_toggle_url}{{else}}{{if uix_pb_portfolio1_listitem_fullimage != ""}}${uix_pb_portfolio1_listitem_fullimage}{{else}}{{if uix_pb_portfolio1_listitem_thumbnail != ""}}${uix_pb_portfolio1_listitem_thumbnail}{{else}}'.esc_url(  UixPBFormCore::photo_placeholder() ).'{{/if}}{{/if}}{{/if}}" title="${uix_pb_portfolio1_listitem_title_attr}">${uix_pb_portfolio1_listitem_title}</a>
								</h3>

								{{if uix_pb_portfolio1_listitem_cat != ""}}<div class="uix-pb-portfolio-type">${uix_pb_portfolio1_listitem_cat}</div>{{/if}}

								<div class="uix-pb-portfolio-content">
									${uix_pb_portfolio1_listitem_intro}
									<a class="uix-pb-portfolio-link" {{if uix_pb_portfolio1_listitem_toggle_url != ""}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank"{{/if}}{{else}}{{if uix_pb_portfolio1_config_urlwindow == 1}}target="_blank" rel="alternate"{{else}}rel="alternate"{{/if}}{{/if}} href="{{if uix_pb_portfolio1_listitem_toggle_url != ""}}${uix_pb_portfolio1_listitem_toggle_url}{{else}}{{if uix_pb_portfolio1_listitem_fullimage != ""}}${uix_pb_portfolio1_listitem_fullimage}{{else}}{{if uix_pb_portfolio1_listitem_thumbnail != ""}}${uix_pb_portfolio1_listitem_thumbnail}{{else}}'.esc_url(  UixPBFormCore::photo_placeholder() ).'{{/if}}{{/if}}{{/if}}" title="${uix_pb_portfolio1_listitem_title_attr}"></a>
								</div>
							</div>
						{{/each}}	

					<!-- loop end -->

				</div>
			</div>

		
		'

    )
);

