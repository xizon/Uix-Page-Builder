<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_hello';

//clone list
$clone_trigger_id        = 'uix_pb_hello_list';    // ID of clone trigger 
$clone_max               = 4;                     // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '#{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ).', #{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ).'';                    


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
			$col         = $value->col;
			$row         = $value->row;
			$size_x      = $value->size_x;
			$section_id  = $value->secindex;

			
		
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
 * Element Template : Code
 * ----------------------------------------------------
 */
//padding
$uix_pb_paddingdis_top        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_paddingdis_top', 20 );
$uix_pb_paddingdis_right      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_paddingdis_right', 0 );
$uix_pb_paddingdis_bottom     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_paddingdis_bottom', 20 );
$uix_pb_paddingdis_left       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_paddingdis_left', 0 );

//textarea
$uix_pb_textarea            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_textarea', __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-pagebuilder' ) );

//toggle
$uix_pb_toggle                = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_toggle', 0 ); // 0:close  1:open


//toggle for switch
$uix_pb_checkbox_toggle       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_checkbox_toggle', 0 ); // 0:close  1:open
$uix_pb_checkbox_toggle_chk   = ( $uix_pb_checkbox_toggle == 1 ) ? true : false;


//checkbox
$uix_pb_checkbox              = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_checkbox', 0 ); // 0:false  1:true
$uix_pb_checkbox_chk          = ( $uix_pb_checkbox == 1 ) ? true : false;

//multiple selector
$uix_pb_multiselect           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_multiselect', '1,3' );

//units
$uix_pb_shortunitstext        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_shortunitstext', '' );
$uix_pb_shortunitstext_units  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_shortunitstext_units', 'px' );


//dynamic adding input
$uix_pb_listitem_imgURL       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_listitem_imgURL', '' );
$uix_pb_listitem_imgtitle     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_listitem_imgtitle', '' );
$uix_pb_listitem_toggle       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_listitem_toggle', 0 ); // 0:close  1:open
$uix_pb_listitem_toggle_url   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_listitem_toggle_url', '' );
$uix_pb_listitem_toggle_icon  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_listitem_toggle_icon', '' );


//general
$uix_pb_text                  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_text', '' );
$uix_pb_shorttext             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_shorttext', '' );
$uix_pb_radio                 = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_radio', '' );
$uix_pb_slider                = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_slider', 1 );
$uix_pb_slider_units          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_slider_units', '' );
$uix_pb_image                 = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_image', '' );
$uix_pb_single_color          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_single_color', '#333333' );
$uix_pb_select                = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_select', '' );
$uix_pb_icon                  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_icon', '' );
$uix_pb_colormap              = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_colormap', 'rgb(162, 63, 3)' );
$uix_pb_toggle_url            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_toggle_url', '' );
$uix_pb_checkbox_toggle_text  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_checkbox_toggle_text', 555 );


//dynamic adding input
$list_hello_item = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_listitem_imgURL';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$list_hello_item .= '
		<p>
		    '.$item[ '['.$colid.']'.$_uid.'[uix_pb_listitem_imgURL]['.$sid.']' ].' <strong>('.$item[ '['.$colid.']'.$_uid.'[uix_pb_listitem_imgtitle]['.$sid.']' ].')</strong><br>
			Toggle URL: '.$item[ '['.$colid.']'.$_uid.'[uix_pb_listitem_toggle_url]['.$sid.']' ].'<br>
			Toggle Icon: <i class="fa fa-'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_listitem_toggle_icon]['.$sid.']' ] ).'"></i><br>
		</p>    
		';
	} 
}

//radio
switch( $uix_pb_radio ){ 
	case 1: 
		$show_radio = 'boy';
		
	break; 
	
	case 2: 
		$show_radio = 'girl';
	
	break; 
	
	case 3: 
		$show_radio = 'private';
	
	break;			
	
	default: 
		$show_radio = '';

}	



