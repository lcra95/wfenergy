<?php 
include("conexion.php");

function empresa1($id)
{
$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id = $id");
$row=mysql_fetch_array($sql);
$emp=$row[2];
$sql1=mysql_query("SELECT * FROM empresa WHERE id LIKE '$emp'");
$data=mysql_fetch_array($sql1);
$frut=substr($data[1], -1);
$rut=substr($data[1], 0,-2);
return array($rut,$frut,$data[2],$data[3],$data[4],$row[3],$row[1]);




}





?>