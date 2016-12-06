( function( $ ) {
"use strict";
    $( function() {

	   /*! 
		 * 
		 * Uix Page Builder Anchor Links
		 * ---------------------------------------------------
		 */
		$( '#uix-pagebuilder-anchorlinks' ).on( 'change', function() {
			
			var id = $( this ).val();
		
			$( '#uix_pagebuilder_anchorlinks_loader' ).show();
			
	
			// retrieve the widget settings form
			$.post( ajaxurl, {
				action               : 'uix_pagebuilder_anchorlinks_save_settings',
				postID               : id,
				security             : uix_pagebuilder_anchorlinks_data.send_string_nonce
			}, function ( response ) {
				$( '#uix-pagebuilder-anchorlinks-result' ).html( response );
				$( '#uix-pagebuilder-anchorlinks-selectall, #uix-pagebuilder-anchorlinks-addbtn' ).show();
				if ( response == '' ) {
					$( '#uix-pagebuilder-anchorlinks-selectall, #uix-pagebuilder-anchorlinks-addbtn' ).hide();
				}
				
				$( '#uix_pagebuilder_anchorlinks_loader' ).hide();
			});
		});

	} );
    
} ) ( jQuery );