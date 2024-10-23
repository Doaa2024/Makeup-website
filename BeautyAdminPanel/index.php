<?php
include 'db.php';
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
$orders = [];
$totalorders = 0;

// Check if there are results
if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
    $totalorders++;
  }
}
$sql2 = "SELECT Count(`UserName`) AS total FROM `users`";
$result2 = $conn->query($sql2);

// Check if there are results
if ($result2->num_rows > 0) {
  // Fetch the total price
  $row2 = $result2->fetch_assoc();
  $customernumber = $row2['total'];
}
$sql3 = "SELECT `username`, MAX(CAST(`total_price` AS DECIMAL(10,2))) AS max_total_price
        FROM `orders`
        GROUP BY `username`
        ORDER BY max_total_price DESC
        LIMIT 1";
$result3 = $conn->query($sql3);

// Check if there are results
if ($result3->num_rows > 0) {
  // Fetch the customer with highest total_price
  $row3 = $result3->fetch_assoc();
  $customerName = $row3['username'];
}
$sql4 = "SELECT SUM(CAST(`total_price` AS DECIMAL(10,2))) AS total_income
        FROM `orders`";
$result4 = $conn->query($sql4);

// Check if there are results
if ($result4->num_rows > 0) {
  // Fetch the total income
  $row4 = $result4->fetch_assoc();
  $totalIncome = $row4['total_income'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
  <title>Admin Panel</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
  <!-- ======== Preloader =========== -->
  <div id="preloader">
    <div class="spinner"></div>
  </div>
  <!-- ======== Preloader =========== -->
  <?php require_once('components/sidenavbar.php'); ?>

  <!-- ======== main-wrapper start =========== -->
  <main class="main-wrapper">
    <!-- ========== header start ========== -->
    <?php require_once('components/header.php'); ?>
    <!-- ========== header end ========== -->

    <!-- ========== section start ========== -->
    <section class="section">
      <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="title">
                <h2>Beauty Dashboard</h2>
              </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
              <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#0">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      eCommerce
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="icon purple">
                <i class="lni lni-cart-full"></i>
              </div>
              <div class="content">
                <h6 class="mb-10">Orders</h6>
                <h3 class="text-bold mb-10"><?= $totalorders ?></h3>

              </div>
            </div>
            <!-- End Icon Cart -->
          </div>
          <!-- End Col -->
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="icon success">
                <i class="lni lni-dollar"></i>
              </div>
              <div class="content">
                <h6 class="mb-10">Total Income</h6>
                <h3 class="text-bold mb-10"><?= $totalIncome ?></h3>

              </div>
            </div>
            <!-- End Icon Cart -->
          </div>
          <!-- End Col -->
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="icon primary">
                <i class="lni lni-credit-cards"></i>
              </div>
              <div class="content">
                <h6 class="mb-10">Top User</h6>
                <h3 class="text-bold mb-10"><?= $customerName ?></h3>

              </div>
            </div>
            <!-- End Icon Cart -->
          </div>
          <!-- End Col -->
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="icon orange">
                <i class="lni lni-user"></i>
              </div>
              <div class="content">
                <h6 class="mb-10">Users</h6>
                <h3 class="text-bold mb-10"><?= $customernumber ?></h3>

              </div>
            </div>
            <!-- End Icon Cart -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->



        <!-- End Row -->

        <!-- End Col -->
        <div class="col-lg-7 ">
          <div class="card-style mb-30" style="align-items:center">
            <div class="title d-flex flex-wrap justify-content-between align-items-center">
              <div class="left">
                <h6 class="text-medium mb-30">Orders Table</h6>
              </div>

            </div>
            <!-- End Title -->
            <div class="table-responsive align-items-center">
              <table class="table top-selling-table align-items-center">
                <thead>
                  <tr>
                    <th></th>
                    <th>
                      <h6 class="text-sm text-medium">OrderID</h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">Customer_Name</h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">Location</h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">Total_Balance</h6>
                    </th>


                  </tr>
                </thead>
                <?php foreach ($orders as $order) : ?>
                  <tr>
                    <td></td>
                    <td><?= $order['OrderID'] ?></td>
                    <td><?= $order['username'] ?></td>
                    <td><?= $order['location'] ?></td>
                    <td><?= $order['total_price'] ?>$</td>
                  </tr>
                <?php endforeach; ?>
              </table>
              <!-- End Table -->
            </div>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->


      </div>
      <!-- end container -->
    </section>
    <!-- ========== section end ========== -->

    <!-- ========== footer start =========== -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-last order-md-first">
            <div class="copyright text-center text-md-start">
              <p class="text-sm">
                Designed and Developed by

                Doaa

              </p>
            </div>
          </div>
          <!-- end col-->
          <div class="col-md-6">
            <div class="terms d-flex justify-content-center justify-content-md-end">
              <a href="#0" class="text-sm">Term & Conditions</a>
              <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->

  <!-- ========= All Javascript files linkup ======== -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>


  <script src="assets/js/moment.min.js"></script>

  <script src="assets/js/jvectormap.min.js"></script>
  <script src="assets/js/world-merc.js"></script>
  <script src="assets/js/polyfill.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    // ======== jvectormap activation
  </script>
</body>

</html>