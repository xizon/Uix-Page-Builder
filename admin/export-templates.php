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
			
$tempdata  = get_option( 'uix-pagebuilder-templates-xml' );

echo $tempdata; 

exit();	
