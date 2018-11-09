<?php 
date_default_timezone_set('America/Santiago');
include_once ("nusoap/src/nusoap.php");
include_once ('leefactura.php');
$emisorRut="76254347-8";
$usuarioWs="24675367-9";
$claveWs="MtVZCHZ8d351";
$fecha=date('Y-m-d');
$objClienteSOAP = new soapclient('http://wstest.webfactura.net/wsWF.php?wsdl');
$token = $objClienteSOAP->getToken($emisorRut, $usuarioWs, $claveWs);
$recibidos = $objClienteSOAP->getComprasJson($token, $emisorRut, $fecha);
$res=0;
$coun=0;
$arrayRec =json_decode($recibidos, true);
foreach ($arrayRec as $key){
    $folio=$key['dteFolio'];
    $emision=$key['dteFechaEmision'];
    $emite=$key['dteRutEmisor'];
    $dteTipo_id=$key['dteTipo_id'];
    $dteXml=$key['dteXml'];
    $xmldec=base64_decode($dteXml);

    $xml='Logs/Recepcion/'.$folio.'_'.$emite.'_'.$dteTipo_id.'_'.$emision.'.xml';
    $fp = fopen($xml, 'w');
    fwrite($fp, $xmldec);
    fclose($fp);

    $lector = new leeXml();
    $reg=$lector->getDtes($xml);
    if($reg){
        $coun++;
    }else{
        $res++;
    }

}
echo 'Exitosos '.$coun.'<br>';
echo 'Fallidos '.$res;

?>