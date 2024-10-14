<?php 

include_once './connection.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $User = "SELECT * FROM admin_users WHERE id = '" . $_SESSION['user_id'] . "'";
  $userQuery = mysqli_query($conn, $User);
} else {
  // If no session, redirect to the login page
  header('Location: index.php');
  exit();
}
$user = mysqli_fetch_array($userQuery);


// Tolat Sales
$saleShow = "SELECT SUM(totalAmount) AS total_sale FROM orders WHERE status = 'Delevered'";
$saleShowQuery = mysqli_query($conn, $saleShow);
if($saleShowQuery){
  $row = mysqli_fetch_array($saleShowQuery);
  $totalSale = $row['total_sale'];
}else{
  $totalSale = 0;
}

// total monthly sale
$monthlySaleShow = "SELECT SUM(totalAmount) AS monthlyTotal_sale 
             FROM orders 
             WHERE status = 'Delevered' 
             AND MONTH(dated) = MONTH(CURRENT_DATE) 
             AND YEAR(dated) = YEAR(CURRENT_DATE)";
$monthlySaleShowQuery = mysqli_query($conn, $monthlySaleShow);
if($monthlySaleShowQuery){
  $row = mysqli_fetch_array($monthlySaleShowQuery);
  $monthlyTotalSale = $row['monthlyTotal_sale'];
}else{
  $monthlyTotalSale = 0;
}


// Total Orders
$totalOrderShow = "SELECT COUNT(*) AS total_orders FROM orders";
$totalOrderShowQuery = mysqli_query($conn, $totalOrderShow);

if($totalOrderShowQuery){
  $row = mysqli_fetch_array($totalOrderShowQuery);
  $totalOrders = $row['total_orders'];
}else{
  $totalOrders = 0;
}

// pending Orders
$pendingOrderShow = "SELECT COUNT(*) AS pending_orders FROM orders WHERE status = 'Pending'";
$pendingOrderShowQuery = mysqli_query($conn, $pendingOrderShow);

if($pendingOrderShowQuery){
  $row = mysqli_fetch_array($pendingOrderShowQuery);
  $pendingOrders = $row['pending_orders'];
}else{
  $pendingOrders = 0;
}

?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin | Eagle Star</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         <?php include_once ('./includes/sidebar.php'); ?>
        <!-- / Menu -->



        <!-- Layout container -->
        <div class="layout-page">
        <!-- navbar -->
        <?php include_once ('./includes/header.php'); ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome <?php echo $user['name']; ?> 🎉</h5>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="./assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="order-1">
                  <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="./assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="./orders.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>Total Sales</span>
                          <h3 class="card-title text-nowrap mb-1">Rs. <?php echo $totalSale; ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <img
                                src="./assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="./orders.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">This Month's Sale</span>
                          <h3 class="card-title mb-2">Rs. <?php echo $monthlyTotalSale; ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="order-3">
                  <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">                              
                            <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt4"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="./orders.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="d-block mb-1">Total Orders</span>
                          <h3 class="card-title text-nowrap mb-2"><?php echo $totalOrders; ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="./orders.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Pending Orders</span>
                          <h3 class="card-title mb-2"><?php echo $pendingOrders; ?></h3>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>

            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="./assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="./assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
