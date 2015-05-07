<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    if(isset($_POST['formCa']))
      {
        include('File/X509.php');
        include('Crypt/RSA.php');
        if(isset($_POST['csr']))
          {
            $CAPrivKey = new Crypt_RSA();
            $privatekeyCsr = file_get_contents("root_ca_privatekey.cert");
            #$privKey->loadKey($privatekeyCsr);
            $CAPrivKey->loadKey($privatekeyCsr);

            $CAPubKey = new Crypt_RSA();            
            $publickeyCsr = file_get_contents("root_ca_publickey.cert");
            #$pubKey->loadKey($publickeyCsr);            
            $CAPubKey->loadKey($publickeyCsr);
            
            $csrca = $_POST['csr'];

            $issuer = new File_X509();
            $issuer->setPrivateKey($CAPrivKey);
            $caroot = file_get_contents("root_ca.cert");
            $issuer->loadX509($caroot);

            $subject = new File_X509();
            $subject->setPublicKey($CAPubKey);
            $subject->loadCSR($csrca);

            $x509 = new File_X509();
            $x509->setStartDate('-1 month');
            $x509->setEndDate('+1 year');
            $x509->setSerialNumber(chr(1));
            $result = $x509->sign($issuer, $subject);
            $fileca = $x509->saveX509($result);

            echo $fileca;
            $myfile = fopen("caclient_old.cert","w") or die("Unable to open file!");
            fwrite($myfile, $fileca);
            fclose($myfile);
          }

        else{
          echo "error[1]";
        }
      }

      else{
        echo "error[2]";
      }
  }
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
	<div id="login">
		<h1>Form Signing Csr</h1>
		<form action="" method="POST">
			<div class="form-group">
				<h4>Input CSR</h4>
					<textarea class="form-control" rows="10" name="csr">
					</textarea>
				<h4>or Upload CSR</h4>
					<input type="file" class="file" name="fileCsr">
			</div>
			<input type="submit" value="Submit" name="formCa"/>
		</form>
	</div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src="js/index.js"></script>

</body>
</html>