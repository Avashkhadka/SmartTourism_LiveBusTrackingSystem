<?php

createDB();

include 'conn.php';
if (!$conn) {
    die("connection error ..." . mysqli_connect_error());
} else {
    TableUser($conn);
    createAdmin($conn);
    createDriverDocuments($conn);
    createBusTable($conn);
    createLocationTable($conn);
    populateInitialLocationData($conn);
}



function createDB()
{
    $conn = mysqli_connect("localhost", "root", "");
    $sql = "CREATE DATABASE IF NOT EXISTS stabns";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<br> Database Created Successfully!!! ";
    }

}

function TableUser($conn)
{
    $sql = "CREATE TABLE IF NOT EXISTS users 
            (
            user_id int PRIMARY KEY AUTO_INCREMENT,
            name varchar(255) not null,
            email varchar(255) not null unique,
            nationality varchar(255) not null,
            country varchar(255) not null,
            city varchar(255) not null,
            phone bigint unique not null,
            password varchar(255) not null,
            profile_image varchar(255) not null,
            role varchar(255) not null,
            created_at TIMESTAMP default current_timestamp
            );";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<br> User Table Created Successfully!!! ";
    }
}

function createAdmin($conn)
{
    $pwh = password_hash("@Admin123", PASSWORD_DEFAULT);

    $sql = "INSERT IGNORE INTO users (name,email,nationality,country,city,phone,password,profile_image,role) values('Admin','admin@gmail.com','Nepali','Nepal','Kathmandu','9841286400','$pwh','assets/profiles/admin.png','admin')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<br> Admin Created Successfully!!! ";
    }
}




function createDriverDocuments($conn)
{
    $sql = "CREATE TABLE  if not exists  driver_documents(

        document_id INT AUTO_INCREMENT PRIMARY KEY,

        user_id INT NOT NULL,
        license_number VARCHAR(100) NOT NULL UNIQUE,
        license_type VARCHAR(50) NOT NULL,
        license_issue_date DATE NOT NULL,
        license_expiry_date DATE NOT NULL,
        issuing_office VARCHAR(255) NOT NULL,
        year_of_experience INT NOT NULL,

        id_front_photo VARCHAR(255)  default Null,
        id_back_photo VARCHAR(255) default Null,
        id_status VARCHAR(255) DEFAULT 'pending', 

        license_front_photo VARCHAR(255) default Null,
        license_back_photo VARCHAR(255)  default Null,
        license_status VARCHAR(255) DEFAULT 'pending', 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )";


    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<br>Driver Documents Table Created Successfully!!!";
    } else {
        echo "<br>Error Creating Driver Documents Table: " . mysqli_error($conn);
    }
}

function createBusTable($conn)
{
    $sql = "CREATE TABLE if not exists bus (
        bus_id INT AUTO_INCREMENT PRIMARY KEY,

        user_id INT NULL,

        bus_number VARCHAR(50) NOT NULL UNIQUE,
        vehicle_type VARCHAR(100) NOT NULL,

        seat_capacity INT NOT NULL,

        registration_number VARCHAR(100) NOT NULL UNIQUE,
        registration_date DATE,

        insurance_number VARCHAR(100),
        insurance_expiry_date DATE,

        operating_city VARCHAR(100) NOT NULL,

        bus_image VARCHAR(255),
        billbook_front_photo VARCHAR(255) NOT NULL,
        billbook_back_photo VARCHAR(255) NOT NULL,
        status varchar(255) DEFAULT 'inactive',

        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

        
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<br>Bus Table Created Successfully!!!";
    } else {
        echo "<br>Error: " . mysqli_error($conn);
    }
}

function createLocationTable($conn)
{

    $sql = "CREATE TABLE if not exists location (
            location_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            latitude DECIMAL(10,8) NOT NULL,
            longitude DECIMAL(11,8) NOT NULL,
            category VARCHAR(50) NOT NULL,
            famous_for VARCHAR(255),
            image json,
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            created_by INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (created_by) REFERENCES users(user_id)
    )";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<br>Location Table Created Successfully!!!";
    } else {
        echo "<br>Error: " . mysqli_error($conn);
    }
}
function populateInitialLocationData($conn)
{

    $jsonPath = __DIR__ . "/../assets/data/InitialLocationData.json";
    if (!file_exists($jsonPath)) {
        die("locations.json not found.");
    }

    $locations = json_decode(file_get_contents($jsonPath), true);

    $count = 0;

    foreach ($locations as $loc) {

        $name = $conn->real_escape_string($loc['name']);
        $description = $conn->real_escape_string($loc['description']);
        $latitude = $loc['latitude'];
        $longitude = $loc['longitude'];
        $category = $conn->real_escape_string($loc['category']);
        $famous_for = $conn->real_escape_string($loc['famous_for']);
        $image = $conn->real_escape_string(json_encode($loc['image']));
        $status = $conn->real_escape_string($loc['status']);

        $sql = "INSERT INTO location
                (name, description, latitude, longitude, category, famous_for, image, status, created_by)
                VALUES (
                    '$name',
                    '$description',
                     $latitude,
                     $longitude,
                    '$category',
                    '$famous_for',
                    '$image',
                    '$status',
                    '1'
                )";

        if (mysqli_query($conn, $sql)) {
            $count++;
        } else {
            echo "Error: " . $conn->error . "<br>";
        }
    }
}


?>