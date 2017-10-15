<?php
/**
 * Callback before tag of form
 * 
 *
 * @param  {string} $widget_name          - Current widget name of section.
 * @param  {string} $form_id              - The form ID (Obtained via module ID).
 * @return {string}                       - HTML code.
 *
 * @access public
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPBFormCore_Components_Wrapper extends UixPBFormCore {


	/**
	 * Parameters for current form.
	 *
	 * @access private
	 *
	 */
	private $widget_name;
	private $form_id;
	
	
	public function __construct( $widget_name, $form_id ) {
		
		$this->widget_name  = $widget_name;
		$this->form_id      = $form_id;

		
	}
	
	
	public function form_before() {
		
		
		$widget_name = $this->widget_name;
		$form_id     = $this->form_id;
		$buttons     = '<div class="uixpbform-modal-buttons"><input type="button" class="close-uixpbform-modal uixpbform-modal-button uixpbform-modal-button-secondary uixpbform-modal-cancel-btn" value="'.__( 'Cancel', 'uix-page-builder' ).'" /><input type="submit" class="uixpbform-modal-button uixpbform-modal-button-primary uixpbform-modal-save-btn" value="'.__( 'Save', 'uix-page-builder' ).'" /></div>';
		
		if ( self::inc_str( $form_id, '_sample_hello2' ) ) {
			$buttons = '';
		}
		
		
		return '<div class="uixpbform-form-container"><div class="uixpbform-table-wrapper"><form method="post">'.$buttons.'<input type="hidden" name="section" value="'.$form_id.'"><input type="hidden" name="row" value=""><input type="hidden" name="widgetname" value="'.$widget_name.'"><input type="hidden" name="colid" value="">';
		
	}
	
	
	/*
	 * Callback after tag of form
	 *
	 * @return {string}                       - HTML code.
	 *
	 */
	public function form_after() {
		
		return '</form></div></div>';
		
	}
	

	
}

