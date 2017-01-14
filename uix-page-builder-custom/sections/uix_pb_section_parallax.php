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
 * Element Template
 * ----------------------------------------------------
 */
$uix_pb_parallax_title           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_title', __( 'Text Here', 'uix-page-builder' ) );
$uix_pb_parallax_titlecolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_titlecolor', '' );
$uix_pb_parallax_desc            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_desc', __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Teneo, inquit, finem illi videri nihil dolere. Esse enim, nisi eris, non potes.', 'uix-page-builder' ) );
$uix_pb_parallax_bg_color        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg_color', '' );
$uix_pb_parallax_bg              = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg', UixPBFormCore::cover_placeholder() ) );
$uix_pb_parallax_bg_attachment   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg_attachment', 'fixed' );
$uix_pb_parallax_speed           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_speed', 0 );
$uix_pb_parallax_height          = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_height', 300 ) );
$uix_pb_parallax_height_units    = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_height_units', 'px' );
$uix_pb_parallax_url             = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_url', '' ) );
$uix_pb_parallax_url_text        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_url_text', __( 'Check Out', 'uix-page-builder' ) );
$uix_pb_parallax_skew            = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_skew', 0 ) );


$skew_px             = abs( rad2deg( $uix_pb_parallax_skew/2 ) );
$skew_deg            = $uix_pb_parallax_skew;
$skew_deg2           = ( $skew_deg > 0 ) ? '-'.$skew_deg : abs( $skew_deg );
$skew_css            = ( $uix_pb_parallax_skew != 0 ) ? 'margin-top: -'.$skew_px.'px;margin-bottom:'.$skew_px.'px;-webkit-transform: skew(0deg, '.$skew_deg.'deg); transform: skew(0deg, '.$skew_deg.'deg);' : '';
$skew_content_style  = ( $uix_pb_parallax_skew != 0 ) ? 'style="-webkit-transform: skew(0deg, '.$skew_deg2.'deg); transform: skew(0deg, '.$skew_deg2.'deg);"' : '';




$bgcolor       = ( !empty( $uix_pb_parallax_bg_color ) ) ? esc_attr( $uix_pb_parallax_bg_color ) : 'transparent';
$bgimage_css   = ( !empty( $uix_pb_parallax_bg )  ? 'style="'.$skew_css.'background: '.$bgcolor.' url('.esc_attr( $uix_pb_parallax_bg ).') '.( $uix_pb_parallax_speed > 0 ? '50%' : 'top' ).' '.( $uix_pb_parallax_speed > 0 ? 0 : 'left' ).' no-repeat '.( $uix_pb_parallax_speed > 0 ? 'fixed' : esc_attr( $uix_pb_parallax_bg_attachment ) ).';"' : 'style="'.$skew_css.'background-color:'.esc_attr( $uix_pb_parallax_bg_color ).';"' );
$title         =  ( !empty( $uix_pb_parallax_titlecolor ) ) ? '<span style="color:'.esc_attr( $uix_pb_parallax_titlecolor ).';">'.uix_pb_kses( $uix_pb_parallax_title ).'</span>' : uix_pb_kses( $uix_pb_parallax_title );
$desc          =  $uix_pb_parallax_desc;
$bgcolor_class = ( !empty( $uix_pb_parallax_bg_color ) ) ? 'uix-pb-parallax-nospace' : '';
$button        = ( !empty( $uix_pb_parallax_url ) ) ? '<p><a class="uix-pb-btn uix-pb-btn-white" href="'.$uix_pb_parallax_url.'">'.uix_pb_kses( $uix_pb_parallax_url_text ).'</a></p>' : '';



$element_temp = '
<div class="uix-pb-parallax-wrapper uix-pb-parallax {bgcolor_class}" {mainstyle} data-parallax="{speed}">
	<div class="uix-pb-parallax-table" style="height:{height}{height_unit}">
		<div class="uix-pb-parallax-content-box" {skew_content_style}>
			<h2>{title}</h2>
			<p>{desc}</p>
			{button}
		</div>
	</div>
