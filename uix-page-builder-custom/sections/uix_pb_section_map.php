<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_map';

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
	$item              = array();
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
$form_type = array(
	'list' => false
);


$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						
					

$args = 
	array(

	    array(
			'id'             => 'uix_pb_map_style',
			'title'          => __( 'Map Style', 'uix-page-builder' ),
			'desc'           => __( 'You can make a search, use the name of a place, city, state, or address, or click the location on the map to get lat long coordinates. &rarr; <a href="//www.latlong.net/" target="_blank">Get Latitude Longitude</a>', 'uix-page-builder' ),
			'value'          => 'normal',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'normal'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-1.png',
									'gray'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-2.png',
									'black'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-3.png',
									'real'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-4.png',
									'terrain'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-5.png',
									'white'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-6.png',
									'dark-blue'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-7.png',
									'dark-blue-2'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-8.png',
									'blue'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-9.png',
									'flat'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-style-10.png',
				                )
		
		),
		
	    array(
			'id'             => 'uix_pb_map_width',
			'title'          => __( 'Map Width', 'uix-page-builder' ),
			'desc'           => __( 'It default to using a 100% width.', 'uix-page-builder' ),
			'value'          => 100,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'       => array( '%', 'px' ),
									'units_id'    => 'uix_pb_map_width_units',
									'units_value' => '%',
				                )
		
		),
		
	    array(
			'id'             => 'uix_pb_map_height',
			'title'          => __( 'Map Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 285,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => array( 'px', 'vh' ),
									'units_id'    => 'uix_pb_map_height_units',
									'units_value' => 'px'
								)
		
		),	
		
		
		
		array(
			'id'             => 'uix_pb_map_name',
			'title'          => __( 'Place Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'SEO San Francisco, CA, Gough Street, San Francisco, CA', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => 'uix_pb_map_latitude',
			'title'          => __( 'Latitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 37.7770776,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		array(
			'id'             => 'uix_pb_map_longitude',
			'title'          => __( 'Longitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => -122.4414289,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_map_zoom',
			'title'          => __( 'Zoom', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 14,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'min'   => 3,
									'max'   => 21,
									'step'  => 1
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_map_marker',
			'title'          => __( 'Marker', 'uix-page-builder' ),
			'desc'           => __( 'By default, a marker uses a standard image. Markers can display custom images, in which case they are usually referred to as "icons."', 'uix-page-builder' ),
			'value'          => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-location.png',
			'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
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

	
	)
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Google Map', 'uix-page-builder' ) ); ?>         
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


			var temp = '[uix_pb_map style=\''+uixpbform_htmlEncode( uix_pb_map_style )+'\' width=\''+uixpbform_floatval( uix_pb_map_width )+''+uixpbform_htmlEncode( uix_pb_map_width_units )+'\' height=\''+uixpbform_floatval( uix_pb_map_height )+''+uixpbform_htmlEncode( uix_pb_map_height_units )+'\' latitude=\''+uixpbform_floatval( uix_pb_map_latitude )+'\' longitude=\''+uixpbform_floatval( uix_pb_map_longitude )+'\' zoom=\''+uixpbform_floatval( uix_pb_map_zoom )+'\' name=\''+uixpbform_htmlEncode( uix_pb_map_name )+'\' marker=\''+encodeURI( uix_pb_map_marker )+'\' ]';
			
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
