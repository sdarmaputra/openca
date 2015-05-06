<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    if(isset($_POST['formCa']))
      {
        include('db.php');
        $content = $_POST['csr'];
        $sql = "INSERT INTO pending_cert (userpending, datepending, contentpending, signed) VALUES (a,a, $content,0)";
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