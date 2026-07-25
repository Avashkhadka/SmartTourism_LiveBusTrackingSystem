<?php
$host = "db";
$user = "student";
$password = "student123";
$database = "student_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Docker PHP App</title>

</head>

<body>

    <table>
        <tr>ID</tr>
        <tr>Name</tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td?>{$row['name']}</td></tr>";
        }
        ?>

    </table>

    <script>
        function showMessage() {
            alert("Hello from JavaScript!");
        }
    </script>
</body>