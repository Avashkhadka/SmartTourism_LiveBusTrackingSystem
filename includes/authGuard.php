<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$publicPages = [
    "index.php",
    "sign-in.php",
    "sign-up.php",
    "driver-sign-up.php",

];

$driverPages = [
    "logout.php",
    "profile.php",
    "dashboard.php",
];
$customerPages = [
    "index.php",
    "logout.php",
    "discover.php",
    "live-map.php",
    "contribute.php",
    "booking.php",
    "profile.php",
    "view-location.php",

];
$adminPages = [
    "logout.php",
    "profile.php",
    "dashboard.php",
];

if (isset($_SESSION['isLogged_in']) and $_SESSION['isLogged_in'] == true) {
    if ($_SESSION['role'] == "driver") {
        if (!in_array($currentPage, $driverPages)) {
            header("location: " . BASEURL . "pages/driver/dashboard.php");
            exit;
        }
    } else if ($_SESSION['role'] == "user") {
        if (!in_array($currentPage, $customerPages)) {
            header("location: " . BASEURL);
            exit;
        }
    } else if ($_SESSION['role'] == "admin") {
        if (!in_array($currentPage, $adminPages)) {
            header("location: " . BASEURL . "pages/admin/dashboard.php");
            exit;
        }
    } else {
        session_destroy();

        header("Location: " . BASEURL . "pages/global/sign-in.php");
        exit;
    }

} else {
    if (!in_array($currentPage, $publicPages)) {
        header("location: " . BASEURL . "pages/global/sign-in.php");
    }

}

?>