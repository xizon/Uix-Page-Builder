<?php
class UixPBFormType_Margin {
	
	public static function add( $args, $args_config, $_output ) {
		
		if ( !is_array( $args ) ) return;
		if ( !is_array( $args_config ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
	
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$name             = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		
		$value            = ( is_array( $args[ 'value' ] ) && !empty( $args[ 'value' ] ) ) ? array(
									'top'     => ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_top', $args[ 'value' ][ 'top' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_top', '' ), 
									'right'   => ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_right', $args[ 'value' ][ 'right' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_right', '' ), 
									'bottom'  => ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_bottom', $args[ 'value' ][ 'bottom' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_bottom', '' ), 
									'left'    => ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_left', $args[ 'value' ][ 'left' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $id.'_left', '' ) 
				                ) : '';
		
		
		$new_id           = ( isset( $args[ 'id' ] ) ) ? array(
									'top'     => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $id.'_top' ) : '', 
									'right'   => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $id.'_right' ) : '', 
									'bottom'  => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $id.'_bottom' ) : '', 
									'left'    => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $id.'_left' ) : '' 
				                ) : '';
			
		$new_name          = ( isset( $args[ 'id' ] ) ) ? array(
									'top'     => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $id.'_top' ) : '', 
									'right'   => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $id.'_right' ) : '', 
									'bottom'  => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $id.'_bottom' ) : '', 
									'left'    => ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $id.'_left' ) : ''
				                ) : '';
		
		
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPBFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
		
		if ( $type == 'margin' ) {
			
            $units = '';

            if ( is_array( $default ) && !empty( $default ) ) {
                $units = $default[ 'units' ];
            }
			
			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    
							<div class="uixpbform-box">
							   
							   <div class="uixpbform-input-text-margin-container">
							
								   '.( !empty( $args[ 'id' ] ) ? '
								   <div class="dir top"><label><em>&uarr;</em><input type="text" id="'.$new_id[ 'top' ].'" name="'.$new_name[ 'top' ].'" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" chk-id-input="'.$new_id[ 'top' ].'" value="'.$value[ 'top' ].'"></label></div>
								   <div class="dir right"><label><em>&rarr;</em><input type="text" id="'.$new_id[ 'right' ].'" name="'.$new_name[ 'right' ].'" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" chk-id-input="'.$new_id[ 'right' ].'" value="'.$value[ 'right' ].'"></label></div>
								   <div class="dir bottom"><label><em>&darr;</em><input type="text" id="'.$new_id[ 'bottom' ].'" name="'.$new_name[ 'bottom' ].'" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" chk-id-input="'.$new_id[ 'bottom' ].'" value="'.$value[ 'bottom' ].'"></label></div>
								   <div class="dir left"><label><em>&larr;</em><input type="text" id="'.$new_id[ 'left' ].'" name="'.$new_name[ 'left' ].'" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" chk-id-input="'.$new_id[ 'left' ].'" value="'.$value[ 'left' ].'"></label></div>
								   ' : '' ).' 	
								   
								   <div class="desc">
								   '.( !empty( $desc ) ? '<p class="info info-margin">'.$desc.'</p>' : '' ).' 
								   </div>
							   
							   </div>
			   	   
							   
							   
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	

			$jscode_vars = '
			    '.( !empty( $args[ 'id' ] ) ? 'var '.$id.'_top'.' = $( "#'.$new_id[ 'top' ].'" ).val();'.PHP_EOL : '' ).'
				'.( !empty( $args[ 'id' ] ) ? 'var '.$id.'_right'.' = $( "#'.$new_id[ 'right' ].'" ).val();'.PHP_EOL : '' ).'
				'.( !empty( $args[ 'id' ] ) ? 'var '.$id.'_bottom'.' = $( "#'.$new_id[ 'bottom' ].'" ).val();'.PHP_EOL : '' ).'
				'.( !empty( $args[ 'id' ] ) ? 'var '.$id.'_left'.' = $( "#'.$new_id[ 'left' ].'" ).val();'.PHP_EOL : '' ).'
			';	

		}
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
