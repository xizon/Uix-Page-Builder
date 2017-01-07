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


/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-pagebuilder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $pid, 'uix-pagebuilder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::pagebuilder_output( $value->content );
		
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::pagebuilder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
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
 * Element Template
 * ----------------------------------------------------
 */

//clone list of toggle class value
$clone_list_toggle_class = '#{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'';       




$uix_pb_team2_config_title            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_team2_config_intro            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_intro', __( 'This is the description text for the title.', 'uix-pagebuilder' ) );
$uix_pb_team2_config_avatar_gray      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_avatar_gray', 0 ); // 0:false  1:true
$uix_pb_team2_config_avatar_gray_chk  = ( $uix_pb_team2_config_avatar_gray == 1 ) ? true : false;
$uix_pb_team2_config_avatar_fillet    = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_avatar_fillet', 0 ) );
$uix_pb_team2_config_list_height      = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_list_height', 0 ) );
$uix_pb_team2_config_grid             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_config_grid', 4 );


$uix_pb_team2_listitem_avatar         = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_avatar', '' ) );
$uix_pb_team2_listitem_name           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_name', __( 'Name', 'uix-pagebuilder' ) );
$uix_pb_team2_listitem_position       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_position', __( 'Position', 'uix-pagebuilder' ) );
$uix_pb_team2_listitem_intro          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_intro', __( 'The Introduction of this member.', 'uix-pagebuilder' ) );
$uix_pb_team2_listitem_toggle         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle', 0 ); // 0:close  1:open
$uix_pb_team2_listitem_toggle_url1    = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_url1', '' ) );
$uix_pb_team2_listitem_toggle_icon1   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_icon1', '' );
$uix_pb_team2_listitem_toggle_url2    = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_url2', '' ) );
$uix_pb_team2_listitem_toggle_icon2   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_icon2', '' );
$uix_pb_team2_listitem_toggle_url3    = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_url3', '' ) );
$uix_pb_team2_listitem_toggle_icon3   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_team2_listitem_toggle_icon3', '' );


//dynamic adding input
$list_team2_item_content = '';
$avatarfillet            =  $uix_pb_team2_config_avatar_fillet.'%';
$height                  = ( $uix_pb_team2_config_list_height > 0 ) ? 'style="height:'.$uix_pb_team2_config_list_height.'px;"' : '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_team2_listitem_name';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$avatarURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_avatar]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_avatar]['.$sid.']' ] : UixPBFormCore::photo_placeholder();
		
		$social_icon_1   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon1]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon1]['.$sid.']' ] : 'link';
		$social_icon_2   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon2]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon2]['.$sid.']' ] : 'link';
		$social_icon_3   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon3]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_icon3]['.$sid.']' ] : 'link'; 
		$social_out_1    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url1]['.$sid.']' ] ) ) ? '<a href="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url1]['.$sid.']' ] ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_1 ).'"></i></a>' : '';
		$social_out_2    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url2]['.$sid.']' ] ) ) ? '<a href="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url2]['.$sid.']' ] ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_2 ).'"></i></a>' : '';
		$social_out_3    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url3]['.$sid.']' ] ) ) ? '<a href="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_toggle_url3]['.$sid.']' ] ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_3 ).'"></i></a>' : '';   	
		
		$list_team2_item_content .= '
		<div class="uix-pb-gallery-list uix-pb-gallery-list-col'.$uix_pb_team2_config_grid.' '.( $uix_pb_team2_config_avatar_gray == 1 ? ' uix-pb-gray' : '' ).'">
			<div class="uix-pb-gallery-list-imgbox" '.$height.'>
				<img src="'.esc_url( $avatarURL ).'" alt="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_name]['.$sid.']' ] ).'" style="-webkit-border-radius: '.$avatarfillet.'; -moz-border-radius: '.$avatarfillet.'; border-radius: '.$avatarfillet.';">
				'.( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_position]['.$sid.']' ] )  ? '<span class="uix-pb-gallery-list-position">'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_position]['.$sid.']' ] ).'</span>' : '' ).'
			</div>
			<div class="uix-pb-gallery-list-info">
				<h3 class="uix-pb-gallery-list-title">'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_name]['.$sid.']' ] ).'</h3>	
				<div class="uix-pb-gallery-list-desc">
					<p>'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_team2_listitem_intro]['.$sid.']' ] ).'</p>
				</div>
				<div class="uix-pb-gallery-list-social">
					'.$social_out_1.'
					'.$social_out_2.'
					'.$social_out_3.'									
				
				</div>
				
			</div>
		</div>
		';	
		
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		

		$avatarURL       = ( !empty( $uix_pb_team2_listitem_avatar ) ) ? $uix_pb_team2_listitem_avatar : UixPBFormCore::photo_placeholder();
		$social_icon_1   = ( !empty( $uix_pb_team2_listitem_toggle_icon1 ) ) ? $uix_pb_team2_listitem_toggle_icon1 : 'link';
		$social_icon_2   = ( !empty( $uix_pb_team2_listitem_toggle_icon2 ) ) ? $uix_pb_team2_listitem_toggle_icon2 : 'link';
		$social_icon_3   = ( !empty( $uix_pb_team2_listitem_toggle_icon3 ) ) ? $uix_pb_team2_listitem_toggle_icon3 : 'link'; 
		$social_out_1    = ( !empty( $uix_pb_team2_listitem_toggle_url1 ) ) ? '<a href="'.esc_url( $uix_pb_team2_listitem_toggle_url1 ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_1 ).'"></i></a>' : '';
		$social_out_2    = ( !empty( $uix_pb_team2_listitem_toggle_url2 ) ) ? '<a href="'.esc_url( $uix_pb_team2_listitem_toggle_url2 ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_2 ).'"></i></a>' : '';
		$social_out_3    = ( !empty( $uix_pb_team2_listitem_toggle_url3 ) ) ? '<a href="'.esc_url( $uix_pb_team2_listitem_toggle_url3 ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_3 ).'"></i></a>' : '';   
		
		$list_team2_item_content .= '
		<div class="uix-pb-gallery-list uix-pb-gallery-list-col'.$uix_pb_team2_config_grid.' '.( $uix_pb_team2_config_avatar_gray == 1 ? ' uix-pb-gray' : '' ).'">
			<div class="uix-pb-gallery-list-imgbox" '.$height.'>
				<img src="'.esc_url( $avatarURL ).'" alt="'.esc_attr( $uix_pb_team2_listitem_name ).'" style="-webkit-border-radius: '.$avatarfillet.'; -moz-border-radius: '.$avatarfillet.'; border-radius: '.$avatarfillet.';">
				'.( !empty( $uix_pb_team2_listitem_position )  ? '<span class="uix-pb-gallery-list-position">'.uix_pb_kses( $uix_pb_team2_listitem_position ).'</span>' : '' ).'
			</div>
			<div class="uix-pb-gallery-list-info">
				<h3 class="uix-pb-gallery-list-title">'.uix_pb_kses( $uix_pb_team2_listitem_name ).'</h3>	
				<div class="uix-pb-gallery-list-desc">
					<p>'.uix_pb_kses( $uix_pb_team2_listitem_intro ).'</p>
				</div>
				<div class="uix-pb-gallery-list-social">
					'.$social_out_1.'
					'.$social_out_2.'
					'.$social_out_3.'									
				
				</div>
				
			</div>
		</div>
		';	
		
	}
	
}
	
				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-gallery">
	{list_content}
