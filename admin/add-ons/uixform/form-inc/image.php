<?php
class UixFormType_Image {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$name             = ( isset( $args[ 'name' ] ) ) ? $args[ 'name' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
        if ( $type == 'image' ) {
            
            //Enqueue the media scripts
            wp_enqueue_media();
                                
            $remove_btn_text = '';
            $upload_btn_text = '';
			$image_prop = false;
            if ( is_array( $default ) && !empty( $default ) ) {
                $remove_btn_text = $default[ 'remove_btn_text' ];
                $upload_btn_text = $default[ 'upload_btn_text' ];
				
				//Image properties
				if ( isset( $default[ 'prop' ] ) && $default[ 'prop' ] ) {
					$image_prop = true;	
				}				
				
				
            }
			
     
            $field .= '
			
			
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    
							<div class="uixform-box">
							
							  
								<div class="uixform-upbtn-container">
									
									'.( !empty( $id ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixform-normal uixform-input-text uixform-input-upload-text"  value="'.$value.'" placeholder="'.$placeholder.'" />' : '' ).' 
									'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
									
									
									<input type="button" class="button uixform-upbtn" id="trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" value="'.$upload_btn_text.'" />
									<a class="removeimg" href="javascript:" id="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" style="display:none">'.$remove_btn_text.'</a>
									'.( !empty( $value ) ? '<div id="'.$id.'_preview" class="field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="'.$id.'_preview" class="field_img_preview"><img src="" alt=""></div>' ).' 
									
												
										
			
								</div>
            
                             </div>
                            
                        </td>
                    </tr> 
                '."\n";	
                
				
			if ( $image_prop ) {	
				$field .= '
						<tr class="trigger_id_'.$id.'_repeat" style="display:none">
							<th scope="row"><label>'.__( 'Background Repeat', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixform-box">
								   
									  <div class="radio" id="radio-selector-'.$id.'_repeat">	
										  <span data-value="no-repeat" class="active">'.__( 'No Repeat', 'uix-page-builder' ).'</span>
										  <span data-value="repeat" >'.__( 'Tile', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-x" >'.__( 'Tile Horizontally', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-y" >'.__( 'Tile Vertically', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'_repeat" value="no-repeat">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'."\n";	
				$jscode .= '
				$( document ).uixform_radioSelector({
						containerID: "#radio-selector-'.$id.'_repeat",
						targetID: "#'.$id.'_repeat"
					});		
						
				'."\n";	
				
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_position" style="display:none">
							<th scope="row"><label>'.__( 'Background Position', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixform-box">
								   
									  <div class="radio" id="radio-selector-'.$id.'_position">	
										  <span data-value="left" class="active">'.__( 'Left', 'uix-page-builder' ).'</span>
										  <span data-value="center" >'.__( 'Center', 'uix-page-builder' ).'</span>
										  <span data-value="right" >'.__( 'Right', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'_position" value="left">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'."\n";	
				$jscode .= '
				$( document ).uixform_radioSelector({
						containerID: "#radio-selector-'.$id.'_position",
						targetID: "#'.$id.'_position"
					});		
						
				'."\n";	
				
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_attachment" style="display:none">
							<th scope="row"><label>'.__( 'Background Attachment', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixform-box">
								   
									  <div class="radio" id="radio-selector-'.$id.'_attachment">	
										  <span data-value="scroll" class="active">'.__( 'Scroll', 'uix-page-builder' ).'</span>
										  <span data-value="fixed" >'.__( 'Fixed', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'_attachment" value="scroll">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'."\n";	
				$jscode .= '
				$( document ).uixform_radioSelector({
						containerID: "#radio-selector-'.$id.'_attachment",
						targetID: "#'.$id.'_attachment"
					});		
						
				'."\n";	
				
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_size" style="display:none">
							<th scope="row"><label>'.__( 'Background Size', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixform-box">
								   
									  <div class="radio" id="radio-selector-'.$id.'_size">	
									      <span data-value="cover" class="active">'.__( 'Cover', 'uix-page-builder' ).'</span>
									      <span data-value="auto">'.__( 'Auto', 'uix-page-builder' ).'</span>
										  <span data-value="contain">'.__( 'Contain', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'_size" value="cover">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'."\n";	
				$jscode .= '
				$( document ).uixform_radioSelector({
						containerID: "#radio-selector-'.$id.'_size",
						targetID: "#'.$id.'_size"
					});		
						
				'."\n";	
				
				/* ------------ */
						
				
	
					
			}
                
				
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
				'.( $image_prop ? 'var '.$id.'_repeat = $( "#'.$id.'_repeat" ).val(); var '.$id.'_position = $( "#'.$id.'_position" ).val(); var '.$id.'_attachment = $( "#'.$id.'_attachment" ).val(); var '.$id.'_size = $( "#'.$id.'_size" ).val();'."\n" : '' ).'
            ';
            $jscode .= '

                /*-- Insert media  --*/
                $( document ).uixform_uploadMediaCustom( { '.( $image_prop ? 'prop: true,' : '' ).'btnID: "#trigger_id_'.$id.'", closebtnID: "#drop_trigger_id_'.$id.'" } );
            ';	
                

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
