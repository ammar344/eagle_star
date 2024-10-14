<?php 
include_once('connection.php');
session_start();

$productId = $_GET['id'];
// echo $productId;
$selectProduct = "SELECT * FROM products WHERE id = '$productId'";
$selectQuery = mysqli_query($conn, $selectProduct);
// $row = mysqli_fetch_assoc($selectQuery);
if(isset($_REQUEST['order'])){

        $proId = $_REQUEST['productId'];
        $productPrice = $_REQUEST['productPrice'];
        $productCode = $_REQUEST['productCode'];
        $quantity = $_REQUEST['quantity'];
        $costumerName = $_REQUEST['name'];
        $customerPhone = $_REQUEST['phoneNumber'];
        $shippingAddress = $_REQUEST['address'];
        $status = 'Pending';

        $totalAmount = $productPrice * $quantity;
    
        $insert = "INSERT INTO orders (productId, productCode, quantity, totalAmount, profit, customerName, customerPhone, shippingAddress, status) VALUES ('$proId', '$productCode', '$quantity', '$totalAmount', '$profit', '$costumerName', '$customerPhone', '$shippingAddress', '$status')";
        $insertQuery = mysqli_query($conn, $insert);
        if($insertQuery){
            header('Location: products.php?page=1');
        }else{
            echo "Error";
        }
        
    }

    // subscribe
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

    <!-- Single Starts Here -->
    <div class="main">
        <!-- main content start -->
        <div class="single-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <div class="line"></div>
                            <h1 class="heading">Product Detail</h1>
                        </div>
                    </div>
                    <?php
        // show data in card from database
        while ($row = mysqli_fetch_assoc($selectQuery)) {
          $imagePath = "./admin/123/product_images/" . $row['image'];
          $productId = $row['id'];
          $pName = $row['product_name'];
          $pPrice = $row['price'];
          $pcode = $row['productCode'];
          $pDescription = $row['description'];
          
        ?>
                    <div class="col-md-5 mt-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col m-0 p-0">
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $pName; ?>" class="order-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-content">
                            <h4>
                                <?php echo $pName; ?>
                            </h4>
                            <h6>Rs.
                                <?php echo $pPrice; ?>
                            </h6>
                            <span class="productCode"><b>Product Code:</b>
                                <?php echo $pcode; ?>
                            </span>
                            <p>
                                <?php echo $pDescription; ?>
                            </p>
                            <span><b>Availibilty:</b> In Stock</span>
                            <form action="manage_cart.php" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 m-0 p-0">
                                            <fieldset>
                                                <label for="quantity">Quantity:</label>
                                                <input value="1" name="quantity" type="quantity"
                                                    class="form-control quantity-text" id="quantity">
                                            </fieldset>
                                        </div>
                                        <input type="hidden" value="<?php echo $productId?>" name="productId">
                                        <input type="hidden" value="<?php echo $pcode?>" name="productCode">
                                        <input type="hidden" value="<?php echo $pName?>" name="productName">
                                        <input type="hidden" value="<?php echo $pPrice?>" name="productPrice">
                                        <div class="col-md-4 mt-4 ml-0 pl-0">
                                            <input type="submit" class="button order-button" value="Add to Cart"
                                                name="add_to_cart">
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- main content end -->
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
                                                    class="form-control" />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit"
                                                    class="btn button mt-2 mt-md-0 mt-lg-0" name="subscribe">
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
        <!-- Single Page Ends Here -->
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