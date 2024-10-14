<?php 
include_once './connection.php';

// delete product funtion

$productId = $_GET['deleteId'];

$delete = "DELETE FROM products WHERE id = $productId";
$deleteQuery = mysqli_query($conn, $delete);
if($deleteQuery){
    header('Location: ./products_manage.php');
}else{
    echo "Error in deleting product";
}

// delete message function

$messageId = $_GET['deleteMesId'];

$delete = "DELETE FROM contact_us WHERE id = $messageId";
$deleteQuery = mysqli_query($conn, $delete);
if($deleteQuery){
    header('Location: ./messages.php');
}else{
    echo "Error in deleting message";
}

// order status
$orderStatusId = $_GET['orderStatusId'];

$updateStatus = "UPDATE orders SET status = 'Delevered' WHERE id = $orderStatusId";
$updateStatusQuery = mysqli_query($conn, $updateStatus);
if($updateStatusQuery){
    header('Location: ./orders.php');
}else{
    echo "Error in changing status";
}


// delete order funtion
$orderId = $_GET['orderDeleteId'];

$delete = "DELETE FROM orders WHERE id = $orderId";
$deleteQuery = mysqli_query($conn, $delete);
if($deleteQuery){
    header('Location: ./orders.php');
}else{
    echo "Error in deleting product";
}

// Subscribers delete
$subId = $_GET['deleteSubId'];

$delete = "DELETE FROM subscribes WHERE id = $subId";
$deleteQuery = mysqli_query($conn, $delete);
if($deleteQuery){
    header('Location: ./subscribe.php');
}else{
    echo "Error in deleting product";
}
?>