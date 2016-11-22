/*! 
 * ************************************
 * Icon Selector
 *************************************
 */	
( function( $ ) {
  jQuery.fn.uixform_iconSelector = function( options ) {
	
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
  jQuery.fn.uixform_enterTextareaValue = function( options ) {
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
  jQuery.fn.uixform_dynamicAddinginput = function( options ) {
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
					
	
					//Icon list
					$( '.icon-selector' ).uixform_iconSelector();
						  
					 
					//focus
					var srow = '.uixform-alert .dynamic-row';
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
  jQuery.fn.uixform_divToggle = function( options ) {
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
								jQuery( settings.targetID ).parent().parent( '.toggle-row' ).find( '.uixform-box' ).hide();
	
							} else {
								
								jQuery( settings.targetID ).hide();
								jQuery( settings.targetID ).find( 'th' ).find( 'label' ).hide();
								jQuery( settings.targetID ).find( 'td' ).find( '.uixform-box' ).hide();
						
							}
	
					});

				
				}
			
			
	            jQuery( document ).on( 'click', settings.btnID, function( e ) {
					
					// if checkbox
					if ( settings.checkbox == 1 ) { 
					
						if ( settings.list == 1 ) {
							
							var trid = jQuery( settings.targetID ).parent().parent( '.toggle-row' );
							
							if ( trid.css( 'display' ) == 'none' ) {
								
								trid.show();
								trid.find( '.uixform-box' ).show();
								jQuery( settings.targetID ).addClass( 'active' );
								
							} else {
								
								trid.hide();
								trid.find( '.uixform-box' ).hide();
							}


						} else {
							
							var trid = jQuery( settings.targetID );
							
							if ( trid.css( 'display' ) == 'none' ) {
								
								trid.show();
								trid.find( 'th' ).find( 'label' ).show();
								trid.find( 'td' ).find( '.uixform-box' ).show();
								trid.addClass( 'active' );
								

							} else {
								
								trid.hide();
								trid.find( 'th' ).find( 'label' ).hide();
								trid.find( 'td' ).find( '.uixform-box' ).hide();

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
							jQuery( settings.targetID ).parent().parent( '.toggle-row' ).find( '.uixform-box' ).show();
							jQuery( settings.targetID ).addClass( 'active' );
		
						} else {
							jQuery( this ).parent( '.uixform-box' ).parent().parent( 'tr' ).hide();
							jQuery( settings.targetID ).show();
							jQuery( settings.targetID ).find( 'th' ).find( 'label' ).show();
							jQuery( settings.targetID ).find( 'td' ).find( '.uixform-box' ).show();
							jQuery( settings.targetID ).addClass( 'active' );
	
						}
	
					}
					
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
  jQuery.fn.uixform_multipleSelector = function( options ) {
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
  jQuery.fn.uixform_radioSelector = function( options ) {
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
  jQuery.fn.uixform_uploadMediaCustom = function( options ) {
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
						    jQuery( settings.btnID ).parent( '.uixform-upbtn-container' ).css( 'height','150px' );
						}
						
						
						if ( settings.closebtnID ){
							jQuery( settings.closebtnID ).show().css( { 'display': 'block' } );
						}	
						
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
						    jQuery( settings.btnID ).parent( '.uixform-upbtn-container' ).css( 'height','40px' );
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
 * Format Content from Textarea 
 *************************************
 */	
function uixform_formatTextarea( str ) {
	
	//checking for "undefined" in replace-regexp
	if ( str != undefined ) {
		str = uixform_getHTML( str );
		str = str.toString().replace(/\s/g," ").replace(/\"/g,"&quot;").replace(/\'/g,"&apos;");
		
	}
	
	return str;

}


function uixform_getHTML( str ) {

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
function uixform_htmlencodeFormat( str ) {
	
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
function uixform_rangeSlider(sliderid, outputid, cusunits) {
        var x = document.getElementById( sliderid ).value;  
		document.getElementById( outputid ).innerHTML = x + cusunits;
        
};



/*! 
 * ************************************
 * Color transform
 *************************************
 */	
function uixform_colorTran( value ) {
	
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
function uixform_html_listTran( str, type ) {
	
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
function uixform_htmlEncode( s ) {
	
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
 * Insert code
 *************************************
 */	
function uixform_insertCodes( formid, code, conid, sid ) {
	( function( $ ) {
	"use strict";
		$( function() {
			 
			 code = code.replace( '[{', '[{"name":"section","value":"'+formid+'"},{"name":"row","value":"'+sid+'"},{' )
			            .replace( /"/g, "$__$");
			 $( '#' + conid ).val( code );
		} );
		
	} ) ( jQuery );

	
	//Synchronize other plug-ins
	if(typeof save == 'function'){
		save();
	}
};
/*! 
 * ************************************
 * Pagebuilder textarea format
 *************************************
 */	
function htmlPagebuilderEscape( str ){
	return str
		.replace(/"/g, '$____$')
		.replace(/'/g, "$___$");
}



/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));
