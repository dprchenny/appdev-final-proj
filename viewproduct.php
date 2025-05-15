//viewing each products

//viewproduct.php

<?php


require_once "dbconnection.php";

session_start();

$productID = $_GET['product'];

echo $productID;

$viewProductsql = "Select * from tbl_product where product_id = '".$productID."' ";

 $viewresult = $conn->query($viewProductsql);



        
    $fielddata = $viewresult->fetch_assoc();


    $productName = $fielddata['product_name'];
    $productDesc= $fielddata['description'];
    $productQuantity= $fielddata['available_quantity'];
    $productCategory= $fielddata['category'];
    $productIMG= $fielddata['img_path'];


    
echo $productName;




?>


