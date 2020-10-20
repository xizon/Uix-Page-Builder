<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Enqueue scripts and styles of Visual Builder
 * 
 */
if ( !function_exists( 'uix_page_builder_vb_script' ) ) {
	add_action( 'admin_enqueue_scripts', 'uix_page_builder_vb_script' );
	function uix_page_builder_vb_script() {
        if ( UixPageBuilder::page_builder_general_mode() ) {
			
			// Register the script (Require to enqueue the script in the <head>.)
			wp_register_script( 'uix_page_builder_metaboxes_save_handle', UixPageBuilder::plug_directory() .'includes/admin/assets/js/core.min.js', array( 'jquery', UixPageBuilder::PREFIX . '-gridster' ), UixPageBuilder::ver(), false );

			// Localize the script with new data
			if ( UixPageBuilder::tempfile_exists() ) {
				$tempfile_exists = 1;
			} else {
				$tempfile_exists = 0;
			}
			
			$curid      = get_the_ID();
			$post_id    = empty( $curid ) ? $_GET['post_id'] : $curid;
			$post_url   = esc_url( get_permalink( $post_id ) );
			$previewURL = '';
			
			if( UixPageBuilder::inc_str( $post_url, '?' ) ) {
				$previewURL = $post_url.'&preview=true&pb_preview=1';
			} else {
				$previewURL = $post_url.'?preview=true&pb_preview=1';
			}
			
			
			$translation_array = array(
				'send_string_plugin_url'       => UixPageBuilder::plug_directory(),
				'send_string_vb_mode'          => ( UixPageBuilder::vb_mode() ) ? 1 : 0,
				'send_string_nonce'            => wp_create_nonce( 'uix_page_builder_metaboxes_save_nonce' ),
				'send_string_postid'           => $post_id,
				'send_string_tempfile_exists'  => ( UixPageBuilder::tempfile_exists() ) ? 1 : 0,
				'send_string_loadlist'         => esc_html__( 'Loading list...', 'uix-page-builder' ),
				'send_string_tempfiles_exists' => $tempfile_exists,
				'send_string_vb_mode'          => ( UixPageBuilder::vb_mode() ) ? 1 : 0,
				'send_string_preview_url'      => $previewURL,
				'send_string_render_count'     => 1,
				'send_string_del_temp_btn'     => esc_attr__( 'Are you sure?', 'uix-page-builder' ),
				'send_string_formsubmit_info'  => esc_html__( 'Can not be submitted in the live preview page.', 'uix-page-builder' ),
				'send_string_nodata'           => esc_html__( 'Hmm... no templates yet.', 'uix-page-builder' ),
				'send_string_tempfile_failed'  => sprintf( __( '<p>Cannot create due to insufficient permissions. To perform the requested action, WordPress needs to access your web server. <br><a class="button button-primary button-small" href="%1$s">Click Here</a> to enter your FTP credentials to proceed.</p>', 'uix-page-builder' ), admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp&tempfiles=ok" ) ),
				'send_string_tempfile_note'    => sprintf( __( '<div id="uix-page-builder-createTempFiles-info-wrapper"><p style="font-weight:bold;">You could <a class="button button-primary button-small" href="%1$s" id="uix-page-builder-createTempFiles-btn">Create</a> a Uix Page Builder template file (from the directory <code>/wp-content/plugins/uix-page-builder/uixpb_templates/tmpl-uix_page_builder.php</code> ) in your templates directory. This allows the page builder content templates to look beautiful with any theme.</p><p>Of course, It’s just a page template file and you doesn’t need to use it. You can use of the default page template or your own custom template file directly.</p><h3>How to use?</h3><ol><li>On the page editing screen, scroll down to <strong>"Page Attributes"</strong> section, and you will find a template drop down menu. Clicking on it will allow you to select the template you just created. The template name is <code>"Uix Page Builder Template"</code>. <a target="_blank" href="%2$s"><i class="dashicons dashicons-format-image"></i></a> <a target="_blank" href="%3$s"><i class="dashicons dashicons-format-image"></i></a></li><li>Go to <strong>"Dashboard » Appearence » Menus"</strong>. Click on <strong>"create a new menu"</strong> to create your custom menu. You should tick the appropriate checkbox of <code>"Primary Menu"</code> from options as <strong>"Display location"</strong>. <a target="_blank" href="%4$s"><i class="dashicons dashicons-format-image"></i></a></li></ol></div>', 'uix-page-builder' ), admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" ), UixPageBuilder::plug_directory().'helper/img/page-temp-tutorial-1.jpg', UixPageBuilder::plug_directory().'helper/img/page-temp-tutorial-2.jpg', UixPageBuilder::plug_directory().'helper/img/set-temp-menu.jpg' ),
				
				
			);
			
			
			wp_localize_script( 'uix_page_builder_metaboxes_save_handle', 'uix_page_builder_layoutdata', $translation_array );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_page_builder_metaboxes_save_handle' );
			

			//Drag and drop (Require to enqueue the script in the <head>.)
			wp_enqueue_script( UixPageBuilder::PREFIX . '-gridster', UixPageBuilder::plug_directory() .'includes/admin/assets/js/jquery.gridster.min.js', array( 'jquery', 'uixpbform' ), '0.5.7', false );	
			wp_enqueue_style( UixPageBuilder::PREFIX . '-gridster', UixPageBuilder::plug_directory() .'includes/admin/assets/css/jquery.gridster.min.css', false, '0.5.7', 'all' );


			//Main
			wp_enqueue_style( UixPageBuilder::PREFIX . '-page-builder-admin', UixPageBuilder::plug_directory() .'includes/admin/assets/css/style.min.css', false, UixPageBuilder::ver(), 'all' );
			//RTL		
			if ( is_rtl() ) {
				wp_enqueue_style( UixPageBuilder::PREFIX . '-page-builder-admin-rtl', UixPageBuilder::plug_directory() .'includes/admin/assets/css/style.min-rtl.css', false, UixPageBuilder::ver(), 'all' );
			}
			
			
			//Jquery UI sortable
			wp_enqueue_script( 'jquery-ui-sortable' );
			
		
	
		}
			
	}
}



/*
 * Create page template files to the theme directory
 * 
 */
if ( !function_exists( 'uix_page_builder_createTempFilesToTheme' ) ) {
	add_action( 'wp_ajax_uix_page_builder_createTempFilesToTheme_settings', 'uix_page_builder_createTempFilesToTheme' );		
	function uix_page_builder_createTempFilesToTheme() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'postID' ] ) ) {
			
            $post_ID        = $_POST[ 'postID' ];
			$echo_ok_status = '<span data-ok="1"></span>';
			
			$status_echo = UixPageBuilder::templates( 'uix_page_builder_metaboxes_save_nonce', uix_page_builder_get_visualBuilder_pageURL( $post_ID ), false, true );

			if( UixPageBuilder::inc_str( $status_echo, $echo_ok_status ) ) {
				echo 1;
			} else {
				echo 0;
			}


			//Using default template
			if ( UixPageBuilder::tempfile_exists() ) {
				update_post_meta( $post_ID, '_wp_page_template', 'tmpl-uix_page_builder.php' );
			}
	
			
		}
		

		wp_die();	
	}
}



