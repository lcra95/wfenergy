<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://sistema.webfactura.net/xml/b47961719e2478b9aa166cf0be525181/0" );
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result=curl_exec ($ch);

$result=curl_exec ($ch);
$files=fopen("Logs/SendQuery/result.xml","w+");
fwrite ($files,$result);
fclose($files);


?>


