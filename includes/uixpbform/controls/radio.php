<?php
class UixPBFormType_Radio extends UixPBFormCore {
	
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
		
		
        if ( $type == 'radio' ) {
			
		
			
            //Options list & Toggle for radio options
			
			$optionlist            = '';
			$target_id             = '';
			$toggle_trigger_id     = '';
			$optionloop            = 1;
			$radiofirst            = '';

			if ( is_array( $default ) && !empty( $default ) ) {
				
				if ( is_array( $toggle ) && !empty( $toggle ) ) {
					
				
					foreach ( $default as $select_key => $select_value ) {
						
						$selected            = ''; 
						$togglekey           = $optionloop - 1;
						$toggle_trigger_id   = ( isset( $toggle[ $togglekey ][ 'trigger_id' ] ) ) ? $id.'-'.$toggle[ $togglekey ][ 'trigger_id' ] : '';
						$target_id           = '';
						
						if ( isset( $toggle[ $togglekey ][ 'target_ids' ] ) ) {
							foreach ( $toggle[ $togglekey ][ 'target_ids' ] as $v ) {
								$target_id .= ''.$v.','; 		
							}
						}
							
						
						if ( ( !empty( $value ) && $select_key == $value ) || ( empty( $value ) && $optionloop == 1 )  ) {
							$selected = '  active'; 
							$radiofirst = $select_key;	
						} 
					 
						$optionlist .= '<span data-value="'.$select_key.'" class="'.$selected.'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.$target_id.'"' : '' ).'>'.$select_value.'</span>'.PHP_EOL;
						$optionloop ++;
					}	
					
	
					
				} else {
				
					foreach ( $default as $select_key => $select_value ) {
						
						$selected = ''; 
						
						if ( ( !empty( $value ) && $select_key == $value ) || ( empty( $value ) && $optionloop == 1 )  ) {
							$selected = '  active'; 
							$radiofirst = $select_key;	
						} 
					 
						$optionlist .= '<span data-value="'.$select_key.'" class="'.$selected.' '.( !empty( $toggle_trigger_id ) ? 'uixpbform_btn_trigger-toggleswitch_radio' : '' ).'" '.( !empty( $toggle_trigger_id ) ? 'data-targetid="'.$target_id.'"' : '' ).'>'.$select_value.'</span>'.PHP_EOL;
						$optionloop ++;
					}	
			
					
					
				}
				
			}

			
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                                  <div class="uixpbform-form-clear"></div>
								  <div data-trigger-clone="0" class="radio uixpbform_btn_trigger-radio" data-targetid="${'.$id.'__fieldID}">	
								   '.$optionlist.' 
								   </div>
							   
							   
								   <input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$radiofirst.'{{/if}}" >
						   
								   '.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
								  
								
							</div>
                        </td>
                    </tr> 
                '.PHP_EOL;	
                

        }
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
