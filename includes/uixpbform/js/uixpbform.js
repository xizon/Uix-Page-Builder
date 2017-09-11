/*
	* Plugin: Uix Page Builder Form
	* Version: 3.3
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
			
				

			
			/*------------- Load core form templates ------------- */
			var form = { 'formID': formID, 'title': $title, 'thisModalID': dataID, 'thisFormName': $ID };
			
			if ( $( '.uixpbform-modal-mask' ).length < 1 ) {
				$( 'body' ).prepend( '<div class="uixpbform-modal-mask"></div>' );
			}
			
			if ( $( '#' + form[ 'thisModalID' ] ).length < 1 ) {
				$( 'body' ).prepend( '<div class="uixpbform-modal-box" id="'+form[ 'thisModalID' ]+'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'+form[ 'title' ]+'</h2><span class="iconslist-box"></span><span class="ajax-temp"></span></div></div>' );
				
			}
				
		
		    if ( Object.prototype.toString.call( settings.initFunction ) == '[object Function]' ) {
				settings.initFunction( form );
			}
			
				
			
			
	        $( document ).on( 'click', $trigger, function( e ) {
				e.preventDefault();
				
				var widget_ID        = $( this ).data( 'id' ),
				    widget_name      = $( this ).data( 'name' ),
					widget_colID     = $( this ).data( 'col-textareaid' ),
				    widgets          = { 'formID': formID, 'ID': widget_ID, 'contentID': 'content-data-' + widget_ID, 'title': $title, 'name': widget_name, 'thisModalID': dataID, 'sectionID': widget_ID, 'colID': widget_colID },
				    code             = '',
					$obj             = $( '.uixpbform-modal-box#'+dataID ),
					modal_H_init     = $( '.uixpbform-modal-box' ),
					modal_H_btn_init = $( '.uixpbform-modal-buttons' ),
					modal_H_max      = $( window ).height()*0.8 - 150,
					action_first_add = false;
				
				
				/*------------- Check whether the element is added for the first time ------------- */
				if ( $( this ).parent( '.uix-page-builder-col' ).length > 0 ) {
					action_first_add = true;
				}
				
				
				/*------------- Open Window ------------- */
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
							
							if ( $obj.find( '.iconslist-box' ).html().length == 0 ) {
								$obj.find( '.iconslist-box' ).html( $( '.uixpbform-icon-selector-btn-target' ).html() );
							}
							
							
							/*-- Init tinymce --*/
							$obj.find( '.uixpbform-mce-editor' ).each( function()  {
								uixpbform_editorInit( $( this ).find( 'textarea.mce' ).attr( 'id' ) );
							});
							
							
							
							
							
							/*-- Count new modal height --*/
							var newHeight  = 0,
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
									//console.log( parseFloat( curH ) + parseFloat( hEx ) );
									
								} );
								
								//Fixed a bug of layout data save: Maximum call stack size exceeded.
								// Don't use: newHeight = Math.max.apply( Math, colsH );
								var max = -Infinity; 
								for( var i = 0; i < colsH.length; i++ ) {
									if ( colsH[i] > max ) {
										newHeight = colsH[i];
									}
									
								}
								
								//console.log( newHeight );
								
								
							} else {
								newHeight = nocols.height();
							}
							
							if ( newHeight == null || 
								newHeight == 0 || 
								parseFloat( newHeight + 150 + $( window ).height()*0.2 ) > $( window ).height()
							   ) 
							{
								newHeight = modal_H_max;
							}
							//Initializes modal height
							modal_H_init.css( 'height', parseFloat( newHeight + 150 ) + 'px' );
							$obj.find( '.ajax-temp .uixpbform-modal-buttons' ).css( 'margin-top', parseFloat( newHeight/2 + 20 ) + 'px' );
						
							
							//Add row
							$( '.uixpbform_btn_trigger-clone' ).on( 'click', function( e ) {
								e.preventDefault();
								
								modal_H_init.css( 'height', parseFloat( modal_H_max + 150 ) + 'px' );
								$obj.find( '.ajax-temp .uixpbform-modal-buttons' ).css( 'margin-top', parseFloat( modal_H_max/2 + 20 ) + 'px' );
							});	
							
							
							
							/*-- Initializes the form state --*/
							//Icon list
							$( '.uixpbform-icon-selector' ).uixpbform_iconSelector(); 
							
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
								
								//All elements close for Uix Page Builder Form
								$( document ).UixPBFormPopClose();
								
								
								//remove sub window (icons)
								$( '.uixpbform-modal-box .iconslist-box' ).removeAttr( 'id' ).removeClass( 'active' );
								//show main modal content
								$( '.uixpbform-modal-box .ajax-temp' ).css( 'visibility', 'visible' );

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
			
					//Reset the modal box
					$obj.UixPBFormPopWinReset( { heightChange: false } );
					
				}
	
				
				/*------------- Callback API ------------- */
				if ( Object.prototype.toString.call( settings.startFunction ) == '[object Function]' ) {
					settings.startFunction( widgets );
				}
				
				

				/*------------- Close ------------- */
				$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
					e.preventDefault();
					
					//All elements close for Uix Page Builder Form
					$( this ).parent().removeClass( 'active' );
					$( document ).UixPBFormPopClose();
					
					//remove sub window (icons)
					$( '.uixpbform-modal-box .iconslist-box' ).removeAttr( 'id' ).removeClass( 'active' );
					//show main modal content
					$( '.uixpbform-modal-box .ajax-temp' ).css( 'visibility', 'visible' );


					
				});
				
			} );
			
			
			
			/*------------- Traverse and update all data ------------- */
			/*------------- Update gridster data ( If the module is added for the first time, and there is no content. ------------- */
            function traverseAndUpdateData( obj ) {
				
				$( '.uixpbform-modal-box' ).each( function()  {
						var $form         = obj,
							formID        = $form.find( '[name="section"]' ).val(),
							rowID         = $form.find( '[name="row"]' ).val(),
							colTextareaID = $form.find( '[name="colid"]' ).val(),
							colContent    = [],
							settings      = [];
					
					
					    if( typeof colTextareaID !== typeof undefined ) {
							
							//Returns column ID
							var cols = colTextareaID.split( '---' );
							var colID = cols[0].replace( 'col-item-', '' );

							//Save begin
							var $jsonTextarea = $( "[name^='"+formID+"|["+colTextareaID+"]']" ),
								fields        = $jsonTextarea.serializeArray();

							colContent.push( [ 'col', colID ] );
							settings.push( [ 'section', formID ] );
							settings.push( [ 'row', rowID ] );
							settings.push( [ 'widgetname', 'Section ' + rowID ] );


							$.each( fields, function( i, field ) {
								var v      = field.value,
									n      = field.name;

								//Warning: Includes JSON data from <textarea>.
								v = uixpbform_htmlEscape( v );


								// When you enter a string in <textarea> will be saving, convert special characters to save JSON data.
								var $cur    = $( '[name="'+n+'"]' );
								if ( $cur.is( 'textarea' ) ) {

									var curdata = uixpbform_format_textarea( $cur, false, v );
									if ( curdata != '' ) {
										v = curdata;
									}

								}

								colContent.push( [ n, v ] );


							});



							var new_settings = JSON.stringify( colContent );


							//Save Item Content
							uixpbform_insertCodes( formID, new_settings, colTextareaID, rowID );

							//Save the data for each sortable item
							var gridsterInit = new UixPBGridsterMain();
							gridsterInit.itemSave( rowID );

							//Save All content
							settings.push( [ 'rowcontent', '{allcontent}' ] );
							var layoutdata_form_data = JSON.stringify( settings );
							uixpbform_insertCodes( formID, layoutdata_form_data, 'cols-all-content-replace-' + rowID, rowID );	
							
						}
					
					    

					});
	
			
			}

			
			
			/*------------- Save data ------------- */
			$( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
				
				//Because the template data is too fast to "save", it will lead to script loading error.
				//Catch a possible error:  Syntax error, unrecognized expression
				try {

					e.preventDefault();

					
					//Update gridster data ( If the module is added for the first time, and there is no content. )
					//Use the ID of current form with AJAX to prevent duplicate events caused by the browser stuck.
					var $form         = $( this ).closest( 'form' ),
						ajaxFormCurID = $( this ).closest( '.uixpbform-modal-box.active' ).attr( 'id' ),
						curSaveBtn    = $( '#' + ajaxFormCurID ).find( '.uixpbform-modal-save-btn' );
					
					if ( curSaveBtn.length == 1 ) {
						
						traverseAndUpdateData( $form );
						
						//Update gridster data ( If the module is added for the first time, and there is no content. )
						//When removing a module, the following code is valid
						var init_settings = $( "[name='uix-page-builder-layoutdata']" ).val();
						if ( init_settings.indexOf( '"content":""' ) >= 0 ) {
							setTimeout( function() {
								traverseAndUpdateData( $form );
							}, 15 );	
						}

					}
					
					//All elements close for Uix Page Builder Form
					$( document ).UixPBFormPopClose();	
					
					

				} catch( err ) {
					
					console.log( err.message );
				}
		
			});
			
			
	
		
		})
	}
})(jQuery);



