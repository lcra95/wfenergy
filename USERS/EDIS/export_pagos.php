    <html>
    <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <title></title>
    </head>
    <body>
<?php 
include("conexion.php");
include("funciones_export.php");
include("funciones.php");
$idp=$_GET['idp'];


?>
<table border="1" cellspacing="0">
	<tr>
		<td align="center"><b>Cuenta</b></td>
		<td align="center"><b>Codigo de Banco</b></td>
		<td align="center"><b>Rut</b></td>
		<td align="center"><b>Digito Verificacion</b></td>
		<td align="center"><b>Razon Social</b></td>
		<td align="center"><b>Concepto</b></td>
		<td align="center"><b>Monto</b></td>
		<td align="center"><b>Periodo</b></td>
		<td align="center"><b>Factura</b></td>		
	</tr>

<?php 
$sql=mysql_query("SELECT * FROM pago WHERE id_proceso_pago = $idp");
while($row=mysql_fetch_array($sql))
{
	list($r,$fr,$ra,$c,$co,$pe,$tipo)=empresa1($row[2]);

	?>
<tr>
	<td align="right"><?php echo $c;?></td>
	<td align="right"><?php echo $co;?></td>
	<td align="right"><?php echo $r;?></td>
	<td align="right"><?php echo $fr;?></td>
	<td><?php echo $ra;?></td>
	<td><?php echo concepto($tipo);?></td>
	<td><?php echo round($row[6]);?></td>
	<td><?php echo $pe;?></td>
	<td><?php echo $row[8];?></td>
</tr>
<?php } ?>
</table>
 </body>
</html>
<?PHP 
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('content-disposition: attachment;filename=Pendiente_por_Facturar.xls');
?>


