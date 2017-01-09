<?php
class UixPBFormType_Icon {
	
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
		
		$tips = ( !empty( $placeholder ) ) ? $placeholder : __( 'Choose Icon', 'uix-page-builder' );
		$iconselector = UixPBFormCore::icon_attr( 'selector' );
		$iconprefix   = UixPBFormCore::icon_attr( 'prefix' );
		
		if ( $type == 'icon' ) {
			
			$social = false;
			
			//Icon list here ( without ajax that is to increase speed. )
			$iconlist = '<span contain-id="icon-selector-'.$id.''.( ( $social ) ? '-social' : '' ).'" list-url="'.UixPBFormCore::plug_filepath().'admin/uixpbform/'.$iconselector.'" target-id="'.$id.'" name="'.$name.'" preview-id="'.$id.'-preview" class="icon-selector uixpbform-icon-selector" id="icon-selector-'.$id.'"></span>';
			if ( is_array( $default ) && !empty( $default ) ) {
				$social = $default[ 'social' ];
				
				if ( $social ) $iconselector = 'fontawesome/font-awesome-social.php';
				
				if ( $social ) {
					
					//Icon list here ( without ajax that is to increase speed. )
					$iconlist = '<span contain-id="icon-selector-'.$id.''.( ( $social ) ? '-social' : '' ).'" list-url="'.UixPBFormCore::plug_filepath().'admin/uixpbform/'.$iconselector.'" target-id="'.$id.'" name="'.$name.'" preview-id="'.$id.'-preview" class="icon-selector uixpbform-icon-selector icon-social" id="icon-selector-'.$id.'-social"></span>';
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
								
								'.( !empty( $id ) ? '<input type="hidden" id="'.$id.'" name="'.$name.'" class="uixpbform-normal uixpbform-input-text" chk-id-input="'.$id.'" value="'.$value.'">' : '' ).'
								'.$iconlist.'
							
							   '.( !empty( $desc ) ? '<p class="info">'.$desc.'</p>' : '' ).' 
							   
							</div>
						</td>
					</tr> 
				'.PHP_EOL;	
				
				
			$jscode_vars = '
				'.( !empty( $id ) ? 'var '.$id.' = $( "#'.$id.'" ).val();'.PHP_EOL : '' ).'
				
			';	
					
		
			
			
		}	
		
		
		//output code
		if ( $_output == 'html' ) return $field;
		if ( $_output == 'js' ) return $jscode;
		if ( $_output == 'js_vars' ) return $jscode_vars;


		
		
	}
	

}
