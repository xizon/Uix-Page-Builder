<?php
class UixPBFormType_MultiSelector {
	
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
		

        if ( $type == 'multiselect' ) {
            
            $optionlist = '';
			
			if ( !is_array( $value ) ) {
				$value = explode( ',', $value );
			}
			
            if ( is_array( $default ) && !empty( $default ) ) {
                $optionloop = 1;
				$radiofirst = '';
                foreach ( $default as $select_key => $select_value ) {
					
					//multiple checkboxes
					if ( is_array( $value ) ) {
						
						$selected = '  class="multi"';
						
						foreach ( $value as $v ) {
							
								if ( $optionloop == $v ) {
									$selected = '  class="multi active"'; 
									$radiofirst .= $select_key.',';	
									
									break;
								} 
						
						}
					
					}
					
					$optionlist .= '<span data-value="'.$select_key.'" '.$selected.'>'.$select_value.'<i class="fa fa-check no"></i></span>'.PHP_EOL;	
			        
                    $optionloop ++;
                }	
            }
			
			if ( !is_array( $value ) ) {
				$optionlist = __( 'Must use the array for "value".', 'uix-page-builder' );
			} 
	
	
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								  <div class="radio uixpbform_btn_trigger-multradio" data-targetid="'.$id.'">	
								   '.$optionlist.' 
								   </div>
							   
								   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.rtrim( $radiofirst, ',' ).'">' : '' ).' 
						   
								   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								  
								
							</div>
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
            $jscode_vars = '
				'.( !empty( $id ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
            ';		
			
            $jscode = '';
		  
            

        }
		
		
		
		
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
