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
					echo "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. Please login to submit Abstract.";
				} else if ($order_status === "Aborted") {
					echo "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
				} else if ($order_status === "Failure") {
					echo "Thank you for shopping with us.However,the transaction has been declined.";
				} else {
					echo "Security Error. Illegal access detected";
				}
				?>
			</h3>
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
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
						$payment_status = $result['payment_status'];
						$payment_type = $result['payment_type'];
						$order_id = $result['order_id'];
						$tracking_id = $result['tracking_id'];
						$bank_ref_no = $result['bank_ref_no'];
						$order_status = $result['order_status'];
						$payment_mode = $result['payment_mode'];
						$amount = $result['amount'];


						$user_id = $_GET['id'];
						$order_id = 0;
						$sql = "SELECT order_id FROM users WHERE id = $user_id";
						$userResult = $conn->query($sql);
						if ($userResult->num_rows == 0) {
							$row = $userResult->fetch_assoc();
							$order_id = $row['order_id'];
						}

						$sql = "SELECT * FROM orders WHERE order_id = $order_id AND order_status = 'Success'";
						$orderResult = $conn->query($sql);
						if ($orderResult->num_rows == 0) {
							$sql = "INSERT INTO orders (user_id,tid,amount,payment_status,payment_type,order_id,tracking_id,bank_ref_no,order_status,payment_mode) ";
							$sql .= " VALUES ($user_id, $tid, $amount,'$payment_status', '$payment_type',$order_id,$tracking_id,'$bank_ref_no','$order_status','$payment_mode')";

							if ($conn->query($sql) === TRUE) {
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
						}

						echo '<p> Order Id  : ' . $order_id . '</p>';
						echo '<p> Tracking Id  : ' . $tracking_id . '</p>';
						echo '<p> Bank Referance No  : ' . $bank_ref_no . '</p>';
						echo '<p> Status  : ' . $order_status . '</p>';
						echo '<p> Payment Mode  : ' . $payment_mode . '</p>';
						echo '<p> Amount Paid  : ' . $amount . '</p>';

						?>
					</div>
				</div>
			</div>
			<a href="login.php" class="text-center">Click here to Login</a>
		</div>
	</div>
</div>

<?php include_once 'include/footer.php';  ?>