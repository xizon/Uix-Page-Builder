
/*! 
 * ************************************
 * Initialize
 *************************************
 */	
( function($) {
 
	$( document ).ready( function() {
		
		/* Sweet Alert */
		$( document ).on( 'click', '.sweet-alert button', function( e ) {
			$( '.sweet-alert' ).css({ top: '50%' });
		});　
		

	} ); 

} ) ( jQuery );



/*! 
 * ************************************
 * Icon Selector
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uix_pb_iconSelector = function( options ) {
	
		return this.each( function() {
			
			var $this = $( this ),
			    containerID = '#' + $this.attr( 'contain-id' ),
				iconURL = $this.attr( 'list-url' ),
				targetID = '#' + $this.attr( 'target-id' ),
				previewID = '#' + $this.attr( 'preview-id' ),
				listContainerID = 'icon-list-' + $this.attr( 'target-id' );
				
			
			//Icon list with the jQuery AJAX method.
			jQuery.ajax({
				url: iconURL, 
				type: "GET",
				success: function( result ){
					jQuery( containerID ).html( '<div id="' + listContainerID + '">' + result + '</div>' );
				}
			});
			
			
			//Click event for icon type: Font Awesome
			jQuery( document ).on( 'click', '#' + listContainerID + ' .b.fontawesome', function( e ) {
				var _v = jQuery(this).find( '.fa' ).attr("class");
				jQuery( '.b.fontawesome' ).removeClass('active');
				jQuery( this ).addClass( 'active' );
				
				
				_v = _v.replace( 'fa fa-', '' );
				jQuery( targetID ).val(_v);
				jQuery( previewID ).html( '<i class="fa fa-'+_v+'"></i>' );
				
			});
			
		    
			//Click event for icon type: Flaticon
			jQuery( document ).on( 'click', '#' + listContainerID + ' .b.flaticon', function( e ) {
				var _v = jQuery(this).find( '.flaticon' ).attr( 'class' );
				jQuery( '.b.flaticon' ).removeClass( 'active' );
				jQuery( this ).addClass( 'active' );
				
				
				_v = _v.replace( 'flaticon ', '' );
				jQuery( targetID ).val( _v );
				jQuery( previewID ).html( '<i class="flaticon '+_v+'"></i>' );
			
			});	
			
	
 
		} );
	
  };
} )( jQuery );


/*! 
 * ************************************
 * Textarea Value Format by Default
 *************************************
 */	

( function( $ ) {
  jQuery.fn.uix_pb_enterTextareaValue = function( options ) {
		var settings=$.extend( {
			'ID':'.social_toggle',
			'value':'',
			'clearIntervalID':''
		}
		,options );
		return this.each( function() {
			
			jQuery( document ).on( 'click', settings.clearIntervalID, function( e ) {
				jQuery( settings.ID ).val( settings.value );
			});　				


		} );
	
  };
} )( jQuery );


