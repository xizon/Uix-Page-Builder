/*!
 * ************************************
 * Initialize Global
 *************************************
 */
jQuery( document ).ready( function() {


    /*!
	 *
	 * Remove current icon from icons list
	 * ---------------------------------------------------
	 */
	jQuery( document ).on( 'click', '.uixpbform-icon-clear', function( e ) {
		e.preventDefault();

		var c               = jQuery( this ).closest( '.uixpbform-box' ),
			s               = c.find( 'span.icon-selector' ),
			targetID        = '#' + s.attr( 'target-id' ),
			chooseBtnID     = '#' + s.attr( 'target-id' ) + '-choosebtn',
			labeltxtID      = '#' + s.attr( 'target-id' ) + '-label',
			previewID       = '#' + s.attr( 'preview-id' );	
		
		
		jQuery( this ).css( 'display', 'none' );
		c.find( 'input' ).val( '' );
		c.find( '.uixpbform-icon-selector-icon-preview' ).html( '' ).removeClass( 'iconshow' );
		jQuery( chooseBtnID ).show();
		jQuery( labeltxtID ).show();
		jQuery( previewID ).hide();

	});
	
	
    /*!
	 *
	 * Normal checkbox
	 * ---------------------------------------------------
	 */

	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-normalchk', function() {

		// don't prevent mouse action
		var cur_targetThisID  = '#' + jQuery( this ).attr( "data-this-targetid" );

		if( jQuery( this ).is( ':checked' ) ) {
			jQuery( cur_targetThisID ).val( 1 );
		} else {
			jQuery( cur_targetThisID ).val( 0 );
		}


	} );



    /*!
	 *
	 * Remove focus
	 * ---------------------------------------------------
	 */

	jQuery( document ).on( 'click', '.uixpbform-form-container', function() {
		// don't prevent mouse action
		jQuery( this ).find( 'form .wp-color-input' ).blur();

	} );


    /*!
	 *
	 * Toggle of unidirectional display
	 * ---------------------------------------------------
	 */

	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-toggleshow', function( e ) {
		e.preventDefault();

		var cur_targetThisID   = '#' + jQuery( this ).attr( "data-this-targetid" );
		jQuery( this ).uixpbform_toggleshow();


		//status
		if( !jQuery( this ).hasClass( 'open' ) ) {
			jQuery( cur_targetThisID ).val( 1 );
		}


	} );
	//if IE
	if ( navigator.userAgent.indexOf('MSIE') >= 0 ) {
		jQuery( document ).off( 'click', '.uixpbform_btn_trigger-toggleshow' );
	}



    /*!
	 *
	 * Toggle of switch with radio
	 * ---------------------------------------------------
	 */
	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-toggleswitch_radio', function( e ) {
		e.preventDefault();

		var cur_targetID          = jQuery( this ).attr( "data-targetid" ),
		    cur_removeID          = jQuery( this ).attr( "data-remove" ),
			cur_targetCloneID     = jQuery( this ).attr( "data-targetid-clone" ),
			cur_list              = jQuery( this ).attr( "data-list" );

		//Dynamic button id
		if ( cur_targetCloneID != '{multID}' && cur_targetCloneID != '' ) {
			cur_targetID = cur_targetCloneID;
		}


		if ( cur_list == 1 ) {
			//Dynamic elements

			jQuery( cur_targetID ).parent().parent( '.toggle-row' ).show();
			jQuery( cur_targetID ).parent().parent( '.toggle-row' ).find( '.uixpbform-box' ).show();

			jQuery( cur_removeID ).parent().parent( '.toggle-row' ).hide();
			jQuery( cur_removeID ).parent().parent( '.toggle-row' ).find( '.uixpbform-box' ).hide();


		} else {

			jQuery( cur_targetID ).show();
			jQuery( cur_targetID ).find( 'th' ).find( 'label' ).show();
			jQuery( cur_targetID ).find( 'td' ).find( '.uixpbform-box' ).show();

			jQuery( cur_removeID ).hide();
			jQuery( cur_removeID ).find( 'th' ).find( 'label' ).hide();
			jQuery( cur_removeID ).find( 'td' ).find( '.uixpbform-box' ).hide();

		}



	} );
	//if IE
	if ( navigator.userAgent.indexOf('MSIE') >= 0 ) {
		jQuery( document ).off( 'click', '.uixpbform_btn_trigger-toggleswitch_radio' );
	}

    /*!
	 *
	 * Toggle of switch with checkbox
	 * ---------------------------------------------------
	 */
	 jQuery( document ).uixpbform_toggleSwitchCheckbox( { btnID: '.uixpbform_btn_trigger-toggleswitch_checkbox' } );


	/*!
	 *
	 * Dynamic Adding Input
	 * ---------------------------------------------------
	 */
	/*-- Click Action --*/
	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-clone', function( e ) {
		e.preventDefault();

		var cur_targetID        = '#' + jQuery( this ).attr( "data-targetid" ),
			cur_appendID        = '#' + jQuery( this ).attr( "data-appendid" ),
			cur_removeClass     = jQuery( this ).attr( "data-removeclass" ),
			cur_cloneContent    = jQuery( this ).attr( "data-clonecontent" ),
			cur_colid           = jQuery( this ).attr( "data-colid" ),
			cur_max             = jQuery( this ).attr( "data-max" ),
			cur_toggleTargetID  = jQuery( this ).attr( "data-toggle-targetid" ),
			cur_sectionRow      = jQuery( this ).attr( "data-section-row" );

		var show_count    = cur_max,
			clone_content = eval( cur_cloneContent ),
			widget_ID     = cur_sectionRow;

		clone_content = '<span class="dynamic-row dynamic-addnow">' + clone_content + '<div class="delrow-container"><a href="javascript:" class="delrow '+cur_removeClass+'" data-spy="'+cur_targetID.replace('#','')+'__'+cur_colid+'">&times;</a></div></span>';
		clone_content = clone_content
		               .replace( /toggle-row/g, 'toggle-row toggle-row-clone-list' )
					   .replace( /data-list="0"/g, 'data-list="1"' );


		var btnINdex = parseFloat( jQuery( this ).attr( 'data-index' ) );

		if ( btnINdex <= show_count ) {

			var cloneCode           = clone_content,
			    cur_toggleTargetID  = cur_toggleTargetID.replace( /{dataID}/g, ''+btnINdex+'-' );
			cloneCode = cloneCode.replace( /data-id=\"/g, 'id="'+btnINdex+'-section_'+widget_ID+'__'+cur_colid.replace( 'col-item-', '' ) );
			cloneCode = cloneCode.replace( /\]\[uix/g, ']'+btnINdex+'-[uix' );
			cloneCode = cloneCode.replace( /{dataID}/g, ''+btnINdex+'-' );
			cloneCode = cloneCode.replace( /{multID}/g, cur_toggleTargetID );
			cloneCode = cloneCode.replace( /{index}/g, '\['+widget_ID+'\]' );
			cloneCode = cloneCode.replace( /{columnid}/g, cur_colid );
			cloneCode = cloneCode.replace( /{colID}/g, ''+btnINdex+'-section_'+widget_ID+'__'+cur_colid.replace( 'col-item-', '' ) );

			jQuery( cur_appendID ).after( cloneCode );
			jQuery( this ).attr( 'data-index',btnINdex+1 );


		}


		if ( btnINdex == show_count ) {
			jQuery( this ).addClass( 'disable' );
		}



        /*-- Initializes the form state --*/
		//icon list with the jQuery AJAX method
		jQuery( '.uixpbform-icon-selector' ).uixpbform_iconSelector();

		//color picker
		jQuery( '.wp-color-input' ).wpColorPicker();

		//toggle default
		jQuery( '.uixpbform_btn_trigger-toggleshow' ).each( function()  {
			if ( jQuery( this ).closest( '.uixpbform-box' ).find( 'input' ).val() == 1 ) {
				jQuery( this ).uixpbform_toggleshow();
			}
		});


		jQuery( '.uixpbform_btn_trigger-toggleswitch_checkbox' ).uixpbform_toggleSwitchCheckboxStatus();
		jQuery( '.uixpbform_btn_trigger-toggleswitch_radio' ).uixpbform_toggleSwitchRadioStatus();


		//insert media
		jQuery( '.uixpbform_btn_trigger-upload' ).uixpbform_mediaStatus();


		/*-- The form focus --*/
		var srow            = jQuery( cur_appendID ).parent( 'td' ).find( ' > .dynamic-row' ),
			srowcols_c      = jQuery( cur_appendID ).closest( '.uixpbform-table-cols-wrapper' ),
			srowsingle_c    = jQuery( cur_appendID ).closest( '.uixpbform-table-wrapper' ),
			sroworg         = null, 
			sroworg_trigger = null;
		
		if ( srowcols_c.length > 0 ) {
			sroworg         = srowcols_c.find( 'tr[class^="dynamic-row-"]' ),
			sroworg_trigger = srowcols_c.find( 'tr[class^="dynamic-row-"] td' );	
		} else {
			sroworg         = srowsingle_c.find( 'tr[class^="dynamic-row-"]' ),
			sroworg_trigger = srowsingle_c.find( 'tr[class^="dynamic-row-"] td' );	
		}
		


		jQuery( srow ).on( 'mouseenter', function(){
			jQuery( srow ).removeClass( 'hover' );
			jQuery( srow ).addClass( 'hoverall' );
			jQuery( sroworg ).removeClass( 'hover' );
			jQuery( sroworg ).addClass( 'hoverall' );		

			jQuery( this ).addClass( 'hover' );
			jQuery( this ).removeClass( 'hoverall' );

			return false;
		});
		jQuery( srow ).on( 'mouseleave', function(){
			jQuery( srow ).removeClass( 'hoverall' );
			jQuery( sroworg ).removeClass( 'hoverall' );	

			jQuery( srow ).addClass( 'hover' );
			jQuery( sroworg ).addClass( 'hover' );

			return false;

		});

		//--
		jQuery( sroworg_trigger ).on( 'mouseenter', function(){
			jQuery( srow ).removeClass( 'hover' );
			jQuery( srow ).addClass( 'hoverall' );		

			jQuery( sroworg ).addClass( 'hover' );
			jQuery( sroworg ).removeClass( 'hoverall' );

			return false;
		});
		jQuery( sroworg_trigger ).on( 'mouseleave', function(){
			jQuery( srow ).removeClass( 'hoverall' );
			jQuery( sroworg ).removeClass( 'hoverall' );	

			jQuery( srow ).addClass( 'hover' );
			jQuery( sroworg ).addClass( 'hover' );

			return false;
		});	


		 /*-- Remove input --*/
		 if ( cur_removeClass ){

			 jQuery( document ).on( 'click', '.' + cur_removeClass, function( e ) {
				e.preventDefault();

				var  cur_thisBTN = jQuery( this ).closest( 'table' ).find( '.uixpbform_btn_trigger-clone' ),
				     btnINdex = parseFloat( cur_thisBTN.attr( 'data-index' ) );

				if ( btnINdex > 1 ) {
					jQuery( this ).closest( '.dynamic-addnow' ).remove();
					cur_thisBTN.attr( 'data-index',btnINdex-1 );
				}

				cur_thisBTN.removeClass( 'disable' );
				


			} );

		 }



	} );


	/*!
	 *
	 * Radio Selector
	 * ---------------------------------------------------
	 */
	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-radio span', function( e ) {
		e.preventDefault();

		var cur_targetID    = '#' + jQuery( this ).parent().attr( "data-targetid" ),
			cur_prop        = jQuery( this ).parent().attr( "data-prop" );


		var _curValue = jQuery( this ).attr( 'data-value' );
		jQuery( this ).parent().find( 'span' ).removeClass( 'active' );
		jQuery( cur_targetID ).val( _curValue );
		jQuery( this ).addClass( 'active' );

		//Dynamic listening for the latest value
		jQuery( cur_targetID ).focus().blur();

	} );


    /*!
	 *
	 * Multiple Selector
	 * ---------------------------------------------------
	 */
	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-multradio span', function( e ) {
		e.preventDefault();

		var cur_targetID    = '#' + jQuery( this ).parent().attr( "data-targetid" ),
			cur_prop        = jQuery( this ).parent().attr( "data-prop" );

		var _curValue = jQuery( this ).attr( 'data-value' ),
			_tarValue = jQuery( cur_targetID ).val() + ',',
			_result;

		jQuery( this ).toggleClass( 'active' );

		if ( _tarValue.indexOf( _curValue + ',' ) < 0 ) {
			_result = _tarValue + _curValue + ',';
		} else {
			_result = _tarValue.replace( _curValue + ',', '' );
		}

		jQuery( cur_targetID ).val( _result.substring( 0, _result.length-1 ) );

		//Dynamic listening for the latest value
		jQuery( cur_targetID ).focus().blur();


	} );




	/*!
	 *
	 * Insert media
	 * ---------------------------------------------------
	 */
	jQuery( document ).on( 'click', '.uixpbform_btn_trigger-upload', function( e ) {
		e.preventDefault();

		var cur_btnID       = '#' + jQuery( this ).attr( "data-btnid" ),
			cur_closebtnID  = '#' + jQuery( this ).attr( "data-closebtnid" ),
			cur_targetID    = '#' + jQuery( this ).attr( "data-targetid" ),
			cur_prop        = jQuery( this ).attr( "data-prop" );

		var upload_frame,
			value_id,
			propIDPrefix = cur_btnID.replace( '#', '' );


		/*-- Open upload window --*/
		var _targetImgContainer = jQuery( this ).attr( "data-insert-img" );
		var _targetPreviewContainer = jQuery( this ).attr( "data-insert-preview" );

		value_id =jQuery( this ).attr( 'id' );
		event.preventDefault();

		if( upload_frame ){
			upload_frame.open();
			return;
		}
		upload_frame = wp.media( {
			title: uix_page_builder_wp_plugin.lang_media_title,
			button: {
			text: uix_page_builder_wp_plugin.lang_media_text,
		},
			multiple: false
		} );
		upload_frame.on( 'select',function(){
			var attachment;
			attachment = upload_frame.state().get( 'selection' ).first().toJSON();
			jQuery( "#" + _targetImgContainer ).val( attachment.url );
			jQuery( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",attachment.url );//image preview
			jQuery( "#" + _targetPreviewContainer ).show();

			//Dynamic listening for the latest value
			jQuery( "#" + _targetImgContainer ).focus().blur();

			//Upload container
			if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
				jQuery( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','150px' );
			}


			if ( cur_closebtnID ){
				jQuery( cur_closebtnID ).show().css( { 'display': 'block' } );
			}

			//Show image properties
			if ( cur_prop ) {
				jQuery( "." + propIDPrefix + '_repeat' ).show();
				jQuery( "." + propIDPrefix + '_position' ).show();
				jQuery( "." + propIDPrefix + '_attachment' ).show();
				jQuery( "." + propIDPrefix + '_size' ).show();


			}

		} );

		upload_frame.open();

		/*-- Delete current picture --*/
		 if ( cur_closebtnID ){
			jQuery( document ).on( 'click', cur_closebtnID, function( e ) {
				e.preventDefault();
				var _targetImgContainer = jQuery( this ).attr( "data-insert-img" );
				var _targetPreviewContainer = jQuery( this ).attr( "data-insert-preview" );

				jQuery( "#" + _targetImgContainer ).val( '' );
				jQuery( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",'' );
				jQuery( "#" + _targetPreviewContainer ).hide();

				//Dynamic listening for the latest value
				jQuery( "#" + _targetImgContainer ).focus().blur();

				//Upload container
				if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
					jQuery( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','40px' );
				}


				jQuery( this ).hide();

				//Hide image properties
				if ( cur_prop ) {
					jQuery( "." + propIDPrefix + '_repeat' ).hide();
					jQuery( "." + propIDPrefix + '_position' ).hide();
					jQuery( "." + propIDPrefix + '_attachment' ).hide();
					jQuery( "." + propIDPrefix + '_size' ).hide();
				}


			} );

		 }


	});

});

