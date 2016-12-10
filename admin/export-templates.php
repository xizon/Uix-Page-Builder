<?php
/**
 * Sets up the WordPress Environment.
 *
 * @package WordPress
 */
require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php' );

//Export a new templates xml file for developer	
header( 'Content-Description: File Transfer' );
header( 'Content-Disposition: attachment; filename=uix-pagebuilder-templates.xml' );
header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );
			
$tempdata  = get_option( 'uix-pagebuilder-templates-xml' );

echo $tempdata; 

exit();	
