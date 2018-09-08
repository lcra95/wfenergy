<?php 
include("conexion.php");
include("funciones.php");
$empresa=$_GET['empresa'];
$tipo=$_GET['tipo'];
$fac=$_GET['factura'];
$miva=miva();

$tip=$_POST['tip'];
$cantidad=$_POST['cantidad'];
$monto=$_POST['monto'];
$exento=$_POST['exento'];
$descuento=$_POST['descuento'];
$recargo=$_POST['recargo'];

$re=0;
$de=0;
$pre=$recargo;
$pde=$descuento;
if($monto<0)
{
	$monto=$monto*-1;
}
$extendido=$monto*$cantidad;
if($descuento==0)
{

}
else
{
	echo $de=$descuento/100;
	$descuento=$descuento*$de;
	echo $descuento=$extendido*$de;
}
if($recargo==0)
{

}else
{
	echo $re=($recargo/100);
	echo $recargo=$extendido*$re;
	
}
$extendido=$extendido+$recargo-$descuento;
if($exento==1)
{
	$exento=$extendido;
	$iva=0;
}else
{
	$iva=$extendido*$miva;
}
$total=$extendido+$iva;

mysql_query("INSERT INTO `borrador_concepto` (`id`, `id_factura`, `id_concepto`, `canti`, `monto`, `extendido`, `exento`, `iva`, `descuento_por`, `recargo_por`, `descuento_efe`, `recargo_efe`, `total`) VALUES (NULL, '$fac', '$tip', '$cantidad', '$monto', '$extendido', '$exento', '$iva', '$pde', '$pre', '$descuento', '$recargo', '$total');");
header("location: nfactura.php?empresa=$empresa&tipo=$tipo&factura=$fac");
?>
  	




























































