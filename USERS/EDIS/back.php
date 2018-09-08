<?php 

include("letras.php");
include("conexion.php");
include("funciones.php");
$fac=$_GET['fac'];
$rutdaniel="24675367-9";
list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc)=filial();
list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);
$date= date('Y-m-d');
$time=date('h:i:s');
list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);
list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);
?>


























<?php
$arreglo_caratula=array("RutEmisor"=>$frut,
                      "RutEnvia"=>$rutdaniel,
                      "RutReceptor"=>$rut,
                      "FchResol"=>"2014-08-22",
                      "NroResol"=>"80",
                      "TmstFirmaEnv"=>$date."T".$time);


$buffer='<?xml version="1.0" encoding="ISO-8859-1"?>
			<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd">
<SetDTE ID="SetDoc">
          <Caratula version="1.0">';
  while (list ($etiqueta, $valor) = each ($arreglo_caratula)):
    $buffer.="<$etiqueta>$valor</$etiqueta>";
  endwhile;
    $buffer.="  
  <SubTotDTE>
    <TpoDTE>33</TpoDTE>
    <NroDTE>1</NroDTE>
  </SubTotDTE>";

  $buffer.="</Caratula>
  <DTE version='1.0'>
  	<Documento ID='F1275T33'>
		<Encabezado>
			<IdDoc>
				<TipoDTE>".$tip."</TipoDTE>
				<Folio>".$fac."</Folio>
				<FchEmis>".$fec."</FchEmis>
				<FchVenc>".$ven."</FchVenc>
			</IdDoc>
			<Emisor>
				<RUTEmisor>".$frut."</RUTEmisor>
				<RznSoc>".$fraz."</RznSoc>
				<GiroEmis>GENERACION EN OTRAS CENTRALES</GiroEmis>
				<Telefono>".$ftel."</Telefono>
				<Acteco>401019</Acteco>
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
		<Detalle>
			<NroLinDet>".$k."</NroLinDet>
			<CdgItem>
				<TpoCodigo>CFN</TpoCodigo>
				<VlrCodigo>".$row[2]."</VlrCodigo>
			</CdgItem>
			<NmbItem>".concepto($$row[2])."</NmbItem>
			<QtyItem>".$row[3]."</QtyItem>
			<UnmdItem>UN</UnmdItem>
			<PrcItem>".round($row[4])."</PrcItem>
			<MontoItem>".round($row[5])."</MontoItem>
		</Detalle>
  <TED version='1.0'>
		<DD>
			<RE>".$frut."</RE>
			<TD>33</TD>
			<F>".$fac."</F>
			<FE>".$fec."</FE>
			<RR>".$rut."</RR>
			<RSR>".$raz."</RSR>
			<MNT>".round($tt)."</MNT>
			<IT1>".concepto($i)."</IT1>
			<CAF version='1.0'>
				<DA>
					<RE>".$frut."</RE>
					<RS>".$fraz."</RS>
					<TD>33</TD>
					<RNG><D>".$desde."</D><H>".$hasta."</H></RNG>
					<FA>".$fec."</FA>
					<RSAPK>
						<M>1PSnOKVircC6lqPIGIZynK+z49S0lA1wLn+OV5N7yJTj5W++Gda3bljQS8wmymxOjGJmKPPdaRv7OmrXAHbdMw==</M>
						<E>Aw==</E>
					</RSAPK>
					<IDK>300</IDK>
				</DA>
				<FRMA algoritmo='SHA1withRSA'>dF+QBAVI6EyvOLUzpIRQmobI8jga/irQuNpxX/VwX/ToX+h73oKJHZm1KunUnoY9cwwJnC8e1VlZ1hNuXHiKXQ==
				</FRMA>
			</CAF>
			<TSTED>".$date."T".$time."</TSTED>
		</DD>
		<FRMT algoritmo='SHA1withRSA'>g+OHXeJeyZPH+zVcN9ussFIxM7KbUK7nJdrCM6mF12BW874AdYGeJ5h/y8scXQmVdw1nwRb76k3rtF5NHlC+mA==</FRMT>
	</TED>
