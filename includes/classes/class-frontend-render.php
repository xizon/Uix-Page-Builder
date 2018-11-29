<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Output the front-end code
 *
 */
if ( !class_exists( 'UixPB_SectionsOutput' ) ) {
	class UixPB_SectionsOutput {
	
	
		public static function init() {
			add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
			add_action( 'admin_init', array( __CLASS__, 'do_my_shortcodes' ) ); //When switching the page template
			add_filter( 'body_class', array( __CLASS__, 'new_class' ) );

		}
		
		/*
		 * Extend the default WordPress body classes.
		 *
		 * The following two conditions will use the designer specified classes:
		 *   a) Choose from premade templates from .xml
		 *   b) Choose from some new templates saved in admin panel
		 *
		 */
		public static function new_class( $classes ) {

			$post_ID   = !isset( $_GET[ 'post_id' ] ) ? get_the_ID() : $_GET[ 'post_id' ];
			$tempclass = UixPageBuilder::page_builder_array_tempattrs( UixPageBuilder::get_page_final_data( $post_ID ), true );
			
			if ( empty( $tempclass ) ) $tempclass = sprintf( esc_attr__( 'Untitled-%1$s', 'uix-page-builder' ), $post_ID );

			$classes[] = 'uix-page-builder-body';
			$classes[] = 'uix-page-builder-'.$tempclass;
			$classes[] = $tempclass;
			
			return $classes;

		}
	
		
		/*
		 * Register shortcodes of front-end
		 *
		 *
		 */
		public static function do_my_shortcodes() {
			if ( !isset( $_GET['pb_preview'] ) ) {
				add_shortcode( 'uix_pb_sections', array( __CLASS__, 'func_frontend' ) );
			} else {
				add_shortcode( 'uix_pb_sections', array( __CLASS__, 'func_backend_render' ) );
			}
			
			
		}
	
		
		/**
		 * Shortcode of back-end render
		 *
		 */
		public static function func_backend_render( $atts, $content = null ) {
			return '<div class="uix-page-builder-themepreview-wp-shortcode"></div>';
		}

		
		/**
		 * Shortcode of front-end page
		 *
		 */
		public static function func_frontend( $atts, $content = null ) {
				extract( shortcode_atts( array( 
					'id'            => '',
				 ), $atts ) );
		
			
			    $post_ID = !isset( $_GET[ 'post_id' ] ) ? get_the_ID() : $_GET[ 'post_id' ];
			    if ( isset( $id ) && !empty( $id ) ) {
					$post_ID = $id;
				}

			    
			    $return_string     = '';
				$builder_content   = UixPageBuilder::page_builder_array_newlist( UixPageBuilder::get_page_final_data( $post_ID ) );
				$item              = array();
				$cols              = array( 
										array( '3_4', 'uix-pb-col-9' ),
										array( '1_4', 'uix-pb-col-3' ),
										array( '2_3', 'uix-pb-col-8' ),
										array( '1_3', 'uix-pb-col-4' ),
										array( '4__1', 'uix-pb-col-3' ),
										array( '4__2', 'uix-pb-col-3' ),
										array( '4__3', 'uix-pb-col-3' ),
										array( '4__4', 'uix-pb-col-3' ),
										array( '3__1', 'uix-pb-col-4' ),
										array( '3__2', 'uix-pb-col-4' ),
										array( '3__3', 'uix-pb-col-4' ),
										array( '2__1', 'uix-pb-col-6' ),
										array( '2__2', 'uix-pb-col-6' ),
										array( '1__1', 'uix-pb-col-12' )
									);

				if ( $builder_content && is_array( $builder_content ) ) {
					foreach ( $builder_content as $key => $value ) :
					
						$con                  = UixPageBuilder::page_builder_output( $value->content );
						$col                  = $value->col;
						$row                  = $value->row;
						$size_x               = $value->size_x;
						$section_id           = $value->secindex;
						$custom_id            = $value->customid;
						$section_title        = $value->title;
						$section_layout       = $value->layout;
						$element_code         = '';
						$element_grid_before  = '';
						$element_grid_after   = '</div>';




						if ( empty( $custom_id ) ) $custom_id = 'uix-page-builder-section-'.$row;


						if ( $con && is_array( $con ) ) {
							foreach ( $con as $key ) :

								${$key[0]} = $key[ 1 ];
								$item[ UixPageBuilder::page_builder_item_name( $key[0] ) ]  =  $key[ 1 ];
							endforeach;
						}

						//------------------------------------   loop sections
						if ( sizeof( $item ) > 3 && !empty( $value->content ) && $value->content != 'undefined' ) {

							$col_content     = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );

							if ( $col_content && is_array( $col_content ) ) {
								foreach ( $col_content as $key => $value ) :

									$colid           = $value[0][1]; //column id
									$temp_index      = count( $value ) - 1;

									$bool1 = UixPageBuilder::inc_str( $value[ $temp_index ][0], '_temp' );
									$bool2 = UixPageBuilder::inc_str( $value[ $temp_index ][0], 'uix_pb_module_undefined' );

									if ( $bool1 || $bool2 ) {

										$value = UixPageBuilder::theme_value( $value[$temp_index][1] );
										
										//The contents of attribute
										$html = ( !empty( $value ) ) ? $value : '&nbsp;';
										

										//Determine the grid system
										foreach ( $cols as $vid ) :
											if ( $colid == $vid[0] ) {
												$element_grid_before = '<div class="'.$vid[1].' {last}">';
											}
										endforeach;

										$element_code .= $element_grid_before.'<div id="'.UixPageBuilder::frontend_wrapper_id( '', $row, $colid ).'">'.$html.'</div>'.$element_grid_after;

									}



								endforeach;


								//Control the behavior of floating elements.
								$matchCount = preg_match( '/(.*){last}(.*)$/', $element_code, $matches );
								if ( $matchCount > 0 ) {

									$element_code = str_replace( '{last}', '',
													str_replace( '{last}'.$matches[2], 'uix-pb-col-last'.$matches[2], 
													$element_code 
													) );

								}

								//Fix the image path of the editor
								$upload_dir   = wp_upload_dir();
								$element_code = str_replace( '../wp-content/uploads/', trailingslashit( $upload_dir[ 'baseurl' ] ), $element_code );
								
								

								//Section container
								$return_string .=  '
								<div class="uix-pb-container'.( $section_layout == 'boxed' ? ' uix-pb-container-boxed' : ' uix-pb-container-fullwidth' ).'">
									<div class="uix-page-builder-section" data-pb-section-id="'.esc_attr( $row ).'" data-pb-section-title="'.esc_attr( $section_title ).'" id="'.esc_attr( $custom_id ).'">
										<div class="uix-pb-row">
										'.do_shortcode( $element_code ).'
										</div>
									</div>
								</div>
								';



							}


						}	
							
						//------------------------------------ end sections



					endforeach;




				}
		
			return do_shortcode( $return_string );
		}

		
		
	}
		
	
}


UixPB_SectionsOutput::init();
