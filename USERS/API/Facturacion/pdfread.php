<?php
 $folio=$_GET['id'];
 include_once ('conexion.php');
 $sql=mysql_query("SELECT pdf FROM factura_recibida WHERE folio = $folio");
 $row=mysql_fetch_array($sql);
 $file = base64_decode($row['pdf']);
 header('Content-Type: application/pdf');
 echo $file;
 ?>