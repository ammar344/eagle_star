<?php
include_once('connection.php');

session_start();
// session_destroy();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // adding items to cart
    if(isset($_REQUEST["add_to_cart"])){

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();  // Initialize the cart as an empty array
        }
         
        if($_SESSION['cart']){
            $myItems = array_column($_SESSION['cart'], 'productName');
            if(in_array($_REQUEST['productName'], $myItems)){
                echo "<script>
                alert('Item already added to Cart');
                window.location.href='products.php?page=1';
                </script>";

            }else{
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array('productId'=>$_REQUEST['productId'], 'productCode'=>$_REQUEST['productCode'], 'productName'=>$_REQUEST['productName'], 'productPrice'=>$_REQUEST['productPrice'], 'quantity'=>$_REQUEST['quantity']);
                echo "<script>
                alert('Item added');
                window.location.href='products.php?page=1';
                </script>";
            }

          
        }else{
            $_SESSION['cart'][0]=array('productId'=>$_REQUEST['productId'], 'productCode'=>$_REQUEST['productCode'], 'productName'=>$_REQUEST['productName'], 'productPrice'=>$_REQUEST['productPrice'], 'quantity'=>$_REQUEST['quantity']);
            echo "<script>
            alert('Item added');
            window.location.href='products.php?page=1';
            </script>";
        }
    }

    // removing item from cart
    if(isset($_REQUEST['remove'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['productName']==$_REQUEST['productName']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']); // re-arrange array
                echo "<script>
                alert('Item Removed successfully.');
                window.location.href='my_cart.php';
                </script>";
            }
        }
    }

    // modify quantity
    if(isset($_REQUEST['modQuantity'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['productName']==$_REQUEST['productName']){
                $_SESSION['cart'][$key]['quantity'] = $_REQUEST['modQuantity'];
                echo "<script>
                window.location.href='my_cart.php';
                </script>";
            }
        }
    }
}
?>