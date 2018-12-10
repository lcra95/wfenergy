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
<<<<<<< HEAD
mysql_query("INSERT INTO `wfenergy_wf_tiltiluno`.`factura_docs` (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL, '$xml', '', '$idr');");
=======
mysql_query("INSERT INTO factura_docs (`id`, `xml`, `pdf`, `id_factura`) VALUES (NULL, '$xml', '', '$idr');");
>>>>>>> 8d7bce0b01dcf2c991fca151eb9ef806aa58a619


header("location: Facturacion/pfactura.php?msg=SE HA CREADO EXITOSAMENTE LA FACTURA $idr");
?>


