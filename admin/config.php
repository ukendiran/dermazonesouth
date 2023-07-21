<?php
// Database connection
if ($_SERVER['HTTP_HOST'] == "localhost") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dermazone";
    $port = "3306";
} else {
    $servername = "localhost";
    $username = "u709996704_dermazone";
    $password = "Dermazone@123";
    $database = "u709996704_dermazone";
    $port = "3306";
}

define('DB_HOST', $servername);
define('DB_USER', $username);
define('DB_PASS', $password);
define('DB_NAME', $dbname);

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});
