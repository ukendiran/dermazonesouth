<?php
// Database connection
$hostname = $_SERVER['HTTP_HOST'];
if ($hostname == "localhost") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dermazone";
} else {
    $servername = "u709996704_dermazone";
    $username = "u709996704_dermazone";
    $password = "Dermazone@123";
    $database = "u709996704_dermazone";
}

define('DB_HOST', $servername);
define('DB_USER', $username);
define('DB_PASS', $password);
define('DB_NAME', $dbname);

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});
