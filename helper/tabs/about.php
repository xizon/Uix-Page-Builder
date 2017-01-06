<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
	
?>

        <p>
            <?php _e( 'Uix Page Builder is a design system that it is simple content creation interface. The currently available default elements: <code>"parallax"</code>, <code>"google maps"</code>, <code>"pricing table"</code>, <code>"features boxes"</code>, <code>"testimonials carousel"</code>, <code>"team"</code>, <code>"list of clients"</code>, <code>"accordion"</code>, <code>"tabs"</code>, <code>"author card"</code>, <code>"contact form"</code> and <code>"portfolio"</code>. To be continued.', 'uix-pagebuilder' ); ?>
        </p>  
        <h3>
            <?php _e( 'Features', 'uix-pagebuilder' ); ?>
        </h3>  
        <p>
			<?php _e( '* Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin.', 'uix-pagebuilder' ); ?><br>
 			<?php _e( '* Support to save custom templates and export templates.', 'uix-pagebuilder' ); ?><br>          
 			<?php _e( '* Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like <strong>"Uix Page Builder Anchor Links"</strong>, from the left column to add to the menu.  ', 'uix-pagebuilder' ); ?><br>   
            <?php _e( '* It is s easy to bind specific WordPress themes you want.', 'uix-pagebuilder' ); ?><br>
            <?php _e( '* Simple operation window, support loop list items.', 'uix-pagebuilder' ); ?><br>
            <?php _e( '* Allows you to customize front-end templates and publish multiple pages based Uix Page Builder.', 'uix-pagebuilder' ); ?><br>
         
            <?php _e( '* Allows completely customize your <code>.css</code>, <code>.php</code>, <code>.js</code>, <code>image</code> files for your builder structure, please refer to the usage.', 'uix-pagebuilder' ); ?><br>
            <?php _e( '<blockquote class="uix-bg-custom-blockquote"><strong>Note:</strong> Currently there is no detailed custom development documentation, can only refer to the default provided by the custom files in folders ( "uix-pagebuilder/uix-pagebuilder-sections/" and "uix-pagebuilder/theme_templates/" ).</blockquote>', 'uix-pagebuilder' ); ?>
           
        
        </p>   
        
   
    
<?php } ?>






