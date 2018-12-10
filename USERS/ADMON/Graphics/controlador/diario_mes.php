<?php 
<<<<<<< HEAD
$host='localhost';
$user='wfenergy_ejpo';
$pass='Elianny2018.*';
$daba='wfenergy_wf_tiltiluno';
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
=======
include (dirname(__FILE__).'/../../../../conexion.php');
>>>>>>> 8d7bce0b01dcf2c991fca151eb9ef806aa58a619

$periodo=$_POST['periodo'];
$data=array();
$i=0;
$sql=mysql_query("SELECT * FROM `energia_periodo` WHERE `periodo` LIKE '$periodo'");
while($row=mysql_fetch_array($sql))
{
	
	$data[$i]=$row[3];
	$i++;
	$data[$i]=$row[4];
	$i++;
}
echo json_encode($data);

?>