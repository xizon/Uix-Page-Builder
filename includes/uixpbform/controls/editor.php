<?php
class UixPBFormType_Editor extends UixPBFormCore {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$name             = ( isset( $args[ 'name' ] ) ) ? $args[ 'name' ] : '';
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		$cls              = ( isset( $args[ 'class' ] ) ) ? $args[ 'class' ] : '';
		$class            = self::call_row_class( $id, $cls );
		$callback         = ( isset( $args[ 'callback' ] ) ) ? self::control_callback_type( $args[ 'callback' ] ) : '';
		
		$field       = '';
		
		
		if ( $type == 'editor' ) {
			
			$height     = 200;
			
			if ( is_array( $default ) && !empty( $default ) ) {
				$height    = ( isset( $default[ 'height' ] ) ) ? $default[ 'height' ] : 200;
				
			}
			
			
			ob_start();
			wp_editor( '', $id, array( 'textarea_rows' => 5,  'tinymce' => false ) );
			$editor_contents = ob_get_clean();
			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    
							<div class="uixpbform-box uixpbform-mce-editor">
							
							   <textarea data-enter-value="true" class="mce" rows="5" id="${'.$id.'__fieldID}-editor">{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}</textarea>
							   
							</div>
							
							'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
							
							<textarea data-enter-value="true" data-editor-height="'.$height.'" class="mce-sync" style="display:none;" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}">{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}</textarea>
						</td>
					</tr> 
				'.PHP_EOL;	


		}
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
