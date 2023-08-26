<?php



$to = "magadev110@gmail.com";
$from = "ukendiran@gmail.com";
$fromName = "ukendiran";

$subject = "Backup Email";

$htmlContent = "test";

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
    echo 'Email sending failed.';
}

?>