<?php
class UixFormType_ListClone {
	
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
		
		
        if ( $type == 'list' ) {
			
            //Enqueue the media scripts
            wp_enqueue_media();
			
            
            $btn_text = '';
            $max = 3;
            $append_box_id = 'appendwrapper-'.$id;
			$clone_id = '';
			$media_js = '';
			$clone_content_js_var = 'dynamic_append_box_content';
			
			
			
            if ( is_array( $default ) && !empty( $default ) ) {
                $btn_text = $default[ 'btn_text' ];
                $max = $default[ 'max' ];
				
				if ( isset( $default[ 'clone_content_js_var' ] ) ) {
					$clone_content_js_var =  $default[ 'clone_content_js_var' ];
				}
				
				
				//clone id
                foreach ( $default[ 'clone_class' ] as $tid_value ) {
					
					$clone_id .= '".'.$tid_value[ 'id' ].'",'; 
					$loop_trigger_id = str_replace( 'dynamic-row-', '', $tid_value[ 'id' ] );
					
					
					//-----
					if ( $tid_value[ 'type' ] == 'image' ) {
						
						$media_js .= '$( document ).uixform_uploadMediaCustom( { btnID: "#"+j_'.$id.'+"-trigger_id_'.$loop_trigger_id.'", closebtnID: "#"+j_'.$id.'+"-drop_trigger_id_'.$loop_trigger_id.'" } );'."\n";
					}	
					
					//-----
					if ( $tid_value[ 'type' ] == 'radio' ) {
						
						$media_js .= '$( document ).uixform_radioSelector( { containerID: "#"+j_'.$id.'+"-radio-selector-'.$loop_trigger_id.'", targetID: "#"+j_'.$id.'+"-'.$loop_trigger_id.'" } );'."\n";
					}
						
					
					//-----
					if ( $tid_value[ 'type' ] == 'color' ) {
						
						$media_js .= '$( document ).uixform_radioSelector( { containerID: "#"+j_'.$id.'+"-trigger_id_'.$loop_trigger_id.'", targetID: "#"+j_'.$id.'+"-'.$loop_trigger_id.'" } );'."\n";
					}		
					
					//-----
					if ( $tid_value[ 'type' ] == 'toggle' && !UixFormCore::is_IE() ) {
						
						//Toggle id
						$toggle_target_id = '';
						
						foreach ( $tid_value[ 'toggle_class' ] as $tid_value ) {
							$tid_value = str_replace( 'dynamic-row-', '', $tid_value );
							$toggle_target_id .= '#"+j_'.$id.'+"-'.$tid_value.','; 	
							
						}	
						
						$toggle_target_id = '"'.rtrim( $toggle_target_id, ',' ).'"';
						$media_js .= '$( document ).uixform_divToggle( { btnID: "#"+j_'.$id.'+"-trigger_id_'.$loop_trigger_id.'", targetID: '.$toggle_target_id.', list: 1 } );'."\n";
					}						
					
					
					
						
					
                }	
         
				
            }
			
			
            
            $field = '
            
		
                <tr'.$class.'>
                    <th scope="row"><label>'.$title.'</label></th>
                    <td>
					
						<div class="uixform-box">
						   <a href="javascript:" class="addrow addrow-'.$id.' table-link" data-index="2">'.$btn_text.'</a>
						 </div>
					
					    <div class="uixform-box">
                   
								'.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							  
						</div>
                         
                    </td>
                </tr>  
				
	            <tr>
                    <th scope="row"></th>
                    <td>
					
						<div class="dynamic-append-wrapper" id="'.$append_box_id.'"></div>
                         
                    </td>
                </tr>  
				

                '."\n";	
                
            $jscode = '

                /*-- Dynamic Adding Input  --*/


                $( document ).uixform_dynamicAddinginput({
                    btnID: ".addrow-'.$id.'",
                    removebtnClass: "delrow-'.$id.'",
                    appendID: "#'.$append_box_id.'",
                    cloneContent: '.$clone_content_js_var.',
                    maxInput: '.$max.'
                });
				for ( var j_'.$id.'=1;j_'.$id.'<='.$max.';j_'.$id.'++ ){
					'.$media_js.'
					
					
				}

            ';	
                

        }
		
		
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;


		
		
	}
	

}
