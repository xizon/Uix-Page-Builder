<?php 

/*
 * Expansion module of Portfolio. ( Require the WP plugin "Uix Products" )
 * 
 */
if ( class_exists( 'UixProducts' ) ) { 

	$module_uix_products = array(
			'title'           => esc_html__( 'Uix Products Grid', 'uix-page-builder' ),
			'id'              => 'uix_pb_section_uix_products.php',
			'thumb'           => 'portfolio-2.jpg',

		);  


} else {
	$module_uix_products = array(
			'title'           => '',
			'id'              => '',
			'thumb'           => '',

		);  
}


/*
 * Expansion module of Slider. ( Require the WP plugin "Uix Slideshow" )
 * 
 */
if ( class_exists( 'UixSlideshow' ) ) { 

	$module_uix_slideshow = array(
			'title'           => esc_html__( 'Uix Slideshow', 'uix-page-builder' ),
			'id'              => 'uix_pb_section_uix_slideshow.php',
			'thumb'           => 'imageslider-2.jpg',

		);  


} else {
	$module_uix_slideshow = array(
			'title'           => '',
			'id'              => '',
			'thumb'           => '',

		);  
}





/*
 * Add the required modules to the page builder
 * 
 */
$uix_pb_config = array(
	

	array(
		'sortname'        => esc_html__( 'Slider', 'uix-page-builder' ),
		'buttons'         => array(
	
								array(
									'title'           => esc_html__( 'Image Slider', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_imageslider.php',
									'thumb'           => 'imageslider-1.jpg',
								
								),
	
	                            $module_uix_slideshow
								
				
							)
	
	),
	
	array(
		'sortname'        => esc_html__( 'Parallax', 'uix-page-builder' ),
		'buttons'         => array(

	
								array(
									'title'           => esc_html__( 'Parallax', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_parallax.php',
									'thumb'           => 'parallax.jpg',
								
								),							
								
				
							)
	
	),
	
	array(
		'sortname'        => esc_html__( 'Team', 'uix-page-builder' ),
		'buttons'         => array(

	
								array(
									'title'           => esc_html__( 'Team Normal', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_team1.php',
									'thumb'           => 'team-1.jpg',
								
								),	
								
								array(
									'title'           => esc_html__( 'Team Grid', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_team2.php',
									'thumb'           => 'team-2.jpg',
								
								),						
								
				
							)
	
	),
	
	array(
		'sortname'        => esc_html__( 'Features', 'uix-page-builder' ),
		'buttons'         => array(

								array(
									'title'           => esc_html__( 'Features 2 Column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_features1.php',
									'thumb'           => 'feaures-1.jpg',
								
								),	
								
								array(
									'title'           => esc_html__( 'Features 3 Column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_features2.php',
									'thumb'           => 'feaures-2.jpg',
								
								),
	
								
				
							)
	
	),
	
	
	array(
		'sortname'        => esc_html__( 'Pricing', 'uix-page-builder' ),
		'buttons'         => array(

						
	
								array(
									'title'           => esc_html__( 'Pricing 3 column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_pricing1.php',
									'thumb'           => 'pricing-1.jpg',
								
								),	
	
								array(
									'title'           => esc_html__( 'Pricing 3 column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_pricing1_2.php',
									'thumb'           => 'pricing-1_2.jpg',
								
								),	
								
								array(
									'title'           => esc_html__( 'Pricing 4 column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_pricing2.php',
									'thumb'           => 'pricing-2.jpg',
								
								),		
	
								
								array(
									'title'           => esc_html__( 'Pricing 4 column', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_pricing2_2.php',
									'thumb'           => 'pricing-2_2.jpg',
								
								),			
				
							)
	
	),
	
	
	array(
		'sortname'        => esc_html__( 'Testimonial', 'uix-page-builder' ),
		'buttons'         => array(

						
								array(
									'title'           => esc_html__( 'Testimonials Carousel', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_testimonials.php',
									'thumb'           => 'testimonials.jpg',
								
								),

							
								array(
									'title'           => esc_html__( 'Clients', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_clients.php',
									'thumb'           => 'clients.jpg',
								
								),					
				
							)
	
	),
	
	

	array(
		'sortname'        => esc_html__( 'Web Elements', 'uix-page-builder' ),
		'buttons'         => array(
		
	
								array(
									'title'           => esc_html__( 'Accordion', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_accordion.php',
									'thumb'           => 'accordion.jpg',
								
								),	
								
								
								array(
									'title'           => esc_html__( 'Tabs', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_tabs.php',
									'thumb'           => 'tabs.jpg',
								
								),
	
								array(
									'title'           => esc_html__( 'Author Card', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_authorcard.php',
									'thumb'           => 'card.jpg',
								
								),	
								
								array(
									'title'           => esc_html__( 'Progress Bar', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_bar.php',
									'thumb'           => 'bar.jpg',
								
								),	
								

								array(
									'title'           => esc_html__( 'Google Map', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_map.php',
									'thumb'           => 'map.jpg',
								
								),	
	
								array(
									'title'           => esc_html__( 'Instagram Feed', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_instagram.php',
									'thumb'           => 'instagram.jpg',
								
								),
	
								array(
									'title'           => esc_html__( 'Contact Form', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_contactform.php',
									'thumb'           => 'contactform.jpg',
								
								),
		
										
							
							)
	
	),		
	
	
	
	array(
		'sortname'        => esc_html__( 'Sidebar', 'uix-page-builder' ),
		'buttons'         => array(

	
								array(
									'title'           => esc_html__( 'WP Sidebar', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_sidebar.php',
									'thumb'           => 'sidebar.jpg',
								
								),
	
							)
	
	),	
	
	
	array(
		'sortname'        => esc_html__( 'Blog', 'uix-page-builder' ),
		'buttons'         => array(

	
								array(
									'title'           => esc_html__( 'WP Posts List', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_blog.php',
									'thumb'           => 'blog.jpg',
								
								),

				
							)
	
	),	
	
	
	array(
		'sortname'        => esc_html__( 'Portfolio', 'uix-page-builder' ),
		'buttons'         => array(
							

								array(
									'title'           => esc_html__( 'Portfolio Grid', 'uix-page-builder' ),
									'id'              => 'uix_pb_section_portfolio1.php',
									'thumb'           => 'portfolio-1.jpg',
								
								),
	
                                $module_uix_products
	
							)
	
	),	
	

		
);


