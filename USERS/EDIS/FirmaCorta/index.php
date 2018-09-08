<?php 

	require_once('DigitalSign.php');

	function firmando($datos)
	{
	$config = array(
		'private_key' => 'privkey.pem',
		'public_key' => 'pubkey.pem',
	);

	$ds = new DigitalSign($config, $datos);
	$signed = $ds->sign();
	if ($signed)
	{
	
	}
	else
	{
	return '<br /> <h1>Ha ocurrido un error</h1> <br />';
		exit;
	}
	$verified = $ds->verifySign();
	if ($verified)
	{
		
	}
	else
	{
		return 'La firma tiene problemas, sorry but you have to carry on';
	}

	return $ds->getFirma();
}
	

	
?>
