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
 * Clone parameters
 * ----------------------------------------------------
 */
$clone_trigger_id        = 'uix_pb_hello_triggerclonelist';  // String of clone trigger ID, must contain at least "_triggerclonelist"
$clone_max               = 4;                               // Maximum of clone form 
               


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
			'id'             => 'uix_pb_hello_tipinfo',
			'desc'           => wp_kses( sprintf( __( 'You can custom the boxed width of the container for Uix Page Builder stylesheets. <a target="_blank" href="%1$s">click here to custom</a>', 'uix-page-builder' ), esc_url( admin_url( 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css' ) ) ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'note'  //error, success, warning, note, default
				                ),
		
		),	
		
	
	    array(
			'id'             => 'uix_pb_hello_dividingline',
			'title'          => esc_html__( 'Image Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'solid',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'solid'     => UixPBFormCore::plug_directory() .'images/line/line-style-1.png',
									'double'    => UixPBFormCore::plug_directory() .'images/line/line-style-2.png',
									'dashed'    => UixPBFormCore::plug_directory() .'images/line/line-style-3.png',
									'dotted'    => UixPBFormCore::plug_directory() .'images/line/line-style-4.png',
									'shadow'    => UixPBFormCore::plug_directory() .'images/line/line-style-5.png',
									'gradient'  => UixPBFormCore::plug_directory() .'images/line/line-style-6.png',
									
				                )
		
		),
	
	    array(
			'id'             => 'uix_pb_hello_radioswitch_style',
			'title'          => esc_html__( 'Radio Switch', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'grand-fill-yellow',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'grand-fill-yellow'   => UixPBFormCore::plug_directory() .'images/heading/heading-style-1.jpg',
									'grand'               => UixPBFormCore::plug_directory() .'images/heading/heading-style-2.jpg',
				                ),
		
			/* Add the "toggle" field to enable the radio switch */
			'toggle'        => array(
			                        array(
										'trigger_id'        => 'grand-fill-yellow', /* The value of radio */
										'target_ids'        => array( 'uix_pb_hello_radioswitch_fillbg' ) /* Associated control ID */

									),
			                        array(
										'trigger_id'        => 'grand', /* The value of radio */
										'target_ids'        => array( '' ) /* Associated control ID */

									),
									
				                )
								
		
		),
			
			array(
				'id'             => 'uix_pb_hello_radioswitch_fillbg',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Image for Text Fill', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
	

		array(
			'id'             => 'uix_pb_hello_text',
			'title'          => esc_html__( 'Text', 'uix-page-builder' ),
			'desc'           => esc_html__( 'This is infomation.', 'uix-page-builder' ),
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_hello_text2}
				${uix_pb_hello_text2_attr}
			 *
			*/
			'id'             => 'uix_pb_hello_text2',
			'title'          => esc_html__( 'Text Attr', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'attr',
		
		),
		
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_hello_text3}
				${uix_pb_hello_text3_slug}
			 *
			*/
			'id'             => 'uix_pb_hello_text3',
			'title'          => esc_html__( 'Text Slug', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'slug',
		
		),
		
		
		/*
	    array(
			'id'             => 'uix_pb_hello_radio',
			'title'          => esc_html__( 'Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'man',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'boy'   => 'Boy',
									'girl'  => 'Girl',
									'man'   => 'Man',
								),
			//Add the "toggle" field to enable the radio switch
			'toggle'        => array(
			                        array(
										'trigger_id'        => 'boy', //The value of radio
										'target_ids'        => array( 'uix_pb_hello_radio_toggle_item1' ) //Associated control ID

									),
			                        array(
										'trigger_id'        => 'girl', //The value of radio
										'target_ids'        => array( 'uix_pb_hello_radio_toggle_item2' ) //Associated control ID

									),
			                        array(
										'trigger_id'        => 'man', //The value of radio
										'target_ids'        => array( '' ) //Associated control ID

									),
									
				                )	
		
		),
		*/
		
	    array(
			'id'             => 'uix_pb_hello_radio',
			'title'          => esc_html__( 'Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'boy',
									'2'  => 'girl',
									'3'  => 'private',
				                )
		
		),

	    array(
			'id'             => 'uix_pb_hello_slider',
			'title'          => esc_html__( 'Slider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'units'       => 'px',
									'min'         => 1,
									'max'         => 20,
									'step'        => 1
				                )
		
		),
		
		
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_hello_paddingdis_top}
				${uix_pb_hello_paddingdis_right}
				${uix_pb_hello_paddingdis_bottom}
				${uix_pb_hello_paddingdis_left}
			 *
			*/
			'id'             => 'uix_pb_hello_paddingdis', 
			'title'          => esc_html__( 'Padding (px)', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Use the input fields below to customize the padding of your column shortcode. Measurement units is pixels (px).', 'uix-page-builder' ),
			'value'          => array(
									'top'     => 20,
									'right'   => 0,
									'bottom'  => 20,
									'left'    => 0
				                ),
			'placeholder'    => '',
			'type'           => 'margin-padding',
		    'callback'       => 'number',
		
		),
		
		array(
			'id'             => 'uix_pb_hello_editor',
			'title'          => esc_html__( 'Editor', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'height'     => 200
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_hello_textarea',
			'title'          => esc_html__( 'Textarea(by default value)', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => wp_kses( __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row' => 5
				                )
		
		),
		
		
		array(
			/*
			 * @template vars: 
			 *
				${uix_pb_hello_textarea2}
				${uix_pb_hello_textarea2_attr}
			 *
			*/
			'id'             => 'uix_pb_hello_textarea2',
			'title'          => esc_html__( 'Textarea(by default value)', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'attr',
			'default'        => array(
									'row' => 3
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_hello_image',
			'title'          => esc_html__( 'Upload Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									//'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
									//'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
	
									/*
									 * Activate the image properties when the image URL is not empty.
									 *
									 * @template vars: 
									 *
										${uix_pb_hello_image_repeat}
										${uix_pb_hello_image_position}
										${uix_pb_hello_image_attachment}
										${uix_pb_hello_image_size}
									 *
									*/
									'prop_value'  => array(
														'repeat'      => 'no-repeat', 
														'position'    => 'left', 
														'attachment'  => 'scroll', 
														'size'        => 'cover' 
													),
				                )
		
		),	

		
	    array(
			'id'             => 'uix_pb_hello_shorttext',
			'title'          => esc_html__( 'Short Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
	    array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_hello_shortunitstext}
				${uix_pb_hello_shortunitstext_units}
			 *
			*/
			'id'             => 'uix_pb_hello_shortunitstext',
			'title'          => esc_html__( 'Short Units Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-units-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'       => array( 'px', 'em', '%' ),
									'units_value' => 'px',
				                )
		
		),
		
		//--- Toggle of unidirectional display (begin)
		array(
			'id'             => 'uix_pb_hello_toggle',
			'title'          => '',
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'toggle',
			'toggle'         => array(
		                            'btn_textclass' => 'table-link-icon',
			                        'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
									'target_ids'    => array( 'uix_pb_hello_toggle_url' )
				                )
		
		),	

			array(
				'id'             => 'uix_pb_hello_toggle_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Toggle URL', 'uix-page-builder' ),
				'type'           => 'text',
				'callback'       => 'url',
			
			),
			
			
		
		//--- Toggle of unidirectional display (end)
		
		
		
		array(
			'id'             => 'uix_pb_hello_single_color',
			'title'          => esc_html__( 'Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#f5f5dc',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' )
		
		),
		
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_hello_single_color2}
				${uix_pb_hello_single_color2_name}
			 *
			*/
			'id'             => 'uix_pb_hello_single_color2',
			'title'          => esc_html__( 'Button Color(name)', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
	     	'callback'       => 'color-name',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_hello_select',
			'title'          => esc_html__( 'Select', 'uix-page-builder' ),
			'desc'           => esc_html__( 'This is infomation.', 'uix-page-builder' ),
			'value'          => 2,
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_multiselect',
			'title'          => esc_html__( 'Multiple Selector', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '1,3', //It takes a variable like '1,3'  if the value is empty.
			'placeholder'    => '',
			'type'           => 'multiselect',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager',
									'4'  => 'children'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_icon',
			'title'          => esc_html__( 'This is Icon Selector ', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'icon',
			'default'        => array(
			                        'social'  => false
				                )
		
		),
			
		
		array(
			'id'             => 'uix_pb_hello_colorpicker',
			'title'          => esc_html__( 'Color Picker', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'color-picker'
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_checkbox',
			'title'          => esc_html__( 'Checkbox', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, //0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		array(
			'id'             => 'uix_pb_hello_checkbox_toggle',
			'title'          => esc_html__( 'Switch', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'         => array(
				                    'target_ids'  => array( 'uix_pb_hello_checkbox_toggle_text' )
				                )
		
		
		),	
		
			array(
				'id'             => 'uix_pb_hello_checkbox_toggle_text',
				'title'          => '',
				'desc'           => '',
				'value'          => 555,
				'placeholder'    => '',
				'type'           => 'short-text',
		        'callback'       => 'number',
				'default'        => array(
										'units'  => 'px'
									)
			
			),	
			
		

	
		
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
				'id'             => 'uix_pb_hello_listitem_imgURL',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => esc_html__( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image'
			
			),	
		
		
			array(
				'id'             => 'uix_pb_hello_listitem_imgtitle',
				'title'          => '',
				'desc'           => '',
				'value'          => esc_html__( 'Image Title', 'uix-page-builder' ),
				'placeholder'    => esc_html__( 'Text', 'uix-page-builder' ),
				'type'           => 'text',
				'callback'       => 'html',
			
			),
			
			//--- Toggle of unidirectional display (begin)
			array(
				'id'             => 'uix_pb_hello_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'placeholder'    => '',
				'type'           => 'toggle',
				'toggle'         => array(
										'btn_text'      => esc_html__( 'set up links with toggle', 'uix-page-builder' ),
										'target_ids'    => array( 'uix_pb_hello_listitem_toggle_url', 'uix_pb_hello_listitem_toggle_icon' )
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_hello_listitem_toggle_url',
					'title'          => '',
					'desc'           => '',
					'value'          => esc_url( '#' ),
					'placeholder'    => esc_html__( 'Toggle URL', 'uix-page-builder' ),
					'type'           => 'text',
				    'callback'       => 'html',
				
				),
				array(
					'id'             => 'uix_pb_hello_listitem_toggle_icon',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => '',
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),

			
			//--- Toggle of unidirectional display (end)
			
		
			//------ Toggle of switch with checkbox (begin)
			array(
				'id'             => 'uix_pb_hello_listitem_switch',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'placeholder'    => '',
				'type'           => 'checkbox',
				'toggle'         => array(
										'target_ids'  => array( 'uix_pb_hello_listitem_sw_test' )
									)

			),


				array(
					'id'             => 'uix_pb_hello_listitem_sw_test',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'placeholder'    => esc_html__( 'Switch Demo', 'uix-page-builder' ),
					'type'           => 'text',
					'callback'       => 'html', 

				),		


			//------ Toggle of switch with checkbox (end)

			
					
		
		
		//------ Clone controls list (end)
		
	
	

	)
;

/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
		'clone'        => array(
								'trigger_id'     => $clone_trigger_id,
								'fields'         => array( 
														'uix_pb_hello_listitem_imgURL',
														'uix_pb_hello_listitem_imgtitle', 
														'uix_pb_hello_listitem_toggle', 
														'uix_pb_hello_listitem_toggle_url', 
														'uix_pb_hello_listitem_toggle_icon', 
														'uix_pb_hello_listitem_switch', 
														'uix_pb_hello_listitem_sw_test' 
													)
							),
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'     => $form_type,
								 'values'   => $args
							),

						),
		'title'                   => esc_html__( 'Form Demo 1', 'uix-page-builder' ),
	
	
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
		


			<h4>Text:</h4> ${uix_pb_hello_text}
			<hr><h4>Textarea:</h4> ${uix_pb_hello_textarea}
			...

            <hr>
            <h4>List:</h4>
			
            <ul>

				<!-- loop start -->

					{{each '.$clone_trigger_id.'}}
						{{if uix_pb_hello_listitem_imgtitle != ""}}

							<li>${uix_pb_hello_listitem_imgtitle} <img src="${uix_pb_hello_listitem_imgURL}" alt="" width="50" height="50"></li>

						{{/if}}

					{{/each}}	

				<!-- loop end -->	
			
			</ul>


		'
    )
);


