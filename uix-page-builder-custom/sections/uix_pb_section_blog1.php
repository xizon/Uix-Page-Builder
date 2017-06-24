<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( 'uix_pb_section_blog1' );
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
			'id'             => 'uix_pb_blog_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_blog_config_intro' ,
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),

		array(
			'id'             => 'uix_pb_blog_config_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 6,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            '12'  => '1',
									'6'   => '2',
									'4'   => '3',
									
								)
		
		),		
		
		
	
	)
;



$form_type = array(
	'list' => 1
);


//Show All Categories as Links
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
$categories_value = array( 'all' => esc_html__( '- All -', 'uix-shortcodes' ) );


if ( ! empty( $categories ) ) {
	foreach( $categories as $category ) {
		UixPageBuilder::array_push_associative( $categories_value, array( $category->term_id => esc_html( $category->cat_name ) ) );
	}
}


$args = 
	array(
	

	    array(
			'id'             => 'uix_pb_blog_num',
			'title'          => esc_html__( 'Posts Number', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Choose how much posts you would like to display per page.', 'uix-page-builder' ),
			'value'          => 10,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => ''
				                )
		
		),
		
	    array(
			'id'             => 'uix_pb_blog_order',
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
			'id'             => 'uix_pb_blog_cats',
			'title'          => esc_html__( 'Select Category', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Get all posts related to particular category name.', 'uix-page-builder' ),
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => $categories_value

		),


	    array(
			'id'             => 'uix_pb_blog_dateformat',
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
			'id'             => 'uix_pb_blog_excerpt_length',
			'title'          => esc_html__( 'Excerpt Length', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 50,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'words'
								)
		
		),		
		
		
		array(
			'id'             => 'uix_pb_blog_readmore_checkbox_toggle',
			'title'          => esc_html__( 'Read More Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'  => '', /* {option id} */
									'toggle_class'  => array(
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_blog_readmore_text' ).'_class',
		                                ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_blog_readmore_class' ).'_class'
	                                 ),
				                )	
		
		
		),	
		

		
	    array(
			'id'             => 'uix_pb_blog_readmore_text',
			'title'          => esc_html__( 'Read More Text', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Change the “read more” text/link that appears after each block.', 'uix-page-builder' ),
			'value'          => esc_html__( 'Read More', 'uix-page-builder' ),
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_blog_readmore_text' ).'_class', /*class of toggle item */
			'placeholder'    => '',
			'type'           => 'text'
		
		),	

	    array(
			'id'             => 'uix_pb_blog_readmore_class',
			'title'          => esc_html__( 'Class Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'uix-pb-btn uix-pb-btn-small-small uix-pb-btn-black',
		    'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_blog_readmore_class' ).'_class', /*class of toggle item */
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
 
		{uix_pb_blog_attrs_link}             --> Permalink
		{uix_pb_blog_attrs_id}               --> Post ID 
		{uix_pb_blog_attrs_title_attr}       --> Title attribute escaping
		{uix_pb_blog_attrs_title}            --> Title
		{uix_pb_blog_attrs_date_m}           --> Month  
		{uix_pb_blog_attrs_date_M}           --> Month display in English
		{uix_pb_blog_attrs_date_d}           --> Day
		{uix_pb_blog_attrs_date_y}           --> Year
		{uix_pb_blog_attrs_cat_link}         --> Categories for a post (Contains hyperlinks)
		{uix_pb_blog_attrs_cat_text}         --> Categories for a post
		{uix_pb_blog_attrs_excerpt}          --> Excerpt with read more button
		{uix_pb_blog_attrs_thumbnail}        --> Featured image HTML code

 
 */
	
$loop_template_code = '

	<li class="grid-item uix-pb-col-{col}">
		<figure>
			<a data-id="{uix_pb_blog_attrs_id}" title="{uix_pb_blog_attrs_title_attr}" href="{uix_pb_blog_attrs_link}">
				{uix_pb_blog_attrs_thumbnail}
			</a>
			<figcaption>
				<p class="post-date">{date}</p>
				<p class="post-cat">{uix_pb_blog_attrs_cat_link}</p>
				<h3><a data-id="{uix_pb_blog_attrs_id}" title="{uix_pb_blog_attrs_title_attr}" href="{uix_pb_blog_attrs_link}">{uix_pb_blog_attrs_title}</a></h3>
				<div class="post-excerpt">
					{uix_pb_blog_attrs_excerpt} 
				</div>
			</figcaption>
		</figure>
	</li>
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
								 'title'   => esc_html__( 'Content', 'uix-page-builder' )
							),

					),
		'title'        => esc_html__( 'Blog Posts List', 'uix-page-builder' ),
	    'js_template'  => '
		
		
			var _config_t             = ( uix_pb_blog_config_title != undefined && uix_pb_blog_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_blog_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc          = ( uix_pb_blog_config_intro != undefined && uix_pb_blog_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uix_pb_blog_config_intro+\'</div>\' : \'\';


		
		
		    var uix_pb_blog_result_readmore_checkbox_toggle    = 1,
			    uix_pb_blog_result_dateformat                  = 1111,
                before_html                                    = \'<div class="uix-pb-blog-posts-grid uix-pb-blog-posts-grid\'+uix_pb_blog_config_grid+\'"><ul class="uix-pb-row">\',
                after_html                                     = \'</ul></div>\',
				loop_temp                                      = \''.UixPBFormCore::str_compression( $loop_template_code ).'\';
			
			switch ( uix_pb_blog_dateformat ) {
				case \'1\':
					uix_pb_blog_result_dateformat = \'{uix_pb_blog_attrs_date_M} {uix_pb_blog_attrs_date_d}, {uix_pb_blog_attrs_date_y}\';
					break;
				case \'2\':
					uix_pb_blog_result_dateformat = \'{uix_pb_blog_attrs_date_y}-{uix_pb_blog_attrs_date_m}-{uix_pb_blog_attrs_date_d}\';
					break;
				case \'3\':
					uix_pb_blog_result_dateformat = \'{uix_pb_blog_attrs_date_m}/{uix_pb_blog_attrs_date_d}/{uix_pb_blog_attrs_date_y}\';
					break;
				case \'4\':
					uix_pb_blog_result_dateformat = \'{uix_pb_blog_attrs_date_d}/{uix_pb_blog_attrs_date_m}/{uix_pb_blog_attrs_date_y}\';
					break;
					
			}
			
			loop_temp = loop_temp
			             .replace( \'{date}\', uix_pb_blog_result_dateformat )
						 .replace( \'{col}\', uix_pb_blog_config_grid );
			
			
			
			
			if ( uix_pb_blog_readmore_checkbox_toggle === false ) uix_pb_blog_result_readmore_checkbox_toggle = 0;
		
		
			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'[uix_pb_blog excerpt_length=\\\'\'+uixpbform_floatval( uix_pb_blog_excerpt_length )+\'\\\' readmore_enable=\\\'\'+uixpbform_htmlEncode( uix_pb_blog_result_readmore_checkbox_toggle )+\'\\\' readmore_class=\\\'\'+uixpbform_htmlEncode( uix_pb_blog_readmore_class )+\'\\\' readmore_text=\\\'\'+uixpbform_htmlEncode( uix_pb_blog_readmore_text )+\'\\\' order=\\\'\'+uixpbform_htmlEncode( uix_pb_blog_order )+\'\\\' cat=\\\'\'+uixpbform_htmlEncode( uix_pb_blog_cats )+\'\\\' show=\\\'\'+uixpbform_floatval( uix_pb_blog_num )+\'\\\' before=\\\'\'+uixpbform_shortcodeUsableHtmlToAttr( before_html )+\'\\\'  after=\\\'\'+uixpbform_shortcodeUsableHtmlToAttr( after_html )+\'\\\'	]\'+loop_temp+\'[/uix_pb_blog]\';
		
		
		'
    )
);

