
<?php
// $data is assumed to contain the data to be signed

// fetch private key from file and ready it
$pkeyid = 0;

// compute signature
$k=openssl_sign($data, $signature, $pkeyid);

// free the key from memory
echo $k;
?>
