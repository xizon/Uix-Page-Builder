<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  WP Menu Extensions: One-page
 *
 */
if ( !class_exists( 'UixPB_Menu_Extensions_Onepage' ) ) {
	class UixPB_Menu_Extensions_Onepage {
	
	
		public static function init() {
			add_action( 'admin_init', array( __CLASS__, 'nav_menu_meta_box' ) );
			add_action( 'wp_ajax_uix_page_builder_anchorlinks_save_settings', array( __CLASS__, 'save' ) );
			add_action( 'admin_head-nav-menus.php', array( __CLASS__, 'enqueue_menu_page_scripts' ) );
		}
	
	
	   /**
		 * Enqueue required CSS and JS
		 */
		public static function enqueue_menu_page_scripts() {
	
			// Register the script
			wp_register_script( 'uix_page_builder_anchorlinks_save_handle', UixPageBuilder::plug_directory() .'includes/admin/assets/js/admin-menu.js', array( 'jquery' ), UixPageBuilder::ver(), true );
		
			wp_localize_script( 'uix_page_builder_anchorlinks_save_handle', 'uix_page_builder_anchorlinks_data', array(
				'send_string_nonce' => wp_create_nonce( 'uix_page_builder_anchorlinks_save_nonce' ),
			) );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_page_builder_anchorlinks_save_handle' );

		}	
	
		/**
		 * Save the mega menu settings (submitted from Menus Page Meta Box)
		 *
		 */
		public static function save() {
			
			check_ajax_referer( 'uix_page_builder_anchorlinks_save_nonce', 'security' );
			
			if ( isset( $_POST[ 'postID' ] ) ) {
				
				$post_ID           = $_POST[ 'postID' ];
				$builder_content   = UixPageBuilder::page_builder_array_newlist( UixPageBuilder::get_page_final_data( $post_ID ) );
				$item              = array();
				$cols              = array( 
										array( '3_4', 'uix-pb-col-9' ),
										array( '1_4', 'uix-pb-col-3' ),
										array( '2_3', 'uix-pb-col-8' ),
										array( '1_3', 'uix-pb-col-4' ),
										array( '4__1', 'uix-pb-col-3' ),
										array( '4__2', 'uix-pb-col-3' ),
										array( '4__3', 'uix-pb-col-3' ),
										array( '4__4', 'uix-pb-col-3' ),
										array( '3__1', 'uix-pb-col-4' ),
										array( '3__2', 'uix-pb-col-4' ),
										array( '3__3', 'uix-pb-col-4' ),
										array( '2__1', 'uix-pb-col-6' ),
										array( '2__2', 'uix-pb-col-6' ),
										array( '1__1', 'uix-pb-col-12' )
									);
				
				if ( $builder_content && is_array( $builder_content ) ) {
					
					echo '
					<div class="tabs-panel tabs-panel-active">
						<ul class="categorychecklist form-no-clear">
					';
					
		
					foreach ( $builder_content as $key => $value ) :
					
					
						$con                  = UixPageBuilder::page_builder_output( $value->content );
						$col                  = $value->col;
						$row                  = $value->row;
						$size_x               = $value->size_x;
						$section_id           = $value->secindex;
					    $section_id_sub       = UixPageBuilder::convert_random_string( $section_id );
						$custom_id            = $value->customid;
						$section_title        = $value->title;
						$element_code         = '';
						$element_grid_before  = '';
						$element_grid_after   = '</div>';

						if ( empty( $custom_id ) ) $custom_id = 'uix-page-builder-section-'.$row;


						if ( $con && is_array( $con ) ) {
							foreach ( $con as $key ) :

								${$key[0]} = $key[ 1 ];
								$item[ UixPageBuilder::page_builder_item_name( $key[0] ) ]  =  $key[ 1 ];
							endforeach;
						}

						//------------------------------------   loop sections
						if ( sizeof( $item ) > 3 && !empty( $value->content ) ) {

							$col_content   = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );

							if ( $col_content && is_array( $col_content ) ) {
								foreach ( $col_content as $key => $value ) :

									$colid           = $value[0][1]; //column id
									$temp_index      = count( $value ) - 1;

									$bool1 = UixPageBuilder::inc_str( $value[ $temp_index ][0], '_temp' );
									$bool2 = UixPageBuilder::inc_str( $value[ $temp_index ][0], 'uix_pb_module_undefined' );

									if ( $bool1 || $bool2 ) {

										$value = UixPageBuilder::theme_value( $value[$temp_index][1] );
										$html = ( !empty( $value ) ) ? $value : '&nbsp;';

										//Determine the grid system
										foreach ( $cols as $id ) :
											if ( $colid == $id[0] ) {
												$element_grid_before = '<div class="'.$id[1].' {last}">';
											}
										endforeach;

										$element_code .= $element_grid_before.$html.$element_grid_after;	


									}



								endforeach;

								echo '
								<li>
									<label class="menu-item-title">
										<input type="checkbox" class="menu-item-checkbox" name="menu-item['.esc_attr( $section_id_sub ).'][menu-item-object-id]" value="'.esc_attr( $section_id ).'"> '.$section_title.'<br><span class="custom-prop"><strong>'.__( 'ID', 'uix-page-builder' ).':</strong> '.$custom_id.'</span>
									</label>
									<input type="hidden" class="menu-item-type" name="menu-item['.esc_attr( $section_id_sub ).'][menu-item-type]" value="custom">
									<input type="hidden" class="menu-item-title" name="menu-item['.esc_attr( $section_id_sub ).'][menu-item-title]" value="'.esc_attr( $section_title ).'">
									<input type="hidden" class="menu-item-url" name="menu-item['.esc_attr( $section_id_sub ).'][menu-item-url]" value="#'.esc_attr( $custom_id ).'">
									<input type="hidden" class="menu-item-classes" name="menu-item['.esc_attr( $section_id_sub ).'][menu-item-classes]" value="nav-anchor">
								</li>
								';

							}


						}

					
						//------------------------------------ end sections
		
						
				
					endforeach;
					
					echo '
						</ul>
					</div>
					';		
			
			
				}
					
	
			}
			
	
			wp_die();
	
		}	
		
	
	
	
	
		/**
		 * Adding meta box in Admin Menu page
		 *
		 * @https://developer.wordpress.org/reference/functions/add_meta_box/
		 *
		 */
		public static function nav_menu_meta_box() {
			add_meta_box( 
				'uix-pb-menu-onepage-links',
				__( 'Uix Page Builder Anchor Links', 'uix-page-builder' ),
				array( __CLASS__, 'display_menu_custom_box' ),
				'nav-menus', 
				'side', 
				'high' 
			);
		}
	
		 
		public static function display_menu_custom_box() {
 
			
			 ?>
                <p>
                <select style=" width: 100%;" id="uix-page-builder-anchorlinks"> 
                 <option value="">
                <?php echo esc_attr( __( 'Select page', 'uix-page-builder' ) ); ?></option> 
                 <?php 
				$pages = get_pages(); 
				$pb_total = 0;
				foreach ( $pages as $page ) {

					if ( get_page_template_slug( $page->ID ) ==  'tmpl-uix_page_builder.php' || UixPageBuilder::inc_str( $page->post_content, '[uix_pb_sections' ) ) {
						$option = '<option value="'.esc_attr( $page->ID ).'">';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
						
						$pb_total = $pb_total + 1;
	
					}
				
				}
                 ?>
                </select>
                
                </p>    
             <?php
			 if ( $pb_total == 0 ) {
				 _e( '<em>No custom pages based on Uix Page Builder.</em>', 'uix-page-builder' );
				 
			 } else {
				 printf( __( '<div style="background:#FCDBD6;border:1px solid #ECD5D8;-webkit-box-shadow:0 1px 1px 0 rgba(255,255,255,.1);box-shadow:0 1px 1px 0 rgba(255,255,255,.1);margin:5px 2px 12px 0;padding:8px 12px;border-color:#f5df52;background:#fcf7d4;box-shadow:inset 0 0 0 1px #ffffff,0 0 10px 0 rgba(0,0,0,0.05);"><strong>Usage Suggestions:</strong><br><br> Click on <a href="%1$s">Settings &raquo; Reading</a>. Select the option of Static Page, now select one of your page based on "Uix Page Builder" to be the homepage.</div>', 'uix-page-builder' ), esc_url( admin_url( 'options-reading.php' ) ) );
			?>
                <span id="uix_page_builder_anchorlinks_loader" style="display: none"><?php echo __( 'Loading...', 'uix-page-builder' ); ?></span>
				<div id="posttype-uix_page_builder_anchorlinks_options" class="posttypediv">

				    <span id="uix-page-builder-anchorlinks-result"></span>

					<p class="button-controls">
                        <span id="uix-page-builder-anchorlinks-selectall" style="display: none">
                            <span class="list-controls">
                                <a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&amp;selectall=1#posttype-uix_page_builder_anchorlinks_options' ) ); ?>" class="select-all"><?php _e( 'Select All', 'uix-page-builder' ); ?></a>
                            </span>

                        </span>
						<span class="add-to-menu" id="uix-page-builder-anchorlinks-addbtn" style="display: none">
							<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php echo esc_attr__( 'Add to Menu', 'uix-page-builder' ); ?>" name="add-post-type-menu-item" id="submit-posttype-uix_page_builder_anchorlinks_options">
							<span class="spinner"></span>
						</span>
					</p>
				</div>
			<?php
			 }
			
		}
		
	}
		
	
}


UixPB_Menu_Extensions_Onepage::init();
