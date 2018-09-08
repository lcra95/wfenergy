
<?php
// se asume que $datos contiene la información que se va a firmar
echo $datos="hola";

// obtener la clave privada desde el fichero y prepararla
echo $pkeyid = openssl_pkey_get_private("key.pem");

echo $firma="MIIBOwIBAAJBANGuDuim8fEI9yuIlkj+MOyp3mWHifoP6a4oWLSBKJSrd3MpEsZd
czvL0l7t/e0IU5rF+0gRLnU1Mfvtsw1wYWcCAQMCQQCLyV9FxKFLW09yWw7bVCCd
xpRDr7FRX/EexZB4VhsNxm/vtJfDZyYle0Lfy42LlcsXxPm1w6Q6NnjuW+AeBy67
AiEA7iMi5q5xjswqq+49RP55o//jqdZL/pC9rdnUKxsNRMMCIQDhaHdIctErN2hC
IP9knS3+9zra4R+5jSXOvI+3xVhWjQIhAJ7CF0R0S7SIHHKe04NUURf/7RvkMqm1
08k74sdnXi3XAiEAlkWk2vc2HM+a1sCqQxNz/098ketqe7NuidMKeoOQObMCIQCk
FAMS9IcPcMjk7zI2r/4EEW63PSXyN7MFAX7TYe25mw==";
// computar la firma
openssl_sign($datos, $firma, $pkeyid);

// liberar la clave de la memoria
openssl_free_key($pkeyid);
?>



