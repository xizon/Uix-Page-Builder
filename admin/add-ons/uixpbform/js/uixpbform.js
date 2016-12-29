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
				$( 'body' ).prepend( '<div class="uixpbform-modal-box" id="'+form[ 'thisModalID' ]+'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'+form[ 'title' ]+'</h2><span class="ajax-temp"></span></div></div>' );
				
			}
				
		
		    if ( Object.prototype.toString.call( settings.initFunction ) == '[object Function]' ) {
				settings.initFunction( form );
			}
			
				
			
			/*-- Open Window -- */
	        $( document ).on( 'click', $trigger, function( e ) {
				e.preventDefault();
				
				var widget_ID        = $( this ).data( 'id' ),
				    widget_name      = $( this ).data( 'name' ),
					widget_colID     = $( this ).data( 'col-textareaid' ),
				    widgets          = { 'formID': formID, 'ID': widget_ID, 'contentID': 'content-data-' + widget_ID, 'title': $title, 'name': widget_name, 'thisModalID': dataID, 'sectionID': widget_ID, 'colID': widget_colID },
				    code             = '',
					$obj             = $( '.uixpbform-modal-box#'+dataID ),
					modal_H_init     = $( '.uixpbform-modal-box, .uixpbform-sub-window' ),
					modal_H_btn_init = $( '.uixpbform-modal-buttons' ),
					modal_H_max      = $( window ).height()*0.8 - 150;;
				
				//Open
				if ( $obj.length > 0 ) {
					
					$.ajax({
						url       : ajaxurl,
						type      : 'POST',
						data: {
							action    : 'uixpbform_ajax_sections',
							tempID    : formID,
							sectionID : widget_ID,
							colID     : widget_colID,
							widgetName: widget_name,
							postID    : $postID
						},
						success   : function( result ){
							
							result = result.replace( /{index}/g, '\['+widget_ID+'\]' );
							
							$obj.find( '.ajax-temp' ).html( result );
							
							
							/*-- Count new modal height --*/
							var newmHeight = 0,
								hEx        = 0,
								nocols     = $obj.find( '.ajax-temp .uixpbform-form-container' ),
								cols       = $obj.find( '.ajax-temp .uixpbform-table-cols-wrapper' ),
								colsH      = Array(),
								colsH_Max  = 0;
							if ( cols.length > 0 ) {
								
								cols.each( function( index ) {
									var curH  = $( this ).height();
									
									if ( $( this ).hasClass( 'uixpbform-table-col-1' ) ) {
										hEx = curH;
									}
									
									colsH.push( parseFloat( curH ) + parseFloat( hEx ) );
									
									
								} );
								
								newmHeight = Math.max.apply( Math, colsH );
	
								
							} else {
								newmHeight = nocols.height();
							}
							
							if ( newmHeight == null || 
								newmHeight == 0 || 
								parseFloat( newmHeight + 250 ) > $( window ).height()
							   ) 
							{
								newmHeight = modal_H_max;
							}
							//Initializes modal height
							modal_H_init.css( 'height', parseFloat( newmHeight + 150 ) + 'px' );
							$obj.find( '.ajax-temp .uixpbform-modal-buttons' ).css( 'margin-top', parseFloat( newmHeight/2 + 20 ) + 'px' );
						
							
							//Add row
							$( '.uixpbform_btn_trigger-clone' ).on( 'click', function( e ) {
								e.preventDefault();
								
								modal_H_init.css( 'height', parseFloat( modal_H_max + 150 ) + 'px' );
								$obj.find( '.ajax-temp .uixpbform-modal-buttons' ).css( 'margin-top', parseFloat( modal_H_max/2 + 20 ) + 'px' );
							});	
							
							
							
							/*-- Initializes the form state --*/
							//Icon list
							$( '.icon-selector' ).uixpbform_iconSelector(); 
							
							//color picker
							$( '.wp-color-input' ).wpColorPicker();
							
							//toggle default
							$( '.uixpbform_btn_trigger-toggleshow' ).each( function()  {
								if ( $( this ).closest( '.uixpbform-box' ).find( 'input' ).val() == 1 ) {
									$( this ).uixpbform_toggleshow();
								}	
							});	
							$( '.uixpbform_btn_trigger-toggleswitch_checkbox' ).uixpbform_toggleSwitchCheckboxStatus();
							$( '.uixpbform_btn_trigger-toggleswitch_radio' ).uixpbform_toggleSwitchRadioStatus();
							
							//insert media
							$( '.uixpbform_btn_trigger-upload' ).uixpbform_mediaStatus();						
										
							
							/*-- Close --*/
							$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
								e.preventDefault();
								
								//remove modal
								$( '.uixpbform-modal-box' ).removeClass( 'active' );
								$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
								$( 'html' ).css( 'overflow-y', 'auto' );
								
								//remove icon list window
								$( '.uixpbform-sub-window' ).attr( 'id', '' ).hide();	
								
							});	
							
							// stuff here
							return false;		

						

						},
						error: function(){
						    $obj.find( '.ajax-temp' ).html( $errorInfo );
						},
						beforeSend: function() {
							$obj.find( '.ajax-temp' ).html( '<span class="uixpbform-loading"></span>' );
							//console.log( 'loading...' );
							
							//Initializes modal height
							modal_H_init.css( 'height', '220px' );
							modal_H_btn_init.css( 'margin-top', '50px' );

						}
					});
			
					
					$( '.uixpbform-modal-mask' ).fadeIn( 'fast' );
					$obj.addClass( 'active' );
					$obj.find( '.content' ).animate( {scrollTop: 10 }, 100 );
					$( 'html' ).css( 'overflow-y', 'hidden' );
				}
	
				
				//Callback API
				if ( Object.prototype.toString.call( settings.startFunction ) == '[object Function]' ) {
					settings.startFunction( widgets );
				}
				
				
				
				//Close
				$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
					e.preventDefault();
					
					//remove modal
					$( this ).parent().removeClass( 'active' );
					$( '.uixpbform-modal-box' ).removeClass( 'active' );
					$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
					$( 'html' ).css( 'overflow-y', 'auto' );
					
					//remove icon list window
					$( '.uixpbform-sub-window' ).attr( 'id', '' ).hide();		

					
				});
				
			} );
			
			
			
			/*-- Save data -- */
			$( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
				e.preventDefault();
				
				var $form         = $( this ).closest( 'form' ),
				    formID        = $form.find( '[name="section"]' ).val(),
				    rowID         = $form.find( '[name="row"]' ).val(),
					colTextareaID = $form.find( '[name="colid"]' ).val(),
					colContent    = [];
				    settings      = [];
					
					
				//Returns column ID
				var cols = colTextareaID.split( '---' );
				var colID = cols[0].replace( 'col-item-', '' );
			
				var fields = $( "[name^='"+formID+"|["+colTextareaID+"]']" ).serializeArray();
				colContent.push( [ 'col', colID ] );
				settings.push( [ 'section', formID ] );
				settings.push( [ 'row', rowID ] );
				settings.push( [ 'widgetname', 'Section ' + rowID ] );
				
			
				
				$.each( fields, function( i, field ) {
					var v = uixpbform_htmlEscape( field.value ),
					    n = field.name;
					colContent.push( [ n, v ] );
					
				});
				

				//Save Item Content
				uixpbform_insertCodes( formID, JSON.stringify( colContent ), colTextareaID, rowID );
				gridsterItemSave( rowID );
				
				//Save All content
				settings.push( [ 'rowcontent', '{allcontent}' ] );
				
				
				uixpbform_insertCodes( formID, JSON.stringify( settings ), 'cols-all-content-replace-' + rowID, rowID );
	
				//Close window
				$( '.uixpbform-modal-box' ).removeClass( 'active' );
				$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
				$( 'html' ).css( 'overflow-y', 'auto' );
				
				
			});
			
			
			
			
		
		
		})
	}
})(jQuery);

