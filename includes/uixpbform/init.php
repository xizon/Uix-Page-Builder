<?php
/**
 * Uix Page Builder Form
 *
 * @class 		: UixPBForm
 * @version		: 4.6 (July 5, 2021)
 * @author 		: UIUX Lab
 * @author URI 	: https://uiux.cc
 *
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'UixPBFormCore' ) ) {
	class UixPBFormCore {
		
		const PREFIX     = 'uix';
		const VERSION    = '4.6';	
		const MAPAPI     = 'AIzaSyA0kxSY0g5flUWptO4ggXpjhVB-ycdqsDk';
		
		/**
		 * Modules path of template directory with admin panel, not recommend changing it
		 *
		 * For admin panel only, template directory name of front-end can use filter "uixpb_templates_filter"
		 *
		 */
		const CUSTOMTEMP = 'uixpb_templates/modules/';
	
	
		
		/**
		 * Initialize
		 *
		 */
		public static function init() {
			
			
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
			add_action( 'admin_init', array( __CLASS__, 'load_form_core' ) );
			add_action( 'admin_init', array( __CLASS__, 'load_components_core' ) );
			add_action( 'admin_footer', array( __CLASS__, 'icon_selector_win' ) );
			
			
		}
		
		
		/*
		 * Enqueue scripts and styles.
		 *
		 *
		 */
		public static function frontpage_scripts() {
			
			//Add Icons
            wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/css/all.min.css', false, '5.7.0', 'all' );
            wp_enqueue_style( 'font-awesome-v4-shims', self::plug_directory() .'fontawesome/css/v4-shims.min.css', array( 'font-awesome' ), '5.7.0', 'all' );   
            
			
	
		}
		
		/*
		 * Enqueue scripts and styles  in the backstage
		 *
		 *
		 */
		public static function backstage_scripts() {
		
			 if( UixPageBuilder::page_builder_mode() ) {
				  
					//Fix the image path of the editor
					$upload_dir     = wp_upload_dir();
				    $upload_dir_url = trailingslashit( $upload_dir[ 'baseurl' ] );
			 
				 
					////Register core functions (Require to enqueue the script before </body> instead of in the <head>.)
				    wp_register_script( 'uixpbform-functions', self::plug_directory() .'js/uixpbform.functions.min.js', array( 'jquery', 'jquery-tmpl' ), self::VERSION, true );
					wp_localize_script( 'uixpbform-functions',  'uix_page_builder_wp_plugin', array( 
						'site_lang'                 => get_locale(),
						'url'                       => self::plug_directory(),
						'site_url'                  => site_url(),
						'site_domain'               => parse_url( site_url(), PHP_URL_SCHEME ).'://'.parse_url( site_url(), PHP_URL_HOST ),
						'upload_dir_url'            => $upload_dir_url,
						'lang_media_title'          => __( 'Select Files', 'uix-page-builder' ),
						'lang_media_text'           => __( 'Insert', 'uix-page-builder' ),			
						'lang_mce_sourcecode_title' => __( 'Source Code', 'uix-page-builder' ),
						'lang_mce_image'            => __( 'Insert Image', 'uix-page-builder' ),
						'lang_mce_unlink_title'     => __( 'Remove link', 'uix-page-builder' ),
						'lang_mce_link_title'       => __( 'Insert/Edit link', 'uix-page-builder' ),
						'lang_mce_link_field_url'   => __( 'URL', 'uix-page-builder' ),
						'lang_mce_link_field_text'  => __( 'Link Text', 'uix-page-builder' ),
						'lang_mce_link_field_win'   => __( 'Open link in a new tab', 'uix-page-builder' ),
						'lang_mce_hcode_title'       => __( 'Syntax Highlight Code', 'uix-page-builder' ),
						'lang_mce_hcode_field_label' => __( 'Language', 'uix-page-builder' ),
					 ) );	
				 
				    wp_enqueue_script( 'uixpbform-functions' );

					//Add Icons
                    wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/css/all.min.css', false, '5.7.0', 'all' );
                    wp_enqueue_style( 'font-awesome-v4-shims', self::plug_directory() .'fontawesome/css/v4-shims.min.css', array( 'font-awesome' ), '5.7.0', 'all' );   

					//UixForm (Require to enqueue the script before </body> instead of in the <head>.)
					wp_enqueue_style( 'uixpbform', self::plug_directory() .'css/uixpbform.min.css', false, self::VERSION, 'all');
					//RTL		
					if ( is_rtl() ) {
						wp_enqueue_style( 'uixpbform-rtl', self::plug_directory() .'css/uixpbform.min-rtl.css', false, self::VERSION, 'all');
					}
				 
				 
				    wp_enqueue_script( 'jquery-tmpl', self::plug_directory() .'js/jquery.tmpl.min.js', array( 'jquery' ), '1.0', true );
				 
					wp_enqueue_script( 'uixpbform', self::plug_directory() .'js/uixpbform.min.js', array( 'uixpbform-functions' ), self::VERSION, true );
					

				 
				 
					//Colorpicker
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'wp-color-picker' );	
				 
				    //Colorpicker alpha plugin
				    $wp_color_picker_alpha_uri_name = version_compare( get_bloginfo( 'version' ), '5.5.0', '>=' ) ? 'wp-color-picker-alpha/up-5.5.0/wp-color-picker-alpha.min.js' : 'wp-color-picker-alpha/default/wp-color-picker-alpha.min.js';
					wp_enqueue_script( 'wp-color-picker-alpha', self::plug_directory() .'js/' . $wp_color_picker_alpha_uri_name, array( 'wp-color-picker', 'uixpbform-functions' ), '2.1.2', true );
				 
	
				 
			  }
			
	
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
		 * Callback the plugin directory URL
		 *
		 *
		 */
		public static function plug_directory() {
	
		  return trailingslashit( plugin_dir_url( __FILE__ ) );
	
		}
		
		/*
		 * Callback the plugin directory
		 *
		 *
		 */
		public static function plug_filepath() {
	
		  return trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() );
	
		}	
		
		
		/*
		 * Callback this plugin slug
		 *
		 *
		 */
		public static function get_slug() {
			$curslug = '';
			$plugin_array = get_plugins();
		
			// First check if we have plugins, else return false
			if ( empty( $plugin_array ) )
				return false;
		
			// Define our variable as an empty array to avoid bugs if $plugin_array is empty
			$slugs = array();
		
			foreach ( $plugin_array as $plugin_slug=>$values ){
				$slugs[] = basename(
						$plugin_slug, // Get the key which holds the folder/file name
						'.php' // Strip away the .php part
					);
			}
			
			foreach ( $slugs as $value ){
				if( self::inc_str( dirname( plugin_basename( __FILE__ ) ), $value ) ) { 
					$curslug = $value;
					break;	
				}
			}	
			
			return $curslug;
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
		 * Load all core components in the directory
		 *
		 */
		 public static function load_components_core() {

			foreach ( glob( dirname(__FILE__). "/components/*.php") as $file ) {
				include $file;
			}

		 }	
		
		
		/*
		 * Call the specified page modules
		 *
		 *
		 */
		public static function call_ajax_modules_tempfilepath( $name ) {
			
			if ( self::tempfolder_exists() ) {
				
				$theme_template_modules_path = self::get_theme_template_modules_path();
				
				include get_stylesheet_directory(). "/".$theme_template_modules_path."{$name}.php";
	
			} else {
				include self::plug_filepath().self::CUSTOMTEMP."{$name}.php";
			}
			
		}
		
	
		/*
		 * Load all the form controls in the directory
		 *
		 */
		 public static function load_form_core() {
	
			foreach ( glob( dirname(__FILE__). "/controls/*.php") as $file ) {
				include $file;
			}	 
		 }

	
		
		/*
		 * ========================================================================================================================================
		 * ========================================================================================================================================
		 */		


		
		/*
		 * Print icon selector
		 *
		 */
		 public static function icon_selector_win() {
			 
			 if( UixPageBuilder::page_builder_mode() ) {
				 
			     echo '<div class="uixpbform-sub-window uixpbform-icon-selector-btn-target" id="" style="display:none;">';
				 require_once ( dirname( __FILE__ ) . '/'.self::icon_attr( 'selector' ) );
				 echo '</div>';	 
			 }
			 
				 
		 }	
		
	
		/*
		 * Returns icon attributes
		 *
		 */
		 public static function icon_attr( $type = 'prefix' ) {
			
			if ( $type == 'prefix' ) {
				return 'fa fa-';
				
			}
			 
			if ( $type == 'selector' ) {
				return 'fontawesome/font-awesome-custom.php';	
			}
		
			 
		 }	
		
		
		
		/*
		 * Get attachment ID
		 *
		 *
		 */	
		public static function get_attachment_id( $img_url ) {
			$cache_key	= md5($img_url);
			$post_id	= wp_cache_get($cache_key, 'wpjam_attachment_id' );
			if($post_id == false){
		
				$attr		= wp_upload_dir();
				$base_url	= $attr['baseurl']."/";
				$path = str_replace($base_url, "", $img_url);
				if($path){
					global $wpdb;
					$post_id	= $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '{$path}'");
					$post_id	= $post_id?$post_id:''; 
				}else{
					$post_id	= '';
				}
		
				wp_cache_set( $cache_key, $post_id, 'get_attachment_id', 86400);
			}
			return $post_id;
		}
	
	
		/*
		 * Shortcode Formatting Output
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
		 * Check if the Dynamic Adding Input
		 *
		 *
		 */
		public static function is_dynamic_input( $class ) {
			 
			 if( self::inc_str( $class, 'dynamic-row' ) ) { 
				 return true;
			 } else {
				 return false;
			 }
			
		
		}
		
		
		/*
		 * Returns Row Class of Table 
		 *
		 *
		 */

		public static function call_row_class( $id, $cls, $echoclass = true ) {
			 
			//class of clone field
			if ( self::inc_str( $id, '_listitem' ) ) {
				$class = ( $echoclass ) ? ' class="dynamic-row-'.$id.'"' : 'dynamic-row-'.$id;
			} else {
				
				if ( $echoclass ) {
					$class = ( isset( $cls ) && !empty( $cls ) ) ? ' class="'.$cls.'"' : '';
				} else {
					$class = ( isset( $cls ) && !empty( $cls ) ) ? $cls : '';
				}
				
			}
			
			return $class;
		
		}
		
	
		
		/*
		 * Returns readable Colour
		 *
		 *
		 */	
		public static function readable_color( $color ){
			
			if ( self::inc_str( $color, 'rgb' ) ) {
				$color = self::rgb2hex( $color );
			}
			
			if ( self::inc_str( $color, '#' ) ) {
				$color = str_replace('#', '', $color );
			}
			
			$r = hexdec(substr( $color, 0, 2 ) );
			$g = hexdec(substr( $color, 2, 2 ) );
			$b = hexdec(substr( $color, 4, 2 ) );
		
			$contrast = sqrt(
				$r * $r * .241 +
				$g * $g * .691 +
				$b * $b * .068
			);
		
			//RGB Luminance
			if($contrast > 130){
				return '#000000';
			}else{
				return '#FFFFFF';
			}
		}
			
		public static function hex2rgb($hex) {
		   $hex = str_replace("#", "", $hex);
		
		   if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
		   }
		   $rgb = array($r, $g, $b);
		   //return implode(",", $rgb); // returns the rgb values separated by commas
		   return $rgb; // returns an array with the rgb values
		}
		
		public static function rgb2hex($rgb) {
		   $hex = "#";
		   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
		   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
		   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
		
		   return $hex; // returns the hex value including the number sign (#)
		}	
	
		
		/*
		 * Callback code of form
		 *
		 *
		 */
		public static function format_formcode( $str ) {
	
			$str = str_replace( '{apo:}', "'",
				   str_replace( '\'', '&apos;',
				   self::str_compression( $str )   
				   ) );
		
		
			return $str;
	
		
			
		}
		

	
		/*
		 * Returns the value of a form control for the specified type
		 *
		 *
		 */
		public static function control_callback_type( $type ) {
			
			$callback_attr = 'data-callback="html"';
			
			switch( $type ) {
				case 'url':
					$callback_attr = 'data-callback="url"'; //Synchronous JavaScript function: uixpbform_format_urlEncode()

				  break;
				case 'attr':
					$callback_attr = 'data-callback="attr"'; //Synchronous JavaScript function: uixpbform_format_htmlAttr()

				  break;
				case 'slug':
					$callback_attr = 'data-callback="slug"'; //Synchronous JavaScript function: uixpbform_format_slug()

				  break;
				case 'html':
					$callback_attr = 'data-callback="html"'; //Synchronous JavaScript function: uixpbform_format_text_entering()

				  break;

				case 'number':
					$callback_attr = 'data-callback="number"'; //Synchronous JavaScript function: uixpbform_format_floatval()

				  break;
				case 'number-deg_px':
					$callback_attr = 'data-callback="number-deg_px"'; //Synchronous JavaScript function: uixpbform_format_degToPx()

				  break;

				case 'color-name':
					$callback_attr = 'data-callback="color-name"'; //Synchronous JavaScript function: uixpbform_format_colorTran()

				  break;	  


				case 'list':
					$callback_attr = 'data-callback="list"'; //Synchronous JavaScript function: uixpbform_format_html_listTran()

				  break;  

				default:
					$callback_attr = 'data-callback="html"';

			}
			
			return $callback_attr;
	
		}
		
		/*
		 * Convert attribute
		 *
		 *
		 */
		public static function to_attr( $str ) {

			return 	str_replace( "'", '{rowcapo:}',
					 str_replace( '"', '{rowcqt:}',
					 //HTML attribute.
					 str_replace( "'", "{attrrowcapo:}",
					 str_replace( '"', '{attrrowcqt:}',		
					 //HTML attribute and WP shortcodes.
					 str_replace( '[', "{lsquarebracket:}",
					 str_replace( ']', '{rsquarebracket:}',	
					 //HTML tag.
					 str_replace( '<', "{lt:}",
					 str_replace( '>', '{gt:}',	
					 //Break key
					 str_replace( '<br>', '{br:}',	
					$str
					) ) ) ) ) ) ) ) );
			
			
		}	
		
		
		/*
		 * Convert degrees to px 
		 *
		 *
		 */
		public static function deg_to_px( $str ) {
			
			return abs( ( floatval( $str ) * 180 / M_PI )/2 );
			
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
		 * HTML tags like "<li>","<ul>","<ol>" transform
		 *
		 *
		 * @param  {string} $str          - Current Post ID.
		 * @param  {string} $type         - Available value: li
		 * @return {string}               - HTML cdoe.
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
		 * Form scripts and templates output
		 *
		 *
		 */
		public static function form_scripts( $arr ) {

			$echo = new UixPBFormCore_Components_FormScripts( $arr );

		}

		
		
		/*
		 * Callback photo placeholder
		 *
		 *
		 */
		public static function photo_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/no-photo.png';
	
		}
		
		/*
		 * Callback LOGO placeholder
		 *
		 *
		 */
		public static function logo_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/no-logo.png';
	
		}
		
		
		/*
		 * Callback cover placeholder
		 *
		 *
		 */
		public static function cover_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/default-cover.jpg';
	
		}	
		
		
		/*
		 * Callback map markers
		 *
		 *
		 */
		public static function map_marker() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/map/map-location.png';
	
		}	
		
		
	}

}

UixPBFormCore::init();	
