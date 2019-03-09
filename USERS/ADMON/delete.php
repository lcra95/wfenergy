<?php 
include ("conexion.php");

$id=$_GET["id"];
$ide=$_GET["ide"];
if($id == 'udpe'){
	$sql=mysql_query("UPDATE periodo SET activo = 0");
	$sql1=mysql_query("UPDATE periodo SET activo = 1 WHERE id LIKE '$ide'");
	header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
}
if($id=="dp")
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '$ide'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN PERIODO QUE POSEE TRANSACCIONES REGISTRADAS&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM periodo WHERE id LIKE '$ide'");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");		
	}

}
if($id=="dg")
{
	$sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id_grupo_transaccion = $ide");
	if($row=mysql_fetch_array($sql))
	{
		echo $row[0];
		$sql1=mysql_query("SELECT * FROM `empresa_transaccion` WHERE `id_transaccion` = $row[0]");
		if($dat=mysql_fetch_array($sql1))
		{
			header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN GRUPO QUE POSEE TRANSACCIONES REGISTRADAS&color=rojo");
		}
		else
		{
			mysql_query("DELETE FROM grupo_transaccion WHERE id= $ide");
			header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
			
		}	
	}
	else
	{
			mysql_query("DELETE FROM grupo_transaccion WHERE id= $ide");
			header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	}
}
if($id=="dsf")
{
	$sql=mysql_query("SELECT * FROM seguimiento_factura WHERE id_status_factura = $ide");
	if($row=mysql_fetch_array($sql))
	{
			header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN STATUS QUE POSEE FACTURAS ASIGNADAS&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM status_factura WHERE id = $ide");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	}
}
if($id=="dnu")
{
	$sql=mysql_query("SELECT * FROM usuario WHERE id_nivel_acceso = $ide");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN ROL QUE POSEE USUARIOS ASIGNADOS&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM nivel_acceso WHERE id= $ide");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	
	}
}
if($id=="dsp")
{
	$sql=mysql_query("SELECT * FROM proceso_pago WHERE id_status = $ide");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN STATUS DE PAGO ASIGNADO A PROCESOS&color=rojo");

	}
	else
	{
		mysql_query("DELETE FROM status_pago WHERE id= $ide");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
		
	}
}
if($id=="dcp")
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id_empresa LIKE '$ide'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UNA EMPRESA CON HISTORIAL DE TRANSACCIONES&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM empresa WHERE id LIKE '$ide'");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	}

}
if($id=="dfi")
{
	$sql=mysql_query("SELECT * FROM usuario WHERE rut_filial LIKE '$ide'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR FILIAL CON USUARIOS REGISTRADOS&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM filial WHERE rut LIKE '$ide'");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	}
}
if($id=="dtt")
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id_transaccion = $ide");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN TIPO DE TRANSACCION CON REGISTROS ACTIVOS&color=rojo");
	}
	else
	{
		mysql_query("DELETE FROM tipo_transaccion WHERE id = $ide");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
	}

}
if($id=="du")
{
	mysql_query("UPDATE usuario SET status = '0' WHERE indicador = '$ide' LIMIT 1 ;");
	header("location: tablas.php?msg=SE HA REVOCADO EL ACCESO DEL USUARIO SI DESEA REACTIVARLO CONSULTE CON SOPORTE&color=verde");	

}
if($id=="dfo")
{
	$sql=mysql_query("SELECT * FROM folio WHERE id = $ide");
	$row=mysql_fetch_array($sql);
	echo $row[3];
	if($row[3]==0)
	{	
		
		$sql1=mysql_query("SELECT * FROM factura WHERE id >=$row[1] AND id <= $row[2]");
		$rowa=mysql_num_rows($sql1);
		echo$rowa;
		if($rowa>0)
		{
		
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN FOLIO CON HISTORIAL DE FACTURAS&color=rojo");
		}
		else
		{
			mysql_query("DELETE FROM folio WHERE id=$ide");
			header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");	
			
		}	
	}
	else
	{
		header("location: tablas.php?msg=ES IMPOSIBLE ELIMINAR UN FOLIO ACTIVO&color=rojo");
	}
}
?>

