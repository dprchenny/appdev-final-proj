<?php


require_once "dbconnection.php";

session_start();


$productID = $_GET['product'];

$userID = $_SESSION['user_id'];

if (isset($_GET['deleteall'])) {
    $deletesql = "delete from tbl_cart";

    $conn->query($deletesql);

    header('location:shopping_cart.php');
}


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


if ($result->num_rows > 0) {

?>

<table class="table table-success">
    <tr>
        <th>
            Cart ID
        </th>
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
        <th>
            Total Price
        </th>
        <th>
            Action
        </th>
    </tr>
<img src="" alt="">

<?php

$cartTotalz=0;


    foreach ($result as $fieldname) {
        echo "<tr>";
        echo "<td>".$number."</td>";
        echo "<td>".$fieldname['name']."</td>";
        echo "<td>₱".$fieldname['price']."</td>";
        echo "<td><img src='".$fieldname['img_path']."' width=100 height=100></td>";
        echo "<td>
                <form action='' method='post'>
                    <input type='hidden' value='".$fieldname['cart_id']."' name='updateQuantityID'>
                <div>
                <input type='number' min = '1' value='".$fieldname['quantity']."' name='updateQuantity'>
                <input type='submit' value='update' name='updateCart'>
                </div>
                </form>
            </td>";
        echo "<td>₱".$total=($fieldname['price']*$fieldname['quantity'])."</td>";
        echo "<td>
                <a href='delete_shopping_cart.php?deletecart=".$fieldname['cart_id']."' class='delete'>
                    <i class='fas fa-trash'></i>Remove
                </a>
            </td>";
        echo "<tr>";

       $number++;
       $cartTotalz=$cartTotalz+($fieldname['price']*$fieldname['quantity']);
    }

?>

</table>

<?php


if ($cartTotalz>0) {
    echo "<div>
    <a href='user_product.php' class='bottom_btn'>Continue Shopping</a>

    <h3 class='bottom_btn'>Grand Total: <span><?php echo number_format($cartTotalz) ?></span></h3>

    <a href='confirm_payment.php' class='bottom_btn'>Proceed to Checkout</a>
    </div>";


?>




<a href="shopping_cart.php?deleteall" class="delete_all_btn">
    <i class="fas fa-trash"></i>
    Delete All
</a>

<?php
}


   
} else {
    echo "Cart Empty";

    ?>

    <a href="user_product.php">Shop Now</a>


<?php
}

?>



</div>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>

<?php


    if (isset($_POST['updateCart'])) {
        $cartUpdateQuantity=$_POST['updateQuantity'];
        $updateQuantityID=$_POST['updateQuantityID'];



        $updateQuantitysql = "update tbl_cart set quantity='$cartUpdateQuantity' where cart_id='$updateQuantityID'";


        $conn->query($updateQuantitysql);

        
        ?>

        <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Quantity updated!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "shopping_cart.php";
        });
        </script>

        <?php

    }




?>





