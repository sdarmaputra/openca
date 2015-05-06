<!DOCTYPE html>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {   
    if(isset($_POST['signup']))
      {
        include('db.php');
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="INSERT INTO user (username, userpass, usertype) VALUES ('$email','$password','1')";
        if ($conn->query($sql) === TRUE)
          echo "New record created successfully";
        else
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }


?>

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

<style>
  table, th, td {
      border: 1px solid black;
  }
</style>
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
      </ul>
      <div class="text-right">
        <a href="signup.php">Sign Up</a></li>
      </div>
    </div>
  </div>
</nav>

<div id="login">   
  <h1>Sign Up</h1>
    <form action="" method="POST">
      <div class="form-group">
      <input type="email" placeholder="Email" name="email"/>        
      <input type="password" placeholder="Password" name="password"/>
      <input type="submit" name="signup" />      
      </div>
    </form>
</div>

<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src="js/index.js"></script>
</body>

</html>