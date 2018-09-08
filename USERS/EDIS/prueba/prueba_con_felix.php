<?php
//Datos que se quieren firmar:
$datos = 'Este texto será firmado. Thanks for your attention :)';

//Se deben crear dos claves aparejadas, una clave pública y otra privada
//A continuación el array de configuración para la creación del juego de claves
$configArgs = array(
    'config' => 'C:\wamp\bin\php\php5.2.9-1\extras\openssl\openssl.cnf', //<-- esta ruta es necesaria si trabajas con XAMPP
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
);
$resourceNewKeyPair = openssl_pkey_new($configArgs);
if (!$resourceNewKeyPair) {
    echo 'Puede que tengas problemas con la ruta indicada en el array de configuración "$configArgs" ';
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}

//obtengo del recurso $resourceNewKeyPair la clave publica como un string 
$details = openssl_pkey_get_details($resourceNewKeyPair);
$publicKeyPem = $details['key'];

//obtengo la clave privada como string dentro de la variable $privateKeyPem (la cual es pasada por referencia)
if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, NULL, $configArgs)) {
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}

//guardo la clave publica y privada en disco:
//file_put_contents('private_key.pem', $privateKeyPem);
//file_put_contents('public_key.pem', $publicKeyPem);

//si bien ya tengo cargado el string de la clave privada, lo voy a buscar a disco para verificar que el archivo private_key.pem haya sido correctamente generado:
$privateKeyPem ="-----BEGIN RSA PRIVATE KEY-----
MIIBOgIBAAJBAN1OerIg4F5jpwZ1A/meLgAkSSupgJfkmk56BRkZdwvsQ5bmBlCl
F5s7CtTetJ19CUIlC+BRnW4uSnRvI2afGWkCAQMCQQCTiacha0A+7RoETgKmaXQA
GDDHxlW6mGbe/ANmEPoH8ZpMJI7SckR7HRRZHwK0i3o2kk0+59SwvQVhmSZ7NOMD
AiEA8u7MJvNzZMq6uT1pyey7DCubwj/g3/j3pvDGOAfEaEsCIQDpNeMJIYZMF9Sz
EcZmofDFxK3VwhT+bBsbcUMxpgtcmwIhAKH0iBn3okMx0dDTm9vzJ11yZ9bVQJVQ
pRn12Xqv2EWHAiEAm3lCBhZZiA/jIgvZmcFLLoMejoFjVEgSEkuCIRlc6GcCIDzd
sNuhu2Id7S5VSCaj2feP/N0OK7EgYhtX+4f32kLw
-----END RSA PRIVATE KEY-----"; 

$publicKeyPem="-----BEGIN PUBLIC KEY-----
MFowDQYJKoZIhvcNAQEBBQADSQAwRgJBAN1OerIg4F5jpwZ1A/meLgAkSSupgJfk
mk56BRkZdwvsQ5bmBlClF5s7CtTetJ19CUIlC+BRnW4uSnRvI2afGWkCAQM=
-----END PUBLIC KEY-----";
//obtengo la clave privada como resource desde el string
$resourcePrivateKey = openssl_get_privatekey($privateKeyPem);

//crear la firma dentro de la variable $firma (la cual es pasada por referencia)
if (!openssl_sign($datos, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA256)) {
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}

// guardar la firma en disco:
file_put_contents('signature.dat', $firma);

// comprobar la firma
if (openssl_verify($datos, $firma, $publicKeyPem, 'sha256WithRSAEncryption') === 1) {
    echo 'la firma es valida y los datos son confiables';
} else {
    echo 'la firma es invalida y/o los datos fueron alterados';
}
