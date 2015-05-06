<?php
$server = "localhost";
$user = "caca";
$pass = "ourca123!";
$dbname = "ourca";
$conn = mysqli_connect($server, $user, $pass, $dbname);
if (!$conn) echo "Error connecting to database!";
?>