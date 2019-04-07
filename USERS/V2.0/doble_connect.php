<?php 
$mysqli1 = new mysqli('localhost', 'latinsyc_lrequen', '18594602lcra*', 'latinsyc_giasys');

$sql = "SELECT rut, comuna, ciudad FROM empresa";
$res = $mysqli1->query($sql);
echo '<pre>';

while ($row = mysqli_fetch_assoc($res)){
    $rut = explode('-',$row['rut']);
    $comuna = $row['comuna'];
    $ciudad = $row['ciudad'];

    $uno = edita($rut[0], $comuna, $ciudad);

    echo $uno.'<br>';

    
}
function edita($rut, $comuna, $ciudad){
    $mysql = new mysqli('localhost', 'root', '', 'sen_data');

    $sql2 = "UPDATE participante SET comuna ='$comuna', ciudad =  '$ciudad' WHERE rut = $rut";
    $mysql->query($sql2);
    echo $mysql->error;
    return 'bien';
}


?>