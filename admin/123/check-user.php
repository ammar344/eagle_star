<?php
// Include your database connection
include './connection.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];

    // Check if username exists
    $checkUser = "SELECT * FROM admin_users WHERE userName='$username'";
    $result = mysqli_query($conn, $checkUser);

    if(mysqli_num_rows($result)){
        echo "Username already exists."; // Response if the username exists
    } else {
        echo "Username available."; // Response if the username is available
    }
}

if(isset($_POST['email'])){
    $email = $_POST['email'];

    // Check if email exists
    $checkEmail = "SELECT * FROM admin_users WHERE userEmail='$email'";
    $result = mysqli_query($conn, $checkEmail);

    if(mysqli_num_rows($result) > 0){
        echo "Email already exists."; // Response if the email exists
    } else {
        echo "Email available."; // Response if the email is available
    }
}
?>
