<?php
include('db.php');
session_start();
$username = $_POST['email'];
$pass = $_POST['password'];
$u = mysqli_query($conn, "SELECT * from user where username='".$username."'");
$u = mysqli_fetch_row($u);
if ($u[2] == $pass){
    $_SESSION['valid'] = true;
    $_SESSION['userid'] = $u[0];
    $_SESSION['username'] = $u[1];
    $_SESSION['usertype'] = $u[3];
    if ($_SESSION['usertype'] == 1) header("location: req_csr.php");
    elseif ($_SESSION['usertype'] == 0) {
    	header("location: create_ca.php");
    }
}
else header("location: index.php");
?>