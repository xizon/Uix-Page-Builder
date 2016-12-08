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
		
        var $window      = $( window ),
		    windowWidth  = $window.width(),
		    windowHeight = $window.height(),
			barspeed     = 1000;
	
		$( '.uix-pb-bar-box-square' ).each(function() {
			var $this       = $( this ),
			    perc        = $( '.uix-pb-bar', this).data( 'percent' ),
				size        = $( '.uix-pb-bar', this).data( 'size' ),
				linewidth   = $( '.uix-pb-bar', this).data( 'linewidth' ),
				trackcolor  = $( '.uix-pb-bar', this).data( 'trackcolor' ),
				barcolor    = $( '.uix-pb-bar', this).data( 'barcolor' ),
				units       = $( '.uix-pb-bar', this).data( 'units' ),
				iconName    = $( '.uix-pb-bar', this).data( 'icon' ),
				boxheight   = $( '.uix-pb-bar-info', this).height();
				
			if ( boxheight > 0 ) $( this ).css( { 'height': linewidth + boxheight + 'px' } );
			$( '.uix-pb-bar', this).css( { 'height': linewidth + 'px', 'width': '100%', 'background': trackcolor } );
			$( '.uix-pb-bar .uix-pb-bar-percent', this).css( { 'height': linewidth + 'px', 'width': 0, 'background': barcolor } );
			$( '.uix-pb-bar .uix-pb-bar-text', this).html( '' );
			
			//Number Incrementers of Progress Bar ( Making class active by scrolling past it )
			$window.on( 'scroll', function() {
				var scrollTop = $window.scrollTop();
			
			
				$this.find( '.uix-pb-bar .uix-pb-bar-text' ).each( function()  {
					
					if ( $this.find( '.uix-pb-bar .uix-pb-bar-percent' ).width() == 0 ) {
						
						if ( scrollTop > parseFloat( $( this ).offset().top - windowHeight + 150 ) ) {
							
							$this.find( '.uix-pb-bar .uix-pb-bar-percent' ).css( { 'height': linewidth + 'px', 'width': 0, 'background': barcolor } ).animate( { percentage: perc, width: perc + '%'  }, {duration: barspeed } );
							
							var $el = $( this ),
								value = perc;
								
						
							$( { percentage: 0 } ).stop(true).animate( { percentage: value }, {
								duration : barspeed,
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
	
							
						}
	
					}
					
				});

			
			});
			
			
			
		});
		
		
		$( '.uix-pb-bar-box-circular' ).each(function() {
			
			var $this      = $( this ),
				perc       = $( '.uix-pb-bar', this).data( 'percent' ),
				size       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
				sizeNum    = size.replace( 'px', '' ),
				linewidth  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'linewidth' ),
				trackcolor = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'trackcolor' ),
				barcolor   = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'barcolor' ),
				units      = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'units' ),
				icon       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'icon' );
			
			$( '.uix-pb-bar', this ).easyPieChart({
				animate: barspeed,
				barColor: barcolor,
				trackColor: trackcolor,
				scaleLength: 0,
				lineWidth: linewidth,
				size: sizeNum
			});
			
			$( '.uix-pb-bar', this ).data( 'easyPieChart' ).update( 0 );
			
				
		
		});
			
		// Making class active by scrolling past it
		$window.on( 'scroll', function() {
			var scrollTop = $window.scrollTop();
			
			$( '.uix-pb-bar-box-circular' ).each(function() {
				
				if ( $( '.uix-pb-bar .uix-pb-bar-percent', this ).text().length == 0 ) {
					
					if ( scrollTop > parseFloat( $( this ).offset().top - windowHeight + 150 ) ) {
						
						
						var $this      = $( this ),
							perc       = $( '.uix-pb-bar', this).data( 'percent' ),
							size       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
							sizeNum    = size.replace( 'px', '' ),
							linewidth  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'linewidth' ),
							trackcolor = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'trackcolor' ),
							barcolor   = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'barcolor' ),
							units      = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'units' ),
							icon       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'icon' ),
							$txtcont   = $( '.uix-pb-bar', this ).find( '.uix-pb-bar-percent' );
					
					
						$( '.uix-pb-bar', this ).data( 'easyPieChart' ).update( perc );
						$( '.uix-pb-bar', this ).find( '.uix-pb-bar-percent' ).css( { 'line-height': size, 'width': size } ).animate( { percentage: perc }, {duration: barspeed } );
						$( { percentage: 0 } ).stop(true).animate( { percentage: perc }, {
							duration : barspeed,
							step: function () {
								// percentage with 1 decimal;
								var percentageVal = parseInt( Math.round(this.percentage * 10) / 10 );
								
								if ( icon != '' ) {
									$txtcont.html( '<i class="fa fa-'+icon+'"></i>' );
								} else {
									$txtcont.html( percentageVal + units );
								}
								
							}
						}).promise().done(function () {
							// hard set the value after animation is done to be
							// sure the value is correct
							if ( icon != '' ) {
								$txtcont.html( '<i class="fa fa-'+icon+'"></i>' );
							} else {
								$txtcont.html( perc + units );
							}			
							
							
						});
						
						
						
					}
	
				}
	
			
			});

		
		});
	
		
		
		
	};
	
		
    uix_pb.bar = {
        documentReady : documentReady        
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );




