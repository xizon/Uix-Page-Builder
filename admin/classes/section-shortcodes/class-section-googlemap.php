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
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_map_display_script' ) );
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
				'marker' => '',
				
			 ), $atts ) );
			 
			if ( empty ( $marker ) ) $marker = UixPageBuilder::plug_directory() .'admin/uixpbform/images/map/map-location.png';
		
			return '<div class="uix-page-builder-map-preview-tmpl"></div><div class="uix-page-builder-map-preview-container" data-width="'.esc_attr( $width ).'" data-height="'.esc_attr( $height ).'" data-style='.esc_attr( $style ).' data-latitude='.floatval( $latitude ).' data-longitude='.floatval( $longitude ).' data-zoom='.floatval( $zoom ).' data-name='.urlencode_deep( $name ).' data-marker='.esc_url( $marker ).'"></div>';
		}

		
		
		/**
		 * Add map display’s JavaScript to your theme
		 *
		 */
		function enqueue_map_display_script() {
			
			$script = '
				!function(a){var b={};a.UixPBTmpl=function a(c,d){var e=/\W/.test(c)?new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push(\'"+c.replace(/[\r\t\n]/g," ").split("<%").join("\t").replace(/((^|%>)[^\t]*)\'/g,"$1\r").replace(/\t=(.*?)%>/g,"\',$1,\'").split("\t").join("\');").split("%>").join("p.push(\'").split("\r").join("\\\'")+"\');}return p.join(\'\');"):b[c]=b[c]||a(null===document.getElementById(c)?\'<div data-tmpl="0"></div>\'+c:document.getElementById(c).innerHTML);return d?e(d):e},a.fn.UixPBTmpl=function(b,c){return this.each(function(){var d=a.UixPBTmpl(b,c);a(this).html(d).promise().done(function(){a("#uix-page-builder-themepreview").load(function(){a(this).contents().text().search("[uix_pb_sections]")>0&&a(document).UixPBRenderWPShortcode({postID:uix_page_builder_layoutdata.send_string_postid})})})})}}(jQuery);

				( function( $ ) {
				"use strict";
					$( function() {

						$( ".uix-page-builder-map-preview-container" ).each( function( index )  {

							var $frame = $( this );

							$frame.prev( ".uix-page-builder-map-preview-tmpl" ).load( "'.UixPageBuilder::plug_directory().'admin/preview/map.html", function( response, status, xhr ) {

								response = response.replace(/\<script([^>]+)\>/g, "" ).replace(/\<\/script\>/g, "" );

								$frame.UixPBTmpl( response, {
									pluginPath : "'.UixPageBuilder::plug_directory().'",
									width      : $frame.data( "width" ),
									height     : $frame.data( "height" ),
									style      : $frame.data( "style" ),
									latitude   : $frame.data( "latitude" ),
									longitude  : $frame.data( "longitude" ),
									zoom       : $frame.data( "zoom" ),
									name       : $frame.data( "name" ),
									marker     : $frame.data( "marker" )
								} );
							});

						});


					} );

				} ) ( jQuery );	
			';
			
		    wp_add_inline_script( UixPageBuilder::PREFIX . '-page-builder', UixPBFormCore::str_compression( $script ) );
		}
		
		
	}
		
	
}


UixPB_Map::init();
