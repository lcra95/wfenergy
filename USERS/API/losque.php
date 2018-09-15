<?php 
include("conexion.php");

$sql=mysql_query("SELECT * FROM empresa_transaccion");
$i=0;
while($row=mysql_fetch_array($sql))
{
	
	$sql1=mysql_query("SELECT * FROM empresa WHERE id LIKE '$row[2]'");
	if(!$datos=mysql_fetch_array($sql1))
	{
		
		$a[$i]=$row[2];
		echo $a[$i].'<br>';
		$i++;
	}


}


?>
