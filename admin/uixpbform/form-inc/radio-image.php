<?php
class UixPBFormType_RadioImage {
	
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
		
		
		
        if ( $type == 'radio-image' ) {
            
		
			//inscure browser
			if( UixPBFormCore::is_IE() && UixPBFormCore::is_dynamic_input( $class ) ) {
				$new_class = str_replace( 'dynamic-row', 'isMSIE dynamic-row', $class );
			} else {
				$new_class = $class;
			}
			
			
            //Options list & Toggle for radio options
			
			$optionlist            = '';
			$toggle_class          = '';
			$toggle_remove_class   = '';
			$target_id             = '';
			$remove_id             = '';
			$toggle_trigger_id     = '';
			$optionloop            = 1;
			$radiofirst            = '';

			if ( is_array( $default ) && !empty( $default ) ) {
				
				if ( is_array( $toggle ) && !empty( $toggle ) ) {
					
				
					foreach ( $default as $select_key => $select_value ) {
						
						$selected            = ''; 
						$togglekey           = $optionloop - 1;
	
						$toggle_class        = ( isset( $toggle[ $togglekey ][ 'toggle_class' ] ) ) ? $toggle[ $togglekey ][ 'toggle_class' ] : '';
						$toggle_remove_class = ( isset( $toggle[ $togglekey ][ 'toggle_remove_class' ] ) ) ? $toggle[ $togglekey ][ 'toggle_remove_class' ] : '';
						$toggle_trigger_id   = ( isset( $toggle[ $togglekey ][ 'trigger_id' ] ) ) ? $toggle[ $togglekey ][ 'trigger_id' ] : '';
						$target_id           = '';
						$remove_id           = '';
						
						if ( isset( $toggle[ $togglekey ][ 'toggle_class' ] ) ) {
							foreach ( $toggle[ $togglekey ][ 'toggle_class' ] as $v ) {
								$target_id .= '.'.$v.','; 	
							}
						}
							
						if ( isset( $toggle[ $togglekey ][ 'toggle_remove_class' ] ) ) {
							foreach ( $toggle[ $togglekey ][ 'toggle_remove_class' ] as $v ) {
								$remove_id .= '.'.$v.','; 	
							}						
							
						}
							
						
						if ( ( !empty( $value ) && $select_key == $value ) || ( empty( $value ) && $optionloop == 1 )  ) {
							$selected = '  active'; 
							$radiofirst = $select_key;	
						} 
					 
						$optionlist .= '<span data-value="'.$select_key.'" id="'.$id.'-'.$select_key.'" class="img'.$selected.' '.( !empty( $toggle_trigger_id ) ? 'uixpbform_btn_trigger-toggleswitch_radio' : '' ).'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.rtrim( $target_id, ',' ).'" data-remove="'.rtrim( $remove_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" ' : '' ).'><img alt="" title="'.$select_key.'" src="'.$select_value.'"></span>'.PHP_EOL;	
						$optionloop ++;
					}	
					
	
					
				} else {
				
					foreach ( $default as $select_key => $select_value ) {
						
						$selected = ''; 
						
						if ( ( !empty( $value ) && $select_key == $value ) || ( empty( $value ) && $optionloop == 1 )  ) {
							$selected = '  active'; 
							$radiofirst = $select_key;	
						} 
					 
						$optionlist .= '<span data-value="'.$select_key.'" id="'.$id.'-'.$select_key.'" class="img'.$selected.' '.( !empty( $toggle_trigger_id ) ? 'uixpbform_btn_trigger-toggleswitch_radio' : '' ).'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.rtrim( $target_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" ' : '' ).'><img alt="" title="'.$select_key.'" src="'.$select_value.'"></span>'.PHP_EOL;	
						$optionloop ++;
					}	
			
					
					
				}
				
			}
					
		
            
            $field = '
                    <tr'.$new_class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                                  <div class="uixpbform-form-clear"></div>
								  <div class="radio uixpbform_btn_trigger-radio" data-targetid="'.$id.'">	
								   '.$optionlist.' 
								   </div>
							   
								   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.$radiofirst.'">' : '' ).' 
						   
								   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								  
								
							</div>
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
            $jscode_vars = '
				'.( !empty( $id ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';	
			
			
            $jscode = '';
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
