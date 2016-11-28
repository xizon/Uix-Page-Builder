<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>


        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)</h4>', 'uix-pagebuilder' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/plug.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">2. You need to create Uix Page Builder template files in your templates directory. You can create the files on the WordPress admin panel.</h4>', 'uix-pagebuilder' ); ?>
     
        </p>  
        <p>
           &nbsp;&nbsp;&nbsp;&nbsp;<a class="button button-primary" href="<?php echo admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" ); ?>"><?php _e( 'Create now!', 'uix-pagebuilder' ); ?></a>
     
        </p>  
         <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;As a workaround you can use FTP, access the Uix Page Builder template files path <code>/wp-content/plugins/uix-pagebuilder/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-pagebuilder' ); ?>
   
        </p>         
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;Please check if you have the 1 template files <code>"page-uix_pagebuilder.php"</code> in your templates directory. If you can"t find these files, then just copy them from the directory "/wp-content/plugins/uix-pagebuilder/theme_templates/" to your templates directory.', 'uix-pagebuilder' ); ?>
           
          
        </p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/temp.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">3. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Custom One Page". Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used "Uix Page Builder Template". The "Template Name: Uix Page Builder Template" tells WordPress that this will be a custom page template. )</h4>', 'uix-pagebuilder' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/menu.jpg" alt=""> <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/add-page.jpg" alt="">
        </p> 
        
         <p>
           <?php _e( '<p>You will find <strong>"Uix Page Builder Attributes"</strong> settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box.</p>', 'uix-pagebuilder' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/active.jpg" alt="">
        </p> 
                    
        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">4. You can pretty much custom every aspect of the look and feel of this page by modifying the <code>*.php</code> template files <strong>(Access the path to the themes directory)</strong> . Best Practices for Editing WordPress Template Files:</h4>', 'uix-pagebuilder' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to <strong>"Appearance > Editor"</strong> from your sidebar.', 'uix-pagebuilder' ); ?>
        </p>   
          
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/editor.jpg" alt="">
        </p> 
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) You can connect to your site via an <strong>FTP</strong> client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.', 'uix-pagebuilder' ); ?>
        </p>  
        
        
       
<?php } ?>