<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/*
 * Add a preview to a Wordpress Control Panel
 *
 * 
 */
if ( !function_exists( 'uix_page_builder_previewControlpanel' ) ) {
	
	add_action( 'init', 'uix_page_builder_previewControlpanel' );		
	function uix_page_builder_previewControlpanel() {
		
		
        if ( is_admin() ) {
			if ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) {
				add_action( 'admin_init', 'uix_page_builder_visualBuilder_init' );
				add_action( 'admin_menu', 'uix_page_builder_remove_redundant_menu' );
				add_action( 'admin_head', 'uix_page_builder_remove_redundant_wapper' );
				add_action( 'admin_head', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options' );
				wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
			}    
        } else {
			if ( isset( $_GET['preview'] ) && $_GET['preview'] == 1 ) {
                add_filter( 'show_admin_bar', '__return_false' );
			}
        }
	
		
	}
}



if ( !function_exists( 'uix_page_builder_previewFrontend' ) ) {
	if ( current_user_can( 'edit_pages' ) ) {
		add_action( 'wp_footer', 'uix_page_builder_previewFrontend' );
	}
	
	function uix_page_builder_previewFrontend() {
		$js = "
		<script type='text/javascript'>										  
		( function($) {
		'use strict';
		
			jQuery.fn.simulateClick = function() {
				return this.each(function() {
					if('createEvent' in document) {
						var doc = this.ownerDocument,
							evt = doc.createEvent('MouseEvents');
						evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
						this.dispatchEvent(evt);
					} else {
						this.click();
					}
				});
			};
		
			$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
				if (results==null){
				   return null;
				}
				else{
				   return results[1] || 0;
				}
			};
			
			$( function() {
			    if ( $.urlParam( 'preview' ) == 1 ) {
				    $( '#wpadminbar' ).css( 'visibility', 'hidden' );
					$( '.uix-page-builder-section' ).css( {
					    'cursor': 'pointer'
					} );
					
					
					$( '.uix-page-builder-section > .uix-pb-row > div' ).on( 'mouseenter', function(){
						$( this ).css( {
							'-webkit-box-shadow': 'none',
							'-moz-box-shadow'   : 'none',
							'box-shadow'        : 'none',
						} );
					}).on( 'mouseleave' , function(){
					
						$( this ).css( {
							'-webkit-box-shadow': 'none',
							'-moz-box-shadow'   : 'none',
							'box-shadow'        : 'none'
						} );
					});
					
					$( '.uix-page-builder-section > .uix-pb-row > div' ).on( 'mouseenter', function() {

						var id         = parseFloat( $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ) ),
							curindex   = $(this).index(),
							obj        = $('#uix-page-builder-gridster-widget-' + id, window.parent.document );

						$('.uix-page-builder-gridster-widget', window.parent.document ).removeClass( 'hover' );
						obj.addClass( 'hover' );

					});	


					$( '.uix-page-builder-section > .uix-pb-row > div' ).on( 'click', function() {

						var id         = parseFloat( $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ) ),
							curindex   = $(this).index(),
							obj        = $('#uix-page-builder-gridster-widget-' + id, window.parent.document );

						obj.find( '.sortable-list > li:eq( '+curindex+' ) .widget-item-btn.used' ).simulateClick( 'click' );

						return false;
					});	
					
					
				}
				
				
				
			}); 
		} ) ( jQuery );
		</script>
		";
		
		echo UixPBFormCore::str_compression( $js );
		
		
	}
}


//Initialize visual builder page 
if ( !function_exists( 'uix_page_builder_visualBuilder_init' ) ) {
	
    function uix_page_builder_visualBuilder_init() {

		$post_ID          = isset( $_GET['post_id'] ) ? $_GET['post_id'] : '';
		$post_url         = esc_url( get_permalink( $post_ID ) );
		$current_user     = wp_get_current_user();
		$current_screen   = get_current_screen();
		$post_type        = get_post_type( $post_ID );
		$user_ID          = isset( $current_user ) && isset( $current_user->ID ) ? (int) $current_user->ID : 0;
		$post_title       = isset( $_GET['post_title'] ) ? $_GET['post_title'] : '';
		$post_title       = str_replace( '{and}', '&', 
							str_replace( '{space}', ' ', 
							str_replace( '%7B', '{', 
							str_replace( '%7D', '}', 
							$post_title 
						   ) ) ) );
		
		
	
		//Create visual builder page
        if ( !current_user_can( 'edit_post', $post_ID ) ) {
            header( 'Location: ' . $post_url );
        }
		
        if ( $post_ID ) {
			
			if ( 'publish' != get_post_status ( $post_ID ) && 'draft' != get_post_status ( $post_ID ) ) {
				$post_data = array(
					'ID'           => $post_ID,
					'post_status'  => 'draft',
					'post_title'   => empty( $post_title ) ? esc_html__( '(no title)', 'uix-page-builder' ) : $post_title,
					'post_content' => '[uix_pb_sections]'
				);
				
				//Using default template
				if ( UixPageBuilder::tempfile_exists() ) {
					update_post_meta( $post_ID, '_wp_page_template', 'page-uix_page_builder.php' );
				}
				
				
			} else {
				
				$content_post = get_post( $post_ID );
				
				$post_data = array(
					'ID'           => $post_ID,
					'post_title'   => empty( $content_post->post_title ) ? esc_html__( '(no title)', 'uix-page-builder' ) : $content_post->post_title,
					'post_content' => empty( $content_post->post_content ) ? '[uix_pb_sections]' : $content_post->post_content
				);
			}
			
			remove_all_actions( 'admin_notices', 3 );
			remove_all_actions( 'network_admin_notices', 3 );
            add_filter( 'wp_insert_post_empty_content', 'uix_page_builder_allowInsertEmptyPost' );
            wp_update_post( $post_data, true );
			
		
        }
		
		
 		
	    //Front-end show
		if ( $post_ID ) {
            
			require_once ABSPATH . 'wp-admin/admin-header.php';
			
		    echo '
			<iframe id="uix-page-builder-themepreview" name="uix-page-builder-themepreview"  frameborder="0" border="0" width="100%" height="100%" src="'.$post_url.'?preview=1"></iframe>
			<a class="uix-page-builder-themepreview-btn" title="'.esc_attr__( 'Hide Sidebar', 'uix-page-builder' ).'" id="uix-page-builder-themepreview-btn-close" href="javascript:"><i class="dashicons dashicons-arrow-left"></i></a>
			';
			
			require_once ABSPATH . 'wp-admin/admin-footer.php';
			
		}
      http://192.168.1.104/1/wp-admin/post.php?post=4139&action=edit
        // Since 4.6 WP version post.php redirects by default to edit.php if no action or custom action defined
        die();
		
		
    }
}

