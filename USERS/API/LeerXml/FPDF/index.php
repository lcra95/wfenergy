<?php
include "plantilla.php";
$sql=mysql_query("SELECT * FROM empresa_transaccion");

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor('232','232','232');
$pdf->Cell(10,6,'ID',1,0,'C',1);
$pdf->Cell(90,6,'Empresa',1,0,'C',1);
$pdf->Cell(20,6,'Periodo',1,0,'C',1);
$pdf->Cell(30,6,'Monto',1,1,'C',1);
$pdf->SetFont('Arial','',10);

while($row=mysql_fetch_array($sql))
{
$pdf->Cell(10,6,$row[0],1,0,'C',0);
$pdf->Cell(90,6,$row[2],1,0,'',0);
$pdf->Cell(20,6,$row[3],1,0,'C',0);
$pdf->Cell(30,6,$row[4],1,1,'R',0);
}



$pdf->Output();
$pdf->ob_end_flush();
?>