<!-- php -->
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
        header('Location: ./about.php');
    }else{
    $insert = "INSERT INTO subscribes (semail) VALUES ('$subEmail')";
    $insert_query = mysqli_query($conn, $insert);
    if($insert_query){
        header('Location: ./about.php');
    }else{
        echo "error";
    }
    }
}
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

  <link rel="stylesheet"
    href="./vendor/others/css/owl.css" />
  <!-- custom css -->
  <link rel="stylesheet" href="./assets/css/style.css" />

</head><head>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php?page=1">Products</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="about.php">About Us
                                <span class="sr-only">(current)</span>
                            </a>
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
    <!-- about page content start -->

    <div class="main">
        <div class="about-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <div class="line"></div>
                            <h1 class="heading">About Eagle Star</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="left-image">
                            <img src="./assets/images/about-us.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 mt-4 mt-md-0 mt-lg-0">
                        <div class="right-content">
                            <div class="container">
                                <p>
                                    Welcome to <strong>Eagle Star Hosiery and Garments</strong>, your trusted name for quality hosiery and
                                    garments. For over [number] years, we've been dedicated to creating products that combine
                                    comfort, style, and durability.
                                </p>
                                <br>
                                <p>
                                    Our journey began with a simple vision: to create garments that not only meet the highest
                                    standards of quality but also cater to the diverse needs of our customers. Today, we are
                                    proud to be recognized for our innovative designs, superior craftsmanship, and unwavering
                                    dedication to customer satisfaction.
                                </p>
                                <br>
                                <p>
                                    Our range includes socks, stockings, leggings, and more, all crafted with the finest
                                    materials and the latest technology. We believe in making fashion accessible and
                                    sustainable, with eco-friendly practices at the core of our production.
                                </p>
                                <br>
                                <p>
                                    Choose Eagle Star for everyday essentials that keep you stylish, comfortable, and confident.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- subscribe-form start -->

        <div class="subscribe-form mt-4">
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
    <!-- footer end -->


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