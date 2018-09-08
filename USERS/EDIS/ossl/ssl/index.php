<?php
	// datos que se quieren firmar
	$datos = "<DD><RE>97975000-5</RE><TD>33</TD><F>27</F><FE>2003-09-08</FE><RR>8414240-9</RR><RSR>JORGE GONZALEZ LTDA</RSR><MNT>502946</MNT><IT1>Cajon AFECTO</IT1><CAF version='1.0'><DA><RE>97975000-5</RE><RS>RUT DE PRUEBA</RS><TD>33</TD><RNG><D>1</D><H>200</H></RNG><FA>2003-09-04</FA><RSAPK><M>0a4O6Kbx8Qj3K4iWSP4w7KneZYeJ+g/prihYtIEolKt3cykSxl1zO8vSXu397QhTmsX7SBEudTUx++2zDXBhZw==</M><E>Aw==</E></RSAPK><IDK>100</IDK></DA><FRMA algoritmo='SHA1withRSA'>g1AQX0sy8NJugX52k2hTJEZAE9Cuul6pqYBdFxj1N17umW7zG/hAavCALKByHzdYAfZ3LhGTXCai5zNxOo4lDQ==</FRMA></CAF><TSTED>2003-09-08T12:28:31</TSTED></DD>";

	// crear unas claves pública y privada nuevas
	$new_key_pair = openssl_pkey_new(array(
	    "private_key_bits" => 2048,
	    "private_key_type" => OPENSSL_KEYTYPE_RSA,
	));
	openssl_pkey_export($new_key_pair, $private_key_pem);

	$details = openssl_pkey_get_details($new_key_pair);
	$public_key_pem = $details['key'];

	// crear la firma
	openssl_sign($datos, $firma, $private_key_pem, OPENSSL_ALGO_SHA1);

	// guardar para después
	file_put_contents('private_key.pem', $private_key_pem);
	file_put_contents('public_key.pem', $public_key_pem);
	file_put_contents('signature.dat', $firma);

	// comprobar la firma
	$r = openssl_verify($datos, $firma, $public_key_pem, OPENSSL_ALGO_SHA1);
	var_dump($r);
?>