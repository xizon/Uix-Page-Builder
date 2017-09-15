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
			'id'             => 'uix_pb_bar_shape',
			'title'          => esc_html__( 'Choose Style', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'circular',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'circular'  => 'circular',
									'square'  => 'square'
								),
			/* If the toggle of switch with radio is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
			                        array(
										'trigger_id'           => 'circular', /* {option id} */
										'toggle_class'         => array( ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' ),
										'toggle_remove_class'  => array( ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' )

									),
			                        array(
										'trigger_id'           => 'square', /* {option id} */
										'toggle_class'         => array( ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' ),
										'toggle_remove_class'  => array( ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' )

									),
						
									
				                )		
								
		),
		
			array(
				'id'             => 'uix_pb_bar_circular_size',
				'title'          => esc_html__( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 120,
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),
			
			array(
				'id'             => 'uix_pb_bar_square_size',
				'title'          => esc_html__( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 100,
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-units-text',
				'default'        => array(
										'units'      => array( '%', 'px' ),
										'units_id'    => 'uix_pb_bar_square_size_units',
										'units_value' => '%'
									)
			
			),	
			
		
	
		array(
			'id'             => 'uix_pb_bar_percent',
			'title'          => esc_html__( 'Percent', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 75,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),
	
		
		array(
			'id'             => 'uix_pb_bar_perc_icons_size',
			'title'          => esc_html__( 'Percentage & Icon Size', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 12,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),	
		
		array(
			'id'             => 'uix_pb_bar_linewidth',
			'title'          => esc_html__( 'Line Width', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),
		
		array(
			'id'             => 'uix_pb_bar_icon_toggle',
			'title'          => esc_html__( 'Icon', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Using Icon instead of percentage.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox',
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'    => '', /* {option id} */
									'toggle_class'  => array( ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class' )
				                )	
		
		
		),	
		
			array(
				'id'             => 'uix_pb_bar_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),	
			
		array(
			'id'             => 'uix_pb_bar_color',
			'title'          => esc_html__( 'Bar Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' )
		
		),
		

	
		array(
			'id'             => 'uix_pb_bar_trackcolor',
			'title'          => esc_html__( 'Track color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#f1f1f1',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' )
		
		),
	
		array(
			'id'             => 'uix_pb_bar_percent_icon_color',
			'title'          => esc_html__( 'Percentage & Icon Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#473f3f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' )
		
		),
		
	
	    array(
			'id'             => 'uix_pb_bar_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Title', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		),	
		
		
	    array(
			'id'             => 'uix_pb_bar_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
								)
		),	
		

		array(
			'id'             => 'uix_pb_bar_show_units',
			'title'          => esc_html__( 'Displayed Units', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '%',
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
		'title'        => esc_html__( 'Progress Bar', 'uix-page-builder' ),
	
	
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
	
			var  temp                                 = \'\',
				 uix_pb_bar_result_color              = uix_pb_bar_color,
				 uix_pb_bar_result_trackcolor         = uix_pb_bar_trackcolor,
				 uix_pb_bar_result_percent_icon_color = uix_pb_bar_percent_icon_color,
				 uix_pb_bar_result_size               = ( uix_pb_bar_shape == \'circular\' ) ? uixpbform_floatval( uix_pb_bar_circular_size )+"px" : uixpbform_floatval( uix_pb_bar_square_size )+uix_pb_bar_square_size_units,
				 uix_pb_bar_result_icon               = ( uix_pb_bar_icon != \'\' ) ? \'<i class="fa fa-\'+uixpbform_htmlEncode( uix_pb_bar_icon )+\'"></i>\' : uix_pb_bar_percent+uix_pb_bar_show_units;

			if ( uix_pb_bar_shape == \'square\' ) {


				temp += \'<div class="uix-pb-bar-box uix-pb-bar-box-square">\';
				temp += \'<div style="width:\'+uix_pb_bar_result_size+\';">\';
				temp += \'<div class="uix-pb-bar-info">\';
				temp += \'<h3 class="uix-pb-bar-title">\'+uix_pb_bar_title+\'</h3>\';
				temp += \'<div class="uix-pb-bar-desc">\'+uixpbform_format_textarea_entering( uix_pb_bar_desc )+\'</div>\';
				temp += \'</div>\';
				temp += \'<div class="uix-pb-bar" data-percent="\'+uixpbform_floatval( uix_pb_bar_percent )+\'" data-linewidth="\'+uixpbform_floatval( uix_pb_bar_linewidth )+\'" data-trackcolor="\'+uix_pb_bar_result_trackcolor+\'" data-barcolor="\'+uix_pb_bar_result_color+\'" data-units="\'+uixpbform_htmlEncode( uix_pb_bar_show_units )+\'" data-size="\'+uix_pb_bar_result_size+\'" data-icon="\'+uixpbform_htmlEncode( uix_pb_bar_icon )+\'">\';
				temp += \'<span class="uix-pb-bar-percent"></span>\';
				temp += \'<span class="uix-pb-bar-placeholder">0</span>\';
				temp += \'<span class="uix-pb-bar-text"  style="color:\'+uix_pb_bar_result_percent_icon_color+\';font-size:\'+uixpbform_floatval( uix_pb_bar_perc_icons_size )+\'px;">\'+uix_pb_bar_result_icon+\'</span>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';



			} else {

				temp += \'<div class="uix-pb-bar-box uix-pb-bar-box-circular">\';
				temp += \'<div class="uix-pb-bar" data-percent="\'+uixpbform_floatval( uix_pb_bar_percent )+\'" style="width:\'+uix_pb_bar_result_size+\';">\';
				temp += \'<span class="uix-pb-bar-percent" data-linewidth="\'+uixpbform_floatval( uix_pb_bar_linewidth )+\'" data-trackcolor="\'+uix_pb_bar_result_trackcolor+\'" data-barcolor="\'+uix_pb_bar_result_color+\'" data-units="\'+uixpbform_htmlEncode( uix_pb_bar_show_units )+\'" data-size="\'+uix_pb_bar_result_size+\'"  data-icon="\'+uixpbform_htmlEncode( uix_pb_bar_icon )+\'" style="color:\'+uix_pb_bar_result_percent_icon_color+\';font-size:\'+uixpbform_floatval( uix_pb_bar_perc_icons_size )+\'px;"></span>\';
				temp += \'</div>\';
				temp += \'<h3 class="uix-pb-bar-title">\'+uix_pb_bar_title+\'</h3>\';
				temp += \'<div class="uix-pb-bar-desc">\'+uixpbform_format_textarea_entering( uix_pb_bar_desc )+\'</div>\';
				temp += \'</div>\';


			}
		'
    )
);

