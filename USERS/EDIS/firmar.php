<?php 

	require_once('ossl/ds/FirmaElectronica.php');
	require_once('ossl/ds/XML.php');

	$datos = "<DD><RE>97975000-5</RE><TD>33</TD><F>27</F><FE>2003-09-08</FE><RR>8414240-9</RR><RSR>JORGE GONZALEZ LTDA</RSR><MNT>502946</MNT><IT1>Cajon AFECTO</IT1><CAF version='1.0'><DA><RE>97975000-5</RE><RS>RUT DE PRUEBA</RS><TD>33</TD><RNG><D>1</D><H>200</H></RNG><FA>2003-09-04</FA><RSAPK><M>0a4O6Kbx8Qj3K4iWSP4w7KneZYeJ+g/prihYtIEolKt3cykSxl1zO8vSXu397QhTmsX7SBEudTUx++2zDXBhZw==</M><E>Aw==</E></RSAPK><IDK>100</IDK></DA><FRMA algoritmo='SHA1withRSA'>g1AQX0sy8NJugX52k2hTJEZAE9Cuul6pqYBdFxj1N17umW7zG/hAavCALKByHzdYAfZ3LhGTXCai5zNxOo4lDQ==</FRMA></CAF><TSTED>2003-09-08T12:28:31</TSTED></DD>";

	$config = array(
		'file' => 'usr0061.p12',
		'pass' => 'usr0061',
		'data' => ''
	);

	$firma = new FirmaElectronica($config, "#F1275T33");
	// $result = $firma->sign($datos);

	// echo $result;

	// echo '<br /> VERIFICANDO FIRMA <br />';

	// $vResult = $firma->verify($datos, $result);
	// if ($vResult)
	// {
	// 	echo 'La firma fue verificada satisfactoriamente';
	// }
	// else
	// {
	// 	echo 'Se ha generado un error y los datos no pudieron ser verificados';
	// }

	$sResult = $firma->signXML($datos);

	$vResult = $firma->verifyXML($sResult);

	echo $vResult;

?>