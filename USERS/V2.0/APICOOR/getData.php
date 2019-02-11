<?php 
class getDatos {

    function getData($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json', 
                'X-CSRFToken: 224ee8463734f52991464b90337863ed774fbf83'
            ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
        $result=curl_exec ($ch);
    
        return $result;
    
    }

}


?>