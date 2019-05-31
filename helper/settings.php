<?php

/*
 * Enqueuing Scripts and Styles
 * 
 */
function uix_page_builder_scripts() {

	//Check if screen ID
	$currentScreen = get_current_screen();

	if ( UixPageBuilder::inc_str( $currentScreen->base, '_page_' ) &&
		 ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == UixPageBuilder::HELPER )	
	 ) 
	{
	    wp_enqueue_style( UixPageBuilder::PREFIX . '-helper', UixPageBuilder::plug_directory() .'helper/helper.css', true, UixPageBuilder::ver(), 'all' );
		wp_enqueue_script( UixPageBuilder::PREFIX . '-helper', UixPageBuilder::plug_directory() .'helper/helper.js', array( 'jquery' ), UixPageBuilder::ver(), true );	

	} 
	
	
}
add_action( 'admin_enqueue_scripts', 'uix_page_builder_scripts' );


/*
 * Add an operator panel in admin panel
 * 
 */
function uix_page_builder_options_page(){
	
    //must check that the user has the required capability 
    if ( !current_user_can( 'manage_options' ) ){
      wp_die( __('You do not have sufficient permissions to access this page.', 'uix-page-builder') );
    }

  
?>


<div class="wrap uix-bg-custom-wrapper">
    
    <h2><?php _e( 'Uix Page Builder Helper', 'uix-page-builder' ); ?></h2>
    <?php
	
	if( !isset( $_GET[ 'tab' ] ) ) {
		$active_tab = 'about';
	}
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} 
	
	$tabs = array();
	$tabs[] = array(
	    'tab'     =>  'about', 
		'title'   =>  __( 'About', 'uix-page-builder' )
	);
	$tabs[] = array(
	    'tab'     =>  'usage', 
		'title'   =>  __( 'How to use?', 'uix-page-builder' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'credits', 
		'title'   =>  __( 'Credits', 'uix-page-builder' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'temp', 
		'title'   =>  __( 'Template Files', 'uix-page-builder' )
	);
	
	
	$tabs[] = array(
	    'tab'     =>  'general-settings', 
		'title'   =>  __( '<i class="dashicons dashicons-admin-generic"></i> General Settings', 'uix-page-builder' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'custom-css', 
		'title'   =>  __( '<i class="dashicons dashicons-welcome-view-site"></i> Custom CSS', 'uix-page-builder' )
	);	
	
	$tabs[] = array(
		'tab'     =>  'for-developer', 
		'title'   =>  __( '<i class="dashicons dashicons-networking"></i> For Theme Developer', 'uix-page-builder' )
	);		
	
	
	?>
    <h2 class="nav-tab-wrapper">
        <?php foreach ( $tabs as $key ) :  ?>
            <?php $url = 'admin.php?page=' . rawurlencode( UixPageBuilder::HELPER ) . '&tab=' . rawurlencode( $key[ 'tab' ] ); ?>
            <a href="<?php echo esc_attr( is_network_admin() ? network_admin_url( $url ) : admin_url( $url ) ) ?>"
               class="nav-tab<?php echo $active_tab === $key[ 'tab' ] ? esc_attr( ' nav-tab-active' ) : '' ?>">
                <?php echo $key[ 'title' ] ?>
            </a>
        <?php endforeach ?>
    </h2>

    <?php 
		foreach ( glob( UIX_PAGE_BUILDER_PLUGIN_DIR. "helper/tabs/*.php") as $file ) {
			include $file;
		}	
	?>
        
    
    
</div>
 
    <?php
     
}