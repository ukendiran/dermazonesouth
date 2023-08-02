<!-- Navbar Start -->
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
                <a class="nav-link dropdown-toggle <?= ($activePage == 'index' || $activePage == '' || $activePage == 'highlights' || $activePage == 'scientific') ? 'active' : ''; ?>" data-bs-toggle="dropdown">Home</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="index.php" class="dropdown-item <?= ($activePage == 'index') ? 'active' : ''; ?>">Home </a>
                    <a href="highlights.php" class="dropdown-item <?= ($activePage == 'highlights') ? 'active' : ''; ?>">Highlights </a>
                    <a href="scientific.php" class="dropdown-item <?= ($activePage == 'scientific') ? 'active' : ''; ?>">Scientific program </a>
                </div>
            </div>
            <a href="committee.php" class="nav-item nav-link <?= ($activePage == 'committee') ? 'active' : ''; ?>">Committee</a>
            <a href="downloads.php" class="nav-item nav-link <?= ($activePage == 'downloads') ? 'active' : ''; ?>">Downloads</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= ($activePage == 'guideline' || $activePage == 'login') ? 'active' : ''; ?>" data-bs-toggle="dropdown">Abstract</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="guideline.php" class="dropdown-item <?= ($activePage == 'guideline') ? 'active' : ''; ?>">Guidelines</a>
                    <a href="login.php" class="dropdown-item <?= ($activePage == 'login') ? 'active' : ''; ?>">Abstract Submission</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= ($activePage == 'places' || $activePage == 'conference-venue') ? 'active' : ''; ?>" data-bs-toggle="dropdown">Venue</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="places.php" class="dropdown-item <?= ($activePage == 'places') ? 'active' : ''; ?>">About Puducherry</a>
                    <a href="conference-venue.php" class="dropdown-item <?= ($activePage == 'conference-venue') ? 'active' : ''; ?>">Conference Venue</a>

                </div>
            </div>
            <!-- <a href="places.php" class="nav-item nav-link">Places</a> -->
            <a href="contact.php" class="nav-item nav-link <?= ($activePage == 'contact') ? 'active' : ''; ?>">Contact us</a>
        </div>
        <a href="registration.php" class="btn btn-primary px-3 d-none d-lg-block">Registration</a>
    </div>
</nav>
<!-- Navbar End -->