/*!
 * ************************************
 * Insert media  status
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_mediaStatus = function( options ) {
		var settings=$.extend( {}, options );
		return this.each( function() {

			var cur_btnID       = '#' + jQuery( this ).attr( "data-btnid" ),
			    cur_closebtnID  = '#' + jQuery( this ).attr( "data-closebtnid" ),
				cur_targetID    = '#' + jQuery( this ).attr( "data-insert-img" ),
				cur_previewID   = '#' + jQuery( this ).attr( "data-insert-preview" ),
				cur_prop        = jQuery( this ).attr( "data-prop" ),
				propIDPrefix    = cur_btnID.replace( '#', '' ),
				imgvalue        = jQuery( cur_targetID ).val();

		
			if ( jQuery( cur_targetID ).length > 0 ) {
				
				if ( imgvalue.length == 0 ) {
					jQuery( cur_previewID ).hide().find( 'img' ).attr( 'src', '' );
				}
				

				if ( imgvalue.length > 0 ) {

					/*-- Show image properties and remove button --*/
					jQuery( cur_closebtnID ).show().css( { 'display': 'block' } );
					jQuery( cur_previewID ).show().find( 'img' ).attr( 'src', imgvalue );

					if ( cur_prop ) {
						jQuery( "." + propIDPrefix + '_repeat' ).show();
						jQuery( "." + propIDPrefix + '_position' ).show();
						jQuery( "." + propIDPrefix + '_attachment' ).show();
						jQuery( "." + propIDPrefix + '_size' ).show();

					}


					/*-- Delete current picture --*/
					 if ( cur_closebtnID ){
						jQuery( document ).on( 'click', cur_closebtnID, function( e ) {
							e.preventDefault();
							var _targetImgContainer = jQuery( this ).attr( "data-insert-img" );
							var _targetPreviewContainer = jQuery( this ).attr( "data-insert-preview" );

							jQuery( "#" + _targetImgContainer ).val( '' );
							jQuery( "#" + _targetPreviewContainer ).find( 'img' ).attr( 'src', '' );
							jQuery( "#" + _targetPreviewContainer ).hide();

							//Upload container
							if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
								jQuery( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','40px' );
							}


							jQuery( this ).hide();

							//Hide image properties
							if ( cur_prop ) {
								jQuery( "." + propIDPrefix + '_repeat' ).hide();
								jQuery( "." + propIDPrefix + '_position' ).hide();
								jQuery( "." + propIDPrefix + '_attachment' ).hide();
								jQuery( "." + propIDPrefix + '_size' ).hide();
							}


						} );

					 }



				}

			}



		} );

  };
} )( jQuery );


