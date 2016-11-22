<?php
/**
 * UixForm
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 */

class UixFormCore {
	
	const PREFIX = 'uix';

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_form_core' ) );
		add_filter( 'mce_css', array( __CLASS__, 'mce_css' ) );
		
	}
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
		
		//Add Icons
		wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/font-awesome.css', array(), '4.5.0', 'all');
		

	}
	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		 if( get_post_type() == 'page' ) {
			  
				if ( is_admin()) {
					
						//Add Icons
						wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/font-awesome.css', array(), '4.5.0', 'all');
								
						//UixForm
						wp_enqueue_style( 'uixform', self::plug_directory() .'css/uixform.css', false,'1.0.0', 'all');
						wp_enqueue_script( 'uixform', self::plug_directory() .'js/uixform.js', array( 'jquery' ), '1.0.0' );
						wp_enqueue_script( 'uixform-functions', self::plug_directory() .'js/uixform.functions.js', array( 'jquery' ), '1.0.0' );
				
						//Colorpicker
						wp_enqueue_style( 'wp-color-picker' );
						wp_enqueue_script( 'wp-color-picker' );
						

				}
		  }
		

	}
	
	
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
	
		if ( mb_strlen( strpos( $str, $incstr ), 'UTF8' ) > 0 ) {
			return true;
		} else {
			return false;
		}

	}

	
	
	
	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_directory() {

	  return plugin_dir_url( __FILE__ );

	}
	
		
	/*
	 * ========================================================================================================================================
	 * ========================================================================================================================================
	 */			
	

	/*
	 * Load all the form fields in the directory
	 *
	 */
	 public static function load_form_core() {

		foreach ( glob( dirname(__FILE__). "/form-inc/*.php") as $file ) {
			include $file;
		}	 
	 }
	
	
	/*
	 * Get current URI
	 *
	 */
	public static function cur_uri() {

		$protocol = strpos( strtolower( $_SERVER['SERVER_PROTOCOL'] ), 'https' )  === false ? 'http' : 'https';
		$thisURL = $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$weburl = $protocol.'://'.$_SERVER['HTTP_HOST'];
		
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$uri = $_SERVER['REQUEST_URI'];
		} else {
			if ( isset($_SERVER['argv'] ) ) {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
			} else {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
			}
		}
		return $weburl.$uri;


	}
	
	
	/*
	 * Get page URI
	 *
	 */
	
	public static function page_uri() {

		global $post;
		$_c = '';
	
		if ( is_single() || is_page() ) {
			$_c = get_permalink( get_the_ID() );
		}
		if ( is_home() ) {
			$_c = home_url('/');
		}
		if ( is_category() || is_category() && is_paged() ) {
			$_c = get_category_link(get_query_var( 'cat' ) );
		}
		if ( is_tag() || is_tag() && is_paged() ) {
			$_c = get_term_link(get_query_var( 'tag' ), 'post_tag' );
		}
		if ( is_search() || is_search() && is_paged() ) {
			$_c = get_search_link(get_query_var( 'search' ) );
		}
		if ( is_author() ) {
			$_c = esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) ));
		}
		if ( is_date() ) {
			$_c = get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'));
		}
		
		if ( $_c == '' ) {
			$cururl = self::cur_uri();
			if ( is_paged() ) {
				
				if ( strpos( $cururl, '&paged=') ){
					$cururl_new = explode( '&paged=', $cururl );
					$cururl = $cururl_new[0];
					
				}
				
				
				if ( strpos( $cururl, '/page') ){
					$cururl_new = explode( '/page', $cururl );
					$cururl = $cururl_new[0];
				}
				
		
			}
			$_c = $cururl;
		}
		
	    return $_c;

	}



	
	/*
	 * Transform string to slug for filterable categories
	 *
	 *
	 */
	public static function transform_slug( $str ) {
	
		return str_replace( ' ', '-', strtolower( $str ) );

	}

	/*
	 * Display categories on page
	 *
	 *
	 */
	public static function cat_list( $str, $classprefix = 'uix-pb-portfolio-' ) {

		$list = array();  
		$c = preg_match_all( '/\<div class="'.$classprefix.'type">(.*?)\<\/div\>/', $str, $m ); 
		$code = '';
		if( count( $m[1] ) > 0 ) { 
			for( $i=0; $i < $c; $i++ ) { 
			
				$new = !empty($m[1][$i]) ? $m[1][$i] : '';
				array_push( $list, array(
				    'slug' => self::transform_slug( $new ),
					'name' => $new
				));
				
			}  
			
			foreach ( $list as $key ) {
				$code .= '<li><a href="javascript:" data-group="'.$key[ 'slug' ].'">'.$key[ 'name' ].'</a></li>';
			}	
			
			return $code;

		} else {
			return '';
		}
	
	}


	
	/*
	 * Get attachment ID
	 *
	 *
	 */	
	public static function get_attachment_id( $img_url ) {
		$cache_key	= md5($img_url);
		$post_id	= wp_cache_get($cache_key, 'wpjam_attachment_id' );
		if($post_id == false){
	
			$attr		= wp_upload_dir();
			$base_url	= $attr['baseurl']."/";
			$path = str_replace($base_url, "", $img_url);
			if($path){
				global $wpdb;
				$post_id	= $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '{$path}'");
				$post_id	= $post_id?$post_id:''; 
			}else{
				$post_id	= '';
			}
	
			wp_cache_set( $cache_key, $post_id, 'get_attachment_id', 86400);
		}
		return $post_id;
	}


	/*
	 * Shortcode Formatting Output
	 *
	 *
	 */
	public static function str_compression( $str ) {
		
		$str = str_replace( "\r\n", '', $str );
		$str = str_replace( "\n", '', $str );
		$str = str_replace( "\t", '', $str ); 
		$str = str_replace( "\t", '', $str );
		
		$pattern = array(
		"/> *([^ ]*) *</",
		"/[\s]+/",
		"/<!--[^!]*-->/",
		"/\"  /",
		"/ \"/",
		"'/\*[^*]*\*/'"
		);
		$replace = array(
		">\\1<",
		" ",
		"",
		"\"",
		"\"",
		""
		);
		
	  $outputcode = preg_replace( $pattern, $replace, $str );
		
	  return $outputcode;

	}
	
	
	
		
	/*
	 * Check if the user needs a browser update
	 *
	 *
	 */
	public static function is_IE() {
         
		 if( self::inc_str( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) ) { 
		     return true;
		 } else {
			 return false;
		 }
        
	
	}
	
	/*
	 * Check if the Dynamic Adding Input
	 *
	 *
	 */
	public static function is_dynamic_input( $class ) {
         
		 if( self::inc_str( $class, 'dynamic-row' ) ) { 
		     return true;
		 } else {
			 return false;
		 }
        
	
	}
	
	
	/*
	 * Returns Row Class of Table 
	 *
	 *
	 */
	public static function row_class( $class ) {
         
		if( self::is_IE() && self::is_dynamic_input( $class ) ) {
			$new_class = str_replace( 'toggle-row', 'toggle-row isMSIE', $class );
		} else {
			$new_class = $class;
		}
		
		return $new_class;
        
	
	}
	
	
	/*
	 * Add custom CTA styles to TinyMCE editor
	 *
	 *
	 */
	public static function mce_css( $wp ) {
		$wp .= ',' . self::plug_directory() .'css/uixform.mce.css';
		return $wp;
	}
	
	
	
	/*
	 * Returns readable Colour
	 *
	 *
	 */	
	public static function readable_color( $color ){
		
		if ( self::inc_str( $color, 'rgb' ) ) {
			$color = self::rgb2hex( $color );
		}
		
		if ( self::inc_str( $color, '#' ) ) {
			$color = str_replace('#', '', $color );
		}
		
		$r = hexdec(substr( $color, 0, 2 ) );
		$g = hexdec(substr( $color, 2, 2 ) );
		$b = hexdec(substr( $color, 4, 2 ) );
	
		$contrast = sqrt(
			$r * $r * .241 +
			$g * $g * .691 +
			$b * $b * .068
		);
	
	    //RGB Luminance
		if($contrast > 130){
			return '#000000';
		}else{
			return '#FFFFFF';
		}
	}
		
	public static function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
	public static function rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
	
	   return $hex; // returns the hex value including the number sign (#)
	}	
		
	
	/*
	 * Decode template
	 *
	 *
	 */
	public static function decode( $str ) {


         if ( $str ) {
			 $restr = str_replace( '&#8217;', '\'',
					   str_replace( '&#8221;', '"',
					   str_replace( '&apos;', '\'',
					   str_replace( '&quot;', '"',
					   wp_specialchars_decode( $str )
					   ))));
					   
	 
		 } else {
		    $restr = $str;
		 }
		 
		 return $restr;

	}
	
	
	
	/*
	 * Get sub tags
	 *
	 *
	 */
	public static function get_subtags( $str, $content = null ) {

         if ( $str ) {
			 preg_match_all( '/\['.$str.'\](.*?)\[\/'.$str.'\]/si', $content , $match );
			 return $match[1][0];
		 } else {
		    return '';
		 }
	
	}

	
	
	/*
	 * Callback code of form
	 *
	 *
	 */
	public static function format_formcode( $str ) {

		$str = str_replace( '$___$', "'",
		       str_replace( '\'', '&apos;',
			   self::str_compression( $str )
			   ) );
	

		return $str;


	}
	

	
	/*
	 * Callback before tag of form
	 *
	 *
	 */
	public static function form_before() {
		
		return '<div class="uixform-alert"><div class="uixform-table-wrapper"><form method="post">';

	}
	
	/*
	 * Callback after tag of form
	 *
	 *
	 */
	public static function form_after() {
		
		return '</form></div></div>';

	}
	
	/*
	 * Callback before javascript of uixform
	 *
	 *
	 */
	public static function uixform_callback( $form_js, $form_html, $form_js_vars, $form_id, $title ) {
		
	    $formid = '.'.$form_id.'';
		  
		return "
		
		{$form_js}
		
		$( document ).uixFormPop({   
			trigger: '{$formid}',
			title: '{$title}',
			initFunction: function( form ) {
				var code = '{$form_html}';
				if ( $( '#' + form[ 'thisModalID' ] ).length < 1 ) {
					
					$( 'body' ).prepend( '<div class=\"uixform-modal-box\" id=\"'+form[ 'thisModalID' ]+'\"><a href=\"javascript:void(0)\" class=\"close-btn close-uixform-modal\">×</a><div class=\"content\"><h2>'+form[ 'title' ]+'</h2>'+code+'<div class=\"uixform-modal-buttons\"><input type=\"button\" class=\"close-uixform-modal uixform-modal-button uixform-modal-cancel-btn\" value=\"".__( 'Cancel', 'uix-page-builder' )."\" /><input type=\"submit\" class=\"uixform-modal-button uixform-modal-button-primary uixform-modal-save-btn\" data-formID=\"'+form[ 'thisFormName' ]+'\" value=\"".__( 'Save', 'uix-page-builder' )."\" /></div></div></div>' );
				}
			},
			startFunction: function( widgets ) {
				{$form_js_vars}
				
				setTimeout( function() {
					/*-- Icon list with the jQuery AJAX method --*/
					$( '.icon-selector' ).uixform_iconSelector();
					$( '.wp-color-input' ).wpColorPicker();
				}, 1 );	
			}
		});

		";

	}
	
     /*
	 * Returns dynamic form
	 *
	 *
	 */
	public static function dynamic_form_code( $class, $str, $toggle = null ) {
		
		 $searcharray[ 'list_str' ] = array(
			   'data-insert-preview="', //image
			   'data-insert-img="', //image
			   'pushinputID=',//icon
			   'id=',//input,textarea
			   '<td>',
			   '</td>'
			   
		
		  );
		  $replacearray[ 'list_str' ] = array(
			   'data-insert-preview="{dataID}', 
			   'data-insert-img="{dataID}', 
			   'pushinputID={dataID}', 
			   'data-id=',
			   '',
			   ''
		  );  

         if ( $str ) {
			 preg_match_all( '/<tr.*?'.$class.'">(.*?)<\/tr>/is', $str, $match );
			 $v = str_replace( $searcharray[ 'list_str' ], $replacearray[ 'list_str' ], $match[1][0] );
			 $v = preg_replace( '/<th.*?<\/th>/', '', $v );
			 
			//inscure browser
			if( self::is_IE() ) {
				 if ( $toggle == 'toggle-row' ) {
					 $v = '<div class="toggle-row isMSIE">'.$v.'</div>';
				 }
				 if ( $toggle == 'toggle' ) {
					 $v = '<div class="toggle-btn isMSIE">'.$v.'</div>';
				 }	 

			} else {
				 if ( $toggle == 'toggle-row' ) {
					 $v = '<div class="toggle-row">'.$v.'</div>';
				 }
				 if ( $toggle == 'toggle' ) {
					 $v = '<div class="toggle-btn">'.$v.'</div>';
				 }	 
	
			}
		
			 return self::str_compression( $v );
		 } else {
		    return '';
		 }
	

	}
	
	
	/*
	 * Callback form
	 *
	 * 
	 */
	 
	public static function add_form( $config_id, $arr1 = null, $arr2 = null, $code = 'html', $wrapper_name = '' ) {
		
		$section_args = array();
		$field_total = array();
		$field_args = array();
		$before = '';
		$after = '';
		$field = '';
		$output = '';
		$jscode = '';
		$jscode_vars = '';
		
		
		
		
		/**
		 * Get the configuration options
		 */
		
		if ( is_array( $arr2 ) ) {

			foreach ( $arr2 as $field_key => $field_value ) {
				$field_total[] = $field_value;
			}	
	
		}
	
	
        if ( !empty( $config_id ) ) {
			
			
			/**
			 * Add the form container
			 */
			 if ( is_array( $arr1 ) ) { 
			 
					if ( $arr1[ 'list' ] == false ) {
		
							$before = '
							 '.self::form_before().'
								<table class="uixform-table">
									<!-- Automatically repair display issues that readability of UixForm.  -->
									<input type="hidden" style="display:none"><!-- Required -->
							'."\n";
							
							
							$after = '
								</table>
							 '.self::form_after().'
							'."\n";
		
			
					}
					
					//Column 2
					if ( $arr1[ 'list' ] == 2 ) {
					
							$before = '
							 
								 <div class="uixform-table-cols-wrapper uixform-table-col-2">
									<table class="uixform-table-list">
										<!-- Automatically repair display issues that readability of UixForm.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.uixform-table-cols-wrapper-->
							 
							'."\n";
						
						
					}
					
					//Column 3
					if ( $arr1[ 'list' ] == 3 ) {
						$before = '
							 
								 <div class="uixform-table-cols-wrapper uixform-table-col-3">
									<table class="uixform-table-list">
										<!-- Automatically repair display issues that readability of UixForm.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.uixform-table-cols-wrapper-->
							 
							'."\n";
						
					}
					
					//Column 4
					if ( $arr1[ 'list' ] == 4 ) {
						$before = '
							 
								 <div class="uixform-table-cols-wrapper uixform-table-col-4">
									<table class="uixform-table-list">
										<!-- Automatically repair display issues that readability of UixForm.  -->
										<input type="hidden" style="display:none"><!-- Required -->
										
										
										<tr class="item">
											<th colspan="2" scope="col">
											'.$wrapper_name.'
											</th>
										</tr> 
										
							'."\n";
							
							
							$after = '
									</table>
								</div><!-- /.uixform-table-cols-wrapper-->
							 
							'."\n";
							
					}
			
			 }
			
			
			

			/**
			 * Add the field to the properly indexed
			 */
	
			foreach ( $field_total as $key) {
		
				$_title = ( isset( $key['title'] ) ) ? $key['title'] : '';
				$_desc = ( isset( $key['desc'] ) ) ? $key['desc'] : '';
				$_default = ( isset( $key['default'] ) ) ? $key['default'] : '';
				$_value = ( isset( $key['value'] ) ) ? $key['value'] : '';
				$_ph = ( isset( $key['placeholder'] ) ) ? $key['placeholder'] : '';
				$_id = ( isset( $key['id'] ) ) ? $key['id'] : '';
				$_type = ( isset( $key['type'] ) ) ? $key['type'] : 'text';
				$_class = ( isset( $key['class'] ) ) ? $key['class'] : '';
				$_toggle = ( isset( $key['toggle'] ) ) ? $key['toggle'] : '';
				
				$args = [
					'title'             => $_title,
					'desc'              => $_desc,
					'default'           => $_default,
					'value'             => $_value,
					'placeholder'       => $_ph,
					'id'                => $_id,
					'type'              => $_type,
					'class'              => $_class,
					'toggle'              => $_toggle

				];
			
				
				//icon
				$field .= UixPageBuilderForm_Icon::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Icon::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Icon::add( $args, 'js_vars' );
	
				//radio
				$field .= UixPageBuilderForm_Radio::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Radio::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Radio::add( $args, 'js_vars' );
				
				//radio image
				$field .= UixPageBuilderForm_RadioImage::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_RadioImage::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_RadioImage::add( $args, 'js_vars' );			
				
				//multiple selector
				$field .= UixPageBuilderForm_MultiSelector::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_MultiSelector::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_MultiSelector::add( $args, 'js_vars' );			
	
				//slider
				$field .= UixPageBuilderForm_Slider::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Slider::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Slider::add( $args, 'js_vars' );
				
				//margin
				$field .= UixPageBuilderForm_Margin::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Margin::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Margin::add( $args, 'js_vars' );
				
				
				//text
				$field .= UixPageBuilderForm_Text::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Text::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Text::add( $args, 'js_vars' );
	
	
				//textarea
				$field .= UixPageBuilderForm_Textarea::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Textarea::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Textarea::add( $args, 'js_vars' );
	
	
				//short text
				$field .= UixPageBuilderForm_ShortText::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ShortText::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ShortText::add( $args, 'js_vars' );
				
				//short units text
				$field .= UixPageBuilderForm_ShortUnitsText::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ShortUnitsText::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ShortUnitsText::add( $args, 'js_vars' );	
	
				//checkbox
				$field .= UixPageBuilderForm_Checkbox::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Checkbox::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Checkbox::add( $args, 'js_vars' );
	
				//color
				$field .= UixPageBuilderForm_Color::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Color::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Color::add( $args, 'js_vars' );
				
				//colormap
				$field .= UixPageBuilderForm_ColorMap::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ColorMap::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ColorMap::add( $args, 'js_vars' );
					
				
	
				//select
				$field .= UixPageBuilderForm_Select::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Select::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Select::add( $args, 'js_vars' );
	
				//image
				$field .= UixPageBuilderForm_Image::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Image::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Image::add( $args, 'js_vars' );
	
	
				//toggle 1
				$field .= UixPageBuilderForm_Toggle::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_Toggle::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_Toggle::add( $args, 'js_vars' );
	
				//list 1
				$field .= UixPageBuilderForm_ListClone::add( $args, 'html' );
				$jscode .= UixPageBuilderForm_ListClone::add( $args, 'js' );
				$jscode_vars .= UixPageBuilderForm_ListClone::add( $args, 'js_vars' );
	
	


			} // end foreach
			

			//HTML output
			if ( $code == 'html' ) $output = self::format_formcode ( $before.$field.$after );
			
			//Javascript output
			if ( $code == 'js' || $code == 'javascript' ) $output = $jscode;
			
			//Javascript vars output
			if ( $code == 'js_vars' ) $output = $jscode_vars;		
			
			//Add simulation buttons
			if ( $code == 'active_btn' ) $output = '';		

			
		}
		
		
		
		
		return $output;
	
	}
		
	


	
}

UixFormCore::init();