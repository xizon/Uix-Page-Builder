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
           <?php _e( '<h4 class="uix-bg-custom-title">2. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Custom One Page". Save the page and hit "Preview" to see how it looks. ( You could specify the template name, in this case I used "Uix Page Builder Template". )</h4>', 'uix-page-builder' ); ?>
        </p>  
        <blockquote class="uix-bg-custom-blockquote">
			<p class="uix-bg-custom-desc">
			   <?php 
				printf( 
					__('You could <a href="%s">create</a> Uix Page Builder template file (from the directory "/wp-content/plugins/uix-page-builder/theme_templates/page-uix_page_builder.php" ) in your templates directory.', 'uix-page-builder' ), 
					admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" )
				);
				?>
			</p>
        </blockquote>    
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/menu.jpg" alt=""><br><img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/add-page.jpg" alt="">
        </p> 
        
         <p>
           <?php _e( '<p>You will find <strong>"Uix Page Builder Attributes"</strong> settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box. <br>Click <strong>"Use Visual Builder"</strong> button to enter the visual editing mode.</p>', 'uix-page-builder' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/active.jpg" alt="">
        </p> 
                      
        
       
       
<?php } ?>