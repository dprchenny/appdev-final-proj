<?php

require_once "dbconnection.php";
session_start();

$userID = $_SESSION['user_id'];

if (isset($_GET['deletecart'])) {
    $delete_id = $_GET['deletecart'];


    $deletesql = "Delete from tbl_cart where cart_id = $delete_id";
    
    $conn->query($deletesql);


    if ($deletesql) {
        header('location:shopping_cart.php');
    }
}





?>
