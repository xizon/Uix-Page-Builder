<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
/**
 * Filters content and keeps only allowable HTML elements.
 *
 */
if( !function_exists( 'uix_pb_kses' ) ) {
	function uix_pb_kses( $html ){

		$allowed_tags = wp_kses_allowed_html( 'post' );
		return wp_kses( $html, $allowed_tags );

	}
}


