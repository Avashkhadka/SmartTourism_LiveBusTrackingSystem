<?php
require_once __DIR__ . '/../services/generalFunction.php';
function handleBusRegistration($conn)
{

    $imagePaths = [];
    mysqli_begin_transaction($conn);
    try {

        $user_id = $_SESSION['user_id'];
        $bus_number = htmlspecialchars($_POST['bus_number']);
        $bus_type = $_POST['bus_type'];
        $total_seats = $_POST['total_seats'];
        $bus_fare = $_POST['bus_fare'] > 5 ? $_POST['bus_fare'] : 5;
        $insurance_number = $_POST['insurance_number'];
        $bill_book_no = $_POST['bill_book_no'];
        $operating_route = $_POST['operating_route'];


        $sql = "SELECT * FROM bus where `bus_number` = '$bus_number'";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            respondJson(400, "Something went wrong", ["code" => $sql]);
        }
        if (mysqli_num_rows($res) > 0) {
            respondJson(409, "Bus with same number already exits.");
        }


        $fieldNames = ["busimg-0", "busimg-1", "busimg-2", "busimg-3", "busimg-4", "busimg-5"];
        $imagePaths = uploadImages("bus", $user_id, $bus_number, $fieldNames);


        if (!$bus_number || !$bus_type || !$total_seats || !$bus_fare || !$insurance_number || !$bill_book_no || !$operating_route) {
            respondJson(400, "Invalid Bus Data");
            return;
        }

        $imagePaths = json_encode($imagePaths);
        $stmt = mysqli_prepare($conn, "
        INSERT INTO bus(user_id, route_id,bus_number,vehicle_type, seat_capacity, bill_book_no,insurance_number,bus_image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

        mysqli_stmt_bind_param(
            $stmt,
            "iississs",
            $user_id,
            $operating_route,
            $bus_number,
            $bus_type,
            $total_seats,
            $bill_book_no,
            $insurance_number,
            $imagePaths
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception(mysqli_stmt_error($stmt));
        }


        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        respondJson(200, "Bus submitted for verification.", ["path" => $imagePaths]);

    } catch (Exception $e) {
        mysqli_rollback($conn);        // undoes insertLocation / updateLocationImages
        deleteUploadedFiles($imagePaths); // removes any files that already hit disk

        respondJson(500, $e->getMessage());
    }









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

function getRoutes($conn)
{
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!$authHeader) {
        respondJson(401, "Authorization required");
        exit;
    }
    $verifyUser = checkLogin($authHeader);
    if (!$verifyUser->role == "driver") {
        respondJson(401, "You dont have permission to Access available routes");
    }

    $sql = "SELECT * from route";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = $res->fetch_all(MYSQLI_ASSOC);
        respondJson(
            200,
            "Successifully fetched Route Data.",
            ["route" => $data]
        );
    } else {
        respondJson(400, mysqli_error($conn));
    }
}
function getBusData($conn)
{
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!$authHeader) {
        respondJson(401, "Authorization required");
        exit;
    }
    $verifyUser = checkLogin($authHeader);
    if ($verifyUser->role != "admin") {
        respondJson(401, "You dont have permission to Access bus requests");
        exit;
    }
    $sql = "SELECT b.*,u.name,u.email,u.phone,u.nationality,u.country,u.city,r.route_name,r.distance,r.total_stops,r.route_stops FROM bus b INNER JOIN users u ON b.user_id = u.user_id LEFT JOIN route r ON b.route_id = r.route_id WHERE b.status = 'PENDING' ORDER BY b.created_at DESC";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = $res->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$bus) {
            $bus["route_stops"] = json_decode($bus["route_stops"], true);
        }
        respondJson(200, "Successfully fetched Bus Data.", ["data" => $data]);
    } else {
        respondJson(400, mysqli_error($conn));
    }
}


function manageBus($conn)
{
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';

    if (!$authHeader) {
        respondJson(401, "Authorization required");
        exit;
    }

    $verifyUser = checkLogin($authHeader);
    if ($verifyUser->role != "admin") {
        respondJson(401, "You dont have permission to manage bus requests");
        exit;
    }

    $bus_id = $_GET['id'] ?? null;
    $mode = $_GET['mode'] ?? null;
    if (!$bus_id || !$mode) {
        respondJson(400, "Bus ID and mode are required");
        exit;
    }
    if (!in_array($mode, ["accept", "reject"])) {
        respondJson(400, "Invalid mode");
        exit;
    }

    $status = $mode === "accept" ? "approved" : "rejected";
    $stmt = mysqli_prepare($conn, "UPDATE bus SET status = ? WHERE bus_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $status, $bus_id);
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            respondJson(200, "Bus $status successfully");
        } else {
            respondJson(404, "Bus not found");
        }
    } else {
        respondJson(500, mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
}


function getBusByDriverId($conn)
{
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!$authHeader) {
        respondJson(401, "Authorization required");
        exit;
    }
    $verifyUser = checkLogin($authHeader);
    if ($verifyUser->role != "driver") {
        respondJson(401, "You dont have permission to Access bus requests");
        exit;
    }
    $user_id = $verifyUser->user_id;

    $sql = "SELECT b.*,u.name,u.email,u.phone,u.nationality,u.country,u.city,r.route_name,r.distance,r.total_stops,r.route_stops FROM bus b INNER JOIN users u ON b.user_id = u.user_id LEFT JOIN route r ON b.route_id = r.route_id where b.status ='approved' and b.user_id =$user_id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = $res->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$bus) {
            $bus["route_stops"] = json_decode($bus["route_stops"], true);
        }
        respondJson(200, "Successfully fetched Bus Data.", ["data" => $data]);
    } else {
        respondJson(400, mysqli_error($conn));
    }

}
function getActiveBusData($conn)
{
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    if (!$authHeader) {
        respondJson(401, "Authorization required");
        exit;
    }
    $verifyUser = checkLogin($authHeader);
    if ($verifyUser->role != "user") {
        respondJson(401, "You dont have permission to Access bus requests");
        exit;
    }
    $activeBusId = $_GET['activeBusId'];

    $sql = "SELECT b.*,u.name,u.email,u.phone,u.nationality,u.country,u.city,r.route_name,r.distance,r.total_stops,r.route_stops FROM bus b INNER JOIN users u ON b.user_id = u.user_id LEFT JOIN route r ON b.route_id = r.route_id where b.status ='approved' and b.bus_id in ($activeBusId)";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = $res->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$bus) {
            $bus["route_stops"] = json_decode($bus["route_stops"], true);
        }
        respondJson(200, "Successfully fetched Bus Data.", ["bus" => $data]);
    } else {
        respondJson(400, mysqli_error($conn));
    }
}
?>