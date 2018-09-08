<?php 

	require_once('FirmaElectronica.php');
	require_once('XML.php');
	function firmaXML($docu,$datos,$forma)
	{

	$config = array(
		'file' => 'usr0061.p12',
		'pass' => 'usr0061',
		'data' => ''
	);

	$firma = new FirmaElectronica($config, $forma);
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
}
?>