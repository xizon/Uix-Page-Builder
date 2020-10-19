/* *************************************

	---------------------------
	UIX PAGE BUILDER SCRIPTS
	---------------------------

	TABLE OF CONTENTS
	---------------------------


	1. Accordion & Tabs
	2. Progress Bar
	3. Pricing
    4. Parallax
    5. Testimonials
	6. Portfolio ( With Filterable and Masonry )
	7. Grid
	8. Image Slider
	9. Custom Menu
	Required: Invoking JavaScript code in an iframe from the parent page
	

************************************* */

var templateUrl = wp_theme_root_path.templateUrl;

var uix_pb = (function ( $, window, document ) {
    'use strict';

    var uix_pb         = {},
        components    = { documentReady: [], pageLoaded: [] };

	if( $.isFunction( $.fn.waitForImages ) ){
		$( 'body' ).waitForImages( pageLoaded );
	} else {
		$( window ).on( 'load', pageLoaded );
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

				//Returns new id
				var $this              = $( this ),
					activated          = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
					tranEfftct         = $this.data( 'effect' ),
					spoilerContent     = '.uix-pb-spoiler-content',
					speed              = 300,
					spoilerCloseClass  = 'uix-pb-spoiler-closed',
					$spoilerBox        = $this.find( '.uix-pb-spoiler' );
			
			    if ( typeof activated === typeof undefined || activated === 0 ) {
					
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
					
					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );
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
				activated   = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
			    perc        = $( '.uix-pb-bar', this).data( 'percent' ),
				size        = $( '.uix-pb-bar', this).data( 'size' ),
				linewidth   = $( '.uix-pb-bar', this).data( 'linewidth' ),
				trackcolor  = $( '.uix-pb-bar', this).data( 'trackcolor' ),
				barcolor    = $( '.uix-pb-bar', this).data( 'barcolor' ),
				units       = $( '.uix-pb-bar', this).data( 'units' ),
				iconName    = $( '.uix-pb-bar', this).data( 'icon' ),
				boxheight   = $( '.uix-pb-bar-info', this).height();

			
			if ( typeof activated === typeof undefined || activated === 0 ) {


				$( '.uix-pb-bar', this).css( { 'height': linewidth + 'px', 'width': '100%', 'background': trackcolor } );
				$( '.uix-pb-bar .uix-pb-bar-percent', this).css( { 'height': linewidth + 'px', 'width': 0, 'background': barcolor } );
				$( '.uix-pb-bar .uix-pb-bar-text', this).html( '' );


				$this.find( '.uix-pb-bar .uix-pb-bar-text' ).each( function()  {

					if ( $this.find( '.uix-pb-bar .uix-pb-bar-percent' ).width() == 0 ) {

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

				});			

				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}


		});


		$( '.uix-pb-bar-box-circular' ).each(function() {

			var $this      = $( this ),
				activated  = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
				perc       = $( '.uix-pb-bar', this).data( 'percent' ),
				size       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
				sizeNum    = parseFloat( size ),
				linewidth  = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'linewidth' ),
				trackcolor = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'trackcolor' ),
				barcolor   = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'barcolor' ),
				units      = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'units' ),
				icon       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'icon' ),
				$txtcont   = $( '.uix-pb-bar', this ).find( '.uix-pb-bar-percent' );


			if ( typeof activated === typeof undefined || activated === 0 ) {

				
				//---------------------------
				$( '.uix-pb-bar', this ).easyPieChart({
					animate: barspeed,
					barColor: barcolor,
					trackColor: trackcolor,
					scaleLength: 0,
					lineWidth: linewidth,
					size: sizeNum
				});

				$( '.uix-pb-bar', this ).data( 'easyPieChart' ).update( 0 );

				
				//---------------------------
				if ( $( '.uix-pb-bar .uix-pb-bar-percent', this ).text().length == 0 ) {

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
				
				
				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}	


		});

	};


    uix_pb.bar = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );




/*!
 *************************************
 * 3. Pricing
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';

    var pageLoaded = function() {

		//Initialize the height
		$( '.uix-pb-price' ).each( function(){

				//returns new id
				var $this            = $( this ),
					activated        = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
					priceBGH         = Array(),
					priceBGH_excerpt = Array(),
					$initHeight      = $this.find( '.uix-pb-price-init-height' );

			
			    if ( typeof activated === typeof undefined || activated === 0 ) {
					
					$initHeight.each( function( index ) {
						//Screen protection of height
						$( this ).find( '.uix-pb-price-border,.uix-pb-price-excerpt' ).css( 'height', 'auto' );

						var tempheight = $( this ).height();
						var tempheight_excerpt = $( this ).find( '.uix-pb-price-excerpt' ).height();
						priceBGH.push( tempheight );
						priceBGH_excerpt.push( tempheight_excerpt );


					} );

					var priceBGH_Max         = Math.max.apply( Math, priceBGH ),
						priceBGH_Max_excerpt = Math.max.apply( Math, priceBGH_excerpt );



					if ( priceBGH_Max > 0 ) {
						if ( $( document.body ).width() > 768 ){

							$initHeight.find( '.uix-pb-price-border' ).css( 'height', priceBGH_Max + 'px' );
							if ( $initHeight.find( '.uix-pb-price-border.uix-pb-price-important' ).length > 0 ) {
								var ty = Math.abs(parseInt($initHeight.find( '.uix-pb-price-border.uix-pb-price-important' ).css('transform').split(',')[5]));
								if ( !isNaN(ty) ) {
									$initHeight.find( '.uix-pb-price-border.uix-pb-price-important' ).css( 'height', priceBGH_Max + ty*2 + 'px' );
								}

							}


						} else {
							$initHeight.find( '.uix-pb-price-border' ).css( 'height', 'auto' );
						}

					}
					
					
					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}
		

		});

		//Border of the hover effect
		$( '.uix-pb-price-border-hover' ).each( function(){

			var $this        = $( this ),
				activated    = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
				hw           = 6,
			    defaultColor = $this.find( '.uix-pb-price-border' ).css( 'border-color' ),
				textColor    = $this.data( 'tcolor' ),
				btnColor     = $this.data( 'bcolor' );

			
			if ( typeof activated === typeof undefined || activated === 0 ) {

				if ( $this.css( 'top' ) != '0px' ) {

					$this.hover(function() {
						$(this).find( '.uix-pb-price-border' ).css({
							"border-color": textColor,
							"-webkit-box-shadow": "inset 0 0px 0px "+hw+"px " + textColor,
							"-moz-box-shadow": "inset 0 0px 0px "+hw+"px " + textColor,
							"box-shadow": "inset 0 0px 0px "+hw+"px " + textColor,
						});
					},function() {
						$(this).find( '.uix-pb-price-border' ).css({
							"border-color": defaultColor,
							"-webkit-box-shadow": "none",
							"-moz-box-shadow": "none",
							"box-shadow": "none"
						});
					});

				}				

				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}
			


		});

		
		
		/* -----------Style 2  -------------- */
		//Initialize the height
		$( '.uix-pb-price2' ).each( function(){
			

				//returns new id
				var $this            = $( this ),
					activated        = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
					priceBGH         = Array(),
					priceBGH_excerpt = Array(),
					$initHeight      = $this.find( '.uix-pb-price2-init-height' );

			
			    if ( typeof activated === typeof undefined || activated === 0 ) {
					
					$initHeight.each( function( index ) {
						//Screen protection of height
						$( this ).find( '.uix-pb-price2-border,.uix-pb-price2-excerpt' ).css( 'height', 'auto' );

						var tempheight = $( this ).height();
						var tempheight_excerpt = $( this ).find( '.uix-pb-price2-excerpt' ).height();
						priceBGH.push( tempheight );
						priceBGH_excerpt.push( tempheight_excerpt );


					} );

					var priceBGH_Max         = Math.max.apply( Math, priceBGH ),
						priceBGH_Max_excerpt = Math.max.apply( Math, priceBGH_excerpt );



					if ( priceBGH_Max > 0 ) {
						if ( $( document.body ).width() > 768 ){

							// Initialize the height of all columns
							$initHeight.find( '.uix-pb-price2-border' ).css( 'height', priceBGH_Max + 'px' );

							// Actived columns
							$initHeight.find( '.uix-pb-price2-border.uix-pb-price2-important' ).each( function() {

								var textColor = $( this ).closest( '.uix-pb-price2-border-hover' ).data( 'tcolor' ),
									btnColor  = $( this ).closest( '.uix-pb-price2-border-hover' ).data( 'bcolor' );

								$( this ).css( 'background-color', btnColor );

							});	




						} else {
							$initHeight.find( '.uix-pb-price2-border' ).css( 'height', 'auto' );
						}

					}

					
					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}
			


		});

	
		

    };

    uix_pb.pricing = {
        pageLoaded : pageLoaded
    };

    uix_pb.components.pageLoaded.push( pageLoaded );
    return uix_pb;


}( uix_pb, jQuery, window, document ) );




/*!
 *************************************
 * 4. Parallax
 *************************************
 */

/* 
 *************************************
 * Parallax Effect
 *
 * @param  {Number} speed     - The speed of movement between elements.
 * @param  {JSON} bg          - Specify the background display. Default value: { enable: true, xPos: '50%' }
 * @return {Void}             - The constructor.
 *************************************
 */

