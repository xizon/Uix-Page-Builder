<?php
class UixPBFormType_ShortText {
	
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
		
		
        if ( $type == 'short-text' ) {
            
            $units = '';
            if ( is_array( $default ) && !empty( $default ) ) {
                $units = $default[ 'units' ];
            }
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						    <div class="uixpbform-box">
								   
								<div class="uixpbform-input-text-short uixpbform-input-text-short-units">
			
								   '.( !empty( $id ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text" chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'">' : '' ).' 	
								   
								   <span class="units units-short">'.$units.'</span>
								   
								</div>
								
								'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								
							</div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';		
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