//multiple selector
$multiselector      =  explode( ',', $uix_pb_multiselect );
$show_multiselector = '';
foreach ( $multiselector as $key => $value ) {
	$key = $key + 1;
	switch( $key ){ 
		case 1: 
			$show_multiselector .= 'student, ';
			
		break; 
		
		case 2: 
			$show_multiselector .= 'teacher, ';
		
		break; 
		
		case 3: 
			$show_multiselector .= 'manager, ';
		
		break; 	
		
		case 4: 
			$show_multiselector .= 'children, ';
		
		break; 				
		
		default: 

	}	
}

$show_html = '
	<h4>Text:</h4> '.$uix_pb_text.'
	<hr><h4>Textarea:</h4> '.$uix_pb_textarea.'
	<hr><h4>Short Text:</h4> '.$uix_pb_shorttext.'
	<hr><h4>Short Units Text:</h4> '.$uix_pb_shortunitstext.''.$uix_pb_shortunitstext_units.'
	<hr><h4>Select:</h4> '.$uix_pb_select.'
	<hr><h4>Upload Image:</h4> '.$uix_pb_image.'
	<hr><h4>Toggle URL:</h4> '.$uix_pb_toggle_url.'
	<hr><h4>Icon:</h4> <i class="fa fa-'.$uix_pb_icon.'"></i>
	<hr><h4>Radio:</h4> '.$show_radio.'
	<hr><h4>Slider:</h4> '.$uix_pb_slider.''.$uix_pb_slider_units.'
	<hr><h4>Color:</h4> '.$uix_pb_colormap.'
	<hr><h4>Multiple Selector:</h4> '.rtrim( $show_multiselector, ', ' ).'
	<hr><h4>Padding:</h4> '.$uix_pb_paddingdis_top.' '.$uix_pb_paddingdis_right.' '.$uix_pb_paddingdis_bottom.' '.$uix_pb_paddingdis_left.' 
	<hr><h4>Checkbox:</h4> '.( $uix_pb_checkbox ? '(checked)' : '' ).'
	<hr><h4>List Item:</h4> '.$list_hello_item.'
';


$element_temp = '
<div class="uix-pb-hello">
	{content}
</div>  
';

$uix_pb_section_hello_temp = str_replace( '{content}', $show_html,
							     $element_temp 
								 );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = [
	'list' => false
];


