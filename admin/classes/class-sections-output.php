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
		}
	
		
		/*
		 * Register shortcodes of front-end
		 *
		 *
		 */
		public static function do_my_shortcodes() {
			add_shortcode( 'uix_pb_sections', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {

			    $return_string     = '';
				$builder_content   = UixPageBuilder::page_builder_array_newlist( get_post_meta( get_the_ID(), 'uix-page-builder-layoutdata', true ) );
				$item              = array();
				$cols              = array( 
										array( '3_4', 'uix-pb-col-8' ),
										array( '1_4', 'uix-pb-col-4' ),
										array( '2_3', 'uix-pb-col-9' ),
										array( '1_3', 'uix-pb-col-3' ),
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

								$$key[0] = $key[ 1 ];
								$item[ UixPageBuilder::page_builder_item_name( $key[0] ) ]  =  $$key[0];
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
								    $bool2 = UixPageBuilder::inc_str( $value[ $temp_index ][0], 'uix_pb_section_undefined' );

									if ( $bool1 || $bool2 ) {

										$value = UixPageBuilder::theme_value( $value[$temp_index][1] );
										$html = ( !empty( $value ) ) ? $value : '&nbsp;';

										//Determine the grid system
										foreach ( $cols as $id ) :
											if ( $colid == $id[0] ) {
												$element_grid_before = '<div class="'.$id[1].' {last}">';
											}
										endforeach;

										$element_code .= $element_grid_before.$html.$element_grid_after;

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
