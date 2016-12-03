<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_code';

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
$uix_pb_code_info             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_code_info', '' );
$uix_pb_code_info_chk         = $uix_pb_code_info;
$uix_pb_code_moreoptions      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_code_moreoptions', 0 ); // 0:false  1:true
$uix_pb_code_moreoptions_chk  = ( $uix_pb_code_moreoptions == 1 ) ? true : false;
$uix_pb_code_font             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_code_font', 0 ); // 0:false  1:true
$uix_pb_code_font_chk         = ( $uix_pb_code_font == 1 ) ? true : false;
$uix_pb_code_color_toggle     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_code_color_toggle', 0 ); // 0:close  1:open
$uix_pb_code_color_other      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_code_color_other', '' );




$element_temp = '
<code>
	{content}
</code>  
';



if ( $uix_pb_code_font == 1 ) {
	$uix_pb_code_info_chk = '<span style="font-size: 2em">'.$uix_pb_code_info.'</span>';
}
if ( !empty( $uix_pb_code_color_other ) ) {
	$uix_pb_code_info_chk = '<span style="color: '.$uix_pb_code_color_other.'">'.$uix_pb_code_info_chk.'</span>';
}


$uix_pb_section_code_temp = str_replace( '{content}', $uix_pb_code_info_chk,
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_info' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_code_info' ),
			'title'          => __( 'Text', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_code_info,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_moreoptions' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_code_moreoptions' ),
			'title'          => __( 'Options', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_code_moreoptions,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_code_moreoptions_chk
							),
			/* if show the target item, the target id require class like "toggle-row toggle-row-show" */
			'toggle'        => array(
									'trigger_id'  => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_moreoptions' ), /* {item id}-{option id} */
									'toggle_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_font' ).'_class' ]
								)	
		
		
		),	
		
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_font' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_code_font' ),
				'title'          => __( 'Big font', 'uix-pagebuilder' ),
				'desc'           => '',
				'value'          => $uix_pb_code_font,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_font' ).'_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'checkbox',
				'default'        => array(
										'checked'  => $uix_pb_code_font_chk,
									)
			
			
			),	
			
	
			
		//------toggle begin
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_color_toggle' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_code_color_toggle' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_code_color_toggle,
			'placeholder'    => '',
			'type'           => 'toggle',
			'default'        => array(
									'btn_text'      => __( 'other color', 'uix-pagebuilder' ),
									'toggle_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_color_other' ).'_class' ]
								)
		
		),	
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_color_other' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_code_color_other' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_code_color_other,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_color_other' ).'_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			
			),	

	
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_code_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_code_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_code_temp,
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



/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert Code', 'uix-pagebuilder' ) ); ?>            
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
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "input change keyup focusin focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			var tempcode                 = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
			    uix_pb_code_font_chk     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_font' ); ?>-checkbox' ).is( ":checked" ),
			    uix_pb_code_info         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_info' ); ?>' ).val(),
				uix_pb_code_info_chk     = uix_pb_code_info,
				uix_pb_code_color_other  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_code_color_other' ); ?>' ).val();
				
	
				
			if ( uix_pb_code_font_chk === true ) uix_pb_code_info_chk = '<span style="font-size: 2em">'+uix_pb_code_info_chk+'</span>';
			if ( uix_pb_code_color_other != '' ) uix_pb_code_info_chk = '<span style="color: '+uix_pb_code_color_other+'">'+uix_pb_code_info_chk+'</span>';
				

			if ( tempcode.length > 0 ) {
				
				tempcode = tempcode.replace(/{content}/g, uix_pb_code_info_chk );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_code_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}
