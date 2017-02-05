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
			'id'             => 'uix_pb_authorcard_primary_color',
			'title'          => __( 'Primary Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),

		array(
			'id'             => 'uix_pb_authorcard_avatar',
			'title'          => __( 'Author Picture', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Avatar URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
								)
		
		),	
		

		
		array(
			'id'             => 'uix_pb_authorcard_name',
			'title'          => __( 'Author Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Your Name', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_authorcard_intro',
			'title'          => __( 'Biographical Info', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Quae cum praeponunt, ut sit aliqua rerum selectio, naturam videntur sequi; Tu vero, inquam, ducas licet, si sequetur; Ab his oratores, ab his imperatores ac rerum publicarum principes extiterunt. Igitur neque stultorum quisquam beatus neque sapientium non beatus.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	

		array(
			'id'             => 'uix_pb_authorcard_link_label',
			'title'          => __( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '&rarr;', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_authorcard_link_link',
			'title'          => __( 'Link URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),		



		array(
			'id'             => 'uix_pb_authorcard_1_url',
			'title'          => __( 'Social Network 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_1_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 1', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_authorcard_2_url',
			'title'          => __( 'Social Network 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_2_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 2', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
			
		
		array(
			'id'             => 'uix_pb_authorcard_3_url',
			'title'          => __( 'Social Network 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_3_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 3', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Author Card', 'uix-page-builder' ) ); ?>         
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


			var avatarURL    = ( uix_pb_authorcard_avatar != undefined && uix_pb_authorcard_avatar != '' ) ? encodeURI( uix_pb_authorcard_avatar ) : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
				uix_pb_authorcard_1_icon_cur     = ( uix_pb_authorcard_1_icon == undefined || uix_pb_authorcard_1_icon == '' ) ? 'link' : uix_pb_authorcard_1_icon,
				uix_pb_authorcard_2_icon_cur     = ( uix_pb_authorcard_2_icon == undefined || uix_pb_authorcard_2_icon == '' ) ? 'link' : uix_pb_authorcard_2_icon,
				uix_pb_authorcard_3_icon_cur     = ( uix_pb_authorcard_3_icon == undefined || uix_pb_authorcard_3_icon == '' ) ? 'link' : uix_pb_authorcard_3_icon,	
				social_out_1 = ( uix_pb_authorcard_1_url != undefined && uix_pb_authorcard_1_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_1_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_1_icon_cur+'"></i></a>' : '',
				social_out_2 = ( uix_pb_authorcard_2_url != undefined && uix_pb_authorcard_2_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_2_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_2_icon_cur+'"></i></a>' : '',
				social_out_3 = ( uix_pb_authorcard_3_url != undefined && uix_pb_authorcard_3_url != '' ) ? '<a href="'+encodeURI( uix_pb_authorcard_3_url )+'" target="_blank"><i class="fa fa-'+uix_pb_authorcard_3_icon_cur+'"></i></a>' : '';


			var temp = '';
				temp += '<div class="uix-pb-authorcard-wrapper">';
				temp += '<div class="uix-pb-authorcard" style="border-top-color: '+uixpbform_htmlEncode(uix_pb_authorcard_primary_color)+';">';
				temp += '<div class="uix-pb-authorcard-top">';
				temp += '<div class="uix-pb-authorcard-text">';
				temp += '<h3 class="uix-pb-authorcard-title">'+uix_pb_authorcard_name+'';
				temp += social_out_1;
				temp += social_out_2;
				temp += social_out_3;
				temp += '</h3>';	 
				temp += '</div>';
				temp += '<div class="uix-pb-authorcard-pic"><img src="'+avatarURL+'" alt="'+uixpbform_htmlEncode(uix_pb_authorcard_name)+'"></div>';
				temp += '</div>';
				temp += '<div class="uix-pb-authorcard-middle">'+uix_pb_authorcard_intro+'</div>';
				temp += '<a class="uix-pb-authorcard-final" href="'+encodeURI(uix_pb_authorcard_link_link)+'" rel="author">'+uix_pb_authorcard_link_label+'</a>';
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
