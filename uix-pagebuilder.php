<?php
/**
 * Uix Page Builder
 *
 * @author UIUX Lab <uiuxlab@gmail.com>
 *
 *
 * Plugin name: Uix Page Builder
 * Plugin URI:  https://uiux.cc/wp-plugins/uix-pagebuilder/
 * Description: Uix Page Builder is a design system that it is simple content creation interface.
 * Version:     1.0.0
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-pagebuilder
 * Domain Path: /languages
 */

class UixPageBuilder {
	
	const PREFIX      = 'uix';
	const HELPER      = 'uix-pagebuilder-helper';
	const NOTICEID    = 'uix-pagebuilder-helper-tip';
	const CUSTOMTEMP  = 'uix-pagebuilder-sections/sections/';
	const MAPAPI      = 'AIzaSyA0kxSY0g5flUWptO4ggXpjhVB-ycdqsDk';

	
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
		if ( ! defined( 'UIX_PAGEBUILDER_PLUGIN_DIR' ) ) {
			define( 'UIX_PAGEBUILDER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'UIX_PAGEBUILDER_PLUGIN_URL' ) ) {
			define( 'UIX_PAGEBUILDER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'UIX_PAGEBUILDER_PLUGIN_FILE' ) ) {
			define( 'UIX_PAGEBUILDER_PLUGIN_FILE', __FILE__ );
		}
	}

	/*
	 * Include required files.
	 *
	 *
	 */
	public static function includes() {
		require_once UIX_PAGEBUILDER_PLUGIN_DIR.'admin/post-extensions/post-extensions-init.php';
		require_once UIX_PAGEBUILDER_PLUGIN_DIR.'admin/classes/class-menu-onepage.php';
		require_once UIX_PAGEBUILDER_PLUGIN_DIR.'admin/classes/class-google-map.php';
	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Core
		if ( file_exists( self::backend_path( 'dir' ).'css/uix-pagebuilder.css' ) ) {
			wp_enqueue_style( self::PREFIX . '-pagebuilder', self::backend_path( 'uri' ).'css/uix-pagebuilder.css', false, self::ver(), 'all' );
		}
		if ( file_exists( self::backend_path( 'dir' ).'js/plugins.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-pagebuilder-plugins', self::backend_path( 'uri' ).'js/plugins.js', false, self::ver(), true );	
		}	
		if ( file_exists( self::backend_path( 'dir' ).'js/uix-pagebuilder.js' ) ) {
			wp_enqueue_script( self::PREFIX . '-pagebuilder', self::backend_path( 'uri' ).'js/uix-pagebuilder.js', array( 'jquery' ), self::ver(), true );	
			
			// Theme path in javascript file ( var templateUrl = wp_theme_root_path.templateUrl; )
			wp_localize_script( self::PREFIX . '-pagebuilder',  'wp_theme_root_path', array( 
				'templateUrl' => get_stylesheet_directory_uri()
			 ) );		
			
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
						
						//jQuery Accessible Tabs
						wp_enqueue_script( 'accTabs', self::plug_directory() .'admin/js/jquery.accTabs.js', array( 'jquery' ), '0.1.1');
						wp_enqueue_style( 'accTabs', self::plug_directory() .'admin/css/jquery.accTabs.css', false, '0.1.1', 'all');
					
						
						//Main
						wp_enqueue_style( self::PREFIX . '-pagebuilder', self::plug_directory() .'admin/css/style.css', false, self::ver(), 'all');
						
						//Jquery UI
						wp_enqueue_script( 'jquery-ui' );

						//Masonry
						wp_enqueue_script( 'masonry' );

				}
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-pagebuilder', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
		

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
			__( 'Uix Page Builder Settings', 'uix-pagebuilder' ),
			__( 'Uix Page Builder', 'uix-pagebuilder' ),
			'manage_options',
			self::HELPER,
			'uix_pagebuilder_options_page',
			'dashicons-editor-kitchensink',
			'82.' . rand( 0, 99 )
			
		);
	
        //Add sub links
		add_submenu_page(
			self::HELPER,
			__( 'Helper', 'uix-pagebuilder' ),
			__( 'Helper', 'uix-pagebuilder' ),
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
		 
		 require_once UIX_PAGEBUILDER_PLUGIN_DIR.'helper/settings.php';
	 }
	
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-pagebuilder' ) . '</a>';
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
				return get_template_directory_uri() .'/uix-pagebuilder-sections/';
			} else {
				return get_template_directory() .'/uix-pagebuilder-sections/';
			}
			
			
		} else {
			
			if ( $type == 'uri' )  {
				return self::plug_directory() .'uix-pagebuilder-sections/';
			} else {
				return self::plug_filepath() .'uix-pagebuilder-sections/';
				
			}
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
	
	    global $uix_pagebuilder_temp;
        if ( $uix_pagebuilder_temp === true ) { 
			$classes[] = 'uix-pagebuilder-body';
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
	public static function pagebuilder_output( $arr ) {
		
		$data = wp_specialchars_decode( $arr );
		$data = 	str_replace( '{rqt:}', '"',
				str_replace( '{apo:}', '&#039;',
				str_replace( '{cqt:}', '&quot;',
				str_replace( '{br:}', '<br>',
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
		
		
	public static function pagebuilder_analysis_rowcontent( $str ) {
		
		$data = 	str_replace( '{rowqt:}', '"',
			    $str 
			    );
		return json_decode( $data );
		
		
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

	      if( is_dir( get_stylesheet_directory() . '/uix-pagebuilder-sections' ) ) {
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
	
		
		echo "<li class=\"row col-".$col."\" id=\"widget-items-elements-detail-".$col."-'+uid+'\"><a class=\"button add-elements-btn\" href=\"javascript:\" data-elements=\"widget-items-elements-".$col."-'+uid+'\">".__( 'Add content', 'uix-pagebuilder' )."</a><textarea id=\"col-item-".$col."---'+uid+'\">[[{rqt:}col{rqt:},{rqt:}".$col."{rqt:}],[{rqt:}uix_pb_section_undefined|[col-item-".$col."---'+uid+'][uix_pb_undefined]['+sid+']{rqt:},{rqt:}{rqt:}]]</textarea></li>";
		
	}
	
	
	public static function list_page_sortable_li_btns( $col = '' ) {
	
		if ( self::tempfolder_exists() ) {
			include get_stylesheet_directory(). "/".self::CUSTOMTEMP."config.php";
			
		} else {
			include self::plug_filepath().self::CUSTOMTEMP."config.php";
		}
		
		$imgpath = self::backend_path( 'uri' ).'images/preview_thumbnail/';
		
		
		$btns = '<div class="uix-pagebuilder-col-tabs">';
	   
		foreach ( $uix_pb_config as $v ) {
			
			$btns .= '<h3>'.$v[ 'sortname' ].'</h3><div>';
			
			foreach ( $v[ 'buttons' ] as $key ) {
				
				$btns .= "<div class=\"uix-pagebuilder-col\"><a class=\"widget-item-btn ".$key[ 'id' ]."\" data-elements-target=\"widget-items-elements-detail-".$col."-'+uid+'\" data-slug=\"".$key[ 'id' ]."\" data-name=\"".esc_attr( $key[ 'title' ] )."\" data-id=\"'+uid+'\" data-col-textareaid=\"col-item-".$col."---'+uid+'\" href=\"javascript:\"><span class=\"t\">".$key[ 'title' ]."</span><span class=\"img\"><img src=\"".esc_url( $imgpath.$key[ 'thumb' ] )."\" alt=\"".esc_attr( $key[ 'title' ] )."\"></span></a></div>";
			}		
			
			$btns .= '</div>';
							
		}
		
		$btns .= '</div>';
				
		
		echo 'if ( jQuery( \'#widget-items-elements-'.$col.'-\'+uid+\'\' ).length < 1 ) {jQuery( \'body\' ).prepend( \'<div class="uixpbform-modal-box" id="widget-items-elements-'.$col.'-\'+uid+\'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">×</a><div class="content"><h2>'.__( 'Choose Element You Want', 'uix-pagebuilder' ).'</h2><div class="widget-items-container">'.$btns.'</div></div></div>\' ); var $grid = jQuery( ".js-tabs_panel" ).imagesLoaded( function() { $grid.masonry({itemSelector: ".uix-pagebuilder-col"}); }); if ( jQuery( document.body ).width() > 768 ) { jQuery( ".uix-pagebuilder-col-tabs" ).accTabs(); } }';
			
		
		
	}
	
		
	public static function list_page_itembuttons() {
	
	    echo "<div class=\"widget-items-col-container\"><button type=\"button\" class=\"add\"><i class=\"dashicons dashicons-text\"></i>".__( 'Layout', 'uix-pagebuilder' )."</button><div class=\"btnlist\"><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1__1\',\'\',\'\');\" class=\"widget-items-col widget-items-col-average-1\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'2__1\',\'\',\'\');\" class=\"widget-items-col widget-items-col-average-2\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'3__1\',\'\',\'\');\" class=\"widget-items-col widget-items-col-average-3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'4__1\',\'\',\'\');\" class=\"widget-items-col widget-items-col-average-4\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1_3\',\'\',\'\');\" class=\"widget-items-col widget-items-col-1_3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'2_3\',\'\',\'\');\" class=\"widget-items-col widget-items-col-2_3\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'1_4\',\'\',\'\');\" class=\"widget-items-col widget-items-col-1_4\"></a><a href=\"javascript:gridsterItemAddRow(0,'+uid+',\''+contentid+'\',\'3_4\',\'\',\'\');\" class=\"widget-items-col widget-items-col-3_4\"></a></div></div><span class=\"cols-content-data-container\" id=\"cols-content-data-'+uid+'\"></span><textarea id=\"cols-all-content-tempdata-'+uid+'\" class=\"temp-data temp-data-1\"></textarea><textarea id=\"cols-all-content-replace-'+uid+'\" class=\"temp-data temp-data-2\"></textarea>";

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
		
		$toggle_target_ID  = str_replace( '{colID}', ''.$cur_id.'-'.str_replace( 'col-item-', 'section_'.$widget_ID.'__', $col_id ), $clone_list_toggle_class );
		
		//Clone content
		$data = '<span class="dynamic-row dynamic-addnow">'.$clone_value.'<div class="delrow-container"><a href="javascript:" class="delrow delrow-'.$clone_trigger_id.'-'.$col_id.'">&times;</a></div></span>';
	
			 
		//Clone code
		$data = str_replace( '{index}', '['.$widget_ID.']',
		       str_replace( 'data-id="', 'id="'.$cur_id.'-',
			   str_replace( '][uix', ']'.$cur_id.'-[uix',
			   str_replace( '{dataID}', ''.$cur_id.'-',
			   str_replace( '{multID}', $toggle_target_ID,
			   str_replace( '{columnid}', $col_id,
			   str_replace( '{colID}', ''.$cur_id.'-'.str_replace( 'col-item-', 'section_'.$widget_ID.'__', $col_id ),
			   $data 
			   ) ) ) ) ) ) );
		
		
		//Toggle elements
		$data = str_replace( 'uixpbform_btn_trigger-toggleshow open', 'uixpbform_btn_trigger-toggleshow',
			   $data 
			   );		
		
		
		//Default value
		if ( $value && is_array( $value ) ) {
			foreach ( $value as $t_value ) {
				$data = str_replace( '"'.$t_value[ 'replace' ].'"', '"'.$t_value[ 'default' ].'"', $data );
				$data = str_replace( '>'.$t_value[ 'replace' ].'<', '>'.$t_value[ 'default' ].'<', $data );
			}	
		}
		
		//Clone list classes
		$data = str_replace( 'data-list="0"', 'data-list="1"',
			   str_replace( 'toggle-row', 'toggle-row toggle-row-clone-list',
			   $data 
			   ) );
			   
			   	   
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
						<p>' . __( '<strong>You need to create Uix Page Builder template files in your templates directory. You can create the files on the WordPress admin panel.</strong>', 'uix-pagebuilder' ) . ' <a class="button button-primary" href="' . admin_url( "admin.php?page=".self::HELPER."&tab=temp" ) . '">' . __( 'Create now!', 'uix-pagebuilder' ) . '</a><br>' . __( 'As a workaround you can use FTP, access the Uix Page Builder template files path <code>/wp-content/plugins/uix-pagebuilder/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-pagebuilder' ) . '</p>
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

	      if( !file_exists( get_stylesheet_directory() . '/page-uix_pagebuilder.php' ) ) {
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
						return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-pagebuilder' );
					} else {
						return __( '<div class="notice notice-error"><p><strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-pagebuilder' );
					}
	
				} else {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-error"><p><strong>There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-pagebuilder' );
						
					} else {
						return __( '<div class="notice notice-success"><p>Remove successful!</p></div>', 'uix-pagebuilder' );
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
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-pagebuilder' ).'"  /></p>';
				
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
			
				return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-pagebuilder' );
				
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
	
		require_once UIX_PAGEBUILDER_PLUGIN_DIR.'admin/add-ons/uixpbform/init.php';

	}
	
	
}

add_action( 'plugins_loaded', array( 'UixPageBuilder', 'init' ) );
