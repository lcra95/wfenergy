<?php 
$host='localhost';
$user='latinsyc_lrequen';
$pass='18594602lcra*';
$daba='latinsyc_giasys';
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
$periodo='2017';
$max=0;
$min=0;
$suma=0;
$prom=0;
$i=0;

$maxf=0;
$minf=0;
$sumaf=0;
$promf=0;
$if=0;

$maxm=0;
$minm=0;
$sumam=0;
$promm=0;
$im=0;

$maxa=0;
$mina=0;
$sumaa=0;
$proma=0;
$ia=0;

$maxy=0;
$miny=0;
$sumay=0;
$promy=0;
$iy=0;

$maxj=0;
$minj=0;
$sumaj=0;
$promj=0;
$ij=0;

$maxl=0;
$minl=0;
$sumal=0;
$proml=0;
$il=0;

$maxg=0;
$ming=0;
$sumag=0;
$promg=0;
$ig=0;

$maxs=0;
$mins=0;
$sumas=0;
$proms=0;
$is=0;

$maxo=0;
$mino=0;
$sumao=0;
$promo=0;
$io=0;

$maxn=0;
$minn=0;
$suman=0;
$promn=0;
$in=0;

$maxd=0;
$mind=0;
$sumad=0;
$promd=0;
$id=0;





$sql=mysql_query("SELECT * FROM costo_marginal WHERE periodo LIKE '%$periodo%'");
while($row=mysql_fetch_array($sql))
{
	//ENERO
	if($row[1]=="2017-01")
	{
		if($i==0)
		{
			$max=$row[2];
			$min=$row[2];

		}
		else
		{
			if($row[2]>=$max)
			{
				$max=$row[2];

			}
			elseif($row[2]<=$min)
			{
				$min=$row[2];
			}
		}
		$i++;
		$suma=$suma+$row[2];
	}
	//FEBRERO
	if($row[1]=="2017-02")
	{
		if($if==0)
		{
			$maxf=$row[2];
			$minf=$row[2];

		}
		else
		{
			if($row[2]>=$maxf)
			{
				$maxf=$row[2];

			}
			elseif($row[2]<=$minf)
			{
				$minf=$row[2];
			}
		}
		$if++;
		$sumaf=$sumaf+$row[2];
	}
	//MARZO
	if($row[1]=="2017-03")
	{
		if($im==0)
		{
			$maxm=$row[2];
			$minm=$row[2];

		}
		else
		{
			if($row[2]>=$maxm)
			{
				$maxm=$row[2];

			}
			elseif($row[2]<=$minm)
			{
				$minm=$row[2];
			}
		}
		$im++;
		$sumam=$sumam+$row[2];
	}
	//ABRIL
	if($row[1]=="2017-04")
	{
		if($ia==0)
		{
			$maxa=$row[2];
			$mina=$row[2];

		}
		else
		{
			if($row[2]>=$maxa)
			{
				$maxa=$row[2];

			}
			elseif($row[2]<=$mina)
			{
				$mina=$row[2];
			}
		}
		$ia++;
		$sumaa=$sumaa+$row[2];
	}	
	//MAYO
	if($row[1]=="2017-05")
	{
		if($im==0)
		{
			$maxy=$row[2];
			$miny=$row[2];

		}
		else
		{
			if($row[2]>=$maxy)
			{
				$maxy=$row[2];

			}
			elseif($row[2]<=$miny)
			{
				$miny=$row[2];
			}
		}
		$iy++;
		$sumay=$sumay+$row[2];
	}
	//JUNIO
	if($row[1]=="2017-06")
	{
		if($ij==0)
		{
			$maxj=$row[2];
			$minj=$row[2];

		}
		else
		{
			if($row[2]>=$maxj)
			{
				$maxj=$row[2];

			}
			elseif($row[2]<=$minj)
			{
				$minj=$row[2];
			}
		}
		$ij++;
		$sumaj=$sumaj+$row[2];
	}
	//JULIO
	if($row[1]=="2017-07")
	{
		if($il==0)
		{
			$maxl=$row[2];
			$minl=$row[2];

		}
		else
		{
			if($row[2]>=$maxl)
			{
				$maxl=$row[2];

			}
			elseif($row[2]<=$minl)
			{
				$minl=$row[2];
			}
		}
		$il++;
		$sumal=$sumal+$row[2];
	}
	//AGOSTO
	if($row[1]=="2017-08")
	{
		if($ig==0)
		{
			$maxg=$row[2];
			$ming=$row[2];

		}
		else
		{
			if($row[2]>=$maxg)
			{
				$maxg=$row[2];

			}
			elseif($row[2]<=$ming)
			{
				$ming=$row[2];
			}
		}
		$ig++;
		$sumag=$sumag+$row[2];
	}















}

$prom=$suma/$i;
$promf=$sumaf/$if;
$promm=$sumam/$im;
$proma=$sumaa/$ia;
$promy=$sumay/$iy;
$promj=$sumaj/$ij;
$proml=$sumal/$il;
$promg=$sumag/$ig;
$data = array(0 => $min,
				  1 => $minf,
				  2 => $minm,
				  3 => $mina,
				  4 => $miny,
				  5 => $minj,
				  6 => $max,
				  7 => $maxf,
				  8 => $maxm,
				  9 => $maxa,
				  10 =>$maxy,
				  11 =>$maxj,
				  12 =>$prom,
				  13 =>$promf,
				  14 =>$promm,
				  15 =>$proma,
				  16 =>$promy,
				  17 =>$promj,
				  18 =>$minl,
				  19 =>$proml,
				  20 =>$maxl,
				  21 =>$ming,
				  22 =>$promg,
				  23 =>$maxg
				  );			 
	echo json_encode($data);
?>

