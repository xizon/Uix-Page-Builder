<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
 *
 * Tips: your WordPress site in local server, you need to chang file permissions to use "wpfilesystem_write_file"
   Add following code to "wp-config.php":
   
   -----
   define("FS_METHOD", "direct"); 
   define("FS_CHMOD_DIR", 0777); 
   define("FS_CHMOD_FILE", 0777); 
   
*
*/

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_pagebuilder_list';


// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_pagebuilder_listfiles' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = '';
		
		$status_echo = UixPageBuilder::wpfilesystem_write_file( 'uix_pagebuilder_listfiles', 'edit.php?post_type=uix_pagebuilder&page='.UixPageBuilder::HELPER, 'helper/', 'debug.txt', UixPageBuilder::theme_list() );
		echo $status_echo;
		
	}
	

 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'pagebuilder-list' ) { ?>
	
	
    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_pagebuilder_listfiles' ); ?>
        
         <h3><?php _e( 'Create Uix Page Builder list files in this plugin directory:', 'uix-page-builder' ); ?></h3>
 
         <div class="uix-plug-note">
            <h4><?php _e( 'Themes list file\'s name:', 'uix-page-builder' ); ?></h4>
            <?php echo UixPageBuilder::plug_directory().'live-demo/themes.js'; ?>  
            <br><br>
         </div>
         
         <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__( 'Click This Button to Create Uix Page Builder List Files', 'uix-page-builder' ); ?>"  /></p>
         
    </form>

	
	
 
	
    
<?php } ?>