<?php 
include (dirname(__FILE__).'/../../../../conexion.php');

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