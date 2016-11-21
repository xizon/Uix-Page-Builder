<?php 
$uix_pb_config = [
	
		array(
			'title'           => __( 'Features', 'uix-page-builder' ),
			'id'              => 'uix_pb_section_features'
		
		),
		array(
			'title'           => __( 'Hello', 'uix-page-builder' ),
			'id'              => 'uix_pb_section_hello'
		
		),	
];

	
foreach ( $uix_pb_config as $key ) {
	echo "<a class=\"widget-item ".$key[ 'id' ]."\" data-target=\"'+num+'\" href=\"javascript:\">".$key[ 'title' ]."</a>";
}	
