<?php

session_start();
$_SESSION = array();
session_destroy();
$_SESSION["loggedin"]=false;
header("location: login.php");
?>
