( function( $ ) {
"use strict";
    $( function() {

	   /*! 
		 * 
		 * Per column section buttons
		 * ---------------------------------------------------
		 */
		 
		 //--------click
		$( document ).on( 'click', '.widget-item-btn', function( e ) {
			e.preventDefault();
			
			var  cur_slug         = $( this ).data( 'slug' ),
				 cur_rowID        = $( this ).data( 'id' ),
				 widget_name      = $( this ).data( 'name' ),
				 ele_target       = $( this ).data( 'elements-target' ),
				 ele_btn          = $( '#' + ele_target ).find( '.add-elements-btn' ),
				 cur_defaultvalue = $( '#' + ele_target ).find( 'textarea' ).val();
			
			if ( ele_btn.css( 'display' ) != 'none' ) {
				ele_btn.after( $( this ).clone().addClass( 'used' ).text( widget_name ) ).hide();
				
				if ( $( '#' + ele_target ).find( 'textarea' ).length > 0 ) {
					
					//Save empty data
					if ( cur_defaultvalue.indexOf( 'uix_pb_section_undefined' ) >= 0 ) {
						var nv = cur_defaultvalue
												 .replace( 'uix_pb_section_undefined', cur_slug )
												 .replace( 'uix_pb_undefined', cur_slug + '_temp' );
												 
						$( '#' + ele_target ).find( 'textarea' ).val( nv );
						
						
						gridsterItemSave( cur_rowID );
						uixPBFormDataSave();
						
						
					}
					
					
					//status
					var new_cur_defaultvalue = $( '#' + ele_target ).find( 'textarea' ).val();
					if ( new_cur_defaultvalue.indexOf( cur_slug ) >= 0 && new_cur_defaultvalue.indexOf( 'uix_pb_section_undefined' ) < 0 ) {
						$( '#' + ele_target ).addClass( 'used' );
					}
		  
				}
			
				
			}
			
			
			
			//Elements close
			gridsterItemElementsClose();
		
		
		});	
		
		//--------status
		gridsterItemElementsBTStatus( 0 );
		
		
		
	   /*! 
		 * 
		 * Debug detection textarea
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '#uix-pagebuilder-layoutdata, .uix-pagebuilder-gridster-widget .content-box, .uix-pagebuilder-gridster .temp-data-1, .uix-pagebuilder-gridster .temp-data-2, .sortable-list .row textarea', function() {
			$( this ).select();
			
		});
			
		 /*! 
		 * 
		 * Hide layout button
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '.widget-items-col-container a', function( e ) {
			$( this ).parent().parent().hide();
		});
				
						
					
	   /*! 
		 * 
		 * Elements show
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '.add-elements-btn', function( e ) {
			e.preventDefault();
			
			var modalID = '#' + $( this ).data( 'elements' );
			
			$( '.uixpbform-modal-mask' ).fadeIn( 'fast' );
			$( modalID ).addClass( 'active' );
			$( modalID ).find( '.content' ).animate( {scrollTop: 10 }, 100 );
			$( 'html' ).css( 'overflow-y', 'hidden' );
			
			
			//Close
			$('.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
				e.preventDefault();
				gridsterItemElementsClose();
			});	
			
						
		});
		
	   /*! 
		 * 
		 * Row Settings
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '.uix-pagebuilder-gridster-widget .dashicons.settings', function( e ) {
			e.preventDefault();
			
			$( '.settings-wrapper' ).hide();
			
			var $set = $( this ).next( '.settings-wrapper' );
			$set.show();
			
			
			//Close
			$set.find( '.close' ).on( 'click', function( e ) {
				$set.hide();
			});	
			
						
		});		
		
		$( document ).on( 'click', '.uix-pagebuilder-gridster-drag', function( e ) {
			e.preventDefault();
			
			$( '.settings-wrapper' ).hide();
						
		});				
		
			
				
	
		/*! 
		 * 
		 * Page Options
		 * ---------------------------------------------------
		 */	
		$( document ).ready( function() {
			
			var hidedivs    = [ '#postdivrich' ],
				hideID      = '',
				selectedElt = $( "input[name='uix-pagebuilder-status']:checked" ).attr( 'id' ),
				pbID        = '#uix_pagebuilder_page_meta_pagerbuilder_container';
			$( '.postbox' ).each( function()  {
				if ( $( this ).attr( 'id' ).indexOf( 'dis_pagebuilder' ) >= 0 ) {
					hidedivs.push( '#' + $( this ).attr( 'id' ) );
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
			
			$( '#uix-pagebuilder-status1' ).on( 'click', function() {
				uixpagebuilderShow();
				
				//Auto set page template
				if ( uix_pagebuilder_layoutdata.send_string_tempfiles_exists == 1 ) {
					$('[name="page_template"] option[value="page-uix_pagebuilder.php"]').attr( 'selected', 'selected' );
				}
				
			});
			$( '#uix-pagebuilder-status2' ).on( 'click', function() {
				uixpagebuilderHide();
				
				//Restore set page template
				if ( uix_pagebuilder_layoutdata.send_string_tempfiles_exists == 1 ) {
					$('[name="page_template"] option[value="default"]').attr( 'selected', 'selected' );
				}
				
			});
			
			
			
			function uixpagebuilderHide() {
				$( hideID ).slideDown( 300 ).css( 'width', '100%' );
				$( pbID ).slideUp( 300 );	
				uixpagebuilderInit();
			}
			function uixpagebuilderShow() {
				$( hideID ).slideUp( 300 );
				$( pbID ).slideDown( 300 ).css( 'width', '100%' );
				uixpagebuilderInit();
			}				
			function uixpagebuilderInit() {
				$( 'html, body' ).animate( {scrollTop: 10 }, 100 );
				$( 'html, body' ).delay( 300 ).animate( {scrollTop: 5 }, 100 );
				$( '.uix-pagebuilder-gridster ul' ).css( 'width', '100%' );
			}				
						
			
		});

	} );
    
} ) ( jQuery );




/*! 
 * 
 * Per column section buttons status
 * ---------------------------------------------------
 */	
function gridsterItemElementsBTStatus( type ) {
	jQuery( document ).ready( function() {
		
		setTimeout( function() {
			jQuery( '.widget-item-btn' ).each( function()  {
		
				var  cur_slug         = jQuery( this ).data( 'slug' ),
					 cur_rowID        = jQuery( this ).data( 'id' ),
					 widget_name      = jQuery( this ).data( 'name' ),
					 ele_target       = jQuery( this ).data( 'elements-target' ),
					 $sort_container  = jQuery( '#' + ele_target ),
					 ele_btn          = $sort_container.find( '.add-elements-btn' ),
					 cur_defaultvalue = $sort_container.find( 'textarea' ).val();
				
				//console.log( cur_slug + ' : ' + cur_rowID );
				if ( $sort_container.length > 0 ) {
					
					if ( $sort_container.find( 'textarea' ).length > 0 ) {
						
						if ( cur_defaultvalue.indexOf( cur_slug ) >= 0 && cur_defaultvalue.indexOf( 'uix_pb_section_undefined' ) < 0 ) {
							
							if ( type == 0 ) {
								ele_btn.after( jQuery( this ).clone().addClass( 'used' ).text( widget_name ) ).hide();
							}
							
							$sort_container.addClass( 'used' );
							
						} 
	
					}
				
	
				}
				
			
			});
	
		}, 100 );
    });	
}


/*! 
 * 
 * Elements close
 * ---------------------------------------------------
 */	
function gridsterItemElementsClose() {
	jQuery( document ).ready( function() {
		jQuery( '.uixpbform-modal-box' ).removeClass( 'active' );
		jQuery( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
		jQuery( 'html' ).css( 'overflow-y', 'auto' );
    });	
}



