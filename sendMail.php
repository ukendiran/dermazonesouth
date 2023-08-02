<?php
$to = $_GET['to'];
$from = $_GET['from'];
$fromName = $_GET['name'];

$subject = "Dermazone South 2023 Payment Confirmation";

$htmlContent = '
<html>

<head>
    <title>Welcome to Dermazone South 2023</title>
</head>

<body>
    <h1>Thanks you for joining with us!</h1>
    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">
        <tr>
            <th>Name:</th>
            <td>Dermazone South 2023</td>
        </tr>
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th>
            <td>dermazonesouth2023@gmail.com</td>
        </tr>
        <tr>
            <th>Website:</th>
            <td><a href="http://www.dermazonesouth2023.com">https://dermazonesouth2023.com</a></td>
        </tr>
    </table>
</body>

</html>';

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
$headers .= 'Cc: ukendiran@gmail.com' . "\r\n";
$headers .= 'Bcc: ukendiran@gmail.com' . "\r\n";

// Send email
if (mail($to, $subject, $htmlContent, $headers)) {
    echo 'Email has sent successfully.';
} else {
    echo 'Email sending failed.';
}
