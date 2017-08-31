<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( basename( __FILE__, '.php' ) );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = array(
    'list' => 1
);

$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
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
									'row'     => 3,
									'format'  => true
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
									'row'     => 2,
									'format'  => true
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
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' )
									)
			
		),	
			
		
	    array(
			'id'             => 'uix_pb_col_demo_col2_1_slider',
			'title'          => esc_html__( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => 'uix_pb_col_demo_col2_1_slider_units',
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
									'row'     => 2,
									'format'  => true
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
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' )
									)
			
		),	
			
	    array(
			'id'             => 'uix_pb_col_demo_col2_2_slider',
			'title'          => esc_html__( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => 'uix_pb_col_demo_col2_2_slider_units',
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
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'                   => '',
	    'defalt_value'            => $item,
	    'widget_name'             => $wname,
		'form_id'                 => $form_id,
		'section_id'              => $sid,
	    'column_id'               => $colid,
		'fields'                  => array(
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col2,
											 'values'  => $args_col2_1,
											 'title'   => esc_html__( 'Item 2_1', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col2,
											 'values'  => $args_col2_2,
											 'title'   => esc_html__( 'Item 2_2', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_1,
											 'title'   => esc_html__( 'Item 3_1', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_2,
											 'title'   => esc_html__( 'Item 3_2', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col3,
											 'values'  => $args_col3_3,
											 'title'   => esc_html__( 'Item 3_3', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_1,
											 'title'   => esc_html__( 'Item 4_1', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_2,
											 'title'   => esc_html__( 'Item 4_2', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_3,
											 'title'   => esc_html__( 'Item 4_3', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_col4,
											 'values'  => $args_col4_4,
											 'title'   => esc_html__( 'Item 4_4', 'uix-page-builder' )
										),
	
	
	

									),
		'title'                   => esc_html__( 'Form Demo 2', 'uix-page-builder' ),
	    'js_template'             => '

			var temp = \'\';
		
		
		'
    )
);

