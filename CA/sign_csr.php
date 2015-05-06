<?php
include('session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if(isset($_POST['formCa']))
			{
				include('File/X509.php');
				include('Crypt/RSA.php');
				include('db.php');
				if(isset($_POST['csr']))
					{
						$sql = "SELECT contentpending FROM pending_cert where userpending='$username'";
						$result_query = $conn->query($sql);

						// // Associative array
						// $row = mysqli_fetch_array($result_query,MYSQLI_ASSOC);

						//echo $row["pubKey"].$row["privKey"].$row["signature"];
						$CAPrivKey = new Crypt_RSA();
						$CAPubKey = new Crypt_RSA();

						$privatekeyCsr = file_get_contents("root_ca_privatekey.cert");
						#$privKey->loadKey($privatekeyCsr);
						$publickeyCsr = file_get_contents("root_ca_publickey.cert");
						#$pubKey->loadKey($publickeyCsr);

						$CAPrivKey->loadKey($privatekeyCsr);
						$CAPubKey->loadKey($publickeyCsr);
						#print_r($CAPrivKey);
						#print_r($CAPubKey);
						$csr = $_POST['csr'];

						$issuer = new File_X509();
						$issuer->setPrivateKey($CAPrivKey);
						$caroot = file_get_contents("root_ca.cert");
						$ca = $issuer->loadX509($caroot);

						$subject = new File_X509();
						$subject->setPublicKey($CAPubKey);
						$subject->loadCSR($csr);

						$x509 = new File_X509();
						$x509->setStartDate('-1 month');
						$x509->setEndDate('+1 year');
						// $sql = "SELECT pubKey, privKey, signature FROM root where username='root'";
						// $result_query = mysqli_query($con,$sql);

						// // Associative array
						// $row = mysqli_fetch_array($result_query,MYSQLI_ASSOC);
						//$serial = 'FF';
						$x509->setSerialNumber(chr(1));
						$result = $x509->sign($issuer, $subject);
						$fileca = $x509->saveX509($result);

						// Free result set
						// mysqli_free_result($result_query);
						// mysqli_close($con);
						#echo $fileca;
						$myfile = fopen("caclient".'.cert',"w") or die("Unable to open file!");
						fwrite($myfile, $fileca);
						fclose($myfile);
					}

				else if(isset($_POST['fileCsr'])){
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
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Certificate Authority</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
        	<li ><a href="#">Home</a></li>
	        <li><a href="create-csr.php">CSR</a></li>
	        <li class="active"><a href="signing-ca.php">Sign</a></li>
	        <li><a href="logout.php">Logout</a></li>
            <li><a href="#"><i>Welcome, <?php echo $username; ?></i></a></li>
          	<li><a href="req_csr.php">CSR</a></li>
          	<li class="active"><a href="sign_csr.php">Sign</a></li>
          	<li><a href="login.php">Login</a></li>  
        </ul>
      </div>
    </div>
  </nav>

	<div id="login">
		<h1>Form Signing Csr</h1>
		<form action="" method="POST">
			<div class="form-group">
				<h4>Input CSR</h4>
					<!-- <textarea class="form-control" rows="10" name="csr">
					</textarea> -->
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