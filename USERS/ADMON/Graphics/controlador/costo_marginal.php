<?php 
include (dirname(__FILE__).'/../../../../conexion.php');
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

