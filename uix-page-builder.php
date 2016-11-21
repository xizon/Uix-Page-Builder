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

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
		self::meta_boxes();
	
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_filter( 'body_class', array( __CLASS__, 'new_class' ) );
		add_filter( 'mce_css', array( __CLASS__, 'mce_css' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_form' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_form_core' ) );
		
	
	}
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Add Icons
		wp_enqueue_style( 'font-awesome', self::plug_directory() .'admin/add-ons/fontawesome/font-awesome.css', array(), '4.5.0', 'all');
		wp_enqueue_style( 'flaticon', self::plug_directory() .'admin/add-ons/flaticon/flaticon.css', array(), '1.0', 'all');
					
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
					
						//Add Icons
						wp_enqueue_style( 'font-awesome', self::plug_directory() .'admin/add-ons/fontawesome/font-awesome.css', array(), '4.5.0', 'all');
						wp_enqueue_style( 'flaticon', self::plug_directory() .'admin/add-ons/flaticon/flaticon.css', array(), '1.0', 'all');
								
						//Sweetalert
						wp_enqueue_style( self::PREFIX . '-sweetalert', self::plug_directory() .'admin/add-ons/sweetalert/sweetalert.css', false,'1.0.0', 'all');
						wp_enqueue_script( self::PREFIX . '-sweetalert', self::plug_directory() .'admin/add-ons/sweetalert/sweetalert.min.js', array( 'jquery' ), '1.0.0' );
				
						//Colorpicker
						wp_enqueue_style( 'wp-color-picker' );
						wp_enqueue_script( 'wp-color-picker' );		
								
							
						//Drag and drop
						wp_enqueue_script( self::PREFIX . '-gridster', self::plug_directory() .'admin/js/jquery.gridster.min.js', array( 'jquery' ), '0.5.6', true );	
						wp_enqueue_style( self::PREFIX . '-gridster', self::plug_directory() .'admin/css/jquery.gridster.css', false, '0.5.6', 'all');
						
						//Main
						wp_enqueue_script( self::PREFIX . '-page-builder', self::plug_directory() .'admin/js/script.js', array( 'jquery' ), self::ver(), true );	
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
		 
		 require_once 'helper/settings.php';
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
	 * Custom Metaboxes and Fields
	 *
	 *
	 */
	public static function meta_boxes() {
	
		require_once 'admin/metaboxes-page.php';

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
		$data = str_replace( '&#039;', "'",
		        str_replace( '&quot;', '"',
			    str_replace( '&apos;', "'",
			    $data 
			    ) ) );
			   
		return do_shortcode( $data );
		
	}		
		
		
	/*
	 * ========================================================================================================================================
	 * ========================================================================================================================================
	 */			
		

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
	 * Call the specified form
	 *
	 *
	 */
	public static function call_form( $name ) {
		
		if( get_post_type() == 'page' ) {
			

			if ( self::tempfolder_exists() ) {
				foreach ( glob( get_stylesheet_directory(). "/uix-page-builder-sections/sections/*.php") as $file ) {
					include $file;
				}		
			} else {
				foreach ( glob( dirname(__FILE__). "/uix-page-builder-sections/sections/*.php") as $file ) {
					include $file;
				}		

			}
		
 
		 }
  
	}
	
	/**
	 * List buttons of page sections 
	 * 
	 */
	public static function list_page_buttons() {
	
		if ( self::tempfolder_exists() ) {
			require get_stylesheet_directory(). "/uix-page-builder-sections/sections/config.php";
		} else {
			require dirname(__FILE__). "/uix-page-builder-sections/sections/config.php";
		}

	}
	

	/*
	 * Load all the form fields in the directory
	 *
	 */
	 public static function load_form_core() {

		foreach ( glob( dirname(__FILE__). "/admin/core/form-inc/*.php") as $file ) {
			include $file;
		}	 
	 }
	
	
	/*
	 * Get current URI
	 *
	 */
	public static function cur_uri() {

		$protocol = strpos( strtolower( $_SERVER['SERVER_PROTOCOL'] ), 'https' )  === false ? 'http' : 'https';
		$thisURL = $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$weburl = $protocol.'://'.$_SERVER['HTTP_HOST'];
		
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$uri = $_SERVER['REQUEST_URI'];
		} else {
			if ( isset($_SERVER['argv'] ) ) {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
			} else {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
			}
		}
		return $weburl.$uri;


	}
	
	
	/*
	 * Get page URI
	 *
	 */
	
	public static function page_uri() {

		global $post;
		$_c = '';
	
		if ( is_single() || is_page() ) {
			$_c = get_permalink( get_the_ID() );
		}
		if ( is_home() ) {
			$_c = home_url('/');
		}
		if ( is_category() || is_category() && is_paged() ) {
			$_c = get_category_link(get_query_var( 'cat' ) );
		}
		if ( is_tag() || is_tag() && is_paged() ) {
			$_c = get_term_link(get_query_var( 'tag' ), 'post_tag' );
		}
		if ( is_search() || is_search() && is_paged() ) {
			$_c = get_search_link(get_query_var( 'search' ) );
		}
		if ( is_author() ) {
			$_c = esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) ));
		}
		if ( is_date() ) {
			$_c = get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'));
		}
		
		if ( $_c == '' ) {
			$cururl = self::cur_uri();
			if ( is_paged() ) {
				
				if ( strpos( $cururl, '&paged=') ){
					$cururl_new = explode( '&paged=', $cururl );
					$cururl = $cururl_new[0];
					
				}
				
				
				if ( strpos( $cururl, '/page') ){
					$cururl_new = explode( '/page', $cururl );
					$cururl = $cururl_new[0];
				}
				
		
			}
			$_c = $cururl;
		}
		
	    return $_c;

	}



	
	/*
	 * Transform string to slug for filterable categories
	 *
	 *
	 */
	public static function transform_slug( $str ) {
	
		return str_replace( ' ', '-', strtolower( $str ) );

	}

	/*
	 * Display categories on page
	 *
	 *
	 */
	public static function cat_list( $str, $classprefix = 'uix-pb-portfolio-' ) {

		$list = array();  
		$c = preg_match_all( '/\<div class="'.$classprefix.'type">(.*?)\<\/div\>/', $str, $m ); 
		$code = '';
		if( count( $m[1] ) > 0 ) { 
			for( $i=0; $i < $c; $i++ ) { 
			
				$new = !empty($m[1][$i]) ? $m[1][$i] : '';
				array_push( $list, array(
				    'slug' => self::transform_slug( $new ),
					'name' => $new
				));
				
			}  
			
			foreach ( $list as $key ) {
				$code .= '<li><a href="javascript:" data-group="'.$key[ 'slug' ].'">'.$key[ 'name' ].'</a></li>';
			}	
			
			return $code;

		} else {
			return '';
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
		
		$str = str_replace( "\r\n", '', $str );
		$str = str_replace( "\n", '', $str );
		$str = str_replace( "\t", '', $str ); 
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
	 * Check if the user needs a browser update
	 *
	 *
	 */
	public static function is_IE() {
         
		 if( self::inc_str( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) ) { 
		     return true;
		 } else {
			 return false;
		 }
        
	
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
	public static function row_class( $class ) {
         
		if( self::is_IE() && self::is_dynamic_input( $class ) ) {
			$new_class = str_replace( 'toggle-row', 'toggle-row isMSIE', $class );
		} else {
			$new_class = $class;
		}
		
		return $new_class;
        
	
	}
	
	
	/*
	 * Add custom CTA styles to TinyMCE editor
	 *
	 *
	 */
	public static function mce_css( $wp ) {
		$wp .= ',' . self::plug_directory() .'admin/css/content.css';
		return $wp;
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
	 * Decode template
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
	 * Get sub tags
	 *
	 *
	 */
	public static function get_subtags( $str, $content = null ) {

         if ( $str ) {
			 preg_match_all( '/\['.$str.'\](.*?)\[\/'.$str.'\]/si', $content , $match );
			 return $match[1][0];
		 } else {
		    return '';
		 }
	
	}

	
	
	/*
	 * Callback code of form
	 *
	 *
	 */
	public static function format_formcode( $str ) {

		$str = str_replace( '\'', '&apos;',
				   self::str_compression( $str )
				   );
	

		return $str;


	}
	

	
	/*
	 * Callback before tag of form
	 *
	 *
	 */
	public static function form_before() {
		
		return '<div class="sweet-table-wrapper">';

	}
	
	/*
	 * Callback after tag of form
	 *
	 *
	 */
	public static function form_after() {
		
		return '</div><!-- /.sweet-table-wrapper-->';

	}
	
	/*
	 * Callback before javascript of sweetalert
	 *
	 *
	 */
	public static function sweetalert_before( $form_js, $form_html, $form_js_vars, $form_id, $title ) {
		
	    $formid = '.'.$form_id.'';
		  
		return "
		
		{$form_js}
		
		/* Pager Builder */
		$( document ).on( 'click', '{$formid}', function( e ) {
			
			var widget_conID = $( this ).data( 'target' );
			
			swal({   
				title: '{$title}',
				text: '{$form_html}',   
				html: true,
				type: 'input',
				showCancelButton: true,   
				confirmButtonColor: '#7ad03a',   
				cancelButtonText: '".__( 'Cancel', 'uix-page-builder' )."',
				confirmButtonText: '".__( 'Insert into', 'uix-page-builder' )."'
			}, 
			function(){ 
			    
			    {$form_js_vars}
		";

	}
	
	
	/*
	 * Callback after javascript of sweetalert
	 *
	 *
	 */
	public static function sweetalert_after() {
		
		return "
				/* Close */
				swal( '', '".__( 'Using successfully.', 'uix-page-builder' )."', 'success' ); 

				
			});
			
			/*-- Icon list with the jQuery AJAX method --*/
			$( '.icon-selector' ).uix_pb_iconSelector();
			$( '.wp-color-input' ).wpColorPicker();
		
		});
		";

	}
	
	
	/*
	 * Callback before javascript of push to editor/textarea
	 *
	 *
	 */
	public static function send_to_editor_before( $tid = '' ) {
		
		  return "uix_pb_insertCodes( ";

	}
	
	
	/*
	 * Callback after javascript of push to editor/textarea
	 *
	 *
	 */
	public static function send_to_editor_after() {
		
		  return ', widget_conID );';
	
	}

	
     /*
	 * Returns dynamic form
	 *
	 *
	 */
	public static function dynamic_form_code( $class, $str, $toggle = null ) {
		
		 $searcharray[ 'list_str' ] = array(
			   'data-insert-preview="', //image
			   'data-insert-img="', //image
			   'pushinputID=',//icon
			   'id=',//input,textarea
			   '<td>',
			   '</td>'
			   
		
		  );
		  $replacearray[ 'list_str' ] = array(
			   'data-insert-preview="{dataID}', 
			   'data-insert-img="{dataID}', 
			   'pushinputID={dataID}', 
			   'data-id=',
			   '',
			   ''
		  );  

         if ( $str ) {
			 preg_match_all( '/<tr.*?'.$class.'">(.*?)<\/tr>/is', $str, $match );
			 $v = str_replace( $searcharray[ 'list_str' ], $replacearray[ 'list_str' ], $match[1][0] );
			 $v = preg_replace( '/<th.*?<\/th>/', '', $v );
			 
			//inscure browser
			if( self::is_IE() ) {
				 if ( $toggle == 'toggle-row' ) {
					 $v = '<div class="toggle-row isMSIE">'.$v.'</div>';
				 }
				 if ( $toggle == 'toggle' ) {
					 $v = '<div class="toggle-btn isMSIE">'.$v.'</div>';
				 }	 

			} else {
				 if ( $toggle == 'toggle-row' ) {
					 $v = '<div class="toggle-row">'.$v.'</div>';
				 }
				 if ( $toggle == 'toggle' ) {
					 $v = '<div class="toggle-btn">'.$v.'</div>';
				 }	 
	
			}
		
			 return self::str_compression( $v );
		 } else {
		    return '';
		 }
	

	}
	
	
	/*
	 * Callback form
	 *
	 * 
	 */
	 
	public static function add_form( $config_id, $arr1 = null, $arr2 = null, $code = 'html', $wrapper_name = '' ) {
		
		$section_args = array();
		$field_total = array();
		$field_args = array();
		$before = '';
		$after = '';
		$field = '';
		$output = '';
		$jscode = '';
		$jscode_vars = '';
		
		
		
		
		/**
		 * Get the configuration options
		 */
		
		if ( is_array( $arr2 ) ) {

			foreach ( $arr2 as $field_key => $field_value ) {
				$field_total[] = $field_value;
			}	
	
		}
	
	
        if ( !empty( $config_id ) ) {
			
			
			/**
			 * Add the form container
			 */
			 if ( is_array( $arr1 ) ) { 
			 
					if ( $arr1[ 'list' ] == false ) {
		
							$before = '
							 '.self::form_before().'
								<table class="sweet-table">
									<!-- Automatically repair display issues that readability of Sweetalert Form.  -->
									<input type="hidden" style="display:none"><!-- Required -->
							'."\n";
							
							
							$after = '
								</table>
							 '.self::form_after().'
							'."\n";
		
			
					}
					
					//Column 2
					if ( $arr1[ 'list' ] == 2 ) {
					
							$before = '
							 
								 <div class="sweet-table-cols-wrapper sweet-table-col-2">
									<table class="sweet-table-list">
										<!-- Automatically repair display issues that readability of Sweetalert Form.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.sweet-table-cols-wrapper-->
							 
							'."\n";
						
						
					}
					
					//Column 3
					if ( $arr1[ 'list' ] == 3 ) {
						$before = '
							 
								 <div class="sweet-table-cols-wrapper sweet-table-col-3">
									<table class="sweet-table-list">
										<!-- Automatically repair display issues that readability of Sweetalert Form.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.sweet-table-cols-wrapper-->
							 
							'."\n";
						
					}
					
					//Column 4
					if ( $arr1[ 'list' ] == 4 ) {
						$before = '
							 
								 <div class="sweet-table-cols-wrapper sweet-table-col-4">
									<table class="sweet-table-list">
										<!-- Automatically repair display issues that readability of Sweetalert Form.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.sweet-table-cols-wrapper-->
							 
							'."\n";
							
					}
			
			 }
			
			
			

			/**
			 * Add the field to the properly indexed
			 */
	
			foreach ( $field_total as $key) {
		
				$_title = ( isset( $key['title'] ) ) ? $key['title'] : '';
				$_desc = ( isset( $key['desc'] ) ) ? $key['desc'] : '';
				$_default = ( isset( $key['default'] ) ) ? $key['default'] : '';
				$_value = ( isset( $key['value'] ) ) ? $key['value'] : '';
				$_ph = ( isset( $key['placeholder'] ) ) ? $key['placeholder'] : '';
				$_id = ( isset( $key['id'] ) ) ? $key['id'] : '';
				$_type = ( isset( $key['type'] ) ) ? $key['type'] : 'text';
				$_class = ( isset( $key['class'] ) ) ? $key['class'] : '';
				$_toggle = ( isset( $key['toggle'] ) ) ? $key['toggle'] : '';
				
				$args = [
					'title'             => $_title,
					'desc'              => $_desc,
					'default'           => $_default,
					'value'             => $_value,
					'placeholder'       => $_ph,
					'id'                => $_id,
					'type'              => $_type,
					'class'              => $_class,
					'toggle'              => $_toggle

				];
			
				
				//icon
				$field .= UixPageBuilderForm_Icon::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Icon::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Icon::add( $args, 'js_vars' );
	
				//radio
				$field .= UixPageBuilderForm_Radio::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Radio::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Radio::add( $args, 'js_vars' );
				
				//radio image
				$field .= UixPageBuilderForm_RadioImage::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_RadioImage::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_RadioImage::add( $args, 'js_vars' );			
				
				//multiple selector
				$field .= UixPageBuilderForm_MultiSelector::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_MultiSelector::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_MultiSelector::add( $args, 'js_vars' );			
	
				//slider
				$field .= UixPageBuilderForm_Slider::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Slider::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Slider::add( $args, 'js_vars' );
				
				//margin
				$field .= UixPageBuilderForm_Margin::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Margin::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Margin::add( $args, 'js_vars' );
				
				
				//text
				$field .= UixPageBuilderForm_Text::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Text::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Text::add( $args, 'js_vars' );
	
	
				//textarea
				$field .= UixPageBuilderForm_Textarea::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Textarea::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Textarea::add( $args, 'js_vars' );
	
	
				//short text
				$field .= UixPageBuilderForm_ShortText::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ShortText::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ShortText::add( $args, 'js_vars' );
				
				//short units text
				$field .= UixPageBuilderForm_ShortUnitsText::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ShortUnitsText::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ShortUnitsText::add( $args, 'js_vars' );	
	
				//checkbox
				$field .= UixPageBuilderForm_Checkbox::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Checkbox::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Checkbox::add( $args, 'js_vars' );
	
				//color
				$field .= UixPageBuilderForm_Color::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Color::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Color::add( $args, 'js_vars' );
				
				//colormap
				$field .= UixPageBuilderForm_ColorMap::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ColorMap::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ColorMap::add( $args, 'js_vars' );
					
				
	
				//select
				$field .= UixPageBuilderForm_Select::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Select::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Select::add( $args, 'js_vars' );
	
				//image
				$field .= UixPageBuilderForm_Image::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Image::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Image::add( $args, 'js_vars' );
	
	
				//toggle 1
				$field .= UixPageBuilderForm_Toggle::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Toggle::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Toggle::add( $args, 'js_vars' );
	
				//list 1
				$field .= UixPageBuilderForm_ListClone::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ListClone::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ListClone::add( $args, 'js_vars' );
	
	


			} // end foreach
			

			//HTML output
			if ( $code == 'html' ) $output = self::format_formcode ( $before.$field.$after );
			
			//Javascript output
			if ( $code == 'js' || $code == 'javascript' ) $output = $jscode;
			
			//Javascript vars output
			if ( $code == 'js_vars' ) $output = $jscode_vars;		
			
			//Add simulation buttons
			if ( $code == 'active_btn' ) $output = '';		

			
		}
		
		
		
		
		return $output;
	
	}
		

	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
