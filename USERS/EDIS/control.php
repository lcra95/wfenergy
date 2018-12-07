<?php
 
//conexiones, conexiones everywhere
ini_set('display_errors', 1);
error_reporting(E_ALL);
$db_host = 'localhost';
$db_user = 'wfenergy_ejpo';
$db_pass = 'Elianny2018.*';
$peri=$_POST["periodo"];
$tipo=$_POST["tipo"];
$date=date("Y-m-d h:i:s");
include("funciones.php");
 
$i=0;




$database = 'wfenergy_wf_tiltiluno';
$table = 'empresa_transaccion';
if (!@mysql_connect($db_host, $db_user, $db_pass))
    die("No se pudo establecer conexión a la base de datos");
 
if (!@mysql_select_db($database))
    die("base de datos no existe");
    if(isset($_POST['submit']))
    {
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         list ($td,$fn,$h)=busca_archivo($fname);
         echo $compare=compare($fname,$peri);
         if($compare=="NO OK")
         {
                header("location: tablas.php?msg=EL NOMBRE DEL ARCHIVO NO COINCIDE CON EL PERIODO SELECCIONADO&color=rojo");
         }



         echo 'Cargando nombre del archivo: '.$fname.' <br>';
         $chk_ext = explode(".",$fname);
         if($td=="OK")
         {
         
         if(strtolower(end($chk_ext)) == "csv")
         {
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
    
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {
                $id=id();
               //Insertamos los datos con los valores...
            $sql = "INSERT INTO empresa_transaccion VALUES ('$id','$tipo', '$data[0]','$peri','$data[1]');";
              mysql_query($sql) or die('Error: '.mysql_error());
             }
             //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);
            mysql_query("INSERT INTO archivo VALUES ('NULL', '$fname','$date')"); 
            header("location: tablas.php?msg=OPERACION EXITOSA&color=verde");
         }
         else
         {
            //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
//ver si esta separado por " , "
             header("location: tablas.php?msg=ARCHIVO INVALIDO&color=rojo");
         }
        }
        else
        {
            header("location: tablas.php?msg=ARCHIVO DUPLICADO SE CARGO EL $h&color=rojo");
            echo $h;
        }
    }
 
?>