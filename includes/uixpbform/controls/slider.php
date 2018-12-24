<?php
class UixPBFormType_Slider extends UixPBFormCore {
	
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
		
		
        if ( $type == 'slider' ) {
            
            $units = '';
			$min = '';
			$max = '';
			$step = '';
			
            if ( is_array( $default ) && !empty( $default ) ) {
				$min = $default[ 'min' ];
				$max = $default[ 'max' ];
				$step = $default[ 'step' ];
				$units = ( isset( $default[ 'units' ] ) ) ? $default[ 'units' ] : '';
				
            }
	
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								
									<div class="uixpbform-range-container">
										<input type="range" class="uixpbform-normal uixpbform-range" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" min="'.$min.'" max="'.$max.'" step="'.$step.'" oninput="uixpbform_rangeSlider(this.id, \'slider_output_${'.$id.'__fieldID}\', \''.$units.'\' )">
										
										<output class="uixpbform-range-txt" id="slider_output_${'.$id.'__fieldID}">{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}'.$units.'</output>
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
