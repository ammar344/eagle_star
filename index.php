<!-- PHP -->
<?php
include_once('admin/connection.php');

$show = "SELECT * FROM featured_items";
$show_query = mysqli_query($conn, $show);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Elite Hosiery & Garments</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <!-- other css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact Us</a>
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
                            <div class="owl-carousel owl-theme">
                                <?php
                                // show data in card from database
                                while ($row = mysqli_fetch_assoc($show_query)) {
                                    $imagePath = "./admin/featured_images/" . $row['featured_image'];
                                    $fName = $row['featured_name'];
                                    $fprice = $row['featured_price'];
                                ?>
                                    <a href="">
                                        <div class="featured-item">
                                            <img src="<?php echo $imagePath; ?>" alt="<?php echo $pName; ?>" alt="" />
                                            <h4>
                                                <?php echo $fName; ?>
                                            </h4>
                                            <h6>
                                                <?php echo $fprice; ?>
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
                            <form id="subscribe" action="admin/server.php" method="get">
                                <div class="row">
                                    <div class="col-md-7">
                                        <fieldset>
                                            <input type="email" name="semail" id="" placeholder="Enter your email"
                                                class="form-control" />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-5">
                                        <fieldset>
                                            <input type="hidden" name="cmd" value="subscribe">
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
                            <li><a href=""><i class="fa fa-facebook mt-2"></i></a></li>
                            <li class="ml-4"><a href="#"><i class="fa fa-twitter mt-2"></i></a></li>
                            <li class="ml-4"><a href="#"><i class="fa fa-linkedin mt-2"></i></a></li>
                            <li><a href="#" class="ml-4"><i class="fa fa-rss mt-2"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- Additional Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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