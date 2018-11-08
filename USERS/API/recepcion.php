<?php 
include("nusoap/src/nusoap.php");
$emisorRut="76254347-8";
$usuarioWs="24675367-9";
$claveWs="MtVZCHZ8d351";
//$fecha=date('Y-m-d');
$fecha='2018-10-29';
$objClienteSOAP = new soapclient('http://wstest.webfactura.net/wsWF.php?wsdl');
$token = $objClienteSOAP->getToken($emisorRut, $usuarioWs, $claveWs);
$recibidos = $objClienteSOAP->getComprasJson($token, $emisorRut, $fecha);

$arrayRec =json_decode($recibidos, true);
foreach ($arrayRec as $key){
    $folio=$key['dteFolio'];
    $emision=$key['dteFechaEmision'];
    $emite=$key['dteRutEmisor'];
    $dteTipo_id=$key['dteTipo_id'];
    $dteXml=$key['dteXml'];
    $xmldec=base64_decode($dteXml);

    $fp = fopen('Logs/Recepcion/'.$folio.'_'.$emite.'_'.$dteTipo_id.'.xml', 'w');
    fwrite($fp, $xmldec);
    fclose($fp);

}

?>