( function ( $ ) {
    $.fn.uix_pb_parallax = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
			speed    : 0.25,
			bg       : { enable: true, xPos: '50%' }
        }, options );
 
        this.each( function() {
			
			var bgEff      = settings.bg,
				$this      = $( this ),
				bgXpos     = '50%',
				speed      = -parseFloat( settings.speed );
			
		
	
			//Prohibit transition delay
			$this.css( {
				'transition': 'none'
			} );

		    $( window ).on( 'scroll touchmove', function( e ){
				scrollUpdate();
			});
			
			
			//Initialize the position of the background
			if ( bgEff ) {
				//background parallax
				$this.css('background-position', bgXpos + ' ' + (-$this.offset().top*speed) + 'px' );
			
			} 
			
			
			function scrollUpdate() {
				var scrolled = $( window ).scrollTop(),
					st       = $this.offset().top - scrolled;
				

				if ( bgEff ) {
					//background parallax
					$this.css('background-position', bgXpos + ' ' + ( 0 - ( st * speed ) ) + 'px' );
				}
				
			}

			
			
		});
 
    };
 
}( jQuery ));


uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {

        var $window       = $( window ),
		    windowWidth   = $window.width();
		
		uix_pb_parallaxInit( windowWidth );
		
		$window.on('resize', function() {
			windowWidth = $window.width();
			$( '.uix-pb-parallax' ).removeData( 'activated' );
			uix_pb_parallaxInit( windowWidth );
		});
		
		function uix_pb_parallaxInit( w ) {
			
			$( '.uix-pb-parallax' ).each(function() {

				var $this     = $( this ),
					activated = $this.data( 'activated' );//In order to avoid duplication of the running script with Uix Page Builder ( required )

				if ( typeof activated === typeof undefined || activated === 0 ) {

					$( this ).uix_pb_parallax( { speed: $this.data( 'parallax' ) } );
					
					
					 //Used for modules with special effects, such as "skew".
					 //The overflow is clipped, and the rest of the content will be invisible.
					 //This module of tilting effect is displayed when the script runs.
					 if ( $this.hasClass( 'skew' ) ) {
						 $this.closest( '.uix-page-builder-section' ).css( 'overflow', 'hidden' ).addClass( 'scripts-load-ok' ); 
					 }



					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}



			});
			

			
		}
		
		
		
	};


    uix_pb.parallax = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );



/*!
 *************************************
 * 5. Testimonials
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {


		$( '[data-uix-pb-hybridcontent-slider="1"]' ).each( function()  {

			 var $this     = $( this );

			$this.UixPBHybridContentSlider({

				//Get parameter configuration from the data-* attribute of HTML
				dir               : $this.data( 'dir' ),
				auto              : $this.data( 'auto' ),
				speed             : $this.data( 'speed' ),
				timing            : $this.data( 'timing' ),
				loop              : $this.data( 'loop' ),
				draggable         : $this.data( 'draggable' ),
				draggableCursor   : $this.data( 'draggable-cursor' ),
				nextID            : $this.data( 'next' ),
				prevID            : $this.data( 'prev' ),
				paginationID      : $this.data( 'pagination' )
				
			});

		});	



	};


    uix_pb.testimonials = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );


/*!
 *************************************
 * 6. Portfolio ( With Filterable and Masonry )
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {
		
		
		//Format the category group for each list item, in order to compatible filterable plugin
		//Like this:  a,b,c  ->   ["a","b","c"]
		//------------------------------
		 $( '[data-groups-name]' ).each( function(){

			var $this              = $( this ),
				activated          = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
				name               = $this.data( 'groups-name' );

		
			if ( typeof activated === typeof undefined || activated === 0 ) {

				
				if ( typeof name !== typeof undefined ) {
				
					var nameArr = name.toString().split( ',' ),
						res     = '';

					res += '[';
					if ( nameArr.constructor === Array ) {
					  for( var i=0; i<nameArr.length; i++ ) {
						  res += '"'+nameArr[i]+'",';
					  }   
					}
					res = res.replace(/,\s*$/, '');

					res += ']';
					res = res.toString();

					$this.attr( 'data-groups', res );	
					
				}

				
				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}
			 
	
		 });	


		
		
		
		// With Filterable and Masonry 
		//------------------------------
		/* @ Version 1.0 (October 15, 2020) */
		$( '.uix-pb-portfolio-wrapper' ).each( function() {

			var galleryType    = $( this ).data( 'show-type' ),
			    filterCat      = $( this ).data( 'filter-id' ),
				$grid          = $( this ).find( '.uix-pb-portfolio-tiles' ),
				$allItems      = $( this ).find( '.uix-pb-portfolio-item' ),
				$filterOptions = $( filterCat );
			
			
			if ( typeof galleryType === typeof undefined ) return false;
			
			
			/* 
			 ---------------------------
			Display categories on page
			 ---------------------------
			 */ 
			var catlistStr   = '',
				itemsStr     = $grid.html().replace(/&nbsp;/g, ' ' ),
				re           = new RegExp("(.*?)\<\/div\>","gim"),
				v            = '<div class="uix-pb-portfolio-type">',
				re           = new RegExp("" + v + "(.*?)\<\/div\>","gim"),
				arr          = [];


			itemsStr.replace( re, function(s, match) {

				   match = match
					   .replace(/\&lt;/g, '')
					   .replace(/\&gt;/g, '')
					   .replace(/\&amp;/g, '');



				   arr.push( match );
				  });	


			//Remove Duplicates from JavaScript Array
			var uniqueArr = [];
			uniqueArr = arr.filter(function(item, pos, self) {
				return self.indexOf(item) == pos;
			});


			//Output
			var newArr = uniqueArr;
			for( var j = 0; j < newArr.length; j++ ) {

				var _slug = newArr[j]
							.toString()
							.replace(/[^\w\s\-！￥【】\u4e00-\u9eff]/gi, '')
							.replace(/\s/g, '-')
							.replace(/(\-){2,}/g, '-')
							.replace(/\-\s*$/, '' )
							.toLowerCase();


				catlistStr += '<li><a href="javascript:void(0)" data-normal="1" data-group="'+_slug+'">'+newArr[j]+'</a></li>';
			}
			
			
			if ( galleryType.indexOf( 'filter' ) >= 0 ) {
				if ( $( filterCat + '-container' ).length > 0 ) {
					$( filterCat + '-container' ).html( catlistStr ).promise().done( function(){ initFilter(); });
				} else {
					$( '.uix-pb-portfolio-cat-list' ).find( '> ul' ).html( '<li class="current-cat"><a href="javascript:void(0)" data-normal="1" data-group="all">All</a></li>' + catlistStr ).promise().done( function(){ initFilter(); });
				}
			} else {
				initFilter();
			}
			
			
			
			function initFilter() {
				/* 
				 ---------------------------
				 Add a tagname to each list item
				 ---------------------------
				 */ 
				// Masonry
				if ( galleryType.indexOf( 'masonry' ) >= 0  ) {
					$( this ).addClass( 'masonry-container' );
					$( this ).find( '.uix-pb-portfolio-item' ).addClass( 'masonry-item' );
				}

				// Filterable
				if ( galleryType.indexOf( 'filter' ) >= 0  ) {
					$( this ).addClass( 'filter-container' );
					$( this ).find( '.uix-pb-portfolio-item' ).addClass( 'filter-item' );	
				}	

				


				//Standard layout 
				//--
				// When all items have loaded refresh their
				// dimensions and layout the grid.
				if ( galleryType.indexOf( 'filter' ) >= 0 && galleryType.indexOf( 'standard' ) >= 0 ) {
					imagesLoaded( $grid ).on( 'always', function() {
						var itemH = [];
						$allItems.each( function( index ) {
							var tempheight = $( this ).find( '.uix-pb-portfolio-image' ).height();
							itemH.push( tempheight );

						} );

						$grid.find( '.uix-pb-portfolio-image' ).css( 'height', Math.max.apply( Math, itemH ) + 'px' );
					});	
				}




				if ( galleryType.indexOf( 'filter' ) >= 0 || galleryType.indexOf( 'masonry' ) >= 0 ) {

					var MuuriGrid = new Muuri( $grid.get(0), {
						items: $grid.get(0).querySelectorAll( '.uix-pb-portfolio-item' ),

						// Default show animation
						showDuration: 300,
						showEasing: 'ease',

						// Default hide animation
						hideDuration: 300,
						hideEasing: 'ease',

						// Item's visible/hidden state styles
						visibleStyles: {
							opacity: '1',
							transform: 'scale(1)'
						},
						hiddenStyles: {
							opacity: '0',
							transform: 'scale(0.5)'
						},

						// Layout
						layout: {
							fillGaps: false,
							horizontal: false,
							alignRight: false,
							alignBottom: false,
							rounding: true
						},
						layoutOnResize: 100,
						layoutOnInit: true,
						layoutDuration: 300,
						layoutEasing: 'ease',

						//// Drag & Drop
						dragEnabled: false
					});


					// When all items have loaded refresh their
					// dimensions and layout the grid.
					imagesLoaded( $grid ).on( 'always', function() {
						MuuriGrid.refreshItems().layout();
						// For a little finishing touch, let's fade in
						// the images after all them have loaded and
						// they are corrertly positioned.
						$( 'body' ).addClass( 'images-loaded' );
					});


					/* 
					 ---------------------------
					 Function of Filterable and Masonry
					 ---------------------------
					 */ 
					if ( galleryType.indexOf( 'filter' ) >= 0 ) {

						$filterOptions.find( 'li > a' ).off( 'click' ).on( 'click', function() {
							var $this       = $( this );
							var activeClass = 'current-cat',
								  isActive    = $this.parent().hasClass( activeClass ),
								  group       = isActive ? 'all' : $this.data( 'group' );

							// Hide current label, show current label in title
							if ( !isActive ) {
								$filterOptions.find( '.' + activeClass ).removeClass( activeClass );
							}

							$this.parent().toggleClass( activeClass );

							// Filter elements
							var filterFieldValue = group;
							MuuriGrid.filter( function ( item ) {

								var element       = item.getElement(),
									  curCats       = element.getAttribute( 'data-groups' ).toString().replace(/^\,|\,$/g, '').replace(/^\[|\]$/g, '') + ',all',
									  isFilterMatch = !filterFieldValue ? true : ( curCats || '' ).indexOf( filterFieldValue ) > -1;

								return isFilterMatch;
							});


							return false;	
						});	
					}



				}//endif galleryType.indexOf( 'filter' ) >= 0 || galleryType.indexOf( 'masonry' ) >= 0




				//remove filter button of all
				//-------
				if ( galleryType.indexOf( 'filter' ) < 0 ) {
					if ( filterCat == '' ) {
						$filterOptions = $( '.uix-pb-portfolio-cat-list' );
					}

					$filterOptions.find( '[data-group="all"]' ).parent( 'li' ).remove();
				}	
	
				
			}
	

		} );
		


	};


    uix_pb.portfolio = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );




