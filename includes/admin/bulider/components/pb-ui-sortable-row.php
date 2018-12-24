<?php
/**
 * List sortable row selector of modules in admin panel
 * 
 * @access public
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPB_Components_SortableRow extends UixPageBuilder {

	
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

		return "<li class=\"row col-".$col."\" id=\"widget-items-elements-detail-".$col."-'+uid+'\"><a class=\"button add-elements-btn\" href=\"javascript:\" data-elements=\"widget-items-elements-".$col."-'+uid+'\"><i class=\"dashicons dashicons-plus\"></i></a><textarea id=\"col-item-".$col."---'+uid+'\">[[{rqt:}col{rqt:},{rqt:}".$col."{rqt:}],[{rqt:}uix_pb_module_undefined|[col-item-".$col."---'+uid+'][uix_pb_undefined]['+sid+']{rqt:},{rqt:}{rqt:}]]</textarea></li>";

	}


}

