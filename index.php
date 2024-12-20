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
        header('Location: ./index.php');
    }else{
    $insert = "INSERT INTO subscribes (semail) VALUES ('$subEmail')";
    $insert_query = mysqli_query($conn, $insert);
    if($insert_query){
        header('Location: ./index.php');
    }else{
        echo "error";
    }
    }
}

$show = "SELECT * FROM products WHERE productType = 'featured' ORDER BY date DESC";
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
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php?page=1">Products</a>
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
        <!-- banner start -->
        <div class="container-fluid banner">
        </div>
        <!-- banner end -->

        <!-- featured section start -->

        <div class="featured-items">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <div class="line"></div>
                            <h1 class="heading">Featured Items</h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme owl-card">
                                <?php
                                // show data in card from database
                                while ($row = mysqli_fetch_assoc($show_query)) {
                                    $imagePath = "./admin/123/product_images/" . $row['image'];
                                    $fName = $row['product_name'];
                                    $fprice = $row['price'];
                                ?>
                                    <a href="single-product.php?id=<?php echo $row['id'] ?>">
                                        <div class="featured-item">
                                            <img src="<?php echo $imagePath; ?>" alt="<?php echo $pName; ?>" alt="" />
                                            <h4>
                                                <?php echo $fName; ?>
                                            </h4>
                                            <h6>
                                                Rs. <?php echo $fprice; ?>
                                            </h6>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- featured section end -->
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
                                            <input type="email" name="semail" id="" placeholder="Enter your email"
                                                class="form-control" required/>
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
                            <li><a href="#" class="ml-4"><i class="fab fa-instagram mt-2"></i></a></li>
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