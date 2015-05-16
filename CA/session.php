<?php
$_SESSION['valid'] = false;
session_start();
if ($_SESSION['valid']){    
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $usertype = $_SESSION['usertype'];
    if (isset($page) && $page == 'login') header("location: index-user.php");
}
else {
	$_SESSION['valid'] = false;
    $userid = NULL;
    $username = NULL;
    $usertype = NULL;
    if (!isset($page) || $page!='login') header("location: index.php");
}
?>