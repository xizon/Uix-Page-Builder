<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
	
?>

        <p class="uix-bg-custom-desc">
            <?php _e( 'Uix Page Builder is a design system that it is simple content creation interface. Drag & Drop, User-friendly and online Visual Editing.', 'uix-page-builder' ); ?>
        </p> 
        <p class="uix-bg-custom-desc">
            <?php _e( 'Here are <strong>6+</strong> One-Page Templates for you to swipe and make your own. Here, you will find free, professional design for Uix Page Builder. We add new, fresh designs regularly in order to provide you with large variety of templates to chose from. More importantly, each module may contain a variety of styles.', 'uix-page-builder' ); ?>
        </p> 
        <p class="uix-bg-custom-desc">
            <?php _e( 'You could add a new page with Uix Page Builder to your WordPress site, find the <strong>Pages</strong> menu in the WordPress Dashboard Navigation menu. Click <strong>Add new</strong>. The <strong>"Uix Page Builder Attributes"</strong> section applies page builder templates to your new page. ', 'uix-page-builder' ); ?>
        </p> 
                
        <h3>
            <?php _e( 'Included Modules ', 'uix-page-builder' ); ?>
        </h3>       
        <p class="uix-bg-custom-desc">
            <?php _e( 'The currently available default elements:', 'uix-page-builder' ); ?>
        </p> 
		<ul class="uix-bg-custom-list">
	        <li><?php _e( 'Custom Menu (2 layouts)', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Parallax', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Google Maps', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Pricing (4 layouts)', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Features (2 layouts)', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Testimonials carousel', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Team (2 layouts)', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Clients', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Accordion', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Tabs', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Author Card', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Progress Bar', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Portfolio', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Blog', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Slider', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Sidebar', 'uix-page-builder' ); ?></li>   
		    <li><?php _e( 'Uix Products (Require the WP plugin "Uix Products")', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Uix Slideshow (Require the WP plugin "Uix Slideshow")', 'uix-page-builder' ); ?></li> 
		    <li><?php _e( 'Contact Form (Require the WP plugin "Contact Form 7")', 'uix-page-builder' ); ?></li>     
		</ul> 
                   

        <h3>
            <?php _e( 'Features', 'uix-page-builder' ); ?>
        </h3> 
        
		<ul class="uix-bg-custom-list">

			<li><?php _e( 'Compatible with Gutenberg. (new)', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'A particularly simple custom form and template API.', 'uix-page-builder' ); ?></li>
			<li>

			 <?php 
				printf( 
					__('Support Custom Post Types to create a portfolio list in WordPress. (Require the WP plugin <a href="%s" target="_blank">Uix Products</a>)', 'uix-page-builder' ), 
					esc_url( 'https://wordpress.org/plugins/uix-products/' )
				);
			?>
			</li>
			<li>

			 <?php 
				printf( 
					__('Support Custom Post Types to create a slideshow in WordPress. (Require the WP plugin <a href="%s" target="_blank">Uix Slideshow</a>)', 'uix-page-builder' ), 
					esc_url( 'https://wordpress.org/plugins/uix-slideshow/' )
				);
			?>
			</li>
			<li><?php _e( 'You can switch between <strong>"Visual Builder"</strong> and <strong>"Default Editor"</strong> modes at any time on the Pages Add New/Edit Screen.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Support to choose multiple default templates you want.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Support to save custom templates and export templates.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like "Uix Page Builder Anchor Links", from the left column to add to the menu.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Simple operation window, support loop list items.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Customizable core style sheets.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Drag and Drop Responsive Website Builder.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Uix Page Builder supports the automatic addition of Anchor Links.', 'uix-page-builder' ); ?></li>
			<li><?php _e( 'Supports Right-To-Left (RTL) direction.', 'uix-page-builder' ); ?></li>
			

  
		</ul> 
          
         <p>
           <?php _e( '<strong>If you like this plug-in, you can check out my free and high-quality themes with Uix Page Builder for you to download.</strong> <h4><a href="https://uiux.cc/" target="_blank">Click here to check out</a></h4>', 'uix-page-builder' ); ?>
        </p>      

   
  
  
    
<?php } ?>






