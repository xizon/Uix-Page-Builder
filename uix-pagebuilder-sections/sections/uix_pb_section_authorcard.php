<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_authorcard';

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
$uix_pb_authorcard_primary_color  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_primary_color', '#a2bf2f' );
$uix_pb_authorcard_avatar         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_avatar', '' );
$uix_pb_authorcard_name           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_name', __( 'Your Name', 'uix-pagebuilder' ) );
$uix_pb_authorcard_intro          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_intro', __( 'There is no description.', 'uix-pagebuilder' ) );
$uix_pb_authorcard_link_label     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_link_label', __( '&rarr;', 'uix-pagebuilder' ) );
$uix_pb_authorcard_link_link      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_link_link', '#' );
$uix_pb_authorcard_1_icon         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_1_icon', '' );
$uix_pb_authorcard_2_icon         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_2_icon', '' );
$uix_pb_authorcard_3_icon         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_3_icon', '' );
$uix_pb_authorcard_1_url          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_1_url', '' );
$uix_pb_authorcard_2_url          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_2_url', '' );
$uix_pb_authorcard_3_url          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_authorcard_3_url', '' );


$element_temp = '
<div class="uix-pb-authorcard" style="border-top-color: {color};">
	<div class="uix-pb-authorcard-top">
		<div class="uix-pb-authorcard-text">
			<h3 class="uix-pb-authorcard-title">{name}
			{social_1}
			{social_2}
			{social_3}
			</h3> 	 
		</div>
		<div class="uix-pb-authorcard-pic"><img src="{avatar}" alt="{name_attr}"></div>
	</div>
	<div class="uix-pb-authorcard-middle">{intro}</div> 
	<a class="uix-pb-authorcard-final" href="{link_url}" rel="author">{link_label}</a> 
</div> 
';
 
 
$avatarURL = ( !empty( $uix_pb_authorcard_avatar ) ) ? $uix_pb_authorcard_avatar : UixPBFormCore::plug_directory() .'images/no-photo.png';
$social_out_1 = ( !empty( $uix_pb_authorcard_1_url ) ) ? '<a href=\''.$uix_pb_authorcard_1_url.'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $uix_pb_authorcard_1_icon ) ? $uix_pb_authorcard_1_icon : 'link' ).'\'></i></a>' : '';
$social_out_2 = ( !empty( $uix_pb_authorcard_2_url ) ) ? '<a href=\''.$uix_pb_authorcard_2_url.'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $uix_pb_authorcard_2_icon ) ? $uix_pb_authorcard_2_icon : 'link' ).'\'></i></a>' : '';
$social_out_3 = ( !empty( $uix_pb_authorcard_3_url ) ) ? '<a href=\''.$uix_pb_authorcard_3_url.'\' target=\'_blank\'><i class=\'fa fa-'.( !empty( $uix_pb_authorcard_3_icon ) ? $uix_pb_authorcard_3_icon : 'link' ).'\'></i></a>' : '';


