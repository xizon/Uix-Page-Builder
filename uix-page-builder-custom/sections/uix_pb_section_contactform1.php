<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_contactform1';

/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = UixPageBuilder::template_parameters( $form_id, $sid, $pid, $wname, $colid );

/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = array(
	'list' => false
);


$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						


$args = 
	array(

		
		array(
			'id'             => 'uix_pb_contactform1_code',
			'title'          => esc_html__( 'Shortcode & Content', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '[uix_pb_contact_form]',
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	    array(
			'id'             => 'uix_pb_contactform1_tipinfo',
			'desc'           => wp_kses( __( 'Output a complete commenting form with your theme by default. <strong>You can install a contact form plugin you want. When you\'re done, copy shortcode and paste into the editor.</strong>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'warning'  //error, success, warning, note
				                ),
		
		),	



        //------- template
		array(
			'id'             => $form_id.'_temp',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	

	


	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'        => '',
	    'defalt_value' => $item,
	    'widget_name'  => $wname,
		'form_id'      => $form_id,
		'section_id'   => $sid,
	    'column_id'    => $colid,
		'fields'       => array(
							array(
								 'config'  => $args_config,
								 'type'    => $form_type,
								 'values'  => $args
							),

						),
		'title'        => esc_html__( 'Contact Form', 'uix-page-builder' ),
	    'js_template'  => '
			var temp = uix_pb_contactform1_code;
		'
    )
);