/*!
 * ************************************
 * Toggle of unidirectional display ( Show )
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_toggleshow = function( options ) {

		var settings=$.extend( {},options );
		return this.each( function() {

			var cur_targetID       = jQuery( this ).attr( "data-targetid" ),
				cur_targetCloneID  = jQuery( this ).attr( "data-targetid-clone" ),
				cur_list           = jQuery( this ).attr( "data-list" );

			//Dynamic button id
			if ( cur_targetCloneID != '{multID}' && cur_targetCloneID != '' ) {
				cur_targetID = cur_targetCloneID;
			}



			if ( cur_list == 1 ) {

				//Dynamic elements
				jQuery( this ).parent().parent( '.toggle-btn' ).hide();
				jQuery( cur_targetID ).parent().parent( '.toggle-row' ).show();
				jQuery( cur_targetID ).parent().parent( '.toggle-row' ).find( '.uixpbform-box' ).show();
				jQuery( cur_targetID ).addClass( 'active' );

			} else {
				jQuery( this ).parent( '.uixpbform-box' ).parent().parent( 'tr' ).hide();
				jQuery( cur_targetID ).show();
				jQuery( cur_targetID ).find( 'th' ).find( 'label' ).show();
				jQuery( cur_targetID ).find( 'td' ).find( '.uixpbform-box' ).show();
				jQuery( cur_targetID ).addClass( 'active' );

			}


		} );

  };
} )( jQuery );



/*!
 * ************************************
 * Re-initialize Dynamic Adding Input ( If there are some default values )
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_dynamicFormInit = function( options ) {

		var settings=$.extend( {
			'cloneCode' : ''
		}
		,options );
		return this.each( function() {


			var cur_appendID      = '#' + jQuery( this ).attr( "data-appendid" ),
				show_count        = jQuery( this ).attr( "data-max" ),
				cur_removeClass   = jQuery( this ).attr( "data-removeclass" ),
				btnINdex          = parseFloat( jQuery( this ).attr( 'data-index' ) );

			if ( btnINdex <= show_count ) {

				jQuery( cur_appendID ).after( settings.cloneCode );
				jQuery( this ).attr( 'data-index',btnINdex+1 );
			}


			if ( btnINdex == show_count ) {
				jQuery( this ).addClass( 'disable' );
			}


			/*-- Initializes the form state --*/
			//icon list with the jQuery AJAX method
			jQuery( '.uixpbform-icon-selector' ).uixpbform_iconSelector();

			//color picker
			jQuery( '.wp-color-input' ).wpColorPicker();

			//toggle default
			jQuery( '.uixpbform_btn_trigger-toggleshow' ).each( function()  {
				if ( jQuery( this ).closest( '.uixpbform-box' ).find( 'input' ).val() == 1 ) {
					jQuery( this ).uixpbform_toggleshow();
				}
			});
			jQuery( '.uixpbform_btn_trigger-toggleswitch_checkbox' ).uixpbform_toggleSwitchCheckboxStatus();
			jQuery( '.uixpbform_btn_trigger-toggleswitch_radio' ).uixpbform_toggleSwitchRadioStatus();

			//insert media
			jQuery( '.uixpbform_btn_trigger-upload' ).uixpbform_mediaStatus();


			
			/*-- Format all contents of <textarea>  --*/
			jQuery( cur_appendID ).closest( '.uixpbform-table-wrapper' ).find( 'textarea' ).each( function()  {

				var curdata = uixpbform_format_textarea( $( this ), true );
				if ( curdata != '' ) {
					$( this ).val( curdata );
				}

			});		
			

			/*-- The form focus --*/
			var srow            = jQuery( cur_appendID ).parent( 'td' ).find( ' > .dynamic-row' ),
				srowcols_c      = jQuery( cur_appendID ).closest( '.uixpbform-table-cols-wrapper' ),
				srowsingle_c    = jQuery( cur_appendID ).closest( '.uixpbform-table-wrapper' ),
				sroworg         = null, 
				sroworg_trigger = null;

			if ( srowcols_c.length > 0 ) {
				sroworg         = srowcols_c.find( 'tr[class^="dynamic-row-"]' ),
				sroworg_trigger = srowcols_c.find( 'tr[class^="dynamic-row-"] td' );	
			} else {
				sroworg         = srowsingle_c.find( 'tr[class^="dynamic-row-"]' ),
				sroworg_trigger = srowsingle_c.find( 'tr[class^="dynamic-row-"] td' );	
			}

			
			jQuery( srow ).on( 'mouseenter', function(){
				jQuery( srow ).removeClass( 'hover' );
				jQuery( srow ).addClass( 'hoverall' );
				jQuery( sroworg ).removeClass( 'hover' );
				jQuery( sroworg ).addClass( 'hoverall' );		

				jQuery( this ).addClass( 'hover' );
				jQuery( this ).removeClass( 'hoverall' );
				
				return false;
			});
			jQuery( srow ).on( 'mouseleave', function(){
				jQuery( srow ).removeClass( 'hoverall' );
				jQuery( sroworg ).removeClass( 'hoverall' );	
				
				jQuery( srow ).addClass( 'hover' );
				jQuery( sroworg ).addClass( 'hover' );
				
				return false;
					
			});
			
			//--
			jQuery( sroworg_trigger ).on( 'mouseenter', function(){
				jQuery( srow ).removeClass( 'hover' );
				jQuery( srow ).addClass( 'hoverall' );		

				jQuery( sroworg ).addClass( 'hover' );
				jQuery( sroworg ).removeClass( 'hoverall' );
				
				return false;
			});
			jQuery( sroworg_trigger ).on( 'mouseleave', function(){
				jQuery( srow ).removeClass( 'hoverall' );
				jQuery( sroworg ).removeClass( 'hoverall' );	
				
				jQuery( srow ).addClass( 'hover' );
				jQuery( sroworg ).addClass( 'hover' );
				
				return false;
			});	



			 /*-- Remove input --*/
			 if ( cur_removeClass ){

				 jQuery( document ).on( 'click', '.' + cur_removeClass, function( e ) {
					e.preventDefault();

					var  cur_thisBTN = jQuery( this ).closest( 'table' ).find( '.uixpbform_btn_trigger-clone' ),
						 btnINdex = parseFloat( cur_thisBTN.attr( 'data-index' ) );

					if ( btnINdex > 1 ) {
						jQuery( this ).closest( '.dynamic-addnow' ).remove();
						cur_thisBTN.attr( 'data-index',btnINdex-1 );
					}

					cur_thisBTN.removeClass( 'disable' );

				} );

			 }


		} );

  };
} )( jQuery );



