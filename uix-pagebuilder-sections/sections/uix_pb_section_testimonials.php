<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_testimonials';

//clone list
$clone_trigger_id        = 'uix_pb_testimonials_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '';


/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-pagebuilder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $pid, 'uix-pagebuilder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::pagebuilder_output( $value->content );
		
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::pagebuilder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
			if ( $col_content && is_array( $col_content ) ) {
				foreach ( $col_content as $key ) :
				    
					$detail_content = $key;
					
					//column id
					$colname           = $form_id.'-col';
					$cname             = str_replace( $form_id.'|', '', $key[1][0] );
					$id                = $key[0][1];
					$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_section_xxx-col' ];
					
				
					foreach ( $detail_content as $value ) :	
						$name           = str_replace( $form_id.'|', '', $value[0] );
						$content        = $value[1];
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];
						
					endforeach;
						
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}

/**
 * Element Template
 * ----------------------------------------------------
 */
$uix_pb_testimonials_config_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_config_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_testimonials_config_intro          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_config_intro', __( 'This is the description text for the title.', 'uix-pagebuilder' ) );


$uix_pb_testimonials_listitem_avatar       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_listitem_avatar', '' );
$uix_pb_testimonials_listitem_name         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_listitem_name', __( 'Name', 'uix-pagebuilder' ) );
$uix_pb_testimonials_listitem_position     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_listitem_position', __( 'Position', 'uix-pagebuilder' ) );
$uix_pb_testimonials_listitem_intro        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_testimonials_listitem_intro', __( 'Enter some details for the customer giving this testimonial., E.g., Thank you from the bottom of our hearts.', 'uix-pagebuilder' ) );





//dynamic adding input
$list_testimonials_item_content = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_testimonials_listitem_intro';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
	
		$avatar                          = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_avatar]['.$sid.']' ] ) )  ? '<img class="uix-pb-testimonials-avatar" src="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_avatar]['.$sid.']' ] ).'" alt="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_name]['.$sid.']' ] ).'" />': '<span class="uix-pb-testimonials-no-avatar"></span>';
		$posclass                        = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_avatar]['.$sid.']' ] ) )  ? '': 'class="uix-pb-testimonials-pure-text"';
		$list_testimonials_item_content .= '
        <li>
           <div class="uix-pb-testimonials-content">'.wp_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_intro]['.$sid.']' ], wp_kses_allowed_html( 'post' ) ).'</div>
		   <div class="uix-pb-testimonials-signature">
		       '.$avatar.'
		       <strong '.$posclass.'>'.wp_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_name]['.$sid.']' ], wp_kses_allowed_html( 'post' ) ).'</strong> - '.wp_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_testimonials_listitem_position]['.$sid.']' ], wp_kses_allowed_html( 'post' ) ).'
		   </div>														                                                    
        </li>  
		';	
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		
		$avatar                          = ( !empty( $uix_pb_testimonials_listitem_avatar ) )  ? '<img class="uix-pb-testimonials-avatar" src="'.esc_url( $uix_pb_testimonials_listitem_avatar ).'" alt="'.esc_attr( $uix_pb_testimonials_listitem_name ).'" />': '<span class="uix-pb-testimonials-no-avatar"></span>';
		$posclass                        = ( !empty( $uix_pb_testimonials_listitem_avatar ) )  ? '': 'class="uix-pb-testimonials-pure-text"';
		$list_testimonials_item_content .= '
        <li>
           <div class="uix-pb-testimonials-content">'.wp_kses( $uix_pb_testimonials_listitem_intro, wp_kses_allowed_html( 'post' ) ).'</div>
		   <div class="uix-pb-testimonials-signature">
		       '.$avatar.'
		       <strong '.$posclass.'>'.wp_kses( $uix_pb_testimonials_listitem_name, wp_kses_allowed_html( 'post' ) ).'</strong> - '.wp_kses( $uix_pb_testimonials_listitem_position, wp_kses_allowed_html( 'post' ) ).'
		   </div>														                                                    
        </li>  
		';	
		
	}
	
}
	
				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-testimonials">
	<div class="uix-pb-testimonials-container">
		<div class="flexslider">
			<ul class="slides">
				{list_content}
			</ul><!-- .uix-pb-testimonials-slides -->
		</div><!-- .flexslider -->
	</div><!-- .uix-pb-testimonials-container -->
