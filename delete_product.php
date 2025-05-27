<?php

require_once "dbconnection.php";
session_start();

$userID = $_SESSION['user_id'];

if (isset($_GET['deleteproduct'])) {
    $delete_id = $_GET['deleteproduct'];


    $deletesql = "Delete from tbl_product where product_id = $delete_id";
    
    $conn->query($deletesql);

    $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Deleted a Product',NOW())";

    
    $conn->query($logssql);


    if ($deletesql) {
        header('location:admin_products.php');
    }
}





?>
