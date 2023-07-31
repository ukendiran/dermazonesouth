<?php
include_once('./include/connection.php');
$upload = json_encode(array('msg' => 'err'));
if (!empty($_FILES['file'])) {

    // File upload configuration 
    $targetDir = "uploads/";
    $allowTypes = array('pdf', 'doc', 'docx', 'xlx', 'xlxs');

    $fileName = strtotime("now") . "-" . basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;

    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Upload file to the server 
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        // $filename = $_FILES['file']['name'];
        $upload = 'ok';
        $encryptedID = $_POST['id'];
        $id = decryptID($encryptedID, $secretKey);
        $sql = "INSERT INTO abstract_submition (user_id, filename) VALUES ( $id, '$fileName')";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
echo json_encode(array('msg' => $upload, 'id' => $encryptedID));
