<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_features2';

//clone list
$clone_trigger_id        = 'uix_pb_features_col3_list';    // ID of clone trigger
$clone_max                 = 3;                                 // Maximum of clone form 

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
$uix_pb_features_col3_config_title               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_config_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_features_col3_config_intro               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_config_intro', __( 'This is the description text for the heading.', 'uix-pagebuilder' ) );


$uix_pb_features_col3_listitem_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_features_col3_listitem_titlecolor     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_titlecolor', '' );
$uix_pb_features_col3_listitem_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_features_col3_listitem_desccolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_desccolor', '' );
$uix_pb_features_col3_listitem_icon           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_icon', '' );
$uix_pb_features_col3_listitem_iconcolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col3_listitem_iconcolor', '' );


//dynamic adding input
$list_features2_item = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_features_col3_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		$titlecolor   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_titlecolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_titlecolor]['.$sid.']' ].'"' : '';
		$desccolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_desccolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_desccolor]['.$sid.']' ].'"' : '';
		$iconcolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_iconcolor]['.$sid.']' ] ) ) ? 'style="border-color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_iconcolor]['.$sid.']' ].';color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_iconcolor]['.$sid.']' ].'"' : '';
		$icon         = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_icon]['.$sid.']' ] ) ) ? '<i class="fa fa-'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_icon]['.$sid.']' ].'" '.$iconcolor.'></i>' : '<i class="fa fa-check" '.$iconcolor.'></i>';	
		$list_features2_item .= '<div class="uix-pb-col-4 '.( $k == 3 ? 'uix-pb-col-last' : '' ).'">';
		
		$list_features2_item .= '
			<div class="uix-pb-feature-li uix-pb-feature-li-c3">
			    <p class="uix-pb-feature-icon">'.$icon.'</p>
				  
				<h3 class="uix-pb-feature-title" '.$titlecolor.'>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_title]['.$sid.']' ].'</h3>
				<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col3_listitem_desc]['.$sid.']' ].'</p></div>     

			 </div>
		';
		$list_features2_item .= '</div>';
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		
		$titlecolor   = ( !empty( $uix_pb_features_col3_listitem_titlecolor ) ) ? 'style="color:'.$uix_pb_features_col3_listitem_titlecolor.'"' : '';
		$desccolor    = ( !empty( $uix_pb_features_col3_listitem_desccolor ) ) ? 'style="color:'.$uix_pb_features_col3_listitem_desccolor.'"' : '';
		$iconcolor    = ( !empty( $uix_pb_features_col3_listitem_iconcolor ) ) ? 'style="border-color:'.$uix_pb_features_col3_listitem_iconcolor.';color:'.$uix_pb_features_col3_listitem_iconcolor.'"' : '';
		$icon         = ( !empty( $uix_pb_features_col3_listitem_icon ) ) ? '<i class="fa fa-'.$uix_pb_features_col3_listitem_icon.'" '.$iconcolor.'></i>' : '<i class="fa fa-check" '.$iconcolor.'></i>';	
		
		
		$list_features2_item .= '
		<div class="uix-pb-col-4">
			<div class="uix-pb-feature-li uix-pb-feature-li-c3">
				<p class="uix-pb-feature-icon">'.$icon.'</p>
				<h3 class="uix-pb-feature-title" '.$titlecolor.'>'.$uix_pb_features_col3_listitem_title.'</h3>
				<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$uix_pb_features_col3_listitem_desc.'</p></div>         
			</div>
		</div>
		
		<div class="uix-pb-col-4">
			<div class="uix-pb-feature-li uix-pb-feature-li-c3">
				<p class="uix-pb-feature-icon">'.$icon.'</p>
				<h3 class="uix-pb-feature-title" '.$titlecolor.'>'.$uix_pb_features_col3_listitem_title.'</h3>
				<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$uix_pb_features_col3_listitem_desc.'</p></div>         
			</div>
		</div>
		
		<div class="uix-pb-col-4 uix-pb-col-last">
			<div class="uix-pb-feature-li uix-pb-feature-li-c3">
				<p class="uix-pb-feature-icon">'.$icon.'</p>
				<h3 class="uix-pb-feature-title" '.$titlecolor.'>'.$uix_pb_features_col3_listitem_title.'</h3>
				<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$uix_pb_features_col3_listitem_desc.'</p></div>         
			</div>  
		</div>
		';
	}
	
	
}

				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-feature">
	<div class="uix-pb-row">
		{list}
	</div>
</div><!-- /.uix-pb-feature -->          
';


