<?php
header("Content-Type: application/json");
include '../config/conn.php';
include "../services/authFunctions.php";

$reqUri = $_SERVER['REQUEST_URI'];
$path = parse_url($reqUri, PHP_URL_PATH);

$route = explode("/", trim($path, "/"));
$reqPath = end($route);

switch ($reqPath) {
    case "getlocation":
        handleGetLocation($reqPath);
        break;
    default:
        http_response_code(400);
        echo json_encode(["error" => "use valid api end point"]);
        break;
}

function handleGetLocation($reqPath)
{

    if (checkLogin()) {
        $lim = 10;
        $offset = substr($reqPath,-1);

        // $sql = 
    } else {
        http_response_code(409);
        echo json_encode(["error" => "U dont have access to use the resource"]);

    }
}


?>