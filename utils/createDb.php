<?php
include 'conn.php';

if (!$conn) {
    die("connection error ..." . mysqli_connect_error());
} else {
    createDB();
    TableUser($conn);
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
            email varchar(255) not null,
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

?>