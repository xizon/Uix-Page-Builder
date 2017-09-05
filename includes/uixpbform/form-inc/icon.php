<?php
class UixPBFormType_Icon {
	
	public static function add( $args, $args_config, $_output ) {
		
		if ( !is_array( $args ) ) return;
		if ( !is_array( $args_config ) ) return;
			
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$desc             = ( isset( $args[ 'desc' ] ) ) ? $args[ 'desc' ] : '';
		$default          = ( isset( $args[ 'default' ] ) && !empty( $args[ 'default' ] ) ) ? $args[ 'default' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], $args[ 'value' ] ) : UixPBFormCore::fvalue( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args_config[ 'items' ], $args[ 'id' ], '' );
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? $args[ 'placeholder' ] : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fid( $args_config[ 'col_id' ], $args_config[ 'sid' ], $args[ 'id' ] ) : '';
		$name             = ( isset( $args[ 'id' ] ) ) ? UixPBFormCore::fname( $args_config[ 'col_id' ], $args_config[ 'form_id' ], $args[ 'id' ] ) : '';
		$type             = ( isset( $args[ 'type' ] ) ) ? $args[ 'type' ] : '';
		$class            = ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) ? ' class="'.UixPBFormCore::row_class( $args[ 'class' ] ).'"' : '';
		$toggle           = ( isset( $args[ 'toggle' ] ) && !empty( $args[ 'toggle' ] ) ) ? $args[ 'toggle' ] : '';
		
		$field = '';
		$jscode = '';
		$jscode_vars = '';
		
		$tips = ( !empty( $placeholder ) ) ? $placeholder : __( 'Choose Icon', 'uix-page-builder' );
		$iconselector = UixPBFormCore::icon_attr( 'selector' );
		$iconprefix   = UixPBFormCore::icon_attr( 'prefix' );
		
		if ( $type == 'icon' ) {
			
			$social = false;
			
			//Icon list here ( without ajax that is to increase speed. )
			$iconlist = '<span contain-id="icon-selector-'.$id.''.( ( $social ) ? '-social' : '' ).'" list-url="'.UixPBFormCore::plug_filepath().'includes/uixpbform/'.$iconselector.'" target-id="'.$id.'" name="'.$name.'" preview-id="'.$id.'-preview" class="icon-selector uixpbform-icon-selector" id="icon-selector-'.$id.'"></span>';
			if ( is_array( $default ) && !empty( $default ) ) {
				$social = $default[ 'social' ];
				
				if ( $social ) $iconselector = 'fontawesome/font-awesome-social.php';
				
				if ( $social ) {
					
					//Icon list here ( without ajax that is to increase speed. )
					$iconlist = '<span contain-id="icon-selector-'.$id.''.( ( $social ) ? '-social' : '' ).'" list-url="'.UixPBFormCore::plug_filepath().'includes/uixpbform/'.$iconselector.'" target-id="'.$id.'" name="'.$name.'" preview-id="'.$id.'-preview" class="icon-selector uixpbform-icon-selector icon-social" id="icon-selector-'.$id.'-social"></span>';
				} 
			}
			
			$field = '
					<tr'.$class.'>
						<th scope="row"><label>'.$title.'</label></th>
						<td>
						    <div class="uixpbform-box">
						
						        <div class="uixpbform-icon-selector-preview-wrapper">
								
									<div class="uixpbform-icon-selector-icon-preview" id="'.$id.'-preview">'.( ( !empty( $value ) ) ? '<i class="'.$iconprefix.''.$value.'"></i>' : '' ).'</div>

									<a href="javascript:" id="'.$id.'-choosebtn" class="uixpbform-icon-selector-btn" title="'.esc_attr__( 'Choose Icon', 'uix-page-builder' ).'"><i class="fa fa-question"></i></a>

									<a href="javascript:" class="uixpbform-icon-clear">&times;</a>

									<div class="uixpbform-icon-selector-label" id="'.$id.'-label">'.$tips.'<span class="uixpbform-loading icon" style="display:none"></span></div>
									
								</div>
								
								'.( !empty( $args[ 'id' ] ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text" chk-id-input="'.$id.'" value="'.$value.'">' : '' ).'
								'.$iconlist.'
							
							   '.( !empty( $desc ) ? '<p class="info info-fly">'.$desc.'</p>' : '' ).' 
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	
				
				
			$jscode_vars = '
				'.( !empty( $args[ 'id' ] ) ? 'var '.$args[ 'id' ].' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
				
			';	
					
		
			
			
		}	
		
		
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;


		
		
	}
	

}
