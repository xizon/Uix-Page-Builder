<?php
class UixFormType_Slider {
	
	public static function add( $args, $_output ) {
		
		if ( !is_array( $args ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? $args[ 'value' ] : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
		
        if ( $type == 'slider' ) {
            
            $units = '';
			$min = '';
			$max = '';
			$step = '';
			$units_id = '';
			
            if ( is_array( $default ) && !empty( $default ) ) {
				$min = $default[ 'min' ];
				$max = $default[ 'max' ];
				$step = $default[ 'step' ];
				$units = ( isset( $default[ 'units' ] ) ) ? $default[ 'units' ] : '';
				$units_id = ( isset( $default[ 'units_id' ] ) ) ? $default[ 'units_id' ] : '';
            }
	
            
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						    <div class="uixform-box">
                               
								   '.( !empty( $units_id ) ? '<input type="hidden" id="'.$units_id.'" value="'.$units.'">' : '' ).' 
								   
								   '.( !empty( $id ) ? '
									<div class="uixform-range-container">
										<input type="range" class="uixform-normal uixform-range" id="'.$id.'" name="$___$+form[ $___$thisFormName$___$ ]+$___$|['.$id.']" value="'.$value.'" min="'.$min.'" max="'.$max.'" step="'.$step.'" oninput="uixform_rangeSlider(this.id, \'slider_output_'.$id.'\', \''.$units.'\' )">
										<output class="uixform-range-txt" id="slider_output_'.$id.'">'.$value.''.$units.'</output>
									</div>
								   ' : '' ).' 
							   
									
								   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
								  
							  </div>
                            
                        </td>
                    </tr> 
                '."\n";	
                
				
            $jscode_vars = '
				'.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
				'.( !empty( $units_id ) ? 'var '.$units_id.' = $( "#'.$units_id.'" ).val();'."\n" : '' ).'
            ';		
		
            

        }
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
