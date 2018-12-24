<?php
class UixPBFormType_MarginPadding extends UixPBFormCore {
	
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
		
		if ( $type == 'margin-padding' ) {

			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						   
							<div class="uixpbform-box">
							   
							   <div class="uixpbform-input-text-margin-container">
							
								   <div class="dir top"><label><em>&uarr;</em><input '.$callback.' type="text" id="${'.$id.'_top__fieldID}" name="${'.$id.'_top__fieldID}" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" data-enter-value="true" value=" {{if '.$id.'_top__fieldVal}}${'.$id.'_top__fieldVal}{{else}}'.$value[ 'top' ].'{{/if}}"></label></div>
								   
								   <div class="dir right"><label><em>&rarr;</em><input '.$callback.' type="text" id="${'.$id.'_right__fieldID}" name="${'.$id.'_right__fieldID}" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" data-enter-value="true" value="{{if '.$id.'_right__fieldVal}}${'.$id.'_right__fieldVal}{{else}}'.$value[ 'right' ].'{{/if}}"></label></div>
								   
								   <div class="dir bottom"><label><em>&darr;</em><input '.$callback.' type="text" id="${'.$id.'_bottom__fieldID}" name="${'.$id.'_bottom__fieldID}" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" data-enter-value="true" value="{{if '.$id.'_bottom__fieldVal}}${'.$id.'_bottom__fieldVal}{{else}}'.$value[ 'bottom' ].'{{/if}}"></label></div>
								   
								   <div class="dir left"><label><em>&larr;</em><input '.$callback.' type="text" id="${'.$id.'_left__fieldID}" name="${'.$id.'_left__fieldID}" class="uixpbform-normal uixpbform-input-text uixpbform-input-text-margin" data-enter-value="true" value="{{if '.$id.'_left__fieldVal}}${'.$id.'_left__fieldVal}{{else}}'.$value[ 'left' ].'{{/if}}"></label></div>
					
								   
								   <div class="desc">
								   '.( !empty( $desc ) ? '<p class="info info-margin">'.$desc.'</p>' : '' ).' 
								   </div>
							   
							   </div>
			   	   
							   
							   
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	


		}
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
