<?php

require_once "dbconnection.php";
session_start();

$userID = $_SESSION['user_id'];

if (isset($_GET['deleteorder'])) {
    $delete_id = $_GET['deleteorder'];


    $deletesql = "Delete from tbl_orders where order_id = $delete_id";
    
    $conn->query($deletesql);
    

    $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Deleted an Order',NOW())";

    
    $conn->query($logssql);


    if ($deletesql) {
        header('location:admin_orders.php');
    }
}





?>
