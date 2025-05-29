<?php


require_once "dbconnection.php";

session_start();


$productID = $_GET['product'];

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
    <style>
        @import "design.css";
    </style>
</head>
<body>
  
<!-- Navbar -->
    <div id="navbarContainer">
      <div>
        <ul class="nav justify-content-center" id="navbarContent">
          <li class="nav-item">
            <a class="nav-link" href="home.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user_product.php">PRODUCTS</a>
          </li>
          <li class="nav-item" id="logoNav">
            <a class="nav-link" href="#">
              <img src="images/logo.jpg" class="img-fluid" alt="logo" />
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shopping_cart.php">ORDERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loginpage.php">LOGIN</a>
          </li>
        </ul>
      </div>
    </div>

<div class="container pt-5 pb-5 mt-5 mb-5 border border-danger rounded" style="background-color: #c7b9b7">

<?php

$selectsql = "select * from tbl_product where product_id = $productID";

 $result = $conn->query($selectsql);

 if ($result->num_rows > 0) {
    $fielddata = $result->fetch_assoc();

 } else {
    echo "0 products found!";
 }


// sql for cart count
 $cartHeadsql = "select * from tbl_cart where user_id = '$userID'";


 $cartCount = mysqli_num_rows($conn->query($cartHeadsql));
//sql for cart count

?>
<!-- cart icon with number -->
<a style="color: #5c1812" href="shopping_cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $cartCount    ?></sup></span></a>
<!-- cart icon with number -->


<!-- add to cart form -->
<form action="" method="post">

<h1 style="color: #5c1812">Product <?php echo $productID     ?></h1>

<div class="row">
    <div class="col">

<img src="<?php echo $fielddata['img_path']     ?>" alt="" width=200 height=200>

<h2 style="color: #5c1812"><?php echo $fielddata['product_name']     ?></h2>

<h3 style="color: #5c1812"><?php echo $fielddata['price']      ?></h3>

<input type="submit" class="submit_btn cart_btn" value="Add to cart" name="cart">

    </div>
</div>

</form>

<!-- add to cart form -->


</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Footer -->
    <div id="footerContainer">
      <div id="footerContent">
        <div id="footLeft">
          <div id="logoFooterContainer">
            <a class="nav-link" href="#">
              <img src="images/logo.jpg" class="img-fluid" alt="logo" />
            </a>
          </div>
          <div id="leftFootTxt">
            <p id="address">Wine Craft</p>
            <p>
              0325 Stray Kids St., <br />
              Kwangya City, South Korea <br />
              9AM to 5PM
            </p>
          </div>
        </div>
        <div id="footRight">
          <div id="rightFootTxt" class="float-end">
            <p>
              winecraft@gmail.com <br />
              +011 811 1003
            </p>
          </div>
        </div>
      </div>
    </div>
    


</body>
</html>

<?php


// cart php
if (isset($_POST['cart'])) {
    $productName = $fielddata['product_name'];
    $productPrice = $fielddata['price'];
    $productIMG = $fielddata['img_path'];
    $productQuantity = 1;
    
    


    $cartselectssql = "select * from tbl_cart where product_id='$productID' and user_id='$userID'";

    $resultcarts = $conn->query($cartselectssql);

    if ($resultcarts->num_rows == 0) {


         $cartsql = "insert into tbl_cart (name,price,img_path,quantity,user_id,product_id) values ('$productName',$productPrice,'".$productIMG."',$productQuantity,'$userID','$productID')";

        $conn->query($cartsql);

           $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Added item to cart',NOW())";

    
             $conn->query($logssql);


    
        ?>

        <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Item added to cart!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "shopping_cart.php";
        });
        </script>

        <?php
        

    
    }else if ($resultcarts->num_rows > 0){

        ?>

        <script>
        Swal.fire({
        position: "center",
        icon: "info",
        title: "Item already added to cart!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "shopping_cart.php";
        });
        </script>

        <?php
        
         
    }


  
}





?>
