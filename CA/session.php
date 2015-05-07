<?php
session_start();
if ($_SESSION['valid']){
    $username = $_SESSION['username'];
    $usertype = $_SESSION['usertype'];
}
else {
    $username = NULL;
    $usertype = NULL;
    if (!isset($page)) header("location: login.php");
}
?>