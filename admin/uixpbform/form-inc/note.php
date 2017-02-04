<?php
class UixPBFormType_Note {
	
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
		
		
		if ( $type == 'note' ) {
			
			$infotype  = 'note';
			$fullwidth = false;
			
			
			if ( is_array( $default ) && !empty( $default ) ) {
				$infotype  = ( isset( $default[ 'type' ] ) ) ? $default[ 'type' ] : 'note';
				$fullwidth = ( isset( $default[ 'fullwidth' ] ) ) ? $default[ 'fullwidth' ] : false;
			}
			
			$field = '
					<tr'.$class.'>
						'.( ! $fullwidth ? '<th scope="row"><label>'.$title.'</label></th>' : '' ).'
						<td>	
						    
							<div class="uixpbform-box">
							
							   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" chk-id-input="'.$id.'" value="'.$value.'">' : '' ).' 	
			   	   
							   '.( !empty( $desc ) ? '<p class="info info-'.$infotype.'">'.$desc.'</p>' : '' ).' 
							   
							   
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
