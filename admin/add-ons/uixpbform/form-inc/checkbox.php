<?php
class UixPBFormType_Checkbox {
	
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
		
		
        if ( $type == 'checkbox' ) {
            
            $checked = false;
					
            if ( is_array( $default ) && !empty( $default ) ) {
                $checked = $default[ 'checked' ];
			
				
                if ( $checked ) {
                    $checked_txt = 'checked';
                } else {
                    $checked_txt = '';
                }
				
	
            }
			
			//Toggle for checkbox
			$toggle_class = '';
			$target_id = '';
			$toggle_trigger_id = '';
			$toggle_no_id = '';
			
			
            if ( is_array( $toggle ) && !empty( $toggle ) ) {
             
			 
				$toggle_class = ( isset( $toggle[ 'toggle_class' ] ) ) ? $toggle[ 'toggle_class' ] : '';
				$toggle_trigger_id = ( isset( $toggle[ 'trigger_id' ] ) ) ? $toggle[ 'trigger_id' ] : '';
				
				if ( isset( $toggle[ 'toggle_class' ] ) ) {
					foreach ( $toggle[ 'toggle_class' ] as $tid_value ) {
						$target_id .= '.'.$tid_value.','; 	
					}	
	
				}
				
				//if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid
				if ( isset( $toggle[ 'toggle_not_class' ] ) && !empty( $toggle[ 'toggle_not_class' ] ) ) {
					foreach ( $toggle[ 'toggle_not_class' ] as $tid_value2 ) {
						$toggle_no_id .= '.'.$tid_value2.','; 		
					}
						
				}
				
				
            }
			
			//inscure browser
			if( UixPBFormCore::is_IE() && UixPBFormCore::is_dynamic_input( $class ) ) {
				$new_class = str_replace( 'dynamic-row', 'isMSIE dynamic-row', $class );
			} else {
				$new_class = $class;
			}
			
			
			if ( $value == 1 && empty( $toggle_trigger_id ) ) {
				$checked_txt = 'checked';
			}
			if ( $value == 0 && empty( $toggle_trigger_id ) ) {
				$checked_txt = '';
			}
			
			
            $field = '
                    <tr'.$new_class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    <div class="uixpbform-box">
                        
                             <span class="uixpbform-checkbox">
                              
								 '.( !empty( $toggle_trigger_id ) ? '<div class="onoffswitch uixpbform_btn_trigger-toggleswitch_checkbox '.$checked_txt.'" data-this-targetid="'.$id.'" data-targetid="'.rtrim( $target_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" data-linked-no-toggleid="'.rtrim( $toggle_no_id, ',' ).'">' : '' ).'
								 
                                 '.( !empty( $id ) ? '<input value="" id="'.$id.'-checkbox" name="'.$name.'-checkbox" type="checkbox" data-this-targetid="'.$id.'" class="uixpbform-normal uixpbform-check uixpbform_btn_trigger-normalchk '.( !empty( $toggle_trigger_id ) ? 'onoffswitch-checkbox' : '' ).'" '.$checked_txt.'>' : '' ).'
								 
								 '.( !empty( $toggle_trigger_id ) ? '<label class="onoffswitch-label" for="myonoffswitch"></label></div>' : '' ).'
								 
								 '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" value="'.$value.'" >' : '' ).'


                             </span>
                             
                             '.( !empty( $desc ) ? '<span class="info info-checkbox">'.$desc.'</span>' : '' ).' 
         
                            </div>
                        </td>
                    </tr> 
                '."\n";	
                
            $jscode_vars = '';						
                
			$jscode = '';
				

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
