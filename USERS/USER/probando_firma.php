<?php 


		$data='<DD><RE>76584248-4</RE><TD>33</TD><F>1</F><FE>2017-07-03</FE><RR>76437712-5</RR><RSR>ACCIONA ENERGIA CHILE HOLDINGS SA</RSR><MNT>233501</MNT><IT1>RELLENO</IT1><CAF version="1.0"><DA><RE>76584248-4</RE><RS>LATIN SERVICES SPA</RS><TD>33</TD><RNG><D>1</D><H>50</H>
                </RNG>
                <FA>2017-07-03</FA>
                <RSAPK>
                  <M>v5UgDJ/0AFn3JlQqppedatRMgKEkS6QgSJQtIZm1Xiq9fDzAfuYbPfrb3DSspmYVWLAabpbx45b5FXN3pPFh9Q==</M>
                  <E>Aw==</E>
                </RSAPK>
                <IDK>100</IDK>
              </DA>
              <FRMA algoritmo="SHA1withRSA">Nb3faMSdnqDQx0nfyTX6ixI2osoEO0Ns+9SqmnDQ9o+PMFnVDPDDSVgC6ejp5+2ZFWY2e40WpYfNURpEkojdNQ==</FRMA>
            </CAF>
            <TSTED>2017-07-03T10:58:47</TSTED>
          </DD>';

		  echo   $oResult = sign($data);
   			echo 	$dResult = verify($oResult);

function sign($data, $signature_alg = OPENSSL_ALGO_SHA1)

    {
    	$pkey="MIIBOgIBAAJBAL+VIAyf9ABZ9yZUKqaXnWrUTIChJEukIEiULSGZtV4qvXw8wH7mGz3629w0rKZmFViwGm6W8eOW+RVzd6TxYfUCAQMCQH+4wAhqoqrmpMQ4HG8Pvkc4MwBrbYfCwDBiyMERI5QbVva9y9dLKfWPYaNoOdjRrIeTdkKufg+CHONwq6Y/sDMCIQDim4tDTSR0Fiw5eYXNJ3EBUqC+NCYW2XTyEAS1+C0yZwIhANhulMtu0Og3d4/tkoi5upE6sirWax3y3tuwRcAzZKdDAiEAlxJc14jC+A7IJlED3hpLVjcV1CLEDzujTAqtzqVzdu8CIQCQSbiHnzXwJPpf87cF0ScLfHbHOZy+oennytkqzO3E1wIhAJJU/V4OD06a9l5bd5ZyfkklIA9dch+aPSta6pzb1PHR";


        if (openssl_sign($data, $signature, $pkey, $signature_alg)==false) {

            return ('No fue posible firmar los datos');

        }

        return base64_encode($signature);

    }


      $pub_key="MFowDQYJKoZIhvcNAQEBBQADSQAwRgJBAL+VIAyf9ABZ9yZUKqaXnWrUTIChJEukIEiULSGZtV4qvXw8wH7mGz3629w0rKZmFViwGm6W8eOW+RVzd6TxYfUCAQM=";
function verify($data, $signature, $pub_key, $signature_alg = OPENSSL_ALGO_SHA1)

    {	


        return openssl_verify($data, base64_decode($signature), $pub_key, $signature_alg) == 1 ? true : false;

    }



    ?>