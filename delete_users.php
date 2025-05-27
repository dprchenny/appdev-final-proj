<?php

require_once "dbconnection.php";
session_start();

$userID = $_SESSION['user_id'];

if (isset($_GET['deleteusers'])) {
    $delete_id = $_GET['deleteusers'];


    $deletesql = "Delete from tbl_users where user_id = $delete_id";
    
    $conn->query($deletesql);

    $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Deleted a user',NOW())";

    
    $conn->query($logssql);


    if ($deletesql) {
        header('location:admin_users.php');
    }
}





?>
