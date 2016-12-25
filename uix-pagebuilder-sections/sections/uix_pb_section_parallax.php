<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_parallax';

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
$uix_pb_parallax_title           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_parallax_titlecolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_titlecolor', '' );
$uix_pb_parallax_desc            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Teneo, inquit, finem illi videri nihil dolere. Esse enim, nisi eris, non potes.', 'uix-pagebuilder' ) );
$uix_pb_parallax_desccolor       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_desccolor', '' );
$uix_pb_parallax_bg              = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg', '' ) );
$uix_pb_parallax_bg_attachment   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg_attachment', 'fixed' );
$uix_pb_parallax_speed           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_speed', 0 );
$uix_pb_parallax_height          = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_height', 300 ) );


$bgimage_css = ( !empty( $uix_pb_parallax_bg ) ) ? 'style="background:url('.esc_attr( $uix_pb_parallax_bg ).') '.( $uix_pb_parallax_speed > 0 ? '50%' : 'top' ).' '.( $uix_pb_parallax_speed > 0 ? 0 : 'left' ).' no-repeat '.( $uix_pb_parallax_speed > 0 ? 'fixed' : esc_attr( $uix_pb_parallax_bg_attachment ) ).';"' : '';

$title       =  ( !empty( $uix_pb_parallax_titlecolor ) ) ? '<span style="color:'.esc_attr( $uix_pb_parallax_titlecolor ).';">'.uix_pb_kses( $uix_pb_parallax_title ).'</span>' : uix_pb_kses( $uix_pb_parallax_title );

$desc        =  ( !empty( $uix_pb_parallax_desccolor ) ) ? '<span style="color:'.esc_attr( $uix_pb_parallax_desccolor ).';">'.uix_pb_kses( $uix_pb_parallax_desc ).'</span>' : uix_pb_kses( $uix_pb_parallax_desc );



$element_temp = '
<div class="uix-pb-parallax-wrapper uix-pb-parallax" {mainstyle} data-parallax="{speed}">
	<div class="uix-pb-parallax-table" style="height:{height}">
		<div class="uix-pb-parallax-content-box">
			<h2>{title}</h2>
			<p>{desc}</p>
		</div>
	</div>
</div>
';


$uix_pb_section_parallax_temp = str_replace( '{mainstyle}', $bgimage_css, 
                                  str_replace( '{speed}', esc_attr( $uix_pb_parallax_speed ), 
								  str_replace( '{height}', esc_attr( $uix_pb_parallax_height ).'px', 
								  str_replace( '{title}', $title, 
								  str_replace( '{desc}', $desc,

							     $element_temp 
								 ) ) ) ) );



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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_title,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_title' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'text'

		),

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_titlecolor' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_titlecolor' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_parallax_titlecolor,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_titlecolor' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	


		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desc' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_desc' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_desc,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desc' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)

		),

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desccolor' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_desccolor' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_parallax_desccolor,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desccolor' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)

		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_height' ),
			'title'          => __( 'Height', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_height,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_speed' ),
			'title'          => __( 'Parallax', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_speed,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_speed_units' ),
									'units'       => '',
									'min'         => 0,
									'max'         => 10,
									'step'        => 0.1
				                )
		
		),	
		

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_bg' ),
			'title'          => __( 'Background Image', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_bg,
			'placeholder'    => '',
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
								)
		
		),	
			
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_attachment' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_bg_attachment' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_parallax_bg_attachment,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'fixed'  => 'fixed',
									'scroll'  => 'scroll',
				                )
		
		),
		
		

		

        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_parallax_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_parallax_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_parallax_temp,
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Parallax', 'uix-pagebuilder' ) ); ?>         
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
		
		
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			var tempcode                        = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_parallax_title           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_title' ); ?>' ).val(),
				uix_pb_parallax_titlecolor      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_titlecolor' ); ?>' ).val(),
				uix_pb_parallax_desc            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desc' ); ?>' ).val(),
				uix_pb_parallax_desccolor       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desccolor' ); ?>' ).val(),
				uix_pb_parallax_bg              = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg' ); ?>' ).val(),
				uix_pb_parallax_bg_attachment   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_attachment' ); ?>' ).val(),
				uix_pb_parallax_speed           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed' ); ?>' ).val(),
				uix_pb_parallax_height          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height' ); ?>' ).val();
				
			
			
			if ( tempcode.length > 0 ) {
				
				var bg_pos_1     = ( uix_pb_parallax_speed > 0 ) ? '50%' : 'top',
					bg_pos_2     = ( uix_pb_parallax_speed > 0 ) ? 0 : 'left',
					speed        = ( uix_pb_parallax_speed > 0 ) ? 'fixed' : uixpbform_htmlEncode( uix_pb_parallax_bg_attachment ),
					bgimage_css  = ( uix_pb_parallax_bg != undefined && uix_pb_parallax_bg != '' ) ? 'style="background:url('+encodeURI( uix_pb_parallax_bg )+') '+bg_pos_1+' '+bg_pos_2+' no-repeat '+speed+';"' : '',
					title        =  ( uix_pb_parallax_titlecolor != undefined && uix_pb_parallax_titlecolor != '' ) ? '<span style="color:'+uixpbform_htmlEncode( uix_pb_parallax_titlecolor )+';">' + uix_pb_parallax_title + '</span>' : uix_pb_parallax_title,
					desc         =  ( uix_pb_parallax_desccolor != undefined && uix_pb_parallax_desccolor != '' ) ? '<span style="color:'+uixpbform_htmlEncode( uix_pb_parallax_desccolor )+';">' + uix_pb_parallax_desc + '</span>' : uix_pb_parallax_desc;

			  
				
				//---
				tempcode = tempcode
								  .replace(/{mainstyle}/g, bgimage_css )
								  .replace(/{speed}/g, uix_pb_parallax_speed )
								  .replace(/{height}/g, uixpbform_floatval( uix_pb_parallax_height )+'px' )
								  .replace(/{title}/g, title )
								  .replace(/{desc}/g, desc );
								  
					
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_parallax_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
