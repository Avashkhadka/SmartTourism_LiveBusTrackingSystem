<?php
header("Content-Type: application/json");
include '../config/conn.php';
include "../services/authFunctions.php";

$reqUri = $_SERVER['REQUEST_URI'];
$path = parse_url($reqUri, PHP_URL_PATH);

$route = explode("/", trim($path, "/"));
$headers = getallheaders();

$reqPath = end($route);
$GLOBALS['headers'] = getallheaders();

if (!isset($headers['Authorization'])) {
    http_response_code(400);
    echo json_encode(["error" => "No Authorization Code send"]);
    return;
}

switch ($reqPath) {
    case "getlocation":
        handleGetLocation($conn);
        break;
    default:
        http_response_code(400);
        echo json_encode(["error" => "use valid api end point"]);
        break;
}

function handleGetLocation($conn)
{
    $verifyUser = checkLogin($GLOBALS['headers']['Authorization']);
    if ($verifyUser) {
        $lim = 30;
        $offset = (int) isset($_GET['offset']) ? $_GET['offset'] - 1 : 0;
        $sql = "SELECT * from location where status != 'approved' limit $lim offset $offset ";
        $res = $conn->query($sql);
        $data = $res->fetch_all(MYSQLI_ASSOC);
        if ($res) {
            http_response_code(200);
            echo json_encode(["location" => $data]);
            return;
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Failed to fetch location"]);
            return;
        }
        // $sql = 
    } else {
        http_response_code(401);
        echo json_encode(["error" => "U dont have access to use the resource","b"=>$verifyUser]);
        return;
    }
}


?>