<?php 
include("fpdf/fpdf.php");
include("conexion.php");
class PDF extends FPDF{

	function Header()
	{
		$this->Image('images/logo.jpg', 5, 5, 60,'','','www.lrsystems.cl');
		$this->SetFont('Arial','B', 15);
		$this->Ln(5);
		$this->Cell(0,10,'Ejemplo de Reporte',0,0,'C');

		$this->Ln(15);
	}
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','i', 8);
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');

	}
}



?>