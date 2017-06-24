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

			}    
        } else {
			if ( isset( $_GET['pb_preview'] ) && $_GET['pb_preview'] == 1 ) {
                add_filter( 'show_admin_bar', '__return_false' );
			}
        }
	
		
	}
}


if ( !function_exists( 'uix_page_builder_previewFrontend' ) ) {
	if ( current_user_can( 'edit_pages' ) ) {
		add_action( 'wp_head', 'uix_page_builder_previewFrontend' );
	}
	
	function uix_page_builder_previewFrontend() {
		$code = "
		<style type='text/css'>
		.uix-page-builder-editicon {
			display: none;
			text-align: center;
			position: absolute;
			left: 15px;
			top: 15px;
			z-index: 999999;
			background-color: #2C7EAE;
			width: 35px;
			height: 35px;
			font-size: 16px;
			margin: auto;
			color: #fff;
			cursor: pointer;
			-webkit-border-radius: 100%; 
			-moz-border-radius: 100%; 
			border-radius: 100%;
			-webkit-box-shadow: 0px 1px 12px 0px rgba(36, 104, 143,0.34);
			-moz-box-shadow: 0px 1px 12px 0px rgba(36, 104, 143,0.34);
			box-shadow: 0px 1px 12px 0px rgba(36, 104, 143,0.34);
			-webkit-animation:  pbicon .2s linear forwards;
			animation: pbicon .2s linear forwards;

		}
		.uix-page-builder-editicon .fa {
		    margin-top: 12px;
			color: #fff;
		}
		
		.uix-page-builder-section > .uix-pb-row > div {
		    position: relative;
		}
		.uix-page-builder-section > .uix-pb-row > div:hover .uix-page-builder-editicon {
		    display: block;
		}
		
		.uix-page-builder-section .editmode {
			position: relative;
			z-index: 999998 !important;
		}

		@-webkit-keyframes pbicon {
			0%   { 
				-webkit-transform: scale(0);
				-ms-transform: scale(0);
				transform: scale(0);
			}
			100% {
				-webkit-transform: scale(1);
				-ms-transform: scale(1);
				transform: scale(1);
			}
		}
		@keyframes pbicon {
			0%   { 
				-webkit-transform: scale(0);
				-ms-transform: scale(0);
				transform: scale(0);
			}
			100% {
				-webkit-transform: scale(1);
				-ms-transform: scale(1);
				transform: scale(1);
			}
		}
		</style>
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
			
			    if ( $.urlParam( 'pb_preview' ) == 1 ) {
				    $( '#wpadminbar' ).css( 'visibility', 'hidden' );

					$( '.uix-page-builder-section > .uix-pb-row > div' ).each( function( index ) {
					    var id         = parseFloat( $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ) ),
							curindex   = $(this).index(),
							obj        = $('#uix-page-builder-gridster-widget-' + id, window.parent.document );
				
						
					    $( this ).append(  '<a data-id=\"'+id+'\" data-index=\"'+curindex+'\" class=\"uix-page-builder-editicon\" href=\"javascript:void(0);\" role=\"button\"><i class=\"fa fa-edit\"></i></a>' );
					});
						
					
					$( '.uix-page-builder-section > .uix-pb-row > div' ).on( 'mouseenter', function(){
					    
						var id         = parseFloat( $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ) ),
							curindex   = $(this).index(),
							obj        = $('#uix-page-builder-gridster-widget-' + id, window.parent.document );

						$('.uix-page-builder-gridster-widget', window.parent.document ).removeClass( 'hover' );
						obj.addClass( 'hover' );
						
						$( this ).find( '> div' ).addClass( 'editmode' );

						$( this ).css( {
							'-webkit-box-shadow': 'none',
							'-moz-box-shadow'   : 'none',
							'box-shadow'        : 'none',
						} );
						
						
						
					}).on( 'mouseleave' , function(){
					
						$( this ).find( '> div' ).removeClass( 'editmode' );
						
						$( this ).css( {
							'-webkit-box-shadow': 'none',
							'-moz-box-shadow'   : 'none',
							'box-shadow'        : 'none'
						} );
					});
					

					$( '.uix-page-builder-editicon' ).on( 'click', function() {

						var id         = parseFloat( $( this ).data( 'id' ) ),
							index      = parseFloat( $( this ).data( 'index' ) ),
							obj        = $('#uix-page-builder-gridster-widget-' + id, window.parent.document );
						
						obj.find( '.sortable-list > li:eq( '+index+' ) .widget-item-btn.used' ).simulateClick( 'click' );

						return false;
					});	
					
					
				}
				
				
				
			}); 
		} ) ( jQuery );
		</script>
		";
		
		echo UixPBFormCore::str_compression( $code );
		
		
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
			<script type="text/html" id="uix_page_builder_viewport_preview_tmpl">
				 <'.tag_escape( 'iframe' ).' id="uix-page-builder-themepreview" name="uix-page-builder-themepreview"  frameborder="0" border="0" width="100%" height="100%" src="<%=url%>"></'.tag_escape( 'iframe' ).'>
			</script>	
			<div id="uix-page-builder-viewport-preview-container"></div>
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
			
			$id              = $_POST[ 'postID' ];
			$layoutdata 	 = wp_unslash( $_POST[ 'layoutdata' ] );
			$pagetemp 	     = sanitize_text_field( $_POST[ 'pageTemp' ] );
			$builderstatus 	 = 'disable';

			//Show page builder core assets of "Pages Add New Screen"
			if ( UixPageBuilder::SHOWPAGESCREEN == 1 ) {
				$builderstatus 	 = 'enable';
			}
			
			update_post_meta( $id, 'uix-page-builder-layoutdata', $layoutdata );
			update_post_meta( $id, 'uix-page-builder-status', $builderstatus );
			update_post_meta( $id, '_wp_page_template', $pagetemp );
			
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