$args = 
	[

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_text' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_text' ),
			'title'          => __( 'Text', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_text,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_radio' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_radio' ),
			'title'          => __( 'Radio', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_radio,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'boy',
									'2'  => 'girl',
									'3'  => 'private',
				                )
		
		),

	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_slider' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_slider' ),
			'title'          => __( 'Slider', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_slider,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_slider_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_slider_units' ),
									'units'       => 'px',
									'min'         => 1,
									'max'         => 20,
									'step'        => 1
				                )
		
		),
		
		
		array(
			'id'             => array(
									'top'     => UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_top' ), 
									'right'   => UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_right' ), 
									'bottom'  => UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_bottom' ), 
									'left'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_left' ) 
				                ),
			'name'           => array(
									'top'     => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_paddingdis_top' ), 
									'right'   => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_paddingdis_right' ), 
									'bottom'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_paddingdis_bottom' ), 
									'left'    => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_paddingdis_left' )
				                ),
			'title'          => __( 'Padding (px)', 'uix-pagebuilder' ),
			'desc'           => __( 'Use the input fields below to customize the padding of your column shortcode. Measurement units is pixels (px).', 'uix-pagebuilder' ),
			'value'          => array(
									'top'     => $uix_pb_paddingdis_top,
									'right'   => $uix_pb_paddingdis_right,
									'bottom'  => $uix_pb_paddingdis_bottom,
									'left'    => $uix_pb_paddingdis_left
				                ),
			'placeholder'    => '',
			'type'           => 'margin',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_textarea' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_textarea' ),
			'title'          => __( 'Textarea(by default value)', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_textarea,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
				                )
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_image' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_image' ),
			'title'          => __( 'Upload Image', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_image,
			'placeholder'    => __( 'Image URL', 'uix-pagebuilder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									
									/* Show image properties 
									 * Javascript Vars:
									 
									   {item id}_repeat
									   {item id}_position
									   {item id}_attachment
									   {item id}_size
									*/
									//'prop'  => true,
				                )
		
		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_shorttext' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_shorttext' ),
			'title'          => __( 'Short Text', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_shorttext,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_shortunitstext' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_shortunitstext' ),
			'title'          => __( 'Short Units Text', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_shortunitstext,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'       => [ 'px', 'em', '%' ],
									'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_shortunitstext_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_shortunitstext_units' ),
									'units_value' => $uix_pb_shortunitstext_units,
				                )
		
		),
		
		//------toggle begin
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_toggle' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_toggle' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_toggle,
			'placeholder'    => '',
			'type'           => 'toggle',
			'default'        => array(
			                        //'btn_textclass' => 'table-link-attr',
			                        'btn_text'      => __( 'set up links with toggle', 'uix-pagebuilder' ),
									'toggle_class'  => [ UixPageBuilder::fid( $colid, $sid, 'uix_pb_toggle_url' ).'_class' ]
				                )
		
		),	

			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_toggle_url' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_toggle_url' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_toggle_url,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_toggle_url' ).'_class', /*class of toggle item */
				'placeholder'    => __( 'Toggle URL', 'uix-pagebuilder' ),
				'type'           => 'text',
				'default'        => ''
			
			),
			
			
		
		//------toggle end
		
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_single_color' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_single_color' ),
			'title'          => __( 'Color', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_single_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' ]
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_select' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_select' ),
			'title'          => __( 'Select', 'uix-pagebuilder' ),
			'desc'           => __( 'This is infomation.', 'uix-pagebuilder' ),
			'value'          => $uix_pb_select,
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager'
	
				                )
		
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_multiselect' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_multiselect' ),
			'title'          => __( 'Multiple Selector', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_multiselect, //It takes a variable like '1,3'  if the value is empty.
			'placeholder'    => '',
			'type'           => 'multiselect',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager',
									'4'  => 'children'
	
				                )
		
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_icon' ),
			'title'          => __( 'This is Icon Selector ', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_icon,
			'placeholder'    => '',
			'type'           => 'icon',
			'default'        => array(
			                        'social'  => false
				                )
		
		),
			
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_colormap' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_colormap' ),
			'title'          => __( 'Color Map', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_colormap,
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
								'swatches' => 1
							)
		
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_checkbox' ),
			'title'          => __( 'Checkbox', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_checkbox,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_checkbox_chk
				                )
		
		
		),	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox_toggle' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_checkbox_toggle' ),
			'title'          => __( 'Switch', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_checkbox_toggle,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_checkbox_toggle_chk
				                ),
			/* if show the target item, the target id require class like "toggle-row toggle-row-show" */
			'toggle'        => array(
									'trigger_id'  => UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox_toggle' ), /* {item id}-{option id} */
									'toggle_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox_toggle_text' ).'_class' ],
									
									/* if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid . */
									/*
									'toggle_not_class'  => [ '' ]
									*/
									
				                )	
		
		
		),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox_toggle_text' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_checkbox_toggle_text' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_checkbox_toggle_text,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox_toggle_text' ).'_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),	
			
		


		
		//------list begin
		array(
			'desc'           => sprintf( esc_html__( 'Note: %1$s items per row.Per section insert "for a maximum of %1$s".', 'uix-pagebuilder' ), $clone_max ),
			'type'           => 'text'
		
		),
		
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
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgURL' ).'',
											'type'      => 'image'
										), 
										array(
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgtitle' ).'',
											'type'      => 'text'
										),						
										
										array(
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'    => [ 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ).'', 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ).'' ]
										), 									
										
										

									 ],
									'max'                       => $clone_max
				                )
									
		),
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgURL' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_listitem_imgURL' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_listitem_imgURL,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgURL' ).'', /*class of list item */
				'placeholder'    => __( 'Image URL', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									)
			
			),	
		
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgtitle' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_listitem_imgtitle' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_listitem_imgtitle,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgtitle' ).'', /*class of list item */
				'placeholder'    => __( 'Text', 'uix-pagebuilder' ),
				'type'           => 'text'
			
			),
			
			//------toggle begin
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_listitem_toggle' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_listitem_toggle,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-pagebuilder' ),
										'toggle_class'  => [ 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ).'', 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ).'' ]
									)
			
			),	
	
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_listitem_toggle_url' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_listitem_toggle_url,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => __( 'Toggle URL', 'uix-pagebuilder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_listitem_toggle_icon' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_listitem_toggle_icon,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ).'',/*class of toggle item */
					'placeholder'    => '',
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),

			
			//------toggle end
			
			
					
		
		
		//------list end
		
	
	
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_hello_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_hello_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_hello_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	
	

	]
