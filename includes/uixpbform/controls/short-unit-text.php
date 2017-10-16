<?php
class UixPBFormType_ShortUnitsText extends UixPBFormCore {
	
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
		
		
        if ( $type == 'short-units-text' ) {
            
            $unitslist = '';
			$unitsvalue = ( isset( $default[ 'units_value' ] ) ) ? $default[ 'units_value' ] : '';
			$unitsfirst = '';
			
   
			
			$i = 1;
            if ( is_array( $default ) && !empty( $default ) ) {
				
				if ( isset( $default[ 'units' ] ) && is_array( $default[ 'units' ] ) ) {
					
					$unitsfirst = $default[ 'units' ][0];
					
					foreach ( $default[ 'units' ] as $units_value ) {

						if ( $unitsvalue == '' ) {
							$active = ( $i == 1 ) ? ' class="active"' : '';
						} else {
							$active = ( $units_value == $unitsvalue ) ? ' class="active"' : '';		
						}

						$unitslist .= '<span '.$active.' data-value="'.$units_value.'">'.$units_value.'</span>'.PHP_EOL;	

						$i++;
					}	
				}
	
            }
			
			if ( $unitsvalue == '' ) $unitsvalue = $unitsfirst;
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								<div class="uixpbform-input-text-short">
			
								   <input '.$callback.' type="text" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" class="uixpbform-normal uixpbform-input-text" data-enter-value="true" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" placeholder="'.$placeholder.'">
								   
								   
								   <span class="units units-short units-selector uixpbform_btn_trigger-radio" data-targetid="${'.$id.'_units__fieldID}">'.$unitslist.'</span>
								   
								   <input type="hidden" id="${'.$id.'_units__fieldID}" name="${'.$id.'_units__fieldID}" value="{{if '.$id.'_units__fieldVal}}${'.$id.'_units__fieldVal}{{else}}'.$unitsvalue.'{{/if}}">
						
								</div>
								
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
