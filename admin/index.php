<?php
// login.php
require_once 'config.php';
$user = new Admin();
session_start();

// Check if a user session exists (user is logged in)
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or home page
    header("Location: dashboard.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users = $user->checkLogin($username, $password);
    
    if (count($users) > 0) {
        // Authentication successful, store user info in session
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $users[0]['id'];     
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed, redirect back to login form with error message
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: index.php");
        exit();
    }
}
?>




<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Add Bootstrap CSS via CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="col-4 offset-4">
            <h1>Login</h1>
            <form action="index.php" method="post">

                <?php
                // Display an error message if it exists
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
                    unset($_SESSION['login_error']); // Clear the error message after displaying it
                }
                ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </div>

            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>