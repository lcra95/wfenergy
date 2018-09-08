<?php
require_once('ossl/ds/XML.php');
include("conexion.php");
include("funciones.php");


$fac=$_GET['fac'];
function estamierda($fac)
{
$fac=$_GET['fac'];
$p='ossl/ds/'.$fac.'.xml';
return $p;
}



function GenCaratulaXML($fac)//Recibe el ID de la Factura y Genera el Formato de Caratula del DTE

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();





    $bufer='<Caratula version="1.0">

    <RutEmisor>'.$frut.'</RutEmisor>

    <RutEnvia>'.$rutdaniel.'</RutEnvia>

    <RutReceptor>'.$rut.'</RutReceptor>

    <FchResol>2017-06-21</FchResol>

    <NroResol>0</NroResol>

    <TmstFirmaEnv>'.$date."T".$time.'</TmstFirmaEnv>

    <SubTotDTE>

        <TpoDTE>'.$tip.'</TpoDTE>

        <NroDTE>'.$fac.'</NroDTE>

    </SubTotDTE>

</Caratula>

';

return $bufer;

}

function GenEncabezadoXML($fac)

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();


    $encabezado="<Encabezado>

            <IdDoc>

                <TipoDTE>".$tip."</TipoDTE>

                <Folio>".$fac."</Folio>

                <FchEmis>".$fec."</FchEmis>

                <FchVenc>".$ven."</FchVenc>

            </IdDoc>

            <Emisor>

                <RUTEmisor>".$frut."</RUTEmisor>

                <RznSoc>".$fraz."</RznSoc>

                <GiroEmis>".$fgir."</GiroEmis>

                <Telefono>".$ftel."</Telefono>

                <Acteco>741400</Acteco>

                <DirOrigen>".$fdir."</DirOrigen>

                <CmnaOrigen>".$fcom."</CmnaOrigen>

                <CiudadOrigen>".$fciu."</CiudadOrigen>

            </Emisor>

            <Receptor>

                <RUTRecep>".$rut."</RUTRecep>

                <RznSocRecep>".$raz."</RznSocRecep>

                <GiroRecep>".$gir."</GiroRecep>

                <Contacto>".$con."</Contacto>

                <DirRecep>".$dir."</DirRecep>

                <CmnaRecep>".$com."</CmnaRecep>

                <CiudadRecep>".$ciu."</CiudadRecep>

            </Receptor>

            <Totales>

                <MntNeto>".round($totext)."</MntNeto>

                <MntExe>".round($totex)."</MntExe>

                <TasaIVA>".$iva."</TasaIVA>

                <IVA>".round($ivat)."</IVA>

                <MntTotal>".round($total)."</MntTotal>

            </Totales>

        </Encabezado>

        ";
return $encabezado;
}



function ultimate_conpcepto($fac)

{
$id=$fac;
$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();




    $sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id= $id");

    $row=mysql_fetch_array($sql);

    return $row[1];

}

function solicitap($fac)

{

$i=0;

$sql=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $fac");

while($row=mysql_fetch_array($sql))

{

    return $con = ultimate_conpcepto($row[2]);

    break;

}

    



}

function conceptosxml($fac)

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();



$buffermedio="";

$i=0;

$cont=1;



    $sql3=mysql_query("SELECT * FROM `factura_concepto` WHERE `id_factura` = $fac");

    while($row=mysql_fetch_array($sql3))

    {

        $con[$i]=$row[2];

           $cant[$i]=$row[3];

        $prec[$i]=$row[4];

        $ext[$i]=$row[5];

        $exe[$i]=$row[6];


        $tot[$i]=$row[12];

        $i++;

    }

    $tamano=sizeof($cant);

    for($a=0;$a<$tamano;$a++)

    {

        $buffer3[$a]='

        <Detalle>

            <NroLinDet>'.$cont.'</NroLinDet>

            <CdgItem>

                <TpoCodigo>CFN</TpoCodigo>

                <VlrCodigo>'.$con[$a].'</VlrCodigo>

            </CdgItem>

            <NmbItem>'.ultimate_conpcepto($con[$a]).'</NmbItem>

            <QtyItem>'.$cant[$a].'</QtyItem>

            <UnmdItem>UN</UnmdItem>

            <PrcItem>'.round($prec[$a]).'</PrcItem>

            <MontoItem>'.round($ext[$a]).'</MontoItem>

        </Detalle>

        ';

        $cont++;

            $buffermedio=$buffermedio.$buffer3[$a];

    }

