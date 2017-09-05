<?php
class UixPBFormType_Image {
	
	public static function add( $args, $args_config, $_output ) {
		
		if ( !is_array( $args ) ) return;
		if ( !is_array( $args_config ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], $args[ 'value' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], '' );
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args[ 'id' ] ) : '';
		$name             = ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $args[ 'id' ] ) : '';
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
									
									'.( !empty( $args[ 'id' ] ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text uixpbform-input-upload-text"  chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'" />' : '' ).' 
									'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
									
									
									<input type="button" class="button uixpbform-upbtn uixpbform_btn_trigger-upload" data-prop="'.( $image_prop ? 1 : 0 ).'" data-btnid="trigger_id_'.$id.'" data-closebtnid="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" value="'.$upload_btn_text.'" />
									<a class="removeimg" href="javascript:" id="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" style="display:none" title="'.esc_attr( $remove_btn_text ).'">&times;</a>
									'.( !empty( $value ) ? '<div id="'.$id.'_preview" class="field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="'.$id.'_preview" class="field_img_preview"><img src="" alt=""></div>' ).' 
									
												
										
			
								</div>
            
                             </div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
			if ( $image_prop ) {	
				

				$image_prop_value = ( is_array( $default[ 'prop_value' ] ) && !empty( $default[ 'prop_value' ] ) ) ? array(
										'repeat'     => ( isset( $default[ 'prop_value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'repeat' ], $default[ 'prop_value' ][ 'repeat' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'repeat' ], '' ), 
										'position'   => ( isset( $default[ 'prop_value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'position' ], $default[ 'prop_value' ][ 'position' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'position' ], '' ), 
										'attachment'  => ( isset( $default[ 'prop_value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'attachment' ], $default[ 'prop_value' ][ 'attachment' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'attachment' ], '' ), 
										'size'    => ( isset( $default[ 'prop_value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'size' ], $default[ 'prop_value' ][ 'size' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'prop_id' ][ 'size' ], '' ) 
									) : '';

				$image_prop_id = ( is_array( $default[ 'prop_id' ] ) && !empty( $default[ 'prop_id' ] ) ) ? array(
										'repeat'     => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'prop_id' ][ 'repeat' ] ) : '', 
										'position'   => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'prop_id' ][ 'position' ] ) : '', 
										'attachment'  => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'prop_id' ][ 'attachment' ] ) : '', 
										'size'    => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'prop_id' ][ 'size' ] ) : '' 
									) : '';

				$image_prop_name = ( is_array( $default[ 'prop_id' ] ) && !empty( $default[ 'prop_id' ] ) ) ? array(
										'repeat'     => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'prop_id' ][ 'repeat' ] ) : '', 
										'position'   => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'prop_id' ][ 'position' ] ) : '', 
										'attachment'  => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'prop_id' ][ 'attachment' ] ) : '', 
										'size'    => ( isset( $default[ 'prop_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'prop_id' ][ 'size' ] ) : ''
									) : '';
				

				/* ------------ */
				$field .= '
						<tr class="trigger_id_'.$id.'_repeat" style="display:none">
							<th scope="row"><label>'.__( 'Background Repeat', 'uix-page-builder' ).'</label></th>
							<td>
							
								<div class="uixpbform-box">
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$image_prop_id[ 'repeat' ].'">	
										  <span data-value="no-repeat" '.( $image_prop_value[ 'repeat' ] == 'no-repeat' ? 'class="active"' : '' ).' >'.__( 'No Repeat', 'uix-page-builder' ).'</span>
										  <span data-value="repeat" '.( $image_prop_value[ 'repeat' ] == 'repeat' ? 'class="active"' : '' ).' >'.__( 'Tile', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-x" '.( $image_prop_value[ 'repeat' ] == 'repeat-x' ? 'class="active"' : '' ).' >'.__( 'Tile Horizontally', 'uix-page-builder' ).'</span>
										  <span data-value="repeat-y" '.( $image_prop_value[ 'repeat' ] == 'repeat-y' ? 'class="active"' : '' ).' >'.__( 'Tile Vertically', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$image_prop_id[ 'repeat' ].'" name="'.$image_prop_name[ 'repeat' ].'" chk-id-input="'.$image_prop_id[ 'repeat' ].'" value="'.$image_prop_value[ 'repeat' ].'">' : '' ).' 
								
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
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$image_prop_id[ 'position' ].'">
										  <span data-value="left" '.( $image_prop_value[ 'position' ] == 'left' ? 'class="active"' : '' ).' >'.__( 'Left', 'uix-page-builder' ).'</span>
										  <span data-value="center" '.( $image_prop_value[ 'position' ] == 'center' ? 'class="active"' : '' ).' >'.__( 'Center', 'uix-page-builder' ).'</span>
										  <span data-value="right" '.( $image_prop_value[ 'position' ] == 'right' ? 'class="active"' : '' ).' >'.__( 'Right', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$image_prop_id[ 'position' ].'" name="'.$image_prop_name[ 'position' ].'" chk-id-input="'.$image_prop_id[ 'position' ].'" value="'.$image_prop_value[ 'position' ].'">' : '' ).' 
								
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
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$image_prop_id[ 'attachment' ].'">	
										  <span data-value="scroll" '.( $image_prop_value[ 'attachment' ] == 'scroll' ? 'class="active"' : '' ).' >'.__( 'Scroll', 'uix-page-builder' ).'</span>
										  <span data-value="fixed"  '.( $image_prop_value[ 'attachment' ] == 'fixed' ? 'class="active"' : '' ).' >'.__( 'Fixed', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$image_prop_id[ 'attachment' ].'" name="'.$image_prop_name[ 'attachment' ].'" chk-id-input="'.$image_prop_id[ 'attachment' ].'" value="'.$image_prop_value[ 'attachment' ].'">' : '' ).' 
								
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
								   
									  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$image_prop_id[ 'size' ].'">	
									      <span data-value="cover" '.( $image_prop_value[ 'size' ] == 'cover' ? 'class="active"' : '' ).' >'.__( 'Cover', 'uix-page-builder' ).'</span>
									      <span data-value="auto" '.( $image_prop_value[ 'size' ] == 'auto' ? 'class="active"' : '' ).'>'.__( 'Auto', 'uix-page-builder' ).'</span>
										  <span data-value="contain" '.( $image_prop_value[ 'size' ] == 'contain' ? 'class="active"' : '' ).'>'.__( 'Contain', 'uix-page-builder' ).'</span>
									   </div>
									   '.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$image_prop_id[ 'size' ].'" name="'.$image_prop_name[ 'size' ].'" chk-id-input="'.$image_prop_id[ 'size' ].'" value="'.$image_prop_value[ 'size' ].'">' : '' ).' 
								
								</div>
							</td>
						</tr> 
					'.PHP_EOL;
				
									
	
					
			}
                
		
            $jscode_vars = '
                '.( !empty( $args[ 'id' ] ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
			    '.( $image_prop && !empty( $default[ 'prop_id' ][ 'repeat' ] ) ? 'var '.$default[ 'prop_id' ][ 'repeat' ].' = $( "#'.$image_prop_id[ 'repeat' ].'" ).val();'.PHP_EOL : '' ).'
				'.( $image_prop && !empty( $default[ 'prop_id' ][ 'position' ] ) ? 'var '.$default[ 'prop_id' ][ 'position' ].' = $( "#'.$image_prop_id[ 'position' ].'" ).val();'.PHP_EOL : '' ).'
				'.( $image_prop && !empty( $default[ 'prop_id' ][ 'attachment' ] ) ? 'var '.$default[ 'prop_id' ][ 'attachment' ].' = $( "#'.$image_prop_id[ 'attachment' ].'" ).val();'.PHP_EOL : '' ).'
				'.( $image_prop && !empty( $default[ 'prop_id' ][ 'size' ] ) ? 'var '.$default[ 'prop_id' ][ 'size' ].' = $( "#'.$image_prop_id[ 'size' ].'" ).val();'.PHP_EOL : '' ).'
            ';
            $jscode .= '';	
                

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
