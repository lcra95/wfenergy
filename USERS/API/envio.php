<?php 
include("nusoap/src/nusoap.php");
$idr=$_GET['id'];
$id='Logs/DTE/'.$idr;
$emisorRut="76254347-8";
$usuarioWs="24675367-9";
$claveWs="MtVZCHZ8d351";
$archivoXML = $id;
$archivoXMLdata = file_get_contents($archivoXML);
$dom = new DOMDocument;
$dom->load($archivoXML);
$tips=$dom->getElementsByTagName('TipoDTE');
$docTipo=$tips->item(0)->nodeValue;
$fol=$dom->getElementsByTagName('Folio');
$docFolio=$fol->item(0)->nodeValue;
$emp=$dom->getElementsByTagName('RUTEmisor');
$empresaRut=$emp->item(0)->nodeValue;
$archivoXMLbase64 = base64_encode($archivoXMLdata);
$objClienteSOAP = new soapclient('http://wsprod.webfactura.net/wsWF.php?wsdl');
$token = $objClienteSOAP->getToken($emisorRut, $usuarioWs, $claveWs);
$objRespuesta = $objClienteSOAP->sendDte($token, $archivoXMLbase64, $empresaRut, $docTipo, $docFolio);
$fp = fopen('Logs/RespuestaWs/'.$docFolio.'.xml', 'w');
fwrite($fp, $objRespuesta);
fclose($fp);


$archivoXML1=('Logs/RespuestaWs/'.$docFolio.'.xml');
$archivo=file_get_contents($archivoXML);
$xmlDoc = new DOMDocument;
$xmlDoc->load($archivoXML1);
$searchNode = $xmlDoc->getElementsByTagName( "PDF" );

foreach( $searchNode as $searchNode )
{
   
    $valueID = $searchNode->getAttribute('Url');
    $mysqli = new mysqli("localhost", "latinsyc_lrequen", "18594602lcra*", "latinsyc_giasys");
    $sql="INSERT INTO `latinsyc_giasys`.`factura_docs` (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL,'','$valueID','$docFolio')";
    echo $sql;
    $mysqli->query($sql);
}
	//header ("location: Logs/RespuestaWs/$docFolio.xml");
 	header("location: Facturacion/listafacturas.php");
?>