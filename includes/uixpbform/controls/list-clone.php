<?php
class UixPBFormType_ListClone extends UixPBFormCore {
	
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
		
		$field            = '';
		
	
		
        if ( $type == 'list' ) {
			
            //Enqueue the media scripts
            wp_enqueue_media();
			
            
            $btn_text = '';
            $max = 3;
            $append_box_id = 'appendwrapper-'.$id;
			
			
			
            if ( is_array( $default ) && !empty( $default ) ) {
                $btn_text = isset( $default[ 'btn_text' ] ) ? $default[ 'btn_text' ] : esc_html__( 'click here to add an item', 'uix-page-builder' );
                $max      = isset( $default[ 'max' ] ) ? $default[ 'max' ] : 1;	
            }
			
		    
			
            $field = '
            
		
                <tr'.$class.'>
                    <th scope="row"><label>'.$title.'</label></th>
                    <td>
					
						<div class="uixpbform-box">
						   <a href="javascript:" class="addrow addrow-${colID} table-link-m uixpbform_btn_trigger-clone" data-clone-max="'.$max.'" data-clone-removeclass="delrow-'.$id.'-${colID}" data-clone-appendid="'.$append_box_id.'-${colID}" data-clone-sectionid="${sectionID}" data-clone-colid="${colID}" data-clone-formid="${formID}"  data-clone-index="1" title="'.esc_attr( $btn_text ).'"><i class="fa fa-plus"></i></a>
						   
						   <input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="'.$value.'">
						   
						 </div>
					
					    <div class="uixpbform-box">
                   
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
							  
						</div>
                         
                    </td>
                </tr>  
				
	            <tr>
                    <th scope="row"></th>
                    <td>
					
						<div class="dynamic-append-wrapper">
						    <div id="'.$append_box_id.'-${colID}"></div>
						</div>
                         
                    </td>
                </tr>  
				

                '.PHP_EOL;	
				
			 

        }
		
		
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
