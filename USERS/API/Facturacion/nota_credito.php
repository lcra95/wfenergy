<?php 
include_once ("conexion.php");
$fac=$_GET['id'];
$tipo_d=33;
$fecha=date('Y-m-d');
$tipo_f=61;
$codref=1;
$razon="ANULA DOCUMENTO DE REFERENCIA";
$sql=mysql_query("SELECT * FROM folio where tipo_folio =61");
$row=mysql_fetch_array($sql);
$desde=$row[1];
$sql1=mysql_query("SELECT * FROM nota_credito");
$num=mysql_num_rows($sql1);
$id=$desde+$num;

mysql_query("INSERT INTO nota_credito (`id`, `folio`, `tipo`, `tipo_doc_ref`, `num_doc_ref`, `fecha_ref`, `cod_ref`, `razon_ref`) VALUES 
	(NULL, '$id', '$tipo_f', '$tipo_d', '$fac', '$fecha', '$codref', '$razon');");
//mysql_query("DELETE FROM factura_transaccion WHERE id_factura = $fac");

include_once ("../funciones.php");

$folio=$id;
list($tipo, $fac, $date)=setNotaCredito($folio);

function setNotaCredito($folio)
{
	$sql=mysql_query("SELECT * FROM nota_credito WHERE folio = $folio");
	$row=mysql_fetch_array($sql);

	return array($row[3], $row[4],$row[5]);

}

function setDTE($fac,$folio, $date)
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
//list($f,$desde,$hasta,$caf,$tf)=folio_activo($tip);
	

	$referencia='<Referencia>
			<NroLinRef>1</NroLinRef>
			<TpoDocRef>'.$tip.'</TpoDocRef>
			<FolioRef>'.$fac.'</FolioRef>
			<FchRef>'.$date.'</FchRef>
			<CodRef>1</CodRef>
			<RazonRef>ANULA DOCUMENTO</RazonRef>
		</Referencia>';
	
	$doc="";
	$ini='<?xml version="1.0" encoding="UTF-8"?>
	<DTE xmlns="http://www.sii.cl/SiiDte" version="1.0">
	<Documento ID="F'.$folio.'T61">';
	$fin='</Documento>
	</DTE>';

	$encabezado='
			<Encabezado>
				<IdDoc>
					<TipoDTE>61</TipoDTE>
					<Folio>'.$folio.'</Folio>
					<FchEmis>'.$date.'</FchEmis>
					<FchVenc>'.$date.'</FchVenc>
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
					<TasaIVA>19</TasaIVA>
					<IVA>'.round($ivat).'</IVA>
					<MntTotal>'.round($total).'</MntTotal>
				</Totales>
			</Encabezado>';
	$detalles=conceptosxml($fac);
	$descuentos=descuentos($fac);
	/*$referencia='
			<Referencia>
				<NroLinRef>1</NroLinRef>
				<TpoDocRef>801</TpoDocRef>
				<FolioRef>777</FolioRef>
				<FchRef>2012-08-24</FchRef>
				<RazonRef>FACTURA SEGUN OC 777</RazonRef>
			</Referencia>';*/

	$doc=$ini.$encabezado.$detalles.$descuentos.$referencia.$fin;
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
		<NmbItem>'.$text=ultimate_conpcepto($conc[$a]).'</NmbItem>
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
$b2=setDTE($fac,$folio,$date);
$files=fopen("../Logs/DTE/$folio.xml","w+");
fwrite ($files,$b2);
fclose($files);
header("location: ../envio.php?id=$folio.xml");
?>
