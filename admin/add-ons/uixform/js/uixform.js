/*
	* Plugin: Uix Form
	* Version 1.0.0
	* Author: UIUX Lab
	* Twitter: @uiux_lab
	* Author URL: https://uiux.cc
	
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
*/
(function($){
	$.fn.uixFormPop=function(options){
		var settings=$.extend({
			'title'             : '',
			'trigger'           : '',
			'initFunction'      : function(){ },	 //Callback: function( form ){ alert( form[ 'formID' ] ); }
			'startFunction'     : function(){ }	 //Callback: function( widgets ){ alert( widgets[ 'contentID' ] ); }
		}
		,options);
		this.each(function(){
			
			var $this               = $( this ),
			    $ID                 = settings.trigger.replace( '.', '' ).replace( '#', '' ),
				$title              = settings.title,
				$trigger            = settings.trigger,
				dataID              = 'uixform-modal-open-' + $ID,
				formID              = $trigger.replace( '.', '' ).replace( '#', '' ),
				pageSectionID       = 0;
				
			if ( $( '.uixform-modal-mask' ).length < 1 ) {
				$( 'body' ).prepend( '<div class="uixform-modal-mask"></div>' );
			}
			
			
			if ( $.cookie( 'uix-page-section-cur' ) != null ) {
				pageSectionID = $.cookie( 'uix-page-section-cur' );
			}

			var form = { 'formID': formID, 'title': $title, 'thisModalID': dataID, 'thisFormName': $ID, 'sectionID': pageSectionID };
			settings.initFunction( form );
			
	        $( document ).on( 'click', $trigger, function( e ) {
				
				
				var widget_ID              = $( this ).data( 'id' ),
				    widgets                = { 'formID': formID, 'ID': widget_ID, 'contentID': 'content-data-' + widget_ID, 'title': $title, 'thisModalID': dataID, 'sectionID': pageSectionID },
					$obj                   = $( '.uixform-modal-box#'+dataID );
				
				$obj.find( '.content' ).animate( {scrollTop: 10 }, 100 );
				
				/*-- Save section id -- */
				$.cookie( 'uix-page-section-cur', widget_ID );
				
				/*-- Callback -- */
				settings.startFunction( widgets );
				
				/*-- Open Window -- */
				if ( $obj.length > 0 ) {
	
					$( '.uixform-modal-mask' ).fadeIn( 'fast' );
					$obj.addClass( 'active' );
				}
	
				
				/*-- Close Window -- */
				$( '.uixform-modal-box .close-uixform-modal' ).on( 'click', function( e ) {
					e.preventDefault();
					$( this ).parent().removeClass( 'active' );
					$( '.uixform-modal-box' ).removeClass( 'active' );
					$( '.uixform-modal-mask' ).fadeOut( 'fast' );
				});
				
			} );
			
			
			
			/*-- Save data -- */
			$( document ).on( 'click', '.uixform-modal-save-btn', function( e ) {
				e.preventDefault();
				
				var formID        = $( this ).attr( 'data-formID' ),
				    pageSectionID = $.cookie( 'uix-page-section-cur' );
				
				if ( $.cookie( 'uix-page-section-cur' ) == null ) {
					pageSectionID = 0;
				}
				
				
				var contentID = 'content-data-' + pageSectionID;
		
		
				var settings = [];
				
				var fields = $( "[name^='"+formID+"']" ).serializeArray();
				settings.push( [ 'section', formID ] );
				settings.push( [ 'row', pageSectionID ] );
				
				$.each( fields, function( i, field ) {
					var v = htmlPagebuilderEscape( field.value ),
					    n = field.name;
					settings.push( [ n, v ] );
				});	
				
				uixform_insertCodes( formID, JSON.stringify( settings ), contentID, pageSectionID );
				$( '.uixform-modal-box .close-uixform-modal' ).trigger( 'click' );
				
				
				
			});
		
		
		})
	}
})(jQuery);



