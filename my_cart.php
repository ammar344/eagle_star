<!-- PHP -->
<?php
include_once('connection.php');
session_start();

// place order
if($_SERVER["REQUEST_METHOD"]=="POST"){
  foreach($_SESSION['cart'] as $key => $value){
  $productId = $value['productId'];
  $productCode = $value['productCode'];
  $productPrice = $value['productPrice'];
  $quantity = $value['quantity'];

  if(isset($_REQUEST['order'])){

        $proId = $productId;
        $productCode = $productCode;
        $productPrice = $productPrice;
        $quantity = $quantity;
        $costumerName = $_REQUEST['name'];
        $customerPhone = $_REQUEST['phoneNumber'];
        $shippingAddress = $_REQUEST['address'];
        $status = 'Pending';

        $totalAmount = $productPrice * $quantity;
    
        $insert = "INSERT INTO orders (productId, productCode, quantity, totalAmount, customerName, customerPhone, shippingAddress, status) VALUES ('$proId', '$productCode', '$quantity', '$totalAmount', '$costumerName', '$customerPhone', '$shippingAddress', '$status')";
        $insertQuery = mysqli_query($conn, $insert);
        if($insertQuery){
          echo "<script>
          alert('Order placed Successfully');
          window.location.href='products.php?page=1';
          </script>";

          unset($_SESSION['cart']);

        }else{
          echo "<script>
          alert('Error in placing order');
          window.location.href='my_cart.php';
          </script>";

        }
        
    }
  }

}
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
  <!-- <div class="spinner-wrapper">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div> -->
  <!-- </div> -->
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
            <li class="nav-item cart active">
              <a class="nav-link" href="my_cart.php"><i class="fas fa-shopping-cart"></i>
                <span class="sr-only">(current)</span>
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
    <div class="cart-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line"></div>
              <h1 class="heading">My cart</h1>
            </div>
          </div>
          <div class="col-md-8">
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-head text-center">
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Price (Rs.)</th>
                    <th>Quantity</th>
                    <th>Total (Rs.)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php
                  if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                    $i = 1;
                    foreach($_SESSION['cart'] as $key => $value){
                        

                  ?>
                <tbody class="table-border-bottom-0 text-center">
                  <tr>
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php echo $value['productName']; ?>
                    </td>
                    <td>
                      <?php echo $value['productCode']; ?>
                    </td>
                    <td>
                      <?php echo $value['productPrice']; ?>
                      <input type="hidden" name="iPrice" value="<?php echo $value['productPrice']; ?>" class="iPrice">
                    </td>
                    <td>
                    <form action="manage_cart.php" method="post">
                      <input value="<?php echo $value['quantity']; ?>" type="number"
                        class="quantity-text-cart iQuantity" id="quantity" min=1 name="modQuantity" onchange="this.form.submit()">
                      <input type="hidden" name="productName" value="<?php echo $value['productName']; ?>">
                    </form>
                    </td>
                    <td class="iTotal"></td>
                    <td>
                      <form action="manage_cart.php" method="post">
                        <input type="hidden" name="productName" value="<?php echo $value['productName']; ?>">
                        <button id="form-submit" class="btn btn-sm btn-danger remove_button mt-md-0 mt-lg-0"
                          name="remove">
                          <i class="far fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>

                  </tr>
                </tbody>
                <?php 
                        $i++;}
                    }
                   ?>

              </table>
            </div>
          </div>
          <div class="col-md-4 check-out">
            <div class="col-md-12">
              <div class="section-heading">
                <h1 class="heading">Total Amount:</h1>
                <h5 class="text-right">Rs. <span id="gTotal"></span></h5>
              </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="col-md-12">
            <?php
                  if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

            ?>      
            <form action="my_cart.php" method="POST" id="order">
              <div class="row">
                <div class="col-md-12 mt-4 mt-md-0 mt-lg-0">
                  <fieldset>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name..." required>
                  </fieldset>
                </div>
                <div class="col-md-12 mt-4">
                  <fieldset>
                    <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Enter Number..." required>
                  </fieldset>
                </div>
                <div class="col-md-12 mt-4">
                  <fieldset>
                    <textarea name="address" id="address" rows="6" class="form-control"
                      placeholder="Enter your Shipping Address..." required></textarea>
                  </fieldset>
                </div>
                <div class="col-md-12 mt-4">
                  <fieldset>
                    <button type="submit" id="form-submit" class="btn contact_button mt-2 mt-md-0 mt-lg-0"
                      name="order">
                      Order Now
                    </button>
                  </fieldset>
                </div>
              </div>
            </form>
            <?php } ?>
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

  <!-- <script>
    // spinner

    const spinnerWrapperEl = document.querySelector('.spinner-wrapper');

    window.addEventListener('load', () => {
      spinnerWrapperEl.style.opacity = '0';

      setTimeout(() => {
        spinnerWrapperEl.style.display = 'none';
      }, 200);
    });
  </script> -->
  <script>
    var grandTotal = 0;
    var iPrice = document.getElementsByClassName('iPrice');
    var iQuantity = document.getElementsByClassName('iQuantity');
    var iTotal = document.getElementsByClassName('iTotal');
    var gTotal = document.getElementById('gTotal');

    function subTotal() {
      grandTotal = 0;
      for (i = 0; i < iPrice.length; i++) {
        iTotal[i].innerText = (iPrice[i].value) * (iQuantity[i].value);
        grandTotal = grandTotal + (iPrice[i].value) * (iQuantity[i].value);
      }
      gTotal.innerText = grandTotal;
    }

    subTotal();
  </script>
</body>

</html>