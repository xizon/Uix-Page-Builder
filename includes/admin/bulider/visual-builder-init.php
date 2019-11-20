<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Add a preview to a Wordpress Control Panel
 *
 * @since 0.2.0
 */
if ( !function_exists( 'uix_page_builder_previewControlPanel' ) ) {
	
	add_action( 'init', 'uix_page_builder_previewControlPanel' );		
	function uix_page_builder_previewControlPanel() {
		
        if ( is_admin() ) {
			if ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) {
				add_action( 'admin_init', 'uix_page_builder_visualBuilder_init' );
				add_action( 'admin_menu', 'uix_page_builder_remove_redundant_menu' );
				add_action( 'admin_head', 'uix_page_builder_remove_redundant_wapper' );
				add_action( 'admin_head', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options' );
				
				//Fix Gutenberg register error
				// As early as possible, but after any plugins ( ACF ) that adds meta boxes.
				remove_action( 'admin_head', 'gutenberg_collect_meta_box_data', 99 );

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
		
        .uix-page-builder-section.admin > .uix-pb-row > [class^=\"uix-pb-col-\"]:hover:before {
            box-shadow: 0 0 0 1px #357797;
            display: block;
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            pointer-events: none;
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
		

		.uix-page-builder-editicon.active:after {
			position: absolute;
			left: -8px;
			top: -8px;
			z-index: 1000000;
			content: '';
			display: block;
			width: 50px;
			height: 50px;
			-webkit-border-radius: 100%; 
			-moz-border-radius: 100%;
			border-radius: 100%;
			border-style: solid;
			-webkit-animation: pbloader 500ms linear infinite;
			animation: pbloader 500ms linear infinite;
			border-width: 1px;
			border-color: #2C7EAE transparent transparent;			

		}


		@-webkit-keyframes pbloader {
			to {
				transform: rotate(360deg);
			}
		}

		@keyframes pbloader {
			to {
				transform: rotate(360deg);
			}
		}


		</style>
		";
		
		echo UixPageBuilder::str_compression( $code );
		
		
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
					'post_title'   => empty( $post_title ) ? UixPageBuilder::get_page_title_default() : $post_title,
					'post_content' => '[uix_pb_sections id="'.esc_attr( $post_ID ).'"]'
				);
				
				//Using default template
				if ( UixPageBuilder::tempfile_exists() ) {
					update_post_meta( $post_ID, '_wp_page_template', 'tmpl-uix_page_builder.php' );
				}
				
				
			} else {
				
				$content_post = get_post( $post_ID );
				
				$post_data = array(
					'ID'           => $post_ID,
					'post_title'   => empty( $content_post->post_title ) ? UixPageBuilder::get_page_title_default() : $content_post->post_title,
					'post_content' => empty( $content_post->post_content ) ? '[uix_pb_sections id="'.esc_attr( $post_ID ).'"]' : $content_post->post_content
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
			<div id="uix-page-builder-viewport-preview-tmpl"></div>
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
if ( !function_exists( 'uix_page_builder_saveLiveRender' ) ) {
	add_action( 'wp_ajax_uix_page_builder_saveLiveRender_settings', 'uix_page_builder_saveLiveRender' );		
	function uix_page_builder_saveLiveRender() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'layoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			
			$post_ID         = $_POST[ 'postID' ];
			$layoutdata 	 = UixPageBuilder::format_layoutdata_add_tempname( $post_ID, wp_unslash( $_POST[ 'layoutdata' ] ) );
			$builderstatus 	 = 'disable';

			//Show page builder core assets of "Pages Add New Screen"
			if ( UixPageBuilder::SHOWPAGESCREEN == 1 ) {
				$builderstatus 	 = 'enable';
			}
			
			update_post_meta( $post_ID, 'uix-page-builder-layoutdata', $layoutdata );
			update_post_meta( $post_ID, 'uix-page-builder-status', $builderstatus );
			
			
			echo 1;
		}
		
		
		wp_die();	
	}
}



/*
 * Save WP page template with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_savePageTemplate' ) ) {
	add_action( 'wp_ajax_uix_page_builder_savePageTemplate_settings', 'uix_page_builder_savePageTemplate' );		
	function uix_page_builder_savePageTemplate() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'postID' ] ) ) {
			
			$post_ID         = $_POST[ 'postID' ];
			$pagetemp 	     = sanitize_text_field( $_POST[ 'pagetemp' ] );

			update_post_meta( $post_ID, '_wp_page_template', $pagetemp );
			
			echo 1;
		}
		
		
		wp_die();	
	}
}



/*
 * Publish live-render data with ajax 
 * 
 */
if ( !function_exists( 'uix_page_builder_publishLiveRender' ) ) {
	add_action( 'wp_ajax_uix_page_builder_publishLiveRender_settings', 'uix_page_builder_publishLiveRender' );		
	function uix_page_builder_publishLiveRender() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'postID' ] ) ) {
			
			$post_ID      = $_POST[ 'postID' ];
			$post_title   = $_POST[ 'postTitle' ];
			
			if ( empty( $post_title ) ) {
				$post_title = sanitize_title( UixPageBuilder::get_page_title_default() );
			}
			
			$post_data = array(
				'ID'           => $post_ID,
				'post_title'   => $post_title,
				'post_name'    => $post_title,
				'post_status'  => 'publish'
			);
			
            wp_update_post( $post_data, true );
			
			echo 1;
		}
		
		
		wp_die();	
	}
}




