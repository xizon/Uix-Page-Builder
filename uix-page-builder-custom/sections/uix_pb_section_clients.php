<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_clients';

//clone list
$clone_trigger_id        = 'uix_pb_clients_list';    // ID of clone trigger 
$clone_max               = 50;                         // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '';


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
$uix_pb_clients_config_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_config_title', __( 'Text Here', 'uix-page-builder' ) );
$uix_pb_clients_config_intro          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_config_intro', __( 'This is the description text for the title.', 'uix-page-builder' ) );
$uix_pb_clients_config_grid           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_config_grid', 3 );




$uix_pb_clients_listitem_logo       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_listitem_logo', '' ) );
$uix_pb_clients_listitem_url        = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_listitem_url', '' ) );
$uix_pb_clients_listitem_intro      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_clients_listitem_intro', __( 'The Introduction of this client.', 'uix-page-builder' ) );





//dynamic adding input
$list_clients_item_content = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_clients_listitem_logo';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		$logoURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_logo]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_logo]['.$sid.']' ] : UixPBFormCore::logo_placeholder();
	
		$list_clients_item_content .= '
        <div class="uix-pb-client-li uix-pb-client-li-'.$uix_pb_clients_config_grid.'">
           <p class="uix-pb-img">
		       '.( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_url]['.$sid.']' ] ) ? '<a href="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_url]['.$sid.']' ] ).'" target="_blank">' : '' ).'<img src="'.esc_url( $logoURL ).'" alt="" />'.( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_url]['.$sid.']' ] ) ? '</a>' : '' ).'
		       
		   </p>
		   <p>'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_clients_listitem_intro]['.$sid.']' ] ).'</p>
		  													                                                    
        </div>  
		';	
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		
		$logoURL       = ( !empty( $uix_pb_clients_listitem_logo ) ) ? $uix_pb_clients_listitem_logo : UixPBFormCore::logo_placeholder();
		
		$list_clients_item_content .= '
        <div class="uix-pb-client-li uix-pb-client-li-'.$uix_pb_clients_config_grid.'">
		   <p class="uix-pb-img">
		       '.( !empty( $uix_pb_clients_listitem_url ) ? '<a href="'.esc_url( $uix_pb_clients_listitem_url ).'" target="_blank">' : '' ).'<img src="'.esc_url( $logoURL ).'" alt="" />'.( !empty( $uix_pb_clients_listitem_url ) ? '</a>' : '' ).'
		       
		   </p>
           <p>'.uix_pb_kses( $uix_pb_clients_listitem_intro ).'</p>            
        </div>  
		';	
		
	}
	
}
	
				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-client">
	{list_content}
</div><!-- /.uix-pb-client -->      
';


$uix_pb_section_clients_temp = str_replace( '{list_content}', $list_clients_item_content,
								 str_replace( '{heading}', ( !empty( $uix_pb_clients_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_clients_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_clients_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_clients_config_intro.'</div>' : '' ),			  
					
							     $element_temp 
								 ) ) );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];



$args_config = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_config_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_clients_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_config_intro' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_clients_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_grid' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_config_grid' ),
			'title'          => __( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_clients_config_grid,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            '6'  => '6',
		                            '5'  => '5',
									'4'  => '4',
									'3'  => '3',
									'2'  => '2',
								)
		
		),	
		
		
	
	]
;


$form_type = [
    'list' => 1
];



$args = 
	[
		
		//------list begin

		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id ),
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'',
											'type'      => 'image'
										),
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'',
											'type'      => 'text'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'',
											'type'      => 'textarea'
										), 		
										
	

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_listitem_logo' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_clients_listitem_logo,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'', /*class of list item */
				'placeholder'    => __( 'LOGO URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
				
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_listitem_url' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_clients_listitem_url,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'', /*class of list item */
				'placeholder'    => __( 'Destination URL, e.g., http://your.clientsite.com', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''

			),
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_clients_listitem_intro' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_clients_listitem_intro,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'', /*class of list item */
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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_clients_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_clients_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_clients_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),		


		
	
	]
;

//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-page-builder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Clients', 'uix-page-builder' ) ); ?>            
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
		$field = 'uix_pb_clients_listitem_logo';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_clients_listitem_logo]['.$sid.']' ]
								),
				
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_clients_listitem_url]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_clients_listitem_intro]['.$sid.']' ]
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
		
		
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() {
			
			
			var tempcode                      = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_clients_config_title   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_title' ); ?>' ).val(),
				uix_pb_clients_config_intro   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_intro' ); ?>' ).val(),
				uix_pb_clients_config_grid    = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_config_grid' ); ?>' ).val();
	
	
				
			if ( tempcode.length > 0 ) {
		
				
				
				var _config_t      = ( uix_pb_clients_config_title != undefined && uix_pb_clients_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_clients_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_clients_config_intro != undefined && uix_pb_clients_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_clients_config_intro+'</div>' : '';
						
					
				
				
				
				
				/* List Item */
				var list_num               = <?php echo $clone_max; ?>,
					show_list_item_content = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid      = ( i >= 2 ) ? '#'+i+'-' : '#',
						_logo     = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_logo' ); ?>' ).val(),
						_url      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_url' ); ?>' ).val(),
						_intro    = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_clients_listitem_intro' ); ?>' ).val();
						
					
					var _item_v_logoURL        = ( _logo != undefined && _logo != '' ) ? encodeURI( _logo ) : '<?php echo UixPBFormCore::logo_placeholder(); ?>',
					    _item_v_urltag_before  = ( _url != undefined && _url != '' ) ? '<a href="'+encodeURI( _url )+'" target="_blank">' : '',
						_item_v_urltag_after   = ( _url != undefined && _url != '' ) ? '</a>' : '';
					
					if ( _logo != undefined ) {
										
						//Do not include spaces
						show_list_item_content += '<div class="uix-pb-client-li uix-pb-client-li-'+uix_pb_clients_config_grid+'">';
						show_list_item_content += '<p class="uix-pb-img">'+_item_v_urltag_before+'<img src="'+_item_v_logoURL+'" alt="" />'+_item_v_urltag_after+'</p>';
						show_list_item_content += '<p>'+_intro+'</p>';   
						show_list_item_content += '</div>';
	
					}
					
					
				}

                
				//---
				
				tempcode = tempcode.replace(/{list_content}/g, show_list_item_content )
								    .replace(/{heading}/g, _config_t )
								    .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_clients_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