//Used for wp filter 'wp_insert_post_empty_content' to allow empty post insertion.
if ( !function_exists( 'uix_page_builder_allowInsertEmptyPost' ) ) {
	
    function uix_page_builder_allowInsertEmptyPost( $allow_empty ) {
        return false;
    }
}


/*
 * Get URL of visual builder page
 *
 * 
 */
if ( !function_exists( 'uix_page_builder_get_visualBuilder_pageURL' ) ) {
	
    function uix_page_builder_get_visualBuilder_pageURL( $id ) {
        return admin_url( "post.php" ).'?post_id='.$id.'&post_type='.get_post_type( $id ).'&uix_page_builder_visual_mode=1';
    }

}


/*
 * Get URL of normal editor page
 *
 * 
 */
if ( !function_exists( 'uix_page_builder_get_normalEditor_pageURL' ) ) {
	
    function uix_page_builder_get_normalEditor_pageURL( $id ) {
        return admin_url( "post.php" ).'?post='.$id.'&action=edit';
    }

}


/*
 * Remove redundant elements for admin panel of visual builder page
 *
 * 
 */
if ( !function_exists( 'uix_page_builder_remove_redundant_menu' ) ) {
    
	function uix_page_builder_remove_redundant_menu(){
		global $menu;
		$menu = array();
	}

}
if ( !function_exists( 'uix_page_builder_remove_redundant_wapper' ) ) {
		
	function uix_page_builder_remove_redundant_wapper() {
		echo "
		<style type='text/css'>
		#adminmenuwrap, 
		#adminmenuback,
		#wpfooter,
		.notice {
			display: none;
		}
		#wpadminbar {
		    visibility: hidden;
		}
		#wpcontent, #footer {
			margin-left: 15px;
		}
		html, body {
		    overflow: hidden;
		}
		</style>
		<div id='uix-page-builder-visualBuilder-loader'><div class='loader single'></div></div>
		";
	}
}



/*
 * Save live-render data with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_savevisualBuilder' ) ) {
	add_action( 'wp_ajax_uix_page_builder_savevisualBuilder_settings', 'uix_page_builder_savevisualBuilder' );		
	function uix_page_builder_savevisualBuilder() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'layoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			
			$layoutdata 	 = wp_unslash( $_POST[ 'layoutdata' ] );
			$pagetemp 	     = sanitize_text_field( $_POST[ 'pageTemp' ] );
			$builderstatus 	 = 'disable';

			//Show page builder core assets of "Pages Add New Screen"
			if ( UixPageBuilder::SHOWPAGESCREEN == 1 ) {
				$builderstatus 	 = 'enable';
			}
			
			update_post_meta( $_POST[ 'postID' ], 'uix-page-builder-layoutdata', $layoutdata );
			update_post_meta( $_POST[ 'postID' ], 'uix-page-builder-status', $builderstatus );
			update_post_meta( $_POST[ 'postID' ], '_wp_page_template', $pagetemp );
			
			echo 1;
		}
		
		
		wp_die();	
	}
}


/*
 * Publish live-render data with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_publishvisualBuilder' ) ) {
	add_action( 'wp_ajax_uix_page_builder_publishvisualBuilder_settings', 'uix_page_builder_publishvisualBuilder' );		
	function uix_page_builder_publishvisualBuilder() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'postID' ] ) ) {
			
			$post_data = array(
				'ID'           => $_POST[ 'postID' ],
				'post_status'  => 'publish'
			);
			
            wp_update_post( $post_data, true );
			
			echo 1;
		}
		
		
		wp_die();	
	}
}



