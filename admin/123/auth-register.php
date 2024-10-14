<?php 
include_once './connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user = "SELECT * FROM admin_users WHERE id = '" . $_SESSION['user_id'] . "'";
  $UserQuery = mysqli_query($conn, $user);
} else {
  // If no session, redirect to the login page
  header('Location: index.php');
  exit();
}

if(isset($_REQUEST['sign_up'])){
  $name = $_REQUEST['name'];
  $userName = $_REQUEST['username'];
  $userEmail = $_REQUEST['useremail'];
  $userPassword = $_REQUEST['userpassword'];
  // $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

  // user check
  $checkUser = "SELECT * FROM admin_users WHERE userName='$userName' OR userEmail='$userEmail'";
  $checkUserQuery = mysqli_query($conn, $checkUser);
  if(mysqli_num_rows($checkUserQuery) > 0){
    echo "username or email is already existed";
  }else{
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    $insertUser = "INSERT INTO admin_users (name, userName, userEmail, userPass) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertUser);
    $stmt->bind_param("ssss", $name, $userName, $userEmail, $hashedPassword);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        header('Location: index.php');
        exit(); // Important to stop further execution after redirect
    } else {
        echo "Error in Registration: " . $conn->error;
    }
  }

}


?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
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

    <title>Register | Eagle Star</title>

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
    <!-- Page -->
    <link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img src="./assets/images/eaglestar_logo.png" alt="">
              </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Register Yourself to Eagle Star</h4>

              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Enter your Name"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    onkeyup="checkUsername()"
                    autofocus
                    required
                  />
                  <span id="usernameStatus"></span>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter your email" onkeyup="checkEmail()" required/>
                  <span id="emailStatus"></span>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="userpassword"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100" name="sign_up">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="index.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->


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

    <script>
var usernameAvailable = false;
var emailAvailable = false;

function checkUsername() {
    var username = $('#username').val();
    if (username === '') {
        $('#usernameStatus').html('');
        usernameAvailable = false;
        return;
    }

    $.ajax({
        type: "POST",
        url: "check-user.php",
        data: {username: username},
        success: function(response) {
            console.log('Username check response:', response); // Debugging line
            $('#usernameStatus').html(response);
            if (response.includes("available")) {
                usernameAvailable = true;
            } else {
                usernameAvailable = false;
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error); // Debugging line
        }
    });
}

function checkEmail() {
    var email = $('#useremail').val();
    if (email === '') {
        $('#emailStatus').html('');
        emailAvailable = false;
        return;
    }

    $.ajax({
        type: "POST",
        url: "check-user.php",
        data: {email: email},
        success: function(response) {
            console.log('Email check response:', response); // Debugging line
            $('#emailStatus').html(response);
            if (response.includes("available")) {
                emailAvailable = true;
            } else {
                emailAvailable = false;
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error); // Debugging line
        }
    });
}

$('#formAuthentication').on('submit', function(e) {
    if (!usernameAvailable || !emailAvailable) {
        e.preventDefault();
        alert("Please choose a different username or email.");
    }
});

</script>
  </body>
</html>
