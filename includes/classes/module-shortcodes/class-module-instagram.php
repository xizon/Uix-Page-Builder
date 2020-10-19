<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse A Simple Instagram Feed
 *
 */
if ( !class_exists( 'UixPB_Instagram' ) ) {
	class UixPB_Instagram {
	
	
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
			add_shortcode( 'uix_pb_instagram', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			
			$return_string = '';
			return UixPBFormCore::str_compression(  $return_string );
		}

		
		
	}
		
	
}


UixPB_Instagram::init();
