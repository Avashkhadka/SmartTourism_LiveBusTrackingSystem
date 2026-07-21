<?php
header("Content-Type: application/json");
include '../config/conn.php';
include '../services/driver.php';
include '../services/user.php';
include '../services/admin.php';
include "../services/authFunctions.php";


$action = $_POST['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    switch ($action) {
        case "signup":
            handleSignup($_POST, $conn);
            break;

        case "login":
            handleSignIn($_POST, $conn);
            break;

        case "driverSignup":
            handleDrSignIn($_POST, $_FILES, $conn);
            break;

        default:
            echo json_encode([
                "status" => 400,
                "message" => "Invalid action."
            ]);
            break;
    }
}