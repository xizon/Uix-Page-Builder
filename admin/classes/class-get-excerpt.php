<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Excerpt
 *
 */
if ( !class_exists( 'UixPB_BlogExcerpt' ) ) {
	class UixPB_BlogExcerpt {
	
	
		public static function uix_pb_excerpt( $length = 150, $readmore = false, $readmore_t = '', $btnclass = '' ) {

			// Get global post
			global $post;

			// Get post data
			$id			    = $post->ID;
			$excerpt	    = $post->post_excerpt;
			$content        = $post->post_content;
			$readmore_link  = '';
			$readmore_text  = empty( $readmore_t ) ? esc_html__( 'Read More', 'uix-page-builder' ) : $readmore_t;
			

			//Ignore a more tag when using the_content()
			$content_ig_more  = str_replace( '<!--more-->', '', $post->post_content );	


			//More button
			if ( $readmore == true ) {
				$btn_text	= apply_filters( 'uix_pb_redmore_text', $readmore_text );
				$btn_link	= '<div class="uix-pb-blog-posts-read-more"><a data-id="'.esc_attr( get_the_ID() ).'"  class="'.esc_attr( $btnclass ).'" href="'. esc_url( get_permalink( $id ) ) .'">'. $btn_text .'</a></div>';
				$readmore_link = apply_filters( 'uix_pb_redmore_link', $btn_link );
			}


			if ( $excerpt ) {
				/**
				 * Display custom excerpt
				 *
				 * @since	1.0.0
				 */		
				$output = '<div class="uix-pb-blog-posts-excerpt-content">'.$excerpt.'</div>';


				if ( self::has_ultimate_excerpt( $output, $content_ig_more ) ) {
					$readmore_link = '';
				}

				$output .= $readmore_link;

				return $output;

			} else {

				/**
				 * Generate auto excerpt
				 *
				 * @since	1.0.0
				 */

				$wp_media_suffix = 'mp3|m4a|ogg|wav|mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2';

				// capture the post content with html
				ob_start();
					the_content();
					$out = ob_get_contents();
				ob_end_clean();

				//To determine whether the content includes media element
				$fr = tag_escape( 'iframe' );
				$md = explode( '|', $wp_media_suffix);

				//remove wp media
				if ( strpos( $out, $fr ) ) {
					$content = preg_replace( '/<'.$fr.'.*<\/'.$fr.'>/i', '', $out ); 
				}


				//strip shortcodes
				$content = strip_shortcodes( $content );

				//To determine whether the content includes chinese
				if ( preg_match('/[\p{Han}]/simu', $content ) ) {
					$output = wp_html_excerpt( $content, $length, '...' );
				} else {
					$output = wp_trim_words( $content, $length );
				}

				//remove hyperlink for video and audio
				if ( ! strpos( $out, $fr ) ) {
					foreach( $md as $v ) {
						if ( strpos( $out, $v ) ) {
							$output = preg_replace( '/(http)(.)*([a-z0-9\-\.\_])+\.('.$wp_media_suffix.')/i', '', $output );
							break;
						}

					}
				}
				
				$output = '<div class="uix-pb-blog-posts-excerpt-content">'.$output.'</div>';
				

				if ( empty( $output ) || self::has_ultimate_excerpt( $output, $content_ig_more ) ) {
					$readmore_link = '';
				}


				$output .= $readmore_link;

				return $output;

			}


		}
		
	

		public static function has_ultimate_excerpt( $str1, $str2 ) {

			if ( mb_strlen( wp_strip_all_tags( $str1, true ), 'UTF8' ) >= mb_strlen( wp_strip_all_tags( $str2, true), 'UTF8' )  ) {
				return true;
			} else {
				return false;
			}


		}	
		
		
		
	}
		
	
}

