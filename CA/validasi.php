<?php

include('File/X509.php');

$x509 = new File_X509();
$x509->loadCA('C://xampp/htdocs/simple/root.cert'); // see signer.crt
$cert = $x509->loadX509('C://xampp/htdocs/simple/client.cert'); // see google.crt
echo $x509->validateSignature() ? 'valid' : 'invalid';

?>