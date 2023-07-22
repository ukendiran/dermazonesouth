<?php include_once './includes/header.php'; ?>

<?php
require_once 'config.php';

$user = new User();
$id = $_GET['id'];
$users = $user->getUserById($id);
?>


<!-- Content -->
<div class="container mt-4">
    <h1 class="mb-4">Edit User</h1>
    <?php
    // PHP code to handle the form submission and database update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize data from the form
        $id = $_POST["id"];
        $name = $_POST["first_name"];
        $email = $_POST["email"];
        $updateData[] = "first_name='$name'";
        $updateData[] = "email='$email'";

        $result = $user->updateUser($updateData, $id);
        // Redirect back to the index.php page after the update
        header("Location: index.php");
        exit();
    }

    // Retrieve user data for editing from the database

    $user = $users[0]; // Replace this with the actual database query

    ?>
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $user['first_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $user['last_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Email</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $user['mobile']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="<?= $adminurl; ?>/index.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
<?php include_once './includes/footer.php'; ?>