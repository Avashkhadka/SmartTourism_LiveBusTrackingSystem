<?php

createDB();

include 'conn.php';
if (!$conn) {
    die("connection error ..." . mysqli_connect_error());
} else {
    TableUser($conn);
    createAdmin($conn);
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
    $sql = "CREATE TABLE IF NOT EXISTS user 
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
    $pwh = password_hash("@Admin123",PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name,email,nationality,country,city,phone,password,profile_image,role) values('Admin','admin@gmail.com','Nepali','Nepal','Kathmandu','9841286400','$pwh','assets/profiles/admin.png','admin')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "<br> Admin Created Successfully!!! ";
    }
}

?>