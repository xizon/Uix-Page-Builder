<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>

          <p>
            <?php 
				$embed_code = wp_oembed_get('https://www.youtube.com/watch?v=KXlpzjUsvdA', array('width'=>560, 'height'=>315 )); 
				echo $embed_code;										 
			  ?>
        
        </p>   
        
       
        <h3>
            <?php _e( '(1) How to use?', 'uix-page-builder' ); ?>
        </h3>  
        <p class="uix-bg-custom-desc">
           <?php _e( '1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)', 'uix-page-builder' ); ?>
        </p>  
        <p class="uix-bg-custom-desc">
           <?php _e( '2. Go to your WordPress admin panel, edit or create a new page. You will find <strong>"Uix Page Builder Attributes"</strong> settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. ( You could specify the template name, in this case I used "Uix Page Builder Template". )', 'uix-page-builder' ); ?>
        </p>  
   
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/menu.jpg" alt=""> 
			<img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/active.jpg" alt="">
        </p> 
        
        
        <p class="uix-bg-custom-desc">
           <?php _e( '2-2. For Gutenberg. the <strong>"Uix Page Builder Attributes"</strong> settings can be found in the Extended Settings section with the Gutenberg block editor.', 'uix-page-builder' ); ?>
        </p>  
   
        <p>
           <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/gutenberg-go.jpg" alt=""> 
        </p> 
        

        <h3>
            <?php _e( '(2) FAQ', 'uix-page-builder' ); ?>
        </h3> 



		<div class="uix-bg-custom-faq-group">

			<div class="uix-bg-custom-accordion">
				<ul>
					<li>
						<h3><?php _e( 'FAQ 1: How To Create a Full Width or Boxed Layout?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
							 <?php _e( 'On visual builder page, expand the <i class="dashicons dashicons-admin-generic"></i> from Drag & Drop modules of left sidebar. You can easily choose the type of container.', 'uix-page-builder' ); ?></p>

						</div>
					</li>
					<!-- we will keep this LI open by default -->
					<li>
						<h3><?php _e( 'FAQ 2: How To Create The One-Page Navigation?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
							 <?php _e( '1. On visual builder page, expand the <i class="dashicons dashicons-admin-generic"></i> from Drag & Drop modules of left sidebar. You can enter any string in the custom <strong>ID</strong> field on the right. Such as <code>my-portfolio</code>.', 'uix-page-builder' ); ?></p>
							 <p>
							 <?php printf( __( '2. Create a new <a href="%1$s">menu</a>, and add a Custom Link for each menu item you plan on having. For each menu item, enter an id that you will assign later to the corresponding section. For example, for the menu item <code>My Portfolio</code>, you would enter <code>#my-portfolio</code> in the URL field.', 'uix-page-builder' ), admin_url( "nav-menus.php" ) ); ?>
							 </p>

							<p>
							   <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/set-layout-1.jpg" alt=""> 
							   <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/set-layout-2.jpg" alt="">
							</p> 
						</div>
					</li>
					<li>
						<h3><?php _e( 'FAQ 3: How to use a custom page builder template?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
						   <?php 
							printf( 
								__('You could <a href="%s">create</a> Uix Page Builder template file (from the directory "/wp-content/plugins/uix-page-builder/uixpb_templates/tmpl-uix_page_builder.php" ) in your templates directory. It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, you can use of the default page template or your own custom template file directly.', 'uix-page-builder' ), 
								admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=temp" )
							);
							?>

							</p>
							<p>
								 <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/page-temp-tutorial-1.jpg" alt="">
							</p> 
							<p>
								 <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/page-temp-tutorial-2.jpg" alt="">
							</p> 

						</div>
					</li>
					<li>
						<h3><?php _e( 'FAQ 4: How to create Anchor Links menu with Uix Page Builder?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
							<?php _e( 'Uix Page Builder supports the automatic addition of Anchor Links. From the <strong>"Appearance"</strong> menu on the left-hand side of the Dashboard, select the <strong>"Menus"</strong> option to bring up the Menu Editor. Locate the pane entitled <strong>"Uix Page Builder Anchor Links"</strong>. Within this pane, select a page to view all anchor link.', 'uix-page-builder' ); ?>

							</p>

							<p>
								 <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/anchor-links.jpg" alt="">
							</p> 
						</div>
					</li>
					<li>
						<h3><?php _e( 'FAQ 5: How to set the menu for the currently used page template of Uix Page Builder?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
						   <?php 
							printf( 
								__('Go to <a href="%s">Dashboard » Appearence » Menus</a>. Click on <strong>"create a new menu"</strong> to create your custom menu. You should tick the appropriate checkbox of <code>"Primary Menu"</code> from options as <strong>"Display location"</strong>.', 'uix-page-builder' ), 
								admin_url( "nav-menus.php" )
							);
							?>

							</p>
							<p>
								 <img src="<?php echo UixPageBuilder::plug_directory(); ?>helper/img/set-temp-menu.jpg" alt="">
							</p> 

						</div>
					</li>
					<li>
						<h3><?php _e( 'FAQ 6: How to customize the Uix Page Builder templates and modules in admin panel?', 'uix-page-builder' ); ?></h3>
						<div class="uix-bg-custom-faq-con">
							<p>
						   <?php 
							printf( 
								__('<a href="%s">Check out here</a>', 'uix-page-builder' ), 
								admin_url( "admin.php?page=".UixPageBuilder::HELPER."&tab=for-developer" )
							);
							?>

							</p>


						</div>
					</li>				


				</ul>
			</div>
		</div>

       
<?php } ?>