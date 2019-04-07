
<?php
 /**
  * Establezco la ruta de nuestro sitio de pruebas en el
  * include_path para que la librería pueda incluir ella
  * misma sus archivos necesario
  */
set_include_path(implode(PATH_SEPARATOR, array(
        realpath(dirname(__FILE__) . '/phpseclib'),
        get_include_path(),
)));

// Incluimos la librería
require_once 'lib_sec/Net/SFTP.php';

 // Este bloque de 4 líneas no requiere explicación
$strServer = 'https://ppagos-sen.coordinadorelectrico.cl';
$intPort = 22;
$strUsername = 'sen76254347';
$strPassword = 'a400936a66d955cb0ca2ee9e5aecf387a96873ca';

/**
 * Estos serían los archivos local y remoto con los que
 * vamos a trabajar
 */
$strLocalFile = 'localfile.txt';
$strRemoteFile = 'remotefile.txt';

// Instanciamos la clase
$objFtp = new Net_SFTP( $strServer , $intPort );

// Realizamos el logeo
if (!$objFtp ->login( $strUsername , $strPassword )) {
         exit( 'Login Failed' );
}

// Obtenemos el directorio remoto actual
echo $objFtp->pwd() . "\r\n";

/**
 * Leemos los datos del archivo local que que queremos
 * enviar al servidor
 */
$strData = file_get_contents( $strLocalFile );

/**
 * Creamos un archivo en el servidor y escribimos lo datos
 * del archivo local que queremos enviar al servidor
 */
$objFtp->put( $strLocalFile, $strData );

/**
 * Descargamos un archivo remoto y lo guardamos nuestro
 * servidor local
 */
$objFtp->get( $strRemoteFile, $strRemoteFile );

echo('<pre>');
// Listamos los archivos en el directorio remoto
print_r($objFtp->nlist());
echo('</pre>');

/**
 * Cerramos la conexión, como debe hacer un buen
 * programador
 */
$objFtp->disconnect();
?>