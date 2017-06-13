<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Categories
 *
 */
if ( !class_exists( 'UixPB_BlogCategories' ) ) {
	class UixPB_BlogCategories {
	
	
		public static function entry_categories() {
		
			//Used between list items, there is a space after the comma
			$separate_meta = esc_html__( ', ', 'uiuxlabtheme' );

			$output      = array();
			$categories  = get_the_category();


			foreach ( $categories as $category ) { 

				$output[] = '<a title="'.esc_attr( sprintf( __( 'View all posts in %s', 'uiuxlabtheme' ), $category->name ) ).'" data-cat-id="'.esc_attr( $category->term_id ).'" href="'.esc_url( get_category_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a>';
			}

			$output = join( $separate_meta, $output );	

			return $output;
		}
		
		
		
	}
		
	
}

