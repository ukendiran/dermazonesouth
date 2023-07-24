<?php include_once './includes/header.php'; ?>

<!-- Content -->

<div class="container">
    <div class="card">
        <div class="card-header"><h4>Registered User List</h4></div>
        <div class="card-body">
            <table id="user-table" class="table table-light table-striped ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IADVL Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['membership_no']; ?></td>
                            <td><?php echo $user['first_name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['mobile']; ?></td>
                            <td><?php //echo '<a href="edit_user.php?id=' . $user['id'] . '">Edit</a>'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include_once './includes/footer.php'; ?>