jQuery( document ).ready( function() {
	
	
	
   /*! 
	 * 
	 * Debug detection textarea
	 * ---------------------------------------------------
	 */	
	jQuery( document ).on( 'click', '#uix-pagebuilder-layoutdata, .uix-pagebuilder-gridster-widget .content-box, .uix-pagebuilder-gridster .temp-data-1, .uix-pagebuilder-gridster .temp-data-2, .sortable-list .row textarea', function() {
		jQuery( this ).select();
		
	});
		
     /*! 
	 * 
	 * Hide layout button
	 * ---------------------------------------------------
	 */	
	jQuery( document ).on( 'click', '.widget-items-col-container a', function( e ) {
		jQuery( this ).parent().parent().hide();
	});
				
		

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
			if ( uix_pagebuilder_layoutdata.send_string_tempfiles_exists == 1 ) {
				jQuery('[name="page_template"] option[value="page-uix_pagebuilder.php"]').attr( 'selected', 'selected' );
			}
			
		});
		jQuery( '#uix-pagebuilder-status2' ).on( 'click', function() {
			uixpagebuilderHide();
			
			//Restore set page template
			if ( uix_pagebuilder_layoutdata.send_string_tempfiles_exists == 1 ) {
				jQuery('[name="page_template"] option[value="default"]').attr( 'selected', 'selected' );
			}
			
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

   
});


/*! 
 * 
 * Per column section buttons
 * ---------------------------------------------------
 */
function gridsterItemButtonsInit( uid ) {
	jQuery( document ).ready( function() {
		
		jQuery( '.sortable-list-container-'+uid+' li' ).each( function()  {
			
			var $this            = jQuery( this ),
			    $btn_container   = $this.find( '.widget-items-container' ),
			    cur_defaultvalue = $this.find( 'textarea' ).val();
					
	
			//--------click action
			$btn_container.find( '.widget-item-btn' ).on( 'click', function( e ) {
				e.preventDefault();
				
				var  cur_slug    = jQuery( this ).data( 'slug' ),
				     widget_name = jQuery( this ).data( 'name' );
				
				
				$btn_container.find( '.widget-item-btn' ).hide();
				jQuery( this )
							 .show()
							 .addClass( 'used' )
							 .text( widget_name );
			
							 
			
			} );	

			
			//--------status
			if ( $this.find( 'textarea' ).length > 0 ) {
				$btn_container.find( '.widget-item-btn' ).each( function()  {
			
					var  cur_slug         = jQuery( this ).data( 'slug' ),
						 cur_rowID        = jQuery( this ).data( 'id' ),
						 widget_name      = jQuery( this ).data( 'name' );
					
					//console.log( cur_slug + ' : ' + cur_rowID );
					
					if ( cur_defaultvalue.indexOf( cur_slug ) >= 0 ) {
						jQuery( this ).addClass( 'used' );
						jQuery( this ).text( widget_name );
						$this.addClass( 'used' );
					} 
					
				});
	
			}
			
			
			
		});
		
		
		//Per column section buttons status
		jQuery( document ).ready( function() {
			
			jQuery( '.sortable-list-container li' ).each( function()  {
				var $this = jQuery( this );
				$this.find( '.widget-item-btn' ).each( function()  {
					if ( !jQuery( this ).hasClass( 'used' ) ) {
						jQuery( this ).hide();
					}
				});

			});
			
		});
		
	
	});
}
