<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "dermazone";
$port = "3307";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $iadvl_no = $_POST["iadvl_no"];

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE iadvl_no = '$iadvl_no'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Invalid";
    }
}

$conn->close();
