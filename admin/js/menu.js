( function( $ ) {
"use strict";
    $( function() {

	   /*! 
		 * 
		 * Uix Page Builder Anchor Links
		 * ---------------------------------------------------
		 */
		$( '#uix-page-builder-anchorlinks' ).on( 'change', function() {
			
			var id = $( this ).val();
		
			$( '#uix_page_builder_anchorlinks_loader' ).show();
			
	
			// retrieve the widget settings form
			$.post( ajaxurl, {
				action               : 'uix_page_builder_anchorlinks_save_settings',
				postID               : id,
				security             : uix_page_builder_anchorlinks_data.send_string_nonce
			}, function ( response ) {
				$( '#uix-page-builder-anchorlinks-result' ).html( response );
				$( '#uix-page-builder-anchorlinks-selectall, #uix-page-builder-anchorlinks-addbtn' ).show();
				if ( response == '' ) {
					$( '#uix-page-builder-anchorlinks-selectall, #uix-page-builder-anchorlinks-addbtn' ).hide();
				}
				
				$( '#uix_page_builder_anchorlinks_loader' ).hide();
			});
			
			// stuff here
			return false;	
			
		});

	} );
    
} ) ( jQuery );