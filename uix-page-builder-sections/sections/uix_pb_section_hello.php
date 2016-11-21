<?php
/**
 * Form ID
 */
$form_id = 'uix_pb_section_hello';

/**
 * Form Type
 */
$form_type = [
    'list' => false
];

$args = 
	[
		array(
			'desc'           => __( 'Note: 3 items per row.Per section insert "for a maximum of 3".', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_text',
			'title'          => __( 'Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	    array(
			'id'             => 'uix_pb_radio',
			'title'          => __( 'Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'boy',
									'2'  => 'girl',
									'3'  => 'private',
				                )
		
		),

	    array(
			'id'             => 'uix_pb_slider',
			'title'          => __( 'Slider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'  => 'uix_pb_slider_units',
									'units'  => 'px',
									'min'   => 1,
									'max'   => 20,
									'step'  => 1
				                )
		
		),
		
		
		array(
			'id'             => 'uix_pb_paddingdis',
			'title'          => __( 'Padding (px)', 'uix-page-builder' ),
			'desc'           => __( 'Use the input fields below to customize the padding of your column shortcode. Measurement units is pixels (px).', 'uix-page-builder' ),
			'value'          => array(
									'top'  => 20,
									'right'  => 0,
									'bottom'  => 20,
									'left'  => 0
				                ),
			'placeholder'    => '',
			'type'           => 'margin',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),


		
		array(
			'id'             => 'uix_pb_textarea',
			'title'          => __( 'Textarea', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_textarea_2',
			'title'          => __( 'Textarea(by default value)', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => false,
									'default_value_htmlformat'  => true,
									'default_value_trigger'     => $form_id
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_image',
			'title'          => __( 'Upload Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									
									/* Show image properties 
									 * Javascript Vars:
									 
									   {item id}_repeat
									   {item id}_position
									   {item id}_attachment
									   {item id}_size
									*/
									//'prop'  => true,
				                )
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_shorttext',
			'title'          => __( 'Short Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
	    array(
			'id'             => 'uix_pb_shortunitstext',
			'title'          => __( 'Short Units Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'  => [ 'px', 'em', '%' ],
									'units_id'  => 'uix_pb_shortunitstext_units'
				                )
		
		),
		
		//------toggle begin
		array(
			'id'             => 'uix_pb_toggle',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'toggle',
			'default'        => array(
			                        //'btn_textclass' => 'table-link-attr',
			                        'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
									'toggle_class'  => [ 'uix_pb_toggle_url_class', 'uix_pb_toggle_url2_class', 'uix_pb_toggle_urlalign_class' ]
				                )
		
		),	

			array(
				'id'             => 'uix_pb_toggle_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row uix_pb_toggle_url_class', /*class of toggle item */
				'placeholder'    => __( 'Toggle URL', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''
			
			),
			
			array(
				'id'             => 'uix_pb_toggle_url2',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row uix_pb_toggle_url2_class',/*class of toggle item */
				'placeholder'    => __( 'Toggle URL2', 'uix-page-builder' ),
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 3,
										'format'  => true
									)
			
			),
	
			
			
		
		//------toggle end
		
		
		
		array(
			'id'             => 'uix_pb_single_color',
			'title'          => __( 'Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#333333',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' ]
		
		),
		array(
			'id'             => 'uix_pb_select',
			'title'          => __( 'Select', 'uix-page-builder' ),
			'desc'           => __( 'This is infomation.', 'uix-page-builder' ),
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_multiselect',
			'title'          => __( 'Multiple Selector', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => [ '1', '3' ], //It takes a variable like [ ]  if the value is empty.
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
			'id'             => 'uix_pb_icon',
			'title'          => __( 'This is Icon Selector ', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'icon',
			'default'        => array(
			                        'social'  => false
				                )
		
		),
			
		
		array(
			'id'             => 'uix_pb_colormap',
			'title'          => __( 'Color Map', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'rgb(162, 63, 3)',
			'placeholder'    => '',
			'type'           => 'colormap'
		
		
		),	
		array(
				'id'             => 'uix_pb_colormap2',
				'title'          => __( 'Color Map', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
									'swatches' => 1
								)

		),	
		
		
		array(
			'id'             => 'uix_pb_checkbox',
			'title'          => __( 'Checkbox', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => false
				                )
		
		
		),	
		
		array(
			'id'             => 'uix_pb_checkbox_toggle',
			'title'          => __( 'Toggle for Checkbox', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => true
				                ),
			/* if show the target item, the target id require class like "toggle-row toggle-row-show" */
			'toggle'        => array(
									'trigger_id'  => 'uix_pb_checkbox_toggle', /* {item id}-{option id} */
									'toggle_class'  => [ 'uix_pb_checkbox_toggle_text_class' ],
									
									/* if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid . */
									/*
									'toggle_not_class'  => [ '' ]
									*/
									
				                )	
		
		
		),	
		
			array(
				'id'             => 'uix_pb_checkbox_toggle_text',
				'title'          => '',
				'desc'           => '',
				'value'          => 1,
				'class'          => 'toggle-row toggle-row-show uix_pb_checkbox_toggle_text_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),	
			
		


		
		//------list begin
		array(
			'id'             => 'uix_pb_list',
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_imgURL',
											'type'      => 'image'
										), 
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_imgtitle',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_imgicon',
											'type'      => 'icon'
										), 
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_radio',
											'type'      => 'radio'
										), 
										
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_color',
											'type'      => 'color'
										), 									
										
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_colormap',
											'type'      => 'colormap'
										), 										
										array(
											'id'        => 'dynamic-row-uix_pb_listitem_shorttext',
											'type'      => 'short-text'
										), 										
										
										array(
											'id'              => 'dynamic-row-uix_pb_listitem_toggle',
											'type'            => 'toggle',
											'toggle_class'    => [ 'dynamic-row-uix_pb_listitem_toggle_url', 'dynamic-row-uix_pb_listitem_toggle_icon' ]
										), 									
										
										

									 ],
									'max'                       => 3
				                )
									
		),
		
			array(
				'id'             => 'uix_pb_listitem_imgURL',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_imgURL', /*class of list item */
				'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
		
		
			array(
				'id'             => 'uix_pb_listitem_imgtitle',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_imgtitle', /*class of list item */
				'placeholder'    => __( 'Text', 'uix-page-builder' ),
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_listitem_imgicon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_imgicon', /*class of list item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => true
									)
			
			),
			
			array(
				'id'             => 'uix_pb_listitem_radio',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_radio', /*class of list item */
				'placeholder'    => '',
				'type'           => 'radio',
				'default'        => array(
										'1'  => 'boy',
										'2'  => 'girl',
										'3'  => 'private',
				                )
			
			),
			
				
			array(
				'id'             => 'uix_pb_listitem_color',
				'title'          => '',
				'desc'           => '',
				'value'          => '#f5f5dc',
				'class'          => 'dynamic-row-uix_pb_listitem_color', /*class of list item */
				'placeholder'    => '',
				'type'           => 'color',
				'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c' ]
			
			),	
			
			array(
				'id'             => 'uix_pb_listitem_colormap',
				'title'          => '',
				'desc'           => '',
				'value'          => 'rgb(162, 63, 3)',
				'class'          => 'dynamic-row-uix_pb_listitem_colormap', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			
			),	
			
			array(
				'id'             => 'uix_pb_listitem_shorttext',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_shorttext', /*class of list item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),
			
			
			//------toggle begin
			array(
				'id'             => 'uix_pb_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_listitem_toggle', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => [ 'dynamic-row-uix_pb_listitem_toggle_url', 'dynamic-row-uix_pb_listitem_toggle_icon' ]
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_listitem_toggle_url',
					'title'          => '',
					'desc'           => __( 'Note: 3 items per row.Per section insert "for a maximum of 3".', 'uix-page-builder' ),
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-uix_pb_listitem_toggle_url', /*class of toggle item */
					'placeholder'    => __( 'Toggle URL', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_listitem_toggle_icon',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-uix_pb_listitem_toggle_icon',/*class of toggle item */
					'placeholder'    => '',
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),

			
			//------toggle end
			
			
					
		
		
		//------list end
		
	
		

		
	
		

	]
;

$form_html = UixPageBuilder::add_form( $form_id, $form_type, $args, 'html' );
$form_js = UixPageBuilder::add_form( $form_id, $form_type, $args, 'js' );
$form_js_vars = UixPageBuilder::add_form( $form_id, $form_type, $args, 'js_vars' );

/**
 * Add simulation buttons
 */
echo UixPageBuilder::add_form( $form_id, '', '', 'active_btn' );
?>		


<script type="text/javascript">

( function($) {
    
	$( document ).ready( function() {
		
		/* List Item ( step 1) */
		var dynamic_append_box_content = '<?php echo UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_imgURL', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_imgtitle', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_imgicon', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_radio', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_color', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_colormap', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_shorttext', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_toggle', $form_html, 'toggle' ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_toggle_url', $form_html, 'toggle-row' ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_listitem_toggle_icon', $form_html, 'toggle-row' ); ?>';
		
	
		
		 /* Callback before custom javascript of sweetalert */
		<?php echo UixPageBuilder::sweetalert_before( $form_js, $form_html, $form_js_vars, $form_id, __( 'Demo Form 1', 'uix-page-builder' ) ); ?>
		
	
				/* List Item ( step 2)  */
		        var list_num = 3;
				
		
				var show_list_item = '';
				for ( var i=0; i<=list_num; i++ ){
					
			        var _uid = ( i == 0 ) ? '#' : '#'+i+'-',
					    _txt = $( _uid+'uix_pb_listitem_imgtitle' ).val(),
					    _img = $( _uid+'uix_pb_listitem_imgURL' ).val(),
						_icon = $( _uid+'uix_pb_listitem_imgicon' ).val(),
						_radio = $( _uid+'uix_pb_listitem_radio' ).val(),
						_color = $( _uid+'uix_pb_listitem_color' ).val(),
						_colormap = $( _uid+'uix_pb_listitem_colormap' ).val(),
						_shorttext = $( _uid+'uix_pb_listitem_shorttext' ).val(),
						_toggle_url = $( _uid+'uix_pb_listitem_toggle_url' ).val(),
						_toggle_icon = $( _uid+'uix_pb_listitem_toggle_icon' ).val();
						
					
					
					if ( _txt != undefined )  show_list_item += _txt;   
					if ( _img != undefined ) show_list_item += '( Image URL: '+_img+' )';   
					if ( _icon != undefined ) show_list_item += '( Icon: '+_icon+' )';   
					if ( _radio != undefined ) show_list_item += '( Radio: '+_radio+' )';   
					if ( _color != undefined ) show_list_item += '( Color: '+_color+' )';   
					if ( _colormap != undefined ) show_list_item += '( Custom Color : '+_colormap+' )';   
					if ( _shorttext != undefined ) show_list_item += '( Units Txt : '+_shorttext+' )';   
					if ( _toggle_url != undefined ) show_list_item += '( Toggle URL : '+_toggle_url+' )';   
					if ( _toggle_icon != undefined ) show_list_item += '( Toggle Icon : '+_toggle_icon+' )';   
						
					
				}
				
				
				/* Multiple Selector */
				var multiselectorArr = uix_pb_multiselect.split( ',' ),
				    show_checkboxes = '';
				for ( var k=0; k < multiselectorArr.length; k++ ) {
					
					
					switch( multiselectorArr[k] ){ 
						case '1': 
						    show_checkboxes += 'student+';
							
						break; 
						
						case '2': 
						    show_checkboxes += 'teacher+';
						
						break; 
						
						case '3': 
						    show_checkboxes += 'manager+';
						
						break; 	
						
						case '4': 
						    show_checkboxes += 'children+';
						
						break; 				
						
						default: 

					}
					
				}
		
	
				/* Checkbox */
				var show_checkbox = '';
				if ( uix_pb_checkbox === true ){
					show_checkbox = '(checked)';
				}
				
			
				/* Output */
				_vhtml = '';
				_vhtml += '<hr>Text: '+uix_pb_text;
				_vhtml += '<hr>Textarea: '+uix_pb_textarea;
				_vhtml += '<hr>Short Text: <br>'+uix_pb_shorttext;
				_vhtml += '<hr>Short Units Text: '+uix_pb_shortunitstext+uix_pb_shortunitstext_units;
				_vhtml += '<hr>Select: '+uix_pb_select;
				_vhtml += '<hr>Upload Image: '+uix_pb_image;
				_vhtml += '<hr>Toggle URL: '+uix_pb_toggle_url;
				_vhtml += '<hr>Icon: '+uix_pb_icon;
				_vhtml += '<hr>Radio: '+uix_pb_radio;
				_vhtml += '<hr>Slider: '+uix_pb_slider+uix_pb_slider_units;
				_vhtml += '<hr>Color Map Value: '+uix_pb_colormap;
				_vhtml += '<hr>Multiple Checkboxes: '+show_checkboxes;
				_vhtml += '<hr>Padding: '+uix_pb_paddingdis_top+','+uix_pb_paddingdis_right+','+uix_pb_paddingdis_bottom+','+uix_pb_paddingdis_left;
				
				
				
				//---
				_vhtml += '<hr>List Item: '+show_list_item;
				_vhtml += '<hr>Checkbox: '+show_checkbox+'<br>';
			

				<?php echo UixPageBuilder::send_to_editor_before( $form_id ); ?> "<div class='demo'>" + _vhtml + "</div>" <?php echo UixPageBuilder::send_to_editor_after(); ?>
				
				
				
		   /* Callback after custom javascript of sweetalert */
		  <?php echo UixPageBuilder::sweetalert_after(); ?>
				


	} ); 

	
	
} ) ( jQuery );

</script>
