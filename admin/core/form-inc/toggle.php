<?php
class UixPageBuilderForm_Toggle {
	
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
		
        if ( $type == 'toggle' ) {
            
            $btn_text = '';
			$target_id = '';
			$link_class = '';

	
            if ( is_array( $default ) && !empty( $default ) ) {
                $btn_text = $default[ 'btn_text' ];
				$link_class = ( isset( $default[ 'btn_textclass' ] ) && !empty( $default[ 'btn_textclass' ] ) ) ? $default[ 'btn_textclass' ] : 'table-link-normal';
				
				//Toggle id
                foreach ( $default[ 'toggle_class' ] as $tid_value ) {
					$target_id .= '.'.$tid_value.','; 		
                }	
		
				
            }
			
			
			//inscure browser
			if( UixPageBuilder::is_IE() && UixPageBuilder::is_dynamic_input( $class ) ) {
				$new_class = str_replace( 'dynamic-row', 'isMSIE dynamic-row', $class );
			} else {
				$new_class = $class;
			}
		
		
			
            $field = '
                    <tr'.$new_class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						   <div class="sweet-box">
								<a href="javascript:" id="trigger_id_'.$id.'" class="'.$link_class.'">'.$btn_text.'</a>
		
								'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 	
								
							</div>					

                            
                        </td>
                    </tr> 
                '."\n";	
                
                
            $jscode_vars = '
                '.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'."\n" : '' ).'
            ';
			

			
            $jscode = '
			    /*-- Toggle  --*/
                $( document ).uix_pb_divToggle( { btnID: "#trigger_id_'.$id.'", targetID: "'.rtrim( $target_id, ',' ).'" } );
            ';	
			
			//inscure browser
			if( UixPageBuilder::is_IE() && UixPageBuilder::is_dynamic_input( $class ) ) {
				$jscode = '';
			}
                

        }	
			
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;

		
		
	}
	

}