/*! 
 * ************************************
 * Dynamic Adding Input
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uix_pb_dynamicAddinginput = function( options ) {
		var settings=$.extend( {
			'btnID':'.addrow',
			'removebtnClass':'delrow',
			'appendID':'#dynamic-append-box',
			'maxInput':20,
			'cloneContent':''
		}
		,options );
		return this.each( function() {
			
			    var show_count = settings.maxInput, 
					clone_content = settings.cloneContent;
	
				clone_content = '<span class="dynamic-row dynamic-addnow">' + clone_content + '<div class="delrow-container"><a href="javascript:" class="delrow '+settings.removebtnClass+'">&times;</a></div></span>';
				clone_content = clone_content.replace( /toggle-row/g,'toggle-row toggle-row-clone-list' );
				
				jQuery( document ).on( 'click', settings.btnID, function( event ) {
					
					var btnINdex = parseFloat( jQuery( this ).attr( 'data-index' ) );
					var sweetWrapperinnerHeight = jQuery( '.sweet-table-wrapper' ).innerHeight() + 24;
					
					
					if ( btnINdex <= show_count ) {
						
						var cloneCode = clone_content;
						cloneCode = cloneCode.replace( /data-id=\"/g,'id="'+btnINdex+'-' );
						cloneCode = cloneCode.replace( /{dataID}/g,''+btnINdex+'-' ); 
					
						jQuery( settings.appendID ).after( cloneCode );
						jQuery( this ).attr( 'data-index',btnINdex+1 );
				
					}
					
					
					if ( btnINdex == show_count ) {
						jQuery( settings.btnID ).addClass( 'disable' );
					}
					
					
					//Fix Sweet Alert position of top
					$( document ).uix_pb_fixedWinTop( { oheight: sweetWrapperinnerHeight } );
	
					//Icon list
					$( '.icon-selector' ).uix_pb_iconSelector();
						  
					 
					//focus
					var srow = '.sweet-alert .dynamic-row';
					$( srow ).mouseenter(function() {
						$( srow ).animate( { opacity: 0.3 }, 0 );
						$( this ).animate( { opacity: 1 }, 0 );
					});
					$( srow ).mouseleave(function() {
						$( srow ).animate( { opacity: 1 }, 0 );
					});
					
					//color picker
					$( '.wp-color-input' ).wpColorPicker();
					
					
					
				} );
				

				 //remove input
				 if ( settings.removebtnClass ){
					 
					 jQuery( document ).on( 'click', '.' + settings.removebtnClass, function( event ) {
						var btnINdex = parseFloat( jQuery( settings.btnID ).attr( 'data-index' ) );
				
						if ( btnINdex <= 1 ) {
							alert( "keep at least one." );
						} else {
							jQuery( this ).parent().parent().remove();
							jQuery( settings.btnID ).attr( 'data-index',btnINdex-1 );							
						}
				
						jQuery( settings.btnID ).removeClass( 'disable' );
				
						
					} );		
	 
				 }	
				 


		  
		  
		} );
	
  };
} )( jQuery );


/*! 
 * ************************************
 * Toggle
 *************************************
 */	

( function( $ ) {
  jQuery.fn.uix_pb_divToggle = function( options ) {
		var settings=$.extend( {
			'btnID':'.social_toggle',
			'targetID':'.social_box',
			'checkbox': 0,
			'checkboxToggleClass' : '',
			'noToggleID' : '',
			'list': 0
		}
		,options );
		return this.each( function() {
			
			
			
			    //Toggle for radio
				if ( settings.checkbox == 1 ) { 
				
				    jQuery( document ).on( 'click', settings.checkboxToggleClass, function( e ) {
						
							if ( settings.list == 1 ) {
							
								jQuery( settings.targetID ).parent().parent( '.toggle-row' ).hide();
								jQuery( settings.targetID ).parent().parent( '.toggle-row' ).find( '.sweet-box' ).hide();
	
							} else {
								
								jQuery( settings.targetID ).hide();
								jQuery( settings.targetID ).find( 'th' ).find( 'label' ).hide();
								jQuery( settings.targetID ).find( 'td' ).find( '.sweet-box' ).hide();
						
							}
	
					});

				
				}
			
			
	            jQuery( document ).on( 'click', settings.btnID, function( e ) {
					
					var sweetWrapperinnerHeight = jQuery( '.sweet-table-wrapper' ).innerHeight() + 24;
					
					
					// if checkbox
					if ( settings.checkbox == 1 ) { 
					
						if ( settings.list == 1 ) {
							
							var trid = jQuery( settings.targetID ).parent().parent( '.toggle-row' );
							
							if ( trid.css( 'display' ) == 'none' ) {
								
								trid.show();
								trid.find( '.sweet-box' ).show();
								jQuery( settings.targetID ).addClass( 'active' );
								
							} else {
								
								trid.hide();
								trid.find( '.sweet-box' ).hide();
							}


						} else {
							
							var trid = jQuery( settings.targetID );
							
							if ( trid.css( 'display' ) == 'none' ) {
								
								trid.show();
								trid.find( 'th' ).find( 'label' ).show();
								trid.find( 'td' ).find( '.sweet-box' ).show();
								trid.addClass( 'active' );
								

							} else {
								
								trid.hide();
								trid.find( 'th' ).find( 'label' ).hide();
								trid.find( 'td' ).find( '.sweet-box' ).hide();

							}
			
	
						}


						//if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid
						if ( settings.noToggleID != '' ) {
							jQuery( settings.noToggleID ).hide();
						}


					
					} else {
						
						if ( settings.list == 1 ) {
							jQuery( this ).parent().parent( '.toggle-btn' ).hide();
							jQuery( settings.targetID ).parent().parent( '.toggle-row' ).show();
							jQuery( settings.targetID ).parent().parent( '.toggle-row' ).find( '.sweet-box' ).show();
							jQuery( settings.targetID ).addClass( 'active' );
		
						} else {
							jQuery( this ).parent( '.sweet-box' ).parent().parent( 'tr' ).hide();
							jQuery( settings.targetID ).show();
							jQuery( settings.targetID ).find( 'th' ).find( 'label' ).show();
							jQuery( settings.targetID ).find( 'td' ).find( '.sweet-box' ).show();
							jQuery( settings.targetID ).addClass( 'active' );
	
						}
	
					}
					
					
					//Fix Sweet Alert position of top
					$( document ).uix_pb_fixedWinTop( { oheight: sweetWrapperinnerHeight } );
					
				} );
	
	
		  
		} );
	
  };
} )( jQuery );


