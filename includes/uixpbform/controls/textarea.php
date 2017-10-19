<?php
class UixPBFormType_Textarea extends UixPBFormCore {
	
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

		$field = '';
		
		if ( $type == 'textarea' ) {
			
			$row     = 5;
			$hide    = false;
			$tmpl    = false;

			if ( is_array( $default ) && !empty( $default ) ) {
				$row    = ( isset( $default[ 'row' ] ) ) ? $default[ 'row' ] : 5;
				$hide   = ( isset( $default[ 'hide' ] ) ) ? $default[ 'hide' ] : false;
				$tmpl   = ( isset( $default[ 'frontend_tmpl' ] ) ) ? $default[ 'frontend_tmpl' ] : false;
				
			}
			
			//If this is the HTML output code for each module, the <textarea> will be hidden in current form.
			$field = '
			        
					'.( !$hide ? '<tr'.$class.'>' : '<tr'.$class.' '.( $hide ? 'style="display:none"' : '' ).'>' ).' 
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    <div class="uixpbform-box">
						  
								<textarea '.( !empty( $callback ) && !self::inc_str( $callback, 'attr' ) ? $callback : '' ).' {{if '.$id.'__fieldVal}}data-tmpl-value="1"{{else}}data-tmpl-value="0"{{/if}} '.( $tmpl ? 'data-tmpl-enable="1"' : '' ).' rows="'.$row.'"  class="uixpbform-normal uixpbform-input-text '.( $tmpl ? 'uixpbform-tmpl-textarea' : '' ).' '.( !empty( $callback ) && self::inc_str( $callback, 'attr' ) ? 'uixpbform-input-text-spy-attrslug' : '' ).'" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" placeholder="'.$placeholder.'" data-enter-value="true">{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}</textarea>
								
								
								'.( !empty( $callback ) && self::inc_str( $callback, 'attr' ) ? '<input type="hidden" class="uixpbform-input-text-attr" id="${'.$id.'_attr__fieldID}" name="${'.$id.'_attr__fieldID}" value="{{if '.$id.'_attr__fieldVal}}${'.$id.'_attr__fieldVal}{{else}}'.self::to_attr( $value ).'{{/if}}">' : '' ).'
								

								
							   '.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	
				
    
		
		}

			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
