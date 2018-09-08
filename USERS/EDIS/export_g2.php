    <html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    </head>
    <body>

<?php 
include("conexion.php");
include("funciones.php");
$ano='2017';
?>
<table>
	<tr>
		<td><b>ID</b></td>
		<td><B>CONCEPTO</B></td>
		<td><B>RUT</B></td>
		<td><B>RAZÓN</B></td>		
		<td><B>PERIODO</B></td>
		<td><B>MONTO</B></td>
	</tr>
<?php
$sel=mysql_query("SELECT * FROM empresa_transaccion WHERE periodo LIKE '%2017%' ORDER BY `empresa_transaccion`.`periodo` ASC");
while($row=mysql_fetch_array($sel))
{
?>
	<tr>
		<td><?php echo $row[0];?></td>
		<td><?php echo concepto($row[1]);?></td>
		<td><?php echo rut_empresa($row[2]);?></td>
		<td><?php echo razon($row[2]);?></td>
		<td><?php echo $row[3];?></td>
		<td align="right"><?php echo $row[4];?></td>				
	</tr>
<?php	
}
?>
</table>
</body>
</html>
<?PHP 
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('content-disposition: attachment;filename=Transacciones.xls');
?>