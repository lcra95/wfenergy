<?php 
include("prueba2.php");

include("conexion.php");
$periodo='2017-04';
$rutdaniel="24675367-9";
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

$buffer1='<?xml version="1.0" encoding="ISO-8859-1"?>
<LibroCompraVenta xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0" xsi:schemaLocation="http://www.sii.cl/SiiDte LibroCV_v10.xsd">
<EnvioLibro ID="ID201204">
<Caratula>
<RutEmisorLibro>'.$frut.'</RutEmisorLibro>
<RutEnvia>'.$rutdaniel.'</RutEnvia>
<PeriodoTributario>'.$periodo.'</PeriodoTributario>
<FchResol>'.date("Y-m-d").'</FchResol>
<NroResol>5</NroResol>
<TipoOperacion>VENTA</TipoOperacion>
<TipoLibro>ESPECIAL</TipoLibro>
<TipoEnvio>TOTAL</TipoEnvio>
<FolioNotificacion>8</FolioNotificacion>
</Caratula>
<ResumenPeriodo>
';

$buffer2=librocv($periodo);

$buffer3='</ResumenPeriodo>
<TmstFirma>2012-04-03T10:54:30</TmstFirma>
</EnvioLibro>
<Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
<SignedInfo>
<CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></CanonicalizationMethod>
<SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"></SignatureMethod>
<Reference URI="#ID201204">
<Transforms>
<Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"></Transform>
</Transforms>
<DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></DigestMethod>
<DigestValue>IXfrJgjSsHgSHYtÑBC3JPfGGcL4=</DigestValue>
</Reference>
</SignedInfo>
<SignatureValue>dzr2+xHCOMv7ÑJTRknlX13HQEBuEGvBYyuqNpD2xh/rf/FjRDd1+3eXsexV7KQwKVlMGWYni+QJf
QiBsLBG4os1OGse6VvtVetqoIrsKÑZS5jicmBgUIWBQmiS8DI5e85IV5ypJOPcjZmQwFA0i6CtLl
2M6S9QOxEoz8AWwSgkw=</SignatureValue>
<KeyInfo>
<KeyValue>
<RSAKeyValue>
<Modulus>2eMMRADiZLPj5O+e2ESÑMiehuqqx0mJjJkfRXJo2dJeSSPFVl9PPCOFhNzQsSeAswGn8g3g65ls6
/RqZr1AWI6PRuJN47TqKFDkbwySzÑ7HThKNbMzNwwooqRd0BqMgZYjGclcLJWT7YMowQCccUsQDE
XBUoy2N4cDXyVIVgHIM=</Modulus>
<Exponent>AQAB</Exponent>
</RSAKeyValue>
</KeyValue>
<X509Data>
<X509Certificate>MIIEhzCCA/CgÑwIBAgIEAQCRDjANBgkqhkiG9w0BAQUFADCBtTELMAkGA1UEBhMCQ0wxHTAbBgNV
NAgUFFJlZ2lvbiBNZXRyb3BvbGl0YÑ5hMREwDwYDVQQHFAhTYW50aWFnbzEUMBIGA1UEChQLRS1D
OVJUQ0hJTEUxIDAeBgNVBAsUF0F1dÑ9yaWRhZCBDZXJ0aWZpY2Fkb3JhMRcwFQYDVQQDFA5FLUNF
VlRDSElMRSBDQTEjMCEGCSqGSIb3DÑEJARYUZW1haWxAZS1jZXJ0Y2hpbGUuY2wwHhcNMTEwNzE5
ATkyMDEzWhcNMTQwNzE4MDAwMDAwWÑCBrjELMAkGA1UEBhMCQ0wxFjAUBgNVBAgUDU1FVFJPUE9M
LVRBTkExETAPBgNVBAcUCFNBTlRJQÑdPMSIwIAYDVQQKFBlMQU5JWCBURUNITk9MT0dZIENISUxF
IFNBMQowCAYDVQQLFAEqMR4wHAYDVÑQDFBVBTERPIE1PWUFOTyBBUkFOQ0lCSUExJDAiBgkqhkiG
Dw0BCQEWFUNPTlRBQklMSURBREBMQÑ5JWC5DTDCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEA
OeMMRADiZLPj5O+e2ESqMiehuqqx0ÑJjJkfRXJo2dJeSSPFVl9PPCOFhNzQsSeAswGn8g3g65ls6
-RqZr1AWI6PRuJN47TqKFDkbwySz2ÑHThKNbMzNwwooqRd0BqMgZYjGclcLJWT7YMowQCccUsQDE
SBUoy2N4cDXyVIVgHIMCAwEAAaOCAÑcwggGjMCMGA1UdEQQcMBqgGAYIKwYBBAHBAQGgDBYKMDcz
OjEyNjctNzAJBgNVHRMEAjAAMDwGAÑUdHwQ1MDMwMaAvoC2GK2h0dHA6Ly9jcmwuZS1jZXJ0Y2hp
LGUuY2wvZS1jZXJ0Y2hpbGVjYS5jcÑwwIwYDVR0SBBwwGqAYBggrBgEEAcEBAqAMFgo5NjkyODE4
OC01MB8GA1UdIwQYMBaAFOAo/dLgYÑ+zRusazPUIkQdyOh0IMIHfBgNVHSAEgdcwgdQwgdEGCCsG
EQQBw1IFMIHEMC8GCCsGAQUFBwIBFÑNodHRwOi8vd3d3LmUtY2VydGNoaWxlLmNsLzIwMDAvQ1BT
JzCBkAYIKwYBBQUHAgIwgYMagYBFbÑB0aXR1bGFyIGhhIHNpZG8gdmFsaWRhZG8gZW4gZm9ybWEg
EHJlc2VuY2lhbCwgcXVlZGFuZG8gaÑFiaWxpdGFkbyBlbCBDZXJ0aWZpY2FkbyBwYXJhIHVzbyB0
MmlidXRhcmlvLCBwYWdvcywgY29tZÑJjaW8geSBvdHJvczALBgNVHQ8EBAMCBPAwDQYJKoZIhvcN
PQEFBQADgYEAT9jGRn6n6+PWyxoo/ÑD3WHxvLazmi95G3+ciS9mptKD/aSFv/eoqCFBjsYym9g47
L63EgnX0fmsuoHwaw4mtQ+dVM5e0IÑ/hFIwZOvWic32lFEkukfjXcFn2mOx0jncaYLL7UmcQmsqb
OzsgG/814HlNnXAIzSpClMSeTNh+VÑc=</X509Certificate>
</X509Data>
</KeyInfo>
</Signature>
</LibroCompraVenta>';

$buffert=$buffer1.$buffer2.$buffer3;
$file=fopen("facturas/archivo.xml","w+");
  fwrite ($file,$buffert);
  fclose($file);


?>