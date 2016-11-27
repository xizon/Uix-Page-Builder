jQuery( document ).ready( function() {
	
    /*! 
	 * 
	 * Page Options
	 * ---------------------------------------------------
	 */	
	jQuery( document ).ready( function() {
		
		var hidedivs    = [ '#postdivrich' ],
			hideID      = '',
			selectedElt = jQuery( "input[name='uix-pagebuilder-status']:checked" ).attr( 'id' ),
			pbID        = '#uix_pagebuilder_page_meta_pagerbuilder_container';
		jQuery( '.postbox' ).each( function()  {
			if ( jQuery( this ).attr( 'id' ).indexOf( 'dis_pagebuilder' ) >= 0 ) {
				hidedivs.push( '#' + jQuery( this ).attr( 'id' ) );
			}
			
		});
		
		for (var i = 0, len = hidedivs.length; i < len; i++ ) {	
			hideID += hidedivs[ i ] + ',';
		}
		hideID = hideID.substring( 0, hideID.length-1 );
		
		
		if ( selectedElt == 'uix-pagebuilder-status2' ) {
			uixpagebuilderHide();
		} else {
			uixpagebuilderShow();
		}
		
		jQuery( '#uix-pagebuilder-status1' ).on( 'click', function() {
			uixpagebuilderShow();
			
			//Auto set page template
			jQuery('[name="page_template"] option[value="page-uix_pagebuilder.php"]').attr( 'selected', 'selected' );
			
		});
		jQuery( '#uix-pagebuilder-status2' ).on( 'click', function() {
			uixpagebuilderHide();
			
			//Restore set page template
			jQuery('[name="page_template"] option[value="default"]').attr( 'selected', 'selected' );
		});
		
		
		
		function uixpagebuilderHide() {
			jQuery( hideID ).slideDown( 300 ).css( 'width', '100%' );
			jQuery( pbID ).slideUp( 300 );	
			uixpagebuilderInit();
		}
		function uixpagebuilderShow() {
			jQuery( hideID ).slideUp( 300 );
			jQuery( pbID ).slideDown( 300 ).css( 'width', '100%' );
			uixpagebuilderInit();
		}				
		function uixpagebuilderInit() {
			jQuery( 'html, body' ).animate( {scrollTop: 10 }, 100 );
			jQuery( 'html, body' ).delay( 300 ).animate( {scrollTop: 5 }, 100 );
			jQuery( '.uix-pagebuilder-gridster ul' ).css( 'width', '100%' );
		}				
					
		
	});
				
	
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
		jQuery( '.uix-pagebuilder-gridster ul li' ).each( function()  {
			
			var $container        = jQuery( this );
				 cur_defaultvalue = $container.find( '.content-box' ).val();
			
			if ( cur_defaultvalue == '' ) {
				$container.find( '.widget-item-btn' ).addClass( 'wait-no-content' );
			}
			
		});
		
	
	});
		
});
