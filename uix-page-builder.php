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
 * Version:     1.1.4
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
	const CUSTOMTEMP       = 'uix-page-builder-custom/sections/';
	const MAPAPI           = 'AIzaSyA0kxSY0g5flUWptO4ggXpjhVB-ycdqsDk';
	const CLEANTEMP        = 0; // Clear custom template data when this value is "1" (For developer)
	const SHOWPAGESCREEN   = 0; // Show page builder core assets from "Pages Add New Screen" when this value is "1" (For developer)

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
	    self::setup_constants();
		self::includes();
		
		
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_filter( 'body_class', array( __CLASS__, 'new_class' ) );
		add_action( 'admin_footer', array( __CLASS__, 'call_sections' ) );
		add_action( 'admin_notices', array( __CLASS__, 'usage_notice_app' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'print_custom_stylesheet' ) );
		
	
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
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/post-extensions/post-extensions-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/post-extensions/visual-builder-init.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-menu-onepage.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-section-googlemap.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-section-contactform.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-sections-output.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/classes/class-xml.php';
		require_once UIX_PAGE_BUILDER_PLUGIN_DIR.'admin/uixpbform/init.php';
	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Core
		if ( file_exists( self::backend_path( 'dir' ).'css/uix-page-builder.css' ) ) {
			wp_enqueue_style( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'css/uix-page-builder.css', false, self::ver(), 'all' );
		}
		if ( file_exists( self::backend_path( 'dir' ).'js/plugins.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-page-builder-plugins', self::backend_path( 'uri' ).'js/plugins.js', false, self::ver(), true );	
		} else {

			// Shuffle
			wp_enqueue_script( 'shuffle', self::plug_directory() .'assets/add-ons/shuffle/jquery.shuffle.js', array( 'jquery' ), '3.1.1', true );

			// Shuffle.js requires Modernizr..
			wp_enqueue_script( 'modernizr', self::plug_directory() .'assets/add-ons/HTML5/modernizr.min.js', false, '3.3.1', false );

			// Easy Pie Chart
			wp_enqueue_script( 'easypiechart', self::plug_directory() .'assets/add-ons/piechart/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.7', true );

			//flexslider
			wp_enqueue_script( 'flexslider', self::plug_directory() .'assets/add-ons/flexslider/jquery.flexslider.min.js', array( 'jquery' ), '2.5.0', true	);
			wp_enqueue_style( 'flexslider', self::plug_directory() .'assets/add-ons/flexslider/flexslider.css', false, '2.5.0', 'all' );

			// Parallax
			wp_enqueue_script( 'bgParallax', self::plug_directory() .'assets/add-ons/parallax/jquery.bgParallax.js', array( 'jquery' ), '1.1.3', true );
							  
		}
		
		if ( file_exists( self::backend_path( 'dir' ).'js/uix-page-builder.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-page-builder', self::backend_path( 'uri' ).'js/uix-page-builder.js', array( 'jquery' ), self::ver(), true );	
			
			// Theme path in javascript file ( var templateUrl = wp_theme_root_path.templateUrl; )
			wp_localize_script( self::PREFIX . '-page-builder',  'wp_theme_root_path', array( 
				'templateUrl' => get_stylesheet_directory_uri()
			 ) );		
			
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
			__( 'Custom CSS', 'uix-page-builder' ),
			__( 'Custom CSS', 'uix-page-builder' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=custom-css'
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
	 * Returns custom back-end panel directory or directory URL
	 *
	 */
	public static function backend_path( $type = 'uri' ) {
	
		if ( self::tempfolder_exists() ) {
			
			if ( $type == 'uri' )  {
				return get_template_directory_uri() .'/uix-page-builder-custom/';
			} else {
				return get_template_directory() .'/uix-page-builder-custom/';
			}
			
			
		} else {
			
			if ( $type == 'uri' )  {
				return self::plug_directory() .'uix-page-builder-custom/';
			} else {
				return self::plug_filepath() .'uix-page-builder-custom/';
				
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
	 * Extend the default WordPress body classes.
	 *
	 *
	 */
	public static function new_class( $classes ) {
	
	    $classes[] = 'uix-page-builder-body';
		return $classes;

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
	public static function page_builder_array_newlist( $arr ) {
		
		$data = esc_textarea( $arr );
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
	 * Output content of page builder
	 *
	 */	
	public static function page_builder_output( $arr ) {
		
		$data = wp_specialchars_decode( $arr );
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
			$data = str_replace( '&lt;br&gt;', '<br>',
								
					//Returns string in order to protect the security output of JSON
					str_replace( '{rowcsql:}', '[', 
					str_replace( '{rowcsqr:}', ']',
					str_replace( 'amp;', '',   //step 2
					str_replace( '&amp;', '&', //step 1
					
								
					$data 
				   ) ) ) ) );	
	
		}
			   
		return json_decode( $data, true );
		
	}		
		
		
	public static function page_builder_analysis_rowcontent( $str ) {
		
		$data = 	str_replace( '{rowqt:}', '"',
			    $str 
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

	      if( is_dir( get_stylesheet_directory() . '/uix-page-builder-custom' ) ) {
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
						
						if ( file_exists( get_stylesheet_directory(). "/".self::CUSTOMTEMP."".$key[ 'id' ].".php" ) ) {
							include get_stylesheet_directory(). "/".self::CUSTOMTEMP."".$key[ 'id' ].".php";
						}
						
					}						
				}

			} else {
				include self::plug_filepath().self::CUSTOMTEMP."config.php";
				
				foreach ( $uix_pb_config as $v ) {
					foreach ( $v[ 'buttons' ] as $key ) {
						
						if ( file_exists( self::plug_filepath().self::CUSTOMTEMP."".$key[ 'id' ].".php" ) ) {
							include self::plug_filepath().self::CUSTOMTEMP."".$key[ 'id' ].".php";
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
		
		$imgpath = self::backend_path( 'uri' ).'images/preview_thumbnail/';
		
		
		$btns = '<div class="uix-page-builder-col-tabs">';
	   
		foreach ( $uix_pb_config as $v ) {
			
			$btns .= '<h3>'.$v[ 'sortname' ].'</h3><div>';
			
			foreach ( $v[ 'buttons' ] as $key ) {
				
				$btns .= "<div class=\"uix-page-builder-col\"><a class=\"widget-item-btn ".$key[ 'id' ]."\" data-elements-target=\"widget-items-elements-detail-".$col."-'+uid+'\" data-slug=\"".$key[ 'id' ]."\" data-name=\"".esc_attr( $key[ 'title' ] )."\" data-id=\"'+uid+'\" data-col-textareaid=\"col-item-".$col."---'+uid+'\" href=\"javascript:\"><span class=\"t\">".$key[ 'title' ]."</span><span class=\"img\"><img src=\"".esc_url( $imgpath.$key[ 'thumb' ] )."\" alt=\"".esc_attr( $key[ 'title' ] )."\"></span></a></div>";
			}		
			
			$btns .= '</div>';
							
		}
		
		$btns .= '</div>';
				
		
		echo 'if ( jQuery( \'#widget-items-elements-'.$col.'-\'+uid+\'\' ).length < 1 ) {jQuery( \'body\' ).prepend( \'<div class="uixpbform-modal-box uixpbform-modal-box-elementsselector" id="widget-items-elements-'.$col.'-\'+uid+\'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'.__( 'Choose Element You Want', 'uix-page-builder' ).'</h2><div class="widget-items-container">'.$btns.'</div></div></div>\' ); if ( jQuery( document.body ).width() > 768 ) { jQuery( ".uix-page-builder-col-tabs" ).accTabs(); } }';
			
		
		
	}
	
		
	public static function list_page_itembuttons() {
	
	    echo "<div class=\"widget-items-col-container\"><button type=\"button\" class=\"add\"><i class=\"dashicons dashicons-text\"></i>".__( 'Layout', 'uix-page-builder' )."</button><div class=\"btnlist\"><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1__1\',\'\',\'\');\"  title=\"".esc_attr__( '1/1', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-1\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'2__1\',\'\',\'\');\" title=\"".esc_attr__( '1/2', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-2\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'3__1\',\'\',\'\');\" title=\"".esc_attr__( '1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'4__1\',\'\',\'\');\" title=\"".esc_attr__( '1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-4\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1_3\',\'\',\'\');\" title=\"".esc_attr__( '1/3, 2/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'2_3\',\'\',\'\');\" title=\"".esc_attr__( '2/3, 1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-2_3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1_4\',\'\',\'\');\" title=\"".esc_attr__( '1/4, 3/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_4\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'3_4\',\'\',\'\');\" title=\"".esc_attr__( '3/4, 1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-3_4\"></a></div></div><span class=\"cols-content-data-container\" id=\"cols-content-data-'+uid+'\"></span><textarea id=\"cols-all-content-tempdata-'+uid+'\" class=\"temp-data temp-data-1\"></textarea><textarea id=\"cols-all-content-replace-'+uid+'\" class=\"temp-data temp-data-2\"></textarea>";

	}
				
		
	/*
	 * Returns form id
	 *
	 *
	 */
	public static function fid( $col_id, $section_row, $field ) {
		$colid = str_replace( 'col-item-', 'section_'.$section_row.'__', $col_id );
		return $colid.'_'.$field;
	}	

	
	
	/*
	 * Returns form name
	 *
	 *
	 */
	public static function fname( $col_id, $form_id, $field ) {
		return $form_id.'|['.$col_id.']['.$field.']{index}';
	}
	
		
	/*
	 * Returns form value
	 *
	 *
	 */
	public static function fvalue( $col_id, $section_row, $arr, $field, $default = '' ) {
		
		$result = '';
		if ( is_array( $arr ) && array_key_exists( '['.$col_id.']['.$field.']['.$section_row.']', $arr ) ) {
			$result = $arr[ '['.$col_id.']['.$field.']['.$section_row.']' ];
		} else {
			$result = $default;
		}
		
		$result = str_replace( '{rowcapo:}', '&#039;',
			 	 str_replace( '{rowcqt:}', '&quot;',
				 

			    $result
			    ) );	
				
				
		return $result;
		
	
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
	 * Push the clone form of saved data
	 *
	 *
	 */
	public static function push_cloneform( $clone_trigger_id, $cur_id, $col_id, $clone_value, $section_row, $value, $clone_list_toggle_class = '' ) {
		
		$widget_ID         = $section_row;
		
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
				
				if ( self::inc_str( $data, 'chk-id-input="'.$t_value[ 'id' ].'"' ) ) {
					$data = str_replace( 'chk-id-input="'.$t_value[ 'id' ].'"', 'value="'.esc_attr( self::inputtextareavalue( $t_value[ 'default' ] ) ).'"', $data );	
				}
				if ( self::inc_str( $data, 'chk-id-textarea="'.$t_value[ 'id' ].'"' ) ) {
					$data = str_replace( 'chk-id-textarea="'.$t_value[ 'id' ].'"', '>'.esc_textarea( self::inputtextareavalue( $t_value[ 'default' ] ) ).'</textarea>', $data );	
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
	 * Display categories on page
	 *
	 *
	 */
	public static function cat_list( $str, $classprefix = 'uix-pb-portfolio-' ) {

		$list = array();  
		$html = array();  
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
				array_push( $html, '<li><a href="javascript:" data-group="'.$key[ 'slug' ].'">'.$key[ 'name' ].'</a></li>' );
			}
			$html = array_unique( $html );
			
			foreach ( $html as $key ) {
				$code .= $key;
			}	
			
			return $code;

		} else {
			return '';
		}
	
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
						__('You could <a class="button button-small" href="%s">create</a> Uix Page Builder template file (from the directory <strong>"/wp-content/plugins/uix-page-builder/theme_templates/page-uix_page_builder.php"</strong> ) in your templates directory.  ', 'Anyword'), 
						admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" )
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
		$filepath = UIX_PAGE_BUILDER_PLUGIN_DIR. 'theme_templates/';
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
		  $filepath = UIX_PAGE_BUILDER_PLUGIN_DIR. 'theme_templates/';
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
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
