<?php 
include_once ('Config.php');
mysqli_set_charset($mysqli,"utf8");
$id=$_GET['id'];
$dbSelect= "SELECT * FROM detalle_balance WHERE id = $id";
$result = $mysqli->query($dbSelect);
$row = mysqli_fetch_assoc($result); 

echo json_encode($row);
?>