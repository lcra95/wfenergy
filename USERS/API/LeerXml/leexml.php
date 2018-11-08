<?php 
//include("FPDF/fpdf.php");
//include("FPDF/conexion.php");
$doc=new DOMDocument();
$doc->load('../Logs/Recepcion/1035_76481364-2_33.xml');

$receptores=$doc->getElementsByTagName('Receptor');
foreach ($receptores as $receptor) 
{
//Acceso al TAG	
	$rut=$receptor->getElementsByTagName('RUTRecep');//<RUTRecep>76254347-8</RUTRecep>
	$razon=$receptor->getElementsByTagName('RznSocRecep');
	$giro=$receptor->getElementsByTagName('GiroRecep');
	$direccion=$receptor->getElementsByTagName('DirRecep');
	$comuna=$receptor->getElementsByTagName('CmnaRecep');
	$ciudad=$receptor->getElementsByTagName('CiudadRecep');
//Valores Contenidos en los TAGS
	$rr=$rut->item(0)->nodeValue;//76254347-8
	$rzr=$razon->item(0)->nodeValue;
	$grr=$giro->item(0)->nodeValue;
	$drr=$direccion->item(0)->nodeValue;
	$cor=$comuna->item(0)->nodeValue;
    $cir=$ciudad->item(0)->nodeValue;
}

$totales=$doc->getElementsByTagName('Totales');
foreach ($totales as $total) 
{
//Acceso al TAG		
	$definitivo=$total->getElementsByTagName('MntTotal');
	$iva=$total->getElementsByTagName('IVA');
	if(!$exento=$total->getElementsByTagName('MntExe'))
	{
		$ex=$exento->item(0)->nodeValue;
	}
	$neto=$total->getElementsByTagName('MntNeto');
//Valores Contenidos en los TAGS
	echo $df=$definitivo->item(0)->nodeValue;
	echo $iv=$iva->item(0)->nodeValue;
	echo $nt=$neto->item(0)->nodeValue;
	$dg=0;
	$rg=0;
}
$i=0;
$detalles=$doc->getElementsByTagName('Detalle');
foreach ($detalles as $detalle ) 
{
	$descripcion[$i]=$detalle->getElementsByTagName('DscItem');	
	$cantidad[$i]=$detalle->getElementsByTagName('QtyItem');
	$precio[$i]=$detalle->getElementsByTagName('PrcItem');
	$unidad[$i]=$detalle->getElementsByTagName('UnmdItem');
	$monto[$i]=$detalle->getElementsByTagName('MontoItem');

	$des=$descripcion[$i]->item(0)->nodeValue;
	$can=$cantidad[$i]->item(0)->nodeValue;
	$pr=$precio[$i]->item(0)->nodeValue;
	$un=$unidad[$i]->item(0)->nodeValue;
	$mon=$monto[$i]->item(0)->nodeValue;
	$i++;
}


