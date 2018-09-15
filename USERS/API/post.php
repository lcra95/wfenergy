<?php
$idr=$_GET['id'];
$id='DTE/'.$idr;
$ch = curl_init();
$archivo=file_get_contents($id);

curl_setopt($ch, CURLOPT_URL,            "http://api.kimchi.cl/firmar" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,     $archivo );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/json'));

$result=curl_exec ($ch);
$files=fopen("DTE/result.xml","w+");
fwrite ($files,$result);
fclose($files);

$res=file_get_contents('DTE/result.xml');
$xml=base64_encode($res);
include("conexion.php");
mysql_query("INSERT INTO `latinsyc_giasys`.`factura_docs` (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL, '$xml', '', '$idr');");


header("location: Facturacion/pfactura.php?msg=SE HA CREADO EXITOSAMENTE LA FACTURA $idr");
?>


