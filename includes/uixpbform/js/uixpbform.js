/*
	* Plugin: Uix Page Builder Form
	* Version: 4.6
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
				$( 'body' ).prepend( '<div class="uixpbform-modal-box" id="'+form[ 'thisModalID' ]+'"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>'+form[ 'title' ]+'</h2><span class="iconslist-box"></span><span class="echo-module-temp"></span><span class="echo-module-temp-clone" style="display:none"></span><span class="echo-frontend-temp" style="display:none"></span></div></div>' );
				
			}
				
		
		    if ( Object.prototype.toString.call( settings.initFunction ) == '[object Function]' ) {
				settings.initFunction( form );
			}
			
				
			
			
	        $( document ).on( 'click.UIXPB_FORMPOP_OPEN', $trigger, function( e ) {
				e.preventDefault();
				
				var widget_ID        = $( this ).data( 'id' ),
				    widget_name      = $( this ).data( 'name' ),
					widget_col_ID    = $( this ).data( 'col-textareaid' ),
				    widgets          = { 'formID': formID, 'ID': widget_ID, 'contentID': 'content-data-' + widget_ID, 'title': $title, 'name': widget_name, 'thisModalID': dataID, 'sectionID': widget_ID, 'colID': widget_col_ID },
				    code             = '',
					$obj             = $( '.uixpbform-modal-box#'+dataID ),
					modal_H_max      = $( window ).height()*0.8 - 150,
					echo_tmpl_ID     = '.uixpbform-modal-box#'+dataID+' .echo-module-temp',
					echo_frontend_ID = '.uixpbform-modal-box#'+dataID+' .echo-frontend-temp',
					action_first_add = false;
				

				
				/*------------- Check whether the element is added for the first time ------------- */
				if ( $( this ).parent( '.uix-page-builder-col' ).length > 0 ) {
					action_first_add = true;
				}
				
	
				/*------------- Open Window ------------- */
				if ( $obj.length > 0 ) {
				
					var tempID              = formID,  
						sectionID           = widget_ID,                                                         //Like this: ABCDE
						colID               = widget_col_ID,                                                     //Like this: col-item-1__1---ABCDE
						colIDToVar          = colID.replace( '---', '----' ),                                    //Like this: col-item-1__1----ABCDE
						colNumber           = colID.replace( 'col-item-', '' ).replace( '---' + sectionID, '' ), //Like this: 1__1
						widgetName          = widget_name,
						postID              = $postID,
						renderTemp          = uixpbform_module_form_ids( tempID, sectionID, colID, false );

				
					/*-- Reset the modal box --*/
					$obj.UixPBFormPopWinReset( { heightChange: 220 } );
					$obj.attr({
						'data-tempID'           : tempID,
						'data-colID'            : colID,
						'data-colIDToVar'       : colIDToVar,
						'data-sectionID'        : sectionID,
						'data-echoFrontendID'   : echo_frontend_ID,
						'data-colNumber'        : colNumber	
					});	
					
					
					/*-- Call the specified page modules --*/
					
					//Empty container contents
					$( echo_tmpl_ID ).html( '' );

					
					if ( uixpbform_isJSON( renderTemp ) ) {
						//Use the saved data values
						$( '#module_tmpl__' + tempID ).tmpl( JSON.parse( renderTemp ) ).appendTo( echo_tmpl_ID );		
					} 
				
					
					/*-- Initializes the index data of the currently open form --*/
					$obj.find( 'form [name="section"]' ).val( tempID );
					$obj.find( 'form [name="colid"]' ).val( colID );
					$obj.find( 'form [name="row"]' ).val( sectionID );

					
					/*-- Initializes the controls state --*/
					$( document ).uixpbform_init_controls( { form: $obj } );

					

					/*-- Dynamic Adding Input ( Default Value ) --*/
					if ( uixpbform_clonedata_exists( renderTemp ) ) {
						$obj.find( '.uixpbform_btn_trigger-clone' ).uixpbform_dynamicFormInit( { type: 'load' } );
					}
			
				
											
					/*-- Load icons --*/
					if ( $obj.find( '.iconslist-box' ).html().length == 0 ) {
						$obj.find( '.iconslist-box' ).html( $( '.uixpbform-icon-selector-btn-target' ).html() );
					}


					/*-- Count new modal height --*/
					var newHeight  = 0,
						hEx        = 0,
						nocols     = $( echo_tmpl_ID ).find( '.uixpbform-form-container' ),
						cols       = $( echo_tmpl_ID ).find( '.uixpbform-table-cols-wrapper' ),
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
					$obj.css( 'height', parseFloat( newHeight + 150 ) + 'px' );
					$obj.find( '.uixpbform-modal-buttons' ).css( 'margin-top', parseFloat( newHeight/2 + 20 ) + 'px' );

					//Add row
					$( '.uixpbform_btn_trigger-clone' ).on( 'click', function( e ) {
						e.preventDefault();
						
						var _mh    = ( $( window ).height()*0.8 - 150 ) + 150;

						$obj.css( 'height', _mh + 'px' );
						$obj.find( '.uixpbform-modal-buttons' ).css( 'margin-top', _mh*0.8/2 + 'px' );
						
						
					});	

					
					/*-- Close --*/
					$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
						e.preventDefault();

						//All elements close for Uix Page Builder Form
						$( document ).UixPBFormPopClose();


						//remove sub window (icons)
						$( '.uixpbform-modal-box .iconslist-box' ).removeAttr( 'id' ).removeClass( 'active' );

					});	
				
					
					
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


					
				});
				
			} );
			
			
			
			/*------------- Traverse and update all data ------------- */
			/*------------- Update gridster data ( If the module is added for the first time, and there is no content. ------------- */
            function traverseAndUpdateData( obj ) {
				
				$( '.uixpbform-modal-box' ).each( function()  {
						var $form               = obj,
							formID              = $form.find( '[name="section"]' ).val(),   //Like this: uix_pb_module_???
							rowID               = $form.find( '[name="row"]' ).val(),       //Like this: ABCDE  (Per row ID is equal to the section ID)
							colID               = $form.find( '[name="colid"]' ).val(),     //Like this: col-item-1__1---ABCDE
							colIDToVar          = colID.replace( '---', '----' ),           //Like this: col-item-1__1----ABCDE
							colNumber           = uixpbform_to_col_numberID( colID ),       //Like this: 1__1
							colContent          = [],
							settings            = [];
					
					
					    if( typeof colID !== typeof undefined ) {
							

							//Save begin
							var $jsonTextarea = $( "[name^='"+formID+"-"+colIDToVar+"']" ),
								fields        = $jsonTextarea.serializeArray();
							
							
						
							
							colContent.push( [ 'col', colNumber ] );
							settings.push( [ 'section', formID ] );
							settings.push( [ 'row', rowID ] );
							settings.push( [ 'widgetname', 'Section ' + rowID ] );


							for( var i = 0; i < fields.length; i++ ) {
								var _id      = fields[i].name,
									_value   = fields[i].value,
									
									//Convert the JSON data (saved) ID to be saved
									_s_id    = uixpbform_to_controlID_ToSave( _id, formID, rowID, colID );
								
								
								//Exclude the original form ID of the clone
								if ( _id.indexOf( '__index__' ) < 0 ) {
									
									
									//Format the value of a form control for the specified type
									if ( _id.indexOf( '_temp' ) < 0 ) {
										var callbackType = $( '#' + _id ).data( 'callback' );
										if ( typeof callbackType !== typeof undefined ) {
											_value = uixpbform_value_callback( _value, callbackType );
										} else {
											_value = uixpbform_format_text_entering( _value );
										}	
									}

					
								
									
									//Warning: Includes JSON data from <textarea>.
									_value = uixpbform_textarea_to_JSONSaveData( _value );
									
									
									//Avoid real-time nulling of template values
									if ( typeof $( '#' + _id ).attr( 'data-enter-value' ) !== typeof undefined ) {
										if ( _value == '' ) _value = '&nbsp;';
									}

									//Push values
									colContent.push( [ _s_id, _value ] );	
								}

								

							}//end for(array: fields)



							var new_settings = JSON.stringify( colContent );
							

							
							//Save Item Content
							uixpbform_insertCodes( formID, new_settings, colID, rowID );

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
			$( document ).off( 'click.UIXPB_FORMPOP_SAVE' ).on( 'click.UIXPB_FORMPOP_SAVE', '.uixpbform-modal-save-btn', function( e ) {
				
				e.preventDefault();


				//Update gridster data ( If the module is added for the first time, and there is no content. )
				//Use the ID of current form with AJAX to prevent duplicate events caused by the browser stuck.
				var $form         = $( this ).closest( 'form' ),
					$obj          = $( this ).closest( '.uixpbform-modal-box.active' ),
					curSaveBtn    = $obj.find( '.uixpbform-modal-save-btn' );

				if ( curSaveBtn.length == 1 ) {

					//Save & render HTML code (include shortcode) for current module in real time
					//Must be placed on the data that will eventually be saved
					$obj.UixPBFormPopSaveAndRenderHtml({
						tempID           : $obj.attr( 'data-tempID' ),
						colID            : $obj.attr( 'data-colID' ),
						colIDToVar       : $obj.attr( 'data-colIDToVar' ),
						sectionID        : $obj.attr( 'data-sectionID' ),
						echoFrontendID   : $obj.attr( 'data-echoFrontendID' ),
						colNumber        : $obj.attr( 'data-colNumber' )	
					});
					
					
					//Update gridster data ( If the module is added for the first time, and there is no content. )
					//When removing a module, the following code is valid

					traverseAndUpdateData( $form );
					
					var init_settings = $( "[name='uix-page-builder-layoutdata']" ).val();
					if ( init_settings.indexOf( '"content":""' ) >= 0 ) {
						setTimeout( function() {
							traverseAndUpdateData( $form );
						}, 15 );	
					}
					
					//Trigger the front end of the JavaScript function "uix_pb_render_trigger()"
					$( document ).UixPBRenderFrontendPageTrigger();
					
			
				}

				//All elements close for Uix Page Builder Form
				$( document ).UixPBFormPopClose();
				
				
				// stuff here
				return false;
				
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
			
			//Remove a light box to the mask layer
			$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
			
			//Deactivate the current object
			$( '.uixpbform-modal-box' ).removeClass( 'active' ).css( 'height', '200px' );
	
			//The scroll bar of the page
			$( 'html' ).css( 'overflow-y', 'auto' );
	
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
			
			//Deactivate the current object
			$( '.uixpbform-modal-box' ).removeClass( 'active' );
			
			//The scroll bar of the page
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
			
			//Add a light box to the mask layer
			$( '.uixpbform-modal-mask' ).fadeIn( 'fast' );
			
			
			//Activate the current object
			$this.addClass( 'active' );
			$this.find( '.uixpbform-modal-buttons' ).css( 'margin-top', '50px' );
			
			
			//Automatically calculate height
			if ( settings.heightChange ) {
				$this.css( 'height', parseFloat( ( $( window ).height()*0.8 - 150 ) + 150 ) + 'px' );
			}
			
			//Use the specified height
			var isNumeric = /^[-+]?(\d+|\d+\.\d*|\d*\.\d+)$/;
			if ( isNumeric.test( settings.heightChange ) ) {
				$this.css( 'height', settings.heightChange + 'px' );
			}

		
			//The position of the content is corrected
			$this.find( '.content' ).animate( {scrollTop: 10 }, 100 );
			
			//The scroll bar of the page
			$( 'html' ).css( 'overflow-y', 'hidden' );
			
		})
	}
})(jQuery);



/*!
 *
 * Save & render HTML code (include shortcode) for current module in real time
 * ---------------------------------------------------
 *
 */	
(function($){
	$.fn.UixPBFormPopSaveAndRenderHtml=function(options){
		var settings=$.extend({
		    'tempID'            : '',
			'colID'             : '',
			'colIDToVar'        : '',
			'sectionID'         : '',
			'echoFrontendID'    : '',
			'colNumber'         : ''
		}
		,options);
		this.each(function(){
			
			var $this                            = $( this ),
				tempID                           = settings.tempID,
				colID                            = settings.colID,
				colIDToVar                       = settings.colIDToVar,
				sectionID                        = settings.sectionID,
				echoFrontendID                   = settings.echoFrontendID,
				colNumber                        = settings.colNumber,
			
			    //Returns the form ID of the front-end HTML code after rendering the template.
			    renderTempID                     = uixpbform_module_form_ids( tempID, sectionID, colID, true ),
				renderTempElements               = [],
				
				//All form control IDs
				all_field_ids                    = $( '#uixpbform-form-all-field-ids-' + tempID ).attr( 'data-field-ids' ),
				all_real_field_ids_arr           = [],

			
			    //Push clone controls to result
			    keys                             = uixpbform_module_form_keys( $( '#module_tmpl__' + tempID ).html() ), 
				cloneTempListKey                 = [],
				cloneBeforeTempListElements      = [],
				cloneTempListElements            = [],
				cloneTempListElements_frontend   = [],
				cloneTempListMax                 = $( $( '#module_tmpl__' + tempID ).html() ).find( '[data-clone-max]' ).attr( 'data-clone-max' );
			
			
			/*! 
			 * ************************************
			 * Returns all real IDs
			 *
			 *************************************
			 */
			
			if ( typeof all_field_ids !== typeof undefined ) {

				var field_ids_arr = all_field_ids.split( ',' );
				for ( var i = 0; i < field_ids_arr.length; i++ ) {
					
					var rid = uixpbform_to_controlName_ToVar( field_ids_arr[i], tempID, sectionID, colID );
					if ( rid != '' ) {
						
						
						var _old_field_name = uixpbform_to_controlVarID_ToName( rid ),
							_new_field_name = uixpbform_filter_control_id( _old_field_name );

						rid = rid.replace( _old_field_name, _new_field_name );
						
						
						all_real_field_ids_arr.push( rid );
					}
					
				}//end for
			}
			
			
			
			//The form IDs of the front-end code after rendering module template
			$( "[name^='"+tempID+"-"+colIDToVar+"']" ).each( function()  {
				
				var _id = $( this ).attr( 'id' )
											 .replace( tempID + '-'+colIDToVar+'-', '' )
											 .replace( '-' + sectionID + '-', '' );
					
				
					if ( _id.indexOf( '__index__' ) < 0 &&  _id.indexOf( '_temp' ) >= 0 ) {
						all_real_field_ids_arr.push( $( this ).attr( 'id' ) );
					}
				
			});
			
			
			
			//The form IDs of the clone controls
			if ( typeof cloneTempListMax !== typeof undefined && cloneTempListMax > 0 ) {
				
				var cloneIDs = [];
				for ( var k = 1; k < cloneTempListMax; k++ ) {
					for ( var i = 0; i < all_real_field_ids_arr.length; i++ ) {
						
						if ( all_real_field_ids_arr[i].indexOf( '_listitem' ) >= 0 ) {
							
							if ( $( '#' + all_real_field_ids_arr[i] + k ).length > 0 ) {
								cloneIDs.push( all_real_field_ids_arr[i] + k );
							}
							
						}
						
					}//end for

				}//end for
				
				all_real_field_ids_arr = all_real_field_ids_arr.concat( cloneIDs );
				
			}
			
			
			
			
			/*! 
			 * ************************************
			 * Traverse the controls value
			 *
			 *************************************
			 */
			for ( var i = 0; i < all_real_field_ids_arr.length; i++ ) {

				var $field = $( '#' + all_real_field_ids_arr[i] );
				
				//Format all contents of <textarea>
				var curdata = uixpbform_format_textarea( $field );
				if ( curdata != '' ) {
					$field.val( curdata );
				}

				
				//Push the ID and values into the array for use with the template.
				var _id    = all_real_field_ids_arr[i]
													 .replace( tempID + '-'+colIDToVar+'-', '' )
													 .replace( '-' + sectionID + '-', '' ),

					_value = uixpbform_to_controlSaveData_ToHTML( uixpbform_filter_control_val( $field.val() ) );

				

				//Exclude the original form ID of the clone
				if ( _id.indexOf( '__index__' ) < 0 ) {
					
					if ( _id.indexOf( '_triggerclonelist' ) >= 0 && _id.indexOf( '_temp' ) < 0 ) {
						_id = _id + '__fieldID';
					} else if ( _id.indexOf( '_listitem' ) >= 0 && _id.indexOf( '_temp' ) < 0 ) {
						_id = _id + '__fieldVal';
					}

					
					//Format the value of a form control for the specified type
					if ( _id.indexOf( '_temp' ) < 0 ) {
						var callbackType = $field.data( 'callback' );
						if ( typeof callbackType !== typeof undefined ) {
							_value = uixpbform_value_callback( _value, callbackType );
						} else {
							_value = uixpbform_format_text_entering( _value );
						}	
					}

					renderTempElements.push( { [_id]: _value }  );
				}
					
				
			}//end for
			
			
			
		
			/*! 
			 * ************************************
			 * Push clone controls to result
			 *
			 * @param  {array}  keys                             - Returns the keys of the module template.
			 * @param  {array} cloneTempListKey                  -  The key of clone controls array
			 * @param  {array}  cloneBeforeTempListElements      - The object of clone loops before
			 * @param  {array}  cloneTempListElements            - The object of clone loops
			 * @param  {array}  cloneTempListElements_frontend   - The object of clone loops for front-end template
			 * @param  {number} cloneTempListMax                 - The maximum value of the clone
			 *
			 *************************************
			 */

	
			if ( 
				typeof cloneTempListMax !== typeof undefined && 
				cloneTempListMax > 0 &&
				Object.prototype.toString.call( renderTempElements ) === '[object Array]'
			) {

				
				//<Loop each control>
				for( var i = 0; i < renderTempElements.length; i++ ) {

				
					var _field_value = renderTempElements[i],
						_field_str   = JSON.stringify( _field_value );
					
					
					
					// Make the cloned form into JSON format
					if ( _field_str.indexOf( '_listitem' ) >= 0 && _field_str.indexOf( '_temp' ) < 0 ) {
						
						var _loop_key_id_arr  = _field_str.replace(/^\{?|\}?$/g, '' ).split( ':' ),
							_loop_old_key_id  = _loop_key_id_arr[0].replace(/"/g, '' ),
							_loop_new_key_id  = uixpbform_filter_control_id( uixpbform_to_cloneControlKey_ToSave( _loop_old_key_id ) );	

						_field_str = _field_str.replace( _loop_old_key_id, _loop_new_key_id );
						
						cloneTempListElements.push( uixpbform_to_cloneControlKey_ToSave( _field_str ) );
						
						
						if ( uixpbform_to_cloneControlKey_notLoopIndex( _loop_old_key_id ) ) {
							
							cloneBeforeTempListElements.push( uixpbform_to_cloneControlKey_ToSave( _field_str ) );

						}
						
					}
					
					
				}//</Loop each control>
				
				
				for( var i = 0; i < cloneTempListElements.length; i++ ) {
					cloneTempListElements_frontend.push( JSON.parse( cloneTempListElements[i] ) );
				}
			
				
				// Make a key of clone object
				if( Object.prototype.toString.call( keys ) === '[object Array]' ) {

					for( var i = 0; i < keys.length; i++ ) {
						if ( keys[i].indexOf( '_triggerclonelist' ) >= 0 ) {
							cloneTempListKey.push( keys[i] );
						}
					}

				}


				//The total number of each clone group
				var cloneBeforeTempListTotal    = 0, //Include only values (excluding IDs)
					cloneTempListTotal          = 0, //Include only values (excluding IDs)
					cloneTempListJsonArr        = [],
					cloneTempListJson           = '';


				
				 // If multiple columns are used to clone event and there are multiple clone triggers, 
				 // the triggers ID and clone controls ID must contain the string "_one_", "_two", "_three_" or "_four_" for per column
				var cloneBeforeTempListTotal_one_col    = 0,
					cloneBeforeTempListTotal_two_col    = 0,
					cloneBeforeTempListTotal_three_col  = 0,
					cloneBeforeTempListTotal_four_col   = 0,
					cloneTempListTotal_one_col          = 0,
					cloneTempListTotal_two_col          = 0,
					cloneTempListTotal_three_col        = 0,
					cloneTempListTotal_four_col         = 0,
					cloneTempListJson_one               = '',
					cloneTempListJson_two               = '',
					cloneTempListJson_three             = '',
					cloneTempListJson_four              = '',
					cloneTempListJsonArr_one            = [],
					cloneTempListJsonArr_two            = [],
					cloneTempListJsonArr_three          = [],
					cloneTempListJsonArr_four           = [];
				
				
				
	
				for( var k = 0; k < cloneBeforeTempListElements.length; k++ ) {
					
					var _v = cloneBeforeTempListElements[k];
					
					if ( _v.indexOf( '_one_' ) >=0 ) cloneBeforeTempListTotal_one_col++;
					if ( _v.indexOf( '_two_' ) >=0 ) cloneBeforeTempListTotal_two_col++;
					if ( _v.indexOf( '_three_' ) >=0 ) cloneBeforeTempListTotal_three_col++;
					if ( _v.indexOf( '_four_' ) >=0 ) cloneBeforeTempListTotal_four_col++;
					
					if (
						_v.indexOf( '_one_' ) < 0 &&
						_v.indexOf( '_two_' ) < 0 &&
						_v.indexOf( '_three_' ) < 0 &&
						_v.indexOf( '_four_' ) < 0 
					) {
						cloneBeforeTempListTotal++;
					}	
					
					
				}	
				
				for( var k = 0; k < cloneTempListElements_frontend.length; k++ ) {
					
					var _el = cloneTempListElements_frontend[k],
						_v  = JSON.stringify( _el );
					
					if ( _v.indexOf( '_one_' ) >=0 ) cloneTempListTotal_one_col++, cloneTempListJsonArr_one.push( _el );
					if ( _v.indexOf( '_two_' ) >=0 ) cloneTempListTotal_two_col++, cloneTempListJsonArr_two.push( _el );
					if ( _v.indexOf( '_three_' ) >=0 ) cloneTempListTotal_three_col++, cloneTempListJsonArr_three.push( _el );
					if ( _v.indexOf( '_four_' ) >=0 ) cloneTempListTotal_four_col++, cloneTempListJsonArr_four.push( _el );
					
					if (
						_v.indexOf( '_one_' ) < 0 &&
						_v.indexOf( '_two_' ) < 0 &&
						_v.indexOf( '_three_' ) < 0 &&
						_v.indexOf( '_four_' ) < 0 
					) {
						cloneTempListTotal++;
						cloneTempListJsonArr.push( _el );

					}
					
	
				}
				
				
				
				// Returns the group string of the front-end rendering template that has been cloned
				cloneTempListJson = uixpbform_cloned_groupStr_frontend( cloneTempListJsonArr, cloneTempListTotal, cloneBeforeTempListTotal );
				
				cloneTempListJson_one = uixpbform_cloned_groupStr_frontend( cloneTempListJsonArr_one, cloneTempListTotal_one_col, cloneBeforeTempListTotal_one_col );
				
				cloneTempListJson_two = uixpbform_cloned_groupStr_frontend( cloneTempListJsonArr_two, cloneTempListTotal_two_col, cloneBeforeTempListTotal_two_col );
				
				cloneTempListJson_three = uixpbform_cloned_groupStr_frontend( cloneTempListJsonArr_three, cloneTempListTotal_three_col, cloneBeforeTempListTotal_three_col );
				
				cloneTempListJson_four = uixpbform_cloned_groupStr_frontend( cloneTempListJsonArr_four, cloneTempListTotal_four_col, cloneBeforeTempListTotal_four_col );


			
				//Add the looped data to the trigger
				if ( cloneTempListKey.length > 0 ) {

					for ( var p = 0; p < cloneTempListKey.length; p++ ) {

						var _key  = cloneTempListKey[p];
					
						if ( _key.indexOf( '_one_' ) >= 0 && cloneTempListJson_one.length > 0 ) renderTempElements.push( { [_key]: cloneTempListJson_one } );
						if ( _key.indexOf( '_two_' ) >= 0 && cloneTempListJson_two.length > 0 ) renderTempElements.push( { [_key]: cloneTempListJson_two } );
						if ( _key.indexOf( '_three_' ) >= 0 && cloneTempListJson_three.length > 0 ) renderTempElements.push( { [_key]: cloneTempListJson_three } );
						if ( _key.indexOf( '_four_' ) >= 0 && cloneTempListJson_four.length > 0 ) renderTempElements.push( { [_key]: cloneTempListJson_four } );

						if (
							_key.indexOf( '_one_' ) < 0 &&
							_key.indexOf( '_two_' ) < 0 &&
							_key.indexOf( '_three_' ) < 0 &&
							_key.indexOf( '_four_' ) < 0 &&
							cloneTempListJson.length > 0
						) {
							renderTempElements.push( { [_key]: cloneTempListJson } );
						}

					}//end for

				}//end if


			}
			
			
			
			/*! 
			 * ************************************
			 * Format the JSON data format for the template
			 *	
			 *************************************
			 */
			renderTempElements = uixpbform_arr_to_tempjson( renderTempElements, false, true );
			
			 
			/*! 
			 * ************************************
			 * Returns the JSON result value of the module template for front-end rendering
			 * Convert the english letter to the original form identifier.
			 *	
			 *************************************
			 */	
			renderTempElements = uixpbform_module_form_JsonResult_frontend( renderTempElements );

			
		    //Empty container contents
			$( echoFrontendID ).html( '' );

			
			//Use the template to render to the front page
			$( '#frontend_module_tmpl__' + tempID ).tmpl( JSON.parse( renderTempElements ) ).appendTo( echoFrontendID );

			
			//Update the form in real time
			var htmlcode = $( echoFrontendID ).html();
			$( '#' + renderTempID ).val( htmlcode );

			//Render HTML Viewport (Relative to the front of the page)
			$( document ).UixPBRenderHTML({ divID: '#section_' + sectionID + '__' + colNumber, value: uixpbform_format_text_decode( htmlcode, true ) });
			
		})
	}
})(jQuery);


