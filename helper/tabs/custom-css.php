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

	$theme_template_dir_name        = UixPageBuilder::get_theme_template_dir_name();
    $filepath                       = $theme_template_dir_name.'/css/';
	$org_cssname_uix_page_builder1  = 'uix-page-builder.css';
	$org_cssname_uix_page_builder2  = 'uix-page-builder.min.css';
	$enable1                        = '<span style="color:red">'.__( '(Enabled)', 'uix-page-builder' ).'</span>';
	$enable2                        = '<span style="color:red">'.__( '(Enabled)', 'uix-page-builder' ).'</span>';
	
	if ( 
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1 ) &&
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2 ) 
	) {
		$enable1 = '';
	} elseif ( 
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1 ) &&
		! file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2 ) 
	) {
		$enable2 = '';
	} elseif ( 
		! file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1 ) &&
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2 ) 
	) {
		$enable1 = '';
	}
	
	
	if ( UixPageBuilder::tempfolder_exists() ) {
		$filetype = 'theme';
	} else {
		$filetype = 'plugin';
	}
	
	if ( 
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1 ) || 
		file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2 ) 
	) {

?>
    
<p><?php _e( 'You can minimize the CSS File in order to get lower download times and save bandwidth. And change suffix <strong>".css"</strong> to <strong>".min.css"</strong>, two files can exist at the same time then give priority to the use of compressed version.', 'uix-page-builder' ); ?></p>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_pb_customcss' ); ?>
        
      
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-page-builder' ); ?>
              <hr>
              <p class="uix-bg-custom-desc-note"><?php _e( 'You could add new styles code to your website, without modifying original .css files.', 'uix-page-builder' ); ?></p>
              <p class="uix-bg-custom-desc-note"><?php _e( 'Add <code>.rtl .your-classname { .. }</code> to build RTL stylesheets.', 'uix-page-builder' ); ?></p>
            </th>
            <td>
              <textarea name="uix_pb_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_pb_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php
	   
	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1 ) ) {

		$csspath = UixPageBuilder::backend_path( 'uri' ).'css/'.$org_cssname_uix_page_builder1;

		// capture output from WP_Filesystem
		ob_start();

			UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder1, $filetype );
			$out = ob_get_contents();
		ob_end_clean();

		if ( empty( $out ) ) {

			$sourcecode = UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder1, $filetype );

			echo '

					 <div class="uix-popwin-dialog-wrapper">
					     '.esc_html__( 'CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="javascript:" class="uix-popwin-viewcss-btn">'.$csspath.'</a> '.$enable1.'
						 <div class="uix-popwin-dialog-mask"></div>
						 <div class="uix-popwin-dialog">  
							<textarea rows="15" style=" width:95%;" class="regular-text">'.$sourcecode.'</textarea>
							<a href="javascript:" class="close button button-primary">'.esc_html__( 'Close', 'uix-page-builder' ).'</a>
						</div>
					 </div>

			';	

		} else {

			echo '
					 <div>'.esc_html__( 'CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="'.$csspath.'" target="_blank">'.$csspath.'</a> '.$enable1.'
					 </div>
					 

			';	


		}
		
	}
?>
      
        
<?php
	//RTL
    $org_cssname_uix_page_builder1_rtl = UixPageBuilder::to_rtl_css( $org_cssname_uix_page_builder1 );
	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder1_rtl ) ) {

		$csspath = UixPageBuilder::backend_path( 'uri' ).'css/'.$org_cssname_uix_page_builder1_rtl;

		// capture output from WP_Filesystem
		ob_start();

			UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder1_rtl, $filetype );
			$out = ob_get_contents();
		ob_end_clean();

		if ( empty( $out ) ) {

			$sourcecode = UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder1_rtl, $filetype );

			echo '

					 <div class="uix-popwin-dialog-wrapper">
					     '.esc_html__( 'RTL CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="javascript:" class="uix-popwin-viewcss-btn">'.$csspath.'</a> '.$enable1.'
						 <div class="uix-popwin-dialog-mask"></div>
						 <div class="uix-popwin-dialog">  
							<textarea rows="15" style=" width:95%;" class="regular-text">'.$sourcecode.'</textarea>
							<a href="javascript:" class="close button button-primary">'.esc_html__( 'Close', 'uix-page-builder' ).'</a>
						</div>
					 </div>

			';	

		} else {

			echo '
					 <div>'.esc_html__( 'RTL CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="'.$csspath.'" target="_blank">'.$csspath.'</a> '.$enable1.'
					 </div>

			';	


		}
		
	}
