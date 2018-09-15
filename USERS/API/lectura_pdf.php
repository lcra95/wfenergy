<?php 

$archivoXML=('respuestaWs120.xml');
$archivo=file_get_contents($archivoXML);
$xmlDoc = new DOMDocument;
$xmlDoc->load($archivoXML);
$searchNode = $xmlDoc->getElementsByTagName( "PDF" );

foreach( $searchNode as $searchNode )
{
   
    $valueID = $searchNode->getAttribute('Url');
    header("location: $valueID");
}

?>