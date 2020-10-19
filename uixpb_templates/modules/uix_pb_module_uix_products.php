<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

/**
 * Note: 
 *
 * Please refer to sample:  uix_pb_module_sample_hello.php
 * 						    uix_pb_module_sample_hello2.php
 *
 * 1) For all ID attribute, special characters are only allowed underscores "_"
 * 2) Optional params of field "callback":  html, attr, slug, url, number, number-deg_px, color-name, list
 * 3) String of clone trigger ID, must contain at least "_triggerclonelist"
 * 4) String of clone ID attribute must contain at least "_listitem"
 * 5) If multiple columns are used to clone event and there are multiple clone triggers, 
      the triggers ID and clone controls ID must contain the string "_one_", "_two", "_three_" or "_four_" for per column
*/

/**
 * Returns current module(form group) ID
 * ----------------------------------------------------
 */
$form_id = basename( __FILE__, '.php' );


/**
 * Form Type & Controls
 * ----------------------------------------------------
 */
$form_type_config = array(
    'list' => 1
);

$module_config = 
	array(
	
		array(
			'id'             => 'uix_pb_uix_products_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'html', 
		
		),
	
		
		array(
			'id'             => 'uix_pb_uix_products_config_intro' ,
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
		    'callback'       => 'html', 
			'default'        => array(
									'row'     => 3
								)
		
		),
		
		
		//------ Toggle of switch with checkbox (begin)
		array(
			'id'             => 'uix_pb_uix_products_config_display_cats',
			'title'          => esc_html__( 'Display Categories List', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'        => array(
									'target_ids'    => array( 'uix_pb_uix_products_config_filterable' )
				                )	
		
		
		),

		array(
			'id'             => 'uix_pb_uix_products_config_filterable',
			'title'          => esc_html__( 'Filterable by Category', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'


		),	

	
		array(
			'id'             => 'uix_pb_uix_products_config_layout',
			'title'          => esc_html__( 'Layout', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'standard',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'standard'  => esc_html__( 'Standard', 'uix-page-builder' ),
									'masonry'  => esc_html__( 'Masonry', 'uix-page-builder' ),
								)
		
		
		),	
	
	
	
	
		//------ Toggle of switch with checkbox (end)
		
		
		
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
		    'callback'       => 'number', 
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




$args = 
	array(

		
		
		array(
			'id'             => 'uix_pb_uix_products_pagination',
			'title'          => esc_html__( 'Display Pagination', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		),	
		
		
	    array(
			'id'             => 'uix_pb_uix_products_num',
			'title'          => esc_html__( 'Show Number of Products', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 9,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number', 
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
			'value'          => 'all',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => UixPageBuilder::get_frontend_uix_products_cats()

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
		    'callback'       => 'number', 
			'default'        => array(
									'units'  => 'words'
								)
		
		),		
		
		//------ Toggle of switch with checkbox (begin)
		array(
			'id'             => 'uix_pb_uix_products_readmore_checkbox_toggle',
			'title'          => esc_html__( 'Read More Button', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'         => array(
									'target_ids'    => array( 'uix_pb_uix_products_readmore_text', 'uix_pb_uix_products_readmore_class' )
				                )	
		
		
		),	

			array(
				/*
				 * @template vars: 
				 *
					${uix_pb_uix_products_readmore_text}
					${uix_pb_uix_products_readmore_text_attr}
				 *
				*/
				'id'             => 'uix_pb_uix_products_readmore_text',
				'title'          => esc_html__( 'Read More Text', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => esc_html__( 'Read More', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
		        'callback'       => 'attr',

			),	


			array(
				'id'             => 'uix_pb_uix_products_readmore_class',
				'title'          => esc_html__( 'Class Name', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 'uix-pb-portfolio-link',
				'placeholder'    => '',
				'type'           => 'text',
		        'callback'       => 'html', 

			),	
		//------ Toggle of switch with checkbox (end)
		

		
	    array(
			'id'             => 'uix_pb_uix_products_manage_tipinfo',
			'desc'           => wp_kses( sprintf( __( '<a href="%1$s" target="_blank">Manage Your Content of Uix Products</a>', 'uix-page-builder' ), esc_url( admin_url( 'edit.php?post_type=uix_products' ) ) ), wp_kses_allowed_html( 'post' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	

	
	)
;


/**
 * Returns form
 * ----------------------------------------------------
 */

/**
 * 
 * Returns the unique ID used in the frontend template
 */
$frontend_id = uniqid();



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
		{uix_pb_uix_products_attrs_cat_groupattr}    --> Escaping for categories group HTML attributes. Like this: data-groups-name="discovery,featured"
		{uix_pb_uix_products_attrs_excerpt}          --> Excerpt with read more button
		{uix_pb_uix_products_attrs_thumbnail}        --> Featured image HTML code
        {uix_pb_uix_products_attrs_thumbnail_url}    --> Featured image URL
 
 */


	
$loop_template_code = '
	<div class="uix-pb-portfolio-item" {uix_pb_uix_products_attrs_cat_groupattr}> 
	    <span class="uix-pb-portfolio-image" style="-webkit-border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;-moz-border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;">
			<a {{if uix_pb_uix_products_config_urlwindow == 1}}target="_blank"{{/if}} href="{uix_pb_uix_products_attrs_link}" title="{uix_pb_uix_products_attrs_title_attr}">
				<img src="{uix_pb_uix_products_attrs_thumbnail_url}" alt="" style="-webkit-border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;-moz-border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;border-radius:${uix_pb_uix_products_config_thumbnail_fillet}%;">
			</a>
		</span>
		<h3><a {{if uix_pb_uix_products_config_urlwindow == 1}}target="_blank"{{/if}} href="{uix_pb_uix_products_attrs_link}" title="{uix_pb_uix_products_attrs_title_attr}">{uix_pb_uix_products_attrs_title}</a></h3>
		<div class="uix-pb-portfolio-type">{uix_pb_uix_products_attrs_cat_text}</div>
		<div class="uix-pb-portfolio-content">
		    
		</div>
	</div>
';			
		
$loop_template_code = UixPBFormCore::str_compression( $loop_template_code );



UixPBFormCore::form_scripts( array(
	    'clone'        => false,
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'    => $form_type_config,
								 'values'  => $module_config,
								 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
							),
							array(
								 'type'    => $form_type,
								 'values'  => $args,
								 'title'   => esc_html__( 'Content Settings', 'uix-page-builder' )
							),

					),
		'title'        => esc_html__( 'Uix Products Grid', 'uix-page-builder' ),
	
		/**
		 * /////////////// Customizing HTML output on the frontend /////////////// 
		 * 
		 * 
		 * Usage:
		 *
		 * 1) Written as pure HTML syntax.
		 * 2) Directly use the controls ID as a variable: ${???}
		 * 3) Using {{if}} and {{else}} to render conditional sections. 
		       -----E.g.
		       {{if your_field_id}} ... {{else}} ... {{/if}}
			   
		 * 4) Using {{each}} to render repeating sections.
		       -----E.g.
				{{each your_clone_trigger_id}}
					{{if your_listitem_field_id != ""}}
					    {{if $index == 0}}<li class="active">{{else}}<li>{{/if}}
						    ${your_listitem_field_id}
						</li>
					{{/if}}	
				{{/each}}
		 
		 */
	    'template'              => '
		
			{{if uix_pb_uix_products_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_uix_products_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_uix_products_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_uix_products_config_intro}</div>		
			{{/if}}	
			
			
			[uix_pb_uix_products catslist_enable=\'${uix_pb_uix_products_config_display_cats}\' catslist_filterable=\'${uix_pb_uix_products_config_filterable}\' catslist_id=\''.$frontend_id.'\' catslist_classprefix=\'uix-pb-portfolio-\' pagination=\'${uix_pb_uix_products_pagination}\' excerpt_length=\'${uix_pb_uix_products_excerpt_length}\' readmore_enable=\'${uix_pb_uix_products_readmore_checkbox_toggle}\'  readmore_class=\'${uix_pb_uix_products_readmore_class}\' readmore_text=\'${uix_pb_uix_products_readmore_text_attr}\' order=\'${uix_pb_uix_products_order}\'  cat=\'${uix_pb_uix_products_cats}\' show=\'${uix_pb_uix_products_num}\' before=\'<div class="uix-pb-portfolio-wrapper" data-show-type="${uix_pb_uix_products_config_layout}{{if uix_pb_uix_products_config_filterable == 1}}|filter{{/if}}" data-filter-id="{{if uix_pb_uix_products_config_filterable == 1}}#nav-filters-uix-pb-portfolio-cat-list-'.$frontend_id.'{{/if}}"><div class="uix-pb-portfolio-tiles uix-pb-portfolio-col${uix_pb_uix_products_config_grid}">\' after=\'</div></div>\']'.$loop_template_code.'[/uix_pb_uix_products]
			
		
		'

	
    )
);

