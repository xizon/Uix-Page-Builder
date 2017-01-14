<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_contactform1';

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

$uix_pb_section_contactform1_code = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_section_contactform1_code', '[uix_pb_contact_form]' );

$element_temp = '{contactform_shortcode}';
 
 
$uix_pb_section_contactform1_temp = str_replace( '{contactform_shortcode}', $uix_pb_section_contactform1_code,

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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_contactform1_code' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_contactform1_code' ),
			'title'          => __( 'Shortcode', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_section_contactform1_code,
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	    array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_contactform1_tipinfo' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_contactform1_tipinfo' ),
			'desc'           => __( 'Output a complete commenting form with your theme by default. <strong>You can install a contact form plugin you want. When you\'re done, copy shortcode and paste into the editor.</strong>', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'warning'  //error, success, warning, note
				                ),
		
		),	


        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_contactform1_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_contactform1_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_contactform1_temp,
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
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Contact Form', 'uix-page-builder' ) ); ?>         
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
			
			var tempcode                          = "<?php echo UixPBFormCore::str_compression( $element_temp ); ?>",
				uix_pb_section_contactform1_code  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_contactform1_code' ); ?>' ).val();
				
			
			
			
			if ( tempcode.length > 0 ) {
					
				//---
				tempcode = tempcode
								  .replace(/{contactform_shortcode}/g, uix_pb_section_contactform1_code );
				
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_contactform1_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}