</div><!-- /.uix-pb-testimonials -->        
';


$uix_pb_section_testimonials_temp = str_replace( '{list_content}', $list_testimonials_item_content,
								 str_replace( '{heading}', ( !empty( $uix_pb_testimonials_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_testimonials_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_testimonials_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_testimonials_config_intro.'</div>' : '' ),			  
					
							     $element_temp 
								 ) ) );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];



$args_config = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_config_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_testimonials_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_config_intro' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_testimonials_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	]
;


$form_type = [
    'list' => 1
];



$args = 
	[
		
		//------list begin

		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'',
											'type'      => 'image'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
	

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_listitem_avatar' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_testimonials_listitem_avatar,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'', /*class of list item */
				'placeholder'    => __( 'Avatar URL', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									)
			
			),	
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_listitem_name' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_testimonials_listitem_name,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_listitem_position' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_testimonials_listitem_position,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_testimonials_listitem_intro' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_testimonials_listitem_intro,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_testimonials_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_testimonials_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_testimonials_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),		


		
	
	]
;

//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'html', __( 'General Settings', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Testimonials Carousel', 'uix-pagebuilder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}

/**
 * Returns forms with ajax
 * ----------------------------------------------------
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
	
	
    /*-- Dynamic Adding Input ( Default Value ) --*/
	for ( $i = 2; $i <= $clone_max; $i++ ) {
		$uid = $i.'-';
		$field = 'uix_pb_testimonials_listitem_intro';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_testimonials_listitem_avatar]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_testimonials_listitem_name]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_testimonials_listitem_position]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_testimonials_listitem_intro]['.$sid.']' ]
								),
				
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() {
			
			
			var tempcode                   = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_testimonials_config_title  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_config_title' ); ?>' ).val(),
				uix_pb_testimonials_config_intro  = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_config_intro' ); ?>' ).val();
	
	
				
			if ( tempcode.length > 0 ) {
		
				
				
				var _config_t      = ( uix_pb_testimonials_config_title != undefined && uix_pb_testimonials_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_testimonials_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_testimonials_config_intro != undefined && uix_pb_testimonials_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_testimonials_config_intro+'</div>' : '';
						
					
				
				
				/* List Item */
				var list_num               = <?php echo $clone_max; ?>,
					show_list_item_content = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid      = ( i >= 2 ) ? '#'+i+'-' : '#',
						_avatar   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_avatar' ); ?>' ).val(),
						_name     = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_name' ); ?>' ).val(),
						_pos      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_position' ); ?>' ).val(),
						_intro    = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_testimonials_listitem_intro' ); ?>' ).val();
						
					var _item_v_avatar     = ( _avatar != undefined && _avatar != '' ) ? '<img class="uix-pb-testimonials-avatar" src="'+encodeURI( _avatar )+'" alt="'+uixpbform_htmlEncode( _name )+'" />': '<span class="uix-pb-testimonials-no-avatar"></span>',
						_item_v_posclass   = ( _avatar != undefined && _avatar != '' ) ? '': 'class="uix-pb-testimonials-pure-text"',
						_item_v_name       = ( _name != undefined && _name != '' ) ? _name : '',
						_item_v_pos        = ( _pos != undefined && _pos != '' ) ? _pos : '',
						_item_v_intro      = ( _intro != undefined && _intro != '' ) ? _intro : '';
					
					
					if ( _intro != undefined && _intro != '' ) {
										
						//Do not include spaces
						show_list_item_content += '<li>';
						show_list_item_content += '<div class="uix-pb-testimonials-content">'+_item_v_intro+'</div>';
						show_list_item_content += '<div class="uix-pb-testimonials-signature">'+_item_v_avatar+'';
						show_list_item_content += '<strong '+_item_v_posclass+'>'+_item_v_name+'</strong> - '+_item_v_pos+'';
						show_list_item_content += '</div>';										                                                    
						show_list_item_content += '</li>';
	
					}
					
					
				}

                
				//---
				
				tempcode = tempcode.replace(/{list_content}/g, show_list_item_content )
								    .replace(/{heading}/g, _config_t )
								    .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_testimonials_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