</div>
';

						
$uix_pb_section_parallax_temp = str_replace( '{mainstyle}', $bgimage_css, 
                                  str_replace( '{speed}', esc_attr( $uix_pb_parallax_speed ), 
								  str_replace( '{height}', esc_attr( $uix_pb_parallax_height ), 
								  str_replace( '{height_unit}', esc_attr( $uix_pb_parallax_height_units ), 
								  str_replace( '{title}', $title, 
								  str_replace( '{desc}', $desc,
								  str_replace( '{bgcolor_class}', $bgcolor_class,
								  str_replace( '{skew_content_style}', $skew_content_style,
								  str_replace( '{button}', $button,

							     $element_temp 
								 ) ) ) ) ) ) ) ) );



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
			'title'          => __( 'Title', 'uix-page-builder' ),
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
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_desc,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desc' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)

		),

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_skew' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_skew' ),
			'title'          => __( 'Skew', 'uix-page-builder' ),
			'desc'           => __( 'Suggest values: <strong>-10</strong> &nbsp;to&nbsp;<strong>10</strong>.', 'uix-page-builder' ),
			'value'          => $uix_pb_parallax_skew,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'deg'
								)

		),
		
		

		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_height' ),
			'title'          => __( 'Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_height,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => [ 'px', 'vh' ],
									'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_height_units' ),
									'units_value' => $uix_pb_parallax_height_units
								)
		
		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_speed' ),
			'title'          => __( 'Parallax', 'uix-page-builder' ),
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_color' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_bg_color' ),
			'title'          => __( 'Background Color', 'uix-page-builder' ),
			'desc'           => __( 'Seamless display when the background color is not empty.', 'uix-page-builder' ),
			'value'          => $uix_pb_parallax_bg_color,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_color' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	
		
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_bg' ),
			'title'          => __( 'Background Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_bg,
			'placeholder'    => '',
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
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
		
		

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_url' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_url' ),
			'title'          => __( 'Destination URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_parallax_url,
			'placeholder'    => __( 'http://', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''

		),	

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_url_text' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_url_text' ),
			'title'          => __( 'Link Text', 'uix-page-builder' ),
			'desc'           => __( 'Valid when the value of <strong>"Destination URL"</strong> is not empty', 'uix-page-builder' ),
			'value'          => $uix_pb_parallax_url_text,
			'placeholder'    => '',
			'type'           => 'text',
			'default'        => ''

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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Parallax', 'uix-page-builder' ) ); ?>         
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
				uix_pb_parallax_bg_color        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_color' ); ?>' ).val(),
				uix_pb_parallax_bg              = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg' ); ?>' ).val(),
				uix_pb_parallax_bg_attachment   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_attachment' ); ?>' ).val(),
				uix_pb_parallax_speed           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed' ); ?>' ).val(),
				uix_pb_parallax_height          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height' ); ?>' ).val(),
				uix_pb_parallax_height_units    = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height_units' ); ?>' ).val(),
				uix_pb_parallax_url             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_url' ); ?>' ).val(),
				uix_pb_parallax_url_text        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_url_text' ); ?>' ).val(),
				uix_pb_parallax_skew            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_skew' ); ?>' ).val();
				
			
			
			
			if ( tempcode.length > 0 ) {
				
				//Converts from radians to degrees.
				var skewToPx           = Math.abs( ( uixpbform_floatval( uix_pb_parallax_skew ) * 180 / Math.PI )/2 ),
					skewDeg            = uixpbform_floatval( uix_pb_parallax_skew ),
					skewDeg2           = -( skewDeg ),
					skew_css           = ( uix_pb_parallax_skew != 0 ) ? 'margin-top: -'+skewToPx+'px;margin-bottom:'+skewToPx+'px;-webkit-transform: skew(0deg, '+skewDeg+'deg); transform: skew(0deg, '+skewDeg+'deg);' : '',
					skew_content_style = ( uix_pb_parallax_skew != 0 ) ? 'style="-webkit-transform: skew(0deg, '+skewDeg2+'deg); transform: skew(0deg, '+skewDeg2+'deg);"' : '';
				
				
				var bg_pos_1      = ( uix_pb_parallax_speed > 0 ) ? '50%' : 'top',
					bg_pos_2      = ( uix_pb_parallax_speed > 0 ) ? 0 : 'left',
					bgcolor       =  ( uix_pb_parallax_bg_color != undefined && uix_pb_parallax_bg_color != '' ) ? uixpbform_htmlEncode( uix_pb_parallax_bg_color ) : 'transparent',
					speed         = ( uix_pb_parallax_speed > 0 ) ? 'fixed' : uixpbform_htmlEncode( uix_pb_parallax_bg_attachment ),
					bgimage_css   = ( uix_pb_parallax_bg != undefined && uix_pb_parallax_bg != '' ) ? 'style="'+skew_css+'background: '+bgcolor+' url('+encodeURI( uix_pb_parallax_bg )+') '+bg_pos_1+' '+bg_pos_2+' no-repeat '+speed+';"' : 'style="'+skew_css+'background-color:'+bgcolor+';"',
					title         =  ( uix_pb_parallax_titlecolor != undefined && uix_pb_parallax_titlecolor != '' ) ? '<span style="color:'+uixpbform_htmlEncode( uix_pb_parallax_titlecolor )+';">' + uix_pb_parallax_title + '</span>' : uix_pb_parallax_title,
					desc          =  uix_pb_parallax_desc,
					bgcolor_class =  ( uix_pb_parallax_bg_color != undefined && uix_pb_parallax_bg_color != '' ) ? 'uix-pb-parallax-nospace' : '',
					button =  ( uix_pb_parallax_url != undefined && uix_pb_parallax_url != '' ) ? '<p><a class="uix-pb-btn uix-pb-btn-white" href="'+encodeURI( uix_pb_parallax_url )+'">'+uix_pb_parallax_url_text+'</a></p>' : '';

		
				
				//---
				tempcode = tempcode
								  .replace(/{mainstyle}/g, bgimage_css )
								  .replace(/{speed}/g, uix_pb_parallax_speed )
								  .replace(/{height}/g, uixpbform_floatval( uix_pb_parallax_height ) )
				                  .replace(/{height_unit}/g, uixpbform_htmlEncode( uix_pb_parallax_height_units ) )
								  .replace(/{title}/g, title )
								  .replace(/{desc}/g, desc )
				                  .replace(/{skew_content_style}/g, skew_content_style )
				                  .replace(/{bgcolor_class}/g, bgcolor_class )
				                  .replace(/{button}/g, button );
								  
				
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_parallax_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
