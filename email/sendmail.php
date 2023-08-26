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

$lines = file('list.txt');

foreach($lines as $email) {
      // Send email
                if (mail($email, $subject, $htmlContent, $headers)) {
                    echo $email. ' - Email has sent successfully' . "</br>";
                    
                } else {
                    echo 'Email sending failed.';
                }

}