return $buffermedio;

}



function genTEDXML($fac)

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();



    $ted="<DD><RE>".$frut."</RE><TD>33</TD><F>".$fac."</F><FE>".$fec."</FE><RR>".$rut."</RR><RSR>".$raz."</RSR><MNT>".round($total)."</MNT><IT1>". solicitap($fac)."</IT1>".$caf."<TSTED>".$date."T".$time."</TSTED></DD>";
    require_once('FirmaCorta/DigitalSign.php');
    
      $config = array(
        'private_key' => 'FirmaCorta/privkey.pem',
        'public_key' => 'FirmaCorta/pubkey.pem',
    );

    $ds = new DigitalSign($config, $ted);
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

    $res=$ds->getFirma();


    $ted="<DD><RE>".$frut."</RE><TD>33</TD><F>".$fac."</F><FE>".$fec."</FE><RR>".$rut."</RR><RSR>".$raz."</RSR><MNT>".round($total)."</MNT><IT1>". solicitap($fac)."</IT1>".$caf."<TSTED>".$date."T".$time."</TSTED></DD>
    <FRMT algoritmo='SHA1withRSA'>".$res."</FRMT>";



    return $ted;

}



function ultimateXML($fac)

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();
$did='F'.$fac.'T'.$tip; 

$b1='<?xml version="1.0" encoding="ISO-8859-1"?>

    <EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd">

    <SetDTE ID="SetDoc">';

$b2=GenCaratulaXML($fac);

$b3='<DTE version="1.0">

    <Documento ID="'.$did.'">'.$b4=GenEncabezadoXML($fac).$b5=conceptosxml($fac).'<TED version="1.0">'.$b6=genTEDXML($fac).'</TED>
    <TmstFirma>'.$date."T".$time.'</TmstFirma>
</Documento>

    </DTE>
        </SetDTE>
        </EnvioDTE>
    ';


return  $bt=$b1.$b2.$b3;

}

  $x=ultimateXML($fac);

  $file=fopen("ossl/ds/$fac.xml","w+");

  fwrite ($file,$x);

  fclose($file);
$tip=33;
$did='F'.$fac.'T'.$tip; 
$forma='#'.$did;

$ted=genTEDXML($fac);



    $datos = $ted;
    $config = array(
        'file' => 'ossl/ds/mic.p12',
        'pass' => '18594lcra*',
        'data' => ''
    );

    $firma = new FirmaElectronica($config, $forma);

    // $result = $firma->sign($datos);

    // echo $result;

    // echo '<br /> VERIFICANDO FIRMA <br />';

    // $vResult = $firma->verify($datos, $result);
    // if ($vResult)
    // {
    //  echo 'La firma fue verificada satisfactoriamente';
    // }
    // else
    // {
    //  echo 'Se ha generado un error y los datos no pudieron ser verificados';
    // }

    $sResult = $firma->signXML($x, $forma);

    $vResult = $firma->verifyXML($sResult);

    $sResult = $firma->signXML($sResult, 'SetDoc');

    $vResult = $firma->verifyXML($sResult);

   echo $vResult;

class FirmaElectronica


{



    private $config; ///< Configuración de la firma electrónica

    private $certs; ///< Certificados digitales de la firma

    private $data; ///< Datos del certificado digial

    public $p;


    public function __construct(array $config = [])

    {

        $this->config = array_merge([

            'file' => null,

            'pass' => null,

            'data' => null,

            'wordwrap' => 64,

        ], $config);

        // cargar firma electrónica desde el contenido del archivo .p12 si no

        // se pasaron como datos del arreglo de configuración

        if (!$this->config['data'] and $this->config['file']) {

            if (is_readable($this->config['file'])) {

                $this->config['data'] = file_get_contents($this->config['file']);

            } else {

                echo 'Archivo de la firma electrónica '.basename($this->config['file']).' no puede ser leído';

            }

        }

        // leer datos de la firma electrónica

        if ($this->config['data'] and openssl_pkcs12_read($this->config['data'], $this->certs, $this->config['pass'])===false) {

            echo 'No fue posible leer los datos de la firma electrónica (verificar la contraseña)';

        }

        $this->data = openssl_x509_parse($this->certs['cert']);

        // quitar datos del contenido del archivo de la firma

        unset($this->config['data']);

    }


    private function error($msg)

    {

        $msg = Estado::get(Estado::FIRMA_ERROR, $msg);

        \sasco\LibreDTE\Log::write(Estado::FIRMA_ERROR, $msg);

        return false;

    }