/*!
 * ************************************
 * Toggle of switch with checkbox
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_toggleSwitchCheckbox = function( options ) {
		var settings=$.extend( {
			'btnID' : '.uixpbform_btn_trigger-toggleswitch_checkbox'
		}
		,options );
		return this.each( function() {

			//--------click
			jQuery( document ).on( 'click', settings.btnID ,function( e ) {
				e.preventDefault();

				var cur_targetID          = jQuery( this ).attr( "data-targetid" ),
					cur_linkedNoToggleID  = jQuery( this ).attr( "data-linked-no-toggleid" ),
					cur_targetCloneID     = jQuery( this ).attr( "data-targetid-clone" ),
					cur_list              = jQuery( this ).attr( "data-list" ),
					cur_targetThisID      = '#' + jQuery( this ).attr( "data-this-targetid" );


				//status
				if( !jQuery( this ).hasClass( 'checked' ) ) {
					jQuery( cur_targetThisID ).val( 1 );
				} else {
					jQuery( cur_targetThisID ).val( 0 );
				}
				
				//Dynamic listening for the latest value
				jQuery( cur_targetThisID ).focus().blur();	
				

				//Dynamic button id
				if ( cur_targetCloneID != '{multID}' && cur_targetCloneID != '' ) {
					cur_targetID = cur_targetCloneID;
				}

				if ( cur_list == 1 ) {
					//Dynamic elements

					var trid = jQuery( cur_targetID ).parent().parent( '.toggle-row' );

					if ( trid.css( 'display' ) == 'none' ) {

						trid.show();
						trid.find( '.uixpbform-box' ).show();
						jQuery( cur_targetID ).addClass( 'active' );
						jQuery( this ).addClass( 'checked' );

					} else {

						trid.hide();
						trid.find( '.uixpbform-box' ).hide();
						jQuery( this ).removeClass( 'checked' );

					}


				} else {

					var trid = jQuery( cur_targetID );

					if ( trid.css( 'display' ) == 'none' ) {

						trid.show();
						trid.find( 'th' ).find( 'label' ).show();
						trid.find( 'td' ).find( '.uixpbform-box' ).show();
						jQuery( this ).addClass( 'checked' );


					} else {

						trid.hide();
						trid.find( 'th' ).find( 'label' ).hide();
						trid.find( 'td' ).find( '.uixpbform-box' ).hide();
						jQuery( this ).removeClass( 'checked' );

					}

				}


				//if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid
				if ( cur_linkedNoToggleID != '' ) {
					jQuery( cur_linkedNoToggleID ).hide();
				}



			} );

			//if IE
			if ( navigator.userAgent.indexOf('MSIE') >= 0 ) {
				jQuery( document ).off( 'click', '.uixpbform_btn_trigger-toggleswitch_checkbox' );
			}


		} );

  };
} )( jQuery );


/*!
 * ************************************
 * Toggle of switch with checkbox status
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_toggleSwitchCheckboxStatus = function( options ) {
		var settings=$.extend( {}, options );
		return this.each( function() {

			var cur_targetID          = jQuery( this ).attr( "data-targetid" ),
				cur_linkedNoToggleID  = jQuery( this ).attr( "data-linked-no-toggleid" ),
				cur_targetCloneID     = jQuery( this ).attr( "data-targetid-clone" ),
				cur_list              = jQuery( this ).attr( "data-list" ),
				cur_targetThisID      = '#' + jQuery( this ).attr( "data-this-targetid" );

			//Dynamic button id
			if ( cur_targetCloneID != '{multID}' && cur_targetCloneID != '' ) {
				cur_targetID = cur_targetCloneID;
			}

			if ( cur_list == 1 ) {
				//Dynamic elements

				var trid = jQuery( cur_targetID ).parent().parent( '.toggle-row' );

				if( jQuery( this ).hasClass( 'checked' ) ) {
					trid.show();
					trid.find( '.uixpbform-box' ).show();
					jQuery( cur_targetID ).addClass( 'active' );

				}


			} else {

				var trid = jQuery( cur_targetID );
				if( jQuery( this ).hasClass( 'checked' ) ) {
					trid.show();
					trid.find( 'th' ).find( 'label' ).show();
					trid.find( 'td' ).find( '.uixpbform-box' ).show();

				}


			}


			//if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid
			if ( cur_linkedNoToggleID != '' ) {
				jQuery( cur_linkedNoToggleID ).hide();
			}
			


		} );

  };
} )( jQuery );


/*!
 * ************************************
 * Toggle of switch with radio status
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_toggleSwitchRadioStatus = function( options ) {
		var settings=$.extend( {}, options );
		return this.each( function() {

			var cur_targetID          = jQuery( this ).attr( "data-targetid" ),
				cur_removeID          = jQuery( this ).attr( "data-remove" ),
				cur_targetCloneID     = jQuery( this ).attr( "data-targetid-clone" ),
				cur_list              = jQuery( this ).attr( "data-list" ),
				cur_value             = jQuery( this ).closest( '.uixpbform-box' ).find( 'input' ).val();

			if ( cur_value == jQuery( this ).attr( 'data-value' ) ) {

				//Dynamic button id
				if ( cur_targetCloneID != '{multID}' && cur_targetCloneID != '' ) {
					cur_targetID = cur_targetCloneID;
				}


				if ( cur_list == 1 ) {
					//Dynamic elements

					jQuery( cur_targetID ).parent().parent( '.toggle-row' ).show();
					jQuery( cur_targetID ).parent().parent( '.toggle-row' ).find( '.uixpbform-box' ).show();

					jQuery( cur_removeID ).parent().parent( '.toggle-row' ).hide();
					jQuery( cur_removeID ).parent().parent( '.toggle-row' ).find( '.uixpbform-box' ).hide();


				} else {

					jQuery( cur_targetID ).show();
					jQuery( cur_targetID ).find( 'th' ).find( 'label' ).show();
					jQuery( cur_targetID ).find( 'td' ).find( '.uixpbform-box' ).show();

					jQuery( cur_removeID ).hide();
					jQuery( cur_removeID ).find( 'th' ).find( 'label' ).hide();
					jQuery( cur_removeID ).find( 'td' ).find( '.uixpbform-box' ).hide();

				}

			}


		} );

  };
} )( jQuery );

/*!
 * ************************************
 * Icon Selector
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_iconSelector = function( options ) {
	
		return this.each( function() {
			
			var $this           = $( this ),
			    containerID     = '#' + $this.attr( 'contain-id' ),
				iconURL         = $this.attr( 'list-url' ),
				targetID        = '#' + $this.attr( 'target-id' ),
				chooseBtnID     = '#' + $this.attr( 'target-id' ) + '-choosebtn',
				labeltxtID      = '#' + $this.attr( 'target-id' ) + '-label',
				previewID       = '#' + $this.attr( 'preview-id' ),
				listContainerID = 'icon-list-' + $this.attr( 'target-id' ),
				defaultIconName =  jQuery( targetID ).val(),
				$formContainer  = jQuery( previewID ).closest( '.uixpbform-box' );
				
			
			/*-- Default status --*/
			if ( $formContainer.find( 'input' ).val() == '' ) {
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'none' );
				$formContainer.find( 'input' ).val( '' );
				$formContainer.find( '.uixpbform-icon-selector-icon-preview' ).html( '' ).removeClass( 'iconshow' );
				jQuery( chooseBtnID ).show();
				jQuery( labeltxtID ).show();
				jQuery( previewID ).hide();

			} else {
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'inline-block' );
				$formContainer.find( '.uixpbform-icon-selector-icon-preview' ).html( '<i class="fa fa-'+$formContainer.find( 'input' ).val()+'"></i>' ).show().addClass( 'iconshow' );
				jQuery( chooseBtnID ).hide();
				jQuery( labeltxtID ).hide();
			}

			
			
			/*-- Icon list in new window --*/
			jQuery( document ).on( 'click', chooseBtnID, function( e ) {
				e.preventDefault();
				
				//current modal box ID
				var curmID          = uixpbform_curModalID(),
					$socialIcon     = jQuery( '#'+curmID+' .iconslist-box .b:not(.social)' ),
				    $socialTitle    = jQuery( '#'+curmID+' .iconslist-box .uixpbform-icon-social-title' )
				
				//console.log( curmID );

				//hide main modal content
				jQuery( '#'+curmID+' .ajax-temp' ).css( 'visibility', 'hidden' );
				//show sub window (icons)
				jQuery( '#'+curmID+' .iconslist-box' )
					.attr( 'id', listContainerID )
					.addClass( 'active' );
				
				
				//social icons
				if ( $this.hasClass( 'icon-social' ) ) {
					$socialIcon.hide();	
					$socialTitle.hide();		
				} else {
					$socialIcon.show();	
					$socialTitle.show();		
				}
				
			});
			
		

			/*-- Click event for icon type: Font Awesome --*/
			jQuery( document ).on( 'click', '#' + listContainerID + ' .b.fontawesome', function( e ) {
				e.preventDefault();
				var _v = jQuery(this).find( '.fa' ).attr( 'class' );
				
				
				_v = _v.replace( 'fa fa-', '' );
				jQuery( targetID ).val(_v);
				jQuery( previewID ).html( '<i class="fa fa-'+_v+'"></i>' ).show().addClass( 'iconshow' );
				
				//remove button
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'inline-block' );
				jQuery( chooseBtnID ).hide();
				jQuery( labeltxtID ).hide();
				
				
				//remove sub window (icons)
				jQuery( '.uixpbform-modal-box .iconslist-box' ).removeAttr( 'id' ).removeClass( 'active' );
				//show main modal content
				jQuery( '.uixpbform-modal-box .ajax-temp' ).css( 'visibility', 'visible' );

				//Dynamic listening for the latest value
				jQuery( targetID ).focus().blur();	
				
				
			});
			
	
		} );
	
  };
} )( jQuery );


