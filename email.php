<?php
require 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.example.com', 587))
  ->setUsername('your_username')
  ->setPassword('your_password');

// Create the Mailer using the created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Test Email'))
  ->setFrom(['sender@example.com' => 'Sender Name'])
  ->setTo(['recipient@example.com' => 'Recipient Name'])
  ->setBody('This is a test email sent using SwiftMailer.');

// Send the message
$result = $mailer->send($message);

if ($result) {
    echo "Email sent successfully!";
} else {
    echo "Email could not be sent.";
}
