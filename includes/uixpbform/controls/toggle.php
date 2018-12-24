<?php
class UixPBFormType_Toggle extends UixPBFormCore {
	
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
		
		$field       = '';
		
		
		//Toggle
        if ( $type == 'toggle' ) {
            
            $btn_text   = '';
			$target_id  = '';
			$link_class = '';

	
            if ( is_array( $toggle ) && !empty( $toggle ) ) {
                $btn_text   = $toggle[ 'btn_text' ];
				$link_class = ( isset( $toggle[ 'btn_textclass' ] ) && !empty( $toggle[ 'btn_textclass' ] ) ) ? $toggle[ 'btn_textclass' ] : 'table-link-normal';
				
				//Target ids
                foreach ( $toggle[ 'target_ids' ] as $tid_value ) {
					$target_id .= ''.$tid_value.','; 		
                }	
		
				
            }
			
		
			
            $field = '
                    <tr'.$class.'>
                        <th scope="row"><label>'.$title.'</label></th>
                        <td>
						
						   <div class="uixpbform-box">
								<a data-trigger-clone="0" href="javascript:" class="'.$link_class.' '.( $link_class == 'table-link-icon' ? 'table-link-iconattr' : '' ).' uixpbform_btn_trigger-toggleshow" data-targetid="'.$target_id.'" title="'.esc_attr( $btn_text ).'">'.( $link_class == 'table-link-icon' ? '<i class="fa fa-sort-desc"></i>'.__( 'More Options', 'uix-page-builder' ) : $btn_text ).'</a>
								
								<input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" >
		
								'.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 	
								
							</div>					

                            
                        </td>
                    </tr> 
                '.PHP_EOL;	
                
      

        }	
			
		//output code
		if ( $_output == 'html' ) return $field;

		
		
	}
	

}
