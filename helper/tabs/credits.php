<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'credits' ) {
?>


        <h3>
           <?php _e( 'I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:', 'uix-page-builder' ); ?>
        </h3>  
        <p>
        
        <ul>
            <li><a href="http://fontawesome.io" target="_blank" rel="nofollow"><?php _e( 'Font Awesome', 'uix-page-builder' ); ?></a></li>
            <li><a href="https://dsmorse.github.io/gridster.js/" target="_blank" rel="nofollow"><?php _e( 'Gridster', 'uix-page-builder' ); ?></a></li>
            <li><a href="http://robert-fleischmann.de" target="_blank" rel="nofollow"><?php _e( 'easy-pie-chart', 'uix-page-builder' ); ?></a></li>
            <li><a href="https://github.com/haltu/muuri" target="_blank" rel="nofollow"><?php _e( 'Muuri', 'uix-page-builder' ); ?></a></li>
            <li><a href="https://github.com/23r9i0/wp-color-picker-alpha" target="_blank" rel="nofollow"><?php _e( 'wp-color-picker-alpha', 'uix-page-builder' ); ?></a></li>
            <li><a href="http://github.com/jquery/jquery-tmpl" target="_blank" rel="nofollow"><?php _e( 'jQuery Templates plugin', 'uix-page-builder' ); ?></a></li>
         
         
         
         
         
         
        </ul>
        
        </p> 
        
    
<?php } ?>