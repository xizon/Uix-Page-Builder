<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( 'uix_pb_section_authorcard' );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;




/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = array(
	'list' => false
);


$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
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
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => esc_html__( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => esc_html__( 'Upload', 'uix-page-builder' ),
								)
		
		),	
		

		
		array(
			'id'             => 'uix_pb_authorcard_name',
			'title'          => esc_html__( 'Author Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Your Name', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_authorcard_intro',
			'title'          => esc_html__( 'Biographical Info', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Quae cum praeponunt, ut sit aliqua rerum selectio, naturam videntur sequi; Tu vero, inquam, ducas licet, si sequetur; Ab his oratores, ab his imperatores ac rerum publicarum principes extiterunt. Igitur neque stultorum quisquam beatus neque sapientium non beatus.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	

		array(
			'id'             => 'uix_pb_authorcard_link_label',
			'title'          => esc_html__( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '&rarr;', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_authorcard_link_link',
			'title'          => esc_html__( 'Link URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),		



		array(
			'id'             => 'uix_pb_authorcard_1_url',
			'title'          => esc_html__( 'Social Network 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => esc_html__( 'Your Social Network Page URL 1', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
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
			'default'        => ''
		
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
			'default'        => ''
		
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

	


	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
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
								 'type'    => $form_type,
								 'values'  => $args
							),

						),
		'title'        => esc_html__( 'Author Card', 'uix-page-builder' ),
	    'js_template'  => '
			var avatarURL    = ( uix_pb_authorcard_avatar != undefined && uix_pb_authorcard_avatar != \'\' ) ? encodeURI( uix_pb_authorcard_avatar ) : \''.esc_url(  UixPBFormCore::photo_placeholder() ).'\',
				uix_pb_authorcard_1_icon_cur     = ( uix_pb_authorcard_1_icon == undefined || uix_pb_authorcard_1_icon == \'\' ) ? \'link\' : uix_pb_authorcard_1_icon,
				uix_pb_authorcard_2_icon_cur     = ( uix_pb_authorcard_2_icon == undefined || uix_pb_authorcard_2_icon == \'\' ) ? \'link\' : uix_pb_authorcard_2_icon,
				uix_pb_authorcard_3_icon_cur     = ( uix_pb_authorcard_3_icon == undefined || uix_pb_authorcard_3_icon == \'\' ) ? \'link\' : uix_pb_authorcard_3_icon,	
				social_out_1 = ( uix_pb_authorcard_1_url != undefined && uix_pb_authorcard_1_url != \'\' ) ? \'<a href="\'+encodeURI( uix_pb_authorcard_1_url )+\'" target="_blank"><i class="fa fa-\'+uix_pb_authorcard_1_icon_cur+\'"></i></a>\' : \'\',
				social_out_2 = ( uix_pb_authorcard_2_url != undefined && uix_pb_authorcard_2_url != \'\' ) ? \'<a href="\'+encodeURI( uix_pb_authorcard_2_url )+\'" target="_blank"><i class="fa fa-\'+uix_pb_authorcard_2_icon_cur+\'"></i></a>\' : \'\',
				social_out_3 = ( uix_pb_authorcard_3_url != undefined && uix_pb_authorcard_3_url != \'\' ) ? \'<a href="\'+encodeURI( uix_pb_authorcard_3_url )+\'" target="_blank"><i class="fa fa-\'+uix_pb_authorcard_3_icon_cur+\'"></i></a>\' : \'\';


			var temp = \'\';
				temp += \'<div class="uix-pb-authorcard-wrapper">\';
				temp += \'<div class="uix-pb-authorcard" style="border-top-color: \'+uixpbform_htmlEncode(uix_pb_authorcard_primary_color)+\';">\';
				temp += \'<div class="uix-pb-authorcard-top">\';
				temp += \'<div class="uix-pb-authorcard-text">\';
				temp += \'<h3 class="uix-pb-authorcard-title">\'+uix_pb_authorcard_name+\'\';
				temp += social_out_1;
				temp += social_out_2;
				temp += social_out_3;
				temp += \'</h3>\';	 
				temp += \'</div>\';
				temp += \'<div class="uix-pb-authorcard-pic"><img src="\'+avatarURL+\'" alt="\'+uixpbform_htmlEncode(uix_pb_authorcard_name)+\'"></div>\';
				temp += \'</div>\';
				temp += \'<div class="uix-pb-authorcard-middle">\'+uix_pb_authorcard_intro+\'</div>\';
				temp += \'<a class="uix-pb-authorcard-final" href="\'+encodeURI(uix_pb_authorcard_link_link)+\'" rel="author">\'+uix_pb_authorcard_link_label+\'</a>\';
				temp += \'</div>\';
				temp += \'</div>\';		
		'
    )
);


