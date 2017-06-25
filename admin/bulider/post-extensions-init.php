<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/*
 * Save template with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_savetemp' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_savetemp_settings', 'uix_page_builder_savetemp' );		
	function uix_page_builder_savetemp() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'curlayoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			
			
			$name      = ( empty( $_POST[ 'tempname' ] ) ) ? sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $_POST[ 'postID' ] ) : $_POST[ 'tempname' ];
		    $value     = array();
			$xmlargs   = '';
			$old       = get_option( 'uix-page-builder-templates' );
			
		
		    array_push( $value, array(
									'name'  => sanitize_text_field( $name ),
									'data'  => wp_unslash( $_POST[ 'curlayoutdata' ] )
								)
			);
			
			$xmlargs   .= '
				<item>
					<name><![CDATA['.sanitize_text_field( $name ).']]></name>
					<data><![CDATA['.wp_unslash( $_POST[ 'curlayoutdata' ] ).']]></data>
				</item>
			';
			
			
			if ( is_array( $old ) && sizeof( $old ) > 0 ) {
				
				foreach ( $old as $v ) {
					
					array_push( $value, array(
											'name'  => $v[ 'name' ],
											'data'  => $v[ 'data' ]
										)
					);
							
					$xmlargs   .= '
						<item>
							<name><![CDATA['.$v[ 'name' ].']]></name>
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
			$xmlvalue = str_replace( UixPBFormCore::plug_directory(), '{temp_placeholder_path}', $xmlvalue );
			
			
			if ( UixPageBuilder::CLEANTEMP == 1 ) {
				update_option( 'uix-page-builder-templates', '' );
			} else {
				update_option( 'uix-page-builder-templates', $value );
			}
			
			
			update_option( 'uix-page-builder-templates-xml', $xmlvalue );
			
			

			
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
			
			
			$tempdata  = get_option( 'uix-page-builder-templates' );
			$xmlfile   = UixPageBuilder::backend_path( 'dir' ).'sections/templates.xml';
			
			echo '<p>';
			
			
			if ( is_array( $tempdata ) && sizeof( $tempdata ) > 0 ) {
				
				foreach ( $tempdata as $key => $v ) {
					
					$newdata = str_replace( '{temp_placeholder_path}', UixPBFormCore::plug_directory(), $v[ 'data' ] );
					
					echo '
					<label>
						<input type="radio" name="temp" value="1" '.( $key == 0 ? 'checked' : '' ).'>
						'.$v[ 'name' ].'
						<textarea>'.$newdata.'</textarea>
					</label>
					';
	
	
				}
	
			} else {
				
				if ( !file_exists( $xmlfile ) ) {
					_e( 'Hmm... no templates yet.', 'uix-page-builder' );
				}
				
			}
			
			/*
			 * Templates file: uix-page-builder-custom/sections/templates.xml
			 *
			 * If you have moved to "uix-page-builder-custom/sections/" folder so yet, Uix Page Builder's templates 
			 * list will be reset to its default value as specified from the xml file.
			*/
			
			if ( file_exists( $xmlfile ) ) {
				
				$xml             = new UixPB_XML;  
				$xml -> xml_path = UixPageBuilder::backend_path( 'uri' ).'sections/templates.xml';
				$xLength         =  $xml -> get_xmlLength();
				$xValue          = $xml -> xml_read();
				
				
				for ( $xmli = 0; $xmli <= $xLength - 1; $xmli++ ) {
					
					$checked = ( $xmli == 0 ) ? 'checked' : '';
					
					if ( is_array( $tempdata ) && sizeof( $tempdata ) > 0 ) {
						$checked = '';
					}
					
					$newdata = str_replace( '{temp_placeholder_path}', UixPBFormCore::plug_directory(), $xValue['item'][$xmli]['data'] );
						
					echo '
					<label>
						<input type="radio" name="temp" value="1" '.$checked.'>
						'.$xValue['item'][$xmli]['name'].' <span class="default">'.__( 'Default', 'uix-page-builder' ).'</span>
						<textarea>'.$newdata.'</textarea>
					</label>
					';
				}

			}
							
			echo '</p>';
		
			
		}
      
		
		wp_die();	
	}
}



/*
 * Output the front-end code
 * 
 */
if ( !function_exists( 'uix_page_builder_output_frontend' ) ) {
	add_action( 'wp_ajax_uix_page_builder_output_frontend_settings', 'uix_page_builder_output_frontend' );		
	function uix_page_builder_output_frontend() {
		/*
		 * Preview directly through the URL
		 *
		 * E.g. http://yoursite.com/wp-admin/admin-ajax.php?action=uix_page_builder_output_frontend_settings&post_id=1234&pb_render_entire_page=1
		 *
		*/
		
		if ( isset( $_GET[ 'post_id' ] ) && ( isset( $_GET['pb_render_entire_page'] ) && $_GET['pb_render_entire_page'] == 1 ) ) {
			
			$content = UixPageBuilder::format_render_codes( do_shortcode( '[uix_pb_sections]' ) );
			
			if ( empty( $content ) ) $content = '<i class="fa fa-plus-circle"></i> '.esc_html__( 'Add a first module from the side panel. You can also choose a template to use.', 'uix-page-builder' );
			
			echo $content;
		}
		
		
		
		
		wp_die();	
	}
}



