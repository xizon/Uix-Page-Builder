<?php
class UixPBFormType_Slider {
	
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
		
		
        if ( $type == 'slider' ) {
            
            $units = '';
			$min = '';
			$max = '';
			$step = '';
			$unitsid = '';
			
            if ( is_array( $default ) && !empty( $default ) ) {
				$min = $default[ 'min' ];
				$max = $default[ 'max' ];
				$step = $default[ 'step' ];
				$units = ( isset( $default[ 'units' ] ) ) ? $default[ 'units' ] : '';
				$unitsid = ( isset( $default[ 'units_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'units_id' ] ) : '';
				$unitsname = ( isset( $default[ 'units_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'units_id' ] ) : '';
				
				$jscode_vars .= '
					'.( !empty( $unitsid ) ? 'var '.$default[ 'units_id' ].' = $( "#'.$unitsid.'" ).val();'.PHP_EOL : '' ).'
				';		
				
				
            }
	
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								   '.( !empty( $unitsid ) ? '<input type="hidden" id="'.$unitsid.'" name="'.$unitsname.'" chk-id-input="'.$unitsid.'" value="'.$units.'">' : '' ).' 
								   
								   '.( !empty( $id ) ? '
									<div class="uixpbform-range-container">
										<input type="range" class="uixpbform-normal uixpbform-range" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.$value.'" min="'.$min.'" max="'.$max.'" step="'.$step.'" oninput="uixpbform_rangeSlider(this.id, \'slider_output_'.$id.'\', \''.$units.'\' )">
										<output class="uixpbform-range-txt" id="slider_output_'.$id.'">'.$value.''.$units.'</output>
									</div>
								   ' : '' ).' 
							   
									
								   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								  
							  </div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
            $jscode_vars .= '
                '.( !empty( $id ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';	
		
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
