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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders</span></h4>


              <!-- Bootstrap Table with Header - Dark -->
              <div class="card mb-5">
                <h5 class="card-header">Today,s Orders</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-height">
                    <thead class="table-head">
                      <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>Product Id</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Phone no.</th>
                        <th>Shipping Address</th>
                        <th>status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <?php 
                    $showToday = "SELECT * FROM orders WHERE DATE(dated) = CURDATE() ORDER BY dated DESC";
                    $showTodayQuery = mysqli_query($conn, $showToday);

                    $i = 1;
                    while($row = mysqli_fetch_array($showTodayQuery)){
                      $orderId = $row['id'];
                      $productId = $row['productId'];
                      $productCode = $row['productCode'];
                      $quantity = $row['quantity'];
                      $totalAmount = $row['totalAmount'];
                      $customerName = $row['customerName'];
                      $phone = $row['customerPhone'];
                      $address = $row['shippingAddress'];
                      $status = $row['status'];  
                                     
                    ?>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $customerName ?></td>
                        <td><?php echo $productId ?></td>
                        <td><?php echo $productCode ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $totalAmount ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $address ?></td>
                        <td><?php echo $status ?></td>

                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="server.php?orderStatusId=<?php echo $orderId ?>"
                                ><i class="bx bx-check me-1"></i> Delevered</a
                              >
                              <a class="dropdown-item" href="server.php?orderDeleteId=<?php echo $orderId ?>"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    <?php $i++; } ?>
                  </table>
                </div>
              </div>
              <hr>
              <div class="card mb-5">
                <h5 class="card-header">Pending Orders</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-height">
                    <thead class="table-head">
                      <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>Product Id</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Phone no.</th>
                        <th>Shipping Address</th>
                        <th>status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <?php 
                    $showPending = "SELECT * FROM orders WHERE status = 'pending' ORDER BY dated DESC";
                    $showPendingQuery = mysqli_query($conn, $showPending);

                    $i = 1;
                    while($row = mysqli_fetch_array($showPendingQuery)){
                      $orderId = $row['id'];
                      $productId = $row['productId'];
                      $productCode = $row['productCode'];
                      $quantity = $row['quantity'];
                      $totalAmount = $row['totalAmount'];
                      $customerName = $row['customerName'];
                      $phone = $row['customerPhone'];
                      $address = $row['shippingAddress'];
                      $status = $row['status'];  
                                     
                    ?>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $customerName ?></td>
                        <td><?php echo $productId ?></td>
                        <td><?php echo $productCode ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $totalAmount ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $address ?></td>
                        <td><?php echo $status ?></td>

                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="server.php?orderStatusId=<?php echo $orderId ?>"
                                ><i class="bx bx-check me-1"></i> Delevered</a
                              >
                              <a class="dropdown-item" href="server.php?orderDeleteId=<?php echo $orderId ?>"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    <?php $i++; } ?>
                  </table>
                </div>
              </div>
              <hr>
              <div class="card mb-5">
                <h5 class="card-header">Delevered Orders</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-height">
                    <thead class="table-head">
                      <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>Product Id</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Phone no.</th>
                        <th>Shipping Address</th>
                        <th>status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <?php 
                    $show = "SELECT * FROM orders WHERE status = 'delevered' ORDER BY dated DESC";
                    $showQuery = mysqli_query($conn, $show);
                    
                    $i = 1;
                    while($row = mysqli_fetch_array($showQuery)){
                      $productId = $row['productId'];
                      $productCode = $row['productCode'];
                      $quantity = $row['quantity'];
                      $totalAmount = $row['totalAmount'];
                      $customerName = $row['customerName'];
                      $phone = $row['customerPhone'];
                      $address = $row['shippingAddress'];
                      $status = $row['status'];  
                                     
                    ?>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $customerName ?></td>
                        <td><?php echo $productId ?></td>
                        <td><?php echo $productCode ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $totalAmount ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $address ?></td>
                        <td><?php echo $status ?></td>

                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="server.php?orderDeleteId=<?php echo $orderId ?>"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    <?php $i++; } ?>
                  </table>
                </div>
              </div>
              <!--/ Bootstrap Table with Header Dark -->

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

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
