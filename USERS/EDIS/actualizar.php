<?php 
include("conexion.php");
include("funciones.php");

$fac=$_GET['factura'];
$periodo=$_GET['periodo'];
$status=$_POST['status'];
$date=date('Y-m-d');

mysql_query("INSERT INTO `cdec_manager`.`seguimiento_factura` (`id`, `id_factura`, `id_status_factura`, `fecha`) VALUES (NULL, '$fac', '$status', '$date');");
mysql_query("UPDATE `cdec_manager`.`factura` SET `id_status` = '$status' WHERE `factura`.`id` =$fac LIMIT 1 ;");
header("location: listafacturas.php?periodo=$periodo");

?>