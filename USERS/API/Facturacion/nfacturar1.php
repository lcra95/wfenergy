<?php
include ("letras.php");
include ("../funciones.php");

$fac=$_GET['factura'];
$observacion=$_POST['observacion'];
$fecha=$_POST['fecha'];

$fecha = str_replace('/', '-', $fecha);
date('Y-m-d', strtotime($fecha));
if($fecha==""){
    $fecha = date('Y-m-d');
}


$id=$_GET['id'];




$date=date("Y-m-d");
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc)=filial();

$sql=mysql_query("SELECT * FROM borrador WHERE id = $fac");
if($row=mysql_fetch_array($sql))
{
$if=proxima_factura();  
}


mysql_query("UPDATE empresa_transaccion SET id_status = 1 WHERE id  = $id");
mysql_query("INSERT INTO factura_transaccion VALUES ('null','$if','$id')");
mysql_query("INSERT INTO factura VALUES ('$if', '$row[1]', '$observacion', '$date', '$fecha', '$row[5]', '$row[6]', '$row[7]','0','0')");
mysql_query("DELETE FROM borrador WHERE id = $fac");


$sql2=mysql_query("SELECT * FROM empresa WHERE id LIKE '$row[5]'");
$datos=mysql_fetch_array($sql2);




$sql1=mysql_query("SELECT * FROM borrador_concepto WHERE id_factura = $fac");
while($data=mysql_fetch_array($sql1))
{
mysql_query("INSERT INTO factura_concepto VALUES
(null, '$if', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]');
 ");
}
mysql_query("DELETE FROM borrador_concepto WHERE id_factura = $fac");

$fac=$if;


function setDTE($fac)
{
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
// function folio_activo()
// {
// 	$sql=mysql_query("SELECT * FROM folio WHERE status = 1 AND tipo_folio = 33");
// 	$row=mysql_fetch_array($sql);
// 	print_r($row[0],$row[1],$row[2],$row[4],$row[5]);
// 	return array($row[0],$row[1],$row[2],$row[4],$row[5]);

// }
// function proxima_factura()
// {	

// 	list($foli,$desde,$hasta)=folio_activo();
// 	$sql=mysql_query("SELECT * FROM factura WHERE id >=$desde AND id <= $hasta");
// 	$row=mysql_num_rows($sql);
// 	if($row==0)
// 	{
// 		$fac=$desde;
// 	}else
// 	{
// 	$fac=$desde+$row;
// 	}
// 	if($fac>$hasta)
// 	{
// 		return "NULL";
// 	}
// 	else
// 	{
// 		return $fac;
// 	}
// }
$b2=setDTE($fac);
$files=fopen("../Logs/DTE/$fac.xml","w+");
fwrite ($files,$b2);
fclose($files);

header("location: ../envio.php?id=$fac.xml&tran=$id");
?>
