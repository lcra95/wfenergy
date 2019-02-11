<?php 
include_once ("Config.php");
$contacto =CP;

$sql = "";

echo '<pre>';
$result = $mysqli->query($sql);
echo $mysqli->error;
while($row = mysqli_fetch_assoc($result)){
    
    print_r($row);
}

?>


