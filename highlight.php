<?php include 'include/header.php';
include 'include/navbar.php';
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-1 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-5 text-white animated slideInRight">Highlight</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb animated slideInRight mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">Highlight</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-1">
        <div class="container">
        <?php include 'include/program_highlight.php'; ?>
        </div>
    </div>
    <!-- About End -->
        
    <?php include 'include/footer.php'; ?>