<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Google ContactForm
 *
 */
if ( !class_exists( 'UixPB_ContactForm' ) ) {
	class UixPB_ContactForm {
	
	
		public static function init() {
			add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
		}
	
		
		/*
		 * Register shortcodes of front-end
		 *
		 *
		 */
		public static function do_my_shortcodes() {
			add_shortcode( 'uix_pb_contact_form', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			extract( shortcode_atts( array( 
				'style' => 1,
				
			 ), $atts ) );
			 
			// capture output from the widgets
			ob_start();

			   comment_form();

				$out = ob_get_contents();
			ob_end_clean();

			$return_string = '';

			$pattern = "/<h3.+class=\"comment-reply-title\".*?>.*?<\/h3>/ism";

			$matchCount = preg_match_all( $pattern, $out, $match ); 
			if ( $matchCount > 0 ) {
				$return_string = str_replace( $match[0][0], '', $out );
			}


			// If comments are closed and there are comments,let's leave a little note,shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
				$return_string = '<p class="no-comments uix-sc-no-comments">'.__( 'Comments are closed.', 'uix-page-builder' ).'</p>';
			} 


		   return do_shortcode( UixPBFormCore::str_compression( $return_string ) );
		}

		
		
	}
		
	
}


UixPB_ContactForm::init();
