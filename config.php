<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

function generateUniqueID()
{
    // Generate a random number between 100000000 and 999999999
    $randomNumber = mt_rand(100000000, 999999999);

    // Get the current timestamp
    $timestamp = time();

    // Combine the random number and timestamp
    $uniqueID = $randomNumber . $timestamp;

    // Ensure the ID is exactly 9 digits by taking the last 9 characters
    $uniqueID = substr($uniqueID, -9);

    return $uniqueID;
}



