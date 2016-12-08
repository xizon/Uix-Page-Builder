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
$uix_pb_bar_margin_top                  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_margin_top', 25 );
$uix_pb_bar_margin_right                = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_margin_right', 25 );
$uix_pb_bar_margin_bottom               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_margin_bottom', 0 );
$uix_pb_bar_margin_left                 = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_margin_left', 25 );
$uix_pb_bar_shape                       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_shape', 'circular' );
$uix_pb_bar_circular_size               = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_circular_size', 120 );
$uix_pb_bar_square_size                 = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_square_size', 100 );
$uix_pb_bar_square_size_units           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_square_size_units', '%' );
$uix_pb_bar_percent                     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_percent', 75 );
$uix_pb_bar_perc_icons_size             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_perc_icons_size', 12 );
$uix_pb_bar_linewidth                   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_linewidth', 3 );
$uix_pb_bar_icon_toggle                 = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_icon_toggle', 0 ); // 0:false  1:true
$uix_pb_bar_icon_toggle_chk             = ( $uix_pb_bar_icon_toggle == 1 ) ? true : false;
$uix_pb_bar_icon                        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_icon', '' );
$uix_pb_bar_color                       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_color', '#a2bf2f' );
$uix_pb_bar_trackcolor                  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_trackcolor', '#f1f1f1' );
$uix_pb_bar_percent_icon_color          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_percent_icon_color', '#473f3f' );
$uix_pb_bar_title                       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_title', __( 'Title', 'uix-pagebuilder' ) );
$uix_pb_bar_desc                        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_desc', '' );
$uix_pb_bar_show_units                  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_bar_show_units', '%' );



if ( $uix_pb_bar_shape == 'square' ) {
	
	$content = '
	<div class="uix-pb-bar-box uix-pb-bar-box-square" style="margin:'.esc_attr( $uix_pb_bar_margin_top ).'px '.esc_attr( $uix_pb_bar_margin_right ).'px '.esc_attr( $uix_pb_bar_margin_bottom ).'px '.esc_attr( $uix_pb_bar_margin_left ).'px; width:'.esc_attr( $uix_pb_bar_square_size.$uix_pb_bar_square_size_units ).';">
		<div class="uix-pb-bar-info">
			<h3 class="uix-pb-bar-title">'.$uix_pb_bar_title.'</h3>
			<div class="uix-pb-bar-desc">'.$uix_pb_bar_desc.'</div>
		</div>
		<div class="uix-pb-bar" data-percent="'.esc_attr( $uix_pb_bar_percent ).'" data-linewidth="'.esc_attr( $uix_pb_bar_linewidth ).'" data-trackcolor="'.esc_attr( $uix_pb_bar_trackcolor ).'" data-barcolor="'.esc_attr( $uix_pb_bar_color ).'" data-units="'.esc_attr( $uix_pb_bar_show_units ).'" data-size="'.esc_attr( $uix_pb_bar_square_size.$uix_pb_bar_square_size_units ).'" data-icon="'.esc_attr( $uix_pb_bar_icon ).'">
			<span class="uix-pb-bar-percent"></span>
			<span class="uix-pb-bar-placeholder">0</span>
			<span class="uix-pb-bar-text"  style="color:'.esc_attr( $uix_pb_bar_percent_icon_color ).';font-size:'.esc_attr( $uix_pb_bar_perc_icons_size ).'px;">'.( !empty( $uix_pb_bar_icon )  ? '<i class="fa fa-'.esc_attr( $uix_pb_bar_icon ).'"></i>' : ''.$uix_pb_bar_percent.''.$uix_pb_bar_show_units.'' ).'</span>
		</div>
	</div><!-- /.uix-pb-bar-box-square -->
	';
	
	
} else {
	$content = '
			<div class="uix-pb-bar-box uix-pb-bar-box-circular" style="margin:'.esc_attr( $uix_pb_bar_margin_top ).'px '.esc_attr( $uix_pb_bar_margin_right ).'px '.esc_attr( $uix_pb_bar_margin_bottom ).'px '.esc_attr( $uix_pb_bar_margin_left ).'px;">
				<div class="uix-pb-bar" data-percent="'.esc_attr( $uix_pb_bar_percent ).'" style="width:'.esc_attr( $uix_pb_bar_circular_size ).'px;">
					<span class="uix-pb-bar-percent" data-linewidth="'.esc_attr( $uix_pb_bar_linewidth ).'" data-trackcolor="'.esc_attr( $uix_pb_bar_trackcolor ).'" data-barcolor="'.esc_attr( $uix_pb_bar_color ).'" data-units="'.esc_attr( $uix_pb_bar_show_units ).'" data-size="'.esc_attr( $uix_pb_bar_circular_size ).'px"  data-icon="'.esc_attr( $uix_pb_bar_icon ).'" style="color:'.esc_attr( $uix_pb_bar_percent_icon_color ).';font-size:'.esc_attr( $uix_pb_bar_perc_icons_size ).'px;"></span>
				</div>
				<h3 class="uix-pb-bar-title">'.$uix_pb_bar_title.'</h3>
				<div class="uix-pb-bar-desc">'.$uix_pb_bar_desc.'</div>
			</div><!-- /.uix-pb-bar-box-circular -->
	';	
	
}

