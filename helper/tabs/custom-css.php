<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_pb_customcss';



// If they did, this hidden field will be set to 'Y'
if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_pb_customcss' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		
		update_option( 'uix_pb_opt_cssnewcode', wp_unslash( $_POST[ 'uix_pb_opt_cssnewcode' ] ) );
	
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-page-builder' ).'</strong></p></div>';

	
	}
	
	
	

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'custom-css' ) {

	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/uix-page-builder.css' ) ) {

?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_pb_customcss' ); ?>
        
      
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-page-builder' ); ?>
              <hr>
              <p class="uix-bg-custom-desc-note"><?php _e( 'You could add new styles code to your website, without modifying original .css files.', 'uix-page-builder' ); ?></p>
            </th>
            <td>
              <textarea name="uix_pb_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_pb_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php

	
	$org_cssname_uix_page_builder = 'uix-page-builder.css';
	$org_csspath_uix_page_builder = UixPageBuilder::backend_path( 'uri' ).'css/uix-page-builder.css';
	$filepath                   = 'uix-page-builder-custom/css/';
	
	
	if ( UixPageBuilder::tempfolder_exists() ) {
		$filetype = 'theme';
	} else {
		$filetype = 'plugin';
	}

	
	// capture output from WP_Filesystem
	ob_start();
	
		UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder, $filetype );
		$filesystem_uix_page_builder_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_page_builder_out ) ) {
		
		$style_org_code_uix_page_builder = UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder, $filetype );
		
		echo '
		
		         <p>'.__( 'CSS file root directory:', 'uix-page-builder' ).' 
				     <a href="javascript:" id="uix_page_builder_view_css" >'.$org_csspath_uix_page_builder.'</a>
					 <div class="uix-page-builder-dialog-mask"></div>
					 <div class="uix-page-builder-dialog" id="uix-page-builder-view-css-container">  
						<textarea rows="15" style=" width:95%;" class="regular-text">'.$style_org_code_uix_page_builder.'</textarea>
						<a href="javascript:" id="uix_page_builder_close_css" class="close button button-primary">'.__( 'Close', 'uix-page-builder' ).'</a>  
					</div>
				 </p><hr />
				<script type="text/javascript">
					
				( function($) {
					
					"use strict";
					
					$( function() {
						
						var dialog_uix_page_builder = $( "#uix-page-builder-view-css-container, .uix-page-builder-dialog-mask" );  
						
						$( "#uix_page_builder_view_css" ).click( function() {
							dialog_uix_page_builder.show();
						});
						$( "#uix_page_builder_close_css" ).click( function() {
							dialog_uix_page_builder.hide();
						});
					
			
					} );
					
				} ) ( jQuery );
				
				</script>
		
		';	

	} else {
		
		echo '
		         <p>'.__( 'CSS file root directory:', 'uix-page-builder' ).' 
				     <a href="'.$org_csspath_uix_page_builder.'" target="_blank">'.$org_csspath_uix_page_builder.'</a>
				 </p><hr />

		';	
		
		
	}
?>
        
        
        <?php submit_button(); ?>

    
    </form>


    
<?php 
	} else {
		echo __( '<p>The .css file does not exist.</p>', 'uix-page-builder' );
		
	}																			
} 
?>
																				
																			