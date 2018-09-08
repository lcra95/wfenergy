<?php 
include("conexion.php");
include("funciones.php");
include("letras.php");
$if=$_GET['factura'];
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc)=filial();

$sql7=mysql_query("SELECT * FROM factura WHERE id = $if");
$k=mysql_fetch_array($sql7);
$emp=$k[5];
$fecha=$k[4];
$date=$k[3];
$observacion=$k[2];
$tipo=$k[7];
$tip=tipo_dte($tipo);
$sql2=mysql_query("SELECT * FROM empresa WHERE id LIKE '$emp'");
$datos=mysql_fetch_array($sql2);
?>

<table width="950" align="center">
	<tr>
		<td width="640" align="center">
			<img src="images/logo.jpg"  class="img-responsive"><br>
			<font size="+1"><strong><?php echo $fraz;?></strong></font>
			<br>GENERACION EN OTRAS CENTRALES<BR>
			Dirección:<br>
			<?php echo $fdir.' - '.$fcom.' - '.$fciu; ?><br>
			FONO: <?PHP echo $ftel;?><br>
			E-mail: <?php echo $fema;?><br>
			Sucursal: <?php echo $fsuc;?>
		</td>
		<td valign="top" align="CENTER"><BR>
			<!--TABLA SELLO FACTURA-->
			<table width="300" align="center" border="2" bordercolor="red" cellspacing="0" cellpadding="0">
				<tr>
					<td align="Center">
						<font size="+1" color="red"><strong>RUT.:<?php echo $frut;?><br><br><br><?php echo $tip;?><br><BR>N° <?PHP echo $if?><br><br></strong></font>
					</td>
				</tr>
			</table>	
			<!--/FIN TABLA SELLO FACTURA-->
			<font size="+1" color="red"><strong>S.I.I. - SANTIAGO ORIENTE</strong></font>
		</td>
	</tr>
	<tr>
		<td align="Right" colspan="2">
			<b><?php echo $fciu.', '; echo obtenerFechaEnLetra($date);?></b>
		</td>	
	</tr>
</table>

<table align="center" width="950" border="1" cellspacing="0">
	<tr>
		<td>
			<table align="center" width="950">
				<tr>
					<td width="100"><b>Señor(es)</b></tD>
					<td width="500"><b>:</b> <?php echo $datos[2]; ?></td>
					<td width="100"><b>Contacto</b></td>
					<td><b>:</b> <?php echo $datos[9];?></td>
				</tr>
				<tr>
					<td width="100"><b>Rut</b></tD>
					<td><b>:</b> <?php echo $datos[1];?></td>
					<td width="100"><b>Teléfono</b></td>
					<td><b>:</b> <?php echo $datos[8]?></td>
				</tr>
				<tr>
					<td width="100"><b>Giro</b></tD>
					<td><b>:</b>  <?php echo $datos[10];?></td>
					<td width="100"><b>Vencimiento</b></td>
					<td><b>:</b> <?PHP echo obtenerFechaEnLetra($fecha);?></td>
				</tr>
				<tr>
					<td width="100"><b>Dirección </b></tD>
					<td><b>: </b> <?php echo$datos[5];?>
					</td><td width="100"></td>
					<td></td>
				</tr>
				<tr>
				<td width="100"><b>Comuna</b></tD><td><b>:</b> <?php echo $datos[6];?></td><td width="100"><b>Ciudad</b></td><td><b>:</b> <?php echo $datos[7];?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<table  width="950" align="center">
	<tr>
		<td width="100"><b>Referencia</b></td>
		<td><b>:</b></td>
	</tr>
