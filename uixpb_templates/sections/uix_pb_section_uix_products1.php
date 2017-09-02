<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Require the WP plugin "Uix Products"
 * ----------------------------------------------------
 */
if ( !class_exists( 'UixProducts' ) ) {
    return;
}


/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( basename( __FILE__, '.php' ) );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;

							 

/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type_config = array(
    'list' => 1
);


$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						


$module_config = 
	array(
	
		array(
			'id'             => 'uix_pb_uix_products_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_uix_products_config_intro' ,
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
		array(
			'id'             => 'uix_pb_uix_products_config_display_cats',
			'title'          => esc_html__( 'Display Categories List', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => '', /* {option id} */
									'toggle_class'  => array(
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_config_filterable' ).'_class'
	                                 ),
				                )	
		
		
		),

		array(
			'id'             => 'uix_pb_uix_products_config_filterable',
			'title'          => esc_html__( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_config_filterable' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		array(
			'id'             => 'uix_pb_uix_products_config_urlwindow',
			'title'          => esc_html__( 'Open link in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		

		array(
			'id'             => 'uix_pb_uix_products_config_thumbnail_fillet',
			'title'          => esc_html__( 'Radius of Fillet Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),		
		
		
		array(
			'id'             => 'uix_pb_uix_products_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
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
		
		
	
	)
;



$form_type = array(
	'list' => 1
);


//Show All Categories as Links. In order to get all posts related to particular category name.
$categories = get_categories( array(
    'orderby'  => 'name',
    'order'    => 'ASC',
	'taxonomy' => 'uix_products_category'
) );
$categories_value = array( 'all' => esc_html__( '- All -', 'uix-page-builder' ) );


if ( ! empty( $categories ) ) {
	foreach( $categories as $category ) {
		UixPageBuilder::array_push_associative( $categories_value, array( $category->term_id => esc_html( $category->cat_name ) ) );
	}
}


$args = 
	array(

		
	    array(
			'id'             => 'uix_pb_uix_products_num',
			'title'          => esc_html__( 'Show Number of Products', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 9,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => ''
				                )
		
		),
		
	    array(
			'id'             => 'uix_pb_uix_products_order',
			'title'          => esc_html__( 'Order By', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'DESC'  => 'desc',
									'ASC'  => 'asc',
		                            'rand'  => 'rand'
				                )
		
		),
	
		array(
			'id'             => 'uix_pb_uix_products_cats',
			'title'          => esc_html__( 'Select Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => $categories_value

		),


	    array(
			'id'             => 'uix_pb_uix_products_dateformat',
			'title'          => esc_html__( 'Meta Date Format', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => date( 'F j, Y' ),
									'2'  => date( 'Y-m-d' ),
									'3'  => date( 'm/d/Y' ),
									'4'  => date( 'd/m/Y' ),
				                )
		
		),
		
		
	    array(
			'id'             => 'uix_pb_uix_products_excerpt_length',
			'title'          => esc_html__( 'Excerpt Length', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 35,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'words'
								)
		
		),		
		
		
		array(
			'id'             => 'uix_pb_uix_products_readmore_checkbox_toggle',
			'title'          => esc_html__( 'Read More Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => '', /* {option id} */
									'toggle_class'  => array(
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_readmore_text' ).'_class',
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_readmore_class' ).'_class'
	                                 ),
				                )	
		
		
		),	
		

		
	    array(
			'id'             => 'uix_pb_uix_products_readmore_text',
			'title'          => esc_html__( 'Read More Text', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Change the "read more" text/link that appears after each block.', 'uix-page-builder' ),
			'value'          => esc_html__( 'Read More', 'uix-page-builder' ),
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_readmore_text' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'text'
		
		),	

	    array(
			'id'             => 'uix_pb_uix_products_readmore_class',
			'title'          => esc_html__( 'Class Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'uix-pb-portfolio-link',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_uix_products_readmore_class' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		


	
	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */

/**
 * 
 * Use this template to display content on your website. You can use the following placeholders 
 * in the post list item templates, which will be replaced by the actual values when the content is displayed:
 
		{uix_pb_uix_products_attrs_link}             --> Permalink
		{uix_pb_uix_products_attrs_id}               --> Post ID 
		{uix_pb_uix_products_attrs_title_attr}       --> Title attribute escaping
		{uix_pb_uix_products_attrs_title}            --> Title
		{uix_pb_uix_products_attrs_date_m}           --> Month  
		{uix_pb_uix_products_attrs_date_M}           --> Month display in English
		{uix_pb_uix_products_attrs_date_d}           --> Day
		{uix_pb_uix_products_attrs_date_y}           --> Year
		{uix_pb_uix_products_attrs_cat_link}         --> Categories for a post (Contains hyperlinks)
		{uix_pb_uix_products_attrs_cat_text}         --> Categories for a post
		{uix_pb_uix_products_attrs_cat_attr}         --> Escaping for categories HTML attributes.
		{uix_pb_uix_products_attrs_cat_groupattr}    --> Escaping for categories group HTML attributes. Like this: data-groups='["discovery","featured"]'
		{uix_pb_uix_products_attrs_excerpt}          --> Excerpt with read more button
		{uix_pb_uix_products_attrs_thumbnail}        --> Featured image HTML code
        {uix_pb_uix_products_attrs_thumbnail_url}    --> Featured image URL
		{uix_pb_uix_products_attrs_format}           --> Retrieve the format slug for a post
 
 */


	
$loop_template_code = '
	<div class="uix-pb-portfolio-item" {uix_pb_uix_products_attrs_cat_groupattr}> 
	    <span class="uix-pb-portfolio-image" style="-webkit-border-radius:{avatar_fillet};-moz-border-radius:{avatar_fillet};border-radius:{avatar_fillet};">
			<a {urlwindow} href="{uix_pb_uix_products_attrs_link}" title="{uix_pb_uix_products_attrs_title_attr}">
				<img src="{uix_pb_uix_products_attrs_thumbnail_url}" alt="" style="-webkit-border-radius:{avatar_fillet};-moz-border-radius:{avatar_fillet};border-radius:{avatar_fillet};">
			</a>
		</span>
		<h3><a {urlwindow} href="{uix_pb_uix_products_attrs_link}" title="{uix_pb_uix_products_attrs_title_attr}">{uix_pb_uix_products_attrs_title}</a></h3>
		<div class="uix-pb-portfolio-type">{uix_pb_uix_products_attrs_cat_text}</div>
		<div class="uix-pb-portfolio-content">
		    
		</div>
	</div>
';			
			
UixPageBuilder::form_scripts( array(
	    'clone'        => '',
	    'defalt_value' => $item,
	    'widget_name'  => $wname,
		'form_id'      => $form_id,
		'section_id'   => $sid,
	    'column_id'    => $colid,
		'fields'       => array(
							array(
								 'config'  => $args_config,
								 'type'    => $form_type_config,
								 'values'  => $module_config,
								 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
							),
							array(
								 'config'  => $args_config,
								 'type'    => $form_type,
								 'values'  => $args,
								 'title'   => esc_html__( 'Content Settings', 'uix-page-builder' )
							),

					),
		'title'        => esc_html__( 'Uix Products Grid', 'uix-page-builder' ),
	    'js_template'  => '
		
		
			var _config_id            = uixpbform_uid(),
			    _config_t             = ( uix_pb_uix_products_config_title != undefined && uix_pb_uix_products_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_uix_products_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc          = ( uix_pb_uix_products_config_intro != undefined && uix_pb_uix_products_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uix_pb_uix_products_config_intro+\'</div>\' : \'<div class="uix-pb-section-desc"></div>\',
				_config_urlwindow     = ( uix_pb_uix_products_config_urlwindow === true ) ? \' target="_blank"\' : \'\',
				_config_avatar_fillet = uixpbform_floatval( uix_pb_uix_products_config_thumbnail_fillet ) + \'%\';

		
		
		    var uix_pb_uix_products_result_readmore_checkbox_toggle    = 1,
			    uix_pb_uix_products_result_dateformat                  = \'\',
                before_html                                            = \'<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col\'+uix_pb_uix_products_config_grid+\'" id="uix-pb-portfolio-filter-stage-\'+_config_id+\'">\',
                after_html                                             = \'</div>\',
				show_list_item                                         = \''.UixPBFormCore::str_compression( $loop_template_code ).'\';
			
			switch ( uix_pb_uix_products_dateformat ) {
				case \'1\':
					uix_pb_uix_products_result_dateformat = \'{uix_pb_uix_products_attrs_date_M} {uix_pb_uix_products_attrs_date_d}, {uix_pb_uix_products_attrs_date_y}\';
					break;
				case \'2\':
					uix_pb_uix_products_result_dateformat = \'{uix_pb_uix_products_attrs_date_y}-{uix_pb_uix_products_attrs_date_m}-{uix_pb_uix_products_attrs_date_d}\';
					break;
				case \'3\':
					uix_pb_uix_products_result_dateformat = \'{uix_pb_uix_products_attrs_date_m}/{uix_pb_uix_products_attrs_date_d}/{uix_pb_uix_products_attrs_date_y}\';
					break;
				case \'4\':
					uix_pb_uix_products_result_dateformat = \'{uix_pb_uix_products_attrs_date_d}/{uix_pb_uix_products_attrs_date_m}/{uix_pb_uix_products_attrs_date_y}\';
					break;
					
			}
			
			show_list_item = show_list_item
							 .replace( /{date}/g, uix_pb_uix_products_result_dateformat )
							 .replace( /{col}/g, uix_pb_uix_products_config_grid )
							 .replace( /{urlwindow}/g, _config_urlwindow )
							 .replace( /{avatar_fillet}/g, _config_avatar_fillet );


			
			
			
			if ( uix_pb_uix_products_readmore_checkbox_toggle === false ) uix_pb_uix_products_result_readmore_checkbox_toggle = 0;
		
		
		
			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'[uix_pb_uix_products catslist_enable=\\\'\'+uix_pb_uix_products_config_display_cats+\'\\\' catslist_filterable=\\\'\'+uix_pb_uix_products_config_filterable+\'\\\' catslist_id=\\\'\'+_config_id+\'\\\' catslist_classprefix=\\\'uix-pb-portfolio-\\\' excerpt_length=\\\'\'+uixpbform_floatval( uix_pb_uix_products_excerpt_length )+\'\\\' readmore_enable=\\\'\'+uixpbform_htmlEncode( uix_pb_uix_products_result_readmore_checkbox_toggle )+\'\\\' readmore_class=\\\'\'+uixpbform_htmlEncode( uix_pb_uix_products_readmore_class )+\'\\\' readmore_text=\\\'\'+uixpbform_htmlEncode( uix_pb_uix_products_readmore_text )+\'\\\' order=\\\'\'+uixpbform_htmlEncode( uix_pb_uix_products_order )+\'\\\' cat=\\\'\'+uixpbform_htmlEncode( uix_pb_uix_products_cats )+\'\\\' show=\\\'\'+uixpbform_floatval( uix_pb_uix_products_num )+\'\\\' before=\\\'\'+uixpbform_shortcodeUsableHtmlToAttr( before_html )+\'\\\'  after=\\\'\'+uixpbform_shortcodeUsableHtmlToAttr( after_html )+\'\\\']\'+show_list_item+\'[/uix_pb_uix_products]\';
		
		
		'
    )
);