    private function normalizeCert($cert)

    {

        if (strpos($cert, '-----BEGIN CERTIFICATE-----')===false) {

            $body = trim($cert);

            $cert = '-----BEGIN CERTIFICATE-----'."\n";

            $cert .= wordwrap($body, $this->config['wordwrap'], "\n", true)."\n";

            $cert .= '-----END CERTIFICATE-----'."\n";

        }

        return $cert;

    }



    public function getID()

    {

        // RUN/RUT se encuentra en la extensión del certificado, esto de acuerdo

        // a Ley 19.799 sobre documentos electrónicos y firma electrónica

        $x509 = new \phpseclib\File\X509();

        $cert = $x509->loadX509($this->certs['cert']);

        if (isset($cert['tbsCertificate']['extensions'])) {

            foreach ($cert['tbsCertificate']['extensions'] as $e) {

                if ($e['extnId']=='id-ce-subjectAltName') {

                    return ltrim($e['extnValue'][0]['otherName']['value']['ia5String'], '0');

                }

            }

        }

        // se obtiene desde serialNumber (esto es sólo para que funcione la firma para tests)

        if (isset($this->data['subject']['serialNumber'])) {

            return ltrim($this->data['subject']['serialNumber'], '0');

        }

        // no se encontró el RUN

        return $this->error('No fue posible obtener el ID de la firma');

    }



    public function getName()

    {

        if (isset($this->data['subject']['CN']))

            return $this->data['subject']['CN'];

        return $this->error('No fue posible obtener el Name (subject.CN) de la firma');

    }




    public function getEmail()

    {

        if (isset($this->data['subject']['emailAddress']))

            return $this->data['subject']['emailAddress'];

        return $this->error('No fue posible obtener el Email (subject.emailAddress) de la firma');

    }




    public function getFrom()

    {

        return date('Y-m-d H:i:s', $this->data['validFrom_time_t']);

    }


    public function getTo()

    {

        return date('Y-m-d H:i:s', $this->data['validTo_time_t']);

    }



    public function getIssuer()

    {

        return $this->data['issuer']['CN'];

    }




    public function getData()

    {

        return $this->data;

    }




    public function getModulus()

    {

        $details = openssl_pkey_get_details(openssl_pkey_get_private($this->certs['pkey']));

        return wordwrap(base64_encode($details['rsa']['n']), $this->config['wordwrap'], "\n", true);

    }



    public function getExponent()

    {

        $details = openssl_pkey_get_details(openssl_pkey_get_private($this->certs['pkey']));

        return wordwrap(base64_encode($details['rsa']['e']), $this->config['wordwrap'], "\n", true);

    }




    public function getCertificate($clean = false)

    {

        if ($clean) {

            return trim(str_replace(

                ['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----'],

                '',

                $this->certs['cert']

            ));

        } else {

            return $this->certs['cert'];

        }

    }




    public function getPrivateKey($clean = false)

    {

        if ($clean) {

            return trim(str_replace(

                ['-----BEGIN PRIVATE KEY-----', '-----END PRIVATE KEY-----'],

                '',

                $this->certs['pkey']

            ));

        } else {

            return $this->certs['pkey'];

        }

    }




    public function sign($data, $signature_alg = OPENSSL_ALGO_SHA1)

    {

        $signature = null;

        if (openssl_sign($data, $signature, $this->certs['pkey'], $signature_alg)==false) {

            return $this->error('No fue posible firmar los datos');

        }

        return base64_encode($signature);

    }



    public function verify($data, $signature, $pub_key = null, $signature_alg = OPENSSL_ALGO_SHA1)

    {

        if ($pub_key === null)

            $pub_key = $this->certs['cert'];

        $pub_key = $this->normalizeCert($pub_key);

        return openssl_verify($data, base64_decode($signature), $pub_key, $signature_alg) == 1 ? true : false;

    }




    public function signXML($xml, $reference , $tag = null, $xmlns_xsi = false)

