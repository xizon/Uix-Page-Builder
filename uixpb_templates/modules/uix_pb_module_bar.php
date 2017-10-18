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
			'id'             => 'uix_pb_bar_shape',
			'title'          => esc_html__( 'Choose Style', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'circular',
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'circular'  => 'circular',
									'square'  => 'square'
								),
		
			/* Add the "toggle" field to enable the radio switch */
			'toggle'        => array(
			                        array(
										'trigger_id'        => 'circular', /* The value of radio */
										'target_ids'        => array( 'uix_pb_bar_circular_size' ) /* Associated control ID */

									),
			                        array(
										'trigger_id'        => 'square', /* The value of radio */
										'target_ids'        => array( 'uix_pb_bar_square_size' ) /* Associated control ID */

									),
									
				                )	
								
		),
		
			array(
				'id'             => 'uix_pb_bar_circular_size',
				'title'          => esc_html__( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 120,
				'placeholder'    => '',
				'type'           => 'short-text',
		        'callback'       => 'number',
				'default'        => array(
										'units'  => 'px'
									)
			
			),
			
			array(
		    /*
		     * @template vars: 
			 *
				${uix_pb_bar_square_size}
				${uix_pb_bar_square_size_units}
			 *
			*/
				'id'             => 'uix_pb_bar_square_size',
				'title'          => esc_html__( 'Bar Size', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => 100,
				'type'           => 'short-units-text',
		        'callback'       => 'number',
				'default'        => array(
										'units'      => array( '%', 'px' ),
										'units_value' => '%'
									)
			
			),	
			
		
	
		array(
			'id'             => 'uix_pb_bar_percent',
			'title'          => esc_html__( 'Percent', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 75,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'  => '%'
								)
		
		),
	
		
		array(
			'id'             => 'uix_pb_bar_perc_icons_size',
			'title'          => esc_html__( 'Percentage & Icon Size', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 12,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'  => 'px'
								)
		
		),	
		
		array(
			'id'             => 'uix_pb_bar_linewidth',
			'title'          => esc_html__( 'Line Width', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'short-text',
		    'callback'       => 'number',
			'default'        => array(
									'units'  => 'px'
								)
		
		),
		
		
		//------ Toggle of switch with checkbox (begin)
		array(
			'id'             => 'uix_pb_bar_icon_toggle',
			'title'          => esc_html__( 'Icon', 'uix-page-builder' ),
			'desc'           => esc_html__( 'Using Icon instead of percentage.', 'uix-page-builder' ),
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
			'toggle'         => array(
				                    'target_ids'  => array( 'uix_pb_bar_icon' )
				                )
		
		
		),	
		
			array(
				'id'             => 'uix_pb_bar_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'placeholder'    => '',
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),	
		//------ Toggle of switch with checkbox (end)
		
			
		array(
			'id'             => 'uix_pb_bar_color',
			'title'          => esc_html__( 'Bar Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' )
		
		),
		

	
		array(
			'id'             => 'uix_pb_bar_trackcolor',
			'title'          => esc_html__( 'Track color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#f1f1f1',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' )
		
		),
	
		array(
			'id'             => 'uix_pb_bar_percent_icon_color',
			'title'          => esc_html__( 'Percentage & Icon Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#473f3f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#ffffff', '#473f3f',  '#bebebe', '#dcdcdc', '#f1f1f1' )
		
		),
		
	
	    array(
			'id'             => 'uix_pb_bar_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Title', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		),	
		
		
	    array(
			'id'             => 'uix_pb_bar_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'callback'       => 'html',
			'default'        => array(
									'row'     => 2
								)
		),	
		

		array(
			'id'             => 'uix_pb_bar_show_units',
			'title'          => esc_html__( 'Displayed Units', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '%',
			'placeholder'    => '',
			'type'           => 'text',
			'callback'       => 'html',
		
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
		'title'        => esc_html__( 'Progress Bar', 'uix-page-builder' ),
	
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
		
			{{if uix_pb_bar_shape == "square"}}

				<div class="uix-pb-bar-box uix-pb-bar-box-square">
					<div style="width:${uix_pb_bar_square_size}${uix_pb_bar_square_size_units}">
						<div class="uix-pb-bar-info">
							<h3 class="uix-pb-bar-title">${uix_pb_bar_title}</h3>
							<div class="uix-pb-bar-desc">${uix_pb_bar_desc}</div>
						</div>
						<div class="uix-pb-bar" data-percent="${uix_pb_bar_percent}" data-linewidth="${uix_pb_bar_linewidth}" data-trackcolor="${uix_pb_bar_trackcolor}" data-barcolor="${uix_pb_bar_color}" data-units="${uix_pb_bar_show_units}" data-size="${uix_pb_bar_square_size}${uix_pb_bar_square_size_units}" data-icon="${uix_pb_bar_icon}">
							<span class="uix-pb-bar-percent"></span>
							<span class="uix-pb-bar-placeholder">0</span>
							<span class="uix-pb-bar-text"  style="color:${uix_pb_bar_percent_icon_color};font-size:${uix_pb_bar_perc_icons_size}px;">
								{{if uix_pb_bar_icon != ""}}
									<i class="fa fa-${uix_pb_bar_icon}"></i>
								{{else}}
									${uix_pb_bar_percent}${uix_pb_bar_show_units}
								{{/if}}
							</span>
						</div>
					</div>
				</div>


			{{else}}


				<div class="uix-pb-bar-box uix-pb-bar-box-circular">
					<div class="uix-pb-bar" data-percent="${uix_pb_bar_percent}" style="width:${uix_pb_bar_circular_size}px">
						<span class="uix-pb-bar-percent" data-linewidth="${uix_pb_bar_linewidth}" data-trackcolor="${uix_pb_bar_trackcolor}" data-barcolor="${uix_pb_bar_color}" data-units="${uix_pb_bar_show_units}" data-size="${uix_pb_bar_circular_size}px"  data-icon="${uix_pb_bar_icon}" style="color:${uix_pb_bar_percent_icon_color};font-size:${uix_pb_bar_perc_icons_size}px;"></span>
					</div>
					<h3 class="uix-pb-bar-title">${uix_pb_bar_title}</h3>
					<div class="uix-pb-bar-desc">${uix_pb_bar_desc}</div>
				</div>


			{{/if}}

		'
    )
);