?>        
            
                
<?php


	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2 ) ) {

		$csspath = UixPageBuilder::backend_path( 'uri' ).'css/'.$org_cssname_uix_page_builder2;

		// capture output from WP_Filesystem
		ob_start();

			UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder2, $filetype );
			$out = ob_get_contents();
		ob_end_clean();

		if ( empty( $out ) ) {

			$sourcecode = UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder2, $filetype );

			echo '

					 <div class="uix-popwin-dialog-wrapper">
					     '.esc_html__( 'CSS mini-file root directory:', 'uix-page-builder' ).' 
						 <a href="javascript:" class="uix-popwin-viewcss-btn">'.$csspath.'</a> '.$enable2.'
						 <div class="uix-popwin-dialog-mask"></div>
						 <div class="uix-popwin-dialog">  
							<textarea rows="15" style=" width:95%;" class="regular-text">'.$sourcecode.'</textarea>
							<a href="javascript:" class="close button button-primary">'.esc_html__( 'Close', 'uix-page-builder' ).'</a> 
						</div>
					 </div>

			';	

		} else {

			echo '
					 <div>'.esc_html__( 'CSS mini-file root directory:', 'uix-page-builder' ).' 
						 <a href="'.$csspath.'" target="_blank">'.$csspath.'</a> '.$enable2.'
					 </div>

			';	


		}
		
	}
?> 
        
        
<?php
	//RTL
    $org_cssname_uix_page_builder2_rtl = UixPageBuilder::to_rtl_css( $org_cssname_uix_page_builder2 );
	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/'.$org_cssname_uix_page_builder2_rtl ) ) {

		$csspath = UixPageBuilder::backend_path( 'uri' ).'css/'.$org_cssname_uix_page_builder2_rtl;

		// capture output from WP_Filesystem
		ob_start();

			UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder2_rtl, $filetype );
			$out = ob_get_contents();
		ob_end_clean();

		if ( empty( $out ) ) {

			$sourcecode = UixPageBuilder::wpfilesystem_read_file( 'uix_pb_customcss', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_page_builder2_rtl, $filetype );

			echo '

					 <div class="uix-popwin-dialog-wrapper">
					     '.esc_html__( 'RTL CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="javascript:" class="uix-popwin-viewcss-btn">'.$csspath.'</a> '.$enable2.'
						 <div class="uix-popwin-dialog-mask"></div>
						 <div class="uix-popwin-dialog">  
							<textarea rows="15" style=" width:95%;" class="regular-text">'.$sourcecode.'</textarea>
							<a href="javascript:" class="close button button-primary">'.esc_html__( 'Close', 'uix-page-builder' ).'</a>
						</div>
					 </div>

			';	

		} else {

			echo '
					 <div>'.esc_html__( 'RTL CSS file root directory:', 'uix-page-builder' ).' 
						 <a href="'.$csspath.'" target="_blank">'.$csspath.'</a> '.$enable2.'
					 </div>

			';	


		}
		
	}
?>        
        
        
        <hr />
        
        <?php submit_button(); ?>

    
    </form>


    
<?php 
	} else {
		echo __( '<p>The .css file does not exist.</p>', 'uix-page-builder' );
		
	}																			
} 
?>
																				
																			