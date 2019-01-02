<?php
/*
AMBIENTE TILTIL
AMBIENTE LOCAL
*/
define('AMBIENTE','TILTIL');
define('WS_USER', '24675367-9');
define('WS_PASS', 'MtVZCHZ8d351');
define('WS_EMISOR', '76254347-8');
define('WS_PROD','http://wsprod.webfactura.net/wsWF.php?wsdl');//
//define('WS_PROD','http://wstest.webfactura.net/wsWF.php?wsdl');
define('WS_TEST','http://wstest.webfactura.net/wsWF.php?wsdl');



if(AMBIENTE=='LOCAL'){
    
    define('SERVER','localhost');
    define('DB', 'latinsyc_giasys');
    define('DB_USER', 'latinsyc_lrequen');
    define('DB_PASS', '18594602lcra*');
    
}elseif(AMBIENTE == 'TILTIL'){
   
    define('SERVER','localhost');
    define('DB', 'wfenergy_wf_tiltiluno');
    define('DB_USER', 'wfenergy_ejpo');
    define('DB_PASS', 'Elianny2018.*');
}

?>