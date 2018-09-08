<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 

include("letras.php");
include("conexion.php");
include("funciones.php");
$fac=$_GET['fac'];
$rut=$_GET['rut'];
$raz=razon($rut);
list($dir,$com,$ciu,$tel,$con)=empresa($rut);
$dir;
$com;
$ciu;
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc)=filial();

?>

<table width="950" align="center">
	<tr>
		<td width="640" align="center">
			<img src="images/logo.jpg" class="img-responsive"><br>
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
						<font size="+1" color="red"><strong>RUT.:<?php echo $frut;?><br><br><br>FACTURA ELECTRONICA<br><BR>N° <?PHP echo $fac?><br><br></strong></font>
					</td>
				</tr>
			</table>	
			<!--/FIN TABLA SELLO FACTURA-->
			<font size="+1" color="red"><strong>S.I.I. - SANTIAGO ORIENTE</strong></font>
		</td>
	</tr>
	<tr>
		<td align="Right" colspan="2">
			<b><?php $date=fechafac($fac); echo $fciu.', '; echo obtenerFechaEnLetra($date);?></b>
		</td>	
	</tr>
</table>

<table align="center" width="950" border="1" cellspacing="0">
	<tr>
		<td>
			<table align="center" width="950">
				<tr>
					<td width="100"><b>Señor(es)</b></tD>
					<td width="500"><b>:</b> <?php echo $raz; ?></td>
					<td width="100"><b>Contacto</b></td>
					<td><b>:</b> <?php echo $con;?></td>
				</tr>
				<tr>
					<td width="100"><b>Rut</b></tD>
					<td><b>:</b> <?php echo $rut;?></td>
					<td width="100"><b>Teléfono</b></td>
					<td><b>:</b> <?php echo $tel?></td>
				</tr>
				<tr>
					<td width="100"><b>Giro</b></tD>
					<td><b>:</b>  <?php echo "GENERACION EN OTRAS CENTRALES N.C.P.";?></td>
					<td width="100"><b>Vencimiento</b></td>
					<td><b>:</b> <?PHP $nuevafecha = strtotime ( '+5 day' , strtotime ( $date ) ) ;	$nuevafecha = date ( 'Y-m-j',$nuevafecha ); echo obtenerFechaEnLetra($nuevafecha);?></td>
				</tr>
				<tr>
					<td width="100"><b>Dirección </b></tD>
					<td><b>: </b> <?php echo $dir;?>
					</td><td width="100"></td>
					<td></td>
				</tr>
				<tr>
				<td width="100"><b>Comuna</b></tD><td><b>:</b> <?php echo $com;?></td><td width="100"><b>Ciudad</b></td><td><b>:</b> <?php echo $ciu;?></td>
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


<table  width="950" align="center">
	<tr bgcolor="#CCCCCC">
		<td width="80" align="center">Código</td>
		<td width="520" align="center">Descripción</td>
		<td width="50" align="center">Cantidad</td>
		<td width="100" align="center">Precio Unit.</td>
		<td width="100" align="center">Valor Dscto</td>
		<td width="100" align="center">Valor</td>
	</tr>
	<tr>
		<td align="center"><?php list($i,$m,$d,$r)=detallefac($fac); echo $i; if($m<0){$m=$m*-1;}?></td>
		<td><?php echo concepto($i);?></td>
		<td align="center"><?php echo 1;?></td>
		<td align="right"><?php echo round($m); ?></td>
		<td align="right"><?php echo 0;?></td>
		<td align="right"><?php echo round($m*1)	;?></td>
	</tr>
</table>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<table width="950" align="center">
	<tr>
		<td><?php $iva=$m*0.19; $numero=round($iva+$m); echo '<b>'.numtoletras($numero).'</b>';?></td>
	</tr>
	<tr>
		<td width="425" rowspan="3"><img src="images/firma.jpg"></td>
		<td width="425">
			<table width="425" border="1" cellspacing="0">
				<tr>
					<td width="60">Exento:</td>
					<td> <div align="right">$ 0</div></td>
					<td width="90">Neto:</td>
					<td><div align="right">$ <?php echo round($m); ?></div></td>
				</tr>
				<tr>
					<td>Descuento:</td>
					<td><div align="right">$ <?php echo round($r);?></div></td>
					<td>19% I.V.A.</td>
					<td><div align="right">$ <?php echo round($iva=$m*0.19); ?> </div></td>
				</tr>
				<tr>
					<td>Recargo:</td>
					<td><div align="right">$ <?php echo round($d);?></div></td>
					<td>Total:</td>
					<td><div align="right">$ <?php echo round($iva+$m+$d+$r);?></div></td>
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
					<td valign="top">Observaciones:</td>
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
	<br>TT Cta/Cte: Hanwha Q Cells Til Til Uno Spa Rut: 76.254.347-8, Scotiabank Numero Cta. Cte en pesos: 973140787, Contacto:
		</td>
	</tr>
</table>

</body>
</html>