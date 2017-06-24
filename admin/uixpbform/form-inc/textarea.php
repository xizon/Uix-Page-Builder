<?php
class UixPBFormType_Textarea {
	
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
		
		if ( $type == 'textarea' ) {
			
			$row     = 5;
			$format  = true;
			
			if ( is_array( $default ) && !empty( $default ) ) {
				$row    = ( isset( $default[ 'row' ] ) ) ? $default[ 'row' ] : 5;
				$format = ( isset( $default[ 'format' ] ) ) ? $default[ 'format' ] : true;
				$hide   = ( isset( $default[ 'hide' ] ) ) ? $default[ 'hide' ] : false;
				$tmpl   = ( isset( $default[ 'tmpl' ] ) ) ? $default[ 'tmpl' ] : false;
				
			}
			
			$field = '
			        
					'.( !$hide ? '<tr'.$class.'>' : '<tr'.$class.' '.( $hide ? 'style="display:none"' : '' ).'>' ).' 
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    <div class="uixpbform-box">
						  
							   '.( !empty( $args[ 'id' ] ) ? '<textarea '.( empty( $value ) ? 'data-tmpl-value="0"' : 'data-tmpl-value="1"' ).' '.( $tmpl ? 'data-tmpl-id="'.UixPageBuilder::frontend_wrapper_id( $id ).'"' : '' ).' rows="'.$row.'"  class="uixpbform-normal uixpbform-input-text '.( $tmpl ? 'uixpbform-tmpl-textarea' : '' ).'" id="'.$id.'" name="'.$name.'" placeholder="'.$placeholder.'" chk-id-textarea="'.$id.'">'.( $format ? $value : UixPBFormCore::html_textareaTran( $value ) ).'</textarea>' : '' ).' 					   	   
							   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							   
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
