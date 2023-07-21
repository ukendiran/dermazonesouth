<?php
// get_users.php


require_once 'config.php';

$user = new User();
$users = $user->getUserById();

// Replace the database credentials with your actual values
$host = 'localhost';
$username = 'your_db_username';
$password = 'your_db_password';
$dbname = 'your_db_name';

$user = new User($host, $username, $password, $dbname);

// Start from the first record (page 1 if not provided)
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
// Number of records to fetch per page
$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
// Total number of records in the users table
$totalRecords = $user->getTotalUsersCount();

// Fetch user data for the current page
$users = $user->getUsers($start, $length);

// Prepare data for DataTables response
$response = array(
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $users
);

echo json_encode($response);
