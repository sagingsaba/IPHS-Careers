<?php
require_once ".\include\connect\dbcon.php";
session_start();
$loggeduser = $_SESSION["user_id"];
unset($_SESSION["user_id"]);
$loggeduser = null;
$pdoConnect = null;
session_destroy();

header('location: index.php');
exit;
?>