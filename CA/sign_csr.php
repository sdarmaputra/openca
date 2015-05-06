<?php
$page = 'sign';
include('session.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    if(isset($_POST['formCa']))
      {
    	include('db.php');
		$content = $_POST['csr'];
		$user = $_SESSION['username'];
		$sql = "INSERT INTO pending_cert (userpending, contentpending, signed) VALUES ('$user', '$content', 0)";
		if ($conn->query($sql) === TRUE)
			echo "New record created successfully";
		else
			echo "Error: " . $sql . "<br>" . $conn->error;		
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
  <?php include('navbar.php'); ?>

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