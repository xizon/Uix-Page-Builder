<?php
/**
 * List column buttons of sortable row selector in admin panel
 * 
 * @access public
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPB_Components_SortableRow_ColumnBtn extends UixPageBuilder {

	
	public function __construct() {
		
		echo $this -> output();
		
	}

	private function output() {

		return "<div class=\"widget-items-col-container\"><button type=\"button\" class=\"add\"><i class=\"dashicons dashicons-text\"></i>".__( 'Layout', 'uix-page-builder' )."</button><div class=\"btnlist\"><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\"  title=\"".esc_attr__( '1/1', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-1\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"2__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/2', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-2\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"3__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"4__1\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-average-4\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1_3\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/3, 2/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"2_3\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '2/3, 1/3', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-2_3\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"1_4\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '1/4, 3/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-1_4\"></a><a data-add=\"0\" data-uid=\"'+uid+'\" data-contentid=\"'+contentid+'\" data-col=\"3_4\" data-content=\"\"  data-list=\"\" href=\"javascript:void(0);\" title=\"".esc_attr__( '3/4, 1/4', 'uix-page-builder' )."\" class=\"widget-items-col widget-items-col-3_4\"></a></div></div><span class=\"cols-content-data-container\" id=\"cols-content-data-'+uid+'\"></span><textarea id=\"cols-all-content-tempdata-'+uid+'\" class=\"temp-data temp-data-1\"></textarea><textarea id=\"cols-all-content-replace-'+uid+'\" class=\"temp-data temp-data-2\"></textarea>";

	}


}

