<?PHP 
<<<<<<< HEAD
$host='localhost';
$user='wfenergy_ejpo';
$pass='Elianny2018.*';
$daba='wfenergy_wf_tiltiluno';
=======
include_once ('../../Config.php');
$host=SERVER;
$user=DB_USER;
$pass=DB_PASS;
$daba=DB;
>>>>>>> 8d7bce0b01dcf2c991fca151eb9ef806aa58a619
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

?>