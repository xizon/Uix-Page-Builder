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
 * Version:     1.4.3
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-page-builder
 * Domain Path: /languages
 */

/*--------------------------------------------------------
 * Some of the easily confusing Variable Terms in the plugin: 
 *
 * 1) form ID      ->  Obtained via module ID.
 * 2) section ID   ->  Obtained via gridster widget ID.
 * 3) section      ->  Each page module of front-end HTML code. (It is not a page builder module in admin panel.)
 * 4) module       ->  The page builder forms and front-end rendering.
 * 5) template     ->  The JSON final data of each page.

*/

class UixPageBuilder {
	
	const PREFIX           = 'uix';
	const HELPER           = 'uix-page-builder-helper';
	const NOTICEID         = 'uix-page-builder-helper-tip';
	const SHOWPAGESCREEN   = 0; // Show page builder core assets from "Pages Add New Screen" when this value is "1" (For developer)

	/**
	 * Modules path of template directory with admin panel, not recommend changing it
	 *
	 * For admin panel only, template directory name of front-end can use filter "uixpb_templates_filter"
	 *
	 */
	const CUSTOMTEMP       = 'uixpb_templates/modules/';


	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
	    self::setup_constants();
		self::includes();
		
		
		add_action( 'init', array( __CLASS__, 'register_scripts' ) );
		add_action( 'init', array( __CLASS__, 'load_classes_core' ) );
		add_action( 'init', array( __CLASS__, 'load_components_core' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ), 99999 );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_modules' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'print_custom_stylesheet' ) );
		//add_action( 'admin_notices', array( __CLASS__, 'usage_notice_app' ) );
	
	}
	
	/**
	 * Setup plugin constants.
	 *
	 */
	public static  function setup_constants() {

		// Plugin Folder Path.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_DIR' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_URL' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		}

		// Plugin Root File.
		if ( ! defined( 'UIX_PAGE_BUILDER_PLUGIN_FILE' ) ) {
			define( 'UIX_PAGE_BUILDER_PLUGIN_FILE', trailingslashit( __FILE__ ) );
		}
	}

	/*
	 * Include required files.
	 *
	 *
	 */
	public static function includes() {
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'includes/admin/general.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'includes/admin/bulider/post-extensions-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'includes/admin/bulider/visual-builder-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'includes/uixpbform/init.php';	
	}
	
	
	/*
	 * Load all core classes in the directory
	 *
	 */
	 public static function load_classes_core() {

		foreach ( glob( UIX_PAGE_BUILDER_PLUGIN_DIR. "includes/classes/*.php") as $file ) {
			include $file;
		}

		foreach ( glob( UIX_PAGE_BUILDER_PLUGIN_DIR. "includes/classes/section-shortcodes/*.php") as $file ) {
			include $file;
		} 

	 }
		
	/*
	 * Load all core components in the directory
	 *
	 */
	 public static function load_components_core() {

		foreach ( glob( UIX_PAGE_BUILDER_PLUGIN_DIR. "includes/admin/bulider/components/*.php") as $file ) {
			include $file;
		}

	 }	
	
	
	
	
	
	/*
	 * Register scripts and styles.
	 *
	 *
	 */
	public static function register_scripts() {
		
		// Core
		wp_register_script( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'js/'.self::frontpage_core_js_name(), array( 'jquery' ), self::ver(), true );
		wp_register_script( self::PREFIX . '-page-builder-plugins', self::backend_path( 'uri' ).'js/uix-page-builder-plugins.js', false, self::ver(), true );
		wp_register_style( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'css/'.self::frontpage_core_css_name(), false, self::ver(), 'all' );
		wp_localize_script( self::PREFIX . '-page-builder',  'wp_theme_root_path', array( 
			'templateUrl' => get_stylesheet_directory_uri()
		 ) );
			

		// Shuffle
		wp_register_script( 'shuffle', self::plug_directory() .'includes/admin/assets/add-ons/shuffle/jquery.shuffle.js', array( 'jquery' ), '3.1.1', true );

		// Shuffle.js requires Modernizr..
		wp_register_script( 'modernizr', self::plug_directory() .'includes/admin/assets/add-ons/HTML5/modernizr.min.js', false, '3.3.1', false );

		// Easy Pie Chart
		wp_register_script( 'easypiechart', self::plug_directory() .'includes/admin/assets/add-ons/piechart/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.7', true );
		
		//flexslider
		wp_register_script( 'flexslider', self::plug_directory() .'includes/admin/assets/add-ons/flexslider/jquery.flexslider.min.js', array( 'jquery' ), '2.5.0', true );
		wp_register_style( 'flexslider', self::plug_directory() .'includes/admin/assets/add-ons/flexslider/flexslider.css', false, '2.5.0', 'all' );
		
		// Parallax
		wp_register_script( 'bgParallax', self::plug_directory() .'includes/admin/assets/add-ons/parallax/jquery.bgParallax.js', array( 'jquery' ), '1.1.3', true );

		

	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Core
		if ( 
			file_exists( self::backend_path( 'dir' ).'css/uix-page-builder.css' ) || 
			file_exists( self::backend_path( 'dir' ).'css/uix-page-builder.min.css' ) 
		) {
			wp_enqueue_style( self::PREFIX . '-page-builder' );
		}
		
		if ( 
			file_exists( self::backend_path( 'dir' ).'js/uix-page-builder.js' ) || 
			file_exists( self::backend_path( 'dir' ).'js/uix-page-builder.min.js' ) 
		) {
			wp_enqueue_script( self::PREFIX . '-page-builder' );	
		}		
		
		
		//Plugins
		if ( file_exists( self::backend_path( 'dir' ).'js/uix-page-builder-plugins.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-page-builder-plugins' );	
		} else {

			wp_enqueue_script( 'shuffle' );
			wp_enqueue_script( 'modernizr' );
			wp_enqueue_script( 'easypiechart' );
			wp_enqueue_script( 'flexslider' );
			wp_enqueue_style( 'flexslider' );
			wp_enqueue_script( 'bgParallax' );

							  
		}
		

	}
	

	/*
	 * Returns the front-end core files's name
	 *
	 *
	 */
	public static function frontpage_core_js_name() {

		$name = 'uix-page-builder.js';
		
		if ( file_exists( self::backend_path( 'dir' ).'js/uix-page-builder.min.js' ) ) {
			$name = 'uix-page-builder.min.js';
		}
		
		return $name;
		
	}
	
	public static function frontpage_core_css_name() {

		$name = 'uix-page-builder.css';
		
		if ( file_exists( self::backend_path( 'dir' ).'css/uix-page-builder.min.css' ) ) {
			$name = 'uix-page-builder.min.css';
		}
		
		return $name;
		
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
		
		$incstr = str_replace( '(', '\(',
				  str_replace( ')', '\)',
				  str_replace( '|', '\|',
				  str_replace( '*', '\*',
				  str_replace( '+', '\+',
			      str_replace( '.', '\.',
				  str_replace( '[', '\[',
				  str_replace( ']', '\]',
				  str_replace( '?', '\?',
				  str_replace( '/', '\/',
				  str_replace( '^', '\^',
			      str_replace( '{', '\{',
				  str_replace( '}', '\}',	
				  str_replace( '$', '\$',
			      str_replace( '\\', '\\\\',
				  $incstr 
				  )))))))))))))));
			
		if ( !empty( $incstr ) ) {
			if ( preg_match( '/'.$incstr.'/', $str ) ) {
				return true;
			} else {
				return false;
			}
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
		 
		 
		 
		add_submenu_page(
			self::HELPER,
			__( 'How to use?', 'uix-page-builder' ),
			__( 'How to use?', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=usage'
		);	  
		 
		add_submenu_page(
			self::HELPER,
			__( 'Template Files', 'uix-page-builder' ),
			__( 'Template Files', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=temp'
		);	 
		 
		add_submenu_page(
			self::HELPER,
			__( 'Custom CSS', 'uix-page-builder' ),
			__( 'Custom CSS', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=custom-css'
		);	 
		 
		 
		 
		add_submenu_page(
			self::HELPER,
			__( 'For Theme Developer', 'uix-page-builder' ),
			__( 'For Theme Developer', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=for-developer'
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
	 * Generates the template name created by the current builder
	 *
	 *
	 */
	public static function get_tempname( $slug = false, $auto = true, $customid = '' ) {

		$random = uniqid();
		if ( !empty( $customid ) ) $random = $customid;
		
		if ( $auto ) {
			$id = self::get_session_current_postid();
			if ( !empty( $customid ) ) $id = $customid;

			if ( empty( $id ) ) {
				$tempname = sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $random );
			} else {
				$tempname = self::get_session_default_tempname( $id );
			}
			
		} else {
			$tempname = sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $random );	
		}

	
		
		if ( $slug ) {
			return sanitize_title_with_dashes( $tempname );
		} else {
			return $tempname;
		}
		
		
	
	}
	

	/*
	 * Get session for current post ID (Used only in the background panel)
	 *
	 *
	 */
	public static function get_session_current_postid() {
		
		if( ! isset( $_SESSION ) ) session_start();
		if( array_key_exists( 'uix-page-builder-current-postid', $_SESSION ) && !empty( $_SESSION[ 'uix-page-builder-current-postid' ] ) ) {
			return $_SESSION[ 'uix-page-builder-current-postid' ];	
		} else {
			return '';
		}

	}
	
	
	/*
	 * Define session for current post ID (Used only in the background panel)
	 *
	 *
	 * The following only one condition will reset the new session value:
	 *   a) Load the page builder panel for the first time when entering the page.
	 *
	 */
	public static function session_current_postid( $str ) {
		
		if( ! isset( $_SESSION ) ) session_start();
		$_SESSION[ 'uix-page-builder-current-postid' ] = $str;

	}
	
	
	/*
	 * Remove session for current post ID (Used only in the background panel)
	 *
	 *
	 */
	public static function unset_session_current_postid() {
		
		if( ! isset( $_SESSION ) ) session_start();
		unset( $_SESSION[ 'uix-page-builder-current-postid' ] );

	}
	
	
	

	/*
	 * Get session for the template name
	 *
	 *
	 */
	public static function get_session_default_tempname( $id ) {
		
		if( ! isset( $_SESSION ) ) session_start();
		if( array_key_exists( 'uix-page-builder-tempname' . $id, $_SESSION ) && !empty( $_SESSION[ 'uix-page-builder-tempname' . $id ] ) ) {
			return $_SESSION[ 'uix-page-builder-tempname' . $id ];	
		} else {
			return '';
		}

	}
	
	
	/*
	 * Define session for the template name
	 *
	 *
	 * The following two conditions will reset the new session value:
	 *   a) Initialize template with ajax when manually select the template later.
	 *   b) Load the page builder panel for the first time when entering the page.
	 *
	 */
	public static function session_default_tempname( $str, $id ) {
		
		if( ! isset( $_SESSION ) ) session_start();
		$_SESSION[ 'uix-page-builder-tempname' . $id ] = $str;

	}
	
	
	/*
	 * Remove session for the template name
	 *
	 *
	 */
	public static function unset_session_default_tempname( $id ) {
		
		if( ! isset( $_SESSION ) ) session_start();
		unset( $_SESSION[ 'uix-page-builder-tempname' . $id ] );

	}
	
	
	/*
	 * Convert the template image path
	 *
	 * "{temp_preview_thumb_path}" of template(.xml) variable was deprecated after version 1.3.7 (included), 
	 * and it is compatible with older versions.
	 *
	 */
	public static function convert_img_path( $str, $type ) {
		
		if ( $type == 'load' ) {

			$str = str_replace( '{temp_placeholder_path}', self::get_img_path( 'placeholder' ),
				   str_replace( '{temp_preview_thumb_path}', self::get_img_path( 'thumb' ),
				   $str 
				   ) );

		} elseif ( $type == 'save' ) {
			$str = str_replace( self::get_img_path( '', 1 ), '{temp_placeholder_path}', //step 4
				   str_replace( self::get_img_path( '', 2 ), '{temp_placeholder_path}', //step 3
				   str_replace( self::get_img_path( 'thumb' ), '{temp_preview_thumb_path}', //step 2
				   str_replace( self::get_img_path( 'placeholder' ), '{temp_placeholder_path}', //step 1
				   $str 
				   ) ) ) );	
		}
		   

		
		return $str;

	}
	
	
	/*
	 * Returns the template image path
	 *
	 *
	 */
	public static function get_img_path( $type = 'thumb', $dircontrol = '' ) {
		
		// When this folder "UixPageBuilderTmpl" of your theme exists, it is preferred to use it as a premade images in the template.
		// ( Highest priority )
		$theme_assets_folder_dir         = get_stylesheet_directory() . '/assets';
		
		if ( is_dir( $theme_assets_folder_dir ) ) {
			$theme_assets_folder_name = 'assets/';
		} else {
			$theme_assets_folder_name = '';
		}
		
		$temp_img_folder_dir             = get_stylesheet_directory() . '/'.$theme_assets_folder_name.'images/UixPageBuilderTmpl';
		$temp_preview_thumb_folder_dir   = get_stylesheet_directory() . '/'.$theme_assets_folder_name.'images/UixPageBuilderThumb';

		
		if ( $type == 'thumb' ) {
			$str = is_dir( $temp_preview_thumb_folder_dir ) ? get_template_directory_uri() . '/'.$theme_assets_folder_name.'' : self::backend_path( 'uri' );
		} elseif ( $type == 'placeholder' ) {
			$str = is_dir( $temp_img_folder_dir ) ? get_template_directory_uri() . '/'.$theme_assets_folder_name.'' : self::backend_path( 'uri' );
		}
		
		
		//Force the path to prevent the system from recognizing automatically
		if ( $dircontrol == 1 ) {
			$str = get_template_directory_uri() . '/'.$theme_assets_folder_name.'';
		}
		if ( $dircontrol == 2 ) {
			$str = self::backend_path( 'uri' );
		}
		   
		
		return $str;

	}
	
	
	/*
	 * Returns the module thumbnails path
	 *
	 *
	 */
	public static function module_thumbnails_path() {

		return '{temp_placeholder_path}images/UixPageBuilderThumb/tmpl/_default.jpg';

	}
	
	
	
	
	/**
	 * Returns the template directory name in order to your current theme.
	 *
	 * Themes can filter this by using the "uixpb_templates_filter" filter.
	 * 
	 */
	public static function get_theme_template_dir_name() {

		return untrailingslashit( apply_filters( 'uixpb_templates_filter', 'uixpb_templates' ) );
	}

	
	/**
	 * Returns the modules path of template directory in order to your current theme.
	 *
	 * Output:  uixpb_templates/modules/
	 *
	 * 
	 */
	public static function get_theme_template_modules_path() {

		return trailingslashit( self::get_theme_template_dir_name().'/modules' );
	}	
	
	
	
	/*
	 * Returns custom back-end panel directory or directory URL
	 *
	 *
	 */
	public static function backend_path( $type = 'uri' ) {
		
		$theme_template_dir_name = self::get_theme_template_dir_name();
		
		if ( self::tempfolder_exists() ) {
			
			
			if ( file_exists( get_template_directory() .'/'.$theme_template_dir_name.'/css/uix-page-builder.css' ) ) {
				if ( $type == 'uri' )  {
					return get_template_directory_uri() .'/'.$theme_template_dir_name.'/';
				} else {
					return get_template_directory() .'/'.$theme_template_dir_name.'/';
				}
			}

			if ( file_exists( get_template_directory() .'/assets/css/uix-page-builder.css' ) ) {
				if ( $type == 'uri' )  {
					return get_template_directory_uri() .'/assets/';
				} else {
					return get_template_directory() .'/assets/';
				}
			}
			
		} else {
			
			if ( $type == 'uri' )  {
				return self::plug_directory() .'uixpb_templates/';
			} else {
				return self::plug_filepath() .'uixpb_templates/';
				
			}
		}

	}
	

	/*
	 * Callback the plugin directory URL
	 *
	 *
	 */
	public static function plug_directory() {

	  return UIX_PAGE_BUILDER_PLUGIN_URL;

	}
	
	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_filepath() {

	  return UIX_PAGE_BUILDER_PLUGIN_DIR;

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
	 * Print Custom Stylesheet
	 *
	 */
	 public static function print_custom_stylesheet( $uix_pb_frontend_css = null ) {
      
		$custom_css = get_option( 'uix_pb_opt_cssnewcode' );
		
		if ( !empty( $uix_pb_frontend_css ) ) {
			$custom_css = $custom_css.$uix_pb_frontend_css;
		}

		wp_add_inline_style( self::PREFIX . '-page-builder', $custom_css );
		
		return $uix_pb_frontend_css;


	 }

		
	/*
	 * Check whether it is "uix-page-builder" visual mode
	 *
	 */
	 public static function page_builder_mode() {
        

		//Show page builder core assets of "Pages Add New Screen" & call "UixPBFormCore" class on "Pages Add New Screen".
		if ( self::SHOWPAGESCREEN == 1 ) {
			if ( ( get_post_type() == 'page' ) || ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			if ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) {
				return true;
			} else {
				return false;
			}	
		}
		 
	 }
	
	
	/*
	 * Check whether it is "uix-page-builder" general mode
	 *
	 */
	 public static function page_builder_general_mode() {

		if ( ( get_post_type() == 'page' ) || ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) ) {
			return true;
		} else {
			return false;
		}


	 }
	
	
	/*
	 * Check whether it is "Visual Builder" mode
	 *
	 *
	 */
	public static function vb_mode() {

	      if ( isset( $_GET['uix_page_builder_visual_mode'] ) && $_GET['uix_page_builder_visual_mode'] == 1 ) {
			  return true;
		  } else {
			  return false;
		  }

	}	
	
	
	
	/*
	 * Sort multiple or multi-dimensional arrays for page builder
	 *
	 */
	public static function page_builder_array_newlist( $json_code_pb_encode ) {
		
		//Format the JSON code (remove value of "tempname" and "wp_page_template" )
		$json_code_pb_encode = self::format_render_codes_remove_non_layoutattributes( $json_code_pb_encode );

	
		$data = esc_textarea( $json_code_pb_encode );
		$data = str_replace( '&quot;col&quot;', '"col"', 
		       str_replace( '&quot;row&quot;', '"row"',
			   str_replace( '&quot;size_x&quot;', '"size_x"',
			   str_replace( '&quot;size_y&quot;', '"size_y"',
			   str_replace( '&quot;,&quot;title&quot;:&quot;', '","title":"',
			   str_replace( '&quot;content&quot;:&quot;', '"content":"',
			   str_replace( '&quot;,&quot;secindex&quot;:&quot;', '","secindex":"',
			   str_replace( '&quot;,&quot;customid&quot;:&quot;', '","customid":"',
			   str_replace( '&quot;,&quot;layout&quot;:&quot;', '","layout":"',
			   str_replace( '&quot;}', '"}',
			   $data 
			   ) ) ) ) ) ) ) ) ) );
			   
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
	 * Returns the template name from the template data
	 *
	 */
	public static function page_builder_array_tempattrs( $json_code_pb_encode, $slug = false, $attr = 0 ) {
		
		
		$data = esc_textarea( $json_code_pb_encode );
		$data = str_replace( '&quot;tempname&quot;:&quot;', '"tempname":"',
				str_replace( '&quot;wp_page_template&quot;:&quot;', '"wp_page_template":"',
				str_replace( '&quot;col&quot;', '"col"', 
		       str_replace( '&quot;row&quot;', '"row"',
			   str_replace( '&quot;size_x&quot;', '"size_x"',
			   str_replace( '&quot;size_y&quot;', '"size_y"',
			   str_replace( '&quot;,&quot;title&quot;:&quot;', '","title":"',
			   str_replace( '&quot;content&quot;:&quot;', '"content":"',
			   str_replace( '&quot;,&quot;secindex&quot;:&quot;', '","secindex":"',
			   str_replace( '&quot;,&quot;customid&quot;:&quot;', '","customid":"',
			   str_replace( '&quot;,&quot;layout&quot;:&quot;', '","layout":"',
			   str_replace( '&quot;}', '"}',
			   $data 
			   ) ) ) ) ) ) ) ) ) ) ) );
		
	
		//Get template name
		if ( $attr == 0 ) {
			if ( self::inc_str( $data, '"tempname"' ) ) {
				$newstr   = json_decode( $data, true );
				$tempattr = $newstr[0]['tempname'];

			} else {
				$tempattr  = '';
			}	
		}
		
		//Get WP page template
		if ( $attr == 1 ) {
			if ( self::inc_str( $data, '"wp_page_template"' ) ) {
				$newstr   = json_decode( $data, true );
				$tempattr = $newstr[1]['wp_page_template'];

			} else {
				$tempattr = '';
			}	
		}
		

		
		
		if ( $slug ) {
			return sanitize_title_with_dashes( $tempattr );
		} else {
			return $tempattr;
		}	
	
		
		
	}
	
	
	
	/*
	 * Returns pre row content
	 *
	 *
	 */
	public static function prerow_value( $arr ) {
		
		if ( is_array( $arr ) && sizeof( $arr ) > 3 ) {
			return $arr[ 'rowcontent' ];
		} else {
			return '';
		}
	}
	
	
	/*
	 * Format the JSON code before output the render viewport. 
	 * It is used for HTML code of separated rendering.
	 *
	 */	
	public static function format_render_codes( $str ) {
		
		//Returns string in order to protect the security output of JSON
		return  str_replace( '{rowcsql:}', '[', 
				str_replace( '{rowcsqr:}', ']',
				$str 
			   ) );			   
		
	}	
	
	
	/*
	 * Format the JSON code (remove value of "tempname" and "wp_page_template" )
	 *
	 */	
	public static function format_render_codes_remove_non_layoutattributes( $json_code ) {
		
		// Value of "tempname" is class for the <body> of each builder content
		if ( self::inc_str( $json_code, '"tempname"' ) || self::inc_str( $json_code, '"wp_page_template"' ) ) {
			$result  = '';
			$newstr  = json_decode( $json_code, true );
			
			//Remove non-layout arrays
			if ( self::inc_str( $json_code, '"tempname"' ) && !self::inc_str( $json_code, '"wp_page_template"' ) ) {
				unset( $newstr[0] );
			} elseif ( self::inc_str( $json_code, '"tempname"' ) && self::inc_str( $json_code, '"wp_page_template"' ) ) {
				unset( $newstr[0] );
				unset( $newstr[1] );
			}
		
			$total   = count( $newstr ) + 1;

			$result .= '[';

			for ( $i = 1; $i <= $total; $i++ ) {
				
				//Need to be compatible with old data
				if ( isset( $newstr[ $i ] ) ) {
					$result .= json_encode( $newstr[ $i ] ).',';
				}
				
			}

			$result = rtrim( $result, ',' );
			$result .= ']';

		} else {
			$result = $json_code;
		}

		
		return $result;	

	}	

    //add value of "tempname" and "wp_page_template"
	public static function format_layoutdata_add_tempname( $id, $str, $custom = '' ) {
		
		$custom_name = $custom;

		if ( empty( $custom_name ) ) $custom_name = self::get_tempname();
		
		
		//Format the JSON code (remove value of "tempname" and "wp_page_template" )
		$str             = self::format_render_codes_remove_non_layoutattributes( $str );
		$json_tempname   = '{"tempname":"'.$custom_name.'"},';
		$json_pagetemp   = '{"wp_page_template":"'.get_post_meta( $id, '_wp_page_template', true ).'"},';
		$json_layoutdata = ltrim( rtrim( $str, ']' ), '[' );
		$newstr        = '['.$json_tempname.$json_pagetemp.$json_layoutdata.']';
		
		return $newstr;	

	}
	
	/*
	 * Output content of page builder
	 *
	 */	
	public static function page_builder_output( $json_code ) {
		
		$data = wp_specialchars_decode( $json_code );
		$data = str_replace( '{rqt:}', '"',
				str_replace( '{apo:}', '&#039;',
				str_replace( '{cqt:}', '&quot;',
		        str_replace( '&#039;', "'",
		        str_replace( '&quot;', '"',
			    str_replace( '&apos;', "'",
							
				//Clear duplicate "&"
				str_replace( 'amp;', '',  //step 2
				str_replace( '&amp;', '&', //step 1
						
				
			    $data 
			    ) ) ) ) ) ) ) );
				
		
		//Format the JSON code before output the render viewport.
		if ( !is_admin() ) {
			$data = self::format_render_codes( $data );
		}
			   
		return json_decode( $data, true );
		
	}		
		
	
	
		
	public static function page_builder_analysis_rowcontent( $json_code ) {
		
		$data = str_replace( '{rowqt:}', '"',
			    $json_code 
			    );
		return json_decode( $data );
		
		
	}		
		
	public static function page_builder_item_name( $str ) {
		
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
		
		  $theme_template_dir_name = self::get_theme_template_dir_name();

	      if( is_dir( get_stylesheet_directory() . '/'.$theme_template_dir_name ) ) {
			  return true;
		  } else {
			  return false;
		  }

	}
	
	
	/**
	 * Converts the letters of random strings to numbers so that the array subscripts can be recognized.
	 *
	 */
	public static function convert_random_string( $str ) {
	
	
		//Case sensitive
		$str = str_replace(
			array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),	array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52'),
			$str 
		
		);
		
		return $str;

	}
	
	
	/*
	 * Call the specified page modules
	 *
	 *
	 */
	public static function call_modules( $name ) {
		
		if( self::page_builder_mode() ) {
			
			if ( self::tempfolder_exists() ) {
				
				$theme_template_modules_path = self::get_theme_template_modules_path();
			
				
				include get_stylesheet_directory(). "/".$theme_template_modules_path."config.php";
				foreach ( $uix_pb_config as $v ) {
					foreach ( $v[ 'buttons' ] as $key ) {
						
						if ( !empty( $key[ 'id' ] ) ) {
							$keyid = str_replace( '.php', '', $key[ 'id' ] );

							if ( file_exists( get_stylesheet_directory(). "/".$theme_template_modules_path."".$keyid.".php" ) ) {
								include get_stylesheet_directory(). "/".$theme_template_modules_path."".$keyid.".php";
							}		
						}

						
					}						
				}

			} else {
				include self::plug_filepath().self::CUSTOMTEMP."config.php";
				
				foreach ( $uix_pb_config as $v ) {
					foreach ( $v[ 'buttons' ] as $key ) {
						
						
						if ( !empty( $key[ 'id' ] ) ) {
							$keyid = str_replace( '.php', '', $key[ 'id' ] );

							if ( file_exists( self::plug_filepath().self::CUSTOMTEMP."".$keyid.".php" ) ) {
								include self::plug_filepath().self::CUSTOMTEMP."".$keyid.".php";
							}		
						}

						
					}						
				}
			}
		
		 }
  
	}
	
	
	public static function call_modules_frontend() {
		
		if ( self::tempfolder_exists() ) {
			
			$theme_template_modules_path = self::get_theme_template_modules_path();
			
			include get_stylesheet_directory(). "/".$theme_template_modules_path."config.php";

		} else {
			include self::plug_filepath().self::CUSTOMTEMP."config.php";
		}
		
	}
	

	
		
	/*
	 * Returns textarea & input value
	 *
	 *
	 */
	public static function inputtextareavalue( $str ) {
		
		$result = str_replace( '{rowcapo:}', "'",
			 	 str_replace( '{rowcqt:}', '"',

			    $str
			    ) );	
				
				
		return $result;
		
	
	}	
	
	
	/*
	 * Returns theme template value
	 *
	 *
	 */
	public static function theme_value( $str ) {
		$result = str_replace( '{rowcapo:}', "'",
			 	 str_replace( '{rowcqt:}', '"',
			    $str
			    ) );	
				
		//Required, The js escaped characters will can not be correctly output because the speed of bandwidth.
		$result = str_replace( '&lt;', "<",
				str_replace( '&gt;', ">",
				$result 
				) ); 
		
		return $result;
		
	
	}
	
	
	/*
	 * Returns wrapper ID from per column in the front end
	 *
	 *
	 */
	public static function frontend_wrapper_id( $str, $section_id = '', $column_id = '' ) {
	
		$column_id = str_replace( 'col-item-', '', $column_id );
		$id        = '';

		if ( !empty( $str ) ) {
			$id = $str;
		} else {
			$id = 'section_'.str_replace( 'section-', '', $section_id ).'__'.$column_id;
		}
		
		if ( self::inc_str( $id, '---' ) ) {
			$arr = split ( '\-\-\-', $id ); 
			return $arr[0];
		} else {
			return $id;
		}	
		

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
	 * Color transform
	 *
	 *
	 */
	public static function color_tran( $str ) {
		
		switch( $str ) {
			case '#a2bf2f':
				return 'green';

			  break;
			case '#d59a3e':
				return 'yellow';

			  break;

			case '#DD514C':
				return 'red';	 
			  break;

			case '#FA9ADF':
				return 'pink';	

			  break;

			case '#4BB1CF':
				return 'blue'; 
			  break;

			case '#0E90D2':
				return 'darkblue'; 
			  break;	  


			case '#5F9EA0':
				return 'cadetblue';
			  break;

			case '#473f3f':
				return 'black';
			  break;


			case '#bebebe':
				return 'gray';
			  break;       

			case '#ffffff':
				return 'white';
			  break;      
				
			default:

		}
	}
	
	
	/*
	 * Append associative array elements
	 *
	 *
	 */
	public static function array_push_associative(&$arr) {
	   $args = func_get_args();
	   $ret  = null;
	   foreach ($args as $arg) {
		   if (is_array($arg)) {
			   foreach ($arg as $key => $value) {
				   $arr[$key] = $value;
				   $ret++;
			   }
		   }else{
			   $arr[$arg] = "";
		   }
	   }
	   return $ret;
	}	
	
	
	
	/*
	 * Delete element from multidimensional-array based on value
	 *
	 *
	 */
	function remove_element_withvalue($array, $key, $value){
		 foreach($array as $subKey => $subArray){
			  if($subArray[$key] == $value){
				   unset($array[$subKey]);
			  }
		 }
		 return $array;
	}
	
	
	/*
	 * Decode template for shortcode attributes
	 *
	 *
	 */
	public static function decode( $str ) {


         if ( $str ) {
			 $restr = str_replace( '&#8217;', '\'',
					   str_replace( '&#8221;', '"',
					   str_replace( '&apos;', '\'',
					   str_replace( '&quot;', '"',
					   wp_specialchars_decode( $str )
					   ))));
					   
	 
		 } else {
		    $restr = $str;
		 }
		 
		 return $restr;

	}
	
	
	
	
	/*
	 * HTML tags like "<li>","<ul>","<ol>" transform
	 *
	 *
	 */
	public static function html_listTran( $str, $type = 'li' ) {
		
		$newstr = '';
		
		if ( !empty( $str ) ) {
			if ( self::inc_str( $str, '<br>' ) ) {
				$strarr = explode( '<br>', $str );

				foreach ( $strarr as $value ) {

					if ( self::inc_str( $value, '<'.$type.'>' ) ) {
						$newstr .= $value;
					} else {
						$newstr .= '<'.$type.'>'.$value.'</'.$type.'>';
					}


				}	
			} else {

				if ( self::inc_str( $str, '<'.$type.'>' ) ) {
					$newstr = $str;
				} else {
					$newstr = '<'.$type.'>'.$str.'</'.$type.'>';
				}


			}
		}
		
		$newstr = str_replace( '<'.$type.'></'.$type.'>', '', $newstr );
		
		
		return $newstr;
		
	}
	
	/*
	 * Transform string to slug for filterable categories
	 *
	 *
	 */
	public static function transform_slug( $str ) {
	
		return sanitize_title( $str );

	}
	
	
	
	
	/*
	 *  Add admin one-time notifications
	 *
	 *
	 */
	public static function usage_notice_app() {
		
		if( self::page_builder_general_mode() ) {
		
			global $current_user ;
			$user_id = $current_user->ID;

			/* Check that the user hasn't already clicked to ignore the message */
			if ( ! get_user_meta( $user_id, self::NOTICEID ) ) {


				if( !self::tempfile_exists() ) {
					echo '<div class="notice notice-warning"><p>';
					printf( 
						__('You could <a class="button button-small" href="%s">create</a> Uix Page Builder template file (from the directory <strong>"/wp-content/plugins/uix-page-builder/uixpb_templates/tmpl-uix_page_builder.php"</strong> ) in your templates directory.  ', 'uix-page-builder' ), 
						admin_url( "admin.php?page=".self::HELPER."&tab=temp" )
					);
					printf( __( '<a href="%1$s">Hide Notice</a>' ), '?post_type='.self::get_slug().'&'.self::NOTICEID.'=0');
					echo '</p></div>';

				}
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
	 * Checks whether a template file exists from your current theme.
	 *
	 *
	 */
	public static function tempfile_exists() {

	      if( !file_exists( get_stylesheet_directory() . '/tmpl-uix_page_builder.php' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}	
		
	
	/*
	 * Checks whether the modules template file(.xml) exists from your current theme.
	 *
	 *
	 */
	public static function tempfile_modules_exists() {
		
		  $theme_template_dir_name = self::get_theme_template_dir_name();

	      if( !file_exists( get_stylesheet_directory() . '/'.$theme_template_dir_name.'.xml' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}	
		
	/*
	 * Returns the modules template file(.xml) directory or directory URL
	 *
	 * Templates file: 
	 * 
	 *  a) /wp-content/plugins//uixpb_templates/modules/templates.xml  
	 *  b) /wp-content/plugins/{your-theme}/uixpb_templates/modules/templates.xml  
	 *  c) /wp-content/themes/{your-theme}/uixpb_templates.xml
	 *
	 */
	public static function tempfile_modules_path( $type = 'uri', $locate = 'all', $folder = false ) {
		
		$theme_template_dir_name = self::get_theme_template_dir_name();
		$theme_name              = $theme_template_dir_name.'.xml';
		$plug_name               = 'templates.xml';
		
		if ( $folder ) {
			$theme_name = '';
			$plug_name  = '';
		}
		
		
		//Plugin or Theme
		if ( $locate == 'all' ) {
			if ( self::tempfile_modules_exists() ) {

				if ( $type == 'uri' )  {
					return get_template_directory_uri() .'/'.$theme_name;
				} else {
					return get_template_directory() .'/'.$theme_name;
				}

			} else {

				if ( $type == 'uri' )  {
					return self::backend_path( 'uri' ).'modules/'.$plug_name;
				} else {
					return self::backend_path( 'dir' ).'modules/'.$plug_name;
				}

			}	
		}

		
		//Only Plugin
		if ( $locate == 'plug' ) {
			if ( $type == 'uri' )  {
				return self::backend_path( 'uri' ).'modules/'.$plug_name;
			} else {
				return self::backend_path( 'dir' ).'modules/'.$plug_name;
			}	
		}
		
		//Only Theme
		if ( $locate == 'theme' ) {
			if ( $type == 'uri' )  {
				return get_template_directory_uri() .'/'.$theme_name;
			} else {
				return get_template_directory() .'/'.$theme_name;
			}
		}
		

	}	
	
	
	/*
	 * Returns template files directory
	 *
	 *
	 */
	public static function list_templates_name( $show = 'plug' ){
	
		$filenames               = array();
		$filepath                = UIX_PAGE_BUILDER_PLUGIN_DIR. 'uixpb_templates/';
		$themepath               = get_stylesheet_directory() . '/';
		
		foreach ( glob( dirname(__FILE__). "/uixpb_templates/*.php") as $file ) {
		    $filenames[] = str_replace( dirname(__FILE__). "/uixpb_templates/", '', $file );
		}	
		
		echo '<ul>';
		
		foreach ( $filenames as $filename ) {
	
			if ( $show == 'plug' ) {
				echo '<li>'.trailingslashit( $filepath ) . $filename.'</li>';
			} else {
				echo '<li>'.trailingslashit( $themepath ) . $filename.' &nbsp;&nbsp;'.sprintf( __( '<a target="_blank" href="%1$s"><i class="dashicons dashicons-welcome-write-blog"></i> Edit this template</a>', 'uix-page-builder' ), admin_url( 'theme-editor.php?file='.$filename ) ).'</li>';
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
		  $filepath = UIX_PAGE_BUILDER_PLUGIN_DIR. 'uixpb_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/uixpb_templates/*.php") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/uixpb_templates/", '', $file );
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
			
            if ( !empty( $_POST ) && check_admin_referer( 'custom_action_nonce') ) {
				
				
                  $output = UixPageBuilder::wpfilesystem_write_file( 'custom_action_nonce', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=???', 'helper/', 'debug.txt', 'This is test.' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( 'custom_action_nonce' );
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
		
		  $contentdir = UIX_PAGE_BUILDER_PLUGIN_DIR.$path; 
		  
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
			  $contentdir = UIX_PAGE_BUILDER_PLUGIN_DIR.$path; 
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
		 * Compress the front end code
		 *
		 *
		 */
		public static function str_compression( $str ) {
			
			$str = str_replace( PHP_EOL, '', $str );
			$str = str_replace( "\t", '', $str );
			
			$pattern = array(
			"/> *([^ ]*) *</",
			"/[\s]+/",
			"/<!--[^!]*-->/",
			"/\"  /",
			"/ \"/",
			"'/\*[^*]*\*/'"
			);
			$replace = array(
			">\\1<",
			" ",
			"",
			"\"",
			"\"",
			""
			);
			
		  $outputcode = preg_replace( $pattern, $replace, $str );
			
		  return $outputcode;
	
		}
	
	
	
		
	/*
	 * Returns each variable in module data  (Receive parameters via ajax)
	 *
	 *
	 */
	public static function get_module_data_vars( $id ) {

		$form_id = $id;
		$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
		$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
		$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : esc_html__( 'Section', 'uix-page-builder' );
		$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
		$item    = self::parse_json_form_values( $form_id, $sid, $pid, $wname, $colid );
		
		$vars = array(
			'sid'        => $sid,
			'pid'        => $pid,
			'wname'      => $wname,
			'colid'      => $colid,
			'item'       => $item,
			'form_id'    => $form_id
		);
		
		return $vars;

	}
			
	
	
		
	/*
	 * Parse JSON's values of all the form items for each module
	 *
	 *
	 * $form_id  @var string  -> The form ID (Obtained via module ID).
	 * $sid      @var string  -> The section ID. (Obtained via gridster widget ID.)
	 * $pid      @var string  -> Current Post ID.
	 * $wname    @var string  -> Current widget name of section.
	 * $colid    @var string  -> Column ID.
	 *
	 */
	public static function parse_json_form_values( $form_id, $sid, $pid, $wname, $colid ) {
		
		//The value of all the form items for each module
		$item = array();
		
		
		if ( $sid >= 0 ) {

			$builder_content   = self::page_builder_array_newlist( self::get_page_final_data( $pid ) );
			

			if ( $builder_content && is_array( $builder_content ) ) {
				foreach ( $builder_content as $key => $value ) :
		
					$con = self::page_builder_output( $value->content );


					if ( $con && is_array( $con ) ) {
						foreach ( $con as $key ) :

							$$key[ 0 ] = $key[ 1 ];
							$item[ self::page_builder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
						endforeach;
					}

					//loop content
					$col_content = self::page_builder_analysis_rowcontent( self::prerow_value( $item ), 'content' );


					if ( $col_content && is_array( $col_content ) ) {
						foreach ( $col_content as $key ) :

							$detail_content = $key;

							//column id
							$colname           = $form_id.'-col';
							$cname             = str_replace( $form_id.'|', '', $key[1][0] );
							$id                = $key[0][1];
							$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_module_xxx-col' ];


							foreach ( $detail_content as $value ) :	
								$name           = str_replace( $form_id.'|', '', $value[0] );
								$content        = $value[1];
								$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_module_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];

							endforeach;


						endforeach;
					}	

				
				endforeach;


			}
			
			return $item;


		} else {
			return '';
		}

	}
	
	/*
	 * Returns the JSON final data of each page.
	 *
	 *
	 * $id  @var string  -> Current Post ID.
	 *
	 */
	public static function get_page_final_data( $id ) {
		
		$data = '';
		
		if ( !empty( $id ) ) {
			
			$data = get_post_meta( $id, 'uix-page-builder-layoutdata', true );

			//Compatible with 1.4.2 or before versions of .xml template files and pages that have saved data.
			$data = str_replace( 'uix_pb_section_', 'uix_pb_module_', $data );
			
		}

		return $data;
		
	}
	
	
	
	/*
	 * Form javascripts output when in ajax or default state
	 *
	 *
	 */
	public static function form_scripts( $arr ) {
		
		$echo = new UixPB_Components_FormScripts( $arr );

	}


	/**
	 * List sortable row selector of modules in admin panel
	 * 
	 */
	public static function list_page_sortable_li( $col = '' ) {
	
		$echo = new UixPB_Components_SortableRow( $col );

	}
	
	/**
	 * List buttons of sortable row selector in admin panel
	 * 
	 */	
	public static function list_page_sortable_li_btns( $col = '' ) {
	
		$echo = new UixPB_Components_SortableRow_btn( $col );
		
	}
	
	
	/**
	 * List column buttons of sortable row selector in admin panel
	 * 
	 */
	public static function list_page_itembuttons() {
		
		$echo = new UixPB_Components_SortableRow_ColumnBtn();

	}
				
	
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
