<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$publicPages = [
    "index.php",
    "sign-in.php",
    "sign-up.php",
    "driver-sign-up.php"
];

$driverPages = [
    "logout.php",
    "profile.php",
];
$customerPages = [
    "index.php",
    "logout.php",
    "discover.php",
    "live-map.php",
    "contribute.php",
    "booking.php",
    "profile.php",

];
$adminPages = [
    "logout.php",
    "profile.php",
];

if (isset($_SESSION['isLogged_in']) and $_SESSION['isLogged_in'] == true) {
    if ($_SESSION['role'] == "driver") {
        if (!in_array($currentPage, $driverPages)) {
            header("location: " . BASEURL . "/driverDashboard");
            exit;
        }
    } else if ($_SESSION['role'] == "user") {
        if (!in_array($currentPage, $customerPages)) {
            header("location: " . BASEURL);
            exit;
        }
    } else if ($_SESSION['role'] == "admin") {
        if (!in_array($currentPage, $adminPages)) {
            header("location: " . BASEURL . "/dashboard");
            exit;
        }
    } else {
        session_destroy();

        header("Location: " . BASEURL . "/pages/sign-in.php");
        exit;
    }

} else {
    if (!in_array($currentPage, $publicPages)) {
        header("location: " . BASEURL . "pages/sign-in.php");
    }

}

?>