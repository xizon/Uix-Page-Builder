<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_portfolio1';

//clone list
$clone_trigger_id        = 'uix_pb_portfolio1_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value @var array
$clone_list_toggle_class = [ 'uix_pb_portfolio1_listitem_toggle_url' ];       


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

$form_type_config = [
    'list' => 1
];

$args_config = [
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
];						


$module_config = 
	[
	
		array(
			'id'             => 'uix_pb_portfolio1_config_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_intro',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_portfolio1_config_filterable',
			'title'          => __( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_urlwindow',
			'title'          => __( 'Open link in new tab', 'uix-page-builder' ),
			'desc'           => __( 'This option is valid when you use destination URL.', 'uix-page-builder' ),
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		

		array(
			'id'             => 'uix_pb_portfolio1_config_thumbnail_fillet',
			'title'          => __( 'Radius of Fillet Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => 'uix_pb_portfolio1_config_grid',
			'title'          => __( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
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
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'',
											'type'      => 'image'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'',
											'type'      => 'image'
										), 					
		
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => [ 
												'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
											 ]
										), 			
		

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_thumbnail',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', /*class of list item */
				'placeholder'    => __( 'Thumbnail', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_fullimage',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', /*class of list item */
				'placeholder'    => __( 'Full Preview', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),			
		
			array(
				'id'             => 'uix_pb_portfolio1_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Project Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => 'uix_pb_portfolio1_listitem_cat',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Category', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => 'uix_pb_portfolio1_listitem_intro',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'The description of this project.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => 'uix_pb_portfolio1_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => [ 
											'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
	                                     ]
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_portfolio1_listitem_toggle_url',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => __( 'Destination URL', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				
		
			
		
		//------list end
		
		
		
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

//---
$form_html  = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::form_after();


//----
$form_js_vars  = '';
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', $form_html )	
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', $form_html, 'toggle-row' );

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
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Portfolio Grid', 'uix-page-builder' ) ); ?>            
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
		$field = 'uix_pb_portfolio1_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [ 'uix_pb_portfolio1_listitem_thumbnail', 'uix_pb_portfolio1_listitem_fullimage', 'uix_pb_portfolio1_listitem_title', 'uix_pb_portfolio1_listitem_cat', 'uix_pb_portfolio1_listitem_intro', 'uix_pb_portfolio1_listitem_toggle', 'uix_pb_portfolio1_listitem_toggle_url' ];
							  
			UixPageBuilder::push_cloneform( $uid, $item, $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>

			var _config_id            = uixpbform_uid(),
				_config_t             = ( uix_pb_portfolio1_config_title != undefined && uix_pb_portfolio1_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_portfolio1_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
				_config_desc          = ( uix_pb_portfolio1_config_intro != undefined && uix_pb_portfolio1_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_portfolio1_config_intro+'</div>' : '',
				_config_avatar_fillet = uixpbform_floatval( uix_pb_portfolio1_config_thumbnail_fillet ) + '%';
			

			/* List Item */
			var list_num               = <?php echo $clone_max; ?>,
				show_list_item = '';


			for ( var i = 1; i <= list_num; i++ ){


				var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
					_thumbnail   = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ); ?>' ).val(),
					_fullimage   = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ); ?>' ).val(),
					_title       = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ); ?>' ).val(),
					_cat         = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ); ?>' ).val(),
					_intro       = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ); ?>' ).val(),
					_url         = encodeURI( $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ); ?>' ).val() );


					var _item_v_thumbnailURL  = ( _thumbnail != undefined && _thumbnail != '' ) ? _thumbnail : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
					_item_v_fullimageURL      = ( _fullimage != undefined && _fullimage != '' ) ? _fullimage : _item_v_thumbnailURL,
					_item_v_catshow           = ( _cat != undefined && _cat != '' ) ? '<div class="uix-pb-portfolio-type">'+_cat+'</div>' : '',
					_item_v_targetcode        = '';

					if ( _url != undefined && _url != '' ) {
						_item_v_targetcode   = ( uix_pb_portfolio1_config_urlwindow === true ) ? ' target="_blank"' : '';
						_item_v_fullimageURL = _url;
					} else {
						_item_v_targetcode = ( uix_pb_portfolio1_config_urlwindow === true ) ? ' target="_blank" rel="uix-pb-prettyPhoto"' : 'rel="uix-pb-prettyPhoto"';;
					}




				if ( _intro != undefined && _intro != '' ) {

					//Do not include spaces

					show_list_item += '<div class="uix-pb-portfolio-item" data-groups=\'{rowcsql:}"'+uixpbform_strToSlug( _cat )+'"{rowcsqr:}\'>';
					show_list_item += '<span class="uix-pb-portfolio-image" style="-webkit-border-radius: '+_config_avatar_fillet+'; -moz-border-radius: '+_config_avatar_fillet+'; border-radius: '+_config_avatar_fillet+';">';
					show_list_item += '<a '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'">';
					show_list_item += '<img src="'+_item_v_thumbnailURL+'" alt="" style="-webkit-border-radius: '+_config_avatar_fillet+'; -moz-border-radius: '+_config_avatar_fillet+'; border-radius: '+_config_avatar_fillet+';">';
					show_list_item += '</a>';
					show_list_item += '</span>';
					show_list_item += '<h3><a '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'">'+_title+'</a></h3>';
					show_list_item += _item_v_catshow;
					show_list_item += '<div class="uix-pb-portfolio-content">';
					show_list_item += _intro;
					show_list_item += '<a class="uix-pb-portfolio-link" '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'"></a>';
					show_list_item += '</div>';
					show_list_item += '</div>';

				}


			}


			//Display categories on page
			var catlist = '';
			if (  uix_pb_portfolio1_config_filterable === true ) {
				catlist += '<div class="uix-pb-portfolio-cat-list uix-pb-filterable" data-classprefix="uix-pb-portfolio-"  data-filter-id="'+_config_id+'" id="uix-pb-portfolio-cat-list-'+_config_id+'">';
				catlist += '<ul>';
				catlist += '<li class="current"><a href="javascript:" data-group="all"><?php echo __( 'All', 'uix-page-builder' ); ?></a></li>';
				catlist += uixpbform_catlist( show_list_item, 'uix-pb-portfolio-' );
				catlist += '</ul>';
				catlist += '</div>';

			}


			var temp = '';
				temp += _config_t;
				temp += _config_desc;
				temp += catlist;
				temp += '<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col'+uix_pb_portfolio1_config_grid+'" id="uix-pb-portfolio-filter-stage-'+_config_id+'">';
				temp += show_list_item;
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

