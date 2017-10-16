<?php
class UixPBFormType_Checkbox extends UixPBFormCore {
	
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
		
		
        if ( $type == 'checkbox' ) {
            
			$target_id                        = '';
            $checked                          = ( $value == 1 ) ? true : false;
			$checked_txt                      = '';
			$normal_checkbox_target_id_code   = '';
			
			
			
			if ( $checked ) {
				$checked_txt = 'checked';
			} else {
				$checked_txt = '';
			}
			
			
            if ( is_array( $toggle ) && !empty( $toggle ) ) {
				
				//Target ids
                foreach ( $toggle[ 'target_ids' ] as $tid_value ) {
					$target_id .= ''.$tid_value.','; 		
                }	
		
				
            } else {
				$normal_checkbox_target_id_code = 'data-trigger-clone="0" data-targetid="${'.$id.'__fieldID}"';
			}
			
			
			
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    <div class="uixpbform-box">
                        
                             <span class="uixpbform-checkbox">
                              
								 '.( !empty( $target_id ) ? '<div data-trigger-clone="0" class="onoffswitch uixpbform_btn_trigger-toggleswitch_checkbox '.$checked_txt.'" data-targetid="'.$target_id.'">' : '' ).'
								 
                                 <input value="" type="checkbox" '.$normal_checkbox_target_id_code.' class="uixpbform-normal uixpbform-check '.( !empty( $target_id ) ? 'onoffswitch-checkbox' : 'uixpbform_btn_trigger-normalchk' ).'" '.$checked_txt.'>
								 
								 '.( !empty( $target_id ) ? '<label class="onoffswitch-label" for="myonoffswitch"></label></div>' : '' ).'
								 
								<input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" >


                             </span>
                             
                             
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
