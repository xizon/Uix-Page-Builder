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
$uix_pb_map_style        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_style', 'normal' );
$uix_pb_map_width        = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_width', 100 ) );
$uix_pb_map_height       = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_height', 285 ) );
$uix_pb_map_height_units = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_height_units', 'px' );
$uix_pb_map_width_units  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_width_units', '%' );
$uix_pb_map_name         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_name', 'SEO San Francisco, CA, Gough Street, San Francisco, CA' );
$uix_pb_map_latitude     = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_latitude', 37.7770776 ) );
$uix_pb_map_longitude    = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_longitude', -122.4414289 ) );
$uix_pb_map_zoom         = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_zoom', 14 ) );
$uix_pb_map_marker       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_map_marker', UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-location.png' );


$element_temp = '[uix_pb_map style=\'{map_style}\' width=\'{map_width}{map_width_units}\' height=\'{map_height}{map_height_units}\' latitude=\'{map_latitude}\' longitude=\'{map_longitude}\' zoom=\'{map_zoom}\' name=\'{map_name}\' marker=\'{map_marker}\' ]';
 
 
$uix_pb_section_map_temp = str_replace( '{map_marker}', esc_url( $uix_pb_map_marker ), 
						  str_replace( '{map_name}', esc_attr( $uix_pb_map_name ), 
						  str_replace( '{map_style}', esc_attr( $uix_pb_map_style ), 
						  str_replace( '{map_width}', esc_attr( $uix_pb_map_width ), 
						  str_replace( '{map_width_units}', esc_attr( $uix_pb_map_width_units ), 
						  str_replace( '{map_height}', esc_attr( $uix_pb_map_height ), 
						  str_replace( '{map_height_units}', esc_attr( $uix_pb_map_height_units ), 
						  str_replace( '{map_latitude}', esc_attr( $uix_pb_map_latitude ), 
						  str_replace( '{map_longitude}', esc_attr( $uix_pb_map_longitude ), 
						  str_replace( '{map_zoom}', esc_attr( $uix_pb_map_zoom ), 

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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_style' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_style' ),
			'title'          => __( 'Map Style', 'uix-page-builder' ),
			'desc'           => __( 'You can make a search, use the name of a place, city, state, or address, or click the location on the map to get lat long coordinates. &rarr; <a href="//www.latlong.net/" target="_blank">Get Latitude Longitude</a>', 'uix-page-builder' ),
			'value'          => $uix_pb_map_style,
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_width' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_width' ),
			'title'          => __( 'Map Width', 'uix-page-builder' ),
			'desc'           => __( 'It default to using a 100% width.', 'uix-page-builder' ),
			'value'          => $uix_pb_map_width,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'       => [ '%', 'px' ],
									'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_width_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_width_units' ),
									'units_value' => $uix_pb_map_width_units,
				                )
		
		),
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_height' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_height' ),
			'title'          => __( 'Map Height', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_map_height,
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'      => [ 'px', 'vh' ],
									'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_height_units' ),
									'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_height_units' ),
									'units_value' => $uix_pb_map_height_units
								)
		
		),	
		
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_name' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_name' ),
			'title'          => __( 'Place Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_map_name,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_latitude' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_latitude' ),
			'title'          => __( 'Latitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_map_latitude,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_longitude' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_longitude' ),
			'title'          => __( 'Longitude', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_map_longitude,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_zoom' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_zoom' ),
			'title'          => __( 'Zoom', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_map_zoom,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
									'min'   => 3,
									'max'   => 21,
									'step'  => 1
				                )
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_marker' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_map_marker' ),
			'title'          => __( 'Marker', 'uix-page-builder' ),
			'desc'           => __( 'By default, a marker uses a standard image. Markers can display custom images, in which case they are usually referred to as "icons."', 'uix-page-builder' ),
			'value'          => $uix_pb_map_marker,
			'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
				                )
		
		),		



        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_map_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_map_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_map_temp,
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
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Google Map', 'uix-page-builder' ) ); ?>         
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
			
			var tempcode                = "<?php echo UixPBFormCore::str_compression( $element_temp ); ?>",
				uix_pb_map_style        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_style' ); ?>' ).val(),
				uix_pb_map_width        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_width' ); ?>' ).val(),
				uix_pb_map_height       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_height' ); ?>' ).val(),
				uix_pb_map_height_units = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_height_units' ); ?>' ).val(),
				uix_pb_map_width_units  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_width_units' ); ?>' ).val(),
				uix_pb_map_name         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_name' ); ?>' ).val(),
				uix_pb_map_latitude     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_latitude' ); ?>' ).val(),
				uix_pb_map_longitude    = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_longitude' ); ?>' ).val(),
				uix_pb_map_zoom         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_zoom' ); ?>' ).val(),
				uix_pb_map_marker       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_map_marker' ); ?>' ).val();
				
			
			
			if ( tempcode.length > 0 ) {
				
						  
				//---
				tempcode = tempcode
								  .replace(/{map_marker}/g, encodeURI( uix_pb_map_marker ) )
								  .replace(/{map_name}/g, uixpbform_htmlEncode( uix_pb_map_name ) )
								  .replace(/{map_style}/g, uixpbform_htmlEncode( uix_pb_map_style ) )
								  .replace(/{map_width}/g, uixpbform_floatval( uix_pb_map_width ) )
								  .replace(/{map_width_units}/g, uixpbform_htmlEncode( uix_pb_map_width_units )  )
								  .replace(/{map_height}/g, uixpbform_floatval( uix_pb_map_height ) )
				                  .replace(/{map_height_units}/g, uixpbform_htmlEncode( uix_pb_map_height_units ) )
								  .replace(/{map_latitude}/g, uixpbform_floatval( uix_pb_map_latitude ) )
								  .replace(/{map_longitude}/g, uixpbform_floatval( uix_pb_map_longitude )  )
								  .replace(/{map_zoom}/g, uixpbform_floatval( uix_pb_map_zoom ) );
								  
					
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_map_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
