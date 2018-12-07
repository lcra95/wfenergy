<?php 
include("conexion.php");

function empresaNota($folio){
	$sql=mysql_query("SELECT * FROM factura WHERE id = $folio");
	$data=mysql_fetch_array($sql);

	return $data[5];
}
function notaDatos($id){
	$sql=mysql_query("SELECT * FROM nota_credito WHERE folio = $id");
	$datos=mysql_fetch_array($sql);
	return $datos[4];
}
function acumulado($id)
{
$peri=substr($id, 0,-3);
$suma=0;
$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '%$peri%'");
while($row=mysql_fetch_array($sql))
{
		if(($row[1]<20 && $row[4]>0) || ($row[1]>=20 && $row[4]<0))
		{
			$suma=$suma+round($row[4]);
		}
		elseif(($row[1]>=20 && $row[4]>0))
		{
			$suma=$suma-round($row[4]);
		}
} 
return array(number_format($suma),$peri);
}
function ultimate_factura($id)
{
	$sql=mysql_query("SELECT * FROM factura WHERE id = $id");
	$row=mysql_fetch_array($sql);
	return array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
}
function ultimate_empresa($id)
{
	$sql=mysql_query("SELECT * FROM empresa WHERE id LIKE '$id'");
	$row=mysql_fetch_array($sql);
	return array($row[1],$row[2],$row[5],$row[6],$row[7],$row[9],$row[10]);

}
function ultimate_montos($id)
{
	$total=0;
	$ivat=0;
	$totex=0;
	$totext=0;
	$sql=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $id");
	while($row=mysql_fetch_array($sql))
	{
		$ivat=$ivat+$row[7];
		$totex=$totex+$row[6];
		$total=$total+$row[12];
		$totext=$totext+$row[5];
	}
	$iva=miva();
	$iva=$iva*100;
	return array($totext,$totex,$ivat,$total,$iva);
}
function no_fac($periodo)
{
if($periodo!='2018-10'){
	return "FALSE";
}
else{
	return "TRUE";
}

}



function borradores($id)
{
	$sql=mysql_query("SELECT * FROM borrador_concepto WHERE id_factura = $id");
	$row=mysql_num_rows($sql);
	return $row;
}


function compare($nombre,$periodo)
{
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($nombre, $periodo);

// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
// porque la posición de 'a' está en el 1° (primer) caracter.
if ($pos === false) {
    return "NO OK";
} else {
    return "OK";
}
}

function tipo_dte($id)
{
	$sql=mysql_query("SELECT * FROM tipo_documento WHERE id= $id");
	$row=mysql_fetch_array($sql);
	return $row[1];
}



function busca_archivo($id)
{
	$sql=mysql_query("SELECT * FROM archivo WHERE nombre LIKE '$id'");
	if($row=mysql_fetch_array($sql))
	{
		return array('NULL',$row[1],$row[2]);
	}
	else
	{
		return array('OK','NULL','NULL');
	}


}
function miva()
{
	$sql=mysql_query("SELECT * FROM iva");
	$row=mysql_fetch_array($sql);
	return $row[1];
}



function id()
{
	$sql=mysql_query("SELECT *
FROM `empresa_transaccion`");
	$row=mysql_num_rows($sql);
	$id=$row+1;
	return $id;
}
function folio_activo()
{
	$sql=mysql_query("SELECT * FROM folio WHERE status = 1");
	$row=mysql_fetch_array($sql);
	return array($row[0],$row[1],$row[2],$row[4]);
}
function proxima_factura()
{
	list($foli,$desde,$hasta)=folio_activo();
	$sql=mysql_query("SELECT * FROM factura WHERE id >=$desde AND id <= $hasta");
	$row=mysql_num_rows($sql);
	if($row==0)
	{
		$fac=$desde;
	}else
	{
	$fac=$desde+$row+1;
	}
	if($fac>$hasta)
	{
		return "NULL";
	}
	else
	{
		return $fac;
	}
}
function con_trans($id)
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id = $id");
	$row=mysql_fetch_array($sql);
	$t=concepto($row[1]);
	return $t; 
}
function concepto($id)
{
$sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id= $id");
$row=mysql_fetch_array($sql);
if($row[1]=="POTENCIA(-)")
{
	return "POTENCIA";
}else
{
return $row[1];
}
}
function conceptoG($id)
{
$sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id= $id");
$row=mysql_fetch_array($sql);
return $row[2];
}
function grupo($id)
{
@$g=conceptoG($id);
$sql=mysql_query("SELECT * FROM grupo_transaccion WHERE id = $g");
@$row=mysql_fetch_array($sql);
return $row[1];

}
function vacio($id)
{
if($id==0)
{
	return 0.00;
}else
{
	return $id;
}

}
function rut_empresa($id)
{
	$sel=mysql_query("SELECT * FROM empresa WHERE id LIKE '$id'");
	$row=mysql_fetch_array($sel);

	return $row[1];

}
function razon($id)
{
	$sel=mysql_query("SELECT * FROM empresa WHERE id LIKE '$id' OR rut LIKE '$id'");
	$row=mysql_fetch_array($sel);

	return $row[2];

}

