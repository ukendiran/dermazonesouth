<?php include 'include/header.php';
include 'include/navbar.php';
include_once('./include/connection.php');
$data = array();
$id = '';

if (isset($_GET['id'])) {
    // To decrypt the ID back
    $id = decryptID($_GET['id'], $yourSecretKey);
    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    // $id = decryptID($_POST['id'], $yourSecretKey);
    $membership_no = $_POST['membership_no'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];
    $registration_no = $_POST['registration_no'];
    $has_workshop = $_POST['has_workshop'];
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
    $sql = "UPDATE users "
        . " SET id = '$id', membership_no = '$membership_no', first_name = '$first_name', last_name = '$last_name',"
        . "email = '$email', mobile = '$mobile', registration_no = '$registration_no', age = $age,"
        . "has_workshop = '$has_workshop', food = '$food', co_delegates	 = '$co_delegates	', institution = '$institution',"
        . "member_type = '$member_type', designation = '$designation', gender	 = '$gender', address_line1 = '$address_line1',"
        . "address_line2 = '$address_line2', pincode = '$pincode', city	 = '$city', state = '$state'"
        . " WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
?>
        <script>
            // $.notify("Access granted", "success");
        </script>
<?php
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
                <li class="breadcrumb-item active" aria-current="page">Registration</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-2">
            <div class="col-md-9">
                <h2 class="mb-4">
                    Dermazone South 2023 Registration</h2>
                <div class="form-s1">
                    <form id="registation-form" method="post" action="register.php?id=<?= $id ?>">
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
                            <div class="form-group mt-3"> <label>Medical Council No</label>
                                <input type="text" value="<?= (isset($data['registration_no'])) ? $data['registration_no'] : '' ?>" class="form-control" name="registration_no" required="" maxlength="5" placeholder="Enter medical council no.">
                            </div>
                            <div class="form-group mt-3 row">
                                <div class="col-sm-6"> <label>Email ID</label>
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
                                    <div class="form-check">
                                        <input id="has_workshop" name="has_workshop" type="hidden" value="<?= (isset($data['has_workshop'])) ? $data['has_workshop'] : '' ?>">
                                        <input class="form-check-input" <?= (isset($data['has_workshop']) && $data['has_workshop'] == '1') ? 'checked' : '' ?> name="has_workshop" type="checkbox" value="1" id="workshopCheck">
                                        <label class="form-check-label" for="workshopCheck"> Workshop </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark submit-btn mt-3" name="submit">Submit</button>
                            <input type="hidden" name="id" value="<?= $id ?>" />
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





<?php include 'include/footer.php'; ?>