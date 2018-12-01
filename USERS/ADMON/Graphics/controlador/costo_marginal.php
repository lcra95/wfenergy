<?php 
$host='localhost';
$user='latinsyc_lrequen';
$pass='18594602lcra*';
$daba='latinsyc_giasys';
//Verifico conexón con el servidor
if(!@$db=mysql_connect($host,$user,$pass))
{
	echo "Error de Conexión con el Servidor";
}
else
{	//Establace conexión con la base de datos si existe conexión con el servidor
	mysql_select_db($daba,$db);
	if(mysql_error($db))
	{
	echo "Error de Conexión con la Base de Datos";
	}
}
$periodo='2018-10';

$sql=mysql_query("SELECT * FROM costo_marginal WHERE periodo LIKE '%$periodo%'");
$i=0;
$data=array();
while($row=mysql_fetch_array($sql))
{
	$data[$i]=$row[2];
	 $i++;
}			 
	echo json_encode($data);
?>

