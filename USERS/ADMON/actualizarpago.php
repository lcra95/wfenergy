<?php 
include("conexion.php");
include("funciones.php");
$id=$_GET['id'];
$fac=$_POST['factura'];
$pro=$_GET['pro'];

mysql_query("UPDATE pago SET factura_pagada = '$fac' WHERE id = $id");
header("location: listapago.php?id=$pro");

?>