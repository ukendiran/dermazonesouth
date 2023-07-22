 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
     <div class="container">
         <a class="navbar-brand text-white" href="<?= $adminurl; ?>">Dermazone</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     <a class="nav-link text-white " href="<?php echo $adminurl; ?>">Home</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white" href="<?php echo $baseurl; ?>">Site</a>
                 </li>
                 <!-- Add more navigation items here if needed -->
                 <li class="nav-item dropdown">
                     <a class="nav-link text-white dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Profile
                     </a>
                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                         <a class="dropdown-item" href="#">Profile</a>
                         <a class="dropdown-item" href="#">Settings</a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="<?= $adminurl; ?>logout.php">Logout</a>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </nav>