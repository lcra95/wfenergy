<?php 

define('WS_USER', '24675367-9');
define('WS_PASS', 'MtVZCHZ8d351');
define('WS_EMISOR', '76254347-8');
define('WS_PROD','http://wsprod.webfactura.net/wsWF.php?wsdl');//
//define('WS_PROD','http://wstest.webfactura.net/wsWF.php?wsdl');
define('WS_TEST','http://wstest.webfactura.net/wsWF.php?wsdl');

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

function proxima_factura()
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, 'latinsyc_giasys');
    $arr = folio_activo();
    $desde = $arr['desde'];
    $hasta = $arr['hasta'];
	$sql=$mysqli->query("SELECT count(*) as Cuenta FROM factura WHERE id >=$desde AND id <= $hasta");
    $row=mysqli_fetch_assoc($sql);
    $row=$row['Cuenta'];
    if($row==0) {
        
        $fac=$desde;
    
    }else {
    
        $fac=$desde+$row+1;
    }
    

	if($fac>$hasta) {
        
        return "NULL";
	}
	else {
		return $fac;
	}
}
function folio_activo()
{

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
	$sql=$mysqli->query("SELECT * FROM folio WHERE status = 1");
	$row=mysqli_fetch_assoc($sql);
	return $row;
}
?>