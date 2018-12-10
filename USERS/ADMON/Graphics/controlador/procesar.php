<?php
include_once (dirname(__FILE__).'/../../../../conexion.php');
	
	
	$año=$_POST['ano'];

	$enero = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-01%'"));
	$febrero = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-02%'"));
	$marzo = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-03%'"));
	$abril = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-04%'"));
	$mayo = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-05%'"));
	$junio = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-06%'"));
	$julio = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-07%'"));
	$agosto = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-08%'"));
	$septiembre = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-09%'"));
	$octubre = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-10%'"));
	$noviembre = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-11%'"));
	$diciembre = mysql_fetch_array(mysql_query("SELECT SUM(monto) AS r FROM empresa_transaccion WHERE periodo LIKE '%$año-12%'"));
	
	$data = array(0 => round($enero['r'],1),
				  1 => round($febrero['r'],1),
				  2 => round($marzo['r'],1),
				  3 => round($abril['r'],1),
				  4 => round($mayo['r'],1),
				  5 => round($junio['r'],1),
				  6 => round($julio['r'],1),
				  7 => round($agosto['r'],1),
				  8 => round($septiembre['r'],1),
				  9 => round($octubre['r'],1),
				  10 => round($noviembre['r'],1),
				  11 => round($diciembre['r'],1)
				  );			 
	echo json_encode($data);
?>