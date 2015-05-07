<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if(isset($_POST['formSubmit']))
			{
				include('File/X509.php');
				include('Crypt/RSA.php');
				if(isset($_POST['csr']))
					{
						$con = mysqli_connect("localhost","root","","csr");
						// Check connection
						if (mysqli_connect_errno())
							{
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

						$sql="SELECT pubKey, privKey, signature FROM root where username='root'";
						$result_query=mysqli_query($con,$sql);

						// Associative array
						$row = mysqli_fetch_array($result_query,MYSQLI_ASSOC);

						//echo $row["pubKey"].$row["privKey"].$row["signature"];
						$CAPrivKey = new Crypt_RSA();
						$CAPubKey = new Crypt_RSA();
						$CAPrivKey->loadKey($row["privKey"]);
						$CAPubKey->loadKey($row["pubKey"]);
						$csr = $_POST['csr'];

						$issuer = new File_X509();
						$issuer->setPrivateKey($CAPrivKey);
						$ca=$issuer->loadX509($row["signature"]);

						$subject = new File_X509();
						$subject->setPublicKey($CAPubKey);
						$subject->loadCSR($csr);

						$x509 = new File_X509();
						$x509->setStartDate('-1 month');
						$x509->setEndDate('+1 year');
						$sql = "SELECT pubKey,privKey,signature FROM root where username='root'";
						$result_query=mysqli_query($con,$sql);

						// Associative array
						$row = mysqli_fetch_array($result_query,MYSQLI_ASSOC);
						$serial = '12';
						$x509->setSerialNumber(chr($serial));
						$result = $x509->sign($issuer, $subject);
						$fileca = $x509->saveX509($result);

						// Free result set
						mysqli_free_result($result_query);
						mysqli_close($con);
						echo $fileca;
						$myfile = fopen("ca".'.cert',"w") or die("Unable to open file!");
						fwrite($myfile, $fileca);
						fclose($myfile);
						$file = "ca".'.cert';

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