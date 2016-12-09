<?php
class UixPBFormType_Textarea {
	
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
		
		
		if ( $type == 'textarea' ) {
			
			$row     = 5;
			$format  = true;
			$the_var = '';
			
			if ( is_array( $default ) && !empty( $default ) ) {
				$row    = ( isset( $default[ 'row' ] ) ) ? $default[ 'row' ] : 5;
				$format = ( isset( $default[ 'format' ] ) ) ? $default[ 'format' ] : true;
				$hide   = ( isset( $default[ 'hide' ] ) ) ? $default[ 'hide' ] : false;
				
				if ( !$hide ) {
					if ( $format ) {
						$the_var = 'var '.$id.' = uixpbform_formatTextarea( $( "#'.$id.'" ).val() );';
					} else {
						$the_var = 'var '.$id.' = $( "#'.$id.'" ).val();';
					}

				}
			}
			
			$field = '
			        
					'.( !$hide ? '<tr'.$class.'>' : '<tr'.$class.' '.( $hide ? 'style="display:none"' : '' ).'>' ).' 
						<th scope="row"><label>'.$title.'</label></th>
						<td>	
						    <div class="uixpbform-box">
						
							   '.( !empty( $id ) ? '<textarea rows="'.$row.'"  class="uixpbform-normal uixpbform-input-text" id="'.$id.'" name="'.$name.'" placeholder="'.$placeholder.'" chk-id-textarea="'.$id.'">'.$value.'</textarea>' : '' ).' 					   	   
							   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							   
							</div>
						</td>
					</tr> 
				'."\n";	
				
			$jscode_vars = '
				'.( !empty( $id ) ? ''.$the_var.''."\n" : '' ).'
			';	
			
			$jscode = '';
			
			
		
		}

			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
