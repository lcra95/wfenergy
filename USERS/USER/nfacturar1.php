<?php
include("letras.php");

include("funciones.php"); 
$fac=$_GET['factura'];
$observacion=$_POST['observacion'];
$fecha=$_POST['fecha'];

echo $fecha = str_replace('/', '-', $fecha);
echo date('Y-m-d', strtotime($fecha));

$id=$_GET['id'];
mysql_query("INSERT INTO factura_transaccion VALUES ('null','$fac','$id')");



$date=date("Y-m-d");
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc)=filial();

$sql=mysql_query("SELECT * FROM borrador WHERE id = $fac");
if($row=mysql_fetch_array($sql))
{
$if=proxima_factura();  
}




mysql_query("INSERT INTO factura VALUES ('$if', '$row[1]', '$observacion', '$date', '$fecha', '$row[5]', '$row[6]', '$row[7]')");
mysql_query("DELETE FROM borrador WHERE id = $fac");
$sql6=mysql_query("INSERT INTO `cdec_manager`.`seguimiento_factura` (`id`, `id_factura`, `id_status_factura`, `fecha`) VALUES (NULL, '$if', '1', '$date');");


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
header("location: pfac.php?factura=$if&empresa=$row[5]?fecha=$fecha");
?>
