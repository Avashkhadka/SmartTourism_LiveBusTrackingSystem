<?php
session_start();
include '../config/constants.php';
$_SESSION = [];
session_destroy();

header("location: " . BASEURL . "pages/sign-in.php");

?>