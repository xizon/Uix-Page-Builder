<?php

function uix_pagebuilder_options_page(){
	
    //must check that the user has the required capability 
    if ( !current_user_can( 'manage_options' ) ){
      wp_die( __('You do not have sufficient permissions to access this page.', 'uix-pagebuilder') );
    }

  
?>


<style>
/* General */
.uix-bg-custom-wrapper img{
	background-color:#fff;
    border: 1px solid #ddd;
    padding: 5px;
	-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.uix-bg-custom-wrapper a{
	text-decoration:none;
}

.uix-bg-custom-wrapper code{
	border:1px solid #B1B1B1;
	-webkit-border-radius: 2px; 
	-moz-border-radius: 2px; 
	border-radius: 2px;
	line-height:1.1em;
	margin-bottom:5px;
	display:inline-block;
	
}

.uix-bg-custom-title{
	font-size:1.1em;
	font-weight:bold;
}
.uix-bg-custom-title strong,
.uix-bg-custom-desc strong{
	color:#D16E15;
}
	
.uix-bg-custom-blockquote {
    background: #EBEBEB;
	border: 1px solid #F8F8F8;
    border-left: 7px solid #BEBEBE;
    padding: 0 2em 1.421875em;
	margin: 1.625em;
	font-style: italic;
	line-height: 2;
    quotes: "\201C""\201D""\2018""\2019";
	font-size: 1.14285714286em;
	color: #939393;
}
	

/* Code preview container*/
.uix-pagebuilder-dialog {  
    width:500px;
	height:440px;
	padding:20px 0 0 20px;
    background:#e8e8e8;
    border: 1px solid #dadada;
    font-family:sans-serif;
	-webkit-box-shadow: 0 1px 15px rgba(0,0,0,.8);
	-moz-box-shadow: 0 1px 15px rgba(0,0,0,.8);
	box-shadow: 0 1px 15px rgba(0,0,0,.8);
	position:absolute;
	top:50%;
	margin-top:-250px;
	left:50%;
	margin-left:-250px;
	display:none;
	z-index:9999999;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px; 
	border-radius: 5px;
}  

.uix-pagebuilder-dialog-mask{
	display:none;
	z-index:9999998;
	background:rgba(0,0,0,.8);
	position:fixed;
	top:0;
	left:0;
	height:100%;
	width:100%;
}
	

.uix-pagebuilder-dialog textarea{
	width:100%;
	height:90%;
}
.uix-pagebuilder-dialog .close{
	display:inline-block;
	margin-top:3px;
}

@media all and (max-width: 540px) {
	
	.uix-pagebuilder-dialog {  
		width: 300px;
		margin-left:-170px;
		
	}
	
}

	
</style>

<div class="wrap uix-bg-custom-wrapper">
    
    <h2><?php _e( 'Uix Page Builder Helper', 'uix-pagebuilder' ); ?></h2>
    <?php
	
	if( !isset( $_GET[ 'tab' ] ) ) {
		$active_tab = 'about';
	}
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} 
	
	$tabs = array();
	$tabs[] = [
	    'tab'     =>  'about', 
		'title'   =>  __( 'About', 'uix-pagebuilder' )
	];
	$tabs[] = [
	    'tab'     =>  'usage', 
		'title'   =>  __( 'How to use?', 'uix-pagebuilder' )
	];
	
	$tabs[] = [
	    'tab'     =>  'credits', 
		'title'   =>  __( 'Credits', 'uix-pagebuilder' )
	];
	
	$tabs[] = [
	    'tab'     =>  'temp', 
		'title'   =>  __( 'Template Files', 'uix-pagebuilder' )
	];
	
	$tabs[] = [
	    'tab'     =>  'custom-css', 
		'title'   =>  __( '<i class="dashicons dashicons-welcome-view-site"></i> Custom CSS', 'uix-pagebuilder' )
	];	
	
	
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
		foreach ( glob( WP_PLUGIN_DIR .'/'.UixPageBuilder::get_slug(). "/helper/tabs/*.php") as $file ) {
			include $file;
		}	
	?>
        
    
    
</div>
 
    <?php
     
}