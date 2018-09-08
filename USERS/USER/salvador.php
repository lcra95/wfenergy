<?php 

## openssl genrsa -out key.pem 1024
## openssl rsa -in key.pem -pubout -outform PEM -out pubkey.pem
## openssl rsa -in key.pem -pubout -outform DER -out pubkey.der

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

	$pkeyid = openssl_get_privatekey($priv_key);
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