/*!
 *
 * All elements close for Uix Page Builder Form
 * ---------------------------------------------------
 */	
(function($){
	$.fn.UixPBFormPopClose=function(options){
		var settings=$.extend({
			
		}
		,options);
		this.each(function(){
			
			$( '.uixpbform-modal-box' ).removeClass( 'active' );
			$( 'html' ).css( 'overflow-y', 'auto' );
			
			//mask div
			$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
	
		})
	}
})(jQuery);


/*!
 *
 * Switch between different pop-up windows when the pop-up windows is not fully closed.
 * ---------------------------------------------------
 * In order to keep the mask div.
 *
 */	
(function($){
	$.fn.UixPBFormPopSwitchTransition=function(options){
		var settings=$.extend({
			
		}
		,options);
		this.each(function(){
			
			$( '.uixpbform-modal-box' ).removeClass( 'active' );
			$( 'html' ).css( 'overflow-y', 'auto' );
			
		})
	}
})(jQuery);



/*!
 *
 * Reset modal box to maximum height by default
 * ---------------------------------------------------
 *
 */	
(function($){
	$.fn.UixPBFormPopWinReset=function(options){
		var settings=$.extend({
		    'heightChange' : true
		}
		,options);
		this.each(function(){
			
			var $this = $( this );
			
			$this.addClass( 'active' );
			$( '.uixpbform-modal-mask' ).fadeIn( 'fast' );
			
			if ( settings.heightChange ) {
				$this.css( 'height', parseFloat( ( $( window ).height()*0.8 - 150 ) + 150 ) + 'px' );
			}
		
			$this.find( '.content' ).animate( {scrollTop: 10 }, 100 );
			$( 'html' ).css( 'overflow-y', 'hidden' );
			
		})
	}
})(jQuery);


