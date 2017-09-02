<?php
/**
 * Sets up the WordPress Environment.
 *
 * @package WordPress
 */
require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php' );

if ( !current_user_can('export') ) {
    wp_die( __( 'Sorry, you are not allowed to export the content of this site.' ) );	
}


//Export a new templates xml file for developer	
header( 'Content-Description: File Transfer' );
header( 'Content-Disposition: attachment; filename=templates.xml' );
header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );
			

$xmlfile   = UixPageBuilder::tempfile_modules_path( 'dir' );
$tempdata = str_replace( '</items>', '', get_option( 'uix-page-builder-templates-xml' ) );

//Display the list by loading the template file (.xml)
if ( file_exists( $xmlfile ) ) {

	$xml             = new UixPB_XML;  
	$xml -> xml_path = UixPageBuilder::tempfile_modules_path( 'uri' );
	$xLength         = $xml -> get_xmlLength();
	$xValue          = $xml -> xml_read();

	// Reading JSON data now
	$xValue = $xml -> xml_read();

	for ( $xmli = 0; $xmli <= $xLength - 1; $xmli++ ) {

		$json_data       = UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['data'], 'save' );			
		$preview_thumb   = UixPageBuilder::convert_img_path( $xValue['item'][$xmli]['thumb'], 'save' );
		$temp_name       = $xValue['item'][$xmli]['name'];

		if ( $temp_name != 'null' ) {
			$tempdata     .= '
				<item>
					<name><![CDATA['.$temp_name.']]></name>
					<thumb><![CDATA['.$preview_thumb.']]></thumb>
					<data><![CDATA['.$json_data.']]></data>
				</item>
			';
		}

	}

}

// If there is only one template, you need to automatically add an empty template to avoid reading errors.
// Insert a new node
$tempdata .= '
	<item>
		<name><![CDATA[null]]></name>
		<thumb><![CDATA['.UixPageBuilder::module_thumbnails_path().']]></thumb>
		<data><![CDATA[[{"tempname":"null"},{"col":1,"row":1,"size_x":1,"size_y":2,"content":"","secindex":"0","layout":"boxed","customid":"section-0","title":"Section 1"}]]]></data>
	</item>
	
</items>
';



echo $tempdata; 

exit();	
