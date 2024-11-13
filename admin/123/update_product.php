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


// show product
$updateId = $_GET['updateId'];
$select = "SELECT * FROM products WHERE id = '$updateId'";
$selectQuery = mysqli_query($conn, $select);
$show = mysqli_fetch_assoc($selectQuery);

// update product
// show product
$updateId = $_GET['updateId'];
$select = "SELECT * FROM products WHERE id = '$updateId'";
$selectQuery = mysqli_query($conn, $select);
$show = mysqli_fetch_assoc($selectQuery);

// update product
if (isset($_POST['update'])) {
    $productName = $conn->real_escape_string($_POST['productName']);
    $productPrice = $conn->real_escape_string($_POST['product_price']);
    $productCode = $conn->real_escape_string($_POST['productCode']);
    $productType = $conn->real_escape_string($_POST['productType']);

    // Prepare the SQL update statement
    $update = "UPDATE products SET product_name = '$productName', productType = '$productType', price = '$productPrice', productCode = '$productCode' WHERE id = '$updateId'";
    $updateQuery = mysqli_query($conn, $update);
    
    if ($updateQuery) {
        echo "<script>
        alert('Product Updated Successfully.');
        window.location.href='products_manage.php';
        </script>";
    } else {
        echo "<script>
        alert('Error in updating: " . mysqli_error($conn) . "');
        window.location.href='products_manage.php';
        </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin | Eagle Star</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

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
            <div class=""></div>
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Update Product</h4>

            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Product Details</h5>
                  <!-- product -->
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">Product Name</label>
                          <input class="form-control" type="text" name="productName" placeholder="Enter Product Name" value="<?php echo $show['product_name']; ?>"
                            autofocus required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="lastName" class="form-label">Product Code</label>
                          <input class="form-control" type="text" name="productCode" placeholder="product Code" value="<?php echo $show['productCode']; ?>"
                            required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="language" class="form-label">Product type</label>
                          <select id="language" class="select2 form-select" name="productType" value="<?php echo $show['productType']; ?>">
                            <option value=""><?php echo $show['productType']; ?></option>
                            <option value="Featured">Featured</option>
                            <option value="common">Common</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="organization" class="form-label">Product Price</label>
                          <input type="number" class="form-control" name="product_price"
                            placeholder="Enter Product Price" value="<?php echo $show['price']; ?>" />
                        </div>
                      </div>
                      <div class="mt-2">
                        <button type="submit" name="update" class="btn btn-primary me-2">Update Product</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                      </div>
                    </form>
                  </div>
                  <!-- /products -->
                </div>
              </div>
            </div>
            <hr>

            <!-- products display -->

          </div>
          <!-- / Content -->

        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->

    </div>

  </div>


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
  <script src="./assets/js/pages-account-settings-account.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>


</body>

</html>