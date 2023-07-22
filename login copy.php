<?php include 'include/header.php';
include 'include/navbar.php';
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
                <form id="myForm" method="POST">
                    <div class="form-s1">
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6"> <label class="small">IADVL Number</label>
                                <!-- <input data-url="<?php echo $base_url; ?>check.php" type="text" class="form-control registration-mem-no" id="membership_no" name="membership_no" placeholder="Enter IADVL Number"> -->
                                <input type="text" class="form-control registration-mem-no" id="membership_no" name="membership_no" placeholder="Enter IADVL Number">
                                <p id="membership_noError"></p>
                            </div>
                        </div>
                        <button class="btn btn-dark mt-3 px-4" id="btn-submit">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center text-center" id="otpfrm">
            <div class="col-md-12">
                <h2 class="mb-4">Please enter the One-Time Password to verify your account</h2>
                <p>A one-Time Password has been sent to registered mobile number ending with **********</p>
                <form id="myForm" method="POST">
                    <div class="form-s1">
                        <div class="form-group row otpfrmgrp">
                            <div class="col-sm-6">

                                <div class="d-flex justify-content-center">
                                    <!-- Six separate OTP input fields -->
                                    <input type="number" class="otp-input" id="otp-input-start" maxlength="1"  required oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    <input type="number" class="otp-input" maxlength="1"  required oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    <input type="number" class="otp-input" maxlength="1"  required oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    <input type="number" class="otp-input" maxlength="1"  required oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    <input type="number" class="otp-input" maxlength="1"  required oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                    <input type="number" class="otp-input" id="otp-input-end" maxlength="1" oninput="moveToNext(this)" onkeydown="moveToPrevious(event, this)">
                                </div>
                                <input type="hidden" id="mbmship_no" name="mbmship_no" value="">
                                <button type="button" class="btn btn-primary mt-20" id="otpsubmit" onclick="getOTP()" disabled>SUBMIT</button>

                                <span class="result"></span>
                                <!-- </section> -->

                            </div>
                        </div>
                        <!-- <button class="btn btn-dark mt-3 px-4" id="btn-submit">Validate</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    #otpfrm {
        display: none;
    }

    .result {
        text-align: center;
        color: orange;
        font-size: 2em;
        font-weight: bold;
        margin-top: 1.5em;
        display: block;
    }

    input {
        border: 0;
        border-bottom: 2px solid #C0C0C0;
        outline: 0;
        color: #111111;
        width: 37px;
        padding: 0 5px;
        margin-right: 10px;
        text-align: center;
        font-size: 3em;
        cursor: pointer;
        will-change: border;
        transition: border .3s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        -moz-appearance: textfield;
        appearance: none;
        margin: 0;
    }

    input:focus {
        border: 0;
        border-bottom: 2px solid #ff6200;
    }

    input:disabled {
        background: #fff;
    }

    input:last-child {
        margin-right: 0;
    }

    .paintOrangeLine {
        border: 0;
        border-bottom: 2px solid #ff6200;
    }

    .otpbutton {
        background: #ff6200;
        color: whiteSmoke;
        padding: 1em 2em;
        margin-top: 2em;
        border: 0;
        width: 30%;
        cursor: pointer;
        transition: opacity .3s ease-in-out;
        will-change: opacity;
    }

    .otpbutton:hover {
        opacity: .8;
    }

    .otpfrmgrp {
        justify-content: center;
    }

    .otp-input {
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 20px;
        margin: 0 5px;
        border: 2px solid #ccc;
        border-radius: 5px;
    }

    .otp-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }
</style>
<?php include 'include/footer.php'; ?>