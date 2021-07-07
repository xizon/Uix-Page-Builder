/*!
 * ************************************
 * Initialize Global
 *************************************
 */
( function( $ ) {
"use strict";
	$( document ).ready( function() {


		/*!
		 *
		 * Remove current icon from icons list
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uixpbform-icon-clear', function( e ) {
			e.preventDefault();

			var c               = $( this ).closest( '.uixpbform-box' ),
				s               = c.find( 'span.icon-selector' ),
				targetID        = '#' + s.attr( 'data-targetid' ),
				chooseBtnID     = '#' + s.attr( 'data-targetid' ) + '-choosebtn',
				labeltxtID      = '#' + s.attr( 'data-targetid' ) + '-label',
				previewID       = '#' + s.attr( 'data-previewid' );	


			$( this ).css( 'display', 'none' );
			c.find( 'input' ).val( '' );
			c.find( '.uixpbform-icon-selector-icon-preview' ).html( '' ).removeClass( 'iconshow' );
			$( chooseBtnID ).show();
			$( labeltxtID ).show();
			$( previewID ).hide();

		});


		/*!
		 *
		 * Normal checkbox
		 * ---------------------------------------------------
		 */

		$( document ).on( 'click', '.uixpbform_btn_trigger-normalchk', function() {

			// don't prevent mouse action
			var cur_targetID  = '#' + $( this ).attr( "data-targetid" );

			if( $( this ).is( ':checked' ) ) {
				$( cur_targetID ).val( 1 );
			} else {
				$( cur_targetID ).val( 0 );
			}
			
			//Dynamic listening for the latest value
			$( cur_targetID ).focus().blur();


		} );



		/*!
		 *
		 * Remove focus
		 * ---------------------------------------------------
		 */

		$( document ).on( 'click', '.uixpbform-form-container', function() {
			// don't prevent mouse action
			$( this ).find( 'form .wp-color-input' ).blur();

		} );


		
		/*!
		 *
		 * Input elements of type "text" with attribute values and slug values
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'keyup', '.uixpbform-input-text-spy-attrslug', function() {
			
			var cur_value     = $( this ).val();
			
			//To attribute
			var $attr_input    = $( this ).closest( '.uixpbform-box' ).find( '.uixpbform-input-text-attr' );
			if ( $attr_input.length > 0 ) {
				$attr_input.val( uixpbform_format_htmlAttr( cur_value ) );
			}	
			
			//To slug
			var $slug_input    = $( this ).closest( '.uixpbform-box' ).find( '.uixpbform-input-text-slug' );
			if ( $slug_input.length > 0 ) {
				$slug_input.val( uixpbform_format_slug( cur_value ) );
			}	
			
		} );
			
		
		/*!
		 *
		 * Input elements of type "text" with units conversion
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'keyup', '.uixpbform-input-text-spy-deg_px', function() {
			
			var cur_value     = $( this ).val();
			
			//Degrees to px 
			var $attr_input    = $( this ).closest( '.uixpbform-box' ).find( '.uixpbform-input-text-deg_px' );
			if ( $attr_input.length > 0 ) {
				$attr_input.val( uixpbform_format_degToPx( cur_value ) );
			}
			
			
		} );
		
		/*!
		 *
		 * Traditional Selector
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'change', '.uixpbform_btn_trigger-select', function( e ) {
			e.preventDefault();

			var $selector     = $( this ),
			    cur_targetID  = '#' + $selector.attr( "data-targetid" );
			
	
			$( cur_targetID ).val( $selector.find( ' option:selected' ).val() );
			
			//Add event and status
			$selector.uixpbform_selectEvent();
			
			//Dynamic listening for the latest value
			$( cur_targetID ).focus().blur();

		} );
	
		

		/*!
		 *
		 * Multiple Selector
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '.uixpbform_btn_trigger-multradio span', function( e ) {
			e.preventDefault();

			var $selector     = $( this ).parent(),
				$option       = $( this ),
			    cur_targetID  = '#' + $selector.attr( "data-targetid" ),
				cur_value     = $option.attr( 'data-value' ),
				tar_value     = $( cur_targetID ).val() + ',',
			    res_value     = '';
			
			$option.toggleClass( 'active' );
			
			if ( tar_value.indexOf( cur_value + ',' ) < 0 ) {
				res_value = tar_value + cur_value + ',';
			} else {
				res_value = tar_value.replace( cur_value + ',', '' );
			}

			res_value = res_value
							.replace(/,\s*$/, '' )
							.replace(/^,/, '' );
			
			$( cur_targetID ).val( res_value );
			
			//Add event and status
			$selector.uixpbform_multipleEvent();
			
			//Dynamic listening for the latest value
			$( cur_targetID ).focus().blur();

		} );

		
		
		/*!
		 *
		 * Radio Selector
		 * ---------------------------------------------------
		 */	
		$( document ).on( 'click', '.uixpbform_btn_trigger-radio span', function( e ) {
			e.preventDefault();

			var $selector     = $( this ).parent(),
				$option       = $( this ),
			    cur_targetID  = '#' + $selector.attr( "data-targetid" ),
				cur_value     = $option.attr( 'data-value' );
			
			
			//Color Selector
			var $colorname_input    = $selector.closest( '.uixpbform-box' ).find( '.uixpbform-color-name' );
			if ( $colorname_input.length > 0 ) {
				$colorname_input.val( uixpbform_format_colorTran( cur_value ) );
			}	
			
			//Radio Selector
			$selector.find( 'span' ).removeClass( 'active' );
			$( cur_targetID ).val( cur_value );
			$option.addClass( 'active' );

			
			//Add event and status
			$selector.uixpbform_radioEvent();
			
			//Dynamic listening for the latest value
			$( cur_targetID ).focus().blur();

		} );
		
		
		

		/*!
		 *
		 * Toggle of unidirectional display
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uixpbform_btn_trigger-toggleshow', function( e ) {
			e.preventDefault();
			
			var $this   = $( this ),
			    $target = $this.closest( '.uixpbform-box' );

			
			$target.find( 'input[type="hidden"]' ).val( 1 );
			
			//Add event and status
			$this.uixpbform_toggleEvent( { unidirectionalDisplay: true } );
			

		} );
		
			
		/*!
		 *
		 * Toggle of switch with checkbox
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uixpbform_btn_trigger-toggleswitch_checkbox', function( e ) {
			e.preventDefault();
			
			var $this          = $( this ),
			    $target        = $this.closest( '.uixpbform-box' ).find( 'input[type="hidden"]' );

			
			if ( $target.val() == 1 ) {
				$target.val( 0 );
			} else {
				$target.val( 1 );
			}
			
			//Add event and status
			$this.uixpbform_toggleEvent( { unidirectionalDisplay: false } );
			
			//Dynamic listening for the latest value
			$target.focus().blur();
			

		} );
		
		


		/*!
		 *
		 * Dynamic Adding Input
		 * ---------------------------------------------------
		 */
		/*-- Click Action --*/
		$( document ).on( 'click', '.uixpbform_btn_trigger-clone', function( e ) {
			e.preventDefault();
			$( this ).uixpbform_dynamicFormInit( { type: 'click' } );
		} );



		/*!
		 *
		 * Insert media
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uixpbform_btn_trigger-upload', function( e ) {
			e.preventDefault();

			var cur_btnID       = '#' + $( this ).attr( "data-insert-btnid" ),
				cur_closebtnID  = '#' + $( this ).attr( "data-insert-closebtnid" ),
				cur_targetID    = '#' + $( this ).attr( "data-targetid" ),
				cur_prop        = $( this ).attr( "data-insert-prop" );

			var upload_frame,
				value_id,
				propIDPrefix = cur_btnID.replace( '#', '' );


			/*-- Open upload window --*/
			var _targetImgContainer = $( this ).attr( "data-insert-img" );
			var _targetPreviewContainer = $( this ).attr( "data-insert-preview" );

			value_id =$( this ).attr( 'id' );
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
				$( "#" + _targetImgContainer ).val( attachment.url );
				$( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",attachment.url );//image preview
				$( "#" + _targetPreviewContainer ).show();

				//Dynamic listening for the latest value
				$( "#" + _targetImgContainer ).focus().blur();

				//Upload container
				if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
					$( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','150px' );
				}


				if ( cur_closebtnID ){
					$( cur_closebtnID ).show().css( { 'display': 'block' } );
				}

				//Show image properties
				if ( cur_prop ) {
					$( "." + propIDPrefix + '_repeat' ).show().addClass( 'active' );
					$( "." + propIDPrefix + '_position' ).show().addClass( 'active' );
					$( "." + propIDPrefix + '_attachment' ).show().addClass( 'active' );
					$( "." + propIDPrefix + '_size' ).show().addClass( 'active' );


				}

			} );

			upload_frame.open();

			/*-- Delete current picture --*/
			 if ( cur_closebtnID ){
				$( document ).on( 'click', cur_closebtnID, function( e ) {
					e.preventDefault();
					var _targetImgContainer = $( this ).attr( "data-insert-img" );
					var _targetPreviewContainer = $( this ).attr( "data-insert-preview" );

					$( "#" + _targetImgContainer ).val( '' );
					$( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",'' );
					$( "#" + _targetPreviewContainer ).hide();

					//Dynamic listening for the latest value
					$( "#" + _targetImgContainer ).focus().blur();

					//Upload container
					if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
						$( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','40px' );
					}


					$( this ).hide();

					//Hide image properties
					if ( cur_prop ) {
						$( "." + propIDPrefix + '_repeat' ).hide().removeClass( 'active' );
						$( "." + propIDPrefix + '_position' ).hide().removeClass( 'active' );
						$( "." + propIDPrefix + '_attachment' ).hide().removeClass( 'active' );
						$( "." + propIDPrefix + '_size' ).hide().removeClass( 'active' );
					}


				} );

			 }


		});

	});
    
} ) ( jQuery );


/*!
 * ************************************
 * Insert media status
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_mediaStatus = function( options ) {
		var settings=$.extend( {}, options );
		return this.each( function() {

			var cur_btnID       = '#' + $( this ).attr( "data-insert-btnid" ),
			    cur_closebtnID  = '#' + $( this ).attr( "data-insert-closebtnid" ),
				cur_targetID    = '#' + $( this ).attr( "data-insert-img" ),
				cur_previewID   = '#' + $( this ).attr( "data-insert-preview" ),
				cur_prop        = $( this ).attr( "data-insert-prop" ),
				propIDPrefix    = cur_btnID.replace( '#', '' ),
				imgvalue        = $( cur_targetID ).val();

		
		
			if ( $( cur_targetID ).length > 0 ) {
				
				if ( imgvalue.length == 0 ) {
					$( cur_previewID ).hide().find( 'img' ).attr( 'src', '' );
				}
				

				if ( imgvalue.length > 0 ) {

					/*-- Show image properties and remove button --*/
					$( cur_closebtnID ).show().css( { 'display': 'block' } );
					$( cur_previewID ).show().find( 'img' ).attr( 'src', imgvalue );

					if ( cur_prop ) {
						$( "." + propIDPrefix + '_repeat' ).show();
						$( "." + propIDPrefix + '_position' ).show();
						$( "." + propIDPrefix + '_attachment' ).show();
						$( "." + propIDPrefix + '_size' ).show();

					}


					/*-- Delete current picture --*/
					 if ( cur_closebtnID ){
						$( document ).on( 'click', cur_closebtnID, function( e ) {
							e.preventDefault();
							var _targetImgContainer = $( this ).attr( "data-insert-img" );
							var _targetPreviewContainer = $( this ).attr( "data-insert-preview" );

							$( "#" + _targetImgContainer ).val( '' );
							$( "#" + _targetPreviewContainer ).find( 'img' ).attr( 'src', '' );
							$( "#" + _targetPreviewContainer ).hide();

							//Upload container
							if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
								$( cur_btnID ).parent( '.uixpbform-upbtn-container' ).css( 'height','40px' );
							}


							$( this ).hide();

							//Hide image properties
							if ( cur_prop ) {
								$( "." + propIDPrefix + '_repeat' ).hide();
								$( "." + propIDPrefix + '_position' ).hide();
								$( "." + propIDPrefix + '_attachment' ).hide();
								$( "." + propIDPrefix + '_size' ).hide();
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
 * Traditional Selector
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_selectEvent = function( options ) {

		var settings=$.extend( {}, options );
		return this.each( function() {
			

			var $this         = $( this ),
				cur_targetID  = '#' + $this.attr( 'data-targetid' ),
				cur_val       = $( cur_targetID ).val();

			if ( cur_val == '' ) {
				cur_val = $this.find( 'option:first' ).val();
				
				$( cur_targetID ).val( cur_val );
				
				//Dynamic listening for the latest value
				$( cur_targetID ).focus().blur();	

			}
			
			/*-- Compatible with 1.4.6 or before versions of .xml template files and pages that have saved data. --*/
			if ( $this.attr( 'data-targetid' ) == '' ) {
				cur_val = $this.closest( '.uixpbform-box' ).find( 'input[type="hidden"]' ).val();	
			}
			
			
			
			/*-- Control Status --*/
			$this.val( cur_val );
			
			

		} );

  };
} )( jQuery );



/*!
 * ************************************
 * Multiple Selector
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_multipleEvent = function( options ) {

		var settings=$.extend( {}, options );
		return this.each( function() {
			

			var $this         = $( this ),
			    $option       = $this.find( 'span' ),
				cur_targetID  = '#' + $this.attr( 'data-targetid' );


			
			/*-- Control Status --*/
			$option.each( function()  {
				
				if ( $( cur_targetID ).val().indexOf( $( this ).attr( 'data-value' ) ) >= 0 ) {
					$( this ).addClass( 'active' );
				} else {
					$( this ).removeClass( 'active' );
				}	
			
				
			});
			
		
			

		} );

  };
} )( jQuery );



