<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');
include_once './config.php';
include('Crypto.php');
$dotenv->load();
$id =0;
$amount = 0;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>
    <script language='javascript'>
        document.location.href = "registration.php";
    </script>
    <?php
}
if (isset($_POST['update-registration'])) {
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
    $earlyBird  = strtotime('2023-08-31');
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
        if ($workshop == 'None') {
            $workshop_amount = 0;
        } else {
            $workshop_amount = 2000;
        }
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
        if ($workshop == 'None') {
            $workshop_amount = 0;
        } else {
            $workshop_amount = 3000;
        }
    }

    $amount = $member_amount + $person_amount + $workshop_amount;
 if($email == "ukendiran@gmail.com") $amount=10;
    $sql = "UPDATE users "
        . " SET  membership_no = '$membership_no', first_name = '$first_name', last_name = '$last_name',"
        . "email = '$email', mobile = '$mobile', registration_no = '$registration_no', council_state = '$council_state', age = $age,"
        . "workshop = '$workshop', food = '$food', co_delegates	 = '$co_delegates', institution = '$institution',"
        . "member_type = '$member_type', designation = '$designation', gender = '$gender', address_line1 = '$address_line1',"
        . "address_line2 = '$address_line2', pincode = '$pincode', city	 = '$city', state = '$state', "
        . "member_amount = $member_amount, person_amount = $person_amount, workshop_amount = $workshop_amount , "
        . "amount = $amount "
        . " WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        //echo "Abstract Submitted";
    }
}

if (isset($_POST['submit'])) {

   
    if ($_POST['amount'] !== 0) {
        $merchant_data = '';
        if($_POST['payment_type'] == "NETBANKING"){
            $working_key = $_ENV['WORKING_KEY'];
            $access_code = $_ENV['ACCESS_KEY'];
            $merchant_id = $_ENV['MERCHANT_ID'];
        }else{
            $working_key = $_ENV['WORKING_KEY_1'];
            $access_code = $_ENV['ACCESS_KEY_1'];
            $merchant_id = $_ENV['MERCHANT_ID_1'];
        }
        $merchant_data .= 'merchant_id=' . $merchant_id . '&';
        $order_id = 1;
        $tid = time();
        $user_id = $_POST['id'];   
        $amount = $_POST['amount'];
        $sql = "SELECT * FROM orders WHERE user_id = $user_id AND order_status = 'Success'";
        $orderResult = $conn->query($sql);
        if ($orderResult->num_rows == 0 && $user_id != 0) {
            $insert_order_sql = "INSERT INTO orders (user_id,tid,amount) VALUES ($user_id, '$tid', $amount)";
            if ($conn->query($insert_order_sql) === TRUE) {
                $order_id = $conn->insert_id;
                $merchant_data .= 'tid=' . $tid . '&';
                $merchant_data .= 'order_id=' . $order_id . '&';
                $update_user_sql = "UPDATE users SET order_id= $order_id,tid='$tid' WHERE id = $user_id";
                if ($conn->query($update_user_sql) === TRUE) {
                    error_reporting(0);
                   
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
            }
        } else {
                echo '<script>window.location.href="registration.php"</script>';
                $_SESSION["login_error"] = "Something went Wrong. Try again";
        }
    }
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
                                            <option value="NETBANKING" <?= (isset($_POST['payment_type']) && $_POST['payment_type'] == "NETBANKING") ? 'selected' : '' ?>>CREDIT/DEBIT/NET BANKING</option>
                                            <!--<option value="CARD" <?= (isset($_POST['payment_type']) && $_POST['payment_type'] == "CARD") ? 'selected' : '' ?>>CREDIT/DEBIT CARD</option>-->
                                        </select>
                                    </div>
                                   
                                    <input type="hidden" name="language" value="EN">
                                    <input type="hidden" name="currency" value="INR">
                                    <input type="hidden" name="redirect_url" value="<?= $base_url; ?>payment-response.php?id=<?= $id ?>">
                                    <input type="hidden" name="cancel_url" value="<?= $base_url; ?>payment-response.php?id=<?= $id ?>">
                                </div>

                                <button name="submit" type="submit" class="btn btn-dark  mt-3 px-4" id="pay-btn">Pay</button>
                                <input type="hidden" name="user_id" value="<?= $id ?>" />
                                <input type="hidden" name="id" value="<?= $id ?>" />
                                <a href="registration.php" class="btn btn-secondary mt-3 px-4" id="cancel-btn">Cancel</a>

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