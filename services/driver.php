<?php
include 'generalFunction.php';
function handleDrSignIn($data, $files, $conn)
{
    $full_name = $data['full_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $license_number = $data['license_number'];
    $license_type = $data['license_type'];
    $license_issue_date = $data['license_issue_date'];
    $license_expiry_date = $data['license_expiry_date'];
    $issuing_office = $data['issuing_office'];
    $year_of_experience = $data['year_of_experience'];

    // $vechicle_number = $data['vechicle_number'];
    // $vechicle_type = $data['vechicle_type'];
    // $seat_capacity = $data['seat_capacity'];
    // $operating_city = $data['operating_city'];

    $id_front_photo = $files['id_front_photo'];
    $id_back_photo = $files['id_back_photo'];

    $license_front_photo = $files['license_front_photo'];
    $license_back_photo = $files['license_back_photo'];

    // $billbook_front_photo = $files['billbook_front_photo'];
    // $billbook_back_photo = $files['billbook_back_photo'];

    $idFront = uploadImage(
        $id_front_photo,
        "uploads/userData",
        $full_name,
        "id_front"
    );

    $idBack = uploadImage(
        $id_back_photo,
        "uploads/userData",
        $full_name,
        "id_back"
    );

    $licenseFront = uploadImage(
        $license_front_photo,
        "uploads/userData",
        $full_name,
        "license_front"
    );

    $licenseBack = uploadImage(
        $license_back_photo,
        "uploads/userData",
        $full_name,
        "license_back"
    );

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
            '$full_name',
            '$email',
            '$phone',
            'nepali',
            'Nepal',
            'Kathmandu',
            '$password',
            'uploads/profiles/default.png',
            'driver'
        )";

        $res = mysqli_query($conn, $sql);

        if (!$res) {
            http_response_code(500);

            echo json_encode([
                "error" => true,
                "message" => "Failed to create user.",
                "ermsg" => $res,
            ]);
        } else {

            $user_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO driver_documents(user_id,license_number,license_type,license_issue_date,license_expiry_date, issuing_office,year_of_experience,id_front_photo,id_back_photo,license_front_photo,license_back_photo) VALUES($user_id,'$license_number','$license_type','$license_issue_date','$license_expiry_date','$issuing_office','$year_of_experience','$idFront','$idBack','$licenseFront','$licenseBack')";


            $res = mysqli_query($conn, $sql);
            if (!$res) {
                http_response_code(500);

                echo json_encode([
                    "error" => true,
                    "message" => "Failed to create user.",
                    "ermsg" => mysqli_error($conn),
                ]);
                exit;
            }
            if($res){

                http_response_code(200);
                echo json_encode([
                    "success" => true,
                "message" => "Created",
                "ermsg" => $res,
                "sql" => $sql,
                ]);
                }else{
                    http_response_code(400);
                    echo json_encode([
                    "success" => true,
                    "message" => "Created",
                    "ermsg" =>  mysqli_error($conn),
                    "sql" => $sql,
                    ]);
                    
                }
            // if (!$res) {
            //     http_response_code(500);

            //     echo json_encode([
            //         "error" => true,
            //         "message" => "Driver details could not be saved.",
            //     ]);
            // } else {
            //     http_response_code(200);

            //     echo json_encode([
            //         "success" => true,
            //         "message" => "Driver registration completed successfully.",
            //     ]);
            // }
        }
    }
}