/*
class PDF extends FPDF{

	function Header()
	{
		$doc=new DOMDocument();
		$doc->load('../Logs/Recepcion/1035_76481364-2_33.xml');
		$tdte="FACTURA ELECTRONICA";
		$sii="S.I.I - SANTIAGO ORIENTE";
		$encabezados=$doc->getElementsByTagName('IdDoc');
		foreach ($encabezados as $encabezado) 
		{
		//Acceso al TAG
			$folio=$encabezado->getElementsByTagName('Folio');
			$fecha=$encabezado->getElementsByTagName('FchEmis');
		//Valores Contenidos en los TAGS
			$fl=$folio->item(0)->nodeValue;
			$fh=$fecha->item(0)->nodeValue;
		}

		$emisors=$doc->getElementsByTagName('Emisor');
		foreach($emisors as $emisor)
		{
	//Acceso al TAG 
			$rut=$emisor->getElementsByTagName('RUTEmisor');
			$razon=$emisor->getElementsByTagName('RznSoc');
			$giro=$emisor->getElementsByTagName('GiroEmis');
			$direccion=$emisor->getElementsByTagName('DirOrigen');
			$comuna=$emisor->getElementsByTagName('CmnaOrigen');
			$ciudad=$emisor->getElementsByTagName('CiudadOrigen');
		//Valores Contenidos en los TAGS
			$re=$rut->item(0)->nodeValue;
			$rze=$razon->item(0)->nodeValue;
			$gre=$giro->item(0)->nodeValue;
			$dre=$direccion->item(0)->nodeValue;
			$coe=$comuna->item(0)->nodeValue;
			$cie=$ciudad->item(0)->nodeValue;
		}
	
		$this->SetFont('times','', 8);
		$this->Ln(-5);
		$this->Cell(114,5,$this->Image('images/logo.jpg', 20, 5, 80,'','',''),0,0,'C');	
		$this->Ln(15);
		$this->Cell(114,5,utf8_decode($rze),0,0,'C');
		$this->Cell(70,5,utf8_decode($re),1,1,'C');
		$this->Cell(114,5,utf8_decode($gre),0,0,'C');
		$this->Cell(70,5,'',0,1,'C');
		$this->Cell(114,5,utf8_decode('DIRECCION'),0,0,'C');
		$this->Cell(70,5,utf8_decode($tdte),0,1,'C');
		$this->Cell(114,5,utf8_decode($dre),0,0,'C');
		$this->Cell(70,5,'',0,1,'C');
		$this->Cell(114,5,utf8_decode('COMUNA: '.$coe),0,0,'C');
		$this->Cell(70,5,utf8_decode('N°').$fl,1,1,'C');					
		$this->Cell(114,5,utf8_decode('CIUDAD: '.$cie),0,0,'C');
		$this->Cell(70,5,utf8_decode($sii),0,1,'C');		
		$this->Cell(184,5,utf8_decode('CREADA EN: '.$fh),0,1,'R');
		$this->Ln(2);
	}
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','i', 8);
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');

	}
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('times','',10);
$pdf->SetFillColor('232','232','232');
$pdf->Cell(184,0,'',1,1,'R');
$pdf->Cell(124,5,utf8_decode('Señores: '.$rzr),0,0,'L');
$pdf->Cell(70,5,utf8_decode('Contacto: '),0,1,'L');
$pdf->Cell(124,5,utf8_decode('R.U.T: '.$rr),0,0,'L');
$pdf->Cell(70,5,utf8_decode('Vencimiento: '),0,1,'L');
$pdf->Cell(184,5,utf8_decode('Giro: '.$grr),0,1,'L');
$pdf->Cell(184,5,utf8_decode('Dirección: '.$drr),0,1,'L');
$pdf->Cell(64,5,utf8_decode('Comuna: '.$cor),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Ciudad: '.$cir),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Teléfono: '),0,1,'L');
$pdf->Cell(184,0,'',1,1,'R');
$pdf->Cell(184,5,utf8_decode('Referencia: '),0,1,'L');
$pdf->Cell(184,0,'',1,1,'R');

$pdf->Cell(4,5,'#',0,0,'C',1);
$pdf->Cell(100,5,utf8_decode('Descripción'),0,0,'C',1);
$pdf->Cell(20,5,utf8_decode('Cantidad'),0,0,'C',1);
$pdf->Cell(20,5,utf8_decode('Precio Unit.'),0,0,'C',1);
$pdf->Cell(20,5,utf8_decode('Valor Dscto.'),0,0,'C',1);
$pdf->Cell(20,5,utf8_decode('Valor'),0,1,'C',1);



$i=0;
$detalles=$doc->getElementsByTagName('Detalle');
foreach ($detalles as $detalle ) 
{
	$descripcion[$i]=$detalle->getElementsByTagName('DscItem');	
	$cantidad[$i]=$detalle->getElementsByTagName('QtyItem');
	$precio[$i]=$detalle->getElementsByTagName('PrcItem');
	$unidad[$i]=$detalle->getElementsByTagName('UnmdItem');
	$monto[$i]=$detalle->getElementsByTagName('MontoItem');

	$des=$descripcion[$i]->item(0)->nodeValue;
	$can=$cantidad[$i]->item(0)->nodeValue;
	$pr=$precio[$i]->item(0)->nodeValue;
	$un=$unidad[$i]->item(0)->nodeValue;
	$mon=$monto[$i]->item(0)->nodeValue;
	$i++;
	$pdf->Cell(4,5,$i,0,0,'C',0);
	$pdf->Cell(100,5,utf8_decode($des),0,0,'L',0);
	$pdf->Cell(20,5,utf8_decode($can),0,0,'R',0);
	$pdf->Cell(20,5,utf8_decode($pr),0,0,'R',0);
	$pdf->Cell(20,5,utf8_decode(0),0,0,'R',0);
	$pdf->Cell(20,5,utf8_decode($mon),0,1,'R',0);
}
	$pdf->Ln(110);
	$pdf->Cell(184,5,utf8_decode($mon),0,1,'R',0);








$pdf->SetFont('Arial','',10);
$pdf->Output();
$pdf->ob_end_flush();
*/
?>