<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse Posts List
 *
 */
if ( !class_exists( 'UixPB_Menu' ) ) {
	class UixPB_Menu {
	
	
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
			add_shortcode( 'uix_pb_menu', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			extract( shortcode_atts( array( 
				'id'            => '',
				'classname'     => '',
			 ), $atts ) );
			
			$return_string = '';
			
			if ( !empty( $id ) ) {
				
				$return_string .= '<nav class="uix-pb-menu-container">';
				
				ob_start();
				
				wp_nav_menu(
						array(
							'menu'            => $id,
							'container'       => false,
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => '',
							'menu_id'         => $id,
							'echo'            => true,
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul class="'.esc_attr( $classname ).'" id="uix-pb-menu-%1$s"><li class="uix-pb-menu-mobile-icon"><a href="javascript:void(0);">&#9776;</a></li>%3$s</ul>', 
							'depth'           => 0,
						)
					);	
				
					$return_string .= ob_get_contents();
				ob_end_clean();
				
				$return_string .= '</nav>';
			
			}
			
			return $return_string;

		   
		}

		
		
	}
		
	
}


UixPB_Menu::init();
