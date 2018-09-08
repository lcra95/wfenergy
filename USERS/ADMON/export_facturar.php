<?php 
include("conexion.php");
include("funciones.php");
include("Classes/PHPExcel.php");
$obj=new PHPExcel();
$iva=miva();
$periodo=$_GET["periodo"];


	
	$obj->getProperties()->setCreator("Codigos")->setDescription("Facturas $periodo");
	$obj->setActiveSheetIndex(0);
	$obj->getActiveSheet()->setTitle("Facturar $periodo");

	$obj->getActiveSheet()->setCellValue('A1', 'Item');
	$obj->getActiveSheet()->setCellValue('B1', 'ID');
	$obj->getActiveSheet()->setCellValue('C1', 'Empresa');
	$obj->getActiveSheet()->setCellValue('D1', 'Nombre');
	$obj->getActiveSheet()->setCellValue('E1', 'Concepto');
	$obj->getActiveSheet()->setCellValue('F1', 'Monto');
	$obj->getActiveSheet()->setCellValue('G1', 'Iva');
	$obj->getActiveSheet()->setCellValue('H1', 'Total');
	$obj->getActiveSheet()->setCellValue('I1', 'Fecha');
	$obj->getActiveSheet()->setCellValue('J1', 'N° Factura');

$i=1;
$fila=2;
$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '$periodo'");
while($row=mysql_fetch_row($sql))
{

if($row[1]<20 && $row[4]>0)
{
$concep=concepto($row[1]);
$empresa=rut_empresa($row[2]);
$monto=round($row[4]);
$moiva=round($monto*$iva);
$total=round($monto+$moiva);
	 
	$obj->getActiveSheet()->setCellValue('A'.$fila, $i);
	$obj->getActiveSheet()->setCellValue('B'.$fila, $row[0]);
	$obj->getActiveSheet()->setCellValue('C'.$fila, $empresa);
	$obj->getActiveSheet()->setCellValue('D'.$fila, $row[2]);
	$obj->getActiveSheet()->setCellValue('E'.$fila, $concep);
	$obj->getActiveSheet()->setCellValue('F'.$fila, $monto);
	$obj->getActiveSheet()->setCellValue('G'.$fila, $moiva);
	$obj->getActiveSheet()->setCellValue('H'.$fila, $total);
	$obj->getActiveSheet()->setCellValue('I'.$fila, '');
	$obj->getActiveSheet()->setCellValue('J'.$fila, '');

$i++;
$fila++; 
}
elseif($row[1]>=20 && $row[4]<0)
{
$concep=concepto($row[1]);
$empresa=rut_empresa($row[2]);
$monto=round($row[4]*-1);
$moiva=round($monto*$iva);
$total=round($monto+$moiva);

	$obj->getActiveSheet()->setCellValue('A'.$fila, $i);
	$obj->getActiveSheet()->setCellValue('B'.$fila, $row[0]);
	$obj->getActiveSheet()->setCellValue('C'.$fila, $empresa);
	$obj->getActiveSheet()->setCellValue('D'.$fila, $row[2]);
	$obj->getActiveSheet()->setCellValue('E'.$fila, $concep);
	$obj->getActiveSheet()->setCellValue('F'.$fila, $monto);
	$obj->getActiveSheet()->setCellValue('G'.$fila, $moiva);
	$obj->getActiveSheet()->setCellValue('H'.$fila, $total);
	$obj->getActiveSheet()->setCellValue('I'.$fila, '');
	$obj->getActiveSheet()->setCellValue('J'.$fila, '');

$fila++;
$i++;
}
}

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('content-disposition: attachment;filename=Pendiente_por_Facturar.xls');
    header('Cache-Control: max-age=0');

    $Writer= new PHPExcel_Writer_Excel2007($obj);
    $Writer->save('php://output');


?>