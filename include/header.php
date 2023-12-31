<!DOCTYPE html>
<html lang="en">
<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$activePage = basename($_SERVER['PHP_SELF'], ".php");
if ($_SERVER['HTTP_HOST'] == "localhost") {
    $base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
} else {
    $base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
}
?>

<head>
    <meta charset="utf-8">
    <title>DERMAZONE SOUTH 2023</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="DERMAZONE SOUTH 2023" name="keywords">
    <meta content="DERMAZONE SOUTH 2023" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->