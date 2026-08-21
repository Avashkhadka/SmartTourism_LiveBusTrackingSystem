<?php
require_once __DIR__ . '/../services/emailHandler.php';
function uploadImage($file, $folder, $username, $name)
{
    // File extension
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // Generate filename
    $filename = strtolower(str_replace(" ", "_", $username));
    $filename .= "_" . $name . "." . $ext;
    $destination = realpath(__DIR__ . "/..") . "/" . $folder . "/" . $filename;
    $destinationdb = $folder . "/" . $filename;
    move_uploaded_file($file['tmp_name'], $destination);
    return $destinationdb;

}


function respondJson($statusCode, $message, $extra = [])
{
    http_response_code($statusCode);
    echo json_encode(array_merge([
        "status" => $statusCode,
        "message" => $message
    ], $extra));
    exit;
}

function generateOtp()
{
    return random_int(100000, 999999);
}

function generateRefCode($length = 8)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function otpMailer($email, $name)
{
    try {
        $emailHandler = new EmailHandler();
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

        return [
            "success" => true,
            "message" => "OTP Sent Successfully",
            "expiresOn" => $otp_expires,
            "requestId" => $refCode,
            "email" => $email,
            "status" => 200,
        ];

    } catch (Exception $e) {
        return [
            "success" => false,
            "message" => "Failed to send OTP: " . $e->getMessage(),
            "status" => 500,
        ];
    }
}
