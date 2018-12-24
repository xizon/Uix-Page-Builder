<?php
class UixPBFormType_Note extends UixPBFormCore {
	
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
							
							   <input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}">
			   	   
							   '.( !empty( $desc ) ? '<p class="info info-'.$infotype.'">'.$desc.'</p>' : '' ).' 
							   
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	


		}
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