function factura($id)
{
	$sel=mysql_query("SELECT * FROM factura_transaccion WHERE id_transaccion = $id");
	if($row=mysql_fetch_array($sel))
	{
		return $row[1];
	}
	else
	{
		return 'N/F';
	}

}
function ffactura($id)
{
	$sel=mysql_query("SELECT * FROM factura_transaccion WHERE id_transaccion = $id");
	if($row=mysql_fetch_array($sel))
	{
		return $row[1];
	}
	else
	{
		return 'N/F';
	}

}
function iva($id)
{
	$sel=mysql_query("SELECT * FROM iva");
	$row=mysql_fetch_array($sel);
	$iva=$id*$row[1];
	return round($iva);
}
function busca_empresa($id)
{
	$sel=mysql_query("SELECT * FROM empresa WHERE id LIKE '$id'");
	if($row=mysql_fetch_array($sel))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function dstatusfac($id)
{
	if($id=="N/F")
	{
		return $id;
	}
	else
	{
	$sql=mysql_query("SELECT * FROM status_factura WHERE id = $id");
	$row=mysql_fetch_array($sql);
	return $row[1];
}
}
function status_fac($id)
{
		if($id=="N/F")
	{
		return $id;
	}
	else
	{
	$sql=mysql_query("SELECT * FROM seguimiento_factura WHERE id_factura = $id");
	$row=mysql_fetch_array($sql);
	$k=dstatusfac($row[2]);
	return $k;
}
}
function color($id)
{
	if($id=='rojo')
	{
		return 'bg-danger';
	}else
	{
		return 'bg-success';
	}
}
function filial()
{
	$sql=mysql_query("SELECT * FROM filial WHERE rut like '76254347-8'");
	$row=mysql_fetch_array($sql);
	return array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6], $row[7],$row[8],$row[9]);
}

function obtenerFechaEnLetra($fecha){

   // $dia= conocerDiaSemanaFecha($fecha);

    $num = date("j", strtotime($fecha));

    $anno = date("Y", strtotime($fecha));

    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

    $mes = $mes[(date('m', strtotime($fecha))*1)-1];

    return $num.' de '.$mes.' del '.$anno;

}

 

function conocerDiaSemanaFecha($fecha) {

    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

    $dia = $dias[date('w', strtotime($fecha))];

    return $dia;

}
function fechafac($id)
{
	$sql=mysql_query("SELECT * FROM factura WHERE id = $id");
	$row=mysql_fetch_array($sql);
	return $row[2];
}
function sumafecha($date)
{
$nuevafecha = strtotime ( '+5 day' , strtotime ( $date ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
return date_format($nuevafecha);
}
function detallefac($id)
{
	$sql=mysql_query("SELECT * FROM factura WHERE id = $id");
	$row=mysql_fetch_array($sql);
	$sql2=mysql_query("SELECT * FROM `empresa_transaccion` WHERE `id` = $row[12]");
	$rowa=mysql_fetch_array($sql2);
	return array($rowa[1],$rowa[4],$row[8],$row[10],$row[14]);

}
function datos_empresa($id)
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id = $id");
	$row=mysql_fetch_array($sql);
	$rut=rut_empresa($row[2]);
	$razon=razon($row[2]);
	return array($rut,$razon);
}

function cambia_color($id)
{
	$row=$id;
	if($row==1)
	{
		return 'bg-default';
	}
	if(($row==2)||($row==3))
	{
		return 'bg-warning';	
	}
	if($row==4)
	{
		return 'bg-success';
	}
	if($row==5)
	{
		return 'bg-danger';
	}
}
function ultimo_status($id)
{
$rs = mysql_query("SELECT MAX(id_status_factura) AS id FROM seguimiento_factura WHERE id_factura = $id");
if ($row = mysql_fetch_row($rs)) {
return $id = trim($row[0]);
}
}

function dfsta($id)
{
	$sql=mysql_query("SELECT * FROM `status_factura` WHERE `id` = $id");
	$row=mysql_fetch_array($sql);
	return $row[1];
}
function color_importe($id)
{
	if($id<=0)
	{
		return 'bg-danger';
	}else
	{
		return 'bg-success';
	}
}
function proceso($id)
{
$sql=mysql_query("SELECT * FROM pago WHERE id_empresa_transaccion = $id");
$row=mysql_fetch_array($sql);
return $row[3];
}
function status_pago($id)
{
	$sel=mysql_query("SELECT * FROM status_pago WHERE id = $id");
	$row=mysql_fetch_array($sel);
	return $row[1];
}
function cuenta_procesos()
{
	$sql=mysql_query("SELECT * FROM proceso_pago");
	$row=mysql_num_rows($sql);
	return $row+1;
}
function empresa($id)
{
	$sel=mysql_query("SELECT * FROM empresa WHERE id LIKE '$id' OR rut LIKE '$id'");
	$row=mysql_fetch_array($sel);

	return array($row[5],$row[6],$row[7],$row[8],$row[9]);

}
function empresa_pago($id)
{
	$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE id=$id");
	$row=mysql_fetch_array($sql);
	$sql1=mysql_query("SELECT * FROM `empresa` WHERE `id` LIKE '$row[2]'");
	$dat=mysql_fetch_array($sql1);
	return array($dat[1],$dat[2]);
}
function  update_factura($id,$pro)
{
	$sql=mysql_query("SELECT * FROM pago WHERE id= $id");
	$row=mysql_fetch_array($sql);
	if($row[8]=="")
	{
		return "<a href='updatepagos.php?id=$id&pro=$pro' class='fa fa-upload' aria-hidden='true'><a>";
	}
	else
	{
		return $row[8];
	}
}
?>
