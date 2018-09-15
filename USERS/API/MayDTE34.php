<?php 
include("funciones.php");
include("conexion.php");
$fac=2;


function setDTE($fac)
{
$tip=34;
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir,$ate)=filial();
list($st,$obs,$fec,$ven,$emp,$per,$tip,$dg,$rg)=ultimate_factura($fac);
list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);
list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);
list($f,$desde,$hasta,$caf,$tf)=folio_activo($tip);

	$doc="";
	$ini='<?xml version="1.0" encoding="UTF-8"?>
	<DTE xmlns="http://www.sii.cl/SiiDte" version="1.0">
	<Documento ID="'.$fac.'T'.$tip.'">';
	$fin='</Documento>
	</DTE>';

	$encabezado='
			<Encabezado>
				<IdDoc>
					<TipoDTE>'.$tip.'</TipoDTE>
					<Folio>'.$fac.'</Folio>
					<FchEmis>'.$fec.'</FchEmis>
					<FchVenc>'.$ven.'</FchVenc>
					<MntPagos>
						<FchPago>'.$ven.'</FchPago>
						<MntPago>'.round($total).'</MntPago>
						<GlosaPagos>30 dias</GlosaPagos>
					</MntPagos>
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
					<MntExe>'.round($totex).'</MntExe>
					<MntTotal>'.round($total).'</MntTotal>
				</Totales>
			</Encabezado>';
	$detalles=conceptosxml($fac);

	/*$referencia='
			<Referencia>
				<NroLinRef>1</NroLinRef>
				<TpoDocRef>801</TpoDocRef>
				<FolioRef>777</FolioRef>
				<FchRef>2012-08-24</FchRef>
				<RazonRef>FACTURA SEGUN OC 777</RazonRef>
			</Referencia>';*/
	$doc=$ini.$encabezado.$detalles.$fin;
	return $doc;

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

        $buffer3[$a]='
        <Detalle>
			<NroLinDet>'.$a+1.'</NroLinDet>
			<NmbItem>'.$text=ultimate_conpcepto($conc[$a]).'</NmbItem>
			<QtyItem>'.$cant[$a].'</QtyItem>
			<UnmdItem>UN</UnmdItem>
			<PrcItem>'.round($prec[$a]).'</PrcItem>
			<MontoItem>'.round($ext[$a]).'</MontoItem>
		</Detalle>';
        $buffermedio=$buffermedio.$buffer3[$a];

    }

return $buffermedio;

}
$b2=setDTE($fac);
$files=fopen("DTE/$fac.xml","w+");
fwrite ($files,$b2);
fclose($files);
?>
<A href="DTE/<?php echo $fac?>.xml">hERE</A>