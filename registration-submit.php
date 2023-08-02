<?php
include_once 'include/header.php';
include_once 'include/navbar.php';
include_once('./include/connection.php');
session_start();
$data = array();
$id =0;


if (isset($_POST['proceed'])) {
    $membership_no = $_POST['membership_no'];
    $sql = "SELECT * FROM users WHERE membership_no = '$membership_no'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $id = $data['id'];
    if($data['payment_status'] == 'paid'){
        header("Location: login.php");
        $_SESSION["login_error"] = "Your already Subscribed Please Login to Submit Abstract";
    }
    
        // header("Location: registration.php");
        // $_SESSION["login_error"] = "There is no registration on this membership number. Make sure the membership number you entered is correct.";
    
}else{
    // header("Location: registration.php");
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-5 text-white animated slideInRight">Registration</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Online Registration</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {  ?>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-12">
                    <h2 class="mb-4">
                        Dermazone South 2023 Online Registration</h2>
                    <div class="form-s1">

                        <form id="registation-form" method="post" action="payment.php">
                            <div class="form-group row">
                                <div class="col-sm-6"> <label class="small">IADVL Number (Eg. LM/K/99999)</label>
                                    <input type="text" readonly value="<?= (isset($data['membership_no'])) ? $data['membership_no'] : '' ?>" class="form-control member-no" name="membership_no" required="" minlength="6" maxlength="20" placeholder="Enter IADVL Number">
                                </div>
                                <div class="col-sm-6 mt-3 mt-sm-0 member-auto-fill"> <label>Registration Type</label>
                                    <select class="form-control member_type" required="" name="member_type">
                                        <option value="" <?= (isset($data['member_type']) && $data['member_type']  == "") ? 'selected' : '' ?>>Select</option>
                                        <option value="PLM" <?= (isset($data['member_type']) && $data['member_type'] == "PLM") ? 'selected' : '' ?>>Provisional Life Membership</option>
                                        <option value="IADVL_MEMBER" <?= (isset($data['member_type']) && $data['member_type'] == "IADVL_MEMBER") ? 'selected' : '' ?>>IADVL Life Member</option>
                                    </select>
                                </div>
                            </div> <a href="javascript: void(0)" class="btn btn-dark mt-3 px-4 d-none" id="fetch-btn">Proceed</a>
                            <div class="member-auto-fill">
                                <div class="form-group mt-3 row">
                                    <div class="col-sm-6"> <label>First Name</label>
                                        <input type="text" value="<?= (isset($data['first_name'])) ? $data['first_name'] : '' ?>" class="form-control first_name" name="first_name" required="" minlength="3" maxlength="100" placeholder="Enter first name">
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0"> <label>Last Name</label>
                                        <input type="text" value="<?= (isset($data['last_name'])) ? $data['last_name'] : '' ?>" class="form-control last_name" name="last_name" required="" maxlength="100" placeholder="Enter last name">
                                    </div>
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-lg-6"> <label>Designation</label>
                                        <input type="text" value="<?= (isset($data['designation'])) ? $data['designation'] : '' ?>" class="form-control designation" name="designation" required="" minlength="3" maxlength="100" placeholder="Enter designation">
                                    </div>
                                    <div class="col-6 col-lg-3 mt-3 mt-lg-0"> <label>Gender</label>
                                        <select class="form-control" required="" name="gender">
                                            <option value="" <?= (isset($data['gender']) && $data['gender']  == "") ? 'selected' : '' ?>>Select</option>
                                            <option value="Female" <?= (isset($data['gender']) && $data['gender']  == "Female") ? 'selected' : '' ?>>Female</option>
                                            <option value="Male" <?= (isset($data['gender']) && $data['gender']  == "Male") ? 'selected' : '' ?>>Male</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-lg-3 mt-3 mt-lg-0"> <label>Age</label>
                                        <input type="number" value="<?= (isset($data['age'])) ? $data['age'] : '' ?>" class="form-control age" name="age" required="" minlength="2" maxlength="2" min="18" placeholder="Enter age">
                                    </div>
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-sm-6">
                                        <label>Medical Council No</label>
                                        <input type="text" value="<?= (isset($data['registration_no'])) ? $data['registration_no'] : '' ?>" class="form-control" name="registration_no" required="" maxlength="5" placeholder="Enter Medical Council Number.">
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0">
                                        <label>Medical Council State</label>
                                        <input type="text" value="<?= (isset($data['council_state'])) ? $data['council_state'] : '' ?>" class="form-control" name="council_state" required="" maxlength="5" placeholder="Enter Medical Council State.">
                                    </div>
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-sm-6">
                                        <label>Email ID</label>
                                        <input type="email" value="<?= (isset($data['email'])) ? $data['email'] : '' ?>" class="form-control email" name="email" required="" placeholder="Enter email ID">
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0"> <label>Mobile No</label>
                                        <input type="text" value="<?= (isset($data['mobile'])) ? $data['mobile'] : '' ?>" class="form-control mobile" name="mobile" required="" minlength="10" maxlength="10" placeholder="Enter 10 digit mobile no.">
                                    </div>
                                </div>
                                <div class="form-group mt-3"> <label>Address line 1</label>
                                    <input type="text" value="<?= (isset($data['address_line1'])) ? $data['address_line1'] : '' ?>" class="form-control address_line1" name="address_line1" required="" minlength="3" maxlength="250" placeholder="Enter address line 1">
                                </div>
                                <div class="form-group mt-3"> <label>Address line 2</label>
                                    <input type="text" value="<?= (isset($data['address_line2'])) ? $data['address_line2'] : '' ?>" class="form-control address_line2" name="address_line2" maxlength="250" placeholder="Enter address line 2">
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-sm-6 col-lg-2"> <label>Pincode</label>
                                        <input type="text" class="form-control pincode" value="<?= (isset($data['pincode'])) ? $data['pincode'] : '' ?>" name="pincode" required="" minlength="6" maxlength="6" placeholder="Enter pincode">
                                    </div>
                                    <div class="col-sm-6 col-lg-5 mt-3 mt-sm-0"> <label>City</label>
                                        <input type="text" class="form-control city" value="<?= (isset($data['city'])) ? $data['city'] : '' ?>" name="city" required="" minlength="3" maxlength="100" placeholder="Enter city">
                                    </div>
                                    <div class="col-sm-6 col-lg-5 mt-3 mt-lg-0"> <label>State</label>
                                        <input type="text" class="form-control state" value="<?= (isset($data['state'])) ? $data['state'] : '' ?>" name="state" required="" minlength="3" maxlength="50" placeholder="Enter state">
                                    </div>
                                </div>
                                <div class="form-group mt-3"> <label>Institution</label>
                                    <input type="text" value="<?= (isset($data['institution'])) ? $data['institution'] : '' ?>" class="form-control" name="institution" required="" minlength="3" maxlength="255" placeholder="Enter institution">
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-sm-6"> <label>No. of co-delegates</label>
                                        <select class="form-control" required="" name="co_delegates">
                                            <option value="" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "") ? 'selected' : '' ?>>Select</option>
                                            <option value="0" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "0") ? 'selected' : '' ?>>0</option>
                                            <option value="1" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "1") ? 'selected' : '' ?>>1</option>
                                            <option value="2" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "2") ? 'selected' : '' ?>>2</option>
                                            <option value="3" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "3") ? 'selected' : '' ?>>3</option>
                                            <option value="4" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "4") ? 'selected' : '' ?>>4</option>
                                            <option value="5" <?= (isset($data['co_delegates']) && $data['co_delegates']  == "5") ? 'selected' : '' ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0"> <label>Meal preference</label>
                                        <select class="form-control" required="" value="<?= (isset($data['food'])) ? $data['food'] : '' ?>" value="<?php echo (isset($data['food'])) ?  $data['food'] : '' ?>" name="food">
                                            <option value="" <?= (isset($data['food']) && $data['food']  == "0") ? 'selected' : '' ?>>Select</option>
                                            <option value="Veg" <?= (isset($data['food']) && $data['food']  == "Veg") ? 'selected' : '' ?>>Veg</option>
                                            <option value="Non Veg" <?= (isset($data['food']) && $data['food']  == "Non Veg") ? 'selected' : '' ?>>Non Veg</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-3 row">
                                    <div class="col-12">
                                        <label>Workshop</label>
                                        <div class="form-check">
                                            <input <?= (isset($data['workshop']) && $data['workshop'] == 'None') ? 'checked' : '' ?> name="workshop" type="radio" value="None" id="None" checked> None
                                            <input <?= (isset($data['workshop']) && $data['workshop'] == 'Lasers') ? 'checked' : '' ?> name="workshop" type="radio" value="Lasers" id="Lasers"> Lasers
                                            <input <?= (isset($data['workshop']) && $data['workshop'] == 'Trichology') ? 'checked' : '' ?> name="workshop" type="radio" value="Trichology" id="Trichology"> Trichology
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark submit-btn mt-3" name="update">Submit</button>
                                <input type="hidden" name="id" value="<?= $id ?>" />
                                <input type="hidden" name="amount" value="<?= (isset($data['amount'])) ? $data['amount'] : '' ?>" />
                            </div>
                            <div id="message"></div>
                        </form>
                        <div class="alert alert-info mt-10" role="alert">
                            Dear Doctor, At the time of registration for
                            Dermazone South 2023 please submit to us a declaration from the Head of Department that you are
                            a postgraduate student.<br> Mail ID: <a href="mailto:dermazonesouth2023@gmail.com"> dermazonesouth2023@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php } ?>


<?php include_once 'include/footer.php'; ?>