/*!
 *************************************
 * 7. Grid
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {

		 $( '.uix-pb-col-last' ).each( function(){
			 
			 var $this     = $( this ),
				 activated = $this.data( 'activated' );//In order to avoid duplication of the running script with Uix Page Builder ( required )
			 
			 
			if ( typeof activated === typeof undefined || activated === 0 ) {

                $this.after( '<div class="uix-pb-clear"></div>' );

				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}
			 
		    
		 });	

	};


    uix_pb.grid = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );



/*!
 *************************************
 * 8. Image Slider
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {

	
		$( '[data-uix-pb-slideshow="1"]' ).each( function()  {

			 var $this     = $( this );

			$this.UixPBSlideshow({

				//Get parameter configuration from the data-* attribute of HTML
				auto              : $this.data( 'auto' ),
				timing            : $this.data( 'timing' ),
				loop              : $this.data( 'loop' ),
				countTotalID      : $this.data( 'count-total' ),
				countCurID        : $this.data( 'count-now' ),
				paginationID      : $this.data( 'controls-pagination' ),
				arrowsID          : $this.data( 'controls-arrows' ),
				draggable         : $this.data( 'draggable' ),
				draggableCursor   : $this.data( 'draggable-cursor' )
			});

		});	
	
		

	};


    uix_pb.slideshow = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );



/*!
 *************************************
 * 9. Custom Menu
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {
	
        var $window       = $( window ),
		    windowWidth   = $window.width(),
		    windowHeight  = $window.height(),
			menuContainer = 'ul.uix-pb-menu-fixed, ul.uix-pb-menu-embedded';
		
		uix_pb_customMenuInit( windowWidth );
		
		$window.on('resize', function() {
			windowWidth = $window.width();
			uix_pb_customMenuInit( windowWidth );
		});
		
		function uix_pb_customMenuInit( w ) {
			
			// Show Toolbar when viewing site
			if ( w <= 768 ){
				$window.on( 'scroll', function() {
					var scrollTop = $window.scrollTop();

					if ( scrollTop > 32 ) {
						$( menuContainer ).addClass( 'scrolling' );
					} else {
						$( menuContainer ).removeClass( 'scrolling' );
					}

				});
			} else {
				$window.on( 'scroll', function() {
					$( menuContainer ).removeClass( 'scrolling' );

				});
			}
			
		}
		

		
		//Mobile Trigger
		$( 'li.uix-pb-menu-mobile-icon' ).on( 'click', function( e ) {
			e.preventDefault();
			
			$( this ).closest( menuContainer ).toggleClass( 'responsive' );

		});
		


	};


    uix_pb.custommenu = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );



/*! 
 * ************************************
 * Invoking JavaScript code in an iframe from the parent page
 * --------------------------------
 * This is a method that joint back-end panel and front-end javascripts preview in real time.
 * This file is only used for front-end pages, and you can modify other names of JavaScript functions. 
 *
 * !!! Do not delete and modify this function "uix_pb_render_trigger()". !!!!
 *************************************
 */	
function uix_pb_render_trigger() {
	( function( $ ) {
	"use strict";
		$( document ).ready( function() {
			$.uix_pb_render();		
		} );

	} ) ( jQuery );
	
};


( function($) {
    'use strict';

	/* 
	 * Apply the original scripts of this plugin
	 * --------------------------------
	*/
	$.extend( { 
		uix_pb_init:function () {

			var scipts_pageLoaded    = uix_pb.components.pageLoaded,
				scipts_documentReady = uix_pb.components.documentReady;
			
			
			for ( var i = 0; i < scipts_pageLoaded.length; i++ ) {
			     scipts_pageLoaded[i]();
			}
			for ( var i = 0; i < scipts_documentReady.length; i++ ) {
			     scipts_documentReady[i]( $ );
			}	
	
			
		} 
	});
	
	/* 
	 * Reload the front-end javascripts to make the live preview take effect.   
	 * --------------------------------
	 * 
	 * This function can be used in your theme script.
	 * Usage: if ( $.isFunction( $.uix_pb_render ) ) { $.uix_pb_render( { action: function(){ ... } } ); }    
	 *
	*/
	$.extend({ 
		uix_pb_render:function ( options ) { 
		
			var settings=$.extend({
				"action": function(){
					
				},
			}
			,options);
		
			var backendPanel = $( '.uix-page-builder-visual-builder', window.parent.document ).length;

			if ( backendPanel > 0 ) {
				$.uix_pb_init();
				settings.action();
				
				//Compatible plugin: Uix Slideshow
				if ( $.isFunction( $.uixslideshow_default ) ) { 
					$.uixslideshow_default(); 
				}	
				if ( $.isFunction( $.uixslideshow_custom ) ) { 
					$.uixslideshow_custom(); 
				}	
				
				//Compatible plugin: Uix Products
				if ( $.isFunction( $.uixproducts_default ) ) { 
					$.uixproducts_default(); 
				}	
				if ( $.isFunction( $.uixproducts_custom ) ) { 
					$.uixproducts_custom(); 
				}				
				
				
				
			}
	
		   
	
		} 
	}); 
	
	
} ) ( jQuery );







/* 
 *************************************
 * Custom Slidershow for Uix Page Builder
 * @ Version 1.1 (July 30, 2020)
 *
 * @param  {Boolean} auto                  - Setup a slideshow for the slider to animate automatically.
 * @param  {Number} timing                 - Autoplay interval.
 * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
 * @param  {String} countTotalID           - Total number ID or class of counter.
 * @param  {String} countCurID             - Current number ID or class of counter.
 * @param  {String} paginationID           - Navigation ID for paging control of each slide.
 * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
 * @param  {Boolean} draggable             - Allow drag and drop on the slider.
 * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
 *
 *************************************
 */    
