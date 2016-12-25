<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_pagebuilder_temp';

	
// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_pagebuilder_tempfiles' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = "";
		
		if( UixPageBuilder::tempfile_exists() ) {
			// Template files removed
			$status_echo = UixPageBuilder::templates( 'uix_pagebuilder_tempfiles', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp', true );
			echo $status_echo;
	
		} else {
			// Template files copied
			$status_echo = UixPageBuilder::templates( 'uix_pagebuilder_tempfiles', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp' );
			echo $status_echo;
		
		}
	
	}
	

 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) { ?>
	
	
    <?php if( UixPageBuilder::tempfile_exists() ) { ?>
    
        <form method="post" action="" onsubmit="return confirm('<?php echo esc_attr__( 'Are you sure?\nIt is possible based on your theme of the plugin templates. When you create them again, the default plugin template will be used.', 'uix-pagebuilder' ); ?>')">
        
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <?php wp_nonce_field( 'uix_pagebuilder_tempfiles' ); ?>
            
            
             <h3><?php _e( 'Uix Page Builder template files already exists. Remove Uix Page Builder template files in your templates directory:', 'uix-pagebuilder' ); ?></h3>
             <p>
               <?php _e( 'As a workaround you can use FTP, access path <code>/wp-content/themes/{your-theme}/</code> and remove Uix Page Builder template files.', 'uix-pagebuilder' ); ?>
             </p>   
             
             <div class="uix-plug-note">
                <h4><?php _e( 'Template files list:', 'uix-pagebuilder' ); ?></h4>
                <?php UixPageBuilder::list_templates_name( 'theme' ); ?>
             </div>
             
             <p class="submit"><input type="submit" name="submit" id="submit" class="button button-remove" value="<?php echo esc_attr__( 'Remove Uix Page Builder Template Files', 'uix-pagebuilder' ); ?>" /></p>
    
        </form>
    
    <?php } else { ?>
    
        <form method="post" action="">
        
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <?php wp_nonce_field( 'uix_pagebuilder_tempfiles' ); ?>
            
             <h3><?php _e( 'Copy Uix Page Builder template files in your templates directory:', 'uix-pagebuilder' ); ?></h3>
             <p>
               <?php _e( 'As a workaround you can use FTP, access the Uix Page Builder template files path <code>/wp-content/plugins/uix-pagebuilder/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-pagebuilder' ); ?>
       
             </p>   
          
             <div class="uix-plug-note">
                <h4><?php _e( 'Template files list:', 'uix-pagebuilder' ); ?></h4>
                <?php UixPageBuilder::list_templates_name( 'plug' ); ?>
             </div>
             
             <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__( 'Click This Button to Copy Uix Page Builder Files', 'uix-pagebuilder' ); ?>"  /></p>
             
        </form>

    
    
    <?php } ?>
	
	
 
	
    
<?php } ?>