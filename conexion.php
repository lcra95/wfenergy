<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
</head>
<?PHP 
$host='localhost';
$user='wfenergy_ejpo';
$pass='Elianny2018.*';
$daba='wfenergy_wf_tiltiluno';

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

?>