/*! 
 * ************************************
 * Multiple Selector
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uix_pb_multipleSelector = function( options ) {
		var settings=$.extend( {
			'containerID':'#demo',
			'targetID': '#input'
		}
		,options );
		return this.each( function() {
	        
			
			jQuery( document ).on( 'click', settings.containerID + ' span', function( e ) {
	
				var _curValue = jQuery( this ).attr( 'data-value' ),
				    _tarValue = jQuery( settings.targetID ).val() + ',',
					_result;
					
				jQuery( this ).toggleClass( 'active' );
				
				if ( _tarValue.indexOf( _curValue + ',' ) < 0 ) {
					_result = _tarValue + _curValue + ',';
				} else {
					_result = _tarValue.replace( _curValue + ',', '' );
				}
				
				jQuery( settings.targetID ).val( _result.substring( 0, _result.length-1 ) );
			
			} );	

 
		} );
	
  };
} )( jQuery );

/*! 
 * ************************************
 * Radio Selector
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uix_pb_radioSelector = function( options ) {
		var settings=$.extend( {
			'containerID':'#demo',
			'targetID': '#input'
		}
		,options );
		return this.each( function() {
	        
			
			jQuery( document ).on( 'click', settings.containerID + ' span', function( e ) {
				var _curValue = jQuery( this ).attr( 'data-value' );
				jQuery( settings.containerID ).find( 'span' ).removeClass( 'active' );
				jQuery( settings.targetID ).val( _curValue );
				jQuery( this ).addClass( 'active' );
			} );	

 
		} );
	
  };
} )( jQuery );




/*! 
 * ************************************
 * Insert media 
 *************************************
 */	

