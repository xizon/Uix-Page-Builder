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
	6. Filterable
	7. Grid
	
	


************************************* */

var templateUrl = wp_theme_root_path.templateUrl;

var uix_pb = (function ( $, window, document ) {
    'use strict';

    var uix_pb         = {},
        components    = { documentReady: [], pageLoaded: [] };

	if( $.isFunction( $.fn.waitForImages ) ){
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

		});


		$( '.uix-pb-bar-box-circular' ).each(function() {

			var $this      = $( this ),
				perc       = $( '.uix-pb-bar', this).data( 'percent' ),
				size       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
				sizeNum    = parseFloat( size ),
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

        $( '.uix-pb-bar-box-circular' ).each(function() {

			if ( $( '.uix-pb-bar .uix-pb-bar-percent', this ).text().length == 0 ) {

				var $this      = $( this ),
					perc       = $( '.uix-pb-bar', this).data( 'percent' ),
					size       = $( '.uix-pb-bar .uix-pb-bar-percent', this).data( 'size' ),
					sizeNum    = parseFloat( size ),
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
					priceBGH         = Array(),
					priceBGH_excerpt = Array(),
					$initHeight      = $this.find( '.uix-pb-price-init-height' );

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


		});

		//Border of the hover effect
		$( '.uix-pb-price-border-hover' ).each( function(){

			var $this        = $( this ),
				hw           = 6,
			    defaultColor = $this.find( '.uix-pb-price-border' ).css( 'border-color' );

			if ( $this.css( 'top' ) != '0px' ) {

				$this.hover(function() {
					$(this).find( '.uix-pb-price-border' ).css({
						"border-color": $this.data( 'tcolor' ),
						"-webkit-box-shadow": "inset 0 0px 0px "+hw+"px " + $this.data( 'tcolor' ),
						"-moz-box-shadow": "inset 0 0px 0px "+hw+"px " + $this.data( 'tcolor' ),
						"box-shadow": "inset 0 0px 0px "+hw+"px " + $this.data( 'tcolor' )
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
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {

        uix_pb_parallaxInit();
        $( window ).on( 'resize', function() {
           uix_pb_parallaxInit();

        });

        function uix_pb_parallaxInit() {
            $( '.uix-pb-parallax' ).each(function() {
                $( this ).bgParallax( "50%", $( this ).data( 'parallax' ) );
            });
        };
		
		
		// Seamless display when the background color is not empty
		$( '.uix-pb-parallax-nospace' ).closest( '.uix-pb-container' ).addClass( 'nospace' );
		$( '.uix-pb-parallax-nospace' ).closest( '.uix-page-builder-section' ).addClass( 'nospace' );	
		$( '.uix-pb-parallax-nospace' ).closest( '.uix-pb-row > div' ).addClass( 'nospace' );
		


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

        $( '.uix-pb-testimonials-container .flexslider' ).flexslider( {
            namespace	      : "uix-pb-flex-",
            animation         : 'slide',
            slideshow         : true,
            smoothHeight      : true,
            controlNav        : true,
            directionNav      : false,
            animationSpeed    : 600,
            slideshowSpeed    : 7000,
            selector          : ".slides > li",
            start: function(slider) {
				//Prevent to <a> of page transitions
				$( 'a' ).each( function() {
					var attr = $( this ).attr( 'href' );

					if ( typeof attr === typeof undefined ) {
						$( this ).attr( 'href', '#' );
					}
				});	
            }

        } );


	};


    uix_pb.testimonials = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );


/*!
 *************************************
 * 6. Filterable
 *************************************
 */
uix_pb = ( function ( uix_pb, $, window, document ) {
    'use strict';


    var documentReady = function( $ ) {

		 $( '.uix-pb-filterable' ).each( function(){

			var $this              = $( this ),
				classprefix        = $this.data( 'classprefix' ),
				fid                = $this.data( 'filter-id' ),
				filterBox          = $( '#'+classprefix+'filter-stage-'+fid+'' ),
				filterNav          = $( '#'+classprefix+'cat-list-'+fid+'' ),
				filterItemSelector = '.'+classprefix+'item';


			 filterBox.shuffle({
				itemSelector: filterItemSelector,
				speed: 550, // Transition/animation speed (milliseconds).
				easing: 'ease-out', // CSS easing function to use.
				sizer: null // Sizer element. Use an element to determine the size of columns and gutters.
			  });

			//init
			imagesLoaded( '#'+classprefix+'filter-stage-'+fid+'' ).on( 'always', function() {
				 $( '#'+classprefix+'cat-list-'+fid+' li:first a' ).trigger( 'click' );
			 });


			filterNav.find( 'li > a' ).on( 'click', function( e ) {

				  var thisBtn = $( this ),
					  activeClass = 'current',
					  isActive = thisBtn.hasClass( activeClass ),
					  group = isActive ? 'all' : thisBtn.data( 'group' );

				  // Hide current label, show current label in title
				  if ( !isActive ) {
					filterNav.find( '.' + activeClass ).removeClass( activeClass );
				  }

				  thisBtn.toggleClass( activeClass );

				  // Filter elements
				  filterBox.shuffle( 'shuffle', group );

				  return false;


			} ); 		


		 });	

	};


    uix_pb.filterable = {
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
		    $( this ).after( '<div class="uix-pb-clear"></div>' );
		 });	

	};


    uix_pb.grid = {
        documentReady : documentReady
    };

    uix_pb.components.documentReady.push( documentReady );
    return uix_pb;

}( uix_pb, jQuery, window, document ) );




