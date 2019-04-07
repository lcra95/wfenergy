<?php 
include_once ("Config.php");

$sql="SELECT * FROM periodo ORDER BY id DESC ";
$result = $mysqli->query($sql);
?>

<form action="ventana.php" method="post">
    <label for="periodo">Periodo</label>
    <select name="periodo" id="periodo">
        <?php while( $row = mysqli_fetch_assoc($result)){?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
        <?php }?>
    </select>
    <input type="submit" value="Enviar">
</form>
<?php 
@$periodo = $_POST['periodo'];

if(!empty($periodo)){

$endpoint = 'VentanaFac';
$parametros = '&periods='.$periodo;
//$parametros = '&creditor=110&payment_matrix=34';
$end = new endpoints();
$result = $end->endpointsData($endpoint, $parametros);
echo '<pre>';
    print_r($result);

}

class endpoints{

    function endpointsData($enpoint, $parametros){
        
        include_once ('getData.php');
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);

        $curl = new getDatos();
        $sql = "SELECT e.url FROM endpoints e WHERE e.nombre = '$enpoint'"; 
        $result = $mysqli->query($sql);    
        $row = mysqli_fetch_assoc($result);
        
        
        $limit = '?limit=500';
        
        $url = $row['url'].$limit.$parametros;
        $result = $curl->getData($url);
        $result =json_decode($result,1);
       


       
        for ($i = 0; $i  < $result['count']; $i++){
            $id = $result['results'][$i]['id']; 
            $key = $result['results'][$i]['natural_key'];
            $tipofac = utf8_decode($result['results'][$i]['billing_type']);
            $periodo = $result['results'][$i]['periods'][0];
            // $desPrefijo = $result['results'][$i]['description_prefix']; 
            // $venPago = $result['results'][$i]['payment_window'];

            $vfInsert = "INSERT INTO ventana_facturacion VALUES ('$id','$key','$tipofac','$periodo')";
            $mysqli->query($vfInsert);
            echo $mysqli->error;
            echo '<br>';


       }
        return $result;
    }
    
}


?>