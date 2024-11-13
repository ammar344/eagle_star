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


$targetDir = 'product_images/';
$alertMessage = "";
// upload function

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['upload'])) {
    $productName = $conn->real_escape_string($_REQUEST['productName']);
    $productPrice = $conn->real_escape_string($_REQUEST['product_price']);
    $productCode = $conn->real_escape_string($_REQUEST['productCode']);
    $productType = $conn->real_escape_string($_REQUEST['productType']);
    $description = $conn->real_escape_string($_REQUEST['description']);

    foreach ($_FILES['images']['name'] as $key => $name) {
        $imageName = $conn->real_escape_string($name);
        $filePath = $targetDir . basename($name);
        $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

        // Check if file type is allowed
        $allowedTypes = array('jpg', 'jpeg', 'png');
        if (!in_array(strtolower($fileType), $allowedTypes)) {
          // $errorMessage = "Only .jpg, .jpeg, and .png files are allowed.";
          echo "<script>
          alert('Only .jpg, .jpeg, and .png files are allowed.');
          window.location.href='products_manage.php';
          </script>";
          continue;
        }

        // Check if image already exists
        $check = "SELECT * FROM products WHERE image = '$imageName'";
        $checkQuery = mysqli_query($conn, $check);
        if (mysqli_num_rows($checkQuery) > 0) {
          echo "<script>
          alert('Image Already existed.');
          window.location.href='products_manage.php';
          </script>";
            continue;
        } else {
            // Upload image to the server
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $filePath)) {
                $imagePath = $conn->real_escape_string($filePath);
                $insert = "INSERT INTO products (product_name, image, productType, price, productCode, description) VALUES ('$productName', '$imageName', '$productType', '$productPrice', '$productCode', '$description')";
                $insertQuery = mysqli_query($conn, $insert);
                if ($insertQuery) {
                  echo "<script>
                  alert('Product Uploaded Successfully.');
                  window.location.href='products_manage.php';
                  </script>";
                } else {
                  $errorMessage = "Error: " . mysqli_error($conn);
                  echo "<script>
                  alert('" . addslashes($errorMessage) . "');
                  window.location.href='products_manage.php';
                  </script>";
                }
            } else {
              echo "<script>
              alert('Failed to Upload Image.');
              window.location.href='products_manage.php';
              </script>";
            }
        }
    }
}

// show products
if (isset($_POST['search'])) {
  // Get the search input
  $search = mysqli_real_escape_string($conn, $_POST['searchProduct']);

  // Query to search for products based on product name, code, or type
  $show = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR productCode LIKE '%$search%' OR productType LIKE '%$search%' ORDER BY date DESC";
} else {
  // If no search, show all products
  $show = "SELECT * FROM products ORDER BY date DESC";
}

$showQuery = mysqli_query($conn, $show);

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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage Products</h4>

            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Product Details</h5>
                  <!-- product -->
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="./assets/img/avatars/8.jpg" alt="user-avatar" class="d-block rounded" height="100"
                          width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload Produt Image</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden
                              accept="image/png, image/png, image/jpeg" name="images[]" multiple required />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">Product Name</label>
                          <input class="form-control" type="text" name="productName" placeholder="Enter Product Name"
                            autofocus required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="lastName" class="form-label">Product Code</label>
                          <input class="form-control" type="text" name="productCode" placeholder="product Code"
                            required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="language" class="form-label">Product type</label>
                          <select id="language" class="select2 form-select" name="productType" required>
                            <option value="">Select Product Type</option>
                            <option value="Featured">Featured</option>
                            <option value="common">Common</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="organization" class="form-label">Product Price</label>
                          <input type="number" class="form-control" name="product_price"
                            placeholder="Enter Product Price" required/>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="organization" class="form-label">Product Description</label>
                          <textarea class="form-control" name="description"
                            placeholder="Enter product's description" rows="7" required></textarea>
                        </div>
                      </div>
                      <div class="mt-2">
                        <button type="submit" name="upload" class="btn btn-primary me-2">Upload Product</button>
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
            <div class="card">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="card-header">Products</h5>
                </div>

              </div>


              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-head">
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <?php
                    $i = 1;
                    while($row = mysqli_fetch_array($showQuery)){
                      
                      $pId = $row['id'];
                      $pName = $row['product_name'];
                      $pCode = $row['productCode'];
                      $pType = $row['productType'];
                      $pPrice = $row['price'];

                    
                    ?>
                  <tbody class="table-border-bottom-0">
                    <tr>
                      <td>
                        <?php echo $i ?>
                      </td>
                      <td>
                        <?php echo $pName ?>
                      </td>
                      <td>
                        <?php echo $pCode ?>
                      </td>
                      <td>
                        <?php echo $pType ?>
                      </td>
                      <td>
                        <?php echo $pPrice ?>
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="server.php?deleteId=<?php echo $pId ?>"><i
                                class="bx bx-trash me-1"></i> Delete</a>
                                <a class="dropdown-item" href="update_product.php?updateId=<?php echo $pId ?>"><i class='bx bx-shield-plus'></i> Update</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <?php $i++; } 
                     ?>
                </table>
              </div>

            </div>
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