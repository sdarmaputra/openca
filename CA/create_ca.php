<?php
$page = 'create_ca';
include('session.php');
include('File/X509.php');
include('Crypt/RSA.php');
include('db.php');
       
$sql = "SELECT userpending, contentpending FROM pending_cert where signed=0";
$result_query = $conn->query($sql);

// // Associative array
$row = mysqli_fetch_array($result_query, MYSQLI_ASSOC);

//echo $row["pubKey"].$row["privKey"].$row["signature"];
$CAPrivKey = new Crypt_RSA();
$CAPubKey = new Crypt_RSA();

$privatekeyCsr = file_get_contents("root_ca_privatekey.cert");
#$privKey->loadKey($privatekeyCsr);
$publickeyCsr = file_get_contents("root_ca_publickey.cert");
#$pubKey->loadKey($publickeyCsr);

$CAPrivKey->loadKey($privatekeyCsr);
$CAPubKey->loadKey($publickeyCsr);

$csr = $row["contentpending"];

$issuer = new File_X509();
$issuer->setPrivateKey($CAPrivKey);
$caroot = file_get_contents("root_ca.cert");
$issuer->loadX509($caroot);

$subject = new File_X509();
$subject->setPublicKey($CAPubKey);
$subject->loadCSR($csr);

$x509 = new File_X509();
$x509->setStartDate('-1 month');
$x509->setEndDate('+1 year');

//$serial = 'FF';
$x509->setSerialNumber(chr(1));
$result = $x509->sign($issuer, $subject);
$fileca = $x509->saveX509($result);

#echo $fileca;
$myfile = fopen("caclient_new.cert","w") or die("Unable to open file!");
fwrite($myfile, $fileca);
fclose($myfile);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Certificate Authority</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>

<body>
  <?php include('navbar.php'); ?>
  <div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Date Request</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John</td>
          <td>Doe</td>
          <td>john@example.com</td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src="js/index.js"></script>

</body>
</html>