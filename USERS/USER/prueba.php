<?php 
include("conexion.php");

function ultimate_conpcepto($id)
{
	$sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id= $id");
	$row=mysql_fetch_array($sql);
	return $row[1];
}
function solicitap($fac)
{
$i=0;
$sql=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $fac");
while($row=mysql_fetch_array($sql))
{
	return $con = ultimate_conpcepto($row[2]);
	break;
}
	

}
function conceptosxml($fac)
{
$buffermedio="";
$i=0;
$cont=1;

	$sql3=mysql_query("SELECT * FROM `factura_concepto` WHERE `id_factura` = $fac");
	while($row=mysql_fetch_array($sql3))
	{
		$con[$i]=$row[2];
		$cant[$i]=$row[3];
		$prec[$i]=$row[4];
		$ext[$i]=$row[5];
		$exe[$i]=$row[6];
		$iva[$i]=$row[7];
		$tot[$i]=$row[12];
		$i++;
	}
	$tamano=sizeof($cant);
	for($a=0;$a<$tamano;$a++)
	{
		$buffer3[$a]='
		<Detalle>
			<NroLinDet>'.$cont.'</NroLinDet>
			<CdgItem>
				<TpoCodigo>CFN</TpoCodigo>
				<VlrCodigo>'.$con[$a].'</VlrCodigo>
			</CdgItem>
			<NmbItem>'.ultimate_conpcepto($con[$a]).'</NmbItem>
			<QtyItem>'.$cant[$a].'</QtyItem>
			<UnmdItem>UN</UnmdItem>
			<PrcItem>'.round($prec[$a]).'</PrcItem>
			<MontoItem>'.round($ext[$a]).'</MontoItem>
		</Detalle>
		';
		$cont++;
			$buffermedio=$buffermedio.$buffer3[$a];
	}
return $buffermedio;
}
$buffertotal=conceptosxml($fac);
  $file=fopen("facturas/archivo.xml","w+");
  fwrite ($file,$buffertotal);
  fclose($file);



