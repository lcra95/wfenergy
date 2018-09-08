<?php 
include("letras.php");
include("conexion.php");
include("funciones.php");
$fac=$_GET['fac'];
$rutdaniel="24675367-9";
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();
list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);
$date= date('Y-m-d');
$time=date('h:i:s');
list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);
list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);
include("prueba.php");
list($f,$desde,$hasta,$caf)=folio_activo();
$buffer1="";
$buffer2="";
$buffer3="";
$buffer4="";
$k=0;
	$sql3=mysql_query("SELECT * FROM `factura_concepto` WHERE `id_factura` = $fac");
	while($row=mysql_fetch_array($sql3))
	{
	$k++;
	}	
$did='F'.$fac.'T'.$tip;	
$buffercentral=conceptosxml($fac);
?>


<?php
$arreglo_caratula=array("RutEmisor"=>$frut,
                      "RutEnvia"=>$rutdaniel,
                      "RutReceptor"=>$rut,
                      "FchResol"=>"2014-08-22",
                      "NroResol"=>"80",
                      "TmstFirmaEnv"=>$date."T".$time);

$buffer='<?xml version="1.0" encoding="ISO-8859-1"?>
			<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd">
<SetDTE ID="SetDoc">
          <Caratula version="1.0">';
  while (list ($etiqueta, $valor) = each ($arreglo_caratula)):
    $buffer1.="<$etiqueta>$valor</$etiqueta>";
  endwhile;
    $buffer2.="  
  <SubTotDTE>
    <TpoDTE>".$tip."</TpoDTE>
    <NroDTE>1</NroDTE>
  </SubTotDTE>";

  $buffer3.="</Caratula>
  <DTE version='1.0'>
  	<Documento ID='$did'>
		<Encabezado>
			<IdDoc>
				<TipoDTE>".$tip."</TipoDTE>
				<Folio>".$fac."</Folio>
				<FchEmis>".$fec."</FchEmis>
				<FchVenc>".$ven."</FchVenc>
			</IdDoc>
			<Emisor>
				<RUTEmisor>".$frut."</RUTEmisor>
				<RznSoc>".$fraz."</RznSoc>
				<GiroEmis>".$fgir."</GiroEmis>
				<Telefono>".$ftel."</Telefono>
				<Acteco>401019</Acteco>
				<DirOrigen>".$fdir."</DirOrigen>
				<CmnaOrigen>".$fcom."</CmnaOrigen>
				<CiudadOrigen>".$fciu."</CiudadOrigen>
			</Emisor>
			<Receptor>
				<RUTRecep>".$rut."</RUTRecep>
				<RznSocRecep>".$raz."</RznSocRecep>
				<GiroRecep>".$gir."</GiroRecep>
				<Contacto>".$con."</Contacto>
				<DirRecep>".$dir."</DirRecep>
				<CmnaRecep>".$com."</CmnaRecep>
				<CiudadRecep>".$ciu."</CiudadRecep>
			</Receptor>
			<Totales>
				<MntNeto>".round($totext)."</MntNeto>
				<MntExe>".round($totex)."</MntExe>
				<TasaIVA>".$iva."</TasaIVA>
				<IVA>".round($ivat)."</IVA>
				<MntTotal>".round($total)."</MntTotal>
			</Totales>
		</Encabezado>
		";

  $buffer4="<TED version='1.0'>
		<DD>
			<RE>".$frut."</RE>
			<TD>33</TD>
			<F>".$fac."</F>
			<FE>".$fec."</FE>
			<RR>".$rut."</RR>
			<RSR>".$raz."</RSR>
			<MNT>".round($total)."</MNT>
			<IT1>". solicitap($fac)."</IT1>
			".$caf."";
$buffertotal=$buffer.$buffer1.$buffer2.$buffer3.$buffercentral.$buffer4;
  $file=fopen("facturas/$fac.xml","w+");
  fwrite ($file,$buffertotal);
  fclose($file);
 
?> 