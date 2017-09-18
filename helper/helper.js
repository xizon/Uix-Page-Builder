( function( $ ) {
"use strict";
    $( function() {
	
		/*!
		 *
		 * Accordion
		 * ---------------------------------------------------
		 */
		$( '.uix-bg-custom-accordion h3' ).on( 'click', function() {
		    $( this ).parent().parent().find( '.uix-bg-custom-faq-con' ).slideUp();
			if( !$( this ).next().is( ':visible' ) ) {
				$( this ).next().slideDown();
			}	
		});
		
		
		/*!
		 *
		 * Custom CSS
		 * ---------------------------------------------------
		 */
		var uix_pb_dialog_wrapper = '.uix-page-builder-dialog-wrapper',
			uix_pb_dialog         = '.uix-page-builder-dialog-mask, .uix-page-builder-dialog';
		$( '.uix-page-builder-viewcss-btn' ).on( 'click', function( e ) {
			e.preventDefault();
			$( this ).closest( uix_pb_dialog_wrapper ).find( uix_pb_dialog ).show();
			
		});
		
		$( '.uix-page-builder-dialog .close' ).on( 'click', function( e ) {
			e.preventDefault();
			$( this ).closest( uix_pb_dialog_wrapper ).find( uix_pb_dialog ).hide();
		});
		
		

	} );
    
    
} ) ( jQuery );