<TmstFirma>".$date."T".$time."</TmstFirma>
	</Documento>
	<Signature xmlns='http://www.w3.org/2000/09/xmldsig#'>
		<SignedInfo>
			<CanonicalizationMethod Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315´'/>
			<SignatureMethod Algorithm='http://www.w3.org/2000/09/xmldsig#rsa-sha1'/>
			<Reference URI='#F1275T33'>
				<Transforms>
					<Transform Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315'/></Transforms>
					<DigestMethod Algorithm='http://www.w3.org/2000/09/xmldsig#sha1'/>
					<DigestValue>s7DKfu95mLBd4T5dolisGr8S+24=</DigestValue>
			</Reference>
		</SignedInfo>
		<SignatureValue>KfXK5pWdWSShpVp5yOGE1npTk+xIMDMKofJ0h3iksn4VRQbuQyj2ffMO8W8S1jnhWejxyurWIZg8
Ycs9IXMZntPqBEEyj+XvJ72oNdEgPX9rdoHxVlPGKCDzP8WX66vePUQdXLrmJzyRe5odkhuwvW10
TTTxcCdy+m7YdD6BaLU=</SignatureValue>
<KeyInfo>
	<KeyValue>
		<RSAKeyValue>
			<Modulus>zJ21ERH0ErG55wX90rAQMcUgJD1SImFFPOzTfO/QMRK1DbKv6/d4vK+mH6TzAImWCd44wvTef/kB
CXjWJj31e37+yFL+8cXN0boNSBVn8OWK6jqKm8QPm/VzQp6bQIbyKFvebcWe5Ei5FpswEwURcp0r
jaZkf8I9DmRAO1WMllk=</Modulus>
<Exponent>AQAB</Exponent>
		</RSAKeyValue>
	</KeyValue>
	<X509Data>
		<X509Certificate>MIIGPTCCBSWgAwIBAgIKP1DSCwAAAAZDGzANBgkqhkiG9w0BAQUFADCB0jELMAkGA1UEBhMCQ0wx
HTAbBgNVBAgTFFJlZ2lvbiBNZXRyb3BvbGl0YW5hMREwDwYDVQQHEwhTYW50aWFnbzEUMBIGA1UE
ChMLRS1DRVJUQ0hJTEUxIDAeBgNVBAsTF0F1dG9yaWRhZCBDZXJ0aWZpY2Fkb3JhMTAwLgYDVQQD
EydFLUNFUlRDSElMRSBDQSBGSVJNQSBFTEVDVFJPTklDQSBTSU1QTEUxJzAlBgkqhkiG9w0BCQEW
GHNjbGllbnRlc0BlLWNlcnRjaGlsZS5jbDAeFw0xNzAxMTcyMTExNTdaFw0yMDAxMTcyMTExNTda
MIHAMQswCQYDVQQGEwJDTDEKMAgGA1UECAwBKjERMA8GA1UEBxMIU0FOVElBR08xNjA0BgNVBAoT
LVNFUlZJQ0lPUyBFTiBURUNOT0xPR0lBUyBERSBJTkYuIFkgQ09NLiBMVERBLjEXMBUGA1UECxMO
RmFjdHVyYWNpb24uY2wxFjAUBgNVBAMTDU15dW5nIElsIENob2kxKTAnBgkqhkiG9w0BCQEWGmZv
cm11bGFyaW9zQGZhY3R1cmFjaW9uLmNsMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMnbUR
EfQSsbnnBf3SsBAxxSAkPVIiYUU87NN879AxErUNsq/r93i8r6YfpPMAiZYJ3jjC9N5/+QEJeNYm
PfV7fv7IUv7xxc3Rug1IFWfw5YrqOoqbxA+b9XNCnptAhvIoW95txZ7kSLkWmzATBRFynSuNpmR/
wj0OZEA7VYyWWQIDAQABo4ICpzCCAqMwCwYDVR0PBAQDAgTwMB0GA1UdDgQWBBQP0sNBE3Rz8Qq8
Z395BahT7+FX1jAfBgNVHSMEGDAWgBR44T6f0hKzejyNzTAOU7NDKQezVTA+BgNVHR8ENzA1MDOg
MaAvhi1odHRwOi8vY3JsLmUtY2VydGNoaWxlLmNsL2VjZXJ0Y2hpbGVjYUZFUy5jcmwwOgYIKwYB
BQUHAQEELjAsMCoGCCsGAQUFBzABhh5odHRwOi8vb2NzcC5lY2VydGNoaWxlLmNsL29jc3AwPQYJ
KwYBBAGCNxUHBDAwLgYmKwYBBAGCNxUIgtyDL4WTjGaF1Z0XguLcJ4Hv7DxhgcueFIaoglgCAWQC
AQQwIwYDVR0RBBwwGqAYBggrBgEEAcEBAaAMFgoyNDY3NTM2Ny05MCMGA1UdEgQcMBqgGAYIKwYB
BAHBAQKgDBYKOTY5MjgxODAtNTCCAU0GA1UdIASCAUQwggFAMIIBPAYIKwYBBAHDUgUwggEuMC0G
CCsGAQUFBwIBFiFodHRwOi8vd3d3LmUtY2VydGNoaWxlLmNsL0NQUy5odG0wgfwGCCsGAQUFBwIC
MIHvHoHsAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAEYAaQByAG0AYQAgAFMAaQBtAHAAbABlAC4A
IABIAGEAIABzAGkAZABvACAAdgBhAGwAaQBkAGEAZABvACAAZQBuACAAZgBvAHIAbQBhACAAcABy
AGUAcwBlAG4AYwBpAGEAbAAsACAAcQB1AGUAZABhAG4AZABvACAAaABhAGIAaQBsAGkAdABhAGQA
bwAgAGUAbAAgAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAHAAYQByAGEAIAB1AHMAbwAgAHQAcgBp
AGIAdQB0AGEAcgBpAG8wDQYJKoZIhvcNAQEFBQADggEBAFlv8fD7hdr+eQ4HAMSb1BMW3y0hsg45
caOKJvui4SY5lvjE/YSPB0Ffie821N1p4JkRoEDU7nkptQ18r4M92VqAwTlIMj9A1tEZkC34Eb6P
sEKaVGllZQJVD9geMzQUH7NiVUx9q9vLLR5pfnc/Xgha18VYcxiINmkhyQLC2a/P/uglnvTWk77E
s/FgNre/CI8YL8BOjUHWJHl6WA0/5JZx2FT7pRjPy7evtJakAM4uhE68TMgzzpPMxZul/Gdl+8Ln
7jCobrBVfPh8oC/EvTtjq0ye1SRNB+tIyLe3TxzSAG3Ayz8duQ1iX99Kz9ZrmQgkaJg1ZOa0EtGF
ZdeveCw=</X509Certificate>
	</X509Data>
