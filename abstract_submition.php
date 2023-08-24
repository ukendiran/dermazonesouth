<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');


$data = array();
$tableData = array();
$result = array();
$result1 = array();
$id = '';
if (isset($_GET['id'])) {
    $id = decryptID($_GET['id'], $secretKey);

    if ($id !== 0) {
        $sql = "SELECT * FROM users WHERE id = '$id' AND payment_status = 'paid'";
        $result = $conn->query($sql);

        $tableData = $conn->query("SELECT *  FROM abstract_submition WHERE user_id = '$id'");

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
        } else {
            $_SESSION["login_error"] = "Please subscribe and come back";
            echo "<script> window.location.href = 'login.php' </script>";
        }
    } else {
        $_SESSION["login_error"] = "There is no registration on this membership number. Make sure the membership number you entered is correct.";
        // echo "<script> window.location.href = 'login.php' </script>";
    }
} else {
    // echo "<script> window.location.href = 'login.php' </script>";
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Abstract Submition</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Abstract Submition</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<?php if (isset($_GET['id'])) {  ?>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-12">
                    <h2 class="mb-4">
                        Dermazone South 2023 Abstract Submition</h2>
                    <?php $link = 'abstract_submition.php?id=' . $_GET['id']; ?>
                    <!-- <form action="<?= $link ?>" method="post"> -->
                    <div class="form-s1">

                        <!-- <form id="abstract-form" method="post" action="<?= $link ?>"> -->
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p> IADVL Number : <?= (isset($data['membership_no'])) ? $data['membership_no'] : '' ?></p>
                                <p> Registration Type : <?= (isset($data['member_type'])) ? $data['member_type'] : '' ?></p>

                                <p> Name : <?= (isset($data['first_name'])) ? $data['first_name'] : '' ?> <?= (isset($data['last_name'])) ? $data['last_name'] : '' ?></p>
                                <p> Medical Council No : <?= (isset($data['registration_no'])) ? $data['registration_no'] : '' ?></p>
                                <p> Medical Council State : <?= (isset($data['council_state'])) ? $data['council_state'] : '' ?></p>
                            </div>
                            <div class="col-sm-6">
                                <p> Email : <?= (isset($data['email'])) ? $data['email'] : '' ?></p>
                                <p> Mobile : <?= (isset($data['mobile'])) ? $data['mobile'] : '' ?></p>

                                <p> Address :
                                    <span><?= (isset($data['address_line1'])) ? $data['address_line1'] : '' ?></span>
                                    <span><?= (isset($data['address_line2'])) ? $data['address_line2'] : '' ?></span>
                                    <span><?= (isset($data['pincode'])) ? $data['pincode'] : '' ?></span>
                                    <span><?= (isset($data['city'])) ? $data['city'] : '' ?></span>
                                    <span><?= (isset($data['state'])) ? $data['state'] : '' ?></span>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p> Payment Mode : Online</p>
                                <p> Amount Paid : <?= (isset($data['amount'])) ? $data['amount'] : '' ?></p>
                            </div>
                            <div class="col-sm-12">
                                <h3>Upload Files</h3>
                                <!-- Progress bar -->
                                <div class="progress mt-10">
                                    <div class="progress-bar"></div>
                                </div>


                                <form id="uploadForm" enctype="multipart/form-data" class=" mt-10">
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" id="id" />
                                    <input type="file" name="file" id="fileInput" accept=".pdf,.xls,.xlsx" require>
                                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary" />
                                </form>
                            </div>


                        </div>

                        <?php


                        if ($tableData->num_rows > 0) {    ?>
                            <div class="form-group row mt-10">
                                <h3>File List</h3>
                                <table class="table table-borderd" id="table">
                                    <thead>
                                        <tr>
                                            <td>S.No</td>
                                            <td>File Name</td>
                                            <td>File Type</td>
                                            <td>Created Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = $tableData->fetch_assoc()) {
                                        $file = explode('.', $row['filename']);
                                        echo '<tr>';
                                        echo '<td>' . $count++ . '</td>';
                                        echo '<td>' . $file[0] . '</td>';
                                        echo '<td>' . $file[1] . '</td>';
                                        echo '<td>' . $row['created_at'] . '</td>';
                                        echo '<tr>';
                                    }
                                    ?>
                                    </thead>
                                </table>
                            </div>
                        <?php } ?>
                        <!-- </form> -->

                        <div class="member-auto-fill" style="text-align: center;">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>" id="id" />
                            <button id="btn-abstract-submition" type="button" 
                            class="btn btn-dark submit-btn mt-3 text-center" name="abstract-submition" 
                            data-url="<?= $base_url ?>email.php" 
                            data-base_url="<?= $base_url ?>" 
                            data-redirect-url="<?= $link ?>">Abstract Submition </button>
                            <input type="hidden" name="amount" value="<?= (isset($data['amount'])) ? $data['amount'] : '' ?>" />
                        </div>

                        <div id="result"></div>

                    </div>
                    <!-- </form> -->

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php } ?>



<?php include_once 'include/footer.php'; ?>