/*! 
 * ************************************
 * Number formatting
 *************************************
 */	
function uixpbform_floatval( str ) {
	
	if (typeof str == "string" ) {
	    return ( !isNaN( parseFloat( str ) ) ) ? parseFloat( str ) : 0;
	} else {
		return str;
	}

}




/*!
 * ************************************
 * HTML Encode form textarea and input
 *************************************
 */
function uixpbform_htmlEncode( s ) {

      return (typeof s != "string") ? s :
          s.replace(/"|&|'|<|>|[\x00-\x20]|[\x7F-\xFF]|[\u0100-\u2700]/g,
                    function($0){
                        var c = $0.charCodeAt(0), r = ["&#"];
                        c = (c == 0x20) ? 0xA0 : c;
                        r.push(c); r.push(";");
                        return r.join("");
                    });
};




/*! 
 * ************************************
 * Transform to usable HTML tags and add to attributes of shortcode tags
 *************************************
 */	
function uixpbform_shortcodeUsableHtmlToAttr( str ) {
	
	if (typeof str == "string" ) {
	    return str.replace(/'/g,'"').replace(/“/g,'"').replace(/<|>/g,
				function($0){
					var c = $0.charCodeAt(0), r = ["&#"];
					c = (c == 0x20) ? 0xA0 : c;
					r.push(c); r.push(";");
					return r.join("");
				});
	} else {
		return str;
	}

}



