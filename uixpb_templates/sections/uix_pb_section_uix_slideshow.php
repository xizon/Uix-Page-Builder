<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Require the WP plugin "Uix Slideshow"
 * ----------------------------------------------------
 */
if ( !class_exists( 'UixSlideshow' ) ) {
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
			'id'             => 'uix_pb_uix_slideshow_code',
			'title'          => esc_html__( 'Shortcode & Content', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '[uix_slideshow_output show="-1"]',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
	
	    array(
			'id'             => 'uix_pb_uix_slideshow_tipinfo',
			'desc'           => wp_kses( sprintf( __( 'You can install a slider plugin you want. Such as <a href="%1$s" target="_blank">Uix Slideshow</a> When you\'re done, copy shortcode and paste into the editor. <strong>You can change Show Number of Uix Slideshow for shortcode [uix_slideshow_output] .</strong>', 'uix-page-builder' ), esc_url( 'https://wordpress.org/plugins/uix-slideshow/' ) ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'warning'  //error, success, warning, note
				                ),
		
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
		'title'        => esc_html__( 'Uix Slideshow', 'uix-page-builder' ),
	    'js_template'  => '
			var temp = uix_pb_uix_slideshow_code;
		'
    )
);

