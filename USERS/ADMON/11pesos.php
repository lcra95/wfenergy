<?php

include("conexion.php");
function verificar()
{
$ing=0;
$egr=0;
$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '2017-03'");
while($row=mysql_fetch_array($sql))
{
	if(($row[1]<=2 && $row[4]>0) || ($row[1]>2 && $row[4]<0))
	{
		$mon=round($row[4]);
		if($row[1]>2)
		{
			$row[4]=$row[4]*-1;
			$mon=round($row[4]);	
		}
		$ing=$ing+$mon;
	}
	elseif(($row[1]>2 && $row[4]>0))
	{
		//echo $row[4].' = ';
		$mont=round($row[4]);
		if($row[4]<0)
		{
			echo "Estoy Aqui";
			$row[4]=$row[4];
			$mont=round($row[4]);
		}
		//echo $mont.'<br>';
		$egr=$egr+$mont;
	}


}
//echo $ing.' '.$egr.'TOTAL = '.$ing-$egr;
}
function calculo($periodo,$tipo)
{	$ing=0;
	$egr=0;
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '$periodo' AND id_transaccion = $tipo");
	while($row=mysql_fetch_array($sql))
	{
	if(($row[1]<20 && $row[4]>0) || ($row[1]>=20 && $row[4]<0))
	{
		$mon=$row[4];
		if($row[1]>=20)
		{
			$row[4]=$row[4]*-1;
			$mon=$row[4];	
		}
		$ing=$ing+$mon;
	}
	elseif(($row[1]>=20 && $row[4]>0))
	{
		$row[4].' = ';
		$mont=$row[4];
		if($row[4]<0)
		{
			 
			$row[4]=$row[4];
			$mont=$row[4];
		}
		 $mont;
		$egr=$egr+$mont;
	}
	}

	return array($ing,$egr,$total=$ing-$egr);


}

function calculo2($periodo)
{	$ing=0;
	$egr=0;
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '$periodo'");
	while($row=mysql_fetch_array($sql))
	{
	if(($row[1]<20 && $row[4]>0) || ($row[1]>=20 && $row[4]<0))
	{
		$mon=$row[4];
		if($row[1]>=20)
		{
			$row[4]=$row[4]*-1;
			$mon=$row[4];	
		}
		$ing=$ing+$mon;
	}
	elseif(($row[1]>=20 && $row[4]>0))
	{
		$row[4].' = ';
		$mont=$row[4];
		if($row[4]<0)
		{
			 
			$row[4]=$row[4];
			$mont=$row[4];
		}
		 $mont;
		$egr=$egr+$mont;
	}
	}

	return array($ing,$egr,$total=$ing-$egr);
}
?>