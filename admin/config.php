<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dermazone";

define('DB_HOST', $servername);
define('DB_USER', $username);
define('DB_PASS', $password);
define('DB_NAME', $dbname);

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});
