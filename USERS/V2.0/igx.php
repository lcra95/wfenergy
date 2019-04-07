<?php    
include_once ('Config.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
$Query = "SELECT RUT FROM participante WHERE ID = 4";
$respuesta = $mysqli->query($Query);
    while ($row = mysqli_fetch_assoc($respuesta)){   
        
        $rut = $row['RUT'];
        $resourse = 'https://app.igx.cl/coordinado/select2?search='.$rut;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $resourse );
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Origin: https://igx.cl'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result=curl_exec ($ch);
        //print_r(curl_getinfo($ch));
        $res = json_decode($result,1);
        if(sizeof($res['results'])==0){
            
            exit('No Encontrado');
        }

        $coordinado = $res['results'][0]['id'];
        
        $resourse = 'https://app.igx.cl/coordinado/detail?code='.$coordinado;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $resourse );
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Origin: https://igx.cl'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result=curl_exec ($ch);

        curl_close($ch);
        $fp = fopen('respuesta.html', 'w');
        fwrite($fp, $result);
        fclose($fp);
        $xmlDoc = new DOMDocument;
        $archivo=file_get_contents('respuesta.html');
        $xplo = explode('<td>',$archivo);

        $size = sizeof($xplo);
        $nuevo = array();
        $o = 0;
        for($i = 0; $i < $size; $i++ ){

            if($i ==5){
                $xplo[5] = str_replace('.','',$xplo[5]);                    
            }
            if(($i >= 2)&&($i<23)&&($i <>3)){
                               
                $xplod = explode('</td>',$xplo[$i]);
                $nuevo[$o] = trim(utf8_decode($xplod[0])); 
                $o++;
            }

        }
        $nrut = explode('-',$nuevo[2]);

        $Update = "UPDATE participante p SET p.name ='$nuevo[0]', p.nombre_legal = '$nuevo[1]', p.giro_comercial = '$nuevo[3]', p.cuenta_bancaria = $nuevo[18], p.banco = '$nuevo[16]', p.direccion = '$nuevo[4]', p.direccion_postal = '$nuevo[4]' , p.comuna = '$nuevo[5]', p.ciudad = '$nuevo[6]' WHERE p.rut = $nrut[0]";
        $mysqli->query($Update);

        echo $mysqli->error;
        echo '<pre>';
            print_r($nuevo);
        

        
    }        
?>        