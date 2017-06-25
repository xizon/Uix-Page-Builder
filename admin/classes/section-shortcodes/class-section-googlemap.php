<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Google Map
 *
 */
if ( !class_exists( 'UixPB_Map' ) ) {
	class UixPB_Map {
	
	
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
			add_shortcode( 'uix_pb_map', array( __CLASS__, 'func' ) );
			
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
				'marker' => UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-location.png',
				
			 ), $atts ) );
			 
			
			return '<'.tag_escape( 'iframe' ).' class="uix-page-builder-map" style="border:none" width="'.esc_attr( $width ).'" height="'.esc_attr( $height ).'" src="'.UixPageBuilder::plug_directory().'admin/preview/map.php?style='.esc_attr( $style ).'&latitude='.floatval( $latitude ).'&longitude='.floatval( $longitude ).'&zoom='.floatval( $zoom ).'&name='.urlencode_deep( $name ).'&width='.esc_attr( $width ).'&height='.esc_attr( $height ).'&marker='.esc_url( $marker ).'"></'.tag_escape( 'iframe' ).'>';
		}

		
		
	}
		
	
}


UixPB_Map::init();
