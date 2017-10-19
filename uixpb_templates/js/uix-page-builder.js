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

					if ( w <= 768 ){
						 $this.bgParallax( "0%", 0 );
					} else {
						$this.bgParallax( "50%", $this.data( 'parallax' ) );	
					}			
					
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
		
		
		//Format the category group for each list item, in order to compatible shuffle plugin
		//Like this:  a,b,c  ->   ["a","b","c"]
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
		
		

		 $( '.uix-pb-filterable' ).each( function(){

			var $this              = $( this ),
				activated          = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
				classprefix        = $this.data( 'classprefix' ),
				fid                = $this.data( 'filter-id' ),
				filterBox          = $( '#'+classprefix+'filter-stage-'+fid+'' ),
				filterNav          = $( '#'+classprefix+'cat-list-'+fid+'' ),
				filterNavLiDisplay = $( '#'+classprefix+'cat-list-'+fid+''+'-container' ),
				filterItemSelector = '.'+classprefix+'item';

			if ( typeof activated === typeof undefined || activated === 0 ) {
				
				
				//------ Display categories on page
				var catlistStr   = '',
				    itemsStr     = filterBox.html().replace(/&nbsp;/g, ' ' ),
					re           = new RegExp("(.*?)\<\/div\>","gim"),
					v            = '<div class="'+classprefix+'type">',
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
					
					
					catlistStr += '<li><a href="javascript:" data-group="'+_slug+'">'+newArr[j]+'</a></li>';
				}
				
				filterNavLiDisplay.html( catlistStr );
				
				
				
								  
			    //------ Filterable effect
				 filterBox.shuffle({
					itemSelector: filterItemSelector,
					speed: 550, // Transition/animation speed (milliseconds).
					easing: 'ease-out', // CSS easing function to use.
					sizer: null // Sizer element. Use an element to determine the size of columns and gutters.
				  });

			
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
				

				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}
			 
	
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

		$( '.uix-pb-imageslider-container .flexslider' ).each( function()  {
			
	
			var $this        = $( this ),
				activated    = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
				dataSpeed    = $this.data( 'speed' ),
				dataTiming   = $this.data( 'timing' ),
				dataLoop     = $this.data( 'loop' ),
				dataPrev     = $this.data( 'prev' ),
				dataNext     = $this.data( 'next' ),
				dataAnim     = $this.data( 'animation' ),
				dataPaging   = $this.data( 'paging' ),
				dataArrows   = $this.data( 'arrows' );

			if ( typeof activated === typeof undefined || activated === 0 ) {

				// If there is no data-xxx, save current source to it
				if( typeof dataSpeed === typeof undefined ) dataSpeed = 600;
				if( typeof dataTiming === typeof undefined ) dataTiming = 10000;
				if( typeof dataLoop === typeof undefined ) dataLoop = true;
				if( typeof dataPrev === typeof undefined ) dataPrev = "<i class='fa fa-chevron-left'></i>";
				if( typeof dataNext === typeof undefined ) dataNext = "<i class='fa fa-chevron-right'></i>";
				if( typeof dataAnim === typeof undefined ) dataAnim = 'slide';
				if( typeof dataPaging === typeof undefined ) dataPaging = true;
				if( typeof dataArrows === typeof undefined ) dataArrows = true;

				$this.flexslider({
					namespace	      : 'uix-pb-flex-',
					animation         : dataAnim,
					selector          : '.slides > li',
					controlNav        : dataPaging,
					smoothHeight      : true,
					prevText          : dataPrev,
					nextText          : dataNext,
					animationSpeed    : dataSpeed,
					slideshowSpeed    : dataTiming,
					slideshow         : true,
					animationLoop     : dataLoop,
					directionNav      : dataArrows
				});

				

				//Prevents front-end javascripts that are activated in the background to repeat loading.
				$this.data( 'activated', 1 );	
			}
			
			
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


