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
			extract( shortcode_atts( array( 
				'style' => 'normal',
				'width' => '100%',
				'height' => '285px',
				'latitude' => 0,
				'longitude' => 0,
				'zoom' => 14,
				'name' => '',
				'marker' => '',
				
			 ), $atts ) );
			 
			if ( empty ( $marker ) ) $marker = UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-location.png';
		
			return '<div class="uix-page-builder-map-preview-tmpl"></div><div class="uix-page-builder-map-preview-container" data-width="'.esc_attr( $width ).'" data-height="'.esc_attr( $height ).'" data-style='.esc_attr( $style ).' data-latitude='.floatval( $latitude ).' data-longitude='.floatval( $longitude ).' data-zoom='.floatval( $zoom ).' data-name='.urlencode_deep( $name ).' data-marker='.esc_url( $marker ).'"></div>';
		}

		
		
	}
		
	
}


UixPB_Instagram::init();
