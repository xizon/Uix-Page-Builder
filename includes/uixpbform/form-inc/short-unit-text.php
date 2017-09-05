<?php
class UixPBFormType_ShortUnitsText {
	
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
		
		
        if ( $type == 'short-units-text' ) {
            
            $unitslist = '';
			$unitsid = ( isset( $default[ 'units_id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $default[ 'units_id' ] ) : '';
			$unitsname = ( isset( $default[ 'units_id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $default[ 'units_id' ] ) : '';
			$unitsvalue = ( isset( $default[ 'units_value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'units_id' ], $default[ 'units_value' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $default[ 'units_id' ], '' );
			$unitsfirst = '';
			
            $jscode_vars .= '
				'.( !empty( $unitsid ) ? 'var '.$default[ 'units_id' ].' = $( "#'.$unitsid.'" ).val();'.PHP_EOL : '' ).'
            ';	
			
			
			$i = 1;
            if ( is_array( $default ) && !empty( $default ) ) {
				$unitsfirst = $default[ 'units' ][0];
                foreach ( $default[ 'units' ] as $units_value ) {
					
					if ( $unitsvalue == '' ) {
						( $i == 1 ) ? $active = ' class="active"' : $active = '' ;
					} else {
						( $units_value == $unitsvalue ) ? $active = ' class="active"' : $active = '' ;
					}
					
                    $unitslist .= '<span '.$active.' data-value="'.$units_value.'">'.$units_value.'</span>'.PHP_EOL;	
					
					$i++;
                }	
            }
			
			if ( $unitsvalue == '' ) $unitsvalue = $unitsfirst;
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								<div class="uixpbform-input-text-short">
			
								   '.( !empty( $args[ 'id' ] ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text" chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'">' : '' ).' 
								   '.( !empty( $unitsid ) ? '<input type="hidden" id="'.$unitsid.'" name="'.$unitsname.'" chk-id-input="'.$unitsid.'" value="'.$unitsvalue.'">' : '' ).' 
								   
								   <span class="units units-short units-selector uixpbform_btn_trigger-radio" data-targetid="'.$unitsid.'">'.$unitslist.'</span>
						
								</div>
								
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
								
							</div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
            $jscode_vars .= '
                '.( !empty( $args[ 'id' ] ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