;


$form_html = UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html' );
$form_js = UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );
$form_js_vars = UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );


$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgURL' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgtitle' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' );


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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Form Demo 1', 'uix-pagebuilder' ) ); ?>            
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
		$field = 'uix_pb_listitem_imgURL';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_listitem_imgURL]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_listitem_imgURL]['.$sid.']' ]
								),
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_listitem_imgtitle]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_listitem_imgtitle]['.$sid.']' ]
								),
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_listitem_toggle]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_listitem_toggle]['.$sid.']' ]
								),
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_listitem_toggle_url]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_listitem_toggle_url]['.$sid.']' ]
								),
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_listitem_toggle_icon]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_listitem_toggle_icon]['.$sid.']' ]
								)	
																					
								
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			var tempcode                 = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
			    
                //padding
			    uix_pb_paddingdis_top        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_top' ); ?>' ).val(),
			    uix_pb_paddingdis_right      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_right' ); ?>' ).val(),
			    uix_pb_paddingdis_bottom     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_bottom' ); ?>' ).val(),
			    uix_pb_paddingdis_left       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_paddingdis_left' ); ?>' ).val(),

                //textarea
			    uix_pb_textarea              = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_textarea' ); ?>' ).val(),

                //checkbox
				uix_pb_checkbox_chk          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_checkbox' ); ?>-checkbox' ).is( ":checked" ),


                //multiple selector
			    uix_pb_multiselect           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_multiselect' ); ?>' ).val(),

                //units
			    uix_pb_shortunitstext        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_shortunitstext' ); ?>' ).val(),
			    uix_pb_shortunitstext_units  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_shortunitstext_units' ); ?>' ).val(),

                //general
			    uix_pb_text                  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_text' ); ?>' ).val(),
			    uix_pb_shorttext             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_shorttext' ); ?>' ).val(),
			    uix_pb_radio                 = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_radio' ); ?>' ).val(),
			    uix_pb_slider                = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_slider' ); ?>' ).val(),
			    uix_pb_slider_units          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_slider_units' ); ?>' ).val(),
			    uix_pb_image                 = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_image' ); ?>' ).val(),
			    uix_pb_single_color          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_single_color' ); ?>' ).val(),
			    uix_pb_select                = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_select' ); ?>' ).val(),
			    uix_pb_icon                  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_icon' ); ?>' ).val(),
			    uix_pb_colormap              = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_colormap' ); ?>' ).val(),
			    uix_pb_toggle_url            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_toggle_url' ); ?>' ).val();
				
	
			if ( tempcode.length > 0 ) {
				
				
				/* Radio (Requires quotes) */
				var show_radio;
				
				switch( uix_pb_radio ){ 
					case '1': 
						show_radio = 'boy';
						
					break; 
					
					case '2': 
						show_radio = 'girl';
					
					break; 
					
					case '3': 
						show_radio = 'private';
					
					break;			
					
					default: 
				
				}
				
				
				/* Multiple Selector (Requires quotes) */
				var multiselector      = uix_pb_multiselect.split( ',' ),
					show_multiselector = '';
					
				for ( var k = 0; k < multiselector.length; k++ ) {
					
					
					switch( multiselector[k] ){ 
						case '1': 
							show_multiselector += 'student, ';
							
						break; 
						
						case '2': 
							show_multiselector += 'teacher, ';
						
						break; 
						
						case '3': 
							show_multiselector += 'manager, ';
						
						break; 	
						
						case '4': 
							show_multiselector += 'children, ';
						
						break; 				
						
						default: 
	
					}
					
				}	
				
				show_multiselector = show_multiselector.substring( 0, show_multiselector.length - 2 );
					
					
				/* Checkbox */
				var show_checkbox = ( uix_pb_checkbox_chk === true ) ? '(checked)' : '';
				
				
				/* List Item */
				var list_num       = <?php echo $clone_max; ?>,
					show_list_item = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
					    _img         = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgURL' ); ?>' ).val(),
						_title       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_imgtitle' ); ?>' ).val(),
						_toggleurl   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_url' ); ?>' ).val(),
						_toggleicon  = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_listitem_toggle_icon' ); ?>' ).val();
						
					var _item_v_img         = ( _img != undefined ) ? _img : '',
					    _item_v_title       = ( _title != undefined ) ? _title : '',
						_item_v_toggleurl   = ( _toggleurl != undefined ) ? _toggleurl : '',
						_item_v_toggleicon  = ( _toggleicon != undefined ) ? uixpbform_htmlEncode( _toggleicon ) : '';
					
					
					if ( _title != undefined ) {
							
						//Do not include spaces
						show_list_item += '<p>';
						show_list_item += ''+_item_v_img+' <strong>('+_item_v_title+')</strong><br>';
						show_list_item += 'Toggle URL: '+_item_v_toggleurl+'<br>';
						show_list_item += 'Toggle Icon: <i class="fa fa-'+_item_v_toggleicon+'"></i><br>';
						show_list_item += '</p>';	
	
					}
						
					
				}
				
				
				//---
				var show_html = 	'';
				
				show_html += '<h4>Text:</h4> '+uix_pb_text+'';
				show_html += '<hr><h4>Textarea:</h4> '+uix_pb_textarea+'';
				show_html += '<hr><h4>Short Text:</h4> '+uix_pb_shorttext+'';
				show_html += '<hr><h4>Short Units Text:</h4> '+uix_pb_shortunitstext+''+uix_pb_shortunitstext_units+'';
				show_html += '<hr><h4>Select:</h4> '+uix_pb_select+'';
				show_html += '<hr><h4>Upload Image:</h4> '+uix_pb_image+'';
				show_html += '<hr><h4>Toggle URL:</h4> '+uix_pb_toggle_url+'';
				show_html += '<hr><h4>Icon:</h4> <i class="fa fa-'+uix_pb_icon+'"></i>';
				show_html += '<hr><h4>Radio:</h4> '+show_radio+'';
				show_html += '<hr><h4>Slider:</h4> '+uix_pb_slider+''+uix_pb_slider_units+'';
				show_html += '<hr><h4>Color:</h4> '+uix_pb_colormap+'';
				show_html += '<hr><h4>Multiple Selector:</h4> '+show_multiselector+'';
				show_html += '<hr><h4>Padding:</h4> '+uix_pb_paddingdis_top+' '+uix_pb_paddingdis_right+' '+uix_pb_paddingdis_bottom+' '+uix_pb_paddingdis_left+''; 
				show_html += '<hr><h4>Checkbox:</h4> '+show_checkbox+'';
				show_html += '<hr><h4>List Item:</h4> '+show_list_item+'';


				
				tempcode = tempcode.replace(/{content}/g, show_html );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_hello_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}
