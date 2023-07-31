<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_no = $_POST['membership_no'];
    $data = array();
    $sql = "SELECT * FROM users WHERE membership_no = '$membership_no'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      
        if ($row['payment_status'] == 'paid') {
            $id = $row['id'];
            $encryptedID = encryptID($id, $secretKey);
            $data = array(
                'result' => $row,
                'status' => 2,
                'msg' => 'Unpaid',
                'encryptedID' => $encryptedID,
            );

?>
            <script>
                window.location.href = "abstract_submition.php?id=<?= $encryptedID; ?>"
            </script>';
<?php
        } else {
            $_SESSION["login_error"] = "Please subscribe and  come back";
        }
    } else {
        $_SESSION["login_error"] = "There is no registration on this membership number. Make sure the membership number you entered is correct.";
    }
}

?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Abstract</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Abstract Submission</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- About Start -->

<div class="container-xxl py-1">
    <div class="container">
        <div class="row justify-content-center text-center" id="regform">
            <div class="col-md-9">
                <h2 class="mb-4">Registered members login</h2>
                <form action="login.php" method="POST">
                    <div class="form-s1">
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6"> <label class="small">IADVL Number</label>
                                <!-- <input data-url="<?php echo $base_url; ?>check.php" type="text" class="form-control registration-mem-no" id="membership_no" name="membership_no" placeholder="Enter IADVL Number"> -->
                                <input type="text" class="form-control registration-mem-no" id="membership_no" name="membership_no" placeholder="Enter IADVL Number" required>

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
                        <button type="submit" class="btn btn-dark mt-3 px-4" id="btn-submit">Proceed</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<?php include_once 'include/footer.php'; ?>