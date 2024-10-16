<!-- PHP -->
<?php
include_once('connection.php');
session_start();

// subcribe form
if(isset($_REQUEST['subscribe'])){
  $subEmail = $_REQUEST['semail'];
  // check email 
  $checkEmail = "SELECT * FROM subscribes WHERE semail = '$subEmail'";
  $check_query = mysqli_query($conn, $checkEmail);
  $email_show = mysqli_fetch_array($check_query);
  if($email_show){
      header('Location: ./products.php?page=1');
  }else{
  $insert = "INSERT INTO subscribes (semail) VALUES ('$subEmail')";
  $insert_query = mysqli_query($conn, $insert);
  if($insert_query){
      header('Location: ./products.php?page=1');
  }else{
      echo "error";
  }
  }
}

// pagination

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$product_per_page = 16;
$start_from = ($page - 1) * $product_per_page;

$search_query = isset($_GET['search_query']) ? mysqli_real_escape_string($conn, $_GET['search_query']) : '';

if (!empty($search_query)) {
  // with search
  $show = "SELECT * FROM products WHERE product_name LIKE '%$search_query%' ORDER BY date DESC LIMIT $start_from, $product_per_page";
} else {
  // without search
  $show = "SELECT * FROM products ORDER BY date DESC LIMIT $start_from, $product_per_page";
}

$show_query = mysqli_query($conn, $show);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Elite Hosiery & Garments</title>
  <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico" />

  <!-- bootstrap css -->
  <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
  <!-- other css -->
  <link rel="stylesheet" href="./vendor/others/css/owl.css" />

  <link rel="stylesheet" href="./vendor/others/css/owl.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="./assets/css/style.css" />

</head>

<body>
  <!-- spinner start -->
  <div class="spinner-wrapper">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- header start -->
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="./assets/images/eaglestar_logo.png" alt="" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="products.php?page=1">Products</a>
              <span class="sr-only">(current)</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
            <?php 
            $count = 0;
            if(isset($_SESSION['cart'])){
                $count = count($_SESSION['cart']);
            }
            ?>
            <li class="nav-item cart">
              <a class="nav-link" href="my_cart.php"><i class="fas fa-shopping-cart"></i>
                <span class="cart-count">
                  <?php echo $count; ?>
                </span>
              </a>

            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- header end -->

  <!-- main start -->
  <div class="main">
    <!-- product section start -->

    <div class="featured-page">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="section-heading">
              <div class="line"></div>
              <h1 class="heading">Our Products</h1>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-8 mt-4 mt-md-0 mt-lg-0">
                <form action="" method="get">
                  <fieldset>
                    <input type="text" name="search_query" class="form-control mt-4" id="name" placeholder="Search Here...">
                  </fieldset>
              </div>
              <div class="col-md-4 mt-4 mt-md-0 mt-lg-0">
                <fieldset>
                  <button type="submit" id="form-submit" class="btn search_button mt-4" name="search">
                    Search
                  </button>
                </fieldset>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <div class="container featured no-gutter">
      <div class="row posts">
        <?php
        // show data in card from database
        while ($row = mysqli_fetch_assoc($show_query)) {
          $imagePath = "./admin/123/product_images/" . $row['image'];
          $pName = $row['product_name'];
          $productId = $row['id'];
          $pPrice = $row['price'];
          $pcode = $row['productCode'];
        ?>

        <div id="1" class="item new col-md-3 mt-4">
          <form action="manage_cart.php" method="POST">
            <div class="featured-item" id="product">
              <img src="<?php echo $imagePath; ?>" alt="<?php echo $pName; ?>" class="productImg"
                style="height: 250px; width: 330" />
              <h4>
                <?php echo $pName; ?>
              </h4>
              <h6>
                Rs.
                <?php echo $pPrice; ?>
              </h6>
              <label for="quantity">Quantity:</label>
              <input value="1" name="quantity" type="number" class="form-control quantity-text-card" id="quantity">
              <input type="hidden" value="<?php echo $productId?>" name="productId">
              <input type="hidden" value="<?php echo $pcode?>" name="productCode">
              <input type="hidden" value="<?php echo $pName?>" name="productName">
              <input type="hidden" value="<?php echo $pPrice?>" name="productPrice">
              <div class="row">
                <div class="col-md-5 mt-2">
                  <a class="btn btn-primary btn-p" href="single-product.php?id=<?php echo $row['id'] ?>" value=""
                    style="width: 100%;">Details</a>
                </div>
                <div class="col-md-7 mt-2">
                  <button class="btn btn-primary btn-p" name="add_to_cart" style="width: 100%;">Add to Cart</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <?php } ?>
      </div>

      <?php

