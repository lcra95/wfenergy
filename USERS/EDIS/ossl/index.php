<?php
    //Datos que se quieren firmar:
    $datos="<DD><RE>97975000-5</RE><TD>33</TD><F>27</F><FE>2003-09-08</FE><RR>8414240-9</RR><RSR>JORGE GONZALEZ LTDA</RSR><MNT>502946</MNT><IT1>Cajon AFECTO</IT1><CAF version='1.0'><DA><RE>97975000-5</RE><RS>RUT DE PRUEBA</RS><TD>33</TD><RNG><D>1</D><H>200</H></RNG><FA>2003-09-04</FA><RSAPK><M>0a4O6Kbx8Qj3K4iWSP4w7KneZYeJ+g/prihYtIEolKt3cykSxl1zO8vSXu397QhTmsX7SBEudTUx++2zDXBhZw==</M><E>Aw==</E></RSAPK><IDK>100</IDK></DA><FRMA algoritmo='SHA1withRSA'>g1AQX0sy8NJugX52k2hTJEZAE9Cuul6pqYBdFxj1N17umW7zG/hAavCALKByHzdYAfZ3LhGTXCai5zNxOo4lDQ==</FRMA></CAF><TSTED>2003-09-08T12:28:31</TSTED></DD>";

    //Se deben crear dos claves aparejadas, una clave pública y otra privada
    //A continuación el array de configuración para la creación del juego de claves
    $configArgs = array(
        'config' => 'C:\wamp64\bin\php\php7.0.10\extras\ssl\openssl.cnf', //<-- esta ruta es necesaria si trabajas con XAMPP
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA
    );
    $resourceNewKeyPair = openssl_pkey_new($configArgs);
    if (!$resourceNewKeyPair) {
        echo 'Puede que tengas problemas con la ruta indicada en el array de configuración "$configArgs"';
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
    //file_put_contents('private_key.pem', $privateKeyPem); <---
    //file_put_contents('pubkey.pem', $publicKeyPem); <---
    //si bien ya tengo cargado el string de la clave privada, lo voy a buscar a disco para verificar que el archivo private_key.pem haya sido correctamente generado:
    $privateKeyPem = file_get_contents('private_key.pem');
    //obtengo la clave privada como resource desde el string
    //$resourcePrivateKey = openssl_get_privatekey($privateKeyPem);
    $resourcePrivateKey = openssl_pkey_get_private($privateKeyPem);
    //crear la firma dentro de la variable $firma (la cual es pasada por referencia)
    if (!openssl_sign($datos, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA1)) {
        echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
        exit;
    }

    echo $firma;
    // guardar la firma en disco:
    file_put_contents('firma.dat', $firma);
    // comprobar la firma
    if (openssl_verify($datos, $firma, $publicKeyPem, OPENSSL_ALGO_SHA1) === 1) {
        echo 'la firma es valida y los datos son confiables';
    } else {
        echo 'la firma es invalida y/o los datos fueron alterados';
    }
	
?>