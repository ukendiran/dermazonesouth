<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');
include_once './config.php';
$dotenv->load();

if (isset($_POST['submit'])) {
    include('Crypto.php');
    error_reporting(0);
    $working_key = $_ENV['WORKING_KEY'];
    $access_code = $_ENV['ACCESS_KEY'];

    $merchant_json_data =
        array(
            'order_no' => $_POST['order_no'],
            'reference_no' => $_POST['reference_no']
        );

    $merchant_data = json_encode($merchant_json_data);
    $encrypted_data = encrypt($merchant_data, $working_key);
    $final_data = 'enc_request=' . $encrypted_data . '&access_code=' . $access_code . '&command=orderStatusTracker&request_type=JSON&response_type=JSON';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://apitest.ccavenue.com/apis/servlet/DoWebTrans");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type: application/json');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
    // Get server response ...
    $result = curl_exec($ch);
    curl_close($ch);
    $status = '';
    $information = explode('&', $result);

    $dataSize = sizeof($information);
    for ($i = 0; $i < $dataSize; $i++) {
        $info_value = explode('=', $information[$i]);
        if ($info_value[0] == 'enc_response') {
            $status = decrypt(trim($info_value[1]), $working_key);
        }
    }
}

?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" _POST-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Payment Status</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Payment Status</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-2">
            <h2 class="mb-4 text-center"> Dermazone South 2023 Payment Status</h2>
            <div class="col-md-3">
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="form-s1">
                            <form id="payment-status" name="payment-status" method="post" action="payment-status.php">
                                <div class="form-group">
                                    <div>
                                        <label class="small">Order Number</label>
                                        <input type="text" value="" class="form-control order_no" name="order_no" required="" placeholder="Enter Order Number">
                                    </div>
                                    <div>
                                        <label class="small">Refrence No</label>
                                        <input type="text" value="" class="form-control reference_no" name="reference_no" required="" placeholder="Enter Refrence Number">
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-dark  mt-3 px-4" id="btn-payment-status">Get Status</button>

                                </div>
                            </form>

                        </div>
                        <div class="">
                            <?php
                            echo 'Status revert is: ' . $status ;
                            $obj = json_decode($status);
                            print_r($obj);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once 'include/footer.php'; ?>