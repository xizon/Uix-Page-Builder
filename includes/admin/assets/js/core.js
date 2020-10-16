/* Global: uix_page_builder_layoutdata */
( function( $ ) {
"use strict";
    $( function() {
		

		
		
		
		/*!
		 *
		 * The interaction when selecting a module
		 * ---------------------------------------------------
		 */
		$( document ).on( 'mouseover', '.uix-page-builder-col', function(){
			$( '.uix-page-builder-col' ).not( this ).stop().animate( { opacity: 0.2 }, 1 );
		}).on( 'mouseout' , function(){
			$( '.uix-page-builder-col' ).stop().animate( { opacity: 1 }, 1 );
		});
		
		
		/*!
		 *
		 * Create page template files to the theme directory
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '#uix-page-builder-createTempFiles-btn', function( e ) {
			e.preventDefault();
			
			$( this ).addClass( 'processing' );
			
			$.ajax({
				url       : ajaxurl,
				type      : 'POST',
				data: {
					action     : 'uix_page_builder_createTempFilesToTheme_settings',
					postID     : uix_page_builder_layoutdata.send_string_postid,
					security   : uix_page_builder_layoutdata.send_string_nonce
				},
				success   : function( result ){
					
					var $wrapper = $( '#uix-page-builder-createTempFiles-info-wrapper' );
					
					
					if ( result != 0 ) {
						location.reload();
					} else {
						$wrapper.html( uix_page_builder_layoutdata.send_string_tempfile_failed );
					}
					
					// stuff here
					return false;	
					

				}
			});


		});
	
		
		
		/*!
		 *
		 * Determines whether the template file is created
		 * ---------------------------------------------------
		 */
		$( document ).ready( function() {
			
			if ( uix_page_builder_layoutdata.send_string_tempfile_exists == 0 ) {
				$( 'body' ).prepend( '<div class="uixpbform-modal-box active" id="uix-page-builder-template-files-note"><a href="javascript:void(0)" class="close-btn close-uixpbform-modal">&times;</a><div class="content"><h2>&nbsp;</h2><p><img src="' + uix_page_builder_layoutdata.send_string_plugin_url + 'includes/admin/assets/images/bubble-welcome.png" alt="" width="150" height="150"></p><p>'+uix_page_builder_layoutdata.send_string_tempfile_note+'</p></div></div>' );
				$( '#uix-page-builder-template-files-note' ).UixPBFormPopWinReset( { heightChange: 500 } );
				
				
				/*-- Close --*/
				$( '.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
					e.preventDefault();

					$( document ).UixPBFormPopClose();

				});		
				
			}

		} );
		

	
		
		/*!
		 *
		 * Responsive Switching Preview
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uix-page-builder-res-selector li', function( e ) {
			e.preventDefault();

			var $window      = $( window ),
				$preview     = $( '#uix-page-builder-themepreview' ),
				windowWidth  = $window.width(),
				windowHeight = $window.height(),  
				sidebarWidth = ( !$preview.hasClass( 'active' ) ) ? $( '#uix-page-builder-gridster-wrapper' ).width() : 0,
				w            = $( this ).data( 'size' )[0],
				h            = ( $( this ).data( 'size' )[1] > windowHeight ) ? windowHeight : $( this ).data( 'size' )[1],
			    t            = ( windowHeight - h ) /2,
				l            = ( !$preview.hasClass( 'active' ) ) ? ( ( windowWidth - sidebarWidth ) - w ) /2 : ( windowWidth - w ) /2;
		
			$( '.uix-page-builder-res-selector li' ).removeClass( 'active' );
            $( this ).addClass( 'active' );

			if ( $( 'body' ).hasClass( 'rtl' ) ) {
				if ( w == 0 ) {
					$preview.css({
						'width': ( windowWidth - sidebarWidth ) + 'px',
						'height': windowHeight + 'px',
						'margin-top': 0,
						'margin-right': 0
					}).removeClass( 'res' );
				} else {
					$preview.css({
						'width': w + 'px',
						'height': h + 'px',
						'margin-top': t + 'px',
						'margin-right': l + 'px'
					}).addClass( 'res' );	
				}
			} else {
				if ( w == 0 ) {
					$preview.css({
						'width': ( windowWidth - sidebarWidth ) + 'px',
						'height': windowHeight + 'px',
						'margin-top': 0,
						'margin-left': 0
					}).removeClass( 'res' );
					
				} else {
					$preview.css({
						'width': w + 'px',
						'height': h + 'px',
						'margin-top': t + 'px',
						'margin-left': l + 'px'
					}).addClass( 'res' );	
					
				}	
				
				
			}


		});

		
	   /*!
		 *
		 * Visual Builder Page
		 * ---------------------------------------------------
		 */
		$( document ).UixPBRenderSidebar( { method: 'auto' } ); //Sidebar controler
		
		$( document ).on( 'mouseenter', '.uix-page-builder-visual-mode', function() {
			var curtitle = $( '[name="post_title"]' ).val().replace(/&/g, '{and}' ).replace(/\s/g, '{space}' ),
				oldhref  = $( this ).attr( 'href' );
			if ( curtitle.length > 0 ) {
				$( this ).attr( 'href', oldhref + '&post_title=' + encodeURI( curtitle ) )
			}
			
		});
		
		$( document ).on( 'mouseenter', '#uix-page-builder-gridster-wrapper', function() {
			$('.uix-page-builder-gridster-widget' ).removeClass( 'hover' );
			
		});	
		
		
		$( document ).on( 'mousedown', '.uix-page-builder-visual-mode', function() {
			$( window ).unbind();
		});
		
		
		
	   /*!
		 *
		 * Per column module buttons
		 * ---------------------------------------------------
		 */

		 //--------click
		$( document ).on( 'click', '.widget-item-btn', function( e ) {
			e.preventDefault();

			var  cur_slug         = $( this ).data( 'slug' ),
				 cur_rowID        = $( this ).data( 'id' ),
				 widget_name      = $( this ).data( 'name' ),
				 ele_target       = $( this ).data( 'elements-target' ),
				 ele_btn          = $( '#' + ele_target ).find( '.add-elements-btn' ),
				 cur_defaultvalue = $( '#' + ele_target ).find( 'textarea' ).val();

			if ( ele_btn.css( 'display' ) != 'none' ) {
				ele_btn.after( $( this ).clone().addClass( 'used' ).text( widget_name ) ).hide();

				if ( $( '#' + ele_target ).find( 'textarea' ).length > 0 ) {

					//Save empty data
					if ( cur_defaultvalue.indexOf( 'uix_pb_module_undefined' ) >= 0 ) {
						var nv = cur_defaultvalue
												 .replace( 'uix_pb_module_undefined', cur_slug )
												 .replace( 'uix_pb_undefined', cur_slug + '_temp' );

						$( '#' + ele_target ).find( 'textarea' ).val( nv );


						var gridsterInit = new UixPBGridsterMain();
						//Save the data for each sortable item
						gridsterInit.itemSave( cur_rowID );
						//Initialize default value & form
						gridsterInit.formDataSave(); 


					}


					//status
					var new_cur_defaultvalue = $( '#' + ele_target ).find( 'textarea' ).val();
					if ( new_cur_defaultvalue.indexOf( cur_slug ) >= 0 && new_cur_defaultvalue.indexOf( 'uix_pb_module_undefined' ) < 0 ) {
						$( '#' + ele_target ).addClass( 'used' );
					}

				}


			}


			//Switch between different pop-up windows when the pop-up windows is not fully closed.
			$( document ).UixPBFormPopSwitchTransition();


		});



	   /*!
		 *
		 * Debug detection textarea
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '#uix-page-builder-layoutdata, .uix-page-builder-gridster-widget .content-box, .uix-page-builder-gridster .temp-data-1, .uix-page-builder-gridster .temp-data-2, .sortable-list .row textarea', function() {
			$( this ).select();

		});


		 /*!
		 *
		 * Hide layout button
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.widget-items-col-container a', function( e ) {
			$( this ).parent().parent().hide();
		});



	   /*!
		 *
		 * Elements show
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.add-elements-btn', function( e ) {
			e.preventDefault();

			var modalID = '#' + $( this ).data( 'elements' );

			//Reset the modal box
			$( modalID ).UixPBFormPopWinReset( { heightChange: true } );
		
			//Close
			$('.uixpbform-modal-box .close-uixpbform-modal' ).on( 'click', function( e ) {
				e.preventDefault();
				
				//Switch between different pop-up windows when the pop-up windows is not fully closed.
				$( document ).UixPBFormPopSwitchTransition();
				
				//Remove mask
				$( '.uixpbform-modal-mask' ).fadeOut( 'fast' );
			});


		});





	   /*!
		 *
		 * Row Settings
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uix-page-builder-gridster-widget .dashicons.settings', function( e ) {
			e.preventDefault();

			$( '.settings-wrapper' ).hide();

			var $set = $( this ).next( '.settings-wrapper' );
			$set.show();


			//Close
			$set.find( '.close' ).on( 'click', function( e ) {
				$set.hide();
			});


		});

		$( document ).on( 'click', '.uix-page-builder-gridster-drag', function( e ) {
            e.preventDefault();
            
			$( '.settings-wrapper' ).hide();
		});

		$( document ).on( 'mouseenter', '.sortable-list .row', function( e ) {
			e.preventDefault();

			$( '.settings-wrapper' ).hide();

		});


	   /*!
		 *
		 * Template Settings
		 * ---------------------------------------------------
		 */
		$( document ).on( 'click', '.uix-page-builder-gridster-addbtn .export-temp, .uix-page-builder-gridster-addbtn .select-temp, .uix-page-builder-gridster-addbtn .save-temp, .uix-page-builder-gridster-addbtn .publish-visual-builder', function( e ) {
			e.preventDefault();

			var $set = $( this ).next( '.settings-temp-wrapper' );
			$set.show();
			if ( uix_page_builder_layoutdata.send_string_vb_mode != 1 )  $( '.uixpbform-modal-mask' ).show();

			//Close
			$set.find( '.close, .export' ).on( 'click', function() {
				$set.hide();
				$( '.uixpbform-modal-mask' ).hide();
			});


		});
		
	
		 //--------publish
		$( document ).on( 'click', '.settings-temp-wrapper .publish', function( e ) {
			e.preventDefault();
			
			var $this         = $( this );
			
			//Display load animation
			$this.next( '.spinner' ).addClass( 'is-active' );
	
			$.ajax({
				url       : ajaxurl,
				type      : 'POST',
				data: {
					action               : 'uix_page_builder_publishLiveRender_settings',
					postID               : uix_page_builder_layoutdata.send_string_postid,
					postTitle            : $( "[name='uix-page-builder-new-pagetitle']" ).val(),
					security             : uix_page_builder_layoutdata.send_string_nonce
				},
				success   : function( result ){
				
					if ( result == 1 ) {

						//close
						$this.parent().hide();
						$( '.uixpbform-modal-mask' ).hide();
						$this.next( '.spinner' ).removeClass( 'is-active' );

					}

				}
			});

			
			// stuff here
			return false;	
			

		});	
		

		 //--------load
		$( document ).on( 'click', '.uix-page-builder-gridster-addbtn .select-temp', function( e ) {
			e.preventDefault();


			//List
			$.ajax({
				url       : ajaxurl,
				type      : 'POST',
				data: {
					action     : 'uix_page_builder_metaboxes_loadtemplist_settings',
					postID     : uix_page_builder_layoutdata.send_string_postid,
					security   : uix_page_builder_layoutdata.send_string_nonce
				},
				success   : function( result ){
					$( '#uix-page-builder-templatelist' ).html( result );

					if ( result == '' || result == '<p>'+uix_page_builder_layoutdata.send_string_nodata+'</p>' ) {
						$( '#uix-page-builder-templatelist-confirm' ).hide();
					} else {
						$( '#uix-page-builder-templatelist-confirm' ).show();
					}
					
					// stuff here
					return false;	
					

				},
				beforeSend: function() {
					$( '#uix-page-builder-templatelist' ).html( uix_page_builder_layoutdata.send_string_loadlist );
					$( '#uix-page-builder-templatelist-confirm' ).hide();

				}
			});


		});

		$( document ).on( 'click', '.settings-temp-wrapper .confirm', function( e ) {
			e.preventDefault();

			var $this         = $( this ),
			    v             = $( this ).closest( '.settings-temp-wrapper' ).find( '[name="temp"]:checked' ).parent().find( 'textarea' ).html(),
				tempname      = gridsterRenderCodesTempAttrsValue( v, 0 ), //Get the JSON code value of "tempname"
			    pagetemp      = gridsterRenderCodesTempAttrsValue( v, 1 ); //Get the JSON code value of "wp_page_template"

			//Display load animation
			$this.next( '.spinner' ).addClass( 'is-active' );
			
			
			//show loader
			$( '#uix-page-builder-visualBuilder-loader, #uix-page-builder-visualBuilder-loader .loader' ).show();

			
			//Format the JSON code (remove value of "tempname" and "wp_page_template" )
			v = gridsterFormatRenderCodesRemoveTempname( v );
			
			
			$.ajax({
				url       : ajaxurl,
				type      : 'POST',
				data: {
					action               : 'uix_page_builder_metaboxes_loadtemp_settings',
					curlayoutdata        : v,
					tempname             : tempname,
					pagetemp             : pagetemp,
					postID               : uix_page_builder_layoutdata.send_string_postid,
					security             : uix_page_builder_layoutdata.send_string_nonce
				},
				success   : function( result ){
					
					var data      = result
									.toString()
									.replace( /\\/g, '' )
									.replace( /""/g, '' )
									.replace( /:,/g, ':"",' );

					
					//Load and initialize editable widgets
					var gridsterInit = new UixPBGridsterMain();
					gridsterInit.editRow( JSON.parse( data ) );


					//Save options for gridster data
					var settings = jQuery( "[name='uix-page-builder-layoutdata']" ).val();

					
					/*
					//Render and save page data
					var gridsterInit = new UixPBGridsterMain();
					gridsterInit.renderAndSavePage(2); //Render the entire page
					*/
					//render page viewport
					$( document ).UixPBRenderPage( { enable: 0 } );

					//close
					$this.parent().hide();
					$( '.uixpbform-modal-mask' ).hide();
					$this.next( '.spinner' ).removeClass( 'is-active' );
					
					//Sidebar controler
					$( document ).UixPBRenderSidebar( { method: 'open' } );


					// stuff here
					return false;					
					
				}
			});
			
		

		});


		//--------save
		$( document ).on( 'click', '.settings-temp-wrapper .save', function( e ) {
			e.preventDefault();


			var $this = $( this ),
			    v     = $( "[name='uix-page-builder-layoutdata']" ).val(),
			    n     = $( this ).closest( '.settings-temp-wrapper' ).find( '[name="tempname"]' ).val();

			$this.next( '.spinner' ).addClass( 'is-active' );

			
			$.ajax({
				url       : ajaxurl,
				type      : 'POST',
				data: {
					action               : 'uix_page_builder_metaboxes_savetemp_settings',
					curlayoutdata        : v,
					tempname             : n,
					postID               : uix_page_builder_layoutdata.send_string_postid,
					security             : uix_page_builder_layoutdata.send_string_nonce
				},
				success   : function( result ){
					//console.log( result )

					//close
					$this.parent().hide();
					$( '.uixpbform-modal-mask' ).hide();
					$this.next( '.spinner' ).removeClass( 'is-active' );
				}
			});

			
			// stuff here
			return false;	


		});


		 //--------delete
		$( document ).on( 'click', '#uix-page-builder-templatelist .close-tmpl', function( e ) {
			e.preventDefault();
			
			if ( confirm( uix_page_builder_layoutdata.send_string_del_temp_btn ) ) {
				var tid  = $( this ).data( 'del-id' ),
					name = $( '#' + tid ).html();


				$.ajax({
					url       : ajaxurl,
					type      : 'POST',
					data: {
						action     : 'uix_page_builder_delContentTemplate_settings',
						tempName   : name,
						security   : uix_page_builder_layoutdata.send_string_nonce
					},
					success   : function( result ){
						$( '#' + tid ).closest( 'label' ).remove();

						// stuff here
						return false;	


					}
				});	
			} 

		});
	
		
		

		/*!
		 *
		 * Page Options
		 * ---------------------------------------------------
		 */
		$( document ).ready( function() {

			var hidedivs    = [ '#postdivrich' ],
				hideID      = '',
				selectedElt = $( "input[name='uix-page-builder-status']:checked" ).attr( 'id' ),
				pbID        = '#uix_page_builder_page_meta_pagerbuilder_container';
			$( '.postbox' ).each( function()  {
				if ( $( this ).attr( 'id' ).indexOf( 'dis_page_builder' ) >= 0 ) {
					hidedivs.push( '#' + $( this ).attr( 'id' ) );
				}

			});

			for (var i = 0; i < hidedivs.length; i++ ) {
				hideID += hidedivs[ i ] + ',';
			}
			hideID = hideID.replace(/,\s*$/, '' );


			if ( selectedElt == 'uix-page-builder-status2' ) {
				uix_page_builder_hide();
			} else {
				uix_page_builder_show();
			}

			$( '#uix-page-builder-status1' ).on( 'click', function() {
				uix_page_builder_show();
				
				//Add shortcode to editor
				if ( gridsterGetTinymceContent().indexOf( '[uix_pb_sections' ) < 0  ) {
					wp.media.editor.insert( '[uix_pb_sections id="'+uix_page_builder_layoutdata.send_string_postid+'"]' );
				}
				

				//Auto set page template
				if ( uix_page_builder_layoutdata.send_string_tempfiles_exists == 1 ) {
					$('[name="page_template"] option[value="tmpl-uix_page_builder.php"]').attr( 'selected', 'selected' );
				}

			});
			$( '#uix-page-builder-status2' ).on( 'click', function() {
				uix_page_builder_hide();

				//Restore set page template
				if ( uix_page_builder_layoutdata.send_string_tempfiles_exists == 1 ) {
					$('[name="page_template"] option[value="default"]').attr( 'selected', 'selected' );
				}

			});



			function uix_page_builder_hide() {
				$( hideID ).slideDown( 300 ).css( 'width', '100%' );
				$( pbID ).slideUp( 300 );
				uix_page_builder_init();
			}
			function uix_page_builder_show() {
				$( hideID ).slideUp( 300 );
				$( pbID ).slideDown( 300 ).css( 'width', '100%' );
				uix_page_builder_init();
			}
			function uix_page_builder_init() {
				$( 'html, body' ).animate( {scrollTop: 10 }, 100 );
				$( 'html, body' ).delay( 300 ).animate( {scrollTop: 5 }, 100 );
				$( '.uix-page-builder-gridster ul' ).css( 'width', '100%' );
			}


		});

	} );

} ) ( jQuery );


	


