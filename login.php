<?php include 'include/header.php';
include 'include/navbar.php';
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white animated slideInRight">Abstract</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Abstract Submission</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2 class="mb-4">Registered members login</h2>
                <div class="form-s1">
                    <form id="login-form" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6"> <label class="small">IADVL Number</label> <input type="text" class="form-control registration-mem-no" name="iadvl_no" required="" minlength="6" maxlength="20" placeholder="Enter IADVL Number"> </div>
                        </div> <a href="javascript: void(0)" class="btn btn-dark mt-3 px-4" id="otp-btn">Proceed</a>
                        <div class="d-none member-auto-fill">
                            <div class="form-group mt-3 row">
                                <div class="col-sm-6"> <label>OTP</label> <input type="text" class="form-control otp" name="otp" required="" minlength="3" maxlength="100" placeholder="Enter OTP"> </div>
                            </div> <button type="submit" class="btn btn-dark submit-btn mt-3">Submit</button>
                        </div>
                        <div id="message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'include/footer.php'; ?>