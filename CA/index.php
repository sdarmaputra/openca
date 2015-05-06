<!DOCTYPE html>
<?php $page='login'; include('session.php'); ?>
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
      <ul class="nav navbar-nav navbar-right">
        <li><a href="signup.php">Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="login">   
  <h1>Please Login!</h1>
    <form action="logincheck.php" method="POST">
      <input type="email" placeholder="Email" name="email"/>        
      <input type="password" placeholder="Password" name="password"/>          
      <input type="submit" value="Log in" />      
    </form>
</div>

<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src="js/index.js"></script>
</body>

</html>