/*
 * Delete data of custom content template with ajax
 * 
 */
if ( !function_exists( 'uix_page_builder_delContentTemplate' ) ) {
	add_action( 'wp_ajax_uix_page_builder_delContentTemplate_settings', 'uix_page_builder_delContentTemplate' );		
	function uix_page_builder_delContentTemplate() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'tempName' ] ) ) {
			
			//Update the WP data
			$old = get_option( 'uix-page-builder-templates' );
			$new = UixPageBuilder::remove_element_withvalue( $old, 'name', $_POST[ 'tempName' ] );
			update_option( 'uix-page-builder-templates', $new );
			
			//Update the XML data
			$xmlargs    = '';
			if ( is_array( $new ) && sizeof( $new ) > 0 ) {

				foreach ( $new as $v ) {

					$xmlargs   .= '
						<item>
							<name><![CDATA['.$v[ 'name' ].']]></name>
							<thumb><![CDATA['.$v[ 'thumb' ].']]></thumb>
							<author><![CDATA['.$v[ 'author' ].']]></author>
							<email><![CDATA['.$v[ 'email' ].']]></email>
							<release><![CDATA['.$v[ 'release' ].']]></release>
							<data><![CDATA['.$v[ 'data' ].']]></data>
						</item>
					';


				}

			}

			$xmlvalue =  '<?xml version="1.0" encoding="utf-8"?>
			<items>
				'.$xmlargs.'
			</items>
			';

			$xmlvalue = UixPageBuilder::convert_img_path( $xmlvalue, 'save' );
			update_option( 'uix-page-builder-templates-xml', $xmlvalue );	

			
	
			
		}

		wp_die();	
	}
}


