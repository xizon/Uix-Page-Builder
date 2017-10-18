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
$form_type = array(
	'list' => false
);
					


$args = 
	array(

		
		array(
			'id'             => 'uix_pb_authorcard_primary_color',
			'title'          => esc_html__( 'Primary Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),

		array(
			'id'             => 'uix_pb_authorcard_avatar',
			'title'          => esc_html__( 'Author Picture', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Avatar URL', 'uix-page-builder' ),
			'type'           => 'image'
		
		),	
		

		
		array(
			'id'             => 'uix_pb_authorcard_name',
			'title'          => esc_html__( 'Author Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Your Name', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'html', 
		
		),
	
		
		array(
			'id'             => 'uix_pb_authorcard_intro',
			'title'          => esc_html__( 'Biographical Info', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Quae cum praeponunt, ut sit aliqua rerum selectio, naturam videntur sequi; Tu vero, inquam, ducas licet, si sequetur; Ab his oratores, ab his imperatores ac rerum publicarum principes extiterunt. Igitur neque stultorum quisquam beatus neque sapientium non beatus.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
		    'callback'       => 'html', 
			'default'        => array(
									'row'     => 5
								)
		
		),
	

		array(
			'id'             => 'uix_pb_authorcard_link_label',
			'title'          => esc_html__( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '&rarr;', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
		    'callback'       => 'html', 
		
		),		
		array(
			'id'             => 'uix_pb_authorcard_link_link',
			'title'          => esc_html__( 'Link URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text',
		    'callback'       => 'url', 
		
		),		



		array(
			'id'             => 'uix_pb_authorcard_1_url',
			'title'          => esc_html__( 'Social Network 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Your Social Network Page URL 1', 'uix-page-builder' ),
			'type'           => 'text',
		    'callback'       => 'url', 
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_1_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Choose Social Icon 1', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_authorcard_2_url',
			'title'          => esc_html__( 'Social Network 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Your Social Network Page URL 2', 'uix-page-builder' ),
			'type'           => 'text',
		    'callback'       => 'url', 
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_2_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Choose Social Icon 2', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
			
		
		array(
			'id'             => 'uix_pb_authorcard_3_url',
			'title'          => esc_html__( 'Social Network 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Your Social Network Page URL 3', 'uix-page-builder' ),
			'type'           => 'text',
		    'callback'       => 'url', 
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_3_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Choose Social Icon 3', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),	
		



	)
;


/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'        => false,
		'form_id'      => $form_id,
		'fields'       => array(
							array(
								 'type'     => $form_type,
								 'values'   => $args
							),

						),
		'title'        => esc_html__( 'Author Card', 'uix-page-builder' ),

	
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

							

			<div class="uix-pb-authorcard-wrapper">
				<div class="uix-pb-authorcard" style="border-top-color: ${uix_pb_authorcard_primary_color}">
					<div class="uix-pb-authorcard-top">
						<div class="uix-pb-authorcard-text">
							<h3 class="uix-pb-authorcard-title">${uix_pb_authorcard_name}

							{{if uix_pb_authorcard_1_url != "" && uix_pb_authorcard_1_url != "http://%C2%A0"}}
								<a href="${uix_pb_authorcard_1_url}" target="_blank"><i class="fa fa-{{if uix_pb_authorcard_1_icon != ""}}${uix_pb_authorcard_1_icon}{{else}}link{{/if}}	"></i></a>
							{{/if}}		
							{{if uix_pb_authorcard_2_url != "" && uix_pb_authorcard_2_url != "http://%C2%A0"}}
								<a href="${uix_pb_authorcard_2_url}" target="_blank"><i class="fa fa-{{if uix_pb_authorcard_2_icon != ""}}${uix_pb_authorcard_2_icon}{{else}}link{{/if}}	"></i></a>
							{{/if}}	
							{{if uix_pb_authorcard_3_url != "" && uix_pb_authorcard_3_url != "http://%C2%A0"}}
								<a href="${uix_pb_authorcard_3_url}" target="_blank"><i class="fa fa-{{if uix_pb_authorcard_3_icon != ""}}${uix_pb_authorcard_3_icon}{{else}}link{{/if}}	"></i></a>
							{{/if}}	
							</h3>	 
						</div>
						<div class="uix-pb-authorcard-pic">
							{{if uix_pb_authorcard_avatar != ""}}
								<img src="${uix_pb_authorcard_avatar}" alt="">
							{{else}}
								<img src="'.esc_url(  UixPBFormCore::photo_placeholder() ).'" alt="">
							{{/if}}	
						</div>
					</div>
					<div class="uix-pb-authorcard-middle">${uix_pb_authorcard_intro}</div>
					<a class="uix-pb-authorcard-final" href="${uix_pb_authorcard_link_link}" rel="author">${uix_pb_authorcard_link_label}</a>
				</div>
			</div>		
		'
    )
);


