<?php
// include 'authFunctions.php';



$GLOBALS['headers'] = getallheaders();

function process_pending_driver($conn, $signup)
{
    $name = $signup['full_name'];
    $email = $signup['email'];
    $phone = $signup['phone'];
    $country = $signup['country'];
    $city = $signup['city'];
    $nationality = $signup['nationality'];
    $password = $signup['password'];

    $license_number = $signup['license_number'];
    $license_type = $signup['license_type'];
    $license_issue_date = $signup['license_issue_date'];
    $license_expiry_date = $signup['license_expiry_date'];
    $issuing_office = $signup['issuing_office'];
    $year_of_experience = $signup['year_of_experience'];

    $role = $signup['role'];

    // $vechicle_number = $data['vechicle_number'];
    // $vechicle_type = $data['vechicle_type'];
    // $seat_capacity = $data['seat_capacity'];
    // $operating_city = $data['operating_city'];

    // $id_front_photo = $files['id_front_photo'];
    // $id_back_photo = $files['id_back_photo'];

    // $license_front_photo = $files['license_front_photo'];
    // $license_back_photo = $files['license_back_photo'];

    // $billbook_front_photo = $files['billbook_front_photo'];
    // $billbook_back_photo = $files['billbook_back_photo'];

    // $idFront = uploadImage(
    //     $id_front_photo,
    //     "uploads/userData",
    //     $full_name,
    //     "id_front"
    // );

    // $idBack = uploadImage(
    //     $id_back_photo,
    //     "uploads/userData",
    //     $full_name,
    //     "id_back"
    // );

    // $licenseFront = uploadImage(
    //     $license_front_photo,
    //     "uploads/userData",
    //     $full_name,
    //     "license_front"
    // );

    // $licenseBack = uploadImage(
    //     $license_back_photo,
    //     "uploads/userData",
    //     $full_name,
    //     "license_back"
    // );

    // $billFront = uploadImage(
    //     $billbook_front_photo,
    //     "uploads/busData",
    //     $full_name,
    //     "billbook_front"
    // );

    // $billBack = uploadImage(
    //     $billbook_back_photo,
    //     "uploads/busData",
    //     $full_name,
    //     "billbook_back"
    // );


    if (count(getUser("email", $email, $conn)) > 0) {
        return [
            "message" => "Account already exists",
            "status" => 409
        ];
    } else if (count(getUser("phone", $phone, $conn)) > 0) {
        return [
            "message" => "No Duplicate Phone Number Allowed",
            "status" => 409
        ];
    } else {
        $sql = "INSERT INTO users(
            name,
            email,
            phone,
            nationality,
            country,
            city,
            password,
            profile_image,
            role
        ) VALUES(
            '$name',
            '$email',
            '$phone',
            '$nationality',
            '$country',
            '$city',
            '$password',
            'uploads/profiles/default.png',
            '$role'
        )";

        $res = mysqli_query($conn, $sql);

        if (!$res) {
            http_response_code(500);

            return [
                "message" => "Failed to create user.",
                "status"=>500
            ];
        } else {
            $user_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO driver_documents(user_id,license_number,license_type,license_issue_date,license_expiry_date, issuing_office,year_of_experience) VALUES($user_id,'$license_number','$license_type','$license_issue_date','$license_expiry_date','$issuing_office','$year_of_experience')";

            $res = mysqli_query($conn, $sql);
            if (!$res) {

                return [
                    "message" => "Driver details could not be saved.",
                    "status" => 500
                ];
            } else {
                return [
                    "message" => "Driver registration completed successfully",
                    "status" => 200
                ];
            }
        }
    }
}


function getDriverData($conn)
{
    try {
        $verifyUser = checkLogin($GLOBALS['headers']['Authorization']);
        if ($verifyUser) {
            http_response_code(200);
            echo json_encode([
                "id" => $verifyUser->user_id
            ]);
        } else {

            http_response_code(401);
            echo json_encode(["error" => "U dont have access to use the resource", "b" => $verifyUser]);
            return;
        }
    } catch (err) {
        http_response_code(400);
        echo json_encode(["error" => "Something went wrong"]);

    }

}