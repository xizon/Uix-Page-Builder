<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_features1';

//clone list
$clone_trigger_id_1        = 'uix_pb_features_col2_one_list';    // ID of clone trigger 
$clone_trigger_id_2        = 'uix_pb_features_col2_two_list';    // ID of clone trigger 
$clone_max                 = 10;                                 // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '';


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
$uix_pb_features_col2_config_title               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_config_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_features_col2_config_intro               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_config_intro', __( 'This is the description text for the title.', 'uix-pagebuilder' ) );


$uix_pb_features_col2_one_listitem_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_features_col2_one_listitem_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_features_col2_one_listitem_icon           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_icon', '' );

//--
$uix_pb_features_col2_two_listitem_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_features_col2_two_listitem_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_features_col2_two_listitem_icon           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_icon', '' );




//dynamic adding input
$list_features1_item_1 = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_features_col2_one_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		

		$icon         = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ] ) ) ? '<i class="fa fa-'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ].'"></i>' : '<i class="fa fa-check"></i>';	
		
		$list_features1_item_1 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_title]['.$sid.']' ].'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_desc]['.$sid.']' ].'</p></div>         
		</div>  
		';
	} 
	
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		

		$icon         = ( !empty( $uix_pb_features_col2_one_listitem_icon ) ) ? '<i class="fa fa-'.$uix_pb_features_col2_one_listitem_icon.'"></i>' : '<i class="fa fa-check"></i>';	
		
		$list_features1_item_1 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$uix_pb_features_col2_one_listitem_title.'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'.$uix_pb_features_col2_one_listitem_desc.'</p></div>         
		</div>   
		';	
		
	}
	
	
}
	
	
$list_features1_item_2 = '';
for ( $kk = 1; $kk <= $clone_max; $kk++ ) {
	$_uid = ( $kk >= 2 ) ? $kk.'-' : '';
	$_field = 'uix_pb_features_col2_two_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$icon         = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ] ) ) ? '<i class="fa fa-'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ].'"></i>' : '<i class="fa fa-check"></i>';	
		
		$list_features1_item_2 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_title]['.$sid.']' ].'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_desc]['.$sid.']' ].'</p></div>         
		</div>  
		';
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $kk == 1 ) {
		
		
		$icon         = ( !empty( $uix_pb_features_col2_two_listitem_icon ) ) ? '<i class="fa fa-'.$uix_pb_features_col2_two_listitem_icon.'"></i>' : '<i class="fa fa-check"></i>';	
		
		$list_features1_item_2 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$uix_pb_features_col2_two_listitem_title.'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'.$uix_pb_features_col2_two_listitem_desc.'</p></div>         
		</div>   
		';	
		
	}
	
	
}
	
				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-feature">
	<div class="uix-pb-row">
		<div class="uix-pb-col-6">
		{list_1}
		</div>
		<div class="uix-pb-col-6 uix-pb-col-last">
		{list_2}
		</div>
	</div>
</div><!-- /.uix-pb-feature -->          
';


$uix_pb_section_features1_temp = str_replace( '{list_1}', $list_features1_item_1,
                                 str_replace( '{list_2}', $list_features1_item_2,
								 str_replace( '{heading}', ( !empty( $uix_pb_features_col2_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_features_col2_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_features_col2_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_features_col2_config_intro.'</div>' : '' ),
							     $element_temp 
								 ) ) ) );



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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_config_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_features_col2_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_config_intro' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_features_col2_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	]
;



$form_type = [
    'list' => 2
];



$args_1 = 
	[
	
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-pagebuilder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_1,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id_1 ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'',
											'type'      => 'text'
										), 
										
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
																	

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			

			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_desc' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_desc,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_icon,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
		
		//------list end
		
		


		
	
	]
;

$args_2 = 
	[
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-pagebuilder' ),
			'type'           => 'text'
		
		),
	
		//------list begin
		array(
			'id'             => $clone_trigger_id_2,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id_2 ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
																		

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),

			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_desc' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_desc,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_icon,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
		
		//------list end	
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features1_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_features1_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_features1_temp,
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
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'html', __( 'Left Block', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'html', __( 'Right Block', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js_vars' );




$clone_value_1 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );

$clone_value_2 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_1, $clone_value_1 );
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_2, $clone_value_2 );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Features (2 Column)', 'uix-pagebuilder' ) ); ?>            
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
		$field = 'uix_pb_features_col2_one_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_title]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ]
								),
														
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id_1, $cur_id, $colid, $clone_value_1, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	
	for ( $ii = 2; $ii <= $clone_max; $ii++ ) {
		$uid = $ii.'-';
		$field = 'uix_pb_features_col2_two_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $ii;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_title]['.$sid.']' ]
								),
								
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ]
								),							
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id_2, $cur_id, $colid, $clone_value_2, $sid, $value, $clone_list_toggle_class );
	
		} 
	}	
	
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id_1; ?>__<?php echo $colid; ?>'], [data-spy='<?php echo $clone_trigger_id_2; ?>__<?php echo $colid; ?>']", function() {
			
			
			var tempcode                           = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_features_col2_config_title  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_config_title' ); ?>' ).val(),
				uix_pb_features_col2_config_intro  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_config_intro' ); ?>' ).val();
			
			
				
			if ( tempcode.length > 0 ) {
		
			
				/* List Item */
				var list_num         = <?php echo $clone_max; ?>,
					show_list_item_1 = '',
					show_list_item_2 = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid              = ( i >= 2 ) ? '#'+i+'-' : '#',
						_title_1          = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ); ?>' ).val(),
						_desc_1           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ); ?>' ).val(),
						_icon_1           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ); ?>' ).val(),

						_title_2           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ); ?>' ).val(),
						_desc_2            = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ); ?>' ).val(),
						_icon_2            = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ); ?>' ).val();

						
					var _item_v_icon_1         = ( _icon_1 != undefined && _icon_1 != '' ) ? '<i class="fa fa-'+_icon_1+'"></i>' : '<i class="fa fa-check"></i>',
						
						_item_v_icon_2         = ( _icon_2 != undefined && _icon_2 != '' ) ? '<i class="fa fa-'+_icon_2+'"></i>' : '<i class="fa fa-check"></i>';
						
						
						
					if ( _title_1 != undefined && _title_1 != '' ) {
										
						//Do not include spaces
						show_list_item_1 += '<div class="uix-pb-feature-li">';
						show_list_item_1 += '<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'+_item_v_icon_1+'</span>'+_title_1+'</h3>';
						show_list_item_1 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'+_desc_1+'</p></div>';             
						show_list_item_1 += '</div>';
	
					}
					
					
					if ( _title_2 != undefined && _title_2 != '' ) {
										
						//Do not include spaces
						show_list_item_2 += '<div class="uix-pb-feature-li">';
						show_list_item_2 += '<h3 class="uix-pb-feature-title"><span class="uix-pb-feature-icon-side">'+_item_v_icon_2+'</span>'+_title_2+'</h3>';
						show_list_item_2 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow"><p>'+_desc_2+'</p></div>';             
						show_list_item_2 += '</div>';
	
					}
	   	
					
				}
				
				
				var _config_t      = ( uix_pb_features_col2_config_title != undefined && uix_pb_features_col2_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_features_col2_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_features_col2_config_intro != undefined && uix_pb_features_col2_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_features_col2_config_intro+'</div>' : '';
								
				//---
				
	
				
				tempcode = tempcode.replace(/{list_1}/g, show_list_item_1 )
				                   .replace(/{list_2}/g, show_list_item_2 )
								   .replace(/{heading}/g, _config_t )
								   .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features1_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