/*!
 * ************************************
 * Radio Selector
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_radioEvent = function( options ) {

		var settings=$.extend( {}, options );
		return this.each( function() {
			

			var $this         = $( this ),
			    $option       = $this.find( 'span' ),
				cur_targetID  = '#' + $this.attr( 'data-targetid' );

			
			/*-- Identifies this object as a clone object --*/
			if ( cur_targetID.indexOf( '_listitem' ) >= 0 ) {
				$this.attr( "data-trigger-clone", 1 );
			}
			
			
			
			/*-- Control Status --*/
			var	clone_list     = $this.attr( "data-trigger-clone" ),
			    clone_tr_class = $this.closest( 'tr' ).attr( 'class' );

			
			$option.each( function()  {
				
				//Radio status
				if ( $( this ).attr( 'data-value' ) == $( cur_targetID ).val() ) {
					$( this ).addClass( 'active' );
				} else {
					$( this ).removeClass( 'active' );
				}	
				
				
				//Toggle of switch with radio status
				var	option_targetID      = $( this ).attr( 'data-targetid' ),
					option_targetIDs     = uixpbform_get_real_ids( option_targetID, cur_targetID, $this );
				
				
				if ( option_targetIDs != '' && option_targetIDs != ',' ) {

					if ( $( this ).attr( 'data-value' ) == $( cur_targetID ).val() ) {

						if ( clone_list == 1 ) {

							$( option_targetIDs ).closest( '.uixpbform-box' ).show().addClass( 'active' );
							$( option_targetIDs ).addClass( 'active' );	

							//First clone object (not allowed to delete)
							if ( typeof clone_tr_class !== typeof undefined && clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
								$( option_targetIDs ).closest( 'tr' ).show().addClass( 'active' );
							}	

						} else {

							$( option_targetIDs ).closest( 'tr' ).show().addClass( 'active' );
							$( option_targetIDs ).addClass( 'active' );	
						}

					} else {


						if ( clone_list == 1 ) {

							$( option_targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
							$( option_targetIDs ).removeClass( 'active' );

							//First clone object (not allowed to delete)
							if ( typeof clone_tr_class !== typeof undefined && clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
								$( option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
							}


						} else {

							$( option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
							$( option_targetIDs ).removeClass( 'active' );		

						}	

					}		

				}

				
				/*-- Exclude unidirectional display --*/
				if ( typeof( option_targetIDs ) == 'string' && option_targetIDs.length > 0 ) {

					option_targetIDs = option_targetIDs + ',';

					var ids = option_targetIDs.split( ',' );

					for ( var i = 0; i < ids.length; i++ ) {

						if ( ids[i] == '' ) break;

						var $unidirectionalDisplayTrigger = $( ids[i] ).closest( '.uixpbform-box' ).find( '.uixpbform_btn_trigger-toggleshow' );
						if ( $unidirectionalDisplayTrigger.length > 0 ) {

							var _$this              = $unidirectionalDisplayTrigger,
								_$target            = _$this.closest( '.uixpbform-box' ),
								_targetID           = _$this.attr( 'data-targetid' ),
								_curID              = _$target.find( 'input[type="hidden"]' ).attr( 'id' ),
								_curV               = _$target.find( 'input[type="hidden"]' ).val(),
								_option_targetIDs   = uixpbform_get_real_ids( _targetID, _curID, _$this );



								//Identifies this object as a clone object
								if ( _curID.indexOf( '_listitem' ) >= 0 ) {
									_$this.attr( "data-trigger-clone", 1 );
								}

								//Control Status
								var _clone_list     = _$this.attr( "data-trigger-clone" ),
									_clone_tr_class = _$this.closest( 'tr' ).attr( 'class' );


								//Forcibly initialize unidirectional display
								if ( $( this ).attr( 'data-value' ) == $( cur_targetID ).val() ) {

									if ( _curV == 1 ) {


										if ( _clone_list == 1 ) {

											_$this.closest( '.uixpbform-box' ).hide();

											if ( _option_targetIDs != '' ) {
												$( _option_targetIDs ).closest( '.uixpbform-box' ).show().addClass( 'active' );
												$( _option_targetIDs ).addClass( 'active' );

												if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
													$( _option_targetIDs ).closest( 'tr' ).show().addClass( 'active' );
												}
											}


										} else {
											_$this.closest( 'tr' ).hide();

											if ( _option_targetIDs != '' ) {
												$( _option_targetIDs ).closest( 'tr' ).show().addClass( 'active' );
												$( _option_targetIDs ).addClass( 'active' );	
											}	


										}	


									} else {

										if ( _clone_list == 1 ) {

											_$this.closest( '.uixpbform-box' ).show();

											if ( _option_targetIDs != '' ) {
												$( _option_targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
												$( _option_targetIDs ).removeClass( 'active' );

												if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
													$( _option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
												}
											}

										} else {

											_$this.closest( 'tr' ).show();

											if ( _option_targetIDs != '' ) {
												$( _option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
												$( _option_targetIDs ).removeClass( 'active' );		
											}


										}

									}//end if(_curV)							

								} else {


									if ( _clone_list == 1 ) {

										_$this.closest( '.uixpbform-box' ).hide();

										if ( _option_targetIDs != '' ) {
											$( _option_targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
											$( _option_targetIDs ).removeClass( 'active' );

											if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
												$( _option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
											}
										}


									} else {
										_$this.closest( 'tr' ).hide();

										if ( _option_targetIDs != '' ) {
											$( _option_targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
											$( _option_targetIDs ).removeClass( 'active' );		
										}


									}		


								}


						}


					}//end for

				}//end if	
				
				
			});
			
			
		

			//Dynamic form group‘s <tr> mandatory display
			$( '.dynamic-append-wrapper' ).parent( 'td' ).parent( 'tr' ).show();	
			
			
			

		} );

  };
} )( jQuery );


/*!
 * ************************************
 * Toggle Selector: Switch with checkbox, Unidirectional display.
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_toggleEvent = function( options ) {

		var settings=$.extend( {
			'unidirectionalDisplay' : true,
		}
		,options );
		return this.each( function() {
			

			var $this         = $( this ),
			    $target       = $this.closest( '.uixpbform-box' ),
				targetID      = $this.attr( 'data-targetid' ),
				curID         = $target.find( 'input[type="hidden"]' ).attr( 'id' ),
				targetIDs     = uixpbform_get_real_ids( targetID, curID, $this );

			
	
			/*-- Identifies this object as a clone object --*/
			if ( curID.indexOf( '_listitem' ) >= 0 ) {
				$this.attr( "data-trigger-clone", 1 );
			}
			

			
			/*-- Control Status --*/
			var clone_list     = $this.attr( "data-trigger-clone" ),
				clone_tr_class = $this.closest( 'tr' ).attr( 'class' );


			if ( $target.find( 'input[type="hidden"]' ).val() == 1 ) {


				//Activate this control
				if ( $this.hasClass( 'onoffswitch' ) ) $this.addClass( 'checked' );
				
				
				if ( clone_list == 1 ) {

					//Dynamic elements
					if ( settings.unidirectionalDisplay ) {
						$this.closest( '.uixpbform-box' ).hide();
					}
					
					
					if ( targetIDs != '' ) {
						$( targetIDs ).closest( '.uixpbform-box' ).show().addClass( 'active' );
						$( targetIDs ).addClass( 'active' );	
						
						//First clone object (not allowed to delete)
						if ( typeof clone_tr_class !== typeof undefined && clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
							$( targetIDs ).closest( 'tr' ).show().addClass( 'active' );
						}	
						
					}



				} else {
					if ( settings.unidirectionalDisplay ) {
					    $this.closest( 'tr' ).hide();
					}
					
					if ( targetIDs != '' ) {
						$( targetIDs ).closest( 'tr' ).show().addClass( 'active' );
						$( targetIDs ).addClass( 'active' );	
					}


				}

			} else {

				
				//Deactivate this control
				if ( $this.hasClass( 'onoffswitch' ) ) $this.removeClass( 'checked' );	
				

				if ( clone_list == 1 ) {

					//Dynamic elements
					if ( settings.unidirectionalDisplay ) {
					    $this.closest( '.uixpbform-box' ).show();
					}
					
					if ( targetIDs != '' ) {
						$( targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
						$( targetIDs ).removeClass( 'active' );

						//First clone object (not allowed to delete)
						if ( typeof clone_tr_class !== typeof undefined && clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
							$( targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
						}
					}
					



				} else {
					if ( settings.unidirectionalDisplay ) {
					    $this.closest( 'tr' ).show();
					}
					
					if ( targetIDs != '' ) {
						$( targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
						$( targetIDs ).removeClass( 'active' );		
					}
					


				}	


			}
			
			
			/*-- Exclude unidirectional display --*/
			if ( typeof( targetIDs ) == 'string' && targetIDs.length > 0 ) {

				targetIDs = targetIDs + ',';
				
				var ids = targetIDs.split( ',' );

				for ( var i = 0; i < ids.length; i++ ) {
					
					if ( ids[i] == '' ) break;
					
					var $unidirectionalDisplayTrigger = $( ids[i] ).closest( '.uixpbform-box' ).find( '.uixpbform_btn_trigger-toggleshow' );
					if ( $unidirectionalDisplayTrigger.length > 0 ) {
						
						var _$this         = $unidirectionalDisplayTrigger,
						    _$target       = _$this.closest( '.uixpbform-box' ),
						    _targetID      = _$this.attr( 'data-targetid' ),
							_curID         = _$target.find( 'input[type="hidden"]' ).attr( 'id' ),
							_curV          = _$target.find( 'input[type="hidden"]' ).val(),
							_targetIDs     = uixpbform_get_real_ids( _targetID, _curID, _$this );

							//Identifies this object as a clone object
							if ( _curID.indexOf( '_listitem' ) >= 0 ) {
								_$this.attr( "data-trigger-clone", 1 );
							}
			
							//Control Status
							var _clone_list     = _$this.attr( "data-trigger-clone" ),
								_clone_tr_class = _$this.closest( 'tr' ).attr( 'class' );
						
						
							//Forcibly initialize unidirectional display
						    if ( $target.find( 'input[type="hidden"]' ).val() == 1 ) {
								
								if ( _curV == 1 ) {


									if ( _clone_list == 1 ) {

										_$this.closest( '.uixpbform-box' ).hide();

										if ( _targetIDs != '' ) {
											$( _targetIDs ).closest( '.uixpbform-box' ).show().addClass( 'active' );
											$( _targetIDs ).addClass( 'active' );

											if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
												$( _targetIDs ).closest( 'tr' ).show().addClass( 'active' );
											}
										}


									} else {
										_$this.closest( 'tr' ).hide();

										if ( _targetIDs != '' ) {
											$( _targetIDs ).closest( 'tr' ).show().addClass( 'active' );
											$( _targetIDs ).addClass( 'active' );	
										}	


									}	


								} else {

									if ( _clone_list == 1 ) {

										_$this.closest( '.uixpbform-box' ).show();

										if ( _targetIDs != '' ) {
											$( _targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
											$( _targetIDs ).removeClass( 'active' );

											if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
												$( _targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
											}
										}

									} else {

										_$this.closest( 'tr' ).show();

										if ( _targetIDs != '' ) {
											$( _targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
											$( _targetIDs ).removeClass( 'active' );		
										}


									}

								}//end if(_curV)							
								
							} else {
								
								
								if ( _clone_list == 1 ) {

									_$this.closest( '.uixpbform-box' ).hide();

									if ( _targetIDs != '' ) {
										$( _targetIDs ).closest( '.uixpbform-box' ).hide().removeClass( 'active' );
										$( _targetIDs ).removeClass( 'active' );

										if ( typeof _clone_tr_class !== typeof undefined && _clone_tr_class.indexOf( 'dynamic-row-' ) >= 0 ) {
											$( _targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
										}
									}


								} else {
									_$this.closest( 'tr' ).hide();

									if ( _targetIDs != '' ) {
										$( _targetIDs ).closest( 'tr' ).hide().removeClass( 'active' );
										$( _targetIDs ).removeClass( 'active' );		
									}


								}		
								
								
							}


					}


				}//end for

			}//end if	
			

			//Dynamic form group‘s <tr> mandatory display
			$( '.dynamic-append-wrapper' ).parent( 'td' ).parent( 'tr' ).show();



			
		} );

  };
} )( jQuery );



/*!
 * ************************************
 * Re-initialize Dynamic Adding Input 
 *************************************
 */
( function( $ ) {
  jQuery.fn.uixpbform_dynamicFormInit = function( options ) {

		var settings=$.extend( {
			'type' : '', //Valid values: click, load
			
		}
		,options );
		return this.each( function() {


			var cur_appendID         = '#' + $( this ).attr( "data-clone-appendid" ),
				cur_removeCloneClass = $( this ).attr( "data-clone-removeclass" ),
				cur_colID            = $( this ).attr( "data-clone-colid" ),
				cur_formID           = $( this ).attr( "data-clone-formid" ),
				cur_max              = $( this ).attr( "data-clone-max" ),
				cur_sectionID        = $( this ).attr( "data-clone-sectionid" ),
				cur_renderTemp       = uixpbform_module_form_ids( cur_formID, cur_sectionID, cur_colID, false ),
				cur_echo_tmpl_ID     = '#' + $( this ).closest( '.uixpbform-modal-box' ).attr( 'id' ) + ' .echo-module-temp-clone',
				cur_echo_tmpl_code   = '',
				cur_load_tmpl_ID     = '',
			    $obj                 = $( '#uixpbform-modal-open-' + cur_formID );
		
			
			
			/*-- Detects whether each form group contains multiple columns --*/
			var clone_multiTrigger_group_col2   = $( this ).closest( '.uixpbform-modal-box' ).find( '.uixpbform-table-col-2' ).length,
				clone_multiTrigger_group_col3   = $( this ).closest( '.uixpbform-modal-box' ).find( '.uixpbform-table-col-3' ).length,
				clone_multiTrigger_group_col4   = $( this ).closest( '.uixpbform-modal-box' ).find( '.uixpbform-table-col-4' ).length,
				clone_multiTrigger_group_cols   = 0,
				clone_multiTrigger_group_index  = 0;
			
			if ( clone_multiTrigger_group_col2 > 1 ) clone_multiTrigger_group_cols = clone_multiTrigger_group_col2;
			if ( clone_multiTrigger_group_col3 > 1 ) clone_multiTrigger_group_cols = clone_multiTrigger_group_col3;
			if ( clone_multiTrigger_group_col4 > 1 ) clone_multiTrigger_group_cols = clone_multiTrigger_group_col4;

			if ( cur_appendID.indexOf( '_one_' ) >= 0 ) clone_multiTrigger_group_index = 1;
			if ( cur_appendID.indexOf( '_two_' ) >= 0 ) clone_multiTrigger_group_index = 2;
			if ( cur_appendID.indexOf( '_three_' ) >= 0 ) clone_multiTrigger_group_index = 3;
			if ( cur_appendID.indexOf( '_four_' ) >= 0 ) clone_multiTrigger_group_index = 4;
			
			
			
			/*-- Call the specified page modules --*/
			if ( clone_multiTrigger_group_cols > 1 ) {

				var cur_formID_index = '-' + clone_multiTrigger_group_index;
				
				//Empty container contents
				$( cur_echo_tmpl_ID ).html( '' );

				if ( uixpbform_isJSON( cur_renderTemp ) ) {
					//Use the saved data values
					$( '#module_tmpl_clone_' + settings.type + '__' + cur_formID + cur_formID_index ).tmpl( JSON.parse( cur_renderTemp ) ).appendTo( cur_echo_tmpl_ID );		
				} 
				cur_echo_tmpl_code = $( cur_echo_tmpl_ID ).html();


			}
			
			
			if ( clone_multiTrigger_group_cols == 0 ) {
				
				//Empty container contents
				$( cur_echo_tmpl_ID ).html( '' );

				if ( uixpbform_isJSON( cur_renderTemp ) ) {
					//Use the saved data values
					$( '#module_tmpl_clone_' + settings.type + '__' + cur_formID ).tmpl( JSON.parse( cur_renderTemp ) ).appendTo( cur_echo_tmpl_ID );		
				} 
				cur_echo_tmpl_code = $( cur_echo_tmpl_ID ).html();

				
			}

			
			
			/*-- Initializes the clone controls --*/
			var show_count    = cur_max,
				widget_ID     = cur_sectionID,
				appendTotal   = $( cur_echo_tmpl_code ).find( '.delrow' ).length,
				clone_content = cur_echo_tmpl_code;


			//Add an index value
			/* 
			 * The converted form ID is like:

			   uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1
			   uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-2
			   uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-3
			   ...

			  *
			  *
			  -------------
			  __index__              Used for all controls
			  __removeCloneClass__   Used for remove button

			*/

			if ( appendTotal > 1 ) {
				$( this ).attr( 'data-clone-index', appendTotal );
			}

			var cur_index = parseFloat( $( this ).attr( 'data-clone-index' ) );
			if ( cur_index < show_count ) {

				clone_content = clone_content.replace( /__removeCloneClass__/g, cur_removeCloneClass );




				if ( settings.type == 'click' ) {
					//Use the button to trigger the dynamic form to add
					clone_content      = clone_content.replace( /__index__/g, cur_index );	
				} else if ( settings.type == 'load' ) {
					//Load the saved data to trigger the dynamic form to add
					clone_content      = clone_content.replace( /__index__/g, '' );	
				}



				$( cur_appendID ).after( clone_content );

				$( this ).attr( 'data-clone-index', cur_index + 1 );


			}

			if ( ( cur_index + 1 ) == show_count ) {
				$( this ).addClass( 'disable' );
			}		

			

			/*-- Initializes the controls state --*/
			$( document ).uixpbform_init_controls( { form: $obj.find( '.dynamic-append-wrapper' ) } );
			
			

			/*-- The form focus --*/
			var srow            = $( cur_appendID ).closest( 'td' ).find( '.dynamic-row' ),
				srowcols_c      = $( cur_appendID ).closest( '.uixpbform-table-cols-wrapper' ),
				srowsingle_c    = $( cur_appendID ).closest( '.uixpbform-table-wrapper' ),
				sroworg         = null, 
				sroworg_trigger = null;
			
			srow.addClass( 'active' );
			

			if ( srowcols_c.length > 0 ) {
				sroworg         = srowcols_c.find( 'tr[class^="dynamic-row-"]' ),
				sroworg_trigger = srowcols_c.find( 'tr[class^="dynamic-row-"] td' );	
			} else {
				sroworg         = srowsingle_c.find( 'tr[class^="dynamic-row-"]' ),
				sroworg_trigger = srowsingle_c.find( 'tr[class^="dynamic-row-"] td' );	
			}



			$( srow ).on( 'mouseenter', function(){
				$( srow ).removeClass( 'hover' );
				$( srow ).addClass( 'hoverall' );
				$( sroworg ).removeClass( 'hover' );
				$( sroworg ).addClass( 'hoverall' );		

				$( this ).addClass( 'hover' );
				$( this ).removeClass( 'hoverall' );

				return false;
			});
			$( srow ).on( 'mouseleave', function(){
				$( srow ).removeClass( 'hoverall' );
				$( sroworg ).removeClass( 'hoverall' );	

				$( srow ).addClass( 'hover' );
				$( sroworg ).addClass( 'hover' );

				return false;

			});

			//--
			$( sroworg_trigger ).on( 'mouseenter', function(){
				$( srow ).removeClass( 'hover' );
				$( srow ).addClass( 'hoverall' );		

				$( sroworg ).addClass( 'hover' );
				$( sroworg ).removeClass( 'hoverall' );

				return false;
			});
			$( sroworg_trigger ).on( 'mouseleave', function(){
				$( srow ).removeClass( 'hoverall' );
				$( sroworg ).removeClass( 'hoverall' );	

				$( srow ).addClass( 'hover' );
				$( sroworg ).addClass( 'hover' );

				return false;
			});	


			 /*-- Remove input --*/
			 if ( cur_removeCloneClass ){

				 $( document ).on( 'click', '.' + cur_removeCloneClass, function( e ) {
					e.preventDefault();

					var  cur_thisBTN = $( this ).closest( 'table' ).find( '.uixpbform_btn_trigger-clone' ),
						 cur_index   = parseFloat( cur_thisBTN.attr( 'data-clone-index' ) );

					if ( cur_index > 1 ) {
						$( this ).closest( '.dynamic-addnow' ).remove();
						cur_thisBTN.attr( 'data-clone-index', cur_index - 1 );
					}

					cur_thisBTN.removeClass( 'disable' );



				} );

			 }


		} );

  };
} )( jQuery );





/*!
 * ************************************
 * Normal checkbox status
 *************************************
 */
 ( function( $ ) {
  jQuery.fn.uixpbform_normalCheckboxStatus = function( options ) {
		var settings=$.extend( {}, options );
		return this.each( function() {

			var $this         = $( this ),
				cur_targetID  = '#' + $this.attr( "data-targetid" );

			if ( $( cur_targetID ).val() == 1 ) {
				$this.prop( "checked", true );
			} else {
				$this.prop( "checked", false );
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
			    containerID     = '#' + $this.attr( 'data-containerid' ),
				targetID        = '#' + $this.attr( 'data-targetid' ),
				chooseBtnID     = '#' + $this.attr( 'data-targetid' ) + '-choosebtn',
				labeltxtID      = '#' + $this.attr( 'data-targetid' ) + '-label',
				previewID       = '#' + $this.attr( 'data-previewid' ),
				iconURL         = $this.attr( 'data-listurl' ),
				listContainerID = 'icon-list-' + $this.attr( 'data-targetid' ),
				defaultIconName =  $( targetID ).val(),
				$formContainer  = $( previewID ).closest( '.uixpbform-box' );
				
			
			/*-- Default status --*/
			if ( $formContainer.find( 'input' ).val() == '' ) {
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'none' );
				$formContainer.find( 'input' ).val( '' );
				$formContainer.find( '.uixpbform-icon-selector-icon-preview' ).html( '' ).removeClass( 'iconshow' );
				$( chooseBtnID ).show();
				$( labeltxtID ).show();
				$( previewID ).hide();

			} else {
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'inline-block' );
				$formContainer.find( '.uixpbform-icon-selector-icon-preview' ).html( '<i class="fa fa-'+$formContainer.find( 'input' ).val()+'"></i>' ).show().addClass( 'iconshow' );
				$( chooseBtnID ).hide();
				$( labeltxtID ).hide();
			}

			
			
			/*-- Icon list in new window --*/
			$( document ).on( 'click', chooseBtnID, function( e ) {
				e.preventDefault();
				
				//current modal box ID
				var curmID          = uixpbform_curModalID(),
					$socialIcon     = $( '#'+curmID+' .iconslist-box .b:not(.social)' ),
				    $socialTitle    = $( '#'+curmID+' .iconslist-box .uixpbform-icon-social-title' )
				
				//console.log( curmID );

				//show sub window (icons)
				$( '#'+curmID+' .iconslist-box' )
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
			$( document ).on( 'click', '#' + listContainerID + ' .b.fontawesome', function( e ) {
				e.preventDefault();
				var _v = $(this).find( '.fa' ).attr( 'class' );
				
				
				_v = _v.replace( 'fa fa-', '' );
				$( targetID ).val(_v);
				$( previewID ).html( '<i class="fa fa-'+_v+'"></i>' ).show().addClass( 'iconshow' );
				
				//remove button
				$formContainer.find( '.uixpbform-icon-clear' ).css( 'display', 'inline-block' );
				$( chooseBtnID ).hide();
				$( labeltxtID ).hide();
				
				
				//remove sub window (icons)
				$( '.uixpbform-modal-box .iconslist-box' ).removeAttr( 'id' ).removeClass( 'active' );

				//Dynamic listening for the latest value
				$( targetID ).focus().blur();	
				
				
			});
			
	
		} );
	
  };
} )( jQuery );



/*! 
 * ************************************
 * Initializes the controls state
 *
 * Valid when opening a window or triggering a clone event
 * @param  {object} form                        - The current form object
 * @return {void}                               - The constructor.
 *
 *************************************
 */	
 ( function( $ ) {
  jQuery.fn.uixpbform_init_controls = function( options ) {
		var settings=$.extend( {
			'form' : '',
			
		}
		,options );
		return this.each( function() {

			var $this         = $( this ),
				$obj          = settings.form;

			//Init tinyMCE
			$obj.find( '.uixpbform-mce-editor' ).each( function()  {
				$( this ).find( 'textarea.mce' ).val( uixpbform_to_controlSaveData_ToHTML( $( this ).find( 'textarea.mce' ).val() ) );	
				uixpbform_editorInit( $( this ).find( 'textarea.mce' ).attr( 'id' ) );
			});
			
		
			//Check the status of all form values as "&nbsp;"
			$obj.find( '[data-enter-value]' ).each( function()  {

				if ( $.trim( $( this ).val() ) == '' ) {
					$( this ).val( '' );
				}
				
				//Filter the default value with jQuery Templates plugin
				if ( $.trim( $( this ).val() ).length > 0 ) {
					
					var cur_val      = $( this ).val(),
						pattern_val  = /_tmplitem=".*?"/g,
						matchArr_val = '';

					
					while ( ( matchArr_val = pattern_val.exec( cur_val ) ) ) {
						var _re = new RegExp( '(\\s|)'+matchArr_val[0]+'(\\s|)' , 'g' );
						cur_val = cur_val.replace( _re, '' );
					}	
					
					$( this ).val( cur_val );
				}
				
			});	

			//Traditional Selector
			$obj.find( '.uixpbform_btn_trigger-select' ).each( function()  {
				$( this ).uixpbform_selectEvent();
			});
		
			//Icon list
			$obj.find( '.uixpbform-icon-selector' ).uixpbform_iconSelector();

			//Color picker
			$obj.find( '.wp-color-input' ).wpColorPicker();

			//Toggle of unidirectional display
			$obj.find( '.uixpbform_btn_trigger-toggleshow' ).each( function()  {
				$( this ).uixpbform_toggleEvent( { unidirectionalDisplay: true } );
			});

			//Toggle of switch with checkbox
			$obj.find( '.uixpbform_btn_trigger-toggleswitch_checkbox' ).each( function()  {
				$( this ).uixpbform_toggleEvent( { unidirectionalDisplay: false } );
			});			

			//Multiple Selector
			$obj.find( '.uixpbform_btn_trigger-multradio' ).each( function()  {
				$( this ).uixpbform_multipleEvent();
			});	

			//Radio Selector
			$obj.find( '.uixpbform_btn_trigger-radio' ).each( function()  {
				$( this ).uixpbform_radioEvent();
			});	


			//Normal checkbox status	
			$obj.find( '.uixpbform_btn_trigger-normalchk' ).uixpbform_normalCheckboxStatus();

			//Insert media status
			$obj.find( '.uixpbform_btn_trigger-upload' ).uixpbform_mediaStatus();	
			
		
		} );

  };
} )( jQuery );

			


/*! 
 * ************************************
 * Get the real form ID from the associated attribute "data-targetid"
 *
 * Note: Used for controls "toggle", "checkbox", "radio"
 *
 * @param  {string} targetID          - All id of the target control. Like this: uix_pb_???_??, uix_pb_???_??, uix_pb_???_??,
 * @param  {string} curID             - Current control ID. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1
 * @param  {string} obj               - Current control object.
 * @return {string}                   - Converted value matching this (clone) control ID. Note that the prefix has a "#".
                                            Like this: #uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-,
											           #uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1,
													   #uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-2,
 
 
 *	 
 *************************************
 */	
function uixpbform_get_real_ids( targetID, curID, obj ) {
	
	var result = '';

	if ( typeof targetID !== typeof undefined && targetID != '' ) {

		targetID = targetID.replace(/,\s*$/, '' );
		targetID = uixpbform_filter_control_id( targetID );

		obj.closest( 'form' ).find( '[id]' ).each( function()  {

			var _fieldID = jQuery( this ).attr( 'id' );

			if ( typeof( _fieldID ) == 'string' && _fieldID.length > 0 ) {

				var ids = targetID.split( ',' );

				for ( var i = 0; i < ids.length; i++ ) {


					if (  
						ids[i] != '' && 
						_fieldID.indexOf( ids[i] ) >= 0 &&
						curID.indexOf( _fieldID ) < 0 
					) {

						// Check the value of the attribute "data-targetid" of the already cloned control, 
						// and convert it to the value matching this clone control ID.
						_fieldID = uixpbform_to_cloneControl_targetID( curID, _fieldID );

						if ( _fieldID != '' ) {
							result += '#' + _fieldID + ',';
						}

					}

				}//end for

			}//end if

		});	

		result = result.replace(/,\s*$/, '' );

	}	


	return result;
	

}

	

/*! 
 * ************************************
 * Number formatting
 *************************************
 */	
function uixpbform_format_floatval( str ) {
	
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	    return ( !isNaN( parseFloat( str ) ) ) ? parseFloat( str ) : 0;
	} else {
		return str;
	}

}



/*! 
 * ************************************
 * Convert degrees to px 
 *************************************
 */	
function uixpbform_format_degToPx( str ) {
	
	if ( typeof( str ) == 'string' || typeof( str ) == 'number' ) {
	    return Math.abs( ( uixpbform_format_floatval( str ) * 180 / Math.PI )/2 );
	} else {
		return str;
	}

}



/*!
 * ************************************
 * HTML Encode form textarea and input
 *************************************
 */
function uixpbform_format_htmlAttr( str ) {

	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		
		//Filters the break key
		str = str
			.toString()
		    .replace(/(\r)*\n/g, "{br:}" );
		

	    return str.replace(/\[|\]|"|&|'|<|>|[\x00-\x20]|[\x7F-\xFF]|[\u0100-\u2700]/g,
                    function($0){
                        var c = $0.charCodeAt(0), r = ["&#"];
                        c = (c == 0x20) ? 0xA0 : c;
                        r.push(c); r.push(";");
                        return r.join("");
                    })
		            //Filters a string cleaned and escaped for output in an HTML attribute.
					.replace(/\&\#34;/g, '{attrrowcqt:}' )
					.replace(/\&\#39;/g, "{attrrowcapo:}" )
		            //Filters a string cleaned and escaped for output in an HTML attribute and WP shortcodes.
					.replace(/\&\#91;/g, "{lsquarebracket:}" )
					.replace(/\&\#93;/g, "{rsquarebracket:}" )
					//Filters a string cleaned and escaped for output in an HTML tags.
					.replace(/\&\#60;/g, '{lt:}' )
					.replace(/\&\#62;/g, '{gt:}' );
		 
		
	} else {
		return str;
	}
	
};



/*!
 * ************************************
 * Encodes a Uniform Resource Identifier (URI) by replacing each instance of certain characters 
 *************************************
 */
function uixpbform_format_urlEncode( str ) {

	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {

		
		var re = new RegExp('^\#');
		
		if ( !re.test( str ) ) {
			if ( str.indexOf( 'http://' ) < 0 && str.indexOf( 'https://' ) < 0 ) {
				newstr =  'http://' + encodeURI( str );
			} else {
				newstr =  encodeURI( str );
			}	
		} else {
			newstr = str;
		}
		

	} else {
		newstr = str;
	}

	
	
	return newstr;
	
};



/*!
 * ************************************
 * Color transform
 *************************************
 */
function uixpbform_format_colorTran( value ) {

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
 * HTML tags like "<li>","<ul>","<ol>" transform
 *************************************
 */
function uixpbform_format_html_listTran( str, type ) {


	var newstr = '';

	if ( str != '' ) {

		if( typeof str !== typeof undefined ) {
			str = str.toString()
				     .replace(/(\r)*\n/g, '<br>' )
				     .replace(/\s/g, "&nbsp;"); //step 2
		}

		//Convert an escape white space character
		var re  = /\<([^\>]+)\>/ig;
		if ( re.test( str ) ) {
			str = str.replace( re, function( m ){ return m.replace(/&nbsp;/ig, ' ' ); } );	
		}
		
		

		if ( str.indexOf( '<br>' ) >= 0 ) {

			var strarr = str.split( '<br>' );

			for (var i = 0; i < strarr.length; i++ ) {

				if ( strarr[i].indexOf( '<'+type+'>' ) >= 0 ) {
					newstr += strarr[i];
				} else {
					newstr += '<'+type+'>'+strarr[i]+'</'+type+'>';
				}


			}

		} else {

			if ( str.indexOf( '<'+type+'>' ) >= 0 ) {
				newstr = str;
			} else {
				newstr = '<'+type+'>'+str+'</'+type+'>';
			}

		}


	}

	var re2  = new RegExp( "\\<"+type+"\\>\\<\\/"+type+"\\>" , 'g' );
	newstr = newstr.replace( re2, '' );


	return newstr;

};



/*!
 * ************************************
 * Format the value of a form control for the specified type
 *************************************
 */
function uixpbform_value_callback( str, type ) {

	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {

		switch( type ) {	
			case 'url':
				newstr  = uixpbform_format_urlEncode( str );

			  break;
			case 'attr':
				newstr  = uixpbform_format_htmlAttr( str );

			  break;
			
			case 'slug':
				newstr  = uixpbform_format_slug( str );

			  break;
			case 'html':
				newstr  = uixpbform_format_text_entering( str );

			  break;

			case 'number':
				newstr  = uixpbform_format_floatval( str );

			  break;
				
			case 'number-deg_px':
				newstr  = uixpbform_format_degToPx( str );

			  break;

			case 'color-name':
				newstr  = uixpbform_format_colorTran( str );

			  break;	  


			case 'list':
				newstr  = uixpbform_format_html_listTran( str, 'li' );

			  break;  

			default:
				newstr  = uixpbform_format_text_entering( str );
				

		}
		
	} else {
		newstr = str;
	}
	
	return newstr;
	

};


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
 * Insert page builder code
 *************************************
 */
function uixpbform_insertCodes( formid, code, conid, sid ) {
	if ( jQuery( '#' + conid ).length > 0 ) {
		 code = code.replace( '[{', '[{"name":"section","value":"'+formid+'"},{"name":"row","value":"'+sid+'"},{' )
					.replace( /"/g, "{rqt:}");

		 jQuery( '#' + conid ).val( code );	
	}
	//Initialize default value & form
	var gridsterInit = new UixPBGridsterMain();
	gridsterInit.formDataSave(); 
	
};



/*!
 * ************************************
 * Convert data from <textarea> to saveable JSON data
 *
 * Warning: Includes JSON data from <textarea>.
 *
 *************************************
 */
function uixpbform_textarea_to_JSONSaveData( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str.toString()
						.replace(/\$/g, '&#36;' )
						.replace(/"/g, '{cqt:}' )
						.replace(/'/g, '{apo:}' )
						.replace(/(\r)*\n/g, "<br>");
	
	}

	return str;
}



/*!
 * ************************************
 * Decodes an encoded string.
 *
 * Used when using jQuery to read textarea
 *
 *
 * @param  {string}   str           - A string.
 * @param  {boolean} renderFrontend - If true, use the front-end template processing method
 * @return {string}                 - A new string.
 *	 
 *************************************
 */	
function uixpbform_format_text_decode( str, renderFrontend ){
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		newstr  = str
					.replace(/&quot;/g, '"')
					.replace(/&#39;/g, "'")
					.replace(/&lt;/g, '<')
					.replace(/&gt;/g, '>');
		
		//Use the front-end template processing method
		if ( typeof renderFrontend !== typeof undefined && renderFrontend ) {
			newstr = newstr
						 //HTML attribute.
						 .replace( /\{attrrowcapo\:\}/g, "&#39;" )
						 .replace( /\{attrrowcqt\:\}/g, '&#34;' )	
						 //HTML attribute and WP shortcodes.
						 .replace( /\{lsquarebracket\:\}/g, "&#91;" )
						 .replace( /\{rsquarebracket\:\}/g, '&#93;' )
						 //HTML tag.
						 .replace( /\{lt\:\}/g, "&#60;" )
						 .replace( /\{gt\:\}/g, '&#62;' )
			             //Break key
			             .replace( /\{br\:\}/g, '<br>' );		
			
			
			
		}	
		

	}
	
	return newstr;
	

}



/*!
 * ************************************
 * Page builder textarea and input format when you are entering
 *
 * Before saving HTML code (include shortcode) of <textarea> tag for a single module.
 *
 *************************************
 */
function uixpbform_format_text_entering( str ){
	
	
	if( typeof str !== typeof undefined ) {
	
		str = str.toString()
				.replace(/\&\#91;/g, '[')    //step 1
				.replace(/\&\#93;/g, ']')    //step 2
				.replace(/(\r)*\n/g, "<br>" ) //step 3    
				.replace(/\s/g, "&nbsp;" );   //step 4
		
		//Convert an escape white space charact
		var re  = /\<([^\>]+)\>/ig,
			re2 = /\[([^\]]+)\]/ig;

		if ( re.test( str ) ) {
			str = str.replace( re, function( m ){ return m.replace(/&nbsp;/ig, ' ' ); } );	
		}
		if ( re2.test( str ) ) {
			str = str.replace( re2, function( m ){ return m.replace(/&nbsp;/ig, ' ' ); } );	
		}	
		
		
		//Special character filter to avoid conflicts with JSON template data
		str = str
			.replace(/\[/g, '&#91;')
			.replace(/\]/g, '&#93;');
		
		
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
	
		var re  = /\[([^\]]+)\]/ig;
		if ( re.test( str ) ) {
			hasShortcode = true;
		}

	}

	return hasShortcode;

}



/*! 
 * ************************************
 * Returns current modal box ID
 *************************************
 */	
function uixpbform_curModalID() {
	var result = '';
	jQuery( '.uixpbform-modal-box' ).each( function()  {
		if ( jQuery( this ).css( 'display' ) != 'none' ) {
			result = jQuery( this ).attr( 'id' )
			return false;
		}
	});	
	return result;
};

/*! 
 * ************************************
 * Generate human-readable url slugs from any ordinary string.
 *************************************
 */	
function uixpbform_format_slug( str ) {
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		return str
			    .toString()
				.replace(/[^\w\s\-！￥【】\u4e00-\u9eff]/gi, '')
				.replace(/\s/g, '-')
				.replace(/(\-){2,}/g, '-')
				.replace(/\-\s*$/, '' )
				.toLowerCase();

	} else {
		return '';
	}
}




/*! 
 * ************************************
 * Check if a string is a valid JSON string
 *
 * Note: Used when certain functions use "JSON.parse"
 *
 *************************************
 */		
function uixpbform_isJSON( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		if ( str.replace( /\"\"/g, '' ).replace( /\,/g, '' ) == '[{}]' ) {
			return false;
		} else {
		
			if (/^[\],:{}\s]*$/.test( str.replace(/\\["\\\/bfnrtu]/g, '@' ).
			replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
			replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

				return true;

			}else{

				return false;

			}	
			
		}
		
	} else {
		return false;
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
			
			tinymce.PluginManager.add('uixpb_customcode', function(editor) {
				function showDialog() {
					var win = editor.windowManager.open({
						title: uix_page_builder_wp_plugin.lang_mce_sourcecode_title,
						body: {
							type: 'textbox',
							name: 'uixpb_customcode',
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
									editor.setContent(e.data.uixpb_customcode);
								});
							}

							editor.selection.setCursorLocation();
							editor.nodeChanged();

						}
					});


					// Gecko has a major performance issue with textarea
					// contents so we need to set it when all reflows are done
					win.find('#uixpb_customcode').value(editor.getContent({source_view: true}));

					//disable source code editing while in readonly mode
					if(editor.readonly){
						var id = win.find('#uixpb_customcode')[0]._id;
						$(win.find('#uixpb_customcode')[0]._elmCache[id]).prop('readonly', true);
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

				editor.addButton('uixpb_customcode', {
					icon: 'code',
					tooltip: uix_page_builder_wp_plugin.lang_mce_sourcecode_title,
					onclick: showDialog,
					classes:'uixpb_customcode'
				});

				editor.addMenuItem('uixpb_customcode', {
					icon: 'code',
					text: uix_page_builder_wp_plugin.lang_mce_sourcecode_title,
					context: 'tools',
					onclick: showDialog
				});
			});	
			
		}



	} );
    
    
} ) ( jQuery );


function uixpbform_editorInit( id ){

	if( typeof id !== typeof undefined ) {

		var vid     = id.toString().replace( '-editor', '' ),
			$sync   = jQuery( 'textarea#' + vid ),
			editorH = $sync.data( 'editor-height' );


		tinyMCE.execCommand( 'mceRemoveEditor', true, id );
		tinymce.init({
			//tinyMCE Image Displaying Correctly, but not Updating src
			relative_urls : false,
			content_css : '',
			convert_urls : false,
			media_live_embeds: true,
			//---
			language_url : (uix_page_builder_wp_plugin.site_lang != 'en_US' ) ? uix_page_builder_wp_plugin.url +  'js/tinymce/langs/'+uix_page_builder_wp_plugin.site_lang+'.js' : false,  // site absolute URL
			//---
			selector:  'textarea#' + id,
			height : editorH,
			menubar: false,
			plugins: 'textcolor image media hr uixpb_customcode colorpicker lists fullscreen',		
			toolbar: 'removeformat formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote alignleft aligncenter alignright | uixpb_link uixpb_unlink outdent indent superscript subscript hr uixpb_image uixpb_highlightcode media uixpb_customcode',
			setup:function( ed ) {



			   //Avoid formatting all contents of <textarea> 
			   $sync.addClass( 'mce-sync' );

			   ed.on( 'change', function(e) {


				   //Dynamically filter content in TinyMCE
				   var newvalue = ed.getContent()
												 .replace(/\r?\n/gm, '' )
												 .replace(/\.\.\/wp-content\/uploads\//g, uix_page_builder_wp_plugin.upload_dir_url );


				   $sync.val( newvalue ).trigger( 'change' );


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


						//image or video preview
						var videoReg = /^.*\.(avi|AVI|wmv|WMV|flv|FLV|mpg|MPG|mp4|MP4)$/gi;
						if ( videoReg.test( attachment.url ) ) {
							ed.insertContent( '<video width="400" height="300" src="'+attachment.url+'" controls></video>' );
						} else {
							ed.insertContent( '<img src="'+attachment.url+'" alt="">' );
						}   



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


				// Add Syntax Highlight Code button
				ed.addButton('uixpb_highlightcode', {
					image: 'data:image/png;base64,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',
					tooltip: uix_page_builder_wp_plugin.lang_mce_hcode_title,
					onclick: function (e) {


						ed.windowManager.open( {
							title: uix_page_builder_wp_plugin.lang_mce_hcode_title,
							body: [
								{
									type   : 'listbox',
									name   : 'lang',
									label  : uix_page_builder_wp_plugin.lang_mce_hcode_field_label,
									values : [
										{ value: 'xml', text: 'xml' },
										{ value: 'css', text: 'css' },
										{ value: 'html', text: 'html/xhtml' },
										{ value: 'xslt', text: 'xslt' },
										{ value: 'php', text: 'php' },
										{ value: 'javascript', text: 'javascript' },
										{ value: 'python', text: 'python' },
										{ value: 'applescript', text: 'applescript' },
										{ value: 'as3', text: 'as3' },
										{ value: 'plain', text: 'plain' },
										{ value: 'perl', text: 'perl' },
										{ value: 'bash', text: 'bash' },
										{ value: 'javafx', text: 'javafx' },
										{ value: 'ruby', text: 'ruby' },
										{ value: 'shell', text: 'shell' },
										{ value: 'java', text: 'java' },
										{ value: 'sass', text: 'sass' },
										{ value: 'scss', text: 'scss' },
										{ value: 'scala', text: 'scala' },
										{ value: 'sql', text: 'sql' },
										{ value: 'coldfusion', text: 'coldfusion' },
										{ value: 'vb', text: 'vb' },
										{ value: 'groovy', text: 'groovy' },
										{ value: 'erlang', text: 'erlang' },
										{ value: 'diff', text: 'diff' },
										{ value: 'patch', text: 'patch' },
										{ value: 'delphi', text: 'delphi' },
										{ value: 'pascal', text: 'pascal' },
										{ value: 'c#', text: 'c#' },
										{ value: 'cpp', text: 'c/c++' }
									],
									minWidth: 350
								},
								{
									type: 'textbox',
									name: 'content',
									multiline: true,
									minWidth: ed.getParam("code_dialog_width", 600),
									minHeight: ed.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 500)),
									spellcheck: false,
									style: 'direction: ltr; text-align: left'
								},	   

							],
							onsubmit: function( e ) {

								var _content = e.data.content.replace(/(\r)*\n/g, "<br>" );
								
								ed.insertContent( '<pre data-language="' + e.data.lang + '" class="' + e.data.lang + ' brush: ' + e.data.lang + ';">' + _content + '</pre>');
							}
						});
					}
				});                    



		   },
		  content_css: [
			uix_page_builder_wp_plugin.url + 'css/uixpbform.editor.css'
		  ]
		});	
	}


}



/*! 
 * ************************************
 * Display categories on page
 *
 * @param  {string} arr               - HTML code.
 * @param  {string} classprefix       - A string.
 * @return {string}                   - HTML code.
 *	 
 *************************************
 */	
function uixpbform_catlist( str, classprefix ) {
	
	var result = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {

		var re      = new RegExp("(.*?)\<\/div\>","gim"),
			v       = '<div class="'+classprefix+'type">',
			re      = new RegExp("" + v + "(.*?)\<\/div\>","gim"),
			arr     = [];


		str.replace( re, function(s, match) {
			
			   match = match
				   .replace(/\&lt;/g, '')
				   .replace(/\&gt;/g, '')
				   .replace(/\&amp;/g, '');
			
			   arr.push(match);
			  });	


		//Remove Duplicates from JavaScript Array
		var uniqueArr = [];
		uniqueArr = arr.filter(function(item, pos, self) {
			return self.indexOf(item) == pos;
		});


		//Output
		var newArr = uniqueArr;
		for( var j = 0; j < newArr.length; j++ ) {
			result += '<li><a href="javascript:" data-group="'+uixpbform_format_slug( newArr[j] )+'">'+newArr[j]+'</a></li>';
		}

	}
	
	return result;
	

}



/*!
 * ************************************
 * Check the value of the attribute "data-targetid" of the already cloned control, 
 * and convert it to the value matching this clone control ID.
 *
 * @param  {string} curControlID      - Current clone control ID. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1
 * @param  {string} targetObjID       - The value of the attribute "data-targetid" of the already cloned field. 
                                            Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
											           uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1
													   uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-2
									
 * @param  {number}   indexNum      - A default number.
 * @return {string}                 - A new string.
 *	
 *************************************
 */
function uixpbform_to_cloneControl_targetID( curControlID, targetObjID, indexNum ) {

	var newTargetID  = '';
	if ( typeof( curControlID ) == 'string' && curControlID.length > 0 ) {
	
		var realID    = curControlID,
			newID     = '',
			oldIndex  = '',
			reIndex   = realID.match(/-([A-Za-z0-9]){5}(-|-\d+)(?=[^(-|-\d+)]*$)/);

	
		if ( reIndex ) {
		
			oldIndex = reIndex[0];

			//Use the specified number instead of the automatic fetch
			if ( typeof indexNum !== typeof undefined && indexNum != '' && Number.isInteger( indexNum ) ) {
			    oldIndex = indexNum;
			}
			

			var oldTargetID    = targetObjID,
				re            = /-([A-Za-z0-9]){5}(-|-\d+)(?=[^(-|-\d+)]*$)/,
				reTargetIndex = oldTargetID.match( re );

			if ( reTargetIndex ) {
				newTargetID = oldTargetID.replace( re, oldIndex );
			}

		}
	}
	
	return newTargetID;
	

		
}



/*! 
 * ************************************
 * Returns the JSON final data of each page.
 *
 * @return {string} - The JSON format string.
 *	 
 *************************************
 */	
function uixpbform_page_final_data() {
	
	var result = document.getElementById( 'uix-page-builder-layoutdata' ).value;
	result = result.replace( /\&quot\;/g, '"' );

	return result;
	

}

/*!
 * ************************************
 * Clone Character Conversions: Template JSON data key converted to usable
 *
 * @param  {string} str             - A string. Like this:  uix_pb_???_??2__fieldID  or uix_pb_???_??3__fieldVal
 * @return {string}                 - A new string.  Like this:  uix_pb_???_??__fieldID  or uix_pb_???_??__fieldVal
 *	
 *************************************
 */
function uixpbform_to_cloneControlKey_ToSave( str ) {

	if ( typeof( str ) == 'string' && str.length > 0 ) {

		return str
				.replace(/\d+__fieldID(?=[^\d+__fieldID]*$)/, '__fieldID' )
				.replace(/\d+__fieldVal(?=[^\d+__fieldVal]*$)/, '__fieldVal' );	
	
	} else {
		return str;
	}
	
		
}


/*!
 * ************************************
 * Check whether the template JSON data key contains a loop index
 *
 * @param  {string} str             - A string. Like this:  uix_pb_???_??2__fieldID  or uix_pb_???_??3__fieldVal
 * @return {string}                 - A new string.  Like this:  uix_pb_???_??__fieldID  or uix_pb_???_??__fieldVal
 *	
 *************************************
 */
function uixpbform_to_cloneControlKey_notLoopIndex( str ) {

	
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		if ( 
			! /\d+__fieldID(?=[^\d+__fieldID]*$)/.test( str ) && 
			! /\d+__fieldVal(?=[^\d+__fieldVal]*$)/.test( str ) 
		) {
			return true;
		} else {
			return false;
		}
	
	}
	
		
}


/*!
 * ************************************
 * Clone Character Conversions: Control ID of JSON data value converted to usable ID
 *
 * @param  {string} str             - A string. Like this:  uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-1
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @return {string}                 - A new string.  Like this:  uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 *	
 *************************************
 */
function uixpbform_to_cloneControlValueID_ToVar( str, sectionID ) {

	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		
		var re = new RegExp( "-" + sectionID + "-\\d+" , 'g' );
	    newstr = str.replace( re, '-' + sectionID + '-' );
		
	}
	
	return newstr;
		
}


/*!
 * ************************************
 * Format all contents of <textarea> when you will save or display data
 *
 * Determine if the per module content contains "MCE Sync Data" and "Per Module HTML Data"
 *
 * @param  {object}   obj           - An object.
 * @param  {string}   val           - A default string.
 * @return {string}                 - New HTML code.
 *	 
 *************************************
 */
function uixpbform_format_textarea( obj, val ){

	var newstr = '';
	
	if( typeof obj !== typeof undefined ) {
	    
		var value        = ( typeof val !== typeof undefined && val != '' ) ? val : obj.val();

		if ( value != '' ) {
			
			//Exclude data that the HTML editor synchronizes
			if ( ! obj.hasClass( 'mce-sync' ) ) {

				newstr = uixpbform_to_controlSaveData_ToHTML( value );

			}	
		}

	}

	return newstr;
}



/*! 
 * ************************************
 * Convert the HTML code of JSON data (saved) to renderable HTML code
 *
 * @param  {string}   str           - A string that contains HTML code.
 * @return {string}                 - New renderable HTML code.
 *	 
 *************************************
 */	
function uixpbform_to_controlSaveData_ToHTML( str ) {

	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		newstr  = uixpbform_format_text_decode( str )
					.replace(/{rowcqt:}/g, '"' )
					.replace(/{rowcapo:}/g, "'" );
		

	}
	
	return newstr;
		

}


/*! 
 * ************************************
 * Format the array to JSON in order to variables of templates
 *
 * @param  {array}   arr            - An array containing key names and key values
 * @param  {boolean} json           - If true, returns an array of strings
 * @param  {boolean} renderFrontend - If true, use the front-end template processing method
 * @return {string}                 - The JSON format string.
 *	 
 *************************************
 */	
function uixpbform_arr_to_tempjson( arr, json, renderFrontend ) {
	
	var jsondata      = '',
		jsondata_arr  = [],
		old_cloneKey  = '',
		new_cloneKey  = '',
		old_clone_con = '',
		new_clone_con = '';
	
	if( typeof arr !== typeof undefined ) {
	
		
		jsondata = JSON.stringify( arr )
									//remove the first "[" and the last "]"
									.replace(/^\[?|\]?$/g, '' );

		
		//Convert content commas to avoid cloning errors
		var pattern_con = /:".*?"/g;
		if ( pattern_con.test( jsondata ) ) {
			jsondata = jsondata.replace( pattern_con, function( m ){ return m.replace(/,/g, '#comma#' ); } );	
		}
		
	
		//Extract the key values of the clone form
		var pattern_con2 = /:\[(.*?)\]/g;
		if ( pattern_con2.test( jsondata ) ) {
			jsondata = jsondata.replace( pattern_con2, function( m ){ return m.replace(/},{/g, '#boundary#' ); } );	
		}
		
		
		//Use the front-end template processing method
		if ( typeof renderFrontend !== typeof undefined && renderFrontend ) {
			jsondata = jsondata.replace(/_triggerclonelist__fieldID/g, '_triggerclonelist' )
			                   .replace(/__fieldVal/g, '' );	
		}
		
		
		
		jsondata     = jsondata
							.replace(/},{/g, ',' )
							.replace(/\#boundary\#/g, '},{' )
			                //remove the first "{" and the last "}"
							.replace(/^\{?|\}?$/g, '' );
	
		

		if ( typeof json !== typeof undefined && json ) {
			
			var _jsondata = jsondata.split( ',' );
			for ( var i = 0; i < _jsondata.length; i++ ) {
				jsondata_arr.push( _jsondata[i].replace(/\#comma\#/g, ',' ) );

			}
			
			jsondata = jsondata_arr;
	
		} else {
			jsondata = '[{' + jsondata + '}]';	
			jsondata     = jsondata.replace(/\#comma\#/g, ',' );
		}
		

	}

	return jsondata;


}


/*! 
 * ************************************
 * Convert a valid variable ID for controls
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_???_??__fieldID  or uix_pb_???_??__fieldVal
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlID_ToVar( str, tempID, sectionID, colID ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var field_name = str.replace( '__fieldID', '' ).replace( '__fieldVal', '' );
		
		newstr  = tempID + '-' + colID + '-' + field_name + '-' + sectionID + '-';
		newstr  = newstr
			            .replace( '---', '----' )
						.replace(/\[/g, '' )
						.replace(/\]/g, '' )
		

	}
	
	return newstr;
		
}




/*! 
 * ************************************
 * Obtain the clone of the object to determine its existence
 *
 *
 * @param  {string} str             - The final JSON data
 * @return {boolean}                - Returns a Boolean value to determine if clone data exists.
 *	
 *	 
 *************************************
 */	
function uixpbform_clonedata_exists( str ) {
	
	var obj = '';
	if ( uixpbform_isJSON( str ) ) {
		obj = JSON.stringify( str );
	}
	
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		obj = str;
	}
	
	if ( obj.indexOf( '_triggerclonelist' ) >= 0 ) {
		return true;
	} else {
		return false;
	}
	
		
}


/*! 
 * ************************************
 * Convert the JSON data (saved) ID to a control name
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_module_???|[col-item-1__1---ABCDE][uix_pb_???_??][ABCDE]
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: uix_pb_???_??
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlSaveID_ToName( str, tempID, sectionID, colID ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
	    newstr = str
				 .replace( tempID + '|', '' )
				 .replace( '[' + sectionID + ']', '' )
				 .replace( '[' + colID + ']', '' )
				 .replace( '[', '' )
				 .replace( ']', '' );
	

	}
	
	return newstr;
		
}



/*! 
 * ************************************
 * Convert the valid variable ID to a control name
 *
 *
 * @param  {string} str             - A string. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 * @return {string}                 - A new string. Like this: uix_pb_???_??
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlVarID_ToName( str ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		var reName = str.match(/.*----([A-Za-z0-9]){5}-(.*)-([A-Za-z0-9]){5}-.*/);
		if ( reName ) {
			newstr = reName[2];

		}
	

	}
	
	return newstr;
		
}


/*! 
 * ************************************
 * Convert a control name to a valid variable ID for controls
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_???_??
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 *	
 *
 *************************************
 */	
function uixpbform_to_controlName_ToVar( str, tempID, sectionID, colID ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var _colID = colID.replace( '---', '----' );
		newstr = tempID + '-' + _colID + '-' + str + '-' + sectionID + '-';
	}
	
	return newstr;
		
}


/*! 
 * ************************************
 * Convert the JSON data (saved) ID to a valid variable ID for controls
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_module_???|[col-item-1__1---ABCDE][uix_pb_???_??][ABCDE]
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @return {string}                 - A new string. Like this: uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlSaveID_ToVar( str, sectionID ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		var re = new RegExp( sectionID , 'g' );
	    newstr = str
			       .replace( re, '|' + sectionID + '|' )
			       .replace(/\|/g, '-')
				   .replace(/\[/g, '' )
			       .replace(/\]/g, '' );
		

	}
	
	return newstr;
		
}


/*! 
 * ************************************
 * Convert a control ID to a new ID for JSON data (saved)
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_???_?? 
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: uix_pb_module_???|[col-item-1__1---ABCDE][uix_pb_???_??][ABCDE]
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlName_fieldSaveID( str, tempID, sectionID, colID ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
	
		newstr = tempID + '|[' + colID + '][' + str + '][' + sectionID + ']';
	}
	
	return newstr;
		
}


/*! 
 * ************************************
 * Convert the JSON data (saved) ID to be saved
 *
 *
 * @param  {string} str             - A string. Like this:  uix_pb_module_???-col-item-1__1----ABCDE-uix_pb_???_??-ABCDE-
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: uix_pb_module_???|[col-item-1__1---ABCDE][uix_pb_???_??][ABCDE]
 *	
 *	 
 *************************************
 */	
function uixpbform_to_controlID_ToSave( str, tempID, sectionID, colID ) {
	
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var _colID = colID.replace( '---', '----' );

		return str
				 .replace( tempID + '-' + _colID + '-' , tempID + '|[' + colID + '][' )
				 .replace( '-'+sectionID+'-', ']['+sectionID+']' );

	} else {
		return str;
	}
		
}


/*! 
 * ************************************
 * Check if the control ID is valid if it is not valid automatically
 *
 * @param  {string}  str          - A string. Like this: uix_pb_???_??
 * @param  {boolean} reverse      - If true, the converted English letter is used to restore the original form identifier.
 * @return {string}               - A new string.
 * 
 *************************************
 */	
function uixpbform_filter_control_id( str, reverse ) {
	
	var newstr = str;
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		if ( str.indexOf( '_listitem' ) >= 0 ) {
			newstr = newstr.replace(/0/g, 'Ⅰ' )
			.replace(/1/g, 'Ⅱ' )
			.replace(/2/g, 'Ⅲ' )
			.replace(/3/g, 'Ⅳ' )
			.replace(/4/g, 'Ⅴ' )
			.replace(/5/g, 'Ⅵ' )
			.replace(/6/g, 'Ⅶ' )
			.replace(/7/g, 'Ⅷ' )
			.replace(/8/g, 'Ⅸ' )
			.replace(/9/g, 'Ⅹ' );
			
			
			if ( typeof reverse !== typeof undefined && reverse ) {
				
				newstr = newstr.replace(/Ⅰ/g, '0' )
				.replace(/Ⅱ/g, '1' )
				.replace(/Ⅲ/g, '2' )
				.replace(/Ⅳ/g, '3' )
				.replace(/Ⅴ/g, '4' )
				.replace(/Ⅵ/g, '5' )
				.replace(/Ⅶ/g, '6' )
				.replace(/Ⅷ/g, '7' )
				.replace(/Ⅸ/g, '8' )
				.replace(/Ⅹ/g, '9' );	
				
			}
			
			
			
		}

	
	}
	return newstr;
		
}


/*! 
 * ************************************
 * Returns the JSON result value of the module template for front-end rendering
 * Convert the english letter to the original form identifier.
 *
 * @param  {string}  str          - A JSON string.
 * @return {string}               - A new JSON string.
 * 
 *************************************
 */	
function uixpbform_module_form_JsonResult_frontend( str ) {
	
	var newstr = str;
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var pattern_id = /".*?"\:/g;
		if ( pattern_id.test( newstr ) ) {
			newstr = newstr.replace( pattern_id, function( m ){ return uixpbform_filter_control_id( m, true ); } );	
		}
	
	}
	return newstr;
		
}


