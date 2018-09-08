<?php 
include("conexion.php");
include("funciones.php");
$cuenta=$_POST['cuenta'];
$detalle=$_POST['detalle'];
$fecha=$_POST['fecha'];
echo $id=cuenta_procesos();

$sel=mysql_query("SELECT * FROM empresa_transaccion WHERE id_transaccion > 2 AND monto > 0");

$i=0;
while($row=mysql_fetch_array($sel))
{

$sel1=mysql_query("SELECT * FROM pago WHERE id_empresa_transaccion = $row[0]");
if($dat=mysql_fetch_array($sel1))
{

}else
{
$iva=$row[4]*0.19;
$monto=$row[4]*1.19;
$i++;
$sql1=mysql_query("INSERT INTO pago VALUES ('NULL', '$fecha', '$row[0]', '$id', '$row[4]', '$iva', '$monto',  '$row[3]', '');");
}
}
if($i>0)
{
$sql=mysql_query("INSERT INTO proceso_pago VALUES ('$id', '$detalle', '1', '$cuenta', '$fecha')");	
header("location: procesodepago.php?msg=EL PROCESO $id HA SIDO CREADA EXITOSAMENTE&color=verde");
}
else
{
	header("location: procesodepago.php?msg=NO EXISTEN PAGOS PENDIENTES POR PROCESAR&color=rojo");
}

?>