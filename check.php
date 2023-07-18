<?php
include_once('./include/connection.php');
// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_no = $_POST["membership_no"];

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE membership_no = '$membership_no'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Suppose you have an ID you want to encrypt
        $idToEncrypt = $row['id'];
        $encryptedID = encryptID($idToEncrypt, $yourSecretKey);
        $data = array(
            'result' => $row,
            'status' => 1,
            'msg' => 'Success',
            'encryptedID' => $encryptedID,
        );
    } else {
        $data = array(
            'result' => [],
            'status' => 0,
            'msg' => 'Invalid',
        );
    }
    echo json_encode($data);
}

$conn->close();
