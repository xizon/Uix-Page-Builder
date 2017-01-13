<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
	
?>

        <p>
            <?php _e( 'Uix Page Builder is a design system that it is simple content creation interface. The currently available default elements: <code>"parallax"</code>, <code>"google maps"</code>, <code>"pricing table"</code>, <code>"features boxes"</code>, <code>"testimonials carousel"</code>, <code>"team"</code>, <code>"list of clients"</code>, <code>"accordion"</code>, <code>"tabs"</code>, <code>"author card"</code>, <code>"contact form"</code> and <code>"portfolio"</code>. To be continued.', 'uix-page-builder' ); ?>
        </p> 
        <p>
            <?php _e( 'You could add any new pages using the plugin to your WordPress site, find the <strong>Pages</strong> menu in the WordPress Dashboard Navigation menu. Click <strong>Add new</strong>. The <strong>"Uix Page Builder Attributes"</strong> section applies page builder templates to your new page. ', 'uix-page-builder' ); ?>
        </p> 
        <h3>
            <?php _e( 'Displaying on Front-end Pages', 'uix-page-builder' ); ?>
        </h3>  
        <p>
 			<?php _e( 'Embed a shortcode into the editor of any post, page, or custom post type. Use <code>[uix_pb_sections]</code> to add it to your Post, Widgets or Page content.', 'uix-page-builder' ); ?>
        
        </p>  
        
        <h3>
            <?php _e( 'Features', 'uix-page-builder' ); ?>
        </h3>  
        <p>
 			<?php _e( '* Support to save custom templates and export templates.', 'uix-page-builder' ); ?><br>          
 			<?php _e( '* Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like <strong>"Uix Page Builder Anchor Links"</strong>, from the left column to add to the menu.  ', 'uix-page-builder' ); ?><br> 
            <?php _e( '* Simple operation window, support loop list items.', 'uix-page-builder' ); ?><br>
            <?php _e( '* Customizable core style sheets.', 'uix-page-builder' ); ?>
           
        
        </p>   
        
        <h3>
            <?php _e( 'Advanced Customization (Optional) ', 'uix-page-builder' ); ?>
        </h3> 
        
        <blockquote class="uix-bg-custom-blockquote">
  	      <?php _e( 'Refer to the default provided by the custom files in folders ( "uix-page-builder/uix-page-builder-sections/" and "uix-page-builder/theme_templates/" ).', 'uix-page-builder' ); ?>
        </blockquote>
        <p>
			<?php _e( '* Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin.', 'uix-page-builder' ); ?><br>
            <?php _e( '* It is s easy to bind specific WordPress themes you want.', 'uix-page-builder' ); ?><br>
            <?php _e( '* Allows completely customize your <code>.css</code>, <code>.php</code>, <code>.js</code>, <code>image</code> files for your builder structure, please refer to the usage.', 'uix-page-builder' ); ?><br>
            
           
        
        </p>   
    
<?php } ?>






