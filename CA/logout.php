<?php 
    session_start();
    session_destroy();
    $_SESSION['valid'] = false;
    header("location: index.php");
?>