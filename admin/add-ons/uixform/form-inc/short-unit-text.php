<?php
class UixFormType_ShortUnitsText {
	
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
		
		
        if ( $type == 'short-units-text' ) {
            
            $unitslist = '';
			$unitsid = ( isset( $default[ 'units_id' ] ) ) ? $default[ 'units_id' ] : '';
			$unitsfirst = '';
			$i = 1;
            if ( is_array( $default ) && !empty( $default ) ) {
				$unitsfirst = $default[ 'units' ][0];
                foreach ( $default[ 'units' ] as $units_value ) {
					
					( $i == 1 ) ? $active = ' class="active"' : $active = '' ;
                    $unitslist .= '<span '.$active.' data-value="'.$units_value.'">'.$units_value.'</span>'."\n";	
					
					$i++;
                }	
            }
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixform-box">
                               
								<div class="uixform-input-text-short">
			
								   '.( !empty( $id ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixform-normal uixform-input-text" value="'.$value.'" placeholder="'.$placeholder.'">' : '' ).' 
								   '.( !empty( $unitsid ) ? '<input type="hidden" id="'.$unitsid.'" value="'.$unitsfirst.'">' : '' ).' 
								   
								   <span class="units units-short units-selector" id="units-selector-'.$unitsid.'">'.$unitslist.'</span>
						
								</div>
								
								'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								
							</div>
                            
                        </td>
                    </tr> 
                '."\n";	
                
				
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
				'.( !empty( $unitsid ) ? 'var '.$unitsid.' = $( "#'.$unitsid.'" ).val();'."\n" : '' ).'
            ';		
			
            $jscode = '

                /*-- Units Selector --*/
                $( document ).uixform_radioSelector({
                    containerID: "#units-selector-'.$unitsid.'",
                    targetID: "#'.$unitsid.'"
                });
            ';
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
