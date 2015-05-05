<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{		
		if(isset($_POST['formSubmit']))
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

						$x509->setDNProp('id-at-countryName', $countryName);
						$x509->setDNProp('id-at-stateOrProvinceName', $stateOrProvinceName);
						$x509->setDNProp('id-at-localityName', $localityName);
						$x509->setDNProp('id-at-organizationName', $organizationName);						
						$x509->setDNProp('id-at-organizationalUnitName', $organizationalUnitName);
						$x509->setDNProp('id-at-commonName', $commonName);						
						$x509->setDNProp('id-emailAddress', $emailAddress);
						$resultcsr = $x509->signCSR();
						
						$filecsr = $x509->saveCSR($resultcsr);
						$myfile = fopen("csr.pem","w") or die("Unable to open file!");
						fwrite($myfile, $filecsr);
						fclose($myfile);
						
						$file = "csr.pem";
							if (file_exists($file)) 
							{
								header('Content-Description: File Transfer');
								header('Content-Type: application/octet-stream');
								header('Content-Disposition: attachment; filename='.basename($file));
								header('Expires: 0');
								header('Cache-Control: must-revalidate');
								header('Pragma: public');
								header('Content-Length: ' . filesize($file));
								readfile($file);
								exit;
							}
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