( function( $ ) {
  jQuery.fn.uix_pb_uploadMediaCustom = function( options ) {
		var settings=$.extend( {
			'prop': false
		}
		,options );
		return this.each( function() {
			
				var upload_frame,
				    value_id,
					propIDPrefix = settings.btnID.replace( '#', '' );
					
				jQuery( document ).on( 'click', settings.btnID, function( event ) {
					
					var _targetImgContainer = jQuery( this ).attr( "data-insert-img" );
					var _targetPreviewContainer = jQuery( this ).attr( "data-insert-preview" );
					
					value_id =jQuery( this ).attr( 'id' );
					event.preventDefault();
					
					if( upload_frame ){
						upload_frame.open();
						return;
					}
					upload_frame = wp.media( {
						title: 'Select Files',
						button: {
						text: 'Insert into post',
					},
						multiple: false
					} );
					upload_frame.on( 'select',function(){
						attachment = upload_frame.state().get( 'selection' ).first().toJSON();
						jQuery( "#" + _targetImgContainer ).val( attachment.url );
						jQuery( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",attachment.url );//image preview
						jQuery( "#" + _targetPreviewContainer ).show();
						
						//Upload container
						if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
						    jQuery( settings.btnID ).parent( '.sweet-upbtn-container' ).css( 'height','150px' );
						}
						
						
						if ( settings.closebtnID ){
							jQuery( settings.closebtnID ).show();
						}
						
						//Fix Sweet Alert position of top
						$( document ).uix_pb_fixedWinTop( { oheight: jQuery( '.sweet-table-wrapper' ).innerHeight() + 24 } );		
						
						//Show image properties
						if ( settings.prop ) {
							jQuery( "." + propIDPrefix + '_repeat' ).show();
							jQuery( "." + propIDPrefix + '_position' ).show();
							jQuery( "." + propIDPrefix + '_attachment' ).show();
							jQuery( "." + propIDPrefix + '_size' ).show();
						
	
						}
	
						
						
					} );
					 
					upload_frame.open();
					

				} );
				
				 //Delete pictrue   
				 if ( settings.closebtnID ){
					jQuery( document ).on( 'click', settings.closebtnID, function( e ) {
						var _targetImgContainer = jQuery( this ).attr( "data-insert-img" );
						var _targetPreviewContainer = jQuery( this ).attr( "data-insert-preview" );
						
						jQuery( "#" + _targetImgContainer ).val( '' );
						jQuery( "#" + _targetPreviewContainer ).find( 'img' ).attr( "src",'' );
						jQuery( "#" + _targetPreviewContainer ).hide();
						
						//Upload container
						if ( _targetPreviewContainer != '' && _targetPreviewContainer != 'none' ) {
						    jQuery( settings.btnID ).parent( '.sweet-upbtn-container' ).css( 'height','40px' );
						}
						
						
						jQuery( this ).hide();
						
						//Hide image properties
						if ( settings.prop ) {
							jQuery( "." + propIDPrefix + '_repeat' ).hide();
							jQuery( "." + propIDPrefix + '_position' ).hide();
							jQuery( "." + propIDPrefix + '_attachment' ).hide();
							jQuery( "." + propIDPrefix + '_size' ).hide();
						}
						
						
					} );		
	 
				 }	
		  
		  
		} );
	
  };
} )( jQuery );



/*!
 * ************************************
 * jQuery Mousewheel 3.1.12
 *
 * Copyright 2014 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * ************************************
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.12',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
            // Clean up the data we added to the element
            $.removeData(this, 'mousewheel-line-height');
            $.removeData(this, 'mousewheel-page-height');
        },

        getLineHeight: function(elem) {
            var $elem = $(elem),
                $parent = $elem['offsetParent' in $.fn ? 'offsetParent' : 'parent']();
            if (!$parent.length) {
                $parent = $('body');
            }
            return parseInt($parent.css('fontSize'), 10) || parseInt($elem.css('fontSize'), 10) || 16;
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true, // see shouldAdjustOldDeltas() below
            normalizeOffset: true  // calls getBoundingClientRect for each event
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0,
            offsetX    = 0,
            offsetY    = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Normalise offsetX and offsetY properties
        if ( special.settings.normalizeOffset && this.getBoundingClientRect ) {
            var boundingRect = this.getBoundingClientRect();
            offsetX = event.clientX - boundingRect.left;
            offsetY = event.clientY - boundingRect.top;
        }

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        event.offsetX = offsetX;
        event.offsetY = offsetY;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));



/*! 
 * ************************************
 * Format Content from Textarea 
 *************************************
 */	