$pr_query = "SELECT * FROM products";
if (!empty($search_query)) {
    $pr_query .= " WHERE product_name LIKE '%$search_query%'";
}

$pr_result = mysqli_query($conn, $pr_query);
$total_record = mysqli_num_rows($pr_result);

$product_per_page = 16; 
$total_pages = ceil($total_record / $product_per_page);

echo '<div class="container mt-4">';
echo '<nav aria-label="...">';
echo '<ul class="pagination justify-content-center">';

// Previous button
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $prev_page = $_GET['page'] - 1;
    echo '<li class="page-item"><a class="page-link" href="products.php?page=' . $prev_page . '&search_query=' . $search_query . '">Previous</a></li>';
} else {
    echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
}

// Page numbers
for ($i = 1; $i <= $total_pages; $i++) {
    if (isset($_GET['page']) && $_GET['page'] == $i) {
        echo '<li class="page-item active active-page" aria-current="page"><a class="page-link active-page" href="products.php?page=' . $i . '&search_query=' . $search_query . '">' . $i . '</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="products.php?page=' . $i . '&search_query=' . $search_query . '">' . $i . '</a></li>';
    }
}

// Next button
if (isset($_GET['page']) && $_GET['page'] < $total_pages) {
    $next_page = $_GET['page'] + 1;
    echo '<li class="page-item"><a class="page-link" href="products.php?page=' . $next_page . '&search_query=' . $search_query . '">Next</a></li>';
} elseif (!isset($_GET['page']) || $_GET['page'] == $total_pages) {
    echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
}

echo '</ul>';
echo '</nav>';
echo '</div>';

?>


    </div>


    <!-- product section end -->

    <!-- subscribe-form start -->

    <div class="subscribe-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line"></div>
              <h1>Subscribe on Eagle Star Hosiery & Garments</h1>
            </div>
          </div>
          <div class="col-md-8 offset-md-2">
            <div class="container">
              <form id="subscribe" action="" method="get">
                <div class="row">
                  <div class="col-md-7">
                    <fieldset>
                      <input type="email" name="semail" id="" placeholder="Enter your email" class="form-control" />
                    </fieldset>
                  </div>
                  <div class="col-md-5">
                    <fieldset>
                      <button type="submit" id="form-submit" class="btn button mt-2 mt-md-0 mt-lg-0" name="subscribe">
                        Subscribe Now!
                      </button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- subscribe-form end -->
  </div>
  <!-- main end -->
  <!-- footer start -->

  <!-- footer start -->

  <div class="footer">
    <div class="container mt-4 d-flex justify-content-center">
      <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
          <img src="./assets/images/eaglestar_logo.png" alt="" class="footer-logo" />
        </div>
        <div class="col-md-12 mt-2">
          <div class="social-icons">
            <ul class="d-flex justify-content-center">
              <li><a href=""><i class="fab fa-facebook mt-2"></i></a></li>
              <li class="ml-4"><a href="#"><i class="fab fa-whatsapp mt-2"></i></a></li>
              <li class="ml-4"><a href="#"><i class="fab fa-linkedin mt-2"></i></a></li>
              <li class="ml-4"><a href="#"><i class="fab fa-instagram mt-2"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="./vendor/jquery/jquery.slim.min.js"></script>

  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Additional Scripts -->
  <script src="./vendor/jquery/jquery.min.js"></script>
  <script src="./vendor/others/js/owl.js"></script>
  <!-- Additional Scripts -->
  <script src="assets/js/main.js"></script>

  <script>
    // spinner

    const spinnerWrapperEl = document.querySelector('.spinner-wrapper');

    window.addEventListener('load', () => {
      spinnerWrapperEl.style.opacity = '0';

      setTimeout(() => {
        spinnerWrapperEl.style.display = 'none';
      }, 200);
    });
  </script>
</body>

</html>