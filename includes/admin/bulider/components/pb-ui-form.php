<?php
/**
 * Form javascripts output when in ajax or default state
 * 
 * @access public
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPB_Components_FormScripts extends UixPageBuilder {

	/**
	 * Each module's set of parameters for current form.
	 *
	 * @access private
	 * @var array
	 */
	private $arr;
	
	public function __construct( $arr ) {
		
		$this->arr = $arr;
		echo $this -> output();
		
	}
	
	private function output() {
		
		$arr = $this->arr;
	
		if ( is_array( $arr ) && sizeof( $arr ) >= 8 ) {
		
			//basic
			$title            = $arr[ 'title' ];
			$wname            = ( isset( $arr[ 'widget_name' ] ) ) ? $arr[ 'widget_name' ] : __( 'Section', 'uix-page-builder' );
			$form_id          = $arr[ 'form_id' ];
			$colid            = $arr[ 'column_id' ];
			$sid              = $arr[ 'section_id' ];
			$fields_args      = $arr[ 'fields' ];
			$form_js_template = $arr[ 'js_template' ];
			$defalt_value     = $arr[ 'defalt_value' ];
			$multi_columns    = false;
			$form_html        = '';
			$form_js_vars     = '';
			$last_fields_args = end( $fields_args ); //Determine whether to add a template form

			

			
			if ( is_array( $fields_args ) ) {
				
			
				foreach( $fields_args as $v ) :
					if ( isset( $v[ 'title' ] ) && !empty( $v[ 'title' ] ) ) {
						$multi_columns = true;
						break;
						
					}
				endforeach;
				
				if ( $multi_columns ) $form_html .= UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
				
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
																			'hide' => true,
							                                                'tmpl' => true,
							
																		)
											)
						);	
						
					}
						
				
					$form_html .= UixPBFormCore::add_form( $v[ 'config' ], $colid, $wname, $sid, $form_id, $v[ 'type' ], $v[ 'values' ], 'html', $column_title );
					
					$form_js_vars .= UixPBFormCore::add_form( $v[ 'config' ], $colid, $wname, $sid, $form_id, $v[ 'type' ], $v[ 'values' ], 'js_vars' );
	
				endforeach;
				
				
				
				
				if ( $multi_columns ) $form_html .= UixPBFormCore::form_after();
				

			}
			
			
			
			//clone
			$clone                       = $arr[ 'clone' ];
			$clone_enable                = false;
			$clone_trigger_id            = '';
			$clone_max                   = 1;
			$clone_list_toggle_class     = '';
			$clone_fields_group          = '';
		

			if ( is_array( $clone ) && sizeof( $clone ) >= 2 ) {
				$clone_enable                = true;
				$clone_fields_group          = $clone[ 'fields_group' ];
				$clone_list_toggle_class     = $clone[ 'list_toggle_class' ];

				if ( isset( $clone[ 'max' ] ) ) {
					$clone_max = $clone[ 'max' ];
				}
	
			}



			// ---------- Returns actions of javascript
			if ( $sid == -1 && is_admin() ) {
				if( self::page_builder_mode() ) {
					if ( is_admin()) {


						//List Item - Register clone vars ( step 1)
						if ( $clone_enable && is_array( $clone_fields_group ) ) {
						
							foreach( $clone_fields_group as $v ) :
								
								$clone_fields        = $v[ 'fields' ];
								$clone_trigger_id    = $v[ 'trigger_id' ];
								$clone_fields_value  = '';
								
								
								foreach( $clone_fields as $name ) :
									
									$toggle = '';
									if( self::inc_str( $name, '_toggle' ) && !self::inc_str( $name, '_toggle_' ) ) {
										$toggle = 'toggle';
									}
									if( self::inc_str( $name, '_toggle_' ) ) {
										$toggle = 'toggle-row';
									}								
									
									$clone_fields_value .= UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, $name ).'', $form_html, $toggle );
							
								endforeach;

								UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_fields_value );
								
							endforeach;
						
						}


						?>
						<script type="text/javascript">
						( function($) {
						'use strict';
							$( document ).ready( function() {  
								<?php echo UixPBFormCore::uixpbform_callback( $form_id, $title ); ?>

							} ); 
						} ) ( jQuery );
						</script>

						<?php


					}
				}

			}


			// ---------- Returns form with ajax
			if ( $sid >= 0 && is_admin() ) {
				echo $form_html;

				// Dynamic Adding Input ( Default Value ) ( step 2)
				if ( $clone_enable && is_array( $clone_fields_group ) ) {

					foreach( $clone_fields_group as $v ) :
	
						$required_field     = $v[ 'required' ];
						$clone_fields       = $v[ 'fields' ];
						$clone_trigger_id   = $v[ 'trigger_id' ];
						
						if ( !isset( $v[ 'required' ] ) ) {
							$required_field = $clone_fields[0];
						}

						
						for ( $i = 2; $i <= $clone_max; $i++ ) {

							$uid                = $i.'-';
							$clone_fields_value = '';

							foreach( $clone_fields as $name ) :
								
								$toggle = '';
								if( self::inc_str( $name, '_toggle' ) && !self::inc_str( $name, '_toggle_' ) ) {
									$toggle = 'toggle';
								}
								if( self::inc_str( $name, '_toggle_' ) ) {
									$toggle = 'toggle-row';
								}		
								
								$clone_fields_value .= UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, $name ).'', $form_html, $toggle );
							
							endforeach;
							
							if ( is_array( $defalt_value ) && array_key_exists( '['.$colid.']'.$uid.'['.$required_field.']['.$sid.']', $defalt_value ) ) {

								$cur_id = $i;

								$clone_scripts = $this -> push_cloneform( $uid, $defalt_value, $clone_trigger_id, $cur_id, $colid, $clone_fields_value, $sid, $clone_fields, $clone_list_toggle_class );
								
								echo $clone_scripts;
								

							} 
						} //end for
					
					endforeach;


				}


				?>

				<script type="text/javascript">
				( function($) {
				'use strict';
					$( document ).ready( function() {

						function uix_pb_temp() {

							/* Vars */
							<?php echo $form_js_vars; ?>

							/* Template */
							<?php echo $form_js_template; ?>

							/* Save all HTML code (include shortcode) for a single module, the necessary JavaScript variable: temp */
							$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
							
							/* Render HTML Viewport */
							$( document ).UixPBRenderHTML({ divID: '#<?php echo self::frontend_wrapper_id( '', $sid, $colid ); ?>', value: temp });

						}
						
						uix_pb_temp();
						$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], .addrow-<?php echo $colid; ?>, .delrow-<?php echo $colid; ?>", function() { 
							uix_pb_temp();
						});


					} ); 
				} ) ( jQuery );
				</script> 

				<?php	
			}
	
			
		}
	

	}
	
	
	
	/*
	 * Push the clone form of saved data
	 *
	 *
	 * $uid                        @var string      -> Form of module ID via ajax
	 * $items	                    @var array       -> The value of all the "form" items for each module
	 * $clone_trigger_id           @var string      -> The trigger ID of the clone button
	 * $cur_id                     @var string      -> The index value of the current clone form
	 * $col_id		                @var string      -> The column ID of each module
	 * $clone_value                @var HTML code   -> The form code has been cloned
	 * $section_row                @var string      -> The section ID.
	 * $value                      @var array       -> The value of all the "cloned form" items for each module
	 * $clone_list_toggle_classes  @var string      -> The trigger class name of the clone form
	 *
	 */
	private function push_cloneform( $uid, $items, $clone_trigger_id, $cur_id, $col_id, $clone_value, $section_row, $value, $clone_list_toggle_classes = '' ) {
		
		//Toggle class
		$clone_list_toggle_class = '';
		if ( $clone_list_toggle_classes && is_array( $clone_list_toggle_classes ) ) {
			
			foreach ( $clone_list_toggle_classes as $t_value ) {
				$clone_list_toggle_class .= '#{colID}'.UixPBFormCore::fid( $col_id, $section_row, $t_value ).',';
			}
			$clone_list_toggle_class = rtrim( $clone_list_toggle_class, ',' );
		}
		
		//Widget ID
		$widget_ID         = $section_row;
		
		//Toggle target ID
		$toggle_target_ID  = str_replace( '{colID}', $cur_id.'-', $clone_list_toggle_class );
		
		
	    //Initialize clone content
		$new_clone_value = preg_replace_callback(
			'|chk-id-input="(.*?)"|',
			function ( $matches ) {
				return $matches[0].' {temp}';
			},
			$clone_value
		);
		
		$new_clone_value = preg_replace_callback(
			'|chk-id-textarea="(.*?)"|',
			function ( $matches ) {
				return $matches[0].' {temp}';
			},
			$new_clone_value
		);		
		
		$new_clone_value = preg_replace_callback(
			'|\{temp\} value="(.*?)"|',
			function ( $matches ) {
				return '';
			},
			$new_clone_value
		);

		$new_clone_value = preg_replace_callback(
			'|\{temp\}>(.*?)</textarea>|',
			function ( $matches ) {
				return '';
			},
			$new_clone_value
		);

		
		
		//Clone content
		$data = '<span class="dynamic-row dynamic-addnow">'.$new_clone_value.'<div class="delrow-container"><a href="javascript:" class="delrow delrow-'.$col_id.' delrow-'.$clone_trigger_id.'-'.$col_id.'" data-spy="'.$clone_trigger_id.'__'.$col_id.'">&times;</a></div></span>';
	
			 
		//Clone code
		$data = str_replace( '{index}', '['.$widget_ID.']',
		       str_replace( 'data-id="', 'id="'.$cur_id.'-',
			   str_replace( 'chk-id-input="', 'chk-id-input="'.$cur_id.'-',
			   str_replace( 'chk-id-textarea="', 'chk-id-textarea="'.$cur_id.'-',
			   str_replace( '][uix', ']'.$cur_id.'-[uix',
			   str_replace( '{dataID}', ''.$cur_id.'-',
			   str_replace( '{multID}', $toggle_target_ID,
			   str_replace( '{columnid}', $col_id,
			   str_replace( '{colID}', ''.$cur_id.'-'.str_replace( 'col-item-', 'section_'.$widget_ID.'__', $col_id ),
			   str_replace( 'data-insert-img="{colID}', 'data-insert-img="'.$cur_id.'-',
			   str_replace( 'data-insert-preview="{colID}', 'data-insert-preview="'.$cur_id.'-',
			   $data 
			   ) ) ) ) ) ) ) ) ) ) );
		
		
		//Toggle elements
		$data = str_replace( 'uixpbform_btn_trigger-toggleshow open', 'uixpbform_btn_trigger-toggleshow',
			   $data 
			   );		
		
		
		//Default value
		if ( $value && is_array( $value ) ) {
			foreach ( $value as $t_value ) {
				
				$item_id    = $uid.UixPBFormCore::fid( $col_id, $section_row, $t_value );
				$item_value = self::inputtextareavalue( $items[ '['.$col_id.']'.$uid.'['.$t_value.']['.$section_row.']' ] );
			
				
				if ( self::inc_str( $data, 'chk-id-input="'.$item_id.'"' ) ) {
					$data = str_replace( 'chk-id-input="'.$item_id.'"', 'value="'.esc_attr( $item_value ).'"', $data );	
				}
				if ( self::inc_str( $data, 'chk-id-textarea="'.$item_id.'"' ) ) {
					$data = str_replace( 'chk-id-textarea="'.$item_id.'"', '>'.esc_textarea( $item_value ).'</textarea>', $data );	
				}			
				

			}	
		}
		
		
		
		//Clone list classes
		$data = str_replace( 'data-list="0"', 'data-list="1"',
			   str_replace( 'toggle-row', 'toggle-row toggle-row-clone-list',
			   $data 
			   ) );
			   	   
		return "<script type='text/javascript'>jQuery(document).ready(function(){ jQuery( 'a[data-targetid=\"".$clone_trigger_id."\"]' ).uixpbform_dynamicFormInit({cloneCode:'{$data}'}); });</script>";
		
	}


}