( function ( $ ) {
	'use strict';
    $.fn.UixPBSlideshow = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
			auto              : false,
            timing            : 10000,
			loop              : false,
            countTotalID      : 'p.count em.count',
            countCurID        : 'p.count em.current',
            paginationID      : '.uix-advanced-slider__pagination',
            arrowsID          : '.uix-advanced-slider__arrows',
            draggable         : false,
            draggableCursor   : 'move'
        }, options );
 
 
        this.each( function() {
			
			
            var $window                   = $( window ),
                windowWidth               = window.innerWidth,
                windowHeight              = window.innerHeight,
                animDelay                 = 0,
                $sliderWrapper            = $( this );


            sliderInit( false );

            $window.on( 'resize', function() {
                // Check window width has actually changed and it's not just iOS triggering a resize event on scroll
                if ( window.innerWidth != windowWidth ) {

                    // Update the window width for next time
                    windowWidth = window.innerWidth;

                    sliderInit( true );

                }
            });



            /*
             * Get the CSS animation/transition duration for a DOM element
             * Useful for matching CSS animations and JS events
             *
             * @private
             * @description This function can be used separately in HTML pages or custom JavaScript.
             * @param  {Object} el     - Target object, using class name or ID to locate.
             * @return {String|JSON}   - The value of property.
             */
            function getTransitionDuration( el ) {
                
                if ( typeof el === typeof undefined ) {
                    return 0;
                }


                var style    = window.getComputedStyle(el),
                    duration = style.webkitTransitionDuration,
                    delay    = style.webkitTransitionDelay;
                

                if ( typeof duration != typeof undefined ) {
                    // fix miliseconds vs seconds
                    duration = (duration.indexOf("ms")>-1) ? parseFloat(duration) : parseFloat(duration)*1000;
                    delay = (delay.indexOf("ms")>-1) ? parseFloat(delay) : parseFloat(delay)*1000;

                    return duration;
                } else {
                    return 0;
                }

            }   

           
        

            /*
             * Initialize slideshow
             *
             * @param  {Boolean} resize            - Determine whether the window size changes.
             * @return {Void}
             */
            function sliderInit( resize ) {

                $sliderWrapper.each( function()  {

                    var $this                    = $( this ),
                        $items                   = $this.find( '.uix-pb-slideshow__item' ),
                        $first                   = $items.first(),
                        nativeItemW,
                        nativeItemH,
                        activated                = $this.data( 'activated' ); 
				
				
                
                    if ( typeof activated === typeof undefined || activated === 0 ) {
                        
                        var dataAuto                = settings.auto, 
                            dataTiming              = settings.timing, 
                            dataLoop                = settings.loop, 
                            dataControlsPagination  = settings.paginationID, 
                            dataControlsArrows      = settings.arrowsID,
                            dataDraggable           = settings.draggable,
                            dataDraggableCursor     = settings.draggableCursor,                     
                            dataCountTotal          = settings.countTotalID,
                            dataCountCur            = settings.countCurID;    

                        
                        if ( typeof dataAuto === typeof undefined ) dataAuto = false;	
                        if ( typeof dataTiming === typeof undefined ) dataTiming = 10000;
                        if ( typeof dataLoop === typeof undefined ) dataLoop = false; 
                        if ( typeof dataControlsPagination === typeof undefined ) dataControlsPagination = '.uix-advanced-slider__pagination';
                        if ( typeof dataControlsArrows === typeof undefined || dataControlsArrows == false ) dataControlsArrows = '.uix-advanced-slider__arrows';
                        if ( typeof dataDraggable === typeof undefined ) dataDraggable = false;
                        if ( typeof dataDraggableCursor === typeof undefined || dataDraggableCursor == false ) dataDraggableCursor = 'move';
                        if ( typeof dataCountTotal === typeof undefined ) dataCountTotal = 'p.count em.count';
                        if ( typeof dataCountCur === typeof undefined ) dataCountCur = 'p.count em.current';      

                        
                        //Images loaded
                        //-------------------------------------	
                        var images = [];
                        $items.each( function()  {
                            var imgURL   = $( this ).find( 'img' ).attr( 'src' );
                            if ( typeof imgURL != typeof undefined ) {
                                images.push( imgURL );
                            }
                        });

                        loader( images, loadImage, function () {
                            $sliderWrapper.addClass( 'is-loaded' );
                        });	
                        
                        

                        //Autoplay times
                        var playTimes;
                        //A function called "timer" once every second (like a digital watch).
                        $this[0].animatedSlides;


                        setTimeout( function(){

                            //The speed of movement between elements.
                            // Avoid the error that getTransitionDuration takes 0
                            animDelay = getTransitionDuration( $first[0] );

                        }, 100 );  



                        //Initialize the first item container
                        //-------------------------------------		
                        $items.addClass( 'next' );
                        setTimeout( function() {
                            $first.addClass( 'is-active' );
                        }, animDelay );  


                        if ( $first.find( 'video' ).length > 0 ) {

                            //Returns the dimensions (intrinsic height and width ) of the video
                            var video    = document.getElementById( $first.find( 'video' ).attr( 'id' ) ),
                                videoURL = $first.find( 'source:first' ).attr( 'src' );
                          
                            if ( typeof videoURL === typeof undefined ) videoURL = $first.find( 'video' ).attr( 'src' );
                            $first.find( 'video' ).css({
                                'width': $this.width() + 'px'
                            });
                            

                            video.addEventListener( 'loadedmetadata', function( e ) {
                                $this.css( 'height', this.videoHeight*($this.width()/this.videoWidth) + 'px' );	

                                nativeItemW = this.videoWidth;
                                nativeItemH = this.videoHeight;	

                                //Initialize all the items to the stage
                                addItemsToStage( $this, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur );

                            }, false);	

                            video.src = videoURL;


                        } else {

                            var imgURL   = $first.find( 'img' ).attr( 'src' );

                            if ( typeof imgURL != typeof undefined ) {
                                var img = new Image();

                                img.onload = function() {
                                    $this.css( 'height', $this.width()*(this.height/this.width) + 'px' );		

                                    nativeItemW = this.width;
                                    nativeItemH = this.height;	

                                    //Initialize all the items to the stage
                                    addItemsToStage( $this, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur );

                                };

                                img.src = imgURL;
                            }



                        }	



                        //Autoplay Slider
                        //-------------------------------------		
                        if ( !resize ) {



                            if ( dataAuto && !isNaN( parseFloat( dataTiming ) ) && isFinite( dataTiming ) ) {

                                sliderAutoPlay( playTimes, dataTiming, dataLoop, $this, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows );

                                $this.on({
                                    mouseenter: function() {
                                        clearInterval( $this[0].animatedSlides );
                                    },
                                    mouseleave: function() {
                                        sliderAutoPlay( playTimes, dataTiming, dataLoop, $this, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows );
                                    }
                                });	

                            }


                        }   

                        //Prevents front-end javascripts that are activated with AJAX to repeat loading.
                        $this.data( 'activated', 1 );

                    }//endif activated
  
                    

                });


            }




            /*
             * Trigger slider autoplay
             *
             * @param  {Function} playTimes            - Number of times.
             * @param  {Number} timing                 - Autoplay interval.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @return {Void}                          - The constructor.
             */
            function sliderAutoPlay( playTimes, timing, loop, slider, countTotalID, countCurID, paginationID, arrowsID ) {	

                var items = slider.find( '.uix-pb-slideshow__item' ),
                    total = items.length;

                slider[0].animatedSlides = setInterval( function() {

                    playTimes = parseFloat( items.filter( '.is-active' ).index() );
                    playTimes++;


                    if ( !loop ) {
                        if ( playTimes < total && playTimes >= 0 ) sliderUpdates( playTimes, $sliderWrapper, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );
                    } else {
                        if ( playTimes == total ) playTimes = 0;
                        if ( playTimes < 0 ) playTimes = total-1;		
                        sliderUpdates( playTimes, $sliderWrapper, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );
                    }



                }, timing );	
            }




            /*
             * Initialize all the items to the stage
             *
             * @param  {Object} slider                 - Current selector of each slider.
             * @param  {Number} nativeItemW            - Returns the intrinsic width of the image/video.
             * @param  {Number} nativeItemH            - Returns the intrinsic height of the image/video.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop. 
             * @param  {Boolean} draggable             - Allow drag and drop on the slider.
             * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @return {Void}
             */
            function addItemsToStage( slider, nativeItemW, nativeItemH, paginationID, arrowsID, loop, draggable, draggableCursor, countTotalID, countCurID ) {

                var $this                    = slider,
                    $items                   = $this.find( '.uix-pb-slideshow__item' ),
                    $first                   = $items.first(),
                    itemsTotal               = $items.length;


                //If arrows does not exist on the page, it will be added by default, 
                //and the drag and drop function will be activated.
                if ( $( arrowsID ).length == 0 ) {
                    $( 'body' ).prepend( '<div style="display:none;" class="uix-pb-slideshow__arrows '+arrowsID.replace('#','').replace('.','')+'"><a href="#" class="uix-pb-slideshow__arrows--prev"></a><a href="#" class="uix-pb-slideshow__arrows--next"></a></div>' );
                }



                //Prevent bubbling
                if ( itemsTotal == 1 ) {
                    $( paginationID ).hide();
                    $( arrowsID ).hide();
                }
                
                
                //Add identifiers for the first and last items
                $items.last().addClass( 'last' );
                $items.first().addClass( 'first' );



                //Pagination dots 
                //-------------------------------------	
                var _dot       = '',
                    _dotActive = '';
                _dot += '<ul>';
                for ( var i = 0; i < itemsTotal; i++ ) {

                    _dotActive = ( i == 0 ) ? 'class="is-active"' : '';

                    _dot += '<li><a '+_dotActive+' data-normal="1" data-index="'+i+'" href="javascript:void(0)"></a></li>';
                }
                _dot += '</ul>';

                if ( $( paginationID ).html() == '' ) $( paginationID ).html( _dot );

                $( paginationID ).find( 'li a' ).off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    //Prevent buttons' events from firing multiple times
                    var $btn = $( this );
                    if ( $btn.attr( 'aria-disabled' ) == 'true' ) return false;
                    $( paginationID ).find( 'li a' ).attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        $( paginationID ).find( 'li a' ).attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    if ( !$( this ).hasClass( 'is-active' ) ) {


                        //Determine the direction
                        var curDir = 'prev';
                        if ( $( this ).attr( 'data-index' ) > parseFloat( $items.filter( '.is-active' ).index() ) ) {
                            curDir = 'next';
                        }


                        sliderUpdates( $( this ).attr( 'data-index' ), $this, curDir, countTotalID, countCurID, paginationID, arrowsID, loop );

                        //Pause the auto play event
                        clearInterval( $this[0].animatedSlides );	
                    }



                });

                //Next/Prev buttons
                //-------------------------------------		
                var _prev = $( arrowsID ).find( '.uix-pb-slideshow__arrows--prev' ),
                    _next = $( arrowsID ).find( '.uix-pb-slideshow__arrows--next' );

                $( arrowsID ).find( 'a' ).attr( {
					'href': 'javascript:void(0)',
					'data-normal': 1
				} );

                $( arrowsID ).find( 'a' ).removeClass( 'is-disabled' );
                if ( !loop ) {
                    _prev.addClass( 'is-disabled' );
                }


                _prev.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    //Prevent buttons' events from firing multiple times
                    if ( _prev.attr( 'aria-disabled' ) == 'true' ) return false;
                    _prev.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _prev.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) - 1, $this, 'prev', countTotalID, countCurID, paginationID, arrowsID, loop );

                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );

                });

                _next.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    
                    //Prevent buttons' events from firing multiple times
                    if ( _next.attr( 'aria-disabled' ) == 'true' ) return false;
                   _next.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _next.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) + 1, $this, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );


                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );


                });



                //Added touch method to mobile device and desktop
                //-------------------------------------	
                var $dragDropTrigger = $items;


                //Make the cursor a move icon when a user hovers over an item
                if ( draggable && draggableCursor != '' && draggableCursor != false ) $dragDropTrigger.css( 'cursor', draggableCursor );


                //Mouse event
                $dragDropTrigger.on( 'mousedown.UixPBSlideshow touchstart.UixPBSlideshow', function( e ) {

                    //Do not use "e.preventDefault()" to avoid prevention page scroll on drag in IOS and Android

                    var touches = e.originalEvent.touches;

                    $( this ).addClass( 'is-dragging' );


                    if ( touches && touches.length ) {	
                        $( this ).data( 'origin_mouse_x', parseInt( touches[0].pageX ) );
                        $( this ).data( 'origin_mouse_y', parseInt( touches[0].pageY ) );

                    } else {

                        if ( draggable ) {
                            $( this ).data( 'origin_mouse_x', parseInt( e.pageX ) );
                            $( this ).data( 'origin_mouse_y', parseInt( e.pageY ) );	
                        }


                    }

                    $dragDropTrigger.on( 'mouseup.UixPBSlideshow touchmove.UixPBSlideshow', function( e ) {


                        $( this ).removeClass( 'is-dragging' );
                        var touches        = e.originalEvent.touches,
                            origin_mouse_x = $( this ).data( 'origin_mouse_x' ),
                            origin_mouse_y = $( this ).data( 'origin_mouse_y' );

                        if ( touches && touches.length ) {

                            var deltaX = origin_mouse_x - touches[0].pageX,
                                deltaY = origin_mouse_y - touches[0].pageY;

                            //--- left
                            if ( deltaX >= 50) {
                                if ( $items.filter( '.is-active' ).index() < itemsTotal - 1 ) _next.trigger( 'click' );
                            }

                            //--- right
                            if ( deltaX <= -50) {
                                if ( $items.filter( '.is-active' ).index() > 0 ) _prev.trigger( 'click' );
                            }

                            //--- up
                            if ( deltaY >= 50) {


                            }

                            //--- down
                            if ( deltaY <= -50) {


                            }


                            if ( Math.abs( deltaX ) >= 50 || Math.abs( deltaY ) >= 50 ) {
                                $dragDropTrigger.off( 'touchmove.UixPBSlideshow' );
                            }	


                        } else {


                            if ( draggable ) {
                                //right
                                if ( e.pageX > origin_mouse_x ) {				
                                    if ( $items.filter( '.is-active' ).index() > 0 ) _prev.trigger( 'click' );
                                }

                                //left
                                if ( e.pageX < origin_mouse_x ) {
                                    if ( $items.filter( '.is-active' ).index() < itemsTotal - 1 ) _next.trigger( 'click' );
                                }

                                //down
                                if ( e.pageY > origin_mouse_y ) {

                                }

                                //up
                                if ( e.pageY < origin_mouse_y ) {

                                }	

                                $dragDropTrigger.off( 'mouseup.UixPBSlideshow' );

                            }	



                        }



                    } );//end: mouseup.UixPBSlideshow touchmove.UixPBSlideshow




                } );// end: mousedown.UixPBSlideshow touchstart.UixPBSlideshow

            }




            /*
             * Transition Between Slides
             *
             * @param  {Number} elementIndex           - Index of current slider.
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {String} dir                    - Switching direction indicator.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
             * @return {Void}
             */
            function sliderUpdates( elementIndex, slider, dir, countTotalID, countCurID, paginationID, arrowsID, loop ) {

                var $items                   = slider.find( '.uix-pb-slideshow__item' ),
                    total                    = $items.length;



                //Prevent bubbling
                if ( total == 1 ) {
                    $( paginationID ).hide();
                    $( arrowsID ).hide();
                    return false;
                }



                //Transition Interception
                //-------------------------------------
                if ( loop ) {
                    if ( elementIndex == total ) elementIndex = 0;
                    if ( elementIndex < 0 ) elementIndex = total-1;	
                } else {
                    $( arrowsID ).find( 'a' ).removeClass( 'is-disabled' );
                    if ( elementIndex == total - 1 ) $( arrowsID ).find( '.uix-pb-slideshow__arrows--next' ).addClass( 'is-disabled' );
                    if ( elementIndex == 0 ) $( arrowsID ).find( '.uix-pb-slideshow__arrows--prev' ).addClass( 'is-disabled' );
                }

                // To determine if it is a touch screen.
                var isTouchCapable = 'ontouchstart' in window ||
                                    window.DocumentTouch && document instanceof window.DocumentTouch ||
                                    navigator.maxTouchPoints > 0 ||
                                    window.navigator.msMaxTouchPoints > 0;  
                
                if ( isTouchCapable ) {
                    if ( elementIndex == total ) elementIndex = total-1;
                    if ( elementIndex < 0 ) elementIndex = 0;	

                    //Prevent bubbling
                    if ( !loop ) {
                        //first item
                        if ( elementIndex == 0 ) {
                            $( arrowsID ).find( '.uix-pb-slideshow__arrows--prev' ).addClass( 'is-disabled' );
                        }

                        //last item
                        if ( elementIndex == total - 1 ) {
                            $( arrowsID ).find( '.uix-pb-slideshow__arrows--next' ).addClass( 'is-disabled' );
                        }	
                    }


                }
				

				// call the current item
				//-------------------------------------
				var $current = $items.eq( elementIndex );	



                //Determine the direction and add class to switching direction indicator.
                var dirIndicatorClass = '';
                if ( dir == 'prev' ) dirIndicatorClass = 'prev';
                if ( dir == 'next' ) dirIndicatorClass = 'next';



                //Add transition class to Controls Pagination
                $( paginationID ).find( 'li a' ).removeClass( 'leave' );
                $( paginationID ).find( 'li a.is-active' ).removeClass( 'is-active' ).addClass( 'leave');
                $( paginationID ).find( 'li a[data-index="'+elementIndex+'"]' ).addClass( 'is-active').removeClass( 'leave' );

                //Add transition class to each item
                $items.removeClass( 'leave prev next' );
                $items.addClass( dirIndicatorClass );
                slider.find( '.uix-pb-slideshow__item.is-active' ).removeClass( 'is-active' ).addClass( 'leave ' + dirIndicatorClass );
                $items.eq( elementIndex ).addClass( 'is-active ' + dirIndicatorClass ).removeClass( 'leave' );




                //Display counter
                //-------------------------------------
                $( countTotalID ).text( total );
                $( countCurID ).text( parseFloat( elementIndex ) + 1 );		


                //Reset the default height of item
                //-------------------------------------	
                itemDefaultInit( slider, $current );		



            }

            /*
             * Initialize the default height of item
             *
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {Object} currentLlement         - Current selector of each slider.
             * @return {Void}
             */
            function itemDefaultInit( slider, currentLlement ) {

                if ( currentLlement.find( 'video' ).length > 0 ) {

                    //Returns the dimensions (intrinsic height and width ) of the video
                    var video    = document.getElementById( currentLlement.find( 'video' ).attr( 'id' ) ),
                        videoURL = currentLlement.find( 'source:first' ).attr( 'src' );
                    
                    if ( typeof videoURL === typeof undefined ) videoURL = currentLlement.find( 'video' ).attr( 'src' );

                    currentLlement.find( 'video' ).css({
                        'width': currentLlement.closest( '.uix-pb-slideshow__outline' ).width() + 'px'
                    });   
                    
                    
                    video.addEventListener( 'loadedmetadata', function( e ) {

                        slider.css( 'height', this.videoHeight*(currentLlement.closest( '.uix-pb-slideshow__outline' ).width()/this.videoWidth) + 'px' );	

                    }, false);	

                    video.src = videoURL;


                } else {

                    var imgURL   = currentLlement.find( 'img' ).attr( 'src' );


                    if ( typeof imgURL != typeof undefined ) {
                        var img = new Image();

                        img.onload = function() {

                            slider.css( 'height', currentLlement.closest( '.uix-pb-slideshow__outline' ).width()*(this.height/this.width) + 'px' );		

                        };

                        img.src = imgURL;	
                    }



                }	


            }

            // loader will 'load' items by calling thingToDo for each item,
            // before calling allDone when all the things to do have been done.
            function loader(items, thingToDo, allDone) {
                if (!items) {
                    // nothing to do.
                    return;
                }

                if ("undefined" === items.length) {
                    // convert single item to array.
                    items = [items];
                }

                var count = items.length;

                // this callback counts down the things to do.
                var thingToDoCompleted = function (items, i) {
                    count--;
                    if (0 == count) {
                        allDone(items);
                    }
                };

                for (var i = 0; i < items.length; i++) {
                    // 'do' each thing, and await callback.
                    thingToDo(items, i, thingToDoCompleted);
                }
            }

            function loadImage(items, i, onComplete) {
                var onLoad = function (e) {
                    e.target.removeEventListener("load", onLoad);

                    // this next line can be removed.
                    // only here to prove the image was loaded.
                    document.body.appendChild(e.target);

                    // notify that we're done.
                    onComplete(items, i);
                }
                var img = new Image();
                img.addEventListener("load", onLoad, false);
                img.src = items[i];
                img.style.display = 'none';
            }	

		});
 
    };
 
}( jQuery ));





