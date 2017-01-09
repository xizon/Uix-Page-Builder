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
//clone list of toggle class value
$clone_list_toggle_class = '#{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'';       



$uniqid_id                                 = uniqid(); 

$uix_pb_portfolio1_config_title            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_title', __( 'Text Here', 'uix-page-builder' ) );
$uix_pb_portfolio1_config_intro            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_intro', __( 'This is the description text for the title.', 'uix-page-builder' ) );
$uix_pb_portfolio1_config_filterable        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_filterable', 0 ); // 0:false  1:true
$uix_pb_portfolio1_config_filterable_chk    = ( $uix_pb_portfolio1_config_filterable == 1 ) ? true : false;
$uix_pb_portfolio1_config_urlwindow         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_urlwindow', 0 ); // 0:false  1:true
$uix_pb_portfolio1_config_urlwindow_chk     = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? true : false;
$uix_pb_portfolio1_config_thumbnail_fillet  = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_thumbnail_fillet', 0 ) );
$uix_pb_portfolio1_config_grid              = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_grid', 3 );


$uix_pb_portfolio1_listitem_thumbnail       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_thumbnail', '' ) );
$uix_pb_portfolio1_listitem_fullimage       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_fullimage', '' ) );
$uix_pb_portfolio1_listitem_title           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_title', __( 'Project Title', 'uix-page-builder' ) );
$uix_pb_portfolio1_listitem_cat             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_cat', __( 'Category', 'uix-page-builder' ) );
$uix_pb_portfolio1_listitem_intro           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_intro', __( 'The description of this project.', 'uix-page-builder' ) );
$uix_pb_portfolio1_listitem_toggle          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_toggle', 0 ); // 0:close  1:open
$uix_pb_portfolio1_listitem_toggle_url      = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_toggle_url', '' ) );


//dynamic adding input
$list_portfolio1_item_content = '';
$thumbnailfillet              =  $uix_pb_portfolio1_config_thumbnail_fillet.'%';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_portfolio1_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$thumbnailURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ] ) ) ? esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ] ) : UixPBFormCore::photo_placeholder();
		$fullimageURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ] ) ) ? esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ] ) : $thumbnailURL;
		$cat                = uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_cat]['.$sid.']' ] );
		
		$targetcode = '';
		if ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ] ) ) {
			$targetcode   = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? ' target="_blank"' : '';
			$fullimageURL = esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ] );
		} else {
			$targetcode = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? ' target="_blank" rel="uix-pb-prettyPhoto"' : ' rel="uix-pb-prettyPhoto"';
		}
		

		

		$list_portfolio1_item_content .= '
        <div class="uix-pb-portfolio-item" data-groups=\'{rowcsql:}"'.UixPageBuilder::transform_slug( $cat ).'"{rowcsqr:}\'>
            <span class="uix-pb-portfolio-image" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
                <a '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'">
                <img src="'.$thumbnailURL.'" alt="" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
                </a>
            </span>
            <h3><a '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'">'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'</a></h3>
			'.( !empty( $cat ) ? '<div class="uix-pb-portfolio-type">'.$cat.'</div>' : '' ).'
            <div class="uix-pb-portfolio-content">
                '.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_intro]['.$sid.']' ] ).'
				<a class="uix-pb-portfolio-link" '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'"></a>
            </div>
    
        </div>
		';	

		
		
		
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		

		$thumbnailURL       = ( !empty( $uix_pb_portfolio1_listitem_thumbnail ) ) ? $uix_pb_portfolio1_listitem_thumbnail : UixPBFormCore::photo_placeholder();
		$fullimageURL       = ( !empty( $uix_pb_portfolio1_listitem_fullimage ) ) ? $uix_pb_portfolio1_listitem_fullimage : $thumbnailURL;
		$cat                = uix_pb_kses( $uix_pb_portfolio1_listitem_cat );
		
		$targetcode = '';
		if ( !empty( $uix_pb_portfolio1_listitem_toggle_url ) ) {
			$targetcode   = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? ' target="_blank"' : '';
			$fullimageURL = $uix_pb_portfolio1_listitem_toggle_url;
		} else {
			$targetcode = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? ' target="_blank" rel="uix-pb-prettyPhoto"' : ' rel="uix-pb-prettyPhoto"';
		}
		
		
		
		$list_portfolio1_item_content .= '
        <div class="uix-pb-portfolio-item" data-groups=\'{rowcsql:}"'.UixPageBuilder::transform_slug( $cat ).'"{rowcsqr:}\'>
            <span class="uix-pb-portfolio-image" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
                <a '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $uix_pb_portfolio1_listitem_title ).'">
                <img src="'.$thumbnailURL.'" alt="" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
                </a>
            </span>
            <h3><a '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $uix_pb_portfolio1_listitem_title ).'">'.uix_pb_kses( $uix_pb_portfolio1_listitem_title ).'</a></h3>
			'.( !empty( $cat ) ? '<div class="uix-pb-portfolio-type">'.$cat.'</div>' : '' ).'
            <div class="uix-pb-portfolio-content">
                '.uix_pb_kses( $uix_pb_portfolio1_listitem_intro ).'
				<a class="uix-pb-portfolio-link" '.$targetcode.' href="'.$fullimageURL.'" title="'.esc_attr( $uix_pb_portfolio1_listitem_title ).'"></a>
            </div>
    
        </div>
		';	
		
	}
	
}
	

		
//Display categories on page
$catlist = '';
if (  $uix_pb_portfolio1_config_filterable == 1 ) {
   $catlist = '
	<div class="uix-pb-portfolio-cat-list uix-pb-filterable" data-classprefix="uix-pb-portfolio-"  data-filter-id="'.esc_attr( $uniqid_id ).'" id="uix-pb-portfolio-cat-list-'.esc_attr( $uniqid_id ).'">
		<ul>
			<li class="current"><a href="javascript:" data-group="all">'.__( 'All', 'uix-page-builder' ).'</a></li>
			'.UixPageBuilder::cat_list( $list_portfolio1_item_content, 'uix-pb-portfolio-' ).'
		</ul>
	</div><!-- /.uix-pb-portfolio-cat-list -->
   ';  	
}

				
$element_temp = '
{heading}
{desc}
{catlist}
<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col{grid}" id="uix-pb-portfolio-filter-stage-{id}">
	{list_content}
