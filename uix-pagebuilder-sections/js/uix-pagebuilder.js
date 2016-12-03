/* *************************************

	---------------------------
	UIX PAGE BUILDER SCRIPTS
	---------------------------
	
	TABLE OF CONTENTS
	---------------------------
	
		
	1. Accordion
	

************************************* */

var templateUrl = wp_uix_pb_root_path.templateUrl;

var uix_pb = (function ( $, window, document ) {
    'use strict';

    var uix_pb         = {},
        components    = { documentReady: [], pageLoaded: [] };

	if(typeof waitForImages == 'function'){
		$( 'body' ).waitForImages( pageLoaded );
	} else {
		$( window ).load( pageLoaded );
	}
	
    $( document ).ready( documentReady );
	
	
	
    function documentReady( context ) {
        
        context = typeof context == typeof undefined ? $ : context;
        components.documentReady.forEach( function( component ) {
            component( context );
        });
    }

    function pageLoaded( context ){
        
        context = typeof context == "object" ? $ : context;
        components.pageLoaded.forEach( function( component ) {
           component( context );
        });
    }

    uix_pb.setContext = function ( contextSelector ) {
        var context = $;
        if( typeof contextSelector !== typeof undefined ) {
            return function( selector ) {
                return $( contextSelector ).find( selector );
            };
        }
        return context;
    };

    uix_pb.components         = components;
    uix_pb.documentReady      = documentReady;
	uix_pb.pageLoaded         = pageLoaded;

    return uix_pb;
}( jQuery, window, document ) );



/*! 
 *************************************
 * 1. Accordion
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		$( '.uix-pb-accordion' ).each( function(){
			
				//returns new id
				var $this          = $( this ),
					tranEfftct     = $this.data( 'effect' ),
					spoilerContent = '.uix-pb-spoiler-content',
					speed          = 300;
					
					
				//Tabs
				if ( $this.hasClass('uix-pb-tabs') ) {
					
					var $tabsLi = $this.find( '.uix-pb-tabs-title li' );
					
					$this.find( '.uix-pb-tabs-title li:eq(0)' ).addClass( 'active' );
					$this.find( '.uix-pb-spoiler-content:eq(0)' ).show().addClass( 'active' );
					
					
						
						
					$tabsLi.on( 'click', function( e ) {
					
						var  contentIndex = $( this ).index(),
							$title = $( this ),
							$content = $this.find( spoilerContent+':eq('+contentIndex+')' ),
							toggleClass = 'active';
							
							
								
							$tabsLi.removeClass( toggleClass );
							$this.find( spoilerContent ).removeClass( toggleClass );
							
							$title.toggleClass( toggleClass );
							$content.toggleClass( toggleClass );
							
							//Open/close content
							if ( tranEfftct == 'slide' ) {
								$this.find( spoilerContent ).not( '.' + toggleClass ).slideUp( speed );	
								$content.slideDown( speed );	
	
							}
							if ( tranEfftct == 'fade' ) {
								
								$this.find( spoilerContent ).not( '.' + toggleClass ).hide();	
								$content.fadeIn( speed );
								
							}
							if ( tranEfftct == 'none' ) {
								$this.find( spoilerContent ).not( '.' + toggleClass ).hide();	
								$content.show();	
	
							}	
					
							
							// Scroll in spoiler in accordion
							e.preventDefault();	
					
					
					} );
	
					
				} else {
					
				    var $spoilerBox = $this.find( '.uix-pb-spoiler' ),
					    spoilerCloseClass = 'uix-pb-spoiler-closed';
					
					
					$spoilerBox.on( 'click', function( e ) { //prevent the extra click event from $spoilerBox
					
						var $title = $( '.uix-pb-spoiler-title', this ), 
							$spoiler = $title.parent(), 
							$content = $( this ).find( spoilerContent );
					
					
							if ( $title.css( 'widows' ) != 2 ) {
								
								// Open/close spoiler
								$spoiler.toggleClass( spoilerCloseClass );
								
								// Close other spoilers in accordion
								$spoilerBox.removeClass( spoilerCloseClass );	
								
								$( this ).addClass( spoilerCloseClass );
								
								//Open/close content
								if ( tranEfftct == 'slide' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).slideUp( speed );	
									$content.slideDown( speed );	
		
								}
								if ( tranEfftct == 'fade' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).hide();	
									$content.fadeIn( speed );	
		
								}
								if ( tranEfftct == 'none' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).hide();	
									$content.show();	
		
								}						
													
			
							} else {
								
								$( this ).removeClass( spoilerCloseClass );
								
								//Open/close content
								if ( tranEfftct == 'slide' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).slideUp( speed );	
								}
								if ( tranEfftct == 'fade' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).fadeOut( speed );	
								}
								if ( tranEfftct == 'none' ) {
									$this.find( spoilerContent ).not( '.' + spoilerCloseClass ).hide();	
								}												
									
							}
							
				
							// Scroll in spoiler in accordion
							e.preventDefault();	
					
					
					} );
	
					
				}
			
			
		});
		
		
	};
	
		
    uix_pb.accordion = {
        documentReady : documentReady        
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );
