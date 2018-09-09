<?php 
//Agrego comentario para demostracion
include("conexion.php");
$directorio = opendir("/var/www/html/GIASYS/PDFS 2017-10/"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
       echo $tex=substr($archivo, 1 ,-40 );

  	   $sql=mysql_query("UPDATE factura_transaccion SET doc = '$archivo' WHERE `id_factura` = $tex");  	   

    }
    else
    {	

  	    echo $tex=substr($archivo, 1 ,-40 );

		$sql=mysql_query("UPDATE factura_transaccion SET doc = '$archivo' WHERE `id_factura` = $tex");
    	
    
    }
}
?>
