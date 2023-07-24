<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
require_once 'config.php';
$baseurl = 'http://' . $_SERVER['HTTP_HOST'] . '/dev/';
$adminurl = 'http://' . $_SERVER['HTTP_HOST'] . '/dev/admin/';
$user = new User();
// $users = $user->getUserById();
$users = array();
session_start();
// Check if a user session exists (user is logged in)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or home page
    $_SESSION['login_error'] = "Session Expired. Please Login Again";
    header("Location: index.php");
    exit();
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Dermazone Dashboard</title>
    <!-- Add Bootstrap CSS via CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add DataTables CSS via CDN link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- Add DataTables Buttons CSS via CDN link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <style>
        body {
            padding-top: 60px;
            /* Adjust this value to match your fixed header height */
            padding-bottom: 40px;
            /* Adjust this value to match your fixed footer height */
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f5f5f5;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include_once './includes/navbar.php'; ?>