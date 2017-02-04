<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_bar';

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
			'id'             => 'uix_pb_bar_shape',
			'title'          => __( 'Choose Style', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'circular',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'circular'  => 'circular',
									'square'  => 'square'
								),
			/* If the toggle of switch with radio is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
			                        array(
										'trigger_id'           => 'circular', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' ]

									),
			                        array(
										'trigger_id'           => 'square', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' ]

									),
						
									
				                )		
								
		),
		
			array(
				'id'             => 'uix_pb_bar_circular_size',
				'title'          => __( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 120,
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),
			
			array(
				'id'             => 'uix_pb_bar_square_size',
				'title'          => __( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 100,
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-units-text',
				'default'        => array(
										'units'      => [ '%', 'px' ],
										'units_id'    => 'uix_pb_bar_square_size_units',
										'units_value' => '%'
									)
			
			),	
			
		
	
		array(
			'id'             => 'uix_pb_bar_percent',
			'title'          => __( 'Percent', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 75,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),
	
		
		array(
			'id'             => 'uix_pb_bar_perc_icons_size',
			'title'          => __( 'Percentage & Icon Size', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 12,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),	
		
		array(
			'id'             => 'uix_pb_bar_linewidth',
			'title'          => __( 'Line Width', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),
		
		array(
			'id'             => 'uix_pb_bar_icon_toggle',
			'title'          => __( 'Icon', 'uix-page-builder' ),
			'desc'           => __( 'Using Icon instead of percentage.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox',
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'    => '', /* {option id} */
									'toggle_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class' ]
				                )	
		
		
		),	
		
			array(
				'id'             => 'uix_pb_bar_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),	
			
		array(
			'id'             => 'uix_pb_bar_color',
			'title'          => __( 'Bar Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' ]
		
		),
		

	
		array(
			'id'             => 'uix_pb_bar_trackcolor',
			'title'          => __( 'Track color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#f1f1f1',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' ]
		
		),
	
		array(
			'id'             => 'uix_pb_bar_percent_icon_color',
			'title'          => __( 'Percentage & Icon Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#473f3f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' ]
		
		),
		
	
	    array(
			'id'             => 'uix_pb_bar_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Title', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		),	
		
		
	    array(
			'id'             => 'uix_pb_bar_desc',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		),	
		

		array(
			'id'             => 'uix_pb_bar_show_units',
			'title'          => __( 'Displayed Units', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '%',
			'placeholder'    => '',
			'type'           => 'text'
		
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Progress Bar', 'uix-page-builder' ) ); ?>            
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


			var  temp                                 = '',
				 uix_pb_bar_result_color              = uix_pb_bar_color,
				 uix_pb_bar_result_trackcolor         = uix_pb_bar_trackcolor,
				 uix_pb_bar_result_percent_icon_color = uix_pb_bar_percent_icon_color,
				 uix_pb_bar_result_size               = ( uix_pb_bar_shape == 'circular' ) ? uixpbform_floatval( uix_pb_bar_circular_size )+"px" : uixpbform_floatval( uix_pb_bar_square_size )+uix_pb_bar_square_size_units,
				 uix_pb_bar_result_icon               = ( uix_pb_bar_icon != '' ) ? '<i class="fa fa-'+uixpbform_htmlEncode( uix_pb_bar_icon )+'"></i>' : uix_pb_bar_percent+uix_pb_bar_show_units;

			if ( uix_pb_bar_shape == 'square' ) {


				temp += '<div class="uix-pb-bar-box uix-pb-bar-box-square">';
				temp += '<div style="width:'+uix_pb_bar_result_size+';">';
				temp += '<div class="uix-pb-bar-info">';
				temp += '<h3 class="uix-pb-bar-title">'+uix_pb_bar_title+'</h3>';
				temp += '<div class="uix-pb-bar-desc">'+uix_pb_bar_desc+'</div>';
				temp += '</div>';
				temp += '<div class="uix-pb-bar" data-percent="'+uixpbform_floatval( uix_pb_bar_percent )+'" data-linewidth="'+uixpbform_floatval( uix_pb_bar_linewidth )+'" data-trackcolor="'+uix_pb_bar_result_trackcolor+'" data-barcolor="'+uix_pb_bar_result_color+'" data-units="'+uixpbform_htmlEncode( uix_pb_bar_show_units )+'" data-size="'+uix_pb_bar_result_size+'" data-icon="'+uixpbform_htmlEncode( uix_pb_bar_icon )+'">';
				temp += '<span class="uix-pb-bar-percent"></span>';
				temp += '<span class="uix-pb-bar-placeholder">0</span>';
				temp += '<span class="uix-pb-bar-text"  style="color:'+uix_pb_bar_result_percent_icon_color+';font-size:'+uixpbform_floatval( uix_pb_bar_perc_icons_size )+'px;">'+uix_pb_bar_result_icon+'</span>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';



			} else {

				temp += '<div class="uix-pb-bar-box uix-pb-bar-box-circular">';
				temp += '<div class="uix-pb-bar" data-percent="'+uixpbform_floatval( uix_pb_bar_percent )+'" style="width:'+uix_pb_bar_result_size+';">';
				temp += '<span class="uix-pb-bar-percent" data-linewidth="'+uixpbform_floatval( uix_pb_bar_linewidth )+'" data-trackcolor="'+uix_pb_bar_result_trackcolor+'" data-barcolor="'+uix_pb_bar_result_color+'" data-units="'+uixpbform_htmlEncode( uix_pb_bar_show_units )+'" data-size="'+uix_pb_bar_result_size+'"  data-icon="'+uixpbform_htmlEncode( uix_pb_bar_icon )+'" style="color:'+uix_pb_bar_result_percent_icon_color+';font-size:'+uixpbform_floatval( uix_pb_bar_perc_icons_size )+'px;"></span>';
				temp += '</div>';
				temp += '<h3 class="uix-pb-bar-title">'+uix_pb_bar_title+'</h3>';
				temp += '<div class="uix-pb-bar-desc">'+uix_pb_bar_desc+'</div>';
				temp += '</div>';


			}

			
			/* Save data */
			$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
			
		}
		
		uix_pb_temp();
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() { uix_pb_temp(); });
		

		
		
		 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
