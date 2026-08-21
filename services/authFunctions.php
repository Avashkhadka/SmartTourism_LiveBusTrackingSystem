<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../services/generalFunction.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


function getUser($field, $value, $conn)
{
    $allowed = ['email', 'phone'];
    if (!in_array($field, $allowed)) {
        return [];
    }

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE $field=?"
    );

    $stmt->bind_param("s", $value);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_all(MYSQLI_ASSOC);
}



function handleOtpUserVerification($data, $conn)
{
    $submittedOtp = $data['otp_code'] ?? '';
    $sessionOtp = $_SESSION['otp'] ?? null;
    $expiresAt = $_SESSION['otp_expires'] ?? null;

    // Check whether OTP exists
    if ($sessionOtp === null || $expiresAt === null) {
        http_response_code(400);
        echo json_encode([
            "message" => "OTP not found or session expired",
            "error" => true
        ]);
        return;
    }

    // Check expiry
    if (time() > $expiresAt) {
        unset($_SESSION['otp'], $_SESSION['otp_expires']);
        http_response_code(400);
        echo json_encode([
            "message" => "OTP expired",
            "error" => true
        ]);
        return;
    }

    // Check OTP
    if ((string) $submittedOtp !== (string) $sessionOtp) {
        http_response_code(400);
        echo json_encode([
            "message" => "Invalid OTP",
            "error" => true
        ]);
        return;
    }

    // OTP is correct
    $signup = $_SESSION['pending_signup'];
    $status = [];
    if ($signup['role'] == "user") {
        $status = process_pending_user($conn, $signup);
    } else if ($signup['role'] == "driver") {
        $status = process_pending_driver($conn, $signup);
    }


    unset($_SESSION['otp'], $_SESSION['otp_expires']);
    respondJson($status['status'], $status['message']);

    // echo json_encode([
    // "message" => "OTP verified successfully",
    // "error" => false,
    // ]);
}

function process_pending_user($conn, $signup)
{

    $name = $signup['full_name'];
    $nationality = $signup['nationality'];
    $email = $signup['email'];
    $phone = $signup['phone'];
    $country = $signup['country'];
    $city = $signup['city'];
    $password = $signup['password'];
    $role = $signup['role'];

    $sql = "INSERT INTO users 
        (name, email, nationality, country, city, phone, password, profile_image, role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    $profileImage = 'assets/profiles/default.png';

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssss",
        $name,
        $email,
        $nationality,
        $country,
        $city,
        $phone,
        $password,
        $profileImage,
        $role
    );

    $res = mysqli_stmt_execute($stmt);

    if ($res) {

        // Remove temporary signup data after successful account creation
        unset($_SESSION['pending_signup']);

        return [
            "error" => false,
            "message" => "Account Created successfully",
            "status" => 200
        ];

    } else {

        return [
            "error" => true,
            "message" => "Failed To Create An Account",
            "status" => 400
        ];
    }
}

function checkLogin($jwt)
{
    try {

        $key = JWTSECRETKEY;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        return $decoded;
    } catch (Exception $e) {
        json_encode(['error' => $e->getMessage()]);
    }

}

function handleDrSignIn($data, $conn)
{
    $name = $data['full_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    if (count(getUser("email", $email, $conn)) > 0) {
        http_response_code(409);
        echo json_encode([
            "error" => true,
            "message" => "Account already exists",
            "data" => $data,
        ]);
    } else if (count(getUser("phone", $phone, $conn)) > 0) {
        http_response_code(409);
        echo json_encode([
            "error" => true,
            "message" => "No Duplicate Phone Number Allowed",
        ]);
    } else {
        $status = otpMailer($email, $name);
        if ($status['status']) {
            $data['password'] = $password;
            $data['role'] = 'driver';
            $_SESSION['pending_signup'] = $data;
        }

        respondJson($status['status'], $status['message'], $status);
    }

}

function handleSignup($data, $conn)
{

    $name = $data['full_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);


    if (count(getUser("email", $email, $conn)) > 0) {
        echo json_encode([
            "error" => true,
            "message" => "Account already exists",
            "status" => 409,
            "data" => $data,
        ]);
    } else if (count(getUser("phone", $phone, $conn)) > 0) {
        echo json_encode([
            "error" => true,
            "message" => "No Duplicate Phone Number Allowed",
            "status" => 409,
        ]);
    } else {
        $status = otpMailer($email, $name);
        if ($status['status']) {

            $data['role'] = "user";
            $data['password'] = $password;
            $_SESSION['pending_signup'] = $data;
        }

        respondJson($status['status'], $status['message'], $status);

    }
}

function handleSignIn($data, $conn)
{
    $email = $data['email'];
    $password = $data['password'];
    $info = getUser("email", $email, $conn);
    if (count($info) == 1) {
        if (password_verify($password, $info[0]['password'])) {
            $_SESSION['isLogged_in'] = true;
            $_SESSION['user_id'] = $info[0]['user_id'];
            $_SESSION['user_name'] = $info[0]['name'];
            $_SESSION['user_email'] = $info[0]['email'];
            $_SESSION['role'] = $info[0]['role'];
            $_SESSION['profile_image'] = $info[0]['profile_image'];



            $key = JWTSECRETKEY;
            $payload = [
                "user_id" => $info[0]['user_id'],
                "role" => $info[0]['role'],
                "email" => $info[0]['email'],
                "iat" => time(),              // Issued at
                "exp" => time() + 3600 * 12        // Expires in 12 hour
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            echo json_encode(["success" => true, "message" => "Login Successful", "status" => 200, "jwt_code" => $jwt]);
        } else {
            echo json_encode(["error" => true, "message" => "Incorrect Password", "status" => 400,]);
        }
    } else {
        echo json_encode(["error" => true, "message" => "No user found. Please try again", "status" => 400,]);
    }
}