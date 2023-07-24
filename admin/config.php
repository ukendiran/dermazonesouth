<?php
// Database connection

include_once '../config.php';

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


define('DB_HOST', $servername);
define('DB_USER', $username);
define('DB_PASS', $password);
define('DB_NAME', $dbname);

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});
