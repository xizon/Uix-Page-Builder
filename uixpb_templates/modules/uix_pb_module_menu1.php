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
			'id'             => 'uix_pb_menu1_class',
			'title'          => esc_html__( 'Class Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'uix-pb-menu-fixed',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		array(
			'id'             => 'uix_pb_menu1_id',
			'title'          => esc_html__( 'Select a Menu', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => UixPageBuilder::get_frontend_all_menus()

		),
	

		
	    array(
			'id'             => 'uix_pb_menu1_id_tipinfo',
			'desc'           => wp_kses( sprintf( __( 'Uix Page Builder supports the automatic addition of Anchor Links. <a href="%1$s" target="_blank">Manage Your Menus</a>', 'uix-page-builder' ), esc_url( admin_url( 'nav-menus.php' ) ) ), wp_kses_allowed_html( 'post' ) ),
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
		'title'        => esc_html__( 'Fixed Menu', 'uix-page-builder' ),
	
	
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
		
		    var custom_class = uix_pb_menu1_class + \' uix-pb-section-nospace\';
		
			var temp = \'[uix_pb_menu classname=\\\'\'+custom_class+\'\\\' id=\\\'\'+uixpbform_htmlEncode( uix_pb_menu1_id )+\'\\\']\';
		
		
		'
    )
);

