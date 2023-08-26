<?php
// get_users.php

require_once 'config.php';
$user = new User();

// Fetch user data for the current page
$users = $user->getDashboard();

return $users;
