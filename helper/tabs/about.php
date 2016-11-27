<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
	
?>

        <p>
            <?php _e( 'Uix Page Builder is a design system that it is simple content creation interface.', 'uix-pagebuilder' ); ?>
        </p>  
       
   
    
<?php } ?>