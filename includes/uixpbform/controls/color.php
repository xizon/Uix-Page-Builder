<?php
class UixPBFormType_Color extends UixPBFormCore {
	
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
		
		
        if ( $type == 'color' ) {
            
            $colorlist = '';
            if ( is_array( $default ) && !empty( $default ) ) {
                foreach ( $default as $color_value ) {
					
					$active = ( $value == $color_value ) ? ' class="active"' : '';
					
                    $colorlist .= '<span '.$active.' style="background:'.$color_value.'" data-value="'.$color_value.'"></span>'.PHP_EOL;	
                }	
            }
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>		
						    
							<div class="uixpbform-box">
								  <div class="uixpbform-color-selector uixpbform_btn_trigger-radio" data-targetid="${'.$id.'__fieldID}">	
								   '.$colorlist.' 
								   </div>
								   
								   <input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" >
	
	                                '.( !empty( $callback ) && self::inc_str( $callback, 'color-name' ) ? '<input type="hidden" class="uixpbform-color-name" id="${'.$id.'_name__fieldID}" name="${'.$id.'_name__fieldID}" value="{{if '.$id.'_name__fieldVal}}${'.$id.'_name__fieldVal}{{else}}'.self::color_tran( $value ).'{{/if}}">' : '' ).'
									

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
