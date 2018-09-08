<?php 
include("fun_libro_ventas.php");
$periodo='2017-04';
function librocv($periodo)
{
$i=0;
$ivaa=0;
$buffer="";
$sql=mysql_query("SELECT * FROM tipo_documento");
while(@$row=mysql_fetch_array($sql))
{
list($totext,$totex,$ivat,$total,$num)=numero_documentos(@$row[0],$periodo);

$q[$i]=$row[0];
$a[$i]=$totext;
$b[$i]=$totex;
$c[$i]=$ivat;
$d[$i]=$total;
$e[$i]=$num;
$i++;
}
$tamano=sizeof($a);
for($k=0;$k<$tamano;$k++)
{
if($e[$k]>0)
{
$buffer1[$k]="<TotalesPeriodo>
<TpoDoc>".$q[$k]."</TpoDoc>
<TotDoc>".$e[$k]."</TotDoc>
<TotMntExe>".round($b[$k])."</TotMntExe>
<TotMntNeto>".round($a[$k])."</TotMntNeto>
<TotMntIVA>".round($c[$k])."</TotMntIVA>
<TotIVAFueraPlazo>".$ivaa."</TotIVAFueraPlazo>
<TotMntTotal>".round($d[$k])."</TotMntTotal>
</TotalesPeriodo>
";
$buffer=$buffer.$buffer1[$k];
}

}
return $buffer;
}  
?>