<?php
require_once __DIR__ . '/../services/generalFunction.php';
function handleBusRegistration($conn)
{

}

function handleRouteSave($conn)
{
    $routeName = $_POST["route_name"] ?? null;
    $distance = $_POST["distance"] ?? null;
    $totalStops = $_POST["total_stops"] ?? null;
    $routeStops = $_POST["route_stops"] ?? null;

    $routeStops = json_decode($routeStops, true);

    if (!$routeName || !$routeStops || count($routeStops) < 2) {
        respondJson(400, "Invalid Route Data");
        return;
    }

    $routeStops = json_encode($routeStops);

    $stmt = mysqli_prepare($conn, "
        INSERT INTO route(route_name, distance, total_stops, route_stops)
        VALUES (?, ?, ?, ?)
    ");

    mysqli_stmt_bind_param(
        $stmt,
        "sdis",
        $routeName,
        $distance,
        $totalStops,
        $routeStops
    );

    if (mysqli_stmt_execute($stmt)) {
        respondJson(200, "Route Saved Successfully");
    } else {
        respondJson(400, mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
}

?>