<?PHP 
include_once ('Config.php');
$host=SERVER;
$user=DB_USER;
$pass=DB_PASS;
$daba=DB;

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
