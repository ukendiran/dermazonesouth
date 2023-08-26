<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DERMAZONE SOUTH 2023</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="DERMAZONE SOUTH 2023" name="keywords">
    <meta content="DERMAZONE SOUTH 2023" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End --><!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
    <a href="index.php" class="navbar-brand ps-5 me-0">
        <!-- <img class="sticky-logo" src="img/logo-light.svg" alt="Mid Dermacon"> -->
        <h5 class="text-white m-0 logo">DERMAZONE SOUTH 2023</h5>
    </a>
    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Home</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="index.php" class="dropdown-item ">Home </a>
                    <a href="highlights.php" class="dropdown-item ">Highlights </a>
                    <a href="scientific.php" class="dropdown-item ">Scientific program </a>
                </div>
            </div>
            <a href="committee.php" class="nav-item nav-link ">Committee</a>
            <a href="downloads.php" class="nav-item nav-link ">Downloads</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Abstract</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="guideline.php" class="dropdown-item ">Guidelines</a>
                    <a href="login.php" class="dropdown-item ">Abstract Submission</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Venue</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="places.php" class="dropdown-item ">About Puducherry</a>
                    <a href="conference-venue.php" class="dropdown-item ">Conference Venue</a>

                </div>
            </div>
            <!-- <a href="places.php" class="nav-item nav-link">Places</a> -->
            <a href="contact.php" class="nav-item nav-link ">Contact us</a>
        </div>
        <a href="registration.php" class="btn btn-primary px-3 d-none d-lg-block">Registration</a>
    </div>
</nav>
<!-- Navbar End -->    <script language='javascript'>
        document.location.href = "registration.php";
    </script>
    
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
                                        <input type="text" readonly value="" class="form-control member-no" name="membership_no" required="" minlength="6" maxlength="20" placeholder="Enter IADVL Number">
                                    </div>
                                    <div>
                                                                                <label class="small">Full Name</label>
                                        <input type="text" readonly value="" class="form-control name" name="name">
                                    </div>
                                    <div>
                                        <label class="small">Amount</label>
                                        <input type="text" id="amount" readonly value="0" class="form-control amount" name="amount" required="">
                                    </div>
                                    <div class=" mt-3  member-auto-fill"> <label>Payment Type</label>
                                        <select class="form-control payment_type" required="" name="payment_type">
                                            <option value="" >Select</option>
                                            <option value="hdfc" >HDFC BANK</option>
                                            <option value="razor-pay" >RAZOR PAY</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="tid" id="tid" value="">
                                    <input type="hidden" name="merchant_id" value="2701346">
                                    <input type="hidden" name="language" value="EN">
                                    <input type="hidden" name="order_id" value="1">
                                    <input type="hidden" name="currency" value="INR">
                                    <input type="hidden" name="redirect_url" value="https://dermazonesouth2023.com/dev/payment-response.php?id=0">
                                    <input type="hidden" name="cancel_url" value="https://dermazonesouth2023.com/dev/payment-response.php?id=0">
                                </div>

                                <button name="submit" type="submit" class="btn btn-dark  mt-3 px-4" id="pay-btn">Pay</button>
                                <input type="hidden" name="user_id" value="0" />
                                <input type="hidden" name="id" value="0" />
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

<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5 col-md-6">
                <h5 class="text-white mb-4">Our Office</h5>
                <p class="mb-2">
                    <i class="fa fa-map-marker-alt me-3"></i>Indira Gandhi Medical College and Research Institute
                </p>
                <p class="mb-2">
                    Kathirkamam, Puducherry, 605009, India.
                </p>
                <!-- <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+0413 000 0000</p> -->
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>dermazonesouth2023@gmail.com</p>
                <div class="d-flex pt-3">
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link" href="abstract.php">About Us</a>
                <a class="btn btn-link" href="contact.php">Contact Us</a>
                <a class="btn btn-link" href="committee.php">Committee</a>
                <a class="btn btn-link" href="conference-venue.php">Venue</a>
                <a class="btn btn-link" href="terms-and-conditions.php">Terms & Conditions</a>
                <a class="btn btn-link" href="privacy-policy.php">Privacy Policy</a>
                <a class="btn btn-link" href="cancellation-refund-policy.php">Cancellation & Refund Policy</a>
                <a class="btn btn-link" href="#">Support</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-4">Conference Secretariat</h5>
                <p class="mb-1">Dr. C Udayashankar </p>
                <h6 class="text-light">Organising Chairperson </h6>
                <p class="mb-1">Dr. Remya Raj R </p>
                <h6 class="text-light">Organising Secretary</h6>

            </div>
            <!-- <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container text-center">
        <p class="mb-2">Powered by Incredible Events Foundation</p>
        <p class="mb-2">Copyright &copy; <a class="fw-semi-bold" href="#">Dermazonesouth2023</a>, All Right Reserved.</p>
        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        <!-- <p class="mb-0">Designed By 
                <a class="fw-semi-bold" href="https://crution.com/" target="_blank">Crution</a></p> -->
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/notify/notify.min.js"></script>
<script type="text/javascript" src="https://control.msg91.com/app/assets/otp-provider/otp-provider.js"> </script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>