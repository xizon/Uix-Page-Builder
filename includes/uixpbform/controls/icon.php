<?php
class UixPBFormType_Icon extends UixPBFormCore {
	
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
		
		$tips = ( !empty( $placeholder ) ) ? $placeholder : __( 'Choose Icon', 'uix-page-builder' );
		$iconselector = UixPBFormCore::icon_attr( 'selector' );
		$iconprefix   = UixPBFormCore::icon_attr( 'prefix' );
		
		if ( $type == 'icon' ) {
			
			$social = false;
			
			//Icon list here ( without ajax that is to increase speed. )
			$iconlist = '<span data-containerid="icon-selector-${'.$id.'__fieldID}'.( ( $social ) ? '-social' : '' ).'" data-listurl="'.UixPBFormCore::plug_filepath().'includes/uixpbform/'.$iconselector.'" data-targetid="${'.$id.'__fieldID}" data-previewid="${'.$id.'__fieldID}-preview" class="icon-selector uixpbform-icon-selector" id="icon-selector-${'.$id.'__fieldID}"></span>';
			if ( is_array( $default ) && !empty( $default ) ) {
				$social = $default[ 'social' ];
				
				if ( $social ) $iconselector = 'fontawesome/font-awesome-social.php';
				
				if ( $social ) {
					
					//Icon list here ( without ajax that is to increase speed. )
					$iconlist = '<span data-containerid="icon-selector-${'.$id.'__fieldID}'.( ( $social ) ? '-social' : '' ).'" data-listurl="'.UixPBFormCore::plug_filepath().'includes/uixpbform/'.$iconselector.'" data-targetid="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" data-previewid="${'.$id.'__fieldID}-preview" class="icon-selector uixpbform-icon-selector icon-social" id="icon-selector-${'.$id.'__fieldID}-social"></span>';
				} 
			}
			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>
						    <div class="uixpbform-box">
						
						        <div class="uixpbform-icon-selector-preview-wrapper">
								
									<div class="uixpbform-icon-selector-icon-preview" id="${'.$id.'__fieldID}-preview">{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}<i class="'.$iconprefix.''.$value.'"></i>{{/if}}</div>

									<a href="javascript:" id="${'.$id.'__fieldID}-choosebtn" class="uixpbform-icon-selector-btn" title="'.esc_attr__( 'Choose Icon', 'uix-page-builder' ).'"><i class="fa fa-question"></i></a>

									<a href="javascript:" class="uixpbform-icon-clear">&times;</a>

									<div class="uixpbform-icon-selector-label" id="${'.$id.'__fieldID}-label">'.$tips.'<span class="uixpbform-loading icon" style="display:none"></span></div>
									
								</div>
								
								<input type="hidden" id="${'.$id.'__fieldID}" name="${'.$id.'__fieldID}" value="{{if '.$id.'__fieldVal}}${'.$id.'__fieldVal}{{else}}'.$value.'{{/if}}" >
								
								'.$iconlist.'
							
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