</KeyInfo>
	</Signature>
</DTE>
</SetDTE>

<Signature xmlns='http://www.w3.org/2000/09/xmldsig#'>
	<SignedInfo>
		<CanonicalizationMethod Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315'/>
		<SignatureMethod Algorithm='http://www.w3.org/2000/09/xmldsig#rsa-sha1'/>
		<Reference URI='#SetDoc'>
			<Transforms>
				<Transform Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315'/>
			</Transforms>
			<DigestMethod Algorithm='http://www.w3.org/2000/09/xmldsig#sha1'/>
			<DigestValue>284cLJGBZ/UCifZdHHTpJtHDFYQ=</DigestValue>
		</Reference>
	</SignedInfo>

	<SignatureValue>MBzAh5Y40uv2Y9mHmwWxuB5s6MATGF0TEC+bA+vIB+Pbmf30uazKob32yqjpmnrr3xUePO2jHMqd
bAyT8JNxMZBpJ8S0xtaqM9QHwMs20wXdGt0QtJ1uzxWTrVnGwfxg5A7Z6CUDTz8LlEuHEyA/mqSh
3HK0rzMC/h6m/BX6c+I=</SignatureValue>

	<KeyInfo>
		<KeyValue>
			<RSAKeyValue>
				<Modulus>zJ21ERH0ErG55wX90rAQMcUgJD1SImFFPOzTfO/QMRK1DbKv6/d4vK+mH6TzAImWCd44wvTef/kB
CXjWJj31e37+yFL+8cXN0boNSBVn8OWK6jqKm8QPm/VzQp6bQIbyKFvebcWe5Ei5FpswEwURcp0r
jaZkf8I9DmRAO1WMllk=
				</Modulus>
				<Exponent>AQAB</Exponent>
			</RSAKeyValue>
		</KeyValue>
		<X509Data>
			<X509Certificate>MIIGPTCCBSWgAwIBAgIKP1DSCwAAAAZDGzANBgkqhkiG9w0BAQUFADCB0jELMAkGA1UEBhMCQ0wx
