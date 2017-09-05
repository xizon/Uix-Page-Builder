<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Parse XML
 *
 */
 
/*

<?xml version="1.0" encoding="utf-8"?>
<items>
  <item id="1">
    <title>name1</title>
    <author>sex</author>
  </item>
  <item id="2">
    <title>name2</title>
    <author>sex</author>
  </item>
  <item id="3">
    <title>name3</title>
    <author>sex</author>
  </item>
</items>


-------------- 1. Get a single piece of data ---------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';
$xValue          = $xml -> xml_read();

echo $xValue['item']['title'];


--------------2. Get multiple data ---------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';
$xLength         = $xml -> get_xmlLength();
$xValue          = $xml -> xml_read();


for ( $xmli = $xLength - 1; $xmli >= 0; $xmli-- ) {
	echo $xValue['item'][$xmli]['title'];
}


--------------3. Create a new xml file ---------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';

$xml -> xmlArr []  =  array(
    'id'      => '1',
	'title'   => 'name1',
	'author'  => 'sex',
	'love'    => '1'
	
);
$xml -> xmlArr []  =  array(
    'id'      => '2',
	'title'   => 'name2',
	'author'  => 'sex',
	'love'    => '0'
	
);
$xml -> create_newxml();


-------------- 4. Modify the node ---------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';
$xml -> up_xml(3,'title','new name');

-------------- 5. Delete the node ---------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';
$xml -> del_xml(2); //delete id 2
$xml -> del_xml(); //delete all


--------------6. Insert a new node -------------

$xml             = new UixPB_XML;  
$xml -> xml_path = '???.xml';

$xml -> xmlArr  =  array(
    'id'     => '6',
	'title'  => 'new name1',
	'author' => 'sex',
	'love'   => '5'
	
);
$xml -> insert_xml();

*/


 
if (  !class_exists(  'UixPB_XML'  )  ) {

	class UixPB_XML {
		
		public $xml_path; 
		public $xmlArr         =array(); 
		public $xml_nodes      ='item'; 
		public $xml_root_nodes ='items'; 
		public $format_output  = false; 
		
		
		/**
		 * Read nodes
		 *
		 */
		function xml_read() {
			
			$xmlstr=@file_get_contents( $this->xml_path );
			if( $xmlstr ){
				$config=$this->xml2array( $xmlstr );
			}	
			return $config;
		}
			
			
		function xml2array( $parsePath ) {
			$pos=strpos( $parsePath, 'xml' );
			if ( $pos ) {
				$xmlCode=simplexml_load_string( $parsePath,'SimpleXMLElement', LIBXML_NOCDATA );
				$arrayCode=$this->get_object_vars_final( $xmlCode );
				return $arrayCode ;
			} else {
				return '';
			}
		}
		
		function get_object_vars_final( $obj ){
			if( is_object( $obj ) ){
				$obj=get_object_vars( $obj );
			}
			
			if( is_array( $obj ) ){
				foreach ( $obj as $key=>$value ){
					$obj[$key]=$this->get_object_vars_final( $value );
				}
			}
			return $obj;
		}
		
		
		/**
		 * Returns nodes
		 *
		 */
		function get_xmlLength() {
			$xml=new DOMDocument( '1.0', 'utf-8' );
			@$xml->load( $this->xml_path );
			$xmlNtotal = $xml->getElementsByTagName( $this->xml_nodes )->length;
			return $xmlNtotal;
	
	
		 }
		 
		 
		/**
		 * Create a new xml file
		 *
		 */ 
		 function create_newxml() {
			$xml=new DOMDocument( '1.0', 'utf-8' );
			$xml->formatOutput=$this->format_output;
			
			$item = $xml->createElement( $this->xml_root_nodes );
			$xml->appendChild( $item );
	
	
			foreach( $this->xmlArr as $str ){
				$nod=$xml->createElement( $this->xml_nodes );
				$nod->setAttribute( 'id',$str['id'] );	
				
				foreach ( $str as $key => $val ) {
					
					if ( $key != 'id' ){
						$nodsub=$xml->createElement( $key );
						$nodsub->appendChild( $xml->createTextNode( $str[$key] ) );
						$nod->appendChild( $nodsub );
						
						//---
						$item->appendChild( $nod );
		
					}
			
					
				}
		
			
			}
			
			if( fwrite( fopen( $this->xml_path,"w" ),str_replace( PHP_EOL.PHP_EOL.PHP_EOL, "",$xml->saveXML() ) ) ){
				return true;
			}else{
				return false;
			
			}
			
			//$xml->save( $this->xml_path );
			
		   
		 }
	
		/**
		 * Modify nodes
		 *
		 */ 
		 function up_xml( $id,$nodNow,$str ){
			 
			$xml=new DOMDocument( '1.0', 'utf-8' );
			
			if ( $this->get_xmlLength()>0 ){
		
				$xml->load( $this->xml_path );
				
				$nod=$xml->getElementsByTagName( $this->xml_nodes );
				foreach( $nod as $a ){
					
					foreach( $a->attributes as $b ){
						//echo $b->nodeValue;
						if( $b->nodeValue==$id ){
							//$a->setAttribute( 'id',$str ); 
							$a->getElementsByTagName( $nodNow )->item( 0 )->nodeValue = $str;
							
						}
					}
					
				}
		
				
				if( fwrite( fopen( $this->xml_path,"w" ),str_replace( PHP_EOL.PHP_EOL.PHP_EOL, "",$xml->saveXML() ) ) ){
					return true;
		
				}else{
					return false;
				}
	
	
			}
			
			
			if ( $this->get_xmlLength()==0 ){
				return false;
			}
			
			
		 }
		
	
		/**
		 * Delete nodes
		 *
		 */
		 function del_xml( $type='all' ){
	
			$xml=new DOMDocument( '1.0', 'utf-8' );
	
			if ( $this->get_xmlLength()>0 ){
				$xml->load( $this->xml_path );
				
				$nodAll=$xml->getElementsByTagName( $this->xml_root_nodes )->item( 0 );
				$nod=$xml->getElementsByTagName( $this->xml_nodes );
				$root=$xml->documentElement;
		
				$nod=$xml->getElementsByTagName( $this->xml_nodes );
		
				if ( is_numeric( $type ) == 1 ){
	
					foreach( $nod as $a ){
						
						foreach( $a->attributes as $b ){
							if( $b->nodeValue==$type ){
								$root->removeChild( $a );
			
							}
						}
						
					}
	
	
				}else{
					
					if ( $this->get_xmlLength()>0 ){
						$nodAll->parentNode->removeChild( $nodAll );
					}
					
					
					$xml->formatOutput=$this->format_output;
					$item = $xml->createElement( $this->xml_root_nodes );
					$xml->appendChild( $item );
		
				}
		
				
				if( fwrite( fopen( $this->xml_path,"w" ),str_replace( PHP_EOL.PHP_EOL.PHP_EOL, "",$xml->saveXML() ) ) ){
					return true;
		
				}else{
					return false;
				}
	
				
			}
	
			
			if ( $this->get_xmlLength()==0 ){
				return false;
			}
			
			
		 }
		 
		 
		/**
		 * Insert nodes
		 *
		 */
		 function insert_xml() {
	
			$xml=new DomDocument();
			
			if ( $this->get_xmlLength()>0 ){
			
				$xml->load( $this->xml_path );
				
				$nod=$xml->documentElement;
				
				$nodSub=$xml->createElement( $this->xml_nodes );
				$nodSub->setAttribute( 'id',$this->xmlArr['id'] );
				$nod->appendChild( $nodSub );
				
				
		
				foreach ( $this->xmlArr as $key => $val ) {
		
					if ( $key != 'id' ){
						
						$nodName=$xml->createElement( $key );
						$nodName->appendChild( $xml->createTextNode( $this->xmlArr[$key] ) );
						$nodSub->appendChild( $nodName );
					
		
					}
			
					
				}
				
		
				if( fwrite( fopen( $this->xml_path,"w" ),str_replace( PHP_EOL.PHP_EOL.PHP_EOL, "",$xml->saveXML() ) ) ){
					return true;
		
				}else{
					return false;
				}
	
	
				
			}
			
			if ( $this->get_xmlLength()==0 ){
				return false;
			}
			
			
		 }
		 
		 
		 function json_getxml() {
			$jsonxml=simplexml_load_file( $this->xml_path );
			return json_encode( $jsonxml );
		 }	 
		 
	
		
	}
		
}