</div><!-- /.uix-pb-gallery -->        
';


$uix_pb_section_team2_temp = str_replace( '{list_content}', $list_team2_item_content,
								 str_replace( '{heading}', ( !empty( $uix_pb_team2_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_team2_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_team2_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_team2_config_intro.'</div>' : '' ),			  
					
							     $element_temp 
								 ) ) );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];



$args_config = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_team2_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_intro' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_team2_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_avatar_gray' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_avatar_gray' ),
			'title'          => __( 'Gray Avatar', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_team2_config_avatar_gray,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_team2_config_avatar_gray_chk
				                )
		
		
		),	

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_avatar_fillet' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_avatar_fillet' ),
			'title'          => __( 'Radius of Fillet Avatar', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_team2_config_avatar_fillet,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_list_height' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_list_height' ),
			'title'          => __( 'Height of Grid', 'uix-pagebuilder' ),
			'desc'           => __( 'Set height of grid so that it will fit its avatar photo. Browsers use a default stylesheet to render webpages if  the value is <strong>"0"</strong>.', 'uix-pagebuilder' ),
			'value'          => $uix_pb_team2_config_list_height,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		
		),		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_grid' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_config_grid' ),
			'title'          => __( 'Column', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_team2_config_grid,
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
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'',
											'type'      => 'image'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => [ 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
											 ]
										), 			
		

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_avatar' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_team2_listitem_avatar,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'', /*class of list item */
				'placeholder'    => __( 'Avatar URL', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									)
			
			),	
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_name' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_team2_listitem_name,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_position' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_team2_listitem_position,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_intro' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_team2_listitem_intro,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_team2_listitem_toggle,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-pagebuilder' ),
										'toggle_class'  => [ 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',
	                                     ]
									)
			
			),	
	
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_url1' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_url1,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-pagebuilder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_icon1' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_icon1,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 1', 'uix-pagebuilder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_url2' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_url2,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-pagebuilder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_icon2' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_icon2,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 2', 'uix-pagebuilder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_url3' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_url3,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', /*class of toggle item */
					'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-pagebuilder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_team2_listitem_toggle_icon3' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_team2_listitem_toggle_icon3,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'',/*class of toggle item */
					'placeholder'    => __( 'Choose Social Icon 3', 'uix-pagebuilder' ),
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),
		
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_team2_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_team2_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_team2_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),		


		
	
	]
;