/*
 * Save template with ajax when a new template is entered
 * 
 */
if ( !function_exists( 'uix_page_builder_savetemp' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_savetemp_settings', 'uix_page_builder_savetemp' );		
	function uix_page_builder_savetemp() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'curlayoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
	
			$post_ID            = $_POST[ 'postID' ];
	        $user_info          = get_userdata(1);
			$name               = ( empty( $_POST[ 'tempname' ] ) ) ? UixPageBuilder::get_tempname() : $_POST[ 'tempname' ];
		    $value              = array();
			$xmlargs            = '';
			$old                = get_option( 'uix-page-builder-templates' );
			$tmpl_author        = sanitize_text_field( get_the_author_meta('display_name', $user_info->ID ) );
			$tmpl_email         = sanitize_text_field( get_the_author_meta( 'user_email', $user_info->ID ) );
			$tmpl_release       = sanitize_text_field( current_time( 'mysql' ) );
			$tmpl_default_thumb = UixPageBuilder::module_thumbnails_path();
			$tmpl_name          = sanitize_text_field( $name );
			$tmpl_data          = UixPageBuilder::format_layoutdata_add_tempname( $post_ID, wp_unslash( $_POST[ 'curlayoutdata' ] ), $tmpl_name );
			
		
			//If the array item is empty, it will cause the script to read incorrectly
			if ( !empty( $tmpl_data ) && $tmpl_data != '[]' ) {
				
				array_push( $value, array(
										'name'     => $tmpl_name,
										'thumb'    => $tmpl_default_thumb,
										'author'   => $tmpl_author,
										'email'    => $tmpl_email,
										'release'  => $tmpl_release,
										'data'     => $tmpl_data
									)
				);

				$xmlargs   .= '
					<item>
						<name><![CDATA['.$tmpl_name.']]></name>
						<thumb><![CDATA['.$tmpl_default_thumb.']]></thumb>
						<author><![CDATA['.$tmpl_author.']]></author>
						<email><![CDATA['.$tmpl_email.']]></email>
						<release><![CDATA['.$tmpl_release.']]></release>
						<data><![CDATA['.$tmpl_data.']]></data>
					</item>
				';


				if ( is_array( $old ) && sizeof( $old ) > 0 ) {

					foreach ( $old as $v ) {

						array_push( $value, array(
												'name'    => $v[ 'name' ],
												'thumb'   => $v[ 'thumb' ],
												'author'  => $v[ 'author' ],
												'email'   => $v[ 'email' ],
												'release' => $v[ 'release' ],
												'data'    => $v[ 'data' ]
											)
						);


						$xmlargs   .= '
							<item>
								<name><![CDATA['.$v[ 'name' ].']]></name>
								<thumb><![CDATA['.$v[ 'thumb' ].']]></thumb>
								<author><![CDATA['.$v[ 'author' ].']]></author>
								<email><![CDATA['.$v[ 'email' ].']]></email>
								<release><![CDATA['.$v[ 'release' ].']]></release>
								<data><![CDATA['.$v[ 'data' ].']]></data>
							</item>
						';


					}

				}

				
				$xmlvalue =  '<?xml version="1.0" encoding="utf-8"?>
				<items>
					'.$xmlargs.'
				</items>
				';

				//The default picture path
				$xmlvalue = UixPageBuilder::convert_img_path( $xmlvalue, 'save' );

				//Update the WP data
                update_option( 'uix-page-builder-templates', $value );
				
				//Update the XML data
				update_option( 'uix-page-builder-templates-xml', $xmlvalue );	
				
				
			}
	
			
		}
		
		
		wp_die();	
	}
}


