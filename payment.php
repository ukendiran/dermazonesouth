<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');
include_once './config.php';
$dotenv->load();

$amount = 0;
$id = 0;
$orderMaxId = 1;
$max_id = 0;
$orderID = 1;
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $membership_no = $_POST['membership_no'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];
    $registration_no = $_POST['registration_no'];
    $council_state = $_POST['council_state'];
    $workshop = $_POST['workshop'];
    $food = $_POST['food'];
    $co_delegates = $_POST['co_delegates'];
    $institution = $_POST['institution'];
    $member_type = $_POST['member_type'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    $today = strtotime(date('Y-m-d'));
    // $today = strtotime(date('2023-08-16'));
    $earlyBird  = strtotime('2023-08-15');
    $regular  = strtotime('2023-09-15');
    $sport  = strtotime('2023-09-16');

    $member_amount  = 0;
    $person_amount = 0;
    $workshop_amount = 0;
    $amount = 0;

    if ($today <= $earlyBird) {
        if ($member_type == "IADVL_MEMBER") {
            $member_amount = 7000;
        } else {
            $member_amount = 5000;
        }

        $person_amount = $co_delegates * 5000;
        if ($workshop == 'None')
            $workshop_amount = 0;
        else
            $workshop_amount = 2000;
    }

    if ($today > $earlyBird && $today <= $sport) {
        if ($member_type == "IADVL_MEMBER") {
            $member_amount = 8200;
        } else {
            $member_amount = 5300;
        }

        $person_amount = $co_delegates * 6000;
        if ($workshop == 'None')
            $workshop_amount = 0;
        else
            $workshop_amount = 2500;
    }

    if ($today >= $sport) {
        if ($member_type == "IADVL_MEMBER") {
            $member_amount = 11000;
        } else {
            $member_amount = 8000;
        }
        $person_amount = $co_delegates * 7000;
        if ($workshop == 'None')
            $workshop_amount = 0;
        else
            $workshop_amount = 3000;
    }

    $amount = $member_amount + $person_amount + $workshop_amount;
    $orderMaxId = 1;
    $sql = "SELECT MAX(id) as id FROM orders";
    $orderResult = $conn->query($sql);
    if ($orderResult->num_rows > 0) {
        $row = $orderResult->fetch_assoc();
        $orderMaxId = $row['id'] + 1;
    }

    $sql = "UPDATE users "
        . " SET  membership_no = '$membership_no', first_name = '$first_name', last_name = '$last_name',"
        . "email = '$email', mobile = '$mobile', registration_no = '$registration_no', council_state = '$council_state', age = $age,"
        . "workshop = '$workshop', food = '$food', co_delegates	 = '$co_delegates	', institution = '$institution',"
        . "member_type = '$member_type', designation = '$designation', gender	 = '$gender', address_line1 = '$address_line1',"
        . "address_line2 = '$address_line2', pincode = '$pincode', city	 = '$city', state = '$state', "
        . "member_amount = $member_amount, person_amount = $person_amount, workshop_amount = $workshop_amount , "
        . "amount = $amount, order_id = $orderMaxId"
        . " WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
    } else {
        // echo '<script> window.location.href = "login.php" </script>';
    }
}

if (isset($_POST['submit'])) {
    include('Crypto.php');
    error_reporting(0);
    $merchant_data = '';
    $working_key = $_ENV['WORKING_KEY'];
    $access_code = $_ENV['ACCESS_KEY'];

    foreach ($_POST as $key => $value) {
        $merchant_data .= $key . '=' . $value . '&';
    }
    $encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.

?>
    <form method="post" name="redirect" action="<?= $_ENV['CCAVENU_URL']; ?>">
        <?php
        echo "<input type=hidden name=encRequest value=$encrypted_data>";
        echo "<input type=hidden name=access_code value=$access_code>";
        ?>
    </form>

    <script language='javascript'>
        document.redirect.submit();
    </script>

<?php

}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" _POST-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Payment</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-2">
            <h2 class="mb-4 text-center"> Dermazone South 2023 Payment</h2>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-body">
                        <div class="form-s1">
                            <form id="payment-form" method="post" action="payment.php">
                                <div class="form-group">
                                    <div>
                                        <label class="small">IADVL Number</label>
                                        <input type="text" readonly value="<?= (isset($_POST['membership_no'])) ? $_POST['membership_no'] : '' ?>" class="form-control member-no" name="membership_no" required="" minlength="6" maxlength="20" placeholder="Enter IADVL Number">
                                    </div>
                                    <div>
                                        <?php

                                        $name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
                                        $name .= isset($_POST['last_name']) ? " " . $_POST['last_name'] : '';

                                        ?>
                                        <label class="small">Full Name</label>
                                        <input type="text" readonly value="<?= $name ?>" class="form-control name" name="name">
                                    </div>
                                    <div>
                                        <label class="small">Amount</label>
                                        <input type="text" id="amount" readonly value="<?= $amount ?>" class="form-control amount" name="amount" required="">
                                    </div>
                                    <div class=" mt-3  member-auto-fill"> <label>Payment Type</label>
                                        <select class="form-control payment_type" required="" name="payment_type">
                                            <option value="" <?= (isset($_POST['payment_type']) && $_POST['payment_type']  == "") ? 'selected' : '' ?>>Select</option>
                                            <option value="hdfc" <?= (isset($_POST['payment_type']) && $_POST['payment_type'] == "HDFC BANK") ? 'selected' : '' ?>>HDFC BANK</option>
                                            <option value="razor-pay" <?= (isset($_POST['payment_type']) && $_POST['payment_type'] == "RAZOR PAY") ? 'selected' : '' ?>>RAZOR PAY</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="tid" id="tid">
                                    <input type="hidden" name="merchant_id" value="2701346">
                                    <input type="hidden" name="language" value="EN">
                                    <input type="hidden" name="order_id" value="<?= $orderMaxId ?>">
                                    <input type="hidden" name="currency" value="INR">
                                    <input type="hidden" name="redirect_url" value="<?= $base_url; ?>payment-response.php?id=<?= $id ?>">
                                    <input type="hidden" name="cancel_url" value="<?= $base_url; ?>payment-response.php?id=<?= $id ?>">
                                </div>

                                <button name="submit" type="submit" class="btn btn-dark  mt-3 px-4" id="pay-btn">Pay</button>
                                <input type="hidden" name="id" value="<?= $id ?>" />
                                <button onclick="history.back()" class="btn btn-secondary mt-3 px-4" id="cancel-btn">Cancel</button>

                                <div id="message"></div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>