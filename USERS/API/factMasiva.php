<?php 
session_start();
include_once ("conexion.php");
include_once ("funciones.php");

$sel=mysql_query("SELECT * FROM empresa_transaccion WHERE id_status = 0");

echo '<pre>';

while($row=mysql_fetch_array($sel))
{ 
    
    $sql2=mysql_query("SELECT * FROM factura_transaccion WHERE id_transaccion = $row[0]");
	if($data=mysql_fetch_array($sql2))
	{	
        if(($row[1]<20)&&($row[4]>0)){
           if($res = factMasiva($row)){
            
                print_r($res); 

           }
        }else if(($row[1]>=20)&&($row[4]<0)){
            
	    }
    }

}
function factMasiva($row){
    
    if($row){

        $factura = proxima_factura();
        $status = 1;
        $observacion = "";
        $fecha = date('Y-m-d');
        $fvence = date('Y-m-d');
        $transaccion = $row['id'];
        $empresa = $row['id_empresa'];
        $periodo = $row['periodo'];
        $concepto = $row['id_transaccion'];
        $monto = $row['monto'];
        $exento = 0;
        $iva = $monto * 0.19;
        $total= $monto + $iva;
        $cantidad = 1;
        $tipo = 33;
        $descuento = 0;
        $recargo = 0;
        
        $query = "INSERT INTO factura VALUES ('$factura', '$status', '$observacion', '$fecha', '$fvence', '$empresa', '$periodo', '$tipo', '$descuento', '$recargo')";
        $result = mysql_query($query);

        $query2 = "INSERT INTO factura_concepto VALUES (NULL, '$factura', '$concepto', '$cantidad', '$monto', '$monto', '$exento', '$iva', '0', '0', '0', '0', '$total')";
        $result2 = mysql_query($query2);
        
        $query3 = "INSERT INTO factura_transaccion VALUES (NULL, '$factura', '$transaccion')";
        $result3 = mysql_query($query3);

        $query4 = "UPDATE empresa_transaccion SET id_status = 1 WHERE id = $transaccion";
        $result4 =mysql_query($query4);

        $b2=setDTE($factura);
        $files=fopen("Logs/DTE/$factura.xml","w+");
        fwrite ($files,$b2);
        fclose($files);

        envioDte($factura, $transaccion);
        
        return array($factura, $transaccion);
        //header("location: ../envio.php?id=$fac.xml");

    }

}

function setDTE($fac){

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir,$ate)=filial();
list($st,$obs,$fec,$ven,$emp,$per,$tip,$dg,$rg)=ultimate_factura($fac);
list($rut,$raz,$dir,$com,$ciu,$con,$giro)=ultimate_empresa($emp);
$array=array();
$array = explode(',' , $giro);

