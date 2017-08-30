<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse WP Posts Excerpt
 *
 */
if ( !class_exists( 'UixPB_BlogExcerpt' ) ) {
	class UixPB_BlogExcerpt {
	
	
		public static function output( $length = 35, $readmore = false, $readmore_t = '', $btnclass = '' ) {

			$output          = '';
			$readmore_class  = esc_attr( $btnclass );
			$readmore_text   = empty( $readmore_t ) ? esc_html__( 'Read More', 'uix-page-builder' ) : $readmore_t;
			$excerptlength   = empty( $length ) ? 35 : absint( $length );
			
			//More button
			if ( $readmore == true ) {
				add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more' ) );
			} else {
				add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more_remove' ) );
			}
			
			//Except length 
			add_filter( 'excerpt_length', array( __CLASS__, 'custom_excerpt_length' ), 999 );
			
			
			//Capture the excerpt with html
			ob_start();
				the_excerpt();
				$output = ob_get_contents();
			ob_end_clean();
			
			
			//More button attributes
			$output = str_replace( '{{classname}}', $readmore_class,
					  str_replace( '{{label}}', $readmore_text,
					  $output 
					 ) );
			
		
			return $output;
			

		}
		
	
		/**
		 * Filter the "read more" excerpt string link to the post.
		 *
		 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
		 * @param string $more "Read more" excerpt string.
		 * @return string (Maybe) modified "read more" excerpt string.
		 */
		public static function excerpt_more( $more ) {
			return sprintf( '<div class="uix-pb-blog-posts-read-more"><a data-id="'.esc_attr( get_the_ID() ).'"  class="{{classname}}" href="%1$s">%2$s</a></div>',
				get_permalink( get_the_ID() ),
				'{{label}}'
			);
		}	
		
		public static function excerpt_more_remove( $more ) {
			return '';
		}	
		
		

		/**
		 * Filter the except length to 20 words.
		 *
		 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
		 * @param int $length Excerpt length.
		 * @return int (Maybe) modified excerpt length.
		 */
		public static function custom_excerpt_length( $length ) {
			$custom_length = absint( get_option( 'uix-page-builder-excerptlength', 35 ) );
			return $custom_length;
		}

								  
								  
	}
		
	
}



/**
 *  Parse Uix Products Excerpt
 *
 */
if ( !class_exists( 'UixPB_UixProductsExcerpt' ) ) {
	class UixPB_UixProductsExcerpt {
	
	
		public static function output( $length = 35, $readmore = false, $readmore_t = '', $btnclass = '' ) {

			$output          = '';
			$readmore_class  = esc_attr( $btnclass );
			$readmore_text   = empty( $readmore_t ) ? esc_html__( 'Read More', 'uix-page-builder' ) : $readmore_t;
			$excerptlength   = empty( $length ) ? 35 : absint( $length );
			
			//More button
			if ( $readmore == true ) {
				add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more' ) );
			} else {
				add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more_remove' ) );
			}
			
			//Except length 
			add_filter( 'excerpt_length', array( __CLASS__, 'custom_excerpt_length' ), 999 );
			
			
			//Capture the excerpt with html
			ob_start();
				the_excerpt();
				$output = ob_get_contents();
			ob_end_clean();
			
			
			//More button attributes
			$output = str_replace( '{{classname}}', $readmore_class,
					  str_replace( '{{label}}', $readmore_text,
					  $output 
					 ) );
			
		
			return $output;
			

		}
		
	
		/**
		 * Filter the "read more" excerpt string link to the post.
		 *
		 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
		 * @param string $more "Read more" excerpt string.
		 * @return string (Maybe) modified "read more" excerpt string.
		 */
		public static function excerpt_more( $more ) {
			return sprintf( '<a data-id="'.esc_attr( get_the_ID() ).'"  class="{{classname}}" href="%1$s">%2$s</a></div>',
				get_permalink( get_the_ID() ),
				'{{label}}'
			);
		}	
		
		public static function excerpt_more_remove( $more ) {
			return '';
		}	
		
		

		/**
		 * Filter the except length to 20 words.
		 *
		 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
		 * @param int $length Excerpt length.
		 * @return int (Maybe) modified excerpt length.
		 */
		public static function custom_excerpt_length( $length ) {
			$custom_length = absint( get_option( 'uix-page-builder-portfolio-excerptlength', 35 ) );
			return $custom_length;
		}

		
		
		
	}
		
	
}
