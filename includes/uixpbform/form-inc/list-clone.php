<?php
class UixPBFormType_ListClone {
	
	public static function add( $args, $args_config, $_output, $section_row ) {
		
		if ( !is_array( $args ) ) return;
		if ( !is_array( $args_config ) ) return;
		
		//Row ID (Obtained via section ID.)
		$sid              = ( isset( $section_row ) ) ? $section_row : -1;
			
		//General
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], $args[ 'value' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], '' );
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		
		//ID of clone trigger
		$id               = ( isset( $args[ 'id' ] ) ) ? $args[ 'id' ] : '';
		//Column ID of clone trigger
		$colid            = ( isset( $args[ 'colid' ] ) ) ? $args[ 'colid' ] : '';
		
		$name             = ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $args[ 'id' ] ) : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPBFormCore::row_class( $args[ 'class' ] ).'"' : '';
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
			$clone_content_js_var = $id.'_clone_vars.value';
			$toggle_target_id = ''; //Toggle id
			
			
			
            if ( is_array( $default ) && !empty( $default ) ) {
                $btn_text = $default[ 'btn_text' ];
                $max = $default[ 'max' ];
				
				
				//clone id
                foreach ( $default[ 'clone_class' ] as $tid_value ) {
					
					
					$clone_id .= '".'.$tid_value[ 'id' ].'",'; 
					$loop_trigger_id = str_replace( 'dynamic-row-', '', $tid_value[ 'id' ] );
					
					
					//-----
					if ( $tid_value[ 'type' ] == 'toggle' ) {
						
						foreach ( $tid_value[ 'toggle_class' ] as $tid_value ) {
							$tid_value = str_replace( 'dynamic-row-', '', $tid_value );
							$toggle_target_id .= '#{dataID}'.$tid_value.','; 	
							
						}	
						
						$toggle_target_id = rtrim( $toggle_target_id, ',' );
					}						
					
					
                }
         
				
            }
			
			
            
            $field = '
            
		
                <tr'.$class.'>
                    <th scope="row"><label>'.$title.'</label></th>
                    <td>
					
						<div class="uixpbform-box">
						   <a href="javascript:" class="addrow addrow-'.$colid.' table-link-m uixpbform_btn_trigger-clone" data-targetid="'.$id.'" data-spy="'.$id.'__'.$colid.'" data-max="'.$max.'" data-clonecontent="'.$clone_content_js_var.'" data-removeclass="delrow-'.$id.'-'.$colid.'" data-appendid="'.$append_box_id.'-'.$colid.'" data-toggle-targetid="'.$toggle_target_id.'" data-section-row="'.$sid.'" data-colid="'.$colid.'"  data-index="2" title="'.esc_attr( $btn_text ).'"><i class="fa fa-plus"></i></a>
						 </div>
					
					    <div class="uixpbform-box">
                   
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
							  
						</div>
                         
                    </td>
                </tr>  
				
	            <tr>
                    <th scope="row"></th>
                    <td>
					
						<div class="dynamic-append-wrapper" id="'.$append_box_id.'-'.$colid.'"></div>
                         
                    </td>
                </tr>  
				

                '.PHP_EOL;	
				
			 

        }
		
		
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;


		
		
	}
	

}
