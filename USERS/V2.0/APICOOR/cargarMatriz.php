<?php 
$ventana = $_GET['id'];
$periodo = $_GET['periodo'];
$endpoint = 'Matrices';
$parametros = '&billing_window='.$ventana;
$end = new endpoints();
$result = $end->endpointsData($endpoint, $parametros, $periodo);
echo '<pre>';
    print_r($result);



class endpoints{

    function endpointsData($enpoint, $parametros, $periodo){
        


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
        
        for ($i = 0; $i  < $result['count']; $i++){
            $id = $result['results'][$i]['id']; 
            $tipoPago = $result['results'][$i]['payment_type'];
            $version = $result['results'][$i]['version'];
            $archivoPago = $result['results'][$i]['payment_file'];
            $numeroCarta = $result['results'][$i]['letter_code'];
            $anoCarta = $result['results'][$i]['letter_year'];
            $archivoCarta = $result['results'][$i]['letter_file'];
            $archivoMatriz = $result['results'][$i]['matrix_file'];
            $fechaPublicacion = $result['results'][$i]['publish_date'];
            $diasPago = $result['results'][$i]['payment_days'];
            $ventanaPago = $result['results'][$i]['payment_window'];
            $codigo = $result['results'][$i]['natural_key'];
            $referencia = $result['results'][$i]['reference_code'];
            $ventanafactura = $result['results'][$i]['billing_window'];
            $formaPago = $result['results'][$i]['payment_due_type'];

             

            $mInsert = "INSERT INTO matriz VALUES ('$id', '$tipoPago', '$version', '$archivoPago', '$numeroCarta', '$anoCarta', '$archivoCarta', '$archivoMatriz', '$fechaPublicacion', '$diasPago', '$ventanaPago', '$codigo', '$referencia', '$ventanafactura', '$formaPago')";
            $mysqli->query($mInsert);

            if(!$mysqli->error){

                header('location: cargaAutomatica.php?periodo=$periodo');
            }else{
                
                header('location: cargaAutomatica.php?periodo=$periodo');
            }
 
       }


        //return $result;
    }
    
}


?>