<?php
header("Content-Type: application/json");
include '../config/conn.php';
include '../services/driver.php';
include '../services/user.php';
include '../services/admin.php';
include "../services/authFunctions.php";


// if ($_SERVER['REQUEST_METHOD'] === "POST") {
//     $action = $_POST['action'] ?? '';

//     switch ($action) {
       
//         default:
//             echo json_encode([
//                 "status" => 400,
//                 "message" => "Invalid action."
//             ]);
//             break;
//     }
// }
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $action = $_GET['action'];
    switch ($action) {
        case "get-driver-details":
            getDriverData($conn);
            break;

        default:
            echo json_encode([
                "status" => 400,
                "message" => "Invalid action."
            ]);
            break;
    }
}