/*!
 * ************************************
 * HTML5 Range
 *************************************
 */
function uixpbform_rangeSlider(sliderid, outputid, cusunits) {
        var x = document.getElementById( sliderid ).value;
		document.getElementById( outputid ).innerHTML = x + cusunits;

};



/*!
 * ************************************
 * Color transform
 *************************************
 */
function uixpbform_colorTran( value ) {

	switch( value ) {
		case '#a2bf2f':
		    return 'green';

		  break;
		case '#d59a3e':
		    return 'yellow';

		  break;

		case '#DD514C':
		    return 'red';
		  break;

		case '#FA9ADF':
		    return 'pink';

		  break;

		case '#4BB1CF':
		    return 'blue';
		  break;

		case '#0E90D2':
		    return 'darkblue';
		  break;


		case '#5F9EA0':
		    return 'cadetblue';
		  break;

		case '#473f3f':
		    return 'black';
		  break;


		case '#bebebe':
		    return 'gray';
		  break;
			
		case '#ffffff':
		    return 'white';
		  break;		


		default:

	}

};


/*!
 * ************************************
 * Format Content from Textarea
 *************************************
 */
function uixpbform_formatTextarea( str ) {

	
	if( typeof str !== typeof undefined ) {
		str = uixpbform_getHTML( str );
		str = str.toString().replace(/\s/g," ").replace(/\"/g,"&quot;").replace(/\'/g,"&apos;");
		str = str.replace(/<br\w*\/*>/g,"&lt;br&gt;");
		str = str.replace(/<p>/g,"&lt;p&gt;");
		str = str.replace(/<\/p>/g,"&lt;\/p&gt;");

	}

	return str;

}


function uixpbform_getHTML( str ) {

	
	if( typeof str !== typeof undefined ) {
	
		str = str.replace(/\r?\n/gm, '<br/>');
		str = str.replace(/(?!<br\/>)(.{5})<br\/><br\/>(?!<br\/>)/gi, '$1</p><p>');
		if ( str.indexOf( "<p>" ) > str.indexOf( "</p>" ) ) str = "<p>" + str;
		if ( str.lastIndexOf( "</p>" ) < str.lastIndexOf( "<p>" ) ) str += "</p>";
		if ( str.length > 1 && str.indexOf( "<p> ") == -1 ) str = "<p>" + str + "</p>";
		
	}

	return str;

}


/*!
 * ************************************
 * HTML tags like "<li>","<ul>","<ol>" transform
 *************************************
 */
function uixpbform_html_listTran( str, type ) {


	var newStr = '';

	if ( str != '' ) {

		if( typeof str !== typeof undefined ) {
			str = str.toString().replace(/(\r)*\n/g, '<br>' );
		}


		if ( str.indexOf( '<br>' ) >= 0 ) {

			var strarr = str.split( '<br>' );

			for (var i = 0, len = strarr.length; i < len; i++ ) {

				if ( strarr[i].indexOf( '<'+type+'>' ) >= 0 ) {
					newStr += strarr[i];
				} else {
					newStr += '<'+type+'>'+strarr[i]+'</'+type+'>';
				}


			}

		} else {

			if ( str.indexOf( '<'+type+'>' ) >= 0 ) {
				newStr = str;
			} else {
				newStr = '<'+type+'>'+str+'</'+type+'>';
			}

		}

	}

    newStr = newStr.replace(/\<li\>\<\/li\>/g, '' );

	return newStr;

};

/*!
 * ************************************
 * Insert page builder code
 *************************************
 */
function uixpbform_insertCodes( formid, code, conid, sid ) {
	( function( $ ) {
	"use strict";
		$( function() {

			 code = code.replace( '[{', '[{"name":"section","value":"'+formid+'"},{"name":"row","value":"'+sid+'"},{' )
			            .replace( /"/g, "{rqt:}");
			 $( '#' + conid ).val( code );
		} );

	} ) ( jQuery );

	//Initialize default value & form
	var gridsterInit = new UixPBGridsterMain();
	gridsterInit.formDataSave(); 
	
};


function uixpbform_formatAllCodes( code ) {
	var stringValue = code.toString();
	stringValue = stringValue.replace( /{rqt:}/g, "{rowqt:}")
	                        .replace( /{cqt:}/g, "{rowcqt:}")
							.replace( /{apo:}/g, "{rowcapo:}")
	                        .replace( /"/g, "{rowqt:}");
	return stringValue;

};


/*!
 * ************************************
 * Page builder textarea format
 *
 * Warning: Includes JSON data from <textarea>.
 *
 *************************************
 */
function uixpbform_htmlEscape( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str
			.replace(/"/g, '{cqt:}')
			.replace(/'/g, "{apo:}")
			.replace(/(\r)*\n/g, "<br>");
		
	}

	return str;
}

/*!
 * ************************************
 * Page builder textarea format
 *
 * Warning: Does not include JSON data.
 * When you enter a string in <textarea> will be saving, convert special characters to save JSON data.
 *
 *************************************
 */
function uixpbform_format_textarea_notJSON_save( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str.replace(/\s/g, "&nbsp;");
		
	}

	return str;
}


/*!
 * ************************************
 * Page builder textarea format when you are entering
 *
 * Before saving HTML code (do not include shortcode) of <textarea> tag for a single module.
 *
 *************************************
 */
function uixpbform_format_textarea_entering( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str
				.replace(/(\r)*\n/g, "<br>") //step 1
				.replace(/\s/g, "&nbsp;"); //step 2

	}

	return str;
}



/*!
 * ************************************
 * Dynamic Adding Input textarea format
 *
 * Warning: Does not include JSON data.
 * When you enter a string in <textarea>, convert special characters to save JSON data.
 *
 *************************************
 */
function uixpbform_format_textarea_dynamic( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str.replace(/&nbsp;/g, " ");
		
	}

	return str;
}



/*!
 * ************************************
 * Determine if the per module content contains WP shortcode
 *
 * Filter shortcodes of each column widget HTML code through their hooks.
 * Discard the rendering of separated module when the module contains these WP shortcodes, "*" represents a wildcard.
 *
 *************************************
 */
function uixpbform_per_module_has_shortcode( str ){
	
	var hasShortcode = false;
	
	
	if( typeof str !== typeof undefined ) {
	
		var arr          = uix_page_builder_layoutdata.send_string_render_entire.split( ',' );
		for( var j in arr ) {
			
			var thisStr = arr[j].toString().replace( '*', '' ).replace( ']', '' ).replace(/\s/g, '' );

			if ( str.indexOf( thisStr ) >= 0 ) {
				hasShortcode = true;
			}
		}
		
	}


	return hasShortcode;

}

/*!
 * ************************************
 * Format all contents of <textarea> when you will save or display data
 *
 * Determine if the per module content contains "WP Shortcode", "MCE Sync Data" and "Per Module HTML Data"
 *
 *************************************
 */
function uixpbform_format_textarea( obj, dynamic, val ){

	var newstr = '';
	
	if( typeof obj !== typeof undefined ) {
	    
		var tempID       = obj.data( 'tmpl-id' ),
			value        = ( typeof val !== typeof undefined && val != '' ) ? val : obj.val(),
			hasShortcode = uixpbform_per_module_has_shortcode( value );

		if ( value != '' ) {
			if ( 
				 ! hasShortcode && 
				 ! obj.hasClass( 'mce-sync' ) &&  
				 ( typeof tempID === typeof undefined )

			 ) {

				if ( dynamic ) {
					newstr = uixpbform_format_textarea_dynamic( value );
				} else {
					newstr = uixpbform_format_textarea_notJSON_save( value );
				}

			}	
		}

	}

	return newstr;
}




/*! 
 * ************************************
 * Returns value for toggle of switch with checkbox 
 *************************************
 */	
function uixpbform_toggleSwitchCheckboxVal( id ) {
	var result;
	( function( $ ) {
	"use strict";
		$( function() {
			
			if( $( 'input[data-this-targetid="'+id+'"]' ).parent( '.onoffswitch' ).hasClass( 'checked' ) ) {
				result = true;
			} else {
				result = false;
			}		

		} );
		
	} ) ( jQuery );
	
	return result;
};



/*! 
 * ************************************
 * Returns current modal box ID
 *************************************
 */	
function uixpbform_curModalID() {
	var result = '';
	( function( $ ) {
	"use strict";
		$( function() {
			
			$( '.uixpbform-modal-box' ).each( function()  {
				if ( $( this ).css( 'display' ) != 'none' ) {
					result = $( this ).attr( 'id' )
					return false;
				}
			});	

		} );
		
	} ) ( jQuery );
	
	return result;
};

/*! 
 * ************************************
 * Generate human-readable url slugs from any ordinary string.
 *************************************
 */	
function uixpbform_strToSlug( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var pattern = new RegExp("[`~!+%@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】\"；：”“'。，、？]");
		var rs = ""; 
		for (var i = 0; i < str.length; i++) { 
			rs = rs+str.substr( i, 1 ).replace( pattern, '' ); 
		} 

		rs = rs.replace(/\s/g, '-').toLowerCase();
		return rs;
	}
}

		

/*! 
 * ************************************
 * Initialize editor
 *************************************
 */	
/**
 * Based on "code" plugin
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */
( function( $ ) {
"use strict";
    $( function() {

		
		if ( typeof(tinymce) !== 'undefined' ) {
			
			tinymce.PluginManager.add('customCode', function(editor) {
				function showDialog() {
					var win = editor.windowManager.open({
						title: "Source code",
						body: {
							type: 'textbox',
							name: 'customCode',
							multiline: true,
							minWidth: editor.getParam("code_dialog_width", 600),
							minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 500)),
							spellcheck: false,
							style: 'direction: ltr; text-align: left'
						},
						onSubmit: function(e) {
							// We get a lovely "Wrong document" error in IE 11 if we
							// don't move the focus to the editor before creating an undo
							// transation since it tries to make a bookmark for the current selection
							editor.focus();

							if(editor.readonly != true){
								editor.undoManager.transact(function() {
									editor.setContent(e.data.customCode);
								});
							}

							editor.selection.setCursorLocation();
							editor.nodeChanged();

						}
					});


					// Gecko has a major performance issue with textarea
					// contents so we need to set it when all reflows are done
					win.find('#customCode').value(editor.getContent({source_view: true}));

					//disable source code editing while in readonly mode
					if(editor.readonly){
						var id = win.find('#customCode')[0]._id;
						$(win.find('#customCode')[0]._elmCache[id]).prop('readonly', true);
					}

					//This was an attempt to disable the "save" button but nothing I've tried is working. 
					//So far we are good because the user cannot modify the source code anyway
					/*for (var property in win.find('#code')[0].rootControl.controlIdLookup) {
						if (win.find('#code')[0].rootControl.controlIdLookup.hasOwnProperty(property)) {
							var realProperty = win.find('#code')[0].rootControl.controlIdLookup[property];
							var element = $($(realProperty._elmCache[realProperty._id])[0].children[0]);
							if(element.prop('type') == 'button'){
								$(element).prop('disabled', true);
								console.log(element.attr('disabled'));
								console.log(element.prop('disabled'));
							}
						}
					}*/
				}

				editor.addCommand("mceCustomCodeEditor", showDialog);

				editor.addButton('customCode', {
					icon: 'code',
					tooltip: 'Source code',
					onclick: showDialog,
					classes:'customCode'
				});

				editor.addMenuItem('customCode', {
					icon: 'code',
					text: 'Source code',
					context: 'tools',
					onclick: showDialog
				});
			});	
			
		}



	} );
    
    
} ) ( jQuery );


function uixpbform_editorInit( id ){
	( function( $ ) {
	"use strict";
		$( function() {
			
            if( typeof id !== typeof undefined ) {
				
				var vid = id.replace( '-editor', '' );
				
		
				tinyMCE.execCommand( 'mceRemoveEditor', true, id );
				tinymce.init({
					//tinyMCE Image Displaying Correctly, but not Updating src
					relative_urls : false,
					content_css : '',
					convert_urls : false,
					//---
					selector:  'textarea#' + id,
					height : 200,
					menubar: false,
					plugins: 'textcolor image media hr customCode',
				    toolbar: 'undo redo removeformat  | forecolor backcolor styleselect | uixpb_link uixpb_unlink bold italic | bullist numlist outdent indent alignleft aligncenter alignright | hr uixpb_image customCode',
					setup:function(ed) {
						
					   //Avoid formatting all contents of <textarea> 
					   $( 'textarea#' + vid ).addClass( 'mce-sync' );
						
					   ed.on( 'change', function(e) {
						   
						   var newvalue = ed.getContent()
						                                 .replace(/\r?\n/gm, '' )
						                                 .replace(/\.\.\/wp-content\/uploads\//g, uix_page_builder_wp_plugin.upload_dir_url );
						  
						   $( 'textarea#' + vid ).val( newvalue ).trigger( 'change' );
					   });
						
                        //Add media button
						function uixpb_mce_insertImage() {
							var upload_frame;
							if( upload_frame ){
								upload_frame.open();
								return;
							}
							upload_frame = wp.media( {
								title: uix_page_builder_wp_plugin.lang_media_title,
								button: {
								text: uix_page_builder_wp_plugin.lang_media_text,
							},
								multiple: false
							} );
							upload_frame.on( 'select',function() {
								var attachment;
								attachment = upload_frame.state().get( 'selection' ).first().toJSON();
								ed.insertContent( '<img src="'+attachment.url+'" alt="">' );

								
							} );

							upload_frame.open();
							
						}

						ed.addButton( 'uixpb_image', {
						  icon: 'mce-ico mce-i-image',
						  tooltip: uix_page_builder_wp_plugin.lang_mce_image,
						  onclick: uixpb_mce_insertImage
						});
						
						
						// Add link button
						ed.addButton('uixpb_link', {
							icon: 'mce-ico mce-i-link',
							tooltip: uix_page_builder_wp_plugin.lang_mce_link_title,
							onclick: function (e) {
								
								var urlRegex     = /<a href="(.*?)"/g,
									urlMatch     = '',
									selectedtxt  = ed.selection.getContent(),
									curlabel     = selectedtxt.replace(/<a\b[^>]*>/i, '' ).replace(/<\/a>/i, '' ),
									curlinkURL   = '';
								
								while( urlMatch = urlRegex.exec( selectedtxt ) ){
									curlinkURL = urlMatch[1];
								}	

								ed.windowManager.open( {
									title: uix_page_builder_wp_plugin.lang_mce_link_title,
									body: [
									{
										type: 'textbox',
										label: uix_page_builder_wp_plugin.lang_mce_link_field_url,
										name: 'link_url',
										value: curlinkURL,
										placeholder: 'https://',
										multiline: true,
										minWidth: 500,
										minHeight: 30,
									},
									{
										type: 'textbox',
										label: uix_page_builder_wp_plugin.lang_mce_link_field_text,
										name: 'link_text',
										value: curlabel,
										multiline: true,
										minWidth: 500,
										minHeight: 30,
									},	   
										
									{
										type: 'checkbox',
										name: 'link_target',
										label: ' ',
										text: ' ' + uix_page_builder_wp_plugin.lang_mce_link_field_win,
									},
				
										
									],
									onsubmit: function( e ) {
										
										var curtxt      = ( e.data.link_text != '' ) ? e.data.link_text : e.data.link_url,
											target      = ( e.data.link_target ) ? 'target="_blank"' : '';
										
										ed.insertContent( '<a href="' + e.data.link_url + '" ' + target + '>' + curtxt + '</a>');
									}
								});
							}
						});
						
						
						//Delete link button
						ed.addButton('uixpb_unlink', {
							icon: 'mce-ico mce-i-unlink',
							tooltip: uix_page_builder_wp_plugin.lang_mce_unlink_title,
							onclick: function (e) {
								
								var selectedtxt  = ed.selection.getContent();
								selectedtxt = selectedtxt.replace(/<a\b[^>]*>/i, '' ).replace(/<\/a>/i, '' );
								ed.insertContent(  selectedtxt );
								
							}
						});

						
				   },
				  content_css: [
					uix_page_builder_wp_plugin.url + 'css/uixpbform.editor.css'
				  ]
				});	
			}
			

		} );
		
	} ) ( jQuery );
	

}



/*! 
 * ************************************
 * Create a unique number with javascript time
 *************************************
 */	
function uixpbform_uid() {
    var date = Date.now();
    
    // If created at same millisecond as previous
    if (date <= uixpbform_uid.previous) {
        date = ++uixpbform_uid.previous;
    } else {
        uixpbform_uid.previous = date;
    }
    
    return date;
}



/*! 
 * ************************************
 * Display categories on page
 *************************************
 */	
function uixpbform_catlist( str, classprefix ) {
	
    if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var re      = new RegExp("(.*?)\<\/div\>","gim"),
			v       = '<div class="'+classprefix+'type">',
			re      = new RegExp("" + v + "(.*?)\<\/div\>","gim"),
			arr     = [],
			output  = '';

		str.replace( re, function(s, match) {
			   arr.push(match);
			  });	

		Array.prototype.uniqueArr = function() {
			
			//Because the template is too fast to switch, it will lead to script loading error.
			//Catch a possible error:  Syntax error, unrecognized expression
			try {

				var res  = [],
					json = {};

				for( var i = 0; i < this.length; i++ ) {

					var s = this[i].toString();
					if( !json[ s ] ) {
						res.push( s );
						json[ s ] = 1;
					}
				}
				return res;
				
			} catch( err ) {
				console.log( err.message );
			}
			

		}


		//output
		var newArr = arr.uniqueArr();
		for( var j = 0; j < newArr.length; j++ ) {
			output += '<li><a href="javascript:" data-group="'+uixpbform_strToSlug( newArr[j] )+'">'+newArr[j]+'</a></li>';
		}
		
		return output;
		
		
	}

}


