<?php

if ($_SERVER['HTTP_HOST'] == "localhost:8000") {
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


// Example usage
$secretKey = "dermazone"; // Replace this with your secret key

// Function to encrypt the ID
function encryptID($id, $key)
{
    $keyInt = intval(crc32($key)); // Convert the key to an integer value
    $encrypted = base64_encode($id ^ $keyInt);
    return $encrypted;
}

// Function to decrypt the encrypted ID
function decryptID($encryptedID, $key)
{
    $keyInt = intval(crc32($key)); // Convert the key to an integer value
    $decrypted = base64_decode($encryptedID);
    if (is_numeric($decrypted))
        $id = $decrypted ^ $keyInt;
    else
        $id = 0;
    return $id;
}
