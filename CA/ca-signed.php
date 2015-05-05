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

#echo "the private key for the CA cert (can be discarded):\r\n\r\n";
#echo $privatekey;
#echo "\r\n\r\n";

// create a self-signed cert that'll serve as the CA
$subject = new File_X509();
$subject->setDNProp('id-at-countryName', 'ID');
$subject->setDNProp('id-at-stateOrProvinceName', 'East Java');
$subject->setDNProp('id-at-localityName', 'Surabaya');
$subject->setDNProp('id-at-organizationName', 'sampi-ningkang CA');
$subject->setDNProp('id-at-organizationalUnitName', 'sampi ningkang signer');
$subject->setDNProp('id-at-commonName', 'www.sampi-ningkang.com');
$subject->setDNProp('id-at-emailAddress', 'mail@sampi-ningkang.com');
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
$filename = '../simple/privatekey.cert';
$filename1 = '../simple/root.cert';
$filename2 = '../simple/publickey.cert';

$myfile = fopen($filename,"w") or die("Unable to open file!");
fwrite($myfile, $CAPrivKey);

$myfile1 = fopen($filename1,"w") or die("Unable to open file!");
fwrite($myfile1, $x509->saveX509($result));

$myfile2 = fopen($filename2,"w") or die("Unable to open file!");
fwrite($myfile2, $pubKey);

fclose($myfile);
fclose($myfile1);
fclose($myfile2);

// create private key / x.509 cert for stunnel / website
$privKey = new Crypt_RSA();
extract($privKey->createKey());
$privKey->loadKey($privatekey);

$pubKey = new Crypt_RSA();
$pubKey->loadKey($publickey);
$pubKey->setPublicKey();

$subject = new File_X509();
$subject->setDNProp('id-at-organizationName', 'phpseclib demo cert');

$subject->setPublicKey($pubKey);

$issuer = new File_X509();
$issuer->setPrivateKey($CAPrivKey);
$issuer->setDN($CASubject);

$x509 = new File_X509();
$result = $x509->sign($issuer, $subject);
echo "the stunnel.pem contents are as follows:\r\n\r\n";
#echo $privKey->getPrivateKey();
echo "\r\n";
#echo $x509->saveX509($result);
echo "\r\n";
?>