<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);


$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();										
	$mail->Host	 = 'smtp.live.com';				
	$mail->SMTPAuth = true;							
	$mail->Username = 'uke_ind@live.in';				
	$mail->Password = 'Kingking@86';					
	$mail->SMTPSecure = 'ssl'; // Enable TLS encryption
	$mail->Port	 = 587;

	$mail->setFrom('info@dermazonesouth2023.com', 'Dernamzone South 2023');		
	$mail->addAddress('magadev110@gmail.com');

	
	$mail->isHTML(true);								
	$mail->Subject = 'Subject';
	$mail->Body = 'HTML message body in <b>bold</b> ';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
