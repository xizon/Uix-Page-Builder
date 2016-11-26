<?php
/**
 * Uix Page Builder
 *
 * @author UIUX Lab <uiuxlab@gmail.com>
 *
 *
 * Plugin name: Uix Page Builder
 * Plugin URI:  https://uiux.cc/wp-plugins/uix-page-builder/
 * Description: Uix Page Builder is a design system that it is simple content creation interface.
 * Version:     1.0.0
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-page-builder
 * Domain Path: /languages
 */

class UixPageBuilder {
	
	const PREFIX = 'uix';
	const HELPER = 'uix-page-builder-helper';
	const NOTICEID = 'uix-page-builder-helper-tip';
	const CUSTOMTEMP = 'uix-page-builder-sections/sections/';

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
	    self::setup_constants();
		self::includes();
		self::uixpbform_core();
		
		
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_filter( 'body_class', array( __CLASS__, 'new_class' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_sections' ) );
		add_action( 'admin_notices', array( __CLASS__, 'template_notice_required' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		
	
	}
	
	/**
	 * Setup plugin constants.
	 *
	 */
	public static  function setup_constants() {

		// Plugin Folder Path.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_DIR' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_URL' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_FILE' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_FILE', __FILE__ );
		}
	}

	/*
	 * Include required files.
	 *
	 *
	 */
	public static function includes() {
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/post-extensions/post-extensions-init.php';
	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Main stylesheets and scripts to Front-End
		if ( self::tempfolder_exists() ) {
			wp_enqueue_style( self::PREFIX . '-page-builder', get_template_directory_uri() .'/uix-page-builder-sections/css/uix-page-builder.css', false, self::ver(), 'all' );	
			wp_enqueue_script( self::PREFIX . '-page-builder', get_template_directory_uri() .'/uix-page-builder-sections/js/uix-page-builder.js', array( 'jquery', 'masonry', 'shuffle', 'flexslider' ), self::ver(), true );	
				
		} else {
			wp_enqueue_style( self::PREFIX . '-page-builder', self::plug_directory() .'uix-page-builder-sections/css/uix-page-builder.css', false, self::ver(), 'all' );	
			wp_enqueue_script( self::PREFIX . '-page-builder', self::plug_directory() .'uix-page-builder-sections/js/uix-page-builder.js', array( 'jquery', 'masonry', 'shuffle', 'flexslider' ), self::ver(), true );	
			

		}
			
		

	}
	
	

	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		 if( get_post_type() == 'page' ) {
			  
				if ( is_admin()) {
					
						//Drag and drop
						wp_enqueue_script( self::PREFIX . '-gridster', self::plug_directory() .'admin/js/jquery.gridster.min.js', array( 'jquery' ), '0.5.6', true );	
						wp_enqueue_style( self::PREFIX . '-gridster', self::plug_directory() .'admin/css/jquery.gridster.css', false, '0.5.6', 'all');
						
						//Main
						wp_enqueue_style( self::PREFIX . '-page-builder', self::plug_directory() .'admin/css/style.css', false, self::ver(), 'all');

				}
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-page-builder', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
		

	}
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
	
		if ( mb_strlen( strpos( $str, $incstr ), 'UTF8' ) > 0 ) {
			return true;
		} else {
			return false;
		}

	}


	/*
	 * Create customizable menu in backstage  panel
	 *
	 * Add a submenu page
	 *
	 */
	 public static function options_admin_menu() {
		 
		//Add a top level menu page.
		add_menu_page(
			__( 'Uix Page Builder Settings', 'uix-page-builder' ),
			__( 'Uix Page Builder', 'uix-page-builder' ),
			'manage_options',
			self::HELPER,
			'uix_page_builder_options_page',
			'dashicons-editor-kitchensink',
			'82.' . rand( 0, 99 )
			
		);
	
        //Add sub links
		add_submenu_page(
			self::HELPER,
			__( 'Helper', 'uix-page-builder' ),
			__( 'Helper', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER
		);	
		
		// remove the "main" submenue page
		remove_submenu_page( self::HELPER, self::HELPER );
			
			
	 }
	
	
	
	
	/*
	 * Load helper
	 *
	 */
	 public static function load_helper() {
		 
		 require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'helper/settings.php';
	 }
	
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-page-builder' ) . '</a>';
		return $links;
	}
	

	
	
	/*
	 * Get plugin slug
	 *
	 *
	 */
	public static function get_slug() {

         return dirname( plugin_basename( __FILE__ ) );
	
	}
	
	

	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_directory() {

	  return plugin_dir_url( __FILE__ );

	}
	
	/*
	 * Callback the plugin file path
	 *
	 *
	 */
	public static function plug_filepath() {

	  return WP_PLUGIN_DIR .'/'.self::get_slug();

	}	
	

	/*
	 * Returns current plugin version.
	 *
	 *
	 */
	public static function ver() {
	
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_folder = get_plugins( '/' . self::get_slug() );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];


	}
	

	
	/*
	 * Extend the default WordPress body classes.
	 *
	 *
	 */
	public static function new_class( $classes ) {
	
	    global $uix_page_builder_temp;
        if ( $uix_page_builder_temp === true ) { 
			$classes[] = 'uix-page-builder-body';
		}
		
		return $classes;

	}
	
	
		
	
	/*
	 * Sort multiple or multi-dimensional arrays for page builder
	 *
	 */
	public static function pagebuilder_array_newlist( $arr ) {
		
		$data = esc_textarea( $arr );
		$data = str_replace( '&quot;col&quot;', '"col"',
		       str_replace( '&quot;row&quot;', '"row"',
			   str_replace( '&quot;size_x&quot;', '"size_x"',
			   str_replace( '&quot;size_y&quot;', '"size_y"',
			   str_replace( '&quot;,&quot;title&quot;:&quot;', '","title":"',
			   str_replace( '&quot;content&quot;:&quot;', '"content":"',
			   str_replace( '&quot;}', '"}',
			   $data 
			   ) ) ) ) ) ) );
			   
		if ( isset( $data ) ) {
			
			$old_arr = json_decode( $data );
			$new_list = array();
			if ( is_array( $old_arr ) ) {
				foreach( $old_arr as $key => $value ){
					$new_list[] = $value->row;
				}
				array_multisort( $new_list, SORT_ASC, $old_arr );
				
				return $old_arr;

			} else {
				return '';
			}

		}
		
	}
	
