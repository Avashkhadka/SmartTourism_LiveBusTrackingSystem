<?php
header("Content-Type: application/json");
include '../config/conn.php';
include '../services/driver.php';
include '../services/user.php';
include '../services/admin.php';
include '../services/bus.php';
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
    $action = $_GET['action']??"";
    switch ($action) {
        case "get-driver-details":
            getDriverData($conn);
            break;

        case "actionOnDriver":
            actionOnDriver($conn);
            break;

        case "getdrivers":
            getDrivers($conn);
            break;

        case "getRoutes":
            getRoutes($conn);
            break;
        case "getbusrequests":
            getBusData($conn);
            break;
        
        case "manageBusAction":
            manageBus($conn);
            break;
        default:
            echo json_encode([
                "status" => 400,
                "message" => "Invalid action."
            ]);
            break;
    }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $action = $_POST['action'];
    switch ($action) {
        case "registerBus":
            handleBusRegistration($conn);
            break;
        
        case "saveRoute":
            handleRouteSave($conn);
            break;
            
        default:
            echo json_encode([
                "status" => 400,
                "message" => "Invalid action."
            ]);
            break;
    }

}