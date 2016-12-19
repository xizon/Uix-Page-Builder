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
$uix_pb_parallax_title           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_parallax_titlecolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_titlecolor', '' );
$uix_pb_parallax_desc            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_parallax_desccolor       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_desccolor', '' );
$uix_pb_parallax_bg             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg', '' );
$uix_pb_parallax_bg_attachment  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_bg_attachment', 'fixed' );
$uix_pb_parallax_speed  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_speed', 0 );
$uix_pb_parallax_height  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_parallax_height', 0 );




$element_temp = '
<div class="uix-pb-parallax" style="border-top-color: {color};">
	<div class="uix-pb-parallax-top">
		<div class="uix-pb-parallax-text">
			<h3 class="uix-pb-parallax-title">{name}
			{social_1}
			{social_2}
			{social_3}
			</h3> 	 
		</div>
		<div class="uix-pb-parallax-pic"><img src="{avatar}" alt="{name_attr}"></div>
	</div>
	<div class="uix-pb-parallax-middle">{intro}</div> 
	<a class="uix-pb-parallax-final" href="{link_url}" rel="author">{link_label}</a> 
</div> 
';

$uix_pb_section_parallax_temp = str_replace( '{name}', wp_kses( $uix_pb_parallax_title, wp_kses_allowed_html( 'post' ) ), 
                                  str_replace( '{name_attr}', esc_attr( $uix_pb_parallax_title ), 
								  str_replace( '{intro}', wp_kses( $uix_pb_parallax_intro, wp_kses_allowed_html( 'post' ) ), 
								  str_replace( '{link_url}', esc_url( $uix_pb_parallax_link_link ), 
								  str_replace( '{link_label}', wp_kses( $uix_pb_parallax_link_label, wp_kses_allowed_html( 'post' ) ), 
								  str_replace( '{avatar}',esc_url( $avatarURL ), 
								  str_replace( '{color}', esc_attr( $uix_pb_parallax_primary_color ), 
								  str_replace( '{social_1}', $social_out_1, 
								  str_replace( '{social_2}', $social_out_2, 
								  str_replace( '{social_3}', $social_out_3, 

							     $element_temp 
								 ) ) ) ) ) ) ) ) ) );



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
			'title'          => '',
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
			'desc'           => __( 'Title Color', 'uix-pagebuilder' ),
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
			'title'          => '',
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
			'desc'           => __( 'Description Color', 'uix-pagebuilder' ),
			'value'          => $uix_pb_parallax_desccolor,
			'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_desccolor' ).'', /*class of list item */
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
									'swatches' => 1
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_height' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_height' ),
			'title'          => __( 'Height', 'uix-pagebuilder' ),
			'desc'           => __( 'The browser automatically calculates the container height if the value is <strong>"0"</strong>.', 'uix-pagebuilder' ),
			'value'          => $uix_pb_parallax_height,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),	
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_bg_attachment' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_bg_attachment' ),
			'title'          => __( 'Radio', 'uix-pagebuilder' ),
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_speed' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_parallax_speed' ),
			'title'          => __( 'Slider', 'uix-pagebuilder' ),
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Author Card', 'uix-pagebuilder' ) ); ?>         
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
			
			var tempcode                         = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_parallax_primary_color  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_primary_color' ); ?>' ).val(),
				uix_pb_parallax_avatar         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_avatar' ); ?>' ).val(),
				uix_pb_parallax_title           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_title' ); ?>' ).val(),
				uix_pb_parallax_intro          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_intro' ); ?>' ).val(),
				uix_pb_parallax_link_label     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_link_label' ); ?>' ).val(),
				uix_pb_parallax_link_link      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_link_link' ); ?>' ).val(),
				uix_pb_parallax_1_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_1_icon' ); ?>' ).val(),
				uix_pb_parallax_1_icon_cur     = ( uix_pb_parallax_1_icon == undefined || uix_pb_parallax_1_icon == '' ) ? 'link' : uix_pb_parallax_1_icon,
				uix_pb_parallax_2_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_2_icon' ); ?>' ).val(),
				uix_pb_parallax_2_icon_cur     = ( uix_pb_parallax_2_icon == undefined || uix_pb_parallax_2_icon == '' ) ? 'link' : uix_pb_parallax_2_icon,
				uix_pb_parallax_3_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_3_icon' ); ?>' ).val(),
				uix_pb_parallax_3_icon_cur     = ( uix_pb_parallax_3_icon == undefined || uix_pb_parallax_3_icon == '' ) ? 'link' : uix_pb_parallax_3_icon,
				uix_pb_parallax_1_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_1_url' ); ?>' ).val(),
				uix_pb_parallax_2_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_2_url' ); ?>' ).val(),
				uix_pb_parallax_3_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_parallax_3_url' ); ?>' ).val();
				
			
			
			if ( tempcode.length > 0 ) {
				
				
				var avatarURL    = ( uix_pb_parallax_avatar != undefined && uix_pb_parallax_avatar != '' ) ? uix_pb_parallax_avatar : '<?php echo UixPBFormCore::plug_directory(); ?>images/no-photo.png',
					social_out_1 = ( uix_pb_parallax_1_url != undefined && uix_pb_parallax_1_url != '' ) ? '<a href="'+encodeURI( uix_pb_parallax_1_url )+'" target="_blank"><i class="fa fa-'+uix_pb_parallax_1_icon_cur+'"></i></a>' : '',
					social_out_2 = ( uix_pb_parallax_2_url != undefined && uix_pb_parallax_2_url != '' ) ? '<a href="'+encodeURI( uix_pb_parallax_2_url )+'" target="_blank"><i class="fa fa-'+uix_pb_parallax_2_icon_cur+'"></i></a>' : '',
					social_out_3 = ( uix_pb_parallax_3_url != undefined && uix_pb_parallax_3_url != '' ) ? '<a href="'+encodeURI( uix_pb_parallax_3_url )+'" target="_blank"><i class="fa fa-'+uix_pb_parallax_3_icon_cur+'"></i></a>' : '';

				
				
				//---
				tempcode = tempcode
								  .replace(/{name}/g, uix_pb_parallax_title )
								  .replace(/{name_attr}/g, uixpbform_htmlEncode( uix_pb_parallax_title ) )
								  .replace(/{intro}/g, uix_pb_parallax_intro )
								  .replace(/{link_url}/g, uix_pb_parallax_link_link )
								  .replace(/{link_label}/g, uix_pb_parallax_link_label )
								  .replace(/{avatar}/g, avatarURL )
								  .replace(/{color}/g, uixpbform_htmlEncode( uix_pb_parallax_primary_color ) )
								  .replace(/{social_1}/g, social_out_1 )
								  .replace(/{social_2}/g, social_out_2 )
								  .replace(/{social_3}/g, social_out_3 );
								  
					
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_parallax_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
