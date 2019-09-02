<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'for-developer' ) {
	
?>
	   	<p>
		   <strong><?php _e( 'Occasionally you may wish to edit one of the templates that come with Uix Page Builder. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren\'t lost when you update the Uix Page Builder plugin. This document will show you how to safely move template files to your theme.', 'uix-page-builder' ); ?></strong>

		</p>
       
        <h3>
            <?php _e( '(1) Creating the Theme Location', 'uix-page-builder' ); ?>
        </h3>  
	   	<p class="uix-bg-custom-desc">
		   <?php _e( '1) Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin. If you want to custom your builder controls of backend for your theme, then just copy them from the directory <code>/wp-content/plugins/uix-page-builder/uixpb_templates/</code> to your theme directory <code>/wp-content/themes/{your-theme}/uixpb_templates/</code>.', 'uix-page-builder' ); ?>

		</p>
   	    <blockquote class="uix-bg-custom-blockquote">
			<p class="uix-bg-custom-desc">
	        <?php _e( 'Note: You could move the <strong style="color: #000">/wp-content/themes/{your-theme}/uixpb_templates/js/</strong>, <strong style="color: #000">/wp-content/themes/{your-theme}/uixpb_templates/images/</strong> and <strong style="color: #000">/wp-content/themes/{your-theme}/uixpb_templates/css/</strong> folders to your theme assets directory <strong style="color: #000">/wp-content/themes/{your-theme}/assets/</strong>', 'uix-page-builder' ); ?>

			</p>
        </blockquote>
   	    
   	            
	   	<p class="uix-bg-custom-desc">
		   <?php _e( '2) Plugin allow handles plugin scripts of front-end. If you want to custom, rename the <strong>_uix-page-builder-plugins.js</strong> to <strong>uix-page-builder-plugins.js</strong> from the directory <code>/wp-content/plugins/uix-page-builder/uixpb_templates/js/</code> or <code>/wp-content/themes/{your-theme}/uixpb_templates/js/</code> or <code>/wp-content/themes/{your-theme}/assets/js/</code>, and add the required script to <strong>uix-page-builder-plugins.js</strong>. ( If you done, the default Uix Page Builder plugin scripts can\'t queue. You can use your own scripts instead of the plugin only. )', 'uix-page-builder' ); ?>

		</p>       
       

        <h3>
            <?php _e( '(2) Available Template Folders & Files', 'uix-page-builder' ); ?>
        </h3>  
		<p>
		   <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/directory-structure.jpg" alt="">
		</p> 
        
        
        <h3>
            <?php _e( '(3) API', 'uix-page-builder' ); ?>
        </h3>  
   	
	   	<p>
	   	    <?php printf( __( '<a href="%1$s" target="_blank">Online API Documentation</a>', 'uix-page-builder' ), esc_url( 'https://xizon.github.io/wp-documentations/uix-page-builder/' ) ); ?>
		</p>   
   
   
    
    
<?php } ?>