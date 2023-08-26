<?php include_once './includes/header.php'; ?>

<!-- Content -->
<?php

require_once 'config.php';
$user = new User();

// Fetch user data for the current page
$users = $user->getDashboard();
?>
<div class="container">
  <div class="row" style="margin-top:20px;">
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-primary">
              <div class="card-header"><i class="fa fa-shopping-bag"></i> Total Users</div>
              <div class="card-body">
                <h3 class="card-title"><?php echo $users['total_users']; ?></h3>
              </div>
              <a class="card-footer text-right" href="users.php">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-success">
              <div class="card-header"><i class="fa fa-bar-chart"></i> Paid Users</div>
              <div class="card-body">
                <h3 class="card-title"><?php echo $users['paid_users']; ?></h3>
              </div>
              <a class="card-footer text-right" href="users.php?status=paid">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-warning">
              <div class="card-header"><i class="fa fa-user-plus"></i> Unpaid Users</div>
              <div class="card-body">
                <h3 class="card-title"><?php echo $users['unpaid_users']; ?></h3>
              </div>
              <a class="card-footer text-right" href="users.php?status=unpaid">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-danger">
              <div class="card-header"><i class="fa fa-pie-chart"></i> Paid Amount</div>
              <div class="card-body">
                <h3 class="card-title"><?php echo $users['paid_amount']['amount']; ?></h3>
              </div>
              <a class="card-footer text-right" href="users.php?status=paid">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
</div>


<?php include_once './includes/footer.php'; ?>