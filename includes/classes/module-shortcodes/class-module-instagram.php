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
				'username'        => '',
				'custom_classes'  => '',
				'show'            => 10,
				'thumbsize'       => 'small',
				'displayname'     => 'false',
				
			 ), $atts ) );
			
			
			$return_string = '';
	
       
			//returns a big old hunk of JSON from a non-private IG account page.
			// @link https://gist.github.com/cosmocatalano/4544576
			$insta_source  = wp_remote_get('https://www.instagram.com/'.trim( $username ) );
			
			if ( 200 == wp_remote_retrieve_response_code( $insta_source ) ) {
				
				$shards        = explode( 'window._sharedData = ', $insta_source['body'] );
				$insta_json    = explode( ';</script>', $shards[1] ); 
				$insta_array   = json_decode( $insta_json[0], TRUE );

				//Do the deed
				$results_array = $insta_array;
				
				if ( isset( $results_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
					

					//An example of where to go from there
					$latest_array  = $results_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];

					$return_string .= '<div class="uix-pb-instagram-container '.$custom_classes.'">';
					if ( $displayname == 'true' ) {
						$return_string .= '<div class="uix-pb-instagram-feed-username"><a href="https://www.instagram.com/'.esc_attr( $username ).'/" target="_blank">@'.esc_html( $username ).'</a></div>';
					}

					$return_string .= '<ul class="uix-pb-instagram-box uix-pb-instagram-thumb-'.esc_attr( $thumbsize ).'">';

					if ( is_array( $latest_array ) ) {
						$latest_array   = array_slice( $latest_array, 0, $show );
						foreach ( $latest_array as $value ) {
							$link         = isset( $value['code'] ) ? trailingslashit( '//instagram.com/p/' . $value['code'] ) : 'javascript:void(0);';
							$like         = isset( $value['likes']['count'] ) ? $value['likes']['count'] : 0;
							$comments     = isset( $value['comments']['count'] ) ? $value['comments']['count'] : 0;
							$fullimg      = isset( $value['display_src'] ) ? $value['display_src'] : '';
							$thumbnail    = isset( $value['thumbnail_src'] ) ? $value['thumbnail_src'] : '';

							if ( ( strpos( $thumbnail, 's640x640' ) !== false ) ) {
								$thumbnail = str_replace( 's640x640', 's320x320', $thumbnail ); //s160x160, s320x320
							}


							$return_string .= '<li><a href="'.esc_url( $link ).'" target="_blank"><img width="320" height="320" src="'.esc_url( $thumbnail ).'"></a></li>';	

						}	

					}
					$return_string .= '</ul>';
					$return_string .= '</div>';
					
				}


				
			}
			
			
			return UixPBFormCore::str_compression(  $return_string );
		}

		
		
	}
		
	
}


UixPB_Instagram::init();
