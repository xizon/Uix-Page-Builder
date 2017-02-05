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
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = [
	'list' => false
];

$args_config = [
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
];						

						

$args = 
	[
	
		array(
			'id'             => 'uix_pb_parallax_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'

		),

		array(
			'id'             => 'uix_pb_parallax_titlecolor',
			'title'          => '',
			'desc'           => '',
			'value'          => '#999999',
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	


		array(
			'id'             => 'uix_pb_parallax_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '<span style="color:#999999;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Teneo, inquit, finem illi videri nihil dolere. Esse enim, nisi eris, non potes.</span>', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)

		),

		array(
			'id'             => 'uix_pb_parallax_skew',
			'title'          => __( 'Skew', 'uix-page-builder' ),
			'desc'           => __( 'Suggest values: <strong>-10</strong> &nbsp;to&nbsp;<strong>10</strong>.', 'uix-page-builder' ),
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'deg'
								)

		),
		
		

		
	    array(
			'id'             => 'uix_pb_parallax_height',
			'title'          => __( 'Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 300,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => [ 'px', 'vh' ],
									'units_id'    => 'uix_pb_parallax_height_units',
									'units_value' => 'px'
								)
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_parallax_speed',
			'title'          => __( 'Parallax', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'    => 'uix_pb_parallax_speed_units',
									'units'       => '',
									'min'         => 0,
									'max'         => 10,
									'step'        => 0.1
				                )
		
		),	
		
		array(
			'id'             => 'uix_pb_parallax_bg_color',
			'title'          => __( 'Background Color', 'uix-page-builder' ),
			'desc'           => __( 'Seamless display when the background color is not empty.', 'uix-page-builder' ),
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
								)


		),	
		
		
		
		array(
			'id'             => 'uix_pb_parallax_bg',
			'title'          => __( 'Background Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( UixPBFormCore::cover_placeholder() ),
			'placeholder'    => '',
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
								)
		
		),	
			
	    array(
			'id'             => 'uix_pb_parallax_bg_attachment',
			'title'          => '',
			'desc'           => '',
			'value'          => 'fixed',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'fixed'  => 'fixed',
									'scroll'  => 'scroll',
				                )
		
		),

	
		array(
			'id'             => 'uix_pb_parallax_button_checkbox_toggle',
			'title'          => __( 'Link Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => '', /* {option id} */
									'toggle_class'  => [ 
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_btn_color' ).'_class', 
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url' ).'_class', 
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text' ).'_class' 
	                                 ],
									
									/* if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid . */
									/*
									'toggle_not_class'  => [ '' ]
									*/
									
				                )	
		
		
		),	
		
		
		array(
			'id'             => 'uix_pb_parallax_btn_color',
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#ffffff',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_btn_color' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe',  '#ffffff' ]
		
		),
		

		array(
			'id'             => 'uix_pb_parallax_url',
			'title'          => __( 'Destination URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url' ).'_class', /*class of toggle item */
			'placeholder'    => __( 'http://', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''

		),	

		array(
			'id'             => 'uix_pb_parallax_url_text',
			'title'          => __( 'Link Text', 'uix-page-builder' ),
			'desc'           => __( 'Valid when the value of <strong>"Destination URL"</strong> is not empty', 'uix-page-builder' ),
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_parallax_url_text' ).'_class', /*class of toggle item */
			'value'          => __( 'Check Out', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'default'        => ''

		),		
		


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

$form_html    = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html' );
$form_js_vars = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );



/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Parallax', 'uix-page-builder' ) ); ?>         
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
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>

			//Converts from radians to degrees.
			var skewToPx           = Math.abs( ( uixpbform_floatval( uix_pb_parallax_skew ) * 180 / Math.PI )/2 ),
				skewDeg            = uixpbform_floatval( uix_pb_parallax_skew ),
				skewDeg2           = -( skewDeg ),
				skew_css           = ( uix_pb_parallax_skew != 0 ) ? 'margin-top: -'+skewToPx+'px;margin-bottom:'+skewToPx+'px;-webkit-transform: skew(0deg, '+skewDeg+'deg); transform: skew(0deg, '+skewDeg+'deg);' : '',
				skew_content_style = ( uix_pb_parallax_skew != 0 ) ? 'style="-webkit-transform: skew(0deg, '+skewDeg2+'deg); transform: skew(0deg, '+skewDeg2+'deg);"' : '',
				btncolor           = uixpbform_colorTran( uix_pb_parallax_btn_color );


			var bg_pos_1      = ( uix_pb_parallax_speed > 0 ) ? '50%' : 'top',
				bg_pos_2      = ( uix_pb_parallax_speed > 0 ) ? 0 : 'left',
				bgcolor       =  ( uix_pb_parallax_bg_color != undefined && uix_pb_parallax_bg_color != '' ) ? uixpbform_htmlEncode( uix_pb_parallax_bg_color ) : 'transparent',
				speed         = ( uix_pb_parallax_speed > 0 ) ? 'fixed' : uixpbform_htmlEncode( uix_pb_parallax_bg_attachment ),
				bgimage_css   = ( uix_pb_parallax_bg != undefined && uix_pb_parallax_bg != '' ) ? 'style="'+skew_css+'background: '+bgcolor+' url('+encodeURI( uix_pb_parallax_bg )+') '+bg_pos_1+' '+bg_pos_2+' no-repeat '+speed+';"' : 'style="'+skew_css+'background-color:'+bgcolor+';"',
				title         =  ( uix_pb_parallax_titlecolor != undefined && uix_pb_parallax_titlecolor != '' ) ? '<span style="color:'+uixpbform_htmlEncode( uix_pb_parallax_titlecolor )+';">' + uix_pb_parallax_title + '</span>' : uix_pb_parallax_title,
				desc          =  uix_pb_parallax_desc,
				bgcolor_class =  ( uix_pb_parallax_bg_color != undefined && uix_pb_parallax_bg_color != '' ) ? 'uix-pb-parallax-nospace' : '',
				button =  ( uix_pb_parallax_url != undefined && uix_pb_parallax_url != '' ) ? '<p><a class="uix-pb-btn uix-pb-btn-'+btncolor+'" href="'+encodeURI( uix_pb_parallax_url )+'">'+uix_pb_parallax_url_text+'</a></p>' : '';

			
			if ( uix_pb_parallax_button_checkbox_toggle === false ) button = '';


			var temp = '';
				temp += '<div class="uix-pb-parallax-wrapper uix-pb-parallax '+bgcolor_class+'" '+bgimage_css+' data-parallax="'+uix_pb_parallax_speed+'">';
				temp += '<div class="uix-pb-parallax-table" style="height:'+uixpbform_floatval( uix_pb_parallax_height )+''+uixpbform_htmlEncode( uix_pb_parallax_height_units )+'">';
				temp += '<div class="uix-pb-parallax-content-box" '+skew_content_style+'>';
				temp += '<h2>'+title+'</h2>';
				temp += '<p>'+desc+'</p>';
				temp += button;
				temp += '</div>';
				temp += '</div>';
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


