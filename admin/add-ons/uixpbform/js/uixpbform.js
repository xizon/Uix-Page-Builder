/*
	* Plugin: Uix Page Builder Form
	* Version 1.0.0
	* Author: UIUX Lab
	* Twitter: @uiux_lab
	* Author URL: https://uiux.cc
	
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
*/
(function($){
	$.fn.UixPBFormPop=function(options){
		var settings=$.extend({
			'postID'            : '',
			'title'             : '',
			'trigger'           : '',
			'errorInfo'         : 'Timeout expired. The timeout period elapsed prior to completion of the operation or the server is not responding. ',
			'initFunction'      : function(){ },	 //Callback: function( form ){ alert( form[ 'formID' ] ); }
			'startFunction'     : function(){ }	 //Callback: function( widgets ){ alert( widgets[ 'contentID' ] ); }
		}
		,options);
		this.each(function(){
			
			var $this               = $( this ),
			    $ID                 = settings.trigger.replace( '.', '' ).replace( '#', '' ),
				$title              = settings.title,
				$postID             = settings.postID,
				$trigger            = settings.trigger,
				$errorInfo          = settings.errorInfo,
				dataID              = 'uixpbform-modal-open-' + $ID,
				formID              = $trigger.replace( '.', '' ).replace( '#', '' );
			
				

			
			//Prepend section templates
			var form = { 'formID': formID, 'title': $title, 'thisModalID': dataID, 'thisFormName': $ID };
			
			if ( $( '.uixpbform-modal-mask' ).length < 1 ) {
				$( 'body' ).prepend( '<div class="uixpbform-modal-mask"></div>' );
			}
			
			if ( $( '#' + form[ 'thisModalID' ] ).length < 1 ) {
				$( 'body' ).prepend( '<div class="uixpbform-modal-box" id="'+form[ 'thisModalID' ]+'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">×</a><div class="content"><h2>'+form[ 'title' ]+'</h2><span class="ajax-temp"></span></div></div>' );
				
			}
				
		
			settings.initFunction( form );
				
			
			/*-- Open Window -- */
	        $( document ).on( 'click', $trigger, function( e ) {
				e.preventDefault();
				
				var widget_ID       = $( this ).data( 'id' ),
				    widget_name     = $( this ).data( 'name' ),
				    widgets         = { 'formID': formID, 'ID': widget_ID, 'contentID': 'content-data-' + widget_ID, 'title': $title, 'name': widget_name, 'thisModalID': dataID, 'sectionID': widget_ID },
				    code            = '',
					$obj            = $( '.uixpbform-modal-box#'+dataID );
				
				//Open
				if ( $obj.length > 0 ) {
					
					$.ajax({
						url       : ajaxurl,
						type      : 'POST',
						data: {
							action    : 'uixpbform_ajax_sections',
							tempID    : formID,
							sectionID : widget_ID,
							widgetName: widget_name,
							postID    : $postID
						},
						success   : function( result ){
							
							result = result.replace( /{index}/g, '\['+widget_ID+'\]' );
							
							$obj.find( '.ajax-temp' ).html( result );
							//Icon list with the jQuery AJAX method
							$( '.icon-selector' ).uixpbform_iconSelector();
							$( '.wp-color-input' ).wpColorPicker();
							
							//Close
							$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
								e.preventDefault();
								$( '.uixpbform-modal-box' ).removeClass( 'active' );
								$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
								$( 'html' ).css( 'overflow-y', 'auto' );
							});	

						},
						error: function(){
						    $obj.find( '.ajax-temp' ).html( $errorInfo );
						},
						beforeSend: function() {
							$obj.find( '.ajax-temp' ).html( '<span class="uixpbform-loading"></span>' );
							//console.log( 'loading...' );

						}
					});
			
					
					$( '.uixpbform-modal-mask' ).fadeIn( 'fast' );
					$obj.addClass( 'active' );
					$obj.find( '.content' ).animate( {scrollTop: 10 }, 100 );
					$( 'html' ).css( 'overflow-y', 'hidden' );
				}
	
				
				//Callback API
				settings.startFunction( widgets );
				
				
				//Close
				$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
					e.preventDefault();
					$( this ).parent().removeClass( 'active' );
					$( '.uixpbform-modal-box' ).removeClass( 'active' );
					$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
					$( 'html' ).css( 'overflow-y', 'auto' );
				});
				
			} );
			
			
			
			/*-- Save data -- */
			$( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
				e.preventDefault();
				
				var $form         = $( this ).closest( 'form' ),
				    formID        = $form.find( '[name="section"]' ).val(),
				    rowID         = $form.find( '[name="row"]' ).val(),
					widgetName    = $form.find( '[name="widgetname"]' ).val(),
				    settings      = [];
					
				//Add widget name
				var oldname = $( '#title-data-' + rowID ).val();
				if ( oldname.indexOf( widgetName ) < 0 ) {
					$( '#title-data-' + rowID ).val( widgetName );
				} else {
					widgetName = oldname;
				}
					
				var fields = $( "[name^='"+formID+"']" ).serializeArray();
				settings.push( [ 'section', formID ] );
				settings.push( [ 'row', rowID ] );
				settings.push( [ 'widgetname', widgetName ] );
				
				$.each( fields, function( i, field ) {
					var v = uixpbform_htmlEscape( field.value ),
					    n = field.name;
					settings.push( [ n, v ] );
				});	
				
				//Save
				uixpbform_insertCodes( formID, JSON.stringify( settings ), 'content-data-' + rowID, rowID );
	
				//Close window
				$( '.uixpbform-modal-box' ).removeClass( 'active' );
				$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
				$( 'html' ).css( 'overflow-y', 'auto' );
				
				
			});
		
		
		})
	}
})(jQuery);

