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
		self::uixform_core();
		
		
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_filter( 'body_class', array( __CLASS__, 'new_class' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_sections' ) );
	
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
	 * Uix Form Core
	 *
	 *
	 */
	public static function uixform_core() {
	
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/add-ons/uixform/init.php';

	}
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
