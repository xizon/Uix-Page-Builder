<?php
class UixPBFormType_Radio {
	
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
		
		
        if ( $type == 'radio' ) {
			
				
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
					 
						$optionlist .= '<span data-value="'.$select_key.'" id="'.$id.'-'.$select_key.'" class="'.$selected.' '.( !empty( $toggle_trigger_id ) ? 'uixpbform_btn_trigger-toggleswitch_radio' : '' ).'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.rtrim( $target_id, ',' ).'" data-remove="'.rtrim( $remove_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" ' : '' ).'>'.$select_value.'</span>'."\n";	
						$optionloop ++;
					}	
					
	
					
				} else {
				
					foreach ( $default as $select_key => $select_value ) {
						
						$selected = ''; 
						
						if ( ( !empty( $value ) && $select_key == $value ) || ( empty( $value ) && $optionloop == 1 )  ) {
							$selected = '  active'; 
							$radiofirst = $select_key;	
						} 
					 
						$optionlist .= '<span data-value="'.$select_key.'" id="'.$id.'-'.$select_key.'" class="'.$selected.' '.( !empty( $toggle_trigger_id ) ? 'uixpbform_btn_trigger-toggleswitch_radio' : '' ).'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.rtrim( $target_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" ' : '' ).'>'.$select_value.'</span>'."\n";	
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
                '."\n";	
                
				
            $jscode_vars = '
				'.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
            ';		
			
			
			
            $jscode = '';
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
