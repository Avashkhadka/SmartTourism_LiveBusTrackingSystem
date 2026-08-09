<?php
session_start();
$_SESSION = [];
include '../../config/constants.php';
session_destroy();

header("location: " . BASEURL . "pages/global/sign-in.php");

?>