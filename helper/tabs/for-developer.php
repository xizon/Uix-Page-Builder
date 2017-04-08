<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'for-developer' ) {
	
?>

       
        <h3>
            <?php _e( 'Advanced Customization ( For Theme Developer )', 'uix-page-builder' ); ?>
        </h3>  
	   	<p class="uix-bg-custom-desc">
		   <?php _e( '1) Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin. If you want to custom your builder controls of backend for your theme, then just copy them from the directory <code>/wp-content/plugins/uix-page-builder/uix-page-builder-custom/</code> to your theme directory <code>/wp-content/themes/{your-theme}/</code>.', 'uix-page-builder' ); ?>

		</p>    
	   	<p class="uix-bg-custom-desc">
		   <?php _e( '2) Plugin allow handles plugin scripts of front-end. If you want to custom, rename the <strong>_plugins.js</strong> to <strong>plugins.js</strong> from the directory <code>/wp-content/plugins/uix-page-builder/uix-page-builder-custom/js/</code>, and add the required script to <strong>plugins.js</strong>. ( If you done, the default Uix Page Builder plugin scripts can\'t queue. You can use your own scripts instead of the plugin only. )', 'uix-page-builder' ); ?>

		</p>       
       
   
    
<?php } ?>