<?php

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dermazone";
    $port = "3306";
} else {
    $servername = "localhost";
    $username = "u709996704_dermazone";
    $password = "Dermazone@123";
    $database = "u709996704_dermazone";
    $port = "3306";    
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
