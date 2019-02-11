<?php 
define('DB', 'sen_data');
define('DB_PASS', '');
define('DB_USER', 'root');
define('DB_HOST', 'localhost');
define('CP', '1');
define('CB', '2');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
if (mysqli_connect_errno()) {
   
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>