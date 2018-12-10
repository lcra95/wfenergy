<?PHP 
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('content-disposition: attachment;filename=proceso_de_pago.xls');
?>}
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
		<td align="center"><b>Monto</b></td>
		<td align="center"><b>Periodo</b></td>
		<td align="center"><b>Factura</b></td>		
	</tr>

<?php $sql=mysql_query("SELECT 
pp.descripcion, fr.folio,e.cuenta_bancaria, e.codigo_banco, fr.rut_emisor, a.razonsocial, fr.total, fr.iva, fr.exento, fr.neto
FROM pago p 
JOIN proceso_pago pp ON pp.id = p.id_proceso_pago
JOIN factura_recibida fr ON p.id_factura_recibida = fr.id
JOIN acreedor a ON fr.rut_emisor = a.rut_acreedor 
JOIN empresa e ON a.rut_acreedor = e.rut
WHERE p.id_proceso_pago = $idp");
while($q=mysql_fetch_array($sql)){   
$rut=explode('-', $q['rut_emisor']);
?>
<tr>
	<td align="right"><?php echo $q['cuenta_bancaria'];?></td>
	<td align="right"><?php echo $q['codigo_banco'];?></td>
	<td align="right"><?php echo $rut[0];?></td>
	<td align="right"><?php echo $rut[1];?></td>
	<td><?php echo $q['razonsocial'];?></td>

	<td align="right" ><?php echo round($q['total']);?></td>
	<td><?php echo $q['descripcion'];?></td>
	<td align="right"><?php echo $q['folio'];?></td>
</tr>
<?php } ?>
</table>
 </body>
</html>



