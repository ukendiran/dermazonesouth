<?php
require_once 'config.php';

$user = new Admin();
$users = $user->getAdmin();
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
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

    <!-- Content -->
    <div class="container-fluid mt-4">
        <h1 class="mb-4">Welcome to the Admin Dashboard</h1>
        <table id="user-table" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo '<a href="edit_admin_user.php?id=' . $user['id'] . '">Edit</a>'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container-fluid">
            <span class="text-white">Copyright &copy; <?php echo date('Y'); ?> Dermazone Dashboard</span>
        </div>
    </footer>

    <!-- Add jQuery via CDN link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add Popper.js via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Add Bootstrap JS via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Add DataTables JS via CDN link -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Add DataTables Buttons JS via CDN link -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-table').DataTable({
                dom: 'Bfrtip', // Show buttons in the table footer
                buttons: [
                    'excelHtml5' // Add Excel export button
                ]
            });
        });
    </script>
</body>

</html>