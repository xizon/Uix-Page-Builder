<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_team2';

//clone list
$clone_trigger_id        = 'uix_pb_team2_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = [ 'uix_pb_team2_listitem_toggle_url1', 'uix_pb_team2_listitem_toggle_icon1', 'uix_pb_team2_listitem_toggle_url2', 'uix_pb_team2_listitem_toggle_icon2', 'uix_pb_team2_listitem_toggle_url3', 'uix_pb_team2_listitem_toggle_icon3' ];       



/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::page_builder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::page_builder_output( $value->content );
		
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::page_builder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
			if ( $col_content && is_array( $col_content ) ) {
				foreach ( $col_content as $key ) :
				    
					$detail_content = $key;
					
					//column id
					$colname           = $form_id.'-col';
					$cname             = str_replace( $form_id.'|', '', $key[1][0] );
					$id                = $key[0][1];
					$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_section_xxx-col' ];
					
				
					foreach ( $detail_content as $value ) :	
						$name           = str_replace( $form_id.'|', '', $value[0] );
						$content        = $value[1];
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];
						
					endforeach;
						
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}

/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];


$args_config = [
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
];						


$module_config = 
	[
	
		array(
			'id'             => 'uix_pb_team2_config_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_team2_config_intro' ,
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_team2_config_avatar_gray',
			'title'          => __( 'Gray Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, //0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	

		array(
			'id'             => 'uix_pb_team2_config_avatar_fillet',
			'title'          => __( 'Radius of Fillet Avatar', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => 'uix_pb_team2_config_list_height',
			'title'          => __( 'Height of Grid', 'uix-page-builder' ),
			'desc'           => __( 'Set height of grid so that it will fit its avatar photo. Browsers use a default stylesheet to render webpages if  the value is <strong>"0"</strong>.', 'uix-page-builder' ),
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		
		),		
		
		array(
			'id'             => 'uix_pb_team2_config_grid',
			'title'          => __( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 4,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'4'  => '4',
									'3'  => '3',
									'2'  => '2',
								)
		
		),		
		
		
	
	]
;


$form_type = [
    'list' => 1
];



$args = 
	[
		
		//------list begin

		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'',
											'type'      => 'image'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => [ 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
											 ]
										), 			
		

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_team2_listitem_avatar',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'', /*class of list item */
				'placeholder'    => __( 'Avatar URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
			array(
				'id'             => 'uix_pb_team2_listitem_name',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Name', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => 'uix_pb_team2_listitem_position',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Position', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => 'uix_pb_team2_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'The Introduction of this member.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => 'uix_pb_team2_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => [ 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
	                                     ]
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon1',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 1', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon2',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 2', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_url3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_team2_listitem_toggle_icon3',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 3', 'uix-page-builder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => $form_id.'_temp',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	
		


		
	
	]
;

//---
$form_html  = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::form_after();


//----
$form_js_vars  = '';
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'', $form_html, 'toggle-row' );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Team Grid', 'uix-page-builder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}

/**
 * Returns forms with ajax
 * ----------------------------------------------------
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
	
	
    /*-- Dynamic Adding Input ( Default Value ) --*/
	for ( $i = 2; $i <= $clone_max; $i++ ) {
		$uid = $i.'-';
		$field = 'uix_pb_team2_listitem_name';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [ 'uix_pb_team2_listitem_avatar', 'uix_pb_team2_listitem_name', 'uix_pb_team2_listitem_position', 'uix_pb_team2_listitem_intro', 'uix_pb_team2_listitem_toggle', 'uix_pb_team2_listitem_toggle_url1', 'uix_pb_team2_listitem_toggle_icon1', 'uix_pb_team2_listitem_toggle_url2', 'uix_pb_team2_listitem_toggle_icon2', 'uix_pb_team2_listitem_toggle_url3', 'uix_pb_team2_listitem_toggle_icon3' ];
							  
			UixPageBuilder::push_cloneform( $uid, $item, $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>

			var _config_t             = ( uix_pb_team2_config_title != undefined && uix_pb_team2_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_team2_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
				_config_desc          = ( uix_pb_team2_config_intro != undefined && uix_pb_team2_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_team2_config_intro+'</div>' : '',
				_config_gray          = ( uix_pb_team2_config_avatar_gray === true ) ? ' uix-pb-gray' : '',
				_config_height        = ( uix_pb_team2_config_list_height > 0 ) ? 'style="height:'+uixpbform_floatval( uix_pb_team2_config_list_height )+'px;"' : '',
				_config_avatar_fillet = uixpbform_floatval( uix_pb_team2_config_avatar_fillet ) + '%';


				
			/* List Item */
			var list_num               = <?php echo $clone_max; ?>,
				show_list_item         = '';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
					_avatar      = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ); ?>' ).val(),
					_name        = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ); ?>' ).val(),
					_pos         = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ); ?>' ).val(),
					_intro       = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ); ?>' ).val(),
					_toggleurl1  = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ); ?>' ).val(),
					_toggleicon1 = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ); ?>' ).val(),
					_toggleurl2  = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ); ?>' ).val(),
					_toggleicon2 = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ); ?>' ).val(),		_toggleurl3  = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ); ?>' ).val(),
					_toggleicon3 = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ); ?>' ).val();


				var _item_v_avatarURL       = ( _avatar != undefined && _avatar != '' ) ? _avatar : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
					_item_v_social_icon_1   = ( _toggleicon1 != undefined && _toggleicon1 != '' ) ? _toggleicon1 : 'link',
					_item_v_social_icon_2   = ( _toggleicon2 != undefined && _toggleicon2 != '' ) ? _toggleicon2 : 'link',
					_item_v_social_icon_3   = ( _toggleicon3 != undefined && _toggleicon3 != '' ) ? _toggleicon3 : 'link', 
					_item_v_social_out_1    = ( _toggleurl1 != undefined && _toggleurl1 != '' ) ? '<a href="'+encodeURI( _toggleurl1 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_1 )+'"></i></a>' : '',
					_item_v_social_out_2    = ( _toggleurl2 != undefined && _toggleurl2 != '' ) ? '<a href="'+encodeURI( _toggleurl2 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_2 )+'"></i></a>' : '',
					_item_v_social_out_3    = ( _toggleurl3 != undefined && _toggleurl3 != '' ) ? '<a href="'+encodeURI( _toggleurl3 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_3 )+'"></i></a>' : '',
					_item_v_pos             = ( _pos != undefined && _pos != '' ) ? '<em>'+_pos+'</em>' : '';





				if ( _intro != undefined && _intro != '' ) {

					//Do not include spaces

					show_list_item += '<div class="uix-pb-gallery-list uix-pb-gallery-list-col'+uix_pb_team2_config_grid+' '+_config_gray+'">';
					show_list_item += '<div class="uix-pb-gallery-list-imgbox" '+_config_height+'>';
					show_list_item += '<img src="'+encodeURI( _item_v_avatarURL )+'" alt="'+uixpbform_htmlEncode( _name )+'" style="-webkit-border-radius: '+_config_avatar_fillet+'; -moz-border-radius: '+_config_avatar_fillet+'; border-radius: '+_config_avatar_fillet+';">';
					show_list_item += _item_v_pos;
					show_list_item += '</div>';
					show_list_item += '<div class="uix-pb-gallery-list-info">';
					show_list_item += '<h3 class="uix-pb-gallery-list-title">'+_name+'</h3>';
					show_list_item += '<div class="uix-pb-gallery-list-desc">';
					show_list_item += '<p>'+_intro+'</p>';
					show_list_item += '</div>';
					show_list_item += '<div class="uix-pb-gallery-list-social">';
					show_list_item += _item_v_social_out_1;
					show_list_item += _item_v_social_out_2;
					show_list_item += _item_v_social_out_3;									
					show_list_item += '</div>';
					show_list_item += '</div>';
					show_list_item += '</div>';

				}


			}



			var temp = '';
				temp += _config_t;
				temp += _config_desc;
				temp += '<div class="uix-pb-gallery">';
				temp += show_list_item;
				temp += '</div>';	
			

			
			/* Save data */
			$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
			
		}
		
		uix_pb_temp();
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() { uix_pb_temp(); });
		
		
		
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

