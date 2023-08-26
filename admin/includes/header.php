<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
require_once 'config.php';
$baseurl = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$adminurl = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/';
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
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,200" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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