/*! 
 * 
 * [Gridster] Format the JSON code (remove value of "tempname" and "wp_page_template" )
 * ---------------------------------------------------
 *
 * @param  {string} str            - JSON string.
 * @return {string}                - A new string.
 */		
function gridsterFormatRenderCodesRemoveTempname( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		if (/^[\],:{}\s]*$/.test( str.replace(/\\["\\\/bfnrtu]/g, '@' ).
		replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
		replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

			var newstr        = JSON.parse( str ),
				tempnameValue = newstr[0].tempname,
				pagetempValue = newstr[1].wp_page_template,
				result        = '';
			
			if( typeof newstr[0] != typeof undefined ) {
				str = str.replace( '{"tempname":"'+newstr[0].tempname+'"},', '' );
			}

			if( typeof newstr[1] != typeof undefined ) {
				str = str.replace( '{"wp_page_template":"'+newstr[1].wp_page_template+'"},', '' );
			}
			

			return str;

		}else{

		    return str;

		}


	}

}



/*! 
 * 
 * [Gridster] Get the JSON code value of "tempname"
 * ---------------------------------------------------
 *
 * @param  {string} str            - JSON string.
 * @return {string}                - A new string.
 */		
function gridsterRenderCodesTempAttrsValue( str, attr ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		
		if (/^[\],:{}\s]*$/.test( str.replace(/\\["\\\/bfnrtu]/g, '@' ).
		replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
		replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

			var newstr = JSON.parse( str );
			
			if ( attr == 0 && typeof newstr[0] != typeof undefined ) {
				return newstr[0].tempname;
			}
			if ( attr == 1 && typeof newstr[1] != typeof undefined ) {
				return newstr[1].wp_page_template;
			}

		}else{

		    return '';

		}


	}

}

/*! 
 * 
 * [Gridster] Decodes an encoded string.
 * ---------------------------------------------------
 *
 * @param  {string} str            - Any string.
 * @return {string}                - A new string.
 */		
function gridsterHtmlUnescape( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		return str
			.replace(/&quot;/g, '"')
			.replace(/&#39;/g, "'")
			.replace(/&lt;/g, '<')
			.replace(/&gt;/g, '>');

	}

}


/*! 
 * 
 * [Gridster] Escapes a HTML string.
 * ---------------------------------------------------
 *
 * @param  {string} str            - Any string.
 * @return {string}                - A new string.
 */		
function gridsterHtmlEscape( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		return str
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#39;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;');

	}
}



/*! 
 * 
 * [Gridster] Convert a string to slug.
 * ---------------------------------------------------
 *
 * @param  {string} str            - Any string.
 * @return {string}                - A new string.
 */			
function gridsterStrToSlug( str ){
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
 * 
 * [Gridster] Convert a string to title.
 * ---------------------------------------------------
 *
 * @param  {string} str            - Any string.
 * @return {string}                - A new string.
 */			
function gridsterStrToTitle( str ){
	if ( typeof( str ) == 'string' && str.length > 0 ) {
		return str
			    .toString()
				.replace(/[^\w\s\-！￥【】\u4e00-\u9eff]/gi, '');
		
	} else {
		return '';
	}
}

/*! 
 * 
 * [Gridster] Get a widget content with JSON
 * ---------------------------------------------------
 *
 * @param  {string} str            - The contents of all widgets with JSON.
 * @param  {string} type           - Returns the data type. The optional values: "id", "name", content"
 * @param  {string} repstr         - The string that will be returned without any processing.
 * @return {string}                - A new string.
 */		
function gridsterContent( str, type, repstr ){

	if ( typeof( str ) == 'string' && str.length > 0 ) {


		var nstr   = str.replace(/{rqt:}/g, '"');

		if ( type == 'id' ) {
			var result = nstr.match( /row\",\"(.+?)\"\]/g );

			if ( result != null ) {
				return result[0].replace( 'row","', '' )
							   .replace( '"]', '' );

			}



		}
		if ( type == 'name' ) {
			var result = nstr.match( /widgetname\",\"(.+?)\"\]/g );

			if ( result != null ) {
				return result[0].replace( 'widgetname","', '' )
							   .replace( '"]', '' );
			}

		}	
		if ( type == 'content' ) {
			var result = nstr.match( /rowcontent\",\"(.+?)\"\]/g );

			if ( result != null ) {
				return result[0].replace( 'rowcontent","', '' )
							   .replace( '"]', '' );	
			}
		}	

	} else {
		return repstr;
	}	



}


/*! 
 * 
 * [Gridster] Get a widget content of the current column with JSON
 * ---------------------------------------------------
 *
 * @param  {string} str            - The contents of all widgets with JSON.
 * @param  {string} type           - Returns the data type. The optional values: "length", "col", "name", "form_id", "content"
 * @param  {string} index          - Retrieves the array index of the data.
 * @return {string}                - A new string.
 */		
function gridsterColsContent( str, type, index ){

	if ( index < 1 ) index = 1;

	index = index - 1;


	if ( typeof( str ) == 'string' && str.length > 0 ) {
		var nstr   = str.replace(/{rowqt:}/g, '"'),
			result = '';
		nstr = eval( nstr );



		//item array
		var ia         = nstr[index],
			rescontent = [];
		for( var j in ia ) {
			rescontent.push( '[{rqt:}'+ia[j][0]+'{rqt:},{rqt:}'+ia[j][1]+'{rqt:}]' );
		}

		if ( type == 'length' ) {
			result = nstr.length;
		}

		if ( type == 'col' ) {
			result = nstr[index][0][1];
		}
		if ( type == 'name' ) {
			result =  nstr[index][1][0];
		}	

		if ( type == 'form_id' ) {
			var r = nstr[index][1][0],
				a = r.split("|");

			result =  a[0];
		}		

		if ( type == 'content' ) {
			result =  '{'+nstr[index][0][1]+'}['+rescontent+']';	
		}		

		return result;

	} else {
		return '';
	}

}	


/*! 
 * 
 * [Gridster] Initialize the widget data with JSON
 * ---------------------------------------------------
 *
 * @param  {string} str            - The content with JSON to add.
 * @param  {number} uid            - The widget ID number.
 * @return {void}                  - The constructor.
 */		
function gridsterItemRowTextareaInit( str, uid ) {
	jQuery( document ).ready( function() {  
		if ( Object.prototype.toString.call( str ) === '[object Array]' ) {

			var result = ''
				cid    = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];

			for( var j in str ) {

				for( var i in cid ) {
					if ( str[j].toString().indexOf( cid[i] ) >= 0  ) {

						result = str[j].toString();
						result = result.replace( '{'+cid[i]+'}', '' );	

						jQuery( '#col-item-'+cid[i]+'---' + uid ).val( gridsterHtmlUnescape( result ) );

					}

				}

			}


		}

	});
}

/*! 
 * 
 * [Gridster] Format the JSON code before saving the data.
 * ---------------------------------------------------
 *
 * @param  {string} code           - The data with JSON.
 * @return {string}                - New code.
 */	
function gridsterFormatAllCodes( code ) {
	var stringValue = code.toString();
	stringValue = stringValue.replace( /{rqt:}/g, "{rowqt:}")
							.replace( /{cqt:}/g, "{rowcqt:}")
							.replace( /{apo:}/g, "{rowcapo:}")
	
							//Clear duplicate "&"
							.replace( /&amp;/g, "&") //step 1
							.replace( /amp;/g, "") //step 2
	
							.replace( /"/g, "{rowqt:}");
	return stringValue;

}

/*! 
 * 
 * [Gridster] Returns a random widget ID
 * ---------------------------------------------------
 *
 * @return {string}                - A new string.
 */	
function gridsterRowUID() {
	var text     = "",
		possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
		uid      = ( new Date().getTime() ).toString( 36 ).substr( 5, 7 );

	for (var i = 0; i < 5; i++) {
		text += possible.charAt( Math.floor( Math.random() * possible.length ) );
	}
	
	text = text.substr( 0, 2 ) + uid;
	
	return text;
}


/*!
 *
 * [Gridster] Per column module buttons status
 * ---------------------------------------------------
 *
 * @param  {number} type           - Initialize per column module buttons status. 
 *                                  ( 1: Has been clicked | 0: The click action has not yet been performed )
 * @return {void}                  - The constructor.
 */	
function gridsterItemElementsBTStatus( type ) {
	jQuery( document ).ready( function() {

		setTimeout( function() {
			jQuery( '.widget-item-btn' ).each( function()  {

				var  cur_slug         = jQuery( this ).data( 'slug' ),
					 cur_rowID        = jQuery( this ).data( 'id' ),
					 widget_name      = jQuery( this ).data( 'name' ),
					 ele_target       = jQuery( this ).data( 'elements-target' ),
					 $sort_container  = jQuery( '#' + ele_target ),
					 ele_btn          = $sort_container.find( '.add-elements-btn' ),
					 cur_defaultvalue = $sort_container.find( 'textarea' ).val();

				//console.log( cur_slug + ' : ' + cur_rowID );
				if ( $sort_container.length > 0 ) {

					if ( $sort_container.find( 'textarea' ).length > 0 ) {

						// Using '|' in order to avoid duplicated buttons clone when multiple button IDs are similar
						if ( cur_defaultvalue.indexOf( cur_slug + '|' ) >= 0 && cur_defaultvalue.indexOf( 'uix_pb_module_undefined' ) < 0 ) {

							
							//The click action has not yet been performed.
							if ( type == 0 ) {
								ele_btn.after( jQuery( this ).clone().addClass( 'used' ).text( widget_name ) ).hide();
							}

							$sort_container.addClass( 'used' );

						}

					}


				}


			});

		}, 100 );
    });
}





/*!
 *
 * [Gridster] Get the content of the tinyMCE editor.
 * ---------------------------------------------------
 * Get the content of the tinyMCE editor.
 * @link http://wordpress.stackexchange.com/questions/42652/how-to-get-the-input-of-a-tinymce-editor-when-using-on-the-front-end
 * @return {string} Returns the content
 */
function gridsterGetTinymceContent(){

	//change to name of editor set in wp_editor()
	var editorID = 'content',
		content  = '';

	if (jQuery( '#wp-'+editorID+'-wrap' ).hasClass( 'tmce-active' ) ) {
		content = tinyMCE.get( editorID ).getContent({format : 'raw'});
	} else {
		content = jQuery('#'+editorID).val();
	}
	return content;
}


/*!
 *
 * [Gridster] Add shortcut buttons to front-end page 
 * ---------------------------------------------------
 *
 * @return {void}                  - The constructor.
 */	
function gridsterAddShortcutButtons() {

	( function($) {
	'use strict';

		var $ifm = $( '#uix-page-builder-themepreview' ).contents();

		jQuery.fn.UixPBSimulateClick = function() {
			return this.each(function() {
				if('createEvent' in document) {
					var doc = this.ownerDocument,
						evt = doc.createEvent('MouseEvents');
					evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
					this.dispatchEvent(evt);
				} else {
					this.click();
				}
			});
		};


		$( function() {


			$ifm.find( '#wpadminbar' ).css( 'visibility', 'hidden' );
			
			$ifm.find( '.uix-page-builder-section > .uix-pb-row > div' ).each( function( index ) {
				var id         = $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ),
					curindex   = $(this).index(),
					obj        = $('#uix-page-builder-gridster-widget-' + id );

                $( this ).closest( '.uix-page-builder-section' ).addClass( 'admin' );

				$( this ).append(  '<a data-id=\"'+id+'\" data-index=\"'+curindex+'\" class=\"uix-page-builder-editicon\" href=\"javascript:void(0);\" role=\"button\"><i class=\"fa fa-edit\"></i></a>' );
			});


			$ifm.find( '.uix-page-builder-section > .uix-pb-row > div' ).on( 'mouseenter', function(){

				var id         = $( this ).closest( '.uix-page-builder-section' ).data( 'pb-section-id' ),
					curindex   = $(this).index(),
					obj        = $('#uix-page-builder-gridster-widget-' + id );

				$('.uix-page-builder-gridster-widget' ).removeClass( 'hover' );
				obj.addClass( 'hover' );

				$( this ).find( '> div' ).addClass( 'editmode' );

				$( this ).css( {
					'-webkit-box-shadow': 'none',
					'-moz-box-shadow'   : 'none',
					'box-shadow'        : 'none',
				} );



			}).on( 'mouseleave' , function(){

				$( this ).find( '> div' ).removeClass( 'editmode' );

				$( this ).css( {
					'-webkit-box-shadow': 'none',
					'-moz-box-shadow'   : 'none',
					'box-shadow'        : 'none'
				} );
			});


			$ifm.find( '.uix-page-builder-editicon' ).on( 'click', function() {

				var id         = $( this ).data( 'id' ),
					index      = parseFloat( $( this ).data( 'index' ) ),
					obj        = $('#uix-page-builder-gridster-widget-' + id );

				obj.find( '.sortable-list > li:eq( '+index+' ) .widget-item-btn.used' ).UixPBSimulateClick( 'click' );

				return false;
			});	
			

			//Synchronize a scroll effect of Drag & Drop modules of left sidebar when you manage front-end page.
			$ifm.find( '.uix-page-builder-section' ).on( 'mouseenter', function() {

				var id           = $( this ).data( 'pb-section-id' ),
					obj          = $('#uix-page-builder-gridster-widget-' + id ),
					$side        = $( '#uix-page-builder-gridster-wrapper' ),
					widgetTitleH = 37,
					manageBtnsH  = 52;
				
			
				if ( uix_page_builder_layoutdata.send_string_vb_mode == 1 ) {
					
					if ( obj.length > 0 ) {
						$side.animate( { scrollTop: parseFloat( $side.scrollTop() + obj.offset().top - widgetTitleH - manageBtnsH ) }, 100 );
					}
					
					
				}


			});
			
			
			//Prevent form submission
			$ifm.find( '.uix-page-builder-section form' ).on( 'submit', function( e ) {
				e.preventDefault();
				alert( uix_page_builder_layoutdata.send_string_formsubmit_info );
			});




		}); 
	} ) ( jQuery );
}


/*! 
 * 
 * Format the HTML data when separate rendering "div" module on front-end pages
 * ---------------------------------------------------
 *
 * @param  {string} str            - HTML code.
 * @return {string}                - A new unescaped code.
 */	
function UixPBFormatRenderSeparateModuleCode( str ){
	return str;
}

			
/*! 
 * 
 * Format the JSON code before output the render viewport.
 * ---------------------------------------------------
 *
 * @param  {string} code           - Any JSON string.
 * @return {string}                - A new string.
 */	
function UixPBFormatRenderCodes( code ) {
	var stringValue = code.toString();
	
	//Returns string in order to protect the security output of JSON
	stringValue = stringValue
							//Clear duplicate "&"
							.replace( /&amp;/g, "&") //step 1
							.replace( /amp;/g, "") //step 2
	
		                     .replace(/{rowcsql:}/g, '[' )
							 .replace(/{rowcsqr:}/g, ']' );

	
	return stringValue;

}



/*!
 *
 * JavaScript Templating
 * ---------------------------------------------------
 */	
(function($){
  var cache = {};

  $.UixPBTmpl = function UixPBTmpl(str, data){
	  

  // Figure out if we're getting a template, or if we need to
  // load the template - and be sure to cache the result.
   // The HTML code "<div data-tmpl="0"></div>" is order to fixed "Maximum call stack size exceeded"
  var fn = !/\W/.test(str) ?
      cache[str] = cache[str] ||
      UixPBTmpl( ( document.getElementById( str ) === null ? '<div data-tmpl="0"></div>' + str : document.getElementById(str).innerHTML ) ) :

      // Generate a reusable function that will serve as a template
      // generator (and which will be cached).
      new Function("obj",
        "var p=[],print=function(){p.push.apply(p,arguments);};" +

        // Introduce the data as local variables using with(){}
        "with(obj){p.push('" +

        // Convert the template into pure JavaScript
        str
          .replace(/[\r\t\n]/g, " ")
          .split("<%").join("\t")
          .replace(/((^|%>)[^\t]*)'/g, "$1\r")
          .replace(/\t=(.*?)%>/g, "',$1,'")
          .split("\t").join("');")
          .split("%>").join("p.push('")
          .split("\r").join("\\'")
      + "');}return p.join('');");

    // Provide some basic currying to the user
    return data ? fn( data ) : fn;
  };

  $.fn.UixPBTmpl = function(str, data){
    return this.each(function(){

		var curData = $.UixPBTmpl( str, data );
        $( this ).html( curData ).promise().done( function() {
			
			//Get and modify content of an iframe
		   $( '#uix-page-builder-themepreview' ).load( function() {
			   if ( $( this ).contents().text().search( '[uix_pb_sections]' ) > 0 ) { //Regular expression, not WP shortcode
				    //Render WP Shortcode
				    $( document ).UixPBRenderWPShortcode( { postID: uix_page_builder_layoutdata.send_string_postid } );  
		  
			   }
			});
			
		});
		
    });
  };
})(jQuery);	



/*!
 *
 * Render Page Viewport
 * ---------------------------------------------------
 * Render the entire page from URL
 */

(function($){
	$.fn.UixPBRenderPage=function(options){
		var settings=$.extend({
			'enable'     : 0,
			'frameID'    : '#uix-page-builder-viewport-preview-tmpl',
			'previewID'  : '#uix-page-builder-viewport-preview-container',
			'tmplID'     : 'uix_page_builder_viewport_preview_tmpl',
			'previewURL' : uix_page_builder_layoutdata.send_string_preview_url
		}
		,options);
		this.each(function(){
			
			var $this       = $( this ),
				$enable     = settings.enable,
				$frameID    = settings.frameID,
				$previewID  = settings.previewID,
				$tmplID     = settings.tmplID,
				$previewURL = settings.previewURL,
				append      = '&cache=' + new Date().getTime() + 'a' + Math.random();
			
			

			//-------- Initialize the page container
			if ( $enable == 0 ) {

				
				$( $frameID ).load( uix_page_builder_layoutdata.send_string_plugin_url + 'includes/admin/preview/viewport.html', function( response, status, xhr ) {
					$( $previewID ).UixPBTmpl( $tmplID, {
						url : $previewURL + append,
					} );
				});
				
	
				//console.log( 'render ' + uix_page_builder_layoutdata.send_string_render_count + ' Ok!' );
				uix_page_builder_layoutdata.send_string_render_count++;
				
			}
			
			//-------- Render the entire page
			if ( $enable == 2 ) {
				$( document ).UixPBRenderWPShortcode( { postID: uix_page_builder_layoutdata.send_string_postid } );

			}
			
			
			//-------- Remove loader
			setTimeout( function() {
				$( '#uix-page-builder-visualBuilder-loader, #uix-page-builder-visualBuilder-loader .loader' ).hide();
			}, 1000 );

				
			
		})
	}
})(jQuery);


/*!
 *
 * Render HTML Viewport (Relative to the front of the page)
 * ---------------------------------------------------
 * Separate rendering "div" module on front-end pages
 */
(function($){
	$.fn.UixPBRenderHTML=function(options){
		var settings=$.extend({
			'divID'  : '#section_0000000__2__1',
			'value'  : 'undefined',
		}
		,options);
		this.each(function(){
			
			var $this       = $( this ),
				$divID      = settings.divID,
				newValue    = UixPBFormatRenderCodes( settings.value ),
				container   = $( '#uix-page-builder-themepreview' ).contents().find( $divID );
		

			$( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
				e.preventDefault();
				container.next( '.uix-page-builder-editicon' ).addClass( 'active' );

			});
			
			
			// Discard the rendering of separated module when the module contains these WP shortcodes
			var hasShortcode = uixpbform_per_module_has_shortcode( newValue );
			if ( ! hasShortcode ) {
				container.html( UixPBFormatRenderSeparateModuleCode( newValue ) );
			}
			
			
		})
	}
})(jQuery);


/*!
 *
 * Render WP Shortcode
 * ---------------------------------------------------
 * Separate rendering "WP Shortcode" module on front-end pages
 */
(function($){
	$.fn.UixPBRenderWPShortcode=function(options){
		var settings=$.extend({
			'postID'  : '1234',
		}
		,options);
		this.each(function(){
			
			var $this       = $( this ),
				$postID     = settings.postID,
				$ifm        = $( '#uix-page-builder-themepreview' ).contents();
			
			
			$ifm.find( '.uix-page-builder-themepreview-wp-shortcode' ).load( ajaxurl + '?action=uix_page_builder_output_frontend_settings&post_id='+$postID+'&pb_render_entire_page=1&security='+uix_page_builder_layoutdata.send_string_nonce, function( response, status, xhr ) {
				
				var $frontend = $( this );
				
				//Add shortcut buttons to front-end page 
				gridsterAddShortcutButtons();
				
				//Trigger the front end of the JavaScript function "uix_pb_render_trigger()"
				$( document ).UixPBRenderFrontendPageTrigger();


				
				//Initialize the map container
				$frontend.find( '.uix-page-builder-map-preview-container' ).filter( function( index ) {
					
					var $frame    = $( this ),
						fullclass = $frame.parent( 'div' ).attr( 'class' ),
						curheight = $frame.data( 'height' );
					
					$frame.prev( '.uix-page-builder-map-preview-tmpl' ).load( uix_page_builder_layoutdata.send_string_plugin_url + 'includes/admin/preview/map.html', function( response, status, xhr ) {
					
						response = response.replace(/\<script([^>]+)\>/g, '' ).replace(/\<\/script\>/g, '' );

						//If it is full screen map
						if( typeof fullclass != typeof undefined ) {
							if ( fullclass.indexOf( 'full' ) > 0 ) {

								$frame.css( 'height', $( window ).height() + 'px' );
								curheight = '100%';
							} 		
						}
						
						$frame.UixPBTmpl( response, {
							pluginPath : uix_page_builder_layoutdata.send_string_plugin_url,
							width      : $frame.data( 'width' ),
							height     : curheight,
							style      : $frame.data( 'style' ),
							apikey     : $frame.data( 'apikey' ),
							latitude   : $frame.data( 'latitude' ),
							longitude  : $frame.data( 'longitude' ),
							zoom       : $frame.data( 'zoom' ),
							name       : $frame.data( 'name' ),
							marker     : $frame.data( 'marker' )
						} );
					});
					
				});
		
				
			});

		
			
			
		})
	}
})(jQuery);



/*!
 *
 * Sidebar controler
 * ---------------------------------------------------
 */
(function($){
	$.fn.UixPBRenderSidebar=function(options){
		var settings=$.extend({
			'method' : 'auto'
		}
		,options);
		this.each(function(){
			
			var elements     = 'ul.uix-page-builder-res-selector, .uix-page-builder-gridster-addbtn.visualBuilder, #uix-page-builder-visualBuilder-loader, #uix-page-builder-gridster-wrapper.visualBuilder, .uix-page-builder-themepreview-btn, .uix-page-builder-themepreview-btn#uix-page-builder-themepreview-btn-close';
				
			
			$( document ).on( 'click', '#uix-page-builder-themepreview-btn-close', function( e ) {
				e.preventDefault();
				
				var $preview = $( '#uix-page-builder-themepreview' ),
					oldPo    = parseFloat( $preview.css( 'left' ) ),
					target   = $( elements );    
				
				if ( $( 'body' ).hasClass( 'rtl' ) ) {
					oldPo = parseFloat( $preview.css( 'right' ) );
				}
		

				if ( oldPo == 0 ) {
					//Sidebar open
					target.removeClass( 'active' );
					$preview.removeClass( 'active' );
					
				} else {
					//Sidebar close
					target.addClass( 'active' );
					$preview.addClass( 'active' );
				}	
				

				//Responsive preview restores
				$( '.uix-page-builder-res-selector li.active' ).trigger( 'click' );

				

			});
	
			if ( settings.method == 'open' ) {
				$( document ).ready( function() {

					var $preview = $( '#uix-page-builder-themepreview' ),
						target   = $( elements );    

					//Sidebar open
					target.removeClass( 'active' );
					$preview.removeClass( 'active' );

					//Responsive preview restores
					$( '.uix-page-builder-res-selector li.active' ).trigger( 'click' );


					
				});
	
			}
			

			
			
		})
	}
})(jQuery);
	
	
/*!
 *
 * Reload the front-end javascripts to make the live preview take effect.
 * Trigger the front end of the JavaScript function "uix_pb_render_trigger()"
 * ---------------------------------------------------
 */
(function($){
	$.fn.UixPBRenderFrontendPageTrigger=function(options){
		var settings=$.extend( {}, options );
		this.each(function(){
			
			if ( typeof ( $( '#uix-page-builder-themepreview' ).get(0).contentWindow.uix_pb_render_trigger ) == 'function' ) {
				$( '#uix-page-builder-themepreview' ).get(0).contentWindow.uix_pb_render_trigger();
				//console.log( 'Re-render the front-end javascript!');
			}

		})
	}
})(jQuery);


					
			



/*!
 * jQuery Accessible Tabs for Uix Page Builder (!!!change the plugin name)
 *
 * @description: Creates accessible tabs - a single content area with multiple panels
 * @source: https://github.com/nomensa/jquery.accessible-tabs.git
 * @version: '0.1.1'
 *
 * @author: Nomensa
 * @license: licenced under MIT - http://opensource.org/licenses/mit-license.php
*/

(function($, window, document, undefined) {
    'use strict';

    var pluginName,
        defaults,
        counter = 0;

    pluginName = 'UixPBComColTabs';
    defaults = {
        // Specify which tab to open by default using 0-based position
        defaultTab: 0,
        // Callback when the plugin is created
        callbackCreate: function() {},
        // Callback when the plugin is destroyed
        callbackDestroy: function() {},
        // A class applied to the target element
        containerClass: 'js-tabs',
        // A class applied to the active tab control
        controlActiveClass: 'js-tabs_control-item--active',
        // An explanation of how the tabs operate, which is prepended to the tabs content
        controlsText: 'Use the tab and enter or arrow keys to move between tabs',
        // Class to apply to the controls text element
        controlsTextClass: 'js-tabs_control-text',
        // Class to apply the controls list
        tabControlsClass: 'js-tabs_control',
        // Ids for tab controls should start with the following string
        tabControlId: 'js-tabs_control-item--',
        // Class to be applied to the tab panel
        tabPanelClass: 'js-tabs_panel',
        // Ids for tab panels should start with the following string
        tabPanelId: 'js-tabs_panel--'
    };

    function AccTabs(element, options) {
    /*
     Constructor function for the tabs plugin
     */
        var self = this;

        self.element = $(element);
        // Combine user options with default options
        self.options = $.extend({}, defaults, options);

        function init() {
        /*
            Our init function to create an instance of the plugin
        */
            self.controlsWrapper = $('<ul class="' + self.options.tabControlsClass + '" role="tablist" />');

            // Create a control for each tab panel
            $('> div', self.element).each(function(index, value) {
                var tabId = self.options.tabControlId + counter + index,
                    panelId = self.options.tabPanelId + counter + index,
                    heading = $($(value).prev()),
                    headingContent = heading.html(),
                    liMarkup = $('<li role="presentation">' +
                                     '<button aria-selected="false" data-controls="' + panelId + '" id="' + tabId + '" role="tab">' +
                                         headingContent +
                                     '</button>' +
                                 '</li>');

                // Hide heading that has been used for the control button text
                heading.hide();

                // Bind event handlers
                $('button', liMarkup)
                    .click(createHandleClick(self))
                    .keydown(createHandleKeyDown(self));

                self.controlsWrapper.append(liMarkup);
            });

            // Prepend the constructed controls
            self.element.prepend(self.controlsWrapper);

            // Add classes and attributes to tab panels
            $('> div', self.element).each(function(index, value) {
                $(value)
                    .addClass(self.options.tabPanelClass)
                    .attr({
                        'aria-hidden': 'true',
                        'aria-labelledby': self.options.tabControlId + counter + index,
                        'id': self.options.tabPanelId + counter + index,
                        'role': 'tabpanel'
                    })
                    .hide();
            });

            // Add explanatory control text
            self.controlsTextWrapper = $('<p class="' + self.options.controlsTextClass + '">' + self.options.controlsText + '</p>');
            self.element.prepend(self.controlsTextWrapper);

            // Activate the default tab
            self.activateTab($('button', self.controlsWrapper).eq(self.options.defaultTab));

            // Add the active class
            self.element.addClass(self.options.containerClass);

            // Increment counter for unique ID's
            counter++;

            self.options.callbackCreate();
        }

        function createHandleClick() {
        /*
            Create the click event handle
        */
            self.handleClick = function(event) {
                event.preventDefault();

                self.activateTab(this);
            };
            return self.handleClick;
        }

        function createHandleKeyDown() {
        /*
            Create the keydown event handle
        */
            self.handleKeyDown = function(event) {
                switch (event.which) {
                    // arrow left or up
                    case 37:
                    case 38:
                        event.preventDefault();

                        // Allow us to loop through the controls
                        if ($(this).parent().prev().length !== 0) {
                            $(this).parent().prev().find('> button').focus().click();
                        } else {
                            $(self.controlsWrapper).find('li:last > button').focus().click();
                        }
                        break;
                    // arrow right or down
                    case 39:
                    case 40:
                        event.preventDefault();

                        // Allow us to loop through the controls
                        if ($(this).parent().next().length !== 0) {
                            $(this).parent().next().find('> button').focus().click();
                        } else {
                            $(self.controlsWrapper).find('li:first > button').focus().click();
                        }
                        break;
                }
            };
            return self.handleKeyDown;
        }

        init();
    }

    AccTabs.prototype.activateTab = function(tab) {
    /*
        Public method for activating a tab
    */
        // Checks if the tab is already active before trying to activate it
        if ($(tab).attr('aria-selected') === 'false') {
            var activeTabClass = this.options.controlActiveClass,
                tabPanelId = '#' + $(tab).attr('data-controls');

            // Reset state if another tab is active
            if ($('[aria-selected="true"]', this.controlsWrapper).length !== 0) {
                $('[aria-selected="true"]', this.controlsWrapper)
                    .attr('aria-selected', 'false')
                    .parent('li').removeClass(activeTabClass);

                $('> [aria-hidden="false"]', this.element)
                    .attr('aria-hidden', 'true')
                    .hide();
            }

            // Update state of newly selected tab control
            $(tab, this.element).attr('aria-selected', 'true');
            $(tab, this.element).parent('li').addClass(activeTabClass);

            // Update state of newly selected tab panel
            $(tabPanelId, this.element)
                .attr('aria-hidden', 'false')
                .show();
        }
    };

    AccTabs.prototype.rebuild = function() {
    /*
        Public method for rebuild the plugin and options
    */
        return new AccTabs(this.element, this.options);
    };

    AccTabs.prototype.destroy = function () {
    /*
        Public method for return the DOM back to its initial state
    */
        var self = this;

        this.element.removeClass(this.options.containerClass);
        $('> .' + this.options.controlsTextClass, this.element).remove();
        $('> .' + this.options.tabControlsClass, this.element).remove();
        $('> div', this.element).prev().removeAttr('style');

        $('> div', this.element).each(function(index, value) {
            $(value)
                .removeAttr('aria-hidden aria-labelledby id role style')
                .removeClass(self.options.tabPanelClass);
        });

        this.options.callbackDestroy();
    };

    $.fn[pluginName] = function(options) {
    /*
        Guards against multiple instantiations
    */
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new AccTabs(this, options));
            }
        });
    };

})(jQuery, window, document);
