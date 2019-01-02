<?php 
date_default_timezone_set('America/Santiago');
include_once ("nusoap/src/nusoap.php");
include_once ('leefactura.php');
include_once (dirname(__FILE__).'/../../Config.php');
$emisorRut=WS_EMISOR;
$usuarioWs=WS_USER;
$claveWs=WS_PASS;
$fecha=date('Y-m-d');
//$fecha='2018-12-14';
$objClienteSOAP = new soapclient(WS_PROD);
$token = $objClienteSOAP->getToken($emisorRut, $usuarioWs, $claveWs);
$recibidos = $objClienteSOAP->getComprasJson($token, $emisorRut, $fecha);
$res=0;
$coun=0;
$arrayRec =json_decode($recibidos, true);
// echo '<pre>';
//     print_r($arrayRec);
// echo '</pre>';  
foreach ($arrayRec as $key){

    $folio=$key['dteFolio'];
    $emision=$key['dteFechaEmision'];
    $emite=$key['dteRutEmisor'];
    $dteTipo_id=$key['dteTipo_id'];
    $dteXml=$key['dteXml'];
    $dtePdf=$key['dtePdf'];
    $xmldec=base64_decode($dteXml);
    $rest = substr($emite, 0, -2); 
    $xml='Logs/Recepcion/'.$rest.'_'.$dteTipo_id.'_'.$folio.'.xml';
 
    $fp = fopen($xml, 'w');
    fwrite($fp, $xmldec);
    fclose($fp);

    $lector = new leeXml();
    $reg=$lector->getDtes($xml,$dtePdf);
    if($reg){
        $coun++;
    }else{
        $res++;
    }

}


header("location: Facturacion/listarecibo.php");

?>