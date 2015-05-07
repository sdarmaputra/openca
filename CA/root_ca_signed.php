<?php

include('File/X509.php');
include('Crypt/RSA.php');

#DEFINE("OPEN_SSL_CONF_PATH", "C:/xampp/php/extras/openssl/openssl.cnf");

// create private key for CA cert
$CAPrivKey = new Crypt_RSA();
extract($CAPrivKey->createKey());
$CAPrivKey->loadKey($privatekey);

$pubKey = new Crypt_RSA();
$pubKey->loadKey($publickey);
$pubKey->setPublicKey();
#print_r($pubKey);
#echo "\r\n\r\n";

#echo "the private key for the CA cert (can be discarded):\r\n\r\n";
#echo $privatekey;
#echo "\r\n\r\n";

// create a self-signed cert that'll serve as the CA
$subject = new File_X509();
$subject->setDNProp('id-at-countryName', 'ID');
$subject->setDNProp('id-at-stateOrProvinceName', 'Bali');
$subject->setDNProp('id-at-localityName', 'Tabanan');
$subject->setDNProp('id-at-organizationName', 'Lubak-Injin CA');
$subject->setDNProp('id-at-organizationalUnitName', 'Lubak-Injin Signer');
$subject->setDNProp('id-at-commonName', 'www.lubak-injin.com');
$subject->setDNProp('id-at-emailAddress', 'mail@lubak-injin.com');
$subject->setPublicKey($pubKey);

$issuer = new File_X509();
$issuer->setPrivateKey($CAPrivKey);
$issuer->setDN($CASubject = $subject->getDN());

$x509 = new File_X509();
$x509->makeCA();
$x509->setStartDate('-1 month');
$x509->setEndDate('+1 year');

$result = $x509->sign($issuer, $subject);
#echo "the CA cert to be imported into the browser is as follows:\r\n\r\n";
#echo $x509->saveX509($result);
#echo "\r\n\r\n";

$myfile = fopen("root_ca_privatekey.cert","w") or die("Unable to open file!");
fwrite($myfile, $CAPrivKey);

$myfile2 = fopen("root_ca_publickey.cert","w") or die("Unable to open file!");
fwrite($myfile2, $pubKey);

$myfile1 = fopen("root_ca.cert","w") or die("Unable to open file!");
fwrite($myfile1, $x509->saveX509($result));

fclose($myfile);
fclose($myfile1);
fclose($myfile2);

// // create private key / x.509 cert for stunnel / website
// $privKey = new Crypt_RSA();
// extract($privKey->createKey());
// $privatekeyCsr = file_get_contents("privatekey.cert");
// $privKey->loadKey($privatekeyCsr);
// #print_r($privKey);

// $pubKey = new Crypt_RSA();
// $publickeyCsr = file_get_contents("publickeyCsr");
// $pubKey->loadKey($publickeyCsr);
// $pubKey->setPublicKey();

// $subject = new File_X509();
// $subject->setDNProp('id-at-organizationName', 'phpseclib demo cert');

// $subject->setPublicKey($pubKey);

// $issuer = new File_X509();
// $issuer->setPrivateKey($CAPrivKey);
// $issuer->setDN($CASubject);

// $x509 = new File_X509();
// $result = $x509->sign($issuer, $subject);
// #echo "the stunnel.pem contents are as follows:\r\n\r\n";
// #echo $privKey->getPrivateKey();
// #echo "\r\n";
// #echo $x509->saveX509($result);
// $myfile3 = fopen("client.cert","w") or die("Unable to open file!");
// fwrite($myfile3, $x509->saveX509($result));
// fclose($myfile3);
// #echo "\r\n";
?>