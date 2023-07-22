<?php
// logout.php

session_start(); // Start or resume the session
// Check if a user session exists (user is logged in)
// Unset all session variables
$_SESSION = array();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
// Destroy the session
session_destroy();
// Redirect to the login page or any other page you desire after logout
header("Location: index.php");
exit();
