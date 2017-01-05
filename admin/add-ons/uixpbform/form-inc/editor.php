<?php
class UixPBFormType_Editor {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$name             = ( isset( $args[ 'name' ] ) ) ? $args[ 'name' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPBFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
		
		if ( $type == 'editor' ) {
			
			$row     = 5;
			$format  = true;
			$the_var = '';
			
			if ( is_array( $default ) && !empty( $default ) ) {
				$row    = ( isset( $default[ 'row' ] ) ) ? $default[ 'row' ] : 5;
				$format = ( isset( $default[ 'format' ] ) ) ? $default[ 'format' ] : true;
				
				if ( $format ) {
					$the_var = 'var '.$id.' = uixpbform_formatTextarea( $( "#'.$id.'" ).val() );';
				} else {
					$the_var = 'var '.$id.' = $( "#'.$id.'" ).val();';
				}
			}
			
			
			ob_start();
			wp_editor( $value, $id, array( 'textarea_name' => $name, 'textarea_rows' => $row,  'tinymce' => false ) );
			$editor_contents = ob_get_clean();
			$editor_contents = str_replace( 'id="'.$id.'"', 'id="'.$id.'" placeholder="'.$placeholder.'" chk-id-textarea="'.$id.'"', $editor_contents );
			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    
							<div class="uixpbform-box uixpbform-mce-editor">
							
							   <textarea class="mce" rows="'.$row.'" id="'.$id.'-editor">'.( $format ? $value : UixPBFormCore::html_textareaTran( $value ) ).'</textarea>
							   
							   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							   
							   
							</div>
							'.( !empty( $id ) ? '<textarea style="display:none;" id="'.$id.'" name="'.$name.'" chk-id-textarea="'.$id.'">'.( $format ? $value : UixPBFormCore::html_textareaTran( $value ) ).'</textarea>' : '' ).' 	
						</td>
					</tr> 
				'.PHP_EOL;	

			$jscode_vars = '
				'.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
			';	

		}
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
