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
			'id'             => 'uix_pb_pricing_col3_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
	
		
		array(
			'id'             => 'uix_pb_pricing_col3_config_intro',
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
    'list' => 3
);


$args_1 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing_col3_one_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'free', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_one_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 49,
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'number',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_one_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col3_one_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_one_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_one_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_one_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'TRY FOR FREE', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col3_one_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text',
			'callback'       => 'url',
		
		),	
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_pricing_col3_one_btn_color}
				${uix_pb_pricing_col3_one_btn_color_name}
			 *
			*/
			'id'             => 'uix_pb_pricing_col3_one_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
	     	'callback'       => 'color-name',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col3_one_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_one_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPBFormCore::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
		    'callback'       => 'list',
			'default'        => array(
									'row'  => 5
									
				                )
		
		),	
		
	    array(
			'id'             => 'uix_pb_pricing_col3_one_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		
		array(
			'id'             => 'uix_pb_pricing_col3_one_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	)
;


$args_2 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing_col3_two_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'premium', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_two_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 69,
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'number',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_two_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col3_two_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_two_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_two_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_two_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col3_two_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text',
			'callback'       => 'url',
		
		),	
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_pricing_col3_two_btn_color}
				${uix_pb_pricing_col3_two_btn_color_name}
			 *
			*/
			'id'             => 'uix_pb_pricing_col3_two_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
	     	'callback'       => 'color-name',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col3_two_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_two_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPBFormCore::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'list',
			'default'        => array(
									'row' => 5
									
				                )
		
		),	
		
	    array(
			'id'             => 'uix_pb_pricing_col3_two_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		array(
			'id'             => 'uix_pb_pricing_col3_two_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	)
;


$args_3 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing_col3_three_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'professional', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_three_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 109,
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'number',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_three_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing_col3_three_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),
		array(
			'id'             => 'uix_pb_pricing_col3_three_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_three_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_three_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
		),		
		array(
			'id'             => 'uix_pb_pricing_col3_three_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text',
			'callback'       => 'url',
		
		),	
		array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_pricing_col3_three_btn_color}
				${uix_pb_pricing_col3_three_btn_color_name}
			 *
			*/
			'id'             => 'uix_pb_pricing_col3_three_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
	     	'callback'       => 'color-name',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing_col3_three_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing_col3_three_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPBFormCore::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'list',
			'default'        => array(
									'row'  => 5
									
				                )
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_pricing_col3_three_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		array(
			'id'             => 'uix_pb_pricing_col3_three_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),
		

	
	)
;




/**
 * Returns form
 * ----------------------------------------------------
 */
