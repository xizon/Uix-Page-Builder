<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_pb_generalsettings';

	
// If they did, this hidden field will be set to 'Y'
if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_pb_generalsettings' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$uix_pb_opt_map_api   = sanitize_text_field( $_POST[ 'uix_pb_opt_map_api' ] );
		
		// Save the posted value in the database
		update_option( 'uix_pb_opt_map_api', $uix_pb_opt_map_api );
		
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-page-builder' ).'</strong></p></div>';

		
	}


 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'general-settings' ) {
	
?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_pb_generalsettings' ); ?>
  
        <table class="form-table">
			
			
          <tr>
            <th scope="row">
              <?php _e( 'Google Map Settings', 'uix-page-builder' ); ?>
				
            </th>
            <td>
                <p>
                    <label>
                        <input name="uix_pb_opt_map_api" type="text" size="50" value="<?php echo esc_attr( get_option( 'uix_pb_opt_map_api', '' ) ); ?>"/>
                        <?php _e( 'API Key', 'uix-page-builder' ); ?>
                    </label>
                </p>
                
				<p>
				<?php
				   printf( __( '<a href="%1$s" target="_blank">How to 
Get an API Key?</a> If left blank, the default Key will be used, but it will have a traffic excess problem that will not display properly. <br><strong>You can also specify the Key separately when using the map module.</strong>', 'uix-page-builder' ), esc_url( '//developers.google.com/maps/documentation/javascript/get-api-key' ) );   
				   ?>
				</p>

              
				
            </td>
             
            
          </tr>	
			
        </table> 
        

        <?php submit_button(); ?>

    
    </form>


    
<?php } ?>