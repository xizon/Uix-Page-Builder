<?php
class UixPageBuilderForm_Margin {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPageBuilder::row_class( $args[ 'class' ] ).'"' : '';
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
						    
							<div class="sweet-box">
							   
							   <div class="sweet-input-text-margin-container">
							
								   '.( !empty( $id ) ? '
								   <div class="dir top"><label><em>&uarr;</em><input type="text" id="'.$id.'_top" class="sweet-normal sweet-input-text sweet-input-text-margin" value="'.$value[ 'top' ].'"></label></div>
								   <div class="dir right"><label><em>&rarr;</em><input type="text" id="'.$id.'_right" class="sweet-normal sweet-input-text sweet-input-text-margin" value="'.$value[ 'right' ].'"></label></div>
								   <div class="dir bottom"><label><em>&darr;</em><input type="text" id="'.$id.'_bottom" class="sweet-normal sweet-input-text sweet-input-text-margin" value="'.$value[ 'bottom' ].'"></label></div>
								   <div class="dir left"><label><em>&larr;</em><input type="text" id="'.$id.'_left" class="sweet-normal sweet-input-text sweet-input-text-margin" value="'.$value[ 'left' ].'"></label></div>
								   ' : '' ).' 	
								   
								   <div class="desc">
								   '.( !empty( $desc ) ? '<p class="info info-margin">'.$desc.'</p>' : '' ).' 
								   </div>
							   
							   </div>
			   	   
							   
							   
							   
							</div>
						</td>
					</tr> 
				'."\n";	

			$jscode_vars = '
				'.( !empty( $id ) ? '
				var '.$id.'_top = $( "#'.$id.'_top" ).val(),
				    '.$id.'_right = $( "#'.$id.'_right" ).val(),
					'.$id.'_bottom = $( "#'.$id.'_bottom" ).val(),
					'.$id.'_left = $( "#'.$id.'_left" ).val();
				'."\n" : '' ).'
			';	

		}
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
