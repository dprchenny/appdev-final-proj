<?php



require_once "dbconnection.php";

session_start();

$payment = $_SESSION['payment'];

$userID = $_SESSION['user_id'];



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
         rel="stylesheet">
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
  <script src="https://kit.fontawesome.com/e0b3cf36af.js" crossorigin="anonymous"></script>
    
</head>
<body>

    <div class="container">


    <?php

$selectsql = "Select * from tbl_cart where user_id='$userID'";

$result = $conn->query($selectsql);

$number=1;

$shipping = 35;


if ($result->num_rows > 0) {

?>

<table class="table table-success">
    <tr>
        <th>
            Product Name
        </th>
        <th>
            Price
        </th>
        <th>
            Product Image
        </th>
        <th>
            Quantity
        </th>
    </tr>
<img src="" alt="">

<?php

$cartTotalz=0;


    foreach ($result as $fieldname) {
        echo "<tr>";
        echo "<td>".$fieldname['name']."</td>";
        echo "<td>₱".$fieldname['price']."</td>";
        echo "<td><img src='".$fieldname['img_path']."' width=100 height=100></td>";
        echo "<td>".$fieldname['quantity']."</td>";
        echo "<tr>";

       $number++;
       $cartTotalz=$cartTotalz+($fieldname['price']*$fieldname['quantity']);


    }

?>

</table>

<?php

$total = $cartTotalz+$shipping;


?>

<form action="checkout.php" method="post">
    
<div>
    <a href="shopping_cart.php" class="bottom_btn">Back to Cart</a>

    <h3 class="bottom_btn">Item Total: <span><?php echo number_format($cartTotalz) ?></span></h3>

    <h3 class="bottom_btn">Shipping Fee: ₱<span><?php echo $shipping ?></span></h3>

    <h3 class="bottom_btn">TOTAL: ₱<span><?php echo $total ?></span></h3>

    <h3 class="bottom_btn">Payment Method: <span><?php echo $payment ?></span></h3>

 


    <input type="submit" value="Place Order" name="order">
</div>
</form>




<?php
   
} else {
    echo "Cart Empty";
}

?>



</div>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>

<?php


    if (isset($_POST['order'])) {
        
        $orderStatus = "Pending";



        $ordersql = "insert into tbl_orders (user_id,order_date,total_price,order_status) values ('$userID',NOW(),$total,'$orderStatus')";

        $conn->query($ordersql);

        $last_id = $conn->insert_id;

        // $selectOrderIDsql = "select * from tbl_orders where user_id='$userID'";

        // $orderResult=$conn->query($selectOrderIDsql);

        // $fielddataaa = $orderResult->fetch_assoc();

        // $orderID = $fielddataaa['order_id'];


        $selectOrdersql = "Select * from tbl_cart where user_id='$userID'";

        $resultOrder=$conn->query($selectOrdersql);

        foreach ($resultOrder as $fieldnames) {

            $productID = $fieldnames['product_id'];

            $productQuantity = $fieldnames['quantity'];

            $productPrice = $fieldnames['price'];
     
            $orderItemsql = "insert into tbl_order_item (order_id,product_id,quantity,item_price) values ('$last_id','$productID','$productQuantity','$productPrice')";

            $conn->query($orderItemsql);

        }

           $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Placed an Order',NOW())";

    
            $conn->query($logssql);



       


        ?>

        <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Order Placed!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "user_product.php";
        });
        </script>

        <?php

    }




?>





