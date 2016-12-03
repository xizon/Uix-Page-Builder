<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_accordion';
$clone_trigger_id        = 'uix_pb_accordion_list';    // ID of clone trigger 
$clone_max               = 5;                          // Maximum of clone form 
$clone_list_toggle_class = '';                         // Clone list of toggle class value


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
			$col         = $value->col;
			$row         = $value->row;
			$size_x      = $value->size_x;
			$section_id  = $value->secindex;

			
		
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
 * Element Template : Accordion
 * ----------------------------------------------------
 */
$uix_pb_accordion_listitem_title  = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_accordion_listitem_title', __( 'Accordion Title', 'uix-pagebuilder' ) );
$uix_pb_accordion_listitem_con    = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_accordion_listitem_con', __( 'Accordion content here.', 'uix-pagebuilder' ) );


// Dynamic Adding Input ( Default Value )
$list_accordion_item = '';



for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_accordion_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$list_accordion_item .= '
		<div class="uix-pb-spoiler">
			<div class="uix-pb-spoiler-title">'.$item[ '['.$colid.']'.$_uid.'[uix_pb_accordion_listitem_title]['.$sid.']' ].'</div>
			<div class="uix-pb-spoiler-content">
				<p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_accordion_listitem_con]['.$sid.']' ].'</p>
			</div>                   
		</div>     
		';
	} 
}
					
$element_temp = '
<div class="uix-pb-accordion-box">
   <div class="uix-pb-accordion" data-effect="slide">
		  {list}
	</div><!-- /.uix-pb-accordion -->
</div><!-- /.uix-pb-accordion-box -->    
	
<div class="uix-pb-accordion">
	
</div> 
';


$uix_pb_section_accordion_temp = str_replace( '{list}', $list_accordion_item,
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
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'',
											'type'      => 'text'
										), 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'',
											'type'      => 'textarea'
										), 
	

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_accordion_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_accordion_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_accordion_listitem_con' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_accordion_listitem_con,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
			
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_accordion_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_accordion_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_accordion_temp,
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

$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html ).UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( 'uix_pb_accordion_list', $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert Accordion', 'uix-pagebuilder' ) ); ?>            
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
	
	
    /*-- Dynamic Adding Input ( Default Value ) --*/
	for ( $i = 2; $i <= $clone_max; $i++ ) {
		$uid = $i.'-';
		$field = 'uix_pb_accordion_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_accordion_listitem_title]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_accordion_listitem_title]['.$sid.']' ]
								),
								array(
									'replace'  => $item[ '['.$colid.'][uix_pb_accordion_listitem_con]['.$sid.']' ],
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_accordion_listitem_con]['.$sid.']' ]
								),
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "input change keyup focusin focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			
			var tempcode = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>';
				
			if ( tempcode.length > 0 ) {
				
				/* List Item */
				var list_num       = <?php echo $clone_max; ?>,
					show_list_item = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					var _uid     = ( i >= 2 ) ? '#'+i+'-' : '#',
						_title   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_title' ); ?>' ).val(),
						_con     = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_accordion_listitem_con' ); ?>' ).val();
						
					var _item_v_title = ( _title != undefined ) ? _title : '',
						_item_v_con   = ( _con != undefined ) ? _con : '';
					
					
					if ( _title != undefined ) {
										
						//Do not include spaces
						show_list_item += '<div class="uix-pb-spoiler">';
						show_list_item += '<div class="uix-pb-spoiler-title">'+_item_v_title+'</div>';
						show_list_item += '<div class="uix-pb-spoiler-content">';
						show_list_item += '<p>'+_item_v_con+'</p>';
						show_list_item += '</div>  ';                 
						show_list_item += '</div>';
	
					}
						
					
				}


				
				tempcode = tempcode.replace(/{list}/g, show_list_item );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_accordion_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