HTAbBgNVBAgTFFJlZ2lvbiBNZXRyb3BvbGl0YW5hMREwDwYDVQQHEwhTYW50aWFnbzEUMBIGA1UE
ChMLRS1DRVJUQ0hJTEUxIDAeBgNVBAsTF0F1dG9yaWRhZCBDZXJ0aWZpY2Fkb3JhMTAwLgYDVQQD
EydFLUNFUlRDSElMRSBDQSBGSVJNQSBFTEVDVFJPTklDQSBTSU1QTEUxJzAlBgkqhkiG9w0BCQEW
GHNjbGllbnRlc0BlLWNlcnRjaGlsZS5jbDAeFw0xNzAxMTcyMTExNTdaFw0yMDAxMTcyMTExNTda
MIHAMQswCQYDVQQGEwJDTDEKMAgGA1UECAwBKjERMA8GA1UEBxMIU0FOVElBR08xNjA0BgNVBAoT
LVNFUlZJQ0lPUyBFTiBURUNOT0xPR0lBUyBERSBJTkYuIFkgQ09NLiBMVERBLjEXMBUGA1UECxMO
RmFjdHVyYWNpb24uY2wxFjAUBgNVBAMTDU15dW5nIElsIENob2kxKTAnBgkqhkiG9w0BCQEWGmZv
cm11bGFyaW9zQGZhY3R1cmFjaW9uLmNsMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMnbUR
EfQSsbnnBf3SsBAxxSAkPVIiYUU87NN879AxErUNsq/r93i8r6YfpPMAiZYJ3jjC9N5/+QEJeNYm
PfV7fv7IUv7xxc3Rug1IFWfw5YrqOoqbxA+b9XNCnptAhvIoW95txZ7kSLkWmzATBRFynSuNpmR/
wj0OZEA7VYyWWQIDAQABo4ICpzCCAqMwCwYDVR0PBAQDAgTwMB0GA1UdDgQWBBQP0sNBE3Rz8Qq8
Z395BahT7+FX1jAfBgNVHSMEGDAWgBR44T6f0hKzejyNzTAOU7NDKQezVTA+BgNVHR8ENzA1MDOg
MaAvhi1odHRwOi8vY3JsLmUtY2VydGNoaWxlLmNsL2VjZXJ0Y2hpbGVjYUZFUy5jcmwwOgYIKwYB
BQUHAQEELjAsMCoGCCsGAQUFBzABhh5odHRwOi8vb2NzcC5lY2VydGNoaWxlLmNsL29jc3AwPQYJ
KwYBBAGCNxUHBDAwLgYmKwYBBAGCNxUIgtyDL4WTjGaF1Z0XguLcJ4Hv7DxhgcueFIaoglgCAWQC
AQQwIwYDVR0RBBwwGqAYBggrBgEEAcEBAaAMFgoyNDY3NTM2Ny05MCMGA1UdEgQcMBqgGAYIKwYB
BAHBAQKgDBYKOTY5MjgxODAtNTCCAU0GA1UdIASCAUQwggFAMIIBPAYIKwYBBAHDUgUwggEuMC0G
CCsGAQUFBwIBFiFodHRwOi8vd3d3LmUtY2VydGNoaWxlLmNsL0NQUy5odG0wgfwGCCsGAQUFBwIC
MIHvHoHsAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAEYAaQByAG0AYQAgAFMAaQBtAHAAbABlAC4A
IABIAGEAIABzAGkAZABvACAAdgBhAGwAaQBkAGEAZABvACAAZQBuACAAZgBvAHIAbQBhACAAcABy
AGUAcwBlAG4AYwBpAGEAbAAsACAAcQB1AGUAZABhAG4AZABvACAAaABhAGIAaQBsAGkAdABhAGQA
bwAgAGUAbAAgAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAHAAYQByAGEAIAB1AHMAbwAgAHQAcgBp
AGIAdQB0AGEAcgBpAG8wDQYJKoZIhvcNAQEFBQADggEBAFlv8fD7hdr+eQ4HAMSb1BMW3y0hsg45
caOKJvui4SY5lvjE/YSPB0Ffie821N1p4JkRoEDU7nkptQ18r4M92VqAwTlIMj9A1tEZkC34Eb6P
sEKaVGllZQJVD9geMzQUH7NiVUx9q9vLLR5pfnc/Xgha18VYcxiINmkhyQLC2a/P/uglnvTWk77E
s/FgNre/CI8YL8BOjUHWJHl6WA0/5JZx2FT7pRjPy7evtJakAM4uhE68TMgzzpPMxZul/Gdl+8Ln
7jCobrBVfPh8oC/EvTtjq0ye1SRNB+tIyLe3TxzSAG3Ayz8duQ1iX99Kz9ZrmQgkaJg1ZOa0EtGF
ZdeveCw=</X509Certificate>
		</X509Data>
	</KeyInfo>
</Signature>
</EnvioDTE>";

  $file=fopen("facturas/archivo$fac.xml","w+");
  fwrite ($file,$buffer);
  fclose($file);
echo "<a href='facturas/archivo$fac.xml'>XML</a>";
?> 