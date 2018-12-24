<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse WP Posts Categories
 *
 */
if ( !class_exists( 'UixPB_BlogCategories' ) ) {
	class UixPB_BlogCategories {
	
	
		public static function entry_categories() {
		
			//Used between list items, there is a space after the comma
			$separate_meta = esc_html__( ',&nbsp;', 'uix-page-builder' );

			$output      = array();
			$categories  = get_the_category();


			foreach ( $categories as $category ) { 

				$output[] = '<a title="'.esc_attr( sprintf( __( 'View all posts in %s', 'uix-page-builder' ), $category->name ) ).'" data-cat-id="'.esc_attr( $category->term_id ).'" href="'.esc_url( get_category_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a>';
			}

			$output = join( $separate_meta, $output );	

			return $output;
		}
		
		
		
	}
		
	
}



/**
 *  Parse Uix Products Categories
 *
 */
if ( !class_exists( 'UixPB_UixProductsCategories' ) ) {
	class UixPB_UixProductsCategories {
	
	
		public static function entry_categories() {
			
			//Used between list items, there is a space after the comma
			$separate_meta = esc_html__( ', ', 'uix-page-builder' );
			$output        = array();
			
			if ( class_exists( 'UixProducts' ) ) {
				
				$categories    = self::get_the_category_bytax( 'uix_products_category' );

				foreach ( $categories as $category ) { 

					$output[] = '<a title="'.esc_attr( sprintf( __( 'View all posts in %s', 'uix-page-builder' ), $category->name ) ).'" data-cat-id="'.esc_attr( $category->term_id ).'" href="'.esc_url( get_category_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a>';
				}

				$output = join( $separate_meta, $output );	
				
			}
			
			return $output;
		

		}
		
		

		public static function get_the_category_bytax( $tcat = 'category', $id = false ) {
			$categories = get_the_terms( $id, $tcat );
			if ( ! $categories )
				$categories = array();

			$categories = array_values( $categories );

			foreach ( array_keys( $categories ) as $key ) {
				_make_cat_compat( $categories[$key] );
			}

			// Filter name is plural because we return alot of categories (possibly more than #13237) not just one
			return apply_filters( 'get_the_categories', $categories );
		}	
		
		
		
		
	}
		
	
}