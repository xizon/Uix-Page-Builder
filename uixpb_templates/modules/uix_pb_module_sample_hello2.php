<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/************************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ***  This file is an example of all form controls **
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
 * ****************************************************
************************************************************/


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

$form_type_config = array(
    'list' => 1
);


$module_config = 
	array(
	
		array(
			'id'             => 'uix_pb_features_col2_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_features_col2_config_intro',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
	
	)
;



$form_type_col2 = array(
    'list'       => 2
);


$args_col2_1 = 
	array(
	


		array(
			'id'             => 'uix_pb_col_demo_col2_1_text',
			'title'          => esc_html__( 'Text2 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
			
		array(
			'id'             => 'uix_pb_col_demo_col2_1_textarea',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
								)
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_1_icon',
			'title'          => esc_html__( 'Icon', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Choose Demo Icon', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => 'uix_pb_col_demo_col2_1_upload',
				'title'          => esc_html__( 'Upload Image', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image'
			
		),	
			
		
	    array(
			'id'             => 'uix_pb_col_demo_col2_1_slider',
			'title'          => esc_html__( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),		
		
	
	)
;


$args_col2_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col2_2',
			'title'          => esc_html__( 'Text2 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_2_textarea',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
								)
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_2_icon',
			'title'          => esc_html__( 'Icon', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Choose Demo Icon', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => 'uix_pb_col_demo_col2_2_upload',
				'title'          => esc_html__( 'Upload Image', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image'
			
		),	
			
	    array(
			'id'             => 'uix_pb_col_demo_col2_2_slider',
			'title'          => esc_html__( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),			
	
	)
;


//---------

$form_type_col3 = array(
    'list' => 3
);


$args_col3_1 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_1',
			'title'          => esc_html__( 'Text3 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;

$args_col3_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_2',
			'title'          => esc_html__( 'Text3 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;


$args_col3_3 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_3',
			'title'          => esc_html__( 'Text3 - 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;



//---------

$form_type_col4 = array(
    'list' => 4
);


$args_col4_1 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_1',
			'title'          => esc_html__( 'Text4 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;

$args_col4_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_2',
			'title'          => esc_html__( 'Text4 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;
$args_col4_3 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_3',
			'title'          => esc_html__( 'Text4 - 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;
$args_col4_4 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_4',
			'title'          => esc_html__( 'Text4 - 4', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		
		
	
	)
;



/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'                   => false,
		'form_id'                 => $form_id,
		'fields'                  => array(
										array(
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col2,
											 'values'  => $args_col2_1,
											 'title'   => esc_html__( 'Item 2_1', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col2,
											 'values'  => $args_col2_2,
											 'title'   => esc_html__( 'Item 2_2', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_1,
											 'title'   => esc_html__( 'Item 3_1', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_2,
											 'title'   => esc_html__( 'Item 3_2', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_3,
											 'title'   => esc_html__( 'Item 3_3', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_1,
											 'title'   => esc_html__( 'Item 4_1', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_2,
											 'title'   => esc_html__( 'Item 4_2', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_3,
											 'title'   => esc_html__( 'Item 4_3', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_4,
											 'title'   => esc_html__( 'Item 4_4', 'uix-page-builder' )
										),
	
	
	

									),
		'title'                   => esc_html__( 'Form Demo 2', 'uix-page-builder' ),
	
	
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
	    'template'              => ''
    )
);

