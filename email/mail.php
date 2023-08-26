<?php

$subject = "Welcome to Dermazone South 2023 to be held at Puducherry - The Teaser";

$htmlContent = '<div style="text-align:center">
<img src="https://dermazonesouth2023.com/email/upload/new.jpg" width="600" style="text-align:center" />
</div>
';


// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: Dermazone South 2023<info@dermazonesouth2023.com>' . "\r\n";



use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once './src/SimpleXLSX.php';
if ($xlsx = SimpleXLSX::parse('data.xlsx')) {
    $data = $xlsx->rows();
    foreach ($data as $key => $row) {
        if ($key !== 0) {
            if ($row[4] != "--") {
                $email = $row[4];
                echo $email."</br>";
                
                // Send email
                // if (mail($email, $subject, $htmlContent, $headers)) {
                //     echo $email. ' - Email has sent successfully' . "</br>";
                    
                // } else {
                //     echo $email. ' - Email sending failed.' . "</br>";
                // }


                
            }
        }
    }
} else {
    echo SimpleXLSX::parseError();
}



