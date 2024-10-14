<!-- PHP -->
<?php
include_once('connection.php');
session_start();

// contact form
if (isset($_REQUEST['submit'])) {
    $cName = $_REQUEST['name'];
    $cEmail = $_REQUEST['cemail'];
    $cSubject = $_REQUEST['subject'];
    $cMessage = $_REQUEST['message'];

    $insert = "INSERT INTO contact_us (cName, cEmail, cSubject, cMessage) VALUES ('$cName', '$cEmail', '$cSubject', '$cMessage')";
    $insert_query = mysqli_query($conn, $insert);
    if ($insert_query) {
        header('Location: ./contact.php');
    } else {
        echo "error";
    }

}

// subcribe form
if (isset($_REQUEST['subscribe'])) {
    $subEmail = $_REQUEST['semail'];
    // check email 
    $checkEmail = "SELECT * FROM subscribes WHERE semail = '$subEmail'";
    $check_query = mysqli_query($conn, $checkEmail);
    $email_show = mysqli_fetch_array($check_query);
    if ($email_show) {
        header('Location: ./contact.php');
    } else {
        $insert = "INSERT INTO subscribes (semail) VALUES ('$subEmail')";
        $insert_query = mysqli_query($conn, $insert);
        if ($insert_query) {
            header('Location: ./contact.php');
        } else {
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
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="contact.php">Contact Us
                                <span class="sr-only">(current)</span>
                            </a>
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
        <!-- main content start -->
        <div class="contact-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <div class="line"></div>
                            <h1 class="heading">Contact Us</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d215.71371778760968!2d73.07392874285077!3d31.408234308525145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392242b0745ee219%3A0x9dbfb24b2427e1c!2sQuaid-e-Azam%20Market%2C%20Sir%20Syed%20Town%2C%20Faisalabad%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1723966280127!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-content">
                            <div class="container">
                                <form action="" id="contact">
                                    <div class="row">
                                        <div class="col-md-6 mt-4 mt-md-0 mt-lg-0">
                                            <fieldset>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 mt-4 mt-md-0 mt-lg-0">
                                            <fieldset>
                                                <input type="email" name="cemail" class="form-control" id="email" placeholder="Enter Email...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <fieldset>
                                                <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <fieldset>
                                                <textarea name="message" id="message" rows="6" class="form-control" placeholder="Enter your message here..."></textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-5 mt-4 mb-4">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn contact_button mt-2 mt-md-0 mt-lg-0" name="submit">
                                                    Submit!
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
        </div>
        <!-- main content end -->
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
                                                class="form-control" />
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