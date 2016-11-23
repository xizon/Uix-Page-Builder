<?php
class UixFormType_Color {
	
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
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
        if ( $type == 'color' ) {
            
            $colorlist = '';
            if ( is_array( $default ) && !empty( $default ) ) {
                foreach ( $default as $color_value ) {
					
					( $value == $color_value ) ? $active = ' class="active"' : $active = '' ;
					
                    $colorlist .= '<span '.$active.' style="background:'.$color_value.'" data-value="'.$color_value.'"></span>'."\n";	
                }	
            }
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>		
						    
							<div class="uixform-box">
								  <div class="uixform-color-selector" id="trigger_id_'.$id.'">	
								   '.$colorlist.' 
								   </div>
								   '.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" value="'.$value.'">' : '' ).' 
	
								   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							 </div> 
                        </td>
                    </tr> 
                '."\n";	
                
                
                
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
            ';
            $jscode = '

                /*-- Color Selector --*/
                $( document ).uixform_radioSelector({
                    containerID: "#trigger_id_'.$id.'",
                    targetID: "#'.$id.'"
                });
            ';

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
