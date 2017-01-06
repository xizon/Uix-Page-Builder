<?php
class UixPBFormType_ShortUnitsText {
	
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
		
		
        if ( $type == 'short-units-text' ) {
            
            $unitslist = '';
			$unitsid = ( isset( $default[ 'units_id' ] ) ) ? $default[ 'units_id' ] : '';
			$unitsname = ( isset( $default[ 'units_name' ] ) ) ? $default[ 'units_name' ] : '';
			$unitsvalue = ( isset( $default[ 'units_value' ] ) ) ? $default[ 'units_value' ] : '';
			$unitsfirst = '';
			$i = 1;
            if ( is_array( $default ) && !empty( $default ) ) {
				$unitsfirst = $default[ 'units' ][0];
                foreach ( $default[ 'units' ] as $units_value ) {
					
					if ( $unitsvalue == '' ) {
						( $i == 1 ) ? $active = ' class="active"' : $active = '' ;
					} else {
						( $units_value == $unitsvalue ) ? $active = ' class="active"' : $active = '' ;
					}
					
                    $unitslist .= '<span '.$active.' data-value="'.$units_value.'">'.$units_value.'</span>'.PHP_EOL;	
					
					$i++;
                }	
            }
			
			if ( $unitsvalue == '' ) $unitsvalue = $unitsfirst;
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixpbform-box">
                               
								<div class="uixpbform-input-text-short">
			
								   '.( !empty( $id ) ? '<input type="text" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text" chk-id-input="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'">' : '' ).' 
								   '.( !empty( $unitsid ) ? '<input type="hidden" id="'.$unitsid.'" name="'.$unitsname.'" chk-id-input="'.$unitsid.'" value="'.$unitsvalue.'">' : '' ).' 
								   
								   <span class="units units-short units-selector uixpbform_btn_trigger-radio" data-targetid="'.$unitsid.'">'.$unitslist.'</span>
						
								</div>
								
								'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								
							</div>
                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
				
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
				'.( !empty( $unitsid ) ? 'var '.$unitsid.' = $( "#'.$unitsid.'" ).val();'.PHP_EOL : '' ).'
            ';		
			
            $jscode = '';
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