$uix_pb_section_features2_temp = str_replace( '{list}', $list_features2_item,
								 str_replace( '{heading}', ( !empty( $uix_pb_features_col3_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_features_col3_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_features_col3_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_features_col3_config_intro.'</div>' : '' ),
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_config_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_features_col3_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_config_intro' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_features_col3_config_intro,
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
    'list' => 1
];



$args = 
	[
	
	
		array(
			'desc'           => sprintf( __( '<strong>Note:</strong>  %1$s items per row. Per section insert for a maximum of <strong>%1$s</strong>.', 'uix-pagebuilder' ), $clone_max ),
			'type'           => 'text'
		
		),
	 
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
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ).'',
											'type'      => 'colormap'
										), 		
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ).'',
											'type'      => 'colormap'
										), 		
										 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ).'',
											'type'      => 'colormap'
										), 										
																			

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col3_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_titlecolor' ),
				'title'          => '',
				'desc'           => __( 'Title Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col3_listitem_titlecolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)

			
			),	
		
			

			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_desc' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col3_listitem_desc,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_desccolor' ),
				'title'          => '',
				'desc'           => __( 'Description Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col3_listitem_desccolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col3_listitem_icon,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'', /*class of list item */
				'placeholder'    => __( 'Choose Feature Icon', 'uix-pagebuilder' ),
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col3_listitem_iconcolor' ),
				'title'          => '',
				'desc'           => __( 'Icon Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col3_listitem_iconcolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	

			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features2_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_features2_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_features2_temp,
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
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content Per Row', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );


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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Features (3 Column)', 'uix-pagebuilder' ) ); ?>            
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
		$field = 'uix_pb_features_col3_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_title]['.$sid.']' ]
								),
								
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_titlecolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_desccolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_icon]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col3_listitem_iconcolor]['.$sid.']' ]
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
			
			
			var tempcode                           = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_features_col3_config_title  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_config_title' ); ?>' ).val(),
				uix_pb_features_col3_config_intro  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_config_intro' ); ?>' ).val();
			
			
				
			if ( tempcode.length > 0 ) {
		
			
				/* List Item */
				var list_num         = <?php echo $clone_max; ?>,
					show_list_item = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid              = ( i >= 2 ) ? '#'+i+'-' : '#',
						_title          = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_title' ); ?>' ).val(),
						_titlecolor     = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_titlecolor' ); ?>' ).val(),
						_desc           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desc' ); ?>' ).val(),
						_desccolor      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_desccolor' ); ?>' ).val(),
						_icon           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_icon' ); ?>' ).val(),
						_iconcolor      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col3_listitem_iconcolor' ); ?>' ).val();

						
					var _item_v_titlecolor   = ( _titlecolor != undefined && _titlecolor != '' ) ? 'style="color:'+_titlecolor+'"' : '',
					    _item_v_title        = ( _title != undefined && _title != '' ) ? _title : '',
						_item_v_desccolor    = ( _desccolor != undefined && _desccolor != '' ) ? 'style="color:'+_desccolor+'"' : '',
						_item_v_desc         = ( _desc != undefined && _desc != '' ) ? _desc : '',
						_item_v_iconcolor    = ( _iconcolor != undefined && _iconcolor != '' ) ? 'style="border-color:'+_iconcolor+';color:'+_iconcolor+'"' : '',
						_item_v_icon         = ( _icon != undefined && _icon != '' ) ? '<i class="fa fa-'+_icon+'" '+_item_v_iconcolor+'></i>' : '<i class="fa fa-check" '+_item_v_iconcolor+'></i>',
						_item_v_col_lastclass  = ( i == 3 ) ? 'uix-pb-col-last' : '';
					
					
							
					show_list_item += '<div class="uix-pb-col-4 '+_item_v_col_lastclass+'">';
						
					if ( _title != undefined && _title != '' ) {
										
						//Do not include spaces
						
						show_list_item += '<div class="uix-pb-feature-li uix-pb-feature-li-c3">';
						show_list_item += '<p class="uix-pb-feature-icon">'+_item_v_icon+'</p>';
						show_list_item += '<h3 class="uix-pb-feature-title" '+_item_v_titlecolor+'>'+_item_v_title+'</h3>';
						show_list_item += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '+_item_v_desccolor+'><p>'+_item_v_desc+'</p></div>';             
						show_list_item += '</div>';
						
	
					}
					
					show_list_item += '</div>';
	   	
					
				}
				
				
				var _config_t      = ( uix_pb_features_col3_config_title != undefined && uix_pb_features_col3_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_features_col3_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_features_col3_config_intro != undefined && uix_pb_features_col3_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_features_col3_config_intro+'</div>' : '';
								
				//---
				
	
				
				tempcode = tempcode.replace(/{list}/g, show_list_item )
								   .replace(/{heading}/g, _config_t )
								   .replace(/{desc}/g, _config_desc );

								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features2_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

