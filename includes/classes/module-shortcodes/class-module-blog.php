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
				'pagination'      => 0,
				'loop_layout'     => 1,
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
			
			
			 $show           = intval( $show );
			 $before         = wp_specialchars_decode( $before ).PHP_EOL;
			 $after          = wp_specialchars_decode( $after ).PHP_EOL;	
			 $readmore_class = str_replace( '&nbsp;', ' ' , str_replace( '&#160;', ' ' , $readmore_class ));
		
			
			//Loop posts with your current theme.
			if ( $loop_layout == 2 ) {
				 $before = '';
				 $after  = '';	
			}
			
				
			
			//static front page & custom page @https://codex.wordpress.org/Pagination
			if ( get_query_var( 'paged' ) ) { 
				$paged = get_query_var( 'paged' ); 
			} elseif ( get_query_var( 'page' ) ) { 
				$paged = get_query_var( 'page' ); 
			} else { 
				$paged = 1; 
			}

			
			
			if ( $cat != 'all' ) {

				if ( $order != 'rand' ) {
					$wp_query = new WP_Query( array(
						            'paged'           => $paged,
									'post_type'       => 'post',
									'order'           => $order,
									'cat'             => $cat,
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				} else {
					$wp_query = new WP_Query( array(
						            'paged'           => $paged,
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
						            'paged'           => $paged,
									'post_type'       => 'post',
									'order'           => $order,
									'posts_per_page'  => $show ,
									'post_status'     => 'publish',
								)
					);	
				} else {
					$wp_query = new WP_Query( array(
						            'paged'           => $paged,
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
				
			  
		      if ( $loop_layout == 2 ) {
				    //---------------- Loop posts with your current theme.
				    
				    $out = '';
					ob_start();
				        while ( $wp_query->have_posts() ) : $wp_query->the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;
				  
						$out = ob_get_contents();
					ob_end_clean();
				  
				    if ( empty( $out ) ) {
						ob_start();
							while ( $wp_query->have_posts() ) : $wp_query->the_post();
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;

							$out = ob_get_contents();
						ob_end_clean();	
						
					}
				  
				    $return_string .= $out;

				  
			  } else {
				    //---------------- Loop posts with this plugin.
				  
				  while ( $wp_query->have_posts() ) : $wp_query->the_post();

						//excerpt
						if ( $readmore_enable == 0 ) {
							$excerpt_html = UixPB_BlogExcerpt::output( $excerpt_length, false );
						} else {
							$excerpt_html = UixPB_BlogExcerpt::output( $excerpt_length, true, $readmore_text, $readmore_class );
						}



						//featured image
						$thumbnail_src       =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
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

							foreach ( $cat_new as $key ) {
								$cat_group .= $key.',';
							}
							$cat_group = rtrim( $cat_group, ',' );
			

						} else {
							$cat_group = $cat_attr;
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
								   str_replace( '{uix_pb_blog_attrs_cat_groupattr}', 'data-groups-name="'.$cat_group.'"', 
								   str_replace( '{uix_pb_blog_attrs_excerpt}', $excerpt_html,
								   str_replace( '{uix_pb_blog_attrs_thumbnail}', $post_thumbnail,
								   str_replace( '{uix_pb_blog_attrs_thumbnail_url}', esc_url( $post_thumbnail_src ), 
								   str_replace( '{uix_pb_blog_attrs_format}', get_post_format(),   
								   $content
								   ))))))))))))))))
								   .PHP_EOL;	


						$return_string = apply_filters( 'uix_pb_blog_loop_return_string_filter', $return_string );


					endwhile;
				  
			  }
				
				
				/*
				 * Display Pagination
				 *
				 * Note: At this time, the_posts_pagination function is not working.
				 *
				 */
			   $pagecode = '';
			   if ( $pagination == 1 ) {
				   
					$GLOBALS[ 'paged_temp' ]  = 1;
					$pagehtml                = '';
					$pageshow                = '';
					$pagehtml_before         = '<ul>'.PHP_EOL;
					$pagehtml_after          = '</ul>'.PHP_EOL;


					// Get currect number of pages and define total var
					$total = $wp_query->max_num_pages;


					// Display pagination if total var is greater then 1 ( current query is paginated )
					if ( $total > 1 )  {

						// Set current page if not defined
						if ( ! $current_page = get_query_var( 'paged') ) {
							 $current_page = 1;
						 }

						// Get currect format
						if ( get_option( 'permalink_structure') ) {
							$format = 'page/%#%/';
						} else {
							$format = '&paged=%#%';
						}

						// Display pagination @https://codex.wordpress.org/Function_Reference/paginate_links
						$paginate = paginate_links(array(
							'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
							'format'    => $format,
							'current'   => max( 1, $paged ),
							'total'     => $total,
							'mid_size'  => 3,
							'type'      => 'array',
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						) );

						if( is_array( $paginate ) ) {

							foreach ( $paginate as $page ) {

									if ( strpos( $page, 'prev') ){
										$pagehtml .= '<li class="previous">'.$page.'</li>'.PHP_EOL;
									}elseif ( strpos( $page, 'next' ) ){
										$pagehtml .= '<li class="next">'.$page.'</li>'.PHP_EOL;
									}elseif ( strpos( $page, 'current' ) ){
										$pagehtml .= '<li class="active">'.$page.'</li>'.PHP_EOL;
									}else{
										$pagehtml .= '<li>'.$page.'</li>'.PHP_EOL;
									}

							}

						}


						$pageshow = $pagehtml_before.$pagehtml.$pagehtml_after;

					}

				

				   $pagecode .= '<div class="uix-pb-pagination-container">';
				   $pagecode .= $pageshow;
				   $pagecode .= '</div>';
			   } 
		
				
			}

			// Reset post data to prevent conflicts with the main query 
			wp_reset_postdata();
			
	
			return do_shortcode( UixPBFormCore::str_compression(  $before.$return_string.$after.$pagecode ) );

		   
		}

		
		
		/*
		 * Display Pagination
		 *
		 *
		 */
		public static function pagination( $show = 3, $custom_prev = '&larr;', $custom_next = '&rarr;', $li = true, $inf_enable = false ) {



		}

		
	}
		
	
}


UixPB_Blog::init();