</div><!-- /.uix-pb-portfolio-tiles -->        
';


$uix_pb_section_portfolio1_temp = str_replace( '{catlist}', $catlist,
	                              str_replace( '{list_content}', $list_portfolio1_item_content,
								  str_replace( '{id}', esc_attr( $uniqid_id ),
								  str_replace( '{grid}', esc_attr( $uix_pb_portfolio1_config_grid ),
								 str_replace( '{heading}', ( !empty( $uix_pb_portfolio1_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_portfolio1_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_portfolio1_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_portfolio1_config_intro.'</div>' : '' ),		
											 
					
							     $element_temp 
								 ) ) ) ) ) );



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
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_intro' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_filterable' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_filterable' ),
			'title'          => __( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_filterable,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_portfolio1_config_filterable_chk
				                )
		
		
		),	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_urlwindow' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_urlwindow' ),
			'title'          => __( 'Open link in new tab', 'uix-page-builder' ),
			'desc'           => __( 'This option is valid when you use destination URL.', 'uix-page-builder' ),
			'value'          => $uix_pb_portfolio1_config_urlwindow,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_portfolio1_config_urlwindow_chk
				                )
		
		
		),	
		

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_thumbnail_fillet' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_thumbnail_fillet' ),
			'title'          => __( 'Radius of Fillet Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_thumbnail_fillet,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_grid' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_grid' ),
			'title'          => __( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_grid,
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
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'',
											'type'      => 'image'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'',
											'type'      => 'image'
										), 					
		
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => [ 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
											 ]
										), 			
		

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_thumbnail' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_thumbnail,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', /*class of list item */
				'placeholder'    => __( 'Thumbnail', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_fullimage' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_fullimage,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', /*class of list item */
				'placeholder'    => __( 'Full Preview', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),			
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_cat' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_cat,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_intro' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_intro,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_toggle' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_toggle,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => [ 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
	                                     ]
									)
			
			),	
	
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_toggle_url' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_portfolio1_listitem_toggle_url,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => __( 'Destination URL', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				
		
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_portfolio1_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_portfolio1_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_portfolio1_temp,
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




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )	
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Portfolio Grid', 'uix-page-builder' ) ); ?>            
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
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ]
								),				
				
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_cat]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_intro]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_toggle]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ]
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
			
			    
			var tempcode                                  = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_portfolio1_config_id               = uixpbform_uid(),
				uix_pb_portfolio1_config_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_title' ); ?>' ).val(),
				uix_pb_portfolio1_config_intro            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_intro' ); ?>' ).val(),
				uix_pb_portfolio1_config_filterable_chk   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_filterable' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_portfolio1_config_urlwindow_chk    = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_urlwindow' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_portfolio1_config_thumbnail_fillet = uixpbform_floatval( $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_thumbnail_fillet' ); ?>' ).val() ) + '%',
				uix_pb_portfolio1_config_grid             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_grid' ); ?>' ).val();
	
	
				
			if ( tempcode.length > 0 ) {
		
				
				
				var _config_t          = ( uix_pb_portfolio1_config_title != undefined && uix_pb_portfolio1_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_portfolio1_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc       = ( uix_pb_portfolio1_config_intro != undefined && uix_pb_portfolio1_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_portfolio1_config_intro+'</div>' : '';
;
						
				
				/* List Item */
				var list_num               = <?php echo $clone_max; ?>,
					show_list_item_content = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
						_thumbnail   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ); ?>' ).val(),
						_fullimage   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ); ?>' ).val(),
						_title       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ); ?>' ).val(),
						_cat         = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ); ?>' ).val(),
						_intro       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ); ?>' ).val(),
						_url         = encodeURI( $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ); ?>' ).val() );
					
						
						var _item_v_thumbnailURL  = ( _thumbnail != undefined && _thumbnail != '' ) ? _thumbnail : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
						_item_v_fullimageURL      = ( _fullimage != undefined && _fullimage != '' ) ? _fullimage : _item_v_thumbnailURL,
					    _item_v_catshow           = ( _cat != undefined && _cat != '' ) ? '<div class="uix-pb-portfolio-type">'+_cat+'</div>' : '',
						_item_v_targetcode        = '';
					
						if ( _url != undefined && _url != '' ) {
							_item_v_targetcode   = ( uix_pb_portfolio1_config_urlwindow_chk === true ) ? ' target="_blank"' : '';
							_item_v_fullimageURL = _url;
						} else {
							_item_v_targetcode = ( uix_pb_portfolio1_config_urlwindow_chk === true ) ? ' target="_blank" rel="uix-pb-prettyPhoto"' : 'rel="uix-pb-prettyPhoto"';;
						}
		
					
					
					
					if ( _intro != undefined && _intro != '' ) {
										
						//Do not include spaces
						
						show_list_item_content += '<div class="uix-pb-portfolio-item" data-groups=\'{rowcsql:}"'+uixpbform_strToSlug( _cat )+'"{rowcsqr:}\'>';
						show_list_item_content += '<span class="uix-pb-portfolio-image" style="-webkit-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; -moz-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+';">';
						show_list_item_content += '<a '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'">';
						show_list_item_content += '<img src="'+_item_v_thumbnailURL+'" alt="" style="-webkit-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; -moz-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+';">';
						show_list_item_content += '</a>';
						show_list_item_content += '</span>';
						show_list_item_content += '<h3><a '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'">'+_title+'</a></h3>';
						show_list_item_content += _item_v_catshow;
						show_list_item_content += '<div class="uix-pb-portfolio-content">';
						show_list_item_content += _intro;
						show_list_item_content += '<a class="uix-pb-portfolio-link" '+_item_v_targetcode+' href="'+encodeURI( _item_v_fullimageURL )+'" title="'+uixpbform_htmlEncode( _title )+'"></a>';
						show_list_item_content += '</div>';
						show_list_item_content += '</div>';
	
					}
					
					
				}

                
				//Display categories on page
				var catlist = '';
				if (  uix_pb_portfolio1_config_filterable_chk === true ) {
					catlist += '<div class="uix-pb-portfolio-cat-list uix-pb-filterable" data-classprefix="uix-pb-portfolio-"  data-filter-id="'+uix_pb_portfolio1_config_id+'" id="uix-pb-portfolio-cat-list-'+uix_pb_portfolio1_config_id+'">';
					catlist += '<ul>';
					catlist += '<li class="current"><a href="javascript:" data-group="all"><?php echo __( 'All', 'uix-page-builder' ); ?></a></li>';
					catlist += uixpbform_catlist( show_list_item_content, 'uix-pb-portfolio-' );
					catlist += '</ul>';
					catlist += '</div>';
				
				}
				
				
				//---
				
				tempcode = tempcode.replace(/{list_content}/g, show_list_item_content )
								    .replace(/{heading}/g, _config_t )
				                    .replace(/{catlist}/g, catlist )
				                    .replace(/{id}/g, uix_pb_portfolio1_config_id )
				                    .replace(/{grid}/g, uix_pb_portfolio1_config_grid )
								    .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_portfolio1_temp' ); ?>" ).val( tempcode );
			}
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

