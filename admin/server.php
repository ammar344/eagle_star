<?php 
include_once('connection.php');
$cmd = $_REQUEST['cmd'];
switch($cmd){
    // case subscribe
    case "subscribe":{
        if(isset($_REQUEST['subscribe'])){
            $subEmail = $_REQUEST['semail'];
            // check email 
            $checkEmail = "SELECT * FROM subscribes WHERE semail = '$subEmail'";
            $check_query = mysqli_query($conn, $checkEmail);
            $email_show = mysqli_fetch_array($check_query);
            if($email_show){
                header('Location: ../index.php');
                // echo'<script type="text/javascript">alert("Email is already exist")</script>';
                // header('Location: ../index.php');
            }else{
            $insert = "INSERT INTO subscribes (semail) VALUES ('$subEmail')";
            $insert_query = mysqli_query($conn, $insert);
            if($insert_query){
                header('Location: ../index.php');
            }else{
                echo "error";
            }
            }
        }
    }break;
    case "upload":{
        if(isset($_REQUEST['upload'])){
            $productName = mysqli_real_escape_string($conn, $_REQUEST['product_name']);
            $imgName = $_FILES['img']['name'];
            $folder = './product_images'.$imgName;
            $price = $_REQUEST['product_price'];

            // MySQLi to insert data
            $insert_data = "INSERT INTO products (product_name, image, price) VALUES ('$productName', '$imgName', '$price')";
            $insert_query = mysqli_query($conn, $insert_data);
            if($insert_query){
                header('Location: upload_products.php');
            }else{
                echo"Error";
            }
        }
    }break;
    case "featuredUpload":{
        if(isset($_REQUEST['featuredUpload'])){
            $featuredName = $_REQUEST['featured_name'];
            $featuredImgName = $_FILES['featured-img']['name'];
            $folder = './featured_images'.$featuredImgName;
            $featuredPrice = $_REQUEST['featured_price'];

            // MySQLi to insert data
            $insert_data = "INSERT INTO featured_items (featured_name, featured_image, featured_price) VALUES ('$featuredName', '$featuredImgName', '$featuredPrice')";
            $insert_query = mysqli_query($conn, $insert_data);
            if($insert_query){
                header('Location: upload_products.php');
            }else{
                echo"Error";
            }
        }
    }break;

}
?>