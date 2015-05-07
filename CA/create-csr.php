<?php
include('session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {   
    if(isset($_POST['formCsr']))
      {
        include('File/X509.php');
        include('Crypt/RSA.php');
        if(isset($_POST['organizationName']))
          {
            $countryName = $_POST['countryName'];
            $stateOrProvinceName = $_POST['stateOrProvinceName'];
            $localityName = $_POST['localityName'];
            $organizationName = $_POST['organizationName'];           
            $organizationalUnitName = $_POST['organizationalUnitName'];
            $commonName = $_POST['commonName'];         
            $emailAddress = $_POST['emailAddress'];
        
            $privKey = new Crypt_RSA();
            extract($privKey->createKey());
            $privKey->loadKey($privatekey);
            $x509 = new File_X509();
            $x509->setPrivateKey($privKey);

            $pubKey = new Crypt_RSA();
            $pubKey->loadKey($publickey);
            $pubKey->setPublicKey();

            $x509->setDNProp('id-at-countryName', $countryName);
            $x509->setDNProp('id-at-stateOrProvinceName', $stateOrProvinceName);
            $x509->setDNProp('id-at-localityName', $localityName);
            $x509->setDNProp('id-at-organizationName', $organizationName);            
            $x509->setDNProp('id-at-organizationalUnitName', $organizationalUnitName);
            $x509->setDNProp('id-at-commonName', $commonName);            
            $x509->setDNProp('id-emailAddress', $emailAddress);
            $resultcsr = $x509->signCSR();
            
            $filecsr = $x509->saveCSR($resultcsr);
            $myfile = fopen("$organizationName.csr","w") or die("Unable to open file!");
            fwrite($myfile, $filecsr);
            fclose($myfile);

            $myfile1 = fopen("$organizationName.pem","w") or die("Unable to open file!");
            fwrite($myfile1, $pubKey);
            fclose($myfile1);
            
            // $file = "$organizationName.csr";
            //   if (file_exists($file)) 
            //   {
            //     header('Content-Description: File Transfer');
            //     header('Content-Type: application/octet-stream');
            //     header('Content-Disposition: attachment; filename='.basename($file));
            //     header('Expires: 0');
            //     header('Cache-Control: must-revalidate');
            //     header('Pragma: public');
            //     header('Content-Length: ' . filesize($file));
            //     readfile($file);
            //     exit;
            //   }
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
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Certificate Authority</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
          <li ><a href="#">Home</a></li>
          <li class="active"><a href="create-csr.php">CSR</a></li>
          <li><a href="sign_csr.php">Sign</a></li>
          <li><a href="logout.php">Logout</a></li>  
          <li><a href="#"><i>Welcome, <?php echo $username; ?></i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="login">        
    <h1>Form Request</h1>
    <form action="" method="POST">
      <input type="text" placeholder="Country Name" name="countryName"/>
      <input type="text" placeholder="State or Province" name="stateOrProvinceName"/>
      <input type="text" placeholder="Locality Name" name="localityName"/>
      <input type="text" placeholder="Organization Name" name="organizationName"/>
      <input type="text" placeholder="Organizational Unit Name" name="organizationalUnitName"/>
      <input type="text" placeholder="Common Name : www.example.com" name="commonName"/>        
      <input type="Email" placeholder="Email" name="emailAddress"/>          
      <input type="submit" value="Submit" name="formCsr"/>
    </form>
  </div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src="js/index.js"></script>

</body>
</html>