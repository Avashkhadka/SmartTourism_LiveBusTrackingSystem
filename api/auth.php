<?php
include '../config/conn.php';
include "../config/functions.php";

$data = json_decode(file_get_contents("php://input"), true);

$action = $data['action'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "signup") {
    handleSignup($data, $conn);
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "login") {
    handleSignIn($data,$conn);
}

?>