/*
 * Load templates list with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_loadtemplist' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_loadtemplist_settings', 'uix_page_builder_loadtemplist' );		
	function uix_page_builder_loadtemplist() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );

		if ( isset( $_POST[ 'postID' ] ) ) {
			
			
            $post_ID   = $_POST[ 'postID' ];
			$tempdata  = get_option( 'uix-page-builder-templates' );
			$xmlfile   = UixPageBuilder::tempfile_modules_path( 'dir' );
			
			echo '<p>';
			
			
			if ( is_array( $tempdata ) && sizeof( $tempdata ) > 0 ) {
				
				
				foreach ( $tempdata as $key => $v ) {
					
					
					$json_data       = UixPageBuilder::format_page_final_data( UixPageBuilder::convert_img_path( $v[ 'data' ], 'load' ) );
					$preview_thumb   = UixPageBuilder::convert_img_path( $v['thumb'], 'load' );
					$checked         = '';
	
					//The template name has been applied
					$curtempname = UixPageBuilder::get_session_default_tempname( $post_ID );
					if ( !empty( $curtempname ) ) {
						if ( $v[ 'name' ] == $curtempname ) $checked = 'checked';
					}
					
					
					echo '
					<label>
						<input type="radio" name="temp" value="1" '.$checked.'>
						<span id="id-'.UixPageBuilder::to_id_slug( $v[ 'name' ] ).'">'.$v[ 'name' ].'</span> <a data-del-id="id-'.UixPageBuilder::to_id_slug( $v[ 'name' ] ).'" href="javascript:" class="close-tmpl">&times;</a>
						<img class="preview-thumb" style="display:none" src="'.$preview_thumb.'" alt="">
						<textarea>'.$json_data.'</textarea>
					</label>
					';
					
	
	
				}
	
			} else {
				
				if ( !file_exists( $xmlfile ) ) {
					_e( 'Hmm... no templates yet.', 'uix-page-builder' );
				}
				
			}
			
			
			//Display the list by loading the template file (.xml)
			if (  !class_exists(  'DOMDocument'  )  )  _e( '<span style="color:red">Fatal error: Class "DOMDocument" not found in your PHP environment.</span>', 'uix-page-builder' );
			if ( file_exists( $xmlfile ) && class_exists(  'DOMDocument'  ) ) {
						
				
				

				//with WordPress methord
				$response = wp_remote_get( UixPageBuilder::tempfile_modules_path( 'uri' ) );
			
				if ( is_array( $response ) && ! is_wp_error( $response ) ) {
					
					//get xml code
					//--------------
					$xmlCode = simplexml_load_string( $response['body'], "SimpleXMLElement", LIBXML_NOCDATA);
					$jsonXml = json_encode($xmlCode);
					$xValue = json_decode($jsonXml,TRUE);

				
					//get length
					//--------------
					$xLength = count( $xValue[ 'item' ] );
				
					
					//get data
					//--------------
					for ( $xmli = 0; $xmli <= $xLength - 1; $xmli++ ) {

						if ( isset( $xValue['item'][$xmli]['data'] ) ) { //required

							$json_data       = UixPageBuilder::format_page_final_data( UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['data'], 'load' ) );			
							$preview_thumb   = UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['thumb'], 'load' );
							$temp_name       = $xValue['item'][$xmli]['name'];
							$checked         = '';


							//The template name has been applied
							$curtempname = UixPageBuilder::get_session_default_tempname( $post_ID );
							if ( !empty( $curtempname ) ) {
								if ( $temp_name == $curtempname ) $checked = 'checked';
							}



							if ( $temp_name != 'null' ) {
								echo '
								<label>
									<input type="radio" name="temp" value="1" '.$checked.'>
									'.$temp_name.' <span class="default">'.esc_html__( 'Default', 'uix-page-builder' ).'</span>
									<img class="preview-thumb" style="display:none" src="'.$preview_thumb.'" alt="">
									<textarea>'.$json_data.'</textarea>
								</label>
								';	
							}	

						}//endif isset( $xValue['item'][$xmli]['data'] )

					}//end for


				}//endif $response
				
				

			}
							
			echo '</p>';
		
			
		}
      
		
		wp_die();	
	}
}





/*
 * Output the front-end code
 *
 * Preview directly through the URL
 *
 * E.g. http://yoursite.com/wp-admin/admin-ajax.php?action=uix_page_builder_output_frontend_settings&post_id=1234&pb_render_entire_page=1&security={string_nonce}
 *
 * 
 */
