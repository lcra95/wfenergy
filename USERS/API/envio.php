<?php 
session_start();
$mysqli = new mysqli("localhost", "latinsyc_lrequen", "18594602lcra*", "latinsyc_giasys");
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

$res=$xmlDoc->getElementsByTagName('EstadoDTE');
$estado=$res->item(0)->nodeValue;
if($estado!=0){

    switch($docTipo):
        case 33: 
            $sql1="DELETE FROM factura WHERE id = $docFolio";
            $sql2="DELETE FROM factura_concepto WHERE id_factura = $docFolio";
            $sql3="DELETE FROM factura_transaccion WHERE id_factura = $docFolio";
            $mysqli->query($sql2);
            $mysqli->query($sql3);
        break;
        case 56: 
            $sql1="DELETE FROM nota_debito WHERE folio = $docFolio";
        break;   
        case 61: 
            $sql1="DELETE FROM nota_credito WHERE folio = $docFolio";
        break;   
    endswitch;
 
        $mysqli->query($sql1);
    
    switch($estado){
        case 1:
            $_SESSION['msg']="Error En el Shema XML";
            header("location: Facturacion/listafacturas.php");
        break;
        case 2:
            $_SESSION['msg']="Error en Datos";
            header("location: Facturacion/listafacturas.php");
        break;
        case 3:
            $_SESSION['msg']="Folio Duplicado";
            header("location: Facturacion/listafacturas.php");
        break;
        default:
            $_SESSION['msg']="Error en el Envio del DTE";
            header("location: Facturacion/listafacturas.php");

    }

}else{
    foreach( $searchNode as $searchNode ){
    
        $valueID = $searchNode->getAttribute('Url');
        $sql="INSERT INTO `latinsyc_giasys`.`factura_docs` (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL,'','$valueID','$docFolio')";
        $mysqli->query($sql);
        //header ("location: Logs/RespuestaWs/$docFolio.xml");
        $_SESSION['msg']="Operacion Exitosa Folio ".$docFolio." Tipo ".$docTipo;
 	    header("location: Facturacion/listafacturas.php");
    }
}
?>
