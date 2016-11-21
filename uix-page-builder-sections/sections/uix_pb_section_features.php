<?php
/**
 * Form ID
 */
$form_id = 'uix_pb_section_features';

/**
 * Form Type
 */
$form_type = [
    'list' => 2
];


$args_1 = 
	[
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => 'uix_pb_features_col2_one_list',
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_content_js_var'      => 'dynamic_append_box_content_left',
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_title',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_titlecolor',
											'type'      => 'colormap'
										), 		
									
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_desc',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_desccolor',
											'type'      => 'colormap'
										), 		
										 
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_icon',
											'type'      => 'icon'
										), 	
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_one_listitem_iconcolor',
											'type'      => 'colormap'
										), 										
																			

									 ],
									'max'                       => 30
				                )
									
		),
		
		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_title', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_titlecolor',
				'title'          => '',
				'desc'           => __( 'Title Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_titlecolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)

			
			),	
		
			
			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_desc', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_desccolor',
				'title'          => '',
				'desc'           => __( 'Description Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_desccolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	
		
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_icon', /*class of list item */
				'placeholder'    => __( 'Choose Feature Icon', 'uix-page-builder' ),
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_one_listitem_iconcolor',
				'title'          => '',
				'desc'           => __( 'Icon Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_one_listitem_iconcolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	

			
		
		//------list end
		
		


		
	
	]
;

$args_2 = 
	[
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-page-builder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => 'uix_pb_features_col2_two_list',
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_content_js_var'      => 'dynamic_append_box_content_right',
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_title',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_titlecolor',
											'type'      => 'colormap'
										), 		
									
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_desc',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_desccolor',
											'type'      => 'colormap'
										), 		
										 
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_icon',
											'type'      => 'icon'
										), 	
										
										array(
											'id'        => 'dynamic-row-uix_pb_features_col2_two_listitem_iconcolor',
											'type'      => 'colormap'
										), 										
																			

									 ],
									'max'                       => 30
				                )
									
		),
		
		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_title',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Feature Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_title', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_titlecolor',
				'title'          => '',
				'desc'           => __( 'Title Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_titlecolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)

			
			),	
		
			
			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_desc',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-page-builder' ),
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_desc', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_desccolor',
				'title'          => '',
				'desc'           => __( 'Description Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_desccolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	
		
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_icon',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_icon', /*class of list item */
				'placeholder'    => __( 'Choose Feature Icon', 'uix-page-builder' ),
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
			array(
				'id'             => 'uix_pb_features_col2_two_listitem_iconcolor',
				'title'          => '',
				'desc'           => __( 'Icon Color', 'uix-page-builder' ),
				'value'          => '',
				'class'          => 'dynamic-row-uix_pb_features_col2_two_listitem_iconcolor', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	

			
		
		//------list end
		
		


		
	
	]
;


//---

$form_html = UixPageBuilder::form_before();

$form_html .= UixPageBuilder::add_form( $form_id, $form_type, $args_1, 'html', __( 'Left Section', 'uix-page-builder' ) );
$form_html .= UixPageBuilder::add_form( $form_id, $form_type, $args_2, 'html', __( 'Right Section', 'uix-page-builder' ) );

$form_html .= UixPageBuilder::form_after();

//----

$form_js = '';
$form_js .= UixPageBuilder::add_form( $form_id, $form_type, $args_1, 'js' );
$form_js .= UixPageBuilder::add_form( $form_id, $form_type, $args_2, 'js' );

//----

$form_js_vars = '';
$form_js_vars .= UixPageBuilder::add_form( $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPageBuilder::add_form( $form_id, $form_type, $args_2, 'js_vars' );




/**
 * Add simulation buttons
 */
echo UixPageBuilder::add_form( $form_id, '', '', 'active_btn' );
?>		


<script type="text/javascript">

( function($) {
    
	$( document ).ready( function() {
		
		
		/* List Item ( step 1) */
		var dynamic_append_box_content_left = '<?php echo UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_title', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_titlecolor', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_desc', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_desccolor', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_icon', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_one_listitem_iconcolor', $form_html ); ?>';
		
		
		var dynamic_append_box_content_right = '<?php echo UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_title', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_titlecolor', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_desc', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_desccolor', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_icon', $form_html ).UixPageBuilder::dynamic_form_code( 'dynamic-row-uix_pb_features_col2_two_listitem_iconcolor', $form_html ); ?>';	
			
		
		
		 /* Callback before custom javascript of sweetalert */
		<?php echo UixPageBuilder::sweetalert_before( $form_js, $form_html, $form_js_vars, $form_id, __( 'Insert Features (2 Column)', 'uix-page-builder' ) ); ?>
		
		        
				/* List Item ( step 2)  */
		        var list_num = 30;
				
		
				var show_list_item_1 = '';
				for ( var i=0; i<=list_num; i++ ){
					
			        var _uid = ( i == 0 ) ? '#' : '#'+i+'-',
					    _title = $( _uid+'uix_pb_features_col2_one_listitem_title' ).val(),
						_titlecolor = $( _uid+'uix_pb_features_col2_one_listitem_titlecolor' ).val(),
						_icon = $( _uid+'uix_pb_features_col2_one_listitem_icon' ).val(),
						_iconcolor = $( _uid+'uix_pb_features_col2_one_listitem_iconcolor' ).val(),
						_desc = $( _uid+'uix_pb_features_col2_one_listitem_desc' ).val(),
						_desccolor = $( _uid+'uix_pb_features_col2_one_listitem_desccolor' ).val();
						
						
						
						
						
					var _item_v_title = ( _title != undefined && _title != '' ) ? _title : '',
					    _item_v_titlecolor = ( _titlecolor != undefined && _titlecolor != '' ) ? "style='color:"+_titlecolor+"'" : '',
						_item_v_iconcolor = ( _iconcolor != undefined && _iconcolor != '' ) ? "style='border-color:"+_iconcolor+";color:"+_iconcolor+"'" : '',
					    _item_v_icon = ( _icon != undefined && _icon != '' ) ? "<span class='uix-pb-feature-icon-side'><i class='fa fa-"+_icon+"' "+_item_v_iconcolor+"></i></span>" : "<span class='uix-pb-feature-icon-side'><i class='fa fa-check' "+_item_v_iconcolor+"></i></span>",
					    _item_v_desc = ( _desc != undefined && _desc != '' ) ? uix_pb_formatTextarea( _desc ) : '',
						_item_v_desccolor = ( _desccolor != undefined && _desccolor != '' ) ? "style='color:"+_desccolor+"'" : '';
						
					
					if ( _title != undefined ) {
						show_list_item_1 += "<h3 class='uix-pb-feature-title' "+_item_v_titlecolor+">"+_item_v_icon+""+ _item_v_title +"</h3>";			
						show_list_item_1 += "<div class='uix-pb-feature-desc uix-pb-feature-desc-singlerow' "+_item_v_desccolor+">"+ _item_v_desc +"</div>";	
	
					}
						
					
				}
				
				//-----
				
				var show_list_item_2 = '';
				for ( var i=0; i<=list_num; i++ ){
					
			        var _uid = ( i == 0 ) ? '#' : '#'+i+'-',
					    _title = $( _uid+'uix_pb_features_col2_two_listitem_title' ).val(),
						_titlecolor = $( _uid+'uix_pb_features_col2_two_listitem_titlecolor' ).val(),
						_icon = $( _uid+'uix_pb_features_col2_two_listitem_icon' ).val(),
						_iconcolor = $( _uid+'uix_pb_features_col2_two_listitem_iconcolor' ).val(),
						_desc = $( _uid+'uix_pb_features_col2_two_listitem_desc' ).val(),
						_desccolor = $( _uid+'uix_pb_features_col2_two_listitem_desccolor' ).val();
						
						
						
						
						
					var _item_v_title = ( _title != undefined && _title != '' ) ? _title : '',
					    _item_v_titlecolor = ( _titlecolor != undefined && _titlecolor != '' ) ? "style='color:"+_titlecolor+"'" : '',
						_item_v_iconcolor = ( _iconcolor != undefined && _iconcolor != '' ) ? "style='border-color:"+_iconcolor+";color:"+_iconcolor+"'" : '',
					    _item_v_icon = ( _icon != undefined && _icon != '' ) ? "<span class='uix-pb-feature-icon-side'><i class='fa fa-"+_icon+"' "+_item_v_iconcolor+"></i></span>" : "<span class='uix-pb-feature-icon-side'><i class='fa fa-check' "+_item_v_iconcolor+"></i></span>",
					    _item_v_desc = ( _desc != undefined && _desc != '' ) ? uix_pb_formatTextarea( _desc ) : '',
						_item_v_desccolor = ( _desccolor != undefined && _desccolor != '' ) ? "style='color:"+_desccolor+"'" : '';
						
					
					if ( _title != undefined && _title != '' ) {
						show_list_item_2 += "<h3 class='uix-pb-feature-title' "+_item_v_titlecolor+">"+_item_v_icon+""+ _item_v_title +"</h3>";			
						show_list_item_2 += "<div class='uix-pb-feature-desc uix-pb-feature-desc-singlerow' "+_item_v_desccolor+">"+ _item_v_desc +"</div>";	
	
					}
					
					
				}
				
				//-----
				show_list_item_1 = "<div class='uix-pb-col-6'>"+show_list_item_1+"</div>";
				show_list_item_2 = "<div class='uix-pb-col-6 uix-pb-col-last'>"+show_list_item_2+"</div>";
	   
		
		
				<?php echo UixPageBuilder::send_to_editor_before( $form_id ); ?> "<div class='uix-pb-feature'><div class='uix-pb-row'>"+show_list_item_1+show_list_item_2+"</div></div>" <?php echo UixPageBuilder::send_to_editor_after(); ?>
				
				
				
		   /* Callback after custom javascript of sweetalert */
		  <?php echo UixPageBuilder::sweetalert_after(); ?>
				


	} ); 

	
	
} ) ( jQuery );

</script>
