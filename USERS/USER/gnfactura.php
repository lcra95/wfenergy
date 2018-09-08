<?php 
include("conexion.php");
include("funciones.php");

$tipo=$_POST["tipo"];
$empresa=$_GET["empresa"];
$SQL=mysql_query("SELECT * FROM borrador");
echo $fac=mysql_num_rows($SQL);
$fac=$fac+1;
echo $fac;
$fecha=date('Y-m-d');
$vence=date("Y-m-d");
$periodo=$_POST["periodo"];
$status="1";
if($tipo==0)
{
	header("LOCATION: nfactura.php?msg=DEBE SELECCIONAR UN TIPO DE DTE VALIDO&color=rojo");
}
elseif($empresa=="")
{
	header("LOCATION: nfactura.php?msg=DEBE SELECCIONAR UN CLIENTE&color=rojo");

}
else
{
mysql_query("INSERT INTO borrador VALUES ('$fac', '1', '', '$fecha', '$vence', '$empresa', '$periodo', '$tipo');");
header("location: nfactura.php?empresa=$empresa&tipo=$tipo&factura=$fac");
}
?>