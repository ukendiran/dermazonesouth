<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');

?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Registration</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Online Registration</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-1">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <h2 class="mb-4">Dermazone South 2023 Online Registration</h2>
                <form id="loginRegister" action="registration-submit.php" method="POST">
                    <div class="form-s1">
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <!-- <label class="">IADVL Number</label> -->
                                <!-- <input data-url="<?php echo $base_url; ?>check.php" type="text" class="form-control registration-mem-no" id="membership_no" name="membership_no" placeholder="Enter IADVL Number"> -->
                                <input type="text" class="form-control registration-mem-no" required id="membership_no" name="membership_no" placeholder="Enter IADVL Number">
                                <?php
                                if (isset($_SESSION["login_error"]) && $_SESSION["login_error"] != "") {
                                    $myMessage = addslashes($_SESSION["login_error"]);
                                    echo '<p id="membership_noError">' . $_SESSION["login_error"] . '</p>';
                                    unset($_SESSION["login_error"]);
                                }
                                ?>
                            </div>
                        </div>
                        <input type="hidden" name="encryptedID" id="encryptedID" />
                        <button name="proceed" type="submit" class="btn btn-dark mt-3 px-4" id="btn-submit">Proceed</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include_once 'include/fee.php'; ?>


<?php include_once 'include/footer.php'; ?>