function uix_pb_formatTextarea( str ) {
	
	//checking for "undefined" in replace-regexp
	if ( str != undefined ) {
		str = uix_pb_getHTML( str );
		str = str.toString().replace(/\s/g," ").replace(/\"/g,"&quot;").replace(/\'/g,"&apos;");
		
	}
	
	return str;

}


function uix_pb_getHTML( str ) {

    var v = str;
    v = v.replace(/\r?\n/gm, '<br/>');
    v = v.replace(/(?!<br\/>)(.{5})<br\/><br\/>(?!<br\/>)/gi, '$1</p><p>');
    if (v.indexOf("<p>") > v.indexOf("</p>")) v = "<p>" + v;
    if (v.lastIndexOf("</p>") < v.lastIndexOf("<p>")) v += "</p>";
    if (v.length > 1 && v.indexOf("<p>") == -1) v = "<p>" + v + "</p>";


	return v;

}


/*! 
 * ************************************
 * HTML Encode
 *************************************
 */	
function uix_pb_htmlencodeToShortcodeFormat( str ) {
	
	return (typeof str != "string") ? str :
	  str.replace(/'/g,'"').replace(/“/g,'"').replace(/<|>/g,
				function($0){
					var c = $0.charCodeAt(0), r = ["&#"];
					c = (c == 0x20) ? 0xA0 : c;
					r.push(c); r.push(";");
					return r.join("");
				});


}

/*! 
 * ************************************
 * HTML5 Range
 *************************************
 */	
function uix_pb_rangeSlider(sliderid, outputid, cusunits) {
        var x = document.getElementById( sliderid ).value;  
		document.getElementById( outputid ).innerHTML = x + cusunits;
        
};



/*! 
 * ************************************
 * Color transform
 *************************************
 */	
function uix_pb_colorTran( value ) {
	
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
		  
		  
		default:

	}
			
};


/*! 
 * ************************************
 * HTML tags like "<li>","<ul>","<ol>" transform
 *************************************
 */	
function uix_pb_html_listTran( str, type ) {
	
	var newStr = '';
	if ( str != undefined ) {
		
		//checking for "undefined" in replace-regexp
		str = str.toString().replace(/(\r)*\n/g,"[/li][li]").replace(/<br>/g,"[/li][li]");
		
		newStr = '[li]'+str+'[/li]';
		newStr = newStr.replace('[li][/li]','');
		newStr = '['+type+']'+newStr+'[/'+type+']';
	}
	
	if ( str == '' ) newStr = '';
	return newStr;
        
};

/*! 
 * ************************************
 * HTML Encode form textarea
 *************************************
 */	
function uix_pb_htmlEncode( s ) {
	
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
 * Insert value to textarea
 *************************************
 */	
function uix_pb_insertToTextarea( s ) {
      return (typeof s != "string") ? s :  
          s.replace(/<br>/g, "\n");  
};


/*! 
 * ************************************
 * Insert code
 *************************************
 */	
function uix_pb_insertCodes( code, id ) {
	if ( id == 'content' ) {
		window.send_to_editor( code );
	} else {
		( function( $ ) {
		"use strict";
			$( function() {
		         $( '#' + id ).val( $( '#' + id ).val() + uix_pb_insertToTextarea( code ) );
			} );
			
		} ) ( jQuery );
		
	}  
	
	//Synchronize other plug-ins
	if(typeof save == 'function'){
		save();
	}
};

/*! 
 * ************************************
 * Fix Sweet Alert position of top	
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uix_pb_fixedWinTop = function( options ) {
		var settings=$.extend( {
			'oheight':0
		}
		,options );
		return this.each( function() {
			
			var sweetWrapperinnerHeight = settings.oheight,
				win = jQuery( '.sweet-alert' ),
				ah = ( jQuery( document.body ).height() - win.height() )/2,
				ad = jQuery( document.body ).height()*0.67,
				mt = 200;
			
			if ( sweetWrapperinnerHeight < ad && jQuery( document.body ).height() >=560 ) {
				
				var dis = ad - sweetWrapperinnerHeight;
				
				
				if ( dis >= 1 && dis < 40 ) mt = mt + 120;
				if ( dis >= 40 && dis < 60 ) mt = mt + 85;
				if ( dis >= 60 && dis < 120 ) mt = mt + 45;
				if ( dis >= 120 && dis < 150 ) mt = mt + 75;
				
				
				win.animate( { top: ah + mt + "px" }, 300 );
			} 		
				
				
		} );
	
	
  };
} )( jQuery );

