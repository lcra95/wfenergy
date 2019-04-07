<?php
set_time_limit ( -1 );
include_once ('../../Config.php');
session_start();
$xmlDoc = new DOMDocument;
$mysqli = new mysqli(SERVER, DB_USER, DB_PASS, DB);
include_once ("nusoap/src/nusoap.php");
$emisorRut = WS_EMISOR;
$usuarioWs = WS_USER;
$claveWs = WS_PASS;
$docTipo = 2;
$date = date('Y-m-d');
$time = date('h:i:s');
$objClienteSOAP = new soapclient(WS_PROD);
$token = $objClienteSOAP->getToken($emisorRut, $usuarioWs, $claveWs);
$sql = "SELECT 
    fd.id_factura, f.id_tipo_documento 
FROM factura_docs fd 
JOIN factura f on f.id = fd.id_factura
WHERE fd.xml =''";
$resultado=$mysqli->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    $xml= '<?xml version="1.0" encoding="UTF-8"?>
                <SetDTE version="1.0">
                    <ConsultaDTE ID="CDTE01">
                        <Caratula>
                            <RutEmisor>'.$emisorRut.'</RutEmisor>
                            <NroDetalles>1</NroDetalles>
                            <FechaHoraConsulta>'.$date.'T'.$time.'</FechaHoraConsulta>
                            <TipoConsulta>2</TipoConsulta>
                        </Caratula>
                        <DocumentoDTE>
                            <TipoDTE>'.$fila['id_tipo_documento'].'</TipoDTE>
                            <Folio>'.$docFolio = $fila['id_factura'].'</Folio>
                        </DocumentoDTE>
                    </ConsultaDTE>
                </SetDTE>';
        $docFolio = $fila['id_factura'];
        $base64file= base64_encode($xml);
        $objRespuesta = $objClienteSOAP->sendQuery($token, $base64file, $emisorRut, $docTipo);                
        $file = 'Logs/SendQuery/'.$docFolio.'.xml';

        $fp = fopen($file, 'w');
        fwrite($fp, $objRespuesta);
        fclose($fp);


        $xmlDoc->load($file);

        $searchNode = $xmlDoc->getElementsByTagName( "Xml" );
        foreach( $searchNode as $searchNode ){
    
            $valueID = $searchNode->getAttribute('Url');
            $upd ="UPDATE `factura_docs` SET `xml` = '$valueID' WHERE `id_factura` =".$docFolio;
            $result = $mysqli ->query($upd); 
            unlink($file);
        
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $valueID );
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result=curl_exec ($ch);
        
        $oldfile = 'Logs/SendQuery/result.xml';
        $fp = fopen($oldfile, 'w');
        fwrite($fp, $result);
        fclose($fp);

        getDtes($oldfile);
        unlink($oldfile);
}





function getDtes($xml){
    
    $Doc = file_get_contents($xml);
    if(!empty($xml)){
    
    $xmlDoc = new DOMDocument;
    $xmlDoc->load($xml);

    $encabezados=$xmlDoc->getElementsByTagName('IdDoc');
    foreach ($encabezados as $encabezado) 
    {
    //Acceso al TAG
        $TipoDTE=$encabezado->getElementsByTagName('TipoDTE');
        $folio=$encabezado->getElementsByTagName('Folio');
        $fecha=$encabezado->getElementsByTagName('FchEmis');
    //Valores Contenidos en los TAGS
        $fl=$folio->item(0)->nodeValue;
        $fh=$fecha->item(0)->nodeValue;
        $tp=$TipoDTE->item(0)->nodeValue;
    }
        
    $emisors=$xmlDoc->getElementsByTagName('Emisor');
    foreach($emisors as $emisor)
    {
//Acceso al TAG 
        $rut=$emisor->getElementsByTagName('RUTEmisor');
    //Valores Contenidos en los TAGS
        @$re=$rut->item(0)->nodeValue;
    }    
    $receptors=$xmlDoc->getElementsByTagName('Receptor');
    foreach($receptors as $receptor)
    {
//Acceso al TAG 
        $rutr=$receptor->getElementsByTagName('RUTRecep');
    //Valores Contenidos en los TAGS
        @$rr=$rutr->item(0)->nodeValue;
    }    
    $detalles=$xmlDoc->getElementsByTagName('Detalle');

        foreach ($detalles as $detalle ) 
        {
           @$nombre[$i]=$detalle->getElementsByTagName('NmbItem');
           @$nom=$nombre[$i]->item(0)->nodeValue;
                           
        }
    $nfh = explode('-',$fh);
    $mes = $nfh[1];
    $ano = $nfh[0];
    $re=substr($re,0,8);
    if($fh=='2018-12-01'){
        $mes=11;
    }
    
    $archi='Logs/'.$ano.'/'.$mes.'/'.$re.'_'.$tp.'_'.$fl.'.xml';

    $fp = fopen($archi, 'w');
    fwrite($fp, $Doc);
    fclose($fp);
    echo $archi.'<br>';

    return true;
}
}
