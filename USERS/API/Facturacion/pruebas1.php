<?php 
@$carta=$_POST['carta'];
@$PDF=$_FILES['pdf']['name'];
@$FECHA=$_POST['fecha'];
@$periodo=$_POST['periodo'];
$var=file_get_contents($_FILES['pdf']['tmp_name']);
$pdf=base64_encode($var);
$sql="INSERT INTO periodo_carta VALUES (NULL, '2018-07', 'DE05597','$pdf','$FECHA')";
var_dump(mysql_query($sql));

?>