<?php
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
					echo "Thank you for order with us. Your has been charged and your transaction is successful. Please login to submit Abstract.";
				} else if ($order_status === "Aborted") {
					echo "Thank you for order with us.We will keep you posted regarding the status of your order through e-mail";
				} else if ($order_status === "Failure") {
					echo "Thank you for order with us.However,the transaction has been declined.";
				} else {
					echo "Security Error. Illegal access detected";
				}
				?>
			</h3>
			<div class="col-md-4">
			</div>

			<?php
			$result = array();
			for ($i = 0; $i < $dataSize; $i++) {
				$information = explode('=', $decryptValues[$i]);
				$key = $information[0];
				$value = $information[1];
				$result[$key] = $value;
			}

			include_once('./include/connection.php');

			$user_id = isset($result['user_id']) ? $result['user_id'] : '0';
			$tid = isset($result['tid']) ? $result['tid'] : '0';
			$tracking_id = $result['tracking_id'];
			$bank_ref_no = $result['bank_ref_no'];
			$order_status = $result['order_status'];
			$payment_mode = $result['payment_mode'];
			$amount = $result['amount'];


			$user_id = $_GET['id'];
			$order_id = 1;
			$sql = "SELECT * FROM users WHERE id = $user_id";
			$userResult = $conn->query($sql);

			if ($userResult->num_rows > 0) {
				$row = $userResult->fetch_assoc();
				$order_id = $row['order_id'];
			}

			$userData = $userResult->fetch_assoc();
			print_r($userData);
			$to = $userData['email'];
			$membership_no = $userData['membership_no'];
			$name = $userData['first_name'] . " " . $userData['last_name'];

			$sql = "SELECT * FROM orders WHERE order_id = $order_id AND user_id = $user_id AND order_status = 'Success'";
			$orderResult = $conn->query($sql);
			if ($orderResult->num_rows == 0) {
				$insert_order_sql = "INSERT INTO orders (user_id,tid,amount,order_id,tracking_id,bank_ref_no,order_status,payment_mode) ";
				$insert_order_sql .= " VALUES ($user_id, $tid, $amount,$order_id,$tracking_id,'$bank_ref_no','$order_status','$payment_mode')";
				if ($conn->query($insert_order_sql) === TRUE) {
					$last_id = $conn->insert_id;
					$update_user_sql = "UPDATE users SET payment_status = 'paid', order_id=$last_id WHERE id = $user_id";
					if ($conn->query($update_user_sql) === TRUE) {
						echo '
						<table cellpadding="5" cellspacing="5" style=" width: 300px; text-align: left; font-size: 18px;">
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
						';
					}



					$from = "dermazonesouth2023@gmail.com";
					$fromName = "Dermazone South 2023";
					$subject = "Dermazone South 2023 Payment Confirmation";

					$htmlContent = '
<html>
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
                    <a href="#" target="_blank" style="color:#999999;text-decoration:underline;">PRIVACY STATEMENT</a>
                    | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">TERMS OF SERVICE</a>
                    | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">RETURNS</a><br>
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

					// Set content-type header for sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// Additional headers
					$headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
					$headers .= 'Cc: dermazonesouth2023@gmail.com' . "\r\n";
					$headers .= 'Bcc: ukendiran@gmail.com' . "\r\n";

					// Send email
					if (mail($to, $subject, $htmlContent, $headers)) {
						// echo 'Email has sent successfully.';
					} else {
						// echo 'Email sending failed.';
					}
				}
			}

			?>

			<a href="login.php" class="text-center">Click here to Login</a>
		</div>
	</div>
</div>

<?php include_once 'include/footer.php';  ?>