$uix_pb_section_authorcard_temp = str_replace( '{name}', wp_kses( $uix_pb_authorcard_name, wp_kses_allowed_html( 'post' ) ), 
                                  str_replace( '{name_attr}', esc_attr( $uix_pb_authorcard_name ), 
								  str_replace( '{intro}', wp_kses( $uix_pb_authorcard_intro, wp_kses_allowed_html( 'post' ) ), 
								  str_replace( '{link_url}', esc_url( $uix_pb_authorcard_link_link ), 
								  str_replace( '{link_label}', wp_kses( $uix_pb_authorcard_link_label, wp_kses_allowed_html( 'post' ) ), 
								  str_replace( '{avatar}',esc_url( $avatarURL ), 
								  str_replace( '{color}', esc_attr( $uix_pb_authorcard_primary_color ), 
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_primary_color' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_primary_color' ),
			'title'          => __( 'Primary Color', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_primary_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_avatar' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_avatar' ),
			'title'          => __( 'Author Picture', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_avatar,
			'placeholder'    => __( 'Avatar URL', 'uix-pagebuilder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
								)
		
		),	
		

		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_name' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_name' ),
			'title'          => __( 'Author Name', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_name,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_intro' ),
			'title'          => __( 'Biographical Info', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_link_label' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_link_label' ),
			'title'          => __( 'Link Text', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_link_label,
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_link_link' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_link_link' ),
			'title'          => __( 'Link URL', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_link_link,
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),		



		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_1_url' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_1_url' ),
			'title'          => __( 'Social Network 1', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_1_url,
			'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-pagebuilder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_1_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_1_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_authorcard_1_icon,
			'placeholder'    => __( 'Choose Social Icon 1', 'uix-pagebuilder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_2_url' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_2_url' ),
			'title'          => __( 'Social Network 2', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_2_url,
			'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-pagebuilder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_2_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_2_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_authorcard_2_icon,
			'placeholder'    => __( 'Choose Social Icon 2', 'uix-pagebuilder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
			
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_3_url' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_3_url' ),
			'title'          => __( 'Social Network 3', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_authorcard_3_url,
			'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-pagebuilder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_3_icon' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_authorcard_3_icon' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_authorcard_3_icon,
			'placeholder'    => __( 'Choose Social Icon 3', 'uix-pagebuilder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),		



        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_authorcard_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_authorcard_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_authorcard_temp,
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
				uix_pb_authorcard_primary_color  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_primary_color' ); ?>' ).val(),
				uix_pb_authorcard_avatar         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_avatar' ); ?>' ).val(),
				uix_pb_authorcard_name           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_name' ); ?>' ).val(),
				uix_pb_authorcard_intro          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_intro' ); ?>' ).val(),
				uix_pb_authorcard_link_label     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_link_label' ); ?>' ).val(),
				uix_pb_authorcard_link_link      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_link_link' ); ?>' ).val(),
				uix_pb_authorcard_1_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_1_icon' ); ?>' ).val(),
				uix_pb_authorcard_1_icon_cur     = ( uix_pb_authorcard_1_icon == undefined || uix_pb_authorcard_1_icon == '' ) ? 'link' : uix_pb_authorcard_1_icon,
				uix_pb_authorcard_2_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_2_icon' ); ?>' ).val(),
				uix_pb_authorcard_2_icon_cur     = ( uix_pb_authorcard_2_icon == undefined || uix_pb_authorcard_2_icon == '' ) ? 'link' : uix_pb_authorcard_2_icon,
				uix_pb_authorcard_3_icon         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_3_icon' ); ?>' ).val(),
				uix_pb_authorcard_3_icon_cur     = ( uix_pb_authorcard_3_icon == undefined || uix_pb_authorcard_3_icon == '' ) ? 'link' : uix_pb_authorcard_3_icon,
				uix_pb_authorcard_1_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_1_url' ); ?>' ).val(),
				uix_pb_authorcard_2_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_2_url' ); ?>' ).val(),
				uix_pb_authorcard_3_url          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_authorcard_3_url' ); ?>' ).val();
				
			
			
			if ( tempcode.length > 0 ) {
				
				
				var avatarURL    = ( uix_pb_authorcard_avatar != undefined && uix_pb_authorcard_avatar != '' ) ? uix_pb_authorcard_avatar : '<?php echo UixPBFormCore::plug_directory(); ?>images/no-photo.png',
					social_out_1 = ( uix_pb_authorcard_1_url != undefined && uix_pb_authorcard_1_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_1_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_1_icon_cur+'"></i></a>' : '',
					social_out_2 = ( uix_pb_authorcard_2_url != undefined && uix_pb_authorcard_2_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_2_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_2_icon_cur+'"></i></a>' : '',
					social_out_3 = ( uix_pb_authorcard_3_url != undefined && uix_pb_authorcard_3_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_3_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_3_icon_cur+'"></i></a>' : '';

				
				
				//---
				tempcode = tempcode
								  .replace(/{name}/g, uix_pb_authorcard_name )
								  .replace(/{name_attr}/g, uixpbform_htmlEncode( uix_pb_authorcard_name ) )
								  .replace(/{intro}/g, uix_pb_authorcard_intro )
								  .replace(/{link_url}/g, uix_pb_authorcard_link_link )
								  .replace(/{link_label}/g, uix_pb_authorcard_link_label )
								  .replace(/{avatar}/g, avatarURL )
								  .replace(/{color}/g, uixpbform_htmlEncode( uix_pb_authorcard_primary_color ) )
								  .replace(/{social_1}/g, social_out_1 )
								  .replace(/{social_2}/g, social_out_2 )
								  .replace(/{social_3}/g, social_out_3 );
								  
					
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_authorcard_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