	/*
	 * Output content of page builder
	 *
	 */	
	public static function pagebuilder_output( $arr ) {
		
		$data = wp_specialchars_decode( $arr );
		$data = 	str_replace( '$__$', '"',
				str_replace( '$___$', '&#039;',
				str_replace( '$____$', '&quot;',
				str_replace( '$_br_$', '<br>',
		        str_replace( '&#039;', "'",
		        str_replace( '&quot;', '"',
			    str_replace( '&apos;', "'",

				
			    $data 
			    ) ) ) ) ) ) );
				
		if ( !is_admin() ) {
			$data = 	str_replace( '&lt;br&gt;', '<br>', $data );	
		}
			   
		return json_decode( $data, true );
		
	}		
		
	public static function pagebuilder_item_name( $str ) {
		
		if( self::inc_str( $str, '|' ) ) {
			$nstr = explode( '|', $str );
			$result = $nstr[1];
		} else {
			$result  = $str;
		}
			
		
	
			   
		return $result;
		
	}			

	/*
	 * Checks whether a template folder or directory exists
	 *
	 *
	 */
	public static function tempfolder_exists() {

	      if( is_dir( get_stylesheet_directory() . '/uix-page-builder-sections' ) ) {
			  return true;
		  } else {
			  return false;
		  }

	}
	
	
	
	/*
	 * Call the specified page sections
	 *
	 *
	 */
	public static function call_sections( $name ) {
		
		if( get_post_type() == 'page' ) {
			
			if ( self::tempfolder_exists() ) {
				include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";
				foreach ( $uix_pb_config as $key ) {
					include get_stylesheet_directory(). "/".self::CUSTOMTEMP."".$key[ 'id' ].".php";
				}

			} else {
				include self::plug_filepath(). "/".self::CUSTOMTEMP."config.php";
				foreach ( $uix_pb_config as $key ) {
					include self::plug_filepath(). "/".self::CUSTOMTEMP."".$key[ 'id' ].".php";
				}
			}
		
		 }
  
	}
	
	
	public static function call_sections_frontend() {
		
		if ( self::tempfolder_exists() ) {
			include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";

		} else {
			include self::plug_filepath(). "/".self::CUSTOMTEMP."config.php";
		}
		
	}
	
	
	
	/**
	 * List buttons of page sections 
	 * 
	 */
	public static function list_page_buttons() {
	
		if ( self::tempfolder_exists() ) {
			include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";
		} else {
			include self::plug_filepath(). "/".self::CUSTOMTEMP."config.php";
		}
		
		foreach ( $uix_pb_config as $key ) {
			echo "<a class=\"widget-item-btn ".$key[ 'id' ]."\" data-name=\"".esc_attr( $key[ 'title' ] )."\" data-id=\"'+uid+'\" href=\"javascript:\">".$key[ 'title' ]."</a>";
		}	


	}
		
		
	/*
	 * Returns form name
	 *
	 *
	 */
	public static function fname( $form_id, $field ) {
		return $form_id.'|['.$field.']{index}';
	}
			
