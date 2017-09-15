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
			'id'             => 'uix_pb_parallax_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'

		),

		array(
			'id'             => 'uix_pb_parallax_titlecolor',
			'title'          => '',
			'desc'           => '',
			'value'          => '#999999',
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	


		array(
			'id'             => 'uix_pb_parallax_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '<span style="color:#999999;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Teneo, inquit, finem illi videri nihil dolere. Esse enim, nisi eris, non potes.</span>', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 5
								)

		),

		array(
			'id'             => 'uix_pb_parallax_skew',
			'title'          => esc_html__( 'Skew', 'uix-page-builder' ),
			'desc'           => wp_kses( __( 'Suggest values: <strong>-10</strong> &nbsp;to&nbsp;<strong>10</strong>.', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'deg'
								)

		),
		
		

		
	    array(
			'id'             => 'uix_pb_parallax_height',
			'title'          => esc_html__( 'Height', 'uix-page-builder' ),
			'desc'           => esc_html__( 'If the value is "0", the height is automatically calculated.', 'uix-page-builder' ),
			'value'          => 300,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => array( 'px', 'vh' ),
									'units_id'    => 'uix_pb_parallax_height_units',
									'units_value' => 'px'
								)
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_parallax_speed',
			'title'          => esc_html__( 'Parallax', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'    => 'uix_pb_parallax_speed_units',
									'units'       => '',
									'min'         => -10,
									'max'         => 10,
									'step'        => 0.1
				                )
		
		),	
		
		array(
			'id'             => 'uix_pb_parallax_bg_color',
			'title'          => esc_html__( 'Background Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	
		
		
		
		array(
			'id'             => 'uix_pb_parallax_bg',
			'title'          => esc_html__( 'Background Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( UixPBFormCore::cover_placeholder() ),
			'placeholder'    => '',
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
								)
		
		),	
			
	    array(
			'id'             => 'uix_pb_parallax_bg_attachment',
			'title'          => '',
			'desc'           => '',
			'value'          => 'fixed',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'fixed'  => 'fixed',
									'scroll'  => 'scroll',
				                )
		
		),
		
		
		array(
			'id'             => 'uix_pb_parallax_bg_space',
			'title'          => esc_html__( 'Seamless Display', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Set the parallax module top & bottom margin to be 0px for your page.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),

	
		array(
			'id'             => 'uix_pb_parallax_button_checkbox_toggle',
			'title'          => esc_html__( 'Link Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => '', /* {option id} */
									'toggle_class'  => array(
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_btn_color' ).'_class', 
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url' ).'_class', 
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text' ).'_class' ,
										''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text_tipinfo' ).'_class' ,
	                                 ),
									
									/* if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid . */
									/*
									'toggle_not_class'  => array()
									*/
									
				                )	
		
		
		),	
		
		
		array(
			'id'             => 'uix_pb_parallax_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#ffffff',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_btn_color' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe',  '#ffffff' )
		
		),
		

		array(
			'id'             => 'uix_pb_parallax_url',
			'title'          => esc_html__( 'Destination URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url' ).'_class', /*class of toggle item */
			'placeholder'    => esc_html__( 'http://', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''

		),	

		array(
			'id'             => 'uix_pb_parallax_url_text',
			'title'          => esc_html__( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text' ).'_class', /*class of toggle item */
			'value'          => esc_html__( 'Check Out', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'default'        => ''

		),		
		
	    array(
			'id'             => 'uix_pb_parallax_url_text_tipinfo',
			'desc'           => wp_kses( __( 'Valid when the value of <strong>"Destination URL"</strong> is not empty', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text_tipinfo' ).'_class', /*class of toggle item */
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
		'title'        => esc_html__( 'Parallax', 'uix-page-builder' ),

	
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
		 *    $( {index}+'<?php echo UixPBFormCore::fid( $colid, $sid, '{controlID}' ); ?>' ).val()
		 *  
		 *  ---------------------------------
		 *     {index}      @var Number      ->  Index value, For example: 2-, 3-, 4-, 5-, ...
		 *     {controlID}  @var String      ->  The ID of a control.
		 */
	    'js_template'             => '

			//Converts from radians to degrees.
			var skewToPx           = Math.abs( ( uixpbform_floatval( uix_pb_parallax_skew ) * 180 / Math.PI )/2 ),
				skewDeg            = uixpbform_floatval( uix_pb_parallax_skew ),
				skewDeg2           = -( skewDeg ),
				skew_css           = ( uix_pb_parallax_skew != 0 ) ? \'margin-top: -\'+skewToPx+\'px;margin-bottom:\'+skewToPx+\'px;-webkit-transform: skew(0deg, \'+skewDeg+\'deg); transform: skew(0deg, \'+skewDeg+\'deg);\' : \'\',
				skew_content_style = ( uix_pb_parallax_skew != 0 ) ? \'style="-webkit-transform: skew(0deg, \'+skewDeg2+\'deg); transform: skew(0deg, \'+skewDeg2+\'deg);"\' : \'\',
				skew_class         = ( uix_pb_parallax_skew != 0 ) ? \'skew\' : \'\',
				btncolor           = uixpbform_colorTran( uix_pb_parallax_btn_color );


			var bg_pos_1      = ( uix_pb_parallax_speed > 0 ) ? \'50%\' : \'top\',
				bg_pos_2      = ( uix_pb_parallax_speed > 0 ) ? 0 : \'left\',
				bgcolor       =  ( uix_pb_parallax_bg_color != undefined && uix_pb_parallax_bg_color != \'\' ) ? uixpbform_htmlEncode( uix_pb_parallax_bg_color ) : \'transparent\',
				speed         = ( uix_pb_parallax_speed > 0 ) ? \'fixed\' : uixpbform_htmlEncode( uix_pb_parallax_bg_attachment ),
				bgimage_css   = ( uix_pb_parallax_bg != undefined && uix_pb_parallax_bg != \'\' ) ? \'style="\'+skew_css+\'background: \'+bgcolor+\' url(\'+encodeURI( uix_pb_parallax_bg )+\') \'+bg_pos_1+\' \'+bg_pos_2+\' no-repeat \'+speed+\';"\' : \'style="\'+skew_css+\'background-color:\'+bgcolor+\';"\',
				title         =  ( uix_pb_parallax_titlecolor != undefined && uix_pb_parallax_titlecolor != \'\' ) ? \'<span style="color:\'+uixpbform_htmlEncode( uix_pb_parallax_titlecolor )+\';">\' + uix_pb_parallax_title + \'</span>\' : uix_pb_parallax_title,
				desc          =  uix_pb_parallax_desc,
				space_class   =  ( uix_pb_parallax_bg_space === true ) ? \'uix-pb-section-nospace\' : \'\',
				button =  ( uix_pb_parallax_url != undefined && uix_pb_parallax_url != \'\' ) ? \'<p><a class="uix-pb-btn uix-pb-btn-\'+btncolor+\'" href="\'+encodeURI( uix_pb_parallax_url )+\'">\'+uix_pb_parallax_url_text+\'</a></p>\' : \'\';
				
				
			var title_show = ( uix_pb_parallax_title != undefined && uix_pb_parallax_title != \'\' ) ? \'<h2>\'+title+\'</h2>\' : \'\';
			var height_auto = ( uix_pb_parallax_height == 0 ) ? \'uix-pb-parallax-table-auto\' : \'\';


			var blankspace_class = \'\';
			if ( title_show == \'\' && desc == \'\' ) {
			    blankspace_class = \'blankspace\';
				skew_class       = \'\';
			}


			var temp = \'\';
				temp += \'<div class="uix-pb-parallax-wrapper uix-pb-parallax \'+space_class+\' \'+skew_class+\' \'+blankspace_class+\'" \'+bgimage_css+\' data-parallax="\'+uix_pb_parallax_speed+\'">\';
				temp += \'<div class="uix-pb-parallax-table \'+height_auto+\'" style="height:\'+uixpbform_floatval( uix_pb_parallax_height )+\'\'+uixpbform_htmlEncode( uix_pb_parallax_height_units )+\'">\';
				temp += \'<div class="uix-pb-parallax-content-box" \'+skew_content_style+\'>\';
				temp += title_show;
				temp += desc;
				temp += button;
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';

		'
    )
);
