/* *************************************

	---------------------------
	UIX PAGE BUILDER SCRIPTS
	---------------------------
	
	TABLE OF CONTENTS
	---------------------------
	
		
	1. Accordion & Tabs
	2. Progress Bar
	

************************************* */

var templateUrl = wp_theme_root_path.templateUrl;

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
 * 1. Accordion & Tabs
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		$( '.uix-pb-accordion' ).each( function(){
			
				//returns new id
				var $this              = $( this ),
					tranEfftct         = $this.data( 'effect' ),
					spoilerContent     = '.uix-pb-spoiler-content',
					speed              = 300,
					spoilerCloseClass  = 'uix-pb-spoiler-closed',
					$spoilerBox        = $this.find( '.uix-pb-spoiler' );
					
				
				
				//Tabs
				if ( $this.hasClass( 'uix-pb-tabs' ) ) {
					
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
					
					$( '.uix-pb-accordion .'+spoilerCloseClass ).find( spoilerContent ).show();
				
				    
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



/*! 
 *************************************
 * 2. Progress Bar
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		
		$( '.uix-pb-bar-box-square' ).each(function() {
			var perc  = $( '.uix-pb-bar', this).data( 'percent' ),
				size  = $( '.uix-pb-bar', this).data( 'size' ),
				linewidth  = $( '.uix-pb-bar', this).data( 'linewidth' ),
				trackcolor  = $( '.uix-pb-bar', this).data( 'trackcolor' ),
				barcolor  = $( '.uix-pb-bar', this).data( 'barcolor' ),
				units  = $( '.uix-pb-bar', this).data( 'units' ),
				iconName  = $( '.uix-pb-bar', this).data( 'icon' ),
				boxheight  = $( '.uix-pb-bar-info', this).height();
				
			if ( boxheight > 0 ) $( this ).css( { 'height': linewidth + boxheight + 'px' } );
			$( '.uix-pb-bar', this).css( { 'height': linewidth + 'px', 'width': '100%', 'background': trackcolor } );
			$( '.uix-pb-bar .uix-pb-bar-percent', this).css( { 'height': linewidth + 'px', 'width': 0, 'background': barcolor } ).animate( { width: perc + '%' }, {duration: 1000 } );
			
			//Number Incrementers of Progress Bar
			$( '.uix-pb-bar .uix-pb-bar-text', this ).each( function()  {
				var $el = $( this ),
					value = perc;
			
				$( { percentage: 0 } ).stop(true).animate( { percentage: value }, {
					duration : 1000,
					step: function () {
						// percentage with 1 decimal;
						var percentageVal = parseInt( Math.round(this.percentage * 10) / 10 );
						
						if ( iconName != '' ) {
							$el.html( '<i class="fa fa-'+iconName+'"></i>' );
						} else {
							$el.html( percentageVal + units );
						}
						
					}
				}).promise().done(function () {
					// hard set the value after animation is done to be
					// sure the value is correct
					if ( iconName != '' ) {
						$el.html( '<i class="fa fa-'+iconName+'"></i>' );
					} else {
						$el.html( value + units );
					}			
					
					
				});
			});
			
			
		});
		
		
		$( '.uix-pb-bar-box-circular' ).each(function() {
			var perc  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'percent' ),
				size  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
				sizeNum  = size.replace( 'px', '' ),
				linewidth  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'linewidth' ),
				trackcolor  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'trackcolor' ),
				barcolor  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'barcolor' ),
				units  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'units' ),
				icon  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'icon' );
			
			$( '.uix-pb-bar', this ).easyPieChart({
				onStep: function(from, to, percent) { 
					var txtShow = ( icon != '' ) ? '<i class="fa fa-'+icon+'"></i>' : Math.round( percent ) + units;
					$( this.el ).find( '.uix-pb-bar-percent' ).html( txtShow ).css( { 'line-height': size, 'width': size } ); 
				},
				barColor: barcolor,
				trackColor: trackcolor,
				scaleLength: 0,
				lineWidth: linewidth,
				size: sizeNum
			});

		});
		
		
	};
	
		
    uix_pb.bar = {
        documentReady : documentReady        
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );
