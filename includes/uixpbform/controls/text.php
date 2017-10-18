<?php
class UixPBFormType_Text extends UixPBFormCore {
	
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
		
		if ( $type == 'text' ) {
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    
							<div class="uixpbform-box">
							
							
							
							   <input '.( !empty( $callback ) && !self::inc_str( $callback, 'slug' ) && !self::inc_str( $callback, 'attr' ) ? $callback : '' ).' type="text" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" class="uixpbform-normal uixpbform-input-text '.( !empty( $callback ) && ( self::inc_str( $callback, 'slug' ) || self::inc_str( $callback, 'attr' ) ) ? 'uixpbform-input-text-spy-attrslug' : '' ).'" data-enter-value="true" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" placeholder="'.$placeholder.'">
							   
							   
							   '.( !empty( $callback ) && self::inc_str( $callback, 'attr' ) ? '<input type="hidden" class="uixpbform-input-text-attr" id="${'.$id.'_attr__fieldID}" name="${'.$id.'_attr__fieldID}" value="{{if '.$id.'_attr__fieldVal}}${'.$id.'_attr__fieldVal}{{else}}'.self::to_attr( $value ).'{{/if}}">' : '' ).'


							   '.( !empty( $callback ) && self::inc_str( $callback, 'slug' ) ? '<input type="hidden" class="uixpbform-input-text-slug" id="${'.$id.'_slug__fieldID}" name="${'.$id.'_slug__fieldID}" value="{{if '.$id.'_slug__fieldVal}}${'.$id.'_slug__fieldVal}{{else}}'.sanitize_title_with_dashes( $value ).'{{/if}}">' : '' ).'
						
						
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
