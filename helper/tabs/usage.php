<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>


        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)</h4>', 'uix-page-builder' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/plug.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">2. Embed a shortcode into the editor of any post, page, or custom post type. Use <code>[uix_pb_sections]</code> to add it to your Post, Widgets or Page content.</h4>', 'uix-page-builder' ); ?>
     
        </p>  
        
        <blockquote class="uix-bg-custom-blockquote">
			<p class="uix-bg-custom-desc">
			   <?php 
				printf( 
					__('You could <a href="%s">create</a> Uix Page Builder template file (from the directory "/wp-content/plugins/uix-page-builder/theme_templates/page-uix_page_builder.php" ) in your templates directory.', 'Anyword'), 
					admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" )
				);
				?>
			</p>
        </blockquote>        
  

        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">3. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Custom One Page". Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used "Uix Page Builder Template". The "Template Name: Uix Page Builder Template" tells WordPress that this will be a custom page template. )</h4>', 'uix-page-builder' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/menu.jpg" alt=""> <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/add-page.jpg" alt="">
        </p> 
        
         <p>
           <?php _e( '<p>You will find <strong>"Uix Page Builder Attributes"</strong> settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box.</p>', 'uix-page-builder' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/active.jpg" alt="">
        </p> 
                    
        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">4. You can pretty much custom every aspect of the look and feel of this page by modifying the <code>*.php</code> template files <strong>(Access the path to the themes directory)</strong> . Best Practices for Editing WordPress Template Files:</h4>', 'uix-page-builder' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to <strong>"Appearance > Editor"</strong> from your sidebar.', 'uix-page-builder' ); ?>
        </p>   
          
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/editor.jpg" alt="">
        </p> 
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) You can connect to your site via an <strong>FTP</strong> client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.', 'uix-page-builder' ); ?>
        </p>  
        
 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">5. Handles builder controls of backend template usage so that we can use our own templates instead of the plugin.</h4>', 'uix-page-builder' ); ?>
        </p> 
		<p class="uix-bg-custom-desc">
		   <?php _e( 'Backend templates are in the <strong>uix-page-builder-sections</strong> folder. Includes custom "css, js, php" files. If you want to custom your builder controls of backend for your theme, then just copy them from the directory <code>/wp-content/plugins/uix-page-builder/uix-page-builder-sections/</code> to your theme directory <code>/wp-content/themes/{your-theme}/</code>.', 'uix-page-builder' ); ?>
		</p>  
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/temp2.jpg" alt="">
        </p>    
        
        
        
       
<?php } ?>