$element_temp = '{content}';

$uix_pb_section_bar_temp = str_replace( '{content}', $content,
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_shape' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_shape' ),
			'title'          => __( 'Choose Style', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_shape,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'circular'  => 'circular',
									'square'  => 'square'
								),
			/* if show the target item, the target id require class like "toggle-row" */
			'toggle'        => array(
			                        array(
										'trigger_id'           => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_shape' ).'-circular', /* {item id}-{option id} */
										'toggle_class'         => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' ]

									),
			                        array(
										'trigger_id'           => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_shape' ).'-square', /* {item id}-{option id} */
										'toggle_class'         => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class' ]

									),
						
									
				                )		
								
		),
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_circular_size' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_circular_size' ),
				'title'          => __( 'Bar Size', 'uix-pagebuilder' ),
				'desc'           => '',
				'value'          => $uix_pb_bar_circular_size,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_circular_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_square_size' ),
				'title'          => __( 'Bar Size', 'uix-pagebuilder' ),
				'desc'           => '',
				'value'          => $uix_pb_bar_square_size,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-units-text',
				'default'        => array(
										'units'      => [ '%', 'px' ],
										'units_id'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size_units' ),
										'units_name'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_square_size_units' ),
										'units_value' => $uix_pb_bar_square_size_units
									)
			
			),	
			
		
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_percent' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_percent' ),
			'title'          => __( 'Percent', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_percent,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_perc_icons_size' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_perc_icons_size' ),
			'title'          => __( 'Percentage & Icon Size', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_perc_icons_size,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_linewidth' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_linewidth' ),
			'title'          => __( 'Line Width', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_linewidth,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
								)
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon_toggle' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_icon_toggle' ),
			'title'          => __( 'Icon', 'uix-pagebuilder' ),
			'desc'           => __( 'Using Icon instead of percentage.', 'uix-pagebuilder' ),
			'value'          => $uix_pb_bar_icon_toggle,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_bar_icon_toggle_chk
				                ),
			/* if show the target item, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon_toggle' ), /* {item id}-{option id} */
									'toggle_class'  => [ ''.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class' ]
				                )	
		
		
		),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_bar_icon,
				'class'          => 'toggle-row '.UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),	
			
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_color' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_color' ),
			'title'          => __( 'Bar Color', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' ]
		
		),
		

	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_trackcolor' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_trackcolor' ),
			'title'          => __( 'Track color', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_trackcolor,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' ]
		
		),
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_percent_icon_color' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_percent_icon_color' ),
			'title'          => __( 'Percentage & Icon Color', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_percent_icon_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' ]
		
		),
		
	
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_title,
			'placeholder'    => '',
			'type'           => 'text'
		),	
		
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_desc' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_desc' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_desc,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		),	
		

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_show_units' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_show_units' ),
			'title'          => __( 'Displayed Units', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_bar_show_units,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => array(
									'top'     => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_top' ), 
									'right'   => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_right' ), 
									'bottom'  => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_bottom' ), 
									'left'    => UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_left' ) 
				                ),
			'name'           => array(
									'top'     => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_margin_top' ), 
									'right'   => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_margin_right' ), 
									'bottom'  => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_margin_bottom' ), 
									'left'    => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_bar_margin_left' )
				                ),
			'title'          => __( 'Margin (px)', 'uix-pagebuilder' ),
			'desc'           => __( 'Use the input fields below to customize the margin of progress bar.', 'uix-pagebuilder' ),
			'value'          => array(
									'top'     => $uix_pb_bar_margin_top,
									'right'   => $uix_pb_bar_margin_right,
									'bottom'  => $uix_pb_bar_margin_bottom,
									'left'    => $uix_pb_bar_margin_left
				                ),
			'placeholder'    => '',
			'type'           => 'margin',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_bar_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_bar_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_bar_temp,
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Progress Bar', 'uix-pagebuilder' ) ); ?>            
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
			
			var tempcode                               = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
			    uix_pb_bar_margin_top                  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_top' ); ?>' ).val(),
				uix_pb_bar_margin_right                = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_right' ); ?>' ).val(),
				uix_pb_bar_margin_bottom               = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_bottom' ); ?>' ).val(),
				uix_pb_bar_margin_left                 = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_margin_left' ); ?>' ).val(),
				uix_pb_bar_shape                       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_shape' ); ?>' ).val(),
				uix_pb_bar_circular_size               = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_circular_size' ); ?>' ).val(),
				uix_pb_bar_square_size                 = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size' ); ?>' ).val(),
				uix_pb_bar_square_size_units           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_square_size_units' ); ?>' ).val(),
				uix_pb_bar_percent                     = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_percent' ); ?>' ).val(),
				uix_pb_bar_perc_icons_size             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_perc_icons_size' ); ?>' ).val(),
				uix_pb_bar_linewidth                   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_linewidth' ); ?>' ).val(),
				uix_pb_bar_icon                        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_icon' ); ?>' ).val(),
				uix_pb_bar_color                       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_color' ); ?>' ).val(),
				uix_pb_bar_trackcolor                  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_trackcolor' ); ?>' ).val(),
				uix_pb_bar_percent_icon_color          = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_percent_icon_color' ); ?>' ).val(),
				uix_pb_bar_title                       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_title' ); ?>' ).val(),
				uix_pb_bar_desc                        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_desc' ); ?>' ).val(),
				uix_pb_bar_show_units                  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_bar_show_units' ); ?>' ).val();
				

			if ( tempcode.length > 0 ) {
				
				var  show_content                         = '',
				     uix_pb_bar_result_color              = uix_pb_bar_color,
					 uix_pb_bar_result_trackcolor         = uix_pb_bar_trackcolor,
					 uix_pb_bar_result_percent_icon_color = uix_pb_bar_percent_icon_color,
					 uix_pb_bar_result_size               = ( uix_pb_bar_shape == 'circular' ) ? uixpbform_htmlEncode( uix_pb_bar_circular_size )+"px" : uixpbform_htmlEncode( uix_pb_bar_square_size+uix_pb_bar_square_size_units ),
					 uix_pb_bar_result_icon               = ( uix_pb_bar_icon != '' ) ? '<i class="fa fa-'+uixpbform_htmlEncode( uix_pb_bar_icon )+'"></i>' : uix_pb_bar_percent+uix_pb_bar_show_units;
					 
					 
				
				if ( uix_pb_bar_shape == 'square' ) {
					
					
					show_content += '<div class="uix-pb-bar-box uix-pb-bar-box-square" style="margin:'+uixpbform_htmlEncode( uix_pb_bar_margin_top )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_right )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_bottom )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_left )+'px;">';
					show_content += '<div style="width:'+uix_pb_bar_result_size+';">';
					show_content += '<div class="uix-pb-bar-info">';
					show_content += '<h3 class="uix-pb-bar-title">'+uix_pb_bar_title+'</h3>';
					show_content += '<div class="uix-pb-bar-desc">'+uix_pb_bar_desc+'</div>';
					show_content += '</div>';
					show_content += '<div class="uix-pb-bar" data-percent="'+uixpbform_htmlEncode( uix_pb_bar_percent )+'" data-linewidth="'+uixpbform_htmlEncode( uix_pb_bar_linewidth )+'" data-trackcolor="'+uix_pb_bar_result_trackcolor+'" data-barcolor="'+uix_pb_bar_result_color+'" data-units="'+uixpbform_htmlEncode( uix_pb_bar_show_units )+'" data-size="'+uix_pb_bar_result_size+'" data-icon="'+uixpbform_htmlEncode( uix_pb_bar_icon )+'">';
					show_content += '<span class="uix-pb-bar-percent"></span>';
					show_content += '<span class="uix-pb-bar-placeholder">0</span>';
					show_content += '<span class="uix-pb-bar-text"  style="color:'+uix_pb_bar_result_percent_icon_color+';font-size:'+uixpbform_htmlEncode( uix_pb_bar_perc_icons_size )+'px;">'+uix_pb_bar_result_icon+'</span>';
					show_content += '</div>';
					show_content += '</div>';
					show_content += '</div>';
				
					
					
				} else {
					
					show_content += '<div class="uix-pb-bar-box uix-pb-bar-box-circular" style="margin:'+uixpbform_htmlEncode( uix_pb_bar_margin_top )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_right )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_bottom )+'px '+uixpbform_htmlEncode( uix_pb_bar_margin_left )+'px;">';
					show_content += '<div class="uix-pb-bar" data-percent="'+uixpbform_htmlEncode( uix_pb_bar_percent )+'" style="width:'+uix_pb_bar_result_size+';">';
					show_content += '<span class="uix-pb-bar-percent" data-linewidth="'+uixpbform_htmlEncode( uix_pb_bar_linewidth )+'" data-trackcolor="'+uix_pb_bar_result_trackcolor+'" data-barcolor="'+uix_pb_bar_result_color+'" data-units="'+uixpbform_htmlEncode( uix_pb_bar_show_units )+'" data-size="'+uix_pb_bar_result_size+'"  data-icon="'+uixpbform_htmlEncode( uix_pb_bar_icon )+'" style="color:'+uix_pb_bar_result_percent_icon_color+';font-size:'+uixpbform_htmlEncode( uix_pb_bar_perc_icons_size )+'px;"></span>';
					show_content += '</div>';
					show_content += '<h3 class="uix-pb-bar-title">'+uix_pb_bar_title+'</h3>';
					show_content += '<div class="uix-pb-bar-desc">'+uix_pb_bar_desc+'</div>';
					show_content += '</div>';
					
					
				}
	
				//---
				
				tempcode = tempcode.replace(/{content}/g, show_content );	
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_bar_temp' ); ?>" ).val( tempcode );
	
				
			}
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}
