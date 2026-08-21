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
            handleDrSignIn($_POST, $conn);
            break;

        case "otp_verification":
            $otp_for = $_POST['otp_for'] ?? '';

            switch ($otp_for) {
                case "user_verification":
                    handleOtpUserVerification($_POST, $conn);
                    break;

                default:
                    echo json_encode([
                        "status" => 400,
                        "message" => "Invalid action."
                    ]);
                    break;
            }


            break;

        case "otp_verification":
           handleOtpVerification($_POST, $conn);
            break;

        case "otp_verification":
           handleOtpVerification($_POST, $conn);
            break;

        default:
            echo json_encode([
                "status" => 400,
                "message" => "Invalid action."
            ]);
            break;
    }
}