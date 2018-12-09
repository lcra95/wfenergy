<?php
   include_once ("conexion.php");
   $carta=$_GET['carta'];
   $sql=mysql_query("SELECT pdf FROM periodo_carta WHERE carta = '$carta'");
   $carta=mysql_fetch_array($sql);
   $file=base64_decode($carta['pdf']);
   header('Content-Type: application/pdf');
   echo $file;
   ?>