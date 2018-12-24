<?php
class UixPBFormType_MultiSelector extends UixPBFormCore {
	
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
		

        if ( $type == 'multiselect' ) {
            
            $optionlist = '';
			$value_str  = $value;
			
			if ( !is_array( $value ) ) {
				$value = explode( ',', $value );
			}
			
            if ( is_array( $default ) && !empty( $default ) ) {
                $optionloop = 1;
				$radiofirst = '';
                foreach ( $default as $select_key => $select_value ) {
					
					//multiple checkboxes
					if ( is_array( $value ) ) {
						
						$selected = '  class="multi"';
						
						foreach ( $value as $v ) {
							
								if ( $optionloop == $v ) {
									$selected = '  class="multi active"'; 
									$radiofirst .= $select_key.',';	
									
									break;
								} 
						
						}
					
					}
					
					$optionlist .= '<span data-value="'.$select_key.'" '.$selected.'>'.$select_value.'<i class="fa fa-check no"></i></span>'.PHP_EOL;	
			        
                    $optionloop ++;
                }	
            }
	
	
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								  <div class="radio uixpbform_btn_trigger-multradio" data-targetid="${'.$id.'__fieldID}">	
								   '.$optionlist.' 
								   </div>
							   
								   <input data-enter-value="true" type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value_str.'{{/if}}" >
						   
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
