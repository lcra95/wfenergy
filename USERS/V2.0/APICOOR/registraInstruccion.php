<?php 
$instruccion = $_GET['id'];
$endpoint = 'Instrucciones';
$parametros = '&creditor=110&payment_matrix='.$instruccion;
$parametros2 = '&debtor=110&payment_matrix='.$instruccion;

$end = new endpoints();
$result = $end->endpointsData($endpoint, $parametros, $parametros2);
echo '<pre>';
    print_r($result);



class endpoints{

    function endpointsData($enpoint, $parametros, $parametros2){

        include_once ('Config.php');
        include_once ('getData.php');

        $curl = new getDatos();
        $sql = "SELECT e.url FROM endpoints e WHERE e.nombre = '$enpoint'"; 
        $result = $mysqli->query($sql);    
        $row = mysqli_fetch_assoc($result);
        
        
        $limit = '?limit=500';
        
        $url = $row['url'].$limit.$parametros;
        $result = $curl->getData($url);
        $result =json_decode($result,1);

        if($result['count']==0){

            $url = $row['url'].$limit.$parametros2;
            $result = $curl->getData($url);
            $result =json_decode($result,1);
        }

        for ($i = 0; $i  < $result['count']; $i++){
                          
            $id = $result['results'][$i]['id'];
            $id_matriz = $result['results'][$i]['payment_matrix'];
            $id_acreedor = $result['results'][$i]['creditor'];
            $id_deudor = $result['results'][$i]['debtor'];
            $monto = $result['results'][$i]['amount'];
            $status = $result['results'][$i]['status'];
            $resolucion = $result['results'][$i]['resolution'];
            $fechaMaxPago = $result['results'][$i]['max_payment_date'];
  
            

            $Insert = "INSERT INTO instruccion VALUES ('$id', '$id_matriz', '$id_acreedor', '$id_deudor', '$monto', '$status', '$resolucion', '$fechaMaxPago')";
            $mysqli->query($Insert);
  
        }
        return $result;
    }
    
}

?>