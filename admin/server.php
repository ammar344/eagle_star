<?php 
include_once('connection.php');
$cmd = $_REQUEST['cmd'];
switch($cmd){
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