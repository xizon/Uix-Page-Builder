<?php
class UixPBFormType_ColorMap {
	
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
	
        if ( $type == 'colormap' ) {
       
			$swatches = 1;
			if ( is_array( $default ) && !empty( $default ) ) {
				$swatches = ( isset( $default[ 'swatches' ] ) ) ? $default[ 'swatches' ] : 1;

			}
	        
			$field = '';
            $field .= '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>	
						
						    <div class="uixpbform-box">
								
			';
			
			if ( $swatches == 1 ) {
				$field .= ' 
				                <div class="uixpbform-color-selector-onlybutton">
								        
										<div class="uixpbform-color-selector-toggles">
											<input type="text" class="wp-color-input color-picker" data-alpha="true" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.$value.'">
										</div>
										
										'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).'
								
								</div>

								
									 
				';	
			} else {
			
				$field .= ' 
				                <div class="uixpbform-input-text-short">
				
									   '.( !empty( $args[ 'id' ] ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text color" '.( !empty( $value ) ? 'style="background:'.$value.';color:'.UixPBFormCore::readable_color( $value ).'"' : '' ).' chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'">' : '' ).' 
									   
									  
								</div>
								
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).'
				';	
			}

			
			
			$field .= '
			 
								
							</div>
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
          
                
            $jscode_vars = '
                '.( !empty( $args[ 'id' ] ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';
			
			$jscode = '';


        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
