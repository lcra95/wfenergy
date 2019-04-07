<?php
include_once ('../../Config.php');
session_start();
$mysqli = new mysqli(SERVER, DB_USER, DB_PASS, DB);
include_once ("nusoap/src/nusoap.php");
$idr=$_GET['id'];
$transaccion = @$_GET['tran'];
//$idr="unaprueba.xml";//SE COMENTA LA LINEA ANTERIOR, SE ACTIVA ESTA Y SE COLOCA EL NOMBRE DEL ARCHIVO QUE SE DESEA ENVIAR MANUALMENTE
$id='Logs/DTE/'.$idr;
$emisorRut=WS_EMISOR;
$usuarioWs=WS_USER;
$claveWs=WS_PASS;
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
$objClienteSOAP = new soapclient(WS_PROD);
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

$res=$xmlDoc->getElementsByTagName('EstadoDTE');
$estado=$res->item(0)->nodeValue;
if($estado!=0){
    $fp = fopen('Logs/RespuestaWs/Errors/Folio_'.$docFolio.'_Transaccion_'.$transaccion.'.xml', 'w');
    fwrite($fp, $objRespuesta);
    fclose($fp);
    switch($docTipo):
        case 33: 
            $sql1="DELETE FROM factura WHERE id = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            $sql2="DELETE FROM factura_concepto WHERE id_factura = $docFolio";
            $sql3="DELETE FROM factura_transaccion WHERE id_factura = $docFolio";
            // $mysqli->query($sql2);
            // $mysqli->query($sql4);
            // $mysqli->query($sql3);
        break;
        case 56: 
            $sql1="DELETE FROM nota_debito WHERE folio = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            // $mysqli->query($sql4);
        break;   
        case 61: 
            $sql1="DELETE FROM nota_credito WHERE folio = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            // $mysqli->query($sql4);
            break;   
    endswitch;
 
        // $mysqli->query($sql1);
    
    switch($estado){
        case 1:
            echo $_SESSION['msg']="Error En el Schema XML";
            //header("location: Facturacion/pfactura.php");
        break;
        case 2:
            echo $_SESSION['msg']="Error en Datos";
            //header("location: Facturacion/pfactura.php");
        break;
        case 3:
            echo $_SESSION['msg']="Folio Duplicado";
            //header("location: Facturacion/pfactura.php");
        break;
        default:
            echo $_SESSION['msg']="Error en el Envio del DTE";
            //header("location: Facturacion/pfactura.php");

    }

}else{

    switch($docTipo):
        case 56: 
            $sql1="DELETE FROM nota_debito WHERE folio = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            $mysqli->query($sql4);
        break;   
        case 61: 
            $sql1="DELETE FROM factura_transaccion WHERE id_factura = $FolioRef";           
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $FolioRef)";
            $mysqli->query($sql4);
            $mysqli->query($sql1);
        break;   
    endswitch;

    foreach( $searchNode as $searchNode ){
    
        $valueID = $searchNode->getAttribute('Url');
        $sql="INSERT INTO factura_docs (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL,'','$valueID','$docFolio')";
        // $mysqli->query($sql);
        //header ("location: Logs/RespuestaWs/$docFolio.xml");
        echo $_SESSION['msg']="Operacion Exitosa Folio ".$docFolio." Tipo ".$docTipo;
 	    //header("location: Facturacion/pfactura.php");
    }
}
?>
