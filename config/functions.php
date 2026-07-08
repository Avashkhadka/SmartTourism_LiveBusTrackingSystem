<?php
function getUser($Email, $conn)
{
    $sql = "SELECT * FROM user where email = '$Email'";
    $res = mysqli_query($conn, $sql);
    $data = [];
    if ($res) {

        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        return $data;
    }
}


function handleSignup($data, $conn)
{
    $user = $data['user_info'];
    $name = $user['fname'];
    $email = $user['email'];
    $phone = $user['phone'];
    $country = $user['country'];
    $city = $user['city'];
    $password = password_hash($user['password'], PASSWORD_DEFAULT);


    if (count(getUser($email, $conn)) > 0) {
        echo json_encode([
            "error" => true,
            "message" => "Account already exists",
            "status" => 409,
        ]);
    } else {
        $sql = "INSERT INTO user (name,email,country,city,phone,password,profile_image,role) values(
    '$name',
    '$email',
    '$country',
    '$city',
    '$phone',
    '$password',
    'assets/profiles/default.png',
    'user'
)";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Content-Type: application/json");
            echo json_encode([
                "success" => true,
                "message" => "Account Created successfully",
                "status" => 200,
            ]);

        }

    }

}