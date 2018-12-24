<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_page_builder_temp';

	
// If they did, this hidden field will be set to 'Y'
if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' &&
    ( ( isset( $_GET[ 'tempfiles' ] ) && $_GET[ 'tempfiles' ] == 'ok' ) || ( isset( $_GET[ '_wpnonce' ] ) && !empty( $_GET[ '_wpnonce' ] ) ) ) 
  ) {

	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = "";
		
		if( UixPageBuilder::tempfile_exists() ) {
			// Template files removed
			$status_echo = UixPageBuilder::templates( 'uix_page_builder_tempfiles', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp', true );
			echo $status_echo;
	
		} else {
			// Template files copied
			$status_echo = UixPageBuilder::templates( 'uix_page_builder_tempfiles', 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp' );
			echo $status_echo;
		
		}
	
	}
	
 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) { ?>

	<?php if ( !isset( $_GET[ 'tempfiles' ] ) && !isset( $_GET[ '_wpnonce' ] ) ) { ?>
   
		<?php if( UixPageBuilder::tempfile_exists() ) { ?>

			 <h3><?php _e( 'Uix Page Builder template files already exists. Remove Uix Page Builder template files in your templates directory:', 'uix-page-builder' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access path <code>/wp-content/themes/{your-theme}/</code> and remove Uix Page Builder template files.', 'uix-page-builder' ); ?>
			 </p>   

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-page-builder' ); ?></h4>
				<?php UixPageBuilder::list_templates_name( 'theme' ); ?>
			 </div>
			<p>
				<a class="button button-remove" href="<?php echo esc_url( 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp&tempfiles=ok' ); ?>" onClick="return confirm('<?php echo esc_attr__( 'Are you sure?\nIt is possible based on your theme of the plugin templates. When you create them again, the default plugin template will be used.', 'uix-page-builder' ); ?>');"><?php echo esc_html__( 'Remove Uix Page Builder Template Files', 'uix-page-builder' ); ?></a>
			</p>


		<?php } else { ?>

			 <h3><?php _e( 'Copy Uix Page Builder template files in your templates directory:', 'uix-page-builder' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access the Uix Page Builder template files path <code>/wp-content/plugins/uix-page-builder/uixpb_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-page-builder' ); ?>

			 </p>   

			 <p>
			 <strong><?php _e( 'Hi, there! It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, you can use of the default page template or your own custom template file directly.', 'uix-page-builder' ); ?></strong>

			</p> 

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-page-builder' ); ?></h4>
				<?php UixPageBuilder::list_templates_name( 'plug' ); ?>
			 </div>


			<p>
				<a class="button button-primary" href="<?php echo esc_url( 'admin.php?page='.UixPageBuilder::HELPER.'&tab=temp&tempfiles=ok' ); ?>"><?php echo esc_html__( 'Click This Button to Copy Uix Page Builder Files', 'uix-page-builder' ); ?></a>
			</p> 



		<?php } ?>

	
	<?php } ?>
 
	
    
<?php } ?>