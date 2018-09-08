    <html>
    <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <title></title>
    </head>
    <body>
<?php 
include("conexion.php");
include("funciones.php");
$iva=miva();
$periodo=$_GET["periodo"];

?>
<table border="1" cellspacing="0" cellspading="0">
	<tr>
		<td align="center"><b>Item</b></td>
		<td align="center"><b>ID</b></td>
		<td align="center"><b>Empresa</b></td>
		<td align="center"><b>Concepto</b></td>		
		<td align="center"><b>Monto</b></td>
		<td align="center"><b>Iva <?php echo $iva; ?></b></td>
		<td align="center"><b>Total</b></td>
		<td align="center"><b>Fecha Factura</b></td>
		<td align="center"><b>N° Factura</b></td>
		<td align="center"><b>Tipo Pago</b></td>		
	</tr>

<?php
$i=1;
$sql=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '$periodo'");
while($row=mysql_fetch_row($sql))
{

if($row[1]<20 && $row[4]>0)
{
$concep=concepto($row[1]);
$empresa=rut_empresa($row[2]);
$monto=round($row[4]);
$moiva=round($monto*$iva);
$total=round($monto+$moiva);?>
<tr>
	<td align="center"><?php echo $i;?></td>
	<td><?php echo $row[0];?></td>
	<td><?php echo $empresa;?></td>
	<td><?php echo $concep;?></td>
	<td align="right"><?php echo $monto;?></td>
	<td align="right"><?php echo $moiva;?></td>
	<td align="right"><?php echo $total;?></td>
	<td></td>
	<td></td>
	<td></td>
</tr>


<?php
$i++; 
}
elseif($row[1]>=20 && $row[4]<0)
{
$concep=concepto($row[1]);
$empresa=rut_empresa($row[2]);
$monto=round($row[4]*-1);
$moiva=round($monto*$iva);
$total=round($monto+$moiva);



?>
<tr>
	<td align="center"><?php echo $i;?></td>
	<td><?php echo $row[0];?></td>
	<td><?php echo $empresa;?></td>
	<td><?php echo $concep;?></td>
	<td align="right"><?php echo $monto;?></td>
	<td align="right"><?php echo $moiva;?></td>
	<td align="right"><?php echo $total;?></td>
	<td></td>
	<td></td>
	<td></td>
</tr>


<?php 
$i++;
}
}

?>
</table>
 </body>
</html>
<?PHP 
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('content-disposition: attachment;filename=Pendiente_por_Facturar.xls');
?>