UixPBFormCore::form_scripts( array(
	    'clone'                   => false,
		'form_id'                 => $form_id,
		'fields'                  => array(
										array(
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type,
											 'values'  => $args_1,
											 'title'   => esc_html__( 'Table 1', 'uix-page-builder' )
										),
	
										array(
											 'type'    => $form_type,
											 'values'  => $args_2,
											 'title'   => esc_html__( 'Table 2', 'uix-page-builder' )
										),
										array(
											 'type'    => $form_type,
											 'values'  => $args_3,
											 'title'   => esc_html__( 'Table 3', 'uix-page-builder' )
										),
	

									),
		'title'                   => esc_html__( 'Pricing Table (3 column)', 'uix-page-builder' ),
	
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
		
			{{if uix_pb_pricing_col3_config_title != ""}}
				<h2 class="uix-pb-section-heading">${uix_pb_pricing_col3_config_title}</h2><div class="uix-pb-section-hr"></div>		
			{{/if}}			


			{{if uix_pb_pricing_col3_config_intro != ""}}
				<div class="uix-pb-section-desc">${uix_pb_pricing_col3_config_intro}</div>		
			{{/if}}	

			<div class="uix-pb-price">
				<div class="uix-pb-row">

					<!-- ////// one  ////// -->
					<div class="uix-pb-col-4 uix-pb-price-border-hover" data-bcolor="${uix_pb_pricing_col3_one_btn_color}" data-tcolor="${uix_pb_pricing_col3_one_emphasis_color}">
						<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
							<div class="uix-pb-price-border {{if uix_pb_pricing_col3_one_active == 1}}uix-pb-price-important{{/if}}">
								<h5 class="uix-pb-price-level">${uix_pb_pricing_col3_one_title}</h5>
								<h2 class="uix-pb-price-num" style="color:${uix_pb_pricing_col3_one_emphasis_color}">
									<span class="uix-pb-price-currency">${uix_pb_pricing_col3_one_currency}</span>
									<span class="uix-pb-price-num-text">${uix_pb_pricing_col3_one_price}</span>
									<span class="uix-pb-price-period">${uix_pb_pricing_col3_one_period}</span>
								</h2>
								<div class="uix-pb-price-excerpt">
									<p>${uix_pb_pricing_col3_one_desc}</p>
								</div> 
								<a href="${uix_pb_pricing_col3_one_btn_link}" {{if uix_pb_pricing_col3_one_btn_win == 1}}target="_blank"{{/if}} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-${uix_pb_pricing_col3_one_btn_color_name}">${uix_pb_pricing_col3_one_btn_label}</a>
								<div class="uix-pb-price-hr"></div>
								<div class="uix-pb-price-detail">
									<ul>
										${uix_pb_pricing_col3_one_features}
									</ul>
								</div>
							</div>
						</div>
					</div>

					<!-- ////// two  ////// -->
					<div class="uix-pb-col-4 uix-pb-price-border-hover" data-bcolor="${uix_pb_pricing_col3_two_btn_color}" data-tcolor="${uix_pb_pricing_col3_two_emphasis_color}">
						<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
							<div class="uix-pb-price-border {{if uix_pb_pricing_col3_two_active == 1}}uix-pb-price-important{{/if}}">
								<h5 class="uix-pb-price-level">${uix_pb_pricing_col3_two_title}</h5>
								<h2 class="uix-pb-price-num" style="color:${uix_pb_pricing_col3_two_emphasis_color}">
									<span class="uix-pb-price-currency">${uix_pb_pricing_col3_two_currency}</span>
									<span class="uix-pb-price-num-text">${uix_pb_pricing_col3_two_price}</span>
									<span class="uix-pb-price-period">${uix_pb_pricing_col3_two_period}</span>
								</h2>
								<div class="uix-pb-price-excerpt">
									<p>${uix_pb_pricing_col3_two_desc}</p>
								</div> 
								<a href="${uix_pb_pricing_col3_two_btn_link}" {{if uix_pb_pricing_col3_two_btn_win == 1}}target="_blank"{{/if}} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-${uix_pb_pricing_col3_two_btn_color_name}">${uix_pb_pricing_col3_two_btn_label}</a>
								<div class="uix-pb-price-hr"></div>
								<div class="uix-pb-price-detail">
									<ul>
										${uix_pb_pricing_col3_two_features}
									</ul>
								</div>
							</div>
						</div>
					</div>


					<!-- ////// three  ////// -->
					<div class="uix-pb-col-4 uix-pb-col-last uix-pb-price-border-hover" data-bcolor="${uix_pb_pricing_col3_three_btn_color}" data-tcolor="${uix_pb_pricing_col3_three_emphasis_color}">
						<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
							<div class="uix-pb-price-border {{if uix_pb_pricing_col3_three_active == 1}}uix-pb-price-important{{/if}}">
								<h5 class="uix-pb-price-level">${uix_pb_pricing_col3_three_title}</h5>
								<h2 class="uix-pb-price-num" style="color:${uix_pb_pricing_col3_three_emphasis_color}">
									<span class="uix-pb-price-currency">${uix_pb_pricing_col3_three_currency}</span>
									<span class="uix-pb-price-num-text">${uix_pb_pricing_col3_three_price}</span>
									<span class="uix-pb-price-period">${uix_pb_pricing_col3_three_period}</span>
								</h2>
								<div class="uix-pb-price-excerpt">
									<p>${uix_pb_pricing_col3_three_desc}</p>
								</div> 
								<a href="${uix_pb_pricing_col3_three_btn_link}" {{if uix_pb_pricing_col3_three_btn_win == 1}}target="_blank"{{/if}} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-${uix_pb_pricing_col3_three_btn_color_name}">${uix_pb_pricing_col3_three_btn_label}</a>
								<div class="uix-pb-price-hr"></div>
								<div class="uix-pb-price-detail">
									<ul>
										${uix_pb_pricing_col3_three_features}
									</ul>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /.uix-pb-row -->
			</div>
			<!-- /.uix-pb-price-->

		
		'
    )
);
