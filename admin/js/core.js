jQuery( document ).ready( function() {
	
    /*! 
	 * 
	 * Section buttons
	 * ---------------------------------------------------
	 */
	 
	jQuery( document ).on( 'click', '.widget-items-container .widget-item-btn', function( e ) {
		e.preventDefault();
		
		var $container  = jQuery( this ).closest( 'li' ),
		    widget_name = jQuery( this ).data( 'name' );
		
		$container.find( '.widget-item-btn' ).hide();
		jQuery( this )
		             .show()
					 .addClass( 'used' )
					 .text( 'Edit' );
					 
	
		//Add widget name
		var oldname = $container.find( '.title-box' ).val();
		if ( oldname.indexOf( widget_name ) < 0 ) {
			$container.find( '.title-box' ).val( widget_name );		 
		}		 
					 
					 
		
	} );	
	
	jQuery( document ).ready( function() {
		jQuery( '.widget-items-container .widget-item-btn' ).addClass( 'wait' );
		jQuery( '.widget-items-container .widget-item-btn' ).each( function()  {
			
			var $container        = jQuery( this ).closest( 'li' );
				 cur_defaultvalue = $container.find( '.content-box' ).val(),
				 cur_slug         = jQuery( this ).data( 'slug' ),
				 cur_rowID        = jQuery( this ).data( 'id' );
			
			//console.log( cur_slug + ' : ' + cur_rowID );
			if ( cur_defaultvalue.indexOf( cur_slug ) >= 0 ) {
				jQuery( this ).addClass( 'used' );
				jQuery( this ).text( 'Edit' );
				
			}
			
		});
		jQuery( '.uix-page-builder-gridster ul li' ).each( function()  {
			
			var $container        = jQuery( this );
				 cur_defaultvalue = $container.find( '.content-box' ).val();
			
			if ( cur_defaultvalue == '' ) {
				$container.find( '.widget-item-btn' ).addClass( 'wait-no-content' );
			}
			
		});
		
	
	});
		
});


