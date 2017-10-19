<?php
/**
 * Returns each variable in module data
 *
 * @param  {boolean or array} $arr[ 'clone' ]     - Whether there is a clone form, and its parameters.
 * @param  {string} $arr[ 'form_id' ]             - The form ID (Obtained via module ID).
 * @param  {string} $arr[ 'title' ]               - The form title (Obtained via module title).
 * @param  {string} $arr[ 'fields' ]              - All fields of each control.
 * @param  {string} $arr[ 'template' ]            - -> HTML code.
 *
 * @access public
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPBFormCore_Components_FormScripts extends UixPBFormCore {

	/**
	 * Parameters for current form.
	 *
	 * @access private
	 *
	 */
	private $arr;
	
	public function __construct( $arr ) {
		
		$this->arr = $arr;
		
		$this -> output();
	}

	
	private function output() {
		
		$arr = $this->arr;
	
		if ( 
			is_array( $arr ) &&
			isset( $arr[ 'title' ] ) &&
			isset( $arr[ 'form_id' ] ) &&
			isset( $arr[ 'fields' ] ) &&
			isset( $arr[ 'template' ] )
			
		   ) {
		

			$clone            = isset( $arr[ 'clone' ] ) ? $arr[ 'clone' ] : '';
			$title            = $arr[ 'title' ];
			$form_id          = $arr[ 'form_id' ];
			$fields_args      = $arr[ 'fields' ];
			$form_template    = $arr[ 'template' ];
			$wname            = esc_html__( 'Section', 'uix-page-builder' ); //Current widget name of section.
			$multi_columns    = false;
			$field_ids        = ''; //All form control IDs
			$form_tags    = new UixPBFormCore_Components_Wrapper( $wname, $form_id );
			
			if ( is_array( $fields_args ) ) {
		
				
				//Determine whether the form control is a multi-column combination
				foreach( $fields_args as $v ) :
				
					if ( isset( $v[ 'title' ] ) && !empty( $v[ 'title' ] ) ) {
						$multi_columns = true;
						break;
					}
				endforeach;		
				
				
				
				//Add new form controls 
				//Added to the template properties to use JavaScript to find
				foreach( $fields_args as $v ) :
				
					if ( isset( $v[ 'values' ] ) && !empty( $v[ 'values' ] ) ) {
						
						foreach( $v[ 'values' ] as $field ) :  
						    if ( isset( $field[ 'id' ] ) && !empty( $field[ 'id' ] ) ) {
								
								if ( $field[ 'type' ] != 'margin-padding' ) {
									$field_ids .= $field[ 'id' ].',';
								}
								
								
								if ( $field[ 'type' ] == 'image' ) {
									
									if ( isset( $field[ 'default' ] ) && is_array( $field[ 'default' ] ) ) {
										if ( 
											isset( $field[ 'default' ][ 'prop_value' ] ) &&
											is_array( $field[ 'default' ][ 'prop_value' ] ) && 
											!empty( $field[ 'default' ][ 'prop_value' ] )
										  ) {
											$field_ids .= $field[ 'id' ].'_repeat,';
											$field_ids .= $field[ 'id' ].'_position,';
											$field_ids .= $field[ 'id' ].'_attachment,';
											$field_ids .= $field[ 'id' ].'_size,';
										}	
										
										
									}
									

								}
								
								
								if ( $field[ 'type' ] == 'margin-padding' ) {
									$field_ids .= $field[ 'id' ].'_top,';
									$field_ids .= $field[ 'id' ].'_right,';
									$field_ids .= $field[ 'id' ].'_bottom,';
									$field_ids .= $field[ 'id' ].'_left,';
								}	
								
								if ( $field[ 'type' ] == 'short-units-text' ) {
									$field_ids .= $field[ 'id' ].'_units,';
								}		
								
								
								if ( $field[ 'type' ] == 'color' ) {
									
									if ( isset( $field[ 'callback' ] ) && $field[ 'callback' ] == 'color-name' ) {
										$field_ids .= $field[ 'id' ].'_name,';
									}
								
								}	
								
								if ( $field[ 'type' ] == 'text' ) {
									
									if ( isset( $field[ 'callback' ] ) && $field[ 'callback' ] == 'attr' ) {
										$field_ids .= $field[ 'id' ].'_attr,';
									}
									
									if ( isset( $field[ 'callback' ] ) && $field[ 'callback' ] == 'slug' ) {
										$field_ids .= $field[ 'id' ].'_slug,';
									}
								
								}	
							
								if ( $field[ 'type' ] == 'textarea' ) {
									
									if ( isset( $field[ 'callback' ] ) && $field[ 'callback' ] == 'attr' ) {
										$field_ids .= $field[ 'id' ].'_attr,';
									}
								
								}	
								
								
								
								if ( $field[ 'type' ] == 'short-text' ) {
									
									if ( isset( $field[ 'callback' ] ) && $field[ 'callback' ] == 'number-deg_px' ) {
										$field_ids .= $field[ 'id' ].'_deg_px,';
									}
									
								}		
								
								
							} 
						endforeach;
						
					}
						
				
				endforeach;
				
			}
			
			
			$form_html        = '<div id="uixpbform-form-all-field-ids-'.$form_id.'" data-field-ids="'.$field_ids.'"></div>';
			$form_html       .= '<script type="text/x-jquery-tmpl" id="module_tmpl__'.$form_id.'">';
			$last_fields_args = end( $fields_args ); //Determine whether to add a template form
			

			if ( is_array( $fields_args ) ) {
		
				if ( $multi_columns ) $form_html .= $form_tags -> form_before();
				
				foreach( $fields_args as $v ) :
					$column_title = '';
					if ( isset( $v[ 'title' ] ) && !empty( $v[ 'title' ] ) ) {
						$column_title  = $v[ 'title' ];
					}
					
				
					//------- template textarea
					if( $v == $last_fields_args ) {
						 // 'you can do something here as this condition states it just entered last element of an array'; 
						array_push( $v[ 'values' ], array(
													'id'             => $form_id.'_temp',
													'title'          => '',
													'desc'           => '',
													'value'          => '',
													'placeholder'    => '',
													'type'           => 'textarea',
													'default'        => array(
																			'hide'          => true,
							                                                'frontend_tmpl' => true,
							
																		)
											)
						);	
						
					}
				
				
				    $form_controls = new UixPBFormCore_Components_Controls( $wname, $form_id, $v[ 'type' ], $v[ 'values' ], 'html', $column_title );
					$form_html    .= $form_controls -> output();
				
				endforeach;
			
				
				
				if ( $multi_columns ) $form_html .= $form_tags -> form_after();
				$form_html .= '</script>';
				
				
				//Clone controls of list item (Fire this template when the clone button is clicked.)
				$form_html .= $this -> push_clone_controls_tmpl( $clone, $form_html, $form_id, false, $fields_args  );
				
				//Clone controls of list item (Fire this template when the clone data is loaded.)
				$form_html .= $this -> push_clone_controls_tmpl( $clone, $form_html, $form_id, true, $fields_args );
				

			}
			

			// ---------- Returns actions of javascript
			if ( is_admin() ) {
				if( UixPageBuilder::page_builder_mode() ) {
					?>
					
					<script type="text/javascript">
					( function($) {
					'use strict';
						$( document ).ready( function() {  
							<?php echo $this -> uixpbform_callback( $form_id, $title ); ?>

						} ); 
					} ) ( jQuery );
					</script>

					<?php

				}

			}

			
	
			// ---------- Returns form using template
			if ( is_admin() ) {
				if( UixPageBuilder::page_builder_mode() ) {
				
					echo $form_html;
					
					?>
					<script type="text/x-jquery-tmpl" id="frontend_module_tmpl__<?php echo esc_attr( $form_id ); ?>">
						<?php echo self::str_compression( $form_template ); ?>
					</script>
					<?php	
					
				}

			}

			

		}
	

	}
	
	
	/*
	 * Push the clone controls template
	 *
	 *
	 * @param  {boolean or array} $clone    - Whether there is a clone form, and its parameters.
	 * @param  {string} $form_html          - Form the HTML code.
	 * @param  {string} $form_id            - Form of module ID via ajax
	 * @param  {boolean} $load              - When it is true, the existing clone data is loaded without the click trigger.
     * @param  {string} $fields             - All fields of each control. 
	 * @return {string}                     - HTML code.
	 *
	 */
	private function push_clone_controls_tmpl( $clone, $form_html, $form_id, $load = false, $fields = null ) {
		
		$result = '';
		
		if ( is_array( $clone ) ) {

			$clone_fields                = $clone[ 'fields' ];
			$clone_trigger_id            = $clone[ 'trigger_id' ];
			$clone_fields_value          = '';
			$clone_multi_fields          = array();
			$clone_multi_trigger_id      = '';
			
			
			//-------- Multiple columns are used to clone event
			if ( is_array( $clone_trigger_id ) ) {
				
				foreach( $clone_trigger_id as $key => $value ) :
				
				   $clone_multi_fields_value = '';
				
				   if ( isset( $clone_fields[$key] ) ) {
					   $clone_multi_fields     = $clone_fields[$key];
					   $clone_multi_trigger_id = $clone_trigger_id[$key];
					   $clone_formID_index     = $key + 1;
					   
						if ( $load ) {
							$result  .= '<script type="text/x-jquery-tmpl" id="module_tmpl_clone_load__'.$form_id.'-'.$clone_formID_index.'">';
							$result  .= '{{each '.$clone_multi_trigger_id.'__fieldID}}';
						} else {
							$result  .= '<script type="text/x-jquery-tmpl" id="module_tmpl_clone_click__'.$form_id.'-'.$clone_formID_index.'">';
						}

						$result .= '<span class="dynamic-row dynamic-addnow">';

						foreach( $clone_multi_fields as $name ) :

					        
							if ( $load ) {
								$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'', $form_html, false );
							} else {
								$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'', $form_html, true );
							}


							//The extended controls
							if ( is_array( $fields ) ) {


								foreach( $fields as $v ) :


									if ( isset( $v[ 'values' ] ) && !empty( $v[ 'values' ] ) ) {

										foreach( $v[ 'values' ] as $field ) :  

											//Check the current clone control ID
											if ( isset( $field[ 'id' ] ) && $field[ 'id' ] == $name ) {

												if ( $field[ 'type' ] == 'image' ) {

													if ( isset( $field[ 'default' ] ) && is_array( $field[ 'default' ] ) ) {
														if ( 
															isset( $field[ 'default' ][ 'prop_value' ] ) &&
															is_array( $field[ 'default' ][ 'prop_value' ] ) && 
															!empty( $field[ 'default' ][ 'prop_value' ] )
														  ) {
															if ( $load ) {
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_repeat', $form_html, false );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_position', $form_html, false );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_attachment', $form_html, false );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_size', $form_html, false );
															} else {
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_repeat', $form_html, true );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_position', $form_html, true );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_attachment', $form_html, true );
																$clone_multi_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_size', $form_html, true );
															}
														}

													}


												}

											} 
										endforeach;

									}


								endforeach;

							}	




						endforeach;

						$result .= $clone_multi_fields_value;

						//Add a delete button
						$result .= '<div class="delrow-container"><a href="javascript:" class="delrow delrow-${colID} __removeCloneClass__">&times;</a></div>';
						$result .= '</span>';

						if ( $load ) {
							$result .= '{{/each}}';
						}

						$result .= '</script>';	 
					   
					   
				   }
				
				endforeach;
				
			}

			
			//--------Each form group has only one clone event
			if ( is_string( $clone_trigger_id ) ) {
				
				$result = '';
				
				if ( $load ) {
					$result  .= '<script type="text/x-jquery-tmpl" id="module_tmpl_clone_load__'.$form_id.'">';
					$result  .= '{{each '.$clone_trigger_id.'__fieldID}}';
				} else {
					$result  .= '<script type="text/x-jquery-tmpl" id="module_tmpl_clone_click__'.$form_id.'">';
				}

				$result .= '<span class="dynamic-row dynamic-addnow">';

				foreach( $clone_fields as $name ) :

					if ( $load ) {
						$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'', $form_html, false );
					} else {
						$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'', $form_html, true );
					}


					//The extended controls
					if ( is_array( $fields ) ) {


						foreach( $fields as $v ) :


							if ( isset( $v[ 'values' ] ) && !empty( $v[ 'values' ] ) ) {

								foreach( $v[ 'values' ] as $field ) :  

									//Check the current clone control ID
									if ( isset( $field[ 'id' ] ) && $field[ 'id' ] == $name ) {

										if ( $field[ 'type' ] == 'image' ) {

											if ( isset( $field[ 'default' ] ) && is_array( $field[ 'default' ] ) ) {
												if ( 
													isset( $field[ 'default' ][ 'prop_value' ] ) &&
													is_array( $field[ 'default' ][ 'prop_value' ] ) && 
													!empty( $field[ 'default' ][ 'prop_value' ] )
												  ) {
													if ( $load ) {
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_repeat', $form_html, false );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_position', $form_html, false );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_attachment', $form_html, false );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_size', $form_html, false );
													} else {
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_repeat', $form_html, true );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_position', $form_html, true );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_attachment', $form_html, true );
														$clone_fields_value .= $this -> dynamic_form_controls_code( 'dynamic-row-'.$name.'_size', $form_html, true );
													}
												}

											}


										}

									} 
								endforeach;

							}


						endforeach;

					}	




				endforeach;

				$result .= $clone_fields_value;

				//Add a delete button
				$result .= '<div class="delrow-container"><a href="javascript:" class="delrow delrow-${colID} __removeCloneClass__">&times;</a></div>';
				$result .= '</span>';

				if ( $load ) {
					$result .= '{{/each}}';
				}

				$result .= '</script>';
				
			}	
			
			
			
		}	
		
		return $result;
		
	}
	

	
	
	/*
	 * Returns dynamic form controls
	 *
	 *
	 * @param  {string} $class              - Current control class name.
	 * @param  {string} $str                - HTML dode of current control.
	 * @param  {boolean} $constant_value    - Use the value of the default form when using the button to trigger cloning to add new data
	 * @return {string}                     - HTML code.
	 *
	 */
	private function dynamic_form_controls_code( $class, $str, $constant_value ) {
		
		 $searcharray[ 'list_str' ] = array(
			   '__fieldID}',           //ID
			   '<td>',
			   '</td>'


		  );
		  $replacearray[ 'list_str' ] = array(
			   '__fieldID}__index__',
			   '',
			   ''
		  );  

		 if ( $str ) {

			 $v = $str;


			 //Extract HTML code of the clone form
			 if ( preg_match_all( '/<tr.*?'.$class.'.*?>(.*?)<\/tr>/is', $v, $match ) ) {
				 $v = str_replace( $searcharray[ 'list_str' ], $replacearray[ 'list_str' ], $match[1][0] );
			 }

			 $v = preg_replace( '/<th.*?<\/th>/', '', $v );



			 //Use the value of the default form when using the button to trigger cloning to add new data
			 if ( $constant_value ) {


				 //textarea
				 if ( preg_match( '/\>{{if.*?{{\/if}}\</s', $v, $match1 ) ) {

					  $old_v1 = $match1[0];
					  preg_match( '/{{else}}.*?{{\/if}}/', $old_v1, $match2 );
					  $new_v1 = str_replace( '{{else}}', '',
							   str_replace( '{{/if}}', '', 
							   $match2[0] 
							  ) );

					  $v = str_replace( $old_v1, '>'.$new_v1.'<', $v );

				 }

				 //text input
				 if ( preg_match( '/"{{if.*?{{\/if}}"/s', $v, $match1_2 ) ) {

					  $old_v2 = $match1_2[0];
					  preg_match( '/{{else}}.*?{{\/if}}/', $old_v2, $match2_2 );
					  $new_v2 = str_replace( '{{else}}', '',
							   str_replace( '{{/if}}', '', 
							   $match2_2[0] 
							  ) );

					  $v = str_replace( $old_v2, '"'.$new_v2.'"', $v );

				 }	 

			 }


			 return self::str_compression( $v );
		 } else {
			return '';
		 }
			
	}
	


	
	/*
	 * Returns the default pop-up initialization program
	 *
	 *
	 * @param  {string} $form_id             - The form ID (Obtained via module ID).
	 * @param  {string} $title               - The form title (Obtained via module title).
	 * @return {string}                      - JavaScript code.
	 *
	 */
	private function uixpbform_callback( $form_id, $title ) {
		
		$id         = get_the_ID();
		$old_formid = $form_id;
		$formid     = '.'.$old_formid.'';
		$postid     = empty( $id ) ? $_GET['post_id'] : $id;
		$title      = esc_attr( $title );


		return "if( $.isFunction( $.fn.UixPBFormPop ) ){ $(document).UixPBFormPop({postID:'{$postid}',trigger:'{$formid}',title:'{$title}'}); }; ";

	}
	
	
}

