<?php
class UixPBFormType_ShortText extends UixPBFormCore {
	
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
		
		
        if ( $type == 'short-text' ) {
            
            $units = '';
            if ( is_array( $default ) && !empty( $default ) ) {
                $units = isset( $default[ 'units' ] ) ? $default[ 'units' ] : '';
            }
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    <div class="uixpbform-box">
								   
								<div class="uixpbform-input-text-short uixpbform-input-text-short-units">
			
			
			
								   <input '.( !empty( $callback ) && !self::inc_str( $callback, 'number-deg_px' ) ? $callback : '' ).' type="text" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" class="uixpbform-normal uixpbform-input-text '.( !empty( $callback ) && self::inc_str( $callback, 'number-deg_px' ) ? 'uixpbform-input-text-spy-deg_px' : '' ).'" data-enter-value="true" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" placeholder="'.$placeholder.'">
								   
								   
								   '.( !empty( $callback ) && self::inc_str( $callback, 'number-deg_px' ) ? '<input type="hidden" class="uixpbform-input-text-deg_px" id="${'.$id.'_deg_px__fieldID}" name="${'.$id.'_deg_px__fieldID}" value="{{if '.$id.'_deg_px__fieldVal}}${'.$id.'_deg_px__fieldVal}{{else}}'.self::deg_to_px( $value ).'{{/if}}">' : '' ).'

								   
								   <span class="units units-short">'.$units.'</span>
								   
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
