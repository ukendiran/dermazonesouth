<?php
include_once './include/connection.php';
include_once './include/header.php';
include_once './include/navbar.php';
include_once './Crypto.php';
include_once './config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Create a new PHPMailer instance
$mail = new PHPMailer(true);


$dotenv->load();
$user_id = $_GET['id'];
$status = 0;
error_reporting(0);

$workingKey = $_ENV['WORKING_KEY'];
// print_r($_POST); exit();
?>
<?php
if ($_POST) {
    $encResponse = $_POST["encResp"];
    $rcvdString = decrypt($encResponse, $workingKey);
    $order_status = "";
    $decryptValues = explode('&', $rcvdString);
    $dataSize = sizeof($decryptValues);

    $result = array();
    for ($i = 0; $i < $dataSize; $i++) {
        $information = explode('=', $decryptValues[$i]);
        if ($i == 3) $order_status = $information[1];
        $key = $information[0];
        $value = $information[1];
        $result[$key] = $value;
    }

    $order_id = $result['order_id'];
    $tracking_id = $result['tracking_id'];
    $bank_ref_no = $result['bank_ref_no'];
    $order_status = $result['order_status'];
    $payment_mode = $result['payment_mode'];
    $amount = $result['amount'];
    $payment_status = "unpaid";

    $to = '';
    $membership_no = '';
    $name = '';

    $sql = "SELECT * FROM users WHERE id = $user_id";
    $userResult = $conn->query($sql);
    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        $tid = $row['tid'];
        $to = $row['email'];
        $membership_no = $row['membership_no'];
        $name = $row['first_name'] . " " . $row['last_name'];
    }
} else {
    echo '<script>window.location.href="' . $base_url . '"</script>';
}

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
<?php  ?>
<div class="container-xxl">
    <div class="container">
        <div class="row g-2">
            <h3 class="mb-4 text-center">
                <?php

                $sql = "SELECT * FROM orders WHERE id = $order_id";
                $orderResult = $conn->query($sql);
                $orderRow = $orderResult->fetch_assoc();


                $sql = "SELECT * FROM users WHERE id = $user_id";
                $userResult = $conn->query($sql);
                $userRow = $userResult->fetch_assoc();

                if ($order_status == "Success" && $result['amount'] == $orderRow['amount'] && $result['amount'] != 0 && $order_id !== 0 && $orderRow['tid'] == $userRow['tid']) {
                    $payment_status = "paid";
                } else {
                    $payment_status = "unpaid";
                    $order_status = "Failure";
                }


                if ($order_status === "Success") {
                    echo "<p>Thank you for order with us.</p><p>We will keep you posted regarding the status of your order through e-mail.</p>";
                } else if ($order_status === "Aborted") {
                    echo "<p>Thank you for order with us.</p><p>We will keep you posted regarding the status of your order through e-mail.</p>";
                } else if ($order_status === "Failure") {
                    echo "<p>Thank you for order with us.</p><p>However,the transaction has been declined.</p>";
                } else if ($order_status === "Timeout") {
                    echo "<p>Thank you for order with us.</p><p>However,the transaction has been declined due to timeout.</p>";
                }

                $updated_order_sql = "UPDATE orders SET user_id = $user_id,amount=$amount,";
                $updated_order_sql .= "order_id=$order_id,tracking_id='$tracking_id',bank_ref_no=$bank_ref_no,";
                $updated_order_sql .= "order_status='$order_status',payment_mode='$payment_mode' ";
                $updated_order_sql .= " WHERE id=$order_id";

                if ($conn->query($updated_order_sql) === TRUE) {
                    $update_user_sql = "UPDATE users SET payment_status = '$payment_status', order_id=$order_id WHERE id = $user_id";
                    if ($conn->query($update_user_sql) === TRUE) {
                        if ($payment_status == "paid") {
                ?>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="card" style="margin-bottom:20px; margin-top:1px;">
                                        <div class="card-body">
                                            <table cellpadding="5" cellspacing="5" style=" width: 100%; text-align: left; font-size: 18px;">
                                                <tr>
                                                    <th>IADVL Number :</th>
                                                    <td><?= $membership_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td><?= $name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Order Id:</th>
                                                    <td><?= $order_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tracking Id:</th>
                                                    <td><?= $tracking_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Bank Referance No:</th>
                                                    <td><?= $bank_ref_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td><?= $order_status; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Mode:</th>
                                                    <td><?= $payment_mode; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Amount Paid:</th>
                                                    <td><?= $amount; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                            $from = "dermazonesouth2023@gmail.com";
                            $fromName = "Dermazone South 2023";
                            $subject = "Dermazone South 2023 Payment Confirmation";
                            $htmlContent = '<html>
                                      <head>
                                          <title>Welcome to Dermazone South 2023</title>
                                      </head>
                                      <!-- Complete Email template -->
                    
                                      <body style="background-color:grey">
                                          <table align="center" border="0" cellpadding="0" cellspacing="0" width="550" bgcolor="white"
                                              style="border:2px solid black">
                                              <tbody>
                                                  <tr>
                                                      <td align="center">
                                                          <table align="center" border="0" cellpadding="0" cellspacing="0" class="col-550" width="550">
                                                              <tbody>
                                                                  <tr>
                                                                      <td align="center" style="background-color: #FF5E14;height: 50px;">
                    
                                                                          <a href="#" style="text-decoration: none;">
                                                                              <p style="color:white;font-weight:bold;">
                                                                                  Dermazone South 2023
                                                                              </p>
                                                                          </a>
                                                                      </td>
                                                                  </tr>
                                                              </tbody>
                                                          </table>
                                                      </td>
                                                  </tr>
                                                  <tr style="height: 250px;">
                                                      <td align="center"
                                                          style="border: none;border-bottom: 2px solid #FF5E14;padding-right: 10px;padding-left:10px">
                    
                                                          <p style="font-weight: bolder;font-size: 35px;letter-spacing: 1px;color:black; line-height: 50px;">
                                                              Hello ' . $name . '!
                                                              <br> Payment Completed Successfully!
                                                          </p>
                                                      </td>
                                                  </tr>
                    
                                                  <tr style="display: inline-block;">
                                                      <td style="padding: 30px;border: none;border-bottom: 2px solid #361B0E;background-color: white;">
                    
                                                          <table cellpadding="5" cellspacing="5" style=" width: 100%; text-align: left; font-size: 18px;">
                                                              <tr>
                                                                  <th>IADVL Number :</th>
                                                                  <td>' . $membership_no . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Name:</th>
                                                                  <td>' . $name . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Order Id:</th>
                                                                  <td>' . $order_id . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Tracking Id:</th>
                                                                  <td>' . $tracking_id . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Bank Referance No:</th>
                                                                  <td>' . $bank_ref_no . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Status:</th>
                                                                  <td>' . $order_status . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Payment Mode:</th>
                                                                  <td>' . $payment_mode . '</td>
                                                              </tr>
                                                              <tr>
                                                                  <th>Amount Paid:</th>
                                                                  <td>' . $amount . '</td>
                                                              </tr>
                    
                    
                                                          </table>
                                                          <p style="margin-top:30px; text-align: center; width: 100%;">
                                                              <a href="https://dermazonesouth2023.com"
                                                                  style="text-decoration: none;color:black;border: 2px solid #FF5E14;padding: 10px 30px;font-weight: bold;">
                                                                  Read More
                                                              </a>
                                                          </p>
                                                      </td>
                                                  </tr>
                                                  <tr
                                                      style="border: none;background-color: #FF5E14;height: 40px;color:white;padding-bottom: 20px;text-align: center;">
                    
                                                      <td height="40px" align="center">
                                                          <p style="color:white;line-height: 20px;">
                                                              DermazoneSouth2023
                                                          </p>
                                                          <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                                              <img height="30"
                                                                  src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png"
                                                                  width="30" />
                                                          </a>
                    
                                                          <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                                              <img height="30"
                                                                  src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png"
                                                                  width="30" />
                                                          </a>
                    
                                                          <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                                              <img height="20"
                                                                  src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png"
                                                                  width="24" style="position: relative;padding-bottom: 5px;" />
                                                          </a>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td style="font-family:"Open Sans", Arial, sans-serif;font-size:11px; line-height:18px;color:#999999;"
                                                          valign="top" align="center">
                                                          <a href="' . $base_url . 'privacy-policy.php" target="_blank" style="color:#999999;text-decoration:underline;">PRIVACY STATEMENT</a>
                                                          | <a href="' . $base_url . 'terms-and-conditions.php" target="_blank" style="color:#999999; text-decoration:underline;">TERMS OF SERVICE</a>
                                                          | <a href="' . $base_url . 'cancellation-refund-policy.php" target="_blank" style="color:#999999; text-decoration:underline;">RETURNS</a><br>
                                                          &copy; 2023 DermazoneSouth. All Rights Reserved.<br>
                                                          If you do not wish to receive any further
                                                          emails from us, please <a href="#" target="_blank"
                                                              style="text-decoration:none;color:#999999;">unsubscribe</a>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                          </td>
                                          </tr>
                                          <tr>
                                              <td class="em_hide" style="line-height:1px;min-width:700px;background-color:#ffffff;">
                                                  <img alt="" src="images/spacer.gif"
                                                      style="max-height:1px;min-height:1px;display:block;width:700px;min-width:700px;" width="700" border="0"
                                                      height="1">
                                              </td>
                                          </tr>
                                          </tbody>
                                          </table>
                                      </body>
                                </html>';
                                
                                
                           $mail->isSMTP();
                        //   $mail->SMTPDebug = 2;
                           $mail->Host = 'smtp.hostinger.com';
                           $mail->Port = 587;
                           $mail->SMTPAuth = true;
                           $mail->Username = 'info@dermazonesouth2023.com';
                           $mail->Password = 'Crution@123';
                        
                           $mail->Subject = 'Dermazone South 2023 Payment Confirmation';
                           
                           $mail->Body = $htmlContent;
                            
                            // Sender and recipient
                            $mail->setFrom('info@dermazonesouth2023.com', 'Dermazone South 2023');
                            $mail->addAddress($userRow['email'], $name);
                        
                            // Email content
                            $mail->isHTML(true);                      // Set email format to HTML
                            // Send the email
                            $mail->send();
                            
                        } 
                    }
                }


                ?>
            </h3>
            <a class="text-center" href="login.php">Click me to Login</a>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php';  ?>