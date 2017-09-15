<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Returns each variable in module data
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::get_module_data_vars( basename( __FILE__, '.php' ) );
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
			'id'             => 'uix_pb_sidebar_id',
			'title'          => esc_html__( 'Select Sidebar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => UixPageBuilder::get_frontend_all_sidebars()

		),

		
	    array(
			'id'             => 'uix_pb_sidebar_id_tipinfo',
			'desc'           => wp_kses( sprintf( __( 'Calls each of the active widget callbacks in order, which prints the markup for the sidebar. <a href="%1$s" target="_blank">Customize Your Sidebar</a>', 'uix-page-builder' ), esc_url( admin_url( 'widgets.php' ) ) ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
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
		'title'        => esc_html__( 'WP Sidebar', 'uix-page-builder' ),
	
	
		/**
		 * /////////////// Customizing HTML output on the frontend /////////////// 
		 * 
		 * 
		 * Usage:
		 *
		 * 1) Written as pure JavaScript syntax.
		 * 2) Please push the value of final output to the JavaScript variable "temp", For example: var temp = '...';
		 * 3) Be sure to note the escape of quotation marks and slashes.
		 * 4) Directly use the controls ID as a JavaScript variable as the value for each control.
		 * 5) Value of controls with dynamic form need to use, For example:
		 *    $( '{index}<?php echo UixPBFormCore::fid( $colid, $sid, '{controlID}' ); ?>' ).val();
		 *  
		 *  ---------------------------------
		 *     {index}      @var Number      ->  Index value and starting with 2, For example: 2-, 3-, 4-, 5-, ...
		 *     {controlID}  @var String      ->  The ID of a control.
		 */
	    'js_template'             => '
		
			var temp = \'[uix_pb_sidebar id=\\\'\'+uixpbform_htmlEncode( uix_pb_sidebar_id )+\'\\\']\';
		
		
		'
    )
);

