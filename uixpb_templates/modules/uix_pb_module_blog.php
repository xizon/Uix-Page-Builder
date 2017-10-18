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
			'id'             => 'uix_pb_blog_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'html', 
		
		),
	
		
		array(
			'id'             => 'uix_pb_blog_config_intro' ,
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

		
	
	)
;



$form_type = array(
	'list' => 1
);



$args = 
	array(
	

		array(
			'id'             => 'uix_pb_blog_loop_layout',
			'title'          => esc_html__( 'Loop Posts Layout', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => esc_html__( 'With this plugin', 'uix-page-builder' ),
									'2'  => esc_html__( 'With your current theme ( The "Column" setting will be invalid )', 'uix-page-builder' ),
				                ),
		
		
		),	
		
		
		array(
			'id'             => 'uix_pb_blog_pagination',
			'title'          => esc_html__( 'Display Pagination', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		),	
		
	    array(
			'id'             => 'uix_pb_blog_num',
			'title'          => esc_html__( 'Show Number of Posts', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 10,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number', 
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
			'desc'           => '',
			'value'          => 'all',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => UixPageBuilder::get_frontend_post_cats()

		),


	    array(
			'id'             => 'uix_pb_blog_dateformat',
			'title'          => esc_html__( 'Meta Date Format', 'uix-page-builder' ),
			'desc'           => esc_html__( 'It is not valid when using the Loop Posts Layout with your current theme.', 'uix-page-builder' ),
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
			'desc'           => esc_html__( 'It is not valid when using the Loop Posts Layout with your current theme.', 'uix-page-builder' ),
			'value'          => 35,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number', 
			'default'        => array(
									'units'  => 'words'
								)
		
		),		
		
		
		array(
			'id'             => 'uix_pb_blog_grid',
			'title'          => esc_html__( 'Column', 'uix-page-builder' ),
			'desc'           => esc_html__( 'It is not valid when using the Loop Posts Layout with your current theme.', 'uix-page-builder' ),
			'value'          => 6,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
		                            '12'  => '1',
									'6'   => '2',
									'4'   => '3',
									
								)
		
		),		
		
		
		//------ Toggle of switch with checkbox (begin)
		array(
			'id'             => 'uix_pb_blog_readmore_checkbox_toggle',
			'title'          => esc_html__( 'Read More Button', 'uix-page-builder' ),
			'desc'           => esc_html__( 'It is not valid when using the Loop Posts Layout with your current theme.', 'uix-page-builder' ),
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'        => array(
									'target_ids'  => array( 'uix_pb_blog_readmore_text', 'uix_pb_blog_readmore_class' )
				                )	
		
		
		),	
		

		
			array(
				/*
				 * @template vars: 
				 *
					${uix_pb_blog_readmore_text}
					${uix_pb_blog_readmore_text_attr}
				 *
				*/
				'id'             => 'uix_pb_blog_readmore_text',
				'title'          => esc_html__( 'Read More Text', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => esc_html__( 'Read More', 'uix-page-builder' ),
				'placeholder'    => '',
				'type'           => 'text',
		        'callback'       => 'attr', 

			),	

			array(
				'id'             => 'uix_pb_blog_readmore_class',
				'title'          => esc_html__( 'Class Name', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 'uix-pb-btn uix-pb-btn-small-small uix-pb-btn-black',
				'placeholder'    => '',
				'type'           => 'text',
		        'callback'       => 'html', 

			),		
		
		//------ Toggle of switch with checkbox (end)
		
		
	    array(
			'id'             => 'uix_pb_blog_manage_tipinfo',
			'desc'           => wp_kses( sprintf( __( '<a href="%1$s" target="_blank">Manage Your Content of Posts</a>', 'uix-page-builder' ), esc_url( admin_url( 'edit.php' ) ) ), wp_kses_allowed_html( 'post' ) ),
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
		{uix_pb_blog_attrs_cat_attr}         --> Escaping for categories HTML attributes.
		{uix_pb_blog_attrs_cat_groupattr}    --> Escaping for categories group HTML attributes.  Like this: data-groups-name="discovery,featured"
		{uix_pb_blog_attrs_excerpt}          --> Excerpt with read more button
		{uix_pb_blog_attrs_thumbnail}        --> Featured image HTML code
		{uix_pb_blog_attrs_thumbnail_url}    --> Featured image URL
		{uix_pb_blog_attrs_format}           --> Retrieve the format slug for a post
		

 
 */
	
$loop_template_code = '

	<li class="grid-item uix-pb-col-${uix_pb_blog_grid}" {uix_pb_blog_attrs_cat_groupattr}>
		<figure>
			<a data-id="{uix_pb_blog_attrs_id}" title="{uix_pb_blog_attrs_title_attr}" href="{uix_pb_blog_attrs_link}">
				{uix_pb_blog_attrs_thumbnail}
			</a>
			<figcaption>
				<p class="post-date">
					{{if uix_pb_blog_dateformat == 1}}{uix_pb_blog_attrs_date_M} {uix_pb_blog_attrs_date_d}, {uix_pb_blog_attrs_date_y}{{/if}}
					{{if uix_pb_blog_dateformat == 2}}{uix_pb_blog_attrs_date_y}-{uix_pb_blog_attrs_date_m}-{uix_pb_blog_attrs_date_d}{{/if}}
					{{if uix_pb_blog_dateformat == 3}}{uix_pb_blog_attrs_date_m}/{uix_pb_blog_attrs_date_d}/{uix_pb_blog_attrs_date_y}{{/if}}
					{{if uix_pb_blog_dateformat == 4}}{uix_pb_blog_attrs_date_d}/{uix_pb_blog_attrs_date_m}/{uix_pb_blog_attrs_date_y}{{/if}}
				</p>
				<p class="post-cat">{uix_pb_blog_attrs_cat_link}</p>
				<h3><a data-id="{uix_pb_blog_attrs_id}" title="{uix_pb_blog_attrs_title_attr}" href="{uix_pb_blog_attrs_link}">{uix_pb_blog_attrs_title}</a></h3>
				<div class="post-excerpt">
					{uix_pb_blog_attrs_excerpt} 
				</div>
			</figcaption>
		</figure>
	</li>
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
		'title'        => esc_html__( 'WP Posts List', 'uix-page-builder' ),
	
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
		
			{{if uix_pb_blog_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_blog_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_blog_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_blog_config_intro}</div>		
			{{/if}}	
			
			[uix_pb_blog pagination=\'${uix_pb_blog_pagination}\' loop_layout=\'${uix_pb_blog_loop_layout}\'  excerpt_length=\'${uix_pb_blog_excerpt_length}\' readmore_enable=\'${uix_pb_blog_readmore_checkbox_toggle}\' readmore_class=\'${uix_pb_blog_readmore_class}\' readmore_text=\'${uix_pb_blog_readmore_text_attr}\' order=\'${uix_pb_blog_order}\' cat=\'${uix_pb_blog_cats}\' show=\'${uix_pb_blog_num}\' before=\'<div class="uix-pb-blog-posts-grid uix-pb-blog-posts-grid${uix_pb_blog_grid}"><ul class="uix-pb-row">\'  after=\'</ul></div>\']'.$loop_template_code.'[/uix_pb_blog]
			
		
		'

    )
);