</table>

                

            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $if");
            $i=0;
            ?>
      <table width="950" align="center">
        <thead>
          <tr bgcolor="#cccccc">
            <th>#</th>
            <th>Concepto</th>
            <th>Cant</th> 
            <th>Monto</th>  
 			<th>Exento</th>    
            <th>Desc</th>
            <th>Rec</th>  
            <th>Extendido</th> 
           
          </tr>
        </thead>
        <tbody>
          <?php 
          $totalex=0;
          $totatotal=0;
          $totaliva=0;
          $totalexten=0;
          $totaldes=0;
          $totalrec=0;
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            $totalex=$totalex+$row[6];
            $totatotal=$totatotal+$row[12];
            $totaliva=$totaliva+$row[7];
            $totalexten=$totalexten+$row[5];
            $totaldes=$totaldes+$row[10];
			$totalrec=$totalrec+$row[11];
            ?>
          <tr>
            <td ><?php echo $row[2];?></td>
            <td><?php echo concepto($row[2]);?></td>
            <td align="right"><?php echo number_format($row[3]);?></td>
            <td align="right"><?php echo number_format($row[4]);?></td>
            <td align="right"><?php echo number_format($row[6]);?></td>
            <td align="right"><?php echo number_format($row[10]);?></td>
            <td align="right"><?php echo number_format($row[11]);?></td>

            <td align="right"><?php echo number_format($row[5]);?></td>

            </tr>
            <?php ?>


          <?php }?>

        </tbody>
      </table>

<br><br><br><br><br><br><br><br>

<table width="950" align="center">
	<tr>
		<td><?php echo '<b>'.numtoletras($totatotal).'</b>';?></td>
	</tr>
	<tr>
		<td width="425" rowspan="3"><b>ESTE ES UN DOCUMENTO INVALIDO, CREADO SOLO PARA MUESTRA</b></td>
		<td width="425">
			<table width="425" border="1" cellspacing="0">
				<tr>
					<td width="60">Exento:</td>
					<td> <div align="right">$ <?php echo number_format($totalex); ?></div></td>
					<td width="90">Neto:</td>
					<td><div align="right">$ <?php echo number_format($totalexten); ?></div></td>
				</tr>
				<tr>
					<td>Descuento:</td>
					<td><div align="right">$ <?php echo number_format($totaldes);?></div></td>
					<td>19% I.V.A.</td>
					<td><div align="right">$ <?php echo number_format($totaliva);?> </div></td>
				</tr>
				<tr>
					<td>Recargo:</td>
					<td><div align="right">$ <?php echo number_format($totalrec);?></div></td>
					<td>Total:</td>
					<td><div align="right">$ <?php echo number_format($totatotal);?></div></td>
				</tr>			
			</table>
		</td>
	</tr>
	<tr>
		<td>Cancelado Por:___________________</td>		
	</tr>
	<tr>
		<td>
			<table width="425" border="1" cellspacing="0" height="80">
				<tr>
					<td valign="top">Observaciones:
						<BR>
			<?PHP echo $observacion;?>
						</td>
				</tr>
			</table>
		</td>		
	</tr>
</table>


<table  width="950" align="center" border="1" cellspacing="0">
	<tr>
		<td>Nombre : _________________________________ RUT.:&nbsp; ______________________________<br>
		Recinto : _________________________________  &nbsp;Fecha: ______________________________ Firma_________________________
		<br>
		"El acuse de recibo que se declara en este acto, de acuerdo a lo dispuesto en la letra b) del Art. 4º, y la letra c) del Art. 5º de la Ley 19.983, acredita que
la entrega de mercaderias o servicio(s) prestado(s) ha(n) sido recibido(s)".
		</td>
	</tr>
</table>


<table  width="950" align="center"  cellspacing="0">
	<tr>
		<td valign="top"> _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
	<br>TT Cta/Cte: Latin Services Spa Rut: 76.584.248-4, Scotiabank Numero Cta. Cte en pesos: 973146587, Contacto:
		</td>
	</tr>
</table>

</body>
</html>



<?php 

include("conexion.php");

$fac=$if;
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
			".$caf."
			<TSTED>".$date."T".$time."</TSTED>
		</DD>
		<FRMT algoritmo='SHA1withRSA'>OicW7s3fchWu78DDtGFy5f2KJ61nweYyxhZCAlEwGq5jYo357mFveBNz0IraWRZQ9adJ6m6n7nMUrEWs78DQLw==</FRMT>
	</TED>
<TmstFirma>".$date."T".$time."</TmstFirma>
	</Documento>
	</DTE>
	</SetDTE>
</EnvioDTE>";
$buffertotal=$buffer.$buffer1.$buffer2.$buffer3.$buffercentral.$buffer4;
  $file=fopen("facturas/$fac.xml","w+");
  fwrite ($file,$buffertotal);
  fclose($file);
 
?> 