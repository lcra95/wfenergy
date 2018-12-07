<?php
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
$año=2017;

$enero=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-01'");
$e=mysql_fetch_array($enero);
$e[2];
$e[3];

$feb=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-02'");
$f=mysql_fetch_array($feb);
$f[2];
$f[3];

$mar=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-03'");
$m=mysql_fetch_array($mar);
$m[2];
$m[3];

$abr=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-04'");
$a=mysql_fetch_array($abr);
$a[2];
$a[3];

$may=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-05'");
$ma=mysql_fetch_array($may);
$ma[2];
$ma[3];

$jun=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-06'");
$j=mysql_fetch_array($jun);
$j[2];
$j[3];

$jul=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-07'");
$jl=mysql_fetch_array($jul);
$jl[2];
$jl[3];

$ago=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-08'");
$ag=mysql_fetch_array($ago);
$ag[2];
$ag[3];

$sep=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-09'");
$s=mysql_fetch_array($sep);
$s[2];
$s[3];

$oct=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-10'");
$o=mysql_fetch_array($oct);
$o[2];
$o[3];

$nov=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-11'");
$n=mysql_fetch_array($nov);
$n[2];
$n[3];

$dic=mysql_query("SELECT * FROM energia_ano WHERE periodo LIKE '$año-12'");
$d=mysql_fetch_array($dic);
$d[2];
$d[3];
	$data = array(0 => round($e[2]),1,
	 			  1 => round($e[3]),1,
	 			  2 => round($f[2]),1,
	 			  3 => round($f[3]),1,
	 			  4 => round($m[2]),1,
	 			  5 => round($m[3]),1,
	 			  6 => round($a[2]),1,
	 			  7 => round($a[3]),1,
	 			  8 => round($ma[2]),1,
	 			  9 => round($ma[3]),1,
	 			  10 => round($j[2]),1,
	 			  11 => round($j[3]),1,
	 			  12 => round($jl[2]),1,
	 			  13 => round($jl[3]),1,
	 			  14 => round($ag[2]),1,
	 			  15 => round($ag[3]),1,
	 			  16 => round($s[2]),1,
	 			  17 => round($s[3]),1,
	 			  18 => round($o[2]),1,
	 			  19 => round($o[3]),1,
	 			  20 => round($n[2]),1,
	 			  21 => round($n[3]),1,	 			  	 			  	 			  
	 			  22 => round($d[2]),1,
	 			  23 => round($d[3]),1








	 			  );			 
	echo json_encode($data);

?>