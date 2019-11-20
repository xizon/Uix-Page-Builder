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
 * Form Type & Controls
 * ----------------------------------------------------
 */
$form_type = array(
    'list' => false
);


$args = 
	array(
	


		array(
			'id'             => 'uix_pb_parallax_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '<h2><span style="color: #e8e8e8;">Text Here</span></h2>
<p><span style="color: #999999;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Teneo, inquit, finem illi videri nihil dolere. Esse enim, nisi eris, non potes.</span></p>', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 5
								)

		),

		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_parallax_skew}
				${uix_pb_parallax_skew_deg_px}
			 *
			*/
			'id'             => 'uix_pb_parallax_skew',
			'title'          => esc_html__( 'Skew', 'uix-page-builder' ),
			'desc'           => wp_kses( __( 'Suggest values: <strong>-10</strong> &nbsp;to&nbsp;<strong>10</strong>.', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number-deg_px', 
			'default'        => array(
									'units'  => 'deg'
								)

		),
		
		

		
	    array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_parallax_height}
				${uix_pb_parallax_height_units}
			 *
			*/
			'id'             => 'uix_pb_parallax_height',
			'title'          => esc_html__( 'Height', 'uix-page-builder' ),
			'desc'           => esc_html__( 'If the value is "0", the height is automatically calculated.', 'uix-page-builder' ),
			'value'          => 300,
			'placeholder'    => '',
			'type'           => 'short-units-text',
		    'callback'       => 'number', 
			'default'        => array(
									'units'      => array( 'px', 'vh' ),
									'units_value' => 'px'
								)
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_parallax_speed',
			'title'          => esc_html__( 'Parallax', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Recommended value: -10.00 to 10.00', 'uix-page-builder' ),
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number', 
			'default'        => array(
									'units'  => ''
								)
		
		),	
		
		array(
			'id'             => 'uix_pb_parallax_bg_color',
			'title'          => esc_html__( 'Background Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'color-picker'


		),	
		
		
		
		array(
			'id'             => 'uix_pb_parallax_bg',
			'title'          => esc_html__( 'Background Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( UixPBFormCore::cover_placeholder() ),
			'placeholder'    => '',
			'type'           => 'image'
		
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
		
	
		//------ Toggle of switch with checkbox (begin)
		array(
			'id'             => 'uix_pb_parallax_button_toggle',
			'title'          => esc_html__( 'Link Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'         => array(
									'target_ids'  => array( 
														'uix_pb_parallax_btn_color', 
														'uix_pb_parallax_url', 
														'uix_pb_parallax_url_text', 
														'uix_pb_parallax_url_text_tipinfo' 
													)
								)

		),
		
		
			array(
				/*
				 * @template vars: 
				 *
					${uix_pb_parallax_btn_color}
					${uix_pb_parallax_btn_color_name}
				 *
				*/
				'id'             => 'uix_pb_parallax_btn_color',
				'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '#ffffff',
				'placeholder'    => '',
				'type'           => 'color',
				'callback'       => 'color-name',
				'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe',  '#ffffff' )

			),


			array(
				'id'             => 'uix_pb_parallax_url',
				'title'          => esc_html__( 'Destination URL', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'http://', 'uix-page-builder' ),
				'type'           => 'text',
				'callback'       => 'url', 

			),	

			array(
				'id'             => 'uix_pb_parallax_url_text',
				'title'          => esc_html__( 'Link Text', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => esc_html__( 'Check Out', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
				'callback'       => 'html', 

			),		

			array(
				'id'             => 'uix_pb_parallax_url_text_tipinfo',
				'desc'           => wp_kses( __( 'Valid when the value of <strong>"Destination URL"</strong> is not empty', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
				'type'           => 'note',
				'default'        => array(
										'fullwidth'  => false,
										'type'       => 'default'  //error, success, warning, note, default
									),

			),	
		
		//------ Toggle of switch with checkbox (end)
		

	
	)
;

/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'        => false,
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'     => $form_type,
								 'values'   => $args
							),

						),
		'title'        => esc_html__( 'Parallax', 'uix-page-builder' ),

	
	
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
		
			<div class="uix-pb-parallax-wrapper uix-pb-parallax {{if uix_pb_parallax_skew != 0 && uix_pb_parallax_desc != ""}}skew{{/if}} {{if uix_pb_parallax_desc == ""}}blankspace{{/if}}" {{if uix_pb_parallax_bg != ""}}style="{{if uix_pb_parallax_skew != 0}}margin-top: -${uix_pb_parallax_skew_deg_px}px;margin-bottom:${uix_pb_parallax_skew_deg_px}px;-webkit-transform: skew(0deg, ${uix_pb_parallax_skew}deg); transform: skew(0deg, ${uix_pb_parallax_skew}deg);{{/if}}background: {{if uix_pb_parallax_bg_color != ""}}${uix_pb_parallax_bg_color}{{else}}transparent{{/if}} url(${uix_pb_parallax_bg}) {{if uix_pb_parallax_speed > 0}}50%{{else}}top{{/if}} {{if uix_pb_parallax_speed > 0}}0{{else}}left{{/if}} no-repeat {{if uix_pb_parallax_speed > 0}}fixed{{else}}${uix_pb_parallax_bg_attachment}{{/if}};"{{else}}style="{{if uix_pb_parallax_skew != 0}}margin-top: -${uix_pb_parallax_skew_deg_px}px;margin-bottom:${uix_pb_parallax_skew_deg_px}px;-webkit-transform: skew(0deg, ${uix_pb_parallax_skew}deg); transform: skew(0deg, ${uix_pb_parallax_skew}deg);{{/if}}background-color:{{if uix_pb_parallax_bg_color != ""}}${uix_pb_parallax_bg_color}{{else}}transparent{{/if}};"{{/if}} data-parallax="${uix_pb_parallax_speed}">
				<div class="uix-pb-parallax-table {{if uix_pb_parallax_height == 0}}uix-pb-parallax-table-auto{{/if}}" style="height:${uix_pb_parallax_height}${uix_pb_parallax_height_units}">
					<div class="uix-pb-parallax-content-box" {{if uix_pb_parallax_skew != 0}}style="-webkit-transform: skew(0deg, -${uix_pb_parallax_skew}deg); transform: skew(0deg, -${uix_pb_parallax_skew}deg);"{{/if}}>
						${uix_pb_parallax_desc}

						{{if uix_pb_parallax_button_toggle == 1}}
							<p><a class="uix-pb-btn uix-pb-btn-${uix_pb_parallax_btn_color_name}" href="${uix_pb_parallax_url}">${uix_pb_parallax_url_text}</a></p>
						{{/if}}
					</div>
				</div>
			</div>

		'
	
    )
);
