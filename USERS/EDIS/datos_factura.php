<?php 
include("conexion.php");
include("funciones.php");
$id=$_GET['id'];
$em=$_GET['empresa'];
$mo=round($_POST['monto']);
$exento=$_POST["exento"];
$descto=$_POST["descto"];
$recargo=$_POST["recargo"];
$periodo=$_GET['periodo'];
$observacion=$_POST["observacion"];
$vence=$_POST["vence"];
$recarg=0;
$desct=0;
$dte=33;
echo $iva=iva($mo).'<br>';
if($exento=="SI")
{
	$iva=0;
}
echo $idf=proxima_factura();

echo $mo.'<br>';

echo $total= $mo+$iva.'<br>';
$date=date('Y-m-d');

$proveedor=busca_empresa($em);
$mo=round($mo);
$iva=round($iva);
$total=$mo+$iva;
if($descto==0)
{

}else
{
	echo ($desct=$descto/100).'<br>';
	$descto=$descto*$desct.'<br>';
	echo $descto=$total*$desct.'<br>';
	
}
if($recargo==0)
{

}else
{
	echo $recarg=($recargo/100).'<br>';
	echo $recargo=$total*$recarg.'<br>';
	

}
if($mo<0)
{
	$mo=round($mo*-1);
}
echo $total=$total-$descto+$recargo.'<br>';





if($idf=="NULL")
{
	header("location: pfactura.php?msg=NO SE PUEDE FACTURAR, HA SUPERADO EL NUMERO MAXIMO DE FOLIOS ASIGNADOS&color=rojo");
}
elseif($proveedor==true)
{
$sql2=mysql_query("INSERT INTO `cdec_manager`.`seguimiento_factura` (`id`, `id_factura`, `id_status_factura`, `fecha`) VALUES (NULL, '$idf', '1', '$date');");
$sql=mysql_query("INSERT INTO `cdec_manager`.`factura` VALUES  ('$idf', '$observacion', '$date', '$vence', '$mo', '$iva', '$exento', '$total', '$recargo', '$recarg', '$desct', '$descto', '$id','$periodo','$dte');");
	header("location: pfactura.php?msg=FACTURA $idf HA SIDO CREADA EXITOSAMENTE&color=verde");
}
else
{
	header("location: pfactura.php?msg=NO SE PUEDE FACTURAR, EL PROVEEDOR NO ESTA REGISTRADO&color=rojo");
}

?>
