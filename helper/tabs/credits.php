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
            <li><a href="https://dsmorse.github.io/gridster.js/" target="_blank" rel="nofollow"><?php _e( 'Gridster', 'uix-page-builder' ); ?></a></li>
         
         
         
        </ul>
        
        </p> 
        
    
<?php } ?>