/*
 * Initialize template with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_loadtemp' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_loadtemp_settings', 'uix_page_builder_loadtemp' );		
	function uix_page_builder_loadtemp() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'curlayoutdata' ] ) ) {
			echo $_POST[ 'curlayoutdata' ];
			echo json_encode( UixPageBuilder::page_builder_array_newlist( $_POST[ 'curlayoutdata' ] ) );
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
			update_post_meta( $_POST[ 'postID' ], 'uix-page-builder-layoutdata', wp_unslash( $_POST[ 'layoutdata' ] ) );
		}
		
		wp_die();	
	}
}

if ( !function_exists( 'uix_page_builder_save_script' ) ) {
	add_action( 'admin_enqueue_scripts', 'uix_page_builder_save_script' );
	function uix_page_builder_save_script() {
        if ( UixPageBuilder::page_builder_general_mode() ) {
			
			// Register the script
			wp_register_script( 'uix_page_builder_metaboxes_save_handle', UixPageBuilder::plug_directory() .'admin/assets/js/core.min.js', array( 'jquery', UixPageBuilder::PREFIX . '-gridster' ), UixPageBuilder::ver(), false );

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
				'send_string_nonce'            => wp_create_nonce( 'uix_page_builder_metaboxes_save_nonce' ),
				'send_string_postid'           => $post_id,
				'send_string_name'             => sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $post_id ),
				'send_string_loadlist'         => esc_html__( 'Loading list...', 'uix-page-builder' ),
				'send_string_tempfiles_exists' => $tempfile_exists,
				'send_string_vb_mode'          => ( UixPageBuilder::vb_mode() ) ? 1 : 0,
				'send_string_preview_url'      => $previewURL,
				'send_string_render_count'     => 1,
				
			);
			
			
			wp_localize_script( 'uix_page_builder_metaboxes_save_handle', 'uix_page_builder_layoutdata', $translation_array );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_page_builder_metaboxes_save_handle' );
			

			//Drag and drop
			wp_enqueue_script( UixPageBuilder::PREFIX . '-gridster', UixPageBuilder::plug_directory() .'admin/assets/js/jquery.gridster.min.js', array( 'jquery', 'uixpbform' ), '0.5.7', false );	
			wp_enqueue_style( UixPageBuilder::PREFIX . '-gridster', UixPageBuilder::plug_directory() .'admin/assets/css/jquery.gridster.min.css', false, '0.5.7', 'all' );

			//jQuery Accessible Tabs
			wp_enqueue_script( 'accTabs', UixPageBuilder::plug_directory() .'admin/assets/js/jquery.accTabs.js', array( 'jquery' ), '0.1.1', true );
			wp_enqueue_style( 'accTabs-uix-page-builder', UixPageBuilder::plug_directory() .'admin/assets/css/jquery.accTabs.css', false, '0.1.1', 'all' );

			//Main
			wp_enqueue_style( UixPageBuilder::PREFIX . '-page-builder-admin', UixPageBuilder::plug_directory() .'admin/assets/css/style.min.css', false, UixPageBuilder::ver(), 'all' );

			//Jquery UI
			wp_enqueue_script( 'jquery-ui' );
			
		
	
		}
			
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
        <h3><?php _e( 'How To Create The One-Page Navigation? Here is an example:', 'uix-page-builder' ); ?></h3>
        <div class="uix-metabox-con">
            <p>
             <?php _e( '1. Under the <i class="dashicons dashicons-admin-generic"></i> on the right per row, expand the Attributes tab. You can enter <code>my-portfolio</code> in the Custom ID field on the right.', 'uix-page-builder' ); ?></p>
             <p>
             <?php printf( __( '2. Create a new <a href="%1$s">menu</a>, and add a Custom Link for each menu item you plan on having. For each menu item, enter an id that you will assign later to the corresponding section. For example, for the menu item <code>My Portfolio</code>, you would enter <code>#my-portfolio</code> in the URL field.', 'my-text-domain' ), admin_url( "nav-menus.php" ) ); ?>
             </p>
            

        </div>

    
    </div>


        
<?php  
	}  
}


/*
 * Page Builder
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
		
		$curid          = ( property_exists( $object , 'ID' ) ) ? $object->ID : $_GET['post_id'];
		$old_layoutdata = get_post_meta( $curid, 'uix-page-builder-layoutdata', true );
		$gridster_class = ( UixPageBuilder::vb_mode() ) ? 'visualBuilder' : '';

		
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
				<a class="button add" title="<?php echo esc_attr__( 'Add Section', 'uix-page-builder' ); ?>" href="javascript:gridsterAddRow();"><i class="dashicons dashicons-plus"></i><?php _e( 'Add Section', 'uix-page-builder' ); ?></a>
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
							<input size="20" name="tempname" type="text" value="<?php echo sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $curid ); ?>">
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

						$folder = ( UixPageBuilder::tempfolder_exists() ) ? get_stylesheet_directory(). "/".UixPageBuilder::CUSTOMTEMP : UixPageBuilder::plug_filepath().UixPageBuilder::CUSTOMTEMP;

						echo sprintf( __( 'Please save the template you are editing before exporting. <br><br>Move this file <b><em>"templates.xml"</em></b> to the <code>%1$s</code> folder. If you have done so yet, Uix Page Builder\'s templates list will be reset to its default value as specified from the xml file.', 'uix-page-builder' ), $folder );

						?>
					</p>
					<a class="button button-primary button-small export" target="_blank" href="<?php echo esc_url( UixPageBuilder::plug_directory().'admin/export-templates.php' ); ?>"><?php _e( 'Export', 'uix-page-builder' ); ?></a>

				</div>
			</span> 
			

			<?php if ( UixPageBuilder::vb_mode() ) { ?>
			
			<span class="li">
				<a class="button publish-visual-builder" title="<?php echo esc_attr__( 'Publish', 'uix-page-builder' ); ?>" href="<?php echo esc_url( uix_page_builder_get_normalEditor_pageURL( $curid ) ); ?>"><i class="dashicons dashicons-edit"></i><?php _e( 'Publish', 'uix-page-builder' ); ?><span class="wait"></span></a>
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
        
			
         
        
        
       
        <script type="text/javascript">
		
		var gridsterWidth       = 0,
			gridsterMarginsX    = 0,
			gridsterMarginsY    = 15,
			gridsterMinheight   = 25,
			gridsterVisualWidth = 315,
			gridsterNormalWdiff = 60,
			vbmode              = false,
		    oww                 = 0,
		    gridster            = null,
			currently_editing   = null,
			currently_removing  = null,
			saved_data          = '<?php echo json_encode( UixPageBuilder::page_builder_array_newlist( $old_layoutdata ) ); ?>',
			saved_data          = JSON.parse( saved_data ),
			backURL             = '<?php echo uix_page_builder_get_normalEditor_pageURL( $curid ); ?>';

        <?php if ( UixPageBuilder::vb_mode() ) { ?>
        vbmode = true;
        <?php } ?>
			
		jQuery( document ).ready( function() {
			
			if ( ! vbmode ) {	
				gridsterWidth = jQuery( '#titlediv .inside' ).width() - gridsterNormalWdiff;
			} else {
				gridsterWidth = gridsterVisualWidth;
			}
			
		
			if ( vbmode ) {
				
				//Page template changed
				jQuery( document ).on( 'change', "[name='uix-page-builder-cur-page-template']", function() {
					/*-- Render and save page data --*/
					gridsterRenderAndSavePage(0); //Initialize the page container

				});
				
				//Widget layout changed
				jQuery( document ).on( 'change', "input[type='radio'][class='layout-box']", function() {
					/*-- Render and save page data --*/
					gridsterRenderAndSavePage(2); //Render the entire page

				});

			}
	
			
			
			/*-- Render and save page data --*/
			gridsterRenderAndSavePage(0); //Initialize the page container
			
			
			
			oww = jQuery( window ).width();
			
			/*-- Initialize gridster --*/
			gridsterWidgetsInit();

			jQuery( window ).on( 'resize', function() {
				
				/*-- Initialize gridster --*/
				gridsterWidgetsInit();
		
			});
			
			
			/*-- Visual Builder Primary Buttons --*/
			jQuery( '.exit-visual-builder' ).on( 'mouseenter', function(){
				jQuery( '.li.full' ).show();
			});
			jQuery( '.li a, #uix-page-builder-themepreview, .sortable-list .row' ).not( '.exit-visual-builder, .publish-visual-builder' ).on( 'mouseenter', function(){
				jQuery( '.li.full' ).hide();
			});	
			
			jQuery( '.li.full' ).on( 'mouseleave', function(){
				jQuery( this ).hide();
			});
	
		
			jQuery( document ).on( 'click', '.publish-visual-builder', function() {
				
				jQuery( this ).addClass( 'wait' );

				//Initialize the publish button when current admin page in "Visual Builder" mode
				uixPBFormVisualPublish();  
				return false;		
			});		

			
			
		});
			
	
	
		gridsterEditRow( saved_data );
		
		
		/*! 
		 * 
		 * [Gridster] Load and initialize editable widgets
		 * ---------------------------------------------------
		 *
		 * @param  {string} curdata        - The builder content data with JSON 
		 * @return {void}                  - The constructor.
		 */
		function gridsterEditRow( curdata ) {
			jQuery( document ).ready( function() {
				
				
				jQuery( '.gridster ul' ).gridster({
					widget_base_dimensions : [ gridsterWidth, gridsterMinheight ],
					widget_margins         : [ gridsterMarginsX, gridsterMarginsY ],
					max_cols               : 1,
					resize                 : {
						enabled: false
					},
					draggable: {
						handle: '.uix-page-builder-gridster-drag',
						drag: function( e, ui, $widget ) {
							var thispos   = ui.$player[0].dataset,
								curwidget = jQuery( '#uix-page-builder-gridster-widget-' + thispos.id );
							
							curwidget.addClass( 'move' );
	
						},
						stop: function( e, ui, $widget ) {
							
							/*-- Initialize default value & form --*/
							uixPBFormDataSave();	
							
							/*-- Render and save page data --*/
							gridsterRenderAndSavePage(2); //Render the entire page
							
							var newpos    = this.serialize($widget)[0],
								thispos   = ui.$player[0].dataset,
								curwidget = jQuery( '#uix-page-builder-gridster-widget-' + thispos.id )
							
							curwidget.removeClass( 'move' );
							
							//console.log('draggable stop thispos = ' + JSON.stringify(thispos));
							//console.log( "New col: " + newpos.col + " New row: " + newpos.row );
						}
					},
					serialize_params: function( $w, wgd ){ 
						var obj = {
							col          : wgd.col, 
							row          : wgd.row, 
							size_x       : wgd.size_x, 
							size_y       : wgd.size_y,
							content       : jQuery( $w[0] ).find( '.content-box' ).val(),
							secindex     : jQuery( $w[0] ).find( '.sid-box' ).val(),
							layout       : jQuery( $w[0] ).find( '.layout-box:checked' ).val(),
							customid     : gridsterStrToSlug( jQuery( $w[0] ).find( '.cusid-box' ).val() ),
							title        : jQuery( $w[0] ).find( '.title-box' ).val()
							
						} ;
						return obj;
					}
				});
				
			
				gridster = jQuery( '.gridster ul' ).gridster().data( 'gridster' );
			
				//Initialize gridster
				if ( jQuery( "[name='uix-page-builder-layoutdata']" ).val().length > 2 ) {
					gridster.remove_all_widgets();
					jQuery( '.gridster ul' ).empty();
				}
			
			    
				for(var iii = 0; iii < curdata.length; iii++) {
					
					
					//current widget id
					var row_index  = iii + 1,
						uid        = gridsterContent( curdata[iii].content, 'id', curdata[iii].secindex );
					
					if( typeof uid === typeof undefined ) {
						uid = curdata[iii].secindex;
					}
					
				
					
					var titleid        = 'title-data-'+uid,
						contentid      = 'content-data-'+uid,
						layout_boxed   = ( curdata[iii].layout == 'boxed' ) ? 'checked' : '',
						layout_fw      = ( curdata[iii].layout == 'fullwidth' ) ? 'checked' : '';
				
				
				
					gridster.add_widget( '<li id="uix-page-builder-gridster-widget-'+uid+'" class="uix-page-builder-gridster-widget" data-id="'+uid+'" data-row="'+curdata[iii].row+'" data-col="'+curdata[iii].col+'" data-sizex="'+curdata[iii].size_x+'" data-sizey="'+curdata[iii].size_y+'"><div><i class="dashicons dashicons-admin-generic settings" title="<?php echo esc_attr__( 'Settings', 'uix-page-builder' ); ?>"></i><div class="settings-wrapper"><a href="javascript:" class="close">&times;</a><p><strong><?php _e( 'ID', 'uix-page-builder' ); ?></strong><input type="text" size="15" class="cusid-box" value="'+curdata[iii].customid+'"></p><p><strong><?php _e( 'Container', 'uix-page-builder' ); ?></strong><label><input type="radio" class="layout-box" name="layout'+curdata[iii].row+'" value="boxed" '+layout_boxed+'><?php _e( 'Boxed', 'uix-page-builder' ); ?></label><label><input type="radio" class="layout-box" name="layout'+curdata[iii].row+'" value="fullwidth" '+layout_fw+'><?php _e( 'Full Width', 'uix-page-builder' ); ?></label></p></div><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Section', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="'+ gridsterHtmlEscape( curdata[iii].title ) +'"><input type="hidden" class="sid-box" value="'+curdata[iii].secindex+'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget('+uid+');return false;"><i class="dashicons dashicons-no"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'">'+gridsterHtmlUnescape( curdata[iii].content )+'</textarea><?php UixPageBuilder::list_page_itembuttons();?></div></li>', curdata[iii].size_x, curdata[iii].size_y, curdata[iii].col, curdata[iii].row );
					
					
					if ( curdata[iii].content != '' ) {
						
						var allcontent = gridsterContent( curdata[iii].content, 'content', '' );
					
						
						//Transit the replacement value
						jQuery( '#cols-all-content-replace-' + uid ).val( curdata[iii].content.replace( allcontent, '{allcontent}' ) );	
						 
								
						//Default value & form show
						var conLen          = gridsterColsContent( allcontent, 'length', 1 ),
							default_value   = [],
							list_code       = '',
							colid           = '',
							cid             = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];
								
						
						for ( var k = 1; k <= conLen; k ++ ) {
							default_value.push( gridsterColsContent( allcontent, 'content', k ) );
							
							for( var i in cid ) {
								if ( gridsterColsContent( allcontent, 'content', k ).indexOf( 'col-item-'+cid[i] ) >= 0  ) {
									colid  = cid[i];
									
									//Resize widget size
									gridsterWidgetResize( uid, colid );
									
									//Data already exists
									list_code += gridsterItemAddRowPer( uid, contentid, cid[i] );
									
									if ( colid == '3_4' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
									}
									if ( colid == '1_4' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
									}
									if ( colid == '2_3' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>
									}
									if ( colid == '1_3' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>
									}
									if ( colid == '4__1' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '4__1' );?>
									}
									if ( colid == '4__2' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '4__2' );?>
									}
									if ( colid == '4__3' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '4__3' );?>
									}
									if ( colid == '4__4' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '4__4' );?>
									}
									if ( colid == '3__1' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '3__1' );?>
									}
									if ( colid == '3__2' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '3__2' );?>
									}
									if ( colid == '3__3' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '3__3' );?>
									}
									if ( colid == '2__1' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '2__1' );?>
									}
									if ( colid == '2__2' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '2__2' );?>
									}
									if ( colid == '1__1' ) {
										<?php UixPageBuilder::list_page_sortable_li_btns( '1__1' );?>
									}
	
	
	
								}
								
							}
	
							
						}
						
						
						
						list_code = '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+colid+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">'+list_code+'</ul></div>';
						
						//Add a default value when there is no column of data
						gridsterItemAddRow( 1, uid, contentid, '', default_value, list_code );	
		
		
						
	
					}
	
						 
				}//end for
				
			
			    /*-- Initialize gridster --*/
				gridsterWidgetsInit();
				
				
				//save with ajax
				jQuery( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
					e.preventDefault();
					
					var $form           = jQuery( this ).closest( 'form' ),
						tmplValueEmpty  = $form.find( '.uixpbform-tmpl-textarea' ).data( 'tmpl-value' ),
						existShortcode  = $form.find( '.uixpbform-tmpl-textarea' ).val().indexOf( '[uix_pb_' );
					
					
					setTimeout( function() {
						var settings = jQuery( "[name='uix-page-builder-layoutdata']" ).val();
						//console.log( settings );
						
						// retrieve the widget settings form
						jQuery.post( ajaxurl, {
							action               : 'uix_page_builder_metaboxes_save_settings',
							layoutdata           : settings,
							postID               : uix_page_builder_layoutdata.send_string_postid,
							security             : uix_page_builder_layoutdata.send_string_nonce
						}, function ( response ) {
							
							
							/*-- Render and save page data --*/
							if ( existShortcode == -1 ) {
								if ( tmplValueEmpty == 0 ) {
									gridsterRenderAndSavePage(2); //Render the entire page
								} else {
									gridsterRenderAndSavePage(1);
								}
							} else {
								//Filter shortcodes of each column widget HTML code through their hooks.
								gridsterRenderAndSavePage(2); //Render the entire page
							}	
							
							

							
							
							/*-- Initialize per column section buttons status (Has been clicked) --*/
							gridsterItemElementsBTStatus( 1 );
							
						});

						// stuff here
						return false;	
			
					}, 500 );
					
				});	
				
				
			});
			
			/*-- Initialize default value & form --*/
			uixPBFormDataSave();
			
			/*-- Render and save page data --*/
			gridsterRenderAndSavePage(1);
			
			/*-- Spy the form elements --*/
			gridsterFormSpy();	
			
			/*-- Initialize gridster widgets status --*/
			gridsterWidgetStatus();
			
			/*-- Initialize per column section buttons status (The click action has not yet been performed.) --*/
			gridsterItemElementsBTStatus( 0 );

				
		}	 
 
		 
		
		/*! 
		 * 
		 * [Gridster] Add a new widget
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */	
		function gridsterAddRow() {
			
			var gLi         = jQuery( '.gridster > ul > li' ).length,
				gLi         = gLi + 1,
				titleid     = 'title-data-'+gLi,
				contentid   = 'content-data-'+gLi,
				uid         = gLi + ''+gridsterRowUID()+'',
				title_uid   = gLi;
				
			
			gridster.add_widget( '<li id="uix-page-builder-gridster-widget-'+uid+'" class="uix-page-builder-gridster-widget" data-id="'+uid+'"><div><i class="dashicons dashicons-admin-generic settings" title="<?php echo esc_attr__( 'Settings', 'uix-page-builder' ); ?>"></i><div class="settings-wrapper"><a href="javascript:" class="close">&times;</a><p><strong><?php _e( 'ID', 'uix-page-builder' ); ?></strong><input type="text" size="15" class="cusid-box" value="section-'+uid+'"></p><p><strong><?php _e( 'Container', 'uix-page-builder' ); ?></strong><label><input type="radio" class="layout-box" name="layout'+uid+'" value="boxed" checked><?php _e( 'Boxed', 'uix-page-builder' ); ?></label><label><input type="radio" class="layout-box" name="layout'+uid+'" value="fullwidth"><?php _e( 'Full Width', 'uix-page-builder' ); ?></label></p></div><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Section', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="<?php _e( 'Section', 'uix-page-builder' ); ?> '+title_uid+'"><input type="hidden" class="sid-box" value="'+uid+'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget('+uid+');return false;"><i class="dashicons dashicons-no"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'"></textarea><?php UixPageBuilder::list_page_itembuttons();?></div></li>', 1, 2 ).fadeIn( 100, function() {
				
				    /*-- Spy the form elements --*/
					gridsterFormSpy();
			});
			
			
			/*-- Initialize default value & form --*/
			uixPBFormDataSave();

			
			/*-- Initialize gridster --*/
			gridsterWidgetsInit();
			
			/*-- Welcome text --*/
			jQuery( '#uix-page-builder-layoutdata-none' ).hide();
			
			
			
			
			/*-- Navigate to the current row --*/
			/*
			jQuery( 'html, body' ).delay( 100 ).animate( {scrollTop: jQuery( '#uix-page-builder-gridster-widget-'+uid ).offset().top - 50 }, 100 );
			*/
	

		}
			
			
		/*! 
		 * 
		 * [Gridster] Remove the currently selected widget
		 * ---------------------------------------------------
		 *
		 * @param  {number} uid            - The widget ID number.
		 * @return {void}                  - The constructor.
		 */	
		function gridsterRemoveWidget( uid ){
			jQuery( document ).ready( function() {
				
				gridster.remove_widget( jQuery( '#uix-page-builder-gridster-widget-' + uid ) );
					
				/*-- Initialize default value & form --*/
				uixPBFormDataSave();
				
				/*-- Render and save page data --*/
				gridsterRenderAndSavePage(2); //Render the entire page
	
			} );
		}
		
			
		/*! 
		 * 
		 * [Gridster] Save the form data
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */		
		function uixPBFormDataSave(){
			jQuery( document ).ready( function() {  
				var json_str = JSON.stringify( gridster.serialize() );
				json_str = json_str.replace(/(\r)*\n/g, '<br>' ).replace(/\\r/g, '' ).replace(/\\/g, '' );
				
				jQuery( '#uix-page-builder-layoutdata' ).val( json_str );
				
				/*-- Initialize gridster widgets status --*/
				gridsterWidgetStatus();



			});
			
		}
			
			
		/*! 
		 * 
		 * [Gridster] Render and save page data
		 * ---------------------------------------------------
		 *
		 * @param  {type} numbber          - 0: Initialize the page container | 1: No render action | 2: Render the entire page
		 * @return {void}                  - The constructor.
		 */
		function gridsterRenderAndSavePage( type ) {
			jQuery( document ).ready( function() {
				
				if ( vbmode ) {	
					
					//show loader
					if ( type == 0 ) {
						jQuery( '#uix-page-builder-visualBuilder-loader, #uix-page-builder-visualBuilder-loader .loader' ).show();
					}
					

					var $saveobj = jQuery( '#uix-page-builder-save-status' );

					$saveobj.addClass( 'wait' ).text( '<?php echo esc_html__( 'Saving...', 'uix-page-builder' ); ?>' );

					jQuery.post( ajaxurl, {
						action               : 'uix_page_builder_savevisualBuilder_settings',
						layoutdata           : jQuery( "[name='uix-page-builder-layoutdata']" ).val(),
						pageTemp             : jQuery( "[name='uix-page-builder-cur-page-template']" ).val(),
						postID               : uix_page_builder_layoutdata.send_string_postid,
						security             : uix_page_builder_layoutdata.send_string_nonce
					}, function ( response ) {
						if ( response == 1 ) {
			
				
							//render page viewport
							jQuery( document ).UixPBRenderPage( { enable: type } );
							
							//save status
							$saveobj.text( '<?php echo esc_html__( 'Data has been saved.', 'uix-page-builder' ); ?>' );
							setTimeout( function() {
								$saveobj.text( '<?php echo esc_html__( 'Saving...', 'uix-page-builder' ); ?>' ).removeClass( 'wait' );
							}, 1500 );
							
							//remove entire page loader when rendered
							jQuery( '#uix-page-builder-themepreview' ).contents().find( '.uix-page-builder-editicon' ).removeClass( 'active' );
							
							
						}
					});
					
					
					// stuff here
					return false;		
					
				}
		

			});
			
		}	

		
			
		/*! 
		 * 
		 * [Gridster] Initialize the publish button when current admin page in "Visual Builder" mode
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */	
		function gridsterWidgetStatus(){
			jQuery( document ).ready( function() {  
				jQuery( '.gridster > ul > li' ).each( function() {
					var $this = jQuery( this );
					if ( $this.find( '.content-box' ).val() != '') {
						$this.addClass( 'active' );
					} else {
						$this.removeClass( 'active' );
					}
				});
			
			});
			
		}	
		
		/*! 
		 * 
		 * [Gridster] Spy the form elements
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */	
		function gridsterFormSpy(){
			jQuery( document ).ready( function() {  
				jQuery( '.gridster > ul > li' ).each( function() {
					var $this = jQuery( this );
					$this.find( '.content-box, .title-box, .cusid-box, [name^="layout"]' ).on( 'change keyup', function() {
						
						/*-- Initialize default value & form --*/
						uixPBFormDataSave();
						
						/*-- Render and save page data --*/
						gridsterRenderAndSavePage(1);
						
					});
		
				});
			
			});
		
		}	
		
		/*! 
		 * 
		 * [Gridster] Initialize gridster
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */	
		function gridsterWidgetsInit() {
			jQuery( document ).ready( function() {  
				var ow;
				
				if ( ! vbmode ) {	
					ow = jQuery( '#titlediv .inside' ).width() - gridsterNormalWdiff;
				} else {
					ow = gridsterVisualWidth;
				}
				
				jQuery( '.uix-page-builder-gridster-widget' ).css( {'width': ow + 'px' } );
				
				
				
			});	
		}
		
		
		/*! 
		 * 
		 * [Gridster] Decodes an encoded string.
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - Any string.
		 * @return {string}                - A new string.
		 */		
		function gridsterHtmlUnescape( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				return str
					.replace(/&quot;/g, '"')
					.replace(/&#39;/g, "'")
					.replace(/&lt;/g, '<')
					.replace(/&gt;/g, '>');
	
			}
				
		}
			
		 	
		/*! 
		 * 
		 * [Gridster] Escapes a HTML string.
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - Any string.
		 * @return {string}                - A new string.
		 */		
		function gridsterHtmlEscape( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				return str
					.replace(/"/g, '&quot;')
					.replace(/'/g, '&#39;')
					.replace(/</g, '&lt;')
					.replace(/>/g, '&gt;');
	
			}
		}
	
		/*! 
		 * 
		 * [Gridster] Convert a string to slug.
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - Any string.
		 * @return {string}                - A new string.
		 */			
		function gridsterStrToSlug( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				var pattern = new RegExp("[`~!+%@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】\"；：”“'。，、？]");
				var rs = ""; 
				for (var i = 0; i < str.length; i++) { 
					rs = rs+str.substr( i, 1 ).replace( pattern, '' ); 
				} 
				
				rs = rs.replace(/ /g, '-').toLowerCase();
				return rs;
	
			}
		}
	
		/*! 
		 * 
		 * [Gridster] Get a widget content with JSON
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - The contents of all widgets with JSON.
		 * @param  {string} type           - Returns the data type. The optional values: "id", "name", content"
		 * @param  {string} repstr         - The string that will be returned without any processing.
		 * @return {string}                - A new string.
		 */		
		function gridsterContent( str, type, repstr ){
			
			if ( typeof( str ) == 'string' && str.length > 0 ) {


				var nstr   = str.replace(/{rqt:}/g, '"');

				if ( type == 'id' ) {
					var result = nstr.match( /row\",\"(.+?)\"\]/g );

					if ( result != null ) {
						return result[0].replace( 'row","', '' )
									   .replace( '"]', '' );

					}



				}
				if ( type == 'name' ) {
					var result = nstr.match( /widgetname\",\"(.+?)\"\]/g );

					if ( result != null ) {
						return result[0].replace( 'widgetname","', '' )
									   .replace( '"]', '' );
					}

				}	
				if ( type == 'content' ) {
					var result = nstr.match( /rowcontent\",\"(.+?)\"\]/g );

					if ( result != null ) {
						return result[0].replace( 'rowcontent","', '' )
									   .replace( '"]', '' );	
					}
				}	

			} else {
				return repstr;
			}	
			
			
	
		}
		
			
		/*! 
		 * 
		 * [Gridster] Get a widget content of the current column with JSON
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - The contents of all widgets with JSON.
		 * @param  {string} type           - Returns the data type. The optional values: "length", "col", "name", "form_id", "content"
		 * @param  {string} index          - Retrieves the array index of the data.
		 * @return {string}                - A new string.
		 */		
		function gridsterColsContent( str, type, index ){
			
			if ( index < 1 ) index = 1;
			
			index = index - 1;
			
			
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				var nstr   = str.replace(/{rowqt:}/g, '"'),
				    result = '';
				nstr = eval( nstr );
				
				
				
				//item array
				var ia         = nstr[index],
				    rescontent = [];
				for( var j in ia ) {
					rescontent.push( '[{rqt:}'+ia[j][0]+'{rqt:},{rqt:}'+ia[j][1]+'{rqt:}]' );
				}
				
				if ( type == 'length' ) {
					result = nstr.length;
				}
					
				if ( type == 'col' ) {
					result = nstr[index][0][1];
				}
				if ( type == 'name' ) {
					result =  nstr[index][1][0];
				}	
				
				if ( type == 'form_id' ) {
					var r = nstr[index][1][0],
					    a = r.split("|");
						
					result =  a[0];
				}		
				
				if ( type == 'content' ) {
					result =  '{'+nstr[index][0][1]+'}['+rescontent+']';	
				}		
	            
				return result;
				
			} else {
				return '';
			}
			
		}	
		
		
		
		/*! 
		 * 
		 * [Gridster & Sortable ] Each row of sortable item initialization
		 * ---------------------------------------------------
		 *
		 * @param  {number} uid            - The widget ID number.
		 * @return {void}                  - The constructor.
		 */	
		function gridsterItemSortableInit( uid ){
			 jQuery( document ).ready( function() {
				
				var item_sortable = '.sortable-list-container'; //Sortable list container ID
					
				jQuery( item_sortable + '-'+uid+' .sortable-list' ).sortable({
					start: function(event, ui) {
						var start_pos = ui.item.index();
						ui.item.data( 'start_pos', start_pos );
						
					},
					change : function(event, ui) {
						
						var start_pos = ui.item.data('start_pos');
						var index = ui.placeholder.index();
						if (start_pos < index) {
							jQuery( item_sortable + '-'+uid+' li:nth-child(' + index + ')' ).addClass( 'list-group-item-success' );
						} else {
							jQuery( item_sortable + '-'+uid+' li:eq(' + (index + 1) + ')' ).addClass( 'list-group-item-success' );
						}
						
						
			
					},
			
					update: function( event, ui ) {
						gridsterItemSave( uid );
						
						/*-- Initialize default value & form --*/
						uixPBFormDataSave();
						
						/*-- Render and save page data --*/
						gridsterRenderAndSavePage(2); //Render the entire page
						
						
						jQuery( item_sortable + '-'+uid+' li' ).removeClass( 'list-group-item-success' );
			
					}
				});
				
				
				gridsterItemSave( uid );
				

				
			 });

		} 
		
			
		/*! 
		 * 
		 * [Gridster & Sortable] Save the data for each sortable item
		 * ---------------------------------------------------
		 *
		 * @param  {number} uid            - The widget ID number.
		 * @return {void}                  - The constructor.
		 */		
		function gridsterItemSave( uid ) {
			jQuery( document ).ready( function() {  
				var item_sortable    = '.sortable-list-container', //Sortable list container ID
					result           = [],
					allcontentID     = '',
					allcontentRpID   = '',
					sectionContentID = '',
					total            = jQuery( item_sortable + '-'+uid+' li' ).length;
			
				jQuery( item_sortable + '-'+uid+' li' ).each(function( index ){
					var data                = jQuery( this ).find( 'textarea' ).val(),
						id                  = index + 1,
						classname           = jQuery( this ).attr( 'class' ),
						last                = ( id == total ) ? 'uix-pb-col-last' : '';
				
					if ( data == null ) data = '';
					allcontentID       = jQuery( this ).parent().parent().data( 'allcontent-tempid' );
					allcontentRpID       = jQuery( this ).parent().parent().data( 'allcontent-replace-tempid' );
					sectionContentID   = jQuery( this ).parent().parent().data( 'contentid' );
					
					result.push( data );
					
				});
				
				
			
				jQuery( '#' + allcontentID ).val( result );
				
				//Save All content
				if ( jQuery( '#' + allcontentRpID ).length > 0 ) {
					result = gridsterFormatAllCodes( result );
				    var old = jQuery( '#' + allcontentRpID ).val();
		            var newv = old.replace( '{allcontent}', '['+result+']' );
					jQuery( '#' + sectionContentID ).val( newv );	
				}
				
		

			});
				
		}	 

		/*! 
		 * 
		 * [Gridster] Add a widget
		 * ---------------------------------------------------
		 *
		 * @param  {number} add            - Add a default value when there is no column of data. The optional values: 1, 0
		 * @param  {number} uid            - The widget ID number.
		 * @param  {string} contentid      - The textarea ID of the contents with JSON of each widget.
		 * @param  {string} col            - The index of each column.
		 * @param  {string} content        - The content with JSON to add.
		 * @param  {string} list           - The HTML code of default sortable list.
		 * @return {void}                  - The constructor.
		 */		
		function gridsterItemAddRow( add, uid, contentid, col, content, list ) {
			jQuery( document ).ready( function() {  
				var result        = '',
				    average_code  = '',
					colid         = col,
				    sid           = contentid.replace( 'content-data-', '' );
				

				
				//default value
				gridsterItemRowTextareaInit( content, uid );
	
				//output html code
				if ( add == 1 ) {
					jQuery( '#cols-content-data-'+uid+'' ).html( list );	
				}
				
				if ( add == 0 ) {
					result += '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+col+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">';
		
					// 3_4-1_4 column
					if ( col == '3_4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '3_4' );?><?php UixPageBuilder::list_page_sortable_li( '1_4' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
						
					}	
			
					
					// 1_4-3_4 column
					if ( col == '1_4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '1_4' );?><?php UixPageBuilder::list_page_sortable_li( '3_4' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
		
					}	
					
					// 2_3-1_3 column
					if ( col == '2_3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '2_3' );?><?php UixPageBuilder::list_page_sortable_li( '1_3' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>
						
					}	
					
					
					// 1_3-2_3 column
					if ( col == '1_3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '1_3' );?><?php UixPageBuilder::list_page_sortable_li( '2_3' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>
						
					}		
					
					// 4 column
					if ( col == '4__1' || col == '4__2' || col == '4__3' || col == '4__4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '4__1' );?><?php UixPageBuilder::list_page_sortable_li( '4__2' );?><?php UixPageBuilder::list_page_sortable_li( '4__3' );?><?php UixPageBuilder::list_page_sortable_li( '4__4' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__1' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__2' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__3' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__4' );?>
						
						
					}	
					
					// 3 column
					if ( col == '3__1' || col == '3__2' || col == '3__3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '3__1' );?><?php UixPageBuilder::list_page_sortable_li( '3__2' );?><?php UixPageBuilder::list_page_sortable_li( '3__3' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__1' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__2' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__3' );?>
						
					}
					// 2 column
					if ( col == '2__1' || col == '2__2' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '2__1' );?><?php UixPageBuilder::list_page_sortable_li( '2__2' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2__1' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2__2' );?>
						
					}
					
					// 1 column
					if ( col == '1__1' ) {	
						result += '<?php UixPageBuilder::list_page_sortable_li( '1__1' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1__1' );?>
																		  
					}
					
					result += '</ul></div>';	
					
					jQuery( '#cols-content-data-'+uid+'' ).html( result );
					
					//Resize widget size
					gridsterWidgetResize( uid, col );

					
					
				}
					

				//re-sortable
				gridsterItemSortableInit( uid );
				
				setTimeout(function(){
					
					//hide layout button
					jQuery( '.uix-page-builder-gridster-widget' ).each( function() {
						var c = jQuery( this ).find( '.temp-data-1' ).val();
						if ( c.length > 0 ) {
							if ( jQuery( this ).data( 'id' ) == uid ) {
								jQuery( this ).find( '.widget-items-col-container' ).hide();
							}
						}
						
					} );	
				
					
					
				}, 100);
				
				
				
	
			});
		}

			
		/*! 
		 * 
		 * [Gridster] Add a widget HTML code through the existing JSON data
		 * ---------------------------------------------------
		 *
		 * @param  {number} uid            - The widget ID number.
		 * @param  {string} contentid      - The textarea ID of the contents with JSON of each widget.
		 * @param  {string} col            - The index of each column.
		 * @return {string}                - The HTML code for each column
		 */		
		function gridsterItemAddRowPer( uid, contentid, col ) {
			var average_code  = '',
				sid           = contentid.replace( 'content-data-', '' );
			

			if ( col == '3_4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3_4' );?>';
			if ( col == '1_4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1_4' );?>';
			if ( col == '2_3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2_3' );?>';
			if ( col == '1_3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1_3' );?>';
			if ( col == '4__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__1' );?>';
			if ( col == '4__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__2' );?>';
			if ( col == '4__3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__3' );?>';
			if ( col == '4__4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__4' );?>';
			if ( col == '3__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__1' );?>';
			if ( col == '3__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__2' );?>';
			if ( col == '3__3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__3' );?>';
			if ( col == '2__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2__1' );?>';
			if ( col == '2__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2__2' );?>';
			if ( col == '1__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1__1' );?>';
			
			
			return average_code;

		}
		
		/*! 
		 * 
		 * [Gridster] Initialize the widget size
		 * ---------------------------------------------------
		 *
		 * @param  {number} uid            - The widget ID number.
		 * @param  {string} col            - The index of each column.
		 * @return {void}                  - The constructor.
		 */			
		function gridsterWidgetResize( uid, col ) {
			
			var curwidget = jQuery( '#uix-page-builder-gridster-widget-' + uid );
			
			if ( vbmode ) {
				if ( col == '3_4' || col == '1_4' || col == '2_3' || col == '1_3' || col == '2__1' || col == '2__2' ) gridster.resize_widget( curwidget, 1, 2 );
				if ( col == '4__1' || col == '4__2' || col == '4__3' || col == '4__4' ) gridster.resize_widget( curwidget, 1, 4 );
				if ( col == '3__1' || col == '3__2' || col == '3__3' ) gridster.resize_widget( curwidget, 1, 3 );
				if ( col == '1__1' ) gridster.resize_widget( curwidget, 1, 2 );
			}
		}	

			
		/*! 
		 * 
		 * [Gridster] Initialize the widget data with JSON
		 * ---------------------------------------------------
		 *
		 * @param  {string} str            - The content with JSON to add.
		 * @param  {number} uid            - The widget ID number.
		 * @return {void}                  - The constructor.
		 */		
		function gridsterItemRowTextareaInit( str, uid ) {
			jQuery( document ).ready( function() {  
				if ( Object.prototype.toString.call( str ) === '[object Array]' ) {
					
					var result = ''
					    cid    = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];
							
					for( var j in str ) {
						
						for( var i in cid ) {
							if ( str[j].indexOf( cid[i] ) >= 0  ) {
			
								result = str[j];
								result = result.replace( '{'+cid[i]+'}', '' );	
								
								jQuery( '#col-item-'+cid[i]+'---' + uid ).val( gridsterHtmlUnescape( result ) );
								
							}
	
						}
	
					}
			
					
				}

			});
		}
			
		/*! 
		 * 
		 * [Gridster] Format the JSON code before saving the data.
		 * ---------------------------------------------------
		 *
		 * @param  {string} code           - The data with JSON.
		 * @return {string}                - New code.
		 */	
		function gridsterFormatAllCodes( code ) {
			var stringValue = code.toString();
			stringValue = stringValue.replace( /{rqt:}/g, "{rowqt:}")
									.replace( /{cqt:}/g, "{rowcqt:}")
									.replace( /{apo:}/g, "{rowcapo:}")
									.replace( /"/g, "{rowqt:}");
			return stringValue;

		}
			
		/*! 
		 * 
		 * [Gridster] Returns a random widget ID
		 * ---------------------------------------------------
		 *
		 * @return {string}                - A new string.
		 */	
		function gridsterRowUID() {
			return Math.floor( Math.random() * 10000);
		}


			
			
		/*! 
		 * 
		 * Initialize the publish button when current admin page in "Visual Builder" mode
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */	
		function uixPBFormVisualPublish() {
			jQuery( document ).ready( function() {
				
				if ( vbmode ) {	

					jQuery.post( ajaxurl, {
						action               : 'uix_page_builder_publishvisualBuilder_settings',
						postID               : uix_page_builder_layoutdata.send_string_postid,
						security             : uix_page_builder_layoutdata.send_string_nonce
					}, function ( response ) {
						if ( response == 1 ) {
							
							//publish button status
							uixPBFormVisualPublishBtnStatusRestore();
						
						}
					});
					
					
					// stuff here
					return false;		
					
				}
		

			});
			
		}	

			
		/*! 
		 * 
		 * Initialize the publish button status
		 * ---------------------------------------------------
		 *
		 * @return {void}                  - The constructor.
		 */		
		function uixPBFormVisualPublishBtnStatusRestore() {
			jQuery( document ).ready( function() {
				
                //publish button status
				jQuery( '.publish-visual-builder' ).removeClass( 'wait' );
				jQuery( '.publish-visual-builder i' ).attr( 'class', 'dashicons dashicons-yes' );
				setTimeout( function() {
					jQuery( '.publish-visual-builder i' ).attr( 'class', 'dashicons dashicons-edit' );
				}, 1500 );

			});
			
		}		
			
		
        </script>
        
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
		
	
		$layoutdata 	 = wp_unslash( $_POST[ 'uix-page-builder-layoutdata' ] );
		$builderstatus 	 = sanitize_text_field( $_POST[ 'uix-page-builder-status' ] );
		
		
		
		if( isset( $_POST[ 'uix-page-builder-layoutdata' ] ) ) update_post_meta( $post_id, 'uix-page-builder-layoutdata', $layoutdata );
		if( isset( $_POST[ 'uix-page-builder-status' ] ) ) update_post_meta( $post_id, 'uix-page-builder-status', $builderstatus );
		
		
	
	}

}






 