/*! 
 * ************************************
 * Special character filter to avoid conflicts with JSON template data
 *
 * @param  {string} str                  - A string.
 * @return {string}                      - A new string.
 *	 
 *************************************
 */	
function uixpbform_filter_control_val( str ) {

	var newstr = str;
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		newstr = newstr
					.replace(/\$/g, '&#36;' )
					.replace(/\[/g, '&#91;')
					.replace(/\]/g, '&#93;')
					.replace(/{rowcqt:}/g, '&#34;' )
					.replace(/{rowcapo:}/g, '&#39;' );
		
		
	
	}
	return newstr;
	
}



/*! 
 * ************************************
 * Converts the column's mixed ID to a numeric ID
 *
 *
 * @param  {string} str              - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @return {string}                 - A new string. Like this: 1__1
 *	
 *	 
 *************************************
 */	
function uixpbform_to_col_numberID( str ) {
	
	var newstr = '';
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		var arr = str.split( '---' );
		
		newstr = arr[0].replace( 'col-item-', '' );
		
	
	}
	return newstr;
		
}




/*! 
 * ************************************
 * Returns the keys of the module template.
 *
 * @param  {string} str             - HTML code.
 * @return {array}                  - An array of strings.
 *	 
 *************************************
 */	
function uixpbform_module_form_keys( str ) {
	
	var result = [];
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		
		var re      = new RegExp("\\${(.*?)}","gim"),
			arr     = [],
			result  = [];


		str.replace( re, function(s, match) {
			   arr.push(match);
			  });	



		//Remove Duplicates from JavaScript Array
		var uniqueArr = [];
		uniqueArr = arr.filter(function(item, pos, self) {
			return self.indexOf(item) == pos;
		});

		//Output
		var newArr = uniqueArr;
		for( var j = 0; j < newArr.length; j++ ) {
			result.push( uixpbform_filter_control_id( newArr[j] ) );
		}


	}

	
	
	return result;
	
	
}




