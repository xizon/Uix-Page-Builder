<?php
/**
 * Form ID
 */
$form_id = 'uix_pb_section_authorcard';

/**
 * Form Type
 */
$form_type = [
    'list' => false
];



$args = 
	[
	
		array(
			'id'             => 'uix_pb_authorcard_primary_color',
			'title'          => __( 'Primary Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),

		array(
			'id'             => 'uix_pb_authorcard_avatar',
			'title'          => __( 'Author Picture', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => ( $item && is_array( $item ) ) ? $item[ 'uix_pb_authorcard_avatar' ] : '',
			'placeholder'    => __( 'Avatar URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
				                )
		
		),	
		

		
		array(
			'id'             => 'uix_pb_authorcard_name',
			'title'          => __( 'Author Name', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => ( $item && is_array( $item ) ) ? $item[ 'uix_pb_authorcard_name' ] : '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_authorcard_intro',
			'title'          => __( 'Biographical Info', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	

		array(
			'id'             => 'uix_pb_authorcard_link_label',
			'title'          => __( 'Link Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( '&rarr;', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_authorcard_link_link',
			'title'          => __( 'Link URL', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#',
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),		



		array(
			'id'             => 'uix_pb_authorcard_1_url',
			'title'          => __( 'Social Network 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 1', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_1_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 1', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_authorcard_2_url',
			'title'          => __( 'Social Network 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 2', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_2_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 2', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),
			
		
		array(
			'id'             => 'uix_pb_authorcard_3_url',
			'title'          => __( 'Social Network 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Your Social Network Page URL 3', 'uix-page-builder' ),
			'type'           => 'text',
			'default'        => ''
		
		),
		
		array(
			'id'             => 'uix_pb_authorcard_3_icon',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Social Icon 3', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => true
								)
		
		),		


	
	]
;

$form_html = UixFormCore::add_form( $form_id, $form_type, $args, 'html' );
$form_js = UixFormCore::add_form( $form_id, $form_type, $args, 'js' );
$form_js_vars = UixFormCore::add_form( $form_id, $form_type, $args, 'js_vars' );

/**
 * Add simulation buttons
 */
if( get_post_type() == 'page' ) {
	if ( is_admin()) {
		echo UixFormCore::add_form( $form_id, '', '', 'active_btn' );
		?>
		<script type="text/javascript">
        ( function($) {
		'use strict';
            $( document ).ready( function() {  
                <?php echo UixFormCore::uixform_callback( $form_js, $form_html, $form_js_vars, $form_id, __( 'Insert An Author Card', 'uix-page-builder' ) ); ?>            
            } ); 
        } ) ( jQuery );
        </script>
 
        <?php
	}
}

?>		
