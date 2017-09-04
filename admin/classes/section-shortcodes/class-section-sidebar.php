<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Posts List
 *
 */
if ( !class_exists( 'UixPB_Sidebar' ) ) {
	class UixPB_Sidebar {
	
	
		public static function init() {
			add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
			add_action( 'admin_init', array( __CLASS__, 'do_my_shortcodes' ) ); //When switching the page template
		}
	
		
		/*
		 * Register shortcodes of front-end
		 *
		 *
		 */
		public static function do_my_shortcodes() {
			add_shortcode( 'uix_pb_sidebar', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			extract( shortcode_atts( array( 
				'id'            => '',
			 ), $atts ) );
			
			$return_string = '';
			
			if ( !empty( $id ) ) {
				
				$return_string .= '<div class="uix-pb-sidebar-container" role="complementary">';
				
				ob_start();
				
					if ( is_active_sidebar( $id ) ) {
						dynamic_sidebar( $id );
					}
				
					$return_string .= ob_get_contents();
				ob_end_clean();
				
				$return_string .= '</div>';
			
			}
			
			return do_shortcode( UixPBFormCore::str_compression(  $return_string ) );

		   
		}

		
		
	}
		
	
}


UixPB_Sidebar::init();