/*! 
 * ************************************
 * Returns the total number of clone group index.
 *
 * @param  {array} beforeArr             - Unformatted clone group.
 * @param  {number} groupTotal           - The total number of each clone group
 * @param  {number} beforeGroupTotal     - The total number of default clone controls (excluding clone groups)
 * @return {number}                      - A number.
 *	 
 *************************************
 */	
function uixpbform_cloned_groupIndexTotal( beforeArr, groupTotal, beforeGroupTotal ) {
	
	var result = 0;

	if( Object.prototype.toString.call( beforeArr ) === '[object Array]' ) {

		for( var i = 0; i < beforeArr.length; i++ ) {

			if ( 
				(i+1) % beforeGroupTotal == 0 && 
				(i+1) < groupTotal
			) {
				result++;
			}	
		}	
	}

	
	return result;
	
	
}



/*! 
 * ************************************
 * Returns the group string that has been cloned
 *
 * @param  {string} sectionID            - The section ID. (Obtained via gridster widget ID.)
 * @param  {array} beforeArr             - Unformatted clone group.
 * @param  {array} newControlsArr        - New controls.
 * @param  {number} groupTotal           - The total number of each clone group
 * @param  {number} beforeGroupTotal     - The total number of default clone controls (excluding clone groups)
 * @param  {number} newControlsTotal     - The number of new controls (just refer to the visible form)
 * @return {array}                       - A new object.
 *	 
 *************************************
 */	
