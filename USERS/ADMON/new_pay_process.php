<?php 
include ("conexion.php");
include ("funciones.php");
$cuenta=$_POST['cuenta'];
$detalle=$_POST['detalle'];
$fecha=$_POST['fecha'];
$id=cuenta_procesos();

$sql=mysql_query("SELECT id FROM factura_recibida");
$i=0;
while($row=mysql_fetch_array($sql)){
	$fac=$row['id'];
	$sql1=mysql_query("SELECT id FROM pago WHERE id_factura_recibida = $fac");
	if(!$data=mysql_fetch_array($sql1)){
		$i++;
		mysql_query("INSERT INTO pago VALUES (NULL,'$fecha','$fac','$id')");
	}
}
if($i>0){

	$sql=mysql_query("INSERT INTO proceso_pago VALUES ('$id', '$detalle', '1', '$cuenta', '$fecha')");	
	header("location: procesodepago.php?msg=EL PROCESO $id HA SIDO CREADA EXITOSAMENTE&color=verde");
}else{

	header("location: procesodepago.php?msg=NO EXISTEN PAGOS PENDIENTES POR PROCESAR&color=rojo");
}

?>