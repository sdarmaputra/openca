<?php
include('db.php');
session_start();
$username = $_POST['email'];
$pass = $_POST['password'];
$u = mysqli_query($conn, "SELECT * from user where username='".$username."'");
$u = mysqli_fetch_row($u);
if ($u[2] == $pass){
    $_SESSION['valid'] = true;
    $_SESSION['username'] = $u[1];
    $_SESSION['usertype'] = $u[3];
    if ($_SESSION['usertype'] == 1) header("location: create-csr.php");
}
else header("location: login.php");
?>