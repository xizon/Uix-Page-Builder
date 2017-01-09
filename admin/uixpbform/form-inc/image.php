<?php
class UixPBFormType_Image {
	
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
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPBFormCore::row_class( $args[ 'class' ] ).'"' : '';
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
						    
							<div class="uixpbform-box">
							
							  
								<div class="uixpbform-upbtn-container">
									
									'.( !empty( $id ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text uixpbform-input-upload-text"  chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'" />' : '' ).' 
									'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
									
									
									<input type="button" class="button uixpbform-upbtn uixpbform_btn_trigger-upload" data-prop="'.( $image_prop ? 1 : 0 ).'" data-btnid="trigger_id_'.$id.'" data-closebtnid="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" value="'.$upload_btn_text.'" />
									<a class="removeimg" href="javascript:" id="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" style="display:none">'.$remove_btn_text.'</a>
									'.( !empty( $value ) ? '<div id="'.$id.'_preview" class="field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="'.$id.'_preview" class="field_img_preview"><img src="" alt=""></div>' ).' 
									
												
										
			
								</div>
            
                             </div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
			if ( $image_prop ) {	
				$field .= '
						<tr class="trigger_id_'.$id.'_repeat" style="display:none">
							<th scope="row"><label>'.__( 'Background Repeat', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$default[ 'prop_id' ][ 'repeat' ].'">	
										  <span data-value="no-repeat" '.( $default[ 'prop_value' ][ 'repeat' ] == 'no-repeat' ? 'class="active"' : '' ).' >'.__( 'No Repeat', 'uix-page-builder' ).'</span>
										  <span data-value="repeat" '.( $default[ 'prop_value' ][ 'repeat' ] == 'repeat' ? 'class="active"' : '' ).' >'.__( 'Tile', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-x" '.( $default[ 'prop_value' ][ 'repeat' ] == 'repeat-x' ? 'class="active"' : '' ).' >'.__( 'Tile Horizontally', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-y" '.( $default[ 'prop_value' ][ 'repeat' ] == 'repeat-y' ? 'class="active"' : '' ).' >'.__( 'Tile Vertically', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$default[ 'prop_id' ][ 'repeat' ].'" name="'.$default[ 'prop_name' ][ 'repeat' ].'" chk-id-input="'.$default[ 'prop_id' ][ 'repeat' ].'" value="'.$default[ 'prop_value' ][ 'repeat' ].'">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_position" style="display:none">
							<th scope="row"><label>'.__( 'Background Position', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$default[ 'prop_id' ][ 'position' ].'">
										  <span data-value="left" '.( $default[ 'prop_value' ][ 'position' ] == 'left' ? 'class="active"' : '' ).' >'.__( 'Left', 'uix-page-builder' ).'</span>
										  <span data-value="center" '.( $default[ 'prop_value' ][ 'position' ] == 'center' ? 'class="active"' : '' ).' >'.__( 'Center', 'uix-page-builder' ).'</span>
										  <span data-value="right" '.( $default[ 'prop_value' ][ 'position' ] == 'right' ? 'class="active"' : '' ).' >'.__( 'Right', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$default[ 'prop_id' ][ 'position' ].'" name="'.$default[ 'prop_name' ][ 'position' ].'" chk-id-input="'.$default[ 'prop_id' ][ 'position' ].'" value="'.$default[ 'prop_value' ][ 'position' ].'">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_attachment" style="display:none">
							<th scope="row"><label>'.__( 'Background Attachment', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$default[ 'prop_id' ][ 'attachment' ].'">	
										  <span data-value="scroll" '.( $default[ 'prop_value' ][ 'attachment' ] == 'scroll' ? 'class="active"' : '' ).' >'.__( 'Scroll', 'uix-page-builder' ).'</span>
										  <span data-value="fixed"  '.( $default[ 'prop_value' ][ 'attachment' ] == 'fixed' ? 'class="active"' : '' ).' >'.__( 'Fixed', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$default[ 'prop_id' ][ 'attachment' ].'" name="'.$default[ 'prop_name' ][ 'attachment' ].'" chk-id-input="'.$default[ 'prop_id' ][ 'attachment' ].'" value="'.$default[ 'prop_value' ][ 'attachment' ].'">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
				
				$field .= '
						<tr class="trigger_id_'.$id.'_size" style="display:none">
							<th scope="row"><label>'.__( 'Background Size', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$default[ 'prop_id' ][ 'size' ].'">	
									      <span data-value="cover" '.( $default[ 'prop_value' ][ 'size' ] == 'cover' ? 'class="active"' : '' ).' >'.__( 'Cover', 'uix-page-builder' ).'</span>
									      <span data-value="auto" '.( $default[ 'prop_value' ][ 'size' ] == 'auto' ? 'class="active"' : '' ).'>'.__( 'Auto', 'uix-page-builder' ).'</span>
										  <span data-value="contain" '.( $default[ 'prop_value' ][ 'size' ] == 'contain' ? 'class="active"' : '' ).'>'.__( 'Contain', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $id ) ? '<input type="hidden" id="'.$default[ 'prop_id' ][ 'size' ].'" name="'.$default[ 'prop_name' ][ 'size' ].'" chk-id-input="'.$default[ 'prop_id' ][ 'size' ].'" value="'.$default[ 'prop_value' ][ 'size' ].'">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				/* ------------ */
						
				
	
					
			}
                
				
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
				'.( $image_prop ? 'var '.$id.'_repeat = $( "#'.$id.'_repeat" ).val(); var '.$id.'_position = $( "#'.$id.'_position" ).val(); var '.$id.'_attachment = $( "#'.$id.'_attachment" ).val(); var '.$id.'_size = $( "#'.$id.'_size" ).val();'.PHP_EOL : '' ).'
            ';
            $jscode .= '';	
                

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
