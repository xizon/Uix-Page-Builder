<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Posts List
 *
 */
if ( !class_exists( 'UixPB_Blog' ) ) {
	class UixPB_Blog {
	
	
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
			add_shortcode( 'uix_pb_blog', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			extract( shortcode_atts( array( 
				'show'            => 10, 
				'cat'             => 'all', 
				'order'           => 'desc',
				'excerpt_length'  => 35,
				'readmore_enable' => 0, 
				'readmore_text'   => esc_html__( 'Read More', 'uix-page-builder' ),
				'readmore_class'  => '', 
				'before'          => '', 
				'after'           => '', 

			 ), $atts ) );
			
			
			//Update except length 
			update_option( 'uix-page-builder-excerptlength', $excerpt_length );
			
			
			 $before         = wp_specialchars_decode( $before ).PHP_EOL;
			 $after          = wp_specialchars_decode( $after ).PHP_EOL;	
			 $readmore_class = str_replace( '&nbsp;', ' ' , str_replace( '&#160;', ' ' , $readmore_class ));
		

			if ( $cat != 'all' ) {

				if ( $order != 'rand' ) {
					$wp_query = new WP_Query( array(
									'post_type'       => 'post',
									'order'           => $order,
									'cat'             => $cat,
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				} else {
					$wp_query = new WP_Query( array(
									'post_type'       => 'post',
									'orderby'         => 'rand',
									'cat'             => $cat,
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				}



			} else {

				if ( $order != 'rand' ) {
					$wp_query = new WP_Query( array(
									'post_type'       => 'post',
									'order'           => $order,
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				} else {
					$wp_query = new WP_Query( array(
									'post_type'       => 'post',
									'orderby'         => 'rand',
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				}



			}



			 $return_string = '';

			if ( $wp_query->have_posts() ) {
			  while ( $wp_query->have_posts() ) : $wp_query->the_post();
				
				//excerpt
				if ( $readmore_enable == 0 ) {
					$excerpt_html = UixPB_BlogExcerpt::output( $excerpt_length, false );
				} else {
					$excerpt_html = UixPB_BlogExcerpt::output( $excerpt_length, true, $readmore_text, $readmore_class );
				}
				
				
			
				//featured image
				$thumbnail_src       =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
				$post_thumbnail_src  =  $thumbnail_src[0];  
				$post_thumbnail      = '<img src="'.esc_url( $post_thumbnail_src ).'" alt="'.esc_attr( get_the_title() ).'">';
				if ( empty( $post_thumbnail_src ) ) $post_thumbnail = '';


				/*
				 * Apply the filters by calling the 'uix_pb_blog_loop_return_string_callback' function we
				 * "hooked" to 'uix_pb_blog_loop_return_string_filter' using the add_filter() function above.
				 * - 'uix_pb_blog_loop_return_string_filter' is the filter hook $tag
				 * - 'filter me' is the value being filtered
				 * - $arg1 and $arg2 are the additional arguments passed to the callback.
				*/
				
				// Apply the filters by calling the 'uix_pb_blog_loop_return_string' function we "hooked" 
				// to 'uix_pb_blog_loop_return_string' using the add_filter() function above.
				
				
				
				//categories filterable
				$cat_text  = wp_strip_all_tags( UixPB_BlogCategories::entry_categories() );
				$cat_attr  = UixPageBuilder::transform_slug( $cat_text );
				$cat_group = '';
				if ( UixPageBuilder::inc_str( $cat_text, ',' ) ) {
					$cat_arr = explode( ',',$cat_text );
					$cat_new = array();
					if ( is_array( $cat_arr ) ) {
						foreach ( $cat_arr as $key ) {
							array_push( $cat_new, UixPageBuilder::transform_slug( rtrim( ltrim( $key ) ) ) );
						}
					}	
					
					$cat_group .= '[';
					foreach ( $cat_new as $key ) {
						$cat_group .= '"'.$key.'",';
					}
					$cat_group = rtrim( $cat_group, ',' );
					$cat_group .= ']';

				} else {
					$cat_group = '["'.$cat_attr.'"]';
				}
				

				
				
				$return_string .= str_replace( '{uix_pb_blog_attrs_link}', esc_url( get_permalink() ),
						   str_replace( '{uix_pb_blog_attrs_id}', esc_attr( get_the_ID() ),
						   str_replace( '{uix_pb_blog_attrs_title_attr}', esc_attr( get_the_title() ),
						   str_replace( '{uix_pb_blog_attrs_title}', esc_html( get_the_title() ), 
						   str_replace( '{uix_pb_blog_attrs_date_m}', get_the_time('m'),
						   str_replace( '{uix_pb_blog_attrs_date_M}', get_the_time('M'),
						   str_replace( '{uix_pb_blog_attrs_date_d}', get_the_time('d'),
						   str_replace( '{uix_pb_blog_attrs_date_y}', get_the_time('y'),
						   str_replace( '{uix_pb_blog_attrs_cat_link}', UixPB_BlogCategories::entry_categories(),	
						   str_replace( '{uix_pb_blog_attrs_cat_text}', $cat_text,  
						   str_replace( '{uix_pb_blog_attrs_cat_attr}', $cat_attr,  
						   str_replace( '{uix_pb_blog_attrs_cat_groupattr}', 'data-groups=\''.$cat_group.'\'', 
						   str_replace( '{uix_pb_blog_attrs_excerpt}', $excerpt_html,
						   str_replace( '{uix_pb_blog_attrs_thumbnail}', $post_thumbnail,
						   str_replace( '{uix_pb_blog_attrs_thumbnail_url}', esc_url( $post_thumbnail_src ),      
						   UixPageBuilder::decode( $content )
						   )))))))))))))))
						   .PHP_EOL;	

				
				$return_string = apply_filters( 'uix_pb_blog_loop_return_string_filter', $return_string );
					

			  endwhile;
			}

			// Reset post data to prevent conflicts with the main query 
			wp_reset_postdata();
			
	
			return do_shortcode( UixPBFormCore::str_compression(  $before.$return_string.$after ) );

		   
		}

		
		
	}
		
	
}


UixPB_Blog::init();