	/*
	 * Returns form value
	 *
	 *
	 */
	public static function fvalue( $section_row, $arr, $field, $default = '', $clonemax = 0 ) {
		
		if ( is_array( $arr ) && array_key_exists( '['.$field.']['.$section_row.']', $arr ) ) {
			return $arr[ '['.$field.']['.$section_row.']' ];
		} else {
			return $default;
		}
		
		
		//If it is clone list
		if ( $clonemax > 0 ) {

			for ( $i = 0; $i <= $clonemax; $i++ ) {
				$uid = ( $i == 0 ) ? '' : $i.'-';
				
				if ( is_array( $arr ) && array_key_exists( '['.$uid.''.$field.']['.$section_row.']', $arr ) ) {
					return $arr[ '['.$uid.''.$field.']['.$section_row.']' ];
				} else {
					return $default;
				}
				
			}
			
	
		}
	
	}
	
	/*
	 * Push the clone form of saved data
	 *
	 *
	 */
	public static function push_cloneform( $clone_trigger_id, $cur_id, $clone_value, $section_row, $value, $clone_list_toggle_class = '' ) {
		
		$toggle_target_ID  = str_replace( '{dataID}', ''.$cur_id.'-', $clone_list_toggle_class );
		$widget_ID         = $section_row;
		
		//Clone content
		$data = '<span class="dynamic-row dynamic-addnow">'.$clone_value.'<div class="delrow-container"><a href="javascript:" class="delrow delrow-'.$clone_trigger_id.'">&times;</a></div></span>';
	
		$data = str_replace( 'data-list="0"', 'data-list="1"',
			   str_replace( 'toggle-row', 'toggle-row toggle-row-clone-list',
			   $data 
			   ) );
			   
		
		//Clone code
		$data = str_replace( '{index}', '['.$widget_ID.']',
		       str_replace( 'data-id="', 'id="'.$cur_id.'-',
			   str_replace( '|[', '|['.$cur_id.'-',
			   str_replace( '{dataID}', ''.$cur_id.'-',
			   str_replace( '{multID}', $toggle_target_ID,
			   $data 
			   ) ) ) ) );
		
		//Default value
		if ( $value && is_array( $value ) ) {
			foreach ( $value as $t_value ) {
				$data = str_replace( $t_value[ 'replace' ], $t_value[ 'default' ], $data );
			}	
		}
			   
		echo "<script type='text/javascript'>jQuery(document).uixpbform_dynamicFormInit({cloneCode:'{$data}'});</script>";
	}
	
			
	/*
	 * Returns the clone toggle target id
	 *
	 *
	 */
	public static function get_clone_toggle_target_id( $toggle_class ) {
		
		if ( $toggle_class && is_array( $toggle_class ) ) {
			$toggle_target_id = '';
			foreach ( $toggle_class as $tid_value ) {
				$tid_value = str_replace( 'dynamic-row-', '', $tid_value );
				$toggle_target_id .= '#{dataID}'.$tid_value.','; 	
				
			}	
			
			$toggle_target_id = rtrim( $toggle_target_id, ',' );
				   
			return $toggle_target_id;
	
		}
		
	}
						
			
	/*
	 *  Add admin one-time notifications
	 *
	 *
	 */
	
	public static function template_notice_required() {
		
		if( get_post_type() == 'page' ) {
			if( !self::tempfile_exists() ) {
				echo '
					<div class="error notice">
						<p>' . __( '<strong>You need to create Uix Page Builder template files in your templates directory. You can create the files on the WordPress admin panel.</strong>', 'uix-page-builder' ) . ' <a class="button button-primary" href="' . admin_url( "admin.php?page=".self::HELPER."&tab=temp" ) . '">' . __( 'Create now!', 'uix-page-builder' ) . '</a><br>' . __( 'As a workaround you can use FTP, access the Uix Page Builder template files path <code>/wp-content/plugins/uix-page-builder/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-page-builder' ) . '</p>
					</div>
				';
		
			}
		}
	
	}	
	
	
	public static function nag_ignore() {
		    global $current_user;
			$user_id = $current_user->ID;
			
			/* If user clicks to ignore the notice, add that to their user meta */
			if ( isset( $_GET[ self::NOTICEID ]) && '0' == $_GET[ self::NOTICEID ] ) {
				 add_user_meta( $user_id, self::NOTICEID, 'true', true);

				if ( wp_get_referer() ) {
					/* Redirects user to where they were before */
					wp_safe_redirect( wp_get_referer() );
				} else {
					/* This will never happen, I can almost gurantee it, but we should still have it just in case*/
					wp_safe_redirect( home_url() );
				}
		    }
	}
	
