<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'credits' ) {
?>


        <h3>
           <?php _e( 'I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:', 'uix-pagebuilder' ); ?>
        </h3>  
        <p>
        
        <ul>
            <li><a href="http://gridster.net/" target="_blank" rel="nofollow"><?php _e( 'Gridster', 'uix-pagebuilder' ); ?></a></li>
         
        </ul>
        
        </p> 
        
    
<?php } ?>