<?php 

## openssl genrsa -out key.pem 1024
## openssl rsa -in key.pem -pubout -outform PEM -out pubkey.pem
## openssl rsa -in key.pem -pubout -outform DER -out pubkey.der

$toSign="<DD><RE>97975000-5</RE><TD>33</TD><F>27</F><FE>2003-09-08</FE><RR>8414240-9</RR><RSR>JORGE GONZALEZ LTDA</RSR><MNT>502946</MNT><IT1>Cajon AFECTO</IT1><CAF version='1.0'><DA><RE>97975000-5</RE><RS>RUT DE PRUEBA</RS><TD>33</TD><RNG><D>1</D><H>200</H></RNG><FA>2003-09-04</FA><RSAPK><M>0a4O6Kbx8Qj3K4iWSP4w7KneZYeJ+g/prihYtIEolKt3cykSxl1zO8vSXu397QhTmsX7SBEudTUx++2zDXBhZw==</M><E>Aw==</E></RSAPK><IDK>100</IDK></DA><FRMA algoritmo='SHA1withRSA'>g1AQX0sy8NJugX52k2hTJEZAE9Cuul6pqYBdFxj1N17umW7zG/hAavCALKByHzdYAfZ3LhGTXCai5zNxOo4lDQ==</FRMA></CAF><TSTED>2003-09-08T12:28:31</TSTED></DD>";

function hextobin($hexstr) 
{ 
	$n = strlen($hexstr); 
	$sbin="";   
	$i=0; 
	while($i<$n) 
	{       
		$a =substr($hexstr,$i,2);           
		$c = pack("H*",$a); 
		if ($i==0){$sbin=$c;} 
		else {$sbin.=$c;} 
		$i+=2; 
	} 
	return $sbin; 
} 

function buildSign($toSign) {

	$signature = null;
	$priv_key = file_get_contents('key.pem');

	$pkeyid = openssl_pkey_get_private($priv_key);
	openssl_sign($toSign, $signature, $pkeyid);
	openssl_free_key($pkeyid);

	$hex = bin2hex( $signature );
	return $hex;
}

function verifySign($sign, $toSign) {

	$signdata = hextobin($sign);

	$ret = openssl_verify($toSign, $signdata, file_get_contents('pubkey.pem'));
	return $ret;	
}

function verifySign_der($sign, $toSign) {

	$signdata = hextobin($sign);

	$der = file_get_contents('pubkey.der');
	$pem = "-----BEGIN PUBLIC KEY-----\n";
	$str = base64_encode($der);
	$pem .= wordwrap($str, 64, "\n", true)."\n";	
	$pem .= "-----END PUBLIC KEY-----\n";	

	$ret = openssl_verify($toSign, $signdata, $pem);
	return $ret;	
}


$sign = buildSign('test1');
if (verifySign($sign, 'test1') == 1)
	echo "success\n";
if (verifySign_der($sign, 'test1') == 1)
	echo "success\n";

echo "\n";

$sign = buildSign('test1');
if (verifySign($sign, 'test2') == 0)
	echo "success\n";
if (verifySign_der($sign, 'test2') == 0)
	echo "success\n";

?>