	/*
	 * Checks whether a template file or directory exists
	 *
	 *
	 */
	public static function tempfile_exists() {

	      if( !file_exists( get_stylesheet_directory() . '/page-uix_page_builder.php' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}	
		
		
	
	/*
	 * Returns template files directory
	 *
	 *
	 */
	public static function list_templates_name( $show = 'plug' ){
	
		
		$filenames = array();
		$filepath = WP_PLUGIN_DIR .'/'.self::get_slug(). '/theme_templates/';
		$themepath = get_stylesheet_directory() . '/';
		
		foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
		    $filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		}	
		
		echo '<ul>';
		
		foreach ( $filenames as $filename ) {
			$file1 = trailingslashit( $filepath ) . $filename;
			
			$file2 = trailingslashit( $themepath ) . $filename;	
			
			if ( $show == 'plug' ) {
				echo '<li>'.trailingslashit( $filepath ) . $filename.'</li>';
			} else {
				echo '<li>'.trailingslashit( $themepath ) . $filename.'</li>';
			}
			
		}	
		
		echo '</ul>';
			
	}	 

	
	
	/*
	 * Copy/Remove template files to your theme directory
	 *
	 *
	 */
	
	public static function templates( $nonceaction, $nonce, $remove = false ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath = WP_PLUGIN_DIR .'/'.self::get_slug(). '/theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  

		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = $filepath; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
	
				foreach ( $filenames as $filename ) {
					
				    // Copy
					if ( ! file_exists( $themepath . $filename ) ) {
						
						$dir1 = $wp_filesystem->find_folder( $filepath );
						$file1 = trailingslashit( $dir1 ) . $filename;
						
						$dir2 = $wp_filesystem->find_folder( $themepath );
						$file2 = trailingslashit( $dir2 ) . $filename;
									
						$filecontent = $wp_filesystem->get_contents( $file1 );
	
						$wp_filesystem->put_contents( $file2, $filecontent, FS_CHMOD_FILE );
						
			
					} 
					
					// Remove
					if ( $remove ) {
						if ( file_exists( $themepath . $filename ) ) {
							
							$dir = $wp_filesystem->find_folder( $themepath );
							$file = trailingslashit( $dir ) . $filename;
							
							$wp_filesystem->delete( $file, false, FS_CHMOD_FILE );
							
				
						} 
						
	
					}
				}
				
				if ( !$remove ) {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-page-builder' );
					} else {
						return __( '<div class="notice notice-error"><p><strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-page-builder' );
					}
	
				} else {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-error"><p><strong>There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-page-builder' );
						
					} else {
						return __( '<div class="notice notice-success"><p>Remove successful!</p></div>', 'uix-page-builder' );
					}	
					
				}
				
		
				
				
		  } 
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	 
            $output = "";
			$wpnonce_url = 'edit.php?post_type=uix_pagebuilder&page='.UixPageBuilder::HELPER;
			$wpnonce_action = 'temp-filesystem-nonce';

            if ( !empty( $_POST ) ) {
				
				
                  $output = UixPageBuilder::wpfilesystem_write_file( $wpnonce_action, $wpnonce_url, 'helper/', 'debug.txt', 'This is test.' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( $wpnonce_action );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-page-builder' ).'"  /></p>';
				
			}
	 *
	 */
	public static function wpfilesystem_connect_fs( $url, $method, $context, $fields = null) {
		  global $wp_filesystem;
		  if ( false === ( $credentials = request_filesystem_credentials( $url, $method, false, $context, $fields) ) ) {
			return false;
		  }
		
		  //check if credentials are correct or not.
		  if( !WP_Filesystem( $credentials ) ) {
			request_filesystem_credentials( $url, $method, true, $context);
			return false;
		  }
		
		  return true;
	}
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() ).$path; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-page-builder' );
				
		  } 
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() ).$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_template_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return '';
				}
		
		
		  } 
	}	 	
				
		
	/*
	 * Uix Form Core
	 *
	 *
	 */
	public static function uixpbform_core() {
	
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/add-ons/uixpbform/init.php';

	}
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