/* 
 *************************************
 * Custom Hybrid Content Slider for Uix Page Builder
 * @ Version 1.1 (July 30, 2020)
 *
 * @param  {String} dir                    - Switching direction. The value is horizontal/vertical.
 * @param  {Boolean} auto                  - Setup a slideshow for the slider to animate automatically.
 * @param  {Number} timing                 - Autoplay interval.
 * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
 * @param  {Number} speed                  - Delay Between items.
 * @param  {String} nextID                 - Next arrow navigation ID.
 * @param  {String} prevID                 - Previous arrow navigation ID.
 * @param  {String} paginationID           - Navigation ID for paging control of each slide.
 * @param  {Boolean} draggable             - Allow drag and drop on the slider.
 * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
 *
 *************************************
 */    
( function ( $ ) {
	'use strict';
    $.fn.UixPBHybridContentSlider = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
			dir               : 'horizontal',   //horizontal,vertical
			auto              : false,
            timing            : 10000,
			speed             : 550,
			loop              : false,
            nextID            : '#uix-pb-hybridcontent-slider__controls-5 .uix-pb-hybridcontent-slider__controls--next',
            prevID             : '#uix-pb-hybridcontent-slider__controls-5 .uix-pb-hybridcontent-slider__controls--prev',
            paginationID      : '#uix-pb-hybridcontent-slider__pagination-5',
            draggable         : false,
            draggableCursor   : 'move'
        }, options );
 
 
        this.each( function() {
			
			
            var $window                   = $( window ),
                windowWidth               = window.innerWidth,
                windowHeight              = window.innerHeight,
                animDelay                 = 0,
                $sliderWrapper            = $( this );

			
			var	$carouselWrapper,
				$carousel,
				$carouselItem,
				itemTotal,
				amountVisible,
				carouselDir,
				carouselSpeed,
				carouselNext,
				carouselPrev,
				carouselPagination,
				carouseDraggable,
				carouseDraggableCursor,
				dataAuto,
				dataTiming,
				dataLoop;

			//each item width and height
			var eachItemNewWidth, eachItemNewHeight = [];


			//Store the latest position (X,Y) in a temporary variable
			var tempItemsPos = [];
			

			//Autoplay times
			var playTimes;
			

			//Returns the total height of items
			var totalItemsHeight = 0;


            sliderInit( false );

            $window.on( 'resize', function() {
                // Check window width has actually changed and it's not just iOS triggering a resize event on scroll
                if ( window.innerWidth != windowWidth ) {

                    // Update the window width for next time
                    windowWidth = window.innerWidth;

                    sliderInit( true );

                }
            });

        

            /*
             * Initialize slideshow
             *
             * @param  {Boolean} resize            - Determine whether the window size changes.
             * @return {Void}
             */
            function sliderInit( resize ) {

                $sliderWrapper.each( function()  {
					
					
					$carouselWrapper        = $( this );
					var	activated           = $carouselWrapper.data( 'activated' ); 



					if ( typeof activated === typeof undefined || activated === 0 ) {


						$carousel               = $carouselWrapper.find( '.uix-pb-hybridcontent-slider__items' );
						$carouselItem           = $carouselWrapper.find( '.uix-pb-hybridcontent-slider__items > div' );
						itemTotal               = $carouselItem.length;
						amountVisible           = 1;
						carouselDir             = settings.dir;
						carouselSpeed           = settings.speed;
						carouselNext            = settings.nextID;
						carouselPrev            = settings.prevID;
						carouselPagination      = settings.paginationID;
						carouseDraggable        = settings.draggable;
						carouseDraggableCursor  = settings.draggableCursor;



						if ( typeof carouselDir === typeof undefined ) carouselDir = 'horizontal';
						if ( typeof carouselSpeed === typeof undefined ) carouselSpeed = 250;
						if ( typeof carouselNext === typeof undefined ) carouselNext = '#uix-pb-hybridcontent-slider__controls-123 .uix-pb-hybridcontent-slider__controls--next';
						if ( typeof carouselPrev === typeof undefined ) carouselPrev = '#uix-pb-hybridcontent-slider__controls-123 .uix-pb-hybridcontent-slider__controls--prev';
						if ( typeof carouselPagination === typeof undefined ) carouselPagination = '#uix-pb-hybridcontent-slider__pagination-123';
						if ( typeof carouseDraggable === typeof undefined ) carouseDraggable = false;
						if ( typeof carouseDraggableCursor === typeof undefined ) carouseDraggableCursor = 'move';


						//Autoplay parameters
						dataAuto                   = settings.auto;
						dataTiming                 = settings.timing;
						dataLoop                   = settings.loop;

						if ( typeof dataAuto === typeof undefined ) dataAuto = false;	
						if ( typeof dataTiming === typeof undefined ) dataTiming = 10000;
						if ( typeof dataLoop === typeof undefined ) dataLoop = false; 


						//set speed for dom
						$carousel.css('transition', 'all '+carouselSpeed+'ms');	
						$carouselItem.css('transition', 'all '+carouselSpeed+'ms');
						
						
						
						//A function called "timer" once every second (like a digital watch).
						$carouselWrapper[0].animatedSlides;




						// Get the width and height of each item
						$carouselItem.each( function( index ) {
							var _height = $( this ).height();
							
							eachItemNewHeight.push( _height );
							$( this ).attr({
								'data-height': _height,
								'data-index': index
							});
						});


						//Returns the total height of items
						for (var i = 0; i < eachItemNewHeight.length; i++ ) {
							totalItemsHeight += eachItemNewHeight[i];
							if ( (i+1) == (itemTotal - amountVisible) ) break;
						}

						//Set target index of the carousel buttons
						setButtonTargetIndex( $( carouselNext ), $( carouselPrev ), 'init', null );



						//set actived item & initialize the height of container
						setContainerSize( 0 );    
						$carouselItem.addClass( 'js-is-ready' ); 


						// Activate the current item from carouse
						setItemState( 0 );    


						/* 
						 ---------------------------
						 Initialize carousel
						 ---------------------------
						 */  
						var eachItemOldWidth  = $carousel.width()/amountVisible;

						eachItemNewWidth = ( $carouselWrapper.width() / amountVisible );

						if ( carouselDir == 'horizontal' ) {
							$carousel.css( 'width', itemTotal * eachItemOldWidth );
						}


						// Re-order all items
						carouselReOrder();



						//default button status
						$( carouselPrev ).addClass( 'is-disabled' ).data( 'disabled', 1 );	



						/* 
						 ---------------------------
						 Move left/up
						 ---------------------------
						 */ 
						$( carouselNext ).off( 'click' ).on( 'click', $carouselWrapper, function( e ) {
							e.preventDefault();

							//Prevent buttons' events from firing multiple times
							if ( $( this ).attr( 'aria-disabled' ) == 'true' ) return false;
							$( this ).attr( 'aria-disabled', 'true' );

							$( this )
								.delay(carouselSpeed)
								.queue(function(next) { $( this ).attr( 'aria-disabled', 'false' ); next(); });                

							//
							movePositionWithButton( false, $( this ), e, 'next' );

							//Pause the auto play event
							clearInterval( $carouselWrapper[0].animatedSlides );	 


						});


						/* 
						 ---------------------------
						 Move right/down
						 ---------------------------
						 */ 

						$( carouselPrev ).off( 'click' ).on( 'click', $carouselWrapper, function( e ) {
							e.preventDefault();

							//Prevent buttons' events from firing multiple times
							if ( $( this ).attr( 'aria-disabled' ) == 'true' ) return false;
							$( this ).attr( 'aria-disabled', 'true' );

							$( this )
								.delay(carouselSpeed)
								.queue(function(next) { $( this ).attr( 'aria-disabled', 'false' ); next(); });

							//
							movePositionWithButton( false, $( this ), e, 'prev' );

							//Pause the auto play event
							clearInterval( $carouselWrapper[0].animatedSlides );

						});


						/* 
						 ---------------------------
						 Pagination
						 ---------------------------
						 */ 
						if ( $( carouselPagination ).length > 0 && $( carouselPagination ).html().length == 0 ) {
							//Button to add pagination automatically
							var _dot       = '';
							_dot += '<ul class="uix-pb-hybridcontent-slider__pagination--default">';
							for ( var i = 0; i < itemTotal; i++ ) {
								_dot += '<li><a data-normal="1" data-target-index="'+i+'" href="javascript:void(0);"></a></li>';
							}
							_dot += '</ul>';

							$( carouselPagination ).html( _dot ).promise().done( function(){
								// Activate the currently selected Pagination
								setPaginationState( 0 );
							});	
						} else {
							// Activate the currently selected Pagination
							setPaginationState( 0 ); 
						}


						$( carouselPagination ).find( 'li a' ).off( 'click' ).on( 'click', $carouselWrapper, function( e ) {
							e.preventDefault();

							//Prevent buttons' events from firing multiple times
							if ( $( this ).attr( 'aria-disabled' ) == 'true' ) return false;
							$( carouselPagination ).find( 'li a' ).attr( 'aria-disabled', 'true' );

							$( carouselPagination ).find( 'li a' )
								.delay(carouselSpeed)
								.queue(function(next) { $( carouselPagination ).find( 'li a' ).attr( 'aria-disabled', 'false' ); next(); }); 


							//
							if ( !$( this ).parent().hasClass( 'is-active' ) ) {

								movePositionWithButton( true, $( this ), e, 'next' );

								//Pause the auto play event
								clearInterval( $carouselWrapper[0].animatedSlides );	
							}

						});		


						
						
						

						//Added touch method to mobile device and desktop
						//-------------------------------------	
						var $dragDropTrigger = $carouselWrapper;


						//Make the cursor a move icon when a user hovers over an item
						if ( carouseDraggable && carouseDraggableCursor != '' && carouseDraggableCursor != false ) $dragDropTrigger.css( 'cursor', carouseDraggableCursor );



						var direction;

			
						//Mouse event
						$dragDropTrigger.on( 'mousedown.UixPBHybridContentSlider touchstart.UixPBHybridContentSlider', function( e ) {

							//Do not use "e.preventDefault()" to avoid prevention page scroll on drag in IOS and Android

							var touches = e.originalEvent.touches;

							$( this ).addClass( 'is-dragging' );


							if ( touches && touches.length ) {	
								$( this ).data( 'origin_mouse_x', parseInt( touches[0].pageX ) );
								$( this ).data( 'origin_mouse_y', parseInt( touches[0].pageY ) );

							} else {

								if ( carouseDraggable ) {
									$( this ).data( 'origin_mouse_x', parseInt( e.pageX ) );
									$( this ).data( 'origin_mouse_y', parseInt( e.pageY ) );	
								}


							}

							$dragDropTrigger.on( 'mouseup.UixPBHybridContentSlider touchmove.UixPBHybridContentSlider', function( e ) {


								$( this ).removeClass( 'is-dragging' );
								var touches        = e.originalEvent.touches,
									origin_mouse_x = $( this ).data( 'origin_mouse_x' ),
									origin_mouse_y = $( this ).data( 'origin_mouse_y' );

								if ( touches && touches.length ) {

									var deltaX = origin_mouse_x - touches[0].pageX,
										deltaY = origin_mouse_y - touches[0].pageY;




									if ( carouselDir == 'horizontal' ) {
										//--- left
										if ( deltaX >= 50) {
											direction = 'panleft';
										}

										//--- right
										if ( deltaX <= -50) {
											direction = 'panright';
										}
									} else {
										//--- up
										if ( deltaY >= 50) {
											direction = 'panup';
										}

										//--- down
										if ( deltaY <= -50) {
											direction = 'pandown';
										}
									}



									if ( Math.abs( deltaX ) >= 50 || Math.abs( deltaY ) >= 50 ) {
										$dragDropTrigger.off( 'touchmove.UixPBHybridContentSlider' );
									}	




								} else {


									if ( carouseDraggable ) {
										
										

										if ( carouselDir == 'horizontal' ) {
											//right
											if ( e.pageX > origin_mouse_x ) {				
												direction = 'panright';
											}

											//left
											if ( e.pageX < origin_mouse_x ) {
												direction = 'panleft';
											}
	
										} else {
											//down
											if ( e.pageY > origin_mouse_y ) {
												direction = 'pandown';
											}

											//up
											if ( e.pageY < origin_mouse_y ) {
												direction = 'panup';
											}	
										}	

										


										$dragDropTrigger.off( 'mouseup.UixPBHybridContentSlider' );

									}	



								}
								
								


								//===============
								//===============
								switch ( direction ) {
									case 'panleft':
									case 'panup':

										$( carouselNext ).trigger( 'click' );

										break;

									case 'panright':
									case 'pandown':

										$( carouselPrev ).trigger( 'click' );

										break;                 

								}

							
								//Pause the auto play event
								clearInterval( $carouselWrapper[0].animatedSlides );



							} );//end: mouseup.UixPBHybridContentSlider touchmove.UixPBHybridContentSlider




						} );// end: mousedown.UixPBHybridContentSlider touchstart.UixPBHybridContentSlider


						
						
						
						
						

						//Autoplay Slider
						//-------------------------------------		
						if ( dataAuto && !isNaN( parseFloat( dataTiming ) ) && isFinite( dataTiming ) ) {

							sliderAutoPlay( playTimes, dataTiming, dataLoop );

							$carouselWrapper.on({
								mouseenter: function() {
									clearInterval( $carouselWrapper[0].animatedSlides );
								},
								mouseleave: function() {
									sliderAutoPlay( playTimes, dataTiming, dataLoop );
								}
							});	

						}





						//Prevents front-end javascripts that are activated with AJAX to repeat loading.
						$carouselWrapper.data( 'activated', 1 );

					}//endif activated	


	
					
					
					
				});


            }



			/* 
			 ---------------------------
			 Re-order all items
			 ---------------------------
			 */ 

			function carouselReOrder() {


				//Initialize the width and height of each item
				if ( carouselDir == 'horizontal' ) {
					var boxWidth = eachItemNewWidth;
				
					$carouselItem.each( function( i )  {
						$( this ).css({
							'width': boxWidth + 'px',
							'height': eachItemNewHeight[i] + 'px',
							'transform': 'translateX( '+(i * boxWidth)+'px )'
						});
					});
				

				} else {
					
					$carouselItem.each( function( i )  {
						
						var yIncrement = 0;
						for (var k = 0; k < eachItemNewHeight.length; k++ ) {    
							var tempY = ( typeof eachItemNewHeight[k-1] === typeof undefined ) ? 0 : eachItemNewHeight[k-1];
							yIncrement += tempY;
							if ( k == i ) break;
						}   

						$( this ).css({
							'height': eachItemNewHeight[i] + 'px',
							'transform': 'translateY( '+yIncrement+'px )'
						});
					});
					

				}


			}




			/*
			 * Trigger slider autoplay
			 *
			 * @param  {Function} playTimes      - Number of times.
			 * @param  {Number} timing           - Autoplay interval.
			 * @param  {Boolean} loop            - Gives the slider a seamless infinite loop.
			 * @return {Void}             
			 */
			function sliderAutoPlay( playTimes, timing, loop ) {	

				$carouselWrapper[0].animatedSlides = setInterval( function() {

					var autoMove = function( indexGo ) {

						// Retrieve the position (X,Y) of an element 
						var moveX = eachItemNewWidth * indexGo;

						var moveYIncrement = 0;
						for (var k = 0; k < eachItemNewHeight.length; k++ ) {    
							var tempY = ( typeof eachItemNewHeight[k-1] === typeof undefined ) ? 0 : eachItemNewHeight[k-1];
							moveYIncrement += tempY;
							if ( k == indexGo ) break;
						}
						var moveY = moveYIncrement;

						//
						var delta = ( carouselDir == 'horizontal' ) ? -moveX : -moveY;

						//
						itemUpdates( $carouselWrapper, 'auto', delta, null, false, indexGo, eachItemNewHeight );    
					}; 

					playTimes = parseFloat( $carouselItem.filter( '.is-active' ).index() );
					playTimes++;


					if ( !loop ) {
						if ( playTimes < itemTotal && playTimes >= 0 ) {
							autoMove( playTimes );
						}
					} else {
						if ( playTimes == itemTotal ) playTimes = 0;
						if ( playTimes < 0 ) playTimes = itemTotal-1;		

						autoMove( playTimes );
					}

				}, timing );	
			}




			/*
			 * Transition Between Items
			 *
			 * @param  {Element} wrapper            - Wrapper of carousel.
			 * @param  {?Element|String} curBtn     - The button that currently triggers the move.
			 * @param  {Number|Array} delta         - The value returned will need to be adjusted according to the offset rate.
			 * @param  {?Number} speed              - Sliding speed. Please set to 0 when rebounding.
			 * @param  {Boolean} dragging           - Determine if the object is being dragged.
			 * @param  {!Number} indexGo            - The target item index.
			 * @param  {String|Array} itemsHeight   - Return all items height.
			 * @return {Void}
			 */
			function itemUpdates( wrapper, curBtn, delta, speed, dragging, indexGo, itemsHeight ) {

				if ( speed == null ) speed = carouselSpeed/1000;

				var $curWrapper = wrapper.children( '.uix-pb-hybridcontent-slider__items' ),  //Default: $carousel
					$curItems   = $curWrapper.find( '> div' ); //Default: $carouselItem


				//Get height constant
				var itemsHeightArr = [];
				var _itemsHeight = itemsHeight.toString().split( ',' );
				_itemsHeight.forEach( function( element ) {
					itemsHeightArr.push( parseFloat(element) );
				});


				//Check next or previous event
				var btnType = 'init';
				if ( curBtn != null && curBtn != 'auto' ) {
					if ( typeof curBtn.attr( 'class' ) !== typeof undefined ) {
						btnType = ( curBtn.attr( 'class' ).indexOf( '--next' ) >=0 ) ? 'next' : 'prev';
					} else {
						btnType = 'next';
					}

				}

				//Check next or previous event ( Autoplay )
				if ( curBtn == 'auto' ) btnType = 'next';;


				//Clone the first element to the last position
				if ( carouselDir == 'horizontal' ) {

					var boxWidth = eachItemNewWidth;

					
					$curItems.each( function( i )  {
						
						var xIncrement = 0;

						for (var k = 0; k < itemTotal; k++ ) {    
							var tempX = ( k == 0 ) ? 0 : boxWidth;
							xIncrement += tempX;
							if ( k == i ) break;
						}   



						if ( Array.isArray( delta ) ) {

							//Rebound effect of drag offset 
							xIncrement = ( delta.length == 0 ) ? xIncrement : delta[i];     

						} else {

							if ( !dragging ) {
								//console.log( 'btnType: ' + btnType + ' indexGo: ' + indexGo );


								var curWidthIncrement = 0;

								for (var m= 0; m < itemTotal; m++ ) {    
									var tempW = ( m == 0 ) ? 0 : boxWidth;
									curWidthIncrement += tempW;
									if ( m == ( btnType == 'next' ? indexGo : indexGo-1 ) ) break;
								} 

								xIncrement = xIncrement + -curWidthIncrement;  
							} else {
								//console.log( 'dragging...' );
								var x = Math.round(getTranslate(target ) / boxWidth ) * boxWidth;
								xIncrement = x + delta; 
							}
						}

						
						//--
						$( this ).css({
							'transform': 'translateX( '+xIncrement+'px )'
						});
						
						//--
						setTimeout( function() {
							
							if ( !dragging && !Array.isArray( delta ) ) {

								//Get index of current element
								var currentIndex = 0;
								
						

								//The state of the control button
								setButtonState( Math.round( getTranslate($curItems.first()[0] ) ), Math.round( ($curItems.length - amountVisible) * boxWidth ) );  

								//Initialize the height of container
								currentIndex = Math.round( getTranslate($curItems.first()[0] )/boxWidth );
								setContainerSize( currentIndex );  	 

								//Set target index of the carousel buttons
								setButtonTargetIndex( $( carouselNext ), $( carouselPrev ), btnType, ( btnType == 'next' ? Math.abs( currentIndex ) : Math.abs( currentIndex ) + 1 ) );   

								// Activate the currently selected Pagination
								setPaginationState( Math.abs( currentIndex ) );

								// Activate the current item from carouse
								setItemState( Math.abs( currentIndex ) );     

								//Store the latest position (X,Y) in a temporary variable
								tempItemsPos = createStoreLatestPosition();  

							}
						}, speed);	
						
					});


				} else {

					
					$curItems.each( function( i )  {
						
						var yIncrement = 0;

						for (var k = 0; k < itemsHeightArr.length; k++ ) {    
							var tempY = ( typeof itemsHeightArr[k-1] === typeof undefined ) ? 0 : itemsHeightArr[k-1];
							yIncrement += tempY;
							if ( k == i ) break;
						}  

						if ( Array.isArray( delta ) ) {

							//Rebound effect of drag offset 
							yIncrement =  ( delta.length == 0 ) ? yIncrement : delta[i];   

						} else {

							if ( !dragging ) {
								//console.log( 'btnType: ' + btnType + ' indexGo: ' + indexGo );


								var curHeightIncrement = 0;

								for (var m = 0; m < itemsHeightArr.length; m++ ) {    
									var tempH = ( typeof itemsHeightArr[m-1] === typeof undefined ) ? 0 : itemsHeightArr[m-1];
									curHeightIncrement += tempH;
									if ( m == ( btnType == 'next' ? indexGo : indexGo-1 ) ) break;
								}   


								yIncrement =  yIncrement + -curHeightIncrement;  
							} else {
								//console.log( 'dragging...' );
								var draggingItemHeight = ( typeof itemsHeightArr[indexGo-1] === typeof undefined ) ? itemsHeightArr[indexGo] : itemsHeightArr[indexGo-1];

								var y = Math.round(getTranslate(target ) / draggingItemHeight ) * draggingItemHeight;
								yIncrement =  y + delta; 
							}
						}

						
						//--
						$( this ).css({
							'transform': 'translateY( '+yIncrement+'px )'
						});
						
						//--
						setTimeout( function() {
							
							if ( !dragging && !Array.isArray( delta ) ) {

								//The state of the control button
								setButtonState( getTranslate($curItems.first()[0] ), totalItemsHeight );   

								//Set target index of the carousel buttons
								setButtonTargetIndex( $( carouselNext ), $( carouselPrev ), btnType, indexGo ); 

								//set actived item & initialize the height of container
								setContainerSize( ( btnType == 'next' ? indexGo : indexGo-1 ) );

								// Activate the currently selected Pagination
								setPaginationState( ( btnType == 'next' ? indexGo : indexGo-1 ) ); 

								// Activate the current item from carouse
								setItemState( ( btnType == 'next' ? indexGo : indexGo-1 ) );               

								//Store the latest position (X,Y) in a temporary variable
								tempItemsPos = createStoreLatestPosition();   


							}
		
						}, speed);	
						
					});
					
					
		
				}




			}



			/*
			 * Use the button to trigger the transition between the two sliders
			 *
			 * @param  {Boolean} paginationEnable   - Determine whether it is triggered by pagination
			 * @param  {Element} $btn               - The button that currently triggers the move.
			 * @param  {Object} event               - Bind an event handler to the "click" JavaScript event,
			 * @param  {String} type                - Move next or previous.
			 * @return {Void}
			 */
			function movePositionWithButton( paginationEnable, $btn, event, type ) {
				var $curWrapper = $( event.data[0] ),
					  //Protection button is not triggered multiple times.
					  btnDisabled = $btn.data( 'disabled' ),

					  //Get current button index
					  tIndex      = parseFloat( $btn.attr( 'data-target-index' ) );


				// Retrieve the position (X,Y) of an element 
				var moveX = eachItemNewWidth,
					moveY = ( typeof eachItemNewHeight[tIndex-1] === typeof undefined ) ? 0 : eachItemNewHeight[tIndex-1];   

				if ( paginationEnable ) {

					//--
					moveX = eachItemNewWidth * tIndex;

					//--
					var moveYIncrement = 0;
					for (var k = 0; k < eachItemNewHeight.length; k++ ) {    
						var tempY = ( typeof eachItemNewHeight[k-1] === typeof undefined ) ? 0 : eachItemNewHeight[k-1];
						moveYIncrement += tempY;
						if ( k == tIndex ) break;
					}
					moveY = moveYIncrement;

				}



				//
				var delta;
				if ( type == 'next' ) {
					delta = ( carouselDir == 'horizontal' ) ? -moveX : -moveY;
				} else {
					delta = ( carouselDir == 'horizontal' ) ? moveX : moveY;
				}


				if ( typeof btnDisabled === typeof undefined ) {	
					itemUpdates( $curWrapper, $btn, delta, null, false, tIndex, eachItemNewHeight );

				}    
			}  



			/*
			 * Activate the currently selected Pagination
			 *
			 * @param  {Number} index          - Get index of current element.
			 * @return {Void}
			 */
			function setPaginationState( index ) {
				$( carouselPagination ).find( 'li' ).removeClass( 'is-active' );
				$( carouselPagination ).find( 'li a[data-target-index="'+index+'"]' ).parent().addClass( 'is-active' );   
			}   

			/*
			 * Activate the current item from carouse
			 *
			 * @param  {Number} index          - Get index of current element.
			 * @return {Void}
			 */
			function setItemState( index ) {
				$carouselItem.removeClass( 'is-active' );
				$carouselItem.eq( index ).addClass( 'is-active' );   
			}      

			/*
			 * Store the latest position (X,Y) in a temporary variable
			 *
			 * @return {Array}              - Return to a new position.
			 */
			function createStoreLatestPosition() {
				var pos = [];
				// Retrieve the temporary variable of each item.
				$carouselItem.each( function() {
					pos.push( ( carouselDir == 'horizontal' ? getTranslate($( this )[0] ) : getTranslate($( this )[0] ) ) );
				}); 
				return pos;
			}  


			/*
			 * Initialize the height of container
			 *
			 * @param  {Number} index          - Get index of current element.
			 * @return {Void}
			 */
			function setContainerSize( index ) {
				
				var _h = eachItemNewHeight[Math.abs( index )];
				if ( typeof _h !== typeof undefined ) {
					$carousel.css( 'height', eachItemNewHeight[Math.abs( index )] + 'px' );
					   
				}

			}   




			/*
			 * Set target index of the carousel buttons
			 *
			 * @param  {Element} nextBtn      - The next move button.
			 * @param  {Element} prevBtn      - The previous move button.
			 * @param  {String} type          - The type of button is triggered. Values: next, prev, init
			 * @param  {?Number} indexGo      - The target item index.
			 * @return {Void}
			 */
			function setButtonTargetIndex( nextBtn, prevBtn, type, indexGo ) {

				switch ( type ) {
					case 'init':
						nextBtn.attr({
							'data-target-index': 1
						});   
						prevBtn.attr({
							'data-target-index': 0
						});   

						break;

					case 'next':
						var nextBtnOldTargetIndex1 = parseFloat( nextBtn.attr( 'data-target-index' ) );
						var prevBtnOldTargetIndex1 = parseFloat( prevBtn.attr( 'data-target-index' ) );

						if ( indexGo != null ) {
							nextBtnOldTargetIndex1 = indexGo;
							prevBtnOldTargetIndex1 = indexGo-1;
						}

						nextBtn.attr({
							'data-target-index': nextBtnOldTargetIndex1+1
						});   
						prevBtn.attr({
							'data-target-index': prevBtnOldTargetIndex1+1
						});  

						break;  

					case 'prev':
						var nextBtnOldTargetIndex2 = parseFloat( nextBtn.attr( 'data-target-index' ) ) - 1;
						var prevBtnOldTargetIndex2 = parseFloat( prevBtn.attr( 'data-target-index' ) ) - 1;

						if ( indexGo != null ) {
							nextBtnOldTargetIndex2 = indexGo;
							prevBtnOldTargetIndex2 = indexGo-1;
						} 


						nextBtn.attr({
							'data-target-index': nextBtnOldTargetIndex2
						});   
						prevBtn.attr({
							'data-target-index': prevBtnOldTargetIndex2
						});   

						break;  
				}      
			}              

			/*
			 * The state of the control button
			 *
			 * @param  {Number} firstOffset          - Get the computed Translate X or Y values of a given first DOM element.
			 * @param  {Number} lastOffset           - Get the computed Translate X or Y values of a given last DOM element.
			 * @return {Void}
			 */
			function setButtonState( firstOffset, lastOffset ) {

				if ( Math.abs( firstOffset ) == lastOffset ) {
					$( carouselNext ).addClass( 'is-disabled' ).data( 'disabled', 1 );
					$( carouselPrev ).removeClass( 'is-disabled' ).removeData( 'disabled' );
				} else if ( Math.round( firstOffset ) == 0 ) {
					$( carouselNext ).removeClass( 'is-disabled' ).removeData( 'disabled' );
					$( carouselPrev ).addClass( 'is-disabled' ).data( 'disabled', 1 );
				} else {
					$( carouselNext ).removeClass( 'is-disabled' ).removeData( 'disabled' );
					$( carouselPrev ).removeClass( 'is-disabled' ).removeData( 'disabled' );
				}
			}   	
			

			

			/*
			 * Get transform value
			 *
			 * @param  {Number} node           - Dom node selector
			 * @return {Void}
			 */
			function getTranslate(node){
				var transformStyle = node.style.transform;
				// => "translateX(1239.32px)"
				
				var translateXorY = transformStyle.replace(/[^\d.]/g, '');
				return translateXorY;
			}
			
			


		});
 
    };
 
}( jQuery ));




