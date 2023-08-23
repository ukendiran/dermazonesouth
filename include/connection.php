<?php
include 'config.php';

$dotenv->load();

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $servername = $_ENV['LOCAL_SERVERNAME'];
    $username = $_ENV['LOCAL_USERNAME'];
    $password = $_ENV['LOCAL_PASSWORD'];
    $database = $_ENV['LOCAL_DBNAME'];
} else {
    $servername = $_ENV['REMOTE_SERVERNAME'];
    $username = $_ENV['REMOTE_USERNAME'];
    $password = $_ENV['REMOTE_PASSWORD'];
    $database = $_ENV['REMOTE_DBNAME'];
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

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
