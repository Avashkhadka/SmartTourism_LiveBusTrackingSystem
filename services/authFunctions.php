<?php
session_start();
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

function handleSignup($data, $conn)
{
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
        $sql = "INSERT INTO users (name,email,nationality,country,city,phone,password,profile_image,role) values(
    '$name',
    '$email',
    '$nationality',
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

        } else {
            echo json_encode([
                "error" => true,
                "message" => "Failed To Create An Account",
                "status" => 400,
            ]);
        }

    }

}
function handleSignIn($data, $conn)
{
    $email = $data['email'];
    $password = $data['password'];
    $info = getUser("email", $email, $conn);
    if (count($info) == 1) {
        if (password_verify($password, $info[0]['password'])) {
            echo json_encode(["success" => true, "message" => "Login Successful", "status" => 200,]);
            $_SESSION['isLogged_in'] = true;
            $_SESSION['user_id'] = $info[0]['user_id'];
            $_SESSION['user_name'] = $info[0]['name'];
            $_SESSION['role'] = $info[0]['role'];
            $_SESSION['profile_image'] = $info[0]['profile_image'];
        } else {
            echo json_encode(["error" => true, "message" => "Incorrect Password", "status" => 400,]);
        }
    } else {
        echo json_encode(["error" => true, "message" => "No user found. Please try again", "status" => 400,]);
    }
}