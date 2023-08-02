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
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("../img/slider/banner-auroville-globe.jpg") center/cover no-repeat;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        .login-container h1 {
            text-align: center;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .login-container p {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="login-container">
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
                <label for="username" class="form-label text-white text-left">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
                <p><a href="../" class="text-center">Dermazone South 2023</a></p>
            </div>
        </form>

    </div>

       

    <!-- Add Bootstrap JS via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>