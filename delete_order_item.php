<?php

require_once "dbconnection.php";
session_start();

$userID = $_SESSION['user_id'];

if (isset($_GET['deleteorderitem'])) {
    $delete_id = $_GET['deleteorderitem'];


    $deletesql = "Delete from tbl_order_item where order_item_id = $delete_id";
    
    $conn->query($deletesql);
    

    $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Deleted an Order Item',NOW())";

    
    $conn->query($logssql);


    if ($deletesql) {
        header('location:admin_order_item.php');
    }
}





?>
