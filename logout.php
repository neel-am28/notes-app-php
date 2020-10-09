<?php 
    session_start();
    session_unset($_SESSION['USER_ID']);
    session_unset($_SESSION['IS_LOGGED_IN']);
    header("location:login.php");
?>