foreach($array as $key ){
    $gir= $key;
}
list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);
list($f,$desde,$hasta,$caf,$tf)=folio_activo($tip);
$referencias="SELECT 
r.emisor, r.codigo_ref, r.fecha, r.nemotecnico 
FROM factura_concepto fc 
JOIN factura f on fc.id_factura = f.id AND f.id = $fac 
JOIN referencia r on f.id_periodo = r.id_periodo AND r.id_concepto = (SELECT id_concepto FROM factura_concepto WHERE id_factura = $fac) AND f.id_periodo = '$per' ";
$refe=mysql_query($referencias);
$ref=mysql_fetch_array($refe);  
 
    $obser="";  
    if($obs!="")
    {
        $obser='<Adicional>
                    <NodosA>
                        <A6>'.$obs.'</A6>
                    </NodosA>
                </Adicional>';
    }
    $doc="";
    $ini='<?xml version="1.0" encoding="UTF-8"?>
    <DTE xmlns="http://www.sii.cl/SiiDte" version="1.0">
    <Documento ID="F'.$fac.'T'.$tip.'">';
    $fin='</Documento>
    </DTE>';

    $encabezado='
            <Encabezado>
                <IdDoc>
                    <TipoDTE>'.$tip.'</TipoDTE>
                    <Folio>'.$fac.'</Folio>
                    <FchEmis>'.$fec.'</FchEmis>
                    <FchVenc>'.$ven.'</FchVenc>
                </IdDoc>
                <Emisor>
                    <RUTEmisor>'.$frut.'</RUTEmisor>
                    <RznSoc>'.$fraz.'</RznSoc>
                    <GiroEmis>'.$fgir.'</GiroEmis>
                    <Acteco>'.$ate.'</Acteco>
                    <DirOrigen>'.$fdir.'</DirOrigen>
                    <CmnaOrigen>'.$fcom.'</CmnaOrigen>
                    <CiudadOrigen>'.$fciu.'</CiudadOrigen>
                    <CdgVendedor>No</CdgVendedor>
                </Emisor>
                <Receptor>
                    <RUTRecep>'.$rut.'</RUTRecep>
                    <RznSocRecep>'.$raz.'</RznSocRecep>
                    <GiroRecep>'.$gir.'</GiroRecep>
                    <Contacto>'.$con.'</Contacto>
                    <DirRecep>'.$dir.'</DirRecep>
                    <CmnaRecep>'.$com.'</CmnaRecep>
                    <CiudadRecep>'.$ciu.'</CiudadRecep>
                </Receptor>
                <Totales>
                    <MntNeto>'.round($totext).'</MntNeto>
                    <MntExe>'.round($totex).'</MntExe>
                    <TasaIVA>'.$iva.'</TasaIVA>
                    <IVA>'.round($ivat).'</IVA>
                    <MntTotal>'.round($total).'</MntTotal>
                </Totales>
            </Encabezado>';
    $detalles=conceptosxml($fac);
    $descuentos=descuentos($fac);
    $referencia='
    <Referencia>
        <NroLinRef>1</NroLinRef>
        <TpoDocRef>'.$ref['emisor'].'</TpoDocRef>
        <FolioRef>'.$ref['codigo_ref'].'</FolioRef>
        <FchRef>'.$ref['fecha'].'</FchRef>
        <RazonRef>'.$ref['nemotecnico'].'</RazonRef>
    </Referencia>';
    $doc=$ini.$encabezado.$detalles.$descuentos.$referencia.$obser.$fin;
    return $doc;

}
function descuentos($fac)
{
list($st,$obs,$fec,$ven,$emp,$per,$tip,$dg,$rg)=ultimate_factura($fac);
    $buf="";
    if($dg>0)
    {
    $buf="<DscRcgGlobal>
              <NroLinDR>1</NroLinDR>                   
              <TpoMov>D</TpoMov>
              <GlosaDR>Descuento 1</GlosaDR>
              <TpoValor>%</TpoValor>
              <ValorDR>".$dg."</ValorDR>
          </DscRcgGlobal>";        
    }elseif ($rg>0) {
    $buf="<DscRcgGlobal>        
            <NroLinDR>1</NroLinDR>           
            <TpoMov>R</TpoMov>
            <GlosaDR>Descuento 1</GlosaDR>
            <TpoValor>%</TpoValor>
            <ValorDR>".$rg."</ValorDR>
          </DscRcgGlobal>"; 
    }
    return $buf;
}
function conceptosxml($fac) //esta funcion obtine de la base de datos los datos de los conceptos facturados
{
    list($st,$obs,$fec,$ven,$emp,$per,$tip,$dg,$rg)=ultimate_factura($fac);
    $buffermedio="";
    $i=0;

    $sql3=mysql_query("SELECT * FROM `factura_concepto` WHERE `id_factura` = $fac");
    while($row=mysql_fetch_array($sql3))
    {



        $conc[$i]=$row[2];
        $cant[$i]=$row[3];
        $prec[$i]=$row[4];
        $ext[$i]=$row[5];
        $exe[$i]=$row[6];
        $des[$i]=$row[8]; 
        $desm[$i]=$row[10];
        $tot[$i]=$row[12];
   
        $i++;

        
    }
    $tamano=sizeof($cant);
    
    for($a=0;$a<$tamano;$a++)
    {
        $b=$a+1;
        if($exe[$a]==0)
        {
        $buffer3[$a]='<Detalle>
        <NroLinDet>'.$b.'</NroLinDet>
        <CdgItem>
            <TpoCodigo>INT</TpoCodigo>
            <VlrCodigo>'.$conc[$a].'</VlrCodigo>
        </CdgItem>
        <NmbItem>'.$text=ultimate_conpcepto($conc[$a],$per).'</NmbItem>
        <QtyItem>'.$cant[$a].'</QtyItem>
        <UnmdItem>UN</UnmdItem>
        <PrcItem>'.round($prec[$a]).'</PrcItem>
        <MontoItem>'.round($ext[$a]).'</MontoItem>
    </Detalle>';         

        }else
        {
        $buffer3[$a]='<Detalle>
            <NroLinDet>'.$b.'</NroLinDet>
            <CdgItem>
                <TpoCodigo>INT1</TpoCodigo>
                <VlrCodigo>'.$conc[$a].'</VlrCodigo>
            </CdgItem>
            <NmbItem>'.$text=ultimate_conpcepto($conc[$a]).'</NmbItem>
            <DscItem>N/A</DscItem>
            <QtyItem>'.$cant[$a].'</QtyItem>
            <UnmdItem>UN</UnmdItem>
            <PrcItem>'.round($prec[$a]).'</PrcItem>
            <MontoItem>'.round($ext[$a]).'</MontoItem>
        </Detalle>';
        }
    
        $buffermedio=$buffermedio.$buffer3[$a];

    }

return $buffermedio;

}
function envioDte($id , $transaccion){

include_once ('../../Config.php');
$mysqli = new mysqli(SERVER, DB_USER, DB_PASS, DB);
include_once ("nusoap/src/nusoap.php");
$idr=$id.'.xml';
//$idr=".xml";//SE COMENTA LA LINEA ANTERIOR, SE ACTIVA ESTA Y SE COLOCA EL NOMBRE DEL ARCHIVO QUE SE DESEA ENVIAR MANUALMENTE
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
            $mysqli->query($sql2);
            $mysqli->query($sql4);
            $mysqli->query($sql3);
        break;
        case 56: 
            $sql1="DELETE FROM nota_debito WHERE folio = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            $mysqli->query($sql4);
        break;   
        case 61: 
            $sql1="DELETE FROM nota_credito WHERE folio = $docFolio";
            $sql4="UPDATE empresa_transaccion SET id_status = 0 WHERE id = (SELECT id_transaccion FROM factura_transaccion WHERE id_factura = $docFolio)";
            $mysqli->query($sql4);
            break;   
    endswitch;
 
        $mysqli->query($sql1);
    
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
    foreach( $searchNode as $searchNode ){
    
        $valueID = $searchNode->getAttribute('Url');
        $sql="INSERT INTO factura_docs (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL,'','$valueID','$docFolio')";
        $mysqli->query($sql);
        //header ("location: Logs/RespuestaWs/$docFolio.xml");
        echo $_SESSION['msg']="Operacion Exitosa Folio ".$docFolio." Tipo ".$docTipo;
 	    //header("location: Facturacion/pfactura.php");
    }
}


}
echo '</pre>';
?>