if ( !function_exists( 'uix_page_builder_output_frontend' ) ) {
	add_action( 'wp_ajax_uix_page_builder_output_frontend_settings', 'uix_page_builder_output_frontend' );		
	function uix_page_builder_output_frontend() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_GET[ 'post_id' ] ) && ( isset( $_GET['pb_render_entire_page'] ) && $_GET['pb_render_entire_page'] == 1 ) ) {
			
			$content = UixPageBuilder::format_render_codes( do_shortcode( '[uix_pb_sections id="'.esc_attr( $_GET[ 'post_id' ] ).'"]' ) );
			
			if ( empty( $content ) ) $content = '<div style="text-align:center;padding: 1.5em 0;"><i class="fa fa-plus-circle"></i> '.esc_html__( 'Add a first module from the side panel. You can also choose a template to use.', 'uix-page-builder' ).'</div>';
			
			echo $content;
		}
		
		
		
		
		wp_die();	
	}
}





/*
 * Initialize template with ajax when manually select the template later (click the confirm button)
 * 
 */
if ( !function_exists( 'uix_page_builder_loadtemp' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_loadtemp_settings', 'uix_page_builder_loadtemp' );		
	function uix_page_builder_loadtemp() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		
		if ( isset( $_POST[ 'curlayoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			
			$post_ID       = $_POST[ 'postID' ];
			$curlayoutdata = UixPageBuilder::format_page_final_data( $_POST[ 'curlayoutdata' ] );
			
			
			//Match the default template(.xml) for the page builder
			if ( isset( $_POST[ 'pagetemp' ] ) ) {
				$target_pagetemp = $_POST[ 'pagetemp' ];
				$templates       = get_page_templates();
				
				
				foreach ( array_keys( $templates ) as $template ) {

					//The target page template exists
					if ( $templates[ $template ] == $target_pagetemp ) {
						update_post_meta( $post_ID, '_wp_page_template', $target_pagetemp );
						break;
					}
					
				}	
			}

			
			
			//Define session for the template name
			if ( isset( $_POST[ 'tempname' ] ) ) {
				UixPageBuilder::session_default_tempname( $_POST[ 'tempname' ], $post_ID );
			}
			
			$layoutdata = UixPageBuilder::format_layoutdata_add_tempname( $post_ID, wp_unslash( $curlayoutdata ) );
			
			update_post_meta( $post_ID, 'uix-page-builder-layoutdata', $layoutdata );
		}
		
		//Load the template JSON data
		if ( isset( $_POST[ 'curlayoutdata' ] ) ) {
			echo $curlayoutdata;
		}
		
		
		wp_die();	
	}
}



/*
 * Save with Ajax
 * 
 */
if ( !function_exists( 'uix_page_builder_save' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_save_settings', 'uix_page_builder_save' );		
	function uix_page_builder_save() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'layoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			
			$post_ID = $_POST[ 'postID' ];
			
			$layoutdata = UixPageBuilder::format_layoutdata_add_tempname( $post_ID, wp_unslash( $_POST[ 'layoutdata' ] ) );
			
			update_post_meta( $post_ID, 'uix-page-builder-layoutdata', $layoutdata );
		}
		
		wp_die();	
	}
}



/*
 * Display the Core Metabox
 * 
 */
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type' ) ) {
	
	add_action( 'admin_init', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type' );  
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_type(){  
		add_meta_box( 
			'uix_page_builder_page_meta_pagerbuilder_type', 
			__( '<i class="dashicons dashicons-editor-kitchensink"></i>&nbsp;&nbsp;Uix Page Builder Attributes', 'uix-page-builder' ), 
			'uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options', 
			'page', 
			'side', 
			'high',
			null
		);  
	}  
}
   
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options' ) ) {
	
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-page-builder' );
		
		$curid = ( property_exists( $object , 'ID' ) ) ? $object->ID : $_GET['post_id'];
		$status = get_post_meta( $curid, 'uix-page-builder-status', true );
    ?>

	<?php if ( UixPageBuilder::SHOWPAGESCREEN == 0 ) { ?>
	
		<!-- Visual Builder -->
		<?php if ( ! UixPageBuilder::vb_mode() ) { ?>

		 <!-- Hide visualization mode button on side. -->
		 <p>
			<a class="button visual-builder uix-page-builder-visual-mode side" href="<?php echo esc_url( uix_page_builder_get_visualBuilder_pageURL( $curid ) ); ?>"><i class="dashicons dashicons-visibility"></i><?php _e( 'Use Visual Builder', 'uix-page-builder' ); ?></a>
		</p>  
		<?php } ?> 

	<?php } ?> 


    <div class="uix-metabox-group" <?php echo ( UixPageBuilder::SHOWPAGESCREEN == 0 ) ? 'style="display: none"' : ''; ?>>
        <h3><?php _e( 'Page Builder Editor', 'uix-page-builder' ); ?></h3>
        <div class="uix-metabox-con">
     
            <p>
                 <label for="uix-page-builder-status">
                    <input name="uix-page-builder-status" id="uix-page-builder-status1" type="radio" value="enable" <?php echo ( $status == 'enable' ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Enable', 'uix-page-builder' ); ?>
                </label>
                
                <label for="uix-page-builder-status2">
                    <input name="uix-page-builder-status" id="uix-page-builder-status2" type="radio" value="disable" <?php echo ( $status == 'disable' || empty( $status )  ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Disable', 'uix-page-builder' ); ?>
                </label>  
    
            </p>
        </div>

    </div>
    
    <div class="uix-metabox-group">
        <h3>
			<?php _e( 'Frequently Asked Questions (FAQ):', 'uix-page-builder' ); ?>
        </h3>
        
		<p><?php printf( __( '<a href="%1$s" target="_blank">Check out here</a>' ), admin_url( 'admin.php?page='.UixPageBuilder::HELPER.'&tab=usage' ) ); ?></p>
    
    </div>
    



        
<?php  
	}  
}


/*
 * Load the page builder panel for the first time when entering the page.
 * 
 */ 
 
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container' ) ) {
	
	//Show page builder core assets of "Pages Add New Screen"
	if ( UixPageBuilder::SHOWPAGESCREEN == 1 ) {
		add_action( 'admin_init', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container' );  
	}
	
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_container(){  
		
		add_meta_box( 
			'uix_page_builder_page_meta_pagerbuilder_container', 
			__( 'Uix Page Builder', 'uix-page-builder' ), 
			'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options', 
			'page', 
			'normal', 
			'high',
			null
		);  
	}  

}
   

if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options' ) ) {
	
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-page-builder' );
		
		$curid            = ( property_exists( $object , 'ID' ) ) ? $object->ID : $_GET['post_id'];
		$old_layoutdata   = UixPageBuilder::get_page_final_data( $curid );
		$gridster_class   = ( UixPageBuilder::vb_mode() ) ? 'uix-page-builder-visual-builder visualBuilder' : '';

		
		//Define session for the current post ID
		UixPageBuilder::session_current_postid( $curid );
		
	
		//Define session for the template name
		$curtempname = UixPageBuilder::page_builder_array_tempattrs( $old_layoutdata );
		if ( !empty( $curtempname ) ) {
			UixPageBuilder::session_default_tempname( $curtempname, $curid );
		}
	
	
    ?>
     
		<?php if ( UixPageBuilder::vb_mode() ) { ?>

			<ul class="uix-page-builder-res-selector">
				<li data-size="[0,0]" class="active" title="<?php echo esc_attr__( 'Desktop', 'uix-page-builder' ); ?>"><i class="dashicons dashicons-desktop"></i></li>
				<li data-size="[1024,768]" title="<?php echo esc_attr__( 'Tablet', 'uix-page-builder' ); ?>"><i class="dashicons dashicons-laptop"></i></li>
				<li data-size="[768,1024]" title="<?php echo esc_attr__( 'Tablet (Portrait)', 'uix-page-builder' ); ?>"><i class="dashicons dashicons-tablet"></i></li>
				<li data-size="[375,568]" title="<?php echo esc_attr__( 'Mobile', 'uix-page-builder' ); ?>"><i class="dashicons dashicons-smartphone"></i></li>
			</ul>
			<div id="uix-page-builder-save-status"><?php _e( 'Saving...', 'uix-page-builder' ); ?></div>

		 
			 <div style="display: none">
			  <?php
				//Include tinymce editor in visual mode					
				wp_editor( '', 'uix_page_builder_editor_content', array( 
					'quicktags' => array( 'buttons' => 'strong,em,del,ul,ol,li,close' ), // note that spaces in this list seem to cause an issue
				) );										
			  ?>
			 </div>


		<?php } ?> 
      
       
        <div class="uix-page-builder-gridster-addbtn <?php echo esc_attr( $gridster_class ); ?>">

			<span class="li">
				<a class="button add" title="<?php echo esc_attr__( 'Add Section', 'uix-page-builder' ); ?>" href="javascript:void(0);"><i class="dashicons dashicons-plus"></i><?php _e( 'Add Section', 'uix-page-builder' ); ?></a>
			</span>
			<!-- Visual Builder -->
			<?php if ( ! UixPageBuilder::vb_mode() ) { ?>
				 <span class="li">
					<a class="button visual-builder uix-page-builder-visual-mode" title="<?php echo esc_attr__( 'Visual Builder', 'uix-page-builder' ); ?>" href="<?php echo esc_url( uix_page_builder_get_visualBuilder_pageURL( $curid ) ); ?>"><i class="dashicons dashicons-visibility"></i><?php _e( 'Visual Builder', 'uix-page-builder' ); ?></a>
				</span>   
			<?php } ?>    
			<span class="li">
				<a class="button select-temp" title="<?php echo esc_attr__( 'Select a Template', 'uix-page-builder' ); ?>" href="javascript:"><i class="dashicons dashicons-art"></i><?php _e( 'Select a Template', 'uix-page-builder' ); ?></a>
				<div class="settings-temp-wrapper"><a href="javascript:" class="close">&times;</a>
			   
					<p>
					
					    <strong><?php _e( 'Page Template', 'uix-page-builder' ); ?></strong>
						<select style=" width: 100%;" name="uix-page-builder-cur-page-template"> 
							<option value="default"><?php echo esc_html__( 'Default Template', 'uix-page-builder' ); ?></option>
							<?php
								$template = get_page_template_slug( $curid );
								page_template_dropdown( $template, 'page' ) 
							?>
						</select>

					</p>  
		       
			       <strong><?php _e( 'Content Template', 'uix-page-builder' ); ?></strong>
				   <span id="uix-page-builder-templatelist"></span>
				   <a class="button button-primary button-small confirm" id="uix-page-builder-templatelist-confirm" href="javascript:"><?php _e( 'Confirm', 'uix-page-builder' ); ?></a><span class="spinner"></span>

				</div>

			</span>
			<span class="li">
				<a class="button save-temp" title="<?php echo esc_attr__( 'Save as Template', 'uix-page-builder' ); ?>" href="javascript:"><i class="dashicons dashicons-image-rotate-right"></i><?php _e( 'Save as Template', 'uix-page-builder' ); ?></a>
				<div class="settings-temp-wrapper"><a href="javascript:" class="close">&times;</a><strong><?php _e( 'Enter Template Name', 'uix-page-builder' ); ?></strong>  
					<p>
						<label>
							<input size="30" name="tempname" type="text" maxlength="40" value="<?php echo UixPageBuilder::get_tempname( false, false, $curid ); ?>">
						</label>
					</p>
					<a class="button button-primary button-small save" href="javascript:"><?php _e( 'Save', 'uix-page-builder' ); ?></a><span class="spinner"></span>


				</div>
			</span>
			 <span class="li">
				<a class="button export-temp" title="<?php echo esc_attr__( 'Export', 'uix-page-builder' ); ?>" href="javascript:"><i class="dashicons dashicons-share-alt2"></i><?php _e( 'Export', 'uix-page-builder' ); ?></a>
				<div class="settings-temp-wrapper"><a href="javascript:" class="close">&times;</a>
					<p>
						<?php 
		                $theme_template_dir_name     = UixPageBuilder::get_theme_template_dir_name();
		                $theme_template_filepath     = UixPageBuilder::tempfile_modules_path( 'uri' );
						$theme_template_folder_plug  = UixPageBuilder::tempfile_modules_path( 'uri', 'plug', true );
		                $theme_template_folder_theme = UixPageBuilder::tempfile_modules_path( 'uri', 'theme', true );

						echo sprintf( __( '<strong>Please save the template you are editing before exporting. If you have done so yet, Uix Page Builder\'s templates list will be reset to its default value as specified from the xml file.</strong><hr>1. Move this file <b><em>"templates.xml"</em></b> to the <code>%1$s</code> folder.<br><br>2. You still could move this file <b><em>"templates.xml"</em></b> to the <code>%2$s</code> folder and change name to <b><em>"'.$theme_template_dir_name.'.xml"</em></b>. <span style="color:red">(Highest priority)</span>', 'uix-page-builder' ), $theme_template_folder_plug, $theme_template_folder_theme );

						?>
					</p>
					 <p>
					 <?php _e( 'Your current template:', 'uix-page-builder' ); ?><input size="20" type="text" onClick="select();" value="<?php echo esc_url( $theme_template_filepath ); ?>" >
					</p>
					<a class="button button-primary button-small export" target="_blank" href="<?php echo esc_url( UixPageBuilder::plug_directory().'includes/admin/export-templates.php' ); ?>"><?php _e( 'Export', 'uix-page-builder' ); ?></a>

				</div>
			</span> 
			

			<?php if ( UixPageBuilder::vb_mode() ) { ?>
			
			<span class="li">
				<a class="button publish-visual-builder" title="<?php echo esc_attr__( 'Publish', 'uix-page-builder' ); ?>" href="<?php echo esc_url( uix_page_builder_get_normalEditor_pageURL( $curid ) ); ?>"><i class="dashicons dashicons-edit"></i><?php _e( 'Publish', 'uix-page-builder' ); ?><span class="wait"></span></a>
				<div class="settings-temp-wrapper"><a href="javascript:" class="close">&times;</a>
					 <p>
					 <?php _e( 'Enter the title of the page:', 'uix-page-builder' ); ?>
						<label>
							<input size="30" name="uix-page-builder-new-pagetitle" type="text" maxlength="40" value="<?php echo esc_attr( UixPageBuilder::get_page_title( $curid ) ); ?>">
						</label>
					</p>
					<a class="button button-primary button-small publish" href="javascript:"><?php _e( 'Publish', 'uix-page-builder' ); ?></a><span class="spinner"></span>
					
				</div>
			</span>
			
			<span class="li">
				<a class="button exit-visual-builder" title="<?php echo esc_attr__( 'Exit Visual Builder', 'uix-page-builder' ); ?>" href="<?php echo esc_url( uix_page_builder_get_normalEditor_pageURL( $curid ) ); ?>"><i class="dashicons dashicons-no"></i><?php _e( 'Exit Visual Builder', 'uix-page-builder' ); ?></a>
			</span>
			
			

			<?php } ?>


		</div><!-- /.uix-page-builder-gridster-addbtn -->
       
        <div id="uix-page-builder-gridster-wrapper" class="<?php echo esc_attr( $gridster_class ); ?>">
       
			<div class="gridster uix-page-builder-gridster">
				<ul><?php
		        $v = UixPageBuilder::page_builder_array_newlist( $old_layoutdata );
				if ( empty( $v ) ) {
					echo '<span id="uix-page-builder-layoutdata-none">';
					_e( 'Add a first module here. You can also choose a template to use.', 'uix-page-builder' );
					echo '</span>';
				}
				?>
				</ul>
			</div>
      
            <textarea name="uix-page-builder-layoutdata" id="uix-page-builder-layoutdata" ><?php echo esc_textarea( $old_layoutdata ); ?></textarea>
         
       
        </div><!-- /#uix-page-builder-gridster-wrapper -->
        
        <?php $gridster_core_scripts = new UixPB_Components_DD_Core( $old_layoutdata, $curid );?>
			   
<?php  
	}  
}


 
/*
 * Saving the Custom Data from "Pages Add New Screen"
 * 
 */ 

if ( !function_exists( 'uix_page_builder_page_save_custom_meta_box' ) ) {
	
	//Show page builder core assets of "Pages Add New Screen"
	if ( UixPageBuilder::SHOWPAGESCREEN == 1 ) {
		add_action( 'save_post', 'uix_page_builder_page_save_custom_meta_box', 10, 3 );
	}
	
	function uix_page_builder_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce-page-builder' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce-page-builder' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
		

		$layoutdata 	 = UixPageBuilder::format_layoutdata_add_tempname( $post_id, wp_unslash( $_POST[ 'uix-page-builder-layoutdata' ] ) );
		$builderstatus 	 = sanitize_text_field( $_POST[ 'uix-page-builder-status' ] );
		
		if( isset( $_POST[ 'uix-page-builder-layoutdata' ] ) ) update_post_meta( $post_id, 'uix-page-builder-layoutdata', $layoutdata );
		if( isset( $_POST[ 'uix-page-builder-status' ] ) ) update_post_meta( $post_id, 'uix-page-builder-status', $builderstatus );
		
		
	
	}

}






 