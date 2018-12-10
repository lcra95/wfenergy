<?php 
$periodo='2018-10';
$fac=3714;
include("conexion.php");
include("funciones.php");

$referencias="SELECT 
r.emisor, pc.carta, r.codigo_ref, pc.fecha, r.nemotecnico
FROM factura_concepto fc 
JOIN factura f on fc.id_factura = f.id AND f.id=$fac
JOIN referencia r on f.id_periodo = r.id_periodo AND r.id_concepto = (SELECT id_concepto FROM factura_concepto WHERE id_factura = $fac)
JOIN periodo_carta pc on pc.id_periodo = r.id_periodo AND f.id_periodo = '$periodo'";


$balances="SELECT 
pc.carta
FROM periodo_carta pc 
WHERE id_periodo = '$periodo';
";

$sql="SELECT 
*
FROM factura f
JOIN empresa e on f.id_empresa = e.id 
JOIN factura_concepto fc on f.id = fc.id_factura
JOIN tipo_transaccion tt on fc.id_concepto = tt.id
";



$sql1="SELECT 
r.nemotecnico 
FROM factura_concepto fc
JOIN referencia r ON fc.id_concepto = r.id_concepto AND r.id_periodo = '$periodo'
WHERE fc.id_factura = $fac";


$sql2="SELECT 
et.* 
FROM empresa_transaccion et
JOIN fectura_transaccion ft ON et.id != ft.id_transaccion";


$sql="SELECT sum(energia) FROM energia_periodo WHERE periodo = '2018-12'";

$sel=mysql_query($sql);
while($q=mysql_fetch_array($sel)){   
                echo '<pre>';
                  print_r($q);
                echo '</pre>';

}
?>