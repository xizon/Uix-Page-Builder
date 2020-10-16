<?php
/**
 * List buttons of sortable row selector in admin panel
 * 
 * @access public
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPB_Components_SortableRow_btn extends UixPageBuilder {

	
	/**
	 * Column ID
	 *
	 * @access private
	 * @var string
	 */
	private $col;
	
	
	public function __construct( $col ) {
		
		$this->col = $col;
		echo $this -> output();
		
	}
	
	private function output() {
		
		$col = $this->col;

		if ( self::tempfolder_exists() ) {

			$theme_template_modules_path = self::get_theme_template_modules_path();

			include get_stylesheet_directory(). "/".$theme_template_modules_path."config.php";

		} else {
			include self::plug_filepath().self::CUSTOMTEMP."config.php";
		}

		$imgpath_auto     = self::get_img_path( 'thumb' ).'images/UixPageBuilderThumb/';
		$imgpath_auto_dir = self::get_img_path( 'thumb', 0, 'dir' ).'images/UixPageBuilderThumb/';
		$imgpath_plug     = self::get_img_path( 'thumb', 2 ).'images/UixPageBuilderThumb/';
		

		$btns = '<div class="uix-page-builder-col-tabs">';

		foreach ( $uix_pb_config as $v ) {

			$btns .= '<h3>'.$v[ 'sortname' ].'</h3><div>';

			foreach ( $v[ 'buttons' ] as $key ) {

				if ( !empty( $key[ 'id' ] ) ) {
					$keyid  = str_replace( '.php', '', $key[ 'id' ] );
					
					//If there is no image in the theme directory, then switch to the plugin directory
					if( !file_exists( $imgpath_auto_dir.$key[ 'thumb' ] ) ) {
						$imgsrc = ( !empty( $key[ 'thumb' ] ) ) ? $imgpath_plug.$key[ 'thumb' ] : $imgpath_plug.'_none.png';
					} else {
						$imgsrc = ( !empty( $key[ 'thumb' ] ) ) ? $imgpath_auto.$key[ 'thumb' ] : $imgpath_auto.'_none.png';
					}
					

					$btns .= "<div class=\"uix-page-builder-col\"><a class=\"widget-item-btn ".$keyid."\" data-elements-target=\"widget-items-elements-detail-".$col."-'+uid+'\" data-slug=\"".$keyid."\" data-name=\"".esc_attr( $key[ 'title' ] )."\" data-id=\"'+uid+'\" data-col-textareaid=\"col-item-".$col."---'+uid+'\" href=\"javascript:\"><span class=\"t\">".$key[ 'title' ]."</span><span class=\"img\"><img src=\"".esc_url( $imgsrc )."\" alt=\"".esc_attr( $key[ 'title' ] )."\"></span></a></div>";

				}


			}		

			$btns .= '</div>';

		}

		$btns .= '</div>';


		return 'if ( jQuery( \'#widget-items-elements-'.$col.'-\'+uid+\'\' ).length < 1 ) {jQuery( \'body\' ).prepend( \'<div class="uixpbform-modal-box uixpbform-modal-box-elementsselector" id="widget-items-elements-'.$col.'-\'+uid+\'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'.__( 'Choose Element You Want', 'uix-page-builder' ).'</h2><div class="widget-items-container">'.$btns.'</div></div></div>\' ); if ( jQuery( document.body ).width() > 768 ) { jQuery( ".uix-page-builder-col-tabs" ).UixPBComColTabs(); } }';



	}



}

