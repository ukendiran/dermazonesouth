<?php
include_once 'include/connection.php';
include_once 'include/header.php';

include_once 'include/navbar.php';

include('Crypto.php');
include_once './config.php';
$dotenv->load();

$status = 0;
error_reporting(0);

$workingKey = $_ENV['WORKING_KEY'];
$encResponse = $_POST["encResp"];
$rcvdString = decrypt($encResponse, $workingKey);
$order_status = "";
$decryptValues = explode('&', $rcvdString);
$dataSize = sizeof($decryptValues);

?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" _POST-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Payment Confirmation</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Payment Confirmation</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-2">
            <h3 class="mb-4 text-center">
                <?php
                for ($i = 0; $i < $dataSize; $i++) {
                    $information = explode('=', $decryptValues[$i]);
                    if ($i == 3) $order_status = $information[1];
                }
                if ($order_status === "Success") {
                ?>
                    <?php
                    $result = array();
                    for ($i = 0; $i < $dataSize; $i++) {
                        $information = explode('=', $decryptValues[$i]);
                        $key = $information[0];
                        $value = $information[1];
                        $result[$key] = $value;
                    }
                    $tracking_id = $result['tracking_id'];
                    $bank_ref_no = $result['bank_ref_no'];
                    $order_status = $result['order_status'];
                    $payment_mode = $result['payment_mode'];
                    $amount = $result['amount'];
                    $user_id = $_GET['id'];
                    $order_id = 1;
                    $to = '';
                    $membership_no = '';
                    $name = '';
                    $sql = "SELECT * FROM users WHERE id = $user_id";
                    $userResult = $conn->query($sql);
                    if ($userResult->num_rows > 0) {
                        $row = $userResult->fetch_assoc();
                        $order_id = $row['order_id'];
                        $to = $row['email'];
                        $membership_no = $row['membership_no'];
                        $name = $row['first_name'] . " " . $row['last_name'];
                    }
                    $sql = "SELECT * FROM orders WHERE order_id = $order_id AND user_id = $user_id";
                    $sql .= " AND order_status = 'Success'";
                    $orderResult = $conn->query($sql);
                    if ($orderResult->num_rows == 0) {
                        $orderRow = $orderResult->fetch_assoc();
                        if ($result['amount'] == $orderRow['amount'] && $order_id !== 0) {
                            $updated_order_sql = "UPDATE orders SET user_id = $user_id,amount=$amount,";
                            $updated_order_sql .= "order_id=$order_id,tracking_id='$tracking_id',bank_ref_no=$bank_ref_no,";
                            $updated_order_sql .= "order_status='$order_status',payment_mode='$payment_mode' ";
                            $updated_order_sql .= " WHERE id=$order_id";
                            if ($conn->query($updated_order_sql) === TRUE) {
                                $update_user_sql = "UPDATE users SET payment_status = 'paid', order_id=$order_id";
                                $update_user_sql .= " WHERE id = $user_id";
                                if ($conn->query($update_user_sql) === TRUE) {
                                    include 'payment/view.php';
                                }
                                include 'payment/mail.php';
                            }
                        } else {
                            $updated_order_sql = "UPDATE orders SET user_id = $user_id,amount=$amount,";
                            $updated_order_sql .= "order_id=$order_id,tracking_id='$tracking_id',bank_ref_no=$bank_ref_no,";
                            $updated_order_sql .= "order_status='$order_status'";
                            $updated_order_sql .= " WHERE id=$order_id";
                            if ($conn->query($updated_order_sql) === TRUE) {
                                $update_user_sql = "UPDATE users SET payment_status = 'unpaid', order_id=$order_id";
                                $update_user_sql .= " WHERE id = $user_id";
                                if ($conn->query($update_user_sql) === TRUE) {
                                }
                            }
                        }
                    }
                    ?>
                    <a href="login.php" class="text-center">Click here to Login</a>
                <?php
                    echo "Thank you for order with us. Your has been charged and your transaction is successful. Please login to submit Abstract.";
                } else if ($order_status === "Aborted") {
                    echo "Thank you for order with us.We will keep you posted regarding the status of your order through e-mail";
                } else if ($order_status === "Failure") {
                    echo "Thank you for order with us.However,the transaction has been declined.";
                } else {
                    echo "Security Error. Illegal access detected";
                }
                $updated_order_sql = "UPDATE orders SET user_id = $user_id,amount=$amount,";
                $updated_order_sql .= "order_id=$order_id,tracking_id='$tracking_id',bank_ref_no=$bank_ref_no,";
                $updated_order_sql .= "order_status='$order_status'";
                $updated_order_sql .= " WHERE id=$order_id";
                if ($conn->query($updated_order_sql) === TRUE) {
                    $update_user_sql = "UPDATE users SET payment_status = 'unpaid', order_id=$order_id";
                    $update_user_sql .= " WHERE id = $user_id";
                    if ($conn->query($update_user_sql) === TRUE) {
                    }
                }
                ?>
            </h3>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php';  ?>