    {

        $estamierda=estamierda();
        $doc = new XML();

        //$doc->loadXML($xml);

        $doc->load($estamierda);

        if (!$doc->documentElement) {

            echo 'No fue posible obtener el documentElement desde el XML a firmar';

            //return $this->error('No fue posible obtener el documentElement desde el XML a firmar');

        }

        // crear nodo para la firma

        $Signature = $doc->importNode((new XML())->generate([

            'Signature' => [

                '@attributes' => [

                    'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',

                ],

                'SignedInfo' => [

                    '@attributes' => [

                        'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',

                        'xmlns:xsi' => $xmlns_xsi ? 'http://www.w3.org/2001/XMLSchema-instance' : false,

                    ],

                    'CanonicalizationMethod' => [

                        '@attributes' => [

                            'Algorithm' => 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315',

                        ],

                    ],

                    'SignatureMethod' => [

                        '@attributes' => [

                            'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#rsa-sha1',

                        ],

                    ],

                    'Reference' => [

                        '@attributes' => [

                            'URI' => $reference,

                        ],

                        'Transforms' => [

                            'Transform' => [

                                '@attributes' => [

                                    'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#enveloped-signature',

                                ],

                            ],

                        ],

                        'DigestMethod' => [

                            '@attributes' => [

                                'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#sha1',

                            ],

                        ],

                        'DigestValue' => null,

                    ],

                ],

                'SignatureValue' => null,

                'KeyInfo' => [

                    'KeyValue' => [

                        'RSAKeyValue' => [

                            'Modulus' => null,

                            'Exponent' => null,

                        ],

                    ],

                    'X509Data' => [

                        'X509Certificate' => null,

                    ],

                ],

            ],

        ])->documentElement, true);

        // calcular DigestValue

        if ($tag) {

            $item = $doc->documentElement->getElementsByTagName($tag)->item(0);

            if (!$item) {

                return $this->error('No fue posible obtener el nodo con el tag '.$tag);

            }

            $digest = base64_encode(sha1($item->C14N(), true));

        } else {

            $digest = base64_encode(sha1($doc->C14N(), true));

        }

        $Signature->getElementsByTagName('DigestValue')->item(0)->nodeValue = $digest;

        // calcular SignatureValue

        $SignedInfo = $doc->saveHTML($Signature->getElementsByTagName('SignedInfo')->item(0));

        $firma = $this->sign($SignedInfo);

        if (!$firma)

            return false;

        $signature = wordwrap($firma, $this->config['wordwrap'], "\n", true);

        // reemplazar valores en la firma de

        $Signature->getElementsByTagName('SignatureValue')->item(0)->nodeValue = $signature;

        $Signature->getElementsByTagName('Modulus')->item(0)->nodeValue = $this->getModulus();

        $Signature->getElementsByTagName('Exponent')->item(0)->nodeValue = $this->getExponent();

        $Signature->getElementsByTagName('X509Certificate')->item(0)->nodeValue = $this->getCertificate(true);

        // agregar y entregar firma

        $doc->documentElement->appendChild($Signature);

        $doc->save($estamierda);

        return $doc->saveXML();

    }



    public function verifyXML($xml_data, $tag = null)

    {

        $doc = new XML();

        $doc->loadXML($xml_data);

        // preparar datos que se verificarán

        $SignaturesElements = $doc->documentElement->getElementsByTagName('Signature');

        $Signature = $doc->documentElement->removeChild($SignaturesElements->item($SignaturesElements->length-1));

        $SignedInfo = $Signature->getElementsByTagName('SignedInfo')->item(0);

        $SignedInfo->setAttribute('xmlns', $Signature->getAttribute('xmlns'));

        $signed_info = $doc->saveHTML($SignedInfo);

        $signature = $Signature->getElementsByTagName('SignatureValue')->item(0)->nodeValue;

        $pub_key = $Signature->getElementsByTagName('X509Certificate')->item(0)->nodeValue;

        // verificar firma

        if (!$this->verify($signed_info, $signature, $pub_key))

            return false;

        // verificar digest

        $digest_original = $Signature->getElementsByTagName('DigestValue')->item(0)->nodeValue;

        if ($tag) {

            $digest_calculado = base64_encode(sha1($doc->documentElement->getElementsByTagName($tag)->item(0)->C14N(), true));

        } else {

            $digest_calculado = base64_encode(sha1($doc->C14N(), true));

        }

        return $digest_original == $digest_calculado;

    }




    public static function getFromModulusExponent($modulus, $exponent)

    {

        $rsa = new \phpseclib\Crypt\RSA();

        $modulus = new \phpseclib\Math\BigInteger(base64_decode($modulus), 256);

        $exponent = new \phpseclib\Math\BigInteger(base64_decode($exponent), 256);

        $rsa->loadKey(['n' => $modulus, 'e' => $exponent]);

        $rsa->setPublicKey();

        return $rsa->getPublicKey();

    }
}   
?>


