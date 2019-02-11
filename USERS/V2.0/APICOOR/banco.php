<?php 
include_once ('Config.php');
include_once ('getData.php');

$curl = new getDatos();

$sql = "SELECT e.url FROM endpoints e WHERE e.nombre = 'Banco'"; 
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
$url = $row['url'];

$result = $curl->getData($url);
$arr =json_decode($result,1);

// echo '<pre>';
//     print_r($arr);
for ($i = 0; $i < $arr['count']; $i++){

    $id = $arr['results'][$i]['id'];
    $codigo = utf8_decode($arr['results'][$i]['code']);
    $nombre = utf8_decode($arr['results'][$i]['name']);
    $sbif = $arr['results'][$i]['sbif'];
    $tipo = $arr['results'][$i]['type'];

    $bankInsert = "INSERT INTO banco VALUES ('$id', '$codigo', '$nombre', '$sbif','$tipo')";
    $result = $mysqli->query($bankInsert);
    if($result){
        echo "Exitoso ".$nombre.'<br>';
    }else{
        echo $id.' - '.$mysqli->error;
    }
}

?>