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

function insertValue($conn, $table, $data)
{
    $columns = array_keys($data);
    $values = array_values($data);

    $columnList = implode(", ", $columns);
    $placeholders = implode(", ", array_fill(0, count($values), "?"));

    $sql = "INSERT INTO $table ($columnList) VALUES ($placeholders)";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }
    $types = "";

    foreach ($values as $value) {
        if (is_int($value)) {
            $types .= "i";
        } elseif (is_float($value)) {
            $types .= "d";
        } else {
            $types .= "s";
        }
    }

    mysqli_stmt_bind_param($stmt, $types, ...$values);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_stmt_error($stmt));
    }

    return mysqli_insert_id($conn);
}
function insertImages($conn, $table, $columns, $locationId, $imagePaths)
{
    if (empty($imagePaths)) {
        return true;
    }
    $columnList = implode(", ", $columns);
    $placeholders = implode(", ", array_fill(0, count($columns), "?"));
    $sql = "INSERT INTO $table ($columnList) VALUES ($placeholders)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }
    foreach ($imagePaths as $path) {
        $values = [$locationId, $path];
        $types = "";

        foreach ($values as $value) {
            $types .= is_int($value) ? "i" : "s";
        }
        $bindValues = [];
        foreach ($values as $key => &$value) {
            $bindValues[$key] = &$value;
        }

        mysqli_stmt_bind_param($stmt, $types, ...$bindValues);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception(mysqli_stmt_error($stmt));
        }
    }

    mysqli_stmt_close($stmt);
    return true;
}
function updateImages($conn, $table, $columns, $id, $imagePaths)
{
    if (empty($imagePaths)) {
        return true;
    }

    $set = [];
    foreach ($columns as $column) {
        $set[] = "$column = ?";
    }

    $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }

    $values = $imagePaths;
    $values[] = $id;
    $types = str_repeat("s", count($imagePaths)) . "i";

    $bindValues = [];
    foreach ($values as &$value) {
        $bindValues[] = &$value;
    }

    mysqli_stmt_bind_param($stmt, $types, ...$bindValues);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    return true;
}
function deleteUploadedFiles($imagePaths)
{
    foreach ($imagePaths as $path) {
        $fullPath = __DIR__ . '/' . $path;
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
function uploadImages($path, $Id, $data, $fieldNames)
{
    $image_without_space = implode("", explode(" ", $data));
    $uploadDir = __DIR__ . '/../uploads/' . $path . '/' . $image_without_space . "-" . $Id;

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            throw new Exception("Failed to create upload directory");
        }
    }

    $imagePaths = [];
    $fileWasSubmitted = false;

    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif'
    ];

    foreach ($fieldNames as $fieldName) {

        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            continue;
        }

        $fileWasSubmitted = true;

        if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpFile = $_FILES[$fieldName]['tmp_name'];
        $imageInfo = getimagesize($tmpFile);

        if ($imageInfo === false || !isset($allowedTypes[$imageInfo['mime']])) {
            continue;
        }

        $extension = $allowedTypes[$imageInfo['mime']];
        $fileName = $path . "_{$Id}_{$fieldName}_" . uniqid() . "." . $extension;
        $destination = $uploadDir . '/' . $fileName; // was missing the "/"

        if (!move_uploaded_file($tmpFile, $destination)) {
            continue;
        }


        $imagePaths[] = "uploads/" . $path . "/" . $image_without_space . "-" . $Id . "/" . $fileName;
    }


    if ($fileWasSubmitted && empty($imagePaths)) {
        throw new Exception("Image upload failed: none of the submitted images could be saved.");
    }

    return $imagePaths;
}
