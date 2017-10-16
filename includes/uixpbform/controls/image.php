<?php
class UixPBFormType_Image extends UixPBFormCore {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$name             = ( isset( $args[ 'name' ] ) ) ? $args[ 'name' ] : '';
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		$cls              = ( isset( $args[ 'class' ] ) ) ? $args[ 'class' ] : '';
		$class            = self::call_row_class( $id, $cls );
		$callback         = ( isset( $args[ 'callback' ] ) ) ? self::control_callback_type( $args[ 'callback' ] ) : '';
		
		$field       = '';
		
        if ( $type == 'image' ) {
            
            //Enqueue the media scripts
            wp_enqueue_media();
                                
            $remove_btn_text = esc_html__( 'Remove image', 'uix-page-builder' );
            $upload_btn_text = esc_html__( 'Upload', 'uix-page-builder' );
			$image_prop = false;
            if ( isset( $default ) && is_array( $default ) ) {
				
                if ( isset( $default[ 'remove_btn_text' ] ) ) $remove_btn_text = $default[ 'remove_btn_text' ];
                if ( isset( $default[ 'upload_btn_text' ] ) ) $upload_btn_text = $default[ 'upload_btn_text' ];
				
				//Image properties
				if ( 
					isset( $default[ 'prop_value' ] ) &&
				    is_array( $default[ 'prop_value' ] ) && 
					!empty( $default[ 'prop_value' ] )
				  ) {
					$image_prop = true;	
				}				
				
				
            }
			
     
            $field .= '
			
			
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    
							<div class="uixpbform-box">
							
							  
								<div class="uixpbform-upbtn-container">
									
							
									
									 <input type="text" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" class="uixpbform-normal uixpbform-input-text uixpbform-input-upload-text" data-enter-value="true" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" placeholder="'.$placeholder.'">
									
									'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
									
									
									<input type="button" class="button uixpbform-upbtn uixpbform_btn_trigger-upload" data-insert-prop="'.( $image_prop ? 1 : 0 ).'" data-insert-btnid="trigger_id_${'.$id.'__fieldID}" data-insert-closebtnid="drop_trigger_id_${'.$id.'__fieldID}" data-insert-img="${'.$id.'__fieldID}" data-insert-preview="${'.$id.'__fieldID}_preview" value="'.$upload_btn_text.'" />
									<a class="removeimg" href="javascript:" id="drop_trigger_id_${'.$id.'__fieldID}" data-insert-img="${'.$id.'__fieldID}" data-insert-preview="${'.$id.'__fieldID}_preview" style="display:none" title="'.esc_attr( $remove_btn_text ).'">&times;</a>
									'.( !empty( $value ) ? '<div id="${'.$id.'__fieldID}_preview" class="field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="${'.$id.'__fieldID}_preview" class="field_img_preview"><img src="" alt=""></div>' ).' 
									
												
										
			
								</div>
            
                             </div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
			if ( $image_prop ) {	
				

				$image_prop_value = array(
										'repeat'      => ( isset( $default[ 'prop_value' ] ) ) ? $default[ 'prop_value' ][ 'repeat' ] : 'no-repeat', 
										'position'    => ( isset( $default[ 'prop_value' ] ) ) ? $default[ 'prop_value' ][ 'position' ] : 'left', 
										'attachment'  => ( isset( $default[ 'prop_value' ] ) ) ? $default[ 'prop_value' ][ 'attachment' ] : 'scroll', 
										'size'        => ( isset( $default[ 'prop_value' ] ) ) ? $default[ 'prop_value' ][ 'size' ] : 'cover'
									);


				/* ------------ */
				$field .= '
						<tr class="'.self::call_row_class( $id, $cls, false ).'_repeat trigger_id_${'.$id.'__fieldID}_repeat" style="display:none">
							<th scope="row"><label>'.esc_html__( 'Background Repeat', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								      
									  <div class="trigger_id_${'.$id.'__fieldID}_repeat" style="display:none">
										  <div class="radio uixpbform_btn_trigger-radio" data-targetid="${'.$id.'_repeat__fieldID}">	
											  <span data-value="no-repeat" '.( $image_prop_value[ 'repeat' ] == 'no-repeat' ? 'class="active"' : '' ).' >'.esc_html__( 'No Repeat', 'uix-page-builder' ).'</span>
											  <span data-value="repeat" '.( $image_prop_value[ 'repeat' ] == 'repeat' ? 'class="active"' : '' ).' >'.esc_html__( 'Tile', 'uix-page-builder' ).'</span>
											  <span data-value="repeat-x" '.( $image_prop_value[ 'repeat' ] == 'repeat-x' ? 'class="active"' : '' ).' >'.esc_html__( 'Tile Horizontally', 'uix-page-builder' ).'</span>
											  <span data-value="repeat-y" '.( $image_prop_value[ 'repeat' ] == 'repeat-y' ? 'class="active"' : '' ).' >'.esc_html__( 'Tile Vertically', 'uix-page-builder' ).'</span>
										   </div>

										   <input type="hidden" id="${'.$id.'_repeat__fieldID}" name="${'.$id.'_repeat__fieldID}" value="{{if '.$id.'_repeat__fieldVal}}${'.$id.'_repeat__fieldVal}{{else}}'.$image_prop_value[ 'repeat' ].'{{/if}}">  
									  </div>
								   

								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="'.self::call_row_class( $id, $cls, false ).'_position trigger_id_${'.$id.'__fieldID}_position" style="display:none">
							<th scope="row"><label>'.esc_html__( 'Background Position', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								      
									  <div class="trigger_id_${'.$id.'__fieldID}_position" style="display:none">
									  
									      <div class="radio uixpbform_btn_trigger-radio" data-targetid="${'.$id.'_position__fieldID}">
											  <span data-value="left" '.( $image_prop_value[ 'position' ] == 'left' ? 'class="active"' : '' ).' >'.esc_html__( 'Left', 'uix-page-builder' ).'</span>
											  <span data-value="center" '.( $image_prop_value[ 'position' ] == 'center' ? 'class="active"' : '' ).' >'.esc_html__( 'Center', 'uix-page-builder' ).'</span>
											  <span data-value="right" '.( $image_prop_value[ 'position' ] == 'right' ? 'class="active"' : '' ).' >'.esc_html__( 'Right', 'uix-page-builder' ).'</span>
										   </div>

										   <input type="hidden" id="${'.$id.'_position__fieldID}" name="${'.$id.'_position__fieldID}" value="{{if '.$id.'_position__fieldVal}}${'.$id.'_position__fieldVal}{{else}}'.$image_prop_value[ 'position' ].'{{/if}}">
									  
									  </div>
								   
										  
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="'.self::call_row_class( $id, $cls, false ).'_attachment trigger_id_${'.$id.'__fieldID}_attachment" style="display:none">
							<th scope="row"><label>'.esc_html__( 'Background Attachment', 'uix-page-builder' ).'</label></th>
							<td>
							
									<div class="uixpbform-box">
								      
									  <div class="trigger_id_${'.$id.'__fieldID}_attachment" style="display:none">
									  
										  <div class="radio uixpbform_btn_trigger-radio" data-targetid="${'.$id.'_attachment__fieldID}">	
											  <span data-value="scroll" '.( $image_prop_value[ 'attachment' ] == 'scroll' ? 'class="active"' : '' ).' >'.esc_html__( 'Scroll', 'uix-page-builder' ).'</span>
											  <span data-value="fixed"  '.( $image_prop_value[ 'attachment' ] == 'fixed' ? 'class="active"' : '' ).' >'.esc_html__( 'Fixed', 'uix-page-builder' ).'</span>
										   </div>

										   <input type="hidden" id="${'.$id.'_attachment__fieldID}" name="${'.$id.'_attachment__fieldID}" value="{{if '.$id.'_attachment__fieldVal}}${'.$id.'_attachment__fieldVal}{{else}}'.$image_prop_value[ 'attachment' ].'{{/if}}">
										   
									  </div>
								   
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="'.self::call_row_class( $id, $cls, false ).'_size trigger_id_${'.$id.'__fieldID}_size" style="display:none">
							<th scope="row"><label>'.esc_html__( 'Background Size', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								      
									  <div class="trigger_id_${'.$id.'__fieldID}_size" style="display:none">
									  
										  <div class="radio uixpbform_btn_trigger-radio" data-targetid="${'.$id.'_size__fieldID}">	
											  <span data-value="cover" '.( $image_prop_value[ 'size' ] == 'cover' ? 'class="active"' : '' ).' >'.esc_html__( 'Cover', 'uix-page-builder' ).'</span>
											  <span data-value="auto" '.( $image_prop_value[ 'size' ] == 'auto' ? 'class="active"' : '' ).'>'.esc_html__( 'Auto', 'uix-page-builder' ).'</span>
											  <span data-value="contain" '.( $image_prop_value[ 'size' ] == 'contain' ? 'class="active"' : '' ).'>'.esc_html__( 'Contain', 'uix-page-builder' ).'</span>
										   </div>

										   <input type="hidden" id="${'.$id.'_size__fieldID}" name="${'.$id.'_size__fieldID}" value="{{if '.$id.'_size__fieldVal}}${'.$id.'_size__fieldVal}{{else}}'.$image_prop_value[ 'size' ].'{{/if}}">
									  
									  </div>
								   
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
								
	
					
			}
                

        }
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
