<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../services/emailHandler.php';
require_once __DIR__ . '/../services/generalFunction.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$emailHandler = new EmailHandler();

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



function handleOtpVerification($data, $con)
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
    unset($_SESSION['otp'], $_SESSION['otp_expires']);
    http_response_code(200);
    echo json_encode([
        "message" => "OTP verified successfully",
        "error" => false
    ]);
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

    // if (isset($_SESSION['isLogged_in']) && $_SESSION['isLogged_in']) {
    //     return true;
    // } else {
    //     return false;
    // }
}


function handleSignup($data, $conn)
{
    global $emailHandler;

    $name = $data['full_name'];
    $nationality = $data['nationality'];
    $email = $data['email'];
    $phone = $data['phone'];
    $country = $data['country'];
    $city = $data['city'];
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
        try {
            date_default_timezone_set('Asia/Kathmandu');
            $otp = generateOtp();
            $refCode = generateRefCode();
            $otp_expires = time() + (5 * 60);
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_expires'] = $otp_expires;
            $emailHandler->sendOTP(
                $email,
                $name,
                $otp,
                $otp_expires,
                $refCode
            );

            echo json_encode([
                "success" => true,
                "message" => "OTP Sent Successfully",
                "expiresOn" => $otp_expires,
                "requestId" => $refCode,
                "email" => $email,
                "status" => 200,
            ]);

            $_SESSION['pending_signup'] = [
                'full_name' => $data['full_name'],
                'nationality' => $nationality,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country' => $country,
                'city' => $city,
                'password' => $password
            ];
        } catch (Exception $e) {
            echo json_encode([
                "error" => true,
                "message" => "Failed to send OTP: " . $e->getMessage(),
                "status" => 500,
            ]);
        }

    }
}



//         $sql = "INSERT INTO users (name,email,nationality,country,city,phone,password,profile_image,role) values(
//     '$name',
//     '$email',
//     '$nationality',
//     '$country',
//     '$city',
//     '$phone',
//     '$password',
//     'assets/profiles/default.png',
//     'user'
// )";
//         $res = mysqli_query($conn, $sql);
//         if ($res) {
//             header("Content-Type: application/json");
//             echo json_encode([
//                 "success" => true,
//                 "message" => "Account Created successfully",
//                 "status" => 200,
//             ]);

//         } else {
//             echo json_encode([
//                 "error" => true,
//                 "message" => "Failed To Create An Account",
//                 "status" => 400,
//             ]);
//         }

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