<?PHP 
include("conexion.php");
include("funciones.php");
function numero_documentos($id,$periodo)
{
	$num=0;
	$ivoa=0;
	$ext=0;
	$exe=0;
	$tot=0;
	$sql=mysql_query("SELECT * FROM factura WHERE id_tipo_documento = $id AND id_periodo LIKE '$periodo'");
	while($row=mysql_fetch_array($sql))
	{
		$num++;
		list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($row[0]);
		$ext=$ext+$totext;
		$ivoa=$ivoa+$ivat;
		$exe=$exe+$totex;
		$tot=$tot+$total;
	}
return array($ext,$exe,$ivoa,$tot,$num);

}





?>