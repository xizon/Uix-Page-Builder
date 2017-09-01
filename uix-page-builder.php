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
 * Version:     1.3.1
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-page-builder
 * Domain Path: /languages
 */

class UixPageBuilder {
	
	const PREFIX           = 'uix';
	const HELPER           = 'uix-page-builder-helper';
	const NOTICEID         = 'uix-page-builder-helper-tip';
	const CUSTOMTEMP       = 'uixpb_templates/sections/';
	const SHOWPAGESCREEN   = 0; // Show page builder core assets from "Pages Add New Screen" when this value is "1" (For developer)

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
	    self::setup_constants();
		self::includes();
		
		
		add_action( 'init', array( __CLASS__, 'register_scripts' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_sections' ) );
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
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/general.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/bulider/post-extensions-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/bulider/visual-builder-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-menu-onepage.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-frontend-render.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-get-excerpt.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-get-category.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-xml.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/uixpbform/init.php';
		
		//section shortcodes
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/section-shortcodes/class-section-blog.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/section-shortcodes/class-section-googlemap.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/section-shortcodes/class-section-uix_products.php';
	}
	
	
	/*
	 * Register scripts and styles.
	 *
	 *
	 */
	public static function register_scripts() {
		
		// Core
		wp_register_script( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'js/uix-page-builder.js', array( 'jquery' ), self::ver(), true );
		wp_register_script( self::PREFIX . '-page-builder-plugins', self::backend_path( 'uri' ).'js/uix-page-builder-plugins.js', false, self::ver(), true );
		wp_register_style( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'css/uix-page-builder.css', false, self::ver(), 'all' );
		wp_localize_script( self::PREFIX . '-page-builder',  'wp_theme_root_path', array( 
			'templateUrl' => get_stylesheet_directory_uri()
		 ) );
			

		// Shuffle
		wp_register_script( 'shuffle', self::plug_directory() .'admin/assets/add-ons/shuffle/jquery.shuffle.js', array( 'jquery' ), '3.1.1', true );

		// Shuffle.js requires Modernizr..
		wp_register_script( 'modernizr', self::plug_directory() .'admin/assets/add-ons/HTML5/modernizr.min.js', false, '3.3.1', false );

		// Easy Pie Chart
		wp_register_script( 'easypiechart', self::plug_directory() .'admin/assets/add-ons/piechart/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.7', true );
		
		//flexslider
		wp_register_script( 'flexslider', self::plug_directory() .'admin/assets/add-ons/flexslider/jquery.flexslider.min.js', array( 'jquery' ), '2.5.0', true );
		wp_register_style( 'flexslider', self::plug_directory() .'admin/assets/add-ons/flexslider/flexslider.css', false, '2.5.0', 'all' );
		
		// Parallax
		wp_register_script( 'bgParallax', self::plug_directory() .'admin/assets/add-ons/parallax/jquery.bgParallax.js', array( 'jquery' ), '1.1.3', true );

		

	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Core
		if ( file_exists( self::backend_path( 'dir' ).'css/uix-page-builder.css' ) ) {
			wp_enqueue_style( self::PREFIX . '-page-builder' );
		}
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
		
		if ( file_exists( self::backend_path( 'dir' ).'js/uix-page-builder.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-page-builder' );	
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
	public static function get_tempname( $slug = false ) {

		$curid      = get_the_ID();
		$post_id    = empty( $curid ) ? $_GET['post_id'] : $curid;
		
		if ( empty( $post_id ) ) $post_id = uniqid();
	
		$tempname   = sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $post_id );


		if ( $slug ) {
			return sanitize_title_with_dashes( $tempname );
		} else {
			return $tempname;
		}
		
		
	
	}
	

	/*
	 * Define session for the current post ID
	 *
	 *
	 */
	public static function session_post_id() {

		$curid      = get_the_ID();
		$post_id    = empty( $curid ) ? $_GET['post_id'] : $curid;
		
		if( ! isset( $_SESSION ) ) session_start();
		
		if( array_key_exists( 'uix-page-builder-postid', $_SESSION ) && !empty( $_SESSION[ 'uix-page-builder-postid' ] ) ) {
			$post_id = $_SESSION[ 'uix-page-builder-postid' ];	
		}  else {
			$_SESSION[ 'uix-page-builder-postid' ] = $post_id;
		}
		
		return $post_id;

	}
	
	
	/*
	 * Define session for the template name
	 *
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
	 *
	 */
	public static function convert_img_path( $str, $type ) {

		if ( $type == 'load' ) {

			$str = str_replace( '{temp_placeholder_path}', UixPBFormCore::plug_directory(),
				   str_replace( '{temp_preview_thumb_path}', self::backend_path( 'uri' ),
				   $str 
				   ) );
			
		} elseif ( $type == 'save' ) {
			$str = str_replace( UixPBFormCore::plug_directory(), '{temp_placeholder_path}',
				   str_replace( self::backend_path( 'uri' ), '{temp_preview_thumb_path}',
				   $str 
				   ) );	
		}
		
		return $str;

	}
	
	
	
	
	/*
	 * Returns custom back-end panel directory or directory URL
	 *
	 */
	public static function backend_path( $type = 'uri' ) {
	
		if ( self::tempfolder_exists() ) {
			
			
			if ( file_exists( get_template_directory() .'/uixpb_templates/css/uix-page-builder.css' ) ) {
				if ( $type == 'uri' )  {
					return get_template_directory_uri() .'/uixpb_templates/';
				} else {
					return get_template_directory() .'/uixpb_templates/';
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
		
		//Format the JSON code (remove value of "tempname")
		$json_code_pb_encode = self::format_render_codes_remove_tempname( $json_code_pb_encode );

	
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
	public static function page_builder_array_tempname( $json_code_pb_encode, $slug = false ) {
		
		
		$data = esc_textarea( $json_code_pb_encode );
		$data = str_replace( '&quot;tempname&quot;:&quot;', '"tempname":"',
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
			   ) ) ) ) ) ) ) ) ) ) );
		
	
		if ( self::inc_str( $data, '"tempname"' ) ) {
			$newstr  = json_decode( $data, true );
			$tempname = $newstr[0]['tempname'];

		} else {
			$tempname = '';
		}
		
		
		if ( $slug ) {
			return sanitize_title_with_dashes( $tempname );
		} else {
			return $tempname;
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
	 *
	 */	
	public static function format_render_codes( $str ) {
		
		//Returns string in order to protect the security output of JSON
		return str_replace( '{rowcsql:}', '[', 
				str_replace( '{rowcsqr:}', ']',
				str_replace( 'amp;', '',   //step 2
				str_replace( '&amp;', '&', //step 1		
				$str 
			   ) ) ) );			   
		
	}	
	
	
	/*
	 * Format the JSON code (remove value of "tempname")
	 *
	 */	
	public static function format_render_codes_remove_tempname( $json_code ) {
		
		// Value of "tempname" is class for the <body> of each builder content
		if ( self::inc_str( $json_code, '"tempname"' ) ) {
			$result  = '';
			$newstr  = json_decode( $json_code, true );
			unset( $newstr[0] );
			$total   = count( $newstr );

			$result .= '[';

			for ( $i = 1; $i <= $total; $i++ ) {
				$result .= json_encode( $newstr[ $i ] ).',';
			}

			$result = rtrim( $result, ',' );
			$result .= ']';

		} else {
			$result = $json_code;
		}

		
		return $result;	

	}	

    //add value of "tempname"
	public static function format_layoutdata_add_tempname( $id, $str, $custom = '' ) {
		
		//If loaded the default template, use the session name
		if ( empty( $custom ) ) {
			if( ! isset( $_SESSION ) ) session_start();
			if( array_key_exists( 'uix-page-builder-tempname' . $id, $_SESSION ) && !empty( $_SESSION[ 'uix-page-builder-tempname' . $id ] ) ) {
				$custom = $_SESSION[ 'uix-page-builder-tempname' . $id ];	
			}	
		} else {
			//Define session for the template name
			self::session_default_tempname( $custom, $id );
		}
		
		$custom_name = $custom;

		if ( empty( $custom_name ) ) $custom_name = self::get_tempname();
		
		
		//Format the JSON code (remove value of "tempname")
		$str           = self::format_render_codes_remove_tempname( $str );
		$json_tempname = '{"tempname":"'.$custom_name.'"},';
		$newstr        = '['.$json_tempname.ltrim( rtrim( $str, ']' ), '[' ).']';
		
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
				str_replace( '{br:}', '<br>',
		        str_replace( '&#039;', "'",
		        str_replace( '&quot;', '"',
			    str_replace( '&apos;', "'",
				str_replace( 'amp;', '',  //step 2
				str_replace( '&amp;', '&', //step 1
						
				
			    $data 
			    ) ) ) ) ) ) ) ) );
				
		if ( !is_admin() ) {
			$data = self::format_render_codes( $data );
			$data = str_replace( '&lt;br&gt;', '<br>', $data );	
	
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

	      if( is_dir( get_stylesheet_directory() . '/uixpb_templates' ) ) {
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
		
		if( self::page_builder_mode() ) {
			
			if ( self::tempfolder_exists() ) {
				include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";
				foreach ( $uix_pb_config as $v ) {
					foreach ( $v[ 'buttons' ] as $key ) {
						
						$keyid = str_replace( '.php', '', $key[ 'id' ] );
						
						if ( file_exists( get_stylesheet_directory(). "/".self::CUSTOMTEMP."".$keyid.".php" ) ) {
							include get_stylesheet_directory(). "/".self::CUSTOMTEMP."".$keyid.".php";
						}
						
					}						
				}

			} else {
				include self::plug_filepath().self::CUSTOMTEMP."config.php";
				
				foreach ( $uix_pb_config as $v ) {
					foreach ( $v[ 'buttons' ] as $key ) {
						
						$keyid = str_replace( '.php', '', $key[ 'id' ] );
						
						if ( file_exists( self::plug_filepath().self::CUSTOMTEMP."".$keyid.".php" ) ) {
							include self::plug_filepath().self::CUSTOMTEMP."".$keyid.".php";
						}
						
					}						
				}
			}
		
		 }
  
	}
	
	
	public static function call_sections_frontend() {
		
		if ( self::tempfolder_exists() ) {
			include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";

		} else {
			include self::plug_filepath().self::CUSTOMTEMP."config.php";
		}
		
	}
	
	
	
	/**
	 * List buttons of page sections 
	 * 
	 */
	public static function list_page_sortable_li( $col = '' ) {
	
		
		echo "<li class=\"row col-".$col."\" id=\"widget-items-elements-detail-".$col."-'+uid+'\"><a class=\"button add-elements-btn\" href=\"javascript:\" data-elements=\"widget-items-elements-".$col."-'+uid+'\"><i class=\"dashicons dashicons-plus\"></i></a><textarea id=\"col-item-".$col."---'+uid+'\">[[{rqt:}col{rqt:},{rqt:}".$col."{rqt:}],[{rqt:}uix_pb_section_undefined|[col-item-".$col."---'+uid+'][uix_pb_undefined]['+sid+']{rqt:},{rqt:}{rqt:}]]</textarea></li>";
		
	}
	
	
	public static function list_page_sortable_li_btns( $col = '' ) {
	
		if ( self::tempfolder_exists() ) {
			include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";
			
		} else {
			include self::plug_filepath().self::CUSTOMTEMP."config.php";
		}
		
		$imgpath = self::backend_path( 'uri' ).'images/UixPageBuilderThumb/';
		
		
		$btns = '<div class="uix-page-builder-col-tabs">';
	   
		foreach ( $uix_pb_config as $v ) {
			
			$btns .= '<h3>'.$v[ 'sortname' ].'</h3><div>';
			
			foreach ( $v[ 'buttons' ] as $key ) {
				
				
				$keyid  = str_replace( '.php', '', $key[ 'id' ] );
				$imgsrc = ( !empty( $key[ 'thumb' ] ) ) ? $imgpath.$key[ 'thumb' ] : $imgpath.'_none.png';
				
				$btns .= "<div class=\"uix-page-builder-col\"><a class=\"widget-item-btn ".$keyid."\" data-elements-target=\"widget-items-elements-detail-".$col."-'+uid+'\" data-slug=\"".$keyid."\" data-name=\"".esc_attr( $key[ 'title' ] )."\" data-id=\"'+uid+'\" data-col-textareaid=\"col-item-".$col."---'+uid+'\" href=\"javascript:\"><span class=\"t\">".$key[ 'title' ]."</span><span class=\"img\"><img src=\"".esc_url( $imgsrc )."\" alt=\"".esc_attr( $key[ 'title' ] )."\"></span></a></div>";
			}		
			
			$btns .= '</div>';
							
		}
		
		$btns .= '</div>';
				
		
		echo 'if ( jQuery( \'#widget-items-elements-'.$col.'-\'+uid+\'\' ).length < 1 ) {jQuery( \'body\' ).prepend( \'<div class="uixpbform-modal-box uixpbform-modal-box-elementsselector" id="widget-items-elements-'.$col.'-\'+uid+\'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'.__( 'Choose Element You Want', 'uix-page-builder' ).'</h2><div class="widget-items-container">'.$btns.'</div></div></div>\' ); if ( jQuery( document.body ).width() > 768 ) { jQuery( ".uix-page-builder-col-tabs" ).accTabs(); } }';
			
		
		
	}
	
	
	
		
	public static function list_page_itembuttons() {
	
	    echo "<div class=\"widget-items-col-container\"><button type=\"button\" class=\"add\"><i class=\"dashicons dashicons-text\"></i>".__( 'Layout', 'uix-page-builder' )."</button><div class=\"btnlist\"><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\"  title=\"".esc_attr__( '1/1', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-1\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"2__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/2', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-2\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"3__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"4__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-4\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1_3\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/3, 2/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"2_3\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '2/3, 1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-2_3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1_4\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/4, 3/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_4\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"3_4\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '3/4, 1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-3_4\"></a></div></div><span class=\"cols-content-data-container\" id=\"cols-content-data-'+uid+'\"></span><textarea id=\"cols-all-content-tempdata-'+uid+'\" class=\"temp-data temp-data-1\"></textarea><textarea id=\"cols-all-content-replace-'+uid+'\" class=\"temp-data temp-data-2\"></textarea>";

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
	 * Push the clone form of saved data
	 *
	 *
	 */
	public static function push_cloneform( $uid, $items, $clone_trigger_id, $cur_id, $col_id, $clone_value, $section_row, $value, $clone_list_toggle_classes = '' ) {
		
		//Toggle class
		$clone_list_toggle_class = '';
		if ( $clone_list_toggle_classes && is_array( $clone_list_toggle_classes ) ) {
			
			foreach ( $clone_list_toggle_classes as $t_value ) {
				$clone_list_toggle_class .= '#{colID}'.UixPBFormCore::fid( $col_id, $section_row, $t_value ).',';
			}
			$clone_list_toggle_class = rtrim( $clone_list_toggle_class, ',' );
		}
		
		//Widget ID
		$widget_ID         = $section_row;
		
		//Toggle target ID
		$toggle_target_ID  = str_replace( '{colID}', $cur_id.'-', $clone_list_toggle_class );
		
		
	    //Initialize clone content
		$new_clone_value = preg_replace_callback(
			'|chk-id-input="(.*?)"|',
			function ( $matches ) {
				return $matches[0].' {temp}';
			},
			$clone_value
		);
		
		$new_clone_value = preg_replace_callback(
			'|chk-id-textarea="(.*?)"|',
			function ( $matches ) {
				return $matches[0].' {temp}';
			},
			$new_clone_value
		);		
		
		$new_clone_value = preg_replace_callback(
			'|\{temp\} value="(.*?)"|',
			function ( $matches ) {
				return '';
			},
			$new_clone_value
		);

		$new_clone_value = preg_replace_callback(
			'|\{temp\}>(.*?)</textarea>|',
			function ( $matches ) {
				return '';
			},
			$new_clone_value
		);

		
		
		//Clone content
		$data = '<span class="dynamic-row dynamic-addnow">'.$new_clone_value.'<div class="delrow-container"><a href="javascript:" class="delrow delrow-'.$clone_trigger_id.'-'.$col_id.'" data-spy="'.$clone_trigger_id.'__'.$col_id.'">&times;</a></div></span>';
	
			 
		//Clone code
		$data = str_replace( '{index}', '['.$widget_ID.']',
		       str_replace( 'data-id="', 'id="'.$cur_id.'-',
			   str_replace( 'chk-id-input="', 'chk-id-input="'.$cur_id.'-',
			   str_replace( 'chk-id-textarea="', 'chk-id-textarea="'.$cur_id.'-',
			   str_replace( '][uix', ']'.$cur_id.'-[uix',
			   str_replace( '{dataID}', ''.$cur_id.'-',
			   str_replace( '{multID}', $toggle_target_ID,
			   str_replace( '{columnid}', $col_id,
			   str_replace( '{colID}', ''.$cur_id.'-'.str_replace( 'col-item-', 'section_'.$widget_ID.'__', $col_id ),
			   str_replace( 'data-insert-img="{colID}', 'data-insert-img="'.$cur_id.'-',
			   str_replace( 'data-insert-preview="{colID}', 'data-insert-preview="'.$cur_id.'-',
			   $data 
			   ) ) ) ) ) ) ) ) ) ) );
		
		
		//Toggle elements
		$data = str_replace( 'uixpbform_btn_trigger-toggleshow open', 'uixpbform_btn_trigger-toggleshow',
			   $data 
			   );		
		
		
		//Default value
		if ( $value && is_array( $value ) ) {
			foreach ( $value as $t_value ) {
				
				$item_id    = $uid.UixPBFormCore::fid( $col_id, $section_row, $t_value );
				$item_value = self::inputtextareavalue( $items[ '['.$col_id.']'.$uid.'['.$t_value.']['.$section_row.']' ] );
			
				
				if ( self::inc_str( $data, 'chk-id-input="'.$item_id.'"' ) ) {
					$data = str_replace( 'chk-id-input="'.$item_id.'"', 'value="'.esc_attr( $item_value ).'"', $data );	
				}
				if ( self::inc_str( $data, 'chk-id-textarea="'.$item_id.'"' ) ) {
					$data = str_replace( 'chk-id-textarea="'.$item_id.'"', '>'.esc_textarea( $item_value ).'</textarea>', $data );	
				}			
				

			}	
		}
		
		
		
		//Clone list classes
		$data = str_replace( 'data-list="0"', 'data-list="1"',
			   str_replace( 'toggle-row', 'toggle-row toggle-row-clone-list',
			   $data 
			   ) );
			   	   
		echo "<script type='text/javascript'>jQuery(document).ready(function(){ jQuery( 'a[data-targetid=\"".$clone_trigger_id."\"]' ).uixpbform_dynamicFormInit({cloneCode:'{$data}'}); });</script>";
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
	 * Checks whether a template file or directory exists
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
	 * Returns template files directory
	 *
	 *
	 */
	public static function list_templates_name( $show = 'plug' ){
	
		
		$filenames = array();
		$filepath = UIX_PAGE_BUILDER_PLUGIN_DIR. 'uixpb_templates/';
		$themepath = get_stylesheet_directory() . '/';
		
		foreach ( glob( dirname(__FILE__). "/uixpb_templates/*.php") as $file ) {
		    $filenames[] = str_replace( dirname(__FILE__). "/uixpb_templates/", '', $file );
		}	
		
		echo '<ul>';
		
		foreach ( $filenames as $filename ) {
			$file1 = trailingslashit( $filepath ) . $filename;
			
			$file2 = trailingslashit( $themepath ) . $filename;	
			
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
	 * Initialize sections template parameters
	 *
	 *
	 */
	public static function init_template_parameters( $id ) {

		//Form ID
		$form_id = $id;

		//Sections template parameters
		$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
		$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
		$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : esc_html__( 'Section', 'uix-page-builder' );
		$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
		$item    = self::template_parameters( $form_id, $sid, $pid, $wname, $colid );
		
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
	 * Returns template parameters
	 *
	 *
	 */
	public static function template_parameters( $form_id, $sid, $pid, $wname, $colid, $item = '' ) {
		
		if ( $sid >= 0 ) {

			$builder_content   = self::page_builder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
			$item              = array();
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
			
			return $item;


		} else {
			return '';
		}
		
		

	}
	
	/*
	 * Form javascripts output when in ajax or default state
	 *
	 *
	 */
	public static function form_scripts( $arr ) {
		
	
		if ( is_array( $arr ) && sizeof( $arr ) >= 8 ) {
		
			//basic
			$title            = $arr[ 'title' ];
			$wname            = ( isset( $arr[ 'widget_name' ] ) ) ? $arr[ 'widget_name' ] : __( 'Section', 'uix-page-builder' );
			$form_id          = $arr[ 'form_id' ];
			$colid            = $arr[ 'column_id' ];
			$sid              = $arr[ 'section_id' ];
			$fields_args      = $arr[ 'fields' ];
			$form_js_template = $arr[ 'js_template' ];
			$defalt_value     = $arr[ 'defalt_value' ];
			$multi_columns    = false;
			$form_html        = '';
			$form_js_vars     = '';
			$last_fields_args = end( $fields_args ); //Determine whether to add a template form

			

			
			if ( is_array( $fields_args ) ) {
				
			
				foreach( $fields_args as $v ) :
					if ( isset( $v[ 'title' ] ) && !empty( $v[ 'title' ] ) ) {
						$multi_columns = true;
						break;
						
					}
				endforeach;
				
				if ( $multi_columns ) $form_html .= UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );
				
				foreach( $fields_args as $v ) :
					$column_title = '';
					if ( isset( $v[ 'title' ] ) && !empty( $v[ 'title' ] ) ) {
						$column_title  = $v[ 'title' ];
					}
					
				
					//------- template textarea
					if( $v == $last_fields_args ) {
						 // 'you can do something here as this condition states it just entered last element of an array'; 
						array_push( $v[ 'values' ], array(
													'id'             => $form_id.'_temp',
													'title'          => '',
													'desc'           => '',
													'value'          => '',
													'placeholder'    => '',
													'type'           => 'textarea',
													'default'        => array(
																			'hide' => true,
							                                                'tmpl' => true,
							
																		)
											)
						);	
						
					}
						
				
					$form_html .= UixPBFormCore::add_form( $v[ 'config' ], $colid, $wname, $sid, $form_id, $v[ 'type' ], $v[ 'values' ], 'html', $column_title );
					
					$form_js_vars .= UixPBFormCore::add_form( $v[ 'config' ], $colid, $wname, $sid, $form_id, $v[ 'type' ], $v[ 'values' ], 'js_vars' );
	
				endforeach;
				
				
				
				
				if ( $multi_columns ) $form_html .= UixPBFormCore::form_after();
				

			}
			
			
			
			//clone
			$clone                       = $arr[ 'clone' ];
			$clone_enable                = false;
			$clone_trigger_id            = '';
			$clone_max                   = 1;
			$clone_list_toggle_class     = '';
			$clone_fields_group          = '';
		

			if ( is_array( $clone ) && sizeof( $clone ) >= 2 ) {
				$clone_enable                = true;
				$clone_fields_group          = $clone[ 'fields_group' ];
				$clone_list_toggle_class     = $clone[ 'list_toggle_class' ];

				if ( isset( $clone[ 'max' ] ) ) {
					$clone_max = $clone[ 'max' ];
				}
	
			}



			// ---------- Returns actions of javascript
			if ( $sid == -1 && is_admin() ) {
				if( self::page_builder_mode() ) {
					if ( is_admin()) {


						//List Item - Register clone vars ( step 1)
						if ( $clone_enable && is_array( $clone_fields_group ) ) {
						
							foreach( $clone_fields_group as $v ) :
								
								$clone_fields        = $v[ 'fields' ];
								$clone_trigger_id    = $v[ 'trigger_id' ];
								$clone_fields_value  = '';
								
								
								foreach( $clone_fields as $name ) :
									
									$toggle = '';
									if( self::inc_str( $name, '_toggle' ) && !self::inc_str( $name, '_toggle_' ) ) {
										$toggle = 'toggle';
									}
									if( self::inc_str( $name, '_toggle_' ) ) {
										$toggle = 'toggle-row';
									}								
									
									$clone_fields_value .= UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, $name ).'', $form_html, $toggle );
							
								endforeach;

								UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_fields_value );
								
							endforeach;
						
						}


						?>
						<script type="text/javascript">
						( function($) {
						'use strict';
							$( document ).ready( function() {  
								<?php echo UixPBFormCore::uixpbform_callback( $form_id, $title ); ?>

							} ); 
						} ) ( jQuery );
						</script>

						<?php


					}
				}

			}


			// ---------- Returns form with ajax
			if ( $sid >= 0 && is_admin() ) {
				echo $form_html;

				// Dynamic Adding Input ( Default Value ) ( step 2)
				if ( $clone_enable && is_array( $clone_fields_group ) ) {

					foreach( $clone_fields_group as $v ) :
	
						$required_field     = $v[ 'required' ];
						$clone_fields       = $v[ 'fields' ];
						$clone_trigger_id   = $v[ 'trigger_id' ];
						
						if ( !isset( $v[ 'required' ] ) ) {
							$required_field = $clone_fields[0];
						}

						
						for ( $i = 2; $i <= $clone_max; $i++ ) {

							$uid                = $i.'-';
							$clone_fields_value = '';

							foreach( $clone_fields as $name ) :
								
								$toggle = '';
								if( self::inc_str( $name, '_toggle' ) && !self::inc_str( $name, '_toggle_' ) ) {
									$toggle = 'toggle';
								}
								if( self::inc_str( $name, '_toggle_' ) ) {
									$toggle = 'toggle-row';
								}		
								
								$clone_fields_value .= UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, $name ).'', $form_html, $toggle );
							
							endforeach;
							
							if ( is_array( $defalt_value ) && array_key_exists( '['.$colid.']'.$uid.'['.$required_field.']['.$sid.']', $defalt_value ) ) {

								$cur_id = $i;

								self::push_cloneform( $uid, $defalt_value, $clone_trigger_id, $cur_id, $colid, $clone_fields_value, $sid, $clone_fields, $clone_list_toggle_class );

							} 
						} //end for
					
					endforeach;


				}


				?>

				<script type="text/javascript">
				( function($) {
				'use strict';
					$( document ).ready( function() {

						function uix_pb_temp() {

							/* Vars */
							<?php echo $form_js_vars; ?>

							/* Template */
							<?php echo $form_js_template; ?>

							/* Save data */
							$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
							
							/* Render HTML Viewport */
							$( document ).UixPBRenderHTML({ divID: '#<?php echo UixPageBuilder::frontend_wrapper_id( '', $sid, $colid ); ?>', value: temp });

						}

						uix_pb_temp();
						$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() { 
							uix_pb_temp();
						});


					} ); 
				} ) ( jQuery );
				</script> 

				<?php	
			}
	
			
		}
	

	}


	
	
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