function uixpbform_cloned_groupStr( sectionID, newControlsArr, beforeArr, groupTotal, beforeGroupTotal, newControlsTotal ) {
	
	var result                = '',
		cloneTempListGroupRe  = new RegExp( "-" + sectionID + "-\\d+" , 'g' );

	if( Object.prototype.toString.call( beforeArr ) === '[object Array]' ) {
		
		//Format the array to JSON in order to variables of templates
		beforeArr = uixpbform_arr_to_tempjson( beforeArr, true, false );
		
		// Returns the total number of clone group index.
		var groupIndexTotal = uixpbform_cloned_groupIndexTotal( beforeArr, groupTotal, beforeGroupTotal );

		
		for( var i = 0; i < beforeArr.length; i++ ) {


			var v    = '',
				vArr = [];
			

			//Update the index value of the control (not for JSON)
			v    = beforeArr[i].replace( cloneTempListGroupRe, '-' + sectionID + '-' + groupIndexTotal );

			//Convert the english letter to the original form identifier.
			vArr = v.split( ':' );
			v    = v.replace( vArr[0], uixpbform_filter_control_id( vArr[0], true ) );



			if ( 
				(i+1) % beforeGroupTotal == 0 && 
				(i+1) < groupTotal
			) {

				//Loop the new controls
				for ( var g = 0; g < newControlsTotal; g++ ) {
					var newcontrol_o   = newControlsArr[g],
						newcontrol     = null,
						newcontrol_id  = '',
						newcontrol_val = '';	


					if ( typeof newcontrol_o !== typeof undefined && newcontrol_o != ''  ) {

						newcontrol     = JSON.stringify( newcontrol_o ).replace(/^\{?|\}?$/g, '' ).split( ',' ),
						newcontrol_id  = newcontrol[1].replace(/-([A-Za-z0-9]){5}(-|-\d+)(?=[^(-|-\d+)]*$)/g, '-' + sectionID + '-' + groupIndexTotal );

						newcontrol_val = newcontrol[0];


						if ( newcontrol_val != '' &&
							 newcontrol_id != ''
						) {
							result += newcontrol_val + ',';
							result += newcontrol_id + ',';
						}	

					}


				}//end for	

				result += v + '},{';
				groupIndexTotal--;
			} else {
				result += v + ',';
			}


		}
		
		
		result = result.replace(/,\s*$/, '' );
		result = JSON.parse( '[{' + result + '}]' );
		
		//Exclude default raw form data
		result.pop();
		
	}

	
	return result;
	
	
}


