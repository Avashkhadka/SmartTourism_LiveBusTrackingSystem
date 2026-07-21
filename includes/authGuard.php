<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$publicPages = [
    "index.php",
    "sign-in.php",
    "sign-up.php",
    "driver-sign-up.php"
];
if (isset($_SESSION['isLogged_in']) and $_SESSION['isLogged_in'] == true) {
    if (in_array($currentPage,["sign-in.php", "sign-up.php", "driver-sign-up.php"])) {
        header("location: " . BASEURL);
    }
} else {
    if (!in_array($currentPage,$publicPages)) {
        header("location: " . BASEURL . "pages/sign-in.php");
    }

}

?>`