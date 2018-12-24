<?php
/**
 * The core function of Drag & Drop
 * 
 * @access public
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


class UixPB_Components_DD_Core extends UixPageBuilder {

	/**
	 * The corresponding JSON data for each page
	 *
	 * @access private
	 * @var JSON data
	 */
	private $old_layoutdata;
	
	
	/**
	 * The current page ID
	 *
	 * @access private
	 * @var string
	 */
	private $curid;
	
	
	public function __construct( $old_layoutdata, $curid ) {
		
		$this->old_layoutdata = $old_layoutdata;
		$this->curid          = $curid;
		
		$this -> output();
		
	}
	
	private function output() {
		
		$old_layoutdata = $this->old_layoutdata;
		$curid          = $this->curid;
		
	?>
	<script type="text/javascript">

	var gridsterWidth       = 0,
		gridsterMarginsX    = 0,
		gridsterMarginsY    = 15,
		gridsterMinheight   = 25,
		gridsterVisualWidth = 315,
		gridsterNormalWdiff = 60,
		vbmode              = false,
		oww                 = 0,
		gridster            = null,
		currently_editing   = null,
		currently_removing  = null,
		saved_data          = '<?php echo json_encode( self::page_builder_array_newlist( $old_layoutdata ) ); ?>',
		saved_data          = JSON.parse( saved_data ),
		backURL             = '<?php echo uix_page_builder_get_normalEditor_pageURL( $curid ); ?>';

	<?php if ( self::vb_mode() ) { ?>
	vbmode = true;
	<?php } ?>	

	var UixPBGridsterMain = function( obj ) {
		"use strict";


		var UixPBGridsterConstructor = function( obj ) {
			this.init = obj;
		};

		UixPBGridsterConstructor.prototype = {


			/*! 
			 * 
			 * [Gridster] Initialize the loaded page
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */
			pageInit: function() {

				jQuery( document ).ready( function() {

					if ( ! vbmode ) {	
						gridsterWidth = jQuery( '#titlediv .inside' ).width() - gridsterNormalWdiff;
					} else {
						gridsterWidth = gridsterVisualWidth;
					}


					if ( vbmode ) {

						//Page template changed
						jQuery( document ).on( 'change', "[name='uix-page-builder-cur-page-template']", function() {

							//Close the window of template selector
							jQuery( this ).parent().parent().hide();

							//Update the WP page template
							jQuery.post( ajaxurl, {
								action               : 'uix_page_builder_savePageTemplate_settings',
								pagetemp             : jQuery( this ).find( ':selected' ).val(),
								postID               : uix_page_builder_layoutdata.send_string_postid,
								security             : uix_page_builder_layoutdata.send_string_nonce
							}, function ( response ) {

							});

							//Sidebar controler
							jQuery( document ).UixPBRenderSidebar( { method: 'open' } );


							/*-- Render and save page data --*/
							UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 0 ); //Initialize the page container


						});

						//Widget layout changed
						jQuery( document ).on( 'change', "input[type='radio'][class='layout-box']", function() {
							/*-- Render and save page data --*/
							UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page

						});

					}



					/*-- Render and save page data --*/
					UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 0 ); //Initialize the page container



					oww = jQuery( window ).width();

					/*-- Initialize gridster --*/
					UixPBGridsterConstructor.prototype.widgetsInit.call( this );

					jQuery( window ).on( 'resize', function() {

						/*-- Initialize gridster --*/
						UixPBGridsterConstructor.prototype.widgetsInit.call( this );

					});


					/*-- Visual Builder Primary Buttons --*/
					jQuery( '.exit-visual-builder' ).on( 'mouseenter', function(){
						jQuery( '.li.full' ).show();
					});
					jQuery( '.li a, #uix-page-builder-themepreview, .sortable-list .row' ).not( '.exit-visual-builder, .publish-visual-builder' ).on( 'mouseenter', function(){
						jQuery( '.li.full' ).hide();
					});	

					jQuery( '.li.full' ).on( 'mouseleave', function(){
						jQuery( this ).hide();
					});


					/*
					jQuery( document ).on( 'click', '.publish-visual-builder', function( e ) {
						e.preventDefault();

						jQuery( this ).addClass( 'wait' );

						//Initialize the publish button when current admin page in "Visual Builder" mode
						UixPBGridsterConstructor.prototype.formVisualPublish.call( this );	

						//Prevent hyperlink response	
						return false;
					});
					*/
					

					/*-- Add a new widget --*/
					jQuery( document ).on( 'click', '.uix-page-builder-gridster-addbtn .add', function( e ) {
						e.preventDefault();

						UixPBGridsterConstructor.prototype.addRow.call( this );	

						//Prevent hyperlink response	
						return false;	
					});

					/*-- Template preview --*/
					jQuery( document ).on( 'mouseenter', '.settings-temp-wrapper label', function(){
						jQuery( '.settings-temp-wrapper label .preview-thumb' ).hide().animate( { marginTop: '10px', opacity: 0 }, { duration: 0 } );
						jQuery( this ).find( '.preview-thumb' ).show().animate( { marginTop: 0, opacity: 1 }, { duration: 150 } );

					}).on( 'mouseleave' , function(){
						jQuery( this ).find( '.preview-thumb' ).animate( { marginTop:  '10px', opacity: 0 }, { duration: 150,
								complete: function() {
									jQuery( this ).hide();
								}
						} );		
					});			

					jQuery( document ).on( 'mouseleave', '.settings-temp-wrapper #uix-page-builder-templatelist ', function(){
						jQuery( '.settings-temp-wrapper label .preview-thumb' ).hide().animate( { marginTop: '10px', opacity: 0 }, { duration: 0 } );
					});	



					/*-- Remove the currently selected widget --*/
					jQuery( document ).on( 'click', '.remove-gridster-widget', function( e ) {
						e.preventDefault();

						var id = jQuery( this ).data( 'uid' );
						UixPBGridsterConstructor.prototype.removeWidget.call( this, id );	

						//Prevent hyperlink response	
						return false;	
					});



					/*-- Add a widget for column --*/
					jQuery( document ).on( 'click', '.widget-items-col-container .btnlist > a', function( e ) {
						e.preventDefault();


						var add = jQuery( this ).data( 'add' ),
							uid = jQuery( this ).data( 'uid' ),
							contentid = jQuery( this ).data( 'contentid' ),
							col = jQuery( this ).data( 'col' ),
							content = jQuery( this ).data( 'content' ),
							list = jQuery( this ).data( 'list' );


						//Initialize the publish button when current admin page in "Visual Builder" mode
						UixPBGridsterConstructor.prototype.itemAddCol.call( this, add, uid, contentid, col, content, list );	

						//Prevent hyperlink response	
						return false;
					});


					/*-- Load and initialize editable widgets (Calling "editRow" method using JavaScript prototype) --*/
					UixPBGridsterConstructor.prototype.editRow.call( this, saved_data );	


				});


				//Chain method calls
				return this;
			},


			/*! 
			 * 
			 * [Gridster] Load and initialize editable widgets
			 * ---------------------------------------------------
			 *
			 * @param  {string} curdata        - The builder content data with JSON 
			 * @return {void}                  - The constructor.
			 */
			editRow: function( curdata ) {


				jQuery( document ).ready( function() {


					jQuery( '.gridster ul' ).gridster({
						widget_base_dimensions : [ gridsterWidth, gridsterMinheight ],
						widget_margins         : [ gridsterMarginsX, gridsterMarginsY ],
						max_cols               : 1,
						resize                 : {
							enabled: false
						},
						draggable: {
							handle: '.uix-page-builder-gridster-drag',
							drag: function( e, ui, $widget ) {
								var thispos   = ui.$player[0].dataset,
									curwidget = jQuery( '#uix-page-builder-gridster-widget-' + thispos.id );

								curwidget.addClass( 'move' );

							},
							stop: function( e, ui, $widget ) {

								/*-- Initialize default value & form --*/
								UixPBGridsterConstructor.prototype.formDataSave.call( this );


								/*-- Render and save page data --*/
								UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page

								var newpos    = this.serialize($widget)[0],
									thispos   = ui.$player[0].dataset,
									curwidget = jQuery( '#uix-page-builder-gridster-widget-' + thispos.id )

								curwidget.removeClass( 'move' );

								//console.log('draggable stop thispos = ' + JSON.stringify(thispos));
								//console.log( "New col: " + newpos.col + " New row: " + newpos.row );
							}
						},
						serialize_params: function( $w, wgd ){ 
							
							
							var obj = {
								col          : wgd.col, 
								row          : wgd.row, 
								size_x       : wgd.size_x, 
								size_y       : wgd.size_y,
								content      : jQuery( $w[0] ).find( '.content-box' ).val(),
								secindex     : jQuery( $w[0] ).find( '.sid-box' ).val(),
								layout       : jQuery( $w[0] ).find( '.layout-box:checked' ).val(),
								customid     : gridsterStrToSlug( jQuery( $w[0] ).find( '.cusid-box' ).val() ),
								title        : gridsterStrToTitle( jQuery( $w[0] ).find( '.title-box' ).val() )

							} ;
							
							
							return obj;
						}
					});


					gridster = jQuery( '.gridster ul' ).gridster().data( 'gridster' );

					//Initialize gridster
					if ( jQuery( "[name='uix-page-builder-layoutdata']" ).val().length > 2 ) {
						gridster.remove_all_widgets();
						jQuery( '.gridster ul' ).empty();
					}


					for(var iii = 0; iii < curdata.length; iii++) {


						//current widget id
						var row_index  = iii + 1,
							uid        = gridsterContent( curdata[iii].content, 'id', curdata[iii].secindex );

						if( typeof uid === typeof undefined ) {
							uid = curdata[iii].secindex;
						}



						var titleid        = 'title-data-'+uid,
							contentid      = 'content-data-'+uid,
							layout_boxed   = ( curdata[iii].layout == 'boxed' ) ? 'checked' : '',
							layout_fw      = ( curdata[iii].layout == 'fullwidth' ) ? 'checked' : '';



						gridster.add_widget( '<li id="uix-page-builder-gridster-widget-'+uid+'" class="uix-page-builder-gridster-widget" data-id="'+uid+'" data-row="'+curdata[iii].row+'" data-col="'+curdata[iii].col+'" data-sizex="'+curdata[iii].size_x+'" data-sizey="'+curdata[iii].size_y+'"><div><i class="dashicons dashicons-admin-generic settings" title="<?php echo esc_attr__( 'Settings', 'uix-page-builder' ); ?>"></i><div class="settings-wrapper"><a href="javascript:" class="close">&times;</a><p><strong><?php _e( 'ID', 'uix-page-builder' ); ?></strong><input type="text" size="15" class="cusid-box" value="'+curdata[iii].customid+'"></p><p><strong><?php _e( 'Container', 'uix-page-builder' ); ?></strong><label><input type="radio" class="layout-box" name="layout'+curdata[iii].row+'" value="boxed" '+layout_boxed+'><?php _e( 'Boxed', 'uix-page-builder' ); ?></label><label><input type="radio" class="layout-box" name="layout'+curdata[iii].row+'" value="fullwidth" '+layout_fw+'><?php _e( 'Full Width', 'uix-page-builder' ); ?></label></p></div><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Section', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="'+ gridsterHtmlEscape( curdata[iii].title ) +'"><input type="hidden" class="sid-box" value="'+curdata[iii].secindex+'"></div><button class="remove-gridster-widget" data-uid="'+uid+'"><i class="dashicons dashicons-no"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'">'+gridsterHtmlUnescape( curdata[iii].content )+'</textarea><?php self::list_page_itembuttons();?></div></li>', curdata[iii].size_x, curdata[iii].size_y, curdata[iii].col, curdata[iii].row );

						if ( curdata[iii].content != '' ) {

							var allcontent = gridsterContent( curdata[iii].content, 'content', '' );


							//Transit the replacement value
							jQuery( '#cols-all-content-replace-' + uid ).val( curdata[iii].content.replace( allcontent, '{allcontent}' ) );	


							//Default value & form show
							var conLen          = gridsterColsContent( allcontent, 'length', 1 ),
								default_value   = [],
								list_code       = '',
								colid           = '',
								cid             = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];


							for ( var k = 1; k <= conLen; k ++ ) {
								default_value.push( gridsterColsContent( allcontent, 'content', k ) );

								for( var i in cid ) {
									if ( gridsterColsContent( allcontent, 'content', k ).indexOf( 'col-item-'+cid[i] ) >= 0  ) {
										colid  = cid[i];

										//Resize widget size
										UixPBGridsterConstructor.prototype.widgetResize.call( this, uid, colid );

										//Data already exists
										list_code += UixPBGridsterConstructor.prototype.itemAddColPer.call( this, uid, contentid, cid[i] );


										if ( colid == '3_4' ) {
											<?php self::list_page_sortable_li_btns( '3_4' );?>
										}
										if ( colid == '1_4' ) {
											<?php self::list_page_sortable_li_btns( '1_4' );?>
										}
										if ( colid == '2_3' ) {
											<?php self::list_page_sortable_li_btns( '2_3' );?>
										}
										if ( colid == '1_3' ) {
											<?php self::list_page_sortable_li_btns( '1_3' );?>
										}
										if ( colid == '4__1' ) {
											<?php self::list_page_sortable_li_btns( '4__1' );?>
										}
										if ( colid == '4__2' ) {
											<?php self::list_page_sortable_li_btns( '4__2' );?>
										}
										if ( colid == '4__3' ) {
											<?php self::list_page_sortable_li_btns( '4__3' );?>
										}
										if ( colid == '4__4' ) {
											<?php self::list_page_sortable_li_btns( '4__4' );?>
										}
										if ( colid == '3__1' ) {
											<?php self::list_page_sortable_li_btns( '3__1' );?>
										}
										if ( colid == '3__2' ) {
											<?php self::list_page_sortable_li_btns( '3__2' );?>
										}
										if ( colid == '3__3' ) {
											<?php self::list_page_sortable_li_btns( '3__3' );?>
										}
										if ( colid == '2__1' ) {
											<?php self::list_page_sortable_li_btns( '2__1' );?>
										}
										if ( colid == '2__2' ) {
											<?php self::list_page_sortable_li_btns( '2__2' );?>
										}
										if ( colid == '1__1' ) {
											<?php self::list_page_sortable_li_btns( '1__1' );?>
										}



									}

								}


							}



							list_code = '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+colid+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">'+list_code+'</ul></div>';

							//Add a default value when there is no column of data
							UixPBGridsterConstructor.prototype.itemAddCol.call( this, 1, uid, contentid, '', default_value, list_code );




						}


					}//end for


					/*-- Initialize gridster --*/
					UixPBGridsterConstructor.prototype.widgetsInit.call( this );


					//save with ajax
					jQuery( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
						e.preventDefault();

						var $form            = jQuery( this ).closest( 'form' ),
							tmplValueEmpty   = $form.find( '.uixpbform-tmpl-textarea' ).data( 'tmpl-value' ),
							newValue         = $form.find( '.uixpbform-tmpl-textarea' ).val();


						// Discard the rendering of separated module when the module contains these WP shortcodes
						var hasShortcode = uixpbform_per_module_has_shortcode( newValue );

						setTimeout( function() {
							var settings = jQuery( "[name='uix-page-builder-layoutdata']" ).val();
							//console.log( settings );

							// retrieve the widget settings form
							jQuery.post( ajaxurl, {
								action               : 'uix_page_builder_metaboxes_save_settings',
								layoutdata           : settings,
								postID               : uix_page_builder_layoutdata.send_string_postid,
								security             : uix_page_builder_layoutdata.send_string_nonce
							}, function ( response ) {


								/*-- Render and save page data --*/
								if ( ! hasShortcode ) {
									if ( tmplValueEmpty == 0 ) {
										UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page
									} else {
										UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 1 );
									}
								} else {
									//Filter shortcodes of each column widget HTML code through their hooks.
									UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page
								}	





								/*-- Initialize per column module buttons status (Has been clicked) --*/
								gridsterItemElementsBTStatus( 1 );

							});

							// stuff here
							return false;	

						}, 500 );

					});	


					/*-- Initialize default value & form --*/
					UixPBGridsterConstructor.prototype.formDataSave.call( this );

					/*-- Render and save page data --*/
					UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 1 );

					/*-- Spy the form elements --*/
					UixPBGridsterConstructor.prototype.formSpy.call( this );

					/*-- Initialize gridster widgets status --*/
					UixPBGridsterConstructor.prototype.widgetStatus.call( this );

					/*-- Initialize per column module buttons status (The click action has not yet been performed.) --*/
					gridsterItemElementsBTStatus( 0 );


				});




				//Chain method calls
				return this;
			},


			/*! 
			 * 
			 * [Gridster] Add a new widget
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			addRow: function() {

				jQuery( document ).ready( function() {

					var $widgets    = jQuery( '.gridster > ul > li' ),
						newrow      = $widgets.length + 1,
						titleid     = 'title-data-'+newrow,
						contentid   = 'content-data-'+newrow,
						uid         =  gridsterRowUID(); //Must be unique, otherwise it will cause the deleted data after the confusion


					gridster.add_widget( '<li id="uix-page-builder-gridster-widget-'+uid+'" class="uix-page-builder-gridster-widget" data-id="'+uid+'"><div><i class="dashicons dashicons-admin-generic settings" title="<?php echo esc_attr__( 'Settings', 'uix-page-builder' ); ?>"></i><div class="settings-wrapper"><a href="javascript:" class="close">&times;</a><p><strong><?php _e( 'ID', 'uix-page-builder' ); ?></strong><input type="text" size="15" class="cusid-box" value="section-'+uid+'"></p><p><strong><?php _e( 'Container', 'uix-page-builder' ); ?></strong><label><input type="radio" class="layout-box" name="layout'+uid+'" value="boxed" checked><?php _e( 'Boxed', 'uix-page-builder' ); ?></label><label><input type="radio" class="layout-box" name="layout'+uid+'" value="fullwidth"><?php _e( 'Full Width', 'uix-page-builder' ); ?></label></p></div><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Section', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="<?php _e( 'Untitled', 'uix-page-builder' ); ?>"><input type="hidden" class="sid-box" value="'+uid+'"></div><button class="remove-gridster-widget" data-uid="'+uid+'"><i class="dashicons dashicons-no"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'"></textarea><?php self::list_page_itembuttons();?></div></li>', 1, 2 ).fadeIn( 100, function() {

							/*-- Spy the form elements --*/
							UixPBGridsterConstructor.prototype.formSpy.call( this );
					});


					/*-- Initialize default value & form --*/
					UixPBGridsterConstructor.prototype.formDataSave.call( this );


					/*-- Initialize gridster --*/
					UixPBGridsterConstructor.prototype.widgetsInit.call( this );

					/*-- Welcome text --*/
					jQuery( '#uix-page-builder-layoutdata-none' ).hide();


					/*-- Navigate to the current row --*/
					if ( vbmode ) {
						jQuery( '#uix-page-builder-gridster-wrapper' ).delay( 100 ).animate( { scrollTop: jQuery( '#uix-page-builder-gridster-wrapper' ).scrollTop() + jQuery( '#uix-page-builder-gridster-widget-'+uid ).offset().top + 50 }, 100 );
					}

				});


				//Chain method calls
				return this;
			},


			/*! 
			 * 
			 * [Gridster] Remove the currently selected widget
			 * ---------------------------------------------------
			 *
			 * @param  {number} uid            - The widget ID number.
			 * @return {void}                  - The constructor.
			 */	
			removeWidget: function( uid ) {

				jQuery( document ).ready( function() {

					gridster.remove_widget( jQuery( '#uix-page-builder-gridster-widget-' + uid ) );

					/*-- Initialize default value & form --*/
					UixPBGridsterConstructor.prototype.formDataSave.call( this );

					/*-- Render and save page data --*/
					UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page

				} );

				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster] Save the form data
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			formDataSave: function() {

				jQuery( document ).ready( function() {  
					var json_str = JSON.stringify( gridster.serialize() );
					json_str = json_str.replace(/(\r)*\n/g, '<br>' ).replace(/\\r/g, '' ).replace(/\\/g, '' );

					jQuery( '#uix-page-builder-layoutdata' ).val( json_str );

					/*-- Initialize gridster widgets status --*/
					UixPBGridsterConstructor.prototype.widgetStatus.call( this );

				});

				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster] Render and save page data
			 * ---------------------------------------------------
			 *
			 * @param  {number} type          - 0: Initialize the page container | 1: No render action | 2: Render the entire page
			 * @return {void}                  - The constructor.
			 */
			renderAndSavePage: function( type ) {

				jQuery( document ).ready( function() {

					if ( vbmode ) {	

						//show loader
						if ( type == 0 ) {
							jQuery( '#uix-page-builder-visualBuilder-loader, #uix-page-builder-visualBuilder-loader .loader' ).show();
						}


						var $saveobj = jQuery( '#uix-page-builder-save-status' );

						$saveobj.addClass( 'wait' ).text( '<?php echo esc_html__( 'Saving...', 'uix-page-builder' ); ?>' );

						jQuery.post( ajaxurl, {
							action               : 'uix_page_builder_saveLiveRender_settings',
							layoutdata           : jQuery( "[name='uix-page-builder-layoutdata']" ).val(),
							postID               : uix_page_builder_layoutdata.send_string_postid,
							security             : uix_page_builder_layoutdata.send_string_nonce
						}, function ( response ) {
							if ( response == 1 ) {


								//render page viewport
								jQuery( document ).UixPBRenderPage( { enable: type } );

								//save status
								$saveobj.text( '<?php echo esc_html__( 'Data has been saved.', 'uix-page-builder' ); ?>' );
								setTimeout( function() {
									$saveobj.text( '<?php echo esc_html__( 'Saving...', 'uix-page-builder' ); ?>' ).removeClass( 'wait' );
								}, 1500 );

								//remove entire page loader when rendered
								jQuery( '#uix-page-builder-themepreview' ).contents().find( '.uix-page-builder-editicon' ).removeClass( 'active' );


							}
						});


						// stuff here
						return false;		

					}


				});

				//Chain method calls
				return this;
			},		


			/*! 
			 * 
			 * [Gridster] Initialize the publish button when current admin page in "Visual Builder" mode
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			widgetStatus: function() {

				jQuery( document ).ready( function() {  
					jQuery( '.gridster > ul > li' ).each( function() {
						var $this = jQuery( this );
						if ( $this.find( '.content-box' ).val() != '') {
							$this.addClass( 'active' );
						} else {
							$this.removeClass( 'active' );
						}
					});

				});

				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster] Spy the form elements
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			formSpy: function() {

				jQuery( document ).ready( function() {  
					jQuery( '.gridster > ul > li' ).each( function() {
						var $this = jQuery( this );
						$this.find( '.content-box, .title-box, .cusid-box, [name^="layout"]' ).on( 'change', function() {

							/*-- Initialize default value & form --*/
							UixPBGridsterConstructor.prototype.formDataSave.call( this );

							/*-- Render and save page data --*/
							UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 1 );

						});

					});

				});


				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster] Initialize gridster
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			widgetsInit: function() {

				jQuery( document ).ready( function() {  
					var ow;

					if ( ! vbmode ) {	
						ow = jQuery( '#titlediv .inside' ).width() - gridsterNormalWdiff;
					} else {
						ow = gridsterVisualWidth;
					}

					jQuery( '.uix-page-builder-gridster-widget' ).css( {'width': ow + 'px' } );


				});	

				//Chain method calls
				return this;
			},		


			/*! 
			 * 
			 * [Gridster & Sortable ] Each row of sortable item initialization
			 * ---------------------------------------------------
			 *
			 * @param  {number} uid            - The widget ID number.
			 * @return {void}                  - The constructor.
			 */	
			itemSortableInit: function( uid ) {

				 jQuery( document ).ready( function() {

					var item_sortable = '.sortable-list-container'; //Sortable list container ID

					jQuery( item_sortable + '-'+uid+' .sortable-list' ).sortable({
						start: function(event, ui) {
							var start_pos = ui.item.index();
							ui.item.data( 'start_pos', start_pos );

						},
						change : function(event, ui) {

							var start_pos = ui.item.data('start_pos');
							var index = ui.placeholder.index();
							if (start_pos < index) {
								jQuery( item_sortable + '-'+uid+' li:nth-child(' + index + ')' ).addClass( 'list-group-item-success' );
							} else {
								jQuery( item_sortable + '-'+uid+' li:eq(' + (index + 1) + ')' ).addClass( 'list-group-item-success' );
							}



						},

						update: function( event, ui ) {

							/*-- Save the data for each sortable item --*/
							UixPBGridsterConstructor.prototype.itemSave.call( this, uid );

							/*-- Initialize default value & form --*/
							UixPBGridsterConstructor.prototype.formDataSave.call( this );

							/*-- Render and save page data --*/
							UixPBGridsterConstructor.prototype.renderAndSavePage.call( this, 2 ); //Render the entire page


							jQuery( item_sortable + '-'+uid+' li' ).removeClass( 'list-group-item-success' );

						}
					});


					/*-- Save the data for each sortable item --*/
					UixPBGridsterConstructor.prototype.itemSave.call( this, uid );


				 });


				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster & Sortable] Save the data for each sortable item
			 * ---------------------------------------------------
			 *
			 * @param  {number} uid            - The widget ID number.
			 * @return {void}                  - The constructor.
			 */	
			itemSave: function( uid ) {

				jQuery( document ).ready( function() {  
					var item_sortable    = '.sortable-list-container', //Sortable list container ID
						result           = [],
						allcontentID     = '',
						allcontentRpID   = '',
						sectionContentID = '',
						total            = jQuery( item_sortable + '-'+uid+' li' ).length;

					jQuery( item_sortable + '-'+uid+' li' ).each(function( index ){
						var data                = jQuery( this ).find( 'textarea' ).val(),
							id                  = index + 1,
							classname           = jQuery( this ).attr( 'class' ),
							last                = ( id == total ) ? 'uix-pb-col-last' : '';

						if ( data == null ) data = '';
						allcontentID       = jQuery( this ).parent().parent().data( 'allcontent-tempid' );
						allcontentRpID       = jQuery( this ).parent().parent().data( 'allcontent-replace-tempid' );
						sectionContentID   = jQuery( this ).parent().parent().data( 'contentid' );

						result.push( data );

					});



					jQuery( '#' + allcontentID ).val( result );

					//Save All content
					if ( jQuery( '#' + allcontentRpID ).length > 0 ) {
						result = gridsterFormatAllCodes( result );
						var old = jQuery( '#' + allcontentRpID ).val();
						var newv = old.replace( '{allcontent}', '['+result+']' );
						jQuery( '#' + sectionContentID ).val( newv );	
					}



				});


				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * [Gridster] Initialize the widget size
			 * ---------------------------------------------------
			 *
			 * @param  {number} uid            - The widget ID number.
			 * @param  {string} col            - The index of each column.
			 * @return {void}                  - The constructor.
			 */	
			widgetResize: function( uid, col ) {

				var curwidget = jQuery( '#uix-page-builder-gridster-widget-' + uid );

				if ( vbmode ) {
					if ( col == '3_4' || col == '1_4' || col == '2_3' || col == '1_3' || col == '2__1' || col == '2__2' ) gridster.resize_widget( curwidget, 1, 2 );
					if ( col == '4__1' || col == '4__2' || col == '4__3' || col == '4__4' ) gridster.resize_widget( curwidget, 1, 4 );
					if ( col == '3__1' || col == '3__2' || col == '3__3' ) gridster.resize_widget( curwidget, 1, 3 );
					if ( col == '1__1' ) gridster.resize_widget( curwidget, 1, 2 );
				}

				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * Initialize the publish button when current admin page in "Visual Builder" mode
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			formVisualPublish: function() {

				jQuery( document ).ready( function() {

					if ( vbmode ) {	

						jQuery.post( ajaxurl, {
							action               : 'uix_page_builder_publishLiveRender_settings',
							postID               : uix_page_builder_layoutdata.send_string_postid,
							postTitle            : jQuery( "[name='uix-page-builder-new-pagetitle']" ).val(),
							security             : uix_page_builder_layoutdata.send_string_nonce
						}, function ( response ) {
							if ( response == 1 ) {

								//publish button status
								UixPBGridsterConstructor.prototype.formVisualPublishBtnStatusRestore.call( this );

							}
						});


						// stuff here
						return false;		

					}


				});


				//Chain method calls
				return this;
			},	


			/*! 
			 * 
			 * Initialize the publish button status
			 * ---------------------------------------------------
			 *
			 * @return {void}                  - The constructor.
			 */	
			formVisualPublishBtnStatusRestore: function() {

				jQuery( document ).ready( function() {

					//publish button status
					jQuery( '.publish-visual-builder' ).removeClass( 'wait' );
					jQuery( '.publish-visual-builder i' ).attr( 'class', 'dashicons dashicons-yes' );
					setTimeout( function() {
						jQuery( '.publish-visual-builder i' ).attr( 'class', 'dashicons dashicons-edit' );
					}, 1500 );

				});


				//Chain method calls
				return this;
			},

			/*! 
			 * 
			 * [Gridster] Add a widget HTML code through the existing JSON data
			 * ---------------------------------------------------
			 *
			 * @param  {number} uid            - The widget ID number.
			 * @param  {string} contentid      - The textarea ID of the contents with JSON of each widget.
			 * @param  {string} col            - The index of each column.
			 * @return {string}                - The HTML code for each column
			 */	
			itemAddColPer: function( uid, contentid, col ) {

				var average_code  = '',
					sid           = contentid.replace( 'content-data-', '' );


				if ( col == '3_4' ) average_code = '<?php self::list_page_sortable_li( '3_4' );?>';
				if ( col == '1_4' ) average_code = '<?php self::list_page_sortable_li( '1_4' );?>';
				if ( col == '2_3' ) average_code = '<?php self::list_page_sortable_li( '2_3' );?>';
				if ( col == '1_3' ) average_code = '<?php self::list_page_sortable_li( '1_3' );?>';
				if ( col == '4__1' ) average_code = '<?php self::list_page_sortable_li( '4__1' );?>';
				if ( col == '4__2' ) average_code = '<?php self::list_page_sortable_li( '4__2' );?>';
				if ( col == '4__3' ) average_code = '<?php self::list_page_sortable_li( '4__3' );?>';
				if ( col == '4__4' ) average_code = '<?php self::list_page_sortable_li( '4__4' );?>';
				if ( col == '3__1' ) average_code = '<?php self::list_page_sortable_li( '3__1' );?>';
				if ( col == '3__2' ) average_code = '<?php self::list_page_sortable_li( '3__2' );?>';
				if ( col == '3__3' ) average_code = '<?php self::list_page_sortable_li( '3__3' );?>';
				if ( col == '2__1' ) average_code = '<?php self::list_page_sortable_li( '2__1' );?>';
				if ( col == '2__2' ) average_code = '<?php self::list_page_sortable_li( '2__2' );?>';
				if ( col == '1__1' ) average_code = '<?php self::list_page_sortable_li( '1__1' );?>';


				//Chain method calls
				return average_code;

			},

			/*! 
			 * 
			 * [Gridster] Add a widget
			 * ---------------------------------------------------
			 *
			 * @param  {number} add            - Add a default value when there is no column of data. The optional values: 1, 0
			 * @param  {number} uid            - The widget ID number.
			 * @param  {string} contentid      - The textarea ID of the contents with JSON of each widget.
			 * @param  {string} col            - The index of each column.
			 * @param  {string} content        - The content with JSON to add.
			 * @param  {string} list           - The HTML code of default sortable list.
			 * @return {void}                  - The constructor.
			 */	
			itemAddCol: function( add, uid, contentid, col, content, list ) {

				jQuery( document ).ready( function() {  
					var result        = '',
						average_code  = '',
						colid         = col,
						sid           = contentid.replace( 'content-data-', '' );



					//default value
					gridsterItemRowTextareaInit( content, uid );

					//output html code
					if ( add == 1 ) {
						jQuery( '#cols-content-data-'+uid+'' ).html( list );	
					}

					if ( add == 0 ) {
						result += '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+col+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">';

						// 3_4-1_4 column
						if ( col == '3_4' ) {
							result += '<?php self::list_page_sortable_li( '3_4' );?><?php self::list_page_sortable_li( '1_4' );?>';
							<?php self::list_page_sortable_li_btns( '3_4' );?>
							<?php self::list_page_sortable_li_btns( '1_4' );?>

						}	


						// 1_4-3_4 column
						if ( col == '1_4' ) {
							result += '<?php self::list_page_sortable_li( '1_4' );?><?php self::list_page_sortable_li( '3_4' );?>';
							<?php self::list_page_sortable_li_btns( '1_4' );?>
							<?php self::list_page_sortable_li_btns( '3_4' );?>

						}	

						// 2_3-1_3 column
						if ( col == '2_3' ) {
							result += '<?php self::list_page_sortable_li( '2_3' );?><?php self::list_page_sortable_li( '1_3' );?>';
							<?php self::list_page_sortable_li_btns( '2_3' );?>	
							<?php self::list_page_sortable_li_btns( '1_3' );?>

						}	


						// 1_3-2_3 column
						if ( col == '1_3' ) {
							result += '<?php self::list_page_sortable_li( '1_3' );?><?php self::list_page_sortable_li( '2_3' );?>';	
							<?php self::list_page_sortable_li_btns( '1_3' );?>	
							<?php self::list_page_sortable_li_btns( '2_3' );?>

						}		

						// 4 column
						if ( col == '4__1' || col == '4__2' || col == '4__3' || col == '4__4' ) {
							result += '<?php self::list_page_sortable_li( '4__1' );?><?php self::list_page_sortable_li( '4__2' );?><?php self::list_page_sortable_li( '4__3' );?><?php self::list_page_sortable_li( '4__4' );?>';	
							<?php self::list_page_sortable_li_btns( '4__1' );?>
							<?php self::list_page_sortable_li_btns( '4__2' );?>
							<?php self::list_page_sortable_li_btns( '4__3' );?>
							<?php self::list_page_sortable_li_btns( '4__4' );?>


						}	

						// 3 column
						if ( col == '3__1' || col == '3__2' || col == '3__3' ) {
							result += '<?php self::list_page_sortable_li( '3__1' );?><?php self::list_page_sortable_li( '3__2' );?><?php self::list_page_sortable_li( '3__3' );?>';
							<?php self::list_page_sortable_li_btns( '3__1' );?>	
							<?php self::list_page_sortable_li_btns( '3__2' );?>	
							<?php self::list_page_sortable_li_btns( '3__3' );?>

						}
						// 2 column
						if ( col == '2__1' || col == '2__2' ) {
							result += '<?php self::list_page_sortable_li( '2__1' );?><?php self::list_page_sortable_li( '2__2' );?>';	
							<?php self::list_page_sortable_li_btns( '2__1' );?>	
							<?php self::list_page_sortable_li_btns( '2__2' );?>

						}

						// 1 column
						if ( col == '1__1' ) {	
							result += '<?php self::list_page_sortable_li( '1__1' );?>';	
							<?php self::list_page_sortable_li_btns( '1__1' );?>

						}

						result += '</ul></div>';	

						jQuery( '#cols-content-data-'+uid+'' ).html( result );

						//Resize widget size
						var gridsterInit = new UixPBGridsterMain();
						gridsterInit.widgetResize( uid, col );



					}


					//re-sortable
					var gridsterInit = new UixPBGridsterMain();
					gridsterInit.itemSortableInit( uid ); 


					setTimeout(function(){

						//hide layout button
						jQuery( '.uix-page-builder-gridster-widget' ).each( function() {
							var c = jQuery( this ).find( '.temp-data-1' ).val();
							if ( c.length > 0 ) {
								if ( jQuery( this ).data( 'id' ) == uid ) {
									jQuery( this ).find( '.widget-items-col-container' ).hide();
								}
							}

						} );	



					}, 100);




				});

				//Chain method calls
				return this;

			}	



		};

		return new UixPBGridsterConstructor( obj );
	};


	var gridsterInit = new UixPBGridsterMain();
	gridsterInit.pageInit(); 

	</script>	
	
	<?php	
	}


}

