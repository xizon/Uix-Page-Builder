<?php
class UixPBFormType_Toggle {
	
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
		
		
		//Toggle
        if ( $type == 'toggle' ) {
            
            $btn_text = '';
			$target_id = '';
			$link_class = '';

	
            if ( is_array( $default ) && !empty( $default ) ) {
                $btn_text = $default[ 'btn_text' ];
				$link_class = ( isset( $default[ 'btn_textclass' ] ) && !empty( $default[ 'btn_textclass' ] ) ) ? $default[ 'btn_textclass' ] : 'table-link-normal';
				
				//Toggle id
                foreach ( $default[ 'toggle_class' ] as $tid_value ) {
					$target_id .= '.'.$tid_value.','; 		
                }	
		
				
            }
			
			
			//inscure browser
			if( UixPBFormCore::is_IE() && UixPBFormCore::is_dynamic_input( $class ) ) {
				$new_class = str_replace( 'dynamic-row', 'isMSIE dynamic-row', $class );
			} else {
				$new_class = $class;
			}
		
		
			if ( $value == 1 ) {
				$open_class = 'open';
			}
			if ( $value == 0 ) {
				$open_class = '';
			}
		
			
            $field = '
                    <tr'.$new_class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						   <div class="uixpbform-box">
								<a href="javascript:" class="'.$link_class.' '.( $link_class == 'table-link-icon' ? 'table-link-iconattr' : '' ).' uixpbform_btn_trigger-toggleshow '.$open_class.'" data-this-targetid="'.$id.'" data-targetid="'.rtrim( $target_id, ',' ).'" data-list="0" data-targetid-clone="{multID}" title="'.esc_attr( $btn_text ).'">'.( $link_class == 'table-link-icon' ? '<i class="fa fa-sort-desc"></i>'.__( 'More Options', 'uix-page-builder' ) : $btn_text ).'</a>
								
								'.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.$value.'" >' : '' ).'
		
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 	
								
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
