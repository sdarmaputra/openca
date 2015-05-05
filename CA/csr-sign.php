
<?php
// Let's assume that this script is set to receive a CSR that has
// been pasted into a textarea from another page
include('File/X509.php');
// $csrdata = "D://csr.pem";
$x509 = new File_X509();
$csr = $x509->loadCSR('D://csr.pem'); // see google.crt

// We will sign the request using our own "certificate authority"
// certificate.  You can use any certificate to sign another, but
// the process is worthless unless the signing certificate is trusted
// by the software/users that will deal with the newly signed certificate

// We need our CA cert and its private key
$cacert = "C://xampp/htdocs/simple/root.cert";
$privkey = array("C://xampp/htdocs/simple/privatekey.cert", "your_ca_key_passphrase");

$usercert = openssl_csr_sign($csr, $cacert, $privkey, 365);

// Now display the generated certificate so that the user can
// copy and paste it into their local configuration (such as a file
// to hold the certificate for their SSL server)
openssl_x509_export($usercert, $certout);
echo $certout;

// Show any errors that occurred here
while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
}
?>
