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
		<td width="640">
			<img src="images/logo.jpg" class="img-responsive"><br>

		</td>
		<td valign="top" align="CENTER"><BR>
			
		</td>
	</tr>

</table>

<br>

<table align="center" width="950" border="1" cellspacing="0">
	<tr>
		<td align="center"> <br>DATOS DEL CLIENTE<br><br></td>
	</tr>
	<tr>
		<td>
			<table align="center" width="940">
				<tr>
					<td width="100"><b>Cliente</b></tD>
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
					<td width="100"><b></b></td>
					<td><b></b> </td>
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


<table  width="950" align="center" border="1" cellspacing="0">

            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $fac");
            $i=0;
            ?>
     
        <thead>
     	<TR>
		<TD colspan="8" align="center"><br>DATOS FINANCIEROS<br><br></TD>
	</TR>
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
<table width="950" align="center">
	<tr>
		<td width="527" ></td>
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


</table>

<table WIDTH="950" border="1" cellspacing="0" align="center">
	<tr>
		<td align="center" colspan="6"><BR>ACTUALIZACIONES DE STATUS DE LA FACTURA <?PHP echo $fac;?><BR><BR></td>
	</tr>
	<tr>
		<td width="225"></td>
		<td align="center">Id</td>
		<td align="center">Id Status</td>
		<td align="center">Des Status</td>
		<td align="center">Fecha</td>
		<td width="225"></td>
	</tr>
	<?php 
		$con=mysql_query("SELECT * FROM seguimiento_factura WHERE id_factura = $fac");
			while($arr=mysql_fetch_array($con))
			{
	?>
	<tr>
		<td width="225"></td>
		<td align="center"><?php echo $arr[0];?></td>
		<td align="center"><?php echo $arr[2];?></td>
		<td align="center"><?php echo dstatusfac($arr[2]);?></td>		
		<td align="center"><?php echo $arr[3];?></td>
		<td width="225"></td>
	</tr>
	<?php }?>
</table>