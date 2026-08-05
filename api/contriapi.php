<?php
header("Content-Type: application/json");
include '../config/conn.php';
include "../services/authFunctions.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $placeName = $_POST['place_name'] ?? '';
    $shortPitch = $_POST['short_pitch'] ?? '';
    $placeCategory = $_POST['place_category'] ?? '';

    $latitude = $_POST['latitude'] ?? '';
    $longitude = $_POST['longitude'] ?? '';
    $cityRegion = $_POST['city_region'] ?? '';
    $nearestLandmark = $_POST['nearest_landmark'] ?? '';

    $openingHours = $_POST['opening_hours'] ?? '';
    $closingHours = $_POST['closing_hours'] ?? '';
    $bestTimeToVisit = $_POST['best_time_to_visit'] ?? '';
    $entryFee = $_POST['entry_fee'] ?? 0;
    $howToReach = $_POST['how_to_reach'] ?? '';

    $amenities = $_POST['amenities'] ?? [];
    $vibe = $_POST['vibe'] ?? [];

    $agreement = $_POST['contribute_aggrement'] ?? 0;

    $amenitiesJson = json_encode($amenities);
    $vibeJson = json_encode($vibe);

    $createdBy = $_SESSION['user_id'];

    $sql = "INSERT INTO location (
        place_name,
        short_pitch,
        place_category,
        latitude,
        longitude,
        city_region,
        nearest_landmark,
        opening_hours,
        closing_hours,
        best_time_to_visit,
        entry_fee,
        how_to_reach,
        amenities,
        vibe,
        contribute_aggrement,
        created_by
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssddsssssdsssii",
        $placeName,
        $shortPitch,
        $placeCategory,
        $latitude,
        $longitude,
        $cityRegion,
        $nearestLandmark,
        $openingHours,
        $closingHours,
        $bestTimeToVisit,
        $entryFee,
        $howToReach,
        $amenitiesJson,
        $vibeJson,
        $agreement,
        $createdBy
    );

    if (mysqli_stmt_execute($stmt)) {

        $locationId = mysqli_insert_id($conn);

        echo json_encode([
            "status" => 201,
            "message" => "Location Adding Request Sent successfully.",
            "location_id" => $locationId
        ]);

    } else {

        echo json_encode([
            "status" => 500,
            "message" => mysqli_error($conn)
        ]);
    }

    exit;


}