/*! 
 * ************************************
 * Returns the group string of the front-end rendering template that has been cloned
 *
 * @param  {array} beforeArr             - Unformatted clone group.
 * @param  {number} groupTotal           - The total number of each clone group
 * @param  {number} beforeGroupTotal     - The total number of default clone controls (excluding clone groups)
 * @return {array}                       - A new object.
 *	 
 *************************************
 */	
function uixpbform_cloned_groupStr_frontend( beforeArr, groupTotal, beforeGroupTotal ) {
	
	var result = '';

	if( Object.prototype.toString.call( beforeArr ) === '[object Array]' ) {
		
		
		//Format the array to JSON in order to variables of templates
		beforeArr = uixpbform_arr_to_tempjson( beforeArr, true, false );
		
		for( var i = 0; i < beforeArr.length; i++ ) {

			var per_data = beforeArr[i];

			if ( 
				(i+1) % beforeGroupTotal == 0 && 
				(i+1) < groupTotal
			) {
				result += per_data + '},{'
			} else {
				result += per_data + ',';
			}	


		}
		
		
		result = result.replace(/,\s*$/, '' );
		result = JSON.parse( '[{' + result + '}]' );
		
	}

	return result;
	
	
}





/*! 
 * ************************************
 * Returns all form ID values for a module
 *
 * @param  {string} tempID          - Form of module ID.
 * @param  {string} sectionID       - The section ID. (Obtained via gridster widget ID.)
 * @param  {string} colID           - The column ID of each module. Like this: col-item-1__1---ABCDE
 * @param  {boolean} returnTempID   - If true, only return the ID of the control of the front-end rendering template
 * @return {string}                 - The JSON format string.
 *	  
 *************************************
 */	
