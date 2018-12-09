<?PHP 
include("conexion.php");
@$codigo=$_POST["codigo"];
@$nombre=$_POST["nombre"];
@$status=$_POST["status"];
@$id=$_GET["id"];
@$apellido=$_POST["apellido"];
@$email=$_POST["email"];
@$filial=$_POST["filial"];
@$nivel=$_POST["nivel"];
@$grupo=$_POST["grupo"];
@$desde=$_POST["desde"];
@$hasta=$_POST["hasta"];
@$razon=$_POST["razon"];
@$direccion=$_POST["direccion"];
@$comuna=$_POST["comuna"];
@$ciudad=$_POST["ciudad"];
@$contacto=$_POST["contacto"];
@$email=$_POST["email"];
@$sucursal=$_POST["sucursal"];
@$ide=$_POST["ide"];
@$cuenta=$_POST["cuenta"];
@$codigoc=$_POST["codigoc"];
@$giro=$_POST['giro'];
@$ateco=$_POST['ateco'];
if($id=="rp")
{		
	
		$sql=mysql_query("SELECT * FROM `periodo` WHERE `id` LIKE '$codigo'");
		if($row=mysql_fetch_array($sql))
		{
		 $i++;
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
		}
		else
		{

		if($status==1){
			mysql_query("UPDATE periodo SET activo = 0 where activo = 1");

		}
			mysql_query("INSERT INTO periodo VALUES ('$codigo', '$nombre',$status)");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");		
		}
}
if($id=="rg")
{
		$sql=mysql_query("SELECT * FROM grupo_transaccion WHERE descripcion LIKE '$nombre'");
		if($row=mysql_fetch_array($sql))
		{
			header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
		}
		else
		{
			mysql_query("INSERT INTO grupo_transaccion VALUES ('$codigo','$nombre')");
			header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
		}
}	
if($id=="ru")
{
	$idu=$nombre.'.'.$apellido;
	$sql=mysql_query("SELECT * FROM usuario WHERE indicador LIKE '$idu'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}
	else
	{
		mysql_query("INSERT INTO usuario VALUES('$idu','$idu' , '$nombre', '$apellido', '$email', '$nivel', '$filial', '1')");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
	}
}
if($id=="rsf")
{
	$sql=mysql_query("SELECT * FROM `status_factura` WHERE `descripcion` LIKE '$nombre'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}
	else
	{
		mysql_query("INSERT INTO status_factura VALUES('$codigo', '$nombre')");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
	}
}
if($id=="rtt")
{
	$sel=mysql_query("SELECT * FROM tipo_transaccion WHERE descripcion LIKE '$nombre'");
	if($row=mysql_fetch_array($sel))
	{

		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");

	}
	else 
	{
		mysql_query("INSERT INTO tipo_transaccion VALUES('$codigo', '$nombre', '$grupo')");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
	}
}
if($id=="rsp")
{


	$sql=mysql_query("SELECT * FROM status_pago WHERE descripcion LIKE  '$nombre'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}
	else
	{
		mysql_query("INSERT INTO status_pago VALUES ('$codigo', '$nombre')");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");

	}
}
if($id=="rna")
{


	$sql=mysql_query("SELECT * FROM nivel_acceso WHERE descripcion LIKE  '$nombre'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}
	else
	{
		mysql_query("INSERT INTO nivel_acceso VALUES ('$codigo', '$nombre')");
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
	}
}
if($id=="rf")
{

	if($status==1)
	{
		mysql_query("UPDATE folio SET `status` = '0' WHERE status=1 LIMIT 1 ;");
	}

	$sql=mysql_query("INSERT INTO folio VALUES ('$codigo', '$desde', '$hasta', '$status')");
	header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
}
if($id=="rfil")
{
	$sql=mysql_query("SELECT * FROM filial WHERE rut LIKE '$codigo'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}
	else
	{
	mysql_query("INSERT INTO filial 
		VALUES ('$codigo', '$razon', '$direccion', '$comuna', '$ciudad', '$email', '$contacto', '$sucursal', '$giro', '$ateco')");
	header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
}
}
if($id=="recp")
{

	$sql=mysql_query("SELECT * FROM empresa WHERE id LIKE '$ide'");
	if($row=mysql_fetch_array($sql))
	{
		header("location: tablas.php?msg=REGISTRO DUPLICADO&color=rojo");
	}	
	else
	{
		mysql_query("INSERT INTO empresa (`id`, `rut`, `razon social`, `cuenta_bancaria`, `codigo_banco`, `direccion`, `comuna`, `ciudad`, `telefono`, `contacto`, `giro` )
		VALUES ('$ide', '$codigo', '$razon', '$cuenta', '$codigoc', '$direccion', '$comuna', '$ciudad', '$contacto', '$email', '$giro');");
		
		header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
	}

}
if($id=="riv")
{
	mysql_query("UPDATE `iva` SET `valor` = '$nombre' WHERE `iva`.`id` =1 LIMIT 1 ;");
	header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
}
?>