<?php 
include ("conexion.php");
@session_start();
$us=$_GET['us'];
$pas=$_GET['pas'];

$con=mysql_query("SELECT * FROM `usuario` WHERE `indicador` LIKE '$us' AND `password` LIKE '$pas'");
if($row=mysql_fetch_row($con))
{
	
			$_SESSION['id']=$row[0];
			$_SESSION['name']=$row[2].' '.$row[3];
			$_SESSION['rol']=$row[5];
			header("location: USERS/ADMON/inicio.php");
	
}else
{
	
header('location: index.php?msg=Usuario o Contraseña Invalido');
}
?>