/*
 Like this:
 
[
    {
        "colID": "col-item-1__1---3Zq2y", 
        "sectionID": "3Zq2y", 
        "formID": "uix_pb_module_tabs", 
        "uix_pb_tabs_style__fieldVal": "horizontal", 
        "uix_pb_tabs_style__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_style-3Zq2y-", 		
        "uix_pb_tabs_listitem_title__fieldVal": "Tab Title", 
        "uix_pb_tabs_listitem_title__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_title-3Zq2y-", 
        "uix_pb_tabs_listitem_con__fieldVal": "This is content of the tab.", 
        "uix_pb_tabs_listitem_con__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_con-3Zq2y-",
		"uix_pb_tabs_triggerclonelist__fieldID": [
				{ 
					"uix_pb_tabs_listitem_title__fieldVal": "Tab Title3" ,
					"uix_pb_tabs_listitem_title__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_title-3Zq2y-3",
					"uix_pb_tabs_listitem_con__fieldVal": "This is content of the tab.",
					"uix_pb_tabs_listitem_con__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_con-3Zq2y-3",
				},
				{ 
					"uix_pb_tabs_listitem_title__fieldVal": "Tab Title2",
					"uix_pb_tabs_listitem_title__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_title-3Zq2y-2",
					"uix_pb_tabs_listitem_con__fieldVal": "This is content of the tab.",
					"uix_pb_tabs_listitem_con__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_tabs_listitem_con-3Zq2y-2" 
			    },
			
			
		],
		
        "uix_pb_module_tabs_temp__fieldVal": "...", 
        "uix_pb_module_tabs_temp__fieldID": "uix_pb_module_tabs-col-item-1__1----3Zq2y-uix_pb_module_tabs_temp-3Zq2y-"
    }
]

*/
function uixpbform_module_form_ids( tempID, sectionID, colID, returnTempID ) {
	
	var result = [];
	if( typeof tempID !== typeof undefined ) {
		//Push "colID", "sectionID" and "formID"  (Used to clone form templates)
		result.push( { colID: colID } );
		result.push( { sectionID: sectionID } );	
		result.push( { formID: tempID } );



		var data                        = JSON.parse( uixpbform_page_final_data() ),

			//Returns the keys of the module template.
			keys                        = uixpbform_module_form_keys( jQuery( '#module_tmpl__' + tempID ).html() ),
			useKeys                     = false,

			//Clone form IDs and elements
			cloneTempListKey            = [],
			cloneBeforeTempListIndex    = [],
			cloneBeforeTempListElements = [],
			cloneTempListElements       = [],
			cloneTempListElementsNew    = [],
			cloneTempListMax            = jQuery( jQuery( '#module_tmpl__' + tempID ).html() ).find( '[data-clone-max]' ).attr( 'data-clone-max' ),

			//The form ID of the front-end code after rendering module template
			renderTempID                = '',
			renderTempElement1          = '',
			renderTempElement2          = '',

			//All form control IDs
			all_field_ids              = jQuery( '#uixpbform-form-all-field-ids-' + tempID ).attr( 'data-field-ids' ),
			all_clonefield_ids         = '';



		if ( typeof all_field_ids !== typeof undefined ) {

			var new_all_field_ids_arr = all_field_ids.split( ',' );

			for ( var i = 0; i < new_all_field_ids_arr.length; i++ ) {

				if ( new_all_field_ids_arr[i]  != '' && new_all_field_ids_arr[i].indexOf( '_triggerclonelist' ) < 0 ) {
					var _new_field_name    = new_all_field_ids_arr[i],
						_new_key_id        = uixpbform_filter_control_id( _new_field_name ) + '__fieldID';


					all_clonefield_ids += _new_key_id + ',';



				}//end if

			}//end for

		}


		for ( var eachdata = 0; eachdata < data.length; eachdata++ ) {

			if( typeof data[eachdata].row !== typeof undefined ) {

				var id           = data[eachdata].row + '__' + data[eachdata].col,
					sid          = data[eachdata].secindex,
					con          = data[eachdata].content.replace(/{rqt:}/g, '"');

				//Already existing widget, but did not add any modules and grid systems
				if ( con != 'undefined' ) {

					if ( uixpbform_isJSON( con ) ) {

						//--------Use the saved data values
						var conJSON      = JSON.parse( con ),
							formcon      = JSON.parse( conJSON[3][1].replace(/{rowqt:}/g, '"') ),
							oldFormid    = conJSON[0][1].replace(/{rowqt:}/g, '"'),
							oldSid       = conJSON[1][1].replace(/{rowqt:}/g, '"');


						/*! 
						 * ************************************
						 * Use the default value of the form controls (Completely new widget)
						 *	
						 *************************************
						 */
						for( var i = 0; i < formcon.length; i++ ) {

							var perColControls = formcon[i];


							//When the array length is less than 3, the widget has not been added yet
							if ( perColControls.length < 3 ) {


								if( Object.prototype.toString.call( keys ) === '[object Array]' ) {



									for( var i = 0; i < keys.length; i++ ) {

										var _key_id_vid    = keys[i],
											_field_name    = '',
											_field_full_id = '',
											_field_value   = '';



										//Exclude the original form ID of the clone
										if ( _key_id_vid.indexOf( '__index__' ) < 0 && _key_id_vid.indexOf( '_triggerclonelist' ) < 0 ) {

											if ( 
												_key_id_vid.indexOf( '__fieldID' ) >= 0 && 
												_key_id_vid.indexOf( '_temp' ) < 0
											   ) {
												_field_full_id = uixpbform_to_controlID_ToVar( _key_id_vid, tempID, sectionID, colID );
												result.push( { [_key_id_vid]: _field_full_id }  );
											}

											if ( 
												_key_id_vid.indexOf( '__fieldVal' ) >= 0 && 
												_key_id_vid.indexOf( '_temp' ) < 0
											) {
												result.push( { [_key_id_vid]: "" }  );
											}	


											if ( 
												_key_id_vid.indexOf( '__fieldID' ) >= 0 && 
												_key_id_vid.indexOf( '_temp' ) >= 0
											) {
												_field_full_id      = uixpbform_to_controlID_ToVar( _key_id_vid, tempID, sectionID, colID );
												renderTempElement1  = { [_key_id_vid]: _field_full_id };
												renderTempID        = _field_full_id;
											}

											if ( 
												_key_id_vid.indexOf( '__fieldVal' ) >= 0 && 
												_key_id_vid.indexOf( '_temp' ) >= 0
											) {
												renderTempElement2   = { [_key_id_vid]: "" };
											}	


										}//end if



									}	

								}		


							}

						}


						//Retrieve the form ID for each module
						if ( oldSid == sectionID ) {



							//<Loop each column>
							for( var i = 0; i < formcon.length; i++ ) {

								var perColControls = formcon[i],
									oldColid     = 'col-item-' + formcon[i][0][1] + '---' + sid;



								if ( oldColid == colID ) {

									//When the array length is less than 3, the widget has not been added yet
									if ( perColControls.length >= 3 ) {


										//--------All form control IDs (Use the new form controls)
										//<Loop each control>
										for( var j = 1; j < perColControls.length; j++ ) {

											var _field_name    = uixpbform_to_controlSaveID_ToName( perColControls[j][0], tempID, sectionID, colID ),
												_key_id        = uixpbform_filter_control_id( _field_name ) + '__fieldID';


											if ( all_clonefield_ids != '' ) {

												if ( all_clonefield_ids.indexOf( _key_id ) >= 0 ) {
													all_clonefield_ids = all_clonefield_ids.replace( _key_id + ',', '' );
												}

											}


											//Extract the cloned index of the existing data (saved)
											var reIndex = perColControls[j][0].match(/\[([A-Za-z0-9]){5}\]\d+(?=[^\d+]*$)/);

											if ( reIndex ) {
												cloneBeforeTempListIndex.push( reIndex[0].replace(/\[([A-Za-z0-9]){5}\]/g, '' ) );	

											}


										}//</Loop each control>	

										cloneBeforeTempListIndex = cloneBeforeTempListIndex.filter(function(item, pos, self) {
											return self.indexOf(item) == pos;
										});

										//Add new control IDs
										if ( all_clonefield_ids != '' ) {

											var all_clonefield_ids_arr = all_clonefield_ids.split( ',' );


											for ( var k = 0; k < all_clonefield_ids_arr.length; k++ ) {

												if ( all_clonefield_ids_arr[k] != '' ) { 

													var _oid                    = uixpbform_filter_control_id( all_clonefield_ids_arr[k] ),
														_new_clonefield_name    = _oid.replace( '__fieldID', '' ),
														_new_clonefield_save_id = uixpbform_to_controlName_fieldSaveID( _new_clonefield_name, tempID, sectionID, colID ),
														_new_clonefield_full_id = uixpbform_to_controlSaveID_ToVar( _new_clonefield_save_id, sectionID ),
														_new_clonefield_key_id  = _new_clonefield_name + '__fieldID',
														_new_clonefield_key_vid = _new_clonefield_name + '__fieldVal';




													//step 1 (Loop clone controls with the serial number)
													for ( var m = 0; m < cloneBeforeTempListIndex.length; m++ ) {

														if ( _new_clonefield_save_id.indexOf( '_listitem' ) < 0 ) {
															perColControls.push( [ _new_clonefield_save_id + cloneBeforeTempListIndex[m], '' ] );
														} else {
															cloneTempListElementsNew.push(  { [_new_clonefield_key_vid]: '', [_new_clonefield_key_id]: _new_clonefield_full_id + cloneBeforeTempListIndex[m] } );

														}

													}

													//step 2 (Loop clone controls without the serial number)
													if ( _new_clonefield_save_id.indexOf( '_listitem' ) < 0 ) {
														perColControls.push( [ _new_clonefield_save_id, '' ] );
													} else {

														cloneTempListElementsNew.push(  { [_new_clonefield_key_vid]: '', [_new_clonefield_key_id]: _new_clonefield_full_id } );

														//step 3 (Loop clone controls by default)
														result.push(  { [_new_clonefield_key_vid]: '', [_new_clonefield_key_id]: _new_clonefield_full_id } );

													}




												}//end if

											}//end for


										}//<end all_clonefield_ids>


										//--------Use the saved data values

										//<Loop each control>
										for( var j = 1; j < perColControls.length; j++ ) {

											var _field_name    = uixpbform_to_controlSaveID_ToName( perColControls[j][0], tempID, sectionID, colID ),
												_key_id        = _field_name + '__fieldID',
												_key_vid       = _field_name + '__fieldVal',
												_field_full_id = uixpbform_to_controlSaveID_ToVar( perColControls[j][0], sectionID ),
												_field_value   = uixpbform_filter_control_val( perColControls[j][1] );



											//Exclude the original form ID of the clone
											if ( _field_name.indexOf( '__index__' ) < 0 ) {

												if ( 
													_field_name.indexOf( '_temp' ) < 0 && 
													_field_name.indexOf( '_listitem' ) < 0
												) {
													result.push( { [_key_vid]: _field_value, [_key_id]: _field_full_id }  );
												}

												if ( 
													_field_name.indexOf( '_temp' ) >= 0 && 
													_field_name.indexOf( '_listitem' ) < 0
												) {

													renderTempElement1  = { [_key_vid]: _field_value, [_key_id]: _field_full_id };
													renderTempID        = _field_full_id;
												}


												// Make the cloned form into JSON format
												if ( _field_name.indexOf( '_listitem' ) >= 0 ) {


													var _num          = j + 1,
														_new_key_vid  = uixpbform_to_cloneControlKey_ToSave( _key_vid ),
														_new_key_id   = uixpbform_to_cloneControlKey_ToSave( _key_id ),
														_new_key_id_v = uixpbform_to_cloneControlValueID_ToVar( _field_full_id, sectionID ) + _num;



													cloneTempListElements.push( { [_new_key_vid]: _field_value, [_new_key_id]: _new_key_id_v } );


													if ( uixpbform_to_cloneControlKey_notLoopIndex( _key_vid ) ) {

														result.push( { [_key_vid]: _field_value, [_key_id]: _field_full_id }  );

														cloneBeforeTempListElements.push( { [_key_vid]: _field_value, [_key_id]: _field_full_id }  );

													}

												}



											}//<end _field_name.indexOf( '__index__' )>



										}//</Loop each control>

									}//<end perColControls.length>



								}

							}//</Loop each column>

						}



					} else {//<else uixpbform_isJSON( con ) >

						//--------Use the default value of the form controls (Completely new widget)
						useKeys = true;

					}//<end uixpbform_isJSON( con ) >

				}


				/*! 
				 * ************************************
				 * Use the default value of the form controls (Completely new widget)
				 *	
				 *************************************
				 */
				if( useKeys && Object.prototype.toString.call( keys ) === '[object Array]' ) {


					for( var i = 0; i < keys.length; i++ ) {

						var _key_id_vid    = keys[i],
							_field_name    = '',
							_field_full_id = '',
							_field_value   = '';



						//Exclude the original form ID of the clone
						if ( _key_id_vid.indexOf( '__index__' ) < 0 && _key_id_vid.indexOf( '_triggerclonelist' ) < 0 ) {

							if ( 
								_key_id_vid.indexOf( '__fieldID' ) >= 0 && 
								_key_id_vid.indexOf( '_temp' ) < 0
							   ) {
								_field_full_id = uixpbform_to_controlID_ToVar( _key_id_vid, tempID, sectionID, colID );
								result.push( { [_key_id_vid]: _field_full_id }  );
							}

							if ( 
								_key_id_vid.indexOf( '__fieldVal' ) >= 0 && 
								_key_id_vid.indexOf( '_temp' ) < 0
							) {
								result.push( { [_key_id_vid]: "" }  );
							}	


							if ( 
								_key_id_vid.indexOf( '__fieldID' ) >= 0 && 
								_key_id_vid.indexOf( '_temp' ) >= 0
							) {
								_field_full_id      = uixpbform_to_controlID_ToVar( _key_id_vid, tempID, sectionID, colID );
								renderTempElement1  = { [_key_id_vid]: _field_full_id };
								renderTempID        = _field_full_id;
							}

							if ( 
								_key_id_vid.indexOf( '__fieldVal' ) >= 0 && 
								_key_id_vid.indexOf( '_temp' ) >= 0
							) {
								renderTempElement2   = { [_key_id_vid]: "" };
							}	


						}//end if



					}	

				}

				/*! 
				 * ************************************
				 * Push clone controls to result
				 *
				 * @param  {array}  keys                            - Returns the keys of the module template.
				 * @param  {array} cloneTempListKey                 -  The key of clone controls array
				 * @param  {array}  cloneBeforeTempListElements     - The object of clone loops before
				 * @param  {array}  cloneTempListElements           - The object of clone loops
				 * @param  {number} cloneTempListMax                - The maximum value of the clone
				 *
				 *************************************
				 */	
				if ( typeof cloneTempListMax !== typeof undefined && cloneTempListMax > 0 ) {

					// Make a key of clone object
					if( Object.prototype.toString.call( keys ) === '[object Array]' ) {

						for( var i = 0; i < keys.length; i++ ) {
							if ( keys[i].indexOf( '_triggerclonelist' ) >= 0 ) {
								cloneTempListKey.push( keys[i] );
							}
						}

					}




					//The total number of each clone group
					var cloneBeforeTempListTotal    = 0, //Merged with IDs and values
						cloneTempListTotal          = 0, //Merged with IDs and values
						cloneTempListJsonArr        = [],
						cloneTempListJson           = '',
						cloneTempListGroupIndex     = 0,
						cloneTempListNewControlArr    = [],
						//The number of new controls (just refer to the visible form)
						cloneTempListNewControlTotal  = cloneTempListElementsNew.length;


					if ( cloneTempListElementsNew.length > 0 ) {
						cloneTempListNewControlArr = cloneTempListElementsNew;
					}


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
						cloneTempListGroupIndex_one_col     = 0,
						cloneTempListGroupIndex_two_col     = 0,
						cloneTempListGroupIndex_three_col   = 0,
						cloneTempListGroupIndex_four_col    = 0,
						cloneTempListJson_one               = '',
						cloneTempListJson_two               = '',
						cloneTempListJson_three             = '',
						cloneTempListJson_four              = '',
						cloneTempListJsonArr_one            = [],
						cloneTempListJsonArr_two            = [],
						cloneTempListJsonArr_three          = [],
						cloneTempListJsonArr_four           = [];



					for( var k = 0; k < cloneBeforeTempListElements.length; k++ ) {

						var _v = JSON.stringify( cloneBeforeTempListElements[k] );

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


					for( var k = 0; k < cloneTempListElements.length; k++ ) {

						var _el = cloneTempListElements[k],
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


					cloneBeforeTempListTotal            = cloneBeforeTempListTotal * 2;
					cloneBeforeTempListTotal_one_col    = cloneBeforeTempListTotal_one_col * 2;
					cloneBeforeTempListTotal_two_col    = cloneBeforeTempListTotal_two_col * 2;
					cloneBeforeTempListTotal_three_col  = cloneBeforeTempListTotal_three_col * 2;
					cloneBeforeTempListTotal_four_col   = cloneBeforeTempListTotal_four_col * 2;

					cloneTempListTotal                  = cloneTempListTotal * 2;
					cloneTempListTotal_one_col          = cloneTempListTotal_one_col * 2;
					cloneTempListTotal_two_col          = cloneTempListTotal_two_col * 2;
					cloneTempListTotal_three_col        = cloneTempListTotal_three_col * 2;
					cloneTempListTotal_four_col         = cloneTempListTotal_four_col * 2;



					// Returns the group string that has been cloned
					cloneTempListJson     = uixpbform_cloned_groupStr( sectionID, cloneTempListNewControlArr, cloneTempListJsonArr, cloneTempListTotal, cloneBeforeTempListTotal, cloneTempListNewControlTotal );

					cloneTempListJson_one = uixpbform_cloned_groupStr( sectionID, cloneTempListNewControlArr, cloneTempListJsonArr_one, cloneTempListTotal_one_col, cloneBeforeTempListTotal_one_col, cloneTempListNewControlTotal );

					cloneTempListJson_two = uixpbform_cloned_groupStr( sectionID, cloneTempListNewControlArr, cloneTempListJsonArr_two, cloneTempListTotal_two_col, cloneBeforeTempListTotal_two_col, cloneTempListNewControlTotal );

					cloneTempListJson_three = uixpbform_cloned_groupStr( sectionID, cloneTempListNewControlArr, cloneTempListJsonArr_three, cloneTempListTotal_three_col, cloneBeforeTempListTotal_three_col, cloneTempListNewControlTotal );

					cloneTempListJson_four = uixpbform_cloned_groupStr( sectionID, cloneTempListNewControlArr, cloneTempListJsonArr_four, cloneTempListTotal_four_col, cloneBeforeTempListTotal_four_col, cloneTempListNewControlTotal );


					//Add the looped data to the trigger
					if ( cloneTempListKey.length > 0 ) {

						for ( var p = 0; p < cloneTempListKey.length; p++ ) {

							var _key = cloneTempListKey[p];
							if ( JSON.stringify( result ).indexOf( _key ) < 0 ) {


								if ( _key.indexOf( '_one_' ) >= 0 && cloneTempListJson_one.length > 0 ) result.push( { [_key]: cloneTempListJson_one } );
								if ( _key.indexOf( '_two_' ) >= 0 && cloneTempListJson_two.length > 0 ) result.push( { [_key]: cloneTempListJson_two } );
								if ( _key.indexOf( '_three_' ) >= 0 && cloneTempListJson_three.length > 0 ) result.push( { [_key]: cloneTempListJson_three } );
								if ( _key.indexOf( '_four_' ) >= 0 && cloneTempListJson_four.length > 0 ) result.push( { [_key]: cloneTempListJson_four } );

								if (
									_key.indexOf( '_one_' ) < 0 &&
									_key.indexOf( '_two_' ) < 0 &&
									_key.indexOf( '_three_' ) < 0 &&
									_key.indexOf( '_four_' ) < 0 &&
									cloneTempListJson.length > 0
								) {
									result.push( { [_key]: cloneTempListJson } );
								}




							}		

						}//end for(array: cloneTempListKey)

					}//end if


				}


			}

		}//end for(array: data)



		/*! 
		 * ************************************
		 * Push "renderTempElement1" and "renderTempElement2"  to result in the last
		 *	
		 *************************************
		 */
		if ( renderTempElement1 != '' ) result.push( renderTempElement1  );	
		if ( renderTempElement2 != '' ) result.push( renderTempElement2  );	




		/*! 
		 * ************************************
		 * Format the JSON data format for the template
		 *	
		 *************************************
		 */
		result = uixpbform_arr_to_tempjson( result, false, false );



		/*! 
		 * ************************************
		 * Convert the english letter to the original form identifier.
		 *	
		 *************************************
		 */		
		var _result     = result.replace(/^\{?|\}?$/g, '' ),
			_result_arr = _result.split( ',' );


		for( var i = 0; i < _result_arr.length; i++ ) {
			var _re_key_id_arr  = _result_arr[i].split( ':' ),
				_re_old_key_id  = _re_key_id_arr[0].replace(/"/g, '' ),
				_re_new_key_id  = uixpbform_filter_control_id( _re_old_key_id, true );



			if ( _re_old_key_id.indexOf( '_listitem' ) >= 0 ) {
				result = result.replace( _re_old_key_id, _re_new_key_id );
			}



		}



		/*! 
		 * ************************************
		 * Returns the control ID of the template
		 *	
		 *************************************
		 */
		if ( returnTempID ) {
			result = renderTempID.replace(/\[/g, '')
								 .replace(/\]/g, '');
		}
	
	}
	

	return result;
	

}