//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'html', __( 'General Settings', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Team Grid', 'uix-pagebuilder' ) ); ?>            
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
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_avatar]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_name]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_position]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_intro]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_url1]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_icon1]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_url2]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_icon2]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_url3]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_team2_listitem_toggle_icon3]['.$sid.']' ]
								),
				
				
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
			
			
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() {
			
			
			var tempcode                             = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_team2_config_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_title' ); ?>' ).val(),
				uix_pb_team2_config_intro            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_intro' ); ?>' ).val(),
				uix_pb_team2_config_avatar_gray_chk  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_avatar_gray' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_team2_config_avatar_fillet    = uixpbform_floatval( $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_avatar_fillet' ); ?>' ).val() ) + '%',
				uix_pb_team2_config_list_height      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_list_height' ); ?>' ).val(),
				uix_pb_team2_config_grid             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_config_grid' ); ?>' ).val();
	
	
				
			if ( tempcode.length > 0 ) {
		
				
				
				var _config_t      = ( uix_pb_team2_config_title != undefined && uix_pb_team2_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_team2_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_team2_config_intro != undefined && uix_pb_team2_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_team2_config_intro+'</div>' : '',
					_config_gray   = ( uix_pb_team2_config_avatar_gray_chk === true ) ? ' uix-pb-gray' : '',
					_config_height = ( uix_pb_team2_config_list_height > 0 ) ? 'style="height:'+uixpbform_floatval( uix_pb_team2_config_list_height )+'px;"' : '';
;
						
					
				
				
				/* List Item */
				var list_num               = <?php echo $clone_max; ?>,
					show_list_item_content = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
						_avatar      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_avatar' ); ?>' ).val(),
						_name        = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_name' ); ?>' ).val(),
						_pos         = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_position' ); ?>' ).val(),
						_intro       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_intro' ); ?>' ).val(),
						_toggleurl1  = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url1' ); ?>' ).val(),
						_toggleicon1 = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon1' ); ?>' ).val(),
						_toggleurl2  = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url2' ); ?>' ).val(),
						_toggleicon2 = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon2' ); ?>' ).val(),		_toggleurl3  = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_url3' ); ?>' ).val(),
						_toggleicon3 = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_team2_listitem_toggle_icon3' ); ?>' ).val();
					
						
					var _item_v_avatarURL       = ( _avatar != undefined && _avatar != '' ) ? _avatar : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
						_item_v_social_icon_1   = ( _toggleicon1 != undefined && _toggleicon1 != '' ) ? _toggleicon1 : 'link',
						_item_v_social_icon_2   = ( _toggleicon2 != undefined && _toggleicon2 != '' ) ? _toggleicon2 : 'link',
						_item_v_social_icon_3   = ( _toggleicon3 != undefined && _toggleicon3 != '' ) ? _toggleicon3 : 'link', 
						_item_v_social_out_1    = ( _toggleurl1 != undefined && _toggleurl1 != '' ) ? '<a href="'+encodeURI( _toggleurl1 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_1 )+'"></i></a>' : '',
						_item_v_social_out_2    = ( _toggleurl2 != undefined && _toggleurl2 != '' ) ? '<a href="'+encodeURI( _toggleurl2 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_2 )+'"></i></a>' : '',
						_item_v_social_out_3    = ( _toggleurl3 != undefined && _toggleurl3 != '' ) ? '<a href="'+encodeURI( _toggleurl3 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_3 )+'"></i></a>' : '',
						_item_v_pos             = ( _pos != undefined && _pos != '' ) ? '<span class="uix-pb-gallery-list-position">'+_pos+'</span>' : '';
					
					
	
					
					
					
					if ( _intro != undefined && _intro != '' ) {
										
						//Do not include spaces
						
						show_list_item_content += '<div class="uix-pb-gallery-list uix-pb-gallery-list-col'+uix_pb_team2_config_grid+' '+_config_gray+'">';
						show_list_item_content += '<div class="uix-pb-gallery-list-imgbox" '+_config_height+'>';
						show_list_item_content += '<img src="'+encodeURI( _item_v_avatarURL )+'" alt="'+uixpbform_htmlEncode( _name )+'" style="-webkit-border-radius: '+uix_pb_team2_config_avatar_fillet+'; -moz-border-radius: '+uix_pb_team2_config_avatar_fillet+'; border-radius: '+uix_pb_team2_config_avatar_fillet+';">';
						show_list_item_content += _item_v_pos;
						show_list_item_content += '</div>';
						show_list_item_content += '<div class="uix-pb-gallery-list-info">';
						show_list_item_content += '<h3 class="uix-pb-gallery-list-title">'+_name+'</h3>';
						show_list_item_content += '<div class="uix-pb-gallery-list-desc">';
						show_list_item_content += '<p>'+_intro+'</p>';
						show_list_item_content += '</div>';
						show_list_item_content += '<div class="uix-pb-gallery-list-social">';
						show_list_item_content += _item_v_social_out_1;
						show_list_item_content += _item_v_social_out_2;
						show_list_item_content += _item_v_social_out_3;									
						show_list_item_content += '</div>';
						show_list_item_content += '</div>';
						show_list_item_content += '</div>';
	
					}
					
					
				}

                
				//---
				
				tempcode = tempcode.replace(/{list_content}/g, show_list_item_content )
								    .replace(/{heading}/g, _config_t )
								    .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_team2_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