/**!
 * easy-pie-chart
 * Lightweight plugin to render simple, animated and retina optimized pie charts
 *
 * @license 
 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
 * @version 2.1.7
 **/
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){var b=function(a,b){var c,d=document.createElement("canvas");a.appendChild(d),"object"==typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(d);var e=d.getContext("2d");d.width=d.height=b.size;var f=1;window.devicePixelRatio>1&&(f=window.devicePixelRatio,d.style.width=d.style.height=[b.size,"px"].join(""),d.width=d.height=b.size*f,e.scale(f,f)),e.translate(b.size/2,b.size/2),e.rotate((-0.5+b.rotate/180)*Math.PI);var g=(b.size-b.lineWidth)/2;b.scaleColor&&b.scaleLength&&(g-=b.scaleLength+2),Date.now=Date.now||function(){return+new Date};var h=function(a,b,c){c=Math.min(Math.max(-1,c||0),1);var d=0>=c?!0:!1;e.beginPath(),e.arc(0,0,g,0,2*Math.PI*c,d),e.strokeStyle=a,e.lineWidth=b,e.stroke()},i=function(){var a,c;e.lineWidth=1,e.fillStyle=b.scaleColor,e.save();for(var d=24;d>0;--d)d%6===0?(c=b.scaleLength,a=0):(c=.6*b.scaleLength,a=b.scaleLength-c),e.fillRect(-b.size/2+a,0,c,1),e.rotate(Math.PI/12);e.restore()},j=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){window.setTimeout(a,1e3/60)}}(),k=function(){b.scaleColor&&i(),b.trackColor&&h(b.trackColor,b.trackWidth||b.lineWidth,1)};this.getCanvas=function(){return d},this.getCtx=function(){return e},this.clear=function(){e.clearRect(b.size/-2,b.size/-2,b.size,b.size)},this.draw=function(a){b.scaleColor||b.trackColor?e.getImageData&&e.putImageData?c?e.putImageData(c,0,0):(k(),c=e.getImageData(0,0,b.size*f,b.size*f)):(this.clear(),k()):this.clear(),e.lineCap=b.lineCap;var d;d="function"==typeof b.barColor?b.barColor(a):b.barColor,h(d,b.lineWidth,a/100)}.bind(this),this.animate=function(a,c){var d=Date.now();b.onStart(a,c);var e=function(){var f=Math.min(Date.now()-d,b.animate.duration),g=b.easing(this,f,a,c-a,b.animate.duration);this.draw(g),b.onStep(a,c,g),f>=b.animate.duration?b.onStop(a,c):j(e)}.bind(this);j(e)}.bind(this)},c=function(a,c){var d={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,trackWidth:void 0,size:110,rotate:0,animate:{duration:1e3,enabled:!0},easing:function(a,b,c,d,e){return b/=e/2,1>b?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},onStart:function(a,b){},onStep:function(a,b,c){},onStop:function(a,b){}};if("undefined"!=typeof b)d.renderer=b;else{if("undefined"==typeof SVGRenderer)throw new Error("Please load either the SVG- or the CanvasRenderer");d.renderer=SVGRenderer}var e={},f=0,g=function(){this.el=a,this.options=e;for(var b in d)d.hasOwnProperty(b)&&(e[b]=c&&"undefined"!=typeof c[b]?c[b]:d[b],"function"==typeof e[b]&&(e[b]=e[b].bind(this)));"string"==typeof e.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[e.easing])?e.easing=jQuery.easing[e.easing]:e.easing=d.easing,"number"==typeof e.animate&&(e.animate={duration:e.animate,enabled:!0}),"boolean"!=typeof e.animate||e.animate||(e.animate={duration:1e3,enabled:e.animate}),this.renderer=new e.renderer(a,e),this.renderer.draw(f),a.dataset&&a.dataset.percent?this.update(parseFloat(a.dataset.percent)):a.getAttribute&&a.getAttribute("data-percent")&&this.update(parseFloat(a.getAttribute("data-percent")))}.bind(this);this.update=function(a){return a=parseFloat(a),e.animate.enabled?this.renderer.animate(f,a):this.renderer.draw(a),f=a,this}.bind(this),this.disableAnimation=function(){return e.animate.enabled=!1,this},this.enableAnimation=function(){return e.animate.enabled=!0,this},g()};a.fn.easyPieChart=function(b){return this.each(function(){var d;a.data(this,"easyPieChart")||(d=a.extend({},b,a(this).data()),a.data(this,"easyPieChart",new c(this,d)))})}});