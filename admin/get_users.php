<?php
// get_users.php

require_once 'config.php';
$user = new User();

// Process search parameter sent by DataTables
$searchValue = $_GET['search']['value'];

// Start from the first record (page 1 if not provided)
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
// Number of records to fetch per page
$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
// Total number of records in the users table
$totalRecords = $user->getTotalUsersCount();


// Fetch user data for the current page
$users = $user->getUsersByFilter($start, $length, $searchValue);

// Prepare data for DataTables response
$response = array(
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $users
);

echo json_encode($response);
