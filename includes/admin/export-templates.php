<?php
/**
 * Sets up the WordPress Environment.
 *
 * @package WordPress
 */
require_once( dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '/wp-load.php' );

if ( !current_user_can('export') ) {
    wp_die( __( 'Sorry, you are not allowed to export the content of this site.' ) );	
}

if ( !class_exists(  'DOMDocument'  )  ) {
	wp_die( __( 'Fatal error: Class "DOMDocument" not found in your PHP environment.' ) );
} 


//Export a new templates xml file for developer	
header( 'Content-Description: File Transfer' );
header( 'Content-Disposition: attachment; filename=templates.xml' );
header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );
			

$xmlfile   = UixPageBuilder::tempfile_modules_path( 'dir' );
$tempdata = str_replace( '</items>', '', get_option( 'uix-page-builder-templates-xml' ) );

//Display the list by loading the template file (.xml)
if ( file_exists( $xmlfile ) && class_exists(  'DOMDocument'  ) ) {

	//with WordPress methord
	$response = wp_remote_get( UixPageBuilder::tempfile_modules_path( 'uri' ) );

	if ( is_array( $response ) && ! is_wp_error( $response ) ) {

		//get xml code
		//--------------
		$xmlCode = simplexml_load_string( $response['body'], "SimpleXMLElement", LIBXML_NOCDATA);
		$jsonXml = json_encode($xmlCode);
		$xValue = json_decode($jsonXml,TRUE);


		//get length
		//--------------
		$xLength = count( $xValue[ 'item' ] );


		//get data
		//--------------
		for ( $xmli = 0; $xmli <= $xLength - 1; $xmli++ ) {

			if ( isset( $xValue['item'][$xmli]['data'] ) ) { //required

				$json_data       = UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['data'], 'save' );			
				$preview_thumb   = UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['thumb'], 'save' );
				$temp_name       = $xValue['item'][$xmli]['name'];
				$tmpl_author     = $xValue['item'][$xmli]['author'];
				$tmpl_email      = $xValue['item'][$xmli]['email'];
				$tmpl_release    = $xValue['item'][$xmli]['release'];

				if ( $temp_name != 'null' ) {
					$tempdata     .= '
						<item>
							<name><![CDATA['.$temp_name.']]></name>
							<thumb><![CDATA['.$preview_thumb.']]></thumb>
							<author><![CDATA['.$tmpl_author.']]></author>
							<email><![CDATA['.$tmpl_email.']]></email>
							<release><![CDATA['.$tmpl_release.']]></release>
							<data><![CDATA['.$json_data.']]></data>
						</item>
					';
				}	
			}//endif isset( $xValue['item'][$xmli]['data'] )

		}//end for


	}//endif $response
	


}

// If there is only one template, you need to automatically add an empty template to avoid reading errors.
// Insert a new node
$tempdata .= '
	<item>
		<name><![CDATA[null]]></name>
		<thumb><![CDATA['.UixPageBuilder::module_thumbnails_path().']]></thumb>
		<author><![CDATA[null]]></author>
		<email><![CDATA[null]]></email>
		<release><![CDATA[null]]></release>
		<data><![CDATA[[{"tempname":"null"},{"wp_page_template":"null"},{"col":1,"row":1,"size_x":1,"size_y":2,"content":"","secindex":"0","layout":"boxed","customid":"section-0","title":"Section 1"}]]]></data>
	</item>
	
</items>
';



echo $tempdata; 

exit();	
