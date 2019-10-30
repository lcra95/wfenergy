<?php 
define('DB', 'wfenergy_wf_tiltiluno');
define('DB_PASS', 'Elianny2018.*');
define('DB_USER', 'wfenergy_ejpo');
define('DB_HOST', '186.64.115.140:3306');


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);

if (mysqli_connect_errno()) {
   
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>